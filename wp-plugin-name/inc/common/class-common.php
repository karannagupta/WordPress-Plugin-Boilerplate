<?php

namespace WP_Plugin_Name\Inc\Common;

/**
 * The functionality shared between the admin and public-facing areas
 * of the plugin.
 *
 * Useful for things like utilities or hooking into something that
 * affects both back-end and front-end.
 * Everything should be 'public static...' unless only useful as a hook within \WP_Plugin_Name\Inc\Core\Init::define_common_hooks()
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @author     Your Name or Your Company
 */
class Common {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	public static $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $version    The current version of this plugin.
	 */
	public static $version;

	/**
	 * The text domain of this plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      array   $plugin_text_domain    The text domain of this plugin.
	 */
	public static $plugin_text_domain;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since       1.0.0
	 * @param       string $plugin_name        The name of this plugin.
	 * @param       string $version            The version of this plugin.
	 * @param       string $plugin_text_domain The text domain of this plugin.
	 */
	public function __construct( $plugin_name, $version, $plugin_text_domain ) {
		self::$plugin_name = $plugin_name;
		self::$version = $version;
		self::$plugin_text_domain = $plugin_text_domain;
	}
}
