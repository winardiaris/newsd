<?php
include ("static/inc/con.php");
include ("static/inc/function.php");
include ("static/inc/simple_html_dom.php");


//print_r(priority_list());


// = url_test($media_url,$url_target);
//foreach (priority_list("where `priority_status`='1' order by `priority_url` asc") as $list){
	//$array_url = array();
	//$url = Balikin($list[1]); //url get
	
	//if(check_internet($url)==1){
	
	//$media_name = get_media_from_url($url);
	//$media_url = Balikin(get_media_from_media_data($media_name,'media_url'));
	
		//echo $url.PHP_EOL.PHP_EOL;
		//$html = file_get_html($url);
		//foreach($html->find('a') as $data){
			//$url_get = $data->href;
			////$url_get = real_url($url_get);
			
			
			//if(valid_url($url_get)==1){
				//$enable = check_prefix_enable($url_get);
				
				//if($enable>0){
					//array_push($array_url,$url_get);
				//}
			//}
			//else{
				//$url_get = real_url($media_url.$url_get);
				//$enable = check_prefix_enable($url_get);
				
				//if($enable>0){
					//array_push($array_url,$url_get);
				//}
			//}
		//}
		
		//$uniq = array_map('unserialize', array_unique(array_map('serialize', $array_url)));
		//print_r($uniq);
		
		//foreach ($uniq as $url){
			//url_save($url,0,2);
		//}
	//}
//}

//foreach (list_media_prefix('1') as $prefix_list){
	//$media_prefix_url 			= $prefix_list[0];
	//$media_prefix_container 	= Balikin($prefix_list[1]);
	//$media_prefix_title 		= Balikin($prefix_list[2]);
	//$media_prefix_date 			= Balikin($prefix_list[3]);
	//$media_prefix_date_split 	= Balikin($prefix_list[4]);
	//$media_prefix_news_content	= Balikin($prefix_list[5]);
	//$media_prefix_writer 		= Balikin($prefix_list[6]);
	//$media_prefix_image 		= Balikin($prefix_list[7]);
	//$media_prefix_status 		= $prefix_list[8];
	//$media_ 					= Balikin($prefix_list[9]);
	
	////echo $media_prefix_url.PHP_EOL;
	
	//$find_url_from_db = find_url_from_db("WHERE `url` like '%$media_prefix_url%' and `url_status`='0' and `url_from`='2' order by `url` ");
	//foreach($find_url_from_db as $urls ){
		//$kode = $urls[0];
		//$target = Balikin($urls[1]);
		
		
		//$html = file_get_html($target);
		
		//if($media_prefix_container!="-"){
				
			//foreach($html->find($media_prefix_container) as $container ){
				
				////--TITLE
				//if($media_prefix_title!="-"){
					//foreach($container->find($media_prefix_title) as $a){
						//$title = $a->plaintext;
					//}
				//}else{
						//$title = "-";
				//}
				
				
				////--DATE
				//if($media_prefix_date!="-"){
					//foreach($container->find($media_prefix_date) as $b){
						//$date_ = $b->plaintext;
						//$date_ = UbahXXX(UbahXXX(UbahBulan($date_)));
						//$date_ = explode(" ",$date_);
						//$date_split = explode("|",$media_prefix_date_split);
						
						//$date=$date_[$date_split[0]]."-".$date_[$date_split[1]]."-".$date_[$date_split[2]];
					//}
				//}else{
						//$date="" ;
				//}
				
				
				////--NEWS CONTENT
				//if($media_prefix_news_content!="-"){
					//foreach($container->find($media_prefix_news_content) as $c){
						//$news_content = $c->plaintext;
					//}
				//}else{
						//$news_content="-";
				//}
				
				
				
				////-- WRITER 
				//if($media_prefix_writer!="-"){
					//foreach($container->find($media_prefix_writer) as $d){
						//$writer = $d->plaintext;
					//}
				//}else{
						//$writer="-";
				//}
				
				
				
				////-- IMAGE
				//if($media_prefix_image!="-"){
					//foreach($container->find($media_prefix_image) as $e){
						//$image = $e->src;
					//}
				//}else{
						//$image='-';
				//}
				
			//}
		//}
		

		////echo "KODE:".$kode.PHP_EOL;
		////echo "URL:".Balikin($target).PHP_EOL;
		////echo "MEDIA:$media_".PHP_EOL;
		////echo "TITLE:$title".PHP_EOL;
		////echo "DATE:".$date.PHP_EOL;
		////echo "NEWS CONTENT:$news_content".PHP_EOL;
		////echo "WRITER:$writer".PHP_EOL;
		////echo "IMAGE:$image".PHP_EOL;
		////echo "--------------------------------------------------------------------------------------------------------".PHP_EOL;
		
		//$title 			= UbahSimbol(htmlspecialchars_decode(htmlspecialchars_decode($title)));
		//$date 			= UbahBulan($date);
		//$image 			= UbahSimbol(htmlspecialchars_decode(htmlspecialchars_decode($image)));
		//$news_content 	= UbahSimbol(htmlspecialchars_decode(htmlspecialchars_decode($news_content)));
		//$writer 		= UbahSimbol(htmlspecialchars_decode(htmlspecialchars_decode($writer)));
		//$target 		= UbahSimbol(htmlspecialchars_decode(htmlspecialchars_decode($target)));
		
		
		//save_content($kode,$media_,$title,$date,$image,$news_content,$writer,$target);
	//}
	
	////print_r($find_url_from_db);
	
//}
//print_r(list_media_prefix('1'));




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
	
	
	$find_url_from_db = find_url_from_db("WHERE `url` like '%$media_prefix_url%' and `url_status`='0' and `url_from`='2' order by `url` ");
	foreach($find_url_from_db as $list_find ){
		
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
							$news_content = $c->plaintext;
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
		
		
		//echo "KODE:".$kode.PHP_EOL;
		//echo "URL:".Balikin($target).PHP_EOL;
		//echo "MEDIA:$media_".PHP_EOL;
		//echo "TITLE:$title".PHP_EOL;
		//echo "DATE:".$date.PHP_EOL;
		//echo "NEWS CONTENT:$news_content".PHP_EOL;
		//echo "WRITER:$writer".PHP_EOL;
		//echo "IMAGE:$image".PHP_EOL;
		//echo "--------------------------------------------------------------------------------------------------------".PHP_EOL;
		
		$title = UbahSimbol(htmlspecialchars_decode(htmlspecialchars_decode($title)));
		$date = UbahBulan($date);
		$image = UbahSimbol(htmlspecialchars_decode(htmlspecialchars_decode($image)));
		$news_content = UbahSimbol(htmlspecialchars_decode(htmlspecialchars_decode($news_content)));
		$writer = UbahSimbol(htmlspecialchars_decode(htmlspecialchars_decode($writer)));
		$target = UbahSimbol(htmlspecialchars_decode(htmlspecialchars_decode($target)));
		
	
		save_content($kode,$media_,$title,$date,$image,$news_content,$writer,$target);
		}
	}
}

?>
