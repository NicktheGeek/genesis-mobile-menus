<?php

/**
 * Add Navigation Select
 *
 * @author Nick Croft
 * @since 1.0.0
 * @version 1.0.0
 */
 
 add_action( 'wp_enqueue_scripts', 'gmm_enqueue_select_scripts' );
function gmm_enqueue_select_scripts() {
		wp_enqueue_script( 'gmm_collapse_script', GMM_LIB_URL . 'js/nav.toggle.js' , array( 'jquery' ), '0.1', true );
		
		$translation_array = array( 
			'show_text' => __( 'Show Menu' ), 
			'hide_text' => __( 'Hide Menu' )
		);
		
		wp_localize_script( 'gmm_collapse_script', 'gmm_text', $translation_array );


}

 
function gmm_collapse_menu( $menu_position ){
	switch( $menu_position ){
		case 'gmm_primary' :
			add_filter( 'genesis_do_nav'   , 'gmm_do_mobile_collapse_nav', 99 , 3 );
			if( ! genesis_get_option( 'gmm_fail_safe' ) ) 
				add_filter( 'genesis_do_subnav', '__return_false', 99 );
			
			break;
		case 'gmm_secondary' :
			add_filter( 'genesis_do_subnav', 'gmm_do_mobile_collapse_subnav', 99, 3 );
			if( ! genesis_get_option( 'gmm_fail_safe' ) ) 
				add_filter( 'genesis_do_nav'   , '__return_false', 99 );
			
			break;
	}
	
}


function gmm_do_mobile_collapse_nav( $nav_output, $nav, $args ) {	

	$args = array(
		'theme_location' => 'gmm-mobile-menu',	
		'container'      => '', 
		'menu_class'     => 'menu menu-primary genesis-nav-menu gmm-collapse-menu',			
		'echo' => 0
	);
	
	$mobile_menu = wp_nav_menu( $args );
	$mobile_nav  = sprintf ( '<div id="gmm-menu-toggle" class="menu-toggle primary-menu-toggle gmm-menu"><a class="toggle-switch show" href="#"><span>%s</span></a>%s</div>', __( 'Show Menu', 'fluid' ), $mobile_menu );
	$nav         = genesis_get_option( 'gmm_fail_safe' ) ? $nav : '';
	$pattern     = genesis_markup( '<nav class="primary">%3$s%2$s%1$s%4$s</nav>', '<div id="nav">%3$s%2$s%1$s%4$s</div>', 0 );
	
	return sprintf( $pattern, $nav, $mobile_nav, genesis_structural_wrap( 'nav', 'open', 0 ), genesis_structural_wrap( 'nav', 'close', 0 ) );

}

/**
 * Add Secondary Navigation Select
 *
 * @author Jen Baumann
 * @since 1.0.0
 * @version 1.0.0
 */
function gmm_do_mobile_collapse_subnav() {
	
	$args = array(
		'theme_location' => 'gmm-mobile-menu',	
		'container'      => '', 
		'menu_class'     => 'menu menu-secondary genesis-nav-menu gmm-collapse-menu',			
		'echo' => 0
	);
	
	$mobile_menu = wp_nav_menu( $args );
	$mobile_nav  = sprintf ( '<div id="gmm-menu-toggle" class="menu-toggle secondary-menu-toggle gmm-menu"><a class="toggle-switch show" href="#"><span>%s</span></a>%s</div>', __( 'Show Menu', 'fluid' ), $mobile_menu );
	$nav         = genesis_get_option( 'gmm_fail_safe' ) ? $nav : '';
	$pattern     = genesis_markup( '<nav class="secondary">%3$s%2$s%1$s%4$s</nav>', '<div id="subnav">%3$s%2$s%1$s%4$s</div>', 0 );
	
	return sprintf( $pattern, $nav, $mobile_nav, genesis_structural_wrap( 'nav', 'open', 0 ), genesis_structural_wrap( 'nav', 'close', 0 ) );
}

