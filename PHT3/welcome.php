<?php
session_start();
if (isset($_SESSION['login'])) {
    $loggedInUser = $_SESSION['login'];
    echo "<h1>Chào mừng trở lại, $loggedInUser!</h1>";
    echo "<p>Bạn đã đăng nhập thành công.</p>";
    echo '<a href="login.html">Đăng xuất (Tạm thời)</a>';
} 
else {
    header('Location: login.html');
    exit;
}
?>