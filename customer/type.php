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

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/customer/">

    

    <!-- Bootstrap core CSS -->
<link href="../customer/bootstrap.min.css" rel="stylesheet">

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
    background-color: #FDF5E6
	; /* เปลี่ยนสีพื้นหลังของทั้งหน้า */
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
    }
		 footer {
        background-color: #FDF5E6;
        color: #FFFFFF;
      }
		.heading{color:#ec407a !important; }
		
</style>

</head>
<body>
	
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
      <symbol id="check2" viewBox="0 0 16 16">
        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
      </symbol>
      <symbol id="circle-half" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
      </symbol>
      <symbol id="moon-stars-fill" viewBox="0 0 16 16">
        <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
        <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
      </symbol>
      <symbol id="sun-fill" viewBox="0 0 16 16">
        <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
      </symbol>
    </svg>

    <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
      <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center"
              id="bd-theme"
              type="button"
              aria-expanded="false"
              data-bs-toggle="dropdown"
              aria-label="Toggle theme (auto)">
        <svg class="bi my-1 theme-icon-active" width="1em" height="1em"><use href="#circle-half"></use></svg>
        <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
      </button>
      <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
            <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#sun-fill"></use></svg>
            Light
            <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
          </button>
        </li>
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
            <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#moon-stars-fill"></use></svg>
            Dark
            <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
          </button>
        </li>
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true">
            <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#circle-half"></use></svg>
            Auto
            <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
          </button>
        </li>
      </ul>
    </div>

   
<header data-bs-theme="dark">
  <div class="collapse text-bg-dark" id="navbarHeader">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-md-7 py-4">
          <h4>*Shine Cosmatic*</h4>
          <p class="text-body-secondary">
 แหล่งรวมเครื่องสำอางสำหรับคนรักความงาม</p>
        </div>
        <div class="col-sm-4 offset-md-1 py-4">
           <h4> <?php echo isset($_SESSION['cuusername']) ? htmlspecialchars($_SESSION['cuusername']) : 'ผู้ใช้'; ?></h4>
           <ul class="list-unstyled">
                            <li></li>
                            <li><a href="index.php" class="text-white">ออกจากระบบ</a></li>
                        </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container">
      <a href="#" class="navbar-brand d-flex align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox="0 0 24 24"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
        <strong>Shine Cosmatic</strong>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </div>
</header>

<main>

   <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <h1>ShineCosmatics</h1>
            </div>
            <p>
                <a href="indexx.php" class="btn btn-primary my-2">กลับหน้าหลัก</a>
                <a href="inbasket.php" class="btn btn-warning btn-sm"><i class="bi bi-basket2-fill"></i>ตะกร้าสินค้า</a>
            </p>

            <form class="form-inline" action="type.php" method="post" onsubmit="return validateSearch()">
                <label for="textinput">ค้นหา</label>
                <input name="search" type="text" id="searchInput" autofocus>
                <button id="submit" name="Submit" class="btn btn-primary">ค้นหา</button>
            </form>

            <script>
                function validateSearch() {
                    const searchInput = document.getElementById('searchInput').value;
                    if (searchInput.length < 3) {
                        alert("กรุณาพิมพ์ตัวอักษรอย่างน้อย 3 ตัว");
                        return false; // ไม่ให้ส่งฟอร์ม
                    }
                    return true; // ส่งฟอร์มได้
                }
            </script>
        </section>

        <center>
            <?php
            // ดึงข้อมูลหมวดหมู่
            $sql2 = "SELECT * FROM category";
            $rs2 = mysqli_query($conn, $sql2);
            ?>
            <h3>ประเภทสินค้า:</h3>
            <?php while ($data2 = mysqli_fetch_array($rs2, MYSQLI_BOTH)) { ?>
                <a href="type.php?cid=<?=$data2['c_id'];?>" class="btn btn-danger"><?=$data2['c_name'];?></a> |
            <?php } ?>
            <a href="type.php" class="btn btn-danger">ดูสินค้าทั้งหมด</a>
        </center>

        <div class="album py-5 bg-bg-color:#FFB6C1;">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <?php
                    // รับค่า cid จาก URL หากมีการเลือกหมวดหมู่
                    @$cid = $_GET['cid'];
                    @$kw = $_POST['search'];

                    if (!empty($kw)) {
                        // ใช้คำค้นหาในการดึงข้อมูล
                        $sql = "SELECT * FROM product WHERE (p_name LIKE '%{$kw}%' OR p_detail LIKE '%{$kw}%')";
                    } elseif (!empty($cid)) {
                        // แสดงสินค้าตามหมวดหมู่
                        $sql = "SELECT * FROM product WHERE c_id = {$cid}";
                    } else {
                        // แสดงสินค้าทั้งหมดหากไม่มีการค้นหาและไม่มีการเลือกหมวดหมู่
                        $sql = "SELECT * FROM product";
                    }

                    $rs = mysqli_query($conn, $sql);

                    // ตรวจสอบว่ามีสินค้าหรือไม่
                    if (mysqli_num_rows($rs) > 0) {
                        while ($data = mysqli_fetch_array($rs)) {
                    ?>
                    <div class="col">
                        <div class="card shadow-sm">
                            <a href="detail.php?pid=<?=$data['p_id'];?>">
                                <img src="images/<?=$data['p_id'];?>.<?=$data['p_picture'];?>" width="100%" height="400" class="card-img-top">
                            </a>
                            <div class="card-body">
                                <p class="card-text">
                                    <?=$data['p_name'];?><br>
                                    <?=$data['p_price'];?> บาท
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="inbasket.php?id=<?=$data['p_id'];?>" class="btn btn-primary" role="button">หยิบลงตะกร้า</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                        }
                    } else {
                        echo '<div class="col"><p class="text-danger">ไม่พบสินค้าที่คุณค้นหา</p></div>'; // แสดงข้อความหากไม่มีสินค้า
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>
    <script src="../customer/bootstrap.bundle.min.js"></script>
</body>
</html>