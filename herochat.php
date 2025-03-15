<?php
/**
 * Plugin Name: HeroChat
 * Description: HeroChat allows you to display a customizable AI chatbot on selected pages of your website.
 * Version: 1.0.33
 * Author: HeroChat
 * Author URI: https://herochat.org/plugin
 * License: GPL2
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

define('HEROCHAT_VERSION', '1.0.33');

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
    register_setting('herochat_api_settings_group', 'herochat_api_key');
    register_setting('herochat_display_settings_group', 'herochat_display_name');
    register_setting('herochat_display_settings_group', 'herochat_welcome_message');
    register_setting('herochat_display_settings_group', 'herochat_input_placeholder');
    register_setting('herochat_display_settings_group', 'herochat_knowledge_url');
    register_setting('herochat_display_settings_group', 'herochat_knowledge_text');
}
add_action('admin_init', 'herochat_register_settings');

// Settings page
function herochat_settings_page() {
    // Debug output
    error_log('HeroChat Settings Page Loaded');
    error_log('API Key: ' . (get_option('herochat_api_key') ? 'Set' : 'Not Set'));
    error_log('Display Settings: ' . print_r(get_option('herochat_display_settings_group'), true));
    ?>
    <style>
        .herochat-container {
            display: flex;
            gap: 40px;
        }
        .herochat-settings {
            flex: 1;
        }
        .herochat-preview {
            flex: 0 0 460px;
            margin-top: 60px;
        }
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
        }
        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }
        input:checked + .slider {
            background-color: #1FB7FF;
        }
        input:checked + .slider:before {
            transform: translateX(26px);
        }
    </style>
    <div class="wrap">
        <div style="font-size: 12px; color: #666; margin-bottom: 5px;">Version <?php echo HEROCHAT_VERSION; ?></div>
        <h1>HeroChat</h1>
        <p style="font-size: 14px; color: #666; margin-bottom: 20px;">
            Enhance your website with <a href="https://www.herochat.de" target="_blank">HeroChat</a>, the ultimate AI chatbot solution for customer support, lead generation, and sales conversion. Seamlessly integrate an intelligent chatbot that engages visitors, answers questions, and guides users toward your products or services—all in real time.
        </p>
        
        <h2 class="nav-tab-wrapper">
            <a href="#chatbot" class="nav-tab nav-tab-active" data-tab="chatbot">Chatbot</a>
            <a href="#settings" class="nav-tab" data-tab="settings">Settings</a>
            <a href="#api-key" class="nav-tab" data-tab="api-key">API Key</a>
        </h2>

        <div id="chatbot-tab" class="tab-content" style="display: block;">
        <div class="herochat-container">
            <div class="herochat-settings">
        <form method="post" action="options.php">
            <?php settings_fields('herochat_settings_group'); ?>
            <?php do_settings_sections('herochat_settings_group'); ?>
            <table class="form-table">
                <tr>
                    <th scope="row">Enable HeroChat</th>
                    <td>
                        <label class="switch">
                            <input type="checkbox" name="herochat_enabled" value="1" <?php checked(1, get_option('herochat_enabled'), true); ?> />
                            <span class="slider"></span>
                        </label>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Chatbot ID</th>
                    <td>
                        <input type="text" name="herochat_id" id="herochat_id" value="<?php echo esc_attr(get_option('herochat_id', '')); ?>" size="50" required />
                        <p>Enter the chatbot ID (required).</p>
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
        <div class="herochat-preview">
            <div id="iframe-container" style="display: <?php echo get_option('herochat_enabled') ? 'block' : 'none'; ?>">
                <script>
                    window.chatpilotIframeConfig = {
                        chatbotId: "<?php echo esc_js(trim(get_option('herochat_id')) ?: '61be3e7b6818446c8486b538147dce8e'); ?>",
                        domain: "https://app.herochat.de"
                    }
                </script>
                <script src="https://app.herochat.de/embed.iframe.js" charset="utf-8"></script>
                <iframe
                    allow="microphone"
                    src="https://app.herochat.de/chatbot-iframe/61be3e7b6818446c8486b538147dce8e"
                    id="chatbot-iframe"
                    style="border: 1px solid #CCC; border-radius: 10px;"
                    width="460px"
                    height="600px"
                    frameborder="0"
                ></iframe>
            </div>
        </div>
    </div>

    <div class="tab-content" id="settings-tab" style="display: none;">
        <form method="post" action="options.php" id="settings-form">
            <?php settings_fields('herochat_display_settings_group'); ?>
            <table class="form-table">
                <tr>
                    <th scope="row">Chatbot Title</th>
                    <td>
                        <input type="text" name="herochat_display_name" value="<?php echo esc_attr(get_option('herochat_display_name')); ?>" class="regular-text" />
                        <p class="description">Enter the display name for your chatbot.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Welcome Message</th>
                    <td>
                        <input type="text" name="herochat_welcome_message" value="<?php echo esc_attr(get_option('herochat_welcome_message', '👋 Welcome! Please feel free to ask me anything!')); ?>" class="regular-text" />
                        <p class="description">Enter the welcome message for your chatbot.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Input Placeholder</th>
                    <td>
                        <input type="text" name="herochat_input_placeholder" value="<?php echo esc_attr(get_option('herochat_input_placeholder')); ?>" class="regular-text" />
                        <p class="description">Enter the placeholder text for the input field.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Website URL</th>
                    <td>
                        <input type="url" name="herochat_knowledge_url" value="<?php echo esc_url(get_option('herochat_knowledge_url')); ?>" class="regular-text" />
                        <p class="description">Enter the website URL for the knowledge base.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Knowledge Base</th>
                    <td>
                        <textarea name="herochat_knowledge_text" rows="20" style="width: 100%; resize: vertical;"><?php echo esc_textarea(get_option('herochat_knowledge_text')); ?></textarea>
                        <p class="description">Enter the knowledge base text.</p>
                    </td>
                </tr>
            </table>
            <?php submit_button('Save Settings'); ?>
        </form>
    </div>

    <div class="tab-content" id="api-key-tab" style="display: none;">
        <form method="post" action="options.php" id="api-key-form">
            <?php settings_fields('herochat_api_settings_group'); ?>
            <table class="form-table">
                <tr>
                    <th scope="row">API Key</th>
                    <td>
                        <input type="password" name="herochat_api_key" id="herochat_api_key" value="<?php echo esc_attr(get_option('herochat_api_key')); ?>" class="regular-text" />
                        <p class="description">Enter your HeroChat API key here.</p>
                    </td>
                </tr>
            </table>
            <?php submit_button('Save API Key'); ?>
        </form>
    </div>
        <script>
            jQuery(document).ready(function($) {
                // Store the active tab in session storage
                var activeTab = sessionStorage.getItem('activeTab') || 'chatbot';
                
                function switchTab(tabId) {
                    // Remove active class from all tabs and add to current
                    $('.nav-tab').removeClass('nav-tab-active');
                    $('[data-tab="' + tabId + '"]').addClass('nav-tab-active');
                    
                    // Hide all tab content
                    $('.tab-content').hide();
                    
                    // Show selected tab content
                    $('#' + tabId + '-tab').show();
                    
                    // Store active tab
                    sessionStorage.setItem('activeTab', tabId);
                    
                    // Debug
                    console.log('Switching to tab:', tabId);
                    console.log('Tab content element:', $('#' + tabId + '-tab').length);
                }

                // Initialize tabs
                switchTab(activeTab);

                // Tab switching functionality
                $('.nav-tab').on('click', function(e) {
                    e.preventDefault();
                    var tabId = $(this).data('tab');
                    if (tabId) {
                        switchTab(tabId);
                    } else {
                        console.error('No tab ID found for clicked element');
                    }
                });

                // Toggle iframe visibility
                $('input[name="herochat_enabled"]').on('change', function() {
                    $('#iframe-container').toggle($(this).is(':checked'));
                });

                // Form validation
                function validateForm() {
                    var chatbotId = $('#herochat_id').val().trim();
                    $('#submit').prop('disabled', !chatbotId);
                }

                $('#herochat_id').on('input', validateForm);
                validateForm();

                // Handle form submissions
                $('#chatbot-form, #settings-form, #api-key-form').on('submit', function(e) {
                    e.preventDefault();
                    var $form = $(this);
                    var formData = $form.serialize();
                    
                    $.post('options.php', formData)
                        .done(function(response) {
                            // Show success message
                            var $message = $('<div class="notice notice-success"><p>Settings saved successfully!</p></div>')
                                .insertBefore($form)
                                .fadeOut(3000);
                        })
                        .fail(function(xhr, status, error) {
                            console.error('Form submission error:', error);
                            // Show error message
                            var $message = $('<div class="notice notice-error"><p>Error saving settings: ' + error + '</p></div>')
                                .insertBefore($form)
                                .fadeOut(3000);
                        });
                });
            });
        </script>
        </div>
        </div>
    </div>
</div>
    <?php
}

// Enqueue chatbot script in the header
function herochat_enqueue_script() {
    if (!get_option('herochat_enabled')) {
        return;
    }

    $included_pages = array_filter(array_map('trim', explode("\n", get_option('herochat_include_pages', ''))));
    $excluded_pages = array_filter(array_map('trim', explode("\n", get_option('herochat_exclude_pages', ''))));
    $current_path = $_SERVER['REQUEST_URI'];

    // If no included pages specified, use /* as default
    if (empty($included_pages)) {
        $included_pages = array('/*');
    }

    // Check if current path matches any excluded pattern
    foreach ($excluded_pages as $exclude) {
        if (fnmatch($exclude, $current_path) || fnmatch($exclude . '/*', $current_path)) {
            return;
        }
    }

    // Check if current path matches any included pattern
    foreach ($included_pages as $include) {
        if (fnmatch($include, $current_path) || fnmatch($include . '/*', $current_path)) {
            ?>
            <script>
                window.chatpilotConfig = {
                    chatbotId: "<?php echo esc_js(trim(get_option('herochat_id')) ?: '61be3e7b6818446c8486b538147dce8e'); ?>",
                    domain: "https://app.herochat.de"
                }
            </script>
            <?php
            if (trim(get_option('herochat_id'))) {
                ?>
                <script src="https://app.herochat.de/embed.min.js" charset="utf-8" defer></script>
                <?php
            } else {
                update_option('herochat_enabled', false);
            }
            return;
        }
    }
}
add_action('wp_head', 'herochat_enqueue_script');

// Display chatbot on allowed pages
function herochat_display_chatbot() {
    if (!get_option('herochat_enabled')) {
        return;
    }

    $included_pages = array_filter(array_map('trim', explode("\n", get_option('herochat_include_pages', ''))));
    $current_path = $_SERVER['REQUEST_URI'];

    // If no included pages specified, use /* as default
    if (empty($included_pages)) {
        $included_pages = array('/*');
    }

    // Check if current path matches any included pattern
    foreach ($included_pages as $include) {
        if (fnmatch($include, $current_path) || fnmatch($include . '/*', $current_path)) {
            echo '<herochat-bubble id="' . esc_attr(trim(get_option('herochat_id')) ?: '61be3e7b6818446c8486b538147dce8e') . '"></herochat-bubble>';
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
?>