<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?> xml:lang="<?php echo $lang; ?>" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<meta charset="UTF-8" />
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<?php } ?>
<?php if ($icon) { ?>
<link href="<?php echo $icon; ?>" rel="icon" />
<?php } ?>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>



<link rel="stylesheet" type="text/css" href="catalog/view/theme/bershka/stylesheet/stylesheet.css" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/bershka/stylesheet/<?php echo ($this->config->get('tg_colorthemes_default_color')); ?>.css" media="screen" />
<?php if ($this->config->get('tg_colorthemes_status') == "1") { ?>
<link rel="alternate stylesheet" type="text/css" media="screen" title="white-color" href="catalog/view/theme/bershka/stylesheet/white_stylesheet.css" />
<link rel="alternate stylesheet" type="text/css" media="screen" title="blue-color" href="catalog/view/theme/bershka/stylesheet/blue_stylesheet.css" />
<link rel="alternate stylesheet" type="text/css" media="screen" title="teal-color" href="catalog/view/theme/bershka/stylesheet/teal_stylesheet.css" />
<link rel="alternate stylesheet" type="text/css" media="screen" title="gray-color" href="catalog/view/theme/bershka/stylesheet/gray_stylesheet.css" />
<link rel="alternate stylesheet" type="text/css" media="screen" title="red-color" href="catalog/view/theme/bershka/stylesheet/red_stylesheet.css" />

<link rel="alternate stylesheet" type="text/css" media="screen" title="purple-color" href="catalog/view/theme/bershka/stylesheet/purple_stylesheet.css" />
<link rel="alternate stylesheet" type="text/css" media="screen" title="pink-color" href="catalog/view/theme/bershka/stylesheet/pink_stylesheet.css" />
<link rel="alternate stylesheet" type="text/css" media="screen" title="orange-color" href="catalog/view/theme/bershka/stylesheet/orange_stylesheet.css" />
<link rel="alternate stylesheet" type="text/css" media="screen" title="navy-color" href="catalog/view/theme/bershka/stylesheet/navy_stylesheet.css" />
<link rel="alternate stylesheet" type="text/css" media="screen" title="light-color" href="catalog/view/theme/bershka/stylesheet/light_stylesheet.css" />

<link rel="alternate stylesheet" type="text/css" media="screen" title="light-blue-color" href="catalog/view/theme/bershka/stylesheet/light_blue_stylesheet.css" />
<link rel="alternate stylesheet" type="text/css" media="screen" title="green-color" href="catalog/view/theme/bershka/stylesheet/green_stylesheet.css" />
<link rel="alternate stylesheet" type="text/css" media="screen" title="dark-purple-color" href="catalog/view/theme/bershka/stylesheet/dark_purple_stylesheet.css" />
<link rel="alternate stylesheet" type="text/css" media="screen" title="brown-color" href="catalog/view/theme/bershka/stylesheet/brown_stylesheet.css" />
<link rel="alternate stylesheet" type="text/css" media="screen" title="dark-color" href="catalog/view/theme/bershka/stylesheet/dark_stylesheet.css" />
<link rel="alternate stylesheet" type="text/css" media="screen" title="black-color" href="catalog/view/theme/bershka/stylesheet/black_stylesheet.css" />

<script src="catalog/view/javascript/styleswitch.js" type="text/javascript"></script>
<?php } ?>
<?php foreach ($styles as $style) { ?>
<link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<script type="text/javascript" src="catalog/view/javascript/jquery/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" />
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/external/jquery.cookie.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/colorbox/jquery.colorbox.js"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/colorbox/colorbox.css" media="screen" />
<script type="text/javascript" src="catalog/view/javascript/jquery/tabs.js"></script>
<script type="text/javascript" src="catalog/view/javascript/common.js"></script>
<?php foreach ($scripts as $script) { ?>
<script type="text/javascript" src="<?php echo $script; ?>"></script>
<?php } ?>
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/bershka/stylesheet/ie7.css" />
<![endif]-->
<!--[if IE 8]>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/bershka/stylesheet/ie8.css" />
<![endif]-->
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/bershka/stylesheet/ie6.css" />
<script type="text/javascript" src="catalog/view/javascript/DD_belatedPNG_0.0.8a-min.js"></script>
<script type="text/javascript">
DD_belatedPNG.fix('#logo img');
</script>
<![endif]-->
<?php echo $google_analytics; ?>
</head>
<body>
<div id="wrapper">
<div id="container">
<div id="header">
  <?php if ($logo) { ?>
  <div id="logo"><a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" /></a></div>
  <?php } ?>
  <?php echo $language; ?>
  <?php echo $currency; ?>
  <?php echo $cart; ?>
  <div id="search">
    <div class="button-search"></div>
    <input type="text" name="search" placeholder="<?php echo $text_search; ?>" value="<?php echo $search; ?>" />
  </div>
  <div id="welcome">
    <?php if (!$logged) { ?>
    <?php echo $text_welcome; ?>
    <?php } else { ?>
    <?php echo $text_logged; ?>
    <?php } ?>
  </div>
  <div class="links"><a href="<?php echo $home; ?>"><?php echo $text_home; ?></a><a href="<?php echo $wishlist; ?>" id="wishlist-total"><?php echo $text_wishlist; ?></a><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a><a href="<?php echo $shopping_cart; ?>"><?php echo $text_shopping_cart; ?></a><a href="<?php echo $checkout; ?>"><?php echo $text_checkout; ?></a></div>
</div>


<div id="main-top"><!-- -->
		
		<div id="main-menu">
			
			<div id="menu-inner">
				
				<div class="menu-left"><!-- --></div>
				<div class="menu-right"><!-- --></div>
				<div class="menu-middle">
					

              						<?php if ($categories) { ?>
										<div id="menu">
  											<ul>
   												 <?php foreach ($categories as $category) { ?>
    											 <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
      												<?php if ($category['children']) { ?>
      													<div>
        													<?php for ($i = 0; $i < count($category['children']);) { ?>
        													  <ul>
         														 <?php $j = $i + ceil(count($category['children']) / $category['column']); ?>
          															<?php for (; $i < $j; $i++) { ?>
          																<?php if (isset($category['children'][$i])) { ?>
         																	 <li><a href="<?php echo $category['children'][$i]['href']; ?>"><?php echo $category['children'][$i]['name']; ?></a></li>
          																<?php } ?>
          															<?php } ?>
       										 				  </ul>
        													<?php } ?>
      													</div>
     											   <?php } ?>
    											 </li>
    											<?php } ?>
  											</ul>
									  	</div> <!-- menu (end) -->
									<?php } ?>
			
			<?php if ($this->config->get('tg_colorthemes_status') == "1") { ?>						
					<div id="menu">
              			<ul>
              				<li><a href="#";>Color Themes</a>
              					<div>
              						<ul>
              							
              								
											<li><a href="javascript:chooseStyle('blue-color', 60)">Blue Color</a></li>
											<li><a href="javascript:chooseStyle('teal-color', 60)">Teal Color</a></li>
											<li><a href="javascript:chooseStyle('gray-color', 60)">Gray Color</a></li>
											<li><a href="javascript:chooseStyle('red-color', 60)">Red Color</a></li>
											<li><a href="javascript:chooseStyle('purple-color', 60)">Purple Color</a></li>
											<li><a href="javascript:chooseStyle('pink-color', 60)">Pink Color</a></li>
											<li><a href="javascript:chooseStyle('orange-color', 60)">Orange Color</a></li>
											<li><a href="javascript:chooseStyle('navy-color', 60)">Navy Color</a></li>
											<li><a href="javascript:chooseStyle('light-color', 60)">Light Color</a></li>
											<li><a href="javascript:chooseStyle('light-blue-color', 60)">Light Blue Color</a></li>
											<li><a href="javascript:chooseStyle('green-color', 60)">Green Color</a></li>
											<li><a href="javascript:chooseStyle('dark-color', 60)">Dark Color</a></li>
											<li><a href="javascript:chooseStyle('dark-purple-color', 60)">Dark Purple Color</a></li>
											<li><a href="javascript:chooseStyle('brown-color', 60)">Brown Color</a></li>
											<li><a href="javascript:chooseStyle('white-color', 60)">White Color</a></li>
											<li><a href="javascript:chooseStyle('black-color', 60)">Black Color</a></li>
											
										
									</ul>
								</div>
							</li>	
						</ul>
	  				</div>
    		<?php } ?>
					
				</div><!-- .menu-middle (end) -->
			</div><!-- .menu-inner (end) -->
		
			
		</div><!-- #main-menu (end) -->
</div><!-- #main-top (end) -->

</div><!-- #container (end) -->

<div id="container2">

<div class="inner"> 
<div id="notification"></div>