<?php
/**/

function mdidentity_settings () {
	if (!current_user_can('manage_options')) {
		wp_die('You do not have sufficient permissions to access this page.');
	}

	// Here is where you could start displaying the HTML needed for the settings
	// page, or you could include a file that handles the HTML output for you.
	echo '
		<script src="' . plugins_url() . '/mdidentity/js/shortcodeBuilder.js"></script>
		<style src="' . plugins_url() . '/mdidentity/css/settingsStyles.css"></style>
		<div class="wrap">
		<h1>General</h1>
		<form method="post" action="options.php">';

	settings_fields( 'mdidentity-settings' );
	do_settings_sections( 'mdidentity-settings' );

	echo '
			<table class="form-table" width="800px">
				<tr>
					<th scope="row"><label for="api_key">API Key</label></th>
					<td>
						<input name="api_key" class="regular-text" type="text" id="api_key" value="' . esc_attr( get_site_option( 'api_key') ) . '" />
						<p class="description">Your API key can be found on your MDidentity practice profile page.</p>
					</td>
				</tr>
				<tr>
					<th></th>
					<td>';
	echo submit_button();
	echo '</td>
				</tr>
			</table>
			
			<h1>Showcase</h1>
			<table class="form-table">
				
				<tr>
					<th scope="row"><label for="star_color">Star Color</label></th>
					<td>
						<input type="color" name="star_color" id="star_color" value="#FFBE00" />
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="showcase_max_char">Max Character Count</label></th>
					<td>
						<input name="showcase_max_char" class="regular-text" type="text" id="max_char" value="' . esc_attr( get_site_option( 'showcase_max_char') ) . '" />
						<p class="description">How many characters before appending "..." to the comment.</p>
					</td>
				</tr>
				<tr>
					<th scope="row">HIPAA Compliant?</th>
					<td><label><input name="showcase_hipaa_compliant" type="checkbox" value="yes" ' . checked('yes', get_site_option( 'showcase_hipaa_compliant'), false ) . '> Yes, suppress reviewers name</label></td>
				</tr>
				<tr>
					<th></th>
					<td>';
	echo submit_button();
	echo '</td>
				</tr>
			</table>
			
			<h1>Read Our Reviews</h1>
			<table class="form-table">
				<tr>
					<th scope="row"><label for="max_char">Max Character Count</label></th>
					<td>
						<input name="read_reviews_max_char" class="regular-text" type="text" id="max_char" value="' . esc_attr( get_site_option( 'read_reviews_max_char') ) . '" />
						<p class="description">How many characters before appending "..." to the comment.</p>
					</td>
				</tr>
				<tr>
					<th scope="row">HIPAA Compliant?</th>
					<td><label><input name="read_reviews_hipaa_compliant" type="checkbox" value="yes" ' . checked('yes', get_site_option( 'read_reviews_hipaa_compliant'), false ) . '> Yes, suppress reviewers name</label></td>
				</tr>
				<tr>
					<th scope="row"><label for="read_reviews_location">Badge Location</label></th>
					<td>
						<select name="read_reviews_location" onchange="readShortcodeLocation(event)">
							<option value="default">- Select Location -</option>
							<option value="1">Westbrook</option>
							<option value="2">Kennebunk</option>
						</select>
						<p class="description">What Location for the badge.</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="read_reviews_Doctor">Doctor</label></th>
					<td>
						<select name="read_reviews_Doctor" onchange="readShortcodeDoctor(event)">
							<option value="default">- Select Location -</option>
							<option value="883">Andrew Rost</option>
							<option value="636">Greg Conrad</option>
						</select>
						<p class="description">What Doctor for the badge.</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="api_key">Read Reviews Shortcode</label></th>
					<td>
						<input name="read_reviews_shortcode" class="regular-text" type="text" id="read_reviews_shortcode" value="" readonly />
						<p class="description">The read reviews shortcode.</p>
					</td>
				</tr>
			</table>
			
			<h1>Doctor Badge</h1>
			<table class="form-table">
				<tr>
					<th scope="row"><label for="badge_location">Badge Location</label></th>
					<td>
						<select name="badge_location" onchange="doctorBadgeShortcodeLocation(event)">
							<option value="left">Left</option>
							<option value="right">Right</option>
						</select>
						<p class="description">Where to place the badge.</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="badge_doctor">Doctor</label></th>
					<td>
						<select name="badge_doctor" onchange="doctorBadgeShortcodeDoctor(event)">
							<option value="default">- Select Location -</option>
							<option value="883">Andrew Rost</option>
							<option value="636">Greg Conrad</option>
						</select>
						<p class="description">What Doctor for the badge.</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="api_key">Doctor Badge Shortcode</label></th>
					<td>
						<input name="doctor_shortcode" class="regular-text" type="text" id="doctor_shortcode" value="" readonly />
						<p class="description">The doctor badge shortcode for the selected doctor.</p>
					</td>
				</tr>
			</table>
		</form>
	</div>';
}

?>