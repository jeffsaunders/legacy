<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );

	?></title>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_directory' ); ?>/grid960.css" />
<!--[if IE 6]>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_directory' ); ?>/ie6.css" />
<![endif]-->

<!--[if IE 7]>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_directory' ); ?>/ie7.css" />
<![endif]-->
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>

<body <?php body_class($post->post_name); ?>>
<div id="page" class="hfeed"> 
	<div id="header">
	 <div id="hh">
		 <div class="container_16">
		  <header id="branding" role="banner">				
					<?php if( (is_home() || is_single() || is_archive() || is_search()) && $post->post_parent == 0 && $post->post_type == 'post') {?>						
						<hgroup><h1 id="site-title" class="grid_4 prefix_1"><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><span>JAN DEEN</span> LUMINOUS FLUX</a></h1></hgroup>
						<nav id="access" role="navigation">
								<div class="grid_10"> <?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => '' ) ); ?></div>
						</nav><!-- #access -->				
					<?php }else{ ?>
						<hgroup><h1 id="site-title" class="grid_4 prefix_1"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><span>JAN DEEN</span> PHOTOGRAPHY</a></h1></hgroup>
						<nav id="access" role="navigation">						
						  <div class="grid_10 prefix_1"> <?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => '' ) ); ?></div>
						</nav>
					<?php	} ?>

		  </header><!-- #branding -->
		 </div>
	  </div>	 
	</div>
	<div id="main" class="clearfix">