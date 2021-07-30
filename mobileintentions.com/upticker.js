// Display Typwriter Scroller
//var tags_before = "<strong>";
//var tags_after  = "</strong>";
//	'<font color="#FF0000"><strong>',
//	'</strong></font>',
var tags_before = '';
var tags_after  = '';
//var tags_after  = '</a><span class="scrollWhite">&#95;</span>';
var speed = 50;  //delay between "key strokes"
var speed2 = 5000; //delay between messages

function initArray() {
	this.length = initArray.arguments.length;
	for (var i = 0; i < this.length; i++) {
		this[i] = initArray.arguments[i];
	}
}
/*
        '<strong class="scrollWhite">',
        '<strong><a href="?sec=details&prod=100" class="scrollWhite">
        '<strong><a href="?sec=details&prod=134" class="scrollWhite">',
        '<strong><a href="?sec=details&prod=137" class="scrollWhite">',
        '<strong class="scrollWhite">',
        '<strong><a href="?sec=details&prod=101" class="scrollWhite">',
        '<strong><a href="?sec=details&prod=57" class="scrollWhite">',
        '<strong><a href="?sec=details&prod=131" class="scrollWhite">'
*/
var myopentag = new initArray(
	'<strong class="scrollWhite">',
	'<strong class="scrollWhite">',
//	'<strong class="scrollWhite">',
	'<strong class="scrollWhite">',
	'<strong class="scrollWhite">',
	'<strong class="scrollWhite">',
	'<strong class="scrollWhite">',
	'<strong class="scrollWhite">',
	'<strong class="scrollWhite">'
)
var mymessage = new initArray(
	'Mobile Intentions is a T-Mobile Authorized Dealer.',
	'Lowest Out-Of-Pocket Prices for T-Mobile Phones - PERIOD!',
//	'Announcing a Mobile Intentions EXCLUSIVE - FREE ACTIVATION!! (Save an Additional $35 per Phone)',
	'Tired of Waiting 6 Months or MORE Wondering If You Will Ever Get That Rebate?',
	'No Rebate Hassle...All Rebates are Instant at Mobile Intentions. (except rebates direct from T-Mobile)',
//	'No Mail-In Rebates! *Except those from T-Mobile itself.',
	'Mobile Intentions - Your Source for Everything T-Mobile.',
//	'Announcing a Mobile Intentions EXCLUSIVE - FREE ACTIVATION!! (Save an Additional $35 per Phone)',
//	'MAKE Money Buying Phones from Mobile Intentions...',
	'Several of our Most Popular Phones are FREE - BlackBerry, RAZR, PEBL...',
//	'PLUS T-Mobile Mail-In Rebates Net You a PROFIT!',
	'FREE Motorola Bluetooth Headset with Every Blackberry 7105t!',
	'The NEW T-Mobile Dash is here! A Smart, Sleek, and Complete PDA.'
//	'T-Mobile MDA - The Ultimate PDA. Click below to learn more.',
//	'The "Pink" RAZR is here!',
//	'Motorola V360 - Cameraphone and MP3 Player, all-in-one!',
//	'Get your Silver RAZR here - it\'s a Best Seller!',
//	'The Motorola PEBL - So Smooooth.....'
)
/*
	'&#95;</strong>',
	'&#95;</strong>',
	'&#95;</strong>',
	'&#95;</strong>',
	'&#95;</strong>',
	'&#95;</strong>',
	'&#95;</strong>',
	'&#95;</strong>',
	'&#95;</strong>'
*/
var myclosetag = new initArray(
	'&#95;</strong>',
	'&#95;</strong>',
//	'&#95;</strong>',
	'&#95;</strong>',
	'&#95;</strong>',
	'&#95;</strong>',
	'&#95;</strong>',
	'&#95;</strong>',
	'&#95;</strong>'
)
var mymessage2 = mymessage;
var x = 0;
var y = 0;

if(navigator.appName == "Netscape") {
	document.write('<layer id="ticker"></layer><br>');
}

if (navigator.appVersion.indexOf("MSIE") != -1){
	document.write('<span id="ticker"></span><br>');
}

function upticker(){ 
	if (y > mymessage2.length - 1) {
		y = 0;
		setTimeout("upticker()",speed);
	}else{
		if (x > mymessage2[y].length) {
			mymessage = mymessage2[y]; 
			opentag = myopentag[y];
			closetag = myclosetag[y];
			x = 0; y++;
			setTimeout("upticker()",speed2);
		}else{
			mymessage = mymessage2[y].substring(0,x++);
			opentag = myopentag[y];
			closetag = myclosetag[y];
			setTimeout("upticker()",speed);
		}
		if(navigator.appName == "Netscape") {
			ticker.innerHTML = tags_before+opentag+mymessage+tags_after+closetag;
//			document.ticker.visibility='show';
//			ticker.document.write(tags_before+opentag+mymessage+tags_after+closetag);
			ticker.document.write("xxx");
			ticker.document.close();
		}
		if (navigator.appVersion.indexOf("MSIE") != -1){
			ticker.innerHTML = tags_before+opentag+mymessage+tags_after+closetag;
		}
	}
} 

setTimeout("upticker()",speed);
