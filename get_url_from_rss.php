<?php
include ("static/inc/con.php");
include ("static/inc/function.php");
include ("static/inc/simple_html_dom.php");


$count="";
foreach(rss_list("where `rss_status`='1' order by rand()") as $rss){
	//print_r($rss);
	$rss_id 	= $rss[0];
	$rss_media 	= $rss[1];
	$rss_url 	= $rss[2];
	
	foreach(find_element_from_rss($rss_url) as $finded_url){
		$finded_url = real_url($finded_url);
		url_save($finded_url,3);	
		//$count = save_url_rss($finded_url);
	}
	
}





?>
