<?php
/*
Plugin Name: Enrapture
Description: Plugin to help our valued clients using Wordpress.
Version: 1.1
Author: Shane Marriott
Author URI: http://enrapture.gg
*/


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

 
 add_action('admin_head', 'my_custom_logo');

function my_custom_logo() {
   echo '
      <style type="text/css">
        #wp-admin-bar-wp-logo>.ab-item .ab-icon { background-image: url('.plugins_url( 'images/enr-wo-logo.png' , __FILE__ ).') !important; background-position: 0 0;}
      </style>
   ';
}

function my_custom_login_logo() {
    echo '<style type="text/css">
        h1 a { background-image:url('.plugins_url( 'images/enraptureadminlogo.png' , __FILE__ ) .') !important; }
    </style>';
}

add_action('login_head', 'my_custom_login_logo');

  // changing the login page URL
    function put_my_url(){
    return ('http://enrapture.gg/'); // putting my URL in place of the WordPress one
    }
    add_filter('login_headerurl', 'put_my_url');

// changing the login page URL hover text
    function put_my_title(){
    return ('Enrapture - Web design in Guernsey'); // changing the title from "Powered by WordPress" to whatever you wish
    }
    add_filter('login_headertitle', 'put_my_title');


function remove_footer_admin () {
    echo "Thank-you for choosing Enrapture. If you need any help, please <a href=\"http://enrapture.gg/contact/\" target=\"_blank\">contact us.</a>";
} 

add_filter('admin_footer_text', 'remove_footer_admin');
 


remove_action('wp_head', 'wp_generator'); 

 function remove_dashboard_widgets() {
	global $wp_meta_boxes;
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	//unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);

}


	add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );


add_action( 'init', 'github_plugin_updater_init' );
function github_plugin_updater_init() {

	include_once 'updater.php';

	define( 'WP_GITHUB_FORCE_UPDATE', true );

	if ( is_admin() ) { // note the use of is_admin() to double check that this is happening in the admin

		$config = array(
			'slug' => plugin_basename( __FILE__ ),
			'proper_folder_name' => 'enrapture',
			'api_url' => 'https://api.github.com/repos/sdmpxs/enrapturize',
			'raw_url' => 'https://raw.github.com/sdmpxs/enrapturize/master',
			'github_url' => 'https://github.com/sdmpxs/enrapturize',
			'zip_url' => 'https://github.com/sdmpxs/enrapturize/archive/master.zip',
			'sslverify' => true,
			'requires' => '3.0',
			'tested' => '3.3',
			'readme' => 'README.md',
			'access_token' => '',
		);

		new WPGitHubUpdater( $config );

	}

}