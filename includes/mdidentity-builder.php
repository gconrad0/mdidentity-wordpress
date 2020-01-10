<?php
/**/

function mdidentity_showcase_create () {
	return $content = '<script src="https://www.mdidentity.com/widgets/js/v2.0/mdiReviewCarousel.js" name="mdidentity" carousel-type="showcase" client-id="118" location-id="0" doctor-id="0" min-rate="4" star-color="FFBE00" hipaa="no" limit-char="yes" char-count="300" include-blank="no" review-count="0" defer></script><div id="mdiCarouselModule"></div>';
}

function mdidentity_read_reviews_create () {
	if (isset($_GET['page'])) {
		$page = (int)$_GET['page'];
	} else {
		$page = 1;
	}

	$curl = curl_init();

	$url = 'https://v2.mdidentity.com/embedapi/v1/118?type=htmloutput&template=2&filter=true&page=' . $page . '';

	curl_setopt_array($curl, array(
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => $url,
	));

	$html_response = curl_exec($curl);

	curl_close($curl);

	return $html_response;
}

function mdidentity_doctor_badge_create ($prefList) {
	return $content = '<script src="https://www.mdidentity.com/widgets/js/v2.0/mdiDoctorBadge.js" name="doctor-badge" client-id="118" doctor-id="' . $prefList[ 'doctor_id' ] . '" hipaa="no" defer></script><div id="mdiReviewBadge"></div>';
}

add_shortcode('mdidentity-showcase', 'mdidentity_showcase_create');
add_shortcode('mdidentity-read-reviews', 'mdidentity_read_reviews_create');
add_shortcode('mdidentity-doctor-badge', 'mdidentity_doctor_badge_create');

?>