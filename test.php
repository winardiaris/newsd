
<?php
include ("static/inc/con.php");
include ("static/inc/function.php");
include ("static/inc/simple_html_dom.php");

//print_r(list_media_prefix("all"));



//for($i=2008;$i<2016;$i++){
	//for($j=1;$j<=12;$j++){
	
	
	//$url 		= "kpu-bantenprov.go.id/".$i."/".$j."/";
	//$media 		= "kpu-bantenprov";
	//$container 	= "div#content";
	//$title		= "h2.title";
	//$date		= "span.meta_date";
	//$date_split = "2|1|0";
	//$content	= "div.entry";
	//$writer		= "a[rel=author]";
	//$image 		= "div.entry img,0";
	
	//media_prefix_save($url,$container,$title,$date,$date_split,$content,$writer,$image,$media);
//}
//}

$q = mysql_query("SELECT * FROM  `data`  WHERE  `media` LIKE  '%viva%' AND  `date` >  '2015-09-01'") or die(mysql_error());
while($d=mysql_fetch_array($q)){
	echo $d['date'].PHP_EOL;
}

?>
