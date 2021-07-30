<!-- BEGIN INCLUDE menu.php -->

<!-- move all this to custom.js when complete -->
<script language="javascript">
	function menuBG(id, bgColor){
		document.getElementById(id).style.backgroundColor = bgColor;
	}

	function menuText(id, textColor){
		document.getElementById(id).style.color = textColor;
	}
	
	function menuArrow(id, text, color){
	    document.getElementById(id).innerHTML = text;
		document.getElementById(id).style.color = color;
	}

	function hideDiv(div){
		if (document.getElementById(div).style.display == 'none'){
			document.getElementById(div).style.display = 'hidden';
		}else{
			document.getElementById(div).style.display = 'none';
		}
	}
	
	function showDiv(div){
//alert(div);
		if (document.getElementById(div).style.display == 'none' || document.getElementById(div).style.display == 'hidden'){
			document.getElementById(div).style.display = '';
		}
	}
	
	function showSubmenu(div){
	    switch(div){
	        case 'menu1':
				hideDiv('menu1');
				showDiv('submenu1');
				showHelp(0);
	            break;
	        case 'menu2':
				hideDiv('menu2');
				showDiv('submenu2');
				showHelp(0);
	            break;
	        case 'menu3':
				hideDiv('menu3');
				showDiv('submenu3');
				showHelp(0);
	            break;
	        case 'all':
	            hideDiv('menu1');
	            showDiv('submenu1');
				hideDiv('menu2');
				showDiv('submenu2');
				hideDiv('menu3');
				showDiv('submenu3');
	            break;
	    }
	}
	
	function hideSubmenu(div){
	    switch(div){
	        case 'menu1':
				hideDiv('submenu1');
				showDiv('menu1');
				showHelp(0);
	            break;
	        case 'menu2':
				hideDiv('submenu2');
				showDiv('menu2');
				showHelp(0);
	            break;
	        case 'menu3':
				hideDiv('submenu3');
				showDiv('menu3');
				showHelp(0);
	            break;
	        case 'all':
	            hideDiv('submenu1');
	            showDiv('menu1');
				hideDiv('submenu2');
				showDiv('menu2');
				hideDiv('submenu3');
				showDiv('menu3');
	            break;
	    }
	}

	function showHelp(item){
		var help = new Array();
		help[0] = '';
// make rev a & b versions of some of these ("your" vs. "their", etc.) and call based on user_level

		// Transfer to AT&T Menu
		help[1] = '<strong>Transfer to AT&amp;T</strong> &mdash;<br>Transfer a phone number from a different provider over to AT&amp;T or transfer liability for an existing non-company phone over to the company.<br><br>Once the port completes, the number will belong to Google.<br><br>Process will take 2-3 Business days to complete.';
			help[101] = '<strong>Port to AT&amp;T</strong> &mdash;<br>Transfer a phone number from a different provider over to AT&T<br><br>Once the port completes, the number will belong to Google.<br><br>Process will take 2-3 Business days to complete.';
			help[102] = '<strong>Migrate from the old AT&amp;T</strong> &mdash;<br>Upgrade a legacy AT&amp;T Wireless user to a New AT&amp;T SIM and equipment.<br><br>Process will take 2-3 Business days to complete.';
			help[103] = '<strong>Transfer Liability to Google</strong> &mdash;<br>Transfer an existing AT&amp;T number under personal liability over to Google\'s corporate responsibility.<br><br>Once the transfer completes, the number will belong to Google.<br><br>Process will take 2-3 Business days to complete.';

		// Manage Your Account Menu
		help[2] = '<strong>Manage Your Account</strong> &mdash;<br>Manage your existing account\'s settings. Change plans &amp; features, change phone numbers, stop service, etc.<br><br>Process will take 1-2 Business days to complete.';
			help[201] = '<strong>Change Plan &amp; Features</strong> &mdash;<br>Add discounted international features such as AT&amp;T Worldconnect, AT&amp;T World Traveler, and Unlimited International BB Roaming.<br><br>Process will take 1-2 Business days to complete.';
			help[202] = '<strong>Change Phone Number</strong> &mdash;<br>Change wireless number to a number with a different area code.<br><br>Process will take 1-2 Business days to complete.';
			help[203] = '<strong>Stop Service</strong> &mdash;<br>Cancel a subscriber\'s wireless number.<br><br>Process will take 1-2 Business days to complete.';

		// Administrator Options Menu
		help[3] = '<strong>Administrator Options</strong> &mdash;<br>Place bulk orders, approve restricted requests, manage devices, edit site notes, administer site users, run reports, etc.';
			help[301] = '<strong>Update Line of Service</strong> &mdash;<br>Update device/line record username, rate plan, cost center, and employee ID.<br><br>Process will take 2-3 Business days to complete.';
			help[302] = '<strong>Unlock GSM Device</strong> &mdash;<br>Unlock an AT&amp;T branded GSM device for use with a foreign SIM card.<br><br>Process will take <font color="#FF0000">X-X</font> Business days to complete.';
			help[303] = '<strong>Place Bulk Order</strong> &mdash;<br>Place a bulk order for AT&amp;T devices.';
			help[304] = '<strong>Request RMA</strong> &mdash;<br>Request and RMA number to return a device to AT&amp;T.';
			help[305] = '<strong>Approve Request</strong> &mdash;<br>Approve requests submitted by users.';
			help[306] = '<strong>Manage Open Tickets</strong> &mdash;<br>View, add notes to, and close open tickets.';
			help[307] = '<strong>Manage Site Users</strong> &mdash;<br>Add, edit, and delete the site users.';
			help[308] = '<strong>Manage Site News &amp; Notes</strong> &mdash;<br>Add, edit, and delete the welcome message and notes displayed on the home page.';
			help[309] = '<strong>Manage Approved Devices List</strong> &mdash;<br>Add, edit, and delete the available devices as displayed on the site forms.';
			help[310] = '<strong>Reports</strong> &mdash;<br>Management Reports.';
		
		// News & Notes
		help[4] = '<strong>News &amp; Notes</strong> &mdash;<br>View the site news &amp; notes.';

		// Log Out
		help[5] = '<strong>Log out of the system ...</strong>';

<? 
/*
	    text[1] = '<strong>Transfer Number</strong> &mdash;<br>Transfer a phone number from a different provider over to Cingular or transfer liability for an existing non-company phone over to the company.  Once the port completes, the number will belong to Google.  Process will take 2-3 Business days to complete.';
        text[2] = '<b>Transfer Liability</b> – Transfer an existing Cingular number under personal liability over to Google’s corporate responsibility.  Once the transfer completes, the number will belong to Google.  Process will take 2-3 Business days to complete.';
        text[3] = '<b>AT&T to Cingular</b> – Upgrade a legacy AT&T Wireless user to a new Cingular SIM and equipment.  Process will take 2-3 Business days to complete.';
        text[4] = '<b>Device Management</b> - Manage an existing Cingular user’s device.  Process will take ?-? days to complete.';
        text[5] = '<b>Unlock GSM Device</b> – Unlock mobile device.  There is a fee for this service.  Process will take ?-? days to complete.';
        text[6] = '<b>Plan Change</b> – Add discounted international features such as Cingular Worldconnect, Cingular World Traveler, and Unlimited International BB Roaming.  Process will take 1-2 Business days to complete.';
        text[7] = '<b>Phone Number Change</b> – Change  wireless number to a number with a different area code.  Process will take 1-2 Business days to complete.';
        text[8] = '<b>Stop Service</b> – Cancel a subscriber’s wireless number.  Process will take 1-2 Business days to complete.';
        text[9] = '<b>Update Subscriber Information</b> – Updating record such as username, rate plan, cost center, and employee ID.  Process will take 2-3 Business days to complete.';
*/
?>
		document.getElementById('Help').innerHTML = help[item];
	}
