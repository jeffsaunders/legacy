//window.onerror=TrapError;	

function ChangeImage(obj, ImagePath)
	{
		obj.src = ImagePath
	}    
	
function PreLoadImage(aryImages)
{
   	for(loop = 0; loop < aryImages.length; loop++)
    	{
    		var an_image = new Image();
    		an_image.src = aryImages[loop];
    	}		
}

function TrapError(msg)
	{
	alert(msg);
	return true;
	}	

function move_in(img_name,img_src)
	{
	document[img_name].src=img_src;
	}

function move_out(img_name,img_src)
	{
	document[img_name].src=img_src;
	}
	
	
function OpenWindowCentered(szURL, szWindowName, nHeight, nWidth, bytSizable, bytScrollBars)
	{
	//Centers a window and removes toolbars and such
	//1=True; 0=False
	var intTop = (screen.availHeight - nHeight) / 2;
	var intLeft = (screen.availWidth - nWidth) / 2;
				
	return window.open(szURL, szWindowName, "toolbar=no,  top=" + intTop + ", left=" + intLeft + ", location=no, directories=no, menubar=no, status=no, scrollbars=" + bytScrollBars + ", resizable=" + bytSizable + ", width=" + nWidth + ", height="+ nHeight + "");				
	}
		
	
function setRadioValue(radioName, value)
	{
	var collection = document.getElementsByName(radioName);
	
	for (i=0;i<collection.length;i++)
		{
		if (collection[i].value == value)
			{
			collection[i].checked = true;
			}
		}	
	}			
	
function getRadioValue(radioName)
	{
	var collection = document.getElementsByName(radioName);

	for (i=0;i<collection.length;i++)
		{
		if (collection[i].checked)
			return(collection[i].value);
		}
	}	
	
function toggle(e) 
	{
	if (e.style.display == "none") 
		{
		e.style.display = "";
		} 
	else 
		{
		e.style.display = "none";
		}
	}	
	
function ValidImage(szFileName)
	{
	//Valid Image Extensions
	var nLen = szFileName.length;
	var szExt = szFileName.substring(nLen - 3, nLen);
	
	switch(szExt.toLowerCase())
		{
		case "jpg":
			return(true);
		case "gif":
			return(true);
		case "bmp":
			return(true);
		case "png":
			return(true);
		default:
			return(false);
		}
	}
function imgTag()
	{
		if (document.selection.type == "Control")
		{ 
			var oRange = document.selection.createRange();
			if (oRange(0).tagName == 'IMG')
			{
				return(true);
			}				
		}
		return(false);
	}
	
function validEmail(szEmail) {
	var nIndexAT = szEmail.indexOf("@",1);
	var nIndexDot = szEmail.indexOf(".", nIndexAT);
	var nCounter, nIndexBad;
	var szInvalid = "/,;"

	if(szEmail != null || szEmail != "") {
		if (nIndexAT < 0 || nIndexDot < 0) {
			return false;
		} 
		for(nCounter=0; nCounter < szInvalid.length; nCounter++) {
			if (szEmail.indexOf(szInvalid.charAt(nCounter)) >= 0) {
				return false;
				break;
			}
		}
	}
	return true
}

function test(){
alert("test")
}

/*
==================================================================
LTrim(string) : Returns a copy of a string without leading spaces.
==================================================================
*/
function LTrim(str)
/*
   PURPOSE: Remove leading blanks from our string.
   IN: str - the string we want to LTrim
*/
{
   var whitespace = new String(" \t\n\r");

   var s = new String(str);

   if (whitespace.indexOf(s.charAt(0)) != -1) {
      // We have a string with leading blank(s)...

      var j=0, i = s.length;

      // Iterate from the far left of string until we
      // don't have any more whitespace...
      while (j < i && whitespace.indexOf(s.charAt(j)) != -1)
         j++;

      // Get the substring from the first non-whitespace
      // character to the end of the string...
      s = s.substring(j, i);
   }
   return s;
}

/*
==================================================================
RTrim(string) : Returns a copy of a string without trailing spaces.
==================================================================
*/
function RTrim(str)
/*
   PURPOSE: Remove trailing blanks from our string.
   IN: str - the string we want to RTrim

*/
{
   // We don't want to trip JUST spaces, but also tabs,
   // line feeds, etc.  Add anything else you want to
   // "trim" here in Whitespace
   var whitespace = new String(" \t\n\r");

   var s = new String(str);

   if (whitespace.indexOf(s.charAt(s.length-1)) != -1) {
      // We have a string with trailing blank(s)...

      var i = s.length - 1;       // Get length of string

      // Iterate from the far right of string until we
      // don't have any more whitespace...
      while (i >= 0 && whitespace.indexOf(s.charAt(i)) != -1)
         i--;


      // Get the substring from the front of the string to
      // where the last non-whitespace character is...
      s = s.substring(0, i+1);
   }

   return s;
}

/*
=============================================================
Trim(string) : Returns a copy of a string without leading or trailing spaces
=============================================================
*/
function Trim(str)
/*
   PURPOSE: Remove trailing and leading blanks from our string.
   IN: str - the string we want to Trim

   RETVAL: A Trimmed string!
*/
{
   return RTrim(LTrim(str));
}

function TellMeMore(Left, Top, Width, Height, Text, Control)
{
	var szHtml = "<table width=100% cellspacing=3 cellpadding=3 border=0>";
	szHtml += "<tr><td colspan=3></td></tr>";
	szHtml += "<tr><td></td><td><div style='FONT-SIZE: 8pt; COLOR: #666666; FONT-FAMILY: Verdana;HEIGHT: 200px; Width: 100%;OVERFLOW-X: hidden; OVERFLOW: auto;'>";
	szHtml += "<p> <font face='Verdana' size='1'>";
	szHtml += Text;
	szHtml += "</font></p>";
	szHtml += "</div></td><td></td></tr>";
	szHtml += "<tr><td colspan=3></td></tr></table>";
	var oPopup = window.createPopup();
	oPopup.document.body.style.backgroundColor = "#FFFFC1";
	oPopup.document.body.style.border = "solid black 1px";
	oPopup.document.body.innerHTML = szHtml;
	oPopup.show(Left, Top, Width, Height, Control);
}