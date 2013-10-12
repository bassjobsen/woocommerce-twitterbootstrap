<?php
/*
Plugin Name: WooCommerce Twitter Bootstrap
Depends: WooCommerce
Plugin URI: https://github.com/bassjobsen/woocommerce-twitterbootstrap
Description: Adds Twitter's Bootstrap's Grid to WooCommerce
Version: 1.1
Author: Bass Jobsen
Author URI: http://bassjobsen.weblogs.fm/
License: GPLv2
*/

/*  Copyright 2013 Bass Jobsen (email : bass@w3masters.nl)

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
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
 * Check if WooCommerce is active
 **/
if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) 
{
	
	
// Put your plugin code here
die('install Woocommerce First');
}

	

if(!class_exists('WooCommerce_Twitter_Bootstrap')) 
{ 
	
class WooCommerce_Twitter_Bootstrap 
{ 
/*
* Construct the plugin object 
*/ 
public function __construct() 
{ 
	load_plugin_textdomain( 'wootb', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
 	// register actions 
	add_action('admin_init', array(&$this, 'admin_init')); 
	add_action('admin_menu', array(&$this, 'add_menu')); 
	
	
	
	add_filter( 'init', array( $this, 'init' ) );
} 
// END public 

/** 
 * Activate the plugin 
**/ 
public static function activate() 
{ 
	// Do nothing 
} 
// END public static function activate 

/** 
 * Deactivate the plugin 
 * 
**/ 
public static function deactivate() 

{ // Do nothing 
} 
// END public static function deactivate 

/** 
 * hook into WP's admin_init action hook 
 * */ 
 
public function admin_init() 
{ 
	// Set up the settings for this plugin 
	
	$this->init_settings(); 
	// Possibly do additional admin_init tasks 
} 
// END public static function activate - See more at: http://www.yaconiello.com/blog/how-to-write-wordpress-plugin/#sthash.mhyfhl3r.JacOJxrL.dpuf

/** * Initialize some custom settings */ 
public function init_settings() 
{ 
	// register the settings for this plugin 
	register_setting('woocommerce-twitterbootstrap-group', 'number_of_columns'); 
	register_setting('woocommerce-twitterbootstrap-group', 'tbversion'); 
} // END public function init_custom_settings()


/** * add a menu */ 
public function add_menu() 
{
	 
	 add_options_page('WooCommerce Twitter Bootstrap Settings', 'WooCommerce Bootstrap', 'manage_options', 'woocommerce-twitterbootstrap', array(&$this, 'plugin_settings_page'));
} // END public function add_menu() 

/** * Menu Callback */ 
public function plugin_settings_page() 
{ 
	if(!current_user_can('manage_options')) 
	{ 
		wp_die(__('You do not have sufficient permissions to access this page.')); 
	
	} 
// Render the settings template 

include(sprintf("%s/templates/settings.php", dirname(__FILE__))); 

} 
// END public function plugin_settings_page() 

/**
 * Output featured products
 *
 * @access public
 * @param array $atts
 * @return string
 */
function featured_products( $atts ) {

extract(shortcode_atts(array(
'per_page' => 12,
'columns' => 4,
'orderby' => 'date',
'order' => 'desc',
'content_product_template' => 'bs-content-product'
), $atts));

$args = array(
'post_type'=> 'product',
'post_status' => 'publish',
'ignore_sticky_posts'=> 1,
'posts_per_page' => $per_page,
'orderby' => $orderby,
'order' => $order,
'meta_query' => array(
array(
'key' => '_visibility',
'value' => array('catalog', 'visible'),
'compare' => 'IN'
),
array(
'key' => '_featured',
'value' => 'yes'
)
)
);

return $this->showproductspeciallist($args,$content_product_template,$columns);

}

/**
 * Recent Products shortcode
 *
 * @access public
 * @param array $atts
 * @return string
 */
public function recent_products( $atts ) {

global $woocommerce;

extract(shortcode_atts(array(
'per_page' => '12',
'columns' => '4',
'orderby' => 'date',
'order' => 'desc',
'content_product_template' => 'bs-content-product'
), $atts));

$meta_query = $woocommerce->query->get_meta_query();

$args = array(
'post_type'=> 'product',
'post_status' => 'publish',
'ignore_sticky_posts'=> 1,
'posts_per_page' => $per_page,
'orderby' => $orderby,
'order' => $order,
'meta_query' => $meta_query
);	

return $this->showproductspeciallist($args,$content_product_template,$columns);

}

function showproductspeciallist($args,$content_product_template,$columns=null)
{
	
global $woocommerce_loop;	
ob_start();

$products= new WP_Query( $args );

$woocommerce_loop['columns'] = ($columns)?$columns:get_option( 'number_of_columns', 4 );

if ( $products->have_posts() ) 
{
bs_shop_loop($products,$content_product_template,$columns);	
}

wp_reset_postdata();
return '<div class="woocommerce">' . ob_get_clean() . '</div>';
}	


function init()
{
if( !function_exists( 'bssetstylesheets' ) ):

remove_shortcode( 'featured_products' );
add_shortcode( 'featured_products', array($this, 'featured_products' ));
remove_shortcode( 'recent_products' );
add_shortcode( 'recent_products', array($this, 'recent_products' ));

function bssetstylesheets()
{
	wp_register_style ( 'woocommerce-twitterbootstrap', plugins_url( 'css/woocommerce-twitterboostrap.css' , __FILE__ ), 'woocommerce' );
    wp_enqueue_style ( 'woocommerce-twitterbootstrap');
}
endif;	
add_action( 'wp_enqueue_scripts', 'bssetstylesheets', 99 );

function get_grid_classes($woocommerce_loop)
{
/* the grid display */
/*
|  	columns		| mobile 	| tablet 	| desktop	|per page 	|
----------------------------------------------------|-----------|
|		1		|	1		|	1		|	1		| 	10		|
|---------------------------------------------------|-----------|
|		2		|	1		|	2		|	2		|	10		|
|---------------------------------------------------|-----------|
|		3		|	1		|	1		|	3		|	9		|
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
|		3		|	1			 |	3		|	9     |
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
if(get_option( 'tbversion', 3 )==2)
{
	switch($woocommerce_loop['columns'])
	{
	case 6: $classes = 'span2'; break;
	case 4: $classes = 'span3'; break;
	case 3: $classes = 'span4'; break;
	case 31: $classes = 'span4'; break;
	case 2: $classes = 'span6'; break;
	default: $classes = 'span12';
	}
}	
else
{
switch($woocommerce_loop['columns'])
{
	
	case 6: $classes = 'col-xs-6 col-sm-3 col-md-2'; break;
	case 4: $classes = 'col-xs-12 col-sm-6 col-md-3'; break;
	case 3: $classes = 'col-xs-12 col-sm-12 col-md-4'; break;
	case 31: $classes = 'col-xs-12 col-sm-6 col-md-4'; break;
	case 2: $classes = 'col-xs-12 col-sm-6 col-md-6'; break;
	default: $classes = 'col-xs-12 col-sm-12 col-md-12';
	
}
}
return $classes;
}


function bs_product_loop(&$woocommerce_loop,$classes,$template='bs-content-product')
{
	if(!file_exists( $template = get_stylesheet_directory() . '/woocommerce-twitterbootstrap/'.$template.'.php' ))
	{
					 $template = WP_PLUGIN_DIR.'/'.str_replace( basename( __FILE__), "", plugin_basename(__FILE__) ).'templates/bs-content-product.php';
	}	
	
	/*if ( 
	
	( 
	
	$woocommerce_loop['columns'] != 6
	&&
	0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] 
	
	)
	|| 1 == $woocommerce_loop['columns'] )
				{
					?>
		
					<div class="row">

					<?php
				}*/
				include($template);

				/*if ($woocommerce_loop['columns'] != 6 && 0 == ($woocommerce_loop['loop']) % $woocommerce_loop['columns'] )
				{
						?>
						</div><!--end row -->
						<?php
				}*/
				if(get_option( 'tbversion', 3 )==3)// only for version 3+
				{
				if($woocommerce_loop['columns'] == 6) 
				{
					if(0 == ($woocommerce_loop['loop'] % 6)){?><div class="clearfix visible-md visible-lg"></div><?php }
					if(0 == ($woocommerce_loop['loop'] % 4)){?><div class="clearfix visible-sm"></div><?php }
					if(0 == ($woocommerce_loop['loop'] % 2)){?><div class="clearfix visible-xs"></div><?php }
			    }	
			    elseif($woocommerce_loop['columns'] == 4) 
				{
					if(0 == ($woocommerce_loop['loop'] % 4)){?><div class="clearfix visible-md visible-lg"></div><?php }
					if(0 == ($woocommerce_loop['loop'] % 2)){?><div class="clearfix visible-sm"></div><?php }
			    }
			    elseif($woocommerce_loop['columns'] == 3) 
				{
					if(0 == ($woocommerce_loop['loop'] % 3)){?><div class="clearfix visible-md visible-lg"></div><?php }
				}
				elseif($woocommerce_loop['columns'] == 31) 
				{
					if(0 == ($woocommerce_loop['loop'] % 3)){?><div class="clearfix visible-md visible-lg"></div><?php }
					if(0 == ($woocommerce_loop['loop'] % 2)){?><div class="clearfix visible-sm"></div><?php }
				}
			    elseif($woocommerce_loop['columns'] == 2) 
				{
					if(0 == ($woocommerce_loop['loop'] % 2)){?><div class="clearfix invisible-xs"></div><?php }
				}
			    }
				$woocommerce_loop['loop']++;
				
				

}	

add_action( 'shop_loop', 'bs_shop_loop', 99 );

function bs_shop_loop($product=null,$template='bs-content-product',$columns=null)
{

$woocommerce_loop = array('loop'=>0,'columns' => ($columns)?$columns:get_option( 'number_of_columns', 4 ));	


/* double check */
if($woocommerce_loop['columns']!=31 && ( $woocommerce_loop['columns']>6 || in_array($woocommerce_loop['columns'],array(5,7)))) { return; }

// Ensure visibility
//if ( ! $product->is_visible() )	return;

// Increase loop count
$woocommerce_loop['loop']++;

				
				
				
				
				
				?>

				<?php //woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>

				<?php 
				
				$classes = get_grid_classes($woocommerce_loop);
				
				if($product)
				{
				
					?><div class="container products"><div class="row"><?php
				
					while ( $product->have_posts()) : $product->the_post(); 
				    bs_product_loop($woocommerce_loop,$classes,$template);
					endwhile; 
					
				}	
				else
				{
					?><div class="container products"><div class="row"><?php
					
					while ( have_posts() ) : the_post(); 
					bs_product_loop($woocommerce_loop,$classes);
					endwhile;
					
				}				
				if($woocommerce_loop['columns']==31)$woocommerce_loop['columns']=3;
				if ( 0 != ($woocommerce_loop['loop']-1) % $woocommerce_loop['columns'] )
				{
	
				?><div class="<?php echo $classes?>"></div><?php				
				while ( 0 != $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
				{
					$woocommerce_loop['loop']++;
					?><div class="<?php echo $classes?>"></div><?php
				}

				}	
				
	?></div></div><?php	
	
}	


function my_template_redirect(){
   //pages you want to make true, ex. is_shop()
   global $woocommerce;

   if(
   is_shop() || 
   is_product_category()
   
   ) {
    
    if(file_exists( $template = get_stylesheet_directory() . '/woocommerce-twitterbootstrap/bs-archive-product.php' ))
	{
		 include($template);
	}	
    else
    {
    $plugin_dir = WP_PLUGIN_DIR.'/'.str_replace( basename( __FILE__), "", plugin_basename(__FILE__) );
    load_template($plugin_dir . 'templates/bs-archive-product.php');
	}
    exit;
   }
   /*else if(is_product_category())
   {
	   load_template($plugin_dir . 'templates/bs-content-product_cat.php');
	   exit;
   }*/	   
   
}

add_action('template_redirect','my_template_redirect');
	

	
	
// --------------------
// --  PLUGIN HOOKS  --
// --------------------

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
add_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper_bs', 10 );
add_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end_bs', 10 );

if ( ! function_exists( 'woocommerce_output_content_wrapper_bs' ) ) {

	/**
	 * Output the start of the page wrapper.
	 *
	 * @access public
	 * @return void
	 */
	function woocommerce_output_content_wrapper_bs() {

		woocommerce_get_template( 'shop/wrapper-start.php' );
	}
}
if ( ! function_exists( 'woocommerce_output_content_wrapper_end_bs' ) ) {

	/**
	 * Output the end of the page wrapper.
	 *
	 * @access public
	 * @return void
	 */
	function woocommerce_output_content_wrapper_end_bs() {
		//echo 'THE END';
		woocommerce_get_template( 'shop/wrapper-end.php' );
	}
}



add_action( 'woocommerce_before_single_product_summary', 'woocommerce_before_single_product_summary_bs', 1 );
function woocommerce_before_single_product_summary_bs() { 
	
	if(get_option( 'tbversion', 3 )==2)
	{
		$bssingleproductclass = 'span6';
	}
	else
	{
		$bssingleproductclass = 'col-sm-6';
	}	
	
	echo '<div class="container"><div class="row"><div class="'.$bssingleproductclass.' bssingleproduct">'; 
	
	}


add_action( 'woocommerce_before_single_product_summary', 'woocommerce_before_single_product_summary_bs_end', 100 );
function woocommerce_before_single_product_summary_bs_end() { echo '</div>	
<div class="col-sm-6 bssingleproduct">'; }

add_action( 'woocommerce_after_single_product_summary', 'woocommerce_after_single_product_summary_bs', 1 );
function woocommerce_after_single_product_summary_bs() { echo '</div>	
</div>
</div>'; }

/* thumbnails */

add_action('bs_before_shop_loop_item_title','bs_get_product_thumbnail',10,3);
function bs_get_product_thumbnail()
{

global $post;

$doc = new DOMDocument();
$doc->loadHTML(get_the_post_thumbnail($post->ID, 'medium'));
$images = $doc->getElementsByTagName('img');
foreach ($images as $image) {
$image->setAttribute('class',$image->getAttribute('class').' img-responsive');
$image->removeAttribute('height');
$image->removeAttribute('width');
//see: http://stackoverflow.com/questions/6321481/printing-out-html-content-from-domelement-using-nodevalue
echo utf8_decode($doc->saveXML($image)); break;
}

}	


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

*/

// Store column count for displaying the grid
global $woocommerce_loop;

if ( empty( $woocommerce_loop['columns'] ) )
{
$woocommerce_loop['columns'] = get_option('number_of_columns', 4 );	
}


if($woocommerce_loop['columns']==3)
{
	add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 9;' ), 10 );
}	
elseif($woocommerce_loop['columns']>2)
{
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 10 );
}

add_action('woocommerce_before_shop_loop','setupgrid');

function setupgrid()
{

global $woocommerce_loop;

/* set up grid variables */


// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;


	
if($woocommerce_loop['columns']!=31 && ($woocommerce_loop['columns']>6 || in_array($woocommerce_loop['columns'],array(5,7)))) 
{
echo '<div class="alert alert-error">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  Wrong number of columns.
</div>';
}

}

}



} // END class 

}

if(class_exists('WooCommerce_Twitter_Bootstrap')) 
{ // Installation and uninstallation hooks 
	register_activation_hook(__FILE__, array('WooCommerce_Twitter_Bootstrap', 'activate')); 
	register_deactivation_hook(__FILE__, array('WooCommerce_Twitter_Bootstrap', 'deactivate')); 
	
	$woocommercetwitterbootstrap = new WooCommerce_Twitter_Bootstrap();
	// Add a link to the settings page onto the plugin page 
	if(isset($woocommercetwitterbootstrap))
	{
		
		 function plugin_settings_link($links) 
		 { 
			 $settings_link = '<a href="options-general.php?page=woocommerce-twitterbootstrap">Settings</a>';
			 array_unshift($links, $settings_link); 
			
			 return $links; 
		 } 	
		 $plugin = plugin_basename(__FILE__); 
		 	
		
		 add_filter("plugin_action_links_$plugin", 'plugin_settings_link'); 
	}
	
}

