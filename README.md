WooCommerce Twitter's Bootstrap Plugin
======================================

This plugin wraps your Woocommerce views in the Twitter's Bootstrap Grid. Makes your views full responsive. No changes to your theme or other plugins needed.

Installation
------------

[Download the latest version as .zip file](https://github.com/bassjobsen/woocommerce-twitterboostrap/archive/master.zip). Upload the .zip file to your Wordpress plugin directory (wp-content/plugin) and use the activate function in your dashboard.
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

Requirements
---------
* [Wordpress](http://wordpress.org/download/) tested with >= 3.6
* [Twitter's Bootstrap](http://getboostrap.com/) >= 3.0.0 (Twitter's Bootstrap 2 tested with v2.3.2.)
* [WooCommerce](http://wordpress.org/plugins/woocommerce/) tested with >= 2.0.13

Support
-------

We are always happy to help you. If you have any question regarding this code. [Send us a message](http://www.jamedowebsites.nl/contact/) or contact us on twitter [@JamedoWebsites](http://twitter.com/JamedoWebsites).

Todo
-------

* Apply grid on all views
* Make template available in the theme for overwriting and customizing



