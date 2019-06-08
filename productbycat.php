<?php include 'inc/header.php'; ?>

<?php
	if (!isset($_GET['catId']) || $_GET['catId'] == NULL){
		echo "Oeps, er is iets mis gegaan.";
	}else{
		$id = $_GET['catId'];
	}
?>

<div class="main">
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<?php 
					$productbycat = $pd->productByOnlyCat($id);
					if($productbycat){
						while ($result = $productbycat->fetch_assoc()) {	
				?>

				<h3><?php echo $result['catName']  ;?>

				<?php } } ?>

				</h3>
			</div>
			<div class="clear"></div>
		</div>
		
		<br>

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
						<?php echo $result['catName']; ?></a>
				</li>

				<?php }} ?>
			</ul>
		</div>
	</div>
</div>

<br>

<div class="container-fluid">
	<div class="row row-eq-height">

	<?php 
		$productbycat = $pd->productByCat($id);
		if($productbycat){
			while ($result = $productbycat->fetch_assoc()) {	
	?>

	<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 row-eq-height">
		<div class="thumbnail text-center">
			<a href="preview.php?proid=<?php echo $result['productId']; ?>">
			<img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
			<h2>
				<?php echo $result['productName']; ?>
			</h2>
			<p>
				<?php echo $fm->textShorten($result['body'], 60); ?>
			</p>
			<p><span class="price">€
				<?php echo $result['price']; ?></span>
			</p>
			<div><span><a class="btn btn-primary" href="preview.php?proid=<?php echo $result['productId']
				; ?>" class="details">Details</a></span>

			</div>
		</div>
	</div>

	<?php } } else{
	echo "<div class=container-fluid><h4>Er zijn geen produkten terugevonden voor deze categorie</h4></div>";
	}?>

	</div>
</div>

	<div class="rtnToAllProd">
		<a class="btn btn-primary" href="./products.php">TERUG</a>
	</div>

	<br>

<?php include 'inc/footer.php'; ?>