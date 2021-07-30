//=====================================================================||
//               NOP Design JavaScript Shopping Cart                   ||
//                                                                     ||
// For more information on SmartSystems, or how NOPDesign can help you ||
// Please visit us on the WWW at http://www.nopdesign.com              ||
//                                                                     ||
// Javascript portions of this shopping cart software are available as ||
// freeware from NOP Design.  You must keep this comment unchanged in  ||
// your code.  For more information contact FreeCart@NopDesign.com.    ||
//                                                                     ||
// JavaScript Shop Module, V.4.4.0                                     ||
//=====================================================================||

//---------------------------------------------------------------------||
//                       Global Options                                ||
//                      ----------------                               ||
// Shopping Cart Options, you can modify these options to change the   ||
// the way the cart functions.                                         ||
//                                                                     ||
// Language Packs                                                      ||
// ==============                                                      ||
// You may include any language pack before nopcart.js in your HTML    ||
// pages to change the language.  Simply include a language pack with  ||
// a script src BEFORE the <SCRIPT SRC="nopcart.js">... line.          ||
//  For example: <SCRIPT SRC="language-en.js"></SCRIPT>                ||
//                                                                     ||
// Options For Everyone:                                               ||
// =====================                                               ||
// * MonetarySymbol: string, the symbol which represents dollars/euro, ||
//   in your locale.                                                   ||
// * DisplayNotice: true/false, controls whether the user is provided  ||
//   with a popup letting them know their product is added to the cart ||
// * DisplayShippingColumn: true/false, controls whether the managecart||
//   and checkout pages display shipping cost column.                  ||
// * DisplayShippingRow: true/false, controls whether the managecart   ||
//   and checkout pages display shipping cost total row.               ||
// * DisplayTaxRow: true/false, controls whether the managecart        ||
//   and checkout pages display tax cost total row.                    ||
// * TaxRate: number, your area's current tax rate, ie: if your tax    ||
//   rate was 7.5%, you would set TaxRate = 0.075                      ||
// * TaxByRegion: true/false, when set to true, the user is prompted   ||
//   with TaxablePrompt to determine if they should be charged tax.    ||
//   In the USA, this is useful to charge tax to those people who live ||
//   in a particular state, but no one else.                           ||
// * TaxPrompt: string, popup message if user has not selected either  ||
//   taxable or nontaxable when TaxByRegion is set to true.            ||
// * TaxablePrompt: string, the message the user is prompted with to   ||
//   select if they are taxable.  If TaxByRegion is set to false, this ||
//   has no effect. Example: 'Arizona Residents'                       ||
// * NonTaxablePrompt: string, same as above, but the choice for non-  ||
//   taxable people.  Example: 'Other States'                          ||
// * MinimumOrder: number, the minium dollar amount that must be       ||
//   purchased before a user is allowed to checkout.  Set to 0.00      ||
//   to disable.                                                       ||
// * MinimumOrderPrompt: string, Message to prompt users with when     ||
//   they have not met the minimum order amount.                       ||
//                                                                     ||
// Payment Processor Options:                                          ||
// ==========================                                          ||
// * PaymentProcessor: string, the two digit payment processor code    ||
//   for support payment processor gateways.  Setting this field to    ||
//   anything other than an empty string will override your OutputItem ||
//   settings -- so please be careful when receiving any form data.    ||
//   Support payment processor gateways are:                           ||
//    * Authorize.net (an)                                             ||
//    * Worldpay      (wp)                                             ||
//    * LinkPoint     (lp)
//                                                                     ||
// Options For Programmers:                                            ||
// ========================                                            ||
// * OutputItem<..>: string, the name of the pair value passed at      ||
//   checkouttime.  Change these only if you are connecting to a CGI   ||
//   script and need other field names, or are using a secure service  ||
//   that requires specific field names.                               ||
// * AppendItemNumToOutput: true/false, if set to true, the number of  ||
//   each ordered item will be appended to the output string.  For     ||
//   example if OutputItemId is 'ID_' and this is set to true, the     ||
//   output field name will be 'ID_1', 'ID_2' ... for each item.       ||
// * HiddenFieldsToCheckout: true/false, if set to true, hidden fields ||
//   for the cart items will be passed TO the checkout page, from the  ||
//   ManageCart page.  This is set to true for CGI/PHP/Script based    ||
//   checkout pages, but should be left false if you are using an      ||
//   HTML/Javascript Checkout Page. Hidden fields will ALWAYS be       ||
//   passed FROM the checkout page to the Checkout CGI/PHP/ASP/Script  ||
//---------------------------------------------------------------------||

