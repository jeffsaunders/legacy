<?php
//+-----------------------------------------------------------------------------------------------------+
//|			   					SMART WOMEN BUY HOMES - SIDEBAR CODE									|
//+-----------------------------------------------------------------------------------------------------+

// USAGE CONTROL FEATURE - Use the values "off" or "on"

$contactForm = "on"; //Turn OFF or ON the Contact Form
$blockArea = "off"; //Turn OFF or ON the Block area
$pictureArea = "on"; //Turn OFF or ON the picture area

?>

		<div id="sidebar">
    	
        
<?php 
//+------------------------------------------------------------------------------------+
//|			   					Start Contact Form									   |
//+------------------------------------------------------------------------------------+
?>        
        <?php if($contactForm == "on"){ //start contact on/off?>
        <div class="contact">
			<?php
			if($page != "realtor-signup"){
				// Encrypt function
				function encrypt($value, $key){
					if(!$value || !$key){
						return false;
					}
					$td = mcrypt_module_open('rijndael-256', '', 'ecb', '');
					$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size( $td ), MCRYPT_RAND);
					mcrypt_generic_init($td, $key, $iv);
					$encryptedValue = mcrypt_generic($td, $value);
					mcrypt_generic_deinit($td);
					mcrypt_module_close($td);
					return base64_encode( $encryptedValue );
				}
				$dataKey = base64_decode('1zvKhVe39VUe9HDtz3q1x2dqcoDDFEgW35VhIq2YmP0=');
			?>
			<br>
			<div id="quick-contact">
				<h3>Request For Information</h3>
			
				<!-- Form Validation Scripts -->
				<script src="/js/FormValidation.js" type="text/javascript"></script>
			
				<form action="../processQuickContact.php" method="post" name="quickForm" id="quickForm" onSubmit="return validateQuickForm(this);">
				<div id="quick-fields">

					<p>
						<label>Your Name</label><br />
						<input class="text-input large-input" type="text" id="name" name="name" />
					</p>

					<p>
						<label>Your Phone Number</label><br />
						<input class="text-input large-input" type="text" id="phone" name="phone" onKeyPress="return onlyNumbers(event);" onBlur="return formatPhone(this);" />
					</p>
						
					<p>
						<label>Your Email Address</label><br />
						<input class="text-input large-input" type="text" id="email" name="email" onBlur="return trimIt(this);" />
					</p>
						
					<p>
						<label>Best Time To Call</label><br />
						<select name="best_time" id="best_time" class="select select-input">
							<option value="">Select ...</option>
							<option value="Morning">Morning</option>
							<option value="Mid-Day">Mid-Day</option>
							<option value="Afternoon">Afternoon</option>
							<option value="Evening">Evening</option>
							<option value="Saturday">Saturday</option>
							<option value="Email Only">Please Just Email Me</option>
						</select>
					</p>

					<p>
						<label>Comments or Questions</label><br />
						<textarea class="text-input textarea" id="comment" name="comment" cols="30" rows="3"></textarea>
					</p>
					<br>
					<p>
						<input type="hidden" name="source" id="source" value="<?php echo $pageID; ?>">
						<input type="hidden" name="token" id="token" value="<?php echo encrypt($_SESSION['SESSION_ID'], $dataKey); ?>">
						<input class="button" type="submit" value="submit" name="submit" id="submit" />
					</p>

				</div>
			</div>				
			<?php } ?>  
       

<?php if(1==2){ ?> <!-- Never Do -->
        <?php if($page == "realtor-signup") { ?>
            <?php /*?><!--Realtor Contact Form-->
            <script type="text/javascript">document.write(unescape("%3Ciframe src=\"Realtor/RealtorForm/RealtorForm.html\" width=\"302\" height=\"395\"allowtransparency=\"true\" scrolling=\"no\" frameborder=\"0\"%3E&lt;a href=\"Realtor/RealtorForm.php\" title=\"RealtorForm\"&gt;Check out my CoffeeCup Form&lt;/a&gt;%3C/iframe%3E"));</script>
            <noscript>
              <iframe width="302" height="395" style="border:none; background:transparent; overflow:hidden;"
              src="Realtor/RealtorForm/RealtorForm.html">
                &lt;a href="RealtorForm.php" title="RealtorForm"&gt;Check out my CoffeeCup
                Form&lt;/a&gt;
              </iframe>
            </noscript>
            <!--End Realtor Contact Form--><?php */?>
        
         <?php } else { ?>
        
            <!--Standard Contact Form-->
            <script type="text/javascript">document.write(unescape("%3Ciframe src=\"QuickContact/QuickContact.html\" width=\"302\" height=\"365\"allowtransparency=\"true\" scrolling=\"no\" frameborder=\"0\"%3E&lt;a href=\"QuickContact.php\" title=\"QuickContact\"&gt;Check out my CoffeeCup Form&lt;/a&gt;%3C/iframe%3E"));</script>
            <noscript>
              <iframe width="302" height="365" style="border:none; background:transparent; overflow:hidden;"
              src="QuickContact/QuickContact.html">
                &lt;a href="QuickContact.php" title="QuickContact"&gt;Check out my CoffeeCup
                Form&lt;/a&gt;
              </iframe>
            </noscript>
            <!--Standard Contact Form-->
        
        <?php }; ?>  
<?php } ?> <!-- END Never Do -->
        
        </div><!--contact-->
        <?php }else{}; //end contact on/off?>
        
        
        
        
<?php 
//+------------------------------------------------------------------------------------+
//|			   					Start Block Area									   |
//+------------------------------------------------------------------------------------+
?>        
        <?php if($blockArea == "on") { //Start Block Area On/Off?>
        <div class="block">
        	<h2>BLOCK AREA 1</h2>
        </div><!--block-->
        
        <div class="block">
        	<h2>BLOCK AREA 2</h2>
        </div><!--block-->
        
        <div class="block">
        	<h2>BLOCK AREA 3</h2>
        </div><!--block--> 
        <?php }else{}; //End Block Area On/Off?>

<?php 
//+------------------------------------------------------------------------------------+
//|			   					Start Picture Area									   |
//+------------------------------------------------------------------------------------+
?>              
        <?php if($pictureArea == "on") { //Start Picture Area On/Off?>        
       	<div class="sidebar-pic">
        	 <?php
			// Branch Content Based On Passed "pageID" Value
			switch($pageID){

							case "about": print("<img src=\"images/assets/brown-suit.jpg\" alt=\"Smart Women Buy Homes\" border=\"0\" />");break;
							case "happyNews": print("<img src=\"images/assets/touchdown.jpg\" alt=\"Smart Women Buy Homes\" border=\"0\" />");break;
							case "faq": print("<img src=\"images/assets/young-black-woman.jpg\" alt=\"Smart Women Buy Homes\" border=\"0\" />");break;
							default: print("<img src=\"images/assets/brown-suit.jpg\" alt=\"Smart Women Buy Homes\" border=\"0\" />");break;
			} // End Switch
			?>
        	
        </div><!--sidebar-pic-->
        <?php }else{}; //End Picture Area On/Off?>
        

       
        
    </div><!--sidebar-->

    <div class="clear"></div><!--clear-->