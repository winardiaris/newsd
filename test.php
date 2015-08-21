<?php
include ("static/inc/con.php");
include ("static/inc/function.php");
include ("static/inc/simple_html_dom.php");


foreach(media_list("order by rand()") as $media_list){
	$media_id = $media_list[0];
	$media_name = $media_list[1];
	$media_url = $media_list[2];
	
	$q = mysql_query("select `url` from `data` where `media`='$media_name' order by `date` DESC limit 50 ") or die(mysql_error());
	while($d=mysql_fetch_array($q)){
		$url = Balikin($d['url']);
		url_get($media_url,$url);
	}

}




?>
