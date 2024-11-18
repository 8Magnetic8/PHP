<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include("connOOP1.php");
        $strsql = "select * from student";
        $result=$conn -> query($strsql);
       
    ?>
    <table>
        <tr>
            <th>รหัสนะกศึกษา</th>
            <th>ชื่อ-นามสกุล</th>
            <th>โปรแกรมวิชา</th>
            <th>เพศ</th>
        </tr>
        <?php
             while($row=$result->fetch_row()){
                echo"<tr>";
                echo "<td>".$row[0]."</td>";
                echo "<td>".$row[1]."</td>";
                echo "<td>".$row[2]."</td>";
                echo "<td>".$row[3]."</td>";            
                echo"</tr>";
            }
        ?>
        <tr>
            <td>d</td>
            <td>d</td>
            <td>d</td>
            <td>d</td>
        </tr>
        
    </table>
</body>
</html>