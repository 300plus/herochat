<?php
/**
 * Plugin Name: HeroChat
 * Description: HeroChat allows you to display a customizable AI chatbot on selected pages of your website.
 * Version: 1.0.9
 * Author: HeroChat
 * Author URI: https://herochat.org/plugin
 * License: GPL2
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Include Composer autoloader for Plugin Update Checker
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require __DIR__ . '/vendor/autoload.php';
}

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$updateChecker = PucFactory::buildUpdateChecker(
    'https://github.com/300plus/herochat/',
    __FILE__,
    'herochat'
);
$updateChecker->setBranch('main');

// Add settings menu with custom styling
function herochat_add_menu() {
    add_menu_page(
        'HeroChat Settings',
        'HeroChat',
        'manage_options',
        'herochat',
        'herochat_settings_page',
        'dashicons-format-chat',
        25
    );
}
add_action('admin_menu', 'herochat_add_menu');

// Register settings
function herochat_register_settings() {
    register_setting('herochat_settings_group', 'herochat_enabled');
    register_setting('herochat_settings_group', 'herochat_id');
    register_setting('herochat_settings_group', 'herochat_include_pages');
    register_setting('herochat_settings_group', 'herochat_exclude_pages');
}
add_action('admin_init', 'herochat_register_settings');

// Settings page
function herochat_settings_page() {
    ?>
    <div class="wrap">
        <h1>HeroChat Settings</h1>
        <form method="post" action="options.php">
            <?php settings_fields('herochat_settings_group'); ?>
            <?php do_settings_sections('herochat_settings_group'); ?>
            <table class="form-table">
                <tr>
                    <th scope="row">Enable AI Bot</th>
                    <td>
                        <input type="checkbox" name="herochat_enabled" value="1" <?php checked(1, get_option('herochat_enabled'), true); ?> />
                    </td>
                </tr>
                <tr>
                    <th scope="row">Chatbot ID</th>
                    <td>
                        <input type="text" name="herochat_id" value="<?php echo esc_attr(get_option('herochat_id', '61be3e7b6818446c8486b538147dce8e')); ?>" size="50" />
                        <p>Enter the chatbot ID or full tag.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Included Pages</th>
                    <td>
                        <textarea name="herochat_include_pages" rows="5" cols="50"><?php echo esc_textarea(get_option('herochat_include_pages', '')); ?></textarea>
                        <p>Specify the pages where the chatbot should appear (wildcards * allowed).</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Excluded Pages</th>
                    <td>
                        <textarea name="herochat_exclude_pages" rows="5" cols="50"><?php echo esc_textarea(get_option('herochat_exclude_pages', '')); ?></textarea>
                        <p>Specify the pages where the chatbot should NOT appear.</p>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Enqueue chatbot script in the header
function herochat_enqueue_script() {
    if (!get_option('herochat_enabled')) {
        return;
    }
    ?>
    <script>
        window.chatpilotConfig = {
            chatbotId: "<?php echo esc_js(get_option('herochat_id', '61be3e7b6818446c8486b538147dce8e')); ?>",
            domain: "https://app.herochat.de"
        }
    </script>
    <script src="https://app.herochat.de/embed.min.js" charset="utf-8" defer></script>
    <?php
}
add_action('wp_head', 'herochat_enqueue_script');

// Display chatbot on allowed pages
function herochat_display_chatbot() {
    if (!get_option('herochat_enabled')) {
        return;
    }

    $included_pages = array_filter(array_map('trim', explode("\n", get_option('herochat_include_pages', ''))));
    $excluded_pages = array_filter(array_map('trim', explode("\n", get_option('herochat_exclude_pages', ''))));
    $current_path = $_SERVER['REQUEST_URI'];

    foreach ($excluded_pages as $exclude) {
        if (fnmatch($exclude, $current_path)) {
            return;
        }
    }
    
    foreach ($included_pages as $include) {
        if (fnmatch($include, $current_path)) {
            echo '<herochat-bubble id="' . esc_attr(get_option('herochat_id', '61be3e7b6818446c8486b538147dce8e')) . '"></herochat-bubble>';
            return;
        }
    }
}
add_action('wp_footer', 'herochat_display_chatbot');

// Add custom styles to HeroChat admin menu
function herochat_admin_styles() {
    echo '<style>
        #toplevel_page_herochat .wp-menu-name {
            color: #fff !important;
            font-weight: bold;
        }
        #toplevel_page_herochat {
            background: #1FB7FF;
        }
        #toplevel_page_herochat:hover {
            background: #1ca7e8;
        }
    </style>';
}
add_action('admin_head', 'herochat_admin_styles');

// Add custom links to the plugin listing
function herochat_plugin_links($links, $file) {
    if ($file === plugin_basename(__FILE__)) {
        $links[] = '<a href="https://herochat.org/donate" target="_blank">Donate</a>';
        $links[] = '<a href="https://herochat.org/support" target="_blank">Support</a>';
    }
    return $links;
}
add_filter('plugin_row_meta', 'herochat_plugin_links', 10, 2);
