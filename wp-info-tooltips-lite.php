<?
/*
Plugin Name: Wordpress Info Tooltips Lite
Plugin URI: http://voodoopress.net/info_tooltips/
Description: With this powerfull plugin you can add any info to any word inside your posts. You can add descriptions, clarifications etc to any word. Also you can use plugin for affiliate systes, so you can add links to your product to most relative words.
Version: 1.0
Author: Evgen "EvgenDob" Dobrzhanskiy
Author URI: http://voodoopress.net
Stable tag: 1.0
*/
include('modules/cpt.php');
include('modules/functions.php');
include('modules/hooks.php');
include('modules/scripts.php');
include('modules/settings.php');
include('modules/meta_box.php');

register_activation_hook( __FILE__, 'ta_activate' );
function ta_activate() {
$ta_options = array(
	'use_on_frontpage' =>  'off',
  'use_on_archive' =>  'off',
  'use_on_single' =>  'on',
  );
  if( !get_option('ta_options') ){
	update_option('ta_options', $ta_options );
  }
}



?>