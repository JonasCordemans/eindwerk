<div class="header_bottom">

		<div class="header_bottom_left">
			<div class="section group">

    	<div class="content_top">
    		<div>
    		<h3>Categorie nieuwtjes</h3>
    		</div>
    		<div class="clear"></div>
    	</div>

<?php 

//dit gedeelte is voor de laatste van elke brand te tonen in de index.php
$getAcer = $pd->latestFromGin();
if ($getAcer) {
	while ($result = $getAcer->fetch_assoc()) {

?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="preview.php?proid=<?php echo $result['productId']; ?>"> 
						 <img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Gin</h2>
						<p><?php echo $result['productName']; ?></p>
						<p><span class="price">€ <?php echo $result['price']; ?></span></p>
						<div><span><a class="btn btn-primary" href="preview.php?proid=<?php echo $result['productId']; ?>">Details</a></span></div>
				   </div>
			   </div>		
	<?php }} ?>

	<?php 

//dit gedeelte is voor de laatste van elke brand te tonen in de index.php
$getAcer = $pd->latestFromVodka();
if ($getAcer) {
	while ($result = $getAcer->fetch_assoc()) {

?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="preview.php?proid=<?php echo $result['productId']; ?>"> 
						 <img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Vodka</h2>
						<p><?php echo $result['productName']; ?></p>
						<p><span class="price">€ <?php echo $result['price']; ?></span></p>
						<div><span><a class="btn btn-primary" href="preview.php?proid=<?php echo $result['productId']; ?>">Details</a></span></div>
				   </div>
			   </div>		
	<?php }} ?>
			</div>
			<div class="section group">
			<?php 

//dit gedeelte is voor de laatste van elke brand te tonen in de index.php
$getAcer = $pd->latestFromWhiskey();
if ($getAcer) {
	while ($result = $getAcer->fetch_assoc()) {

?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="preview.php?proid=<?php echo $result['productId']; ?>"> 
						 <img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Whiskey</h2>
						<p><?php echo $result['productName']; ?></p>
						<p><span class="price">€ <?php echo $result['price']; ?></span></p>
						<div><span><a  class="btn btn-primary" href="preview.php?proid=<?php echo $result['productId']; ?>">Details</a></span></div>
				   </div>
			   </div>		
	<?php }} ?>		
	<?php 



//dit gedeelte is voor de laatste van elke brand te tonen in de index.php
$getAcer = $pd->latestFromRum();
if ($getAcer) {
	while ($result = $getAcer->fetch_assoc()) {

?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="preview.php?proid=<?php echo $result['productId']; ?>"> 
						 <img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Rum</h2>
						<p><?php echo $result['productName']; ?></p>
						<p><span class="price">€ <?php echo $result['price']; ?></span></p>
						<div><span><a class="btn btn-primary" href="preview.php?proid=<?php echo $result['productId']; ?>">Details</a></span></div>
				   </div>
			   </div>		
	<?php }} ?>
			</div>
		  <div class="clear"></div>
		</div>

	<!-- FlexSlider -->
			 <div class="header_bottom_right_images">

			 <div id="myCarousel" class="carousel slide" data-ride="carousel">

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    
		
		<?php 
						$brand = new Brand();
						$getIm = $brand->getAllImages();
						$itemCount = 0;
						if ($getIm) {
							while($result = $getIm -> fetch_assoc()){
					?>
					<div class="item <?php if ($itemCount === 0) echo 'active' ?>">
      			<img src="admin/<?php echo $result['image']; ?>" alt="...">
					</div>
			<?php $itemCount++; } } ?>
      <div class="carousel-caption"></div>
    
  </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
</div>
			</div>
			

			
			
			<!-- FlexSlider -->
	  <div class="clear"></div>
  </div>	

