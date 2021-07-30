// BEGIN FUNCTIONS TO TOGGLE ZIPCODE LAYER VISIBILITY ---
	//toggles layer visibility on and off
//	function show(id,dest,prod) {
//		if ((!zipcode) || (zipcode == null)){ //make div visible
//			document.getElementById(id).style.visibility = "visible";
//			if (id == "zipprompt1"){
//				prod_id = prod;
//				document.form1.zipcode.focus();
//			}else if (id == "zipprompt2") {
//				document.form2.zipcode.focus();
//			}
//		}else{
//			var destination = dest+prod;
//			this.location.href = destination;  //zipcode set, move on
//		}
//	}
//	function hide(id) {
//		document.getElementById(id).style.visibility = "hidden";
//	}
// END FUNCTIONS TO TOGGLE ZIPCODE LAYER VISIBILITY ---


// BEGIN FUNCTION ZIPSAVE ---
//	function zipsave(zip,dest) {
//		if (zip.length != 5){ //Did they enter a 5 digit zipcode?
//			return;
//		}else{ //They did
//			window.location.href = dest;
//		}
//	}
// END FUNCTION ZIPSAVE ---


// BEGIN FUNCTION TO ROTATE IMAGES (PROMOS IN HEADER) ---

//*****************************************
// Blending Image Slide Show Script- 
// © Dynamic Drive (www.dynamicdrive.com)
// For full source code, visit http://www.dynamicdrive.com/
//*****************************************

//specify interval between slide (in mili seconds)
var slidespeed=10000

//specify images
var slideimages=new Array("images/promos/FreeActivationPromoBanner.gif","images/promos/FamilyPlanPromoBanner.gif","images/promos/Regional3KPromoBanner.gif","images/promos/GetMore1KPromoBanner.gif")
//Array("images/promos/myFave5PromoBanner.gif","images/promos/Regional3KPromoBanner.gif","images/promos/GetMore1KPromoBanner.gif")

//specify corresponding links
var slidelinks=new Array("javascript:adDown('FreeActivation', -450);","javascript:adDown('BackToSchool', -450);","javascript:adDown('Regional3K', -450);","javascript:adDown('GetMore1K', -450);")
//var slidelinks=new Array("javascript:popupwin=window.open('http://www.myfaves.com',137,'height=650,width=900,screenX=900,screenY=650,left=10,top=10,toolbar=no,location=no,menubar=no,status=no,resizable,scrollbars=no'); popupwin.focus();","javascript:adDown('Regional3K', -450);","javascript:adDown('GetMore1K', -450);")

var newwindow=0 //open links in new window? 1=yes, 0=no

var imageholder=new Array()
var ie=document.all
for (i=0;i<slideimages.length;i++){
	imageholder[i]=new Image()
	imageholder[i].src=slideimages[i]
}

function gotoshow(){
	if (newwindow)
		window.open(slidelinks[whichlink])
	else
		window.location=slidelinks[whichlink]
}

// END FUNCTION TO ROTATE IMAGES (PROMOS IN HEADER) ---


