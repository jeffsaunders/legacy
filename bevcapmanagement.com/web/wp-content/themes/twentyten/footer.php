<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>
	</div><!-- #main -->

	<div id="footer" role="contentinfo">
		<div id="colophon">

<?php
	/* A sidebar in the footer? Yep. You can can customize
	 * your footer with four columns of widgets.
	 */
	get_sidebar( 'footer' );
?>

			<div id="site-info">
				<a id="facebook" href="http://www.facebook.com/pages/BevCap-Management-Insurance-Services/135985426436673" target="blank"></a>
                                <a id="twitter" href="http://twitter.com/@BevCapManagemnt" target="blank"></a>
			</div><!-- #site-info -->

			<div id="site-generator">
                          <p>  © Copyright 2011 BevCap Management LLC. All rights reserved</p>
                <a href="http://bevcapmanagement.com/new/?page_id=84" title="Privacy Policy">Privacy Policy</a> |
                <a href="http://bevcapmanagement.com/new/?page_id=39" title="Sitemap">Sitemap</a>
                        </div><!-- #site-generator -->

		</div><!-- #colophon -->
	</div><!-- #footer -->

</div><!-- #wrapper -->

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>