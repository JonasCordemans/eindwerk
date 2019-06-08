﻿<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>

            <?php
                $brand = new Brand();
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $fb = $_POST['fb'];
                    $tw = $_POST['tw'];
                    $ig = $_POST['gp'];

                    $updateSocial = $brand->socialUpdate($fb, $tw, $ig);
                }
            ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Social Media</h2>
        <div class="block"> 

        <?php
        if (isset($updateSocial)){
            echo $updateSocial;
        }
        ?>

        <?php
                $brand = new Brand();
                $getsocial = $brand->getSocialById();
                if ($getsocial) {
                    while($result = $getsocial->fetch_assoc()){
            ?>

         <form action="" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <label>Facebook</label>
                    </td>
                    <td>
                        <input type="text" name="fb" value="<?php echo  $result['fb'];?>" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>Twitter</label>
                    </td>
                    <td>
                        <input type="text" name="tw" value="<?php echo  $result['tw'];?>" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>Instagram</label>
                    </td>
                    <td>
                        <input type="text" name="gp" value="<?php echo  $result['gp'];?>" class="medium" />
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