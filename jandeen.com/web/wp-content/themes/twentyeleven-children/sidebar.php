<?php
/**
 * The Sidebar containing the main widget area.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

?>

 <div class="grid_4" id="sidebar">
			 	<?php get_search_form(); ?>
			 	
			 	<h3>Archive</h3>
			 	<?php dynamic_sidebar( 'sidebar-1' ) ?>
			 	<h3>Links</h3>
			 	<?php wp_list_bookmarks('title_li=&category_before=&category_after=&categorize='); ?>
 </div>
