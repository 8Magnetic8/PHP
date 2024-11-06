<?php
$servername = "localhost"; //ชื่อเซิร์ฟเวอร์
$username = "root"; //รหัสผู้ใช้
$password = ""; //รหัสผ่าน
$dbname = "history"; //ชื่อฐานข้อมูล
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed:" . $conn->connect_error);
}
echo "Connected successfully";

$code = $_GET['code'] ?? "";
$nameandsurname = $_GET['nameandsurname'] ?? "";
$programID = $_GET['programID'] ?? "";
$sex = $_GET['sex'] ?? "";

mysqli_set_charset($conn, "utf8");
$conn->query("insert into student(code,nameandsurname,programID,sex) values ('$code','$nameandsurname','$programID','$sex')");
if ($conn) {
    echo "เพิ่มข้อมูลเรียบร้อยแล้ว";
}
$conn->close();