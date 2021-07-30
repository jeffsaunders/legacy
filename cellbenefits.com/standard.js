// BEGIN FUNCTION SPAWNCHILD ---

//  This function spawns a child window 

//  SpawnChild(URL including fully qualified URL's,
//		 		Width of the spawned window in pixels,
//			 	Height of the spawned window in pixels,
//				Centered (no/0 or 1/yes, which overrides the positioning values below),
//				Netscape distance from left in pixels (unless Centered = 1/yes),
//				Netscape distance from top in pixels (unless Centered = 1/yes),
//				Internet Explorer distance from left in pixels (unless Centered = 1/yes),
//				Internet Explorer distance from top in pixels (unless Centered = 1/yes),
//				Is window resizable? (no/0 or yes/1 - either works),
//				Display scrollbars? (no/0 or yes/1),
//				Display menubar? (no/0 or yes/1),
//				Display toolbar? (no/0 or yes/1),
//				Display statusbar? (no/0 or yes/1)
//				)

// 	Example - SpawnChild('http://192.168.0.1/ChildWindowContent.html','500','200','150','no','200','150','200','yes','yes','no','0','1')
// 	Creates a window that is 500x200 pels located 150 pels from the left and 200 pels from the top (NOT centered) which loads a page from a server at 192.168.0.1 named ChildWindowContent.html, resizable, with scrollbars & statusbar on.

function SpawnChild(Content, ChildName, Width, Height, Centered, NSx, NSy, IEx, IEy, Resizable, ScrollBars, MenuBar, ToolBar, StatusBar){
	if (window.child && !(window.child.closed))	window.child.close();
	var URL=Content;
	var Name=ChildName;
	var WindowWidth=parseInt(Width);
	var WindowHeight=parseInt(Height);
	if ((Centered == "1")||(Centered == "yes")){
		Left=(screen.width/2)-(Width/2);
		Top=(screen.height/2)-(Height/2);
		NSx=Left;
		NSy=Top;
		IEx=Left;
		IEy=Top
	}
	var ScreenX=parseInt(NSx);
	var ScreenY=parseInt(NSy);
	var Left=parseInt(IEx);
	var Top=parseInt(IEy);
	var Resize=Resizable;
	var SB=ScrollBars;
	var MB=MenuBar;
	var TB=ToolBar;
	var Status=StatusBar;
  		child=window.open(URL, Name, "width=" + WindowWidth + ",height=" + WindowHeight + ",screenX=" + ScreenX + ",screenY=" + ScreenY + ",left=" + Left + ",top=" + Top + ",resizable=" + Resize + ",scrollbars=" + SB + ",menubar=" + MB + ",toolbar=" + TB + ",status=" + Status);
}

// END FUNCTION SPAWNCHILD ---


// BEGIN COOKIE FUNCTIONS ---

	//<!-- Set a cookie -->
	function setCookie(name, value, months) {
		var expire = new Date();
		expire.setMonth(expire.getMonth()+months)
		document.cookie = name + "=" + escape(value)
		+ ((expire == null) ? "" : ("; expires=" + expire.toGMTString()));
		return true;
	}

	//<!-- Read a cookie -->
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

// END COOKIE FUNCTIONS ---


// BEGIN KEYCHECK FUNCTIONS ---

// Only accept letters, no numbers
function noNumbers(e){
	var keynum
	var keychar
	var numcheck
	var crcheck
	if(window.event){ // IE
		keynum = e.keyCode
	}else if(e.which){ // Netscape/Firefox/Opera
		keynum = e.which
	}
	keychar = String.fromCharCode(keynum)
	numcheck = /\d/ //Regular expression for digit (number)
	ctlcheck = /[\x00\x08\x0D]/  // Control keys (BS, DEL, TAB, etc.)
//	bscheck = /\cH/ //Regular expression ctrl-H (backspace)
//	crcheck = /\cM/ //Regular expression ctrl-M (enter)
	return (!numcheck.test(keychar)||ctlcheck.test(keychar)) //Return true if not a letter OR control key
//	return !numcheck.test(keychar) //Return true if not a digit
//	return (!numcheck.test(keychar)||crcheck.test(keychar)) //Return true if not a digit OR enter
}

// Only accept digits (numbers)
function onlyNumbers(e){
	var keynum
	var keychar
	var ltrcheck
	var crcheck
	if(window.event){ // IE
		keynum = e.keyCode
	}else if(e.which){ // Netscape/Firefox/Opera
		keynum = e.which
//alert(keynum);
	}
	keychar = String.fromCharCode(keynum)
//alert(keychar);
	ltrcheck = /\D/ //Regular expression for NON-digit (letter)
	ctlcheck = /[\x00\x08\x0D]/  // Control keys (BS, DEL, TAB, etc.)
//	bscheck = /\cH/ //Regular expression ctrl-H (backspace)
//	crcheck = /\cM/ //Regular expression ctrl-M (enter)
	return (!ltrcheck.test(keychar)||ctlcheck.test(keychar)) //Return true if not a number OR control key
//	return !ltrcheck.test(keychar) //Return true if not a letter
//	return (!ltrcheck.test(keychar)||bscheck.test(keychar)||crcheck.test(keychar)) //Return true if not a letter, backspace, OR enter
}

// END KEYCHECK FUNCTIONS ---


// BEGIN EMAIL CHECK FUNCTIONS ---

function verifyemail(addr){
//	if (document.layers||document.all){
		return checkemail(addr);
//	}else{
//		return true;
//	}
}

var testresults
function checkemail(str){
//	var str=document.form.email.value
	var filter=/^.+@.+\..{2,3}$/
	if (filter.test(str)){
		testresults=true;
	}else{
		alert("Please enter a valid email address");
		testresults=false;
	}
	return (testresults)
}

// END EMAIL CHECK FUNCTIONS ---


// BEGIN FUNCTION BLINK ---

	// Before you use this script you may want to have your head examined
	// Copyright 1999 InsideDHTML.com, LLC.  

	function doBlink() {
		// Blink, Blink, Blink...
		var blink = document.all.tags("BLINK")
		for (var i=0; i < blink.length; i++)
			blink[i].style.visibility = blink[i].style.visibility == "" ? "hidden" : "" 
	}

	function startBlink() {
		// Only if it's IE
		if (document.all)
			setInterval("doBlink()",500)
	}
	//window.onload = startBlink;

// END FUNCTION BLINK ---

