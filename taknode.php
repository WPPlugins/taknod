<?php

/**
 * @package taknode
 * @version 1.0
 */
/*
Plugin Name: فروشگاه تک نود ما
Plugin URI: http://taknod.com
Description: با استفاده از این پلاگین میتوانید با API خود به فروش محصولات نود بپردازید.
Author: taknod.com
Version: 1.0
Author URI: taknod.com
*/

include_once 'functions/core.php';

function taknode_header()
{
	wp_enqueue_style( 'taknode_custome', plugins_url( 'css/custome.css', __FILE__ ));
	wp_enqueue_style( 'bootstrap', plugins_url( 'css/bootstrap.min.css', __FILE__ ));
	wp_enqueue_style( 'bootstrap_theme', plugins_url( 'css/bootstrap-theme.min.css', __FILE__ ));

	wp_enqueue_script( 'angularjs', plugins_url( 'js/angular.min.js', __FILE__ ) );
	wp_enqueue_script( 'angular_route', plugins_url( 'js/angular-route.min.js', __FILE__ ) );
	wp_enqueue_script( 'taknodejs', plugins_url( 'js/taknode.js', __FILE__ ) );
}

function taknode_callback_func()
{
	$res = taknode_core_check_callbak();
	if (!empty($res)) {
		return isset($res['licensekey']) ? 
			sprintf(file_get_contents(plugins_url( 'template/success_callback.php', __FILE__ )) ,$res['licensekey'],$res['username'],$res['password'],$res['expiration_date'] ) :
			sprintf(file_get_contents(plugins_url( 'template/error_callback.php', __FILE__ )) ,$res)
			;
	}else{
		return file_get_contents(plugins_url( 'template/header_callback.php', __FILE__ ));
	}
}

function taknode_short_code( $atts ){
	$par=shortcode_atts( ['api' => ''], $atts );
	if (empty($par['api'])) {
		return 'کلید Api وارد نشده است!<br>';
	}
	$html=file_get_contents(plugins_url( 'template/main.php', __FILE__ ));
	return sprintf($html,$par['api'],taknode_json_price($par['api']));
}

add_shortcode( 'taknode', 'taknode_short_code' );
add_shortcode( 'taknode_response', 'taknode_callback_func' );
add_action( 'wp_enqueue_scripts', 'taknode_header' );

?>
