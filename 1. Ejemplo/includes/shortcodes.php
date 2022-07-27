<?php
function certificate_shortcode() {
	wp_enqueue_script('certificate-js');
	wp_enqueue_script('download-js');
	require_once('certificate.php');
}
add_shortcode('certificate', 'certificate_shortcode');
?>