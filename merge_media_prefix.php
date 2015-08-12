<?php
 include ("static/inc/con.php");
include ("static/inc/function.php");
include ("static/inc/simple_html_dom.php");


$target= "http://202.146.128.250:8222/list_media_prefix.php";
$html = file_get_html($target);

$kode = array();
foreach($html->find("td.kode") as $kode_ ){
	array_push($kode,$kode_->plaintext);
}


$media = array();
foreach($html->find("td.media") as $media_ ){
	array_push($media,$media_->plaintext);
}

$url = array();
foreach($html->find("td.url") as $url_ ){
	array_push($url,$url_->plaintext);
}

$container = array();
foreach($html->find("td.container") as $container_ ){
	array_push($container,$container_->plaintext);
}


$title = array();
foreach($html->find("td.title") as $title_ ){
	array_push($title,$title_->plaintext);
}

$date = array();
foreach($html->find("td.date") as $date_ ){
	array_push($date,$date_->plaintext);
}

$date_split = array();
foreach($html->find("td.date_split") as $date_split_ ){
	array_push($date_split,$date_split_->plaintext);
}	
	
$news = array();
foreach($html->find("td.news") as $news_ ){
	array_push($news,$news_->plaintext);
}

$writer = array();
foreach($html->find("td.writer") as $writer_ ){
	array_push($writer,$writer_->plaintext);
}
$image = array();
foreach($html->find("td.image") as $image_ ){
	array_push($image,$image_->plaintext);
}
$status = array();
foreach($html->find("td.status") as $status_ ){
	array_push($status,$status_->plaintext);
}

for($i=0;$i<count($kode);$i++){
	$c = mysql_query("select * from `media_prefix` where `media_prefix_id`='$kode[$i]'") or die(mysql_error());
	$count = mysql_num_rows($c);
	if(!$count){
		$s = mysql_query("insert into `media_prefix` value('$kode[$i]','$media[$i]','$url[$i]','$container[$i]','$title[$i]','$date[$i]','$date_split[$i]','$news[$i]','$writer[$i]','$image[$i]','$status[$i]') ") or die(mysql_error());
		
	}
	else{
		echo "ada".PHP_EOL;
	}
	
}
echo $i;
?>
