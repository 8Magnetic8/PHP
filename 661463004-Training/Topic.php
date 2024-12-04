<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูล Topic</title>
    <script src="https://kit.fontawesome.com/ca2700f7fa.js" crossorigin="anonymous"></script>
    <style>
        @import url("Topic.css");
    </style>
</head>

<body>
    <div class="content">
        <?php
        include "conDB.php"; // เชื่อมต่อฐานข้อมูล

        $topic_id = $_POST['topic_id'] ?? "";
            $topic_header = $_POST['topic_header'] ?? "";
            $topic_detail = $_POST['topic_detail'] ?? "";
            $start = $_POST['start'] ?? "";
            $end = $_POST['end'] ?? "";
            $place = $_POST['place'] ?? "";
            $lecturer_id = $_POST['lecturer_id'] ?? "";            
            $img_topic = "";
        

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
            $action = $_POST['action'];

            // จัดการอัปโหลดรูปภาพ
            if (isset($_FILES['img_topic']) && $_FILES['img_topic']['error'] === UPLOAD_ERR_OK) {
                $upload_dir = "images/";
                $file_name = basename($_FILES['img_topic']['name']);
                $target_file = $upload_dir . $file_name;

                if (move_uploaded_file($_FILES['img_topic']['tmp_name'], $target_file)) {
                    $image_path = $target_file; // ใช้พาธรูปใหม่
                } else {
                    echo "<p style='color: red;'>เกิดข้อผิดพลาดในการอัปโหลดรูปภาพ</p>";
                }
            } else {
                $image_path = $img_topic_old; // ใช้รูปเดิมถ้าไม่มีการอัปโหลด
            }

            switch ($action) {
                case 'insert':
                    if (!empty($topic_header)) {
                        $stmt = $conn->prepare("INSERT INTO topic (topic_id, topic_header, topic_detail, start, end, place, img_topic, lecturer_id) VALUES (?, ?)");
                        $stmt->bind_param("ssssssss", $topic_id, $topic_header, $topic_detail, $start, $end, $place, $img_topic, $lecturer_id) ;
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
                        $stmt = $conn->prepare("UPDATE topic SET topic_header = ?, topic_detail = ?, start = ?, end = ?, place = ?, img_topic = ?, lecturer_id = ? WHERE topic_id = ?");
                        $stmt->bind_param("ssssssss", $topic_header, $topic_detail, $start_date, $end_date, $place, $image_path, $lecturer_id, $topic_id);
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
                        $stmt = $conn->prepare("DELETE FROM topic WHERE topic_id = ?");
                        $stmt->bind_param("i", $topic_id);
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
                <h1>เพิ่มข้อมูล Topic</h1>
            </div>
            <!-- <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="insert"> -->
                <p>
                <label>รหัสโปรแกรมวิชา</label>
                <input type="text" class="input" name="topic_id" value="<?= isset($topic_id) ? htmlspecialchars($topic_id) : ''; ?>" required readonly>
            </p>
            <p>
                <label>หัวเรื่อง</label>
                <input type="text" class="input" name="topic_header" value="<?= isset($topic_header) ? htmlspecialchars($topic_header) : ''; ?>" required>
            </p>
            <p>
                <label>เนื้อหา</label>
                <textarea class="input" name="topic_detail" rows="5" required><?= isset($topic_detail) ? htmlspecialchars($topic_detail) : ''; ?></textarea>
            </p>
            <p>
                <label>วันที่เริ่ม</label>
                <input type="date" class="input" name="start" value="<?= isset($start_date) ? htmlspecialchars($start_date) : ''; ?>" required>
            </p>
            <p>
                <label>วันที่สิ้นสุด</label>
                <input type="date" class="input" name="end" value="<?= isset($end_date) ? htmlspecialchars($end_date) : ''; ?>" required>
            </p>
            <p>
                <label>สถานที่</label>
                <input type="text" class="input" name="place" value="<?= isset($place) ? htmlspecialchars($place) : ''; ?>" required>
            </p>
            <p>
                <label>รูปภาพ</label>
                <input type="file" class="input" name="img_topic" accept="images/*">
            </p>
            <p>
                <label>รหัสอาจารย์</label>
                <input type="text" class="input" name="lecturer_id" value="<?= isset($lecturer_id) ? htmlspecialchars($lecturer_id) : ''; ?>" required>
            </p>
            <input type="submit" class="btn-submit" name="update" value="บันทึก">
            <input type="reset" class="btn-reset" value="ยกเลิก">
            </form>
        </div>

        <!-- ฟอร์มแก้ไขข้อมูล -->
        <div class="formedit" id="formedit" style="display: none;">
            <div class="header">
                <h1>แก้ไขข้อมูล Topic</h1>
            </div>
            <input type="hidden" name="topic_id" value="<?=$topic_id;?>">
            <input type="hidden" name="img_topic_old" value="<?=$image_path;?>">
                <input type="hidden" name="action" value="update">
                <p>
                <label>รหัสโปรแกรมวิชา</label>
                <input type="text" class="input" name="topic_id" value="<?= isset($topic_id) ? htmlspecialchars($topic_id) : ''; ?>" required readonly>
            </p>
            <p>
                <label>หัวเรื่อง</label>
                <input type="text" class="input" name="topic_header" value="<?= isset($topic_header) ? htmlspecialchars($topic_header) : ''; ?>" required>
            </p>
            <p>
                <label>เนื้อหา</label>
                <textarea class="input" name="topic_detail" rows="5" required><?= isset($topic_detail) ? htmlspecialchars($topic_detail) : ''; ?></textarea>
            </p>
            <p>
                <label>วันที่เริ่ม</label>
                <input type="date" class="input" name="start" value="<?= isset($start_date) ? htmlspecialchars($start_date) : ''; ?>" required>
            </p>
            <p>
                <label>วันที่สิ้นสุด</label>
                <input type="date" class="input" name="end" value="<?= isset($end_date) ? htmlspecialchars($end_date) : ''; ?>" required>
            </p>
            <p>
                <label>สถานที่</label>
                <input type="text" class="input" name="place" value="<?= isset($place) ? htmlspecialchars($place) : ''; ?>" required>
            </p>
            <p>
                <label>รูปภาพ</label>
                <input type="file" class="input" name="img_topic" accept="images/*">
            </p>
            <p>
                <label>รหัสอาจารย์</label>
                <input type="text" class="input" name="lecturer_id" value="<?= isset($lecturer_id) ? htmlspecialchars($lecturer_id) : ''; ?>" required>
            </p>
            <input type="submit" class="btn-submit" name="update" value="บันทึก">
            <input type="reset" class="btn-reset" value="ยกเลิก">
            </form>
        </div>

        <!-- ตารางแสดงข้อมูล -->
        <h2>ข้อมูล Topic</h2>
        <a class="btn-newrecord" onclick="showForm('forminput')">
            <i class="fa-solid fa-plus fa-2xl"></i> เพิ่มใหม่
        </a>

        <table>
            <tr>
                <th>รหัส</th>
                <th>หัวเรื่อง</th>
                <th>เนื้อหา</th>
                <th>เริ่ม</th>
                <th>จบ</th>
                <th>สถานที่</th>
                <th>รูป</a></th>
                <th>รหัสอาจารย์</th>
                <th>จัดการ</th>
            </tr>
            <?php
            $sql = "select * from topic"; 
            $result = $conn->query($sql);
            include "menu.php"; 
            if ($result->num_rows > 0) {
                $index = 0;
                while ($row = $result->fetch_row()) {
                    $index++;
                    echo "<tr>";
                    echo "<td>{$index}</td>";
                    // echo "<td>{$row[0]}</td>";
                    echo "<td>{$row[1]}</td>";
                    echo "<td>{$row[2]}</td>";
                    echo "<td>{$row[3]}</td>";
                    echo "<td>{$row[4]}</td>";
                    echo "<td>{$row[5]}</td>";
                    echo "<td><img src='{$row[6]}' alt='รูปภาพ' style='width:500px; height:auto;'></td>";
                    echo "<td>{$row[7]}</td>";

                    echo "<td style='text-align:center;'>";
                    echo "<a href='Topic_edit.php?topic_id={$row[0]}'>";
                    echo "<i class=\"fa-solid fa-square-pen fa\"style=\"color: #128c19;\">|</i>";
                    echo "</a>";
                    echo "<a href='Topic_delete.php?topic_id={$row[0]}'>";
                    echo "<i class=\"fa-solid fa-trash-can fa\" style=\"color: #d7093d;\">|</i>";
                    echo "</a>";
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
