<?php
include ("static/inc/con.php");
include ("static/inc/function.php");
include ("static/inc/simple_html_dom.php");

//remove exluded
//$q = mysql_query("select * from `exclude`")or die(mysql_error());
//while($d=mysql_fetch_array($q)){
	//$qq = mysql_query("select * from `url_data` where `url` like '%".UbahSimbol($d['exclude'])."%'") or die(mysql_error());
	//while($dd = mysql_fetch_array($qq)){
		//echo Balikin($dd['url']).PHP_EOL;
		//mysql_query("delete from `url_data` where `url_id`='".$dd['url_id']."' and `url_status`='0'")or die(mysql_error());
	//}
	
//}

//test
foreach(media_list("where `media_url` like '%tribun%' order by rand()") as $media_list){
	$url = $media_list[2];
		//$url="http://www.mediakaltara.com/";
		$media_name = get_media_from_url($url);
		$media_url = Balikin(get_media_from_media_data($media_name,'media_url'));
		

		$html = file_get_html($url);
		foreach($html->find('a') as $data){
			$url_get = $data->href;
			
			
			if(exclude($url_get)==0){
				$bb = explode("://",$url_get);
				
				if(valid_url($url_get)==1){
					
					echo $url_get.PHP_EOL;
					//url_save($url_get,$url_from);
				}
				elseif($media_name=='cnn indonesia'){
					$a = explode("//",$url_get);
					$url_get = real_url($a[1]);
					echo $url_get.PHP_EOL;
					
					//url_save($url_get,$url_from);
				}
				elseif(valid_url($url_get)==0){
					$url_get = real_url($media_url.$url_get);
					//url_save($url_get,$url_from);
					
					$url_get = str_replace("//","/",$url_get);
					$url_get = str_replace(":/","://",$url_get);
				
					echo $url_get.PHP_EOL;
				}
				
				
			}
			
		}
		echo $media_name."=>".$media_url.PHP_EOL;

}
?>
