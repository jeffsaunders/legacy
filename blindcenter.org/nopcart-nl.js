// JavaScript Shop Module, V.4.4.0  - more info: http://www.nopdesign.com
// IS: 15-4-2003 22:53
// =======================================================================
MonetarySymbol		= '€ ';
DisplayNotice		= true;
DisplayShippingColumn	= true;
DisplayShippingRow	= true;
DisplayTaxRow		= true;
TaxRate			= 0.06;
TaxRateHigh		= 0.19;
TaxByRegion		= false;
TaxPrompt		= 'btw';
TaxablePrompt		= 'btw';
NonTaxablePrompt	= '';
MinimumOrder		= 37.50;
MinimumOrderPrompt	= 'Your order is below our minimum order (€ 37,50),\n please order more before checking out.';
PaymentProcessor	= '';
// =======================================================================
OutputItemId		= 'ID_';
OutputItemQuantity	= 'QUANTITY_';
OutputItemPrice		= 'PRICE_';
OutputItemName		= 'NAME_';
OutputItemShipping	= 'DELIVERY_';
OutputItemAddtlInfo	= 'ADDTLINFO_';
OutputOrderSubtotal	= 'SUBTOTAL';
OutputOrderShipping	= 'DELIVERY';
OutputOrderTax		= 'BTW';
OutputOrderTotal	= 'TOTAL';
AppendItemNumToOutput	= true;
HiddenFieldsToCheckout	= true;
// =======================================================================
if ( !bLanguageDefined ) {
   strSorry  = "I'm Sorry, your cart is full, please proceed to checkout.";
   strAdded  = " added to your shopping cart.";
   strRemove = "Click 'Ok' to remove this product from your shopping cart.";
   strILabel = "Prod.ID";
   strDLabel = "Description";
   strQLabel = "Qty";
   strPLabel = "Price";
   strSLabel = "Delivery";
   strRLabel = "Remove From Cart";
   strRButton= "Remove";
   strSUB    = "SUBTOTAL";
   strSHIP   = "DELIVERY";
   strTAX    = "TAX";
   strTOT    = "TOTAL";
   strErrQty = "Invalid Quantity.";
   strNewQty = 'Please enter new quantity:';
   bLanguageDefined = true;
}

// ***** Jetset Custom Code - block return key pressed ****
function checkCR(evt) {
var evt  = (evt) ? evt : ((event) ? event : null);
var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
if ((evt.keyCode == 13) && (node.type=="text")) {return false;}
  }
document.onkeypress = checkCR;
// ***** END Custom Code ****

// ***** Jetset Custom Code - Delivery Labels ****
LocationLabel = 'ZONE'; 
// ***** END Jetset Custom Code ****


// =======================================================================
function CKquantity(checkString) {
var strNewQuantity = "";

for ( i = 0; i < checkString.length; i++ ) {
	ch = checkString.substring(i, i+1);
	if ( (ch >= "0" && ch <= "9") || (ch == '.') )
	strNewQuantity += ch;
   }

if ( 	strNewQuantity.length < 1 )
	strNewQuantity = "1";

return(strNewQuantity);
}

