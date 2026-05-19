<?php

if (! defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue admin assets for plugin pages and editor screens.
 *
 * @param string $hook_suffix Current admin page hook.
 * @return void
 */
function ssm_enqueue_admin_assets($hook_suffix) {
    $screen = function_exists('get_current_screen') ? get_current_screen() : null;

    if ($hook_suffix === 'settings_page_smart-script-manager' || ($screen && in_array($screen->post_type, ssm_get_supported_post_types(), true))) {
        wp_enqueue_style(
            'ssm-admin',
            SSM_URL . 'assets/admin.css',
            array(),
            SSM_VERSION
        );

        wp_enqueue_script(
            'ssm-admin',
            SSM_URL . 'assets/admin.js',
            array(),
            SSM_VERSION,
            true
        );
    }
}

add_action('admin_enqueue_scripts', 'ssm_enqueue_admin_assets');
