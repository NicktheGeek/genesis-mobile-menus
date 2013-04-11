<?php

/*
 * Creates mobile menu output.
 *
 * todo: 
 *	create select walker
 *	create collapsable (twitter bootstrap type) menu
 *	create alternate menu to replace primary nav menu with no dropdown support
 *	create CSS/JS only fail safe option
 */

/** checks to see if the jetpack mobile function is availabel then returns that response, otherwise returns the wp_is_mobile() response */
function gmm_is_mobile() {
	if( function_exists('jetpack_is_mobile') )
		return jetpack_is_mobile();
	
	return wp_is_mobile();
	
}

add_action( 'template_redirect', 'gmm_maybe_load_menu' );
function gmm_maybe_load_menu() {
	if( ! gmm_is_mobile() && ! genesis_get_option( 'gmm_fail_safe' ) )
		return;
		
	$menu_position = apply_filters( 'gmm_menu_position', genesis_get_option( 'gmm_menu_position' ) );
	$menu_type = apply_filters( 'gmm_menu_type', genesis_get_option( 'gmm_menu_type' ) );
	
	switch( $menu_type ) {
		case 'gmm_select' :
			require_once( GMM_LIB_DIR . 'menus/select-menu.php' );
			gmm_select_menu( $menu_position );
			
			break;
		case 'gmm_collapse' :
			require_once( GMM_LIB_DIR . 'menus/collapse-menu.php' );
			gmm_collapse_menu( $menu_position );
			
			break;
		case 'gmm_alternate' :
			require_once( GMM_LIB_DIR . 'menus/alternate-menu.php' );
			gmm_alternate_menu( $menu_position );
			
			break;
	}
	
}

add_action( 'wp_enqueue_scripts', 'gmm_maybe_enqueue_fail_safe' );
function gmm_maybe_enqueue_fail_safe() {
	wp_enqueue_style( 'gmm_style', GMM_LIB_URL . 'css/gmm-menu.css' , array(), '0.1', 'screen' );
}