//Options for Everyone:
MonetarySymbol        = '$';
DisplayNotice         = true;
DisplayShippingColumn = false;
DisplayShippingRow    = false;
DisplayTaxRow         = true;
TaxRate               = 0.00;
TaxByRegion           = false;
TaxPrompt             = 'For tax purposes, please select if you are a Nevada resident before continuing';
TaxablePrompt         = 'Nevada Residents';
NonTaxablePrompt      = 'Other States';
MinimumOrder          = 0.00;
MinimumOrderPrompt    = 'Your order is below our minimum order, please order more before checking out.';

//Payment Processor Options:
PaymentProcessor      = '';

//Options for Programmers:
OutputItemId          = 'ID_';
OutputItemQuantity    = 'QUANTITY_';
OutputItemPrice       = 'PRICE_';
OutputItemName        = 'NAME_';
OutputItemShipping    = 'SHIPPING_';
OutputItemAddtlInfo   = 'ADDTLINFO_';
OutputOrderSubtotal   = 'SUBTOTAL';
OutputOrderShipping   = 'SHIPPING';
OutputOrderTax        = 'TAX';
OutputOrderTotal      = 'TOTAL';
AppendItemNumToOutput = true;
HiddenFieldsToCheckout = false;


//=====================================================================||
//---------------------------------------------------------------------||
//    YOU DO NOT NEED TO MAKE ANY MODIFICATIONS BELOW THIS LINE        ||
//---------------------------------------------------------------------||
//=====================================================================||


//---------------------------------------------------------------------||
//                      Language Strings                               ||
//                     ------------------                              ||
// These strings will not be used unless you have not included a       ||
// language pack already.  You should NOT modify these, but instead    ||
// modify the strings in language-**.js where ** is the language pack  ||
// you are using.                                                      ||
//---------------------------------------------------------------------||
if ( !bLanguageDefined ) {
   strSorry  = "I'm Sorry, your cart is full, please proceed to checkout.";
   strAdded  = " added to your shopping cart.";
   strRemove = "Click 'Ok' to remove this product from your shopping cart.";
   strILabel = "PRODUCT ID";
   strDLabel = "PRODUCT NAME/DESCRIPTION";
   strQLabel = "QUANTITY";
   strPLabel = "PRICE";
   strSLabel = "SHIPPING";
   strRLabel = "REMOVE FROM CART";
   strRButton= "Remove";
   strSUB    = "SUBTOTAL";
   strSHIP   = "SHIPPING";
   strTAX    = "TAX";
   strTOT    = "TOTAL";
   strErrQty = "Invalid Quantity.";
   strNewQty = 'Please enter new quantity:';
   bLanguageDefined = true;
}


//---------------------------------------------------------------------||
// FUNCTION:    CKquantity                                             ||
// PARAMETERS:  Quantity to                                            ||
// RETURNS:     Quantity as a number, and possible alert               ||
// PURPOSE:     Make sure quantity is represented as a number          ||
//---------------------------------------------------------------------||
function CKquantity(checkString) {
   var strNewQuantity = "";

   for ( i = 0; i < checkString.length; i++ ) {
      ch = checkString.substring(i, i+1);
      if ( (ch >= "0" && ch <= "9") || (ch == '.') )
         strNewQuantity += ch;
   }

   if ( strNewQuantity.length < 1 )
      strNewQuantity = "1";

   return(strNewQuantity);
}


