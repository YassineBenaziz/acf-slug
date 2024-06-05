<?php
/*
 * Plugin Name: Advanced Custom Fields: Slug
 * Plugin URI: https://github.com/YassineBenaziz/acf-slug
 * Description: Slugify addon for Advanced Custom Fields.
 * Version: 0.1.0
 * Author: YassineBenaziz
 * Author URI:  https://www.linkedin.com/in/benaziz-yassine-11289764
 * Email: yassin.benaziz@gmail.com
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * GitHub Plugin URI: https://github.com/YassineBenaziz/acf-slug
 * Text Domain: acf-slug
*/


// 1. set text domain
// Reference: https://codex.wordpress.org/Function_Reference/load_plugin_textdomain
load_plugin_textdomain( 'acf-slug', false, dirname( plugin_basename(__FILE__) ) . '/lang/' );



// 2. Include field type for ACF5
// $version = 5 and can be ignored until ACF6 exists
function include_field_types_slug( $version ) {

    include_once('acf-slug-v5.php');

    if($version == 6){
        include_once('acf-slug-v6.php');
        // create field
        acf_register_field_type('acf_field_slug_v6');
    } else {
        // create field
        acf_register_field_type('acf_field_slug_v5');
    }

}

add_action('acf/include_field_types', 'include_field_types_slug');


// 3. Include field type for ACF4
function register_fields_slug() {

	include_once('acf-slug-v4.php');

}

add_action('acf/register_fields', 'register_fields_slug');

?>
