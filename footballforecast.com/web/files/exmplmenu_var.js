/***********************************************************************************
*	(c) Ger Versluis 2000 version 5.411 24 December 2001 (updated Jan 31st, 2003 by Dynamic Drive for Opera7)
*	For info write to menus@burmees.nl		          *
*	You may remove all comments for faster loading	          *		
***********************************************************************************/

	var NoOffFirstLineMenus=13;			// Number of first level items
	var LowBgColor='#9C0000';			// Background color when mouse is not over
	var LowSubBgColor='black';			// Background color when mouse is not over on subs
	var HighBgColor='black';			// Background color when mouse is over
	var HighSubBgColor='#088A18';			// Background color when mouse is over on subs
	var FontLowColor='white';			// Font color when mouse is not over
	var FontSubLowColor='#FFCB00';			// Font color subs when mouse is not over
	var FontHighColor='#FFCB00';			// Font color when mouse is over
	var FontSubHighColor='white';			// Font color subs when mouse is over
	var BorderColor='#CECFCE';			// Border color
	var BorderSubColor='#CECFCE';			// Border color for subs
	var BorderWidth=2;				// Border width
	var BorderBtwnElmnts=1;			// Border between elements 1 or 0
	var FontFamily="arial,comic sans ms,technical"	// Font family menu items
	var FontSize=10;				// Font size menu items
	var FontBold=1;				// Bold menu items 1 or 0
	var FontItalic=0;				// Italic menu items 1 or 0
	var MenuTextCentered='left';			// Item text position 'left', 'center' or 'right'
	var MenuCentered='left';			// Menu horizontal position 'left', 'center' or 'right'
	var MenuVerticalCentered='top';		// Menu vertical position 'top', 'middle','bottom' or static
	var ChildOverlap=0;				// horizontal overlap child/ parent
	var ChildVerticalOverlap=0;			// vertical overlap child/ parent
	var StartTop=0;				// Menu offset x coordinate
	var StartLeft=0;				// Menu offset y coordinate
	var VerCorrect=0;				// Multiple frames y correction
	var HorCorrect=0;				// Multiple frames x correction
	var LeftPaddng=3;				// Left padding
	var TopPaddng=2;				// Top padding
	var FirstLineHorizontal=0;			// SET TO 1 FOR HORIZONTAL MENU, 0 FOR VERTICAL
	var MenuFramesVertical=1;			// Frames in cols or rows 1 or 0
	var DissapearDelay=1000;			// delay before menu folds in
	var TakeOverBgColor=1;			// Menu frame takes over background color subitem frame
	var FirstLineFrame='navig';			// Frame where first level appears
	var SecLineFrame='space';			// Frame where sub levels appear
	var DocTargetFrame='space';			// Frame where target documents appear
	var TargetLoc='menuPos';				// span id for relative positioning
	var HideTop=0;				// Hide first level when loading new document 1 or 0
	var MenuWrap=1;				// enables/ disables menu wrap 1 or 0
	var RightToLeft=0;				// enables/ disables right to left unfold 1 or 0
	var UnfoldsOnClick=0;			// Level 1 unfolds onclick/ onmouseover
	var WebMasterCheck=0;			// menu tree checking on or off 1 or 0
	var ShowArrow=0;				// Uses arrow gifs when 1
	var KeepHilite=1;				// Keep selected path highligthed
	var Arrws=['tri.gif',5,10,'tridown.gif',10,5,'trileft.gif',5,10];	// Arrow source, width and height

function BeforeStart(){return}
function AfterBuild(){return}
function BeforeFirstOpen(){return}
function AfterCloseAll(){return}


// Menu tree
//	MenuX=new Array(Text to show, Link, background image (optional), number of sub elements, height, width);
//	For rollover images set "Text to show" to:  "rollover:Image1.jpg:Image2.jpg"

Menu1=new Array("Home","index.php","",0,25,150);

Menu2=new Array("Member Area","member.php","",7);
	Menu2_1=new Array("Existing Member Login","login.php","",0,20,175);	
	Menu2_2=new Array("New Member Signup","signup.php","",0);
	Menu2_3=new Array("> Access Paid Picks","paidpicks.php","",0);
	Menu2_4=new Array("> Access Free Picks","freepicks.php","",0);
	Menu2_5=new Array("> Access Weekly Video","multimedia.php","",0);
	Menu2_6=new Array("> Access Archive","archives.php","",0);
	Menu2_7=new Array("> Member Profile","member.php","",0);

Menu3=new Array("TV Multimedia","multimedia.php","",0);

Menu4=new Array("Free Picks","freepicks.php","",0);

Menu5=new Array("TV Show Info","tvshow.php","",0);

Menu6=new Array("TV Market","tvmarket.php","",0);

Menu7=new Array("Biography","bio.php","",0);

Menu8=new Array("Handicappers","handicappers.php","",4);
	Menu8_1=new Array("Dennis Tobler","hc1.php","",0,20,150);	
	Menu8_2=new Array("Jimbo Burford","hc2.php","",0);
	Menu8_3=new Array("Brian Resnick","hc3.php","",0);
	Menu8_4=new Array("All Handicappers","handicappers.php","",0);

Menu9=new Array("Video Archive","archives.php","",0);

Menu10=new Array("Advertising","advertising_tv.php","",4);
	Menu10_1=new Array("TV Advertising","advertising_tv.php","",0,20,150);	
	Menu10_2=new Array("TV Inquiry Form","advertising_inquiry_tv.php","",0);
	Menu10_3=new Array("Web Advertising","advertising_web.php","",0);
	Menu10_4=new Array("Web Inquiry Form","advertising_inquiry_web.php","",0);

Menu11=new Array("Links","links.php","",4);
	Menu11_1=new Array("Affiliated Links","links.php","",0,20,150);	
	Menu11_2=new Array("Associated Sites & Banners","banners.php","",0);
	Menu11_3=new Array("Link Exchange Requirement","linkex_details.php","",0);
	Menu11_4=new Array("Link Exchange Inquiry Form","linkex_inquiry.php","",0);

Menu12=new Array("FAQ's","faq.php","",0);

Menu13=new Array("Contact","contact.php","",0);

