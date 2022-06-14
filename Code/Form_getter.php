<?php

function get_from_db(){
	global $wpdb;
	$text = $wpdb->get_var( 'SELECT post_content FROM '. $wpdb->prefix . 'posts' . ' WHERE post_type = "Flamingo_inbound" ORDER BY ID DESC LIMIT 1 ');
	return parse_db($text);
}


function parse_db($string){
	$raw_data = preg_split("/\\r\\n|\\r|\\n/", $string);
	$data = ["Resort" => $raw_data[0],"Service"=>$raw_data[1],"First Date"=>$raw_data[2],"Last Date"=>$raw_data[3],"Number"=>$raw_data[4]];
	print_r($data);
	echo "</br>";
	return $data;
}

function get_from_url($url){
	$url_param=explode("/",$url);
	$url_param= substr($url_param[3], 1);
	$url_param=explode("&",$url_param);
	//print_r($url_param);
	$data=["Resort"=>str_replace("%20", " ", explode("=",$url_param[0])[1]),"Service"=>str_replace("%20", " ", explode("=",$url_param[1])[1]),"First Date"=>explode("=",$url_param[2])[1],"Last Date"=>explode("=",$url_param[3])[1],"Number"=>explode("=",$url_param[4])[1]];

	return $data;
}
