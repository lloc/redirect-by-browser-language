<?php

/*
Plugin Name: Redirect by browser language
Plugin URI: https://www.freely.de/
Description: MVP for redirecting the user by the preferred browser language
Version: 0.1
Author: Dennis Ploetner
Author URI: http://lloc.de/
*/

add_action( 'template_redirect', function() {
	if ( is_front_page() ) {
		$options = [
			'sites' => [
				'de' => 'https://www.freely.de/de/',
				'en' => 'https://www.freely.de/en/',
			],
			'default' => 'https://www.freely.de/it/',
		];

		$sites   = apply_filters( 'rbbl_sites', $options['sites'] );
		$default = apply_filters( 'rbbl_default', $options['default'] );

		$accepted = '';
		if ( isset( $_SERVER['HTTP_ACCEPT_LANGUAGE'] ) ) {
			$accepted = Locale::acceptFromHttp( $_SERVER['HTTP_ACCEPT_LANGUAGE'] );
		}

		$redirect = $sites[ $accepted ] ?? $default;

		wp_redirect( $redirect, 307 );
		exit;
	}
} );
