<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูล Lecturer</title>
    <script src="https://kit.fontawesome.com/ca2700f7fa.js" crossorigin="anonymous"></script>
    <style>
    @import url("Training.css");
    </style>
</head>

<body>
    <div class="content">
        <?php
        include "conDB.php"; // เชื่อมต่อฐานข้อมูล

        $lecturer_id = $_POST['lecturer_id'] ?? null;
        $lecturer_name = $_POST['lecturer_name'] ?? null;
        $img_lecturer_old = $_POST['img_lecturer_old'] ?? null;
        $image_path = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
            $action = $_POST['action'];

            // จัดการอัปโหลดรูปภาพ
            if (isset($_FILES['img_lecturer']) && $_FILES['img_lecturer']['error'] === UPLOAD_ERR_OK) {
                $upload_dir = "images/";
                $file_name = basename($_FILES['img_lecturer']['name']);
                $target_file = $upload_dir . $file_name;

                if (move_uploaded_file($_FILES['img_lecturer']['tmp_name'], $target_file)) {
                    $image_path = $target_file; // ใช้พาธรูปใหม่
                } else {
                    echo "<p style='color: red;'>เกิดข้อผิดพลาดในการอัปโหลดรูปภาพ</p>";
                }
            } else {
                $image_path = $img_lecturer_old; // ใช้รูปเดิมถ้าไม่มีการอัปโหลด
            }

            switch ($action) {
                case 'insert':
                    if (!empty($lecturer_name)) {
                        $stmt = $conn->prepare("INSERT INTO lecturer (lecturer_name, img_lecturer) VALUES (?, ?)");
                        $stmt->bind_param("ss", $lecturer_name, $image_path);

                        if ($stmt->execute()) {
                            echo "<script>alert('เพิ่มข้อมูลสำเร็จ');</script>";
                        } else {
                            echo "<script>alert('เพิ่มข้อมูลไม่สำเร็จ');</script>";
                        }
                        $stmt->close();
                    }
                    break;

                case 'update':
                    if (!empty($lecturer_id) && !empty($lecturer_name)) {
                        $stmt = $conn->prepare("UPDATE lecturer SET lecturer_name = ?, img_lecturer = ? WHERE lecturer_id = ?");
                        $stmt->bind_param("ssi", $lecturer_name, $image_path, $lecturer_id);

                        if ($stmt->execute()) {
                            echo "<script>alert('แก้ไขข้อมูลสำเร็จ');</script>";
                        } else {
                            echo "<script>alert('แก้ไขข้อมูลไม่สำเร็จ');</script>";
                        }
                        $stmt->close();
                    }
                    break;

                case 'delete':
                    if (!empty($lecturer_id)) {
                        $stmt = $conn->prepare("DELETE FROM lecturer WHERE lecturer_id = ?");
                        $stmt->bind_param("i", $lecturer_id);

                        if ($stmt->execute()) {
                            echo "<script>alert('ลบข้อมูลสำเร็จ');</script>";
                        } else {
                            echo "<script>alert('ลบข้อมูลไม่สำเร็จ');</script>";
                        }
                        $stmt->close();
                    }
                    break;
            }
        }
        ?>

        <!-- ฟอร์มเพิ่มข้อมูล -->
        <div class="forminput" id="forminput" style="display: none;">
            <div class="header">
                <h1>เพิ่มข้อมูล Lecturer</h1>
            </div>
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="insert">
                <p>
                    <label>ชื่อและนามสกุล</label>
                    <input type="text" class="input" name="lecturer_name" required>
                </p>
                <p>
                    <label>รูปภาพบุคคล</label>
                    <input type="file" class="input" name="img_lecturer" accept="image/*">
                </p>
                <input type="submit" class="btn-submit" value="บันทึก">
                <input type="reset" class="btn-reset" value="ยกเลิก" onclick="unshowForm()">
            </form>
        </div>

        <!-- ฟอร์มแก้ไขข้อมูล -->
        <div class="formedit" id="formedit" style="display: none;">
            <div class="header">
                <h1>แก้ไขข้อมูล Lecturer</h1>
            </div>
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="lecturer_id" id="edit_lecturer_id">
                <input type="hidden" name="img_lecturer_old" id="edit_img_lecturer_old">
                <input type="hidden" name="action" value="update">
                <p>
                    <label>ชื่อและนามสกุล</label>
                    <input type="text" class="input" name="lecturer_name" id="edit_lecturer_name" required>
                </p>
                <p>
                    <label>รูปภาพบุคคล</label>
                    <input type="file" class="input" name="img_lecturer" accept="image/*">
                </p>
                <input type="submit" class="btn-submit" value="บันทึก">
                <input type="reset" class="btn-reset" value="ยกเลิก" onclick="unshowForm()">
            </form>
        </div>

        <!-- ตารางแสดงข้อมูล -->
        <h2>ข้อมูล Lecturer</h2>
        <a class="btn-newrecord" onclick="showForm('forminput')">
            <i class="fa-solid fa-plus fa-2xl"></i> เพิ่มใหม่
        </a>

        <table>
            <tr>
                <th>รหัส</th>
                <th>ชื่อ</th>
                <th>รูป</th>
                <th>จัดการ</th>
            </tr>
            <?php
            $sql = "SELECT * FROM lecturer";
            $result = $conn->query($sql);
            include "menu.php";
            $index = 0;
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $index++;
                    echo "<tr>";
                    echo "<td>{$index}</td>";
                    echo "<td>{$row['lecturer_name']}</td>";
                    echo "<td><img src='{$row['img_lecturer']}' alt='รูปภาพ' style='width:100px; height:auto;'></td>";
                    echo "<td style='text-align:center;'>";?>
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="lecturer_id" id="edit_lecturer_id" value="<?= $row['lecturer_id']?>">
                <input type="hidden" name="img_lecturer_old" id="edit_img_lecturer_old">
                <input type="hidden" name="action" value="update">
                    <p><label>ชื่อและนามสกุล</label>
                    <input type="text" class="input" name="lecturer_name" id="edit_lecturer_name" required
                        value="<?= $row['lecturer_name']?>"></p>
                   <p><label>รูปภาพบุคคล</label>
                    <input type="file" class="input" name="img_lecturer" accept="image/*"></p>
                <input type="submit" class="btn-submit" value="บันทึก">
                <input type="reset" class="btn-reset" value="ยกเลิก" onclick="unshowForm()">
            </form>
            <?php
                    echo "<a onclick=\"editRecord('{$row['lecturer_id']}', '{$row['lecturer_name']}', '{$row['img_lecturer']}')\">";
                    echo "<i class=\"fa-solid fa-square-pen fa\" style=\"color: #128c19;\"></i>";
                    echo "</a>";
                    echo "<form style='display:inline;' method='POST' onsubmit='return confirm(\"ยืนยันการลบ?\");'>";
                    echo "<input type='hidden' name='action' value='delete'>";
                    echo "<input type='hidden' name='lecturer_id' value='{$row['lecturer_id']}'>";
                    echo "<button type='submit' style='border:0px;'><i class=\"fa-solid fa-trash-can fa\" style=\"color: #d7093d;\"></i></button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </table>
    </div>

    <script>
    function showForm(formId) {
        const forms = ['forminput', 'formedit'];
        forms.forEach(form => {
            document.getElementById(form).style.display = 'none';
        });
        document.getElementById(formId).style.display = 'block';
    }

    function unshowForm() {
        const forms = ['forminput', 'formedit'];
        forms.forEach(form => {
            document.getElementById(form).style.display = 'none';
        });
    }

    function editRecord(lecturer_id, lecturer_name, img_lecturer) {
        showForm('formedit');
        document.getElementById('edit_lecturer_id').value = lecturer_id;
        document.getElementById('edit_lecturer_name').value = lecturer_name;
        document.getElementById('edit_img_lecturer_old').value = img_lecturer;
    }
    </script>
</body>

</html>