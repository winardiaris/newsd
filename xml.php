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

if(isset($_GET['limit'])){
	$limit = ifset('limit');
	
	if($limit!="-1" and $limit > "-1"){
		$LIMIT ="limit $limit";	
	}
	elseif($limit <="-1"){
		$LIMIT=" limit 2000";
	}
}

$WHERE = substr($WHERE,0,(strlen($WHERE)-5));

//$content_data = mysql_query("select * from `data` $WHERE order by `date` desc limit 300 ") or die(mysql_error());
$content_data = mysql_query("select * from `data` $WHERE order by `date` DESC $LIMIT ") or die(mysql_error());
$count_data = mysql_num_rows($content_data);


$xml =new SimpleXMLElement('<xml/>');
while($data=mysql_fetch_array($content_data)){
    $biodata = $xml->addChild('item');
    $biodata->addChild('kode',$data['kode']);
    $biodata->addChild('media',$data['media']);
    $biodata->addChild('title',htmlspecialchars(Balikin($data['title'])));
    $biodata->addChild('date',$data['date']);
    $biodata->addChild('link',htmlspecialchars(Balikin($data['url'])));
    $biodata->addChild('image',htmlspecialchars(Balikin($data['image'])));
    $biodata->addChild('writer',htmlspecialchars(Balikin($data['writer'])));
    $biodata->addChild('content',htmlspecialchars(Balikin($data['news_content'])));
}
 
Header('Content-type: text/xml');
print($xml->asXML());

?>
