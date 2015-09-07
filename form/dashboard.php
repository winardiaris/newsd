<h1>Dashboard</h1>

<hr>
<a href="?m=dashboard&op=start" class="btn btn-primary">Start</a>
<a href="?m=dashboard&op=stop" class="btn btn-primary">Stop</a>

<hr>
<h3>Log</h3>
<a href="?m=dashboard&op=log_url_media" class="btn btn-primary">log_url_media</a>
<a href="?m=dashboard&op=log_url_priority" class="btn btn-primary">log_url_priority</a>
<a href="?m=dashboard&op=log_url_random" class="btn btn-primary">log_url_random</a>
<a href="?m=dashboard&op=log_url_rss" class="btn btn-primary">log_url_rss</a>

<a href="?m=dashboard&op=log_content_media" class="btn btn-primary">log_content_media</a>
<a href="?m=dashboard&op=log_content_priority" class="btn btn-primary">log_content_priority</a>
<a href="?m=dashboard&op=log_content_random" class="btn btn-primary">log_content_random</a>
<a href="?m=dashboard&op=log_content_rss" class="btn btn-primary">log_content_rss</a>


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

elseif($op=='log_url_media'){
	$a = exec("newsd log_url_media ");
	echo '<hr><textarea class="form-control" rows="15">'.$a.'</textarea>';
}
elseif($op=='log_url_priority'){
	$a = exec("newsd log_url_priority ");
	echo '<hr><textarea class="form-control" rows="15">'.$a.'</textarea>';
}
elseif($op=='log_url_random'){
	$a = exec("newsd log_url_random ");
	echo '<hr><textarea class="form-control" rows="15">'.$a.'</textarea>';
}
elseif($op=='log_url_rss'){
	$a = exec("newsd log_url_rss ");
	echo '<hr><textarea class="form-control" rows="15">'.$a.'</textarea>';
}

elseif($op=='log_content_media'){
	$a = exec("newsd log_content_media ");
	echo '<hr><textarea class="form-control" rows="15">'.$a.'</textarea>';
}
elseif($op=='log_content_priority'){
	$a = exec("newsd log_content_priority ");
	echo '<hr><textarea class="form-control" rows="15">'.$a.'</textarea>';
}
elseif($op=='log_content_random'){
	$a = exec("newsd log_content_random ");
	echo '<hr><textarea class="form-control" rows="15">'.$a.'</textarea>';
}
elseif($op=='log_content_rss'){
	$a = exec("newsd log_content_rss ");
	echo '<hr><textarea class="form-control" rows="15">'.$a.'</textarea>';
}

?>
