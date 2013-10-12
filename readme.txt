=== WooCommerce Twitter's Bootstrap ===
Contributors: bassjobsen
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=SNYGRL7YNVYQW
Tags: WooCommerce, Twitter's Bootstrap, responsive
Requires at least: 3.6
Tested up to: 3.6
Stable tag: 1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin wraps your Woocommerce views in the Twitter's Bootstrap Grid. Makes your views full responsive.


== Description ==

This plugin wraps your Woocommerce views in the Twitter's Bootstrap Grid. Makes your views full responsive. No changes to your theme or other plugins needed.


Twitter's Bootstrap version
---------------------------
Select you Twitter's Boostrap version in the settings Panel.
You could choose between version 2 and 3.0.

Number of columns (Shop page)
-----------------------------
Choose the number of columns in the Shop Page. 
This will be result in the grids shown below:

<pre>
/* the grid display */
/*
|  	columns		| mobile 	| tablet 	| desktop	|per page 	|
----------------------------------------------------|-----------|
|		1		|	1		|	1		|	1		| 	10		|
|---------------------------------------------------|-----------|
|		2		|	1		|	2		|	2		|	10		|
|---------------------------------------------------|-----------|
|		3		|	1		|	1		|	3		|	 9		|
|---------------------------------------------------|-----------|
|		4		|	1		|	2		|	4		|	12		|
|---------------------------------------------------|-----------|
|		5		|	n/a		|	n/a		|	n/a		|	n/a	    |
|---------------------------------------------------|-----------|
|		6		|	2		|	4		|	6		|	12		|
|---------------------------------------------------|-----------|
|		>=6		|	n/a		|	n/a		|	n/a		|	n/a		|
|---------------------------------------------------------------|
* 
* 
*/

/* the grid display Twitter's Bootstrap 2.x*/
/*
|  	columns		| mobile / tablet| desktop	|per page |
------------------------------------------------------|
|		1		|	1		     |	1		| 	10	  |
|-----------------------------------------------------|
|		2		|	1		     |	2	    |	10	  |
|-----------------------------------------------------|
|		3		|	1			 |	3		|	12    |
|-----------------------------------------------------|
|		4		|	1		     |	4	    |   12	  |
|-----------------------------------------------------|
|		5		|	n/a		     |	n/a		|	n/a	  |	
|-----------------------------------------------------|
|		6		|	2		     |	4		|	12	  |
|-----------------------------------------------------|
|		>=6		|	n/a		     |	n/a		|	n/a	  |	
|-----------------------------------------------------|
* 
* 
*/

</pre>

Contribute!
-----------
If you have suggestions for a new feature or improvement, feel free to contact us on [Twitter](http://twitter.com/JamedoWebsites). Alternatively, you can fork the plugin from [Github](https://github.com/bassjobsen/woocommerce-twitterbootstrap).

== Installation ==

1. You can download and install WooCommerce Twitter's Bootstrap using the built in WordPress plugin installer. If you download WooCommerce Twitter's Bootstrap manually, make sure it is uploaded to "/wp-content/plugins/woocommerce-twitterbootstrap/".

1. Activate WooCommerce Twitter's Bootstrap in the "Plugins" admin panel using the "Activate" link. 

== Frequently Asked Questions ==


== Screenshots ==

1. Settings panel of WooCommerce Twitter's Bootstrap

== Changelog ==

= 1.1 =
* All items in one row with responsive column reset see: http://getbootstrap.com/css/#grid-responsive-resets
* Option to overwrite the template in wp-conten/themes/{yourtheme}/woocommerce-twitterboostrap/
* Shortcode for featured products [featured_products], paremeters: per_page, columns and content_product_template
* Shortcode for recent products [recent_products], paremeters: per_page, columns and content_product_template
* Less code for part of the CSS
* Optional column setting 31, use with shortcodes to get 1 (mobile) 2 (tablet) 3 (desktop)

= 1.0.1 =
* Bootstrap 3.0
* Grids applied to category pages too

= 1.0 =
* First version

== Requirements ==

* [Wordpress](http://wordpress.org/download/) tested with >= 3.6
* [Twitter's Bootstrap](http://getboostrap.com/) >= 3.0.0 (Twitter's Bootstrap 2 tested with v2.3.2.)
* [WooCommerce](http://wordpress.org/plugins/woocommerce/) tested with >= 2.0.13

== Support ==

We are always happy to help you. If you have any question regarding this code. [Send us a message](http://www.jamedowebsites.nl/contact/) or contact us on twitter [@JamedoWebsites](http://twitter.com/JamedoWebsites).

== Todo ==

* Make template available in the theme for overwriting and customizing
