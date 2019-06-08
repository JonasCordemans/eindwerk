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
//indien user niet is ingelogd -> terug naar login.php
$login = Session::get("cuslogin");
if ($login == false) {
	header("Location:login.php");
}

?>

<style>

.division{
        width: 50%;
        float: left;
}
.tblone{
        width: 550px; margin: 0 auto; border: 2px solid #ddd;
}
.tblone tr td{
        text-align: justify;
}
.tbltwo{
        float: right;
        text-align: left;
        width: 50%;
        border: 2px solid #ddd;
        margin-right: 14px;
        margin-top: 12px;
}
.tbltwo tr td{
        text-align: justify;
        padding: 5px 10px;
}
.ordernow{

}
.ordernow a{
    width: 150px; 
    margin: 5px auto 0;
    padding: 7px 0;
    text-align: center;
    display: block;
    background: grey;
    border: 1px solid #333;
    color: #fff;
    border-radius: 3px;
    font-size: 25px;
    margin-bottom: 40px;
}


</style>
 <div class="main">
    <div class="content">
        <div class="section group">
    <div class="division">
    <table class="tblone">
        <tr>
            <th>Id</th>
            <th>Produkt</th>
            <th>Stuk prijs</th>
            <th>Hoeveelheid</th>
            <th>Totaal </th>
            <th>Opmerkingen </th>
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
            <td>
                <?php echo $i ;?>
            </td>
            <td>
                <?php echo $result['productName'] ;?>
            </td>
            <td>
                € <?php echo $result['price'] ;?>
            </td>
            <td>
                <?php echo $result['quantity'] ;?>
            </td>
            <td>
            € <?php 
                $total = $result['price'] * $result['quantity'];
                echo $total;
            ?>            
            </td>
            <td>
                Stickertekst: <?php echo $result['remarks'] ;?>
            </td>
        </tr>

        <?php
            $qty = $qty + $result['quantity']; //we beginnen met "0" en voegen daar het aantal aan toe die ophalen uit de databank
            $sum = $sum + $total;
        ?>
        <?php } } ?>

    </table>
    <table class="tbltwo">
        <tr>
            <th>Te betalen : </th>
            <td>€
                <?php 
                    echo(round($sum,2));
                ?>
            </td>
        </tr>
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
                    $incBtw = $sum - $vat;
                    echo(round($incBtw,2));
                ?>
            </td>
        </tr>
        <tr>
            <th>Quantity :</th>
            <td>
                <?php echo $qty; ?>
            </td>
        </tr>
    </table>

    </div>
    <div class="division">

    <?php
        $id = Session::get('cmrId');
        $getdata = $cmr->getCustomerData($id);
        if ($getdata) {
            while ($result = $getdata->fetch_assoc()) {
    ?>

<table class="tblone">
    <tr>
        <td colspan="3"><h2>Jouw Gegevens</h2></td>
    </tr>
    <tr>
        <td width="20%">Name</td>
        <td width="5%">:</td>
        <td><?php echo $result['name'];?></td>
    </tr>
    <tr>
        <td>Phone</td>
        <td>:</td>
        <td><?php echo $result['phone'];?></td>
    </tr>
    <tr>
        <td>Email</td>
        <td>:</td>
        <td><?php echo $result['email'];?></td>
    </tr>
    <tr>
        <td>Address</td>
        <td>:</td>
        <td><?php echo $result['address'];?></td>
    </tr>
    <tr>
        <td>City</td>
        <td>:</td>
        <td><?php echo $result['city'];?></td>
    </tr>
    <tr>
        <td>Zipcode</td>
        <td>:</td>
        <td><?php echo $result['zip'];?></td>
    </tr>
    <tr>
        <td>Country</td>
        <td>:</td>
        <td><?php echo $result['country'];?></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td><a href="editprofile.php">Update gegevens</a></td>
    </tr>
</table>

    <?php } } ?>
    </div>

    </div>
 </div>
 <div class="container">
        <p><a href="?orderid=order" class="btn btn-primary" role="button">Bestelling plaatsen</a></p>
 </div>
</div>

<?php include 'inc/footer.php'; ?>