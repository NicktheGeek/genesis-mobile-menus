<?php
/*
 * Replaces the Menu Options in the Genesis Theme Settings
 */

add_filter( 'genesis_theme_settings_defaults', 'gmm_theme_settings_defaults' );

/** Sets Defaults for the New Menu Options */
function gmm_theme_settings_defaults( $defaults ) {
    $gmm_defaults = array(
        'gmm_menu' => '',
        'gmm_fail_safe' => 0,
    );

    $defaults = wp_parse_args( $defaults, $gmm_defaults );

    return $defaults;
}

add_action( 'admin_menu', 'gmm_theme_settings_init', 15 );

/**
 * This is a necessary go-between to get our scripts and boxes loaded
 * on the theme settings page only, and not the rest of the admin
 */
function gmm_theme_settings_init() {
    global $_genesis_admin_settings;
    
    add_action( 'load-' . $_genesis_admin_settings->pagehook, 'gmm_theme_settings_boxes', 20 );
}

function gmm_theme_settings_boxes() {
    global $_genesis_admin_settings;

    add_meta_box('gmm-theme-settings-nav', __('Mobile Menu', 'gmm'), 'gmm_theme_settings_box', $_genesis_admin_settings->pagehook, 'main', 'high' );
}

function gmm_theme_settings_box() {
?>
    <p><input type="checkbox" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[gmm_fail_safe]" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[gmm_fail_safe]" value="1" <?php checked( 1, genesis_get_option( 'gmm_fail_safe' ) ); ?> /> <label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[gmm_fail_safe]"><?php _e( "Use Fail Safe Mode?", 'gmm' ); ?></label>
    </p>

    <p><?php _e( "Mobile Menu Type", 'gmm' ); ?>
        <select name="<?php echo GENESIS_SETTINGS_FIELD; ?>[gmm_menu]" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[gmm_menu]">
        	<option value="" <?php selected( '', genesis_get_option( 'gmm_menu' ) ); ?>><?php _e( "Please Select Mobile Menu Type", 'gmm' ); ?></option>
            <option value="gmm_select" <?php selected( 'gmm_select', genesis_get_option( 'gmm_menu' ) ); ?>><?php _e( "Select Menu", 'gmm' ); ?></option>
            <option value="gmm_collapse" <?php selected( 'gmm_collapse', genesis_get_option( 'gmm_menu' ) ); ?>><?php _e( "Collapsed Menu", 'gmm' ); ?></option>
            <option value="gmm_alternate" <?php selected( 'gmm_alternate', genesis_get_option( 'gmm_menu' ) ); ?>><?php _e( "Alternate Menu", 'gmm' ); ?></option>
        </select>
    </p>
                    

<?php
}
