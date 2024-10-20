<?php
$host = "localhost";
$usr = "root";
$pwd = "1478963";
$db = "cosmeticnew";


$conn = mysqli_connect($host, $usr, $pwd, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
	if (isset($_GET['cu_username'])) {
    $cu_username = mysqli_real_escape_string($conn, $_GET['cu_username']);
    
    // Fetch user data
    $sql1 = "SELECT * FROM customer WHERE cu_username='$cu_username'";
    $result1 = mysqli_query($conn, $sql1);
    $user_data = mysqli_fetch_array($result1);

    if (!$user_data) {
        die("ไม่พบข้อมูลลูกค้า");
    }
} else {
    die("ชื่อผู้ใช้ไม่ได้ถูกส่ง");
}

}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $cu_name = mysqli_real_escape_string($conn, $_POST['cu_name']);
    $cu_username = mysqli_real_escape_string($conn, $_POST['cu_username']);
    $cu_password = mysqli_real_escape_string($conn, $_POST['cu_password']);
    $cu_phone = mysqli_real_escape_string($conn, $_POST['cu_phone']);
    $cu_address = mysqli_real_escape_string($conn, $_POST['cu_address']);

    // Hash the password
    $hashed_password = password_hash($cu_password, PASSWORD_DEFAULT);

    // Insert into the database
    $sql = "UPDATE `customer` SET `cu_name`='$cu_name',`cu_username`='$cu_username',`cu_password`='$hashed_password',`cu_phone`='$cu_phone',`cu_address`='$cu_address' WHERE cu_id";

    if (mysqli_query($conn, $sql)) {
        // Redirect to the next page (e.g., welcome.php)
        header("Location:../customer/index.php");
        exit(); // Ensure script stops executing after redirect
    } else {
        $message = "<p style='color: red;'>เกิดข้อผิดพลาด: " . mysqli_error($conn) . "</p>";
    }
}

// Close the connection
mysqli_close($conn);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>แก้ไขข้อมูลส่วนตัว - Cosmetic New</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/customer/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container">
        <main class="form-container">
            <div class="col-md-6">
                <div class="text-center mb-4">
                <center><img class="mb-4" src="../customer/459176263_518078740831527_7142297360152062850_n.jpg" alt="" width="200" height="200"></center>
        <h1 class="h3 mb-3 fw-normal"><center>*Shine Cosmetic*</center></h1>
                    <h2>แก้ไขข้อมูลส่วนตัว</h2>    <p class="text-center"><a class="btn btn-custom" href="	indexx.php">กลับหน้าหลัก &raquo;</a></p>
                </div>
<?php if (isset($message)) echo $message; ?>
                <form method="POST" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="cu_name" class="form-label">ชื่อ-สกุล</label>
                        <input type="text" class="form-control" id="cu_name" name="cu_name" required>
                        <div class="invalid-feedback">กรุณากรอกชื่อของคุณ</div>
                    </div>
                    <div class="mb-3">
                        <label for="cu_username" class="form-label">ชื่อผู้ใช้</label>
                        <input type="text" class="form-control" id="cu_username" name="cu_username" required>
                        <div class="invalid-feedback">กรุณากรอกชื่อผู้ใช้</div>
                    </div>
                    <div class="mb-3">
                        <label for="cu_phone" class="form-label">เบอร์โทรศัพท์</label>
                        <input type="text" class="form-control" id="cu_phone" name="cu_phone" required>
                        <div class="invalid-feedback">กรุณากรอกเบอร์โทรศัพท์</div>
                    </div>
                    <div class="mb-3">
                        <label for="cu_address" class="form-label">ที่อยู่</label>
                        <input type="text" class="form-control" id="cu_address" name="cu_address" required>
                        <div class="invalid-feedback">กรุณากรอกที่อยู่</div>
                    </div>
                    <div class="mb-3">
                        <label for="cu_password" class="form-label">รหัสผ่าน</label>
                        <input type="password" class="form-control" id="cu_password" name="cu_password" required>
                        <div class="invalid-feedback">กรุณากรอกรหัสผ่าน</div>
                    </div>
                    <button class="w-100 btn btn-primary btn-lg" type="submit">ยืนยันการแก้ไขข้อมูล</button>
                </form>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/customer/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript for form validation
        (function () {
            'use strict';
            const forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
</body>
</html>