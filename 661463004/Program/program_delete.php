<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>หน้าจัดการข้อมูลโปรแกรมวิชา</title>
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
    <?php
include("conDB.php");

    $status=$_GET['status']??"";
    $id=$_GET['id']??"";
    $programID=$_GET['programID']??"";
    $programName=$_GET['programName']??"";
    $btnsave=$_GET['btnsave']??"";
    $title="ข้อมูลโปรแกรมวิชา";
    switch($status) {
        case 1:
            if ($btnsave!=="") {
                $programID=(isset($_GET['programID'])) ? $_GET['programID'] : "";
                $programName=(isset($_GET['programName'])) ? $_GET['programName'] : "";
                $sqlupdate="update program set programName='$programName' where programID=$programID";
                $conn->query($sqlupdate);
                $num_rows =mysqli_affected_rows($conn);
                if ($conn) {
                    echo "<script>";
                    echo "setTimeout(`window.alert(\"แก้ไขข้อมูลเรียบร้อยแล้ว $num_rows เรคคอร์ด\")`, 500);";
                    echo "setTimeout(`window.location.replace(location.pathname)`, 500);";
                    echo "</script>";
                }
            } else {
                if ($id<>"") {
                    $sql="select * from program where programID=$id";
                    $result=$conn->query($sql);
                    if ($result->num_rows>0) {
                        while ($row=$result->fetch_array()) {
                            $programID=$row[0];
                            $programName=$row[1];
                           
                        }
                        $title="แก้ไข".$title;
                    }
                }
            }
            break;
        case 2:
            if ($btnsave!="") {
                $conn->query("insert into program(programName) values ('$programName')");
                $num_rows =mysqli_affected_rows($conn);
                if ($conn) {         
                    echo "<script>";
                    echo "setTimeout(`window.alert(\"เพิ่มข้อมูลเรียบร้อยแล้ว $num_rows เรคคอร์ด\")`, 500);";
                    echo "setTimeout(`window.location.replace(location.pathname)`, 500);";
                    echo "</script>";
                }
            }
             $title="เพิ่ม".$title;
            break;
        case 3:
            $sql="delete from program where programID=$id";
            $result=$conn->query($sql);
            $num_rows =mysqli_affected_rows($conn);
            if ($num_rows>0) {
                echo "<script>";
                echo "setTimeout(`window.alert(\"ลบข้อมูลเรียบร้อยแล้วจำนวน $num_rows เรคคอร์ด\")`, 500);";
                echo "setTimeout(`window.location.replace(location.pathname)`, 500);";
                echo "</script>";
            }
            break;
    }
    ?>
    <div class="container p-3 bg-info bg-opacity-10 border border-info rounded-end" id="forminput">

        <div id="inputform">
            <form class="w-100 m-auto">
                <h2><?=$title;?></h2>
                <div class="mb-3">
                    <label for="programName" class="form-label">ชื่อโปรแกรมวิชา</label>
                    <input type="hidden" class="form-control" id="programID" name="programID" value=<?=$programID;?>>
                    <input type="text" class="form-control" id="programName" name="programName"
                        placeholder="ป้อนชื่อโปรแกรมวิชา" value=<?=$programName;?>>
                    <input type="hidden" name="status" id="status" value="<?=$status;?>">
                </div>
                <input class="btn btn-primary" type="submit" value="บันทึกข้อมูล" name="btnsave">
                <input class="btn btn-danger" type="reset" value="ยกเลิก" name="reset"
                    onclick="window.location.replace(location.pathname)">
            </form>
            <hr>
        </div>

        <div class="container-md themed-container mt-4">
            <?php


    $sql    = "select * from program";
    $result = $conn->query($sql);
    echo "<h2>ข้อมูลโปรแกรมวิชา</h2>";
    echo "<button class='btn btn-info' onclick='newRecord();'>เพิ่มข้อมูล</button>";
    $no=0;
    if ($result->num_rows > 0) {
        echo "<table class=\"table\"><thead>
    <tr><tr><th scope=\"col\">#</th><th scope=\"col\">โปรแกรมวิชาเอก</th><th></th></tr>
    </thead>  <tbody>";
        while ($row = $result->fetch_row()) {
            $no++;
            echo "<TR>";
            echo "<TD>$no</TD>";
            echo "<TD>" . $row[1] . "</TD>";
            echo "<TD><a href='?status=1&id=$row[0]'>แก้ไข</a>||";
            echo "<a href='?status=3&&id=$row[0]' onClick=\"javascript: return confirm('ยืนยันลบข้อมูล $row[1]');\">ลบข้อมูล</a></TD>";
            echo "</TR>";
        }
    }
    echo "  </tbody></table>";

    $conn->close();

    if(($status==1)||($status==2)){
        echo "<script>";
        echo "document.getElementById(\"inputform\").style.display = \"inline\";";
        echo "</script>;";
    }
    ?>
        </div>
    </div>
</body>

</html>

