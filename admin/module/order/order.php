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