<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>
     <div class="clear"></div>
	</div><!-- #main -->
   </div><!-- #page -->
   <div id="footer" class="container_16">
   	   <div class="clear"></div>
	   <footer id="colophon" role="contentinfo">
			<div class="grid_4 prefix_1"><p>All images copyright Jan Deen</p></div>
			<?php 
			wp_reset_query();
			if(!is_front_page() && $post->post_name != 'portfolios' && $post->post_name != 'contact' ){ ?>
		    	<div class="grid_1 prefix_10"><a href="#header" id="toTop">TOP</a></div>
			<?php } ?>
	    </footer><!-- #colophon -->
   </div>

<?php wp_footer(); ?>
<script src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/jquery.cycle.all.js" type="text/javascript"></script>
<script src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/general.js" type="text/javascript"></script>

</body>
</html>