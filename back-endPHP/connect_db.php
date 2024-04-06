<?php
$servername = "localhost";
$username = "root";
$password = "";
//Tạo kết nối
$conn = mysqli_connect($servername, $username, $password, 'joker_vote');
//Kiểm tra kết nối
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}
?>