<?php
include ("static/inc/con.php");
include ("static/inc/function.php");
include ("static/inc/simple_html_dom.php");

$csv = array_map('str_getcsv', file('data.csv'));

//print_r($csv);
foreach($csv as $data){
	$url = $data[0];
	url_save($url,1);	
}

?>
