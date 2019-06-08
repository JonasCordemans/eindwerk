<?php include 'inc/header.php'; ?>
<?php include 'inc/slider.php'; ?>

<div class="main">
	<div class="content">
		<div class="content_top">
			<div>
				<h3>In de spotlight</h3>
			</div>
			<div class="clear"></div>
		</div>


		<div class="section group">
			<div class="row row-eq-height">
				<?php 
				$getFpd = $pd->getFeaturedProduct();
				if ($getFpd) {
					while ($result = $getFpd->fetch_assoc()) {
				?>

				<div class="grid_1_of_4 images_1_of_4">
					<a href="preview.php?proid=<?php echo $result['productId']; ?>">
						<img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					<h2><?php echo $result['productName']; ?></h2>
					<p><?php echo $fm->textShorten($result['body'], 60); ?></p>
					<p><span class="price">€ <?php echo $result['price']; ?></span></p>
					<div><span><a class="btn btn-primary" href="preview.php?proid=<?php echo $result['productId']
					 	; ?>" class="details">Details</a></span></div>
				</div>

				<?php } } ?>
			</div>
		</div>


		<div class="content_bottom">
			<div>
				<h3>Nieuw in het assortiment</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<div class="row row-eq-height">
				<?php 
				$getNpd = $pd->getNewProduct();
					if ($getNpd) {
						while ($result = $getNpd->fetch_assoc()) {
			?>

				<div class="grid_1_of_4 images_1_of_4">
					<a href="preview.php?proid=<?php echo $result['productId']; ?>">
						<img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					<h2><?php echo $result['productName']; ?></h2>
					<p><?php echo $fm->textShorten($result['body'], 60); ?></p>
					<p><span class="price">€ <?php echo $result['price']; ?></span></p>
					<div class="align-bottom"><span><a class="btn btn-primary" href="preview.php?proid=<?php echo $result['productId']
					 	; ?>">Details</a></span>
					</div>
				</div>

				<?php } } ?>
			</div>
		</div>
	</div>
</div>

<?php include 'inc/footer.php'; ?>