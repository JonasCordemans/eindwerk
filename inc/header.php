<?php
	if (!class_exists("Session")) {
		include 'inc/instances.php';
	}
?>

<!DOCTYPE HTML>

<head>
	<title>BoozeBaron</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="css/style2.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/menu.css" rel="stylesheet" type="text/css" media="all" />
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

	<script>
		$(document).ready(function () {

			$("#fieldBrand").change(function () {
				var selection1 = ($(this).val());
				if (selection1 == "Gin") {
					$("#selectNumber").append(
						"<option value='Sinaas'>Sinaas</option>",
						"<option value='Cactus'>Cactus</option>", 
						"<option value='Kiwi'>Kiwi</option>");
				} else if (selection1 == "Wodka") {
					$("#selectNumber").append(
						"<option value='Cactus'>Cactus</option>",
						"<option value='Kiwi'>Kiwi</option>");
				} else if (selection1 == "Jenever") {
					$("#selectNumber").append(
						"<option value='Kiwi'>Kiwi</option>");
				} else if (selection1 == "Rum") {
					$("#selectNumber").append(
						"<option value='Sinaas'>Sinaas</option>");
				} else if (selection1 == "Tequila") {
					$("#selectNumber").append(
						"<option value='Cactus'>Cactus</option>");
				} else {
					$("#selectNumber").append(
						"<option value='notfound'>Deze combinatie is niet mogelijk</option>");
				}
					$('#fieldTaste').show();
			});

			$("#fieldTaste").change(function () {
				$('#fieldShape').show();
			});

			$("#vak3selection").change(function () {
				var selection3 = ($(this).val());
				if (selection3 == "Rond") {
					$("#selectvolume").append(
						"<option value='100'>100 ml (1 EUR/stuk) </option>",
						"<option value='200'>200 ml (2 EUR/stuk)</option>", 
						"<option value='500'>500 ml (5 EUR/stuk)</option>");
				} else if (selection3 == "Ovaal") {
					$("#selectvolume").append(
						"<option value='100'>100 ml (1 EUR/stuk)</option>",
						"<option value='500'>500 ml (5 EUR/stuk)</option>");
				} else if (selection3 == "Rechthoekig") {
					$("#selectvolume").append(
						"<option value='200'>200 ml (2 EUR/stuk)</option>");
				} else {
					$("#selectvolume").append(
						"<option value='100'>100 ml (1 EUR/stuk)</option>");
				}
					$('#fieldVolume').show();
			});

			$("#selectvolume").change(function () {
				$('#fieldSticker').show();
			});

			$("#fieldSticker").change(function () {
				$('#fieldQuantity').show();
			});

		});
	</script>
</head>

<body class="font">

	<div>
		<div class="header_top background">
			<div class="logo">
				<a href="index.php"><img src="images/logo_trans2.png" alt="" /></a>
			</div>

			<!-- Ophalen van de quote uit de databank -->
			<?php
                $brand = new Brand();
                $getQuote = $brand->getQuoteById();
                if ($getQuote) {
                    while($result = $getQuote->fetch_assoc()){
            ?>

			<h4 class="align white">
				<?php echo $result['quote'];?>
			</h4>
			<h6 class="align white"><i>"
					<?php echo $result['quoteby'];?>"</i></h6>

			<?php } } ?>
			<!-- end -->

			<div class="header_top_right">
				<div class="shopping_cart">
					<div class="btn btn-default">
						<a href="#" title="View my shopping cart" rel="nofollow">
							<span class="cart_title">Winkelkar</span>
							<span class="no_product">

								<?php
								$getData = $ct->checkCartTable();
								if ($getData) {
									echo $ct->getCartQuantity();
								}

								?>

							</span>
						</a>
					</div>
				</div>

				<!-- als ge op logout drukt krijg je de session = cid en wordt de session destroyed -->
				<?php 
					if (isset($_GET['cid'])) {
						$cmrId = Session::get("cmrId");
						$delData = $ct->delCustomerCart();
						$delComp = $pd->delCompareData($cmrId);
						Session::destroyUser();
					}
				?>
				<!-- end -->

				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>

		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
						data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.php">Home</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a href="products.php" class="dropdown-toggle" data-toggle="dropdown" role="button"
								aria-haspopup="true" aria-expanded="false">Produkten <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="products.php">Alle produkten</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="topbrands.php">Produkt op maat</a></li>
							</ul>
						</li>

						<!-- alleen als er al iets in je cart zit is de knop CART/betalen in de balk beschikbaar -->
						<?php 
							$chkCart = $ct->checkCartTable();
								if ($chkCart) { 
						?>
						<li><a href="cart.php">Winkelkar</a></li>
						<li><a href="payment.php">Betalen</a></li>
						<?php } ?>

						<!-- alleen als de customer al bestelling heeft gedaan mag de knop bestellingen beschikbaar zijn -->
						<?php 
							$cmrId = Session::get("cmrId");
							$chkOrder = $ct->checkOrder($cmrId);
								if ($chkOrder) { 
						?>
						<li><a href="order.php">Bestellingen</a></li>
						<?php } ?>

						<!-- alleen als hij ingelogd is kan hij zijn profiel opvragen: 'knop profile is beschikbaar' / check user.php voor de SET van cuslogin-->
						<?php
							$login = Session::get("cuslogin");
								if ($login == true) { 
						?>
						<li><a href="profile.php">Profiel</a></li>
						<?php } ?>

						<!-- alleen als er iets in de compare zit mag de COMPARE knop zichtbaar zijn -->
						<?php
							$cmrId = Session::get("cmrId");
							$getPd = $pd->getCompareProduct($cmrId);
								if ($getPd) {
						?>
						<li><a href="compare.php">Vergelijk</a> </li>
						<?php } ?>

						<!-- alleen als er iets in de wishlist zit mag de WISHLIST knop zichtbaar zijn -->
						<?php
							$checkwlist = $pd->checkWlistData($cmrId);
								if ($checkwlist) {
						?>
						<li><a href="wishlist.php">Verlanglijst</a> </li>
						<?php } ?>

						</form>
						<ul class="nav navbar-nav navbar-right">

						<!-- Als een gebruiker ingelogd is veranderd de LOGIN knopnaar een LOGOUT knop -->
						<?php 
							$login = Session::get("cuslogin");
								if ($login == false) { 
						?>
						<a href="login.php"><button type="button"
								class="btn btn-default navbar-btn">Login</button></a>
						<?php }else{ ?>
						<a href="?cid=<?php Session::get('cmrId');?>"><button type="button"
								class="btn btn-default navbar-btn">Logout</button></a>
						<?php } ?>

							<li><a href="contact.php">Contact</a></li>
						</ul>
						<form class="navbar-form navbar-left" action="search.php" method="get">
							<div class="form-group">
								<input type="text" name="search" class="form-control" placeholder="Zoeken">
								<!-- <button type="submit" value="SEARCH" class="btn btn-default">Submit</button> -->
								<button type="submit" value="SEARCH" class="btn btn-default"><img src="./images/searchicon.png" height="20px" alt="searchicon"></button>
							</div>
						</form>
						
				</ul>
			</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
	</nav>