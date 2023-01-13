<?php
require_once  'settings.php';

add_action('init', 'greenshift_connect_admin_menu');
function greenshift_connect_admin_menu()
{
	if (class_exists('GreenshiftMenuSettings')) {
		new GreenshiftMenuSettings();
	}
}