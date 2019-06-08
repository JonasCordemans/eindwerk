<div class="footer">
	<div class="wrapper">
		<div class="section group">

			<div class="col_1_of_4 span_1_of_4">
				<ul>
					<a href="index.php"><img src="images/logo_trans2.png" alt="boozebaronlogo"></a>
				</ul>
			</div>

			<div class="col_1_of_4 span_1_of_4">
				<h4>Informatie</h4>
				<ul>
					<li><a href="aboutus.php">Over ons</a></li>
					<li><a href="./faq.php">FAQ</a></li>
					<br>
					<!-- <li><a href="./admin/login.php">Admin login</a></li> -->

				</ul>
			</div>

			<div class="col_1_of_4 span_1_of_4">
				<div class="social-icons">
					<h4>Social media</h4>
					<ul>

						<?php
							$brand = new Brand();
							$getsocial = $brand->getSocialById();
							if ($getsocial) {
									while($result = $getsocial->fetch_assoc()){
						?>
						<li class="facebook"><a href="<?php echo $result['fb']; ?>" target="_blank"> </a></li>
						<li class="twitter"><a href="<?php echo $result['tw']; ?>" target="_blank"> </a></li>
						<li class="contact"><a href="<?php echo $result['gp']; ?>" target="_blank"> </a></li>
						<?php }} ?>
						<div class="clear"></div>
					</ul>
				</div>
			</div>

			<div class="col_1_of_4 span_1_of_4">
				<h4>Admin</h4>
				<ul>
					<li><a href="./admin/login.php">Sign In</a></li>
				</ul>
			</div>

		</div>

		<div class="copy_right">
			<?php
                $brand = new Brand();
                $getcopy = $brand->getCopyById();
                if ($getcopy) {
                    while($result = $getcopy->fetch_assoc()){
            ?>

			<p> <a href="https://be.linkedin.com/in/jonas-cordemans-902a9322">
					<?php echo $result['copyright'];?></a></p>

			<?php } } ?>
		</div>
		
	</div>
</div>

<a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
<link href="css/flexslider.css" rel='stylesheet' type='text/css' />
<script defer src="js/jquery.flexslider.js"></script>

</body>

</html>