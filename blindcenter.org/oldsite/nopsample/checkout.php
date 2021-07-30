<?
//=====================================================================||
//               NOP Design JavaScript Shopping Cart                   ||
//                   PHP SCRIPT Checkout Module                        ||
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
//                                                                     ||
//  Function: Writes available form elements from the NOP              ||
//            Free Cart (http://www.nopdesign.com/freecart)            ||
//            and other form elements to an email file, and            ||
//            send user confirmation                                   ||
//                                                                     ||
//=====================================================================||


//######################################################################
//                                                                     #
// User defined variables:                                             #
//     $header        - string value containing the complete           #
//                      path of the HTML page header                   #
//     $footer        - string value containing the complete           #
//                      path of the HTML page footer                   #
//     $youremail     - string value containing the email address to   #
//                      send catalog orders in EMAIL or BOTH modes     #
//     $returnpage    - URL to send user when checkout is complete     #
//     $csvfilename   - string value containing the complete           #
//                      path of the user database.                     #
//     $csvquote      - string value containing what to use for quotes #
//                      in the csv file (typically "" or \")           #
//     $mode          - string value containing 'EMAIL', 'FILE' or     #
//                      'BOTH' to determine if the script should send  #
//                      an email to you with the new order, write the  #
//                      order to a CSV file, or do both.               #
//######################################################################
$header        = "header.html";
$footer        = "footer.html";
$returnpage    = "/";
$youremail     = "spam@nopdesign.com";
$csvfilename   = "orders.csv";
$csvquote      = "\"\"";
$mode          = "BOTH";


//##############################################################
//#FUNCTION:   doFormError                                     #
//#RETURNS:                                                    #
//#PARAMETERS: A error message string.                         #
//#PURPOSE:    Generates an HTML page indicating a form        #
//#            submission error occurred.                      #
//##############################################################
function doFormError($errString) {

    include($header);

    echo "<FONT SIZE=+2>The form you submitted was not complete.<BR><BR></FONT>";
    echo "$errString<BR><BR>\n";
    echo "<INPUT TYPE=BUTTON ONCLICK='history.back()' VALUE='  Return to the checkout page '><HR>";

    include($footer);

    exit;
}

//##############################################################
//#FUNCTION:   doError                                         #
//#RETURNS:                                                    #
//#PARAMETERS: A error message string.                         #
//#PURPOSE:    Generates an HTML page indicating an error      #
//#            occurred.                                       #
//##############################################################
function doError($errString) {

    include($header);

    echo "$errString<BR><BR>\n";

    include($footer);

    exit;
}



//##############################################################
//##############################################################
//###  MAIN                                                  ###
//##############################################################
//##############################################################

if (($b_first == "") || ($b_last == "") || ($b_addr == "") || ($b_city == "") || ($b_state == "") || ($b_zip == "") || ($b_phone == "") || ($b_email == "")) {
   doFormError("I'm sorry, but it appears that you forgot to fill in a required field.  Please go <A HREF='Javascript:history.go(-1);'>back</A> and correct the error.");
   exit;
}

//# checks for valid email address
if( !(ereg("^(.+)@(.+)\\.(.+)$",$b_email)) ) {
    doFormError("You submitted an invalid email address.  Please go <A HREF='Javascript:history.go(-1);'>back</A> and correct the error.");
    exit;
}

$today = date ("l, F jS Y");
$strMessageBody = "";
$strMessageBody .= "A new order has been received.  A summary of this order appears below.\n";
$strMessageBody .= "\n";
$strMessageBody .= "Order Date: $today \n";
$strMessageBody .= " \n";
$strMessageBody .= "Bill To: \n";
$strMessageBody .= "-------- \n";
$strMessageBody .= "   $b_first $b_last \n";
$strMessageBody .= "   $b_addr \n";
$strMessageBody .= "   $b_addr2 \n";
$strMessageBody .= "   $b_city, $b_state  $b_zip \n";
$strMessageBody .= "   $b_phone \n";
$strMessageBody .= "   $b_fax \n";
$strMessageBody .= "   $b_email \n";
$strMessageBody .= " \n";
$strMessageBody .= " \n";
$strMessageBody .= "Ship To: \n";
$strMessageBody .= "-------- \n";
$strMessageBody .= "   $s_first $s_last \n";
$strMessageBody .= "   $s_addr \n";
$strMessageBody .= "   $s_addr2 \n";
$strMessageBody .= "   $s_city, $s_state  $s_zip \n";
$strMessageBody .= "   $s_phone \n";
$strMessageBody .= " \n";
$strMessageBody .= " \n";
$strMessageBody .= "Qty  Price(\$)   Product ID  - Product Name\n";
$strMessageBody .= "===================================================================== \n";
$strMessageBody .= "$QUANTITY_1    \$$PRICE_1    $ID_1 - $NAME_1   $ADDTLINFO_1  \n";
if( $NAME_2 ) {$strMessageBody .= "$QUANTITY_2    \$$PRICE_2    $ID_2 - $NAME_2   $ADDTLINFO_2  \n";}
if( $NAME_3 ) {$strMessageBody .= "$QUANTITY_3    \$$PRICE_3    $ID_3 - $NAME_3   $ADDTLINFO_3  \n";}
if( $NAME_4 ) {$strMessageBody .= "$QUANTITY_4    \$$PRICE_4    $ID_4 - $NAME_4   $ADDTLINFO_4  \n";}
if( $NAME_5 ) {$strMessageBody .= "$QUANTITY_5    \$$PRICE_5    $ID_5 - $NAME_5   $ADDTLINFO_5  \n";}
if( $NAME_6 ) {$strMessageBody .= "$QUANTITY_6    \$$PRICE_6    $ID_6 - $NAME_6   $ADDTLINFO_6  \n";}
if( $NAME_7 ) {$strMessageBody .= "$QUANTITY_7    \$$PRICE_7    $ID_7 - $NAME_7   $ADDTLINFO_7  \n";}
if( $NAME_8 ) {$strMessageBody .= "$QUANTITY_8    \$$PRICE_8    $ID_8 - $NAME_8   $ADDTLINFO_8  \n";}
if( $NAME_9 ) {$strMessageBody .= "$QUANTITY_9    \$$PRICE_9    $ID_9 - $NAME_9   $ADDTLINFO_9  \n";}
if( $NAME_10 ){$strMessageBody .= "$QUANTITY_10    \$$PRICE_10    $ID_10 - $NAME_10   $ADDTLINFO_10 \n";}
if( $NAME_11 ){$strMessageBody .= "$QUANTITY_11    \$$PRICE_11    $ID_11 - $NAME_11   $ADDTLINFO_11 \n";}
if( $NAME_12 ){$strMessageBody .= "$QUANTITY_12    \$$PRICE_12    $ID_12 - $NAME_12   $ADDTLINFO_12 \n";}
if( $NAME_13 ){$strMessageBody .= "$QUANTITY_13    \$$PRICE_13    $ID_13 - $NAME_13   $ADDTLINFO_13 \n";}
$strMessageBody .= "===================================================================== \n";
$strMessageBody .= "SUBTOTAL: $SUBTOTAL \n";
$strMessageBody .= "TOTAL: $TOTAL \n";
$strMessageBody .= "\n";
$strMessageBody .= "FREIGHT: $SHIPPING \n";
$strMessageBody .= "\n\n";
$strMessageBody .= "Comments: \n";
$strMessageBody .= "--------- \n";
$strMessageBody .= "$comment \n";
$strMessageBody .= " \n";


