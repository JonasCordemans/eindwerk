<?php include_once './inc/header.php'; ?>
<?php include_once './classes/product.php'; ?>


<div class="main">
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<h3>Alle produkten</h3>
			</div>
			<div class="clear"></div>
		</div>
		<br>


<!-- Category list -->
<div class="container-fluid">
	<!-- Default dropright button -->
	<div class="btn-group dropright">
		<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
			aria-expanded="false">
			Categorieën >
		</button>
		<div class="dropdown-menu">
			<ul>
				<?php 
			$getCat = $cat->getAllCat();
			if ($getCat) {
				while ($result = $getCat->fetch_assoc()) {
		?>

				<li><a href="productbycat.php?catId=<?php echo $result['catId'];?>">
						<?php echo $result['catName']; ?></a></li>

				<?php }} ?>
			</ul>
		</div>
	</div>
</div>
<br>
<!-- end of Category list -->

		<div class="container-fluid">
			<div class="row row-eq-height">

				<?php 
					$allProd = $pd->getAllProduct();
					if ($allProd) {
						while ($result = $allProd->fetch_assoc()) {
				?>

				<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 row-eq-height">
					<div class="thumbnail text-center">
						<a href="preview.php?proid=<?php echo $result['productId']; ?>">
								<img src="admin/<?php echo $result['image']; ?>" alt=""></a>
							<h2>
								<?php echo $result['productName']; ?>
							</h2>
							<p>
								<?php echo $fm->textShorten($result['body'], 60); ?>
							</p>
							<p><span class="price">€
								<?php echo $result['price']; ?></span>
							</p>

							<p><a href="preview.php?proid=<?php echo $result['productId']
							; ?>" class="btn btn-primary" role="button">Details</a></p>
					</div>
				</div>

				<?php } } ?>

			</div>
			<div class="text-center back">
				<button class="btn btn-primary" onclick="history.go(-1);">TERUG </button>
			</div>
		</div>
	</div>
</div>

<?php include 'inc/footer.php'; ?>