<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
 $filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../classes/cart.php');
$ct = new Cart(); // added Cart Class object 
$fm = new Format(); // added Cart Format object 
?>

<?php 
 if (isset($_GET['shiftid'])) {
 	$id = $_GET['shiftid'];
 	$price = $_GET['price'];
 	$time = $_GET['time'];
 	$shift = $ct->productShifted($id,$time,$price);
 
 }

 if (isset($_GET['delproid'])) {
    $id = $_GET['delproid'];
    $price = $_GET['price'];
    $time = $_GET['time'];
    $prodline = $_GET['id'];
    // 1. moven van tbl_order naar tbl_order_history
    $moveOrder = $ct->movedToHistory($prodline);
    // 2. verwijderen van de lijn uit de lopendebestellingen
    $delOrder = $ct->delProductShifted($id,$time,$price);

}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Bestellingen</h2>

        <?php

if(isset($shift)){
    echo $shift;
}

if(isset($delOrder)){
    echo $delOrder ;
}

if(isset($moveOrder)){
    echo $moveOrder ;
}



?>

        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Besteldatum</th>
                        <th>Produkt</th>
                        <th>Hoeveelheid</th>
                        <th>Prijs</th>
                        <th>Klant ID</th>
                        <th>Adres</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

$getOrder = $ct->getAllOrderProduct();
if ($getOrder) {
    while ($result = $getOrder->fetch_assoc()) {
?>

                    <tr class="odd gradeX">
                        <td>
                            <?php echo $result['id'] ;?>
                        </td>
                        <td>
                            <?php echo $fm->formatDate($result['date']) ;?>
                        </td>
                        <td>
                            <?php echo $result['productName'] ;?>
                        </td>
                        <td>
                            <?php echo $result['quantity'] ;?>
                        </td>
                        <td>
                            <?php echo $result['price'] ;?>
                        </td>
                        <td>
                            <?php echo $result['cmrId'] ;?>
                        </td>
                        <td><a href="customer.php?custId=<?php echo $result['cmrId']; ?>">Adres details</a></td>


                        <?php if ($result['status'] == '0') { ?>
                        <td><a href="?shiftid=<?php echo $result['cmrId']; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date']; ?>">Pending betaling</a></td>
                        <?php	} else {    ?>
                        <td><a href="?delproid=<?php echo $result['cmrId']; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date']; ?>&id=<?php echo $result['id']; ?>">Verwijder</a></td>
                        <?php } ?>

                    </tr>
                    <?php } }?>



                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>