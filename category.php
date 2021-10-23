<?php require("layouts/header.php"); ?>

<?php
error_reporting(0);
require("admin/autoload/autoload.php");

$query = "SELECT * FROM `category`";
$result = mysqli_query($connect, $query);
$numrow = mysqli_num_rows($result);
?>
<div class="main">
	<?php
	if ($numrow != 0) {
		while ($rows = mysqli_fetch_array($result)) {
			$nameCate = $rows['name'];
	?>

			<div class="main-top">
				<div class="content_top">
					<div class="heading">
						<h3><?php echo $nameCate ?></h3>
					</div>
					<div class="page-no">
						<p>Result Pages:</p>
						<ul>
							<li><a href="#">1</a></li>
							<li class="active"><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li>[<a href="#"> Next&gt;&gt;&gt;</a>]</li>
						</ul>
						<p></p>
					</div>
					<div class="clear"></div>
				</div>

				<div class='section group'>
					<?php
					$query2 = "SELECT * FROM `product` INNER JOIN `category` ON product.category_id = category.id WHERE category.name = '$nameCate'";
					$result2 = mysqli_query($connect, $query2);
					$numrow2 = mysqli_num_rows($result2);
					if ($numrow2 <> 0) {
						while ($rows2 = mysqli_fetch_array($result2)) {
							echo "<div class='col_1_of_4 span_1_of_4'>";
							echo "<div class='view effect'>";
							echo "<a href='#'><img src='public/uploads/product/{$rows2['avatar']}'></a>";
							echo "</div>";
							echo "<div class='cart'>";

							echo "<div class='price'>";
							echo "<span class='actual'>{$rows2['price']} VND</span>";
							echo "</div>";
							echo "<input type='submit' value='Add to Cart' class='button name='addtocart'>";
							echo "</div>";
							echo "</div>";
						}
					}
					?>
				</div>
			</div>
			<br>
	<?php
		}
	}
	?>
</div>

<?php require("layouts/footer.php"); ?>