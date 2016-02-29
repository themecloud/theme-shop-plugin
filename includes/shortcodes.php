<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

function themecloud_install_theme_shortcode($atts, $content = null) {
    global $user_ID;

    if(! is_user_logged_in()) {
        return "";
    }

    if (! isset($atts['id'])) {
        return "YOU MUST ENTER THE THEME ID";
    } 

    $atts = shortcode_atts( array(
        'id' => '',
        'style' => '',
        'class' => 'themecloud-install',
        'text' => "Install on Themecloud",
        'target' => '_blank'
    ), $atts, 'themecloud_install_theme');

    $url = Themecloud::getDownloadUrl($atts['id']);
ob_start();
?>
<a href="<?php echo $url; ?>" style="<?php echo esc_attr($atts['style']) ?>" class="<?php echo esc_attr($atts['class']) ?>" target="<?php echo esc_attr($atts['target']) ?>" ><?php echo esc_attr($atts['text']) ?></a>
<?php
$link = ob_get_clean();

    return $link;
}

function themecloud_install_free_theme_shortcode($atts, $content = null) {
    if (! isset($atts['id'])) {
        return "YOU MUST ENTER THE THEME ID";
    }

    $atts = shortcode_atts( array(
        'id' => '',
        'style' => '',
        'class' => 'themecloud-install',
        'text' => "Install on Themecloud",
        'target' => '_blank'
    ), $atts, 'themecloud_install_theme');

    $url = Themecloud::getFreeDownloadUrl($atts['id']);
ob_start();
?>
<a href="<?php echo $url; ?>" style="<?php echo esc_attr($atts['style']) ?>" class="<?php echo esc_attr($atts['class']) ?>" target="<?php echo esc_attr($atts['target']) ?>" ><?php echo esc_attr($atts['text']) ?></a>
<?php
$link = ob_get_clean();

    return $link;
}


add_shortcode('themecloud_install_theme', themecloud_install_theme_shortcode);
add_shortcode('themecloud_install_free_theme', themecloud_install_free_theme_shortcode);

