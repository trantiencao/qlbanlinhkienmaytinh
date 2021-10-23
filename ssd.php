<?php require("header.php"); ?>
<!-- main body -->
<!-- ################################################################################################ -->
<div style="margin-top: 4rem;" class="sectiontitle">
  <h6 class="heading">Sản Phẩm Nhập Khẩu Mới Nguyên Siu Từ Mỹ</h6>
  <p>New Imported Product From USA</p>
</div>
<ul class="nospace group overview">
  <?php
  require("admin/autoload/autoload.php");
  $query = "SELECT * FROM product WHERE product.category_id = '56'";
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
  } else
    echo "Không có sản phẩm nào";
  ?>

</ul>
<!-- ################################################################################################ -->
<!-- / main body -->
<div class="clear"></div>
<?php require("footer.php"); ?>