// =======================================================================
function AddToCart(thisForm) {
var iNumberOrdered = 0;
var bAlreadyInCart = false;
var notice = "";
iNumberOrdered = GetCookie("NumberOrdered");

if ( 	iNumberOrdered == null )
	iNumberOrdered = 0;

if (	thisForm.ID_NUM == null )
	strID_NUM    = "";
else
	strID_NUM    = thisForm.ID_NUM.value;

if (	thisForm.QUANTITY == null )
	strQUANTITY  = "1";
else
	strQUANTITY  = thisForm.QUANTITY.value;

if (	thisForm.PRICE == null )
	strPRICE     = "0.00";
else
	strPRICE     = thisForm.PRICE.value;

if (	thisForm.NAME == null )
	strNAME      = "";
else
	strNAME      = thisForm.NAME.value;

if (	thisForm.SHIPPING == null )
	strSHIPPING  = "0.00";
else
	strSHIPPING  = thisForm.SHIPPING.value;

if (	thisForm.ADDITIONALINFO == null ) {
	strADDTLINFO = "";
} else {
	strADDTLINFO = thisForm.ADDITIONALINFO[thisForm.ADDITIONALINFO.selectedIndex].value;
}

if (	thisForm.ADDITIONALINFO2 != null ) {
	strADDTLINFO += "" + thisForm.ADDITIONALINFO2[thisForm.ADDITIONALINFO2.selectedIndex].value;
}

if (	thisForm.ADDITIONALINFO3 != null ) {
	strADDTLINFO += "" + thisForm.ADDITIONALINFO3[thisForm.ADDITIONALINFO3.selectedIndex].value;
}

if (	thisForm.ADDITIONALINFO4 != null ) {
	strADDTLINFO += "" + thisForm.ADDITIONALINFO4[thisForm.ADDITIONALINFO4.selectedIndex].value;
}

   //Is this product already in the cart?  If so, increment quantity instead of adding another.
for ( i = 1; i <= iNumberOrdered; i++ ) {
	NewOrder = "Order." + i;
	database = "";
	database = GetCookie(NewOrder);

	Token0 = database.indexOf("|", 0);
	Token1 = database.indexOf("|", Token0+1);
	Token2 = database.indexOf("|", Token1+1);
	Token3 = database.indexOf("|", Token2+1);
	Token4 = database.indexOf("|", Token3+1);

	fields = new Array;
	fields[0] = database.substring( 0, Token0 );
	fields[1] = database.substring( Token0+1, Token1 );
	fields[2] = database.substring( Token1+1, Token2 );
	fields[3] = database.substring( Token2+1, Token3 );
	fields[4] = database.substring( Token3+1, Token4 );
	fields[5] = database.substring( Token4+1, database.length );

	if ( 	fields[0] == strID_NUM &&
		fields[2] == strPRICE  &&
		fields[3] == strNAME   &&
		fields[5] == strADDTLINFO
	) {
		bAlreadyInCart = true;
		
		dbUpdatedOrder = strID_NUM    + "|" +
		(parseInt(strQUANTITY)+parseInt(fields[1]))  + "|" +
		strPRICE     + "|" +
		strNAME      + "|" +
		strSHIPPING  + "|" +
		strADDTLINFO;
		
		strNewOrder = "Order." + i;
		DeleteCookie(strNewOrder, "/");
		SetCookie(strNewOrder, dbUpdatedOrder, null, "/");
		
		//notice = strQUANTITY + " " + strNAME + strAdded;
		notice = strAdded + "\n-------------------------------------\n" + "Quantity : " + strQUANTITY + "\nProduct  : " + strNAME;
		break;
	}
}

if ( !bAlreadyInCart ) {
	iNumberOrdered++;

	if ( iNumberOrdered > 20 )
		alert( strSorry );
	else {
		dbUpdatedOrder = strID_NUM    + "|" + 
		strQUANTITY  + "|" +
		strPRICE     + "|" +
		strNAME      + "|" +
		strSHIPPING  + "|" +
		strADDTLINFO;

	strNewOrder = "Order." + iNumberOrdered;
	SetCookie(strNewOrder, dbUpdatedOrder, null, "/");
	SetCookie("NumberOrdered", iNumberOrdered, null, "/");
	//notice = strQUANTITY + " " + strNAME + strAdded;
	notice = strAdded + "\n-------------------------------------\n" + "Quantity : " + strQUANTITY + "\nProduct  : " + strNAME;
      }
   }

if ( DisplayNotice )
	alert(notice);
}

// =======================================================================
function getCookieVal (offset) {
var endstr = document.cookie.indexOf (";", offset);
if ( endstr == -1 )
endstr = document.cookie.length;
return(unescape(document.cookie.substring(offset, endstr)));
}

// =======================================================================
function FixCookieDate (date) {
var base = new Date(0);
var skew = base.getTime();
Date.setTime (date.getTime() - skew);
}

// =======================================================================
function GetCookie (name) {
var arg = name + "=";
var alen = arg.length;
var clen = document.cookie.length;
var i = 0;

while ( i < clen ) {
	var j = i + alen;
	if ( document.cookie.substring(i, j) == arg ) return(getCookieVal (j));
	i = document.cookie.indexOf(" ", i) + 1;
	if ( i == 0 ) break;
}
return(null);
}

// =======================================================================
function SetCookie (name,value,expires,path,domain,secure) {
	document.cookie = name + "=" + escape (value) +
	((expires) ? "; expires=" + expires.toGMTString() : "") +
	((path) ? "; path=" + path : "") +
	((domain) ? "; domain=" + domain : "") +
	((secure) ? "; secure" : "");
}

// =======================================================================
function DeleteCookie (name,path,domain) {
	if ( GetCookie(name) ) {
		document.cookie = name + "=" +
			((path) ? "; path=" + path : "") +
			((domain) ? "; domain=" + domain : "") +
			"; expires=Thu, 01-Jan-70 00:00:01 GMT";
	}
}

// =======================================================================
function moneyFormat(input) {
var dollars = Math.floor(input);
var tmp = new String(input);
	for ( var decimalAt = 0; decimalAt < tmp.length; decimalAt++ ) {
		if ( tmp.charAt(decimalAt)=="," )
		break;
}

	var 	cents  = "" + Math.round(input * 100);
		cents = cents.substring(cents.length-2, cents.length)
		dollars += ((tmp.charAt(decimalAt+2)=="9")&&(cents=="00"))? 1 : 0;

	if ( 	cents == "0" )
		cents = "00";

	return(dollars + "," + cents);
}


// =======================================================================
function RemoveFromCart(RemOrder) {
if ( confirm( strRemove ) ) {
	NumberOrdered = GetCookie("NumberOrdered");
	for ( i=RemOrder; i < NumberOrdered; i++ ) {
		NewOrder1 = "Order." + (i+1);
		NewOrder2 = "Order." + (i);
		database = GetCookie(NewOrder1);
		SetCookie (NewOrder2, database, null, "/");
	}
	NewOrder = "Order." + NumberOrdered;
	SetCookie ("NumberOrdered", NumberOrdered-1, null, "/");
	DeleteCookie(NewOrder, "/");
	location.href=location.href;
   }
}

