<?php
            $sql="delete from student where code=$id";
            $result=$conn->query($sql);
            $num_rows =mysqli_affected_rows($conn);
            if ($num_rows>0) {
                echo "<script>";
                echo "setTimeout(`window.alert(\"ลบข้อมูลเรียบร้อยแล้วจำนวน $num_rows เรคคอร์ด\")`, 500);";
                echo "setTimeout(`window.location.replace(location.pathname)`, 500);";
                echo "</script>";
            }
            $status=0;
    ?>  
</body>

</html>

