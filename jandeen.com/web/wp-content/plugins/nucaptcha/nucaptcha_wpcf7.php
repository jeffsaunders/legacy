<?php
/**
 * A Contact Form 7 module for [nucaptcha] shortcode
 *
 * Originially developed for and tested with Contact Form 7 (v 2.4.6)
 *
 * Author: Randy Lukashuk, NuCaptcha Inc.
 *
 * http://www.nucaptcha.com
**/

/* Shortcode handler */
wpcf7_add_shortcode( 'nucaptcha', 'wpcf7_nucaptcha_shortcode_handler', true );

function wpcf7_nucaptcha_shortcode_handler( $tag ) {
	if ( ! is_array( $tag ) )
		return '';

	$type = $tag['type'];
	$name = $tag['name'];
	$options = (array) $tag['options'];
	$values = (array) $tag['values'];

	if ( empty( $name ) )
		return '';
	
	$atts = '';
	$id_att = '';
	$class_att = '';
	$tabindex_att = '';

	// since NuCaptcha is always required, add wpcf7-validates-as-required
	$class_att .= ' wpcf7-nucaptcha wpcf7-validates-as-required';

	foreach ( $options as $option ) {
		if ( preg_match( '%^id:([-0-9a-zA-Z_]+)$%', $option, $matches ) ) {
			$id_att = $matches[1];

		} elseif ( preg_match( '%^class:([-0-9a-zA-Z_]+)$%', $option, $matches ) ) {
			$class_att .= ' ' . $matches[1];
		}
	}

	if ( $id_att )
		$atts .= ' id="' . trim( $id_att ) . '"';

	if ( $class_att )
		$atts .= ' class="' . trim( $class_att ) . '"';
	
	// If Not Functional, 
	if (!NuCaptchaData::is_functional()) return '';

	include_nucaptcha();
	
	// Render NuCaptcha
	$t = Leap::InitializeTransaction(null, nucaptcha_use_ssl(), null, Leap::PURPOSE_ACTION);
	$ec = Leap::GetErrorCode();

	// Add span.wpcf7-form-control-wrap.$name so the 'incorrect' UI shows up
	$html = '<span class="wpcf7-form-control-wrap '.$name.'">';
	$html .= '<div '.$atts.'>';
	$html .= nucaptcha_deslashit(NuCaptchaData::Get('custom_skin_html')) . ' ';
	if (LMEC_OK == $ec) {
		// Need to manually set display to visible because WPCF7 sets div to display:none by default
		$html .= '<div id="wp_nucaptcha" style="padding-bottom: 4px; display:block;">'.$t->GetWidget(false, false, NuCaptchaData::Get('player_position')).'</div>';
	} else {
		$html .= '<div id="nucaptcha_error" style="display:block;" class="'.NuCaptchaData::Get('css_error').'">Internal NC Error Code: '.$ec.'<br>Message: '.Leap::GetErrorString().'</div>';
	}

	// Generates a string using current user info, returns 'anonymous_user' if not logged in
	$wpui = nucaptcha_wp_user_info();
		
	// Store our Public Persistent Storage
	$html .= '<input type="hidden" name="nucaptcha_ps" id="nucaptcha_ps" value="'.$t->GetPersistentDataForPublicStorage($wpui).'">';
	
	$html .= '</div>';
	$html .= '</span>';

	$script = <<<EOT
<script type="text/javascript">
jQuery(document).ready(function(){
	// override the refill captcha method for NuCaptcha
	jQuery.fn.wpcf7RefillCaptcha = function(captcha) {
		return this.each(function() {
			var form = jQuery(this);
			jQuery.each(captcha, function(i, n) {
				if( n.nc != undefined && n.ps != undefined ) {
					lmReinitializePlayer(n.nc);
					jQuery('#nucaptcha_ps').val(n.ps);
				}
			});
		});
	};
});
</script>
EOT;

	return $html . $script;
}


/* Validation filter */

add_filter( 'wpcf7_validate_nucaptcha', 'wpcf7_nucaptcha_validation_filter', 10, 2 );

function wpcf7_nucaptcha_validation_filter( $result, $tag ) {
	global $wpcf7_contact_form;

	if( $tag['type'] != 'nucaptcha' )
	{
		return $result;
	}
	
	// Is it correct?
	$response = validate_nucaptcha();
	if (!$response)
	{
		$result['valid'] = false;
		$result['reason'][$tag['name']] = $wpcf7_contact_form->message( 'incorrect_nucaptcha' );
	}
	return $result;
}

