<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลนักศึกษา</title>
    <script src="https://kit.fontawesome.com/ca2700f7fa.js" crossorigin="anonymous"></script>
    <style>
        @import url("Training.css");
    </style>
</head>

<body>
    <div class="content">

        <?php
        include "conDB.php"; // เชื่อมต่อฐานข้อมูล

        if (isset($_GET['action'])) {
            $action = $_GET['action'] ?? "";
            $faculty_id = $_GET['faculty_id'] ?? "";
            $faculty_name = $_GET['faculty_name'] ?? "";

            switch ($action) {
                case 'insert':
                    if((isset($_GET['faculty_id']))&&(isset($_GET['faculty_name']))){
                        $sql="insert into faculty values ('{$faculty_id}','{$faculty_name}')";
                        if (mysqli_query($conn, $sql)) {
                            echo "<script>alert('เพิ่มข้อมูลสำเร็จ');</script>";
                        } else {
                            echo "<script>alert('เพิ่มข้อมูลไม่สำเร็จ');</script>";
                        }}
                        break;

                case 'update':
                    if((isset($_GET['faculty_id']))&&(isset($_GET['faculty_name']))){                    
                        $sql="update faculty values ('{$faculty_id}','{$faculty_name}')";
                        if (mysqli_query($conn, $sql)) {
                            echo "<script>alert('แก้ไขข้อมูลสำเร็จ');</script>";
                        } else {
                            echo "<script>alert('แก้ไขข้อมูลไม่สำเร็จ');</script>";
                        }}
                        break;

                case 'delete':
                    if ((isset($_GET['faculty_id']))) {
                        // ใช้ Prepared Statements
                        $stmt = $conn->prepare("DELETE FROM faculty WHERE faculty_id = ?");
                        $stmt->bind_param("s", $faculty_id);

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
                <h1>เพิ่มข้อมูลคณะ</h1>
            </div>
            <form method="GET">
                <p>
                    <label>รหัสคณะ</label>
                    <input type="text" class="input" name="faculty_id" required>
                </p>
                <p>
                    <label>ชื่อคณะ</label>
                    <input type="text" class="input" name="faculty_name" required>
                </p>
                <input type="hidden" name="action" value="insert">
                <input type="submit" class="btn-submit" value="บันทึก">
                <input type="reset" class="btn-reset" value="ยกเลิก" onclick="unshowForm()">
            </form>
        </div>

        <!-- ฟอร์มแก้ไขข้อมูล -->
        <div class="formedit" id="formedit" style="display: none;">
            <div class="header">
                <h1>แก้ไขข้อมูลคณะ</h1>
            </div>
            <form method="GET">
                <p>
                    <label>รหัสคณะ</label>
                    <input type="text" id="edit_faculty_id" class="input" name="faculty_id" readonly>
                </p>
                <p>
                    <label>ชื่อคณะ</label>
                    <input type="text" id="edit_faculty_name" class="input" name="faculty_name" required>
                </p>
                <input type="hidden" name="action" value="update">
                <input type="submit" class="btn-submit" value="แก้ไข">
                <input type="reset" class="btn-reset" value="ยกเลิก" onclick="unshowForm()">
            </form>
        </div>

        <!-- ตารางแสดงข้อมูล -->
        <h2>ข้อมูล Faculty</h2>
        <a class="btn-newrecord" onclick="showForm('forminput')">
            <i class="fa-solid fa-plus fa-2xl"></i> เพิ่มใหม่
        </a>

        <table>
            <tr>
                <th>ลำดับที่</th>
                <th>ชื่อคณะ</th>
                <th>จัดการ</th>
            </tr>
            <?php
            $sql = "SELECT * FROM faculty ORDER BY faculty_id";
            $result = $conn->query($sql);
            include "menu.php";

            $index = 0; // กำหนดตัวแปรลำดับไว้ภายนอกลูปเพื่อให้ค่าลำดับต่อเนื่อง
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $index++;
                    echo "<tr>";
                    echo "<td>{$index}</td>"; // ใช้ตัวแปร $index ซึ่งเพิ่มขึ้นในแต่ละรอบ
                    echo "<td>{$row['faculty_name']}</td>";
                    echo "<td style='text-align:center;'>";

                    // ปุ่มแก้ไข
                    echo "<a onclick=\"editRecord('{$row['faculty_id']}', '{$row['faculty_name']}')\">";
                    echo "<i class=\"fa-solid fa-square-pen fa\" style=\"color: #128c19;\"></i>";
                    echo "</a>";

                    // ฟอร์มลบ
                    echo "<form style='display:inline;' method='GET' onsubmit='return confirm(\"ยืนยันการลบ?\");'>";
                    echo "<input type='hidden' name='action' value='delete'>";
                    echo "<input type='hidden' name='faculty_id' value='{$row['faculty_id']}'>";
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

        function editRecord(faculty_id, faculty_name) {
            showForm('formedit');
            document.getElementById('edit_faculty_id').value = faculty_id;
            document.getElementById('edit_faculty_name').value = faculty_name;
        }
    </script>

</body>

</html>