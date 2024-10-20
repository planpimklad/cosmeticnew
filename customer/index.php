<?php
session_start();
include_once("../customer/connectdb.php");

// เช็คการเชื่อมต่อฐานข้อมูล
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['Submit'])) {
    // ป้องกัน SQL Injection
    $username = mysqli_real_escape_string($conn, $_POST['ausername']);
    $password = $_POST['apassword']; // รหัสผ่านที่ผู้ใช้ป้อนเข้ามา

    // ดึงข้อมูลผู้ใช้จากฐานข้อมูล
    $sql = "SELECT * FROM customer WHERE cu_username = '$username'";
    $rs = mysqli_query($conn, $sql);

    if ($rs) {
        // ตรวจสอบว่ามีผู้ใช้งานหรือไม่
        if (mysqli_num_rows($rs) > 0) {
            $data = mysqli_fetch_assoc($rs);
            
            // ตรวจสอบรหัสผ่านที่ผู้ใช้ป้อนกับรหัสผ่านที่เข้ารหัสในฐานข้อมูล
            if (password_verify($password, $data['cu_password'])) {
                // ถ้ารหัสผ่านถูกต้อง
                $_SESSION['cu_username'] = $data['cu_username'];
                $_SESSION['username'] = $data['cu_username']; // เก็บชื่อผู้ใช้ในเซสชัน
                session_regenerate_id();
                // เปลี่ยนไปยังหน้าหลักของอัลบั้ม
                echo "<script>";
                echo "window.location='../customer/indexx.php';";
                echo "</script>";
                exit(); // เพื่อหยุดการทำงานของสคริปต์
            } else {
                // ถ้ารหัสผ่านไม่ถูกต้อง
                echo "<script>";
                echo "alert('รหัสผ่านไม่ถูกต้อง');";
                echo "</script>";
            }
        } else {
            // ถ้าไม่มีผู้ใช้งานที่ตรงกับชื่อผู้ใช้
            echo "<script>";
            echo "alert('ไม่พบชื่อผู้ใช้นี้ในระบบ');";
            echo "</script>";
        }
    } else {
        // เกิดข้อผิดพลาดในการเชื่อมต่อกับฐานข้อมูล
        echo "<script>";
        echo "alert('เกิดข้อผิดพลาดในการเข้าถึงฐานข้อมูล: " . mysqli_error($conn) . "');";
        echo "</script>";
    }
}
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
    <script src="../customer/color-modes.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>*Shine Cosmetic*</title>
    <link href="../customer/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-signin {
            max-width: 400px;
            margin: auto;
        }
    </style>
</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary">
<main class="form-signin w-100 m-auto">
    <form method="post" action="">
        <center>
            <img class="mb-4" src="../customer/459176263_518078740831527_7142297360152062850_n.jpg" alt="" width="200" height="200">
        </center>
        <h1 class="h3 mb-3 fw-normal"><center>*Shine Cosmetic*</center></h1>
        <div class="form-floating">
            <input type="text" class="form-control" name="ausername" placeholder="Username" autofocus required>
            <label for="floatingInput">Username</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" name="apassword" placeholder="Password" required>
            <label for="floatingPassword">Password</label>
        </div>

        <div class="form-check text-start my-3">
            <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                Remember me
            </label>
        </div>
        <button class="btn btn-primary w-100 py-2" type="submit" name="Submit">เข้าสู่ระบบ</button>
        <br><br>
        <a href="index_check.php" class="btn btn-success w-100 py-2">สมัครสมาชิก</a>
    </form>
</main>
<script src="../customer/bootstrap.bundle.min.js"></script>
</body>
</html>