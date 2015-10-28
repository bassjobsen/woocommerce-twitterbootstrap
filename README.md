WooCommerce Twitter's Bootstrap Plugin
======================================

This plugin wraps your Woocommerce views in the Twitter's Bootstrap Grid. Makes your views full responsive. No changes to your theme or other plugins needed.

Installation
------------

[Download the latest version as .zip file](https://github.com/bassjobsen/woocommerce-twitterbootstrap/archive/master.zip). Upload the .zip file to your Wordpress plugin directory (wp-content/plugin) and use the activate function in your dashboard.
( Plugins > installed plugins ).

Twitter's Bootstrap version
---------------------------
Select you Twitter's Boostrap version in the settings Panel.
You could choose between version 2 and 3.

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
|		3(1)	|	1		|	2		|	3		|	12		|
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

Template overwriting
--------------------
Copy the templates from wp-content/plugins/woocommerce-twitter/templates/ to wp-content/themes/{your(child)theme}/woocommerce-twitterbootstrap/. Edit the templates to adopt them to your needs now.
When a product does not have a featured image placeholder.php sets a placeholder image. This template can be overwritten too. 

Shortcodes
----------
The plugin overwrite the shortcodes of Woocommerce. There are two short code avaviable now:
[featured_products] and [recent_products]. You could use the shortcodes in your templates for example `<?php echo do_shortcode('[featured_products columns="31" content_product_template="bs-content-product-info"]'); ?>` or in your posts `[featured_products]`.

Attributes to use with the shortcodes:
* `columns` the number of columns in your grid (see the table above). This argument overwrites the number of columns from the 
settings. Note use 31 here to use the 3-2-1 layout (12 items per page); 
* `per_page` sets the number of items you want to show (overwrites the settings)

CSS
---
The plugin provides some CSS classes to mimic the default WooCommerce settings. Of course you can overwrite these.
Also see: [Centering product elements on Shop page](http://www.primathemes.com/documentation/centering-product-elements-on-shop-page/)

Requirements
------------
* [Wordpress](http://wordpress.org/download/) tested with >= 3.6
* [Twitter's Bootstrap](http://getboostrap.com/) >= 3.0.0 (Twitter's Bootstrap 2 tested with v2.3.2.)
* [WooCommerce](http://wordpress.org/plugins/woocommerce/) tested with >= 2.0.13

Theme integration
-----------------

To use this plugin in your themes copy the files to for example `{wordpress}/wp-contents/themes/{yourtheme}/vendor/` and add according to this the code below to your `functions.php`:

	if( !function_exists( 'wts' ) ):
	function wts()
	{
	wp_deregister_style ( 'woocommerce-twitterbootstrap');	
	wp_dequeue_style( 'woocommerce-twitterbootstrap');
	wp_register_style ( 'woocommerce-twitterbootstrap', get_stylesheet_directory_uri() . '/vendor/woocommerce-twitterbootstrap/css/woocommerce-twitterboostrap.css', 'woocommerce' );
	wp_enqueue_style( 'woocommerce-twitterbootstrap');
	}
	endif;	
	add_action( 'wp_enqueue_scripts', 'wts', 200 ); 


	remove_action('admin_menu',array($woocommercetwitterbootstrap,'add_menu'));
	add_action('admin_menu','woocommerce_twitterbootstrap_add_menu');
	/** * add a menu */ 
	function woocommerce_twitterbootstrap_add_menu() 
	{
		 global $woocommercetwitterbootstrap;
		 add_theme_page('WooCommerce Twitter Bootstrap Settings', 'WooCommerce Bootstrap', 'manage_options', 'woocommerce-twitterbootstrap', array($woocommercetwitterbootstrap, 'plugin_settings_page'));
	} // END public function add_menu()
	

Support
-------

We are always happy to help you. If you have any question regarding this code. [Send us a message](http://www.jamedowebsites.nl/contact/) or contact us on twitter [@JamedoWebsites](http://twitter.com/JamedoWebsites).

Changelog
---------

1.1

* All items in one row with responsive column reset see: http://getbootstrap.com/css/#grid-responsive-resets
* Option to overwrite the template in wp-conten/themes/{yourtheme}/woocommerce-twitterboostrap/
* Shortcode for featured products [featured_products], paremeters: per_page, columns and content_product_template
* Shortcode for recent products [recent_products], paremeters: per_page, columns and content_product_template
* Less code for part of the CSS
* Optional column setting 31, use with shortcodes to get 1 (mobile) 2 (tablet) 3 (desktop)

1.0.1

* Bootstrap 3.0
* Grids applied to category pages too

1.0

* First version



