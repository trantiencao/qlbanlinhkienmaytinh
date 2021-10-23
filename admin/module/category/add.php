<?php $title = 'Thêm danh mục'; ?>
<?php
    $open = "category";
     require ("../../autoload/autoload.php");
     
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST['name']) && ($_POST['name'] != NULL))
        {
            $name = $_POST['name'];
            
            
                $query = "INSERT INTO `category`(`name`) VALUES ('$name')";
                $result = mysqli_query($connect, $query);
                
                if($result)
                {
                    $_SESSION['success'] = 'Thêm mới thành công';
                    redirectUrl('/qlbanlinhkienmaytinh/admin/module/category/index.php');
                }
            
           
        }
        else
            echo "<script type='text/javascript'>alert('Vui lòng nhập đầy đủ dữ liệu');</script>";
     }
?>

<?php require ("../../layout/header.php"); ?>
                    <!-- Begin Page Content -->
                    <h1 align="center">Thêm Mới Danh Mục</h1>
                    <div class="col-md-12">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên danh mục</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Vui lòng nhập tên danh mục vào đây"  name="name">
                            </div>
                            <button type="submit" class="btn btn-success">Lưu</button>
                        </form>
                    </div>
<?php require ("../../layout/footer.php"); ?>