//---------------------------------------------------------------------||
// FUNCTION:    AddToCart                                              ||
// PARAMETERS:  Form Object                                            ||
// RETURNS:     Cookie to user's browser, with prompt                  ||
// PURPOSE:     Adds a product to the user's shopping cart             ||
//---------------------------------------------------------------------||
function AddToCart(thisForm) {
   var iNumberOrdered = 0;
   var bAlreadyInCart = false;
   var notice = "";
   iNumberOrdered = GetCookie("NumberOrdered");

   if ( iNumberOrdered == null )
      iNumberOrdered = 0;

   if ( thisForm.ID_NUM == null )
      strID_NUM    = "";
   else
      strID_NUM    = thisForm.ID_NUM.value;

   if ( thisForm.QUANTITY == null )
      strQUANTITY  = "1";
   else
      strQUANTITY  = thisForm.QUANTITY.value;

   if ( thisForm.PRICE == null )
      strPRICE     = "0.00";
   else
      strPRICE     = thisForm.PRICE.value;

   if ( thisForm.NAME == null )
      strNAME      = "";
   else
      strNAME      = thisForm.NAME.value;

   if ( thisForm.SHIPPING == null )
      strSHIPPING  = "0.00";
   else
      strSHIPPING  = thisForm.SHIPPING.value;

   if ( thisForm.ADDITIONALINFO == null ) {
      strADDTLINFO = "";
   } else {
      strADDTLINFO = thisForm.ADDITIONALINFO[thisForm.ADDITIONALINFO.selectedIndex].value;
   }
   if ( thisForm.ADDITIONALINFO2 != null ) {
      strADDTLINFO += "; " + thisForm.ADDITIONALINFO2[thisForm.ADDITIONALINFO2.selectedIndex].value;
   }
   if ( thisForm.ADDITIONALINFO3 != null ) {
      strADDTLINFO += "; " + thisForm.ADDITIONALINFO3[thisForm.ADDITIONALINFO3.selectedIndex].value;
   }
   if ( thisForm.ADDITIONALINFO4 != null ) {
      strADDTLINFO += "; " + thisForm.ADDITIONALINFO4[thisForm.ADDITIONALINFO4.selectedIndex].value;
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

      if ( fields[0] == strID_NUM &&
           fields[2] == strPRICE  &&
           fields[3] == strNAME   &&
           fields[5] == strADDTLINFO
         ) {
         bAlreadyInCart = true;
		 // don't increment quantity if is a shipping charge
 		 if ((strNAME == "Delivery Within Las Vegas")||(strNAME == "Ship Outside Las Vegas")||(strNAME == "Pickup at Blind Center")){
	         dbUpdatedOrder = strID_NUM    + "|" +
	  	                      (parseInt(strQUANTITY))  + "|" +
   	    	                  strPRICE     + "|" +
   	        	              strNAME      + "|" +
   	            	          strSHIPPING  + "|" +
   	                	      strADDTLINFO;
		 }else{
	         dbUpdatedOrder = strID_NUM    + "|" +
    	                      (parseInt(strQUANTITY)+parseInt(fields[1]))  + "|" +
        	                  strPRICE     + "|" +
            	              strNAME      + "|" +
                	          strSHIPPING  + "|" +
                    	      strADDTLINFO;
		 }
         strNewOrder = "Order." + i;
         DeleteCookie(strNewOrder, "/");
         SetCookie(strNewOrder, dbUpdatedOrder, null, "/");
         notice = strQUANTITY + " " + strNAME + strAdded;
         break;
      }
   }


   if ( !bAlreadyInCart ) {
      iNumberOrdered++;

      if ( iNumberOrdered > 12 )
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
         notice = strQUANTITY + " " + strNAME + strAdded;
      }
   }

   if ( DisplayNotice )
      alert(notice);
//      location.href=location.href;
}


//---------------------------------------------------------------------||
// FUNCTION:    getCookieVal                                           ||
// PARAMETERS:  offset                                                 ||
// RETURNS:     URL unescaped Cookie Value                             ||
// PURPOSE:     Get a specific value from a cookie                     ||
//---------------------------------------------------------------------||
function getCookieVal (offset) {
   var endstr = document.cookie.indexOf (";", offset);

   if ( endstr == -1 )
      endstr = document.cookie.length;
   return(unescape(document.cookie.substring(offset, endstr)));
}


//---------------------------------------------------------------------||
// FUNCTION:    FixCookieDate                                          ||
// PARAMETERS:  date                                                   ||
// RETURNS:     date                                                   ||
// PURPOSE:     Fixes cookie date, stores back in date                 ||
//---------------------------------------------------------------------||
function FixCookieDate (date) {
   var base = new Date(0);
   var skew = base.getTime();

   date.setTime (date.getTime() - skew);
}


//---------------------------------------------------------------------||
// FUNCTION:    GetCookie                                              ||
// PARAMETERS:  Name                                                   ||
// RETURNS:     Value in Cookie                                        ||
// PURPOSE:     Retrieves cookie from users browser                    ||
//---------------------------------------------------------------------||
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


//---------------------------------------------------------------------||
// FUNCTION:    SetCookie                                              ||
// PARAMETERS:  name, value, expiration date, path, domain, security   ||
// RETURNS:     Null                                                   ||
// PURPOSE:     Stores a cookie in the users browser                   ||
//---------------------------------------------------------------------||
function SetCookie (name,value,expires,path,domain,secure) {
   document.cookie = name + "=" + escape (value) +
                     ((expires) ? "; expires=" + expires.toGMTString() : "") +
                     ((path) ? "; path=" + path : "") +
                     ((domain) ? "; domain=" + domain : "") +
                     ((secure) ? "; secure" : "");
}


