<?php 

function replace_text_wps($text){
	global $post;
	$config = get_option('ta_options'); 
	
	// check if replacemont on this current post
	if( get_post_meta( $post->ID, 'use_replacement', true ) != 'on' ){
		return $text;
	}
	
	// check where to show from settings parameters SINGLE
	if( (is_single() || is_page() ) && $config['use_on_single'] != 'on'  ){
		return $text;
	}
	// category / archive
	if( (is_category() || is_archive() ) && $config['use_on_archive'] != 'on'  ){
		return $text;
	}
	
	// category / archive
	if( (is_home() ) && $config['use_on_frontpage'] != 'on'  ){
		return $text;
	}
	
	$this_post_words = unserialize( get_post_meta( $post->ID, 'words2use', true ) );
	
	if( $this_post_words )
	foreach( $this_post_words as $single_word_id ){
		
		$word2replace = get_post_meta( $single_word_id, 'words2use', true );
		
		//var_dump( $word2replace );
		
		$text = preg_replace( "/([\s,.!;]*)($word2replace)([\s,.!;]*)/i", "$1<span class=\"tip block_".sanitize_title( $word2replace )."\" >$2</span>$3", $text);
		
		// process position things
		//$text .= generate_hidden_content( $single_word_id );
		
	}

    return $text;
}

add_filter('the_content', 'replace_text_wps');
add_filter('the_excerpt', 'replace_text_wps');	



add_Action('wp_footer', 'ta_process_footer');
function ta_process_footer(){
	$all_posts = get_posts('showposts=-1&post_type=single_data');
	foreach( $all_posts as $single_block ){		
		echo generate_hidden_content( $single_block->ID );
	}
	
}

add_Action('admin_footer', 'ta_footer_injection');
function ta_footer_injection(){
global $post;
	
	if( get_post_type( $post->ID ) == 'single_data' ){
		echo '
		<script>
			jQuery("#publish").hide();
			jQuery("#publish").after(\'<input name="save" type="button" class="button button-primary button-large" id="publish_fake" accesskey="p" value="Update">\');
			jQuery("#publish_fake").click(function(){
				if( !jQuery("input[name=words2use]").val() ){
					alert(\''.__('Please, fill "Word (phrase) to apply" field! ', 'ta_domain').'\');
				}else{
					jQuery("#publish").click();
				}
			})
		</script>';
	}
}

add_action('admin_notices', 'showAdminMessages');  
function showAdminMessages()
{	
	global $post;
    if ( current_user_can('manage_options') && get_post_type( $post->ID ) == 'single_data' ) {
       showMessage("If you want to get flexible shortcode functionality - Get <a href='http://voodoopress.net/info_tooltips/'>Delux Version</a> !");
    }
}
function showMessage($message, $errormsg = false)
{
	if ($errormsg) {
		echo '<div id="message" class="error">';
	}
	else {
		echo '<div id="message" class="updated fade">';
	}

	echo "<p><strong>$message</strong></p></div>";
} 

?>