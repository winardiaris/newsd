<?php
include ("static/inc/con.php");
include ("static/inc/function.php");
include ("static/inc/simple_html_dom.php");
	
	
		
		
foreach(media_list("order by rand()") as $media_list){
	$url = $media_list[2];
	echo $url.PHP_EOL."------------------------------------------------------------------------------------------------------------------------------------------------------------".PHP_EOL;
	$array_url = array();
	if(check_internet($url)==1){
	
		$media_name = get_media_from_url($url);
		$media_url = Balikin(get_media_from_media_data($media_name,'media_url'));
	
		//echo $url.PHP_EOL.PHP_EOL;
		$html = file_get_html($url);
		foreach($html->find('a') as $data){
			$url_get = $data->href;
			//$url_get = real_url($url_get);
			
			if(exclude($url_get)==0){
				if(valid_url($url_get)==1){
					$enable = check_prefix_enable($url_get);
					
					if($enable>0){
						echo $url_get.PHP_EOL;
					}
				}
				
				if($media_name=='cnn indonesia'){
					$a = explode("//",$url_get);
					$url_get = real_url($a[1]);
					$enable = check_prefix_enable($url_get);
					
					if($enable>0){
						echo $url_get.PHP_EOL;
					}
				}
				
				if(valid_url($url_get)==0){
					$url_get = real_url($media_url.$url_get);
					$enable = check_prefix_enable($url_get);
					
					if($enable>0){
						echo $url_get.PHP_EOL;
					}
				}
			}
		}
		
	}
}

?>
