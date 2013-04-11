<?php

/*
  Plugin Name: Genesis Mobile Menu Beta
  Plugin URI: http://DesignsByNicktheGeek.com
  Version: 0.1
  Author: Nick_theGeek
  Author URI: http://DesignsByNicktheGeek.com
  Description: Add mobile menu to Genesis child themes
 */

/*
 * To Do:
 *      Create and setup screen shots
 */

/** Load textdomain for translation */
load_plugin_textdomain( 'gmm', false, basename( dirname( __FILE__ ) ) . '/languages/' );

define( 'GMM_LIB_DIR', dirname( __FILE__ ) . '/lib/' );
define( 'GMM_LIB_URL', plugins_url( '/lib/', __FILE__ ) );


/* Prevent direct access to the plugin */
if ( !defined( 'ABSPATH' ) ) {
    wp_die( __( "Sorry, you are not allowed to access this page directly.", 'gmm' ) );
}

register_activation_hook( __FILE__, 'gmm_activation_check' );

/**
 * Checks for minimum Genesis Theme version before allowing plugin to activate
 *
 * @author Nathan Rice
 * @uses gnma_truncate()
 * @since 0.1
 * @version 0.2
 */
function gmm_activation_check() {

    $latest = '1.9';

    $theme_info = get_theme_data( TEMPLATEPATH . '/style.css' );

    if ( basename( TEMPLATEPATH ) != 'genesis' ) {
        deactivate_plugins( plugin_basename( __FILE__ ) ); // Deactivate ourself
        wp_die( sprintf( __( 'Sorry, you can\'t activate unless you have installed %1$sGenesis%2$s', 'gmm' ), '<a href="http://designsbynickthegeek.com/go/genesis">', '</a>' ) );
    }

    $version = gmm_truncate( $theme_info['Version'], 3 );

    if ( version_compare( $version, $latest, '<' ) ) {
        deactivate_plugins( plugin_basename( __FILE__ ) ); // Deactivate ourself
        wp_die( sprintf( __( 'Sorry, you can\'t activate without %1$sGenesis %2$s%3$s or greater', 'gmm' ), '<a href="http://designsbynickthegeek.com/go/genesis">', $latest, '</a>' ) );
    }
}

/**
 *
 * Used to cutoff a string to a set length if it exceeds the specified length
 *
 * @author Nick Croft
 * @since 0.1
 * @version 0.2
 * @param string $str Any string that might need to be shortened
 * @param string $length Any whole integer
 * @return string
 */
function gmm_truncate( $str, $length=10 ) {

    if ( strlen( $str ) > $length ) {
        return substr( $str, 0, $length );
    } else {
        $res = $str;
    }

    return $res;
}

add_action( 'genesis_init', 'gnma_init', 15 );
/** Loads required files when needed */
function gnma_init() {

    if ( is_admin ( ) )
        require_once( GMM_LIB_DIR . 'admin.php');

    else
        require_once( GMM_LIB_DIR . 'structure.php');
        
    register_nav_menus(
    	array( 'gmm-mobile-menu' => __( 'Mobile Menu', 'gmm' ) )
    );

}
