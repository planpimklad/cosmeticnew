<!doctype html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="description" content="">
   <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
   <meta name="generator" content="Hugo 0.84.0">
   <title>Shine Cosmetic</title>

   <!-- Bootstrap core CSS -->
   <link href="../admin/bootstrap.min.css" rel="stylesheet">

   <style>
       body {
           background-color: #FDF5E6;
       }
       .navbar, .bg-dark {
           background-color: #ec407a !important;
       }
       .navbar-brand, .nav-link, .text-white {
           color: #FFFFFF !important;
       }
       .btn-secondary {
           background-color: #ec407a;
           border-color: #ec407a;
       }
       .text-muted, .lead, .heading, h1, h2, .featurette-heading {
           color: #ec407a !important;
       }
       .featurette-divider {
           border-top: 5px solid #FFB6C1;
       }
       .col-lg-4 {
           background-color: #FDF5E6;
       }
       footer {
           background-color: #FDF5E6;
       }
       .btn-pink {
           background-color: #FDF5E6;
           padding: 10px;
           border-radius: 8px;
           display: inline-block;
       }
       .btn-pink:hover {
           background-color: #ec407a;
           color: #fff;
       }
   </style>
</head>
<body>
   <a href="type.php" class="btn-pink">
       <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#ec407a" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
           <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1"/>
       </svg>
   </a>

   <div class="container mt-4">
       <h1 class="text-center">Shine Cosmetic</h1>

       <form method="post" action="" enctype="multipart/form-data">
           <div class="mb-3">
               <label for="pname" class="form-label">ชื่อสินค้า</label>
               <input type="text" name="pname" class="form-control" id="pname" required autofocus>
           </div>
           <div class="mb-3">
               <label for="pdetail" class="form-label">รายละเอียดสินค้า</label>
               <textarea name="pdetail" class="form-control" id="pdetail" rows="5"></textarea>
           </div>
           <div class="mb-3">
               <label for="pprice" class="form-label">ราคา</label>
               <input type="text" name="pprice" class="form-control" id="pprice" required>
           </div>
           <div class="mb-3">
               <label for="pimg" class="form-label">รูปภาพ</label>
               <input type="file" name="pimg" class="form-control" id="pimg">
           </div>
           <div class="mb-3">
               <label for="pcat" class="form-label">ประเภทสินค้า</label>
               <select name="pcat" class="form-select" id="pcat">
                   <?php	
                   include_once("connectdb.php");
                   $sql2 = "SELECT * FROM `category` ORDER BY c_name ASC";
                   $rs2 = mysqli_query($conn, $sql2);
                   while ($data2 = mysqli_fetch_array($rs2)) {
                   ?>
                       <option value="<?=$data2['c_id'];?>"><?=$data2['c_name'];?></option>
                   <?php } ?>
               </select>
           </div>
           <button type="submit" name="Submit" class="btn btn-success">เพิ่ม</button>
       </form>
       <hr>

       <?php
       if (isset($_POST['Submit'])) {
           // ตรวจสอบว่ามีการอัพโหลดรูปภาพและไม่มีข้อผิดพลาด
           if ($_FILES['pimg']['error'] != 0) {
               die('เกิดข้อผิดพลาดในการอัพโหลดรูปภาพ: ' . $_FILES['pimg']['error']);
           }

           // ตรวจสอบประเภทไฟล์ที่อัพโหลด
           $file_name = $_FILES['pimg']['name'];
           $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
           $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
           if (!in_array($ext, $allowed_extensions)) {
               die('ประเภทไฟล์ที่อัพโหลดไม่รองรับ');
           }

           // Escape ข้อมูลที่กรอกจากฟอร์มเพื่อป้องกัน SQL injection
           $pid = mysqli_real_escape_string($conn, $_POST['pid']);

           $pname = mysqli_real_escape_string($conn, $_POST['pname']);
           $pdetail = mysqli_real_escape_string($conn, $_POST['pdetail']);
           $pprice = mysqli_real_escape_string($conn, $_POST['pprice']);
           $pcat = mysqli_real_escape_string($conn, $_POST['pcat']);

           // ตรวจสอบว่ามีข้อมูลครบถ้วนหรือไม่
           if (!empty($pname) && !empty($pprice) && !empty($pcat)) {
               // บันทึกข้อมูลสินค้า
               $sql = "INSERT INTO `product` (`p_id`,`p_name`, `p_detail`, `p_price`, `p_picture`, `c_id`) 
                       VALUES (NULL,'{$pname}', '{$pdetail}', NULL, '{$file_name}', '{$pcat}')";
               
               if (!mysqli_query($conn, $sql)) {
                   die('เกิดข้อผิดพลาดในการเพิ่มสินค้า: ' . mysqli_error($conn));
               }

               $idauto = mysqli_insert_id($conn); // Get the last inserted product ID

               // ย้ายไฟล์รูปภาพไปยังโฟลเดอร์ images/
               if (!move_uploaded_file($_FILES['pimg']['tmp_name'], "images/" . $idauto . "." . $ext)) {
                   die('เกิดข้อผิดพลาดในการบันทึกไฟล์รูปภาพ');
               }

               echo "<script>";
               echo "alert('เพิ่มข้อมูลสินค้าสำเร็จ');";
               echo "window.location='type.php';";
               echo "</script>";
           } else {
               die('กรุณากรอกข้อมูลให้ครบถ้วน');
           }
       }
       ?>

   </div>

   <?php	
   mysqli_close($conn);
   ?>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
