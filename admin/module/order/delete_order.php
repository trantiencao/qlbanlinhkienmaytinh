<?php
$open = 'order';
    require ("../../autoload/autoload.php");
        $id= $_GET['id'];
        $query ="DELETE FROM `order` WHERE id='$id'";
        $resultd= mysqli_query($connect,$query);
        if($resultd)
        {
            $_SESSION['success'] = 'Xóa thành công';
            redirectUrl('/qlbanlinhkienmaytinh/admin/');
        }
?>