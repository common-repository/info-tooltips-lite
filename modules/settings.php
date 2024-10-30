<?php 
	
add_action('admin_menu', 'ta_item_menu');

function ta_item_menu() {
	add_submenu_page( 'edit.php?post_type=single_data', __('Settings' ,'ta_domain'), __('Settings' ,'ta_domain'), 'edit_published_posts', 'ta_config', 'ta_config');
}

function ta_config(){

?>
<div class="wrap">
<h2><?php _e('Settings' ,'ta_domain'); ?></h2>

 <?php if( ($_POST['posted'] == 1) && (is_admin() ) && wp_verify_nonce($_POST['_wpnonce']) ): ?>
  <div id="message" class="updated" > <?php _e('Settings saved successfully' ,'ta_domain'); ?> </div>
  
  <?php 
  
  
  $ta_options = array(

  'use_on_frontpage' =>  $_POST['use_on_frontpage'],
  'use_on_archive' =>  $_POST['use_on_archive'],
  'use_on_single' =>  $_POST['use_on_single'],
  );
  update_option('ta_options', $ta_options );

  ?>
  
  
  <?php else:  ?>
  
  <?php //exit; ?>
  
  <?php endif; ?> 
<form method="post" action="">
<?php wp_nonce_field();  
$config = get_option('ta_options'); 


?>  
<table class="form-table">
   
	<tr valign="top">
      <th scope="row"><?php _e('Where to use tooltip functionality ?' ,'ta_domain'); ?> </th>
      <td>
		<?php _e('Frontpage' ,'ta_domain'); ?>
		<div class="field switch marg_c">
			<label class="cb-enable  <?php if( $config['use_on_frontpage'] == 'on' ) echo ' selected '; ?>"><span><?php _e('On' ,'ta_domain'); ?></span></label>
			<label class="cb-disable <?php if( $config['use_on_frontpage'] != 'on' ) echo ' selected '; ?>"><span><?php _e('Off' ,'ta_domain'); ?></span></label>
			<input type="checkbox"  class="hidden checkbox" name="use_on_frontpage" value="on" <?php if( $config['use_on_frontpage'] == 'on' ) echo ' checked '; ?>  />
			<div class="clearfix"></div>
		</div>
		
		<?php _e('Archive' ,'ta_domain'); ?>
		<div class="field switch marg_c">
			<label class="cb-enable  <?php if( $config['use_on_archive'] == 'on' ) echo ' selected '; ?>"><span><?php _e('On' ,'ta_domain'); ?></span></label>
			<label class="cb-disable <?php if( $config['use_on_archive'] != 'on' ) echo ' selected '; ?>"><span><?php _e('Off' ,'ta_domain'); ?></span></label>
			<input type="checkbox"  class="hidden checkbox" name="use_on_archive" value="on" <?php if( $config['use_on_archive'] == 'on' ) echo ' checked '; ?>  />
			<div class="clearfix"></div>
		</div>
		
		<?php _e('Single Post' ,'ta_domain'); ?>
		<div class="field switch marg_c">
			<label class="cb-enable  <?php if( $config['use_on_single'] == 'on' ) echo ' selected '; ?>"><span><?php _e('On' ,'ta_domain'); ?></span></label>
			<label class="cb-disable <?php if( $config['use_on_single'] != 'on' ) echo ' selected '; ?>"><span><?php _e('Off' ,'ta_domain'); ?></span></label>
			<input type="checkbox"  class="hidden checkbox" name="use_on_single" value="on" <?php if( $config['use_on_single'] == 'on' ) echo ' checked '; ?>  />
			<div class="clearfix"></div>
		</div>
		
      </td>
    </tr>
	
    
	
	

</table>

<input type="hidden" value="1" name="posted" />
<input type="Submit" value="<?php _e('Save' ,'ta_domain'); ?>" class="button-secondary" />
</form>
  
</div>


<?php 
}
?>