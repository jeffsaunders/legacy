<?php
/**
 * Page Template
 *
 * Displays page-not-found message and site-map (if configured)
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_page_not_found_default.php 3230 2006-03-20 23:21:29Z drbyte $
 */
?>
<div class="centerColumn" id="pageNotFound">
<h1 id="pageNotFoundHeading" class="bigBlue"><?php echo HEADING_TITLE; ?></h1>

<?php if (DEFINE_PAGE_NOT_FOUND_STATUS == '1') { ?>
<div id="pageNotFoundMainContent" class="content">
<?php
/**
 * require the html_define for the page_not_found page
 */
  require($define_page); ?>
</div>
<?php } ?>

    <div class="bodyBlack" style="text-align:left;"><?php echo $zen_SiteMapTree->buildTree(); ?>
     <ul>
<?php if (SHOW_ACCOUNT_LINKS_ON_SITE_MAP=='Yes') { ?>
       <li><?php echo '<a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '" class="bodyBlack">' . PAGE_ACCOUNT . '</a>'; ?>
       <ul>
         <li><?php echo '<a href="' . zen_href_link(FILENAME_ACCOUNT_EDIT, '', 'SSL') . '" class="bodyBlack">' . PAGE_ACCOUNT_EDIT . '</a>'; ?></li>
         <li><?php echo '<a href="' . zen_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL') . '" class="bodyBlack">' . PAGE_ADDRESS_BOOK . '</a>'; ?></li>
         <li><?php echo '<a href="' . zen_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL') . '" class="bodyBlack">' . PAGE_ACCOUNT_HISTORY . '</a>'; ?></li>
         <li><?php echo '<a href="' . zen_href_link(FILENAME_ACCOUNT_NEWSLETTERS, '', 'SSL') . '" class="bodyBlack">' . PAGE_ACCOUNT_NOTIFICATIONS . '</a>'; ?></li>
       </ul></li>
         <li><?php echo '<a href="' . zen_href_link(FILENAME_SHOPPING_CART) . '" class="bodyBlack">' . PAGE_SHOPPING_CART . '</a>'; ?></li>
         <li><?php echo '<a href="' . zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL') . '" class="bodyBlack">' . PAGE_CHECKOUT_SHIPPING . '</a>'; ?></li>
<?php } //endif ?>
         <li><?php echo '<a href="' . zen_href_link(FILENAME_ADVANCED_SEARCH) . '" class="bodyBlack">' . PAGE_ADVANCED_SEARCH . '</a>'; ?></li>
         <!--- <li><?php echo '<a href="' . zen_href_link(FILENAME_PRODUCTS_NEW) . '" class="bodyBlack">' . PAGE_PRODUCTS_NEW . '</a>'; ?></li> --->
         <li><?php echo '<a href="' . zen_href_link(FILENAME_SPECIALS) . '" class="bodyBlack">' . PAGE_SPECIALS . '</a>'; ?></li>
         <li><?php echo '<a href="' . zen_href_link(FILENAME_REVIEWS) . '" class="bodyBlack">' . PAGE_REVIEWS . '</a>'; ?></li>
         <li><?php echo BOX_HEADING_INFORMATION; ?>
         <ul>
           <li><?php echo '<a href="' . zen_href_link(FILENAME_SHIPPING) . '" class="bodyBlack">' . BOX_INFORMATION_SHIPPING . '</a>'; ?></li>
           <li><?php echo '<a href="' . zen_href_link(FILENAME_PRIVACY) . '" class="bodyBlack">' . BOX_INFORMATION_PRIVACY . '</a>'; ?></li>
           <li><?php echo '<a href="' . zen_href_link(FILENAME_CONDITIONS) . '" class="bodyBlack">' . BOX_INFORMATION_CONDITIONS . '</a>'; ?></li>
<!---            <li><?php echo '<a href="' . zen_href_link(FILENAME_CONTACT_US) . '" class="bodyBlack">' . BOX_INFORMATION_CONTACT . '</a>'; ?></li> --->
         </ul></li>
     </ul>
</div>

    <div class="buttonRow back"><?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></div>
</div>
