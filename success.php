<?php include 'inc/header.php'; ?>

<?php 
//als een gebruiker NIET is ingelogd moet hij naar de login page gaan
$login = Session::get("cuslogin");
if ($login == false) {
	header("Location:login.php");
}

?>

<style>
  .payment {
    width: 500px;
    min-height: 200px;
    text-align: center;
    border: 1px solid #ddd;
    margin: 0 auto;
    padding: 50px;
  }

  .payment h2 {
    border-bottom: 2px solid #ddd;
    margin-bottom: 40px;
    padding-bottom: 10px;
  }

  .payment p {
    line-height: 25px;
  }
</style>

<div class="main">
  <div class="content">
    <div class="section group">

      <div class="payment">
        <h2>Bedankt voor uw bestelling</h2>

<!-- bestelbedrag -->
        <?php 
          $getPayData = $ct->getTotalValueLastOrder();
          if ($getPayData) {
            $price = 0;
            $id = null;
            while ($result = $getPayData->fetch_assoc()) {
              if (!$id) {
                $id = $result['id'];
              }
              $price += $result['price'] * $result['quantity'];
            }
		    ?>

        <p>
          U mag het verschuldigde bedrag van
          <h4><?php echo ($price) . " EUR";?></h4>

          met als betalingsreferentie
          <h4><?php echo "'".$id."'";?></h4>
        </p>

        <?php } ?>
<!-- end besteldbedrag -->

        <?php 
          $getAccData = $ct->accountnumber();
          if ($getAccData) {
            while ($result = $getAccData->fetch_assoc()) {
		    ?>
        overschrijven op het rekeningnummer:
        <h4><?php echo $result['IBAN'];?></h4>
        <?php }} ?>

        <p>
          Hier is een <a href="order.php"> overzicht</a> van je bestellingen.
        </p>

      </div>

    </div>
  </div>
</div>

<?php include 'inc/footer.php'; ?>