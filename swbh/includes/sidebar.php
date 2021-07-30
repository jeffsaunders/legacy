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
        
        
        <?php if($pageID == "realtor") { ?>
            <!--Realtor Contact Form-->
            <script type="text/javascript">document.write(unescape("%3Ciframe src=\"Realtor/RealtorForm/RealtorForm.html\" width=\"302\" height=\"395\"allowtransparency=\"true\" scrolling=\"no\" frameborder=\"0\"%3E&lt;a href=\"Realtor/RealtorForm.php\" title=\"RealtorForm\"&gt;Check out my CoffeeCup Form&lt;/a&gt;%3C/iframe%3E"));</script>
            <noscript>
              <iframe width="302" height="395" style="border:none; background:transparent; overflow:hidden;"
              src="Realtor/RealtorForm/RealtorForm.html">
                &lt;a href="RealtorForm.php" title="RealtorForm"&gt;Check out my CoffeeCup
                Form&lt;/a&gt;
              </iframe>
            </noscript>
            <!--End Realtor Contact Form-->
        
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
        	 <?
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