//---------------------------------------------------------------------||
// FUNCTION:    DeleteCookie                                           ||
// PARAMETERS:  Cookie name, path, domain                              ||
// RETURNS:     null                                                   ||
// PURPOSE:     Removes a cookie from users browser.                   ||
//---------------------------------------------------------------------||
function DeleteCookie (name,path,domain) {
   if ( GetCookie(name) ) {
      document.cookie = name + "=" +
                        ((path) ? "; path=" + path : "") +
                        ((domain) ? "; domain=" + domain : "") +
                        "; expires=Thu, 01-Jan-70 00:00:01 GMT";
   }
}


//---------------------------------------------------------------------||
// FUNCTION:    MoneyFormat                                            ||
// PARAMETERS:  Number to be formatted                                 ||
// RETURNS:     Formatted Number                                       ||
// PURPOSE:     Reformats Dollar Amount to #.## format                 ||
//---------------------------------------------------------------------||
function moneyFormat(input) {
   var dollars = Math.floor(input);
   var tmp = new String(input);

   for ( var decimalAt = 0; decimalAt < tmp.length; decimalAt++ ) {
      if ( tmp.charAt(decimalAt)=="." )
         break;
   }

   var cents  = "" + Math.round(input * 100);
   cents = cents.substring(cents.length-2, cents.length)
           dollars += ((tmp.charAt(decimalAt+2)=="9")&&(cents=="00"))? 1 : 0;

   if ( cents == "0" )
      cents = "00";

   return(dollars + "." + cents);
}


//---------------------------------------------------------------------||
// FUNCTION:    RemoveFromCart                                         ||
// PARAMETERS:  Order Number to Remove                                 ||
// RETURNS:     Null                                                   ||
// PURPOSE:     Removes an item from a users shopping cart             ||
//---------------------------------------------------------------------||
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


//---------------------------------------------------------------------||
// FUNCTION:    ChangeQuantity                                         ||
// PARAMETERS:  Order Number to Change Quantity                        ||
// RETURNS:     Null                                                   ||
// PURPOSE:     Changes quantity of an item in the shopping cart       ||
//---------------------------------------------------------------------||
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


//---------------------------------------------------------------------||
// FUNCTION:    GetFromCart                                            ||
// PARAMETERS:  Null                                                   ||
// RETURNS:     Product Table Written to Document                      ||
// PURPOSE:     Draws current cart product table on HTML page          ||
//              **DEPRECATED FUNCTION, USE ManageCart or Checkout**    ||
//---------------------------------------------------------------------||
function GetFromCart( fShipping ) {
   ManageCart( );
}


//---------------------------------------------------------------------||
// FUNCTION:    RadioChecked                                           ||
// PARAMETERS:  Radio button to check                                  ||
// RETURNS:     True if a radio has been checked                       ||
// PURPOSE:     Form fillin validation                                 ||
//---------------------------------------------------------------------||
function RadioChecked( radiobutton ) {
   var bChecked = false;
   var rlen = radiobutton.length;
   for ( i=0; i < rlen; i++ ) {
      if ( radiobutton[i].checked )
         bChecked = true;
   }    
   return bChecked;
} 


//---------------------------------------------------------------------||
// FUNCTION:    QueryString                                            ||
// PARAMETERS:  Key to read                                            ||
// RETURNS:     value of key                                           ||
// PURPOSE:     Read data passed in via GET mode                       ||
//---------------------------------------------------------------------||
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

//---------------------------------------------------------------------||
// FUNCTION:    QueryString_Parse                                      ||
// PARAMETERS:  (URL string)                                           ||
// RETURNS:     null                                                   ||
// PURPOSE:     Parses query string data, must be called before Q.S.   ||
//---------------------------------------------------------------------||
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


//---------------------------------------------------------------------||
// FUNCTION:    ManageCart                                             ||
// PARAMETERS:  Null                                                   ||
// RETURNS:     Product Table Written to Document                      ||
// PURPOSE:     Draws current cart product table on HTML page          ||
//---------------------------------------------------------------------||
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

	var fDelivery = 0; //Delivery Cost 
	var strDelivery = ""; //Delivery String 
	var DZX = ""; //DZX is null 
	var DZXthis = false;//Is product ID a delivery ID ? no=false yes-true 
	var shipSet = false; //Shipping choice has not been made
	
   iNumberOrdered = GetCookie("NumberOrdered");
   if ( iNumberOrdered == null )
      iNumberOrdered = 0;

   if ( bDisplay )
      strOutput = "<TABLE WIDTH=\"600\" CELLSPACING=\"0\" BORDER=\"1\" BORDERCOLOR=\"#000000\" CLASS=\"bodyBlack\"><TR CLASS=\"cellDkGray\">" +
