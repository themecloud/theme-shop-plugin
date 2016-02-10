<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

function themecloud_admin_notices() {
    if(! Themecloud::getApiKey()) {
?>
<div class="error notice">
    <p>You have to configure the <b>Themecloud API Key</b>, please go to the <a href="<?php admin_url( 'admin.php?page=themecloud' ) ?>" >Theeemecloud Settings</a>.</p>
</div>
<?php
    }
}
add_action( 'admin_notices', themecloud_admin_notices );

add_action( 'admin_menu', 'themecloud_add_admin_menu' );
add_action( 'admin_init', 'themecloud_settings_init' );

function render_themecloud_logo() {
    return 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxMy4wLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDE0OTQ4KSAgLS0+DQo8IURPQ1RZUEUgc3ZnIFBVQkxJQyAiLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9HcmFwaGljcy9TVkcvMS4xL0RURC9zdmcxMS5kdGQiPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgd2lkdGg9IjM4Mi41NzdweCIgaGVpZ2h0PSIzODIuOTU4cHgiIHZpZXdCb3g9IjAgMCAzODIuNTc3IDM4Mi45NTgiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDM4Mi41NzcgMzgyLjk1OCINCgkgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+DQo8ZyBpZD0iWE1MSURfMl8iPg0KCTxnPg0KCQk8cGF0aCBmaWxsPSIjMDBCOUVCIiBkPSJNMzA3LjI1Myw2OS4yOTJjMTIyLjg4MSwxMTguNjQyLTEzLjA4NSwzNDguNDMxLTE4NC4zOTQsMjc0LjQxNw0KCQkJYzEwLjU2My0xMC45NjUsMTMuNTYtMTMuOTYyLDI0LjE5Ni0yNS40NzZjMTM3LjM5MSw0Ni45NjcsMjI4LjgwMi0xMzQuNTQsMTM4Ljg4OS0yMjYuNjA5DQoJCQlDMjk5LjQzMiw3OC4yNDgsMjk4LjkyLDc4Ljc1OSwzMDcuMjUzLDY5LjI5MnoiLz4NCgkJPHBhdGggZmlsbD0iIzAwQjlFQiIgZD0iTTMxOC44NCw3LjU2Yy0yNy43NzgsNTEuMzg5LTc5LjEzMSwxMTAuODkyLTExNi45NiwxNjQuNDc1YzI5LjI0LDkuOTQxLDQ5Ljg5MSwxNS44OTksNzYuNzU1LDIxLjkzDQoJCQljLTMyLjYwMywzNC44MzItMTg0Ljg3LDE1MS41NzItMjI2LjYwOSwxNzUuNDM5YzQxLjAwOS01NC4wMjEsODAuODEyLTEwOS4yNDgsMTIwLjYxNS0xNjQuNDc1DQoJCQljLTIzLjkwNC05LjAyNy01MC0xNS43ODktNzYuNzU1LTIxLjkzQzE2Ny4yMzEsMTIxLjU1OSwyNDcuMDU2LDY4LjU2MiwzMTguODQsNy41NnoiLz4NCgkJPHBhdGggZmlsbD0iIzAwQjlFQiIgZD0iTTI1Ni43MDYsMzMuMTQ1Yy03LjI3Myw3LjM0Ni0xMy43MDcsMTQuNTEtMjEuOTMxLDIxLjkzQzExNy41MjMsMTYuNTg4LDUuNzksMTI0LjA0NCw1NS42ODEsMjQxLjQ3OQ0KCQkJYzYuMDMxLDE0LjE0NSwyMC41NDEsMzEuNzI2LDM2LjA3NSw0OC42MTFjMCwwLTEyLjI0NCwxMy4xOTQtMTcuMzYxLDIwLjI4NWMtMTUuMDU5LTkuMTM4LTI4LjM5OS0yNy41MjEtMzYuOTg5LTQzLjMxMg0KCQkJQy0zMy40NjQsMTM2LjU0NCw5MS44MjktMzIuOTc0LDI1Ni43MDYsMzMuMTQ1eiIvPg0KCTwvZz4NCgk8Zz4NCgkJPHBhdGggZmlsbD0ibm9uZSIgc3Ryb2tlPSIjMDBCOUVCIiBkPSJNMzE4Ljg0LDcuNTZjLTI3Ljc3OCw1MS4zODktNzkuMTMxLDExMC44OTItMTE2Ljk2LDE2NC40NzUNCgkJCWMyOS4yNCw5Ljk0MSw0OS44OTEsMTUuODk5LDc2Ljc1NSwyMS45M2MtMzIuNjAzLDM0LjgzMi0xODQuODcsMTUxLjU3Mi0yMjYuNjA5LDE3NS40MzkNCgkJCWM0MS4wMDktNTQuMDIxLDgwLjgxMi0xMDkuMjQ4LDEyMC42MTUtMTY0LjQ3NWMtMjMuOTA0LTkuMDI3LTUwLTE1Ljc4OS03Ni43NTUtMjEuOTNDMTY3LjIzMSwxMjEuNTU5LDI0Ny4wNTYsNjguNTYyLDMxOC44NCw3LjU2DQoJCQl6Ii8+DQoJCTxwYXRoIGZpbGw9Im5vbmUiIHN0cm9rZT0iIzAwQjlFQiIgZD0iTTMwNy4yNTMsNjkuMjkyYzEyMi44ODEsMTE4LjY0Mi0xMy4wODUsMzQ4LjQzMS0xODQuMzk0LDI3NC40MTcNCgkJCWMxMC41NjMtMTAuOTY1LDEzLjU2LTEzLjk2MiwyNC4xOTYtMjUuNDc2YzEzNy4zOTEsNDYuOTY3LDIyOC44MDItMTM0LjU0LDEzOC44ODktMjI2LjYwOQ0KCQkJQzI5OS40MzIsNzguMjQ4LDI5OC45Miw3OC43NTksMzA3LjI1Myw2OS4yOTJ6Ii8+DQoJCTxwYXRoIGZpbGw9Im5vbmUiIHN0cm9rZT0iIzAwQjlFQiIgZD0iTTI1Ni43MDYsMzMuMTQ1Yy03LjI3Myw3LjM0Ni0xMy43MDcsMTQuNTEtMjEuOTMxLDIxLjkzDQoJCQlDMTE3LjUyMywxNi41ODgsNS43OSwxMjQuMDQ0LDU1LjY4MSwyNDEuNDc5YzYuMDMxLDE0LjE0NSwyMC41NDEsMzEuNzI2LDM2LjA3NSw0OC42MTFjMCwwLTEyLjI0NCwxMy4xOTQtMTcuMzYxLDIwLjI4NQ0KCQkJYy0xNS4wNTktOS4xMzgtMjguMzk5LTI3LjUyMS0zNi45ODktNDMuMzEyQy0zMy40NjQsMTM2LjU0NCw5MS44MjktMzIuOTc0LDI1Ni43MDYsMzMuMTQ1eiIvPg0KCTwvZz4NCjwvZz4NCjwvc3ZnPg0K';
}

