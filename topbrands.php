<?php 
include 'inc/instances.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['insertcusttoproduct'])) {

	$brand 		= $_POST['brand'];
	$taste 		= $_POST['taste'];
	$volume 	= $_POST['volume'];
	$shape 		= $_POST['shape'];
	$cProduct 	= $brand ."-". $taste."-".$volume."ml-".$shape;

	$quantity 	= $_POST['quantity'];
	$unitprice 	= $_POST['unitprice'];
	$productId 	= '-1';
	$sticker	= $_POST['sticker'];

		$addCustToCart = $ct->addCustToCart($cProduct, $quantity, $unitprice, $productId, $sticker);
	}

include 'inc/header.php';
?>

<script>
	function myFunction() {
		document.getElementById("formreset").reset();
	}
</script>

<div class="main">
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<h3>Stel Je produkt samen</h3>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6">
			<form action="" method="post">
				<div class="form-group">
				
					<label for="fieldBrand">Kies je merk</label>
					<select id="fieldBrand" name="brand" class="form-control">
						<option>Kies</option>
						<?php
							$brand = new Product();
							$getBrand = $brand->getCustomBrands();
							if ($getBrand) {
								while($result = $getBrand->fetch_assoc()){
            			?>

						<option value="<?php echo $result['brand'];?>"><?php echo $result['brand'];?></option>

						<?php } } ?>

					</select>
					<br>
					<div id="fieldTaste" style="display:none">
						<label for="selectNumber">Nu de smaak</label>
						<select id="selectNumber" name="taste" class="form-control">
							<option>Kies</option>
						</select>
						<br>
					</div>

					<div id="fieldShape" style="display:none">
						<label for="vak3selection">De vorm van de fles</label>
						<select id="vak3selection" name="shape" class="form-control">
							<option>Kies</option>
							<?php
								$brand = new Product();
								$getShape = $brand->getCustomShape();
								if ($getShape) {
									while($result = $getShape->fetch_assoc()){
							?>

							<option value="<?php echo $result['shape'];?>"><?php echo $result['shape'];?></option>

							<?php } } ?>


						</select>
						<br>
					</div>

					<div id="fieldVolume" style="display:none">
						<label for="selectvolume">de inhoud van een flesje</label>
						<select id="selectvolume" name="volume" class="form-control">
							<option>Kies</option>
						</select>
						<br>
					</div>

					<div id="fieldSticker" style="display:none">
						<label for="vak4selection">Sticker (max 15 tekens)</label>
						<input type="text" id="fieldSticker" class="form-control" maxlength="15" name="sticker">
					</div>
					<br>
					<div id="fieldQuantity" style="display:none">
						<label for="vak5selection">Aantal</label>
						<input type="number" class="form-control" value="1" min="1" max="1000" name="quantity">
						<br>
						<input id="custprodbereken" class="btn btn-primary" type="submit" name="bereken"
							value="Bereken">
					</div>

				</div>
			</form>
		</div>

<?php

	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['bereken'])) {

	$brand 		= $_POST['brand'];
	$taste 		= $_POST['taste'];
	$volume 	= $_POST['volume'];
	$shape 		= $_POST['shape'];

	if ($_POST['sticker'] == null) {
		$sticker = "geen sticker gekozen";
	}else{
		$sticker = $_POST['sticker'] ;
	}
	
	$unitprice 	= 0;
	$quantity 	= $_POST['quantity'];
	if ($volume == '100') {
		$unitprice = 1;
	}elseif ($volume == '200') {
		$unitprice = 2;
	}else {
		$unitprice = 5;
	}
	
?>

	<div class="col-md-6">
		<form action="" method="post" id="formreset">
			<h3>Samenvatting: </h3>
			<input type="hidden" name="brand" value="<?php echo $brand ?>" />
			<input type="hidden" name="taste" value="<?php echo $taste ?>" />
			<input type="hidden" name="volume" value="<?php echo $volume ?>" />
			<input type="hidden" name="shape" value="<?php echo $shape ?>" />
			<input type="hidden" name="quantity" value="<?php echo $quantity ?>" />
			<input type="hidden" name="unitprice" value="<?php echo $unitprice ?>" />
			<!-- test -->
			<input type="hidden" name="sticker" value="<?php echo $sticker ?>" />
			<!-- end test -->

			<p>Merk: 			<?php echo $brand; 					?></p>
			<p>Smaak: 			<?php echo $taste; 					?></p>
			<p>Vorm: 			<?php echo $shape; 					?></p>
			<p>Inhoud: 			<?php echo $volume; 				?> ml </p>
			<p>Aantal: 			<?php echo $quantity; 				?></p>
			<p>Stukprijs: 		<?php echo $unitprice; 				?> EUR </p>
			<p>Totale prijs: 	<?php echo $quantity * $unitprice; 	?> EUR</p>

			<div class="form-group">
				<label for="exampleFormControlTextarea1">Opmerkingen:</label>
				<textarea class="form-control" name="remarkfield"
					rows="3"><?php echo "Stickertekst: ". $sticker; 	?></textarea>
			</div>
			<input class="btn btn-primary" type="submit" name="insertcusttoproduct"
				value="Toevoegen aan winkelmandje">
			<input class="btn btn-primary" type="submit" onclick="myFunction()" value="Herbeginnen">
		</form>
		<br>
	</div>

	</div>

	<?php } 


		if (isset($addCustToCart)) {
			echo $addCustToCart;
		}
	?>

</div>
</div>

<?php include 'inc/footer.php'; ?>