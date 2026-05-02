<?php defined('ABSPATH') or die;

/**
 * Plugin Name:  TitleKit CRM
 * Plugin URI:   https://thetitlekit.com
 * Description:  CRM and Email Newsletter Plugin for WordPress
 * Version:      2.9.84
 * Author:       TitleKit by TitleKit
 * Author URI:   https://thetitlekit.com
 * License:      GPLv2 or later
 * License URI:  https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:  fluent-crm
 * Domain Path:  /language
 */

if (defined('FLUENTCRM')) {
    return;
}

define('FLUENTCRM', 'fluentcrm');
define('FLUENTCRM_PLUGIN_URL', plugin_dir_url(__FILE__));
define('FLUENTCRM_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('FLUENTCRM_PLUGIN_VERSION', '2.9.84');
define('FLUENTCRM_MIN_PRO_VERSION', '2.9.84');

define('FLUENTCRM_DB_VERSION', '2.9.50');

define('FLUENTCRM_FRAMEWORK_VERSION', 3);
define('FLUENT_CRM_STARTING_TIME', microtime(true));
define('FC_TEMPLATE_API_DOMAIN', 'https://fluentcrm.com');

if (!defined('FLUENTCRM_UPLOAD_DIR')) {
    define('FLUENTCRM_UPLOAD_DIR', '/fluentcrm');
}

require __DIR__ . '/vendor/autoload.php';

call_user_func(function ($bootstrap) {
    $bootstrap(__FILE__);
}, require(__DIR__ . '/boot/app.php'));

add_filter('site_transient_update_plugins', function ($transient) {
    if (is_object($transient) && isset($transient->response['fluent-crm/fluent-crm.php'])) {
        unset($transient->response['fluent-crm/fluent-crm.php']);
    }
    return $transient;
});

