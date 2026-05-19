<?php

if (! defined('ABSPATH')) {
    exit;
}

/**
 * Save per-post script settings.
 *
 * @param int $post_id Post ID.
 * @return void
 */
function ssm_save_meta_data($post_id) {
    if (! isset($_POST['ssm_nonce'])) {
        return;
    }

    if (! wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['ssm_nonce'])), 'ssm_save_meta')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (wp_is_post_revision($post_id)) {
        return;
    }

    if (! current_user_can('edit_post', $post_id) || ! current_user_can('unfiltered_html')) {
        return;
    }

    $fields = array('header', 'body', 'footer');

    foreach ($fields as $field) {
        $value = isset($_POST['ssm_' . $field]) ? wp_unslash($_POST['ssm_' . $field]) : '';
        update_post_meta($post_id, '_ssm_' . $field, $value);
    }

    update_post_meta(
        $post_id,
        '_ssm_disable_global',
        isset($_POST['ssm_disable_global']) ? '1' : '0'
    );
}

add_action('save_post', 'ssm_save_meta_data');
