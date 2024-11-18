<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลโปรแกรมวิชา</title>
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
            font-size:1.5em;
        }
        .header {
            color: #fff;
            background-color: #2196F3;
            padding:20px 10px;
        }
        label{
            font-size:1.5em;
        }
        .btn-submit,
        .btn-reset
        {
            width: 20%;
            border-radius: 25px;
            padding:10px;
            font-size:1.5em;
        }
        .btn-submit:hover{
            background-color: #2196F3;
        }
        .btn-reset:hover{
            background-color: #FF66B2;
        }
        a{
            width: 20%;
            border-radius: 25px;
            padding:10px;
            font-size:1.5em;
            background-color:#2196F3;
            color: #000;           
        }
        </style>
</head>
<body>
    <div class="forminput">
            <div class="header">
                <h1>เพิ่มข้อมูลโปรแกรมวิชา</h1>
            </div>
            <form action="program_insert.php">
                <p>
                    <label>ชื่อโปรแกรมวิชา</label>
                    <input type="text" class="input" name="programName">
                </p>
                <input type="submit" class="btn-submit" name="save" value="แก้ไข">
                <input type="reset" class="btn-reset" value="ยกเลิก">
                <a href="program.php">กลับสู่หน้าหลัก</a>
            </form>
        </div>
</body>
</html>
