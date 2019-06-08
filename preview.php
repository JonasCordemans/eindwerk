<?php include 'inc/instances.php';

if (isset($_GET['proid'])){
    $id = $_GET['proid'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	$quantity = $_POST['quantity'];
	$addCart = $ct->addToCart($quantity, $id);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['compare'])) {
	$cmrId = Session::get("cmrId");
	$productId = $_POST['productId'];
	$insertCom = $pd->insertCompareData($productId, $cmrId);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['wlist'])) {
	$cmrId = Session::get("cmrId");
	$saveWlist = $pd->saveWishList($id, $cmrId);
}
	
include 'inc/header.php';

?>

<style>

.mybutton{
	width: 100px; float: left; margin-right: 45px;
}

</style>


 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="cont-desc span_1_of_2">	

				<?php 
				$getPd = $pd->getSingleProduct($id);
					if ($getPd) {
						while ($result = $getPd->fetch_assoc()) {
							
				?>

					<div class="grid images_3_of_2">
						<img src="admin/<?php echo $result['image']; ?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result['productName'];?></h2>
					<hr>			
					<div class="price">
						<p>Prijs:  <span> € <?php echo $result['price'];?></span></p>
						<p>Categorie: <span><?php echo $result['catName'];?></span></p>
						<p>Merk: <span><?php echo $result['brandName'];?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1" min="1" max="999"/>
						<input type="submit" class="btn btn-primary" name="submit" value="Bestellen"/>
					</form>				
				</div>

				<?php 
					if (isset($addCart)) {
						echo $addCart;
					}
				?>

				</span>

				<?php 
					if (isset($insertCom)) {
						echo $insertCom;
					}
				?>

				<?php 
					if (isset($saveWlist)) {
						echo $saveWlist;
					}
				?>

				<?php 
					$login = Session::get("cuslogin");
					if ($login == true) 
					{ 
				?>

				<div class="add-cart">
					<div class="mybutton">
						<form action="" method="post">
							<input type="hidden" class="buyfield" name="productId" value="<?php echo $result['productId'];?>"/>
							<input type="submit" class="btn btn-primary" name="compare" value="Vergelijken"/>
						</form>
					</div>	
					<div class="mybutton">
						<form action="" method="post">
							<input type="submit" class="btn btn-primary" name="wlist" value="Verlanglijst"/>
						</form>		
					</div>
				</div>

				<?php } ?>

				</div>

			<div class="product-desc">
				<h2>Produktomschrijving</h2>
				<?php echo $result['body'];?>
	    	</div>
				<?php } } ?>
				</div>

<!-- Category list -->
<div class="rightsidebar span_3_of_1">
	<h2>CATEGORIEEN</h2>
	<ul>
		<?php 
			$getCat = $cat->getAllCat();
			if ($getCat) {
				while ($result = $getCat->fetch_assoc()) {
		?>

		<li><a href="productbycat.php?catId=<?php echo $result['catId'];?>"><?php echo $result['catName']; ?></a></li>

		<?php }} ?>
	</ul>
</div>
<!-- end of category list -->


 		</div>
	 </div>
		<div class="text-center back">
			<button class="btn btn-primary" onclick="history.go(-1);">TERUG </button>
		</div>
	</div>

	<?php include 'inc/footer.php'; ?>