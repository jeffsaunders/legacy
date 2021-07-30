<?php


/*
function get_ID_by_slug($page_slug) {
    $page = get_page_by_path(mysql_real_escape_string($page_slug));
    if ($page) {
        return $page->ID;
    } else {
        return null;
    }
}


if(is_admin()){
 add_action('init', 'admin_init');
}
function admin_init() {
  $ss_url = get_bloginfo('stylesheet_directory');
  wp_enqueue_script('mysite-scripts',"$ss_url/admin.js",array('jquery','jquery-ui-sortable'), '', 1);
}
*/

function wp_list_post_types( $args ) {
    $defaults = array(
        'numberposts'  => -1,
        'offset'       => 0,
        'order'        => 'asc',
        'orderby'      => 'menu_order, post_title',
        'post_type'    => 'page',
        'depth'        => 0,
        'show_date'    => '',
        'date_format'  => get_option('date_format'),
        'child_of'     => 0,
        'exclude'      => '',
            'include'      => '',
        'title_li'     => __('Pages'),
        'echo'         => 1,
        'link_before'  => '',
        'link_after'   => '',
        'exclude_tree' => '' );

    $r = wp_parse_args( $args, $defaults );
    extract( $r, EXTR_SKIP );

    $output = '';
    $current_page = 0;

    // sanitize, mostly to keep spaces out
    $r['exclude'] = preg_replace('/[^0-9,]/', '', $r['exclude']);

    // Allow plugins to filter an array of excluded pages (but don't put a nullstring into the array)
    $exclude_array = ( $r['exclude'] ) ? explode(',', $r['exclude']) : array();
    $r['exclude'] = implode( ',', apply_filters('wp_list_post_types_excludes', $exclude_array) );

    // Query pages.
    $r['hierarchical'] = 0;
    $pages = get_posts($r);

    if ( !empty($pages) ) {
        if ( $r['title_li'] )
            $output .= '<li class="pagenav">' . $r['title_li'] . '<ul>';

        global $wp_query;
        if ( ($r['post_type'] == get_query_var('post_type')) || is_attachment() )
            $current_page = $wp_query->get_queried_object_id();
        $output .= walk_page_tree($pages, $r['depth'], $current_page, $r);

        if ( $r['title_li'] )
            $output .= '</ul></li>';
    }

    $output = apply_filters('wp_list_pages', $output, $r);

    if ( $r['echo'] )
        echo $output;
    else
        return $output;
}

add_filter( 'nav_menu_css_class', 'additional_active_item_classes', 10, 2 );

function additional_active_item_classes($classes = array(), $menu_item = false){
	
	global $post;
	if($post->post_type == 'portfolios')
		$classes[] = 'current-menu-item';
	

	return $classes;
}

//short title
function truncate($str, $width, $cutword = false) {
    if (strlen($str) <= $width) return $str;
    list($out) = explode("\n", wordwrap($str, $width, "\n", $cutword), 2);
    return $out.'...';
}




//default imge link in backend
update_option('image_default_link_type','file');

add_action("template_redirect",'template_redirect');
function template_redirect()
{
	global $post;
	//$postID = get_ID_by_slug($wp->request);
	//$parent_ID = get_post_ancestors($postID);
	//$parent_name = $wp->query_vars['pagename'];
	
	//check parent categories ids
	//actual + proiecte
	if ($post->post_type == 'portfolios'){
	   include(TEMPLATEPATH . "-children/page.php");
	   die();
	}	
	
}

add_image_size( 'portfolio', 540, 355, $crop = FALSE); 
add_image_size( 'thumbnail-crop', 182, 400, TRUE);


//last menu item
function add_first_and_last($output) {
  $output = preg_replace('/class="menu-item/', 'class="first-menu-item menu-item', $output, 1);
  $output = substr_replace($output, 'class="last-menu-item menu-item', strripos($output, 'class="menu-item'), strlen('class="menu-item'));
  return $output;
}
add_filter('wp_nav_menu', 'add_first_and_last');

