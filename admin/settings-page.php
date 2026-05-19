<?php

if (! defined('ABSPATH')) {
    exit;
}

/**
 * Register the plugin menu.
 *
 * @return void
 */
function ssm_admin_menu() {
    add_options_page(
        __('Script Manager', 'gv-sss'),
        __('Script Manager', 'gv-sss'),
        'manage_options',
        'smart-script-manager',
        'ssm_settings_page_html'
    );
}

add_action('admin_menu', 'ssm_admin_menu');

/**
 * Render a lightweight code editor field.
 *
 * @param string $name Field name.
 * @param string $value Field value.
 * @param string $label Visible label.
 * @param string $description Helper text.
 * @return void
 */
function ssm_render_editor_field($name, $value, $label, $description) {
    ?>
    <section class="ssm-card">
        <h2><?php echo esc_html($label); ?></h2>
        <p class="description">
            <?php echo esc_html($description); ?>
        </p>
        <div class="ssm-code-editor" data-ssm-editor>
            <div class="ssm-code-editor__gutter" aria-hidden="true" data-ssm-lines></div>
            <textarea
                name="<?php echo esc_attr($name); ?>"
                rows="12"
                class="ssm-code-editor__textarea"
                spellcheck="false"
                data-ssm-lined-editor
            ><?php echo esc_textarea($value); ?></textarea>
        </div>
    </section>
    <?php
}

/**
 * Render the settings page.
 *
 * @return void
 */
function ssm_settings_page_html() {
    if (! current_user_can('manage_options')) {
        return;
    }

    $header_scripts = get_option('ssm_header_scripts', '');
    $body_scripts   = get_option('ssm_body_scripts', '');
    $footer_scripts = get_option('ssm_footer_scripts', '');
    ?>
    <div class="wrap ssm-wrap">
        <div class="ssm-hero">
            <div>
                <h1><?php esc_html_e('Smart Script Manager', 'gv-sss'); ?></h1>
                <p>
                    <?php esc_html_e('One clean place for your site-wide tracking scripts, verification tags, and custom snippets.', 'gv-sss'); ?>
                </p>
            </div>
            <div class="ssm-badge"><?php esc_html_e('Global Scripts', 'gv-sss'); ?></div>
        </div>

        <div class="ssm-panel">
            <form method="post" action="options.php">
                <?php settings_fields('ssm_settings_group'); ?>

                <div class="ssm-grid">
                    <?php
                    ssm_render_editor_field(
                        'ssm_header_scripts',
                        $header_scripts,
                        __('Header Scripts', 'gv-sss'),
                        __('Output inside wp_head. Great for verification tags, analytics, pixels, and schema.', 'gv-sss')
                    );
                    ssm_render_editor_field(
                        'ssm_body_scripts',
                        $body_scripts,
                        __('Body Scripts', 'gv-sss'),
                        __('Output immediately after the opening body tag via wp_body_open. Ideal for GTM noscript and body-level pixels.', 'gv-sss')
                    );
                    ssm_render_editor_field(
                        'ssm_footer_scripts',
                        $footer_scripts,
                        __('Footer Scripts', 'gv-sss'),
                        __('Output near the closing body tag through wp_footer. Useful for delayed scripts and custom tracking code.', 'gv-sss')
                    );
                    ?>
                </div>

                <div class="ssm-note">
                    <strong><?php esc_html_e('Page-wise control:', 'gv-sss'); ?></strong>
                    <?php esc_html_e('Each supported page, post, or custom post type also gets its own Header, Body, and Footer script box plus a Disable Global Scripts option.', 'gv-sss'); ?>
                </div>

                <?php submit_button(__('Save Scripts', 'gv-sss')); ?>
            </form>
        </div>
    </div>
    <?php
}
