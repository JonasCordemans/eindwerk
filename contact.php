<?php include 'inc/header.php'; ?>

<?php
    // Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
?>

<!-- Als er een post method is en de knop submit is ingedrukt -->
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        // er wordt een variabele aangemaakt met een methode in de user klasse
        $contactMail = $cmr->customerMail($_POST);
    }
?>
<!-- end -->

<!-- Boodschap of verzend mail is gelukt of niet -->
<div class="success">
    <?php 
    if (isset($contactMail)) {
        echo $contactMail;
    }
?>
</div>

<!-- end -->

<div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		    <h3>Contacteer ons</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
    </div>
 </div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <form action="" method="POST">
                <div class="form-group">
                    <label class="radio-inline">
                        <input type="radio" name="gender" id="gender1" value="Mvr" checked="checked"> Mvr.
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="gender" id="gender2" value="Mr"> Mr.
                    </label>
                </div>
                <div class="form-group">
                    <label for="Naam">Naam:</label>
                    <input type="text" class="form-control" id="naam" placeholder="naam" name="naam">
                </div>
                <div class="form-group">
                    <label for="Voornaam">Voornaam:</label>
                    <input type="text" class="form-control" id="voornaam" placeholder="voornaam" name="voornaam"
                        >
                </div>
                <div class="form-group">
                    <label for="Email">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="E-mail" name="email">
                </div>
                <div class="form-group">
                    <label for="Telefoon">Telefoon:</label>
                    <input type="tel" class="form-control" id="telefoon" placeholder="telefoon" name="telefoon">
                </div>
                <div class="form-group">
                    <label for="Bericht">Bericht:</label>
                    <textarea class="form-control" name="textarea" rows="3"></textarea>
                    <br>
                    <label for="checkbox"> Ik wil mij inschrijven op de nieuwsbrief:</label>
                    
                    <!-- added another checkbox to avoid "Undefined index: checkbox", if checkbox not check it will pass the value of the hidden one-->
                    <input  type="hidden" name="checkbox"  value="">
                    <!--  -->
                    <input type="checkbox" name="checkbox" value="true"><br>
                    <br>
                    <button type="submit" name="submit" class="btn btn-primary">Verzenden</button>
                </div>  
            </form>
        </div>

        <div class="col-md-6">
            <!--The div element for the map -->
            <div id="map">
                <script>
                    // Initialize and add the map
                        function initMap() {
                            // The location of Uluru
                            var uluru = {lat: 50.963350, lng: 4.625685};
                            // The map, centered at Uluru
                            var map = new google.maps.Map(
                                document.getElementById('map'), {zoom: 15, center: uluru}
                            );
                            // The marker, positioned at Uluru
                            var marker = new google.maps.Marker({position: uluru, map: map});
                        }
                </script>
                <!-- Load the API from the specified URL
                        * The async attribute allows the browser to render the page while the API loads
                        * The key parameter will contain your own API key (which is not needed for this tutorial)
                        * The callback parameter executes the initMap() function
                        * Nieuwe sleutel: AIzaSyAART2Zlv0mPDcCBHe4jHiVSaFw06Nbe_E
                        * Ouwe sleutel: AIzaSyCnY_a4ofDfPqzuGf4dLKsDTeEYf-c7qjg
                    -->
                <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAART2Zlv0mPDcCBHe4jHiVSaFw06Nbe_E&callback=initMap"></script>
            </div>
            <!-- end -->
        </div>
    </div>
    <div class="companydetails">
        <!-- Weergeven company details-->
        <?php
            $brand = new Brand();
            $getCompanyInfo = $brand->getcompanyInfo();
            if ($getCompanyInfo) {
                while($result = $getCompanyInfo->fetch_assoc()){
		?>
            <ul>
                <li><?php echo $result['name'];?></li>
                <li><?php echo $result['address'];?></li>
                <li><?php echo $result['zip'];?> <?php echo $result['city'];?></li>
                <li><?php echo $result['country'];?></li>
                <li>TEL: <?php echo $result['phone'];?></li>
                <li>FAX: <?php echo $result['fax'];?></li>
                <li>BTW: <?php echo $result['vat'];?></li>
                <li><a href="mailto:<?php echo $result['email'];?>?Subject=Ik%20heb%20een%20vraag" target="_top">
                <span><?php echo $result['email'];?></span></a></li>
            </ul>
		<?php } } ?>
                <!-- end -->
    </div>
    <div class="text-center back">
        <button class="btn btn-primary" onclick="history.go(-1);">TERUG </button>
    </div>
</div>
  
<?php include 'inc/footer.php'; ?>
