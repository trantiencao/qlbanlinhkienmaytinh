<?php $title = 'Danh sách danh mục'; ?>
<?php
    $open = "category";
    require ("../../autoload/autoload.php");
    require ("../../../libraries/database.php");
?>
<?php require ("../../layout/header.php"); ?>
                    <!-- Begin Page Content -->

                    <h1 align="center">Danh Sách Danh Mục Sản Phẩm</h1>

                    <!-- Search form -->
                    <div id="searchForm" style="margin-bottom:20px;">
                        <form action="" method="GET" class="d-flex d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            
                                <input type="text" name="loaisanpham" class="form-control bg-light small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2" 
                                value="<?php echo (isset($_GET['loaisanpham'])) ? $_GET['loaisanpham'] : ''; ?>">
                                <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-search fa-sm"></i>
                                </button>
                            
                        </form>
                    </div>

                    <?php if(isset($_SESSION['success'])):?>
                            <div class="alert alert-success">
                                <?php echo $_SESSION['success']; unset($_SESSION['success']) ?>
                            </div>
                    <?php endif ?>
                    
                    <?php
                        if(isset($_GET['pages']))
                        {
                            $pages = $_GET['pages'];
                        }
                        else
                        {
                            $pages = 1; 
                            
                        }

                        $rowPerpage = 5;
                        $perRow = $pages*$rowPerpage - $rowPerpage;
                        
                        $sql = "SELECT * FROM `category` LIMIT $perRow,$rowPerpage";
                        $query = mysqli_query($connect, $sql);
                        $totalRows =  mysqli_num_rows(mysqli_query($connect, "SELECT * FROM category"));
                        $totalPages = ceil($totalRows / $rowPerpage); // ceil là làm tròn tăng thôi 4.1 lên 5. 4.4 lên 5
                       
                        $listPages  = "";
                        for($i =1; $i <= $totalPages; $i++)
                        {
                            if($pages == $i)
                            {
                                $listPages.=' <li class="page-item active"><a href="index.php?pages='.$i.'"></a>'.$i.'</a></li>';
                            }
                            else
                            {
                                $listPages.='<li class="page-item"><a href="index.php?pages='.$i.'"></a>'.$i.'</a></li>';
                                
                            }
                        }

                        if($_SERVER['REQUEST_METHOD']=='GET' && !empty($_GET['loaisanpham'])) {
                            $loaisanpham=$_GET['loaisanpham'];	
                                
                            $sql= "SELECT * FROM `category` WHERE `name` LIKE '%$loaisanpham%' LIMIT $perRow,$rowPerpage";
                    
                            $query=mysqli_query($connect,$sql);
                            if(mysqli_num_rows($query) > 0) {
                                $rows=mysqli_num_rows($query);
                                echo "<div align='center'><b>Có $rows sản phẩm được tìm thấy.</b></div>";
                                echo "<br>";
                            } else {
                                echo "<div align='center'><b>Không có giá trị phù hợp</b></div>";
                                echo "<br>";
                                $sql = "SELECT * FROM `category` LIMIT $perRow,$rowPerpage";
                                $query=mysqli_query($connect,$sql);
                            }
                            
                        } else {
                            $sql = "SELECT * FROM `category` LIMIT $perRow,$rowPerpage";
                            $query=mysqli_query($connect,$sql);
                        }
                    ?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <th width="10%">STT</th>
                                        <th width="40%">Tên danh mục</th>
                                        <th width="32%">Thời gian khởi tạo</th>
                                        <th width="18%">Hành động</th>
                                    </thead>
                                    <tbody>

                                        <?php
                                            $stt = $rowPerpage * ($pages -1)+ 1;
                                            
                                            while($rows = mysqli_fetch_array($query))
                                            {
                                        ?>
                                        <tr>
                                            <td><?php echo $stt++;?></td>
                                            <td><?php echo $rows['name'] ?></td>
                                            <td><?php echo $rows['create_at'] ?></td>
                                            <td>
                                                <a class="btn btn-info" href="edit.php?id=<?php echo $rows['id']?>"> <i class="fa fa-edit" ></i>&nbsp;Edit</a>
                                                <a class="btn btn-danger" href="delete.php?id=<?php echo $rows['id']?>"><i class="fas fa-trash"></i>&nbsp;Delete</a>
                                            </td>
                                        </tr>

                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                    
                                </table>
                                <ul class="pagination" style="justify-content: center;">
                                    <?php
                                        for($t = 1; $t <= $totalPages; $t++)
                                        {
                                        
                                            echo "<li class='page-item'><a class='page-link' href='index.php?pages=$t'>Trang $t</a></li>";
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
<?php require ("../../layout/footer.php"); ?>