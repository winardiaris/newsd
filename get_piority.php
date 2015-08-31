<?php
include ("static/inc/con.php");
include ("static/inc/function.php");
include ("static/inc/simple_html_dom.php");


//print_r(priority_list());


// = url_test($media_url,$url_target);
foreach (priority_list() as $list){
	$url = Balikin($list[1]); //url get
	$media_name = get_media_from_url($url);
	$media_url = Balikin(get_media_from_media_data($media_name,'media_url'));
	
		echo $url.PHP_EOL.PHP_EOL;
		$html = file_get_html($url);
		foreach($html->find('a') as $data){
			$url_get = $data->href;
			
			if(valid_url($url_get)==1){
				$enable = check_prefix_enable($url_get);
				
				if($enable>0){
					echo $url_get.PHP_EOL;
					
					
					
				}
			}
			else{
				$url_get = real_url($media_url.$url_get);
				$enable = check_prefix_enable($url_get);
				
				if($enable>0){
					echo $url_get.PHP_EOL;
					
					
					
				}
			}
		}
	
}


?>