/*
/*
add_filter('post_class', 'my_post_class');
function my_post_class($classes){
  global $wp_query;
  if(($wp_query->current_post+1) == $wp_query->post_count) $classes[] = 'last';
  return $classes;
}



 add_action('admin_print_scripts-settings_page_plugin-admin-page', 'add_my_scripts');
   function add_my_scripts()
   {
       //We can include as many Javascript files as we want here.
       wp_enqueue_script('pluginscript', plugins_url('/js/test.js', __FILE__), array('jquery'));
   }
 






//get post categories as links
function categories_list($id, $child_of = null){
	$post_categories = wp_get_post_categories($id, ('orderby=name&oder=ASC&depth=1'));
	$cats = array();
	$i = 0;
	$categ_count = count($post_categories); 
	$html = '';	
	foreach($post_categories as $c){
		$cat = get_category( $c ); 		
		$i ++;	
			
		//skip other categories
		if($child_of != null && $child_of !=  $cat->parent)  continue;
		
		$html .= '<li>' . '<a href="'. get_category_link(($cat->cat_ID)) .'" title="'. $cat->name .'">'. $cat->name .'</a></li>';
}		

	echo $html;
}





//default imge link in backend
update_option('image_default_link_type','file');


 //page id
function page_id() {
wp_reset_query();
global $wp_query;
$thePostID = $wp_query->post->ID;
return $thePostID; 
}


/**
 * Retrieve or display pagination code.
 *
 * The defaults for overwriting are:
 * 'page' - Default is null (int). The current page. This function will
 *      automatically determine the value.
 * 'pages' - Default is null (int). The total number of pages. This function will
 *      automatically determine the value.
 * 'range' - Default is 3 (int). The number of page links to show before and after
 *      the current page.
 * 'gap' - Default is 3 (int). The minimum number of pages before a gap is 
 *      replaced with ellipses (...).
 * 'anchor' - Default is 1 (int). The number of links to always show at begining
 *      and end of pagination
 * 'before' - Default is '<div class="emm-paginate">' (string). The html or text 
 *      to add before the pagination links.
 * 'after' - Default is '</div>' (string). The html or text to add after the
 *      pagination links.
 * 'title' - Default is '__('Pages:')' (string). The text to display before the
 *      pagination links.
 * 'next_page' - Default is '__('&raquo;')' (string). The text to use for the 
 *      next page link.
 * 'previous_page' - Default is '__('&laquo')' (string). The text to use for the 
 *      previous page link.
 * 'echo' - Default is 1 (int). To return the code instead of echo'ing, set this
 *      to 0 (zero).
 *
 * @author Eric Martin <eric@ericmmartin.com>
 * @copyright Copyright (c) 2009, Eric Martin
 * @version 1.0
 *
 * @param array|string $args Optional. Override default arguments.
 * @return string HTML content, if not displaying.
 */
