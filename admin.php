<?php
//Settings Page
add_action('admin_menu', 'tvpp_create_menu');

function tvpp_create_menu() {
	add_menu_page('The Video Popup Settings', 'Video Popup', 'administrator', __FILE__, 'tvpp_settings_page');
	add_action( 'admin_init', 'register_mysettings' );
}


function register_mysettings() {
	register_setting( 'tvpp-settings-group', 'new_option_name' );
	register_setting( 'tvpp-settings-group', 'some_other_option' );
	register_setting( 'tvpp-settings-group', 'option_etc' );
}


function tvpp_settings_page() {
?>
<div class="wrap">
<h2>The Video Popup Plugin</h2>

<form method="post" action="options.php">
		<?php settings_fields( 'tvpp-settings-group' ); ?>
		<?php do_settings_sections( 'tvpp-settings-group' ); ?>
		<table class="form-table">
				<tr valign="top">
				<th scope="row">Frame Height:</th>
				<td><input type="number" name="tvpp_height" value="<?php echo rtrim(get_option('tvpp_height'), 'px'); ?>" placeholder="325" />px</td>
				</tr>

				<tr valign="top">
				<th scope="row">Frame Width:</th>
				<td><input type="number" name="tvpp_width" value="<?php echo rtrim(get_option('tvpp_width'), 'px'); ?>" placeholder="420" />px</td>
				</tr>

				<tr valign="top">
				<th scope="row">YouTube URL: *</th>
				<td><input type="text" name="tvpp_video_url" value="<?php echo get_option('tvpp_video_url'); ?>" /></td>
				</tr>
		</table>

		<?php submit_button(); ?>

</form>
<p><i>Default height: '325px', width: '420px'</i></p>
</div>
<?php } ?>