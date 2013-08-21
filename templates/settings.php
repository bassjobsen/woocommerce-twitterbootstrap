<div class="wrap"> 

<h2>WooCommerce Twitter Bootstrap Settings</h2> 

<form method="post" action="options.php"> 
<?php @settings_fields('woocommerce-twitterbootstrap-group'); ?> 
<?php @do_settings_fields('woocommerce-twitterbootstrap-group'); ?> 
<table class="form-table"> 
<tr valign="top"> 
<th scope="row">
<label for="setting_a">Number of columns per row</label></th> 
<td>
	<select name="number_of_columns" id="number_of_columns">
	
	<?php
	
	$numberofcolumns = (get_option('number_of_columns'))?get_option('number_of_columns'):4;
	
	foreach(array(1,2,3,4,6) as $number)
	{
		?><option value="<?php echo $number ?>" <?php echo ($numberofcolumns==$number)?' selected="selected"':''?>><?php echo $number ?></option><?
	}	
	?>
	</select>
</td> 
</tr> 

<tr valign="top"> 
<th scope="row">
<label for="tbversion">Version of Twitter's Bootstrap</label></th> 
<td>
	<?php
	$tbversion = (get_option('tbversion'))?get_option('tbversion'):3;
	?>
	<input type="radio" value="2" name="tbversion" <?php echo ($tbversion==2)?' checked="checked"':''?>>Twitter's Bootstrap 2.x (2.3.2)<br>
	<input type="radio" value="3" name="tbversion"<?php echo ($tbversion==3)?' checked="checked"':''?>>Twitter's Bootstrap 3 (RC2)<br>
</td> 
</tr> 

</table> 
<?php @submit_button(); ?> </form> 
</div>
