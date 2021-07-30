<!-- BEGIN INCLUDE Baskets -->

<!-- SSL Site Seal -->
<script language="JavaScript" src="https://secure.comodo.net/trustlogo/javascript/trustlogo.js" type="text/javascript"></script>

<!-- Spawns Child Window -->	
<script language="javascript">

// This function spawns a child window 

//   SpawnChild(URL including fully qualified URL's,
//				Width of the spawned window in pixels,
//				Height of the spawned window in pixels,
//				Centered (no/0 or 1/yes, which overrides the positioning values below),
//				Netscape distance from left in pixels (unless Centered = 1/yes),
//				Netscape distance from top in pixels (unless Centered = 1/yes),
//				Internet Explorer distance from left in pixels (unless Centered = 1/yes),
//				Internet Explorer distance from top in pixels (unless Centered = 1/yes),
//				Is window resizable? (no/0 or yes/1 - either works),
//				Display scrollbars? (no/0 or yes/1),
//				Display menubar? (no/0 or yes/1),
//				Display toolbar? (no/0 or yes/1),
//				Display statusbar? (no/0 or yes/1)
//				)

// Example - SpawnChild('http://192.168.0.1/ChildWindowContent.html','500','200','150','no','200','150','200','yes','yes','no','0','1')
// Creates a window that is 500x200 pels located 150 pels from the left and 200 pels from the top (NOT centered) which loads a page from a server at 192.168.0.1 named ChildWindowContent.html, resizable, with scrollbars & statusbar on.
	
function SpawnChild(Content, ChildName, Width, Height, Centered, NSx, NSy, IEx, IEy, Resizable, ScrollBars, MenuBar, ToolBar, StatusBar){
	if (window.child && !(window.child.closed))	window.child.close();
	var URL=Content;
	var Name=ChildName;
	var WindowWidth=parseInt(Width);
	var WindowHeight=parseInt(Height);
	if ((Centered == "1")||(Centered == "yes")){
		Left=(screen.width/2)-(Width/2);
		Top=(screen.height/2)-(Height/2);
		NSx=Left;
		NSy=Top;
		IEx=Left;
		IEy=Top
	}
	var ScreenX=parseInt(NSx);
	var ScreenY=parseInt(NSy);
	var Left=parseInt(IEx);
	var Top=parseInt(IEy);
	var Resize=Resizable;
	var SB=ScrollBars;
	var MB=MenuBar;
	var TB=ToolBar;
	var Status=StatusBar;
   	child=window.open(URL, Name, "width=" + WindowWidth + ",height=" + WindowHeight + ",screenX=" + ScreenX + ",screenY=" + ScreenY + ",left=" + Left + ",top=" + Top + ",resizable=" + Resize + ",scrollbars=" + SB + ",menubar=" + MB + ",toolbar=" + TB + ",status=" + Status);
}
</script>

