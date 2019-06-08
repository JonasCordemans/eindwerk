<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>

<?php
    
    if (!isset($_GET['faqid']) || $_GET['faqid'] == NULL){
        echo "<script>window.location = 'adminfaqlist.php'; </script>";
    }else{
        $id = $_GET['faqid'];
    }
?>


<?php
    $brand = new Brand();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $question = $_POST['question'];
        $answer = $_POST['answer'];
        $updateFaq = $brand->faqUpdate($question, $answer, $id);
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update FAQ</h2>
        <div class="block copyblock">

            <?php 
                if(isset($updateFaq)) {
                    echo $updateFaq;
            }
            ?>

            <?php
                $getFaq = $brand->getFaqUpdateById($id);
                if ($getFaq) {
                    while($result = $getFaq->fetch_assoc()){
            ?>

            <form method="post" action="">
                <table class="form">
                    <tr>
                        <td>
                            <h4>Vraag</h4>
                            <input type="text" name="question" value="<?php echo $result['question'] ;?>" class="medium" />
                        </td>
                    </tr>
                    <td>
                        <h4>Antwoord</h4>
                        <input type="text" name="answer" value="<?php echo $result['answer'] ;?>" class="medium" />
                    </td>
                    <tr>
                        <td>
                            <input type="submit" name="update" Value="Update" />
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