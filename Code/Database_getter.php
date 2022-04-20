<?php

function get_from_db(){
	global $wpdb;
	$text = $wpdb->get_var( 'SELECT post_content FROM '. $wpdb->prefix . 'posts' . ' WHERE post_type = "Flamingo_inbound" ORDER BY ID DESC LIMIT 1 ');
	return parse_db($text);
}


function parse_db($string){
	$raw_data = preg_split("/\\r\\n|\\r|\\n/", $string);
	$data = ["Resort" => $raw_data[0],"Service"=>$raw_data[1],"First Date"=>$raw_data[2],"Last Date"=>$raw_data[3],"Number"=>$raw_data[4]];
	return $data;
}
