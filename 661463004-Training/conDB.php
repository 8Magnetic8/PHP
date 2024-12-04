<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "training";
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn,"utf8");   
// if($arr_sex)
// {
$arr_sex=["f"=>"หญิง","m"=>"ชาย"];
// }
?>

