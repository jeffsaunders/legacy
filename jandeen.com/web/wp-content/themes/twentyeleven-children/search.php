<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

		<div id="primary" class="container_16">
		  <div id="content" role="main" class=" prefix_1">
			<?php get_sidebar(); ?>
			<div class="grid_10 special_grid">
			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><b><?php printf( __( 'Search Results for: %s', 'twentyeleven' ), '<span>' . get_search_query() . '</span>' ); ?></b></h1>
				</header>


				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>

				<?php endwhile; ?>
		
				<div id="pagination">
					<?php emm_paginate(); ?>
				</div>
			</div>
			<?php else : ?>
				<div class="grid_10 special_grid">
				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentyeleven' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentyeleven' ); ?></p>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->
				</div>
			<?php endif; ?>

			</div><!-- #content -->
			</div>
		</div><!-- #primary -->

<?php get_footer(); ?>