// =======================================================================
function ChangeQuantity(OrderItem,NewQuantity) {
	if ( isNaN(NewQuantity) ) {
		alert( strErrQty );
	} else {
		NewOrder = "Order." + OrderItem;
		database = "";
		database = GetCookie(NewOrder);

		Token0 = database.indexOf("|", 0);
		Token1 = database.indexOf("|", Token0+1);
		Token2 = database.indexOf("|", Token1+1);
		Token3 = database.indexOf("|", Token2+1);
		Token4 = database.indexOf("|", Token3+1);

		fields = new Array;
		fields[0] = database.substring( 0, Token0 );
		fields[1] = database.substring( Token0+1, Token1 );
		fields[2] = database.substring( Token1+1, Token2 );
		fields[3] = database.substring( Token2+1, Token3 );
		fields[4] = database.substring( Token3+1, Token4 );
		fields[5] = database.substring( Token4+1, database.length );

		dbUpdatedOrder = fields[0] + "|" +
			NewQuantity + "|" +
			fields[2] + "|" +
			fields[3] + "|" +
			fields[4] + "|" +
			fields[5];
		strNewOrder = "Order." + OrderItem;
		DeleteCookie(strNewOrder, "/");
		SetCookie(strNewOrder, dbUpdatedOrder, null, "/");
		location.href=location.href;      
   }
}

// =======================================================================
function RadioChecked( radiobutton ) {
var bChecked = false;
var rlen = radiobutton.length;
for ( i=0; i < rlen; i++ ) {
	if ( radiobutton[i].checked )
		bChecked = true;
}    
	return bChecked;
} 

// =======================================================================
QueryString.keys = new Array();
QueryString.values = new Array();
function QueryString(key) {
	var value = null;
	for (var i=0;i<QueryString.keys.length;i++) {
		if (QueryString.keys[i]==key) {
			value = QueryString.values[i];
			break;
      }
   }
   return value;
} 

// =======================================================================
function QueryString_Parse() {
   var query = window.location.search.substring(1);
   var pairs = query.split("&"); for (var i=0;i<pairs.length;i++) {
      var pos = pairs[i].indexOf('=');
      if (pos >= 0) {
         var argname = pairs[i].substring(0,pos);
         var value = pairs[i].substring(pos+1);
         QueryString.keys[QueryString.keys.length] = argname;
         QueryString.values[QueryString.values.length] = value;
      }
   }
}

