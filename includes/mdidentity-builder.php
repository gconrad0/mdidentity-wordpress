<?php
/**
 * @return string
 */

function mdidentity_showcase_create() {

	//Get options
	$star_color = get_option( 'star_color' );
	$api_key  = get_option( 'api_key' );
	$max_char = get_option( 'showcase_max_char' );
	$hippa    = get_option( 'showcase_hipaa_compliant' );
	$showcase_css    = get_option( 'showcase_css' );

	//Strip # from $star_color
	$star_color_strip = substr( $star_color, 1 );

	//Because $hippa is a checkbox input we need to get a value 'no' if it is unchecked
	if ( $hippa == '' ) {
		$hipaa_value = 'no';
	} else {
		$hipaa_value = 'yes';
	}

	//build script
	$content = '<style>' . $showcase_css . '</style><script src="https://www.mdidentity.com/widgets/js/v2.0/mdiReviewShowcase.min.js" name="mdidentity" api-key="' . $api_key . '" star-color="' . $star_color_strip . '" hipaa-compliant="' . $hipaa_value . '" char-count="' . $max_char . '" defer></script><div id="mdiCarouselModule"></div>';

	return $content;
}

function mdidentity_read_reviews_create() {
	if ( isset( $_GET['page'] ) ) {
		$page = (int) $_GET['page'];
	} else {
		$page = 1;
	}

	$curl = curl_init();

	$url = 'https://v2.mdidentity.com/embedapi/v1/118?type=htmloutput&template=2&filter=true&page=' . $page . '';

	curl_setopt_array( $curl, array(
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL            => $url,
	) );

	$html_response = curl_exec( $curl );

	curl_close( $curl );

	return $html_response;
}

function mdidentity_doctor_badge_create() {
	return $content = '<script src="https://www.mdidentity.com/widgets/js/v2.0/mdiDoctorBadge.js" name="doctor-badge" client-id="118" doctor-id="883" hipaa="no" defer></script><div id="mdiReviewBadge"></div>';
}

add_shortcode( 'mdidentity-showcase', 'mdidentity_showcase_create' );
add_shortcode( 'mdidentity-read-reviews', 'mdidentity_read_reviews_create' );
add_shortcode( 'mdidentity-doctor-badge', 'mdidentity_doctor_badge_create' );

