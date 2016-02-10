<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function themecloud_get_actions() {
    if ( isset( $_GET['themecloud_action'] ) ) {
        do_action( 'themecloud_' . $_GET['themecloud_action'], $_GET );
    }
}
add_action(init, themecloud_get_actions);

