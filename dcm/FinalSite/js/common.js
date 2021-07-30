// --- Flip Layers
function show(id) {
	document.getElementById(id).style.visibility = "visible";
	document.getElementById(id).style.display = "block";
}
function hide(id) {
	document.getElementById(id).style.visibility = "hidden";
	document.getElementById(id).style.display = "none";
}

// --- Only accept digits (numbers)
function onlyNumbers(e,o){
	//alert(o.value);
	var keynum
	var keychar
	var ltrcheck
	var crcheck
	if(window.event){ // IE
		keynum = e.keyCode
	}else if(e.which){ // Netscape/Firefox/Opera/Safari/Others
		keynum = e.which
	}
//alert(keynum);
	if (keynum == 08 || keynum == 46 || keynum == 13 || !keynum) return true; // Backspace, decimal point, enter, or navigation (arrow) key
	keychar = String.fromCharCode(keynum)
//alert(keychar);
	ltrcheck = /\D/ //Regular expression for NON-digit (letter)
	crcheck = /\cM/ //Regular expression ctrl-M (enter)
	if (crcheck.test(keychar)) o.blur();
	return !ltrcheck.test(keychar) //Return true if not a letter
//	return (!ltrcheck.test(keychar)||crcheck.test(keychar)) //Return true if not a letter OR enter
}

