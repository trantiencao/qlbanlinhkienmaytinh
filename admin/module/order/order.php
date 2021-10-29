<?php
$open = 'order';
require("layout/header.php");
require("autoload/autoload.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sqlUpdate =  "UPDATE `order` SET  `pending`= 0 WHERE order.id = '$id' ";
    $query = mysqli_query($connect, $sqlUpdate);
    alert($query ? "Phê duyệt đơn hàng thành công" : "xác nhận không thành công, vui lòng thử lại");
    $url = $_SERVER['REQUEST_URI'];
    $url = strtok($url, "?");
}

$sql = "SELECT * FROM `order` WHERE order.pending = 1";
$query = mysqli_query($connect, $sql);

$soLuongDonHang  = mysqli_num_rows($query)
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card <?php echo $soLuongDonHang == 0 ? "border-left-success" : "border-left-danger" ?>   shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold  <?php echo $soLuongDonHang == 0 ? "text-success" : "text-danger" ?> text-uppercase mb-1">
                            <h3> <?php echo $soLuongDonHang == 0 ? "bạn không có đơn hàng nào" :  "bạn đang có $soLuongDonHang đơn hàng đang chờ duyệt" ?>
                            </h3>
                        </div>

                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Begin Page Content -->
    <h1 align="center">Danh Sách Đơn Hàng Chờ Duyệt</h1>

    <!-- Search form -->
    <div id="searchForm" style="margin-bottom:20px;">
        <form action="" method="GET" class="d-flex d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            
                <input type="text" name="madon" class="form-control bg-light small" placeholder="Search for..."
                aria-label="Search" aria-describedby="basic-addon2" 
                value="<?php echo (isset($_GET['madon'])) ? $_GET['madon'] : ''; ?>">
                <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                </button>
              
        </form>
    </div>
    

    <?php
        if (isset($_GET['pages'])) {
            $pages = $_GET['pages'];
        } else {
            $pages = 1;
        }

        $rowPerpage = 5;
        $perRow = $pages * $rowPerpage - $rowPerpage;

        $sql = "SELECT * FROM `order` WHERE pending = 1";
        $query = mysqli_query($connect, $sql);
        $totalRows =  mysqli_num_rows(mysqli_query($connect, $sql));
        $totalPages = ceil($totalRows / $rowPerpage); // ceil là làm tròn tăng thôi 4.1 lên 5. 4.4 lên 5

        $listPages  = "";
        for ($i = 1; $i <= $totalPages; $i++) {
            if ($pages == $i) {
                $listPages .= ' <li class="page-item active"><a href="index.php?pages=' . $i . '"></a>' . $i . '</a></li>';
            } else {
                $listPages .= '<li class="page-item"><a href="index.php?pages=' . $i . '"></a>' . $i . '</a></li>';
            }
        }

        if($_SERVER['REQUEST_METHOD']=='GET' && !empty($_GET['madon'])) {
            $madon=$_GET['madon'];	
                
            $sql= "SELECT * FROM `product` WHERE `name` LIKE '%$tensanpham%' LIMIT $perRow,$rowPerpage";
    
            $query=mysqli_query($connect,$sql);
            if(mysqli_num_rows($query) > 0) {
                $rows=mysqli_num_rows($query);
                echo "<div align='center'><b>Có $rows đơn hàng được tìm thấy.</b></div>";
            } else {
                echo "<div align='center'><b>Không có giá trị phù hợp</b></div>";
                $sql = "SELECT * FROM `product` LIMIT $perRow,$rowPerpage";
                $query=mysqli_query($connect,$sql);
            }
            
        } else {
            $sql = "SELECT * FROM `product` LIMIT $perRow,$rowPerpage";
            $query=mysqli_query($connect,$sql);
        }
    ?>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <th width="5%">STT</th>
                        <th width="12%">Mã đơn hàng</th>
                        <th width="15%">Mã khách hàng</th>
                        <th width="20%">Trạng thái</th>
                        <th width="20%">Thời gian tạo đơn</th>
                        <th width="28%">Hành động</th>
                    </thead>
                    <tbody>
                        <form method="GET">
                            <?php
                            $stt = $rowPerpage * ($pages - 1) + 1;
                            // echo "submit_id_$rows[id]";

                            while ($rows = mysqli_fetch_array($query)) {
                            ?>
                                <tr>
                                    <td><?php echo $stt++; ?></td>
                                    <td><?php echo $rows['id'] ?></td>
                                    <td><?php echo $rows['id_user'] ?></td>
                                    <td><?php echo "Đang chờ duyệt" ?></td>
                                    <td><?php echo $rows['created_at'] ?></td>
                                    <td>
                                        <a href="index.php?id=<?php echo $rows['id'] ?>" class="btn btn-info" onclick="return confirm('Bạn có muốn duyệt?')"> <i class="far fa-check-circle"></i></i>&nbsp;Xác nhận</a>
                                        <a class="btn btn-warning" href="module/order/detail_order.php?id=<?php echo $rows['id'] ?>"><i class="fas fa-info-circle"></i>&nbsp;Chi tiết</a>
                                        <a class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa đơn hàng này?')" href="module/order/delete_order.php?id=<?php echo $rows['id'] ?>"><i class="fas fa-trash"></i>&nbsp;Xóa</a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </form>
                    </tbody>

                </table>
                <ul class="pagination">
                    <?php
                    for ($t = 1; $t <= $totalPages; $t++)
                        echo "<li class='page-item'><a class='page-link' href='index.php?pages=$t'>Trang $t</a></li>";
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <!-- End of Main Content -->
    <?php require("layout/footer.php"); ?>