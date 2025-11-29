<?php
$filename = '65HTTT_Danh_sach_diem_danh.csv';
$data = [];

if (file_exists($filename)) {
    if (($handle = fopen($filename, "r")) !== FALSE) {
        $headers = fgetcsv($handle, 1000, ",");
        if (isset($headers[0])) {
            $headers[0] = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $headers[0]); 
        }
        while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $data[] = array_combine($headers, $row);
        }
        fclose($handle);
    }
} else {
    echo "Không tìm thấy file CSV.";
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 03: Đọc dữ liệu từ file CSV</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4 text-primary">Danh sách tài khoản (Từ file CSV)</h2>
    
    <?php if (!empty($data)): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Họ đệm (Lastname)</th>
                        <th>Tên (Firstname)</th>
                        <th>Lớp/Thành phố (City)</th>
                        <th>Email</th>
                        <th>Khóa học (Course1)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $student): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($student['username']); ?></td>
                            <td><?php echo htmlspecialchars($student['password']); ?></td>
                            <td><?php echo htmlspecialchars($student['lastname']); ?></td>
                            <td><?php echo htmlspecialchars($student['firstname']); ?></td>
                            <td><?php echo htmlspecialchars($student['city']); ?></td>
                            <td><?php echo htmlspecialchars($student['email']); ?></td>
                            <td><?php echo htmlspecialchars($student['course1']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <div class="alert alert-info mt-3">
            <strong>Tổng số dòng dữ liệu:</strong> <?php echo count($data); ?>
        </div>

    <?php else: ?>
        <div class="alert alert-warning">
            Không có dữ liệu hoặc lỗi đọc file.
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>