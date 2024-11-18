<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>แก้ไขข้อมูลนักศึกษา</title>
        <style>
        .forminput {
            width: 50%;
            margin: auto;
        }
        .input {
            padding: 20px;
            display: block;
            border: none;
            border-bottom: 1px solid #000000;
            width: 90%;
            font-size: 1.5em;
        }
        .header {
            color: #fff;
            background-color: #2196F3;
            padding: 20px 10px;
        }
        label {
            font-size: 1.5em;
        }
        .btn-submit,
        .btn-reset {
            width: 20%;
            border-radius: 25px;
            padding: 10px;
            font-size: 1.5em;
        }
        .btn-submit:hover {
            background-color: #2196F3;
        }
        .btn-reset:hover {
            background-color: #FF66B2;
        }
        </style>
    </head>
    <body>
        <?php
if (isset($_GET['code'])) {
    include "conDB.php";
    $code = $_GET['code'] ?? "";//เช็คว่ามีcodeส่งมาไหม
    $sql = "select * from student where code={$code}";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_row()) {
            $nameandsurname = $row[1];
        }
    }
}
?>
        <div class="forminput">
            <div class="header">
                <h1>แก้ไขข้อมูลนักศึกษา</h1>
            </div>
            <form action="student_update.php">
                <input type="text" class="input" name="code" value="<?=$code;?>">
                <p>
                    <label>ชื่อและนามสกุล</label>
                    <input type="text" class="input" name="nameandsurname" value="<?=$nameandsurname;?>">
                </p>
                </p>
                <input type="submit" class="btn-submit" name="update" value="บันทึก">
                <input type="reset" class="btn-reset" value="ยกเลิก">
            </form>
        </div>
    </body>
</html>

