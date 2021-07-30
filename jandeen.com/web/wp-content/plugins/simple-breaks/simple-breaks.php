<?php
/**
 * Plugin name: Simple Breaks
 * Author: Hit Reach
 * Author URI: Http://www.hitreach.co.uk/
 * Plugin URI: http://www.hitreach.co.uk/wordpress-plugins/simple-breaks/
 * Version: 2.3.0
 * Description: Adds in [br] [clearleft] [clearright] [clearboth] [hr] [space] shortcodes to use in posts and pages.
 **/
 define("SB_URL", WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__)));
add_shortcode('br','sb_hr_br');add_shortcode('clearleft','sb_hr_cl');add_shortcode('clearboth','sb_hr_cb');add_shortcode('clearright','sb_hr_cr');add_shortcode('hr','sb_hr_hr');add_shortcode('space','sb_hr_bs');function sb_hr_br($args){extract( shortcode_atts(array('id' => "",'class' =>""), $args)); if($args['id'] != ""){$sbhrbr = "id='".$args['id']."'";}if($args['class'] != ""){	$sbhrbr .= "class='".$args['class']."'";}return "<br $sbhrbr />"; }
function sb_hr_cl($args){extract( shortcode_atts(array('id' => "",'class' =>"", 'span' => false), $args)); if($args['id'] != ""){$sbhrcl = "id='".$args['id']."'";}if($args['class'] != ""){	$sbhrcl .= "class='".$args['class']."'";}if($args['span'] == false){return "<div style='clear:left' $sbhrcl ></div>";} else{ return "<span style='clear:left' $sbhrcl ></span>";}}
function sb_hr_cr($args){extract( shortcode_atts(array('id' => "",'class' =>"", 'span' => false), $args)); if($args['id'] != ""){$sbhrcr = "id='".$args['id']."'";}if($args['class'] != ""){	$sbhrcr .= "class='".$args['class']."'";}if($args['span'] == false){return "<div style='clear:right' $sbhrcr ></div>";} else{ return "<span style='clear:right' $sbhrcr ></span>";}}
function sb_hr_cb($args){extract( shortcode_atts(array('id' => "",'class' =>"", 'span' => false), $args)); if($args['id'] != ""){$sbhrcb = "id='".$args['id']."'";}if($args['class'] != ""){	$sbhrcb .= "class='".$args['class']."'";}if($args['span'] == false){return "<div style='clear:both' $sbhrcr ></div>";} else{ return "<span style='clear:both' $sbhrcr ></span>";}}
function sb_hr_hr($args){extract( shortcode_atts(array('id' => "",'class' =>"",'size'=>1, 'color'=>"black"), $args)); if($args['id'] != ""){$sbhrhr = "id='".$args['id']."'";}if($args['class'] != ""){	$sbhrhr .= "class='".$args['class']."'";}return "<hr $sbhrhr size='".$args['size']."' style='background:".$args['color']."'/>";}
function sb_hr_bs($args){extract( shortcode_atts(array('id' => "",'class' =>"",'size'=>5), $args)); if($args['id'] != ""){$sbhrbs = "id='".$args['id']."'";}if($args['class'] != ""){$sbhrbs .= "class='".$args['class']."'";}$size = $args['size']."px"; return "<div style='height:$size; padding:0; margin:0; ' $sbhrbs ></div>";}
/** TINY MCE **/

register_activation_hook(__FILE__,"sb_hr_register");
function sb_hr_register(){
	$values= array("hr"=> 1, "lb"=>1, "sp"=>1,"cl"=>1,"cr"=>1,"cb"=>1);
	if(get_option("SB_HR_OPTIONS")){
		$current = get_option("SB_HR_OPTIONS");
		if(is_serialized($current)){$current = unserialize($current);}
		$values = array_merge($values,$current);
		update_option("SB_HR_OPTIONS",$values);
	}
	else{
		add_option("SB_HR_OPTIONS",$values);
	}
}

function add_hr_button() {
   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
     return;
   if ( get_user_option('rich_editing') == 'true') {
     add_filter('mce_external_plugins', 'add_hr_tinymce_plugin');
     add_filter('mce_buttons', 'register_hr_button');
   }
}
define( "SB_PLUGIN_DIR", "simple-breaks" );
define( "SB_PLUGIN_URL", get_bloginfo('url')."/wp-content/plugins/" . SB_PLUGIN_DIR );

