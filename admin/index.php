<?php $title = 'Main Admin'; ?>
<?php
session_start();
error_reporting(0);
// Ending a session in 30 minutes from the starting time.
$_SESSION['expire'] = $_SESSION['start'] + (60*5);
if (isset($_SESSION['email'])){
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
        header('Location: /qlbanlinhkienmaytinh/login.php');
    }
}
if (isset($_SESSION['login']) && $_SESSION['login'] == true && $_SESSION['level'] == 1) {
    require("module/order/order.php");
} else header('Location: /qlbanlinhkienmaytinh');
?>