//                  "<TD align=\"center\"><B>"+strILabel+"</B></TD>" +
                  "<TD align=\"center\"><B>"+strDLabel+"</B></TD>" +
                  "<TD align=\"center\"><B>"+strQLabel+"</B></TD>" +
                  "<TD align=\"center\"><B>"+strPLabel+"</B></TD>" +
                  (DisplayShippingColumn?"<TD align=\"center\"><B>"+strSLabel+"</B></TD>":"") +
                  "<TD align=\"center\"><B>"+strRLabel+"</B></TD></TR>";

   if ( iNumberOrdered == 0 ) {
      strOutput += "<TR><TD COLSPAN=6 CLASS=\"bodyBlack\"><CENTER><BR><B>Your cart is empty</B><BR><BR></CENTER></TD></TR>";
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
      fields[0] = database.substring( 0, Token0 );                 // Product ID
      fields[1] = database.substring( Token0+1, Token1 );          // Quantity
      fields[2] = database.substring( Token1+1, Token2 );          // Price
      fields[3] = database.substring( Token2+1, Token3 );          // Product Name/Description
      fields[4] = database.substring( Token3+1, Token4 );          // Shipping Cost
      fields[5] = database.substring( Token4+1, database.length ); //Additional Information

      fTotal     += (parseInt(fields[1]) * parseFloat(fields[2]) );
      fShipping  += (parseInt(fields[1]) * parseFloat(fields[4]) );

		DZX = (fields[0]); 
		fprodttl = (fields[1]) * (fields[2]); // TTL PROD = QTY * PRICE 

		// *** Start delivery calculation Variable 
		if ( DZX == "DZX1" ) { 
			fDelivery = 0; 
			strDelivery = "Delivery Within Las Vegas"; // you can edit the text in the string 
			DZXthis = true;
			shipSet = true;
		} 
		if ( DZX == "DZX2" ) { 
			fDelivery = 0; 
			strDelivery = "Ship Outside Las Vegas"; // you can edit the text in the string 
			DZXthis = true;
			shipSet = true;
		} 
		if ( DZX == "DZX3" ) { 
			fDelivery = 0; 
			strDelivery = "Pickup at Blind Center"; // you can edit the text in the string 
			DZXthis = true;
			shipSet = true;
		} 
		if ( DZX == "SHIPPING" ) { 
			shipSet = true;
		} 
		// *** Finish delivery calculation 

      fTax        = (fTotal * TaxRate);
      strTotal    = moneyFormat(fTotal);
      strTax      = moneyFormat(fTax);
      strShipping = moneyFormat(fShipping);

      if ( bDisplay ) {
//         strOutput += "<TR><TD CLASS=\"bodyBlack\">"  + fields[0] + "</TD>";
         strOutput += "<TR>";

         if ( fields[5] == "" )
            strOutput += "<TD CLASS=\"bodyBlack\">"  + fields[3] + "</TD>";
         else
            strOutput += "<TD CLASS=\"bodyBlack\">"  + fields[3] + " - <I>"+ fields[5] + "</I></TD>";

         strOutput += "<TD CLASS=\"bodyBlack\" align=\"center\"><INPUT TYPE=TEXT NAME=Q SIZE=2 VALUE=\"" + fields[1] + "\" onChange=\"ChangeQuantity("+i+", this.value);\"></TD>";
//         strOutput += "<TD CLASS=\"nopentry\" align=\"center\">" + fields[1] + "</TD>";
         strOutput += "<TD ALIGN=\"right\" CLASS=\"bodyBlack\">"+ MonetarySymbol + moneyFormat(fields[2]) + "/ea</TD>";

         if ( DisplayShippingColumn ) {
            if ( parseFloat(fields[4]) > 0 )
               strOutput += "<TD CLASS=\"bodyBlack\">"+ MonetarySymbol + moneyFormat(fields[4]) + "/ea</TD>";
            else
               strOutput += "<TD CLASS=\"bodyBlack\">N/A</TD>";
         }

         strOutput += "<TD CLASS=\"bodyBlack\" ALIGN=CENTER><input type=button value=\" "+strRButton+" \" onClick=\"RemoveFromCart("+i+")\" CLASS=\"bodyBlack\"></TD></TR>";
      }

      if ( AppendItemNumToOutput ) {
         strFooter = i;
      } else {
         strFooter = "";
      }
      if ( HiddenFieldsToCheckout ) {
//         strOutput += "<input type=hidden name=\"" + OutputItemId        + strFooter + "\" value=\"" + fields[0] + "\">";
         strOutput += "<input type=hidden name=\"" + OutputItemQuantity  + strFooter + "\" value=\"" + fields[1] + "\">";
         strOutput += "<input type=hidden name=\"" + OutputItemPrice     + strFooter + "\" value=\"" + fields[2] + "\">";
         strOutput += "<input type=hidden name=\"" + OutputItemName      + strFooter + "\" value=\"" + fields[3] + "\">";
         strOutput += "<input type=hidden name=\"" + OutputItemShipping  + strFooter + "\" value=\"" + fields[4] + "\">";
         strOutput += "<input type=hidden name=\"" + OutputItemAddtlInfo + strFooter + "\" value=\"" + fields[5] + "\">";
      }

   }

   if ( bDisplay ) {
      strOutput += "<TR><TD CLASS=\"cellLtGray\" COLSPAN=3><B>"+strSUB+"</B></TD>";
      strOutput += "<TD CLASS=\"bodyBlack\" COLSPAN=2 align=\"right\"><B>" + MonetarySymbol + strTotal + "</B></TD>";
      strOutput += "</TR>";

      if ( DisplayShippingRow ) {
         strOutput += "<TR><TD CLASS=\"cellLtGray\" COLSPAN=3><B>"+strSHIP+"</B></TD>";
         strOutput += "<TD CLASS=\"bodyBlack\" COLSPAN=2 align=\"right\"><B>" + MonetarySymbol + strShipping + "</B></TD>";
         strOutput += "</TR>";
      }

      if ( DisplayTaxRow || TaxByRegion ) {
         if ( TaxByRegion ) {
            strOutput += "<TR><TD CLASS=\"cellLtGray\" COLSPAN=3><B>"+strTAX+"</B></TD>";
            strOutput += "<TD CLASS=\"bodyBlack\" COLSPAN=2><B>";
            strOutput += "<input type=radio name=\""+OutputOrderTax+"\" value=\"" + strTax + "\">";
            strOutput += TaxablePrompt + ": " + MonetarySymbol + strTax;
            strOutput += "<BR><input type=radio name=\""+OutputOrderTax+"\" value=\"0.00\">";
            strOutput += NonTaxablePrompt + ": " + MonetarySymbol + "0.00";
            strOutput += "</B></TD>";
            strOutput += "</TR>";
         } else {
            strOutput += "<TR><TD CLASS=\"cellLtGray\" COLSPAN=3><B>"+strTAX+"</B></TD>";
            strOutput += "<TD CLASS=\"bodyBlack\" COLSPAN=2 align=\"right\"><B>" + MonetarySymbol + strTax + "</B></TD>";
            strOutput += "</TR>";
         }
      }

      if ( !TaxByRegion ) {
         strOutput += "<TR><TD CLASS=\"cellLtGray\" COLSPAN=3><B>"+strTOT+"</B></TD>";
         strOutput += "<TD CLASS=\"bodyBlack\" COLSPAN=2 align=\"right\"><B>" + MonetarySymbol + moneyFormat((fTotal + fShipping + fTax)) + "</B></TD>";
         strOutput += "</TR>";
      }
      strOutput += "</TABLE>";

      if ( HiddenFieldsToCheckout ) {
         strOutput += "<input type=hidden name=\""+OutputOrderSubtotal+"\" value=\""+ MonetarySymbol + strTotal + "\">";
         strOutput += "<input type=hidden name=\""+OutputOrderShipping+"\" value=\""+ MonetarySymbol + strShipping + "\">";
         strOutput += "<input type=hidden name=\""+OutputOrderTax+"\"      value=\""+ MonetarySymbol + strTax + "\">";
         strOutput += "<input type=hidden name=\""+OutputOrderTotal+"\"    value=\""+ MonetarySymbol + moneyFormat((fTotal + fShipping + fTax)) + "\">";
      }
   }
   g_TotalCost = (fTotal + fShipping + fTax);

   document.write(strOutput);
   document.close();
   return shipSet;
}

