<?php
//NOTE Changing this file will NOT update the navigation on the home page: index.php

// It won't?? - JS
?>
	
    <?php if($pageID == "Home"){ ?>
    <div id="menu-bar-home">
    	
        <ul class="main-nav-home">
        	<li><a href="/">Home</a></li>
            <li><a href="/?page=media">Media</a></li>
            <li class="nudge-right"><a href="/?page=about">About Us</a></li>
            <li><a href="/?page=happy-news">Happy News</a></li>
            <li><a href="/?page=realtor-signup" class="specialNav">Realtors&reg;, Join Our Team</a></li>
            <li class="nudge-right2"><a href="/?page=faq">FAQ</a></li>
            <li><a href="/?page=contact">Contact Us</a></li>
        </ul><!--main-nav-->
      
      </div><!--main-menu-->
      <?php }else{ ?>
	  
      <div id="menu-bar">
    	
        <ul class="main-nav">
        	<li><a href="/">Home</a></li>
            <li class="nudge-right"><a href="/?page=media">Media</a></li>
            <li><a href="/?page=about">About Us</a></li>
            <li><a href="/?page=happy-news">Happy News</a></li>
            <li><a href="/?page=realtor-signup" class="specialNav">Realtors&reg;, Join Our Team</a></li>
            <li><a href="/?page=faq">FAQ</a></li>
            <li><a href="/?page=contact">Contact Us</a></li>
        </ul><!--main-nav-->
        
    </div><!--main-menu-->
    <?php } ?>