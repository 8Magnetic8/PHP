<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

include "conDB.php";
$id = $_GET["id"] ?? "";
$sql = "delete from program where programID=$id";
$result = $conn->query($sql);
$num_rows = mysqli_affected_rows($conn);
if ($num_rows > 0) {
    echo '<script type="text/javascript">';
    echo 'alert("ลบข้อมูลเรียบร้อยแล้วจำนวน ' . $num_rows . ' เรคคอร์ด");';
    echo 'window.location.href = "inputProgram.php";';
    echo '</script>';
}
?>
</body>
</html>