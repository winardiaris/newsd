<h1>Dashboard</h1>

<hr>
<a href="?m=dashboard&op=start" class="btn btn-primary">Start</a>
<a href="?m=dashboard&op=stop" class="btn btn-primary">Stop</a>


<?php
$m = ifset('m');
$op = ifset('op');

if($op=='start'){
	shell_exec("/var/www/html/newsd/bin/newsd start 2>&1");
	send_notif('Started');
}
elseif($op=='stop'){
	shell_exec("/var/www/html/newsd/bin/newsd stop 2>&1");
	send_notif('Stoped');
}


?>