function register_hr_button($buttons) {
   $current = get_option("SB_HR_OPTIONS");
   if(is_serialized($current)){$current = unserialize($current);}
   array_push($buttons, "|");
   if($current['hr'] == 1){
		array_push($buttons,  "horizontalRule");
   }
   if($current['lb'] == 1){
		array_push($buttons,  "lineBreak");
   }
   if($current['sp'] == 1){
        array_push($buttons,  "space");
   }
   if($current['cl'] == 1){
	   array_push($buttons,  "clearLeft");
   }
   if($current['cr'] == 1){
	   array_push($buttons,  "clearRight");
   }
   if($current['cb'] == 1){
	   array_push($buttons,  "clearBoth");
   }
   return $buttons;
}
function add_hr_tinymce_plugin($plugin_array) {
   $current = get_option("SB_HR_OPTIONS");
   if(is_serialized($current)){$current = unserialize($current);}
   if($current['hr'] == 1){
	   $plugin_array['horizontalRule'] = SB_PLUGIN_URL . '/hr.js';
   }
   if($current['lb'] == 1){
	   $plugin_array['lineBreak'] = SB_PLUGIN_URL . '/hr.js';
   }
   if($current['sp'] == 1){
	   $plugin_array['space'] = SB_PLUGIN_URL . '/hr.js';
   }
    if($current['cl'] == 1){
	   $plugin_array['clearLeft'] = SB_PLUGIN_URL . '/hr.js';
	}
	 if($current['cr'] == 1){
	   $plugin_array['clearRight'] = SB_PLUGIN_URL . '/hr.js';}
 if($current['cb'] == 1){	   $plugin_array['clearBoth'] = SB_PLUGIN_URL . '/hr.js';}
   return $plugin_array;
}

add_action('init', 'add_hr_button');


function my_refresh_mce($ver) {
  $ver += 7;
  return $ver;
}
add_filter( 'tiny_mce_version', 'my_refresh_mce');

add_action('admin_menu', 'sb_hr_menu');
function sb_hr_menu(){
	add_submenu_page('options-general.php','Simple Breaks', 'Simple Breaks', 'edit_posts', 'simple-breaks', 'simple_breaks_options');
}

