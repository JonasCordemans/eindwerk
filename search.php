<?php include 'inc/header.php'; ?>

<?php
	if (!isset($_GET['search']) || $_GET['search'] == NULL){
		echo "   U heeft geen zoekterm ingegeven.";
		return;
	}else{
		$search = $_GET['search'];
	}
?>

<div class="main">
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<h3>Zoekresultaten:</h3>
			</div>
			<div class="clear"></div>
		</div>

		<div class="container-fluid">
			<div class="row row-eq-height">

				<?php
					$productbysearch = $pd->productBySearch($search);
					if($productbysearch){
						while ($result = $productbysearch->fetch_assoc()) {
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

						<p><a href="preview.php?proid=<?php echo $result['productId']
			 			; ?>" class="btn btn-primary" role="button">Details</a>
						</p>

					</div>
				</div>

				<?php } } else{ ?>

				<p> Geen producten teruggevonden</p>

				<?php } ?>
			</div>
		</div>
	</div>
</div>


<?php include 'inc/footer.php'; ?>