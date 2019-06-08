<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>

<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../classes/user.php');
?>

<?php

if (!isset($_GET['custId']) || $_GET['custId'] == NULL){
    echo "<script>window.location = 'mainorder.php'; </script>";
}else{
    $id = $_GET['custId'];
}
?>


<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "<script>window.location = 'mainorder.php'; </script>";
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Klant gegevens</h2>
        <div class="block copyblock">

            <?php 

if(isset($updateCat)) {
    echo $updateCat;
}

?>

            <?php

$cus = new User();
$getCust = $cus->getCustomerData($id);
if ($getCust) {
    while($result = $getCust->fetch_assoc()){
?>

            <form method="post" action="">
                <table class="form">
                    <tr>
                        <td> Naam
                        </td>
                        <td>
                            <input type="text" readonly="readonly" value="<?php echo $result['name'] ;?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td> Adres
                        </td>
                        <td>
                            <input type="text" readonly="readonly" value="<?php echo $result['address'] ;?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                    <tr>
                        <td> Stad
                        </td>
                        <td>
                            <input type="text" readonly="readonly" value="<?php echo $result['city'] ;?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td> Land
                        </td>
                        <td>
                            <input type="text" readonly="readonly" value="<?php echo $result['country'] ;?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td> postcode
                        </td>
                        <td>
                            <input type="text" readonly="readonly" value="<?php echo $result['zip'] ;?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td> Telefoon
                        </td>
                        <td>
                            <input type="text" readonly="readonly" value="<?php echo $result['phone'] ;?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td> email
                        </td>
                        <td>
                            <input type="text" readonly="readonly" value="<?php echo $result['email'] ;?>" class="medium" />
                        </td>
                    </tr>
                    <td>
                        <input type="submit" name="submit" Value="BACK" />
                    </td>
                    </tr>
                </table>
            </form>

            <?php } } ?>
            <!-- hier wordt de if en while loop mee gesloten -->
        </div>
    </div>
</div>

<?php include 'inc/footer.php';?>