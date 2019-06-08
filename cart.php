<?php include 'inc/instances.php'; ?>
<?php 
	if (isset($_GET['delpro'])) {
		$delId =$_GET['delpro'];
		$delProduct = $ct->delProductByCart($delId);
	}
?>

<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$cartId = $_POST['cartId'];
		$quantity = $_POST['quantity'];

		$updateCart = $ct->updateCartQuantity($cartId, $quantity);
		if ($quantity <= 0) {
			$delProduct = $ct->delProductByCart($cartId);
		}
	}
?>

<?php include 'inc/header.php'; ?>

<div class="main">
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<h3>Winkelkar</h3>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>

    	<div class="cartoption">		
			<div class="cartpage">
				<?php 
					if(isset($updateCart)){
						echo $updateCart;
					}

					if(isset($delProduct)){
						echo $delProduct;
					}
				?>
				<table class="tblone">
					<tr>
						<th width="5%">Serial</th>
						<th width="25%">Produkt</th>
						<th width="10%"></th>
						<th width="10%">Stuk prijs</th>
						<th width="10%">Hoeveelheid</th>
						<th width="15%">Totale prijs </th>
						<th width="15%">Opmerkingen </th>
						<th width="10%">Verwijder</th>
					</tr>



					<?php 
						$getPro = $ct->getCartProduct();
						if ($getPro) {
							$i = 0;
							$sum = 0; //voor het tonen van de totale waarde in de header -> winkelkarretje
							$qty = 0; //voor het tonen van het aantal unieke producten in uw winkelkar symbool
							while ($result = $getPro->fetch_assoc() ) {
								$i++;
					?>
					<tr>
						<td><?php echo $i ;?></td>
						<td><?php echo $result['productName'] ;?></td>
						<td><img src="admin/<?php echo $result['image'] ;?>" alt=""/></td>
						<td>€ <?php echo $result['price'] ;?></td>
						<td>
						<form action="" method="post">
							<input type="hidden" name="cartId" value="<?php echo $result['cartId']; ?>"/>
							<input type="number" name="quantity" min="1" max="999" value="<?php echo $result['quantity']; ?>"/>
							<input type="submit" name="submit" value="Update"/>
						</form>
						</td>
						<td>€ 
						<?php 

						$total = $result['price'] * $result['quantity'];
						echo(round($total,2));

						?>
						
						</td>




						<td>Stickertekst: <?php echo $result['remarks'] ;?></td>





						<td><a onclick="return confirm('Wil je dit item echt verwijderen?');" href="?delpro=<?php echo $result['cartId'];?>">X</a></td>
					</tr>
					<?php
						$qty = $qty + $result['quantity']; //we beginnen met "0" en voegen daar het aantal aan toe die ophalen uit de databank
						$sum = $sum + $total;
						Session::set("sum", $sum); //Shopping cart totale waarde - creeeren GET method
					?>
					<?php } } ?> <!-- end of while loop -->

				</table>

						<?php 
							//deze if condition moet erbij, anders krijg je "undefined variable: sum"
							$getData = $ct->checkCartTable();
							if ($getData) { //als uw karretje NIET leeg is worden de totalen berekend
						?>

						<table style="float:right;text-align:left;" width="40%">
						<tr>
								<th>BTW (21%) </th>
								<td>€
								<?php 

								$vat = $sum * 0.21;
								echo(round($vat,2));

								?>
								</td>
							</tr>
						<tr>
								<th>Excl. BTW :</th>
								<td>€  
								<?php 

								$excBtw = $sum - $vat;
								echo(round($excBtw,2));

								?>
								</td>
							</tr>

							<tr>
								<th>Bedrag : </th>
								<td>€
								<?php 

								echo(round($sum,2));

								?>
								</td>
							</tr>


					   </table>

						<?php } else{
							Echo "Er zit niets in je winkelmand";
						} ?>

			</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
</div>

    <a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
</body>
</html>

<?php include 'inc/footer.php'; ?>