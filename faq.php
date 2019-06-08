<?php include_once './inc/header.php'; ?>
<?php include_once './classes/product.php'; ?>


<div class="main">
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<h3>FAQ</h3>
				<h6>Alvorens ons te contacteren gelieve eerst eens door de meest gesteld vragen te scrollen</h6>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>

<div class="container">

	<?php 
$getFaq = $pd->getAllQuestions();
if ($getFaq) {
	while($result = $getFaq -> fetch_assoc()){
?>
	<div class="row">
		<div>
			<h4>
				<?php echo $result['question']; ?>
			</h4>
			<h6>
				<?php echo $result['answer']; ?>
			</h6>
			<hr>
		</div>
	</div>
	<?php } } ?>

</div>

<?php include 'inc/footer.php'; ?>