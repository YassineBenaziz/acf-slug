=== Advanced Custom Fields: Slug Field ===
Contributors: Yassine Benaziz
Requires at least: 3.6
Tested up to: 6.2
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html


Slugify addon for Advanced Custom Fields.

== Description ==

Slugify addon for Advanced Custom Fields.

= Compatibility =

This add-on will work with:

* version 4, 5 and 6

== Installation ==

This add-on can be treated as both a WP plugin and a theme include.

= Plugin =
1. Copy the 'acf-{{field_name}}' folder into your plugins folder
2. Activate the plugin via the Plugins admin page

= Include =
1.	Copy the 'acf-slug' folder into your theme folder (can use sub folders). You can place the folder anywhere inside the 'wp-content' directory
2.	Edit your functions.php file and add the code below (Make sure the path is correct to include the acf-slug.php file)

`
add_action('acf/register_fields', 'register_fields');

function my_register_fields()
{
	include_once('acf-slug/acf-slug.php');
}
`

== Changelog ==

= 0.1.0 =
* Init Plugin
