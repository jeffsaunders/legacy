//--------------------------------------------------------//
// Detect Browser, Version, & OS
var BrowserDetect = {
	init: function () {
		this.browser = this.searchString(this.dataBrowser) || "An unknown browser";
		this.version = this.searchVersion(navigator.userAgent)
			|| this.searchVersion(navigator.appVersion)
			|| "an unknown version";
		this.OS = this.searchString(this.dataOS) || "an unknown OS";
	},
	searchString: function (data) {
		for (var i=0;i<data.length;i++)	{
			var dataString = data[i].string;
			var dataProp = data[i].prop;
			this.versionSearchString = data[i].versionSearch || data[i].identity;
			if (dataString) {
				if (dataString.indexOf(data[i].subString) != -1)
					return data[i].identity;
			}
			else if (dataProp)
				return data[i].identity;
		}
	},
	searchVersion: function (dataString) {
		var index = dataString.indexOf(this.versionSearchString);
		if (index == -1) return;
		return parseFloat(dataString.substring(index+this.versionSearchString.length+1));
	},
	dataBrowser: [
		{ 	string: navigator.userAgent,
			subString: "OmniWeb",
			versionSearch: "OmniWeb/",
			identity: "OmniWeb"
		},
		{
			string: navigator.vendor,
			subString: "Apple",
			identity: "Safari"
		},
		{
			prop: window.opera,
			identity: "Opera"
		},
		{
			string: navigator.vendor,
			subString: "iCab",
			identity: "iCab"
		},
		{
			string: navigator.vendor,
			subString: "KDE",
			identity: "Konqueror"
		},
		{
			string: navigator.userAgent,
			subString: "Firefox",
			identity: "Firefox"
		},
		{
			string: navigator.vendor,
			subString: "Camino",
			identity: "Camino"
		},
		{		// for newer Netscapes (6+)
			string: navigator.userAgent,
			subString: "Netscape",
			identity: "Netscape"
		},
		{
			string: navigator.userAgent,
			subString: "MSIE",
			identity: "Explorer",
			versionSearch: "MSIE"
		},
		{
			string: navigator.userAgent,
			subString: "Gecko",
			identity: "Mozilla",
			versionSearch: "rv"
		},
		{ 		// for older Netscapes (4-)
			string: navigator.userAgent,
			subString: "Mozilla",
			identity: "Netscape",
			versionSearch: "Mozilla"
		}
	],
	dataOS : [
		{
			string: navigator.platform,
			subString: "Win",
			identity: "Windows"
		},
		{
			string: navigator.platform,
			subString: "Mac",
			identity: "Mac"
		},
		{
			string: navigator.platform,
			subString: "Linux",
			identity: "Linux"
		}
	]

};
//BrowserDetect.init();
// Returns:
// BrowserDetect.browser = Browser Name
// BrowserDetect.version = Browser Version Number
// BrowserDetect.OS = Operating System
// Display Example:
// document.write('You\'re using ' + BrowserDetect.browser + ' ' + BrowserDetect.version + ' on ' + BrowserDetect.OS + '!');


//--------------------------------------------------------//
// Determine browser width for centering
function getWidth(){
	var wdth = 0;
	if (window.innerWidth){
		wdth = window.innerWidth;
	}else{
		wdth = document.body.clientWidth;
	}
}


//--------------------------------------------------------//
// Swap images
// Declare images to swap
if (document.images) {
	// MouseOut Images
	img1off = new Image(); 
	img1off.src = "images/SprintLogoOff.gif"; 
//			img2off = new Image(); 
//			img2off.src = "images/NextelLogoOff.gif";
	img3off = new Image();
	img3off.src = "images/AT&TLogoOff.gif";
	img4off = new Image(); 
	img4off.src = "images/VerizonLogoOff.gif";   
	// MouseOver Images
	img1on = new Image(); 
	img1on.src = "images/SprintLogo.gif"; 
//			img2on = new Image(); 
//			img2on.src = "images/NextelSprintLogo.gif";
	img3on = new Image();
	img3on.src = "images/AT&TLogo.gif";
	img4on = new Image(); 
	img4on.src = "images/VerizonLogo.gif";   
}

// Swap Image
function imgOn(imgName) {
       if (document.images) {
           document[imgName].src = eval(imgName + "on.src");
       }
}
function imgOff(imgName) {
       if (document.images) {
           document[imgName].src = eval(imgName + "off.src");
       }
}


//--------------------------------------------------------//
