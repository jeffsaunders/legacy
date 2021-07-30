<!-- BEGIN Include cart.php -->



<script>

// Only accept digits (numbers)

	function onlyNumbers(e,o){

		//alert(o.value);

		var keynum

		var keychar

		var ltrcheck

		var crcheck

		if(window.event){ // IE

			keynum = e.keyCode

		}else if(e.which){ // Webkit/Firefox/Opera

			keynum = e.which

		}

		//alert(keynum);

	//	if (keynum == 08 || keynum == 45 || !keynum) return true; // Backspace, hyphen, or navigation (arrow) key

		if (keynum == 08 || !keynum) return true; // Backspace or navigation (arrow) key

		keychar = String.fromCharCode(keynum)

		ltrcheck = /D/ //Regular expression for NON-digit (letter)

		crcheck = /cM/ //Regular expression ctrl-M (enter)

		if (crcheck.test(keychar)) o.blur();

		return !ltrcheck.test(keychar) //Return true if not a letter

	//	return (!ltrcheck.test(keychar)||crcheck.test(keychar)) //Return true if not a letter OR enter

	}



// Update item quantity in cart

// Using Javascript in order to interrogate the updated quantity value on-the-fly

	function updateItem(item,id){

		window.location="updatecart.php?Task=UpdateItem&ItemNum="+item+"&Quantity="+document.getElementById(id).value;

	}



// Remove an item from cart

	function removeItem(item){

		if (confirm("Are you sure you want to remove this item from your cart?")){

			window.location="updatecart.php?Task=RemoveItem&ItemNum="+item;

		}

	}



// Apply discount

	function applyDiscount(id){

		window.location="updatecart.php?Task=ApplyDiscount&DiscountCode="+document.getElementById(id).value;

	}



// Destroy the shopping cart

	function emptyCart(item){

		if (confirm("Are you sure you want to completely empty your shopping cart?")){

			window.location="updatecart.php?Task=DestroyCart";

		}

	}

</script>



<?

session_start();



$items = 0;

while ($_SESSION['Item'.$items]){

	$qty += $_SESSION['Quantity'.$items];

	$items++;

}

?>



