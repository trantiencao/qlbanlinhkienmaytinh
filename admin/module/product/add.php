<?php $title = 'Thêm sản phẩm'; ?>
<?php require ("../../layout/header.php"); ?>
<?php
    $open = "product";
    require ("../../autoload/autoload.php");
    
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $error = array();
            if(!empty($_POST['name']) && !empty($_POST['price']) && !empty($_POST['sale']) && !empty(basename($_FILES['fileUpload']['name'])) && !empty($_POST['category']) && !empty($_POST['description']))
            {
                $name = $_POST['name'];
                $price = $_POST['price'];
                $capacity = $_POST['capacity'];
                $sale = $_POST['sale'];
                $avt = basename($_FILES['fileUpload']['name']);
                $category = $_POST['category'];
                $description = $_POST['description'];

                if(!empty($capacity))
                {
                    $query = "INSERT INTO `product`(`name`, `price`,`capacity`, `sale`, `avatar`, `category_id`, `description`) VALUES ('$name',$price,$capacity,$sale,'$avt',$category,'$description')";
                }
                else
                {
                    $query = "INSERT INTO `product`(`name`, `price`, `sale`, `avatar`, `category_id`, `description`) VALUES ('$name',$price,$sale,'$avt',$category,'$description')";
                }
                    
                //Bước 1: Tạo foler upload file ảnh
                $target_dir = "../../../public/uploads/product/";
                //Tạo đường dẫn sau khi upload lên hệ thống
                $target_file = $target_dir.basename($_FILES['fileUpload']['name']);

                //Bước 2: Kiểm tra điều kiện upload
                //1. Kiểm tra kích thước file
                //2. Kiểm tra đuôi file
                //3. Kiểm tra sự tồn tại của file

                if($_FILES['fileUpload']['size'] > 5242880)
                {
                    $error['fileUpload'] = "Kích thước ảnh quá lớn";
                }

                $file_type = pathinfo($_FILES['fileUpload']['name'], PATHINFO_EXTENSION);
                
                $file_type_allow = array('png', 'jpg', 'jpeg');
                if(!in_array(strtolower($file_type), $file_type_allow ))
                {
                    $error['fileUpload'] = "Chỉ cho phép upload file ảnh(jgg, png, jpeg)";
                }

                if(file_exists($target_file))
                {
                    $error['fileUpload'] = "File đã tồn tại trên hệ thống";
                }

                // Bước 3: Kiểm tra và chuyển file từ bộ nhớ tạm lên server

                if(empty($error))
                {
                    if(move_uploaded_file($_FILES['fileUpload']['tmp_name'], $target_file))
                        echo  'thành công';
                    else
                        echo 'thất bại';
                }

                $result = mysqli_query($connect, $query);
                
                if($result)
                {
                    $_SESSION['success'] = 'Thêm mới thành công';
                    redirectUrl('/qlbanlinhkienmaytinh/admin/module/product/index.php');
                }
            }
            else
            {
                echo "<script type='text/javascript'>alert('Vui lòng nhập đầy đủ dữ liệu');</script>";
            }
     }
?>


                    <!-- Begin Page Content -->
                    <h1 align="center">Thêm Mới Sản Phẩm</h1>
                    <div class="col-md-12">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên sản phẩm</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập vào tên sản phẩm."  name="name" value=
                                "<?php
                                    if(isset($_POST['name']))
                                    {
                                        echo $_POST['name'];
                                    }
                                    else
                                    {
                                        echo "";
                                    }
                                ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Giá</label>
                                <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Nhập vào giá sản phẩm."  name="price" value=
                                "<?php
                                    if(isset($_POST['price']))
                                    {
                                        echo $_POST['price'];
                                    }
                                    else
                                    {
                                        echo "";
                                    }
                                ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Dung lượng(GB)</label>
                                <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Nhập vào dung lượng. Để trống nếu sản phẩm không có!"  name="capacity" value=
                                "<?php
                                    if(isset($_POST['capacity']))
                                    {
                                        echo $_POST['capacity'];
                                    }
                                    else
                                    {
                                        echo "";
                                    }
                                ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Giảm giá</label>
                                <select class="form-control" name="sale">
                                    <option value="0" selected="selected">0%</option>
                                    <option value="5">5%</option>
                                    <option value="10">10%</option>
                                    <option value="15">15%</option>
                                    <option value="20">20%</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ảnh</label>
                                <input class="form-control-file" type="file" class="form-control"  name="fileUpload" id="fileUpload" value=
                                "<?php
                                    if(isset($_POST['fileUpload']))
                                    {
                                        echo $_POST['fileUpload'];
                                    }
                                    else
                                    {
                                        echo "";
                                    }
                                ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Danh mục</label>
                                <select class="form-control" name="category">
                                    <?php
                                        $query1="SELECT * FROM category";
                                        $result = mysqli_query($connect,$query1);
                                        while($rows = mysqli_fetch_array($result))
                                        {
                                            echo "<option value=$rows[id]>$rows[name]</option>";
                                        }
                                    ?>
                                </select>                            
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mô tả</label>
                                <textarea class="form-control" name="description" id="" cols="10" rows="5" >
                                </textarea>
                            </div>
                            <button type="submit" class="btn btn-success">Lưu</button>
                        </form>
                    </div>
<?php require ("../../layout/footer.php"); ?>