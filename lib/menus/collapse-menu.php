<?php

/**
 * Add Navigation Select
 *
 * @author Nick Croft
 * @since 1.0.0
 * @version 1.0.0
 */
 
function gmm_collapse_menu( $menu_position ){
	switch( $menu_position ){
		case 'gmm_primary' :
			add_filter( 'genesis_do_nav'   , 'gmm_do_mobile_collapse_nav', 99 , 3 );
			add_filter( 'genesis_do_subnav', '_return_false'             , 99     );
			
			break;
		case 'gmm_secondary' :
			add_filter( 'genesis_do_subnav', 'gmm_do_mobile_collapse_subnav', 99, 3 );
			add_filter( 'genesis_do_nav'   , '_return_false'                , 99    );
			
			break;
	}
	
}


function gmm_do_mobile_collapse_nav( $nav_output, $nav, $args ) {	

	$args = array(
		'theme_location' => 'gmm-mobile-menu',	
		'container'      => '', 
		'menu_class'     => 'menu mobile',			
		'echo' => 0
	);
	
	$mobile_menu = wp_nav_menu( $args );
	$mobile_nav  = sprintf ( '<div class="gmm-menu gmm-collapse">%s</div>', $mobile_menu );
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
function gmm_do_mobile_select_subnav() {
	
	$args = array(
		'theme_location' => 'gmm-mobile-menu',	
		'container'      => '', 
		'menu_class'     => 'menu mobile',			
		'echo' => 0
	);
	
	$mobile_menu = wp_nav_menu( $args );
	$mobile_nav  = sprintf ( '<div class="gmm-menu gmm-collapse">%s</div>', $mobile_menu );
	$nav         = genesis_get_option( 'gmm_fail_safe' ) ? $nav : '';
	$pattern     = genesis_markup( '<nav class="secondary">%3$s%2$s%1$s%4$s</nav>', '<div id="subnav">%3$s%2$s%1$s%4$s</div>', 0 );
	
	return sprintf( $pattern, $nav, $mobile_nav, genesis_structural_wrap( 'nav', 'open', 0 ), genesis_structural_wrap( 'nav', 'close', 0 ) );
}

