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
		if ( ! get_option( 'star_color' ) ) {
			$default_star_color = '#ffff01'; // new default star color
		} else {
			$default_star_color = get_option( 'star_color' );
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
					<th scope="row"><label for="star_color">Star Color</label></th>
					<td>
						<input type="color" name="star_color" id="star_color" value="' . esc_attr__( $default_star_color ) . '" />
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="showcase_max_char">Max Character Count</label></th>
					<td>
						<input name="showcase_max_char" class="regular-text" type="number" id="showcase_max_char" value="' . esc_attr( get_option( 'showcase_max_char' ) ) . '" />
						<p class="description">How many characters before appending "..." to the comment.</p>
					</td>
				</tr>
				<tr>
					<th scope="row">HIPAA Compliant?</th>
					<td><label><input id="showcase_hipaa_compliant" name="showcase_hipaa_compliant" type="checkbox" value="yes" ' . checked( 'yes', get_option( 'showcase_hipaa_compliant' ), false ) . '> Yes, suppress reviewers name</label></td>
				</tr>
			</table>';

		submit_button();

		echo '</form>
	</div>';
	}
}

?>
