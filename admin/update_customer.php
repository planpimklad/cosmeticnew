<?php
include_once("connectdb.php");

// ดึงข้อมูลสินค้าที่ต้องการแก้ไขจากตาราง customer
$sql1 = "SELECT * FROM customer WHERE cu_id='{$_GET['cu_id']}'";
$rs1 = mysqli_query($conn, $sql1);
$data1 = mysqli_fetch_array($rs1);
?>
<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <title>Shine Cosmetic - แก้ไขข้อมูลลูกค้า</title>
    <!-- เพิ่ม Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <a href="type.php" class="btn btn-primary">กลับไปหน้าสินค้า</a>
    <div class="container mt-4">
        <h1 class="mt-5 mb-3 text-center">Shine Cosmetic - ข้อมูลลูกค้า</h1>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="cu_id">IDลูกค้า:</label>
                <input type="text" class="form-control" id="cu_id" name="cu_id" required autofocus value="<?=$data1['cu_id'];?>">
            </div>
            <div class="form-group">
                <label for="cu_name">ชื่อลูกค้า:</label>
                <input type="text" class="form-control" id="cu_name" name="cu_name" required autofocus value="<?=$data1['cu_name'];?>">
            </div>
            <div class="form-group">
                <label for="cu_username">ชื่อผู้ใช้:</label>
                <input type="text" class="form-control" id="cu_username" name="cu_username" required autofocus value="<?=$data1['cu_username'];?>">
            </div>
            <div class="form-group">
                <label for="cu_phone">เบอร์โทรศัพท์:</label>
                <input type="text" class="form-control" id="cu_phone" name="cu_phone" required value="<?=$data1['cu_phone'];?>">
            </div>
            <div class="form-group">
                <label for="cu_address">ที่อยู่ลูกค้า:</label>
                <textarea class="form-control" id="cu_address" name="cu_address" rows="5"><?=$data1['cu_address'];?></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-3" name="Submit">บันทึก</button>
        </form>
    </div>

    <!-- เพิ่ม Bootstrap JS และ jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php
if (isset($_POST['Submit'])) {
    // ตรวจสอบว่ามีการอัปโหลดไฟล์หรือไม่
    if (empty($_FILES['pimg']['name'])) {
        // กรณีไม่มีการอัปโหลดไฟล์
        $sql = "UPDATE `customer` SET 
                `cu_name` = '{$_POST['cu_name']}', 
                `cu_username` = '{$_POST['cu_username']}', 
                `cu_phone` = '{$_POST['cu_phone']}', 
                `cu_address` = '{$_POST['cu_address']}'
                WHERE `cu_id` = '{$_POST['cu_id']}'";
    } else {
        // กรณีมีการอัปโหลดไฟล์
        $file_name = $_FILES['pimg']['name'];
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);

        // ควรเพิ่มการตรวจสอบและบันทึกรูปภาพใหม่ (ถ้ามี) ในโค้ดนี้ด้วย
        $sql = "UPDATE `customer` SET 
                `cu_name` = '{$_POST['cu_name']}', 
                `cu_username` = '{$_POST['cu_username']}', 
                `cu_phone` = '{$_POST['cu_phone']}', 
                `cu_address` = '{$_POST['cu_address']}'
                WHERE `cu_id` = '{$_POST['cu_id']}'";
    }

    mysqli_query($conn, $sql) or die("แก้ไขข้อมูลไม่สำเร็จ");

    echo "<script>";
    echo "alert('แก้ไขข้อมูลลูกค้าสำเร็จ');";
    echo "window.location='type.php';";
    echo "</script>";
}
mysqli_close($conn);
?>
</body>
</html>
