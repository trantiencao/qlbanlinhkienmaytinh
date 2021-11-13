<?php $title = 'Sửa sản phẩm'; ?>
<?php require("../../layout/header.php"); ?>
<?php
$open = "product";
$capacityold = "";
require("../../autoload/autoload.php");

$id = $_GET['id'];
$query = "SELECT * FROM `product` WHERE product.id = '$id'";
$result = mysqli_query($connect, $query);
while ($row = mysqli_fetch_array($result)) {
    $nameold = $row['name'];
    $saleold = $row['sale'];
    if (!empty($row['capacity'])) {
        $capacityold = $row['capacity'];
    }
    $priceold = $row['price'];
    $avtold = $row['avatar'];
    $categoryold = $row['category_id'];
    $descriptionold = $row['description'];
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($capacityold == "") {
        if (isset($_POST['name']) && isset($_POST['price']) && isset($_POST['avt']) && isset($_POST['description'])) {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $sale = $_POST['sale'];
            $avt = $_POST['avt'];
            $category = $_POST['category_id'];
            $description = $_POST['description'];
            
            $query = "UPDATE `product` SET `name`='$name',`price`='$price',`sale`='$sale',`avatar`='$avt',`category_id`='$category',`description`='$description' WHERE product.id='$id'";
            $result = mysqli_query($connect, $query);

            if ($name == $nameold &&  $price ==  $priceold && $sale == $saleold && $avt == $avtold &&   $category ==  $categoryold && $description == $descriptionold) {
                $_SESSION['success'] = 'Không có gì thay đổi';
                redirectUrl('/qlbanlinhkienmaytinh/admin/module/product/index.php');
            } else {
                $_SESSION['success'] = 'Cập nhật thành công';
                redirectUrl('/qlbanlinhkienmaytinh/admin/module/product/index.php');
            }
        } else
            echo "<script type='text/javascript'>alert('Vui lòng nhập đầy đủ dữ liệu');</script>";
    } else {
        if (isset($_POST['name']) && isset($_POST['capacity']) && isset($_POST['price']) && isset($_POST['avt']) && isset($_POST['description'])) {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $capacity = $_POST['capacity'];
            $sale = $_POST['sale'];
            $avt = $_POST['avt'];
            $category = $_POST['category_id'];
            $description = $_POST['description'];
            $query = "UPDATE `product` SET `name`='$name',`price`='$price',`capacity`=$capacity,`sale`=$sale,`avatar`='$avt',`category_id`=$category,`description`='$description' WHERE product.id='$id'";
            $result = mysqli_query($connect, $query);

            if ($name == $nameold &&  $price ==  $priceold && $capacity == $capacityold && $sale == $saleold && $avt == $avtold &&   $category ==  $categoryold && $description == $descriptionold) {
                $_SESSION['success'] = 'Không có gì thay đổi';
                redirectUrl('/qlbanlinhkienmaytinh/admin/module/product/index.php');
            } else {
                $_SESSION['success'] = 'Cập nhật thành công';
                redirectUrl('/qlbanlinhkienmaytinh/admin/module/product/index.php');
            }
        } else
            echo "<script type='text/javascript'>alert('Vui lòng nhập đầy đủ dữ liệu');</script>";
    }
}
?>


<!-- Begin Page Content -->
<h1 align="center">Chỉnh Sửa Sản Phẩm</h1>
<div class="col-md-12">
    <form action="" method="POST">
        <div class="form-group">
            <label for="exampleInputEmail1">Tên sản phẩm</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Vui lòng nhập tên sản phẩm vào đây" name="name" value="<?php echo $nameold ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Giá</label>
            <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Vui lòng nhập giá sản phẩm vào đây" name="price" value="<?php echo $priceold ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Dung lượng:</label>
            <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Để trống nếu linh kiện không có dung lượng" name="capacity" value="<?php echo $capacityold ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Giảm giá(%)</label>

            <select class="form-control" name="sale">
                <?php
                $selected = $saleold;
                ?>
                <option value="0" <?php if ($selected == 0) {
                                        echo 'selected="selected"';
                                    } ?>>0%</option>
                <option value="5" <?php if ($selected == 5) {
                                        echo 'selected="selected"';
                                    } ?>>5%</option>
                <option value="10" <?php if ($selected == 10) {
                                        echo 'selected="selected"';
                                    } ?>>10%</option>
                <option value="15" <?php if ($selected == 15) {
                                        echo 'selected="selected"';
                                    } ?>>15%</option>
                <option value="20" <?php if ($selected == 20) {
                                        echo 'selected="selected"';
                                    } ?>>20%</option>
            </select>

        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Ảnh</label>
            <input class="form-control-file" type="file" class="form-control" id="exampleInputEmail1" placeholder="Vui lòng nhập tên sản phẩm vào đây" name="avt" value="<?php echo $avtold ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Danh mục</label>
            <select class="form-control" name="category_id">
                <?php
                $selected = $categoryold;
                $query1 = "SELECT * FROM category";
                $result = mysqli_query($connect, $query1);
                while ($rows = mysqli_fetch_array($result)) {
                    echo $selected == $rows['id'] ? "<option value='$rows[id]' selected='selected'>" . $rows['name'] . "</option>" : "<option value='$rows[id]'>" . $rows['name'] . "</option>";
                    // echo "<option value='$rows['id']'" . ($selected == $rows['id'] ? "selected = 'selected' ": "").">$row['name']<option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Mô tả</label>
            <textarea class="form-control" name="description" id="" cols="10" rows="5"><?php echo $descriptionold ?></textarea>
        </div>
        <button type="submit" class="btn btn-success">Lưu</button>
    </form>
</div>
<?php require("../../layout/footer.php"); ?>