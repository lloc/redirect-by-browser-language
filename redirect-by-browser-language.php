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
			'sites' => [
				'it' => 'https://www.freely.de/it/',
				'en' => 'https://www.freely.de/en/',
				'de' => 'https://www.freely.de/de/',
			],
			'language' => 'it',
		];

		$default   = apply_filters( 'rbbl_default_language', $options['language'] );
		$languages = isset( $_SERVER['HTTP_ACCEPT_LANGUAGE'] ) ? explode( ',', $_SERVER['HTTP_ACCEPT_LANGUAGE'] ) : [];
		$sites     = apply_filters( 'rbbl_active_language', $options['sites'] );

		if ( ! empty( $languages ) ) {
			foreach ( $languages as $str ) {
				$str = substr( $str, 0, 2 );
				if ( isset( $sites[ $str ] ) ) {
					wp_redirect( $sites[ $str ], 307 );
					exit;
				}
			}
		}
	}

	wp_redirect( $sites[ $default ], 307 );
	exit;
} );
