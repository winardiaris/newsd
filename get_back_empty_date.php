<?php
include ("static/inc/con.php");
include ("static/inc/function.php");
include ("static/inc/simple_html_dom.php");




$q = mysql_query("select * from `data` where `date`='0000-00-00'") or die(mysql_error());
while($d=mysql_fetch_array($q)){
	mysql_query("update `url_data` set `url_status`='0' where `url_id`='".$d['kode']."'")or die(mysql_error());
	mysql_query("delete from `data`  where `kode`='".$d['kode']."'")or die(mysql_error());
	
}



?>