// =======================================================================
function ManageCart( ) {
var iNumberOrdered = 0;    //Number of products ordered
var fTotal         = 0;    //Total cost of order
var fTax           = 0;    //Tax amount
var fShipping      = 0;    //Shipping amount
var strTotal       = "";   //Total cost formatted as money
var strTax         = "";   //Total tax formatted as money
var strShipping    = "";   //Total shipping formatted as money
var strOutput      = "";   //String to be written to page
var bDisplay       = true; //Whether to write string to the page (here for programmers)
   
iNumberOrdered = GetCookie("NumberOrdered");
if ( iNumberOrdered == null )
	iNumberOrdered = 0;
      
LocationSelected = GetCookie("ZoneSelected");
if ( LocationSelected == null )
	LocationSelected = 1; // Default zone

if ( bDisplay )
	strOutput = 	"<TABLE CELLSPACING=0 CELLPADDING=0 BORDERCOLOR=#FFFFFF BORDER=1 CLASS=\"nopcart\"><TR height=25>" +
			"<TD WIDTH=75 CLASS=\"nopheader\"><strong>"+strILabel+"</strong></TD>" +
			"<TD WIDTH=220 CLASS=\"nopheader\"><strong>"+strDLabel+"</strong></TD>" +
			"<TD ALIGN=CENTER CLASS=\"nopheader\"><strong>"+strQLabel+"</strong></TD>" +
			"<TD ALIGN=RIGHT WIDTH=80 CLASS=\"nopheader\"><strong>"+strPLabel+"</strong></TD>" +
//			"<TD CLASS=\"nopheader\" ALIGN=RIGHT WIDTH=80><strong>"+strPTLabel+"</strong></TD>" + 
			"<TD WIDTH=90 CLASS=\"nopheader\"></TD></TR>"; //removed: <strong>"+strRLabel+"</strong>

if ( iNumberOrdered == 0 ) {
	strOutput += 	"<TR><TD COLSPAN=6 CLASS=\"lpitems\"><CENTER><BR><strong>"+strEmpty+"</strong><BR><BR></CENTER></TD></TR>";
   }

for ( i = 1; i <= iNumberOrdered; i++ ) {
	NewOrder = "Order." + i;
	database = "";
	database = GetCookie(NewOrder);

	Token0 = database.indexOf("|", 0);
	Token1 = database.indexOf("|", Token0+1);
	Token2 = database.indexOf("|", Token1+1);
	Token3 = database.indexOf("|", Token2+1);
	Token4 = database.indexOf("|", Token3+1);

	fields = new Array;
	fields[0] = database.substring( 0, Token0 );// Product ID
	fields[1] = database.substring( Token0+1, Token1 );// Quantity
	fields[2] = database.substring( Token1+1, Token2 );// Price
	fields[3] = database.substring( Token2+1, Token3 );// Product Name/Description
	fields[4] = database.substring( Token3+1, Token4 );// Shipping Cost
	fields[5] = database.substring( Token4+1, database.length );//Additional Information

	fTotal  += (parseInt(fields[1]) * parseFloat(fields[2]) );
	fprodttl = (fields[1]) * (fields[2]); // TTL PROD = QTY * PRICE
	fTax     = (fTotal * TaxRate);
      
	strTotal    = moneyFormat(fTotal);
	strTax      = moneyFormat(fTax);
	strShipping = moneyFormat(fShipping);

	if ( bDisplay ) {
		strOutput += "<TR VALIGN=TOP CLASS=\"TBLPADDING5\" onmouseover=\"this.className='carthvr'\" onmouseout=\"this.className='TBLPADDING5'\"><TD CLASS=\"nopentry\">"  + fields[0] + "</TD>";

	if ( fields[5] == "" )
		strOutput += "<TD CLASS=\"nopentry\">"  + fields[3] + "</TD>";
	else
		strOutput += "<TD CLASS=\"nopentry\">"  + fields[3] + "<BR> • <I>"+ fields[5] + "</I></TD>";

		strOutput += "<TD ALIGN=CENTER CLASS=\"nopentry\"><INPUT CLASS=impbox TYPE=TEXT NAME=Q SIZE=2 VALUE=\"" + fields[1] + "\" onChange=\"ChangeQuantity("+i+", this.value);\"></TD>";
		strOutput += "<TD ALIGN=RIGHT CLASS=\"nopentry\">"+ MonetarySymbol + moneyFormat(fields[2]) + "</TD>";

	if ( DisplayShippingColumn ) {
		if ( parseFloat(fields[4]) > 0 )
		strOutput += "<TD ALIGN=RIGHT CLASS=\"nopentry\">"+ MonetarySymbol + moneyFormat(fields[4]) + "</TD>";
		else
		strOutput += "<TD ALIGN=RIGHT CLASS=\"nopentry\">"+ MonetarySymbol + moneyFormat(fprodttl) + "</TD>";
	}

		strOutput += "<TD CLASS=\"nopentry\" ALIGN=RIGHT><input type=button class=\"butform\" onmousedown=\"this.className='butformy'\" onmouseup=\"this.className='butform'\" onmouseover=\"this.className='butformx'\" onmouseout=\"this.className='butform'\" value=\" "+strRButton+" \" onClick=\"RemoveFromCart("+i+")\"></TD></TR>"; 
      }

	if ( AppendItemNumToOutput ) {
		strFooter = i;
	} else {
		strFooter = "";
      }
	if ( HiddenFieldsToCheckout ) {
		strOutput += "<input type=hidden name=\"" + OutputItemId        + strFooter + "\" value=\"" + fields[0] + "\">";
		strOutput += "<input type=hidden name=\"" + OutputItemQuantity  + strFooter + "\" value=\"" + fields[1] + "\">";
		strOutput += "<input type=hidden name=\"" + OutputItemPrice     + strFooter + "\" value=\"" + fields[2] + "\">";
		strOutput += "<input type=hidden name=\"" + OutputItemName      + strFooter + "\" value=\"" + fields[3] + "\">";
		strOutput += "<input type=hidden name=\"" + OutputItemShipping  + strFooter + "\" value=\"" + fields[4] + "\">";
		strOutput += "<input type=hidden name=\"" + OutputItemAddtlInfo + strFooter + "\" value=\"" + fields[5] + "\">";
      }

}

	if ( bDisplay ) {
		strOutput += "</TABLE><TABLE width=620 CELLSPACING=0 CELLPADDING=5 BORDERCOLOR=#FFFFFF BORDER=0 CLASS=\"nopcart\">";
		strOutput += "<TR VALIGN=TOP CLASS=\"TBLPADDING3\">"	 
		strOutput += "<TD CLASS=\"subtotal\" ALIGN=RIGHT COLSPAN=5><strong>"+strSUB+"</strong> : </TD>"; 
		strOutput += "<TD CLASS=\"subtotal\" ALIGN=RIGHT WIDTH=65><strong>" + MonetarySymbol + strTotal + "</strong></TD>";
		strOutput += "</TR>"; 

// ***** Jetset Custom Code - Delivery Matrix ****

	if (( DisplayShippingRow ) && ( iNumberOrdered != 0)) { 
		strOutput += "<TR VALIGN=TOP CLASS=\"TBLPADDING3\" bgcolor=\"#FFFFCC\">";
		strOutput += "<TD COLSPAN=5 ALIGN=RIGHT><Strong>"+ StrDelZone +"</Strong> :<br><a href=\"javascript:;\" onclick=\"MM_openBrWindow('../en/deltbl.htm','deltbl','width=450,height=375')\"><font color=\"#FFA00A\"><strong>"+ StrCheckDel +"</strong></font></a>  </TD>"; 
		strOutput += "<TD ALIGN=RIGHT CLASS=\"gentotal\">"; 
		strOutput += "<input type=radio name=\"ZONE\" value=\"0" + "\" onClick=\"CalcDelivery(this.value)\">"; 
		strOutput += "Zone 1"; 
		strOutput += "<BR><input type=radio name=\"ZONE\" value=\"1" + "\" onClick=\"CalcDelivery(this.value)\">"; 
		strOutput += "Zone 2"; 
		strOutput += "<BR><input type=radio name=\"ZONE\" value=\"2" + "\" onClick=\"CalcDelivery(this.value)\">"; 
		strOutput += "Zone 3"; 
		strOutput += "<BR><input type=radio name=\"ZONE\" value=\"3" + "\" onClick=\"CalcDelivery(this.value)\">"; 
		strOutput += "Zone 4"; 
		strOutput += "</TD>"; 
		strOutput += "</TR>";
	}

//document.write(strOutput); 
//		strOutput = "";

LocationSelected = GetCookie("ZoneSelected"); 
	if (LocationSelected == null) LocationSelected = 1;
	
	if (LocationSelected != null) {
		var cLocations = document.getElementsByName('ZONE');
		for (var iCtr = 0; iCtr < cLocations.length; iCtr++) {
			if (cLocations[iCtr].value == LocationSelected) cLocations[iCtr].checked = true;
		}
	}

	if (LocationSelected == 0) LocationLabel = "Zone 1"; 
	if (LocationSelected == 1) LocationLabel = "Zone 2"; 
	if (LocationSelected == 2) LocationLabel = "Zone 3"; 
	if (LocationSelected == 3) LocationLabel = "Zone 4"; 

fShipping = CalcDelivery(LocationSelected); 

strShipping = moneyFormat(fShipping); 
		strOutput += "<TR VALIGN=TOP BGCOLOR=\"#EBEBEB\" CLASS=\"TBLPADDING3\">";
		strOutput += "<TD ALIGN=RIGHT CLASS=\"gentotal\" COLSPAN=5>" + strSHIP + StrDelCost +"<strong>" + LocationLabel + "</strong></TD>"; 
		strOutput += "<TD CLASS=\"gentotal\" ALIGN=RIGHT>" + MonetarySymbol + strShipping + "</TD>"; 
		strOutput += "</TR>"; 
} 
		strOutput += "</TABLE>"; 

	if ( HiddenFieldsToCheckout ) {
		strOutput += "<input type=hidden name=\""+OutputOrderSubtotal+"\" value=\""+ MonetarySymbol + strTotal + "\">";
		strOutput += "<input type=hidden name=\""+OutputOrderShipping+"\" value=\""+ MonetarySymbol + strShipping + "\">";
		strOutput += "<input type=hidden name=\""+OutputOrderTax+"\"      value=\""+ MonetarySymbol + strTax + "\">";
		strOutput += "<input type=hidden name=\""+OutputOrderTotal+"\"    value=\""+ MonetarySymbol + moneyFormat((fTotal + fShipping + fTax)) + "\">";
	}

g_TotalCost = (fTotal + fShipping + fTax);
document.write(strOutput);
document.close();
}

