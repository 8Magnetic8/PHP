<!DOCTYPE html>
<html lang="th">

<head>
    <title>การเชื่อมต่อฐานข้อมูล MYSQL</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script>
    function reloadwithoutofdata() {
        window.location.href = "?";
    }
    </script>
</head>

<body>
    <?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "history";
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn,"utf8");
if(isset($_GET['submit'])){
    $code=$_GET['code']??"";
    $name=$_GET['name']??"";
    $surname=$_GET['surname']??"";
    $program=$_GET['program']??"";
    $sex=$_GET['sex']??"";
    $nameandsurname=$name."  ".$surname;
    $conn->query ("insert into student(code,nameandsurname,programID,sex) values ('$code','$nameandsurname','$programID','$sex')");
    if ($conn) 
    {
        $msg="เพิ่มข้อมูลเรียบร้อยแล้ว";
    }
    $conn->close();
}
?>
    <div class="container w-50 my-4">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">ฟอร์มป้อนข้อมูลประวัตินักศึกษา</h5>
            </div>

            <form action="" method="get" id="myform">
                <div class="input-group">
                    <div class="input-group-prepend w-25">
                        <span class="input-group-text">รหัสนักศึกษา</span>
                    </div>
                    <input type="number" name="code" placeholder="9999999999" class="form-control" value="<?=@$code;?>">
                </div>
                <div class="input-group">
                    <div class="input-group-prepend w-25">
                        <span class="input-group-text">ชื่อและนามสกุล</span>
                    </div>
                    <input type="text" placeholder="ป้อนชื่อพร้อมคำนำหน้า" name="name" class="form-control"
                        value="<?=@$name;?>">
                    <input type="text" placeholder="ป้อนนามสกุล" name="surname" class="form-control"
                        value="<?=@$surname;?>">
                </div>
                <div class="input-group">
                    <div class="input-group-prepend w-25">
                        <span class="input-group-text">โปรแกรมวิชา</span>
                    </div>
                    <select name="program" class="form-select">
                        <option selected disabled>กรุณาเลือกโปรแกรมวิชาเอก</option>
                        <?php
                        // $strprogram ="SELECT * FROM program";
                        // $arrprogram=$conn->$query($strprogram);
                        $strprogram = "select * from program";
                        $arrprogram=$conn -> query($strprogram);

                        while($row = $arrprogram-> fetch_assoc()){
                        //    echo "<option value=''> </option>";
                           echo "<option value='{$row['programID']}'>{$row['programName']}</option>";}

                       ?>
                    </select>

                </div>
                <div class="input-group">
                    <div class="input-group-prepend w-25">
                        <span class="input-group-text">เพศ</span>

                    </div>
                    <?php
                         $arrsex=array('m'=>"ชาย",'f'=>"หญิง");
                         foreach($arrsex as $key=>$item){         
                            if($key==$sex){ ?>
                    <div class="form-check m-1">
                        <input class="form-check-input" type="radio" name="sex" id="sex" value="<?=$key;?>" checked>
                        <label class="form-check-label" for="sex"><?=$item;?></label>
                    </div>
                    <?php        

                            }   else{                                 
                        ?>
                    <div class="form-check m-1">
                        <input class="form-check-input" type="radio" name="sex" id="sex" value="<?=$key;?>">
                        <label class="form-check-label" for="sex"><?=$item;?></label>
                    </div>
                    <?php }} ?>
                </div>

                <div class="modal-footer">

                    <input class="btn btn-primary" type="submit" name="submit" value="ยืนยัน">
                    <input class="btn btn-danger" type="reset" value="ยกเลิก" onclick="window.location.href = '?'">

                </div>
                <p id="msg" class="fs-3 text-primary text-center"><?=@$msg;?></p>
            </form>

        </div>
    </div>
</body>

</html>