if( $mode == "BOTH" || $mode == "EMAIL") {
   //# Send email order to you...
   $mailheaders = "From: $b_email\r\n";
   $mailheaders .="X-Mailer: PHP Mail generated by:NOP Design Shopping Cart\r\n";
   $subject = "New Online Order";
   mail($youremail, $subject, $strMessageBody, $mailheaders);
}


if( $mode == "BOTH" || $mode == "FILE") {
   
   $csvcomments = $comment;
   if (!$CSVF = fopen($csvfilename,'a')) {
       doError("Unable to open CSV file for writing.  Your order has not been saved.");
       exit;
   }

   fputs($CSVF, $string);
   fputs($CSVF, "\"");
   fputs($CSVF, "$today");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$b_first");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$b_last");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$b_addr");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$b_addr2");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$b_city");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$b_state");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$b_zip");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$b_phone");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$b_fax");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$b_email");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$s_first");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$s_last");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$s_addr");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$s_addr2");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$s_city");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$s_state");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$s_zip");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$s_phone");
   fputs($CSVF, "\",\"");   
   fputs($CSVF, "$QUANTITY_1");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "\$$PRICE_1");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$ID_1");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$NAME_1");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$ADDTLINFO_1");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$QUANTITY_2");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "\$$PRICE_2");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$ID_2");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$NAME_2");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$ADDTLINFO_2");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$QUANTITY_3");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "\$$PRICE_3");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$ID_3");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$NAME_3");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$ADDTLINFO_3");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$QUANTITY_4");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "\$$PRICE_4");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$ID_4");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$NAME_4");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$ADDTLINFO_4");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$QUANTITY_5");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "\$$PRICE_5");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$ID_5");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$NAME_5");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$ADDTLINFO_5");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$QUANTITY_6");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "\$$PRICE_6");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$ID_6");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$NAME_6");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$ADDTLINFO_6");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$QUANTITY_7");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "\$$PRICE_7");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$ID_7");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$NAME_7");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$ADDTLINFO_7");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$QUANTITY_8");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "\$$PRICE_8");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$ID_8");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$NAME_8");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$ADDTLINFO_8");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$QUANTITY_9");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "\$$PRICE_9");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$ID_9");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$NAME_9");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$ADDTLINFO_9");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$QUANTITY_10");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "\$$PRICE_10");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$ID_10");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$NAME_10");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$ADDTLINFO_10");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$QUANTITY_11");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "\$$PRICE_11");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$ID_11");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$NAME_11");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$ADDTLINFO_11");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$QUANTITY_12");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "\$$PRICE_12");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$ID_12");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$NAME_12");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$ADDTLINFO_12");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$QUANTITY_13");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "\$$PRICE_13");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$ID_13");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$NAME_13");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$ADDTLINFO_13");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$SUBTOTAL");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$TOTAL");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$SHIPPING");
   fputs($CSVF, "\",\"");
   fputs($CSVF, "$comment");
   fputs($CSVF, "\"\n");
   
   fclose($CSVF);
}

//# Send email conformation to the customer.....
$mailheaders = "From: $youremail\r\n";
$mailheaders .="X-Mailer: PHP Mail generated by:NOP Design Shopping Cart\r\n";
$subject = "Order Confirmation";
mail($b_email, $subject, $strMessageBody, $mailheaders);

include($header);

echo "<h2>Thank you</h2>";
echo "Thank you for your order from our online store.  You will receive a confirmation email of your order ";
echo "momentarily.  Please contact us at $youremail if you have any questions or concerns.";
echo "<P>";
echo "<A HREF=\"$returnpage\" target=_top>Return Home</A>";
echo "<P>";

include($footer);

?>

