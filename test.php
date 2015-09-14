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
		$url="http://www.tribunnews.com";
		$media_name = get_media_from_url($url);
		$media_url = Balikin(get_media_from_media_data($media_name,'media_url'));

		$html = file_get_html($url);
		foreach($html->find('a') as $data){
			$url_get = $data->href;
			//$url_get = real_url($url_get);
			
			//if(exclude($url_get)==0){
				//if(valid_url($url_get)==1){
					
					//url_save($url_get,$url_from);
					////$enable = check_prefix_enable($url_get);
					
					////if($enable>0){
						////array_push($array_url,$url_get);
					////}
				//}
				//elseif($media_name=='cnn indonesia'){
					//$a = explode("//",$url_get);
					//$url_get = real_url($a[1]);
					
					//url_save($url_get,$url_from);
					////$enable = check_prefix_enable($url_get);
					////if($enable>0){
						////array_push($array_url,$url_get);
					////}
				//}
				
				//elseif(valid_url($url_get)==0){
					//$url_get = real_url($media_url.$url_get);
					//url_save($url_get,$url_from);
					
					////$enable = check_prefix_enable($url_get);
					////if($enable>0){
						////array_push($array_url,$url_get);
					////}
				//}
			//}
			echo $url_get.PHP_EOL;
		}
		echo $media_name."=>".$media_url.PHP_EOL;


?>
