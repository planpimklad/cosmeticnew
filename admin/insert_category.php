
<?php
// เชื่อมต่อฐานข้อมูล
include_once("connectdb.php");

// ตรวจสอบการส่งข้อมูล
if (isset($_POST['submit'])) {
    $c_name = mysqli_real_escape_string($conn, $_POST['c_name']);

    // เพิ่มประเภทสินค้าใหม่ในฐานข้อมูล
    $sql = "INSERT INTO category (c_name) VALUES ('{$c_name}')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('เพิ่มประเภทสินค้าสำเร็จ!'); window.location='edit_category.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shine Cosmetic - เพิ่มประเภทสินค้า</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/admin/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">เพิ่มประเภทสินค้าใหม่</h1>
    <form method="post" action="">
        <div class="form-group">
            <label for="c_name">ชื่อประเภทสินค้า:</label>
            <input type="text" class="form-control" id="c_name" name="c_name" required>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">บันทึก</button>
    </form><br>
    <a href="category_list.php" class="btn btn-primary">กลับไปหน้าหลัก</a>
</div>
</body>
</html>
