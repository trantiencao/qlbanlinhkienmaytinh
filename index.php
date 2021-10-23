<?php 
session_start();
error_reporting(0);
require("header.php"); ?>

<div class="wrapper bgded overlay" style="background-image:url('user/images/demo/backgrounds/banner7.jpg');">
    <div id="pageintro" class="hoc clear">
        
        <article>
            <p>Trung tâm mua bán linh kiện hàng đầu</p>
            <h3 class="heading">TTC Computer</h3>
            <p>Giá rẻ, Uy tín, Chất lượng</p>
        </article>
        
    </div>
</div>


<div>
    <hr style="height: 3px; background-color: #0E74A5; width: 96%; margin-bottom: 0;margin-right: 24px">
    <div style="text-align: center; " id="logo" class="one_half first">
        <h1 class="logoname">
            <p id="giamgia" style="margin-top: 5px; transition:all 0.4s">Top<span> giảm giá </span> tháng</p>
        </h1>
    </div>
    <hr style="height: 3px; background-color: #F7A804; width: 79%; margin-top: 0; margin-right: 24px">

    <ul class="nospace group overview">
        <?php
        require("admin/autoload/autoload.php");
        $query = "SELECT * FROM product  ORDER BY product.sale DESC LIMIT 4";
        //Truy vấn nè
        $result = mysqli_query($connect, $query);
        $numrow = mysqli_num_rows($result);
        if ($numrow <> 0) {
            while ($rows = mysqli_fetch_array($result)) { ?>
                <li class="one_third" style="width: 22%;">
                    <figure>
                        <a href="detail.php?id=<?php echo $rows['id'] ?>"><img style="" src="public/uploads/product/<?php echo $rows['avatar'] ?>" alt=""></a>
                        <figcaption>
                            <h6 class="heading"><?php echo $rows['name']; ?></h6>
                            <p><?php echo 'Giá: ' . $rows['price'] . ' vnđ' ?></p>
                            <p><?php echo $rows['stock'] == 0 ? 'Đã hết hàng' : 'Số lượng: ' . $rows['stock'] ?></p>
                        </figcaption>
                    </figure>
                </li>
        <?php
            }
        }
        ?>
    </ul>
    <hr style="height: 3px; background-color: #0E74A5; width: 96%; margin-top: 0; margin-right: 24px">
    <div style="text-align: center; " id="logo" class="one_half first">
        <h1 class="logoname">
            <p id="moinhat" style="margin-top: 5px">Sản phẩm<span> Mới </span></p>
        </h1>
    </div>
    <hr style="height: 3px; background-color: #F7A804; width: 79%; margin-top: 0; margin-right: 24px">

    <ul class="nospace group overview">
        <?php
        require("admin/autoload/autoload.php");
        $query = "SELECT * FROM `product` ORDER BY created_at DESC LIMIT 4";
        //Truy vấn nè
        $result = mysqli_query($connect, $query);
        $numrow = mysqli_num_rows($result);
        if ($numrow <> 0) {
            while ($rows = mysqli_fetch_array($result)) { ?>
                <li class="one_third" style="width: 22%;">
                    <figure>
                        <a href="detail.php?id=<?php echo $rows['id'] ?>"><img src="public/uploads/product/<?php echo $rows['avatar'] ?>" alt=""></a>
                        <figcaption>
                            <h6 class="heading"><?php echo $rows['name']; ?></h6>
                            <p><?php echo 'Giá: ' . $rows['price'] . ' vnđ' ?></p>
                            <p><?php echo $rows['stock'] == 0 ? 'Đã hết hàng' : 'Số lượng: ' . $rows['stock'] ?></p>
                        </figcaption>
                    </figure>
                </li>
        <?php
            }
        }
        ?>
    </ul>
</div>


<div class="wrapper row3">
    <main class="hoc  clear">
        <!-- main body -->


        
        
        <!-- / main body -->
        <div class="clear"></div>
        <?php require("footer.php"); ?>