</script>



<img src="images/GoogleLogo.gif" alt="Google" width="203" height="74" border="0">
<br><img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
	<!-- Transfer/Port menu -->
   	<div id="menu1" z-index: 0;>
		<table width="100%" cellspacing="0" cellpadding="0" style="border: 1px solid #CBCCCE;">
		<tr bgcolor="#EFEFEF">
			<td width="10" bgcolor="#AA0000"><img src="images/spacer.gif" alt="" width="5" height="20" border="0"></td>
			<td width="240"
				id="menu1-1"
				onclick="showSubmenu('menu1');"
				onmouseOver="menuBG('menu1-1', '#AA0000'); menuText('text1-1', '#FFFFFF'); showHelp(1);"
				onmouseOut="menuBG('menu1-1', '#EFEFEF'); menuText('text1-1', '#000000'); showHelp(0);"
				class="bodyBlack"
				style="cursor:pointer;">
				<strong id="text1-1"><img src="images/spacer.gif" alt="" width="5" height="1" border="0">Transfer to AT&amp;T</strong>
			</td>
		</tr>
		</table>
	</div>
	<div id="submenu1" style="display: none; z-index: 1;">
		<table width="100%" cellspacing="0" cellpadding="0" style="border: 1px solid #CBCCCE;">
		<tr>
			<td>
				<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#EFEFEF">
				<tr bgcolor="#AA0000">
					<td height="20"
						id="menu1-2"
						title="Click to Collapse Menu"
						onclick="hideSubmenu('menu1');"
						onmouseOver="menuBG('menu1-2', '#FF0000'); menuArrow('arrow1-2', '&laquo;', '#FFFFFF');"
						onmouseOut="menuBG('menu1-2', '#AA0000'); menuArrow('arrow1-2', '&raquo;', '#FFFFFF');"
						class="bodyWhite"
						style="cursor:pointer;">
						<strong id="arrow1-2">&raquo;</strong>
						<strong id="text1-2"><img src="images/spacer.gif" alt="" width="1" height="1" border="0">Transfer to AT&amp;T</strong>
					</td>
				</tr>
				<tr>
					<td height="20" class="bodyBlack">
						<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
						<img src="images/OrangeBullet.gif" alt="" width="10" height="10" border="0">
						<strong>&nbsp;<a href="?sec=port&task=port" onmouseOver="showHelp(101);" onmouseOut="showHelp(0);" class="bodyBlackRed">Port to AT&amp;T</a></strong>
					</td>
				</tr>
				<tr>
					<td height="20" class="bodyBlack">
						<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
						<img src="images/BlueBullet.gif" alt="" width="10" height="10" border="0">
						<strong>&nbsp;<a href="?sec=port&task=migrate" onmouseOver="showHelp(102);" onmouseOut="showHelp(0);" class="bodyBlackRed">Migrate from the old AT&amp;T</a></strong>
					</td>
				</tr>
				<tr>
					<td height="20" class="bodyBlack">
						<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
						<img src="images/GreenBullet.gif" alt="" width="10" height="10" border="0">
						<strong>&nbsp;<a href="?sec=port&task=transfer" onmouseOver="showHelp(103);" onmouseOut="showHelp(0);" class="bodyBlackRed">Transfer Liability to Google</a></strong>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
	</div>
	<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
	<!-- Manage Account Menu -->
   	<div id="menu2" z-index: 0;>
		<table width="100%" cellspacing="0" cellpadding="0" style="border: 1px solid #CBCCCE;">
		<tr bgcolor="#EFEFEF">
			<td width="10" bgcolor="#000080"><img src="images/spacer.gif" alt="" width="5" height="20" border="0"></td>
			<td	width="240"
				id="menu2-1"
				onclick="showSubmenu('menu2');"
				onmouseOver="menuBG('menu2-1', '#000080'); menuText('text2-1', '#FFFFFF'); showHelp(2);"
				onmouseOut="menuBG('menu2-1', '#EFEFEF'); menuText('text2-1', '#000000'); showHelp(0);"
				class="bodyBlack"
				style="cursor:pointer;">
				<strong id="text2-1"><img src="images/spacer.gif" alt="" width="5" height="1" border="0">Manage Your Account</strong>
			</td>
		</tr>
		</table>
	</div>
	<div id="submenu2" style="display: none; z-index: 1;">
		<table width="100%" cellspacing="0" cellpadding="0" style="border: 1px solid #CBCCCE;">
		<tr>
			<td>
				<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#EFEFEF">
				<tr bgcolor="#000080">
					<td	height="20"
						id="menu2-2"
						title="Click to Collapse Menu"
						onclick="hideSubmenu('menu2');"
						onmouseOver="menuBG('menu2-2', '#0000FF'); menuArrow('arrow2-2', '&laquo;', '#FFFFFF');"
						onmouseOut="menuBG('menu2-2', '#000080'); menuArrow('arrow2-2', '&raquo;', '#FFFFFF');"
						class="bodyWhite"
						style="cursor:pointer;">
						<strong id="arrow2-2">&raquo;</strong>
						<strong id="text2-2"><img src="images/spacer.gif" alt="" width="1" height="1" border="0">Manage Your Account</strong>
					</td>
				</tr>
				<tr>
					<td height="20" class="bodyBlack">
						<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
						<img src="images/RedBullet.gif" alt="" width="10" height="10" border="0">
						<strong>&nbsp;<a href="?sec=change&task=plan" onmouseOver="showHelp(201);" onmouseOut="showHelp(0);" class="bodyBlackBlue">Change Plan &amp; Features</a></strong>
					</td>
				</tr>
				<tr>
					<td height="20" class="bodyBlack">
						<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
						<img src="images/PurpleBullet.gif" alt="" width="10" height="10" border="0">
						<strong>&nbsp;<a href="?sec=change&task=number" onmouseOver="showHelp(202);" onmouseOut="showHelp(0);" class="bodyBlackBlue">Change Phone Number</a></strong>
					</td>
				</tr>
				<tr>
					<td height="20" class="bodyBlack">
						<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
						<img src="images/YellowBullet.gif" alt="" width="10" height="10" border="0">
						<strong>&nbsp;<a href="?sec=change&task=stop" onmouseOver="showHelp(203);" onmouseOut="showHelp(0);" class="bodyBlackBlue">Stop Service</a></strong>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
	</div>
