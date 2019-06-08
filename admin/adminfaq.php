<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>

            <?php
                $brand = new brand();
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $question = $_POST['question'];
                    $answer = $_POST['answer'];
                    $questionAdd = $brand->questionAdd($question, $answer);
                }
            ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add a FAQ</h2>
        <div class="block copyblock">

        <?php 
            if(isset($questionAdd)) {
                echo $questionAdd;
            }
        ?>

            <form action="" method="post">
                <table class="form">
                    <tr>
                        <td>
                            <h4>Question</h4>
                            <input type="text"  name="question" class="large" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h4>Answer</h4>
                            <input type="text"  name="answer" class="large" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" Value="Add" />
                        </td>
                    </tr>
                </table>
            </form>

        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>