<?php
include ("static/inc/con.php");
include ("static/inc/function.php");
include ("static/inc/simple_html_dom.php");


//for get url
foreach(media_list("order by `media_name` asc") as $media_list){
	$media_id = $media_list[0];
	$media_name = $media_list[1];
	$media_url = $media_list[2];
	
	url_get($media_url,$media_url,1);

}

?>
