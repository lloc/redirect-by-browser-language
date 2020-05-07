<?php

/*
Plugin Name: Redirect by browser language
Plugin URI: https://www.freely.de/
Description: MVP for redirecting the user by the preferred browser language
Version: 0.1
Author: Dennis Ploetner
Author URI: http://lloc.de/
*/

add_action( 'init', function() {
	if ( is_front_page() ) {
		$options = [
			'sites'    => [
				'it' => 'https://www.freely.de/it/',
				'en' => 'https://www.freely.de/en/',
				'de' => 'https://www.freely.de/de/',
			],
			'language' => 'it',
		];

		$sites   = apply_filters( 'rbbl_active_sites', $options['sites'] );
		$default = apply_filters( 'rbbl_default_language', $options['language'] );

		$language = isset( $_SERVER['HTTP_ACCEPT_LANGUAGE'] ) ? Locale::acceptFromHttp( $_SERVER['HTTP_ACCEPT_LANGUAGE'] ) : $default;
		$redirect = $sites[ $language ] ?? $sites[ $default ];

		wp_redirect( $redirect, 307 );
		exit;
	}
} );
