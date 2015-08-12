<?php
include ("static/inc/con.php");
include ("static/inc/function.php");
include ("static/inc/simple_html_dom.php");



foreach(media_prefix_list('1') as $prefix_list){
	//print_r($prefix_list);
	
	foreach(url_find_media_prefix($prefix_list[0]) as $list_find){
		//print_r($list_find);
		
		$kode 			= Balikin($list_find[0]);
		$target 			= Balikin($list_find[1]);
			
		
		$container_ 	=  Balikin($prefix_list[1]);
		$title_ 			=  Balikin($prefix_list[2]);
		$date_ 			=  Balikin($prefix_list[3]);
		$date_split 	=  Balikin($prefix_list[4]);
		$news_content_ =  Balikin($prefix_list[5]);
		$writer_ 		=  Balikin($prefix_list[6]);
		$image_ 			=  Balikin($prefix_list[7]);
		$status_ 		=  Balikin($prefix_list[8]);
		$media 			=  Balikin($prefix_list[9]);
		
		
			if(check_internet($target)==1){
				$html = file_get_html($target);
				
				
				if($container_){
					foreach($html->find($container_) as $container ){
						if($title_){
							foreach($container->find($title_) as $a){
								$title = $a->plaintext;
							}
						}else{
							$title = "-";
						}
						
						if($date_){
							foreach($container->find($date_) as $b){
								$date = $b->plaintext;
								$date = UbahXXX(UbahXXX(UbahBulan($date)));
								$date = explode(" ",$date);
								$prefix_date_split = explode("|",$date_split);
								$date=$date[$prefix_date_split[0]]."-".$date[$prefix_date_split[1]]."-".$date[$prefix_date_split[2]];
							}
						}else{
							$date="" ;
						}
						
						if($news_content_){
							foreach($container->find($news_content_) as $c){
								$news_content = $c->innertext;
							}
						}else{
							$news_content_="-";
						}
						
						if($writer_){
							foreach($container->find($writer_) as $d){
								$writer = $d->plaintext;
							}
						}else{
							$writer="-";
						}
						
						if($image_){
							foreach($container->find($image_) as $e){
								$image = $e->src;
							}
						}else{
							$image='-';
						}
						
					}
				}
				
				
				echo "KODE:".$kode.PHP_EOL;
				echo "URL:".Balikin($target).PHP_EOL;
				echo "MEDIA:$media".PHP_EOL;
				echo "TITLE:$title".PHP_EOL;
				echo "DATE:".$date.PHP_EOL;
				echo "NEWS CONTENT:$news_content".PHP_EOL;
				echo "WRITER:$writer".PHP_EOL;
				echo "IMAGE:$image".PHP_EOL;
				echo "--------------------------------------------------------------------------------------------------------".PHP_EOL;
				
				
				//save_content($kode,$media,UbahSimbol($title),UbahBulan($date),UbahSimbol($image),UbahSimbol($news_content),UbahSimbol($writer),UbahSimbol($target));
			}
	}
	
}


?>
