// JavaScript Document
var doctor;
var badgeLocation="left";

function doctorBadgeShortcodeDoctor(e)
{
	doctor = e.target.value;
	createDoctorBadgeShortcode();
}

function doctorBadgeShortcodeLocation(e)
{
	badgeLocation = e.target.value;
	createDoctorBadgeShortcode();
}

function createDoctorBadgeShortcode()
{
	document.getElementById("doctor_shortcode").value = '[mdidentity-doctor-badge doctor-id="' + doctor + '" location="' + badgeLocation + '"]';
}

var readReviewsDoctor;
var readReviewsLocation;

function readShortcodeDoctor(e)
{
	readReviewsDoctor = e.target.value;
	createReadReviewsShortcode();
}

function readShortcodeLocation(e)
{
	readReviewsLocation = e.target.value;
	createReadReviewsShortcode();
}

function createReadReviewsShortcode()
{
	document.getElementById("read_reviews_shortcode").value = '[mdidentity-read-reviews doctor-id="' + readReviewsDoctor + '" location_id="' + readReviewsLocation + '"]';
}