// BEGIN FUNCTION CHANGETEXT (MENU HELP TEXT) ---
		/**********************************************************************************   
		ChangeText 
		*   Copyright (C) 2001 Thomas Brattli
		*   This script was released at DHTMLCentral.com
		*   Visit for more great scripts!
		*   This may be used and changed freely as long as this msg is intact!
		*   We will also appreciate any links you could give us.
		*
		*   Made by Thomas Brattli
		*
		*   Script date: 08/02/2001 (keep this date to check versions) 
		*********************************************************************************/
		function lib_bwcheck(){ //Browsercheck (needed)
			this.ver=navigator.appVersion
			this.agent=navigator.userAgent
			this.dom=document.getElementById?1:0
			this.opera5=(navigator.userAgent.indexOf("Opera")>-1 && document.getElementById)?1:0
			this.ie5=(this.ver.indexOf("MSIE 5")>-1 && this.dom && !this.opera5)?1:0; 
			this.ie6=(this.ver.indexOf("MSIE 6")>-1 && this.dom && !this.opera5)?1:0;
			this.ie4=(document.all && !this.dom && !this.opera5)?1:0;
			this.ie=this.ie4||this.ie5||this.ie6
			this.mac=this.agent.indexOf("Mac")>-1
			this.ns6=(this.dom && parseInt(this.ver) >= 5) ?1:0; 
			this.ns4=(document.layers && !this.dom)?1:0;
			this.bw=(this.ie6 || this.ie5 || this.ie4 || this.ns4 || this.ns6 || this.opera5)
			return this
		}
		var bw=lib_bwcheck()
		if(document.layers){ //NS4 resize fix...
			scrX= innerWidth; scrY= innerHeight;
			onresize= function(){if(scrX!= innerWidth || scrY!= innerHeight){history.go(0)} }
		}

		/****
		Variables to set 
		****/
		msgFont= "Verdana,Arial,Helvetica,sans-serif"	// The font for the message
		msgFontSize= 9				// Set the fontSize in px
		msgFontColor="#FFFFFF"		// Set the fontColor
		msgWidth= "200"				// Set the width of the messageblock here for netscape 4

		//Set the text you want to display on mouseover here.
		messages=new Array()
		messages[0]='<img src="images/spacer.gif" alt="" width="1" height="12" border="0">' //This is what appears when you mouse out.
		messages[1]='<strong>&raquo;&nbsp;Home Page.</strong>'
		messages[2]='<strong>&raquo;&nbsp;Show All Phones &amp; Accessories.</strong>'
		messages[3]='<strong>&raquo;&nbsp;Show All T-Mobile Calling Plans.</strong>'
		messages[4]='<strong>&raquo;&nbsp;T-Mobile Service Coverage Map.</strong>'
		messages[5]='<strong>&raquo;&nbsp;Rebate Forms &amp; Information.</strong>'
		messages[6]='<strong>&raquo;&nbsp;Terms &amp; Conditions Information.</strong>'
		messages[7]='<strong>&raquo;&nbsp;Frequently Asked Questions.</strong>'
		messages[8]='<strong>&raquo;&nbsp;About MobilIntentions.com.</strong>'
		messages[9]='<strong>&raquo;&nbsp;Check Order Status Live!</strong>'
		messages[10]='<strong>&raquo;&nbsp;Thousands of Accessories for All Phones</strong>'
		messages[11]='<strong>&raquo;&nbsp;Call (800)555-1212</strong>'

		/********************************************************************************
		You don't have to change anything below this
		********************************************************************************/

		//ChangeText object constructor.
		function makeChangeTextObj(obj){
		   	this.css = bw.dom?document.getElementById(obj).style:bw.ie4?document.all[obj].style:bw.ns4?document.layers[obj]:0;	
		   	this.writeref = bw.dom?document.getElementById(obj):bw.ie4?document.all[obj]:bw.ns4?document.layers[obj].document:0	;	
			this.writeIt = b_writeIt;					
		}
		function b_writeIt(text,num){
			if (bw.ns4){
				this.writeref.write(text)
				this.writeref.close()
			}
		    else this.writeref.innerHTML = messages[num]
		}

		//The mouoseover function. Calls the writeIt method to write the text to the div.
		function changeText(num){
			if(bw.bw) oMessage.writeIt('<table width="'+msgWidth+'" border="0" cellpadding="0" cellspacing="0"><tr><td><span style="font-size:'+msgFontSize+'px; font-family:'+msgFont+'; color:'+msgFontColor+'">'+messages[num]+'</span></td></tr></table>', num)
		}

		//The init function. Calls the object constructor and initiates some properties.
		function changeTextInit(){
			//Fixing the browsercheck for opera... this can be removed if the browsercheck has been updated!!
			bw.opera5 = (navigator.userAgent.indexOf("Opera")>-1 && document.getElementById)?true:false
			if (bw.opera5) bw.ns6 = 0
	
			oMessage = new makeChangeTextObj('divMessage')
			oLinks = new makeChangeTextObj('divLinks')
			//Setting the style properties of the text layer.
			if(bw.dom || bw.ie4){
				with(oMessage.writeref.style){fontFamily=msgFont; fontSize=msgFontSize+"px"; color=msgFontColor}
			}
			//Both layers are hidden by default to prevent users from mousing over them and creating errors while the page loads.
			oMessage.css.visibility= "visible"
			oLinks.css.visibility= "visible"
		}

		//If the browser is ok, the init function is called on pageload. 
		//Moved to <body> tag - JS
		//if (bw.bw) onload = changeTextInit
// END FUNCTION CHANGETEXT (MENU HELP TEXT) ---


