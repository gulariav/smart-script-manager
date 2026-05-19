<?php

if (! defined('ABSPATH')) {
    exit;
}

/**
 * Return the current singular object id when available.
 *
 * @return int
 */
function ssm_get_current_object_id() {
    $object_id = get_queried_object_id();

    return $object_id ? (int) $object_id : 0;
}

/**
 * Determine whether global scripts are disabled for the current singular item.
 *
 * @return bool
 */
function ssm_should_disable_global() {
    if (! is_singular()) {
        return false;
    }

    $post_id = ssm_get_current_object_id();

    if (! $post_id) {
        return false;
    }

    return '1' === (string) get_post_meta($post_id, '_ssm_disable_global', true);
}

/**
 * Build a readable label for the output location.
 *
 * @param string $location Script location.
 * @return string
 */
function ssm_get_location_label($location) {
    $labels = array(
        'header' => 'Header',
        'body'   => 'Body',
        'footer' => 'Footer',
    );

    return isset($labels[$location]) ? $labels[$location] : ucfirst($location);
}

/**
 * Echo a stored script block if it is not empty.
 *
 * @param string $content Script content.
 * @param string $location Script location.
 * @param string $scope Global or page-level scope label.
 * @return void
 */
function ssm_echo_script_block($content, $location, $scope) {
    $content = trim((string) $content);

    if ($content === '') {
        return;
    }

    $label = sprintf(
        'Smart Script Manager: %s %s Scripts',
        trim((string) $scope),
        ssm_get_location_label($location)
    );

    echo "\n<!-- " . esc_html($label) . " -->\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    echo $content . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    echo "<!-- /" . esc_html($label) . " -->\n\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Output scripts for the requested location.
 *
 * @param string $location header, body, or footer.
 * @return void
 */
function ssm_output_scripts($location) {
    $option_keys = ssm_get_option_keys();

    if (! isset($option_keys[$location])) {
        return;
    }

    if (! ssm_should_disable_global()) {
        ssm_echo_script_block(get_option($option_keys[$location], ''), $location, 'Global');
    }

    if (! is_singular()) {
        return;
    }

    $post_id = ssm_get_current_object_id();

    if (! $post_id) {
        return;
    }

    ssm_echo_script_block(get_post_meta($post_id, '_ssm_' . $location, true), $location, 'Page');
}

/**
 * Output header snippets.
 *
 * @return void
 */
function ssm_output_header_scripts() {
    ssm_output_scripts('header');
}

add_action('wp_head', 'ssm_output_header_scripts', 1);

/**
 * Output body snippets.
 *
 * @return void
 */
function ssm_output_body_scripts() {
    ssm_output_scripts('body');
}

add_action('wp_body_open', 'ssm_output_body_scripts', 999);

/**
 * Output footer snippets.
 *
 * @return void
 */
function ssm_output_footer_scripts() {
    ssm_output_scripts('footer');
}

add_action('wp_footer', 'ssm_output_footer_scripts', 999);
