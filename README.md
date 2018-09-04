# WordPress Plugin Boilerplate with Namespace and Autoloader Support


## Contents

The `wp-plugin-name` directory contains the source code - a fully executable WordPress plugin.

## Features

* The Boilerplate is based on the [Plugin API](http://codex.wordpress.org/Plugin_API), [Coding Standards](http://codex.wordpress.org/WordPress_Coding_Standards), and [Documentation Standards](https://make.wordpress.org/core/handbook/best-practices/inline-documentation-standards/php/).
* All classes, functions, and variables are documented so that you know what you need to change.
* The Boilerplate uses a strict file organization scheme that corresponds both to the WordPress Plugin Repository structure, and that makes it easy to organize the files that compose the plugin.
* The project includes a `.pot` file as a starting point for internationalization.

### Highlights

* Displays a wp-admin error notice to administrators if the required version of PHP is not met
* Displays a wp-admin error notice to administrators if a required third-party plugin (e.g. WooCommerce) is not active
* Easily add a new shortcode by having the shortcode named the same as a method in the `Common` class

## Installation

The Boilerplate can be installed directly into your plugins folder "as-is". You will want to rename it and the classes inside of it to fit your needs.

* Copy wp-plugin-name to your plugin's directory and rename it to your plugin's name
* Perform a find and replace at the project level as follows:
  1. Find the text `wp-plugin-name` and replace with `your-plugin-name` in all files
  1. Find the text `wp_plugin_name` and replace with `your_plugin_name` in all files
  1. Find the text `WP Plugin Name` and replace with `Your Plugin Name` in all files
  1. Find the text `WordPress Plugin Boilerplate` and replace with `Your Plugin Name` in all files
  1. Find the text `WP_Plugin_Name` and replace with `Your_Plugin_Name` in all files
  1. Rename the `css` and `js` files under `inc\admin\css`, `inc\admin\js\`, `inc\views\js`, `inc\views\css` and replace the string `wp-plugin-name` with `your-plugin-name`
  1. Rename the `pot` file under `languages` and replace the string `wp-plugin-name` with `your-plugin-name`
  1. Find the text `http://example.com` and replace with your URI in all files
  1. Find the text `Your Name or Your Company` and replace with your name in all files
  1. Find the text `cliffpaulick` and replace with your WordPress.org username (or delete it) in `readme.txt`
* Activate the plugin

#### Quick Commands to perform the Find and Replace #####
```	bash
# After having downloaded and extracted the archive, navigate to the folder containing the plugin
$ mv wp-plugin-name my-awesome-plugin
$ cd my-awesome-plugin
```
```	bash
# Replace text for "example.com/wp-plugin-name-uri" and "example.com"
$ grep -rl "example.com/wp-plugin-name-uri" ./* | xargs sed -i "s/example.com\/wp-plugin-name-uri/somedomain.com\/my-awesome-plugin-uri/g"

$ grep -rl "example.com" ./* | xargs sed -i "s/example.com/somedomain.com/g"
```
```	bash
# Replace text for "wp-plugin-name"
$ grep -rl "wp-plugin-name" ./* | xargs sed -i "s/wp-plugin-name/my-awesome-plugin/g"
```
```	bash
# Replace Namespace references for the text "WP_Plugin_Name"
$ grep -rl "WP_Plugin_Name" ./* | xargs sed -i "s/WP_Plugin_Name/My_Awesome_Plugin/g"
```
```	bash
# Rename Files with the text "wp-plugin-name" in them
$ find . -iname '*wp-plugin-name*' -exec rename 's/wp-plugin-name/my-awesome-plugin/' {} \;
```
```	bash
# Replace text for Your Name
$ grep -rl "Your Name or Your Company" ./* | xargs sed -i "s/Your Name or Your Company/Your Name/g"
```
Note that this will activate the source code of the Boilerplate, but because the Boilerplate has no real functionality there will be no menu items, meta boxes, or custom post types added.

### Plugin Structure

Following is the pre-built plugin structure. You can add your own new class files (include `namespace` and `use` at the top) by naming them correctly and putting the files in the most appropriate location.

* `wp-plugin-name/inc/admin` - admin-specific functionality
* `wp-plugin-name/inc/core` - plugin core to register hooks, load files etc
* `wp-plugin-name/inc/frontend` - public-facing functionality
* `wp-plugin-name/inc/common` - functionality shared between the admin area and the public-facing parts
* `wp-plugin-name/inc/libraries` - third-party libraries that the plugin uses (like a Composer `vendor` directory)

### PHP Version

This plugin requires PHP 5.6 or newer and will display a wp-admin error notice if activated in an environment that does not meet this or other requirements (such as required plugins or other dependencies you may code).

# Developer Notes

### Updates
For each new version, don't forget to:
* Add a changelog entry to `readme.txt`
* Update the version number:
  * In your `readme.txt` file's header
  * In your main plugin file's header
  * In your main plugin file's `PLUGIN_VERSION` constant
* [Generate a fresh POT file](https://developer.wordpress.org/plugins/internationalization/localization/#generating-pot-file)

### The BoilerPlate uses a variable for the Text Domain

The WordPress Plugin Boilerplate uses a **variable** (`$this->plugin_text_domain`) to store the text domain, used when internationalizing strings.

If you face problems translating the strings with an automated tool/process, replace `$this->plugin_text_domain` with the literal string of your plugin's text domain throughout the plugin.

### References:
* [Here's a discussion from the original project in favor of using variables](https://github.com/DevinVinson/WordPress-Plugin-Boilerplate/issues/59)
* [The Plugin Handbook Recommended Way (i.e. not to use variables)](https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/#text-domains)

# License

This WordPress Plugin Boilerplate is licensed under *GPL version 3 or any later version*.

> This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License, version 3 or any later version, as published by the Free Software Foundation.

> This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

> A copy of the GNU General Public License should be included in the root of this plugin's directory. The file is named `license.txt`; if not, obtain one before using this software by visiting https://www.gnu.org/licenses/gpl-3.0.html or writing to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA


If you opt to use third-party code that is not compatible with this software's license, then you may need to switch to using code that is compatible.

As an example, [here's a discussion](http://make.wordpress.org/themes/2013/03/04/licensing-note-apache-and-gpl/) that states GPLv2-only plugins could not bundle work licensed with Apache 2.0, such as [Bootstrap](http://twitter.github.io/bootstrap/).


# Credits

The WordPress Plugin Boilerplate was started in 2011 by [Tom McFarlin](http://twitter.com/tommcfarlin/) and has since included a number of great contributions. In March of 2015 the project was handed over by Tom to [Devin Vinson](https://github.com/DevinVinson/WordPress-Plugin-Boilerplate/)

This plugin boilerplate was created by [Clifford Paulick](https://github.com/cliffordp/) in 2018, as a fork of [WordPress Plugin Boilerplate with Namespace and Autoloader Support](https://github.com/karannagupta/WordPress-Plugin-Boilerplate), which forked the [WordPress Plugin Boilerplate](https://github.com/DevinVinson/WordPress-Plugin-Boilerplate) project to add support for Namespaces and Autoloading.

# Contributing

**[Reporting issues](https://github.com/cliffordp/WordPress-Plugin-Boilerplate/issues) -- and especially [Pull Requests](https://github.com/cliffordp/WordPress-Plugin-Boilerplate/pulls) -- are welcome!** Do not contribute if you do not agree to this software's license terms.

# Boilerplate's Changelog

Documenting this project's progress...

##### September 3, 2018
* Initial Release