<? if ($_SESSION["user_level"] == "Asst" || $_SESSION["user_level"] == "Admin"){ ?>
	<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
	<!-- Admin Options Menu -->
   	<div id="menu3" z-index: 0;>
		<table width="100%" cellspacing="0" cellpadding="0" style="border: 1px solid #CBCCCE;">
		<tr bgcolor="#EFEFEF">
			<td width="10" bgcolor="#008000"><img src="images/spacer.gif" alt="" width="5" height="20" border="0"></td>
			<td	width="240"
				id="menu3-1"
				onclick="showSubmenu('menu3');"
				onmouseOver="menuBG('menu3-1', '#008000'); menuText('text3-1', '#FFFFFF'); showHelp(3);"
				onmouseOut="menuBG('menu3-1', '#EFEFEF'); menuText('text3-1', '#000000'); showHelp(0);"
				class="bodyBlack"
				style="cursor:pointer;">
				<strong id="text3-1"><img src="images/spacer.gif" alt="" width="5" height="1" border="0">Administrator Options</strong>
			</td>
		</tr>
		</table>
	</div>
	<div id="submenu3" style="display: none; z-index: 1;">
		<table width="100%" cellspacing="0" cellpadding="0" style="border: 1px solid #CBCCCE;">
		<tr>
			<td>
				<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#EFEFEF">
				<tr bgcolor="#008000">
					<td	height="20"
						id="menu3-2"
						title="Click to Collapse Menu"
						onclick="hideSubmenu('menu3');"
						onmouseOver="menuBG('menu3-2', '#00CC00'); menuArrow('arrow3-2', '&laquo;', '#FFFFFF');"
						onmouseOut="menuBG('menu3-2', '#008000'); menuArrow('arrow3-2', '&raquo;', '#FFFFFF');"
						class="bodyWhite"
						style="cursor:pointer;">
						<strong id="arrow3-2">&raquo;</strong>
						<strong id="text3-2"><img src="images/spacer.gif" alt="" width="1" height="1" border="0">Administrator Options</strong>
					</td>
				</tr>
				<tr>
	<? if ($_SESSION["user_level"] == "Asst" || $_SESSION["user_level"] == "Admin"){ ?>
				<td height="20" class="bodyBlack">
						<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
						<img src="images/BlueBullet.gif" alt="" width="10" height="10" border="0">
						<strong>&nbsp;<a href="?sec=service&task=update" onmouseOver="showHelp(301);" onmouseOut="showHelp(0);" class="bodyBlackGreen">Update Line of Service</a></strong>
					</td>
				</tr>
	<? } ?>
	<? if ($_SESSION["user_level"] == "Admin"){ ?>
				<tr>
					<td height="20" class="bodyBlack">
						<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
						<img src="images/RedBullet.gif" alt="" width="10" height="10" border="0">
						<strong>&nbsp;<a href="?sec=service&task=unlock" onmouseOver="showHelp(302);" onmouseOut="showHelp(0);" class="bodyBlackGreen">Unlock GSM Device</a></strong>
					</td>
				</tr>
	<? } ?>
	<? if ($_SESSION["user_level"] == "Admin"){ ?>
				<tr>
					<td height="20" class="bodyBlack">
						<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
						<img src="images/YellowBullet.gif" alt="" width="10" height="10" border="0">
						<strong>&nbsp;<a href="?sec=service&task=order" onmouseOver="showHelp(303);" onmouseOut="showHelp(0);" class="bodyBlackGreen">Place Bulk Order</a></strong>
					</td>
				</tr>
	<? } ?>
	<? if ($_SESSION["user_level"] == "Asst" || $_SESSION["user_level"] == "Admin"){ ?>
				<tr>
					<td height="20" class="bodyBlack">
						<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
						<img src="images/GreenBullet.gif" alt="" width="10" height="10" border="0">
						<strong>&nbsp;<a href="?sec=service&task=rma" onmouseOver="showHelp(304);" onmouseOut="showHelp(0);" class="bodyBlackGreen">Request RMA</a></strong>
					</td>
				</tr>
	<? } ?>
	<? if ($_SESSION["user_level"] == "Asst" || $_SESSION["user_level"] == "Admin"){ ?>
				<tr>
					<td height="20" class="bodyBlack">
						<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
						<img src="images/PurpleBullet.gif" alt="" width="10" height="10" border="0">
						<strong>&nbsp;<a href="?sec=" onmouseOver="showHelp(305);" onmouseOut="showHelp(0);" class="bodyBlackGreen">Approve Request</a></strong>
					</td>
				</tr>
	<? } ?>
	<? if ($_SESSION["user_level"] == "Asst" || $_SESSION["user_level"] == "Admin"){ ?>
<!--				<tr>
					<td height="20" class="bodyBlack">
						<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
						<img src="images/OrangeBullet.gif" alt="" width="10" height="10" border="0">
						<strong>&nbsp;<a href="?sec=" onmouseOver="showHelp(306);" onmouseOut="showHelp(0);" class="bodyBlackGreen">Manage Open Tickets</a></strong>
					</td>
				</tr>-->
	<? } ?>
	<? if ($_SESSION["user_level"] == "Admin"){ ?>
				<tr>
					<td height="20" class="bodyBlack">
						<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
						<img src="images/BlueBullet.gif" alt="" width="10" height="10" border="0">
						<strong>&nbsp;<a href="?sec=manage&task=list_users" onmouseOver="showHelp(307);" onmouseOut="showHelp(0);" class="bodyBlackGreen">Manage Site User</a></strong>
					</td>
				</tr>
	<? } ?>
	<? if ($_SESSION["user_level"] == "Admin"){ ?>
				<tr>
					<td height="20" class="bodyBlack">
						<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
						<img src="images/RedBullet.gif" alt="" width="10" height="10" border="0">
						<strong>&nbsp;<a href="?sec=news&task=list" onmouseOver="showHelp(308);" onmouseOut="showHelp(0);" class="bodyBlackGreen">Manage Site News &amp; Notes</a></strong>
					</td>
				</tr>
	<? } ?>
	<? if ($_SESSION["user_level"] == "Admin"){ ?>
				<tr>
					<td height="20" class="bodyBlack">
						<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
						<img src="images/YellowBullet.gif" alt="" width="10" height="10" border="0">
						<strong>&nbsp;<a href="?sec=manage&task=list_devices" onmouseOver="showHelp(309);" onmouseOut="showHelp(0);" class="bodyBlackGreen">Manage Approved Devices List</a></strong>
					</td>
				</tr>
	<? } ?>
	<? if ($_SESSION["user_level"] == "Admin"){ ?>
				<tr>
					<td height="20" class="bodyBlack">
						<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
						<img src="images/GreenBullet.gif" alt="" width="10" height="10" border="0">
						<strong>&nbsp;<a href="?sec=" onmouseOver="showHelp(310);" onmouseOut="showHelp(0);" class="bodyBlackGreen">Reports</a></strong>
					</td>
				</tr>
	<? } ?>
				</table>
			</td>
		</tr>
		</table>
	</div>
<? } ?>
	<img src="images/spacer.gif" alt="" width="1" height="15" border="0"><br>
	<!-- News & Notes Menu -->
   	<div id="menu4" z-index: 0;>
		<table width="100%" cellspacing="0" cellpadding="0" style="border: 1px solid #CBCCCE;">
		<tr bgcolor="#EFEFEF">
			<td width="10" bgcolor="#4F1E96"><img src="images/spacer.gif" alt="" width="5" height="20" border="0"></td>
			<td	width="240"
				id="menu4-1"
				onclick="javascript:window.location='?sec=notes';"
				onmouseOver="menuBG('menu4-1', '#4F1E96'); menuText('text4-1', '#FFFFFF'); showHelp(4);"
				onmouseOut="menuBG('menu4-1', '#EFEFEF'); menuText('text4-1', '#000000'); showHelp(0);"
				class="bodyBlack"
				style="cursor:pointer;">
				<strong id="text4-1"><img src="images/spacer.gif" alt="" width="5" height="1" border="0">News &amp; Notes</strong>
			</td>
		</tr>
		</table>
	</div>
	<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
	<!-- Logout -->
   	<div id="menu5" z-index: 0;>
		<table width="100%" cellspacing="0" cellpadding="0" style="border: 1px solid #CBCCCE;">
		<tr bgcolor="#EFEFEF">
			<td width="10" bgcolor="#FFCC00"><img src="images/spacer.gif" alt="" width="5" height="20" border="0"></td>
			<td	width="240"
				id="menu5-1"
				onclick="javascript:window.location='?sec=login';"
				onmouseOver="menuBG('menu5-1', '#FFCC00'); menuText('text5-1', '#FFFFFF'); showHelp(5);"
				onmouseOut="menuBG('menu5-1', '#EFEFEF'); menuText('text5-1', '#000000'); showHelp(0);"
				class="bodyBlack"
				style="cursor:pointer;">
				<strong id="text5-1"><img src="images/spacer.gif" alt="" width="5" height="1" border="0">Log Out</strong>
			</td>
		</tr>
		</table>
	</div>
<br>
<div id="Indent"></div><div align="left" class="bodyBlack" id="Help"></div>

<!-- END INCLUDE menu.php -->
