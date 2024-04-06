<?php
//Tạo và Kiểm tra kết nối
include("connect_db.php");
// Tạo cơ sở dữ liệu
$sql = "CREATE DATABASE Kiemtra";
if (mysqli_query($conn, $sql)) {
echo "Database created successfully";
} else {
echo "Error creating database: " . mysqli_error($conn);
}
//Đóng kết nối
?>