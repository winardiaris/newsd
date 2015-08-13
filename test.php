<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>list url</title>
</head>

<body>
<?php
include ("static/inc/con.php");
include ("static/inc/function.php");
include ("static/inc/simple_html_dom.php");


//$media_url = "http://www.antaranews.com";
//$target = "http://www.antaranews.com/berita/512124/jadwal-siaran-langsung-sepak-bola-15-17-agustus";

//$html = file_get_html($target);
//foreach ($html->find('a') as $url){
	//$url_ = $url->href;
	
	//$valid = valid_url($url_);
	//if($valid){
		//$URL = $url_;
	//}
	//else{
		//$URL = real_url($media_url.$url_);
		
	//}
	//echo $URL.PHP_EOL;
	
//}	



//////list prefix
//$q=mysql_query("select * from `url_data` where `url_status`='0' order by `url` asc")or die(mysql_error());
//while($d=mysql_fetch_array($q)){
	//echo Balikin($d['url']).PHP_EOL;
//}


//test date
//$url="http://bola.metrotvnews.com/read/2015/08/06/418808/firman-utina-ingin-bawa-persib-bekuk-arema-di-piala-proklamasi";
//$html = file_get_html($url);	
//foreach($html->find('div.detail div.nate span') as $a){
	//$text = $a->plaintext;
//}
//echo "<textarea>".UbahXXX(UbahXXX(UbahBulan($text)))."</textarea>";


//ubahsimbol
//echo "<textarea>".ubahSimbol('article.article-detail')."</textarea>";



foreach(media_list("order by `media_name` asc") as $media_list){
	$media_id = $media_list[0];
	$media_name = $media_list[1];
	$media_url = $media_list[2];
	
	//url_get($media_url,$media_url);
	
	$ganti = UbahSimbol(substr($media_url,0,-1));
	
	$q = mysql_query("update `media` set `media_url`='$ganti' where `media_id`='$media_id'") or die(mysql_error());
	
}




?>
</body>

</html>


