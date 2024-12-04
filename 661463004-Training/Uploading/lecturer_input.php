<?php
    include "conDB.php";
    if(isset($_POST['save']))
    {

        $lecturer_name=$_POST['lecturer_name']??null;//textbox
        if(($lecturer_name!=null))
        {

            $ext=pathinfo($_FILES['img_lecturer']['name'],PATHINFO_EXTENSION);
            $img_lecturer_new=time().'.'. $ext;
            move_uploaded_file($_FILES['img_lecturer']['tmp_name'],'./images/lecturer/'.$img_lecturer_new);
           
            $stmt = $conn->prepare("INSERT INTO lecturer (lecturer_name, img_lecturer) VALUES (?, ?)");
            $stmt->bind_param("ss", $lecturer_name, $img_lecturer_new);

            if ($stmt->execute()) {
                echo "<script>alert('เพิ่มข้อมูลสำเร็จ');</script>";
            } else {
                echo "<script>alert('เพิ่มข้อมูลไม่สำเร็จ');</script>";
            }
            $stmt->close();
        } 
}
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ป้อนข้อมูลวิทยากร</title>
</head>

<body>
    <form method="post" enctype="multipart/form-data">
        ชื่อขวิทยากร
        <input type="text" name="lecturer_name" id="lecturer_name" required oninvalid="alert('ลืมอะไรไปป่าวพ่อหนุ่ม')">
        <!-- oninvalid="this.setCustomValidity('กรอกไม่ครบ')"
             oninput="this.setCustomValidity('')" -->
        รูปวิทยากร
        <input type="file" name="img_lecturer" id="img_lecturer" required
            oninvalid="this.setCustomValidity('รูปยังไม่ได้ใส่เลยพ่อหนุ่ม')" oninput="this.setCustomValidity('')"
            onchange="previewimg1(this)">
        <img src="" id="previewimg" alt="">
        <input type="submit" value="SAVE" name="save">
    </form>
    <script>
    function previewimg1(imgfile) {
        var previewimg = document.getElementById("previewimg");
        if (imgfile.files && imgfile.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewimg.src = e.target.result;
                previewimg.style.display = "block";
            };
            reader.readAsDataURL(imgfile.files[0]);
        }

    }
    </script>
</body>

</html>