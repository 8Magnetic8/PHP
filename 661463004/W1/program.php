<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>โปรแกรมวิชา</title>
    <script src="https://kit.fontawesome.com/1b47994af8.js" crossorigin="anonymous"></script>
    <style>
        table,tr,th,td{
        border:2px solid #607d8b;
        border-collapse: collapse;/*ถ้าไม่ใส่เส้นจะมี2เส้น */
        }
        th,td{
            padding:10px;
         
        }
    </style>
    
</head>
<body> 
    <h1>ข้อมูลโปรแกรมวิชา</h1>
    <table>   
    <tr>
        <th>ลำดับ</th>
        <th>ชื่อโปรแกรมวิชา</th>     
    </tr>
    <?php
            include("conDB.php"); // นำเข้าไฟล์ conDB.php ที่เชื่อมต่อกับฐานข้อมูล
            $sql    = "select * from program"; // สร้างคำสั่ง SQL เพื่อเลือกข้อมูลจากตาราง program
            $result = $conn->query($sql); // รันคำสั่ง SQL จากตัวแปร $sql
            if ($result->num_rows > 0) {
                $index=0;
            while ($row = $result->fetch_row()) {
                $index++;
                echo "<tr>";
                echo "<td>{$index}</td>";
                echo "<td>{$row[1]}</td>";
                echo "<td>";
                echo "<a href='program_edit.php?programID={$row[0]}'><i class=\"fa-solid fa-pen-to-square\"></i></a>";
                echo "<a href='program_delete.php?programID={$row[0]}'> | <i class=\"fa-solid fa-trash-can\"></i></a>";
                echo "</tr>";
            }
            }
        ?>
    </table>
</body>
</html>