/* Messages */

add_filter( 'wpcf7_messages', 'wpcf7_nucaptcha_messages' );

function wpcf7_nucaptcha_messages( $messages ) {
	return array_merge( $messages, array( 'incorrect_nucaptcha' => array(
		'description' => __( 'Incorrect <a href="http://www.nucaptcha.com/" target="_blank">NuCaptcha</a> Answer.  Please Try Again.', 'wpcf7' ),
		'default' => __( 'Correct NuCaptcha answer required, please try again.', 'wpcf7' )
	) ) );
}


/* Tag generator */

add_action( 'admin_init', 'wpcf7_add_tag_generator_nucaptcha', 45 );

function wpcf7_add_tag_generator_nucaptcha() {
	// remove other captcha generators if they exist
	global $wpcf7_tag_generators;
	$to_remove = array();
	foreach( $wpcf7_tag_generators as $k => $v ) {
		if(preg_match('/captcha/i', $k)) {
			$to_remove[] = $k;
		}
	}

	for($i=0;$i<count($to_remove);$i++)	{
		unset($wpcf7_tag_generators[$to_remove[$i]]);
	}

	wpcf7_add_tag_generator( 'nucaptcha', __( 'NuCaptcha', 'wpcf7' ),
		'wpcf7-tg-pane-nucaptcha', 'wpcf7_tg_pane_nucaptcha' );
}

/* Ajax echo filter */

add_filter( 'wpcf7_ajax_onload', 'wpcf7_nuaptcha_ajax_refill' );
add_filter( 'wpcf7_ajax_json_echo', 'wpcf7_nucaptcha_ajax_refill' );

function wpcf7_nucaptcha_ajax_refill( $items ) {
	global $wpcf7_contact_form;

	if ( ! is_a( $wpcf7_contact_form, 'WPCF7_ContactForm' ) )
		return $items;

	if ( ! is_array( $items ) )
		return $items;

	$fes = $wpcf7_contact_form->form_scan_shortcode(
		array( 'type' => 'nucaptcha' ) );

	if ( empty( $fes ) )
		return $items;

	$refill = array();

	foreach ( $fes as $fe ) {
		$name = $fe['name'];
		$options = $fe['options'];

		if ( empty( $name ) )
			continue;

		// NuCaptcha should already be initialized from the call to validate
		$vec = Leap::GetErrorCode();
		$t = Leap::InitializeTransaction(null, nucaptcha_use_ssl(), null, Leap::PURPOSE_ACTION);
		$tec = Leap::GetErrorCode();
		$refill[$name] = array(
			'nc' => $t->GetJSONToReinitialize(null, false, false, NuCaptchaData::Get('player_position')),
			'ps' => $t->GetPersistentDataForPublicStorage(nucaptcha_wp_user_info()),
			'vec' => $vec,
			'tec' => $tec,
		);
	}

	if ( ! empty( $refill ) )
		$items['captcha'] = $refill;

	return $items;
}

function wpcf7_tg_pane_nucaptcha( &$contact_form ) {
?>
<div id="wpcf7-tg-pane-nucaptcha" class="hidden">
<form action="">
<table>
<tr><td><?php echo esc_html( __( 'Name', 'wpcf7' ) ); ?><br /><input type="text" name="name" class="tg-name oneline" /></td><td></td></tr>
</table>

<table>
<tr>
<td><code>id</code> (<?php echo esc_html( __( 'optional', 'wpcf7' ) ); ?>)<br />
<input type="text" name="id" class="idvalue oneline option" /></td>

<td><code>class</code> (<?php echo esc_html( __( 'optional', 'wpcf7' ) ); ?>)<br />
<input type="text" name="class" class="classvalue oneline option" /></td>
</tr>
</table>

<div class="tg-tag"><?php echo esc_html( __( "Copy this code and paste it into the form left.  Note: NuCaptcha fields are always required fields", 'wpcf7' ) ); ?><br /><input type="text" name="nucaptcha" class="tag" readonly="readonly" onfocus="this.select()" /></div>
</form>
</div>

<?php
}

?>