// =======================================================================
function ExpressCart( ) {
var iNumberOrdered = 0;    //Number of products ordered
var fTotal         = 0;    //Total cost of order
var fTax           = 0;    //Tax amount
var fShipping      = 0;    //Shipping amount
var strTotal       = "";   //Total cost formatted as money
var strTax         = "";   //Total tax formatted as money
var strShipping    = "";   //Total shipping formatted as money
var strOutput      = "";   //String to be written to page
var bDisplay       = true; //Whether to write string to the page (here for programmers)
   
iNumberOrdered = GetCookie("NumberOrdered");
if ( iNumberOrdered == null )
	iNumberOrdered = 0;
      
LocationSelected = GetCookie("ZoneSelected");
if ( LocationSelected == null )
	LocationSelected = 1; // Default zone


for ( i = 1; i <= iNumberOrdered; i++ ) {
	NewOrder = "Order." + i;
	database = "";
	database = GetCookie(NewOrder);

	Token0 = database.indexOf("|", 0);
	Token1 = database.indexOf("|", Token0+1);
	Token2 = database.indexOf("|", Token1+1);
	Token3 = database.indexOf("|", Token2+1);
	Token4 = database.indexOf("|", Token3+1);

	fields = new Array;
	fields[0] = database.substring( 0, Token0 );// Product ID
	fields[1] = database.substring( Token0+1, Token1 );// Quantity
	fields[2] = database.substring( Token1+1, Token2 );// Price
	fields[3] = database.substring( Token2+1, Token3 );// Product Name/Description
	fields[4] = database.substring( Token3+1, Token4 );// Shipping Cost
	fields[5] = database.substring( Token4+1, database.length );//Additional Information

	fTotal  += (parseInt(fields[1]) * parseFloat(fields[2]) );
	fprodttl = (fields[1]) * (fields[2]); // TTL PROD = QTY * PRICE
	fTax     = (fTotal * TaxRate);
      
	strTotal    = moneyFormat(fTotal);
	strTax      = moneyFormat(fTax);
	strShipping = moneyFormat(fShipping);

	if ( AppendItemNumToOutput ) {
		strFooter = i;
	} else {
		strFooter = "";
	}
	if ( HiddenFieldsToCheckout ) {
		strOutput += "<input type=hidden name=\"" + OutputItemId        + strFooter + "\" value=\"" + fields[0] + "\">";
		strOutput += "<input type=hidden name=\"" + OutputItemQuantity  + strFooter + "\" value=\"" + fields[1] + "\">";
		strOutput += "<input type=hidden name=\"" + OutputItemPrice     + strFooter + "\" value=\"" + fields[2] + "\">";
		strOutput += "<input type=hidden name=\"" + OutputItemName      + strFooter + "\" value=\"" + fields[3] + "\">";
		strOutput += "<input type=hidden name=\"" + OutputItemShipping  + strFooter + "\" value=\"" + fields[4] + "\">";
		strOutput += "<input type=hidden name=\"" + OutputItemAddtlInfo + strFooter + "\" value=\"" + fields[5] + "\">";
      }

}

		strOutput += "<TABLE width=636 CELLSPACING=0 CELLPADDING=5 BORDER=0 CLASS=\"nopcart\">";		
		// ***** Jetset Custom Code - Delivery Matrix ****
		strOutput += "<TR VALIGN=MIDDLE CLASS=\"TBLPADDING3\" bgcolor=\"#FFFFCC\">";
		strOutput += "<TD ALIGN=RIGHT><Strong>"+ StrDelZone +"</Strong> :<br><a href=\"javascript:;\" onclick=\"MM_openBrWindow('../en/deltbl.htm','delzone','width=450,height=375')\"><font color=\"#FFA00A\"><strong>"+ StrCheckDel +"</strong></font></a>&nbsp;&nbsp;</TD>"; 
		strOutput += "<TD WIDTH=\"150\" ALIGN=RIGHT CLASS=\"tbltxt\">"; 
		strOutput += "<input type=radio name=\"ZONE\" value=\"0" + "\" onClick=\"CalcDelivery(this.value)\">"; 
		strOutput += "Zone 1"; 
		strOutput += "&nbsp;&nbsp;&nbsp;<input type=radio name=\"ZONE\" value=\"1" + "\" onClick=\"CalcDelivery(this.value)\">"; 
		strOutput += "Zone 2"; 
		strOutput += "<BR><input type=radio name=\"ZONE\" value=\"2" + "\" onClick=\"CalcDelivery(this.value)\">"; 
		strOutput += "Zone 3"; 
		strOutput += "&nbsp;&nbsp;&nbsp;<input type=radio name=\"ZONE\" value=\"3" + "\" onClick=\"CalcDelivery(this.value)\">"; 
		strOutput += "Zone 4"; 
		strOutput += "</TD></TR></TABLE>"; 

	LocationSelected = GetCookie("ZoneSelected"); 
	if (LocationSelected == null) LocationSelected = 1;
	
	if (LocationSelected != null) {
		var cLocations = document.getElementsByName('ZONE');
		for (var iCtr = 0; iCtr < cLocations.length; iCtr++) {
			if (cLocations[iCtr].value == LocationSelected) cLocations[iCtr].checked = true;
		}
	}

	if (LocationSelected == 0) LocationLabel = "Zone 1"; 
	if (LocationSelected == 1) LocationLabel = "Zone 2"; 
	if (LocationSelected == 2) LocationLabel = "Zone 3"; 
	if (LocationSelected == 3) LocationLabel = "Zone 4"; 

	fShipping = CalcDelivery(LocationSelected); 

	if ( HiddenFieldsToCheckout ) {
		strOutput += "<input type=hidden name=\""+OutputOrderSubtotal+"\" value=\""+ MonetarySymbol + strTotal + "\">";
		strOutput += "<input type=hidden name=\""+OutputOrderShipping+"\" value=\""+ MonetarySymbol + strShipping + "\">";
		strOutput += "<input type=hidden name=\""+OutputOrderTax+"\"      value=\""+ MonetarySymbol + strTax + "\">";
		strOutput += "<input type=hidden name=\""+OutputOrderTotal+"\"    value=\""+ MonetarySymbol + moneyFormat((fTotal + fShipping + fTax)) + "\">";
	}

g_TotalCost = (fTotal + fShipping + fTax);
document.write(strOutput);
document.close();
}
// =======================================================================
// ***** Jetset Custom Code - Delivery Zone Calc ****
function CalcDelivery(Zone) { 

LocationValue = GetCookie("ZoneSelected"); 

	if (LocationValue != Zone) { 
		SetCookie("ZoneSelected", Zone, null, "/"); 
		location.href=location.href; 
	} 

	if (LocationValue == 0 ) { 
		return 0.00; 
	} 
	if (LocationValue == 1 ) { 
		return 10.00; 
	} 
	if (LocationValue == 2 ) { 
		return 20.00; 
	} 
	if (LocationValue == 3 ) { 
		return 30.00; 
	}
} 
// ***** End Jetset Custom Code ****

