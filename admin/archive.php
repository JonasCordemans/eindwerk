<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../classes/cart.php');
    $ct = new Cart(); 
    $fm = new Format(); 
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Archief van de bestellingen</h2>

        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Besteldatum</th>
                        <th>Produkt</th>
                        <th>Hoeveelheid</th>
                        <th>Prijs</th>
                        <th>Klant ID</th>
                        <th>Adres</th>
                    </tr>
                </thead>
                <tbody>

<?php

    $getArchive = $ct->getAllArchivedOrders();
    if ($getArchive) {
        while ($result = $getArchive->fetch_assoc()) {
?>

                    <tr class="odd gradeX">
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
                        <td>
                            <a href="customer.php?custId=<?php echo $result['cmrId']; ?>">Adres details</a>
                        </td>
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