function simple_breaks_options(){
   $current = get_option("SB_HR_OPTIONS");
   if(is_serialized($current)){$current = unserialize($current);}
?>
	<div class='wrap'>
        <div style='float:left; width:450px;'>
	    <h1>Simple Breaks</h1>	
		<p>The following options allow you to toggle the tinyMCE editor buttons on and off</p>
		<form method="post" action="options.php"> 
		<?php wp_nonce_field('update-options'); ?>
		<table class="form-table">
		<tr valign="top">
			<th scope="row"><label for="SB_HR_OPTIONS['hr']">Horizontal Rule: </label></th>
			<td><input type="checkbox" name="SB_HR_OPTIONS[hr]" id="SB_HR_OPTIONS['hr']" value='1' <?php if($current['hr']==1){echo "checked='checked'";}?> /></td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="SB_HR_OPTIONS['lb']">Line Break: </label></th>
			<td><input type="checkbox" name="SB_HR_OPTIONS[lb]" id="SB_HR_OPTIONS['lb']" value='1' <?php if($current['lb']==1){echo "checked='checked'";}?> /></td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="SB_HR_OPTIONS['sp']">Space: </label></th>
			<td><input type="checkbox" name="SB_HR_OPTIONS[sp]" id="SB_HR_OPTIONS['sp']" value='1' <?php if($current['sp']==1){echo "checked='checked'";}?> /></td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="SB_HR_OPTIONS['cl']">Clear Left: </label></th>
			<td><input type="checkbox" name="SB_HR_OPTIONS[cl]" id="SB_HR_OPTIONS['cl']" value='1' <?php if($current['cl']==1){echo "checked='checked'";}?> /></td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="SB_HR_OPTIONS['cr']">Clear Right: </label></th>
			<td><input type="checkbox" name="SB_HR_OPTIONS[cr]" id="SB_HR_OPTIONS['cr']" value='1' <?php if($current['cr']==1){echo "checked='checked'";}?> /></td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="SB_HR_OPTIONS['cb']">Clear Both: </label></th>
			<td><input type="checkbox" name="SB_HR_OPTIONS[cb]" id="SB_HR_OPTIONS['cb']" value='1' <?php if($current['cb']==1){echo "checked='checked'";}?> /></td>
		</tr>
	</table>
	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="page_options" value="SB_HR_OPTIONS" />
	<p class="submit">
	<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
	</p>
	</form>
	</div>
    <div style='float:left; display:inline; width:450px; margin-left:25px; margin-bottom:10px; margin-right:15px; padding:10px; -webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;-webkit-box-shadow: #666 2px 2px 5px;-moz-box-shadow: #666 2px 2px 5px;box-shadow: #666 2px 2px 5px;background: #ffff00;background: -webkit-gradient(linear, 0 0, 0 bottom, from(#ffff00), to(#ffffcc));background: -moz-linear-gradient(#ffff00, #ffffcc);background: linear-gradient(#ffff00, #ffffcc);'>
            <span style='font-size:1em; color:#999; display:block; line-height:1.2em;'><strong>Developed by <a href='http://www.hitreach.co.uk' target="_blank" style='text-decoration:none;'>Hit Reach</a></strong><a href='http://www.hitreach.co.uk' target="_blank" style='text-decoration:none;'></a></span>
            <span style='font-size:1em; color:#999; display:block; line-height:1.2em;'><strong>Check out our other <a href='http://www.hitreach.co.uk/services/wordpress-plugins/' target="_blank" style='text-decoration:none;'>Wordpress Plugins</a></strong><a href='http://www.hitreach.co.uk/services/wordpress-plugins/' target="_blank" style='text-decoration:none;'></a></span>
            <span style='font-size:1em; color:#999; display:block; line-height:1.2em;'><strong>Version: 2.3.0 <a href='http://www.hitreach.co.uk/wordpress-plugins/simple-breaks/' target="_blank" style='text-decoration:none;'>Support, Comments &amp; Questions</a></strong></span>
            <hr/>
            <h2>Please help! We need your support...</h2>
            <p>If this plugin has helped you, your clients or customers then please take a moment to 'say thanks'. </p>
            <p>By spreading the word you help increase awareness of us and our plugins which makes it easier to justify the time we spend on this project.</p>
            <p>Please <strong>help us keep this plugin free</strong> to use and allow us to provide on-going updates and support.</p>
            <p>Here are some quick, easy and free things you can do which all help and we would really appreciate.</p>
            <ol>
                <li>
                    <strong>Promote this plugin on Twitter</strong><br/>
                    <a href="http://twitter.com/home?status=I'm using the Simple Breaks WordPress plugin by @hitreach and it rocks! You can download it here: http://bit.ly/qvkq0y" target="_blank">
                    <img src='<?php echo SB_URL;?>/twitter.gif' border="0" width='55' height='20'/>
                    </a><br/><br/>
            </li>
                <li>
                    <strong>Link to us</strong><br/>
                    By linking to <a href='http://www.hitreach.co.uk' target="_blank">www.hitreach.co.uk</a> from your site or blog it means you can help others find the plugin on our site and also let Google know we are trust and link worthy which helps our profile.<br/>
              </li>
              <li>
                   <strong>Like us on Facebook</strong><br/>
                    Just visit <a href='http://www.facebook.com/webdesigndundee' target="_blank">www.facebook.com/webdesigndundee</a> and hit the 'Like!' button!<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like href="http://www.facebook.com/webdesigndundee" send="true" width="450" show_faces="false" action="like" font="verdana"></fb:like><br/><br/>
              </li>
                <li>
                    <strong>Share this plugin on Facebook</strong><br/>
                    <div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like href="http://www.hitreach.co.uk/wordpress-plugins/simple-breaks/" send="true" width="450" show_faces="false" action="recommend" font="verdana"></fb:like>
                    Share a link to the plugin page with your friends on Facebook<br/><br/>
                </li>
                <li>
                    <strong>Make A Donation</strong><br/>
                    Ok this one isn't really free but hopefully it's still a lot cheaper than if you'd had to buy the plugin or pay for it to be made for your project. Any amount is appreciated
              <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
                        <input type="hidden" name="cmd" value="_donations">
                        <input type="hidden" name="business" value="admin@hitreach.co.uk">
                        <input type="hidden" name="lc" value="GB">
                        <input type="hidden" name="item_name" value="Hit Reach">
                        <input type="hidden" name="item_number" value="simpleBreaks-Plugin">
                        <input type="hidden" name="no_note" value="0">
                        <input type="hidden" name="currency_code" value="GBP">
                        <input type="hidden" name="bn" value="PP-DonationsBF:btn_donate_LG.gif:NonHostedGuest">
                        <input type="image" src="https://www.paypalobjects.com/en_GB/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
                        <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                    </form>
                </li>
            </ol>       
        </div>
    
    </div>
	<?php
}
?>