<?php 
		

add_action( 'add_meta_boxes', 'ta_add_custom_box' );
function ta_add_custom_box() {
	
		add_meta_box( 
			'ta_widget_properties',
			__( 'Word to apply', 'ta_domain' ),
			'ta_inner_custom_box',
			'single_data' , 'side'
		);
		
		$all_post_types = get_post_types();
		
		foreach( $all_post_types as $single_post ){
			if( $single_post == 'attachment' || $single_post == 'revision' || $single_post == 'nav_menu_item' || $single_post == 'single_data' ){
				continue;
			}
			add_meta_box( 
				'tg_post_word_selecter',
				__( 'Use Tooltips', 'ta_domain' ),
				'ta_words_selector',
				$single_post  , 'side'
			);
		}
		//$full_str =  implode( ',', $all_used_types ) ;
		
		//$post_type_string = "( ".$full_str." )";
		//var_dump( $post_type_string );
		

}
function ta_words_selector(){
	global $post;
	wp_nonce_field( plugin_basename( __FILE__ ), 'myplugin_noncename' );
	$all_words = get_posts('show_posts=-1&post_type=single_data');
	
	$all_words_arr = array();
	if( is_array( unserialize( get_post_meta( $post->ID, 'words2use', true ) ) ) ){
		$all_words_arr = unserialize( get_post_meta( $post->ID, 'words2use', true ) );
	}
	
	
	echo '
		<label>'.__( 'Use Replacement in this post', 'ta_domain' ).'</label>
		
		<div class="field switch marg_c">
			<label class="cb-enable  '.( get_post_meta( $post->ID, 'use_replacement' ,true ) == 'on' ? ' selected ' : '' ).'"><span>'.__( 'On', 'ta_domain' ).'</span></label>
			<label class="cb-disable '.( get_post_meta( $post->ID, 'use_replacement' ,true ) != 'on' ? ' selected ' : '' ).'"><span>'.__( 'Off', 'ta_domain' ).'</span></label>
			<input type="checkbox"  class="hidden checkbox" name="use_replacement" value="on" '.( get_post_meta( $post->ID, 'use_replacement' ,true ) == 'on' ? ' checked ' : '' ).'  />
			<div class="clearfix"></div>
		</div>
		<br/>
		<label>'.__( 'Select tooltips you want to use in this post', 'ta_domain' ).'</label>
		<select name="words2replace[]" multiple class="widefat">
		';
	foreach( $all_words as $single_word ){
	echo '<option value="'.$single_word->ID.'" '.( in_array( $single_word->ID, $all_words_arr ) ? ' selected ' : ' ' ).' >'.$single_word->post_title.'</option>';
	}
	echo '
		</select>
		<div class="widget_subtitle">'.__( 'All occurences of word will be replaced with tooltip. You can select more one word with pressing CTRL + click on tooltip', 'ta_domain' ).'</div>
	';
}
function ta_inner_custom_box( $post ) {
		
			
		wp_nonce_field( plugin_basename( __FILE__ ), 'myplugin_noncename' );	
		echo '
			
		
		<div class="single_label">'.__( 'Word (phrase) to apply', 'ta_domain' ).'</div>
		<input type="text" name="words2use" class="w_100" value="'.get_post_meta( $post->ID, 'words2use' ,true ).'" /> 
		<div class="widget_subtitle">'.__( 'This word (phrase) will be used to add tooltip (this field should be unique for all tooltips)', 'ta_domain' ).'</div>
		
		<div class="single_label">'.__( 'Block Width (px)', 'ta_domain' ).'</div>
		<input type="text" name="block_width" class="w_100"  value="'.( get_post_meta( $post->ID, 'block_width' ,true ) ? get_post_meta( $post->ID, 'block_width' ,true ) : '200' ).'" /> 
		<div class="widget_subtitle">'.__( 'Tooltip width', 'ta_domain' ).'</div>
		
		
		
		<input type="hidden" value="light" name="block_style"  />
		
		<input type="hidden"  class="hidden checkbox" name="use_shadow" value="on"  checked  />
		

		
		<div class="single_label">'.__('Show On', 'ta_domain').'</div>
		<input type="hidden" value="hover" name="show_action"  />

		
		
		<div class="single_label">'.__('Tooltiped word styling', 'ta_domain').'</div>
		<select name="tooltiped_styling" class="w_100" >
			<option value="bold" '.( get_post_meta( $post->ID, 'tooltiped_styling', true ) == 'bold' ? ' selected ' : ' ' ).' />Bold
			<option value="italic" '.( get_post_meta( $post->ID, 'tooltiped_styling', true ) == 'italic' ? ' selected ' : ' ' ).' />Italic
			<option value="underline_solid" '.( get_post_meta( $post->ID, 'tooltiped_styling', true ) == 'underline_solid' ? ' selected ' : ' ' ).' />Underline Solid
			<option value="underline_dotted" '.( get_post_meta( $post->ID, 'tooltiped_styling', true ) == 'underline_dotted' ? ' selected ' : ' ' ).' />Underline Dotted
			<option value="underline_dashed" '.( get_post_meta( $post->ID, 'tooltiped_styling', true ) == 'underline_dashed' ? ' selected ' : ' ' ).' />Underline Dashed
		</select>
		
		<div class="single_label">'.__('Advanced Word Styling', 'ta_domain').'</div> 
		<textarea name="add_styling" class="wide_text">'.( get_post_meta( $post->ID, 'add_styling' ,true ) ? stripslashes( get_post_meta( $post->ID, 'add_styling' ,true )) : 'border-color:#000;' ).'</textarea> 
		
		
		
		<div class="single_label">'.__('Tooltiped hover word styling', 'ta_domain').'</div>
		<select name="tooltiped_hover_styling" class="w_100" >
			<option value="bold" '.( get_post_meta( $post->ID, 'tooltiped_hover_styling', true ) == 'bold' ? ' selected ' : ' ' ).' />Bold
			<option value="italic" '.( get_post_meta( $post->ID, 'tooltiped_hover_styling', true ) == 'italic' ? ' selected ' : ' ' ).' />Italic
			<option value="underline_solid" '.( get_post_meta( $post->ID, 'tooltiped_hover_styling', true ) == 'underline_solid' ? ' selected ' : ' ' ).' />Underline Solid
			<option value="underline_dotted" '.( get_post_meta( $post->ID, 'tooltiped_hover_styling', true ) == 'underline_dotted' ? ' selected ' : ' ' ).' />Underline Dotted
			<option value="underline_dashed" '.( get_post_meta( $post->ID, 'tooltiped_hover_styling', true ) == 'underline_dashed' ? ' selected ' : ' ' ).' />Underline Dashed
		</select>
		
		<div class="single_label">'.__('Advanced Word Hover Styling', 'ta_domain').'</div> 
		<textarea name="add_hover_styling" class="wide_text">'.( get_post_meta( $post->ID, 'add_hover_styling' ,true ) ? stripslashes( get_post_meta( $post->ID, 'add_hover_styling' ,true )) : 'border-color:#000;' ).'</textarea> 
		
		
		<input type="hidden" value="top" name="block_position" />
	
		<input type="hidden"  name="use_round_corners" value="on"  checked   />
		 
		
		<input type="hidden"  class="hidden checkbox" name="show_tooltip_title" value="on"   />
		 
		<input type="hidden"  class="hidden checkbox" name="show_title_close" value="on"   />
		 
		';	
}

