<?php
include 'db.php';

$msg = "";

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $image = $_FILES['image']['name'];
    $target_dir = "images/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $target_file = $target_dir . basename($image);
    $image_path_db = "images/" . basename($image);
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        try {
            $sql = "INSERT INTO flowers (name, description, image) VALUES (:name, :desc, :image)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':name' => $name,
                ':desc' => $desc,
                ':image' => $image_path_db
            ]);
            $msg = "Thêm hoa thành công!";
        } catch (PDOException $e) {
            $msg = "Lỗi CSDL: " . $e->getMessage();
        }
    } else {
        $msg = "Lỗi khi upload ảnh.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Thêm Hoa Mới</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        form { max-width: 500px; margin: 0 auto; }
        input, textarea { width: 100%; margin-bottom: 10px; padding: 8px; }
        button { padding: 10px 20px; background: green; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Thêm loài hoa mới</h1>
    <?php if($msg) echo "<p style='text-align:center; color:red'>$msg</p>"; ?>

    <form method="POST" enctype="multipart/form-data">
        <label>Tên hoa:</label>
        <input type="text" name="name" required>
        
        <label>Mô tả:</label>
        <textarea name="description" rows="5" required></textarea>
        
        <label>Hình ảnh:</label>
        <input type="file" name="image" required>
        
        <button type="submit" name="submit">Lưu vào CSDL</button>
        <br><br>
        <a href="index.php">Quay lại trang chủ</a>
    </form>
</body>
</html>