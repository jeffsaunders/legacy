<?php
/*
  Plugin Name: jQuery Archive List Widget
  Plugin URI: http://skatox.com/blog/jquery-archive-list-widget/
  Description: A simple jQuery widget for displaying an archive list with some effects (inspired by Collapsible Archive Widget)
  Author: Miguel Useche
  Version: 1.2.1
  Author URI: http://skatox.com/

  Copyleft 2009-2011  Miguel Useche  (email : migueluseche@skatox.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

$jal_dir = preg_replace("/^.*[\/\\\]/", "", dirname(__FILE__));
define("JAL_DIR", "/wp-content/plugins/" . $jal_dir);

/**
 * Loads plugin's options, interprets it for internal use
 * @return array of custom options
 */
function aux_load_options() {
    //Loads options
    $options = get_option('jquery_archive_list_widget');
    $jal_options = array();
    $jal_options['showpost'] = ($options['showpost'] == 'true')? 1 : 0;
    $jal_options['expandcurrent'] = ($options['expandcurrent'] == 'true')? 1 : 0;
    $jal_options['showcount'] = $options['showcount'];
    $jal_options['month_format'] = $options['month_format'];
    $jal_options['title'] = empty($options['title']) ? __('Default Title', 'jalw_i18n') : $options['title'];

    switch ($options['symbol']) {
        case '0':
            $jal_options['ex_sym'] = ' ';
            $jal_options['con_sym'] = ' ';
            break;
        case '1':
            $jal_options['ex_sym'] = '►';
            $jal_options['con_sym'] = '▼';
            break;
        case '2':
            $jal_options['ex_sym'] = '(+)';
            $jal_options['con_sym'] = '(-)';
            break;
        case '3':
            $jal_options['ex_sym'] = '[+]';
            $jal_options['con_sym'] = '[-]';
            break;
        default:
            $jal_options['ex_sym'] = '>';
            $jal_options['con_sym'] = 'v';
            break;
    }

    switch ($options['effect']) {
        case 'slide':
            $jal_options['fx_in'] = 'slideDown';
            $jal_options['fx_out'] = 'slideUp';
            break;
        case 'fade':
            $jal_options['fx_in'] = 'fadeIn';
            $jal_options['fx_out'] = 'fadeOut';
            break;
    }
    return $jal_options;
}

function aux_get_years() {
    global $wpdb;

    //Filters supplied by Ramiro García <ramiro(at)inbytes.com>
    $where = apply_filters('getarchives_where', "WHERE post_type = 'post' AND post_status = 'publish'");
    $join = apply_filters('getarchives_join', "");

    $sql = "SELECT DISTINCT YEAR(post_date) AS `year`, count(ID) as posts ";
    $sql .="FROM {$wpdb->posts} {$join} {$where} ";
    $sql .="GROUP BY YEAR(post_date) ORDER BY post_date DESC";

    return $wpdb->get_results($sql);
}

function aux_get_months($year) {
    global $wpdb;

    //Filters supplied by Ramiro García <ramiro(at)inbytes.com>
    $where = apply_filters('getarchives_where', "WHERE post_type = 'post' AND post_status = 'publish' AND YEAR(post_date) = {$year}");
    $join = apply_filters('getarchives_join', "");

    $sql = "SELECT DISTINCT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, count(ID) as posts ";
    $sql .="FROM {$wpdb->posts} {$join} {$where} ";
    $sql.= "GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date DESC";

    return $wpdb->get_results($sql);
}

function aux_get_posts($year, $month) {
    global $wpdb;

    if (empty($year) || empty($month))
        return null;

    //Filters supplied by Ramiro García <ramiro(at)inbytes.com>
    $where = apply_filters('getarchives_where', "WHERE post_type = 'post' AND post_status = 'publish' AND YEAR(post_date) = {$year} AND MONTH(post_date) = {$month}");
    $join = apply_filters('getarchives_join', "");

    $sql = "SELECT ID, post_title, post_name FROM {$wpdb->posts} ";
    $sql .="$join $where ORDER BY post_date DESC";

    return $wpdb->get_results($sql);
}

/**
 * Builds Javascript's source url with custom parameters to generate dynamic js code
 */
function aux_build_js_url() {
    $options = aux_load_options();

    $url = '/jquery-archive-list.js.php';
    $url.= '?ex_sym=' . rawurlencode($options['ex_sym']) . '&con_sym=' . rawurlencode($options['con_sym']);
    $url.= '&fx_out=' . $options['fx_out'] . '&fx_in=' . $options['fx_in'] . '&showpost=' . $options['showpost'];

    return $url;
}

/**
 * Builds archive list's HTML code
 */
