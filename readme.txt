=== Smart Script Manager ===
Contributors: gulariav
Tags: header scripts, footer scripts, tracking code, google tag manager, pixel
Requires at least: 6.0
Tested up to: 6.8
Requires PHP: 7.4
Stable tag: 1.0.1
License: GPL-2.0-or-later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Add global and page-level header, body, and footer scripts from one clean settings panel.

== Description ==

Smart Script Manager is a lightweight WordPress plugin for adding tracking scripts, verification tags, pixels, analytics, and custom snippets without editing theme files.

Use it for:

* Google Tag Manager
* GA4
* Meta Pixel
* Hotjar
* Microsoft Clarity
* Schema markup
* Verification tags
* Custom JavaScript snippets

The plugin includes:

* Global Header Scripts
* Global Body Scripts
* Global Footer Scripts
* Page-wise Header, Body, and Footer overrides
* Disable Global Scripts option on individual posts/pages
* Compact tabbed editor in the page editor
* Lightweight code-style editor with line numbers in settings

== Installation ==

1. Upload the plugin ZIP from the WordPress admin area via `Plugins > Add Plugin > Upload Plugin`.
2. Activate `Smart Script Manager`.
3. Go to `Settings > Script Manager`.
4. Add your global Header, Body, and Footer scripts.
5. Open any supported page or post if you want page-specific scripts or want to disable global scripts for that item.

== Frequently Asked Questions ==

= Where are the scripts printed? =

Header scripts are printed in `wp_head`, body scripts in `wp_body_open`, and footer scripts in `wp_footer`.

= Can I disable global scripts on one page? =

Yes. Each supported post or page includes a `Disable global scripts on this page` option.

= Does this work with custom post types? =

Yes. The plugin supports public post types except attachments.

= Does the plugin sanitize script tags? =

The plugin is intended for trusted administrators. Raw tracking snippets are preserved for users with the proper capability so GTM and similar code is not broken.

== Screenshots ==

1. Global settings page with Header, Body, and Footer editors
2. Page editor metabox with tabbed script panels

== Changelog ==

= 1.0.1 =

* Moved Script Manager under Settings
* Improved settings page header and notice placement
* Reworked page editor tabs to look and behave more clearly
* Added lightweight code-style editors with line numbers
* Updated plugin metadata, text domain, and GitHub repo link
* Adjusted header script output to run earlier in wp_head
* Refined packaging files for GitHub and WordPress usage

= 1.0.0 =

* Initial release
* Global Header, Body, and Footer scripts
* Page-level overrides
* Disable global scripts per page
* Settings UI with line numbers
* Tabbed post editor interface
