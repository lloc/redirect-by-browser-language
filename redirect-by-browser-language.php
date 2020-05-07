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
				'en' => 'https://www.freely.de/en/',
				'de' => 'https://www.freely.de/de/',
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

		echo 'Sites: ', print_r( $sites, true );
		echo 'Default ', print_r( $default, true );
		echo 'Accepted ', print_r( $accepted, true );
		echo 'Redirect ', print_r( $redirect, true );

		die();

		wp_redirect( $redirect, 307 );
		exit;
	}
} );
