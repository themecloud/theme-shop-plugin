<?php
/**
 * Plugin Name: Themecloud
 * Plugin URI: https://www.themecloud.io
 * Description: Integrates Themecloud API with WordPress
 * Author: Alessandro Siragusa
 * Version: 0.1.0
 *
 * Themecloud is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Themecloud is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Easy Digital Downloads. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package Themecloud
 * @category Core
 * @author Alessandro Siragusa
 * @version 0.1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Themecloud' ) ) :

final class Themecloud {
    private static $instance;

    public static function getInstance() {
        if (! isset(self::$instance) && ! (self::$instance instanceof Themecloud)) {
            self::$instance = new Themecloud();
            self::defineConstants();
            self::$instance->doIncludes();
        }
        return self::$instance;
    }

    private function defineConstants() {
        if (! defined('THEMECLOUD_DIR')) {
            define('THEMECLOUD_DIR', plugin_dir_path( __FILE__ ));
        }
    }

    private function doIncludes() {
        $includesDir = THEMECLOUD_DIR . "includes";

        require_once($includesDir . "/shortcodes.php");
        require_once($includesDir . "/actions.php");
        require_once($includesDir . "/install.php");

        if (is_admin()) {
            $adminDir = $includesDir . "/admin";

            require_once($adminDir . "/settings.php");
        }
    }

    public static function getApiKey() {
        $options = get_option( 'themecloud_settings' );
        return $options['api_key'];
    }

    public static function isDebug() {
        $options = get_option( 'themecloud_settings' );
        return $options['debug'];
    }

    public static function getDownloadUrl($themeId) {
        $apiKey = self::getApiKey();

        $theme = urlencode($themeId);
        $key = self::createHash($themeId);

        return home_url('/', 'relative') . "?themecloud_action=install&theme=$theme&key=$key";
    }

    public static function getFreeDownloadUrl($themeId) {
        return "https://www.themecloud.io/install-theme/$themeId";
    }

    public static function createHash($key) {
        return hash('sha256', $key . SECURE_AUTH_KEY . self::getApiKey() . self::getUserEmail());
    }

    public static function getUserEmail() {
        global $user_ID;

        $user_info = get_userdata($user_ID);

        return $user_info->user_email;
    }

    public static function validateHash($key, $hash) {
        return $hash == self::createHash($key);
    }

    public static function getApiUrl($themeId) {
        $apiKey = urlencode(self::getApiKey());
        $email = urlencode(self::getUserEmail());

        return "https://www.themecloud.io/developer/api/activate/$themeId/$email?apikey=$apiKey";
    }
}

endif; // End if class_exists check

function Themecloud() {
    return Themecloud::getInstance();
}

Themecloud();

