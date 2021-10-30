<?php
session_start();
error_reporting(0);

if (isset($_SESSION["login"]) && $_SESSION["login"] == true) {
    $emailsession = $_SESSION["email"];
} else
    header('Location: /qlbanlinhkienmaytinh');

if (isset($_REQUEST["btn_submit"])) {
    if (isset($_POST["passwordOld"]) && isset($_POST["newpassword"]) && isset($_POST["repeatnewpassword"])) {
        $sql = "SELECT * FROM user WHERE email = '$emailsession'";
        $query = mysqli_query($connect, $sql);
        if (mysqli_num_rows($query) != 0) {
            while ($data = mysqli_fetch_array($query)) {
                $_SESSION["passwordOld"] = $data["password"];
            }
            if (md5($_POST["passwordOld"]) == $_SESSION["passwordOld"]) {
                if ($_POST["newpassword"] == $_POST["repeatnewpassword"]) {
                    $newpassword = md5($_POST["newpassword"]);
                    $sqlupdate = "UPDATE `user` SET `password`='$newpassword' WHERE user.email='$emailsession'";
                    $result = mysqli_query($connect, $query);
                    if ($result) {
                        echo "<script type='text/javascript'>alert('Đổi mật khẩu thành công');</script>";
                        header('Location: /qlbanlinhkienmaytinh');
                    }
                } else
                    echo "<script type='text/javascript'>alert('Nhập lại mật khẩu mới không khớp');</script>";
            } else
                echo "<script type='text/javascript'>alert('Nhập sai mật khẩu hiện tại');</script>";
        }
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

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="public/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="public/admin/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">

                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Đổi mật khẩu</h1>
                                    </div>
                                    <form class="user" action="" method="POST">
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="passwordOld" id="exampleInputPassword" placeholder="Password present">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="newpassword" id="exampleInputNewPassword" placeholder="New password">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="repeatnewpassword" id="exampleInputRepeatNewPassword" placeholder="Repeat New password">
                                        </div>
                                        <input class="btn btn-primary btn-user btn-block" type="submit" name="btn_submit" value="Đổi">
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="index.php">Hủy</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="public/admin/vendor/jquery/jquery.min.js"></script>
    <script src="public/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="public/admin/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="public/admin/js/sb-admin-2.min.js"></script>
</body>

</html>