function aux_build_html_code($jal_options) {
    global $wp_locale;
	global $wp_query;
    $years = aux_get_years();
    $html = '<ul>';

    $is_home = is_front_page() || is_home() || is_search(); //Places where plugin should not show current year
    $post_id = (!$is_home) ? get_the_ID() : -1;
    if ($post_id >= 0) {
        $post_data = get_post($post_id);
        $post_year = 1 * substr($post_data->post_date_gmt, 0, 4);
        $post_month = 1 * substr($post_data->post_date_gmt, 5, 2);
    } else {
        $post_year = $years[0]->year;
    }

    //Prints Years
    for ($i = 0; $x < count($years[$i]); $i++) {
        $this_year = $jal_options['expandcurrent'] && $years[$i]->year == $post_year;
        $year_link = get_year_link($years[$i]->year);
        //START MODIFICARE 1
        if ($this_year || $wp_query->query_vars['year'] == $years[$i]->year) {
       	//END MODIFICARE 1
            $html.= "\n<li class=\"  selected\"><a class=\"jaw_years\" href=\"{$year_link}\">";
            $html.= '<span class="">'. htmlspecialchars($jal_options['con_sym']) . "</span> {$years[$i]->year}";
        } else {
            $html.= "\n<li class=\"\"><a class=\"jaw_years\" href=\"{$year_link}\">";
            $html.= '<span class="">'. htmlspecialchars($jal_options['ex_sym']) . "</span> {$years[$i]->year}";
        }

        //Prints number of post_date	
        if ($jal_options['showcount'] == 'true')
            $html.= " ({$years[$i]->posts})";

        $html.= '</a><ul class="children">';

        //Prints Months
        $months = aux_get_months($years[$i]->year);

        foreach ($months as $month) {
            $month_url = get_month_link($years[$i]->year, $month->month);
			//START MODIFICARE 2
            if($month->month == $wp_query->query_vars['monthnum'] && $years[$i]->year == $wp_query->query_vars['year']) 
				$expanded = 'selected' ;
			else 
				$expanded = ''; 
			
			$style = ($jal_options['expandcurrent'] && $this_year)? 'list-item' : '';
			
            $html.= "\n\t<li class=\" $expanded\" >";
			//END MODIFICARE 2
            $html.= "<a class=\"\" href=\"{$month_url}\">";
            
            $this_month = $this_year && (($post_id >= 0 && $month->month == $post_month) || ($post_id < 0 && $month == $months[0]));

            if ($jal_options['showpost']){
                $sym_key = ($this_month) ? 'con_sym' : 'ex_sym';
                $html.= '<span class="">' . htmlspecialchars($jal_options[$sym_key]) . '</span> ';
            }

            //Prints month according to selected format
            switch ($jal_options['month_format']) {
                case 'short':
                    $html.= $wp_locale->get_month_abbrev($wp_locale->get_month($month->month));
                    break;
                case 'number':
                    if ($month->month < 10)
                        $html.= '0' . $month->month;
                    else
                        $html.= $month->month;
                    break;
                default:
                    $html.= $wp_locale->get_month($month->month);
                    break;
            }

            if ($jal_options['showcount'])
                $html.= " ({$month->posts})";
            $html.= '</a>';

            if ($jal_options['showpost']) {
                $html.= '<ul>';
                $posts = aux_get_posts($years[$i]->year, $month->month);
                
                foreach ($posts as $post) {
                    $style = ($this_month)? 'list-item' : '';
                    $html.= "\n\t\t".'<li class="" >';
                    $html.= '<a href="' . get_permalink($post->ID) . '">' . $post->post_title . '</a></li>';
                }
                
                $html.= '</ul>';
            }
            $html.= '</li>';
        }
        $html.= '</ul></li>';
    }
    $html.= '</ul>';

    return $html;
}

/**
 * Function wich filters any [jQuery Archive List] text inside post to display archive list
 */
function widget_filter_jquery_archives($content) {
    $jal_options = aux_load_options();
    $content = str_ireplace('[jQuery Archive List]', aux_build_html_code($jal_options), $content);
    return $content;
}

/**
 * Function wich displays configuration form used at widgets area at Administration page
 */
