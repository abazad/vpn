<?php
/**
 * Used to set up and fix common variables and include
 * the WordPress procedural and class library.
 *
 * Allows for some configuration in wp-config.php (see default-constants.php)
 *
 * @internal This file must be parsable by PHP4.
 *
 * @package WordPress
 */

/**
 * Stores the location of the WordPress directory of functions, classes, and core content.
 *
 * @since 1.0.0
 */
define( 'WPINC', 'library' );

// Include files required for initialization.


require( ABSPATH . WPINC . '/class-wp-error.php' );
require( ABSPATH . WPINC . '/plugin.php' );
require( ABSPATH . WPINC . '/pluggable.php' );

// require( ABSPATH . WPINC . '/general-template.php' );
