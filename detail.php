<?php require("header.php"); ?>
<?php require("admin/autoload/autoload.php"); ?>
<main class="hoc  clear">
    <!-- main body -->
    <?php
    // echo 'absdfsdfadsfsadf';
    $id = $_GET['id'];
    $query = "SELECT * FROM product WHERE product.id = '$id'";
    //Truy vấn nè
    $item = mysqli_fetch_array(mysqli_query($connect, $query));
    // echo $item['id'];
    $name = $item['name'];
    $price = $item['price'];
    $sale = $item['sale'];
    $avatar = $item['avatar'];
    $description = $item['description'];
    $stock = $item['stock'];

    if (isset($_POST['submit_mua'])) {
        if ($_SESSION['login'] == false) {
            alert("Bạn chưa đăng nhập!");
        } else {
            if (empty($_POST['soLuong'])) {
                alert("Bạn chưa nhập số lượng");
            } else {
                $soLuong = $_POST['soLuong'];
                if (ktSoLuong($soLuong, $stock)) {
                    $id_user = $_SESSION['id_user'];
                    $query = "INSERT INTO `cart`(`id_user`, `id_product`, `quantity`, `price`) VALUES ($id_user,$id,$soLuong, $soLuong * $price * (100 - $sale) / 100)";
                    $them = mysqli_query($connect, $query);
                    if ($them == false) {
                        alert("thêm vào giỏ hàng thất bại ");
                    } else alert("thêm vào giỏ hàng thành công");
                } else alert("vui lòng kiểm tra lại số lượng");
            }
        }
    }
    ?>
    <form method="POST">
        <p style="text-align: center; font-size: 40px;">Chi tiết sản phẩm</p>
        <table style="width: 90%; height: 50%; border-style:none;">
            <tr>
                <td rowspan="6" width="45%">
                    <img src="public/uploads/product/<?php echo $avatar ?>" alt="">
                </td>
                <?php
                echo "<td width='55%'><i  style='color:orange'  class='fas fa-arrow-circle-right'></i> Tên sản phẩm: $name </td>";
                echo "<tr><td><i style='color:orange' class='fas fa-arrow-circle-right'></i> Giá: $price</td</tr>";
                echo "<tr><td><i style='color:orange' class='fas fa-arrow-circle-right'></i> Giảm giá: $sale %</td></tr>";
                echo "<tr><td><i style='color:orange' class='fas fa-arrow-circle-right'></i> Mô tả: $description</td></tr>";
                echo "<tr><td><i style='color:orange' class='fas fa-arrow-circle-right'></i> Còn lại: $stock</td></tr>";
                echo "<tr><td><i style='color:orange' class='fas fa-arrow-circle-right'></i> Số lượng: <input style='border-radius:10px; border-color:red' name='soLuong' style='align:center' type='number' value='Số lượng'></td></tr>";
                echo $stock == 0 ? '<tr><td></td><td style="color:red">Đã hết hàng</td></tr>' : "<tr><td></td><td><button name='submit_mua'style='align:center; background-color: orange; border: none;color: #ffffff;cursor: pointer;border-radius:10px;padding: 10px 40px 10px 40px;position: relative;text-transform: uppercase;' b  type='submit'>" .  'Thêm vào giỏ hàng' . "</button</td></tr>";
                ?>

            </tr>
        </table>
    </form>

    <!-- ################################################################################################ -->
    <!-- ################################################################################################ -->
    <!-- / main body -->
    <div class="clear"></div>


    <?php require("footer.php"); ?>