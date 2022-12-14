<?php 
/*
*
*	***** Aspire Subscribers *****
*
*	This file initializes all AS Core components
*	
*/
// If this file is called directly, abort. //
if ( ! defined( 'WPINC' ) ) {die;} // end if
// Define Our Constants
define('AS_CORE_INC',dirname( __FILE__ ).'/assets/inc/');
define('AS_CORE_IMG',plugins_url( 'assets/img/', __FILE__ ));
define('AS_CORE_CSS',plugins_url( 'assets/css/', __FILE__ ));
define('AS_CORE_JS',plugins_url( 'assets/js/', __FILE__ ));
$currDirPath= getcwd();
require_once(dirname( __FILE__ ).'/Classes/class-email.php');

/*
*
*  Register CSS
*
*/
function as_register_core_css(){
wp_enqueue_style('as-core', AS_CORE_CSS . 'as-core.css',null,time(),'all');
};
add_action( 'wp_enqueue_scripts', 'as_register_core_css' );    
/*
*
*  Register JS/Jquery Ready
*
*/
function as_register_core_js(){
// Register Core Plugin JS	
wp_enqueue_script('as-jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js','jquery',time());
wp_enqueue_script('as-core', AS_CORE_JS . 'as-core.js','jquery',time(),true);
};
add_action( 'wp_enqueue_scripts', 'as_register_core_js' );    
/*
*
*  Includes
*
*/ 
// Load the Functions
if ( file_exists( AS_CORE_INC . 'as-core-functions.php' ) ) {
	require_once AS_CORE_INC . 'as-core-functions.php';
}     
// Load the ajax Request
if ( file_exists( AS_CORE_INC . 'as-ajax-request.php' ) ) {
	require_once AS_CORE_INC . 'as-ajax-request.php';
} 
// Load the Shortcodes
if ( file_exists( AS_CORE_INC . 'as-shortcodes.php' ) ) {
	require_once AS_CORE_INC . 'as-shortcodes.php';
}