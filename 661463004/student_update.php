<?php
if (isset($_GET['update']) && isset($_GET['code']) && isset($_GET['nameandsurname'])) {
    include "conDB.php";
    $code = $_GET['code'] ?? "";
    $nameandsurname = $_GET['nameandsurname'] ?? "";
    if ($code != "") {
        $sql = "update student set nameandsurname='{$nameandsurname}' where code='{$code}'";
        $conn->query($sql);
        if ($conn) {
            echo "แก้ไขข้อมูลเรียบร้อยแล้ว";
            echo "<a href=\"student.php\">แสดงข้อมูล</a>";
        }
    }
    $conn->close();
}
?>