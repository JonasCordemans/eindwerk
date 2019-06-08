<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>

            <?php
                $companyInfo = new Brand();
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $cname      = $_POST['cname'];
                    $caddress   = $_POST['caddress'];
                    $czip       = $_POST['czip'];                 
                    $ccity      = $_POST['ccity'];
                    $ccountry   = $_POST['ccountry'];
                    $cemail     = $_POST['cemail'];                 
                    $cphone     = $_POST['cphone'];
                    $cfax       = $_POST['cfax'];
                    $vat        = $_POST['cvat'];

                    $updateCompanyInfo = $companyInfo->CompanyUpdate($cname, $caddress, $czip, $ccity, $ccountry, $cemail, $cphone, $cfax, $vat);
                }
            ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Company Information</h2>
        <div class="block"> 

        <?php
        if (isset($updateCompanyInfo)){
            echo $updateCompanyInfo;
        }
        ?>

        <?php
                //we loopen door de databank gegevens en wijzen ze toe aan de velden van de form
                $companyInfo = new Brand();
                $getcompanyInfo = $companyInfo->getcompanyInfo();
                if ($getcompanyInfo) {
                    while($result = $getcompanyInfo->fetch_assoc()){
            ?>

         <form action="" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="cname" value="<?php echo  $result['name'];?>" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>Address</label>
                    </td>
                    <td>
                        <input type="text" name="caddress" value="<?php echo  $result['address'];?>" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>ZIP</label>
                    </td>
                    <td>
                        <input type="text" name="czip" value="<?php echo  $result['zip'];?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>City</label>
                    </td>
                    <td>
                        <input type="text" name="ccity" value="<?php echo  $result['city'];?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Country</label>
                    </td>
                    <td>
                        <input type="text" name="ccountry" value="<?php echo  $result['country'];?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input type="text" name="cemail" value="<?php echo  $result['email'];?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Phone</label>
                    </td>
                    <td>
                        <input type="text" name="cphone" value="<?php echo  $result['phone'];?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Fax</label>
                    </td>
                    <td>
                        <input type="text" name="cfax" value="<?php echo  $result['fax'];?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>VAT</label>
                    </td>
                    <td>
                        <input type="text" name="cvat" value="<?php echo  $result['vat'];?>" class="medium" />
                    </td>
                </tr>
				
				 <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>

                    <?php }} ?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>