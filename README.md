# Smart Script Manager

Lightweight WordPress plugin to manage global and page-level Header, Body, and Footer scripts from one clean admin interface.

## Features

- Global Header Scripts
- Global Body Scripts
- Global Footer Scripts
- Page and post level script overrides
- Disable global scripts on individual pages
- Compact tabbed editor in the post editor
- Lightweight code-style editor with line numbers in settings
- HTML comment wrappers around injected output for easier debugging
- Works well for GTM, GA4, Meta Pixel, Clarity, Hotjar, schema, and custom snippets

## Use Cases

- Add Google Tag Manager
- Insert GA4 or Meta Pixel
- Add site verification tags
- Inject schema or analytics snippets
- Override tracking code on specific pages
- Disable global scripts on landing pages

## Installation

### WordPress Admin

1. Download the plugin ZIP.
2. In WordPress, go to `Plugins > Add Plugin > Upload Plugin`.
3. Upload the ZIP and activate the plugin.
4. Go to `Settings > Smart Script Manager`.

### Manual Installation

1. Upload the `smart-script-manager` folder to `/wp-content/plugins/`.
2. Activate the plugin from the WordPress admin.
3. Open `Settings > Smart Script Manager`.

## How It Works

- Header scripts are printed in `wp_head`
- Body scripts are printed in `wp_body_open`
- Footer scripts are printed in `wp_footer`

For singular content, you can also add page-specific scripts and optionally disable global scripts.

## Supported Content Types

The plugin supports public post types except attachments.

## Why There Are Two Readme Files

- `README.md` is for GitHub and humans browsing the repository.
- `readme.txt` is for WordPress plugin packaging and WordPress.org-style metadata.

Yes, keeping both is normal for WordPress plugins.

## Requirements

- WordPress 6.0+
- PHP 7.4+

## License

GPL-2.0-or-later
