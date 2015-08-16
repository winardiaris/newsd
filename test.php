
<?php
include ("static/inc/con.php");
include ("static/inc/function.php");
include ("static/inc/simple_html_dom.php");


//$media_url = "http://www.antaranews.com";
//$target = "http://rss.viva.co.id/";

//$html = file_get_html($target);
//foreach ($html->find('a') as $url){
	////$url_ = $url->href;
	
	////$valid = valid_url($url_);
	////if($valid){
		////$URL = $url_;
	////}
	////else{
		////$URL = real_url($media_url.$url_);
		
	////}
	////echo $URL.PHP_EOL;
	//$pos = strpos($url,"/get/");
	////$pos2 = strpos($url," ");
	//if($pos == true){
		////if($pos2==false){
			//$urls =  $url->href;
			////$media = explode("/",$urls);
			////$media = explode(".",$media[2]);
			////$media = $media[0].'.'.$media[1];
			
			//$media = "viva";
			
			////echo $url."<br>";
			//$save = rss_save($urls,$media);
			//if($save) echo "ok<br>";
		////}
		
	//}
//}	




for($i=0;$i<2;$i++){
	$limit=50;
	
	$target="http://rss.tempo.co/index.php/teco/news/feed/start/".(($i*$limit)+1)."/limit/$limit";
	$rss = simplexml_load_file($target);

	foreach($rss->channel->item as $item){
		$link = (string) $item->link;
		$link = real_url($link);
		
		$title = (string) $item->title;
		echo md5($link).":".$link.PHP_EOL;
		if(check_url_from_db(md5($link))==0){
			url_save($link);
		}
		
	}
}


?>
