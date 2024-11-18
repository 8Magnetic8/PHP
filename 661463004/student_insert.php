<?php
//ส่งแบบGETเรียกใช้แบบ Array
if(isset($_GET['save'])&&(isset($_GET['nameandsurname']))){
include("conDB.php");
$nameandsurname=$_GET['nameandsurname']??"";
$sql="insert into student values ('','{$nameandsurname}')";
$conn->query($sql);
if ($conn) {
    echo "เพิ่มข้อมูลเรียบร้อยแล้ว";
    echo "<a href=\"student.php\">แสดงข้อมูล</a>";
} 
}
$conn->close();
?>