<?php 
add_shortcode( 'tooltip', 'ta_shortcode_handler' );
function ta_shortcode_handler( $atts, $content = null ) {

   global $gall_id;
   extract( shortcode_atts( array(
      'attr_1' => 'attribute 1 default',
      'attr_2' => 'attribute 2 default',
      // ...etc
      ), $atts ) );
	  $tooltip_id = $atts['id'];
	  $word2replace = get_post_meta( $tooltip_id, 'words2use', true );
	  
		$config = get_option('ta_options'); 
		
		// check where to show from settings parameters SINGLE
		if( (is_single() || is_page() ) && $config['use_on_single'] != 'on'  ){
			return $content;
		}
		// category / archive
		
		if( (is_category() || is_archive() ) && $config['use_on_archive'] != 'on'  ){
			return $content;
		}
		
		// category / archive
		if( (is_home() ) && $config['use_on_frontpage'] != 'on'  ){
			return $content;
		}
	  
	  return "<span class=\"tip block_".sanitize_title( $word2replace )."\" >".$content."</span>"; 
}

?>