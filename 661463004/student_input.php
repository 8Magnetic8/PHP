<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>เพิ่มข้อมูลโปรแกรมวิชา</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
    body {
        display: flex;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
        border:
    }

    #forminput {
        max-width: 790px;
        padding: 15px;
    }

    #inputform {
        display: none;
    }
    </style>
    <script>
    function newRecord() {
        window.location.href = "?status=2";
    }
    </script>
</head>
<body>
<div class="container p-3 bg-info bg-opacity-10 border border-info rounded-end" id="show">
        <form action="" method="get" id="inputform" class="w-100 m-auto">

            <h2><?=@$title;?></h2>
            <div class="input-group">
                <div class="input-group-prepend w-25">
                    <span class="input-group-text">รหัสนักศึกษา</span>
                </div>
                <input type="hidden" name="status" class="form-control" value="<?=@$status;?>">
                <input type="number" name="code" placeholder="9999999999" class="form-control" value="<?=@$code;?>">
            </div>
            <div class="input-group">
                <div class="input-group-prepend w-25">
                    <span class="input-group-text">ชื่อและนามสกุล</span>
                </div>
                <input type="text" placeholder="ป้อนชื่อและนามสกุลพร้อมคำนำหน้า" name="nameandsurname"
                    class="form-control" value="<?=@$nameandsurname;?>">
            </div>
            <div class="input-group">
                <div class="input-group-prepend w-25">
                    <span class="input-group-text">โปรแกรมวิชา</span>
                </div>
                <select name="programID" class="form-select">
                    <option selected disabled>กรุณาเลือกโปรแกรมวิชาเอก</option>
                    <?php
        $sql="select * from program";
        $result=$conn->query($sql);
     while ($row=$result->fetch_array()) {
        if ($programID==$row[0]) {
            echo "<option selected value=$row[0]>";
        } else {
            echo "<option value=$row[0]>";
        }
        echo $row[1];
        echo "</option>";
        }

        ?>
                </select>

            </div>
            <div class="input-group">
                <div class="input-group-prepend w-25">
                    <span class="input-group-text">เพศ</span>
                </div>
                <?php
     $arrsex=array("m"=>"ชาย","f"=>"หญิง");
        foreach ($arrsex as $k=>$v) {
        if ((isset($sex))&&($sex==$k)) { ?>
                <div class="form-check m-1">
                    <input checked class="form-check-input" type="radio" name="sex" id="sex" value="<?=$k;?>">
                    <label class="form-check-label" for="sex"><?=$v;?></label>
                </div>
                <?php } else { ?>
                <div class="form-check m-1">
                    <input class="form-check-input" type="radio" name="sex" id="sex" value="<?=$k;?>">
                    <label class="form-check-label" for="sex"><?=$v;?></label>
                </div>
                <?php }
                }?>
            </div>

            <div class="modal-footer">

                <input class="btn btn-primary" type="submit" name="submit" value="บันทึกข้อมูล">
                <input class="btn btn-danger" type="button" name="reset" value="ยกเลิก"
                    onclick="window.location.replace(location.pathname)">

            </div>
            <hr>
        </form>


        <?php
        echo "<h2>ข้อมูลนักศึกษา</h2>";
        echo "<button class='btn btn-info' onclick='newRecord();'>เพิ่มข้อมูล</button>";
        //$sql="select * from student";
        $sql="select student.*,program.programName from student left join program on program.programID=student.programID order by code";
        $result=$conn->query($sql);
        $sex=["f"=>"หญิง","m"=>"ชาย"];
        if ($result->num_rows>0) {
        $arrsex=array("m"=>"ชาย","f"=>"หญิง");
        echo "<table class='table'>";
        echo "<TR><th>#</th><Th>รหัสนักศึกษา</Th><Th>ชื่อและนามสกุล</Th><Th>โปรแกรมวิชาเอก</Th><Th>เพศ</Th></TR>";
        $no=0;    <div class="container p-3 bg-info bg-opacity-10 border border-info rounded-end" id="show">
        <form action="" method="get" id="inputform" class="w-100 m-auto">

            <h2><?=@$title;?></h2>
            <div class="input-group">
                <div class="input-group-prepend w-25">
                    <span class="input-group-text">รหัสนักศึกษา</span>
                </div>
                <input type="hidden" name="status" class="form-control" value="<?=@$status;?>">
                <input type="number" name="code" placeholder="9999999999" class="form-control" value="<?=@$code;?>">
            </div>
            <div class="input-group">
                <div class="input-group-prepend w-25">
                    <span class="input-group-text">ชื่อและนามสกุล</span>
                </div>
                <input type="text" placeholder="ป้อนชื่อและนามสกุลพร้อมคำนำหน้า" name="nameandsurname"
                    class="form-control" value="<?=@$nameandsurname;?>">
            </div>
            <div class="input-group">
                <div class="input-group-prepend w-25">
                    <span class="input-group-text">โปรแกรมวิชา</span>
                </div>
                <select name="programID" class="form-select">
                    <option selected disabled>กรุณาเลือกโปรแกรมวิชาเอก</option>
                    <?php
    $sql="select * from program";
    $result=$conn->query($sql);
    while ($row=$result->fetch_array()) {
        if ($programID==$row[0]) {
            echo "<option selected value=$row[0]>";
        } else {
            echo "<option value=$row[0]>";
        }
        echo $row[1];
        echo "</option>";
    }
        }
    ?>
                </select>

            </div>
            <div class="input-group">
                <div class="input-group-prepend w-25">
                    <span class="input-group-text">เพศ</span>
                </div>
                <?php
     $arrsex=array("m"=>"ชาย","f"=>"หญิง");
    foreach ($arrsex as $k=>$v) {
        if ((isset($sex))&&($sex==$k)) { ?>
                <div class="form-check m-1">
                    <input checked class="form-check-input" type="radio" name="sex" id="sex" value="<?=$k;?>">
                    <label class="form-check-label" for="sex"><?=$v;?></label>
                </div>
                <?php } else { ?>
                <div class="form-check m-1">
                    <input class="form-check-input" type="radio" name="sex" id="sex" value="<?=$k;?>">
                    <label class="form-check-label" for="sex"><?=$v;?></label>
                </div>
                <?php }
                }?>
            </div>

            <div class="modal-footer">

                <input class="btn btn-primary" type="submit" name="submit" value="บันทึกข้อมูล">
                <input class="btn btn-danger" type="button" name="reset" value="ยกเลิก"
                    onclick="window.location.replace(location.pathname)">

            </div>
            <hr>
        </form>


        <?php
    echo "<h2>ข้อมูลนักศึกษา</h2>";
    echo "<button class='btn btn-info' onclick='newRecord();'>เพิ่มข้อมูล</button>";
    //$sql="select * from student";
    $sql="select student.*,program.programName from student left join program on program.programID=student.programID order by code";
    $result=$conn->query($sql);
    if ($result->num_rows>0) {
        $arrsex=array("m"=>"ชาย","f"=>"หญิง");
        echo "<table class='table'>";
        echo "<TR><th>#</th><Th>รหัสนักศึกษา</Th><Th>ชื่อและนามสกุล</Th><Th>โปรแกรมวิชาเอก</Th><Th>เพศ</Th></TR>";
        $no=0;
        while ($row=$result->fetch_array()) {
            $no++;
            echo "<TR>";
            echo "<TD>$no</TD>";
            echo "<TD>$row[0]</TD>";
            echo "<TD>$row[1]</TD>";
            echo "<TD>".$row['programName']."</TD>";
            echo "<TD>".$arrsex[$row[3]]."</TD>";
            echo "<TD><a href='?status=1&&id=$row[0]'>แก้ไข</a>||";
            echo "<a href='?status=3&&id=$row[0]' onClick=\"javascript: return confirm('ยืนยันลบข้อมูล $row[1]');\">ลบข้อมูล</a></TD>";
            echo "</TR>";
        }
        echo "</table>";
    }
    $conn->close();

    if (($status==1)||($status==2)) {
        echo "<script>";
        echo "document.getElementById(\"inputform\").style.display = \"inline\";";
        echo "</script>";
    }
    ?>

    </div>

</body>
</html>
