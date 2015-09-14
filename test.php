<?php
include ("static/inc/con.php");
include ("static/inc/function.php");

//remove exluded
$q = mysql_query("select * from `exclude`")or die(mysql_error());
while($d=mysql_fetch_array($q)){
	$qq = mysql_query("select * from `url_data` where `url` like '%".UbahSimbol($d['exclude'])."%'") or die(mysql_error());
	while($dd = mysql_fetch_array($qq)){
		echo Balikin($dd['url']).PHP_EOL;
		mysql_query("delete from `url_data` where `url_id`='".$dd['url_id']."' and `url_status`='0'")or die(mysql_error());
	}
	
}


?>
