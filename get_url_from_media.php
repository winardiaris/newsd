<?php
include ("static/inc/con.php");
include ("static/inc/function.php");
include ("static/inc/simple_html_dom.php");

foreach(media_list("order by `media_name` asc") as $media_list){
	$media_url = $media_list[2];
	foreach(url_get($media_url) as $urls){
		//echo $urls.PHP_EOL;
		url_save($urls,1);		
	}

}

?>
