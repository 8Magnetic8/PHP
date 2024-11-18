<?php
//ส่งแบบGETเรียกใช้แบบ Array
if(isset($_GET['save'])&&(isset($_GET['programName']))){
include("conDB.php");
$programName=$_GET['programName']??"";
$sql="insert into program values ('','{$programName}')";
$conn->query($sql);
if ($conn) {
    echo "เพิ่มข้อมูลเรียบร้อยแล้ว";
    echo "<a href=\"program.php\">แสดงข้อมูล</a>";
} 
}
$conn->close();
?>
