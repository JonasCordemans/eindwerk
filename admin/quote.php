<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>

            <?php
                $brand = new Brand();
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $quote = $_POST['quote'];
                    $quoteBy = $_POST['quoteBy'];
                    $updateQuote = $brand->quoteUpdate($quote, $quoteBy);
                }
            ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update header quote</h2>
        <div class="block copyblock">

        <?php 
            if(isset($updateQuote)) {
                echo $updateQuote;
            }
        ?>

            <?php
                $brand = new Brand();
                $getquote = $brand->getQuoteById();
                if ($getquote) {
                    while($result = $getquote->fetch_assoc()){
            ?>

            <form action="" method="post">
                <table class="form">
                    <tr>
                        <td>
                            <h4>Quote</h4>
                            <input type="text" value="<?php echo $result['quote'];?>" name="quote" class="large" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h4>By</h4>
                            <input type="text" value="<?php echo $result['quoteby'];?>" name="quoteBy" class="large" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="submit" name="submit" Value="Update" />
                        </td>
                    </tr>
                </table>
            </form>

                    <?php } } ?>

        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>