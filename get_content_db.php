<?php
include ("static/inc/con.php");
include ("static/inc/function.php");

$kode = ifset('kode');

$q = mysql_query("select * from `data` where `kode`='$kode'")or die(mysql_error());
$d = mysql_fetch_array($q);
$news = $d['news_content'];

echo '<news>'.Balikin($news).'</news>';

?>
