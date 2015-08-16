<?php
include ("static/inc/con.php");
include ("static/inc/function.php");
include ("static/inc/simple_html_dom.php");


$prefix_list = list_media_prefix('1');
$count_prefix = count($prefix_list);


for($i=0;$i<$count_prefix;$i++){
	$media_prefix_url 			= $prefix_list[$i][0];
	//$media_prefix_urls 		= Balikin($prefix_list[$i][0]);
	//$kode 					= Balikin($prefix_list[$i][0]);
	$media_prefix_container 	= Balikin($prefix_list[$i][1]);
	$media_prefix_title 		= Balikin($prefix_list[$i][2]);
	$media_prefix_date 			= Balikin($prefix_list[$i][3]);
	$media_prefix_date_split 	= Balikin($prefix_list[$i][4]);
	$media_prefix_news_content	= Balikin($prefix_list[$i][5]);
	$media_prefix_writer 		= Balikin($prefix_list[$i][6]);
	$media_prefix_image 		= Balikin($prefix_list[$i][7]);
	$media_prefix_status 		= $prefix_list[$i][8];
	$media_ 					= Balikin($prefix_list[$i][9]);
	
	foreach(find_url_like_prefix_rss($media_prefix_url) as $list_find){
		
		$kode 	= Balikin($list_find[0]);
		$target = Balikin($list_find[1]);
	
		if(check_internet($target)==1){
		$html = file_get_html($target);
		
		
			if($media_prefix_container!="-"){
				
				foreach($html->find($media_prefix_container) as $container ){
					
					//--TITLE
					if($media_prefix_title!="-"){
						foreach($container->find($media_prefix_title) as $a){
							$title = $a->plaintext;
						}
					}else{
							$title = "-";
					}
					
					
					//--DATE
					if($media_prefix_date!="-"){
						foreach($container->find($media_prefix_date) as $b){
							$date_ = $b->plaintext;
							$date_ = UbahXXX(UbahXXX(UbahBulan($date_)));
							$date_ = explode(" ",$date_);
							$date_split = explode("|",$media_prefix_date_split);
							
							$date=$date_[$date_split[0]]."-".$date_[$date_split[1]]."-".$date_[$date_split[2]];
						}
					}else{
							$date="" ;
					}
					
					
					//--NEWS CONTENT
					if($media_prefix_news_content!="-"){
						foreach($container->find($media_prefix_news_content) as $c){
							$news_content = $c->innertext;
						}
					}else{
							$news_content="-";
					}
					
					
					
					//-- WRITER 
					if($media_prefix_writer!="-"){
						foreach($container->find($media_prefix_writer) as $d){
							$writer = $d->plaintext;
						}
					}else{
							$writer="-";
					}
					
					
					
					//-- IMAGE
					if($media_prefix_image!="-"){
						foreach($container->find($media_prefix_image) as $e){
							$image = $e->src;
						}
					}else{
							$image='-';
					}
					
				}
			}
		
		
		echo "KODE:".$kode.PHP_EOL;
		echo "URL:".Balikin($target).PHP_EOL;
		echo "MEDIA:$media_".PHP_EOL;
		echo "TITLE:$title".PHP_EOL;
		echo "DATE:".$date.PHP_EOL;
		echo "NEWS CONTENT:$news_content".PHP_EOL;
		echo "WRITER:$writer".PHP_EOL;
		echo "IMAGE:$image".PHP_EOL;
		echo "--------------------------------------------------------------------------------------------------------".PHP_EOL;
	
	
		save_content($kode,$media_,UbahSimbol($title),UbahBulan($date),UbahSimbol($image),UbahSimbol($news_content),UbahSimbol($writer),UbahSimbol($target));
		update_status_url_rss($kode,$target);
		}
	}
}



?>
