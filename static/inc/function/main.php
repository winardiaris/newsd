<?php
function check_content($kode,$title){
	$check_content1 = mysql_query("select * from `data` where `kode`='$kode'")or die(mysql_error());
	$count1 = mysql_num_rows($check_content1);
	
	$title = UbahSimbol($title)   ;
	$check_content2 = mysql_query("select * from `data` where `title`='$title'")or die(mysql_error());
	$count2 = mysql_num_rows($check_content2);
	
	return $count1+$count2;
}

function save_content($kode,$media,$title,$date,$image,$news_content,$writer,$url){

	$NOW = date("Y-m-d H:i:s");
	
	
	if(check_content($kode,$title)==0){
		$save_content = mysql_query("
							insert into `data`
							(`kode`,`media`,`title`,`date`,`image`,`news_content`,`writer`,`url`,`status`,`created`) 
	                  values
	                  ('$kode','$media','$title','$date','$image','$news_content','$writer','$url','1','$NOW')
							" )or die(mysql_error());
		if($save_content){
			update_status_url($kode);
			return 1;
		}else{return 0;}
	}
}

function update_status_url($url_id){
	$update_status_url = mysql_query("update `url_data` set `url_status`='1' where `url_id`='$url_id'")or die(mysql_error());
	if($update_status_url){
		return 1;
	}
	else{
		return 0;
	}
	
}


function get_content($url_from,$prefix_status=null,$show_get_content=null,$save_content=null){
	if(isset($prefix_status)){
		$prefix_list = list_media_prefix($prefix_status);
	}
	else{
		$prefix_list = list_media_prefix('1');
	}
	
	$count_prefix = count($prefix_list);
	
	
	for($i=0;$i<$count_prefix;$i++){
		$media_prefix_url 			= $prefix_list[$i][0];
		$media_prefix_container 	= Balikin($prefix_list[$i][1]);
		$media_prefix_title 		= Balikin($prefix_list[$i][2]);
		$media_prefix_date 			= Balikin($prefix_list[$i][3]);
		$media_prefix_date_split 	= Balikin($prefix_list[$i][4]);
		$media_prefix_news_content	= Balikin($prefix_list[$i][5]);
		$media_prefix_writer 		= Balikin($prefix_list[$i][6]);
		$media_prefix_image 		= Balikin($prefix_list[$i][7]);
		$media_prefix_status 		= $prefix_list[$i][8];
		$media_ 					= Balikin($prefix_list[$i][9]);
		$media_prefix_id			= Balikin($prefix_list[$i][10]);
		
		
		$find_url_from_db = find_url_from_db("WHERE `url` like '%$media_prefix_url%' and `url_status`='0' and `url_from`='$url_from' order by `url` ");
		//$find_url_from_db = find_url_from_db($where_find_url);
		foreach($find_url_from_db as $list_find ){
			
			$kode 	= Balikin($list_find[0]);
			$target = Balikin($list_find[1]);
			
			//echo $kode."-".$target.PHP_EOL;
		
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
			
				if(isset($show_get_content)){
					echo "KODE:".$kode.PHP_EOL;
					echo "URL:".Balikin($target).PHP_EOL;
					echo "MEDIA:$media_".PHP_EOL;
					echo "TITLE:$title".PHP_EOL;
					echo "DATE:".$date.PHP_EOL;
					echo "NEWS CONTENT:$news_content".PHP_EOL;
					echo "WRITER:$writer".PHP_EOL;
					echo "IMAGE:$image".PHP_EOL;
					echo "--------------------------------------------------------------------------------------------------------".PHP_EOL;
				}
				
				
				if(isset($save_content)){
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
	}	
	
	
}


?>
