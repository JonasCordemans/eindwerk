<?php
include('inc/instances.php');

if (isset($_GET['orderid']) && ($_GET['orderid'] == 'order' )){
    $cmrId = Session::get("cmrId");
    $insertOrder = $ct->orderProduct($cmrId);
    $delData = $ct->delCustomerCart();
    header("Location:success.php");
}

?>

<?php include 'inc/header.php'; ?>

<?php 
//als een gebruiker NIET is ingelogd moet hij naar de login page gaan
$login = Session::get("cuslogin");
if ($login == false) {
	header("Location:login.php");
}

?>

<div class="main">
    <div class="content">
        <div class="section group" style="text-align: center;">
            <img src="./images/underconstruction.png" alt="under construction">
        </div>
        <div class="text-center back">
		    <button class="btn btn-primary" onclick="history.go(-1);">TERUG </button>
	    </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>