// BEGIN FUNCTION TO VALIDATE ORDER (NAME & EMAIL) FORM ---
//	function orderform(form,id) {
//		if (form['name'].value == "" || form['email'].value == "") {
//			document.getElementById(id).style.visibility = "visible";
//			document.form3.prod.value = form["prod"].value;
//			document.form3.name.value = form["name"].value;
//			document.form3.email.value = form["email"].value;
//			document.form3.name.focus();
//			return false;
//		}else if (form['email'].value != "") {
//			result = verifyemail(form['email'].value);
//			if (result == true){
//				form.submit('this');
//			}
//			return false;
//		}
//	}
// END FUNCTION TO VALIDATE ORDER (NAME & EMAIL) FORM ---



//	function vanish(id) {
//		document.getElementById(id).style.visibility = "hidden";
//		return true;
//	}

	
	
	
	
//	function doBlink() {
		// Blink, Blink, Blink...
//		var blink = document.all.tags("BLINK")
//		for (var i=0; i < blink.length; i++)
//			blink[i].style.visibility = blink[i].style.visibility == "" ? "hidden" : "" 
//	}

//	function startBlink() {
		// Only if it's IE
//		if (document.all)
//			setInterval("doBlink()",500)
//	}
	//window.onload = startBlink;


/*
function textPulse(elementId) {
	var interval = 1000;
	var color1 = "#ff0000", color2 = "#aa0000";
var pulse = document.all.span.id("pulse")
for (var i=0; i < pulse.length; i++)
//	if (document.getElementById) {
//		var element = document.getElementById(elementId);
//		element.style.color = (element.style.color == color1) ? color2 : color1;
//		setTimeout("textPulse('" + elementId + "')", interval);
		pulse[i].style.color = (pulse[i].style.color == color1) ? color2 : color1;
		setTimeout("textPulse('" + elementId + "')", interval);
	}
}
//window.onload = textPulse("pulse");
*/

// BEGIN FUNCTIONS TO POP & HIDE PROMO LAYER(S) ---
function hideAd(divId){
	if (document.layers) document.layers[divId].visibility = 'hide';
	else if (document.all) document.all[divId].style.visibility = 'hidden';
	else if (document.getElementById) document.getElementById(divId).style.visibility = 'hidden';
	if (document.all){ // IE animated gif fix
		setTimeout("document.all.carriers.src = document.all.carriers.src;",1); 
		setTimeout("document.all.fbox1.src = document.all.fbox1.src;",1); 
		setTimeout("document.all.fbox2.src = document.all.fbox2.src;",1); 
		setTimeout("document.all.fbox3.src = document.all.fbox3.src;",1); 
		setTimeout("document.all.pbox1.src = document.all.pbox1.src;",1); 
		setTimeout("document.all.pbox2.src = document.all.pbox2.src;",1); 
		setTimeout("document.all.pbox3.src = document.all.pbox3.src;",1); 
		setTimeout("document.all.pbox4.src = document.all.pbox4.src;",1); 
		setTimeout("document.all.pbox5.src = document.all.pbox5.src;",1); 
		setTimeout("document.all.pbox6.src = document.all.pbox6.src;",1); 
	}
}

function showAd(divId){
	if (document.layers) document.layers[divId].visibility = 'show';
	else if (document.all) document.all[divId].style.visibility = 'visible';
	else if (document.getElementById) document.getElementById(divId).style.visibility = 'visible';
}

function adDown(divId, top){
	setTimeout("showAd('"+divId+"');",0);
	if(typeof topPos == 'undefined') topPos=top;
	if(topPos <= 150){
		topPos+=25;
		if (document.layers) document.layers[divId].top = topPos;
		else if (document.all) document.all[divId].style.top = topPos;
		else if (document.getElementById) document.getElementById(divId).style.top = topPos;	
		setTimeout("adDown('"+divId+"');",5);
	}else{
		topPos=top;
	}
	if (document.all) setTimeout("document.all.carriers.src = document.all.carriers.src;",1); // IE animated gif fix
}

function popAd(){
	adDown('Regional3K', -450);
	setTimeout("hideAd('Regional3K');",10000);
}

// END FUNCTIONS TO POP & HIDE PROMO LAYER(S) ---



var exit=true;
function adios(){
//	var page = 'index.php';
//	var win = 'toolbar=0,directories=0,menubar=0,scrollbars=0,resizable=0,width=500,height=300';
//	if (exit) open(page,'WindowName',win);
////	if (exit) alert("Boo");
}


