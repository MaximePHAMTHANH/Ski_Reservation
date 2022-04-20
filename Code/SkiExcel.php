<?php
/*
Plugin Name: SkiExcel
Plugin URI: 
Description: SkiExcel
Author: Maxime Pham Thanh
Author URI: 
Version: 1.0
*/

if (!defined('ABSPATH') ){
	die;
}

include 'Main.php';

class SkiExcelPluging{

	function __construct(){
		add_action('admin_menu',array($this,'SkiExcelMenu'));
	}

	function SkiExcelMenu(){
		add_menu_page('Forms','SkiExcel','manage_options','SkiExcelMenu',array($this,'SkiExcelMenu_main'),'dashicons-awards',4);
	}

	function SkiExcelMenu_main(){
		echo '<div><h2>SkiExcel Plugin is active</h2></div>';
	}


}


if (class_exists('SkiExcelPluging')){
	$SkiExcel = new SkiExcelPluging();
}

