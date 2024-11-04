<?php
$servername = "localhost"; //ชื่อเซิร์ฟเวอร์
$username = "root"; //รหัสผู้ใช้
$password = ""; //รหัสผ่าน
$dbname = "history"; //ชื่อฐานข้อมูล
$conn = mysqli_connect($servername, $username, $password, $dbname); //เชื่อมต่อฐานข้อมูล
// if (!$conn) {
//     die("Connection failed:" . $conn->connect_error);
// }
// echo "Connected successfully";