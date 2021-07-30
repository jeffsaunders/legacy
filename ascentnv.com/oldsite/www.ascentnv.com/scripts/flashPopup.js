var isInternetExplorer = navigator.appName.indexOf("Microsoft") != -1;

//************************************************************************************
// Handle all the FSCommand messages in a Flash movie.
//************************************************************************************

function topNav_DoFSCommand(command, args)
{
    DoFS(command, args);
}
function topNav2_DoFSCommand(command, args)
{
    DoFS(command, args);
}
function leftNav_DoFSCommand(command, args)
{
	//  var leftNavObj = isInternetExplorer ? document.all.leftNav : document.leftNav;
    DoFS(command, args);
}
function leftNav2_DoFSCommand(command, args)
{
	//  var leftNav2Obj = document.getElementById("leftNav2");
    DoFS(command, args);
}
function popupSwf_DoFSCommand(command, args)
{
    DoFS(command, args);
}
function popupSwf2_DoFSCommand(command, args)
{
    DoFS(command, args);
}

//  common FSCommand calls
function DoFS(command, args)
{    
    if (command == "hideAll")
	{
	    hideAll();
	}
    else if (command == "startTime")
    {
	    startTime();
    }
    else if (command == "stopTime")
    {
	    stopTime();
    }
    else if (command == "flashWrapper")
    {
        var argArray = args.split(",");
        flashWrapper(argArray[0], Number(argArray[1]), Number(argArray[2]), Number(argArray[3]));
    }
    else if(command == "resizeSWF")
    {
        var argArray = args.split(",");
        resizeSWFNested(argArray[0], argArray[1], argArray[2], argArray[3]);
    }
    else if(command == "sendCache")
    {
	var arg = args=="true"?true:false;
	sendCache(arg);
    }
}

//************************************************************************************
//NEW FLASH RESIZE TEST -- added by Robert Smith 5/11/06
//************************************************************************************

function setFlashWidth(divid, newW){
	document.getElementById(divid).style.width = newW+"px";
}
function setFlashHeight(divid, newH,flashID){
	resizeFlash(flashID, null, newH);
	document.getElementById(divid).style.height = newH+"px";
			
}
function setFlashSize(divid, newW, newH){
	setFlashWidth(divid, newW);
	setFlashHeight(divid, newH);
}
function canResizeFlash(){
	var ua = navigator.userAgent.toLowerCase();
	var opera = ua.indexOf("opera");
	if( document.getElementById ){
		if(opera == -1) return true;
		else if(parseInt(ua.substr(opera+6, 1)) >= 7) return true;
	}
	return false;
}


//************************************************************************************
// RESIZE FLASH OBJECT
//************************************************************************************
function resizeFlash(flashID, newWidth, newHeight)
{
	if(navigator.appName.indexOf("Microsoft") != -1){var obj = document.getElementById(flashID);}
	else{var obj = document.getElementById(flashID + '2');}
 	if(newWidth != undefined){obj.width = newWidth;}
 	if(newHeight != undefined){obj.height = newHeight;}
 	if(window.parent.document.getElementById('gridFrame') != undefined){window.parent.resizeFrame(newHeight + 40);}
}


function resizeSWFNested(objectTagName, embedTagName, newWidth, newHeight)
{
	var obj = {};
	
	if(document.getElementById(objectTagName))
	{
		obj = document.getElementById(objectTagName);
	}
	else if(document.getElementById(embedTagName))
	{
		obj = document.getElementById(embedTagName);
	}

	if(obj)
	{
		if(hasValue(newWidth)){obj.width = newWidth;}
 		if(hasValue(newHeight) && ((newHeight > 650 && obj == document.getElementById("leftNav")) || obj != document.getElementById("leftNav")))
		{
			obj.height = newHeight;
		}
 	}
}

function hasValue(v)
{
	return v != undefined && v != "" && v != null && v != "null";
}

function sendCache(b){
	try{
		if(navigator.appName.indexOf("Microsoft") != -1)
		{
			document.getElementById("topnav").SetVariable("_root.cache.checkCache", b);
			document.getElementById("leftnav").SetVariable("_root.cache.checkCache", b);
		}
		else
		{
			document.getElementById("topnav2").SetVariable("_root.cache.checkCache", b);
			document.getElementById("leftnav2").SetVariable("_root.cache.checkCache", b);
		}
	}
	catch(e){
		e = e;
	}
}

//-->


/*
function reDo()
{
	window.location.reload();
} 
window.onresize = reDo;
*/


//  Define global variables
var timerID = null;
var timerOn = false;
var timecount = 1000;

//  Change this to the time delay that you desire
var what = null;
var newbrowser = true;
var check = false;

//  The function flashPopupInit() determines for us what browser version that we are dealing with and assigns a values to the variables what, layerRef, styleSwitch and visibleVar, which we will use in our layer visibility toggling functions. We also assign the Boolean value ?true? to the check variable.
function flashPopupInit()
{
	if (document.layers)
	{
		what = "ns4";
	}
	else if(document.all)
	{
		what = "ie4";
	}
	else if(document.getElementById)
	{
		what="dom1";
	}
	else
	{
		what = "none";
		newbrowser = false;
	}
	check = true;
}


//  Toggles the layer visibility on 
function showLayer(layerName, yPos, divYStart, leftPos)
{
	if(check)
	{
		if (what == "none")
		{
			return;
		}
		else if (what == "dom1")
		{
			var oMozE = document.getElementById("leftNav2");
			oMozE = oMozE.parentNode.parentNode.parentNode.parentNode;
			document.getElementById(layerName).style.visibility = "visible";
			document.getElementById(layerName).style.left = oMozE.offsetLeft + leftPos + "px";
			document.getElementById(layerName).style.top = oMozE.offsetTop + divYStart + yPos + "px";
		}
		else
		{
			var oElement = document.all.flashNav;
			var tempLayerRef = document.all[layerName];
			tempLayerRef.style.visibility = "visible";
			tempLayerRef.style.left = oElement.offsetLeft + leftPos + "px";
			tempLayerRef.style.top = oElement.offsetTop + divYStart + yPos + "px";
		}
	}
	else
	{
		return;
	}
}




//  Toggles the layer visibility off 
function hideLayer(layerName)
{
if(check)
	{
		if (what == "none")
		{
			return;
		}
		else if (what == "dom1")
		{
			document.getElementById(layerName).style.visibility="hidden";
		}
		else
		{
			var tempLayerRef = document.all[layerName];
			if(tempLayerRef)
			{
				tempLayerRef.style.visibility="hidden";
			}
		}
	}
	else
	{
		return;
	}
}

//  hide all
function hideAll()
{
    //  Put all layers used in the nav here.
    hideLayer('flashPopupNavLeft');
    //  hideLayer(' ');
    //  hideLayer(' ');
}

function startTime()
{
	if (timerOn == false)
	{
		timerID = setTimeout("hideAll()", timecount);
		timerOn = true;
	}
}

function stopTime()
{
	if (timerOn)
	{
		clearTimeout(timerID);
		timerID = null;
		timerOn = false;
	}
}


/*
function onLoad()
{
	flashPopupInit();
}
*/


flashPopupInit();


function flashWrapper(a_szLayer, a_nYPos, a_nDivYStart, a_nDivWidth)
{
	hideAll();
	showLayer(a_szLayer, a_nYPos, a_nDivYStart, a_nDivWidth);
	stopTime();
}

