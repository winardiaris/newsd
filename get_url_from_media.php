<?php
include ("static/inc/con.php");
include ("static/inc/function.php");
include ("static/inc/simple_html_dom.php");

foreach(media_list("order by rand()") as $media_list){
	$media_url = $media_list[2];
	
	url_get($media_url,1);
	
	//foreach(url_get($media_url) as $urls){
		////echo $urls.PHP_EOL;
		//url_save($urls,1);		
	//}

}

?>
