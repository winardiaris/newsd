<h1>Dashboard</h1>

<hr>
<a href="?m=dashboard&op=start" class="btn btn-primary">Start</a>
<a href="?m=dashboard&op=stop" class="btn btn-primary">Stop</a>


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


?>
