<?php

// include, require, include_once, require_once
include_once "lib/php/functions.php";
include_once "parts/templates.php";

$data = getRows(
	makeConn(),
	"SELECT * FROM `products` WHERE `id` = '{$_GET['id']}'"
);
$o = $data[0];
$images = explode(",",$o->images);


?><!DOCTYPE html>
<html lang="en">
<head>
	<title>Store: Product Item</title>
	<style>
		.arrow {
  border: solid grey;
  border-width: 0 3px 3px 0;
  display: inline-block;
  padding: 3px;
}

.left {
  transform: rotate(135deg);
  -webkit-transform: rotate(135deg);
}
	</style>
	
	<?php include "parts/meta.php" ?>
	<script src="js/products.js"></script>
</head>
<body>

	<?php include "parts/navbar.php" ?>

	<div class="container">
		<nav class="nav-crumbs" style="margin:1em 0">
			<ul>
				<a href="product_list.php"><i class="arrow left"></i> Go Back</a>
			</ul>
		</nav>

		<div class="grid gap">
			<div class="col-xs-12 col-md-6">
				<div class="card medium">
					<div class="product-main">
						<img src="images/<?= $o->thumbnail ?>" alt="">
					</div>
					<div class="product-thumbs">
					<?=
					array_reduce($images,function($r,$o){
						return $r."<img src='images/$o'>";
					})
					?>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6">
				<form class="card medium flat" method="get" action="data/form_actions.php">
					<div class="card-section">
						<h2><?= $o->name ?></h2>
						<div class="product-description">
							<div class="product-price" style="text-align: left">&dollar;<?= $o->price ?></div>
						</div>
					</div>
					<div class="card-section">
						<label class="form-label">Amount</label>
						<div class="form-select">
							<select name="amount">
								<!-- option*10>{$} -->
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
								<option>6</option>
								<option>7</option>
								<option>8</option>
								<option>9</option>
								<option>10</option>
							</select>
						</div>

					</div>
					<div class="card-section">
						<input type="hidden" name="action" value="add-to-cart">
						<input type="hidden" name="id" value="<?= $o->id ?>">
						<input type="hidden" name="price" value="<?= $o->price ?>">
						<input type="submit" class="form-button" value="Add To Cart">
						<br>
						
							<h3>Description</h3>
						<div style="font-size: 16px;color: #316a8a;"><?= $o->description ?></div>
						<br>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="container">
		<h2>Similar Products</h2>
		<?php recommendedSimilar($o->category,$o->id) ?>
	</div>

	
	<?php include "parts/footer.php" ?>
	
</body>
</html>