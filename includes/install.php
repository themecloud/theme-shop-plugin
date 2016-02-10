<?php

function themecloud_install($data) {
    if( ! is_user_logged_in() ) {
        wp_redirect(wp_login_url($_SERVER['REQUEST_URI']));
        die();
    }
    
    if( ! Themecloud::validateHash($data['theme'], $data['key'])) {
        status_header(403);
        echo "Hash not valid";
        die();
    }

    $debug = Themecloud::isDebug();

    $ch = curl_init(Themecloud::getApiUrl($data['theme']));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if($debug && $httpCode == 403) {
        die('Please verify your API key!');
    }

    if ($response === false || $httpCode == 404) {
        die('An error occurred, please try again later');
    }

    $decoded = json_decode($response);
    if ($decoded->success === false) {
        if($debug) {
            die($decoded->reason);
        }
        die('An error occurred, please try again later');
    }

    header("Location: {$decoded->url}");
    die();
}

add_action( 'themecloud_install', themecloud_install );
