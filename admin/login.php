
<!-- we includen de folder met de class Adminlogin. -->
<?php include '../classes/adminlogin.php'; ?>

<?php 


$al = new Adminlogin();
// Returns the request method used to access the page. We gaan na of in onze form we de actie POST hebben.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$adminUser = $_POST['adminUser'];
	$adminPass = md5($_POST['adminPass']);
//de inhoud van de login velden geven we mee als parameter voor de method in de Adminlogin class
	$loginChk = $al->adminLogin($adminUser, $adminPass );
}

?>

<!DOCTYPE html>

<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="../css/style2.css" media="screen" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<!-- end of Boostrap -->

</head>

<body class="fontlogin">
	<div class="container">
		
		<div style="text-align: center">
		<img src="../images/logo_trans2.png" alt="logo" width="300px">
			<h2>Admin Login</h2>
		</div>
		<form class="form-horizontal" action="" method="post">
			<div class="form-group">
				<label class="control-label col-sm-2" for="email">Gebruikersnaam:</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="email" placeholder="John Doe" name="adminUser">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="pwd">Paswoord:</label>
				<div class="col-sm-10">
					<input type="password" class="form-control" id="pwd" placeholder="*****" name="adminPass">
				</div>
			</div>
			<span style="color:red; font-size: 18px;">
				<?php 
					if (isset($loginChk)) {
						echo $loginChk;
					}
					?>
			</span>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</div>
		</form>
	</div>
	<div class="text-center back">
		<button class="btn btn-primary" onclick="history.go(-1);">TERUG </button>
	</div>
</body>

</html>