<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           WP_Plugin_Name
 *
 * @wordpress-plugin
 * Plugin Name:       WordPress Plugin Boilerplate
 * Plugin URI:        http://example.com/wp-plugin-name-uri/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Your Name or Your Company
 * Author URI:        http://example.com/
 * License:           GPL version 3 or any later version
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       wp-plugin-name
 * Domain Path:       /languages
 */

namespace WP_Plugin_Name;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Define Constants
 */

// `WP_Plugin_Name\PLUGIN_NAME` is defined
define( __NAMESPACE__ . '\NS', __NAMESPACE__ . '\\' );

define( NS . 'PLUGIN_NAME', 'wp-plugin-name' ); // Must match the plugin's directory and its main PHP filename

define( NS . 'PLUGIN_VERSION', '1.0.0' ); // TODO: Keep current

define( NS . 'PLUGIN_NAME_DIR', plugin_dir_path( __FILE__ ) );

define( NS . 'PLUGIN_NAME_URL', plugin_dir_url( __FILE__ ) );

define( NS . 'PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

define( NS . 'PLUGIN_TEXT_DOMAIN', 'wp-plugin-name' );


/**
 * Autoload Classes
 *
 * Each class' filename should start with `class-`, be lower-cased, and spaces should be hyphenated.
 * For example: `class Internationalization_I18n` has filename `class-internationalization-i18n.php`
 */
require_once( PLUGIN_NAME_DIR . 'inc/libraries/autoloader.php' );

/**
 * Register Activation and Deactivation Hooks
 * This action is documented in inc/core/class-activator.php
 */

register_activation_hook( __FILE__, array( NS . 'Inc\Core\Activator', 'activate' ) );

/**
 * The code that runs during plugin deactivation.
 * This action is documented inc/core/class-deactivator.php
 */

register_deactivation_hook( __FILE__, array( NS . 'Inc\Core\Deactivator', 'deactivate' ) );


/**
 * Plugin Singleton Container
 *
 * Maintains a single copy of the plugin app object
 *
 * @since    1.0.0
 */
class WP_Plugin_Name {

	/**
	 * The required version of PHP.
	 *
	 * @since    1.0.0
	 */
	private static $min_php = '5.6.0';

	/**
	 * The list of required plugins, as passed to \is_plugin_active()
	 *
	 * @since    1.0.0
	 */
	private static $required_plugins = [
		// 'gravityforms/gravityforms.php',
		// 'types/wpcf.php',
		// 'woocommerce/woocommerce.php',
	];

	/**
	 * The plugin that is missing, if any.
	 *
	 * @since    1.0.0
	 */
	private static $missing_plugin = '';

	/**
	 * The instance of the plugin.
	 *
	 * @since    1.0.0
	 * @var      Init $init Instance of the plugin.
	 */
	private static $init;
	/**
	 * Loads the plugin
	 *
	 * @access    public
	 */
	public static function init() {
		if ( ! self::is_ready() ) {
			return false;
		}

		if ( null === self::$init ) {
			self::$init = new Inc\Core\Init();
			self::$init->run();
		}

		return self::$init;
	}

	/**
	 * Output a wp-admin notice.
	 *
	 * @param        $message
	 * @param string $type
	 */
	public static function do_admin_notice( $message, $type = 'error' ) {
		$class = sprintf( '%s %s', $type, \sanitize_html_class( PLUGIN_NAME ) );

		printf('<div class="%s"><p>%s</p></div>', $class, $message );
	}

	/**
	 * Check if we have everything that is required.
	 *
	 * @return bool
	 */
	private static function is_ready() {
		$success = true;

		if ( version_compare( PHP_VERSION, self::$min_php, '<' ) ) {
			add_action( 'admin_notices', [ \get_called_class(), 'notice_old_php_version' ] );
			$success = false;
		}

		if ( $success ) {
			$success = self::has_required_plugins();
		}

		return $success;
	}

	/**
	 * Output a message about a required plugin missing, and link to Plugins page.
	 */
	public static function notice_old_php_version() {
		$message = sprintf(
			__( '%1$s requires at least PHP version %2$s in order to work.', PLUGIN_TEXT_DOMAIN ),
			'<strong>' . PLUGIN_NAME . '</strong>',
			'<strong>' . self::$min_php . '</strong>'
		);

		self::do_admin_notice( $message );
	}

	/**
	 * Checks if all of the required plugins are active.
	 *
	 * If not all are, the first one detected missing will display an admin error notice.
	 *
	 * @see \is_plugin_active()
	 * @see \current_user_can()
	 *
	 * @return bool
	 */
	private static function has_required_plugins() {
		// The file in which \is_plugin_active() is located.
		require_once( \ABSPATH . 'wp-admin/includes/plugin.php' );

		// Required to use \current_user_can()
		require_once( \ABSPATH . 'wp-includes/pluggable.php' );

		$result = true;

		foreach ( self::$required_plugins as $plugin ) {
			if ( empty( $result ) ) {
				break;
			}

			self::$missing_plugin = $plugin;

			$result = \is_plugin_active( $plugin );
		}

		if (
			empty( $result )
			&& \current_user_can( 'activate_plugins' )
		) {
			add_action( 'admin_notices', [ \get_called_class(), 'notice_missing_required_plugin' ] );
		}

		return $result;
	}

	/**
	 * Output a message about a required plugin missing, and link to Plugins page.
	 */
	public static function notice_missing_required_plugin() {
		$admin_link = '';

		$current_screen = \get_current_screen();

		if (
			empty( $current_screen->base )
			|| 'plugins' !== $current_screen->base
		) {
			$admin_link = sprintf( ' <a href="%1$s">%1$s</a>', admin_url( 'plugins.php' ) );
		}

		$message = sprintf(
			__( 'The %1$s plugin requires the %2$s plugin to be active in order to work.%3$s', PLUGIN_TEXT_DOMAIN ),
			'<strong>' . PLUGIN_NAME . '</strong>',
			'<strong>' . self::$missing_plugin . '</strong>',
			$admin_link
		);

		self::do_admin_notice( $message );
	}
}

/**
 * Begins execution of the plugin
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * Also returns copy of the app object so 3rd party developers
 * can interact with the plugin's hooks contained within.
 **/
function wp_plugin_name_init() {
	return WP_Plugin_Name::init();
}

wp_plugin_name_init();