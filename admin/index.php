<?php $title = 'Main Admin'; ?>
<?php
session_start();
error_reporting(0);
if (!isset($_SESSION)) {
    $now = time(); // Checking the time now when home page starts.
    if ($now > $_SESSION['expire']) {
        session_destroy();
        header('Location: /qlbanlinhkienmaytinh/login.php');
    }
}
if (isset($_SESSION['login']) && $_SESSION['login'] == true && $_SESSION['level'] == 1) {
    require("module/order/order.php");
} else header('Location: /qlbanlinhkienmaytinh');
?>