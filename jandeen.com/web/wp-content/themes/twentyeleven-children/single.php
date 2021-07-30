<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

		<div id="primary" class="container_16">
			<div id="content" role="main" class="prefix_1">
				<?php get_sidebar(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<div class="grid_10 special_grid">
					<?php get_template_part( 'content', 'single' ); ?>

					<?php comments_template( '', true ); ?>
					
					
					<nav>
						<div id="nav-single">
							<?php 
							 $prev_link = get_adjacent_post(false, '');
							 if($prev_link){
							?> 	
							<span class="nav-previous"><?php previous_post_link( '%link', __( ' Previous', 'twentyeleven' ) ); ?></span>
							<?php } ?>
							<span class="nav-next"><?php next_post_link( '%link', __( 'Next', 'twentyeleven' ) ); ?></span>
						</div>
					</nav><!-- #nav-single -->
				 </div>
				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>