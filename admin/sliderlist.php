<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>

<?php 
 $brand =  new Brand();
 
 if(isset($_GET['delslide'])){
	 $id = $_GET['delslide'];
	 $delBrand = $brand->delSlideById($id);
 }

?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>No.</th>
					<th>Slider Title</th>
					<th>Slider Image</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>

			<?php 
			$brand = new Brand();
			$getIm = $brand->getAllImages();
			if ($getIm) {
				$i = 0;
				while($result = $getIm -> fetch_assoc()){
					$i++;
			?>

				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['title']; ?></td>
					<td><img src="<?php echo $result['image'];?>" height="40px" width="60px"/></td>				
				<td>
				<a onclick="return confirm('Ben je zeker?')" href="?delslide=<?php echo $result['id']; ?>">Delete</a> 
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
