<?php 
/**
 * Plugin Name: ST J&T Tracker
 * Plugin URI: https://standardtouch.com/
 * Description: Track your order with ST J&T Tracker get real time upate from J&T Express on your order
 * Version: 1.0
 * Author: StandardTouch
 * Author URI: https://standardtouch.com/
 * Text Domain: stjnttracker
 * Domain Path: languages/
 * Requires at least: 5.7
 * Requires PHP: 7.0
 *
 * @package stjnttracker
 */


if( !defined( 'ABSPATH' ) ) {
	die;
}

define( 'ST_VERSION', '1.0' );
define( 'ST_PLUGIN_DIR', plugin_dir_path( __FILE__ ));

function activate_st_jnt(){
	require_once  ST_PLUGIN_DIR. 'includes/class-st-jnt-activate.php';
	St_Jnt_Activator::activator();
}
register_activation_hook(__FILE__, 'activate_st_jnt');

function deactivate_st_jnt(){
	require_once ST_PLUGIN_DIR. 'includes/class-st-jnt-deactivate.php';
	St_Jnt_Deactivator::deactivator();
}
register_deactivation_hook(__FILE__, 'deactivate_st_jnt');

require_once ST_PLUGIN_DIR. 'includes/class-st-jnt.php';

$stjnt = new StJnt();
$stjnt->InitPlugin();

