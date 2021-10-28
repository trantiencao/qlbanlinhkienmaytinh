<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $title; ?></title>
    <link href="/qlbanlinhkienmaytinh/public/admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="/qlbanlinhkienmaytinh/public/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="/qlbanlinhkienmaytinh/public/admin/css/sb-admin-2.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
</head>
<?php
session_start();
//error_reporting(0);
// session_destroy(); 
if (isset($_POST['logout'])) {
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
    header('Location: /qlbanlinhkienmaytinh');
}
?>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/qlbanlinhkienmaytinh">
                <div class="sidebar-brand-icon rotate-n-15">
                    TTC
                </div>
                <div class="sidebar-brand-text mx-3">Computer</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            

            <!-- Heading -->
            <div class="sidebar-heading">
                Quản Lí
            </div>

            <!-- Nav Item - Dashboard -->
            <li class="<?php echo isset($open) && $open == 'order' ? 'active' : '' ?> nav-item">
                <a class="nav-link" href="/qlbanlinhkienmaytinh/admin">
                    <i class="fas fa-home"></i>
                    <span>Đơn hàng</span></a>
            </li>

            <!-- Nav Item - Charts -->
            <li class="<?php echo isset($open) && $open == 'category' ? 'active' : '' ?> nav-item">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapsePagess"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-list-ul"></i>
                    <span>Danh Mục</span>
                </a>
                <div id="collapsePagess" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="/qlbanlinhkienmaytinh/admin/module/category/add.php">Thêm mới</a>
                        <a class="collapse-item" href="/qlbanlinhkienmaytinh/admin/module/category/index.php">Danh sách danh mục</a>
                    </div>
                </div>
            </li>

            <li class="<?php echo isset($open) && $open == 'product' ? 'active' : '' ?> nav-item">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapsePagesss"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-list-ul"></i>
                    <span>Sản Phẩm</span>
                </a>
                <div id="collapsePagesss" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="/qlbanlinhkienmaytinh/admin/module/product/add.php">Thêm mới</a>
                        <a class="collapse-item" href="/qlbanlinhkienmaytinh/admin/module/product/index.php">Danh sách sản phẩm</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-success topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <!-- <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="search" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> -->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo "Xin chào ".$_SESSION['name']; ?></span>
                                <i class="fas fa-user-shield"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <input type="button" value="Profile"
                                        style="background: transparent; color: black; border: none; cursor: pointer;">
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item">
                                    <form action="" method="post">
                                        <input type="submit" name="logout" value="Logout"
                                            style="background: transparent; color: black; border: none; cursor: pointer;">
                                    </form>
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->