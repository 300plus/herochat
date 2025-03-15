=== HeroChat ===
Contributors: HeroChat
Tags: chatbot, AI, automation
Requires at least: 5.0
Tested up to: 6.4
Stable tag: 1.0.16
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html

== Description ==
HeroChat allows you to add an AI chatbot to specific pages on your WordPress site. Get your own AI Chatbot at https://www.herochat.de

== Installation ==
1. Upload the plugin files to `/wp-content/plugins/herochat/`, or install via the WordPress plugin repository.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Navigate to **Settings > HeroChat** to configure the chatbot.

== Changelog ==

= 1.0.9 =
* Updated HeroChat menu item styling to use a solid blue background color (#1FB7FF).
* Removed gradient and border radius from menu item styling.

= 1.0.8 =
* Styled HeroChat menu item with a gradient background.
* Applied hover effect to make it stand out in the WordPress admin panel.

= 1.0.7 =
* Updated chatbot embed script to a new format.
* The chatbot ID is now the only required setting for embedding.
* Fixed issues where the chatbot script was not loading correctly.
* Improved script initialization for better performance.
* Resolved an issue where excluded pages were not preventing chatbot display.

= 1.0.6 =
* Updated vendor dependencies for improved compatibility.
* Optimized chatbot initialization and performance.
* Enhanced security by sanitizing and validating input fields.
* Fixed UI inconsistencies in the admin settings page.
* Resolved an issue where some settings were not saving correctly.

= 1.0.5 =
* Improved error handling and debugging support.
* Enhanced chatbot script loading in various themes.
* Fixed inconsistencies in settings validation.

= 1.0.4 =
* Improved wildcard matching for page rules.
* Enhanced compatibility with caching plugins.
* Removed duplicate "View details" link in the plugin listing.

= 1.0.3 =
* Implemented automatic updates using **Plugin Update Checker**.
* Changed WordPress sidebar menu icon to a **chat bubble**.
* Removed duplicate "View details" button from the plugin listing.
* Fixed missing **plugin-update-checker** and **vendor** folders due to `.gitignore`.
* Resolved an issue where the chatbot was not displaying properly on certain included pages.

= 1.0.2 =
* Added chatbot display settings (enable, chatbot ID, included/excluded pages).
* Injected chatbot script dynamically in the header.
* Implemented wildcard pattern matching for included/excluded pages.

= 1.0.1 =
* Initial release with chatbot integration.
