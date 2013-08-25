<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;

/* double check */
if($woocommerce_loop['columns']>6 || in_array($woocommerce_loop['columns'],array(5,7))) { return; }

// Ensure visibility
if ( ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

//$number_of_columns = get_option( 'number_of_columns', 4 );

//col-xs, col-sm, col-md

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
	case 2: $classes = 'col-xs-12 col-sm-6 col-md-6'; break;
	default: $classes = 'col-xs-12 col-sm-1296 col-md-12';
	
}
}	

if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
{
?>
<div class="container">
<div class="row">

<?
}
?>
<div class="<?php echo $classes?>">

	
	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

	<div><a href="<?php the_permalink(); ?>">

		<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'bs_before_shop_loop_item_title' ); 
		?>

		<h3><?php the_title(); ?></h3>

		<?php
			/**
			 * woocommerce_after_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );
		?>

	</a></div>

	<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
</div>
<?

if ( 0 == ($woocommerce_loop['loop']) % $woocommerce_loop['columns'] )
{
	?>
	</div></div><!--end row -->
	<?
}	
