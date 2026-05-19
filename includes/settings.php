<?php

if (! defined('ABSPATH')) {
    exit;
}

/**
 * Return the supported global option keys.
 *
 * @return array<string, string>
 */
function ssm_get_option_keys() {
    return array(
        'header' => 'ssm_header_scripts',
        'body'   => 'ssm_body_scripts',
        'footer' => 'ssm_footer_scripts',
    );
}

/**
 * Persist raw snippets for trusted admins.
 *
 * GTM and similar snippets should not be KSES-sanitized because that can
 * remove required attributes or inline code.
 *
 * @param string $value Submitted option value.
 * @return string
 */
function ssm_sanitize_script_option($value) {
    if (! current_user_can('manage_options') || ! current_user_can('unfiltered_html')) {
        return '';
    }

    return wp_unslash((string) $value);
}

/**
 * Register plugin settings.
 *
 * @return void
 */
function ssm_register_settings() {
    foreach (ssm_get_option_keys() as $option_name) {
        register_setting(
            'ssm_settings_group',
            $option_name,
            array(
                'type'              => 'string',
                'sanitize_callback' => 'ssm_sanitize_script_option',
                'default'           => '',
            )
        );
    }
}

add_action('admin_init', 'ssm_register_settings');
