<?php

$title = "Smart Women Buy Homes | Happy News";
$pageID= "news";

?>

<?php require ('includes/header.php'); ?>
<style type="text/css">
#block_1
	{
	float: left;
	width: 620px;

	background:#F00;
	}
* html #block_1
	{
	display: inline;
	}
#block_2
	{
	float: left;
	width: 300px;
	margin-left: 20px;
	background:#0F0;
	}
#block_3
	{
	float: left;
	width: 33%;
	background:#00F
	}
/* Start Mac IE5 filter \*/
#block_1, #block_2, #block_3
	{
	padding-bottom: 32767px !important;
	margin-bottom: -32767px !important; 
	}
@media all and (min-width: 0px) {
#block_1, #block_2, #block_3
	{
	padding-bottom: 0 !important;
	margin-bottom: 0 !important; 
	}
#block_1:before, #block_2:before, #block_3:before
	{
	content: '[DO NOT LEAVE IT IS NOT REAL]';
	display: block;
	background: inherit;
	padding-top: 32767px !important;
	margin-bottom: -32767px !important;
	height: 0;
	}
}
/* End Mac IE5 filter */
#wrapper
	{
	overflow: hidden; /* This hides the excess padding in non-IE browsers */
	}
/* we need this for IE 5.01 - otherwise the wrapper does not expand to the
necessary height (unless fixed, this problem becomes even more acute 
weirdness as the method is enhanced */
#wrapper
	{
/* Normally a Holly-style hack height: 1% would suffice but that causes 
IE 5.01 to completely collapse the wrapper - instead we float it */
	float: left;
/* NB. possibly only IE 5.01 needs to get this float value - otherwise 5.5 sometimes 
(I saw it happen many moons ago) makes the width of wrapper too small 
the float: none with the comment is ignored by 5.01,
5.5 and above see it and carry on about their business
It's probably fine to just remove it, but it's left here 
just in case that many moons ago problem rears its head again */
	float/**/: none;
	}
/* easy clearing */
#wrapper:after
	{
	content: '[DO NOT LEAVE IT IS NOT REAL]'; 
	display: block; 
	height: 0; 
	clear: both; 
	visibility: hidden;
	}
#wrapper
	{
	display: inline-block;
	}
/*\*/
#wrapper
	{
	display: block;
	}
/* end easy clearing */
#footer
	{
	clear: both;
	}
/* Safari needs this - otherwise the ghost overflow, though painted 
correctly obscures links and form elements that by rights should be above it.
An unintended side-effect is that it cause such elements to vanish in IE 5.01
and 5.5, hence the child selector hack */
* > #footer, * > form, * > #notes, * > .output
	{
	position: relative;
	z-index: 1000;
	}

</style>    
    
<div id="wrapper">
<div id="block_1">
	...asdj;flka js;dflkajs ;dflkja s;dflkja s;dlfkj as;dlkfjas;ldkfj a;sldkfj a;slkdfj ;alkdjf ;aslkjdf ;laksdjf ;aowjf ;alsdjf ;wouhf ;aosdhf ;awouhf ;aoisdjf ;awoidjf ;aoiwdfja;w oijf ;aosiefj; aowifj ;asodhf;asoidjf ;asoidjf ;asoidjf ;siojf asdj;flka js;dflkajs ;dflkja s;dflkja s;dlfkj as;dlkfjas;ldkfj a;sldkfj a;slkdfj ;alkdjf ;aslkjdf ;laksdjf ;aowjf ;alsdjf ;wouhf ;aosdhf ;awouhf ;aoisdjf ;awoidjf ;aoiwdfja;w oijf ;aosiefj; aowifj ;asodhf;asoidjf ;asoidjf ;asoidjf ;siojf asdj;flka js;dflkajs ;dflkja s;dflkja s;dlfkj as;dlkfjas;ldkfj a;sldkfj a;slkdfj ;alkdjf ;aslkjdf ;laksdjf ;aowjf ;alsdjf ;wouhf ;aosdhf ;awouhf ;aoisdjf ;awoidjf ;aoiwdfja;w oijf ;aosiefj; aowifj ;asodhf;asoidjf ;asoidjf ;asoidjf ;siojf 
</div>
<div id="block_2">
	...
</div>

</div>
    
	<?php require ('includes/footer.php'); ?>