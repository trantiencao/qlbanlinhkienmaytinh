<!DOCTYPE html>
<html lang="vi">

<head>
    <title>TTC computer</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="user/layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
    <link href="./CSS/header.css" rel="stylesheet" type="text/css" media="all">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Bootstrap core JS-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <!-- Contact form JS-->

    <!-- Core theme JS-->
    <script src="user/layout/scripts/script.js"></script>
</head>

<?php
session_start();
error_reporting(0);
// Checking the time now when home page starts.
if (time() > $_SESSION['expire']) {
    unset($_SESSION['login']);
    // session_unset($_SESSION["login"]);
    if (isset($_SESSION['login'])) {
        $_SESSION['login'] = false;
        //session_unset($_SESSION["login"]);
    }
    if (isset($_SESSION['email']))
        unset($_SESSION['email']);
    if (isset($_SESSION['password']))
        unset($_SESSION['password']);
    header('Location: login.php');
}

//error_reporting(0);
// session_destroy(); 
// Click dang nhap thi chuyen den webpage login
if (isset($_POST['login'])) {
    header('Location: login.php');
    //redirectUrl('login.php');
}

if (isset($_POST['logout'])) {
    unset($_SESSION['login']);
    // session_unset($_SESSION["login"]);
    if (isset($_SESSION['login'])) {
        $_SESSION['login'] = false;
        //session_unset($_SESSION["login"]);
    }
    if (isset($_SESSION['email']))
        unset($_SESSION['email']);
}
?>

<body id="top">

    <div class="wrapper row0">
        <div id="topbar" class="hoc clear">

            <div class="fl_left">
                <ul class="nospace">
                    <li><a href="index.php"><i class="fas fa-home fa-lg"></i></a></li>
                    <li><a class="js-scroll-trigger" href="#giamgia">Siêu giảm giá</a></li>
                    <li><a class="js-scroll-trigger" href="#moinhat">Sản phẩm mới nhất</a></li>
                    <?php
                    if (isset($_SESSION['login']) && $_SESSION['login'] == true && $_SESSION['level'] == 1) {
                        echo '<li><a class="js-scroll-trigger" href="admin">Admin</a></li>';
                    }
                    ?>
                </ul>
            </div>
            <form action="" method="post">
                <div class="fl_right">
                    <ul class="nospace">
                        <li><i class="fas fa-phone rgtspace-5"></i>0327147158</li>
                        <?php
                        if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                        ?>
                            <li class="dropdown show no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php echo $_SESSION['name']; ?>
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu shadow" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="/qlbanlinhkienmaytinh/reset_password.php">
                                        <input type="button" name="resetpassword" value="Reset Password" style="background: transparent; color: black; border: none; cursor: pointer;">
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item">
                                        <form action="" method="post">
                                            <input type="submit" name="logout" value="Logout" style="background: transparent; color: black; border: none; cursor: pointer;">
                                        </form>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <a href="cart.php"><i style="color:white; font-size:20px;" class="fas fa-shopping-cart"></i></a>
                            </li>
                        <?php
                        } else { ?>
                            <li>
                                <!-- <button style="background: transparent; border: none" type="submit" name="login" value="login"><i class="rgtspace-5">Đăng nhập</i></button> -->
                                <input type="submit" name="login" value="ĐĂNG NHẬP" style="background: transparent; border: none; cursor: pointer;">
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </form>

        </div>
    </div>

    <div class="wrapper row1">
        <header id="header" class="hoc clear">

            <div id="logo" class="one_half first">
                <h1 class="logoname"><a href="index.php"><span>TTC</span>computer</a></h1>
            </div>
            <div class="one_half">
                <!-- Content Wrapper -->
                <div id="content-wrapper" class="d-flex flex-column">
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <div class="search-input">
                                <i class="fa fa-search"></i>
                                <input type="text" placeholder="Search for anything" />
                            </div>
                            <div class="input-group-append" style="margin-left: 10px; float: left;">
                                <form action="" method="POST">
                                    <button class="btn btn-primary" type="submit" name="btn_search">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </header>
        <nav id="mainav" class="hoc clear">
            <ul class="clear">
                <li><a href="/qlbanlinhkienmaytinh/cpu.php">CPU - Bộ Xử Lí</a></li>
                <li><a href="/qlbanlinhkienmaytinh/ram.php">RAM</a></li>
                <li><a href="/qlbanlinhkienmaytinh/ssd.php">Ổ cứng SSD</a></li>
                <li><a href="/qlbanlinhkienmaytinh/hdd.php">Ổ cứng HDD</a></li>
                <li><a href="/qlbanlinhkienmaytinh/odd.php">ODD - Ổ đĩa quang</a></li>
                <li><a href="/qlbanlinhkienmaytinh/vga.php">VGA - Card Màn Hình</a></li>
                <li><a href="/qlbanlinhkienmaytinh/psu.php">PSU - Nguồn Máy Tính</a></li>
            </ul>
        </nav>
    </div>