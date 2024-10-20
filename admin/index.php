<?php
		session_start();
		include_once("connectdb.php");
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
    <script src="../admin/color-modes.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>Admin - Shine Cosmetic</title>
    <link href="../admin/bootstrap.min.css" rel="stylesheet">
    
    <style>
        .form-signin {
            max-width: 380px;
            padding: 15px;
            margin: auto;
        }
        .form-signin img {
            border-radius: 50%;
        }
        .form-floating {
            margin-bottom: 15px;
        }
        .btn-primary {
            background-color: #712cf9;
            border-color: #712cf9;
        }
        .btn-primary:hover {
            background-color: #5a23c8;
            border-color: #5a23c8;
        }
        .form-check-label {
            margin-left: 10px;
        }
        .form-check-input {
            margin-top: 7px;
        }
        .bd-mode-toggle {
            position: fixed;
            bottom: 15px;
            right: 15px;
        }
    </style>
</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <main class="form-signin w-100 m-auto">
        <form method="post" action="">
            <center>
                <img class="mb-4" src="../admin/459176263_518078740831527_7142297360152062850_n.jpg" alt="" width="200" height="200">
            </center>
            <h1 class="h3 mb-3 fw-normal text-center">Shine Cosmetic</h1>

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
        </form>
    </main>

    <script src="../admin/bootstrap.bundle.min.js"></script>

<?php
if(isset($_POST['Submit'])){
    $sql = "SELECT * FROM `admin` WHERE `a_username` = '{$_POST['ausername']}' AND `a_password` = '".md5($_POST['apassword'])."' ";
    $rs = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($rs);

    if($num > 0){
        $data = mysqli_fetch_array($rs);
        $_SESSION['aid']= $data['a_id'];
        $_SESSION['aname']= $data['a_name'];
        echo "<script>window.location='type.php';</script>";
    } else {
        echo "<script>alert('Username หรือ Password ไม่ถูกต้อง');</script>";
        exit;
    }
}
?>
</body>
</html>