function emm_paginate($args = null) {
	$defaults = array(
		'page' => null, 'pages' => null, 
		'range' => 3, 'gap' => 3, 'anchor' => 1,
		'before' => '<div class="emm-paginate">', 'after' => '</div>',
		'title' => __(''),
		'nextpage' => __('&raquo;'), 'previouspage' => __('&laquo'),
		'echo' => 1
	);

	$r = wp_parse_args($args, $defaults);
	extract($r, EXTR_SKIP);

	if (!$page && !$pages) {
		global $wp_query;

		$page = get_query_var('paged');
		$page = !empty($page) ? intval($page) : 1;

		$posts_per_page = intval(get_query_var('posts_per_page'));
		$pages = intval(ceil($wp_query->found_posts / $posts_per_page));
	}
	
	$output = "";
	if ($pages > 1) {	
		$output .= "$before<span class='emm-title'>$title</span>";
		$ellipsis = "<span class='emm-gap'>...</span>";

		if ($page > 1 && !empty($previouspage)) {
			$output .= "<a href='" . get_pagenum_link($page - 1) . "' class='emm-prev'>$previouspage</a>";
		}
		
		$min_links = $range * 2 + 1;
		$block_min = min($page - $range, $pages - $min_links);
		$block_high = max($page + $range, $min_links);
		$left_gap = (($block_min - $anchor - $gap) > 0) ? true : false;
		$right_gap = (($block_high + $anchor + $gap) < $pages) ? true : false;

		if ($left_gap && !$right_gap) {
			$output .= sprintf('%s%s%s', 
				emm_paginate_loop(1, $anchor), 
				$ellipsis, 
				emm_paginate_loop($block_min, $pages, $page)
			);
		}
		else if ($left_gap && $right_gap) {
			$output .= sprintf('%s%s%s%s%s', 
				emm_paginate_loop(1, $anchor), 
				$ellipsis, 
				emm_paginate_loop($block_min, $block_high, $page), 
				$ellipsis, 
				emm_paginate_loop(($pages - $anchor + 1), $pages)
			);
		}
		else if ($right_gap && !$left_gap) {
			$output .= sprintf('%s%s%s', 
				emm_paginate_loop(1, $block_high, $page),
				$ellipsis,
				emm_paginate_loop(($pages - $anchor + 1), $pages)
			);
		}
		else {
			$output .= emm_paginate_loop(1, $pages, $page);
		}

		if ($page < $pages && !empty($nextpage)) {
			$output .= "<a href='" . get_pagenum_link($page + 1) . "' class='emm-next'>$nextpage</a>";
		}

		$output .= $after;
	}

	if ($echo) {
		echo $output;
	}

	return $output;
}

/**
 * Helper function for pagination which builds the page links.
 *
 * @access private
 *
 * @author Eric Martin <eric@ericmmartin.com>
 * @copyright Copyright (c) 2009, Eric Martin
 * @version 1.0
 *
 * @param int $start The first link page.
 * @param int $max The last link page.
 * @return int $page Optional, default is 0. The current page.
 */
function emm_paginate_loop($start, $max, $page = 0) {
	$output = "";
	for ($i = $start; $i <= $max; $i++) {
		$output .= ($page === intval($i)) 
			? "<span class='emm-page emm-current'>$i</span>" 
			: "<a href='" . get_pagenum_link($i) . "' class='emm-page'>$i</a>";
	}
	return $output;
}


//remove comments website
add_filter('comment_form_default_fields', 'url_filtered');
function url_filtered($fields)
{
  if(isset($fields['url']))
   unset($fields['url']);
  return $fields;
}




//search empty request



//editor style
add_editor_style('style.css');


add_action( 'admin_head_media_upload_gallery_form', 'mfields_remove_gallery_setting_div' );
if( !function_exists( 'mfields_remove_gallery_setting_div' ) ) {
    function mfields_remove_gallery_setting_div() {
        print '
            <style type="text/css">
                #gallery-settings *{
                display:none;
                }
            </style>';
    }
}
/*
function sanitize_output($buffer)
{
    $search = array(
        '/\>[^\S ]+/s', //strip whitespaces after tags, except space
        '/[^\S ]+\</s', //strip whitespaces before tags, except space
        '/(\s)+/s'  // shorten multiple whitespace sequences
        );
    $replace = array(
        '>',
        '<',
        '\\1'
        );
  $buffer = preg_replace($search, $replace, $buffer);
    return $buffer;
}

ob_start("sanitize_output");
*/
remove_action('wp_head', 'wp_generator');

// comments
add_filter('comment_form_after_fields', 'my_comment_form_after_fields', 1);
function my_comment_form_after_fields($output){
 return 'dd';//$output;
}

/**
* disable feed
*/
remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link' ); // index link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version