add_action( 'save_post', 'tg_save_postdata' );
function tg_save_postdata( $post_id ) {
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;
  if ( !wp_verify_nonce( $_POST['myplugin_noncename'], plugin_basename( __FILE__ ) ) )
      return;
  if ( 'page' == $_POST['post_type'] ) 
  {
    if ( !current_user_can( 'edit_page', $post_id ) )
        return;
  }
  else
  {
    if ( !current_user_can( 'edit_post', $post_id ) )
        return;
  }
  /// User editotions
  //var_dump( $_POST );
  if( get_post_type( $post_id ) == 'single_data' ){
	update_post_meta( $post_id, 'words2use', $_POST['words2use'] );
	update_post_meta( $post_id, 'block_width', $_POST['block_width'] );
	update_post_meta( $post_id, 'block_style', $_POST['block_style'] );
	update_post_meta( $post_id, 'use_shadow', $_POST['use_shadow'] );
	update_post_meta( $post_id, 'show_action', $_POST['show_action'] );
	update_post_meta( $post_id, 'add_styling', $_POST['add_styling'] );
	update_post_meta( $post_id, 'add_hover_styling', $_POST['add_hover_styling'] );
	
	update_post_meta( $post_id, 'block_position', $_POST['block_position'] );
	update_post_meta( $post_id, 'use_round_corners', $_POST['use_round_corners'] );
	
	update_post_meta( $post_id, 'show_title_close', $_POST['show_title_close'] );
	update_post_meta( $post_id, 'show_tooltip_title', $_POST['show_tooltip_title'] );
	
	update_post_meta( $post_id, 'tooltiped_styling', $_POST['tooltiped_styling'] );
	update_post_meta( $post_id, 'tooltiped_hover_styling', $_POST['tooltiped_hover_styling'] );
	
	
  }
  
		$all_post_types = get_post_types();
		foreach( $all_post_types as $single_post ){
			if( $single_post == 'attachment' || $single_post == 'revision' || $single_post == 'nav_menu_item' || $single_post == 'single_data' ){
				continue;
			}
			$all_used_types[] = $single_post;
		}

  if( in_array( get_post_type( $post_id ) , $all_used_types ) ){
	update_post_meta( $post_id, 'words2use', serialize($_POST['words2replace']) );
	update_post_meta( $post_id, 'use_replacement', $_POST['use_replacement'] );
	
  }
  
  
}

?>