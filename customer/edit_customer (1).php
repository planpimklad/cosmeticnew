<?php
$host = "localhost";
$usr = "root";
$pwd = "";
$db = "cosmeticnew";

// Create connection
$conn = mysqli_connect($host, $usr, $pwd, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data and sanitize it
    $cu_name = mysqli_real_escape_string($conn, $_POST['cu_name']);
    $cu_username = mysqli_real_escape_string($conn, $_POST['cu_username']);
    $cu_password = mysqli_real_escape_string($conn, $_POST['cu_password']);
    $cu_phone = mysqli_real_escape_string($conn, $_POST['cu_phone']);
    $cu_address = mysqli_real_escape_string($conn, $_POST['cu_address']);

    // Insert into the database
    $sql = "INSERT INTO customer (cu_name, cu_username, cu_password, cu_phone, cu_address) 
            VALUES ('$cu_name', '$cu_username', '$cu_password', '$cu_phone', '$cu_address')"; 

    if (mysqli_query($conn, $sql)) {
        // Redirect to the edit_customer.php page after success
        header("Location: edit_customer.php");
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
    <title>สมัครสมาชิก - Cosmetic New</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
            <a href="indexx.php" class="btn btn-secondary">กลับไปยังหน้าแรก</a>
                <div class="text-center mb-4">
                    <h2>แก้ไขข้อมูลส่วนตัว</h2>
                </div>
                <?php if (isset($message)) echo $message; ?>
                
                <!-- Back Button -->
                <div class="mb-3 text-center">
                </div>

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
                    <button class="w-100 btn btn-primary btn-lg" type="submit">ยื่นยันการแก้ไข</button>
                </form>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
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
