<html>
<head>
	<title>Get Data</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.25" />
</head>
<body>
<?php
include ("static/inc/con.php");
include ("static/inc/function.php");


$WHERE ="where ";
if(isset($_GET['search'])){
	$search = ifset('search');
	$WHERE .= " (`media` like '%$search%' or `news_content` like '%$search%' or `url` like '%$search%' or `title` like '%$search%' or `writer` like '%$search%') and ";

}

if(isset($_GET['start_date']) AND isset($_GET['end_date'])){
	$start_date = ifset('start_date');
	$end_date = ifset('end_date');
		$WHERE .=" (`date` BETWEEN '$start_date' and '$end_date') AND ";
}
if(isset($_GET['date'])){
	$date = ifset('date');
	$WHERE .=" (`date`='$date' ) AND ";
}

$WHERE = substr($WHERE,0,(strlen($WHERE)-5));

$content_data = mysql_query("select * from `data` $WHERE order by `date` desc limit 300 ") or die(mysql_error());
$count_data = mysql_num_rows($content_data);
	echo '<div itemprop="count_data">'.$count_data.'</div>';

while($data = mysql_fetch_array($content_data)){
	$return = '<div itemprop="news_data" id="'.$data['kode'].'">';
	$return .='<div itemprop="media">'.Balikin($data['media']).'</div>'.PHP_EOL;
	$return .='<div itemprop="title">'.Balikin($data['title']).'</div>'.PHP_EOL;
	$return .='<div itemprop="date">'.Balikin($data['date']).'</div>'.PHP_EOL;
	$return .='<div itemprop="news_content">'.html_entity_decode(Balikin($data['news_content'])).'</div>'.PHP_EOL;
	$return .='<div itemprop="writer">'.Balikin($data['writer']).'</div>'.PHP_EOL;
	$return .='<div itemprop="image">'.Balikin($data['image']).'</div>'.PHP_EOL;
	$return .='<div itemprop="url">'.Balikin($data['url']).'</div>'.PHP_EOL;
	$return .= '</div><br>';

	echo $return;

}


?>
</body>
</html>
