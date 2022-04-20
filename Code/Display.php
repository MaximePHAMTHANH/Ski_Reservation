<?php

function Display_form($form_data){
	echo "<h4>Resort:<small>  ".$form_data["Resort"]."</small></h4>";
	echo "<h4>Service:<small>  ".$form_data["Service"]."</small></h4>";
	echo "<h4>First Date:<small>  ".$form_data["First Date"]."</small></h4>";
	echo "<h4>Last Date:<small>  ".$form_data["Last Date"]."</small></h4>";	
	echo "<h4>Number of People:<small>  ".$form_data["Number"]."</small></h4></br>";
}


function Display_calendar($form_data,$cal){
	wp_register_style('Calendar_namespace', plugins_url('Calendar.css',__FILE__ ));
    wp_enqueue_style('Calendar_namespace');
	$calendar_values=get_calendar_data($form_data,$cal);
	$cal_values_display=cal_data_display($calendar_values);
	$button_classes=button_class($cal_values_display);
	//print_r($calendar_values);

    echo(
		'
		<script>setTimeout(function(){ window.location = "http://localhost/vierge/"; }, 120000);</script>

		<div class="calendar_wrapper">

			<h5 class="Border_text_date" style="margin:auto">Date</h5>

			<hr class="calendar_divider" style="grid-column: 2;grid-row: 1/9; width:0px; height:442px;margin:auto">

			<h5 class="Border_text_top1"> <small>'.day_column($form_data,0).'</small></br>'.date_adder($form_data["First Date"],0).'</h5>  
			<h5 class="Border_text_top2"> <small>'.day_column($form_data,1).'</small></br>'.date_adder($form_data["First Date"],1).' </h5>
			<h5 class="Border_text_top1"> <small>'.day_column($form_data,2).'</small></br>'.date_adder($form_data["First Date"],2).' </h5>  
			<h5 class="Border_text_top2"> <small>'.day_column($form_data,3).'</small></br>'.date_adder($form_data["First Date"],3).' </h5>
			<h5 class="Border_text_top1"> <small>'.day_column($form_data,4).'</small></br>'.date_adder($form_data["First Date"],4).' </h5>  

			<hr class="calendar_divider" style="grid-column: 1/8;grid-row: 2;height:1px">



			<h5 class="Border_text_left1">9:00<small>am</small></br>12:15<small>pm</small></h5> 

			<form method="post"><input class='.$button_classes["A1"].' type='.$button_classes["A1type"].' name="buttonA1" value='.$cal_values_display["A1"].' /></form>
			<form method="post"><input class='.$button_classes["B1"].' type='.$button_classes["B1type"].' name="buttonB1" value='.$cal_values_display["B1"].'  /></form>
			<form method="post"><input class='.$button_classes["C1"].' type='.$button_classes["C1type"].' name="buttonC1" value='.$cal_values_display["C1"].'  /></form>
			<form method="post"><input class='.$button_classes["D1"].' type='.$button_classes["D1type"].' name="buttonD1" value='.$cal_values_display["D1"].' /></form>
			<form method="post"><input class='.$button_classes["E1"].' type='.$button_classes["E1type"].' name="buttonE1" value='.$cal_values_display["E1"].'  /></form>


			<h5 class="Border_text_left2">9:15<small>am</small></br>12:30<small>pm</small></h5>

			<form method="post"><input class='.$button_classes["A2"].' type='.$button_classes["A2type"].' name="buttonA2" value='.$cal_values_display["A2"].'  /></form>
			<form method="post"><input class='.$button_classes["B2"].' type='.$button_classes["B2type"].' name="buttonB2" value='.$cal_values_display["B2"].'  /></form>
			<form method="post"><input class='.$button_classes["C2"].' type='.$button_classes["C2type"].' name="buttonC2" value='.$cal_values_display["C2"].'  /></form>
			<form method="post"><input class='.$button_classes["D2"].' type='.$button_classes["D2type"].' name="buttonD2" value='.$cal_values_display["D2"].'  /></form>
			<form method="post"><input class='.$button_classes["E2"].' type='.$button_classes["E2type"].' name="buttonE2" value='.$cal_values_display["E2"].'  /></form>


			<h5 class="Border_text_left1">9:30<small>am</small></br>12:45<small>pm</small></h5>

			<form method="post"><input class='.$button_classes["A3"].' type='.$button_classes["A3type"].' name="buttonA3" value='.$cal_values_display["A3"].'  /></form>
			<form method="post"><input class='.$button_classes["B3"].' type='.$button_classes["B3type"].' name="buttonB3" value='.$cal_values_display["B3"].'  /></form>
			<form method="post"><input class='.$button_classes["C3"].' type='.$button_classes["C3type"].' name="buttonC3" value='.$cal_values_display["C3"].'  /></form>
			<form method="post"><input class='.$button_classes["D3"].' type='.$button_classes["D3type"].' name="buttonD3" value='.$cal_values_display["D3"].'  /></form>
			<form method="post"><input class='.$button_classes["E3"].' type='.$button_classes["E3type"].' name="buttonE3" value='.$cal_values_display["E3"].'  /></form>


			<h5 class="Border_text_left2">9:00<small>am</small></br>1:00<small>pm</small></h5>

			<form method="post"><input class='.$button_classes["A4"].' type='.$button_classes["A4type"].' name="buttonA4" value='.$cal_values_display["A4"].'  /></form>
			<form method="post"><input class='.$button_classes["B4"].' type='.$button_classes["B4type"].' name="buttonB4" value='.$cal_values_display["B4"].' /></form>
			<form method="post"><input class='.$button_classes["C4"].' type='.$button_classes["C4type"].' name="buttonC4" value='.$cal_values_display["C4"].'  /></form>
			<form method="post"><input class='.$button_classes["D4"].' type='.$button_classes["D4type"].' name="buttonD4" value='.$cal_values_display["D4"].'  /></form>
			<form method="post"><input class='.$button_classes["E4"].' type='.$button_classes["E4type"].' name="buttonE4" value='.$cal_values_display["E4"].'  /></form>


			<h5 class="Border_text_left1">1:30<small>pm</small></br>5:00<small>pm</small></h5>

			<form method="post"><input class='.$button_classes["A5"].' type='.$button_classes["A5type"].' name="buttonA5" value='.$cal_values_display["A5"].'  /></form>
			<form method="post"><input class='.$button_classes["B5"].' type='.$button_classes["B5type"].' name="buttonB5" value='.$cal_values_display["B5"].'  /></form>
			<form method="post"><input class='.$button_classes["C5"].' type='.$button_classes["C5type"].' name="buttonC5" value='.$cal_values_display["C5"].'  /></form>
			<form method="post"><input class='.$button_classes["D5"].' type='.$button_classes["D5type"].' name="buttonD5" value='.$cal_values_display["D5"].'  /></form>
			<form method="post"><input class='.$button_classes["E5"].' type='.$button_classes["E5type"].' name="buttonE5" value='.$cal_values_display["E5"].'  /></form>


			<h5 class="Border_text_left2">9:00<small>am</small></br>5:00<small>pm</small></h5>

			<form method="post"><input class='.$button_classes["A6"].' type='.$button_classes["A6type"].' name="buttonA6" value='.$cal_values_display["A6"].'  /></form>
			<form method="post"><input class='.$button_classes["B6"].' type='.$button_classes["B6type"].' name="buttonB6" value='.$cal_values_display["B6"].'  /></form>
			<form method="post"><input class='.$button_classes["C6"].' type='.$button_classes["C6type"].' name="buttonC6" value='.$cal_values_display["C6"].'  /></form>
			<form method="post"><input class='.$button_classes["D6"].' type='.$button_classes["D6type"].' name="buttonD6" value='.$cal_values_display["D6"].'  /></form>
			<form method="post"><input class='.$button_classes["E6"].' type='.$button_classes["E6type"].' name="buttonE6" value='.$cal_values_display["E6"].'  /></form>

		</div>
		');
	return $cal_values_display;
}


function date_adder($date,$offset){
	$days_per_months=["06"=>30,"07"=>31,"08"=>31,"09"=>30,"10"=>31,"11"=>30,"12"=>31,"01"=>31,"02"=>28,"03"=>31,"04"=>30,"05"=>31];
	if (date_parser($date)["Day"]+$offset>$days_per_months[date_parser($date)["Month"]]){
		$month=date_parser($date)["Month"]+1;
		$day=date_parser($date)["Day"]+$offset-$days_per_months[date_parser($date)["Month"]];
		if ($month>12){$month=$month-12;}}
	else {
		$month=date_parser($date)["Month"]+0;
		$day=date_parser($date)["Day"]+$offset;}

	if ($month<10 && $day<10){
		return '0'.$month.'-0'.$day;}
	else if ($day<10){
		return $month.'-0'.$day;}
	else if ($month<10){
		return '0'.$month.'-'.$day;}
	else return $month.'-'.$day;	
}


function day_column($date,$offset){
	$week=["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday",];
	$day_offset=1; // 1er juin = mercredi
	$days_passed=days_passed($date["First Date"],$offset)+$day_offset;
	$rest=fmod($days_passed,7);
	return $week[$rest];
}


function cal_data_display($data){
	$cal_data=[];
	foreach ($data as $key => $value){
		if ($value[0]=="x" || $value[0]=="X" || $value[0]=="R" || $value[0]=="" ){
			$cal_data[$key]="✖";
		}
		else $cal_data[$key]=remove_coma($value)."€";
	}
	return $cal_data;
}

function remove_coma($val){
	return explode(" ",$val)[0];
}

function button_class($cal){
	$button_classes=[];
	foreach ($cal as $key => $value){
		if ($value=="✖"){
			$button_classes[$key]="b_off";
			$button_classes[$key."type"]="button";}
		else {
			$button_classes[$key]="b_on";
			$button_classes[$key."type"]="submit";}
	}
	return $button_classes;
}
	
