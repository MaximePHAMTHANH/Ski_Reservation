<?php


function update_schedule($order_id) {
	$order = new WC_Order( $order_id );
	$customer_name=  $order->get_billing_first_name()." ".$order->get_billing_last_name();
	$customer_email= $order->get_billing_email();
	$customer_phone= $order->get_billing_phone();
	foreach ( $order->get_items() as $item_key => $item ) {
		$product = $item->get_product(); 
		$product_name = $product->get_name();
		$reservation_details=parse_product($product_name);
		$cal=cal_finder($reservation_details["Monitor"]);
		$raw_number=raw_finder($reservation_details["Time"]);
		$column_letter=column_finder(days_passed($reservation_details["Date"],0));
		$case='Cal_'.$cal."!".$column_letter.$raw_number;
		if (availability_safety_check($cal,$raw_number,$column_letter)) {
			writeSheet($case,"Reservation ".$customer_name." ".$reservation_details["Resort"]." \n".$reservation_details["Course"]." ".$reservation_details["Number"]." ".$reservation_details["Price"]." \n".$customer_email." ".$customer_phone);
			close_other($cal,$raw_number,$column_letter);	
		}
		else writeSheet('Cal_'.$cal."!".$column_letter."10","Error Duplicate for ".$reservation_details["Time"]." \n".$customer_name." ".$reservation_details["Resort"]." \n".$reservation_details["Course"]." ".$reservation_details["Number"]." ".$reservation_details["Price"]." \n".$customer_email." ".$customer_phone);

	}
}

function parse_product($name){
	$reservation_details=[];
	$exploded=explode(" . ",$name);
	$reservation_details["Date"]=$exploded[0];
	$reservation_details["Time"]=$exploded[1];
	$reservation_details["Resort"]=$exploded[2];
	$reservation_details["Course"]=$exploded[3];
	$reservation_details["Number"]=$exploded[4];
	$reservation_details["Price"]=$exploded[5];
	$reservation_details["Monitor"]=$exploded[6];
	return $reservation_details;
}

function raw_finder($time){
	if ($time=="9:00am-12:15pm") return 4;
	else if ($time=="9:15am-12:30pm") return 5;
	else if ($time=="9:30am-12:45pm") return 6;
	else if ($time=="9:00am-1:00pm") return 7;
	else if ($time=="1:30pm-5:00pm") return 8;
	else if ($time=="9:00am-5:00pm") return 9;
}

function cal_finder($monitor){
	if (str_contains($monitor, "a")) return "c";
	else if (str_contains($monitor, "b")) return "b";
	else if (str_contains($monitor, "c")) return "c";
}

function close_other($cal,$raw_number,$column_letter){
	$cases_to_close=[];
	if ($raw_number==4) {array_push($cases_to_close,"5","6","7","9");}
	else if ($raw_number==5) {array_push($cases_to_close,"4","6","7","9");}
	else if ($raw_number==6) {array_push($cases_to_close,"4","5","7","9");}
	else if ($raw_number==7) {array_push($cases_to_close,"4","5","6","9");}
	else if ($raw_number==8) {array_push($cases_to_close,"9");}
	else if ($raw_number==9) {array_push($cases_to_close,"4","5","6","7","8");}
	foreach ($cases_to_close as $item ) {writeSheet('Cal_'.$cal."!".$column_letter.$item,"x");}
}

function availability_safety_check($cal,$raw_number,$column_letter){
	$case='Cal_'.$cal."!".$column_letter.$raw_number;
	$case_current_value=SinglereadSheet($case);
	if ($case_current_value[0]=="x" || $case_current_value[0]=="X" || $case_current_value[0]=="R" || $case_current_value[0]=="" ){return false;}
	else return true;
}