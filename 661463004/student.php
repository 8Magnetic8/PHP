<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลนักศึกษา</title>  <script src="https://kit.fontawesome.com/ca2700f7fa.js" crossorigin="anonymous"></script>

<style>
    .content {
        width: 900px;
    }

    table {
        width: 900px;
    }

    table,
    tr,
    th,
    td {
        border: 2px solid #607d8b;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 10px;
    }

    .fa {
        font-size: 2em;
    }

    .btn-newrecord {
        background: #0066A2;
        color: white;
        border-style: outset;
        border-color: #0066A2;
        height: 50px;
        padding: 8px 15px;
        font-size: 1.14em;
        text-shadow: none;
        letter-spacing: 2px;
        float: right;
        margin-bottom: 10px;
        text-decoration: none; 
        display: inline-flex;
        align-items: center;
    }

    .btn-newrecord i {
        margin-right: 5px;
    }
</style>
</head>

<body>
<div class="content">
    <h1>ข้อมูลโปรแกรมวิชา</h1>   
    <a href="program_input.php" class="btn-newrecord">
            <i class="fa-solid fa-plus fa-2xl"></i> เพิ่มใหม่
        </a>
    <table>
    <tr>
        <th style="width:10%">ลำดับที่</th>
        <th>รหัสนักศึกษา</th>
        <th>ชื่อ-นามสกุล</th>
        <th>โปรแกรมวิชาเอก</th>
        <th>เพศ</th>
        <th>แก้ไข</th>
        <th>ลบ</th>
        
    </tr>
    <?php
         include "conDB.php"; // นำเข้าไฟล์ conDB.php ที่เชื่อมต่อกับฐานข้อมูล
         $sql = "select * from student"; // สร้างคำสั่ง SQL เพื่อเลือกข้อมูลจากตาราง student
         $result = $conn->query($sql); // รันคำสั่ง SQL จากตัวแปร $sql
         $sex=["f"=>"หญิง","m"=>"ชาย"];
         if ($result->num_rows > 0) {
            $index=0;
            while ($row = $result->fetch_row()) {
                $index++;
                echo "<tr>";
                echo "<td>{$index}</td>";
                echo "<td>{$row[0]}</td>";
                echo "<td>{$row[1]}</td>";
                echo "<td>{$row[2]}</td>";
                echo "<td>{$row[3]}</td>";

                echo "<td style='text-align:center;'>";
                echo "<a href='student_edit.php?code={$row[0]}'>";
                echo "<i class=\"fa-solid fa-square-pen fa\"  style=\"color: #128c19;\"></i>";
                echo "</a>";
                echo "</td>";

                echo "<td style='text-align:center;'>";
                echo "<a href='student_delete.php?code={$row[0]}'>"; //ตัวแปลStudent
                echo "<i class=\"fa-solid fa-trash-can fa\" style=\"color: #d7093d;\"></i>";
                echo "</a>";
                echo "</td>";
                echo "</tr>";        
            }       
         }
    ?>
</body>
</html>