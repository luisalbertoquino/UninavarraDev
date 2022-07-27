<?php
function js_css_register_certificate() {
	// Registro de Scripts
	wp_register_script('certificate-js', esc_url(plugins_url('public/js/certificate.js', __DIR__)));
    wp_register_script('download-js', esc_url(plugins_url('public/js/download.js', __DIR__)));

	// Registro de Estilos
	wp_register_style('certificate-css', esc_url(plugins_url('public/css/certificate.css', __DIR__)));
	wp_register_style('template-css', esc_url(plugins_url('public/css/template.css', __DIR__)));
}
add_action('init', 'js_css_register_certificate');

function my_shortcode_styles_certificate() {
	// Activacion de Estilos
    global $post;

    if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'certificate' ) ) {
		wp_enqueue_style( 'certificate-css' );
		wp_enqueue_style( 'template-css' );
	}
}
add_action( 'wp_enqueue_scripts', 'my_shortcode_styles_certificate' );
?>