<?php
  include('inc/instances.php');

  $login = Session::get("cuslogin");
  if ($login == false) {
    header("Location:login.php");
  }

?>

<?php include 'inc/header.php'; ?>

<div class="main">
  <div class="content">
    <div class="section group">
        <div class="payment">
            <h2>Kies betalingsmethode</h2>
            <p><a href="offline.php" class="btn btn-primary" role="button">Offline Betalen</a></p>
            <p><a href="underconstruction.php" class="btn btn-primary" role="button">Online Betalen</a></p>
        </div>
        <div class="text-center back">
		      <button class="btn btn-primary" onclick="history.go(-1);">TERUG </button>
	      </div>
    </div>
  </div>
</div>

<?php include 'inc/footer.php'; ?>