<img src="images/spacer.gif" alt="" width="2" height="5" border="0"><br>
<table width="640" border="1" cellspacing="0" cellpadding="0" bordercolor="#892A81" bgcolor="#FFFFFF">
<tr>
	<td>
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
	<?
	if ($_SERVER["HTTPS"]){
		echo'
			<td colspan="2" valign="top" background="images/holidaybasketsheader.gif" style="background-repeat: no-repeat;"><img src="images/spacer.gif" alt="" width="530" height="232" border="0"><script type="text/javascript">TrustLogo("images/siteseal.gif", "SC","none");</script></td>
	';
	}else{
		echo'
			<td colspan="2" valign="top" background="images/holidaybasketsheader.gif" style="background-repeat: no-repeat;"><img src="images/spacer.gif" alt="" width="530" height="232" border="0"></td>
		';
	}
	?>
		</tr>
	<?
	if ((!$page) || $page == "1"){
	?>
		<tr>
			<td align="center" valign="middle" class="bigBlack">
				<br><strong>When time is of the essence and you want to make the perfect impression,<br>give the gift of food with our</strong><br><font face="serif" size="7" color="Red">GOURMET GIFT BASKETS</font><br>
			</td>
		</tr>
		<tr>
			<td align="left">
				<table width="600" border="0" cellspacing="0" cellpadding="0" background="images/basketbg.jpg" style="background-position: bottom; background-repeat: no-repeat;">
				<tr>
					<td rowspan="10"><img src="images/spacer.gif" width="175" height="500" alt="" border="0"></td>
					<td align="center" valign="top" class="bigBlack">
						<strong><br>With An Assortment Of Holiday Treats &mdash;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Uniquely Created With A Personal Touch.</strong>
					</td>
				</tr>
				<tr>
					<td valign="top" class="bodyBlack">
						We are pleased to offer you a wonderful selection of Gourmet Gift Baskets.  Our beautiful baskets are uniquely created with a personal touch for any occasion.  The baskets are filled with an assortment of unusual treats from decadent chocolates to exotic specialties of the southwest.<br><br>Our baskets are perfect for friends, family, co-workers, employees, and business associates.  Having trouble finding a gift for the person who has everything?  Make their day with one of our baskets.  Need a new idea for a business gift?  Our baskets will delight even your biggest client.
					</td>
				</tr>
				<tr>
					<td align="center" valign="top" class="xbigBlack">Perfect for holiday shopping for<br>clients, employees &amp; friends.</td>
				</tr>
				<tr>
					<td align="center" valign="top" class="bodyBlack">
						<img src="images/trianglebullet.gif" width="16" height="18" border="0">
						&nbsp;&nbsp;&nbsp;<a href="?sec=baskets&page=2" class="xbigBlack"><font size="5"><strong>Order Today</strong></font></a>&nbsp;&nbsp;&nbsp;
						<img src="images/trianglebullet-left.gif" width="16" height="18" border="0"><br>(Click Here)
					</td>
				</tr>
					<td align="center" valign="top" class="bodyBlack"><em>We ship locally and nationally via UPS and Fed Ex<br>Visa and MasterCard accepted<br><br></em></td>
				</tr>
				</table>
			</td>
		</tr>
	<?
	}
	if ($page == "2"){
	?>

		<!-- Shopping Cart Scripts -->

		<script src="language-en.js"></script>
		<script src="nopcart.js">
		//=====================================================================||
		//               NOP Design JavaScript Shopping Cart                   ||
		//                                                                     ||
		// For more information on SmartSystems, or how NOPDesign can help you ||
		// Please visit us on the WWW at http://www.nopdesign.com              ||
		//                                                                     ||
		// JavaScript Shop Module, V.4.4.0                                     ||
		//=====================================================================||
		</script>
		<script>
		function notify(form){
			notice = form.QUANTITY.value + " " + form.NAME.value + "(s) added to your cart";
			alert(notice);
			AddToCart(form);
		}
		</script>

		<tr>
			<td valign="bottom" class="xbigBlack"><font size="5">&nbsp;<strong>2009 Season</strong></font></td>
			<td width="400" align="right" class="smallBlack">
				<a href="?sec=baskets&page=3"><img src="images/viewcart.gif" width="150" height="20" alt="" border="0"></a><br><strong>**CALL FOR QUANTITY DISCOUNTS&nbsp;</strong>
			</td>
		</tr>

<?
if (false){
?>
		<!-- Grand Gourmet Basket -->

		<tr bgcolor="#E0E0E0">
			<td align="center" valign="top" class="smallBlack">
				<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br><a href="javascript:SpawnChild('images/grandgourmet2008.jpg','child','405','391','yes')" class="smallBlack"><img src="images/grandgourmet2008-th.jpg" alt="Click To Enlarge" width="200" height="190" border="0"><br>Click to Enlarge</a><!--<br><br><img src="images/redbow.gif" alt="" width="57" height="39" border="0">-->
			</td>
			<td valign="top" class="bigBlack">
				<div align="center" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br><strong>Grand Gourmet Basket</strong></div>
				<table width="350" border="0" cellspacing="0" cellpadding="0" align="center">
				<tr>
					<td>
						<br>
						This magnificent gourmet gift basket is abundantly filled with savory confections that are sure to please! This basket features Danielle's Gourmet Chocolates, Oatmeal Raisin Cookies, Peanut Butter Grahams, Honey Toasted Cashews, Melt-a-Way Mints and more!
						<br>

						<div id="container" style="position:relative; align:left; z-index:0; display:block;">
							<div id="GrandGourmetDiv" style="position:absolute; top:-200; left:15; z-index:1; width:300px; background-color:#F8F8F8; border: thin solid #000000; padding:10px; visibility:hidden">
								<table border="0" cellspacing="0" cellpadding="0" class="smallBlack">
								<tr>
									<td align="center" class="bodyBlack"><strong>The Grand Gourmet Basket Contains</strong></td>
								</tr>
								<tr>
									<td bgcolor="#000000"><img src="images/spacer.gif" alt="" width="300" height="1" border="0"></td>
								</tr>
								<tr>
									<td>
										<img src="images/spacer.gif" alt="" width="1" height="5" border="0">
										<ul>
											<li>Danielle's White Chocolate Popcorn</li>
											<li>Williamsburg Chocolate Covered Peanuts</li>
											<li>Danielle's Hand Made Chocolates</li>
											<li>Williamsburg Honey Toasted Cashews</li>
											<li>Williamsburg Chocolate Covered Peanuts</li>
											<li>Gourmet Oatmeal Raisin Cookies</li>
											<li>Revival Chocolate Toffee Almonds</li>
											<li>Peanut Butter Grahams</li>
											<li>Guittard's Melt-A-Way Mints</li>
											<li>White Chocolate Grahams</li>
											<li>Too Good Gourmet Peanut Butter Pretzels</li>
										</ul>
									</td>
								</tr>
								</table>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td align="center"><br><a onMouseOver="show('GrandGourmetDiv');" onMouseOut="hide('GrandGourmetDiv');" style="cursor:pointer; text-decoration:underline;" class="bigBlack"><strong>Basket Contents</strong></a></td>
				</tr>
				</tr>
				</table>
			</td>
		</tr>
		<tr bgcolor="#E0E0E0">
			<td align="center" class="xbigBlack">
				<strong>&nbsp;&nbsp;$85.00</strong><span class="smallBlack">+S&amp;H</span><br>
				<span class="smallBlack"><em>* CALL FOR LARGE QUANTITY DISCOUNTS</em></span><br>
				<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
			</td>
			<td align="center" class="bodyBlack">
				<FORM NAME=order ACTION="" onSubmit="AddToCart(this);">
				<input type=hidden name=sec value="baskets">
				<input type=hidden name=page value="2">
				<strong>Quantity:</strong> <input type=text size=2 maxlength=3 name=QUANTITY onChange="this.value=CKquantity(this.value)" value="1">&nbsp;&nbsp;<input type="submit" value="Add to Cart">
				<input type=hidden name=PRICE value="85.00">
				<input type=hidden name=NAME value="Grand Gourmet Basket">
				<input type=hidden name=ID_NUM value="GRAND   ">
				</FORM>
			</td>
		</tr>

<?
}
?>
		
		<!-- Sweet Indulgence Basket -->

		<tr bgcolor="#E0E0E0">
<!--		<tr bgcolor="#F8F8F8">-->
			<td align="center" valign="top" class="smallBlack">
				<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br><a href="javascript:SpawnChild('images/sweetindulgence2009.jpg','child','600','450','yes')" class="smallBlack"><img src="images/sweetindulgence2009-th.jpg" alt="Click To Enlarge" width="200" height="149" border="1"><br>Click to Enlarge</a>
			</td>
			<td valign="top" class="bigBlack">
				<div align="center" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br><strong>Sweet Indulgence Basket</strong></div>
				<table width="350" border="0" cellspacing="0" cellpadding="0" align="center">
				<tr>
					<td class="bodyBlack">
						<br>
						Celebrate the season with this deliciously decadent basket!<br><br>
						Snowy White Chocolate Popcorn, Melt-A-Way Mints, Peanut Butter Specialty Popcorn, Pure Milk Chocolate Covered Peanuts, Homemade Carmel Corn, and Nutcracker Honey Toasted Cashews.<br><br>
						An array of indulgence awaits inside! 
						<br><br>

<!--						<div id="container" style="position:relative; align:left; z-index:0; display:block;">
							<div id="SweetIndulgenceDiv" style="position:absolute; top:-150; left:15; z-index:1; width:300px; background-color:#E0E0E0; border: thin solid #000000; padding:10px; visibility:hidden">
								<table border="0" cellspacing="0" cellpadding="0" class="smallBlack">
								<tr>
									<td align="center" class="bodyBlack"><strong>The Sweet Indulgence Basket Contains</strong></td>
								</tr>
								<tr>
									<td bgcolor="#000000"><img src="images/spacer.gif" alt="" width="300" height="1" border="0"></td>
								</tr>
								<tr>
									<td>
										<img src="images/spacer.gif" alt="" width="1" height="5" border="0">
										<ul>
											<li>Danielle's White Chocolate Popcorn</li>
											<li>Williamsburg Chocolate Covered Peanuts</li>
											<li>Gourmet Oatmeal Raisin Cookies</li>
											<li>Revival Chocolate Toffee Almonds</li>
											<li>Too Good Gourmet Peanut Butter Pretzels</li>
											<li>Revival Chocolate Toffee Almonds</li>
											<li>Peanut Butter Grahams</li>
										</ul>
									</td>
								</tr>
								</table>
							</div>
						</div>-->
					</td>
				</tr>
<!--				<tr>
					<td align="center"><br><a onMouseOver="show('SweetIndulgenceDiv');" onMouseOut="hide('SweetIndulgenceDiv');" style="cursor:pointer; text-decoration:underline;" class="bigBlack"><strong>Basket Contents</strong></a></td>
				</tr>-->
				</table>
			</td>
		</tr>
		<tr bgcolor="#F8F8F8">
			<td align="center" class="xbigBlack">
				<strong>$55.00</strong><span class="smallBlack">+S&amp;H</span><br>
				<span class="smallBlack"><em>* CALL FOR LARGE QUANTITY DISCOUNTS</em></span><br>
				<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
			</td>
			<td align="center" class="bodyBlack">
				<FORM NAME=order ACTION="" onSubmit="AddToCart(this);">
				<input type=hidden name=sec value="baskets">
				<input type=hidden name=page value="2">
				<strong>Quantity:</strong> <input type=text size=2 maxlength=3 name=QUANTITY onChange="this.value=CKquantity(this.value)" value="1">&nbsp;&nbsp;<input type="submit" value="Add to Cart">
				<input type=hidden name=PRICE value="55.00">
				<input type=hidden name=NAME value="Sweet Indulgence Basket">
				<input type=hidden name=ID_NUM value="SWEET   ">
				</FORM>
			</td>
		</tr>
		<tr bgcolor="#CCCCCC">
			<td colspan="2" align="center" class="xbigBlack">
				<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br><strong>Have a Special Request?  Call (702)642-6000 and we'll<br>create a personalized, made-to-order basket just for you!</strong><br><img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
			</td>
		</tr>
	<?
	}
	if ($page == "3"){
	?>

		<!-- Shopping Cart Scripts -->

		<script src="language-en.js"></script>
		<script src="nopcart.js">
		//=====================================================================||
		//               NOP Design JavaScript Shopping Cart                   ||
		//                                                                     ||
		// For more information on SmartSystems, or how NOPDesign can help you ||
		// Please visit us on the WWW at http://www.nopdesign.com              ||
		//                                                                     ||
		// JavaScript Shop Module, V.4.4.0                                     ||
		//=====================================================================||
		</script>
		
		<!-- Display message if Javascript is disabled -->
		<noscript>
			<tr>
				<td colspan="5" class="bodyBlack">
					<strong><br>Whoops, we detected that your browser does not have JavaScript support, or it is disabled.<br><br>
					Our product catalog requires that you have JavaScript enabled to order products.  <a href="http://www.netscape.com" class="bodyBlack">Netscape</a> and <a href="http://www.microsoft.com/ie" class="bodyBlack">Microsoft</a> offer free browsers which support JavaScript.<br><br>
					If you are using a JavaScript compliant browser and still have problems, make sure you have JavaScript <u>enabled</u> in your browser's preferences.<br><br>
					<div align="center"><a href="?sec=baskets&page=3" class="bodyBlack">Click Here to Refresh Page After Enabling Javascript</a><br><br></div></strong>
				</td>
			</tr>
		</noscript>

		<tr>
			<td colspan="2" align="center" class="bigBlack"><br><strong>The items listed below are currently in your shopping cart:</strong><br><img src="images/spacer.gif" width="1" height="5" alt="" border="0"><br></td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<script>
					shipSet = ManageCart();
				</script>
				<br>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<table width="600" border="0" cellspacing="2">
				<tr>
					<td align="center">
						<form name="DelCost" id="DelCost" onChange="return false;">
							<input type="button" value="&nbsp;Recalculate&nbsp;">
							<input type="button" value="&nbsp;&nbsp;&nbsp;Checkout&nbsp;&nbsp;&nbsp;" onClick="Javascript:window.location.href = '?sec=baskets&page=4';"><br><img src="images/spacer.gif" width="1" height="5" alt="" border="0"><br>
							<input type="button" value="Continue Shopping" onClick="Javascript:window.location.href = '?sec=baskets&page=2';">
						</form> 
					</td>
				</tr>
				</table>
			</td>
		</tr>
	<?
	}
	if ($page == "4"){
	?>

		<!-- Shopping Cart Scripts -->

		<script src="language-en.js"></script>
		<script src="nopcart.js">
		//=====================================================================||
		//               NOP Design JavaScript Shopping Cart                   ||
		//                                                                     ||
		// For more information on SmartSystems, or how NOPDesign can help you ||
		// Please visit us on the WWW at http://www.nopdesign.com              ||
		//                                                                     ||
		// JavaScript Shop Module, V.4.4.0                                     ||
		//=====================================================================||
		</script>

		<script>
		function CheckForm(theform){
			var bMissingFields = false;
			var strFields = "";
			if (theform.b_first.value == ""){
				bMissingFields = true;
				strFields += "     Billing Information: First Name\n";
			}
			if (theform.b_last.value == ""){
				bMissingFields = true;
				strFields += "     Billing Information: Last Name\n";
			}
			if(theform.b_addr.value == ""){
				bMissingFields = true;
				strFields += "     Billing Information: Address\n";
			}
			if(theform.b_city.value == ""){
				bMissingFields = true;
				strFields += "     Billing Information: City\n";
			}
			if(theform.b_state.value == ""){
				bMissingFields = true;
				strFields += "     Billing Information: State\n";
			}
			if(theform.b_zip.value == ""){
				bMissingFields = true;
				strFields += "     Billing Information: Zipcode\n";
			}
			if(theform.b_phone.value == ""){
				bMissingFields = true;
				strFields += "     Billing Information: Phone\n";
			}
			if(theform.b_email.value == ""){
				bMissingFields = true;
				strFields += "     Billing Information: Email\n";
			}
			if((theform.delzone[0].checked == false) && (theform.delzone[1].checked == false) && (theform.delzone[2].checked == false)){
				bMissingFields = true;
				strFields += "     Shipping Method: Select One\n";
			}
			if((theform.payment_type[1].checked == true) || (theform.payment_type[2].checked == true)){
				if(theform.name_on_card.value == ""){
					bMissingFields = true;
					strFields += "     Payment Information: Name On Card\n";
				}
				if(theform.card_number.value == ""){
					bMissingFields = true;
					strFields += "     Payment Information: Card Number\n";
				}
				if(theform.card_expiration.value == ""){
					bMissingFields = true;
					strFields += "     Payment Information: Expiration Date\n";
				}
				if(theform.card_id.value == ""){
					bMissingFields = true;
					strFields += "     Payment Information: Card ID (CVV)\n";
				}
			}
			if(bMissingFields){
				alert( "I'm sorry, but you must provide the following information before continuing:\n" + strFields );
				return false;
			}
			// Set delivery charge
			if (theform.delzone[0].checked == true){ // Deliver
				theform.DELIVERY.value = "10.00";
			}
			if (theform.delzone[1].checked == true){ // Ship
				theform.DELIVERY.value = "*TBD*";
			}
			if (theform.delzone[2].checked == true){ // Pickup
				theform.DELIVERY.value = "0.00";
			}
			return true;
		}
		</script>
		
		<!-- Display message if Javascript is disabled -->
		<noscript>
			<tr>
				<td colspan="5" class="bodyBlack">
					<strong><br>Whoops, we detected that your browser does not have JavaScript support, or it is disabled.<br><br>
					Our product catalog requires that you have JavaScript enabled to order products.  <a href="http://www.netscape.com" class="bodyBlack">Netscape</a> and <a href="http://www.microsoft.com/ie" class="bodyBlack">Microsoft</a> offer free browsers which support JavaScript.<br><br>
					If you are using a JavaScript compliant browser and still have problems, make sure you have JavaScript <u>enabled</u> in your browser's preferences.<br><br>
					<div align="center"><a href="?sec=baskets&page=3" class="bodyBlack">Click Here to Refresh Page After Enabling Javascript</a><br><br></div></strong>
				</td>
			</tr>
		</noscript>

		<tr>
			<td colspan="5" align="center" class="bigBlack"><br><strong>Your Order Total:</strong><br><img src="images/spacer.gif" width="1" height="5" alt="" border="0"><br></td>
		</tr>
		<tr>
			<td colspan="5" align="center"><form action="/cgi-bin/checkout.pl" method="POST" onSubmit="return CheckForm(this)">
				<script>
					CheckoutCart();
				</script>
			</td>
		</tr>
		<tr>
			<td colspan="5">
				<table width="100%" border="0" cellspacing="0" cellpadding="5" align="center">
				<tr>
					<td align="center" class="bigBlack"><br><strong>Please fill out the following to complete your order:</strong><br><img src="images/spacer.gif" width="1" height="5" alt="" border="0"><br></td>
				</tr>

				<!-- Billing Information -->

				<tr class="cellDkGray">
					<td class="bigBlack"><strong>Billing Information <span class="smallBlack">(Must Match Credit Card Billing Information, If Applicable)</span></strong><br><img src="images/spacer.gif" width="1" height="5" alt="" border="0"><br></td>
				</tr>
				<tr class="cellDkGray">
					<td align="center">
						<table width="510" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
						<tr>
							<td><strong>Name:</strong></td>
							<td><input type="text" size="31" name="b_first"><img src="images/spacer.gif" width="7" height="1" alt="" border="0"><input type="text" size="34" name="b_last"></td>
						</tr>
						<tr>
							<td><strong>Address:</strong></td>
							<td><input type="text" name="b_addr" size="70"> </td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td><input type="text" name="b_addr2" size="70"></td>
						</tr>
						<tr>
							<td><strong>City:</strong><br><br></td>
							<td><input type="text" size="31" name="b_city"><img src="images/spacer.gif" width="10" height="1" alt="" border="0"><strong>State:</strong><img src="images/spacer.gif" width="12" height="1" alt="" border="0"><input type="text" size="1"  name="b_state"><img src="images/spacer.gif" width="11" height="1" alt="" border="0"><strong>Zip:</strong><img src="images/spacer.gif" width="12" height="1" alt="" border="0"><input type="text" size="12" name="b_zip"><br><br></td>
						</tr>
						<tr>
							<td><strong>Phone:</strong></td>
							<td><input type="text" size="31" name="b_phone"><img src="images/spacer.gif" width="10" height="1" alt="" border="0"><strong>Fax:</strong><img src="images/spacer.gif" width="22" height="1" alt="" border="0"><input type="text" size="25" name="b_fax"></td>
						</tr>
						<tr>
							<td><strong>Email:</strong></td>
							<td><input type="text" size="70" name="b_email"></td>
						</tr>
						<tr>
							<td colspan="2"><img src="images/spacer.gif" width="1" height="15" alt="" border="0"></td>
						</tr>
						</table>
					</td>
				</tr>

				<!-- Shipping Information -->

				<tr class="cellLtGray">
					<td class="bigBlack"><strong>Shipping Information <span class="smallBlack">(If Different From Billing Information - NO P.O. BOXES)</span></strong><br><img src="images/spacer.gif" width="1" height="5" alt="" border="0"><br></td>
				</tr>
				<tr class="cellLtGray">
					<td align="center">
						<table width="510" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
						<tr>
							<td><strong>Name:</strong></td>
							<td><input type="text" size="31" name="s_first"><img src="images/spacer.gif" width="7" height="1" alt="" border="0"><input type="text" size="34" name="s_last"></td>
						</tr>
						<tr>
							<td><strong>Address:</strong></td>
							<td><input type="text" name="s_addr" size="70"> </td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td><input type="text" name="s_addr2" size="70"></td>
						</tr>
						<tr>
							<td><strong>City:</strong><br><br></td>
							<td><input type="text" size="31" name="s_city"><img src="images/spacer.gif" width="10" height="1" alt="" border="0"><strong>State:</strong><img src="images/spacer.gif" width="12" height="1" alt="" border="0"><input type="text" size="1"  name="s_state"><img src="images/spacer.gif" width="11" height="1" alt="" border="0"><strong>Zip:</strong><img src="images/spacer.gif" width="12" height="1" alt="" border="0"><input type="text" size="12" name="s_zip"><br><br></td>
						</tr>
						<tr>
							<td><strong>Phone:</strong></td>
							<td><input type="text" size="31" name="s_phone"><img src="images/spacer.gif" width="10" height="1" alt="" border="0"><strong>Fax:</strong><img src="images/spacer.gif" width="22" height="1" alt="" border="0"><input type="text" size="25" name="s_fax"></td>
						</tr>
						<tr>
							<td><strong>Email:</strong></td>
							<td><input type="text" size="70" name="s_email"></td>
						</tr>
						<tr>
							<td colspan="2"><img src="images/spacer.gif" width="1" height="15" alt="" border="0"></td>
						</tr>
						</table>
					</td>
				</tr>

				<!-- Greeting Card Message -->

				<tr class="cellDkGray">
					<td class="bigBlack"><strong>Complimentary Greeting Card Message</strong><br><img src="images/spacer.gif" width="1" height="5" alt="" border="0"><br></td>
				</tr>
				<tr class="cellDkGray">
					<td align="center">
						<table width="510" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
						<tr>
							<td><textarea cols="60" rows="6" name="greeting"></textarea></td>
						</tr>
						<tr>
							<td colspan="2"><img src="images/spacer.gif" width="1" height="15" alt="" border="0"></td>
						</tr>
						</table>
					</td>
				</tr>

				<!-- Additional Comments -->

				<tr class="cellLtGray">
					<td class="bigBlack"><strong>Additional Comments or Special Instructions</strong><br><img src="images/spacer.gif" width="1" height="5" alt="" border="0"><br></td>
				</tr>
				<tr class="cellLtGray">
					<td align="center">
						<table width="510" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
						<tr>
							<td><textarea cols="60" rows="6" name="comment"></textarea></td>
						</tr>
						<tr>
							<td colspan="2"><img src="images/spacer.gif" width="1" height="15" alt="" border="0"></td>
						</tr>
						</table>
					</td>
				</tr>

				<!-- Delivery Options -->

				<tr class="cellDkGray">
					<td class="bigBlack"><strong>Delivery Method</strong><br><img src="images/spacer.gif" width="1" height="5" alt="" border="0"><br></td>
				</tr>
				<tr class="cellDkGray">
					<td align="center">
						<table width="510" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
						<tr>
							<td width="100" valign="top"><strong>Select One:</strong></td>
							<td>
								<input type="hidden" name="DELIVERY" value="" />
								<label for="delivery"><input type="radio" name="delzone" id="delivery" value="Delivery Within Las Vegas">&nbsp;<strong>Delivery Within Las Vegas<br><img src="images/spacer.gif" width="25" height="1" alt="" border="0"><span class="smallBlack">(A $10.00 Delivery Charge Will Be Added To Your Order)</span></strong></label><br><img src="images/spacer.gif" width="1" height="5" alt="" border="0"><br>
								<label for="ship"><input type="radio" name="delzone" id="ship" value="Ship Outside Las Vegas">&nbsp;<strong>Ship Outside Las Vegas<br><img src="images/spacer.gif" width="25" height="1" alt="" border="0"><span class="smallBlack">(Please Call 702.642.6000 for Shipping Costs)</span></strong></label><br><img src="images/spacer.gif" width="1" height="5" alt="" border="0"><br>
								<label for="pickup"><input type="radio" name="delzone" id="pickup" value="Pickup at Blind Center">&nbsp;<strong>Pickup at Blind Center<br><img src="images/spacer.gif" width="25" height="1" alt="" border="0"><span class="smallBlack">(You will be contacted when your order is ready to be picked up)</span></strong></label>
							</td>
						</tr>
						<tr>
							<td colspan="2"><img src="images/spacer.gif" width="1" height="15" alt="" border="0"></td>
						</tr>
						</table>
					</td>
				</tr>

				<!-- Payment Information -->

				<tr class="cellLtGray">
					<td class="bigBlack"><strong>Payment Information <span class="smallBlack">(Select Payment Type and Provide Applicable Information)</span></strong><br><img src="images/spacer.gif" width="1" height="5" alt="" border="0"><br></td>
				</tr>
				<tr class="cellLtGray">
					<td align="center">
						<table width="510" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
						<tr>
							<td><strong>Method:</strong></td>
							<td><label for="check"><input type="radio" name="payment_type" id="check" value="Check" checked>&nbsp;<b>Check</b></label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="mastercard"><input type="radio" name="payment_type" id="mastercard" value="MasterCard">&nbsp;<b>MasterCard</b></label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="visa"><input type="radio" name="payment_type" id="visa" value="Visa">&nbsp;<b>Visa</b></label></td>
							</tr>
							<tr>
								<td><img src="images/spacer.gif" width="1" height="3" alt="" border="0"></td>
							</tr>
							<tr>
								<td><strong>Name On Card:</strong> </td>
								<td><input type="text" name="name_on_card" size="63"> </td>
							</tr>
							<tr>
								<td><strong>Card Number:</strong></td>
								<td><input type="text" onKeyPress="return keyCheck(event, this)" name="card_number" size="63"></td>
							</tr>
							<tr>
								<td><strong>Expiration:</strong></td>
								<td><input type="text" onKeyPress="return keyCheck(event, this)" name="card_expiration" size="25"><img src="images/spacer.gif" width="11" height="1" alt="" border="0"><a href="javascript:SpawnChild('cardid.html','child','375','395','yes')" class="bodyBlack"><strong>Card ID (CVV):</strong></a><img src="images/spacer.gif" width="15" height="1" alt="" border="0"><input type="text" size="13" name="card_id"></td>
							</tr>
						<tr>
							<td colspan="2"><img src="images/spacer.gif" width="1" height="15" alt="" border="0"></td>
						</tr>
							</table>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td align="center" class="blacktext"><br><input type=submit Value="Submit Order"> <INPUT type=RESET value="  Clear Form  "><br><br></td>
		</form>
		</tr>
	<?
	}
	if ($page == "5"){
	?>

		<!-- Shopping Cart Scripts -->

		<script src="language-en.js"></script>
		<script src="nopcart.js">
		//=====================================================================||
		//               NOP Design JavaScript Shopping Cart                   ||
		//                                                                     ||
		// For more information on SmartSystems, or how NOPDesign can help you ||
		// Please visit us on the WWW at http://www.nopdesign.com              ||
		//                                                                     ||
		// JavaScript Shop Module, V.4.4.0                                     ||
		//=====================================================================||
		</script>
		<!-- Thanks For The Order -->

		<meta HTTP-EQUIV="refresh" CONTENT="6; url=/">
		<script>SetCookie("NumberOrdered", 0, null, "/");</script>
		<tr>
			<td colspan="5" align="center" class="bigBlack"><br><strong><font size="+1">Thank You!</font><br>Your order has been submitted.</strong><br><br></td>
		</tr>
		<tr>
			<td align="center" class="bodyBlack"><br><strong>A receipt for your order has been mailed to <em><font color="#FF0000"><? echo $email; ?></font></em></strong>.<br><br></td>
		</tr>
		<tr>
			<td align="center" class="bodyBlack"><br><strong>You will be redirected to the Home Page automatically.<br>If this page remains longer than 5 seconds, <a href="/" class="bodyBlack">Click Here</a>.</strong><br><br></td>
		</tr>
	<?
	}
	?>
		</table>
	</td>
</tr>
</table>
<br>

<!-- END INCLUDE Baskets -->
