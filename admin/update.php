<?php
include_once("connectdb.php");

// ดึงข้อมูลสินค้าที่ต้องการแก้ไขจากตาราง product
$sql1 = "SELECT * FROM product WHERE p_id='{$_GET['pid']}'";
$rs1 = mysqli_query($conn, $sql1);
$data1 = mysqli_fetch_array($rs1);
?>
<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <title>Shine Cosmetic - แก้ไขสินค้า</title>
    <!-- เพิ่ม Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
	<a href="type.php" class="btn-primary">กลับไปหน้าสินค้า</a>
<div class="container mt-4">
	
         <h1 class="mt-5 mb-3 text-center">Shine Cosmetic - แก้ไขสินค้า</h1>


        <div class="text-center mb-3">
           
        </div> 

   

    <!-- ฟอร์มแก้ไขข้อมูลสินค้า -->
    <form method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label for="p_name">ชื่อสินค้า:</label>
            <input type="text" class="form-control" id="p_name" name="p_name" required autofocus value="<?=$data1['p_name'];?>">
        </div>

        <div class="form-group">
            <label for="p_detail">รายละเอียดสินค้า:</label>
            <textarea class="form-control" id="p_detail" name="p_detail" rows="5"><?=$data1['p_detail'];?></textarea>
        </div>

        <div class="form-group">
            <label for="p_price">ราคา:</label>
            <input type="text" class="form-control" id="p_price" name="p_price" required value="<?=$data1['p_price'];?>">
        </div>

        <div class="form-group">
            <label for="pimg">รูปภาพ:</label>
            <input type="file" class="form-control-file" id="pimg" name="pimg">
        </div>

        <div class="form-group">
            <label for="pcat">ประเภทสินค้า:</label>
            <select class="form-control" id="pcat" name="pcat">
                <?php
                // ดึงข้อมูลประเภทสินค้าจากตาราง category
                $sql2 = "SELECT * FROM `category` ORDER BY c_name ASC";
                $rs2 = mysqli_query($conn, $sql2);
                while ($data2 = mysqli_fetch_array($rs2)) {
                ?>
                    <option value="<?=$data2['c_id'];?>" <?=($data1['c_id'] == $data2['c_id']) ? "selected" : "";?>>
                        <?=$data2['c_name'];?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3" name="Submit">บันทึก</button>
    </form>

    <hr>
</div>

<!-- เพิ่ม Bootstrap JS และ jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php
if (isset($_POST['Submit'])) {
    if (empty($_FILES['pimg']['name'])) {
        $sql = "UPDATE `product` SET 
                `p_name` = '{$_POST['p_name']}', 
                `p_detail` = '{$_POST['p_detail']}', 
                `p_price` = '{$_POST['p_price']}', 
                `c_id` = '{$_POST['pcat']}' 
                WHERE `p_id` = '{$_GET['pid']}'";
    } else {
        $file_name = $_FILES['pimg']['name'];
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);

        $sql = "UPDATE `product` SET 
                `p_name` = '{$_POST['p_name']}', 
                `p_detail` = '{$_POST['p_detail']}', 
                `p_price` = '{$_POST['p_price']}', 
                `c_id` = '{$_POST['pcat']}', 
                `p_picture` = '{$ext}' 
                WHERE `p_id` = '{$_GET['pid']}'";

        move_uploaded_file($_FILES['pimg']['tmp_name'], "images/" . $_GET['pid'] . "." . $ext);
    }

    mysqli_query($conn, $sql) or die("แก้ไขข้อมูลสินค้าไม่ได้");

    echo "<script>";
    echo "alert('แก้ไขข้อมูลสินค้าสำเร็จ');";
    echo "window.location='type.php';";
    echo "</script>";
}
mysqli_close($conn);
?>
</body>
</html>