// =======================================================================
var g_TotalCost = 0;
function ValidateCart( theForm ) {
	if ( TaxByRegion ) {
		if ( !RadioChecked(eval("theForm."+OutputOrderTax)) ) {
			alert( TaxPrompt );
			return false;
      		}
	}
	if ( isNaN (g_TotalCost) ) { 
		alert( NoQtyPrompt ); 
		return false; 
	} 
	if ( MinimumOrder >= 0.01 ) {
		if ( g_TotalCost < MinimumOrder ) {
			alert( MinimumOrderPrompt );
			return false;
      		}
   	}
	if ( !RadioChecked(theForm.ZONE) ) { 
		alert( LocationPrompt ); 
		return false; 
	} 
   return true;
}

// =======================================================================
function CheckoutCart( ) {
var iNumberOrdered	= 0;    //Number of products ordered
var fTotal		= 0;    //Total cost of order
var fTax		= 0;    //Tax amount
var fShipping		= 0;    //Shipping amount
var strTotal		= "";   //Total cost formatted as money
var strTax		= "";   //Total tax formatted as money
var strShipping		= "";   //Total shipping formatted as money
var strOutput		= "";   //String to be written to page
var bDisplay		= true; //Whether to write string to the page (here for programmers)
var strPP		= "";   //Payment Processor Description Field

iNumberOrdered = GetCookie("NumberOrdered");
	if ( iNumberOrdered == null )
		iNumberOrdered = 0;

	if ( TaxByRegion ) {
		QueryString_Parse();
		fTax = parseFloat( QueryString( OutputOrderTax ) );
		strTax = moneyFormat(fTax);
   	}

	if ( bDisplay )
		strOutput = 	"<TABLE CELLSPACING=0 CELLPADDING=0 BORDERCOLOR=#FFFFFF BORDER=0 CLASS=\"nopcart\"><TR height=25>" + 
				"<TD WIDTH=80 CLASS=\"nopheader\"><strong>"+strILabel+"</strong></TD>" +
				"<TD WIDTH=345 CLASS=\"nopheader\"><strong>"+strDLabel+"</strong></TD>" +
				"<TD WIDTH=50 ALIGN=CENTER CLASS=\"nopheader\"><strong>"+strQLabel+"</strong></TD>" +
				"<TD ALIGN=RIGHT WIDTH=60 CLASS=\"nopheader\"><strong>"+strPLabel+"</strong></TD>" +
				"<TD ALIGN=RIGHT WIDTH=60 CLASS=\"nopheader\"><strong>"+strPTLabel+"</strong></TD>" +
				"</TR>"; 

	for ( i = 1; i <= iNumberOrdered; i++ ) {
		NewOrder = "Order." + i;
		database = "";
		database = GetCookie(NewOrder);

	Token0 = database.indexOf("|", 0);
	Token1 = database.indexOf("|", Token0+1);
	Token2 = database.indexOf("|", Token1+1);
	Token3 = database.indexOf("|", Token2+1);
	Token4 = database.indexOf("|", Token3+1);

	fields = new Array;
	fields[0] = database.substring( 0, Token0 );                 // Product ID
	fields[1] = database.substring( Token0+1, Token1 );          // Quantity
	fields[2] = database.substring( Token1+1, Token2 );          // Price
	fields[3] = database.substring( Token2+1, Token3 );          // Product Name/Description
	fields[4] = database.substring( Token3+1, Token4 );          // Shipping Cost
	fields[5] = database.substring( Token4+1, database.length ); //Additional Information

	fTotal     += (parseInt(fields[1]) * parseFloat(fields[2]) );
	fprodttl    = (fields[1]) * (fields[2]); // TTL PROD = QTY * PRICE
	  
	if ( !TaxByRegion ) fTax = (fTotal * TaxRate);
      		strTotal    = moneyFormat(fTotal);
	if ( !TaxByRegion ) strTax = moneyFormat(fTax);

	if ( bDisplay ) {
		strOutput += "<TR VALIGN=TOP CLASS=\"TBLPADDING5\" onmouseover=\"this.className='carthvr'\" onmouseout=\"this.className='TBLPADDING5'\"><TD CLASS=\"nopentry\">"  + fields[0] + "</TD>";

		if ( fields[5] == "" )
			strOutput += "<TD CLASS=\"nopentry\">"  + fields[3] + "</TD>";
		else
			strOutput += "<TD CLASS=\"nopentry\">"  + fields[3] + "<BR> • <I>"+ fields[5] + "</I></TD>";
		
			strOutput += "<TD ALIGN=CENTER CLASS=\"nopentry\">" + fields[1] + "</TD>";
			strOutput += "<TD ALIGN=RIGHT CLASS=\"nopentry\">"+ MonetarySymbol + moneyFormat(fields[2]) + "</TD>";

         	if ( DisplayShippingColumn ) {
            		if ( parseFloat(fields[4]) > 0 )
               			strOutput += "<TD ALIGN=RIGHT CLASS=\"nopentry\">"+ MonetarySymbol + moneyFormat(fields[4]) + "</TD>";
            		else
               			strOutput += "<TD ALIGN=RIGHT CLASS=\"nopentry\">"+ MonetarySymbol + moneyFormat(fprodttl) + "</TD>";
         	}

	strOutput += "</TR>";
	} // close bDisplay

	if ( AppendItemNumToOutput ) {
		strFooter = i;
	} else {
		strFooter = "";
	}
	
	if ( PaymentProcessor != '' ) {
		strPP += fields[0] + ", " + fields[3];
		if ( fields[5] != "" )
			strPP += " - " + fields[5];
		strPP += ", Qty. " + fields[1] + "\n";
	} else {
		strOutput += "<input type=hidden name=\"" + OutputItemId        + strFooter + "\" value=\"" + fields[0] + "\">";
		strOutput += "<input type=hidden name=\"" + OutputItemQuantity  + strFooter + "\" value=\"" + fields[1] + "\">";
		strOutput += "<input type=hidden name=\"" + OutputItemPrice     + strFooter + "\" value=\"" + fields[2] + "\">";
		strOutput += "<input type=hidden name=\"" + OutputItemName      + strFooter + "\" value=\"" + fields[3] + "\">";
		strOutput += "<input type=hidden name=\"" + OutputItemShipping  + strFooter + "\" value=\"" + fields[4] + "\">";
		strOutput += "<input type=hidden name=\"" + OutputItemAddtlInfo + strFooter + "\" value=\"" + fields[5] + "\">";
	} 
	}

	if ( bDisplay ) {
		strOutput += "<TD CLASS=\"subtotal\" ALIGN=RIGHT COLSPAN=4><strong>"+strSUB+"</strong> : </TD>"; 
		strOutput += "<TD CLASS=\"subtotal\" ALIGN=RIGHT WIDTH=65><strong>" + MonetarySymbol + strTotal + "</strong></TD>";
		strOutput += "</TR>"; 

	if ( DisplayShippingRow ) {
		LocationSelected = GetCookie("ZoneSelected"); 
		if (LocationSelected == null) LocationSelected = 0; //Needed if checkout cart is empty
		if (LocationSelected == 0) LocationLabel = "Zone 1"; 
		if (LocationSelected == 1) LocationLabel = "Zone 2"; 
		if (LocationSelected == 2) LocationLabel = "Zone 3"; 
		if (LocationSelected == 3) LocationLabel = "Zone 4";
		
		fShipping = CalcDelivery(LocationSelected); 
		strShipping = moneyFormat(fShipping); 
		
		strOutput += "<TR VALIGN=TOP CLASS=\"TBLPADDING3\">";
		strOutput += "<TD ALIGN=RIGHT CLASS=\"gentotal\" COLSPAN=4>" + strSHIP + "</TD>"; 
		strOutput += "<TD CLASS=\"gentotal\" ALIGN=RIGHT>" + MonetarySymbol + strShipping + "</TD>"; 
		strOutput += "</TR>"; 
	}
	
	if ( DisplayTaxRow || TaxByRegion ) {
		strOutput += "<TR VALIGN=TOP CLASS=\"TBLPADDING3\"><TD ALIGN=RIGHT COLSPAN=4>"+strTAX+" : </TD>";
		strOutput += "<TD ALIGN=RIGHT CLASS=\"gentotal\">" + MonetarySymbol + strTax + "</TD>";
		strOutput += "</TR>";
	}

	strOutput += "<TR VALIGN=TOP CLASS=\"TBLPADDING5\"><TD ALIGN=RIGHT VALIGN=BOTTOM COLSPAN=4><strong>"+strTOT+"</strong> : </TD>";
	strOutput += "<TD ALIGN=RIGHT CLASS=\"noptotal\"><strong>" + MonetarySymbol + moneyFormat((fTotal + fShipping + fTax)) + "</strong></TD>"; 
	strOutput += "</TR>"; 
	strOutput += "</TABLE>"; 

      
	if ( PaymentProcessor == 'an') {
		//Process this for Authorize.net WebConnect
		strOutput += "<input type=hidden name=\"x_Version\" value=\"3.0\">";
		strOutput += "<input type=hidden name=\"x_Show_Form\" value=\"PAYMENT_FORM\">";
		strOutput += "<input type=hidden name=\"x_Description\" value=\""+ strPP + "\">";
		strOutput += "<input type=hidden name=\"x_Amount\" value=\""+ moneyFormat((fTotal + fShipping + fTax)) + "\">";
	} else if ( PaymentProcessor == 'wp') {
		//Process this for WorldPay
		strOutput += "<input type=hidden name=\"desc\" value=\""+ strPP + "\">";
		strOutput += "<input type=hidden name=\"amount\" value=\""+ moneyFormat((fTotal + fShipping + fTax)) + "\">";
	} else if ( PaymentProcessor == 'lp') {
		//Process this for LinkPoint         
		strOutput += "<input type=hidden name=\"mode\" value=\"fullpay\">";
		strOutput += "<input type=hidden name=\"chargetotal\" value=\""+ moneyFormat((fTotal + fShipping + fTax)) + "\">";
		strOutput += "<input type=hidden name=\"tax\" value=\""+ MonetarySymbol + strTax + "\">";
		strOutput += "<input type=hidden name=\"subtotal\" value=\""+ MonetarySymbol + strTotal + "\">";
		strOutput += "<input type=hidden name=\"shipping\" value=\""+ MonetarySymbol + strShipping + "\">";
		strOutput += "<input type=hidden name=\"desc\" value=\""+ strPP + "\">";
	} else if ( PaymentProcessor == 'pp') {
		//Process this for PayPal         
		strOutput += "<input type=hidden name=\"amount\" value=\""+ moneyFormat((fTotal + fShipping + fTax)) + "\">";
		strOutput += "<input type=hidden name=\"item_name\" value=\""+ strPP + "\">";
	} else {
		strOutput += "<input type=hidden name=\""+OutputOrderSubtotal+"\" value=\""+ MonetarySymbol + strTotal + "\">";
		strOutput += "<input type=hidden name=\""+OutputOrderShipping+"\" value=\""+ MonetarySymbol + strShipping + "\">";
		strOutput += "<input type=hidden name=\""+OutputOrderTax+"\"      value=\""+ MonetarySymbol + strTax + "\">";
		strOutput += "<input type=hidden name=\""+OutputOrderTotal+"\"    value=\""+ MonetarySymbol + moneyFormat((fTotal + fShipping + fTax)) + "\">";
	}
}
	document.write(strOutput);
	document.close();
}

// ***** Jetset Custom Code - Cart is empty ****

function CartNull(){ 	// If Shopping Cart is empty the linked HTML, is inhibited. 
	NumberInCart = 0; 
	NumberInCart = GetCookie("NumberOrdered"); 
	if (( NumberInCart == null ) || ( NumberInCart == 0 )) { 
		alert( 'Your Cart is Empty!' ); 
		return true; 
	} 
	else 	{ 
		return false; 
	} 
}
// ***** End Jetset Custom Code ****