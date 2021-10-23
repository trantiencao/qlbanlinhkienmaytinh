<?php require("header.php"); ?>
<?php require("admin/autoload/autoload.php"); ?>
<main class="hoc  clear">
    <!-- main body -->
    <h1 style="margin-top: 1rem;" align="center">Danh Sách Sản Phẩm</h1>
    <?php
    $id_user =  $_SESSION['id_user'];
    $sql = "SELECT * FROM `cart` join `product` on cart.id_product = product.id  WHERE cart.id_user = '$id_user'";
    $query = mysqli_query($connect, $sql);

    if (isset($_POST['submit'])) {
        $sql_order = "INSERT INTO `order`(`id_user`, `pending`) VALUES ($id_user,1)";
        $query_order = mysqli_query($connect, $sql_order);

        // mysqli_close($connect);
        // $connect = mysqli_connect($servername, $username, $password, $dbname) or die ('khong the ket noi' . mysqli_connect_error());
        $sql_test = "SELECT * FROM `order` WHERE order.id_user = $id_user ORDER BY created_at DESC LIMIT 1";
        $query_test = mysqli_query($connect, $sql_test);


        $rows_test = mysqli_fetch_array($query_test);
        $id_order = $rows_test['id'];

        // echo $id_order;
        $sql = "SELECT * FROM `cart` join `product` on cart.id_product = product.id  WHERE cart.id_user = '$id_user'";
        $query = mysqli_query($connect, $sql);
        // echo mysqli_num_rows($query);
        while ($rows = mysqli_fetch_array($query)) {
            $sql_order_detail = "INSERT INTO `order_detail`( `id_order`, `id_product`, `name_product`, `avatar`, `quantity`,`price`,`sale`)
                                 VALUES ($id_order,$rows[id_product],'$rows[name]','$rows[avatar]',$rows[quantity],$rows[price],$rows[sale])";
            $query_order_detail = mysqli_query($connect, $sql_order_detail);
        }

        alert("Đặt hàng thành công");
    }
    ?>
    <form action="" method="post">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <th width="5%">STT</th>
                            <th width="35%">Tên sản phẩm</th>
                            <th width="10%">Ảnh</th>
                            <th width="10%">Số lượng</th>
                            <th width="10%">Đơn giá</th>
                            <th width="10%">Giảm giá</th>
                            <th width="10%">Tổng tiền</th>
                            <th width="10%">Hành động</th>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT cart.id, cart.id_product,cart.id_user,cart.quantity,product.name, product.sale,product.avatar,cart.price FROM `cart` join `product` on cart.id_product = product.id  WHERE cart.id_user = '$id_user'";
                            $query = mysqli_query($connect, $sql);
                            $stt = 1;
                            while ($rows = mysqli_fetch_array($query)) {
                            ?>
                                <tr>
                                    <td><?php echo $stt; ?></td>
                                    <td><?php echo $rows['name'] ?></td>
                                    <td> <img style="width:100px; height:60px;" src='public/uploads/product/<?php echo $rows['avatar']; ?>'> </td>
                                    <td><?php echo $rows['quantity'] ?></td>
                                    <td><?php echo $rows['price'] ?></td>
                                    <td><?php echo $rows['sale'] . "%" ?></td>
                                    <td><?php echo $rows['quantity'] * $rows['price'] * (100 - $rows['sale']) / 100 ?></td>
                                    <td>
                                        <a href="delete_cart_item.php?id=<?php echo $rows['id'] ?>"><i class="fas fa-trash"></i>&nbsp;Xóa</a>
                                    </td>

                                </tr>

                            <?php
                                $stt++;
                            }
                            ?>
                        </tbody>
                    </table>

                    <button type="submit" name="submit">Đặt Hàng</button>
                </div>
            </div>
        </div>
    </form>
    <?php require("footer.php"); ?>