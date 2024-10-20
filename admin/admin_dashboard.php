<!doctype html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="description" content="">
   <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
   <meta name="generator" content="Hugo 0.84.0">
   <title>Shine Cosmetic - ข้อมูลลูกค้า</title>

   <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/album/">

   <!-- Bootstrap core CSS -->
   <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

   <style>
      /* Styles for the page */
	   
      body {
         background-color: #FDF5E6;
         background-repeat: no-repeat;
      }
      .col-lg-4 {
         background-color: #ec407a;
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
      .text-muted {
         color: #ec407a !important;
      }
      .lead {
         color: #ec407a !important;
      }
      .featurette-divider {
         border-top: 5px solid #FFB6C1;
      }
      h1, h2 {
         color: #ec407a;
      }
      .featurette-heading {
         color: #ec407a !important;
      }
      .category-button {
         margin: 10px 5px;
      }
      footer {
         background-color: #FDF5E6;
         color: #FFFFFF;
      }
      .heading {
         color: #ec407a !important;
      }
      /* Styles for the table header */
      thead th {
         background-color: #FFB6C1; /* สีพื้นหลังหัวข้อตาราง */
         color: white; /* สีของข้อความในหัวข้อตาราง */
      }
   </style>

</head>
<body>
	<center><h1 class="fw-bg-color:#ec407a;" >แก้ไขข้อมูลลูกค้า</h1></center>
	<a href="type.php" class="btn btn-secondary">กลับไปหน้าหลัก</a>
   <table id="myTable" class="table table-striped table-hover" style="width:100%">
      <thead>
         <tr>
            <th>แก้ไข</th>
            <th>ลบ</th>
            <th>IDลูกค้า</th>
            <th>ชื่อ</th>
            <th>ชื่อผู้ใช้</th>
            <th>เบอร์โทรศัพท์</th>
            <th>ที่อยู่</th>
         </tr>
      </thead>
      <tbody>
         <?php
         include_once("connectdb.php");
         $sql = "SELECT * FROM customer ORDER BY cu_id ASC";
         $rs = mysqli_query($conn, $sql);
         while ($data = mysqli_fetch_array($rs)) {
         ?>
            <tr data-category-id="<?=$data['cu_id'];?>">
               <td>
                  <a href="update_customer.php?cu_id=<?=$data['cu_id'];?>" class="btn btn-warning btn-sm">
                     <i class="bi bi-pen"></i> แก้ไข
                  </a>
               </td>
             <td><a href="delete_dash.php?id=<?=$data['cu_id'];?>" onClick="return confirm('ยืนยันการลบ?');" class="btn btn-danger"><i class="bi bi-trash-fill"></i>ลบ</a></td>
               <td><?=$data['cu_id'];?></td>
               <td><?=$data['cu_name'];?></td>
               <td><?=$data['cu_username'];?></td>
               <td><?=$data['cu_phone'];?></td>
               <td><?=$data['cu_address'];?></td>
            </tr>
         <?php
         }
         mysqli_close($conn);
         ?>
      </tbody>
   </table>
   <br><br>
</body>
</html>
