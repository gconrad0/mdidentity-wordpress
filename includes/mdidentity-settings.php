<?php
/**/

function mdidentity_settings() {


	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( 'You do not have sufficient permissions to access this page.' );
	}


	// If no API Key value found in DB, only display API Key field.
	//Need to check API key is valid
	if ( ! get_option( 'api_key' ) ) {
		echo ' <div class="wrap">
		<h1>Please enter your API Key</h1>
		<form method="post" action="options.php">';

		settings_fields( 'mdidentity-settings' );
		do_settings_sections( 'mdidentity-settings' );

		echo '
			 <table class="form-table">
				<tr>
					<th scope="row"><label for="api_key">API Key</label></th>
					<td>
						<input name="api_key" class="regular-text" type="text" id="api_key" required value="' . esc_attr( get_site_option( 'api_key' ) ) . '" />
						<p class="description">Your API key can be found on your MDidentity practice profile page.</p>
					</td>
				</tr>
			</table>';
		submit_button( 'Save API Key' );
		echo '
</form>
	</div>';
	}


	// Here is where you could start displaying the HTML needed for the settings
	// page, or you could include a file that handles the HTML output for you.

	// If API Key value exists in DB, display the rest of the setting fields
	//Need to verify response from api key before moving on
	else {
		echo '<div class="wrap">
		<h1>General</h1>
		<form method="post" action="options.php">';

		settings_fields( 'mdidentity-settings' );
		do_settings_sections( 'mdidentity-settings' );

		// Default value for star_color
		if ( ! get_option( 'showcase_star_color' ) ) {
			$default_star_color = '#FFBE00'; // new default star color
		} else {
			$default_star_color = get_option( 'showcase_star_color' );
		}

		//working on defaults with wp_parse_args
		/*
		$defaults = array(
			'default1' => '1',
			'default2' => '2',
		);
		$options = wp_parse_args(get_option('plugin_options'), $defaults);
*/

		echo '
			<table class="form-table">
				<tr>
					<th scope="row"><label for="api_key">API Key</label></th>
					<td>
						<input name="api_key" class="regular-text" type="text" id="api_key" value="' . esc_attr( get_option( 'api_key', true ) ) . '" />
						<p class="description">Your API key can be found on your MDidentity practice profile page.</p>
					</td>
				</tr>
			</table>
			<hr>
			<h1>Showcase</h1>
			<table class="form-table">
				
				<tr>
					<th scope="row"><label for="showcase_star_color">Star Color</label></th>
					<td>
						<input type="color" name="showcase_star_color" id="showcase_star_color" value="' . esc_attr__( $default_star_color ) . '" />
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="showcase_max_char">Max Character Count</label></th>
					<td>
						<input name="showcase_max_char" class="regular-text" type="text" id="showcase_max_char" value="' . esc_attr( get_option( 'showcase_max_char' ) ) . '" />
						<p class="description">Set how many characters before appending "..." to the review.</p>
					</td>
				</tr>
				<tr>
					<th scope="row">HIPAA Compliant?</th>
					<td><label><input id="showcase_hipaa_compliant" name="showcase_hipaa_compliant" type="checkbox" value="yes" ' . checked( 'yes', get_option( 'showcase_hipaa_compliant' ), false ) . '> Yes, suppress reviewers name</label></td>
				</tr>
				<tr>
					<th scope="row"><label for="showcase_max_char">Time to Display</label></th>
					<td>
						<input name="showcase_display_length" class="regular-text" type="text" id="showcase_display_length" value="' . esc_attr( get_option( 'showcase_display_length' ) ) . '" />
						<p class="description">How long should a review display in milliseconds.</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="showcase_max_char">Transition Speed</label></th>
					<td>
						<input name="showcase_display_trans_speed" class="regular-text" type="text" id="showcase_display_trans_speed" value="' . esc_attr( get_option( 'showcase_display_trans_speed' ) ) . '" />
						<p class="description">Speed of transtion in milliseconds.</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="showcase_max_char">Custom CSS</label></th>
					<td>
						<textarea rows="5" cols="100" name="showcase_css" class="regular-text" type="text" id="showcase_css">' . esc_attr( get_option( 'showcase_css' ) ) . '</textarea>
						<p class="description">Extend the MDidentity showcase widget with your own CSS.</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="showcase_shortcode">Showcase Shortcode</label></th>
					<td>
						<input name="showcase_shortcode" class="regular-text" type="text" id="showcase_shortcode" value="[mdidentity-showcase]" readonly>
					</td>
				</tr>
			</table>';

		submit_button();

		echo '</form>
	</div>';
	}
}

?>
