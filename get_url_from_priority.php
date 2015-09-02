<?php
include ("static/inc/con.php");
include ("static/inc/function.php");
include ("static/inc/simple_html_dom.php");

foreach (priority_list("where `priority_status`='1' order by `priority_url` asc") as $list){
	$url = Balikin($list[1]); //url get
	foreach(url_get($url) as $urls){
		//echo $urls.PHP_EOL;
		url_save($urls,2);		
	}
}


?>
