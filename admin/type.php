<?php
include_once("connectdb.php"); // เชื่อมต่อฐานข้อมูล
session_start();
$kw = $_POST['search'] ?? '';
$categoryId = $_POST['category'] ?? '';
?>
<!doctype html>
<html lang="en">
<head>
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Album example · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/admin/">

    <!-- Bootstrap core CSS -->
    <link href="../admin/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      body {
        background-color: #FDF5E6; /* สีพื้นหลังของทั้งหน้า */
        background-repeat: no-repeat;
      }
      .col-lg-4 {
        background-color: #ec407a; /* สีชมพู */
      }
      .navbar, .bg-dark {
        background-color: #ec407a !important; /* สีชมพูสดสำหรับ navbar และพื้นหลัง */
      }
      .navbar-brand, .nav-link, .text-white {
        color: #FFFFFF !important; /* ตัวอักษรใน navbar เป็นสีขาว */
      }
      .btn-secondary {
        background-color: #ec407a; /* ปุ่มเป็นสีชมพูอ่อน */
        border-color: #ec407a;
      }
      .text-muted {
        color: #ec407a !important; /* ข้อความตัวเล็กเป็นสีชมพูสด */
      }
      .lead {
        color: #ec407a !important; /* ข้อความหลักเป็นสีชมพูสด */
      }
      .featurette-divider {
        border-top: 5px solid #FFB6C1; /* เส้นแบ่งเป็นสีชมพูอ่อน */
      }
      .col-lg-4 {
        background-color: #FDF5E6; /* พื้นหลังคอลัมน์เป็นสีชมพูอ่อน */
      }
      h1, h2 {
        color: #ec407a; /* สีชมพูสดสำหรับ h1 และ h2 */
      }
      .featurette-heading {
        color: #ec407a !important; /* สีชมพูสดเข้มสำหรับข้อความภายใน featurette */
      }
      .category-button {
        margin: 10px 5px; /* เว้นระยะห่างระหว่างปุ่ม */
        background-color: #ff8a80;
        color: white;
        border-radius: 20px;
        padding: 8px 15px;
      }
      footer {
        background-color: #fce4ec;
        color: #FFFFFF;
        padding: 20px 0;
        text-align: center;
      }
      footer p {
        color: #ec407a;
        font-size: 1.2rem;
      }
      .card:hover {
        transform: scale(1.05);
        transition: transform 0.3s ease;
      }
      input#search {
        border: 2px solid #ec407a;
        padding: 10px;
        border-radius: 5px;
      }
      .btn:hover {
        background-color: #d81b60;
      }
      .card-text {
        text-align: center;
        padding: 10px;
      }
    </style>
</head>
<body>

    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
      <!-- Your SVG icons go here -->
    </svg>
  
<header data-bs-theme="dark">
  <div class="collapse text-bg-dark" id="navbarHeader">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-md-7 py-4">
          <h4>*Shine Cosmetic*</h4>
          <p class="text-body-secondary">แหล่งรวมเครื่องสำอางสำหรับคนรักความงาม</p>
        </div>
        <div class="col-sm-4 offset-md-1 py-4">
          <h4><?php echo isset($_SESSION['aname']) ? htmlspecialchars($_SESSION['aname']) : 'ผู้ดูแล'; ?></h4>
          <ul class="list-unstyled">
            <li><a href="index.php" class="text-white">ออกจากระบบ</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container">
      <a href="#" class="navbar-brand d-flex align-items-center">
        <strong>Shine Cosmetic</strong>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </div>
</header>

<main>
  <section class="py-5 text-center container">
    <div class="row py-lg-0">
      <h1 class="fw-bg-color:#ec407a;">ShineCosmetic</h1>
    </div>
    <p>
      <a href="edit_orders.php" class="btn btn-success">แก้ไขสินค้า</a>
      <a href="admin_dashboard.php" class="btn btn-success">แก้ไขข้อมูลลูกค้า</a>
      <a href="edit_category.php" class="btn btn-success">แก้ไขประเภทสินค้า</a>
      <a href="insert.php" class="btn btn-primary my-2">เพิ่มสินค้า</a>        
      <a href="view_order.php" class="btn btn-primary my-2">จัดการออเดอร์</a>
    </p>

    <center>
      <form method="post" action="" class="mb-3">
        <div>
          <label for="search">ค้นหา:</label>
          <input type="text" name="search" id="search" value="<?= htmlspecialchars($kw) ?>" autofocus>
          <button type="submit" name="Submit" class="btn btn-danger">OK</button><br><br>
          <strong>เลือกประเภทสินค้า:</strong><br><br>
          <?php
          $sql2 = "SELECT * FROM category";
          $rs2 = mysqli_query($conn, $sql2);
          while ($data2 = mysqli_fetch_array($rs2, MYSQLI_BOTH)) {
            echo "<button type='submit' name='category' value='{$data2['c_id']}' class='btn btn-danger category-button'>{$data2['c_name']}</button>";
          }
          ?>
          <button type='submit' name='category' value='' class='btn btn-danger category-button'>ทั้งหมด</button>
        </div>
      </form>
    </center>
  </section>

  <div class="album py-5 bg-body-tertiary">
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <?php
        $sql = "SELECT * FROM product WHERE (p_name LIKE '%{$kw}%' OR p_detail LIKE '%{$kw}%')";
        if (!empty($categoryId)) {
          $sql .= " AND c_id = '{$categoryId}'";
        }
        $rs = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_array($rs)) {
        ?>
        <div class="col">
          <div class="card shadow-sm">
            <img src="images/<?=$data['p_id'];?>.<?=$data['p_picture'];?>" width="100%" height="400">
            <div class="card-body">
              <p class="card-text">
                <?=$data['p_name'];?><br>
                <?=$data['p_price'];?> บาท
              </p>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
</main>

<footer>
  <p class="text-center">© Shine Cosmetic</p>
</footer>

<script src="../admin/bootstrap.bundle.min.js"></script>
</body>
</html>
