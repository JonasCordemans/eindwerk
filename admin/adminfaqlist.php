<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>

<?php 
 $brand =  new Brand(); 
 
 if(isset($_GET['delfaq'])){
	 $id = $_GET['delfaq'];
	 $delfaq = $brand->delFaqById($id);
 }

?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>FAQ List</h2>
		<div class="block">
		<?php 
		
		if(isset($delfaq)){
			echo $delfaq;
		}
		
		?>
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th></th>
						<th>Question</th>
						<th>Answer</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$getFaq = $brand->getAllFaq();
						if($getFaq){
							$i = 0;
							while ($result = $getFaq->fetch_assoc()) {
							$i++;
					?>

					<tr class="odd gradeX">
						<td><?php echo $i; ?></td>
						<td><?php echo $result['question']; ?></td>
						<td><?php echo $result['answer']; ?></td>
						<td><a href="adminfaqedit.php?faqid=<?php echo $result['faqid']; ?>">Edit</a> 
							|| <a onclick="return confirm('Ben je zeker?')" href="?delfaq=<?php echo $result['faqid']; ?>">Delete</a></td>
					</tr>
					<?php } } ?>

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