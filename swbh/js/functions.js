// --- Flip Layers
function show(id, focus) {
	document.getElementById(id).style.visibility = "visible";
	document.getElementById(id).style.display = "block";
	if (focus){
		document.getElementById(focus).focus();
	}
}
function hide(id, focus) {
	document.getElementById(id).style.visibility = "hidden";
	document.getElementById(id).style.display = "none";
	if (focus){
		document.getElementById(focus).focus();
	}
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
	}else if(e.which){ // Chrome/Firefox/Opera/Safari/Others
		keynum = e.which
	}
	//alert(keynum);
	if (keynum == 08 || keynum == 45 || keynum == 46 || keynum == 13 || !keynum) return true; // Backspace, hyphen/minus, decimal point, enter, or navigation (arrow) key
//	if (keynum == 08 || keynum == 13 || !keynum) return true; // Backspace, enter, or navigation (arrow) key
	keychar = String.fromCharCode(keynum)
	//alert(keychar);
	ltrcheck = /\D/ //Regular expression for NON-digit (letter)
	crcheck = /\cM/ //Regular expression ctrl-M (enter)
	if (crcheck.test(keychar)) o.blur();
	return !ltrcheck.test(keychar) //Return true if not a letter
}

// --- Format a date as MM/DD/YYYY
function formatDate(o){
	var oValue = o.value;
	// if it's blank, just move on and let the form validation catch that
	if (oValue.length < 1){
		return
	}
	// count how many "-" there are
	var nDashes = oValue.replace(/[^-]/g, '').length;
	// count how many "/" there are
	var nSlashes = oValue.replace(/[^/]/g, '').length;
	// split the string at the "-" or "/"
	if (nDashes == 2){
		var dateArray = oValue.split('-');
	}else if (nSlashes == 2){
		var dateArray = oValue.split('/');
	}else{
		o.style.background="#FF0000";
		alert('The month, day, and year must be seperated by a "-" or "/"');
		o.style.background="#FDFDFD";
 		o.focus();
		return;
	}
	// make sure the three values are all numbers
	var pass = true;
	for (var i = 0; i < 3; i++){
		if (isNaN(dateArray[i])){
			pass = false;
		}
	}
	if (pass == false){
		o.style.background="#FF0000";
		alert('The date must be numeric');
		o.style.background="#FDFDFD";
 		o.focus();
		return;
	}
	// mash up the array values and make a real date of it
	// not completely comprehensive.  It assumes that the year will either be 2 or 4 digits and does not handle any other lengths properly - good enough for now though
    var oDate = new Date(dateArray[2].length == 2 ? '20' + dateArray[2] : dateArray[2], dateArray[0] - 1, dateArray[1], 12, 0, 0, 0);
	// now tear it apart again, but this time it's clean(ish)
    var Month = oDate.getMonth()+1;
    var Day = oDate.getDate();
    var Year = oDate.getFullYear();
	// build the date string the way we like it
    var dateString = '' + (Month <= 9 ? '0' + Month : Month) +'/'+ (Day <= 9 ? '0' + Day : Day) +'/'+ Year;
	o.value = dateString;
	return;
}

// --- Format a phone number as (NNN) NNN-NNNN
function formatPhone(o){
	var errorBG =	"background:#FF0000;";
	var normalBG =	"background:#FFFFFF url('../images/bg-form-field.gif') top left repeat-x;";
	var oValue =	o.value;
	// remove all "(", ")", "-", and spaces
	oValue = oValue.replace(/\(/g, '');
	oValue = oValue.replace(/\)/g, '');
	oValue = oValue.replace(/\-/g, '');
	oValue = oValue.replace(/\s+/g, '');
	// remove all alpha characters
	oValue = oValue.replace(/[a-zA-Z]+/g,'');
	// stop checking and let it pass if it's empty - form validator will catch it if it can't be blank
	if (oValue.length < 1){
		return true;
	// make sure it's 10 digits if there are any
	}else if (oValue.length < 10){
		o.focus();
		o.setAttribute("style", errorBG);
		alert('The phone number needs at least 10 digits');
		o.setAttribute("style", normalBG);
		// Must set a timeout or the prior element's destruction will clobber the focus() call
		// and leave the cursor in the next field
		setTimeout(function(){document.getElementById(o.id).focus();}, 10);
		return false;
	}
	// make sure they are all numbers
// no need - replaced with alpha removal above
//	if (isNaN(oValue)){
//		o.setAttribute("style", errorBG);
//		alert('The phone number must be numeric');
//		o.setAttribute("style", normalBG);
//		// Must set a timeout or the prior element's destruction will clobber the focus() call
//		// and leave the cursor in the next field
//		setTimeout(function() { document.getElementById(o.id).focus(); }, 10);
//		return false;
//	}
	// ok, seems good
//	if (oValue.length < 10){
//		o.value = o.value;
//	}else if (oValue.length == 10){
	if (oValue.length == 10){
		o.value = '(' + (oValue.substr(0, 3) + ') ' + oValue.substr(3, 3) + '-' + oValue.substr(6, 4));
	}else{
		o.value = '(' + (oValue.substr(0, 3) + ') ' + oValue.substr(3, 3) + '-' + oValue.substr(6, 4) + ' ext ' + oValue.substr(10));
	}
	return true;
}

