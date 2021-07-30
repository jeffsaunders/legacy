<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header();  ?>

		<div id="primary" class="container_16">
			<div id="content" role="main">
				<?php
				  if(is_front_page()){ //start front page
				 ?>
				 <div id="homeSlide" class="grid_15 prefix_1">
				 	<?php 	
					  	$args = array( 'post_type' => 'attachment', 'numberposts' => -1, 'orderby' => 'menu_order ID', 'post_status' => null, 'post_parent' => $post->ID ); 
						$attachments = get_posts($args);
						if ($attachments) {
							$i = 0; 
							$images = array();
							foreach($attachments as $attachment){
								$i++;
								if($i > 1) 
								//array_push($images, urlencode($attachment->guid));
								array_push($images, array('alt' => $attachment->post_title, 'image' => urlencode($attachment->guid)));								
							}
							echo wp_get_attachment_image($attachments[0]->ID, '839x472');
							$images = json_encode($images);
													
						}
					?>						
					</div>
					<div id="slide-nav" class="grid_2 prefix_1">
							<a id="prevSlide" href="#"></a>
							<a id="nextSlide" href="#"></a>
							<a id="pauseSlide" href="#"></a>
							<a id="playSlide"  href="#"></a>
					</div>	
					<div id="attachment-title" class="grid_13"><?php echo $attachment->post_title ?></div>
					
					<script type="text/javascript">					
							 jQuery(<?php echo $images ?>).each(function () {
							        jQuery("<img />").attr({"src" : unescape(this.image), "alt": this.alt}).appendTo("#homeSlide");
							  });							
					</script>				
				<?  //end front page
				
				//biography   
				}elseif($post->post_name == 'biography'){ 
				?>
					<?php if (has_post_thumbnail( $post->ID ) ): ?>
					<div class="grid_4 prefix_1 suffix_1">
					 <?php echo wp_get_attachment_image( get_post_thumbnail_id( $post->ID ), '210x500', FALSE ); ?>
					</div>
					<div class="grid_10 ">
					 <?php the_post(); ?>
					 <?php get_template_part( 'content', 'page' ); ?>
                    </div>
					</div>
				<?php endif; 
				//end biography
				
				//portfolios 
				}elseif($post->post_name == 'portfolios' || $post->post_type == 'portfolios'){
			
				?>
				       <ul id="vertical-menu" class="grid_4 prefix_1 suffix_1">
					      <?php wp_list_post_types("post_type=portfolios&title_li=&echo=1"); ?>
				        </ul>
						<div id="portfoliosSlide" class="grid_10 clearfix">
				<?php	
					  	$args = array( 'post_type' => 'attachment', 'numberposts' => -1, 'orderby' => 'menu_order ID', 'post_status' => null, 'post_parent' => $post->ID ); 
						$attachments = get_posts($args);
						if ($attachments) {
							$i = 0; 
							$images = array();
							foreach($attachments as $attachment){
								$i++;
								
								$imgInfo = wp_get_attachment_image_src($attachment->ID, 'portfolio', FALSE);
								$imgInfoFull = wp_get_attachment_image_src($attachment->ID, 'full', FALSE);
								
								//if($i > 1) 								
								array_push($images, array('alt' => $attachment->post_title, 
														  'width' =>$imgInfo[1], 
														  'height' => $imgInfo[2], 
														  'image' => urlencode($imgInfo[0]),
														  'fullImage' => urlencode($imgInfoFull[0])));								
							}
							//echo '<a href="'. $imgInfoFull[0] .'" >'. wp_get_attachment_image($attachments[0]->ID, 'portfolio', FALSE). '</a>';
							$images = json_encode($images);
													
						}
					?>						
						</div>
						<?php   if(count($attachments) > 1){ ?>
							<div id="slide-nav" class="grid_4 prefix_1 suffix_1 portfolios">
									<a id="pauseSlide" href="#"></a>										
									<a id="playSlide"  href="#"></a>								
									<a id="nextSlide"  href="#"></a>
									<a id="prevSlide"  href="#"></a>
							</div>	
							<div id="attachment-title" class="grid_10 <?php count($attachments) <= 1 ? print 'prefix_6' : ''?> "></div>																		

						<?php } //end slide nav ?>
						<script type="text/javascript">					
								 jQuery(<?php echo $images ?>).each(function () {
								        jQuery("<img />").attr({"src" : unescape(this.image), "alt": this.alt, "width": this.width, "height": this.height}).appendTo("#portfoliosSlide").wrap('<a href="'+ unescape(this.fullImage) +'"></a>');


								  });							
						</script>	
				<?php 
				//other pages
				}else{ 
				?>	<div class="grid_10 prefix_6">
						<?php the_post(); ?>	
						<?php get_template_part( 'content', 'page' ); ?>
					</div>
					<?php //comments_template( '', true ); ?>
				<? } ?>
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>