function widget_display_jquery_archives_control() {
    $options = get_option('jquery_archive_list_widget');

    //If submit button was pressed the variables are loaded by POST
    if ($_POST['jquery_archives_widget_submit']) {
        
        $options['symbol'] = $_POST['jquery_archives_widget_symbol'];
        $options['title'] = stripslashes($_POST['jquery_archives_widget_title']);
        $options['effect'] = stripslashes($_POST['jquery_archives_widget_effect']);
        $options['month_format'] = stripslashes($_POST['jquery_archives_widget_format']);
        $options['showpost'] = (isset($_POST['jquery_archives_widget_showpost']))? true : false;
        $options['showcount'] = (isset($_POST['jquery_archives_widget_showcount']))? true : false;
        $options['expandcurrent'] = (isset($_POST['jquery_archives_widget_expandcurrent']))? true : false;

        //Update options in the Wordpress database
        update_option('jquery_archive_list_widget', $options);
    }
    ?>

    <dl>
        <dt><strong><?php _e('Title') ?></strong></dt>
        <dd>
            <input name="jquery_archives_widget_title" type="text" value="<?php echo $options['title']; ?>" />
        </dd>
        <dt><strong><?php _e('Trigger Symbol', 'jalw_i18n') ?></strong></dt>
        <dd>
            <select id="jquery_archives_widget_symbol" name="jquery_archives_widget_symbol">
                <option value="0"  <?php if ($options['symbol'] == '0') echo 'selected="selected"' ?> ><?php _e('Empty Space', 'jalw_i18n') ?></option>
                <option value="1"  <?php if ($options['symbol'] == '1') echo 'selected="selected"' ?> >► ▼</option>
                <option value="2"  <?php if ($options['symbol'] == '2') echo 'selected="selected"' ?> >(+) (-)</option>
                <option value="3"  <?php if ($options['symbol'] == '3') echo 'selected="selected"' ?> >[+] [-]</option>
            </select>
        </dd>
        <dt><strong><?php _e('Effect', 'jalw_i18n') ?></strong></dt>
        <dd>
            <select id="jquery_archives_widget_effect" name="jquery_archives_widget_effect">
                <option value="slide"  <?php if ($options['effect'] == 'slide') echo 'selected="selected"' ?> ><?php _e('Slide (Accordion)', 'jalw_i18n') ?></option>
                <option value="fade" <?php if ($options['effect'] == 'fade')  echo 'selected="selected"' ?> ><?php _e('Fade', 'jalw_i18n') ?></option>
            </select>
        </dd>
        <dt><strong><?php _e('Month Format', 'jalw_i18n') ?></strong></dt>
        <dd>
            <select id="jquery_archives_widget_format" name="jquery_archives_widget_format">
                <option value="full" <?php if ($options['month_format'] == 'full')
        echo 'selected="selected"' ?> ><?php _e('Full Name (January)', 'jalw_i18n') ?></option>
                <option value="short" <?php if ($options['month_format'] == 'short')
        echo 'selected="selected"' ?> ><?php _e('Short Name (Jan)', 'jalw_i18n') ?></option>
                <option value="number" <?php if ($options['month_format'] == 'number')
        echo 'selected="selected"' ?> ><?php _e('Number (01)', 'jalw_i18n') ?></option>
            </select>
        </dd>
        <dt><strong><?php _e('Extra options', 'jalw_i18n') ?></strong></dt>
        <dd>
            <input id="jquery_archives_widget_showcount" name="jquery_archives_widget_showcount" type="checkbox" <?php if ($options['showcount']) echo 'checked="checked"' ?> />
            <?php _e('Show number of posts', 'jalw_i18n') ?>
        </dd>
        <dd>
            <input id="jquery_archives_widget_showpost" name="jquery_archives_widget_showpost" type="checkbox" <?php if ($options['showpost']) echo 'checked="checked"' ?> />
            <?php _e('Show posts under months', 'jalw_i18n') ?>
        </dd>
        <dd>
            <input id="jquery_archives_widget_expandcurrent" name="jquery_archives_widget_expandcurrent" type="checkbox" <?php if($options['expandcurrent'] )  echo 'checked="checked"' ?> />
            <?php _e('Intially expand current year','jalw_i18n') ?>
        </dd>
    </dl> 
    <input type="hidden" name="jquery_archives_widget_submit" value="1" />
    <?php
}

/**
 * Displays the archive list
 */
function widget_display_jQuery_archives($args) {
    extract($args);
    $jal_options = aux_load_options();

    echo $before_widget;
    echo $before_title;
    echo $jal_options['title'];
    echo $after_title;
    echo aux_build_html_code($jal_options);
    echo $after_widget;
}

function widget_display_jQuery_archives_init() {
    //Includes translation file
    if (function_exists("load_plugin_textdomain")) 
        load_plugin_textdomain('jalw_i18n', JAL_DIR . "/lang/");

    //Includes dynamic js script and loads jquery if it is not loaded
    if (function_exists("wp_enqueue_script") && !is_admin()) {
        $js_url = aux_build_js_url();
        wp_enqueue_script('jquery_archive_list', get_option("siteurl") . JAL_DIR . $js_url, array('jquery'), false, true);
    }

    //register this plugin
    wp_register_sidebar_widget(
            'jquery-archive-list-widget', 'jQuery Archive List', 'widget_display_jQuery_archives', array('description' => 'A simple jQuery widget for displaying an archive list with some effects.'
    ));
    wp_register_widget_control('jquery-archive-list-widget', 'jQuery Archive List', 'widget_display_jQuery_archives_control');
}

add_action('init', 'widget_display_jQuery_archives_init');
add_filter('the_content', 'widget_filter_jquery_archives');

//filters on widgets (thanks to Ramiro García <ramiro(at)inbytes.com>)
add_action('widget_text', 'widget_filter_jquery_archives');