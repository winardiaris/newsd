<?php
	$url = 'http://rss.tempo.co/index.php/teco/news/feed/start/10000/limit/10050';
	$rss = simplexml_load_file($url);

	foreach($rss->channel->item as $item){
		$link = (string) $item->link;
		$title = (string) $item->title;

		echo '<a href="'.$link.'">'.$title.'</a><br>';
	}

?>
