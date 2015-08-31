<?php
include ("static/inc/con.php");
include ("static/inc/function.php");
include ("static/inc/simple_html_dom.php");



$q = mysql_query("select * from `url_data` where `url_status`='0' order by rand() limit 50 ")or die(mysql_error());
while($d=mysql_fetch_array($q)){
	$url = Balikin($d['url']);
	foreach(url_get($url) as $urls){
		//echo $urls.PHP_EOL;
		url_save($urls,1);		
	}
}


foreach(media_list("order by rand() asc") as $media_list){
	$media_url = $media_list[2];
	foreach(url_get($media_url) as $urls){
		//echo $urls.PHP_EOL;
		url_save($urls,1);		
	}

}

foreach (priority_list("where `priority_status`='1' order by `priority_url` asc") as $list){
	$url = Balikin($list[1]); //url get
	foreach(url_get($url) as $urls){
		//echo $urls.PHP_EOL;
		url_save($urls,2);		
	}
}
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