//---------------------------------------------------------------------||
// FUNCTION:    ValidateCart                                           ||
// PARAMETERS:  Form to validate                                       ||
// RETURNS:     true/false                                             ||
// PURPOSE:     Validates the managecart form                          ||
//---------------------------------------------------------------------||
var g_TotalCost = 0;
function ValidateCart( theForm ) {
   if ( TaxByRegion ) {
      if ( !RadioChecked(eval("theForm."+OutputOrderTax)) ) {
         alert( TaxPrompt );
         return false;
      }
   }

   if ( MinimumOrder >= 0.01 ) {
      if ( g_TotalCost < MinimumOrder ) {
         alert( MinimumOrderPrompt );
         return false;
      }
   }

   return true;
}

//---------------------------------------------------------------------||
// FUNCTION:    CheckoutCart                                           ||
// PARAMETERS:  Null                                                   ||
// RETURNS:     Product Table Written to Document                      ||
// PURPOSE:     Draws current cart product table on HTML page for      ||
//              checkout.                                              ||
//---------------------------------------------------------------------||
function CheckoutCart( ) {
   var iNumberOrdered = 0;    //Number of products ordered
   var fTotal         = 0;    //Total cost of order
   var fTax           = 0;    //Tax amount
   var fShipping      = 0;    //Shipping amount
   var strTotal       = "";   //Total cost formatted as money
   var strTax         = "";   //Total tax formatted as money
   var strShipping    = "";   //Total shipping formatted as money
   var strOutput      = "";   //String to be written to page
   var bDisplay       = true; //Whether to write string to the page (here for programmers)
   var strPP          = "";   //Payment Processor Description Field

	var fDelivery = 0; //Delivery Cost 
	var strDelivery = ""; //Delivery String 
	var DZX = ""; //DZX is null 
	var DZXthis = false; //Is product ID a delivery ID ? no=false yes-true 

   iNumberOrdered = GetCookie("NumberOrdered");
   if ( iNumberOrdered == null )
      iNumberOrdered = 0;

   if ( TaxByRegion ) {
      QueryString_Parse();
      fTax = parseFloat( QueryString( OutputOrderTax ) );
      strTax = moneyFormat(fTax);
   }

   if ( bDisplay )
      strOutput = "<TABLE WIDTH=\"600\" CELLSPACING=\"0\" BORDER=\"1\" BORDERCOLOR=\"#000000\" CLASS=\"bodyBlack\"><TR CLASS=\"cellDkGray\">" +
//                  "<TD align=\"center\"><B>"+strILabel+"</B></TD>" +
                  "<TD align=\"center\"><B>"+strDLabel+"</B></TD>" +
                  "<TD align=\"center\"><B>"+strQLabel+"</B></TD>" +
                  "<TD align=\"center\"><B>"+strPLabel+"</B></TD>" +
                  "<TD align=\"center\"><B>"+strTLabel+"</B></TD>" +
//                  (DisplayShippingColumn?"<TD align=\"center\"><B>"+strSLabel+"</B></TD>":"") +
                  "</TR>";

//   if ( bDisplay )
//      strOutput = "<TABLE CLASS=\"nopcart\"><TR>" +
//                  "<TD CLASS=\"nopheader\" align=\"center\"><B>"+strILabel+"</B></TD>" +
//                  "<TD CLASS=\"nopheader\" align=\"center\"><B>"+strDLabel+"</B></TD>" +
//                  "<TD CLASS=\"nopheader\" align=\"center\"><B>"+strQLabel+"</B></TD>" +
//                  "<TD CLASS=\"nopheader\" align=\"center\"><B>"+strPLabel+"</B></TD>" +
//                  (DisplayShippingColumn?"<TD CLASS=\"nopheader\" align=\"center\"><B>"+strSLabel+"</B></TD>":"") +
//                  "</TR>";

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
      fShipping  += (parseInt(fields[1]) * parseFloat(fields[4]) );


	DZX = (fields[0]); 
	fprodttl = (fields[1]) * (fields[2]); // TTL PROD = QTY * PRICE 

	// *** Start delivery calculation Variable 
	if ( DZX == "DZX1" ) { 
		fDelivery = 0; 
		strDelivery = "Delivery Within Las Vegas"; // you can edit the text in the string 
		DZXthis = true;
	} 
	if ( DZX == "DZX2" ) { 
		fDelivery = 0; 
		strDelivery = "Ship Outside Las Vegas"; // you can edit the text in the string 
		DZXthis = true;
	} 
	if ( DZX == "DZX3" ) { 
		fDelivery = 0; 
		strDelivery = "Pickup at Blind Center"; // you can edit the text in the string 
		DZXthis = true;
	} 
	// *** Finish delivery calculation 

      if ( !TaxByRegion ) fTax = (fTotal * TaxRate);
      strTotal    = moneyFormat(fTotal);
      if ( !TaxByRegion ) strTax = moneyFormat(fTax);
      strShipping = moneyFormat(fShipping);

      if ( bDisplay ) {

		if ( (DZX=="DZX1") || (DZX=="DZX2") || (DZX=="DZX3") || (DZX=="DZX4" )) // **** checks if prod id is delivery id **** 
strOutput += "<TR VALIGN=TOP><TD COLSPAN=5 CLASS=\"delline\"><I>" + strDelivery + "</I></TD></TR>"; // row = delivery row 
		else 
			{ // cont with org string 

//         strOutput += "<TR><TD CLASS=\"nopentry\">"  + fields[0] + "</TD>";
         strOutput += "<TR>";

         if ( fields[5] == "" )
            strOutput += "<TD CLASS=\"bodyBlack\">"  + fields[3] + "</TD>";
         else
            strOutput += "<TD CLASS=\"bodyBlack\">"  + fields[3] + " - <I>"+ fields[5] + "</I></TD>";

         strOutput += "<TD CLASS=\"bodyBlack\" align=\"center\">" + fields[1] + "</TD>";
         strOutput += "<TD ALIGN=\"right\" CLASS=\"bodyBlack\">"+ MonetarySymbol + moneyFormat(fields[2]) + "/ea</TD>";
         strOutput += "<TD ALIGN=\"right\" CLASS=\"bodyBlack\">"+ MonetarySymbol + moneyFormat(fields[1]*fields[2]) + "</TD>";

//         if ( DisplayShippingColumn ) {
//            if ( parseFloat(fields[4]) > 0 )
//               strOutput += "<TD CLASS=\"bodyBlack\">"+ MonetarySymbol + moneyFormat(fields[4]) + "/ea</TD>";
//            else
//               strOutput += "<TD CLASS=\"bodyBlack\">N/A</TD>";
//         }

		} // close DZX check 

         strOutput += "</TR>";
      }

      if ( AppendItemNumToOutput ) {
         strFooter = i;
      } else {
         strFooter = "";
      }
      if ( PaymentProcessor != '' ) {
         //Process description field for payment processors instead of hidden values.
         //Format Description of product as:
         // ID, Name, Qty X
         strPP += fields[0] + ", " + fields[3];
         if ( fields[5] != "" )
            strPP += " - " + fields[5];
         strPP += ", Qty. " + fields[1] + "\n";
      } else {
//         strOutput += "<input type=hidden name=\"" + OutputItemId        + strFooter + "\" value=\"" + fields[0] + "\">";
         strOutput += "<input type=hidden name=\"" + OutputItemQuantity  + strFooter + "\" value=\"" + fields[1] + "\">";
         strOutput += "<input type=hidden name=\"" + OutputItemPrice     + strFooter + "\" value=\"" + fields[2] + "\">";
         strOutput += "<input type=hidden name=\"" + OutputItemName      + strFooter + "\" value=\"" + fields[3] + "\">";
//         strOutput += "<input type=hidden name=\"" + OutputItemShipping  + strFooter + "\" value=\"" + fields[4] + "\">";
//         strOutput += "<input type=hidden name=\"" + OutputItemAddtlInfo + strFooter + "\" value=\"" + fields[5] + "\">";
      } 

   }

   if ( bDisplay ) {
      strOutput += "<TR><TD CLASS=\"cellLtGray\" COLSPAN=3><B>"+strSUB+"</B></TD>";
      strOutput += "<TD CLASS=\"bodyBlack\" COLSPAN=2 ALIGN=RIGHT><B>" + MonetarySymbol + strTotal + "</B></TD>";
      strOutput += "</TR>";

      if ( DisplayShippingRow ) {
         strOutput += "<TR><TD CLASS=\"cellLtGray\" COLSPAN=3><B>"+strSHIP+"</B></TD>";
         strOutput += "<TD CLASS=\"bodyBlack\" COLSPAN=2 ALIGN=RIGHT><B>" + MonetarySymbol + strShipping + "</B></TD>";
         strOutput += "</TR>";
      }

      if ( DisplayTaxRow || TaxByRegion ) {
         strOutput += "<TR><TD CLASS=\"cellLtGray\" COLSPAN=3><B>"+strTAX+"</B></TD>";
         strOutput += "<TD CLASS=\"bodyBlack\" COLSPAN=2 ALIGN=RIGHT><B>" + MonetarySymbol + strTax + "</B></TD>";
         strOutput += "</TR>";
      }

      strOutput += "<TR><TD CLASS=\"cellLtGray\" COLSPAN=3><B>"+strTOT+"</B></TD>";
      strOutput += "<TD CLASS=\"bodyBlack\" COLSPAN=2 ALIGN=RIGHT><B>" + MonetarySymbol + moneyFormat((fTotal + fShipping + fTax)) + "</B></TD>";
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

//=====================================================================||
//               END NOP Design SmartPost Shopping Cart                ||
//=====================================================================||

