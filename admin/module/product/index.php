<?php $title = 'Danh sách sản phẩm'; ?>
<?php
$open = "product";
require("../../autoload/autoload.php");
?>
<?php require("../../layout/header.php"); ?>
<!-- Begin Page Content -->
<h1 align="center">Danh Sách Sản Phẩm</h1>

<!-- Search form -->
    <div>
        <form action="" method="GET" class="d-flex d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            
                <input type="text" name="tensanpham" class="form-control bg-light small" placeholder="Search for..."
                aria-label="Search" aria-describedby="basic-addon2">
                <input type="submit" value="Tìm Kiếm">
                    <!-- <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button> -->
        </form>
    </div>

    <?php
        if($_SERVER['REQUEST_METHOD']=='GET')
        {
            if(empty($_GET['tensanpham'])) echo "<p align='center'>Vui lòng nhập tên sản phẩm</p>";
            else
            {
                $tensanpham=$_GET['tensanpham'];	
                
                $query= "SELECT * FROM `product` WHERE `name` LIKE '%$tensanpham%'";
                $result=mysqli_query($connect,$query);		
                if(mysqli_num_rows($result)<>0)
                {	$rows=mysqli_num_rows($result);
                    echo "<div align='center'><b>Có $rows sản phẩm được tìm thấy.</b></div>";
                    while($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {
                        
                        echo '<table border="1" cellpadding="5" cellspacing="5" style="border-collapse:collapse;">
                            <tr bgcolor="#eeeeee"><td colspan="2" align="center"><h3>'
                          .$row['name'].'</h3></td></tr>';
                        //echo '<tr><td width="200" align="center"><img src= "../../../public/uploads/product/' .$rows['avatar']. '/></td>';
                        echo '<i><b>Thời gian khởi tạo: </b></i>'.
                                $row['created_at'].' VNĐ';
                        echo '</td></tr></table>';
                    }
                }
                else echo "<div><b>Không tìm thấy sản phẩm này.</b></div>";
            }
        }
    ?>

<?php if (isset($_SESSION['success'])) : ?>
    <div class="alert alert-success">
        <?php echo $_SESSION['success'];
        unset($_SESSION['success']) ?>
    </div>
<?php endif ?>

<?php
if (isset($_GET['pages'])) {
    $pages = $_GET['pages'];
} else {
    $pages = 1;
}

$rowPerpage = 5;
$perRow = $pages * $rowPerpage - $rowPerpage;

$sql = "SELECT * FROM `product` LIMIT $perRow,$rowPerpage";
$query = mysqli_query($connect, $sql);
$totalRows =  mysqli_num_rows(mysqli_query($connect, "SELECT * FROM product"));
$totalPages = ceil($totalRows / $rowPerpage); // ceil là làm tròn tăng thôi 4.1 lên 5. 4.4 lên 5

$listPages  = "";
for ($i = 1; $i <= $totalPages; $i++) {
    if ($pages == $i) {
        $listPages .= ' <li class="page-item active"><a href="index.php?pages=' . $i . '"></a>' . $i . '</a></li>';
    } else {
        $listPages .= '<li class="page-item "><a href="index.php?pages=' . $i . '"></a>' . $i . '</a></li>';
    }
}
?>

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <th width="10%">STT</th>
                    <th width="40%">Tên sản phẩm</th>
                    <th width="10%">Ảnh</th>
                    <th width="20%">Thời gian khởi tạo</th>
                    <th width="20%">Hành động</th>
                </thead>
                <tbody>
                    <?php

                    $stt = $rowPerpage * ($pages - 1) + 1;
                    while ($rows = mysqli_fetch_array($query)) {
                    ?>
                        <tr>
                            <td><?php echo $stt; ?></td>
                            <td><?php echo $rows['name'] ?></td>
                            <td> <img style="width:100px; height:60px;" src='../../../public/uploads/product/<?php echo $rows['avatar']; ?>'> </td>
                            <td><?php echo $rows['created_at'] ?></td>
                            <td>
                                <a class="btn btn-info" href="edit.php?id=<?php echo $rows['id'] ?>"> <i class="fa fa-edit"></i>&nbsp;Edit</a>
                                <a class="btn btn-danger" href="delete.php?id=<?php echo $rows['id'] ?>"><i class="fas fa-trash"></i>&nbsp;Delete</a>
                            </td>
                        </tr>

                    <?php
                        $stt++;
                    }
                    ?>
                </tbody>
            </table>
            <ul class="pagination">
                <?php
                for ($t = 1; $t <= $totalPages; $t++) {
                    echo "<li class='page-item'><a class='page-link' href='index.php?pages=$t'>Trang $t</a></li>";
                }
                ?>
            </ul>
        </div>
    </div>
</div>
<?php require("../../layout/footer.php"); ?>