<?php
$mod = $number % 10;
$number -= $mod;
$number /= 10;

//calculating number of pages
if($mod > 0){
	$numberPages = $number+1;
}else{
	$numberPages = $number;
}


if(isset($_GET['start'])){
	$start = $_GET['start'];
	$end = $start+10;
	$previous = $_GET['start']-10;
	if($previous < 0){
		$previous = 0;
	}
	$next = $start + 10;
	if($next > ($number*10)){
		$next = $start;
	}
}else{
	$start = 0;
	$end = 10;
	$previous = 0;
	if(($number*10) >= 10){
		$next = 10;
	}
	else{
		$next = 0;
	}
}

?>