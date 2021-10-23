<?php $title = 'Main Admin'; ?>
<?php
session_start();
error_reporting(0);
if (isset($_SESSION['login']) && $_SESSION['login'] == true && $_SESSION['level'] == 1) {
    require("module/order/order.php");
} else header('Location: /qlbanlinhkienmaytinh');
?>