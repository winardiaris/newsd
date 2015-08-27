<h1>Dashboard</h1>

<hr>
<a href="?m=dashboard&op=start" class="btn btn-primary">Start</a>
<a href="?m=dashboard&op=stop" class="btn btn-primary">Stop</a>

<hr>
<h3>Log</h3>
<a href="?m=dashboard&op=log1" class="btn btn-primary">get_news_content</a>
<a href="?m=dashboard&op=log2" class="btn btn-primary">get_url_from_media</a>
<a href="?m=dashboard&op=log3" class="btn btn-primary">get_news_content_rss</a>
<a href="?m=dashboard&op=log4" class="btn btn-primary">get_url_from_rss</a>


<?php
$m = ifset('m');
$op = ifset('op');

if($op=='start'){
	exec("newsd start ");
	send_notif('Started');
}
elseif($op=='stop'){
	exec("newsd stop ");
	send_notif('Stoped');
}
elseif($op=='log1'){
	$a = exec("newsd log1 ");
	echo '<hr><textarea class="form-control" rows="15"H>'.$a.'</textarea>';
}
elseif($op=='log2'){
	$a = exec("newsd log2 ");
	echo '<hr><textarea class="form-control" rows="15">'.$a.'</textarea>';
}
elseif($op=='log3'){
	$a = exec("newsd log3 ");
	echo '<hr><textarea class="form-control" rows="15">'.$a.'</textarea>';
}
elseif($op=='log4'){
	$a = exec("newsd log4 ");
	echo '<hr><textarea class="form-control" rows="15">'.$a.'</textarea>';
}


?>
