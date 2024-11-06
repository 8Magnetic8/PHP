<?php
$servername = "localhost"; //ชื่อเซิร์ฟเวอร์
$username = "root"; //รหัสผู้ใช้
$password = ""; //รหัสผ่าน
$dbname = "history"; //ชื่อฐานข้อมูล
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed:" . $conn->connect_error);}
    echo "Connected successfully";
?>