<?php
if (isset($_GET['update']) && isset($_GET['programID']) && isset($_GET['programName'])) {
    include "conDB.php";
    $programID = $_GET['programID'] ?? "";
    $programName = $_GET['programName'] ?? "";
    if ($programID != "") {
        $sql = "update program  set programName='{$programName}' where programID='{$programID}'";
        $conn->query($sql);
        if ($conn) {
            echo "แก้ไขข้อมูลเรียบร้อยแล้ว";
            echo "<a href=\"program.php\">แสดงข้อมูล</a>";
        }
    }
    $conn->close();
}
?>