<div id="cart">

	<?

	if ($items > 0){

	?>

	<div id="cartHeadline">

		<table>

		<tr>

			<td width="600">Your Shopping Cart<br><span class="detailFootnote">You have <?=(isset($qty) ? $qty : 0);?> item<?=($qty != 1 ? "s" : "");?> in your shopping cart.</span></td>

			<td width="300" align="right" valign="bottom"><a href="?sec=checkout"><img src="images/ProceedToCheckout.jpg" alt="" width="222" height="41" border="0"></a></td>

		</tr>

		</table>

	</div>

	<div id="cartContents">

		<table border="0" cellspacing="10" cellpadding="0">

		<tr>

			<td width="160" class="cartDetailHeader roundedCorners">Item</td>

			<td width="350" class="cartDetailHeader roundedCorners">Attributes</td>

			<td width="150" class="cartDetailHeader roundedCorners">Quantity</td>

			<td width="120" class="cartDetailHeader roundedCorners">Item Price</td>

			<td width="120" class="cartDetailHeader roundedCorners">Item Total</td>

		</tr>

		<?

		$item = 0;

		while ($_SESSION['Item'.$item]){

			if ($_SESSION['Quantity'.$item] > 0){

		?>

		<tr>

			<td valign="top"><img src="images/products/<?=$_SESSION['Image'.$item];?>" alt="" width="160" height="70" border="0" class="detailImage roundedCorners"></td>

			<td valign="top">

				<table cellspacing="0" cellpadding="0">

				<tr>

					<td width="90"><strong>MESSAGE:</strong></td>

					<td width="260"><?=$_SESSION['Title'.$item];?></td>

				</tr>

				<tr>

					<td><strong>COLOR:</strong></td>

					<td><?=$_SESSION['Color'.$item];?></td>

				</tr>

				<tr>

					<td><strong>SIZE:</strong></td>

					<td><?=$_SESSION['Size'.$item];?></td>

				</tr>

				<tr>

					<td><strong>WIDTH:</strong></td>

					<td><?=$_SESSION['Width'.$item];?></td>

				</tr>

				</table>

			</td>

			<td align="center" valign="top">

				<table style="margin-top:-5px;">

				<tr>

					<td valign="top"><input type="text" name="Quantity<?=$item;?>" id="Quantity<?=$item;?>" size="1" maxlength="3" value="<?=$_SESSION['Quantity'.$item];?>" onKeyPress="return onlyNumbers(event,this);" style="width:20px; text-align:right; background-color:#F0F0F0;"></td>

					<td><div style="padding:15px 0px 0px 5px;"><a onClick="updateItem(<?=$item;?>,'Quantity<?=$item;?>');" class="detailFootnote" style="cursor:pointer;">Update</a></div></td>

					<td>|</td>

					<td><div style="padding:15px 0px 0px 0px;"><a onClick="removeItem(<?=$item;?>);" class="detailFootnote" style="cursor:pointer;">Remove</a></div></td>

				</tr>

				</table>

			</td>

			<td align="right" valign="top"><div style="margin-top:2px;">$<?=number_format($_SESSION['Price'.$item], 2, '.', ',');?></div></td>

			<td align="right" valign="top"><div style="margin-top:2px;">$<?=number_format($_SESSION['Price'.$item]*$_SESSION['Quantity'.$item], 2, '.', ',');?></div></td>

		</tr>

		<!-- Seperator -->

		<tr>

			<td colspan="5"><hr width="100%" size="2" color="#F0F0F0"></td>

		</tr>

		<?

				$subtotal += ($_SESSION['Price'.$item] * $_SESSION['Quantity'.$item]) * (isset($_SESSION['ItemDiscount']) ? $_SESSION['ItemDiscount'] : 1);

			}

			$item++;

		}

		?>

		<tr>

			<td colspan="2" rowspan="2" valign="top">

				<table border="0" cellspacing="0" cellpadding="0">

				<tr>

					<td><strong>Discount Code:</strong>  </td>

					<td><input type="text" name="DiscountCode" id="DiscountCode" size="10" maxlength="20" value="<?=$_SESSION['DiscountCode'];?>" style="width:100px; background-color:#F0F0F0;"<?=(isset($_SESSION['ShippingDiscount']) || isset($_SESSION['ItemDiscount']) ? ' disabled' : '');?>>  </td>

					<?

					if (isset($_SESSION['ShippingDiscount']) || isset($_SESSION['ItemDiscount'])){

					?>

					<td>

						<font color="#FF0000">Discount Applied</font>

					</td>

					<?

					}else{

					?>

					<td valign="bottom">

						<div style="padding:20px 0px 0px 0px;"><a onClick="applyDiscount('DiscountCode');" class="detailFootnote" style="cursor:pointer;">Apply</a></div>

					</td>

					<?

					}

					?>

				</tr>

				</table>

			</td>

			<td colspan="2" align="right"><strong>Subtotal:</strong></td>

			<td align="right"><strong>$<?=number_format($subtotal, 2, '.', ',');?></strong></td>

		</tr>

		<tr>

			<td colspan="2" align="right"><strong>Free Shipping:</strong></td>

			<td align="right"><strong>$<?=number_format((ceil($qty/$config['shipping']['increment']) * $config['shipping']['cost']) * (isset($_SESSION['ShippingDiscount']) ? $_SESSION['ShippingDiscount'] : 1), 2, '.', ',');?></strong></td>

		</tr>

		<tr>

			<td colspan="4" align="right"><strong>Total (plus applicable sales tax):</strong><br><div class="detailFootnote" style="padding-top:10px;">
			  <table width="100%" border="0">
			    <tr>
			      <td width="37%" align="left"><span class="detailFootnote" style="padding-top:10px;"><img src="../images/lock.gif" width="125" height="60" alt="Secure Shopping" /></span></td>
			      <td width="63%" align="right" valign="top"><span class="detailFootnote" style="padding-top:10px;">* Prayer Belts collects 8¼% Sales Tax on all orders shipped within Texas. </span></td>
		        </tr>
		      </table>
			   </div></td>

			<td align="right" valign="top"><strong style="font-size:18px;">$<?=number_format($subtotal + (ceil($qty/$config['shipping']['increment']) * $config['shipping']['cost']) * (isset($_SESSION['ShippingDiscount']) ? $_SESSION['ShippingDiscount'] : 1), 2, '.', ',');?></strong></td>

		</tr>

		<!-- Seperator -->

		<tr>

			<td colspan="5"><hr width="100%" size="2" color="#F0F0F0"></td>

		</tr>

		<tr>

			<td colspan="5" align="right">

			<table width="100%" border="0" cellpadding="0">

			<tr>

				<td width="450" align="left"><a onClick="emptyCart();" title="Empty Shopping Cart" style="cursor:pointer;"><img src="images/EmptyShoppingCart.jpg" alt="" width="222" height="41" border="0"></a></td>

				<td width="225" align="right"><a href="?sec=products" title="Continue Shopping"><img src="images/ContinueShopping.jpg" alt="" width="222" height="41" border="0"></a></td>

				<td width="225" align="right"><a href="?sec=checkout"><img src="images/ProceedToCheckout.jpg" alt="" width="222" height="41" border="0"></a></td>

			</tr>

			</table>

			</td>

		</tr>

		</table>

	</div>

	<?

	}else{

	?>

	<div id="cartHeadline">

		<table>

		<tr>

			<td width="600">Your Shopping Cart <a href="updatecart.php?Task=DestroyCart">Kill It!</a><br><span class="cartFootnote">You have <?=(isset($qty) ? $qty : 0);?> item<?=($qty != 1 ? "s" : "");?> in your shopping cart.</span></td>

			<td width="300" align="right" valign="bottom"><a href="?sec=products" title="Continue Shopping"><img src="images/ContinueShopping.jpg" alt="" width="222" height="41" border="0"></a></td>

		</tr>

		</table>

	</div>

	<div id="cartContents">

		<br><br>

		<table width="100%" cellspacing="10" cellpadding="0">

		<tr>

			<td align="center"><strong>– Your Shopping Cart is Empty –</strong></td>

		</tr>

		</table>

		<br><br>

	</div>

	<?

	}

	?>

</div>



<!-- END Include cart.php -->