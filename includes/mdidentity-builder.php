<?php
/**/

function mdidentity_showcase_create() {


	//Get options
	$star_color = get_option( 'star_color' );
	$api_key  = get_option( 'api_key' );
	$max_char = get_option( 'showcase_max_char' );
	$hippa    = get_option( 'showcase_hipaa_compliant' );

	//Strip # from $star_color
	$star_color_strip = substr( $star_color, 1 );

	//Because $hippa is a checkbox input we need to get a value 'no' if it is unchecked
	if ( ( $hippa == '' ) ) {
		$hipaa_value = 'no';
	} else {
		$hipaa_value = 'yes';
	}

	//build script
	$content = '<script src="https://www.mdidentity.com/widgets/js/v2.0/mdiReviewCarousel.js" name="mdidentity" carousel-type="showcase" client-id="' . $api_key . '" location-id="0" doctor-id="0" min-rate="4" star-color="' . $star_color_strip . '" hipaa="' . $hipaa_value . '" limit-char="yes" char-count="' . $max_char . '" include-blank="no" review-count="0" defer></script><div id="mdiCarouselModule"></div>';

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

?>