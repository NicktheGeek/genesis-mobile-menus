<?php

/**
 * Add Navigation Select
 *
 * @author Jen Baumann
 * @since 1.0.0
 * @version 1.0.0
 */
 
add_action( 'wp_enqueue_scripts', 'gmm_enqueue_select_scripts' );
function gmm_enqueue_select_scripts() {
		wp_enqueue_script( 'gmm_select_script', GMM_LIB_URL . 'js/select.menu.js' , array( 'jquery' ), '0.1', true );
}
 
function gmm_select_menu( $menu_position ){
	switch( $menu_position ){
		case 'gmm_primary' :
			add_filter( 'genesis_do_nav'   , 'gmm_do_mobile_select_nav', 99 , 3);
			if( ! genesis_get_option( 'gmm_fail_safe' ) ) 
				add_filter( 'genesis_do_subnav', '__return_false', 99 );
			
			break;
		case 'gmm_secondary' :
			add_filter( 'genesis_do_subnav', 'gmm_do_mobile_select_subnav', 99, 3 );
			if( ! genesis_get_option( 'gmm_fail_safe' ) ) 
				add_filter( 'genesis_do_nav'   , '__return_false', 99 );
			
			break;
	}
	
}


function gmm_do_mobile_select_nav( $nav_output, $nav, $args ) {
	remove_filter( 'genesis_nav_items', 'genesis_nav_right', 10, 2 );
	remove_filter( 'wp_nav_menu_items', 'genesis_nav_right', 10, 2 );	

	$args = array(
		'theme_location' => 'gmm-mobile-menu',				
		'container'      => '', 
		'menu_class'     => 'menu mobile',
		'walker'         => new Walker_Nav_Select_Menu(),
		'items_wrap'     => sprintf( '<select class="gmm-mobile-select gmm-menu gmm-select" name="gmm-mobile-select"><option class="gmm-nav-text" value="">%s</option>%s</select>', __( 'Primary Navigation', 'gmm' ), '%3$s' ),				
		'echo' => 0
	);
	
	$mobile_nav = wp_nav_menu( $args );
	//$mobile_nav  = sprintf ( '<div class="gmm-menu select-mobile">%s</div>', $mobile_menu );
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
		'walker'         => new Walker_Nav_Select_Menu(),
		'items_wrap'     => sprintf( '<select class="gmm-mobile-select gmm-menu gmm-select" name="gmm-mobile-select"><option class="gmm-nav-text" value="">%s</option>%s</select>', __( 'Primary Navigation', 'gmm' ), '%3$s' ),				
		'echo' => 0
	);
	
	$mobile_nav = wp_nav_menu( $args );
	//$mobile_nav  = sprintf ( '<div class="gmm-menu select-mobile">%s</div>', $mobile_menu );
	$nav         = genesis_get_option( 'gmm_fail_safe' ) ? $nav : '';
	$pattern     = genesis_markup( '<nav class="secondary">%3$s%2$s%1$s%4$s</nav>', '<div id="subnav">%3$s%2$s%1$s%4$s</div>', 0 );
	
	return sprintf( $pattern, $nav, $mobile_nav, genesis_structural_wrap( 'nav', 'open', 0 ), genesis_structural_wrap( 'nav', 'close', 0 ) );
}


class Walker_Nav_Select_Menu extends Walker_Nav_Menu {	

	var $to_depth = -1;
    function start_lvl(&$output, $depth){
      $output .= '</option>';
    }
	
    function end_lvl( &$output, $depth ){
      $indent = str_repeat( "\t", $depth ); // don't output children closing tag
	}

    function start_el(&$output, $item, $depth, $args){				
		
		$indent = ( $depth ) ? str_repeat( " &mdash; ", $depth * 1 ) : '';	
		
		$selected ='';
		$class_names = $value = '';	

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;			
		
		if( $item->menu_item_parent==0 )
			$classes[] = 'top-level-parent';

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

		$class_names = ' class="' . esc_attr( $class_names ) . '"';	
		
		if( ! is_front_page() )
		$selected = in_array( 'current-menu-item', $classes ) ? ' selected="selected"' : '';
		
		$value = ' value="'. $item->url .'"';		

		$output .= '<option'.$value.$class_names.$selected.'>';	

		$item_output = $args->before;
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;		

		$output .= $indent.$item_output;
    }

    function end_el(&$output, $item, $depth){
		if(substr($output, -9) != '</option>')
      		$output .= "</option>"; // replace closing </li> with the option tag
    }
}