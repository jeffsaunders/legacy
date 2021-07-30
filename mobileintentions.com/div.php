<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<?
// Interrogate and reassign passed variables
//$sec = $_GET['sec'];
$zipcode = $_GET['zipcode'];
//$cat = $_GET['cat'];
//$scn = $_GET['scn'];
//$sub = $_GET['sub'];
?>

<html>
<head>
	<title>Untitled</title>

	<link href="standard.css" rel="stylesheet" type="text/css">

	<!-- Set a cookie -->
	<script language="JavaScript1.1">
	function setCookie(name, value, months) {
		var expire = new Date();
		expire.setMonth(expire.getMonth()+months)
		document.cookie = name + "=" + escape(value)
		+ ((expire == null) ? "" : ("; expires=" + expire.toGMTString()))
	}
	</script>

	<!-- Read a cookie -->
	<script language="JavaScript1.1">
	function getCookie(Name) {
		var search = Name + "="
		if (document.cookie.length > 0) { // if there are any cookies
			offset = document.cookie.indexOf(search) 
			if (offset != -1) { // if cookie exists 
				offset += search.length 
				// set index of beginning of value
				end = document.cookie.indexOf(";", offset) 
				// set index of end of cookie value
				if (end == -1) 
					end = document.cookie.length
					return unescape(document.cookie.substring(offset, end))
			} 
		}
	}
	</script>

	<!-- Read cookie to get zipcode, if it's already set-->
	<script language="JavaScript1.1">
//	function getzipcode() {
		if ((getCookie("zipcode") != null) && (getCookie("zipcode") != "undefined")) {
//		if (getCookie("zipcode") != "") {
			var zipcode = getCookie("zipcode");
		}else{
			var zipcode = null;
		}
//	}
	</script>

	
	
	<script language="javascript">
	//toggles layer visibility on and off
	function show(id) {
		if (zipcode == null){
			document.getElementById(id).style.visibility = "visible";
		}
	}
	function hide(id) {
		document.getElementById(id).style.visibility = "hidden";
	}
	</script>

</head>

<body>


<!--<div id=layer0><a href="#" onClick="hide('layer0');show('layer1');" style="cursor:pointer;"><img src="images/OrderNow.gif" alt="" width="125" height="25" border="0"></div>-->
<a onClick="show('zipprompt');" style="cursor:pointer;"><img src="images/OrderNow.gif" alt="" width="125" height="25" border="0"></a><br><? echo $zipcode; ?><br>
<a href="#" onClick="setCookie('zipcode',zipcode,-1);">Delete Cookie</a>


<script>
	function zipsave(zip,dest) {
		if (zip == ""){
			return false;
		}else{
			setCookie('zipcode',zip,1);
			this.location.href = dest;
		}
	}
</script>
	<form>
		<strong class="bigWhite" style="position:relative;">Please enter your zipcode<br>to verify offer availability.</strong><br><br>
		<input type="text" name="zipcode" size="5" style="position:relative;">&nbsp;<input type="button" name="" value="Go" onClick="zipsave(form.zipcode.value,'http://www.mobileintentions.com/?sec=phones&zipcode='+form.zipcode.value+'');" style="position:relative;">
	</form>



<script type="text/javascript">
// Determine current browser window dimensions
if (window.innerWidth){ //if browser supports window.innerWidth (mozilla)
	bwidth=window.innerWidth;
	bheight=window.innerHeight;
}else if (document.all){ //else if browser supports document.all (IE 4+)
	bwidth=document.body.clientWidth;
	bheight=document.body.clientHeight;
};
document.write("<div id=zipprompt style='position:absolute; top:"+((bheight/2)-12)+"; left:"+((bwidth/2)-125)+"; width:250; height:100; z-index:2; padding:3px; background-color:#E20074; border-color:#E20074; border:thin solid; text-align:center; filter:alpha(opacity=85); visibility:hidden'>");
</script>
	<form>
		<strong class="bigWhite" style="position:relative;">Please enter your zipcode<br>to verify offer availability.</strong><br><br>
		<input type="text" name="zipcode" size="5" style="position:relative;">&nbsp;<input type="submit" name="" value="Go" onClick="setCookie('zipcode',form.zipcode.value,1);" style="position:relative;">
	</form>
</div>

