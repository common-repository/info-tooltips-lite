<?php 
	
function generate_hidden_content( $block_id ){

	$word2replace = get_post_meta( $block_id, 'words2use', true );
	$block_content = get_post( $block_id )->post_content;
	
	switch( get_post_meta( $block_id, 'block_position' ,true ) ){
			case 'top':
				$pos = "
				my: 'bottom center', // Use the corner...
				at: 'top center'
				";
			break;
			case 'top-right':
				$pos = "
				my: 'bottom left', // Use the corner...
				at: 'top right'
				";
			break;
			case 'right':
				$pos = "
				my: 'left center', // Use the corner...
				at: 'right center'
				";
			break;
			case 'right-bottom':
				$pos = "
				my: 'left top', // Use the corner...
				at: 'right bottom'
				";
			break;
			case 'bottom':
				$pos = "
				my: 'top center', // Use the corner...
				at: 'bottom center'
				";
			break;
			case 'bottom-left':
				$pos = "
				my: 'right top', // Use the corner...
				at: 'bottom left'
				";
			break;
			case 'left':
				$pos = "
				my: 'right center', // Use the corner...
				at: 'left center'
				";
			break;
			
			case 'top-left':
				$pos = "
				my: 'bottom right ', // Use the corner...
				at: 'top left '
				";
			break;
		
		}
		
		if( get_post_meta( $block_id, 'show_tooltip_title' ,true ) == 'on' ){
			$title_block = "
				title: {
						text: '".get_post( $block_id )->post_title."' , // Give the tooltip a title using each elements text
						".( get_post_meta( $block_id, 'show_title_close' ,true ) == 'on' ? ' button: true ' : '' )."
					}
			";
		}
		
		// process styling selectors
		switch( get_post_meta( $block_id, 'tooltiped_styling' ,true ) ){
			case "bold":
				$style_base = "font-weight:bold;";
			break;
			case "italic":
				$style_base = "font-style:italic;";
			break;
			case "underline_solid":
				$style_base = "border-bottom:1px solid #000;";
			break;
			case "underline_dotted":
				$style_base = "border-bottom:1px dotted #000;";
			break;
			case "underline_dashed":
				$style_base = "border-bottom:1px dashed #000;";
			break;
		}
		
		switch( get_post_meta( $block_id, 'tooltiped_hover_styling' ,true ) ){
			case "bold":
				$style_hover = "font-weight:bold;";
			break;
			case "italic":
				$style_hover = "font-style:italic;";
			break;
			case "underline_solid":
				$style_hover = "border-bottom:1px solid #000;";
			break;
			case "underline_dotted":
				$style_hover = "border-bottom:1px dotted #000;";
			break;
			case "underline_dashed":
				$style_hover = "border-bottom:1px dashed #000;";
			break;
		}
		
		
		$out = "		
		<div class='".sanitize_title( $word2replace )." hidden'>
			".nl2br( $block_content ) ."
		</div>
		
			<script>
			var data = jQuery('.".sanitize_title( $word2replace )."').html() ;
			jQuery('.block_".sanitize_title( $word2replace )."').qtip({
				content: {
					text: data,
					".$title_block."
				},
				style: {
					classes: '".( get_post_meta( $block_id, 'use_shadow' ,true ) == 'on' ? ' qtip-shadow ' : '' )." qtip-".get_post_meta( $block_id, 'block_style', true )." ".( get_post_meta( $block_id, 'use_round_corners' ,true ) == 'on' ? ' ui-tooltip-rounded ' : '' )."',
					width: ".get_post_meta( $block_id, 'block_width' ,true )." // Set a static width
				},
				effect: function() { jQuery(this).slideDown(100); }, // Show
				show: {
				event: ".( get_post_meta( $block_id, 'show_action' ,true ) ? "'".get_post_meta( $block_id, 'show_action' ,true )."'" : 'false' ).",
				solo: true
				},
				
				
				
				hide: {
					event: 'unfocus'
				},
				position: {
					".$pos."
				}
			});
			</script>
			<style>
			.block_".sanitize_title( $word2replace )."{
				".$style_base.";
				".stripslashes( get_post_meta( $block_id, 'add_styling' ,true ) ).";
			}
			.block_".sanitize_title( $word2replace ).":hover{
				".$style_hover.";
				".stripslashes( get_post_meta( $block_id, 'add_hover_styling' ,true ) ).";							
			}
			</style>
		";
		return $out;
}
	
?>