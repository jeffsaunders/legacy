<?php
//NOTE Changing this file will NOT update the navigation on the home page: index.php
?>
	
    <?php if($pageID == "Home"){ ?>
    <div id="menu-bar-home">
    	
        <ul class="main-nav-home">
        	<li><a href="index.php">Home</a></li>
            <li class="nudge-right"><a href="index2.php?page=about">About Us</a></li>
            <li><a href="index2.php?page=happy-news">Happy News</a></li>
            <li><a href="index2.php?page=realtor" class="specialNav">Realtors&reg;, Join Our Team</a></li>
            <li class="nudge-right2"><a href="index2.php?page=faq">FAQ</a></li>
            <li><a href="index2.php?page=contact">Contact Us</a></li>
        </ul><!--main-nav-->
      
      </div><!--main-menu-->
      <?php }else{ ?>
	  
      <div id="menu-bar">
    	
        <ul class="main-nav">
        	<li><a href="index.php">Home</a></li>
            <li class="nudge-right"><a href="index2.php?page=about">About Us</a></li>
            <li><a href="index2.php?page=happy-news">Happy News</a></li>
            <li><a href="index2.php?page=realtor" class="specialNav">Realtors&reg;, Join Our Team</a></li>
            <li><a href="index2.php?page=faq">FAQ</a></li>
            <li><a href="index2.php?page=contact">Contact Us</a></li>
        </ul><!--main-nav-->
        
    </div><!--main-menu-->
    <?php } ?>