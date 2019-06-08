<?php include 'inc/instances.php'; ?>

<?php 
//vermijden dat wnr een gebruiker ingelogd hij nog eens naar de login page kan gaan
$login = Session::get("cuslogin");
if ($login == true) {
	header("Location:order.php");
}

?>


<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {

	$customLogin = $cmr->customerLogin($_POST);
}
?>

<?php include 'inc/header.php'; ?>

<div class="main">
	<div class="content">

<!-- zodra de gebruiker ingelogd is verdwijnt de inlog-form / check user.php voor de SET van cuslogin-->
<?php
$login = Session::get("cuslogin");
if ($login !== true) { ?>


		<div class="login_panel">

<!-- Boodschap of login is gelukt of niet -->
<?php 
if (isset($customLogin)) {
	echo $customLogin;
}
?>
<!-- end -->

<h3>Inloggen</h3>
			<form action="" method="post">
				<input name="email" placeholder="email" type="text">
				<input name="pass" placeholder="paswoord" type="password">
				<div><div><button class="btn btn-primary" name="login">GO</button></div></div>
			</form>

<?php } ?>

		</div>

		<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {

	$customerReg = $cmr->customerRegistration($_POST);
}

?>

<!-- Boodschap of registratie is gelukt of niet -->
<?php 
if (isset($customerReg)) {
	echo $customerReg;
}
?>
<!-- end -->

		<div class="register_account">
			<h3>Nieuwe account</h3>
			<form action="" method="post">
				<table>
					<tbody>
						<tr>
							<td>
								<div>
									<input type="text" name="name" placeholder="Naam" />
								</div>

								<div>
									<input type="text" name="city" placeholder="Stad" />
								</div>

								<div>
									<input type="text" name="zip" placeholder="Postcode" />
								</div>
								<div>
									<input type="text" name="email" placeholder="Email" />
								</div>
							</td>
							<td>
								<div>
									<input type="text" name="address" placeholder="Adres" />
								</div>
								<div>
									<input type="text" name="country" placeholder="Land" />
								</div>

								<div>
									<input type="text" name="phone" placeholder="Telefoonnummer" />
								</div>

								<div>
									<input type="text" name="pass" placeholder="******" />
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="search">
					<div><button class="btn btn-primary" name="register">Account aanmaken</button></div>
				</div>
				<p class="terms">Door een account aan te maken ga je akkoord met de <a href="terms.php">Algemene voorwaarden</a>.</p>
				<div class="clear"></div>
			</form>
		</div>



		
		<div class="clear"></div>
	</div>
</div>

</div>

<?php include 'inc/footer.php'; ?>