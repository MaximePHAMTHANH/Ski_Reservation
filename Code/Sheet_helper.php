<?php

function date_is_invalid($date){
	$date=date_parser($date);
	if ($date["Year"]==2022 && $date["Month"]>=6 || $date["Year"]==2023 && $date["Month"]<6 ){return false;}
	else return true;
}

function date_parser($date){
	$result = explode("-", $date);
	return ["Year"=>$result[0],"Month"=>$result[1],"Day"=>$result[2]];
}

function days_passed($date,$offset){
	$date=date_parser($date);
	$count=["01"=>214,"02"=>245,"03"=>273,"04"=>304,"05"=>334,"06"=>0,"07"=>30,"08"=>61,"09"=>92,"10"=>122,"11"=>153,"12"=>183];
	return $date["Day"]+$count[$date["Month"]]+$offset;
}

function column_finder($column_number){
	$alphabet=[1=>"A",2=>"B",3=>"C",4=>"D",5=>"E",6=>"F",7=>"G",8=>"H",9=>"I",10=>"J",11=>"K",12=>"L",13=>"M",14=>"N",15=>"O",16=>"P",17=>"Q",18=>"R",19=>"S",20=>"T",21=>"U",22=>"V",23=>"W",24=>"X",25=>"Y",0=>"Z"];
	$int_result=intdiv($column_number+1,26);
	$rest=fmod($column_number+1,26);
	if ($int_result==0 || $int_result==1 && $rest==0){return $alphabet[$rest];}
	else if ($rest==0){return $alphabet[$int_result-1].$alphabet[$rest];}
	else return $alphabet[$int_result].$alphabet[$rest];
}


function get_calendar_data($date,$cal){
	$date_column_letter=[];
	$i=0;
	while ($i<5){
		array_push($date_column_letter,column_finder(days_passed($date["First Date"],$i)));
		$i++;}

	$calendar_data=[];
	$j=1;
	while ($j<7){
		$k=$j+3;
		$calendar_data["A".$j] = SinglereadSheet('Cal'.$cal.'!'.$date_column_letter[0].$k);
		$calendar_data["B".$j] = SinglereadSheet('Cal'.$cal.'!'.$date_column_letter[1].$k);
		$calendar_data["C".$j] = SinglereadSheet('Cal'.$cal.'!'.$date_column_letter[2].$k);
		$calendar_data["D".$j] = SinglereadSheet('Cal'.$cal.'!'.$date_column_letter[3].$k);
		$calendar_data["E".$j] = SinglereadSheet('Cal'.$cal.'!'.$date_column_letter[4].$k);
		$j++;
	}
	return $calendar_data;
}

function form_data_checker($data){
	$date=$data["First Date"];
	$date=date_parser($date);
	$today=date('Y-m-d');
	//$today='2022-06-01';
	$today_parsed=date_parser($today);
	if ($date["Year"]<$today_parsed["Year"]){$data["First Date"]=$today;}
	else if ($date["Year"]==$today_parsed["Year"]){
		if ($date["Month"]<$today_parsed["Month"]){$data["First Date"]=$today;}
		else if ($date["Month"]==$today_parsed["Month"] && $date["Day"]<$today_parsed["Day"]){$data["First Date"]=$today;}} 
	return $data;
}