<?php
$host = "localhost";
$usr = "root";
$pwd = "1478963";
$db = "cosmeticnew";

// Create connection
$conn = mysqli_connect($host, $usr, $pwd, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
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
    $sql = "INSERT INTO customer (cu_name, cu_username, cu_password, cu_phone, cu_address)
            VALUES ('$cu_name', '$cu_username', '$hashed_password', '$cu_phone', '$cu_address')";

    if (mysqli_query($conn, $sql)) {
        // Redirect to the next page (e.g., welcome.php)
        header("Location: index.php");
        exit(); // Ensure script stops executing after redirect
    } else {
        $message = "<p style='color: red;'>เกิดข้อผิดพลาด: " . mysqli_error($conn) . "</p>";
    }
}

// Close the connection
mysqli_close($conn);
?>

<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>สมัครสมาชิก - Cosmetic New</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .form-container .col-md-6 {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn-custom {
            background-color: #ec407a;
            color: white;
            border: none;
        }
        .btn-custom:hover {
            background-color: #d93670;
        }
        .form-label {
            font-weight: bold;
        }
        h2 {
            font-weight: bold;
            color: #ec407a;
        }
    </style>
</head>
<body>
    <div class="container">
        <main class="form-container">
            <div class="col-md-6">
                <div class="text-center mb-4">
                    <img class="mb-4" src="../customer/459176263_518078740831527_7142297360152062850_n.jpg" alt="Logo" width="200" height="200">
                    <h1 class="h3 mb-3 fw-normal">*Shine Cosmetic*</h1>
                    <h2>สมัครสมาชิก</h2>
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
                    <button class="w-100 btn btn-custom btn-lg" type="submit">ยืนยันการสมัครสมาชิก</button>
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
