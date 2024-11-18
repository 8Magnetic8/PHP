<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลโปรแกรมวิชา</title>
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
        </style>


</head>
<body>
<?php
if(isset($_GET['programID'])){
include("conDB.php");
$programID=$_GET['programID']??"";
$programName = isset($_POST['programName']) ? $_POST['programName'] : '';
$sql="select * from program where programID= {$programID}";
$result = $conn->query($sql);
if ($result->num_row > 0) {
    while($row = $result->fetch_row()){
        $programName=$row[1];
    }
}  
}
?>
    <div class="forminput">
            <div class="header">
                <h1>แก้ไขข้อมูลโปรแกรมวิชา</h1>
            </div>
            <form action="program_insert.php">
                <input type="text" class="input" name="programID" value = "<?=$programID;?>">
                <p>
                    <label>ชื่อโปรแกรมวิชา</label>
                    <input type="text" class="input" name="programName" value = "<?=$programName;?>">
                </p>
                <input type="submit" class="btn-submit" name="save" value="บันทึก">
                <input type="reset" class="btn-reset" value="ยกเลิก">
            </form>
        </div>
</body>
</html>