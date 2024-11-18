<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
if(isset($_GET['save'])&&(isset($_GET['programName']))){
include("conDB.php");
$programName=$_GET['programName']??"";
$sql="insert into program values ('','{$programName}')";
$conn->query($sql);
if ($conn) {
    echo "เพิ่มข้อมูลเรียบร้อยแล้ว";

} 
} else {
    echo "เกิดข้อผิดพลาดในการเพิ่มข้อมูล";
} 
$conn->close();

?>
</body>
</html>