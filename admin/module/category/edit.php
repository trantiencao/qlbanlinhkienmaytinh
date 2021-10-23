<?php $title = 'Sửa danh mục'; ?>
<?php
    $open = "category";
     require ("../../autoload/autoload.php");

     $id= $_GET['id'];
     $query = "SELECT * FROM `category` WHERE category.id = $id";
     $result = mysqli_query($connect, $query);

     while($row = mysqli_fetch_array($result))
     {
         $nameold=$row['name'];
     }
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST['name']) && ($_POST['name'] != NULL))
        {
            $name = $_POST['name'];
            $query = "UPDATE `category` SET `name`='$name' WHERE category.id=$id"; 
            $result = mysqli_query($connect, $query);
            
            if($result)
            {
                if($name == $nameold)
                {
                    $_SESSION['success'] = 'Không có gì thay đổi';
                    redirectUrl('/qlbanlinhkienmaytinh/admin/module/category/index.php');
                }
                else
                {
                    $_SESSION['success'] = 'Cập nhật thành công';
                    redirectUrl('/qlbanlinhkienmaytinh/admin/module/category/index.php');
                }
            }
        }
        else
            echo "<script type='text/javascript'>alert('Vui lòng nhập đầy đủ dữ liệu');</script>";
    }
?>

<?php require ("../../layout/header.php"); ?>
                    <!-- Begin Page Content -->
                    <h1 align="center">Sửa Danh Mục</h1>
                    <div class="col-md-12">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên danh mục</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="<?php echo $nameold?>" >
                            </div>
                            <button type="submit" class="btn btn-success">Lưu</button>
                        </form>
                    </div>
<?php require ("../../layout/footer.php"); ?>