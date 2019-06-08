<?php 
include 'inc/instances.php';

//als een gebruiker NIET is ingelogd moet hij naar de login page gaan
$login = Session::get("cuslogin");
if ($login == false) {
	header("Location:login.php");
}

include 'inc/header.php';
?>

 <div class="main">
    <div class="content">
	

<div class="section group">

<div class="notfound">

<h2>
    <span>Uw lopende bestellingen</span>
</h2>

<table class="tblone">
    <tr>
        <th>Serial</th>
        <th>Produkt</th>
        <th></th>
        <th>Hoeveelheid</th>
        <th>Totale prijs </th>
        <th>Status </th>
        <th>Bestel datum </th>
        <th>Verwijder</th>
    </tr>

    <?php 
        $cmrId = Session::get("cmrId");
        $getOrder = $ct->getOrderProduct($cmrId);
        if ($getOrder) {
        $i = 0;
        while ($result = $getOrder->fetch_assoc() ) {
            $i++;
    ?>
        <tr>
            <td><?php echo $i ;?></td>
            <td><?php echo $result['productName'] ;?></td>
            <td><img src="admin/<?php echo $result['image'] ;?>" alt=""/></td>
            <td><?php echo $result['quantity'] ;?></td>
            <td>€ 
                <?php 
                    $total = $result['price'] * $result['quantity'];
                    echo $total;
                ?>
            </td>
            <td>
                <?php 
                    if ($result['status'] == '0') {
                        echo "In behandeling";
                    }else{
                        echo "Verstuurd";
                    }
                ?>
            </td>
            <td>
                <?php echo $fm->formatDate($result['date']) ;?>
            </td>
            <?php
                if ($result['status'] == '1') { ?>
                    <td><a onclick="return confirm('Wil je dit item echt verwijderen?');" href="">X</a></td>
                <?php } else{ ?>
                    <td>N/A</td>
            <?php } ?>
        </tr>
         
         <?php } } ?>

</table>

</div>

</div>

<div class="text-center back">
	<button class="btn btn-primary" onclick="history.go(-1);">TERUG </button>
</div>

<div class="clear"></div>
    </div>
 </div>
</div>

<?php include 'inc/footer.php'; ?>