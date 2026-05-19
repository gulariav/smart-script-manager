<?php
/**
 * Plugin Name: Smart Script Manager
 * Plugin URI: https://github.com/gulariav/smart-script-manager
 * Description: Inject global and page-specific header, body, and footer scripts for tracking pixels, analytics, and custom snippets.
 * Version: 1.0.2
 * Author: Vishal Gularia
 * License: GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: gv-sss
 */

if (! defined('ABSPATH')) {
    exit;
}

define('SSM_VERSION', '1.0.2');
define('SSM_PATH', plugin_dir_path(__FILE__));
define('SSM_URL', plugin_dir_url(__FILE__));

require_once SSM_PATH . 'includes/settings.php';
require_once SSM_PATH . 'includes/output.php';
require_once SSM_PATH . 'includes/save-meta.php';

require_once SSM_PATH . 'admin/settings-page.php';
require_once SSM_PATH . 'admin/meta-box.php';
require_once SSM_PATH . 'admin/admin-assets.php';
