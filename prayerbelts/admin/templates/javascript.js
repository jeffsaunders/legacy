// "Disable" the BACK button in the browser.  (Was causing corruption of text files.)
//javascript:window.history.forward(1); 

function resetMenu1(){
	//Test to see if file dropdown exists.
	if (document.menu.file != null) {
	//	if (eval (document.menu.file.value == null) ) {
		document.menu.file.value = "";
	}
}
function resetMenu2(){
	document.menu.directory.value = "<?=$html[dirValue]?>";
}