function themecloud_add_admin_menu(  ) { 
	add_menu_page( 'themecloud', 'Themecloud', 'manage_options', 'themecloud', 'themecloud_options_page', render_themecloud_logo() );
}

function themecloud_settings_init(  ) { 
	register_setting( 'pluginPage', 'themecloud_settings' );

	add_settings_section(
		'themecloud_pluginPage_section', 
		__( 'Themecloud settings', 'wordpress' ), 
		'themecloud_settings_section_callback', 
		'pluginPage'
	);

	add_settings_field( 
		'api_key', 
		__( 'API Key', 'wordpress' ), 
		'themecloud_api_key_field_render', 
		'pluginPage', 
		'themecloud_pluginPage_section' 
	);
	add_settings_field( 
		'debug', 
		__( 'Debug', 'wordpress' ), 
		'themecloud_debug_field_render', 
		'pluginPage', 
		'themecloud_pluginPage_section' 
	);
}

function themecloud_api_key_field_render(  ) { 
	$apiKey = Themecloud::getApiKey();

	?>
	<input type='text' name='themecloud_settings[api_key]' size="50" value='<?php echo $apiKey; ?>'>
	<?php
}

function themecloud_debug_field_render(  ) { 
	$debug = Themecloud::isDebug();

	?>
	<select name='themecloud_settings[debug]' style="width:100px;">
            <option value="0" <?php echo $debug==0 ? "selected" : "" ?>>Off</option>
            <option value="1" <?php echo $debug==1 ? "selected" : "" ?>>On</option>
	</select>
	<?php
}

function themecloud_settings_section_callback(  ) { 
	echo __( 'In this section you can manage the Themecloud\'s options', 'wordpress' );
}

function themecloud_options_page(  ) { 
	?>
	<form action='options.php' method='post'>
		<h1>Themecloud</h1><br/>
		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>
	</form>
	<?php
}

