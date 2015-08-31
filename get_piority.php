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

foreach (list_media_prefix('1') as $prefix_list){
	$media_prefix_url 			= $prefix_list[0];
	$media_prefix_container 	= Balikin($prefix_list[1]);
	$media_prefix_title 		= Balikin($prefix_list[2]);
	$media_prefix_date 			= Balikin($prefix_list[3]);
	$media_prefix_date_split 	= Balikin($prefix_list[4]);
	$media_prefix_news_content	= Balikin($prefix_list[5]);
	$media_prefix_writer 		= Balikin($prefix_list[6]);
	$media_prefix_image 		= Balikin($prefix_list[7]);
	$media_prefix_status 		= $prefix_list[8];
	$media_ 					= Balikin($prefix_list[9]);
	
	//echo $media_prefix_url.PHP_EOL;
	
	$find_url_from_db = find_url_from_db("WHERE `url` like '%$media_prefix_url%' and `url_status`='0' and `url_from`='2' order by `url` ");
	foreach($find_url_from_db as $urls ){
		
	}
	
	print_r($find_url_from_db);
	
}
//print_r(list_media_prefix('1'));


?>
