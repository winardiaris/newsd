<?php
include ("static/inc/con.php");
include ("static/inc/function.php");
include ("static/inc/simple_html_dom.php");


//print_r(priority_list());


// = url_test($media_url,$url_target);

$array_url = array();
foreach (priority_list("where `priority_status`='1' order by `priority_url` asc") as $list){
	$url = Balikin($list[1]); //url get
	
	if(check_internet($url)==1){
	
	$media_name = get_media_from_url($url);
	$media_url = Balikin(get_media_from_media_data($media_name,'media_url'));
	
		echo $url.PHP_EOL.PHP_EOL;
		$html = file_get_html($url);
		foreach($html->find('a') as $data){
			$url_get = $data->href;
			//$url_get = real_url($url_get);
			
			
			if(valid_url($url_get)==1){
				$enable = check_prefix_enable($url_get);
				
				if($enable>0){
					array_push($array_url,$url_get);
				}
			}
			else{
				$url_get = real_url($media_url.$url_get);
				$enable = check_prefix_enable($url_get);
				
				if($enable>0){
					array_push($array_url,$url_get);
				}
			}
		}
		
	}
	
}
$uniq = array_map('unserialize', array_unique(array_map('serialize', $array_url)));
print_r($uniq);


?>
