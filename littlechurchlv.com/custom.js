// --- Menu Buttons

// Begin Loading Images for Menu Buttons
if (document.images) {

// MouseOver Images
	btn1on = new Image(); 
	btn1on.src = "images/Buttons/Home-On.png"; 
	btn2on = new Image(); 
	btn2on.src = "images/Buttons/AboutUs-On.png";
	btn3on = new Image();
	btn3on.src = "images/Buttons/Packages-On.png";
	btn4on = new Image(); 
	btn4on.src = "images/Buttons/Services-On.png";   
	btn5on = new Image();
	btn5on.src = "images/Buttons/Webcam-On.png";
	btn6on = new Image();
	btn6on.src = "images/Buttons/Questions-On.png";
	btn7on = new Image();
	btn7on.src = "images/Buttons/Reservations-On.png";
	btn8on = new Image();
	btn8on.src = "images/Buttons/Contact-On.png";

// MouseOut Images
	btn1off = new Image(); 
	btn1off.src = "images/Buttons/Home-Off.png"; 
	btn2off = new Image(); 
	btn2off.src = "images/Buttons/AboutUs-Off.png";
	btn3off = new Image();
	btn3off.src = "images/Buttons/Packages-Off.png";
	btn4off = new Image(); 
	btn4off.src = "images/Buttons/Services-Off.png";   
	btn5off = new Image();
	btn5off.src = "images/Buttons/Webcam-Off.png";
	btn6off = new Image();
	btn6off.src = "images/Buttons/Questions-Off.png";
	btn7off = new Image();
	btn7off.src = "images/Buttons/Reservations-Off.png";
	btn8off = new Image();
	btn8off.src = "images/Buttons/Contact-Off.png";
}

// Begin Swap Button
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

// Fading Slideshow	
// Full documentation -> http://www.dynamicdrive.com/dynamicindex14/fadeinslideshow.htm			
/*
var mygallery=new fadeSlideShow({
	wrapperid: "fadeshow1", //ID of blank DIV on page to house Slideshow
	dimensions: [225, 400], //width/height of gallery in pixels. Should reflect dimensions of largest image
//	imagearray: [
//		["path_to_image", "optional_url", "optional_linktarget", "optional_description"],
//		["dog.jpg", "", "", "This image has a description but no hyperlink/target"],
//		["http://i29.tinypic.com/xp3hns.jpg", "http://en.wikipedia.org/wiki/Cave", "_new", "Nice Picture!"] //<--no trailing comma after very last image
//	],
	imagearray: [
		["/images/slideshow/Home01.jpg"],
		["/images/slideshow/Home02.jpg"],
		["/images/slideshow/Home03.jpg"],
		["/images/slideshow/Home04.jpg"],
		["/images/slideshow/Home05.jpg"],
		["/images/slideshow/Home06.jpg"],
		["/images/slideshow/Home07.jpg"],
		["/images/slideshow/Home08.jpg"],
		["/images/slideshow/Home09.jpg"],
		["/images/slideshow/Home10.jpg"]
	],
//	displaymode: {type:'auto|manual', pause:milliseconds, cycles:0|integer, wraparound:true|false, randomize:true|false},
//	The "cycles" option when set to 0 will cause the slideshow to rotate perpetually in automatic mode, while any number larger than 0 means it will stop after x cycles.
//	The "warparound" option when set to false will disable the user's ability in manual mode to go past the very first and last slide when clicking on the navigation links to manually view the slides.
//	The "randomize" option when set to true will shuffle the display order of the images, so they appear in a different order each time the page is loaded.
//	In the following, the slideshow will auto run and stop after 3 complete cycles. Each time the page is reloaded, the order of the images randomly changes:
//	displaymode: {type:'auto', pause:3000, cycles:3, wraparound:true, randomize:true},
//	In the following, the slideshow will be put in manual mode, with the ability to loop back to the beginning of the slideshow disabled:
//	displaymode: {type:'manual', pause:2000, cycles:0, wraparound:false},
//	In manual mode, you must define your own "prev" and "next" controls to let the user control the slideshow. See "togglerid" option below for more info.
	displaymode: {type:'auto', pause:10000, cycles:0, wraparound:false, randomize:false},
	persist: false, //remember last viewed slide and recall within same session?
	fadeduration: 1000, //transition duration (milliseconds)
//	descreveal: "ondemand|always",
//	For a slideshow in which at least one image has a description associated with it, this option dictates the style of the Description Panel. The two choices are "ondemand" and "always". The former reveals the description when the user mouses over the slideshow, while the later shows a persistent description panel at the foot of the slideshow.
	descreveal: "ondemand",
//	togglerid: "slideshowtoggler"
//	Use this option if you wish to create navigational controls that allow the user to explicitly move back and forth between slides, whether the slideshow is in "auto" or "manual" mode. Set "togglerid" to the ID of another DIV on your page that will house the navigation controls for the slideshow
//	The DIV on the page with the corresponding ID attribute will be parsed by the script for links carrying a certain CSS class.
//	--- Example of toggler html code ---
//	<div id="fadeshow2"></div>
//	<div id="fadeshow2toggler" style="width:250px; text-align:center; margin-top:10px">
//	<a href="#" class="prev"><img src="http://i31.tinypic.com/302rn5v.png" style="border-width:0" /></a>  <span class="status" style="margin:0 50px; font-weight:bold"></span> <a href="#" class="next"><img src="http://i30.tinypic.com/lzkux.png" style="border-width:0" /></a>
//	</div>
	togglerid: ""
})
*/

// ---


