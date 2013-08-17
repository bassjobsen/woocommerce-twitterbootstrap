<?php
/*
Plugin Name: WooCommerce Twitter Bootstrap
Depends: WooCommerce
Plugin URI: http://bassjobsen.weblogs.fm/
Description: Adds Twitter's Bootstrap's Grid to WooCommerce
Version: 0.0.1.
Author: Bass Jobsen
Author URI: ttp://bassjobsen.weblogs.fm/
License: GPLv2
*/

/*  Copyright 2023 Bass Jobsen (email : bass@w3masters.nl)

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
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    // Put your plugin code here

wp_register_style ( 'woocommerce-twitterbootstrap', plugins_url( 'css/woocommerce-twitterboostrap.css' , __FILE__ ), 'woocommerce' );
wp_enqueue_style ( 'woocommerce-twitterbootstrap');

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
		//echo 'START';
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
function woocommerce_before_single_product_summary_bs() { echo '<div class="container"><div class="row"><div class="col-sm-6 bssingleproduct">'; }


add_action( 'woocommerce_before_single_product_summary', 'woocommerce_before_single_product_summary_bs_end', 100 );
function woocommerce_before_single_product_summary_bs_end() { echo '</div>	
<div class="col-sm-6 bssingleproduct">'; }

add_action( 'woocommerce_after_single_product_summary', 'woocommerce_after_single_product_summary_bs', 1 );
function woocommerce_after_single_product_summary_bs() { echo '</div>	
</div>
</div>'; }

}
