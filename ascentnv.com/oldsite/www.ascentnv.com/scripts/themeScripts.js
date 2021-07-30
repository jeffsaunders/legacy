function AdjustLeftNav(nPixelsPerMenuItem,nLeftNavSize)
{
	return;
}


function AdjustTopNav(nPixelsPerMenuItem,nLeftNavSize)
{
	return;
}

function DDLang(language)
{
	var bDoorwayLoaded = false;
	try
	{
		bDoorwayLoaded = gbDoorwayLoaded;
	}
	catch(ex){}
	if(bDoorwayLoaded)
	{
	alert("Please fill out the form currently loaded or if possible skip the form before switching to " + language + ". Thank you.");
	}
	else
	{
	prefix = "";
	tempArg = "ChosenLanguage=" + language;
	tempLocation = location.href;
	nStart = tempLocation.toLowerCase().indexOf("/", 8) + 1;

	// Pull #
	if(tempLocation.indexOf("#") != -1)
	{
	tempLocation = tempLocation.substr(0, tempLocation.indexOf("#"));
	}

	// Determine if the URL is to a physical file.
	if((tempLocation.toLowerCase().indexOf(".aspx") != -1) || (nStart == tempLocation.length) || (tempLocation.indexOf("?ChosenLanguage=") != -1))
	{
	
		//Pull Existing Language Querystring
		if(tempLocation.indexOf("?ChosenLanguage=") != -1)
		{
			tempLocation = tempLocation.substr(0, tempLocation.indexOf("?ChosenLanguage="));
			prefix = "?";
		}
		else if(tempLocation.indexOf("&ChosenLanguage=") != -1)
		{
			tempLocation = tempLocation.substr(0, tempLocation.indexOf("&ChosenLanguage="));
			prefix = "&";
		}
		else if(tempLocation.indexOf("?") == -1)
		{
		prefix = "?";
		}
		else if(tempLocation.indexOf("&") == -1)
		{
		prefix = "&";
		}
	}
	else
	{
		//Pull Existing Language Querystring
		if (tempLocation.toLowerCase().indexOf("/english") != -1)
		{
		tempLocation = tempLocation.substr(0, tempLocation.toLowerCase().indexOf("/english"));
		}
		if (tempLocation.toLowerCase().indexOf("/spanish") != -1)
		{
		tempLocation = tempLocation.substr(0, tempLocation.toLowerCase().indexOf("/spanish"));
		}
		if (tempLocation.toLowerCase().indexOf("/french") != -1)
		{
		tempLocation = tempLocation.substr(0, tempLocation.toLowerCase().indexOf("/french"));
		}
		if (tempLocation.toLowerCase().indexOf("/german") != -1)
		{
		tempLocation = tempLocation.substr(0, tempLocation.toLowerCase().indexOf("/german"));
		}
		if (tempLocation.toLowerCase().indexOf("/portuguese") != -1)
		{
		tempLocation = tempLocation.substr(0, tempLocation.toLowerCase().indexOf("/portuguese"));
		}
		
		tempArg = "/" + language;
	}

	Cat = tempLocation + prefix + tempArg;
	window.location = Cat;
	}
}


function resizeIFrame(h)
{
	var w = document.getElementById("ContentIFrame").width;
	document.ContentIFrame.resizeTo(w,h);
}


var FlashResizer = function(){}
	FlashResizer.prototype.resizeFlash = function(flashID, newWidth, newHeight)
	{
		var obj = {};
		//debugger;
		if(document.getElementById(flashID))
		{
			obj = document.getElementById(flashID);
		}
		else if(document.getElementById(flashID + '2'))
		{
			obj = document.getElementById(flashID + '2');
		}
		
		if(obj)
		{
			if(newWidth != undefined){obj.width = newWidth;}
 			if(newHeight != undefined){obj.height = newHeight;}
 		}
	 	
 		if(navigator.appName.indexOf("Microsoft") != -1)
 		{
 			window.parent.resizeFrame(document.body.scrollWidth, document.body.scrollHeight + 10);
 		}
 		else
 		{
 			var objIFrame = window.parent.document.getElementById('gridFrame');
		 	
 			if(objIFrame && newHeight != undefined)
 			{
				objIFrame.height = newHeight;
			}
		}
	}

var resizer = new FlashResizer();

//================================================================================================
//7/07 ASL - Motion theme has its own resizeSWF function becuase its layout is a little different


