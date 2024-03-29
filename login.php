<?php
session_start(); //khởi động session
if(isset($_SESSION["user"])){
    header("Location:index.php");
}
include_once("model/user.php");
$infomation = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = $_REQUEST["email"];
    $password = $_REQUEST["password"];
    $user = User::authentication($userName, $password);
    if ($user != null) {
        // $infomation = "Đăng nhập thành công. Chào bạn: " . $user->fullName;
        $_SESSION["user"] = serialize($user); //đập dẹp object
        header("Location:index.php");
    } else {
        $infomation = "Đăng nhập thất bại. Vui lòng kiểm tra tài khoản và mật khẩu";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin - Login</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
    <div class="container">
        <div class="card card-login mx-auto mt-5">
            <div class="card-header">Login</div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="text" id="inputEmail" class="form-control" name="email" placeholder="Email address"  autofocus="autofocus">
                            <label for="inputEmail">user</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required="required">
                            <label for="inputPassword">Password</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="remember-me">
                                Remember Password
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                       <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </div>
                    <?php if(strlen($infomation) != 0){ ?>
                        <div class="alert alert-danger" role="alert">
                            <?php
                                echo $infomation;
                            ?>
                        </div>
                    <?php } ?>
                </form>
                <div class="text-center">
                    <a class="d-block small mt-3" href="register.html">Register an Account</a>
                    <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>