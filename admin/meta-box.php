<?php

if (! defined('ABSPATH')) {
    exit;
}

/**
 * Get supported post types for per-page scripts.
 *
 * @return array<int, string>
 */
function ssm_get_supported_post_types() {
    $post_types = get_post_types(
        array(
            'public' => true,
        ),
        'names'
    );

    unset($post_types['attachment']);

    return array_values($post_types);
}

/**
 * Register the page-level scripts meta box.
 *
 * @return void
 */
function ssm_add_meta_boxes() {
    if (! current_user_can('unfiltered_html')) {
        return;
    }

    foreach (ssm_get_supported_post_types() as $post_type) {
        add_meta_box(
            'ssm_scripts_box',
            __('Script Manager', 'gv-sss'),
            'ssm_meta_box_callback',
            $post_type,
            'normal',
            'high'
        );
    }
}

add_action('add_meta_boxes', 'ssm_add_meta_boxes');

/**
 * Render the scripts meta box.
 *
 * @param WP_Post $post Current post object.
 * @return void
 */
function ssm_meta_box_callback($post) {
    wp_nonce_field('ssm_save_meta', 'ssm_nonce');

    $header         = get_post_meta($post->ID, '_ssm_header', true);
    $body           = get_post_meta($post->ID, '_ssm_body', true);
    $footer         = get_post_meta($post->ID, '_ssm_footer', true);
    $disable_global = get_post_meta($post->ID, '_ssm_disable_global', true);
    ?>
    <div class="ssm-metabox">
        <p>
            <label>
                <input type="checkbox" name="ssm_disable_global" value="1" <?php checked($disable_global, '1'); ?>>
                <?php esc_html_e('Disable global scripts on this page', 'gv-sss'); ?>
            </label>
        </p>

        <p class="description">
            <?php esc_html_e('Use these fields when a specific page or post needs its own tracking or custom snippet output.', 'gv-sss'); ?>
        </p>

        <div class="ssm-tabs" data-ssm-tabs>
            <div class="ssm-tab-list" role="tablist" aria-label="<?php esc_attr_e('Page script locations', 'gv-sss'); ?>">
                <button type="button" class="ssm-tab-button is-active" role="tab" aria-selected="true" aria-controls="ssm-panel-header" id="ssm-tab-header" data-ssm-tab="ssm-panel-header">
                    <?php esc_html_e('Header', 'gv-sss'); ?>
                </button>
                <button type="button" class="ssm-tab-button" role="tab" aria-selected="false" aria-controls="ssm-panel-body" id="ssm-tab-body" data-ssm-tab="ssm-panel-body">
                    <?php esc_html_e('Body', 'gv-sss'); ?>
                </button>
                <button type="button" class="ssm-tab-button" role="tab" aria-selected="false" aria-controls="ssm-panel-footer" id="ssm-tab-footer" data-ssm-tab="ssm-panel-footer">
                    <?php esc_html_e('Footer', 'gv-sss'); ?>
                </button>
            </div>

            <div class="ssm-tab-panels">
                <section class="ssm-tab-panel is-active" id="ssm-panel-header" role="tabpanel" aria-labelledby="ssm-tab-header">
                    <p>
                        <strong><?php esc_html_e('Header Scripts', 'gv-sss'); ?></strong>
                    </p>
                    <div class="ssm-code-editor ssm-code-editor--compact" data-ssm-editor>
                        <div class="ssm-code-editor__gutter" aria-hidden="true" data-ssm-lines></div>
                        <textarea name="ssm_header" rows="6" class="ssm-code-editor__textarea" spellcheck="false" data-ssm-lined-editor><?php echo esc_textarea($header); ?></textarea>
                    </div>
                </section>

                <section class="ssm-tab-panel" id="ssm-panel-body" role="tabpanel" aria-labelledby="ssm-tab-body" hidden>
                    <p>
                        <strong><?php esc_html_e('Body Scripts', 'gv-sss'); ?></strong>
                    </p>
                    <div class="ssm-code-editor ssm-code-editor--compact" data-ssm-editor>
                        <div class="ssm-code-editor__gutter" aria-hidden="true" data-ssm-lines></div>
                        <textarea name="ssm_body" rows="6" class="ssm-code-editor__textarea" spellcheck="false" data-ssm-lined-editor><?php echo esc_textarea($body); ?></textarea>
                    </div>
                </section>

                <section class="ssm-tab-panel" id="ssm-panel-footer" role="tabpanel" aria-labelledby="ssm-tab-footer" hidden>
                    <p>
                        <strong><?php esc_html_e('Footer Scripts', 'gv-sss'); ?></strong>
                    </p>
                    <div class="ssm-code-editor ssm-code-editor--compact" data-ssm-editor>
                        <div class="ssm-code-editor__gutter" aria-hidden="true" data-ssm-lines></div>
                        <textarea name="ssm_footer" rows="6" class="ssm-code-editor__textarea" spellcheck="false" data-ssm-lined-editor><?php echo esc_textarea($footer); ?></textarea>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <?php
}
