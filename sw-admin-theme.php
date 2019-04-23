<?php
/**
 * Custom Admin panel
 *
 * @package     sw-admin-theme
 * @author      Sebastian Wesołowski
 * @license     MIT License
 *
 * Plugin Name: SW Admin Theme
 * Plugin URI:  https://github.com/sebastianwesolowski/sw-admin-theme
 * Description: Customize WordPress admin theme
 * Version:     1.0.1
 * Author:      Sebastian Wesołowski
 * Author URI:  http://warsztatkodu.pl, http://wesolowski.dev
 * Text Domain: sw-admin-theme
 * Domain Path: /resources/lang
 * License:     MIT License
 * License URI: http://opensource.org/licenses/MIT
 */

add_action('admin_menu', function () {
    add_menu_page('Opcje szablonu', 'Opcje szablonu Page', 'manage_options', 'admin_theme_options', 'admin_theme_option');
});

add_action('admin_init', function () {
    add_settings_section("header_section_TEMPLATE-SETTING", "Ustawienia panelu administracyjnego", "", "admin_theme_options");
    add_settings_field("phone-warszawa", "Szablon", "simple_theme_option", "admin_theme_options", "header_section_TEMPLATE-SETTING");
    register_setting('header_section_TEMPLATE-SETTING', 'showAdvOption');
});

function simple_theme_option()
{
    ?>
            <label for="showAdvOption">Pokazać zawansowane opcje Wordpress</label><br>
            <input type="radio" name="showAdvOption" value="1" <?php checked(1, get_option('showAdvOption'), true);?>>Nie
            <input type="radio" name="showAdvOption" value="2" <?php checked(2, get_option('showAdvOption'), true);?>>Tak
        <?php
}

function admin_theme_option()
{
    ?>
            <div class="wrap">
            <div id="icon-options-general" class="icon32"><br></div>
            <h1>Opcje szablonu</h1>
                <form method="post" action="options.php">
                    <?php
settings_fields("header_section_TEMPLATE-SETTING");
    do_settings_sections("admin_theme_options");
    submit_button();
    ?>
                </form>
            </div>
        <?php
}

function admin_theme()
{
    wp_enqueue_style('AdminThemeWK_admin-theme', plugins_url('assets/css/adminTheme.css', __FILE__));
}
function admin_adv_option_theme()
{
    wp_enqueue_style('AdminThemeWK_adv_admin-theme', plugins_url('assets/css/admin_adv_Theme.css', __FILE__));
}

if (get_option('showAdvOption') == 1) {
    add_action('admin_enqueue_scripts', 'admin_adv_option_theme');
}

add_action('admin_enqueue_scripts', 'admin_theme');
?>
