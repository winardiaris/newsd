
<?php
include ("static/inc/con.php");
include ("static/inc/function.php");
include ("static/inc/simple_html_dom.php");



for($i=0;$i<1000;$i++){
	$limit=50;
	
	$target="http://rss.tempo.co/index.php/teco/news/feed/start/".(($i*$limit)+1)."/limit/$limit";
	$rss = simplexml_load_file($target);

	foreach($rss->channel->item as $item){
		$link = (string) $item->link;
		$link = real_url($link);
		
		$title = (string) $item->title;
		echo md5($link).":".$link.PHP_EOL;
		if(check_url_from_db(md5($link))==0){
			url_save($link);
		}
		
	}
}


?>
