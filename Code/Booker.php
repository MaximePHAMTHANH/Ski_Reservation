<?php

function button_pushed(){
	$buttons_available=["A1","A2","A3","A4","A5","A6","B1","B2","B3","B4","B5","B6","C1","C2","C3","C4","C5","C6","D1","D2","D3","D4","D5","D6","E1","E2","E3","E4","E5","E6"];
	foreach ($buttons_available as $button){
		if(isset($_POST['button'.$button])){
			return [true,$button];}
	//return [false,0];
	}
}

function date_finder($button,$form_data){
	if ($button[0]=="A"){return date_adder($form_data["First Date"],0);}
	else if ($button[0]=="B"){return date_adder($form_data["First Date"],1);}
	else if ($button[0]=="C"){return date_adder($form_data["First Date"],2);}
	else if ($button[0]=="D"){return date_adder($form_data["First Date"],3);}
	else if ($button[0]=="E"){return date_adder($form_data["First Date"],4);}
}

function time_finder($button){
	if ($button[1]=="1"){return "9:00am-12:15pm";}
	else if ($button[1]=="2"){return "9:15am-12:30pm";}
	else if ($button[1]=="3"){return "9:30am-12:45pm";}
	else if ($button[1]=="4"){return "9:00am-1:00pm";}
	else if ($button[1]=="5"){return "1:30pm-5:00pm";}
	else if ($button[1]=="6"){return "9:00am-5:00pm";}		
}

function product_creator($form_data,$cal_values_display,$cal_choice){
	$date=date_finder(button_pushed()[1],$form_data);
	$price=$cal_values_display[button_pushed()[1]];
	$time=time_finder(button_pushed()[1]);
	if ($date[0]==0 && $date[1]<6) {$date = "2023-".$date;}
	else $date = "2022-".$date;
	$product_name=$date." . ".$time." . ".$form_data["Resort"]." . ".$form_data["Service"]." . ".$form_data["Number"]." People . ".$price." . Monitor ".$cal_choice;
	Clear_Cart();
	$product = new WC_Product_Simple();
	$product->set_name($product_name);
	$product->set_status('publish'); 
	$product->set_catalog_visibility('visible');
	$product->set_sold_individually( true );
	$product->set_price($price);
	$product->set_regular_price($price);  
	$product->save();
	if (availability_safety_check_cart($product_name)){WC()->cart->add_to_cart($product->get_id());
		return true;}
	else return false;
	
}

function availability_safety_check_cart($product_name){
		$reservation_details=parse_product($product_name);
		$cal=cal_finder($reservation_details["Monitor"]);
		$raw_number=raw_finder($reservation_details["Time"]);
		$column_letter=column_finder(days_passed($reservation_details["Date"],0));
		if (availability_safety_check($cal,$raw_number,$column_letter)) return true;
		else return false;
}


function Clear_Cart(){
	global $woocommerce;
	$woocommerce->cart->empty_cart();
}

function Expired_redirection(){

	echo '<script>setTimeout(function(){ window.location = "http://localhost/vierge/"; }, 120000);</script>';
}