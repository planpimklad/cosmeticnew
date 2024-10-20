<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shine Cosmetic - แก้ไขประเภทสินค้า</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">
    <h1 class="text-center">แก้ประเภทสินค้า</h1>

    <!-- แก้ไขให้มีฟอร์มเดียว -->
    <form method="post" action="">

        <div class="form-group">
            <label for="c_name">ชื่อประเภทสินค้า:</label>
            <input type="text" class="form-control" id="c_name" name="c_name" value="" required>
        </div>

        <a href="edit_category.php" class="btn btn-secondary">กลับไปหน้าหลัก</a>

        <!-- ปุ่มบันทึกให้อยู่ในฟอร์มเดียว -->
        <button type="submit" class="btn btn-primary" name="update">บันทึก</button>

    </form>
</div>

<?php
// เชื่อมต่อฐานข้อมูล
include_once("connectdb.php");

// ตรวจสอบว่ามีการส่งคำขอแบบ POST หรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับค่าจากฟอร์ม
    $c_name = $_POST['c_name'];

    // สมมติว่าคุณมี category_id ที่ต้องการอัปเดต (ตรวจสอบให้แน่ใจว่าได้ส่งค่า category_id)
    $category_id = 1; // สมมติว่าคุณต้องการแก้ไขประเภทสินค้าที่มี id เป็น 1

    // อัปเดตข้อมูลลงในฐานข้อมูลโดยอ้างอิงจาก category_id
    $sql = "UPDATE `category` SET `c_name` = '$c_name' WHERE `c_id` = '$category_id'";

    // ตรวจสอบการอัปเดตข้อมูล
    if (mysqli_query($conn, $sql)) {
        echo "อัปเดตข้อมูลสำเร็จ!";
    } else {
        // แสดงข้อความเมื่อเกิดข้อผิดพลาด
        echo "เกิดข้อผิดพลาดในการอัปเดต: " . mysqli_error($conn);
    }
}
?>
</body>

</html>
