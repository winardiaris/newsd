<?php
 function check_url_from_db($url_id){
	$qry = mysql_query("SELECT count(*) as `ada` FROM `url_data` WHERE `url_id`='$url_id'")or die(mysql_error());
	$data = mysql_fetch_array($qry);
	if($data['ada']>0){
		return 1;
	}
	else{
		return 0;
	}
}
function url_get($url,$url_from){
	if(check_internet($url)==1){
	
		$media_name = get_media_from_url($url);
		$media_url = Balikin(get_media_from_media_data($media_name,'media_url'));
		

		$html = file_get_html($url);
		foreach($html->find('a') as $data){
			$url_get = $data->href;
			if(exclude($url_get)==0){
				
				if(valid_url($url_get)==1){
					//echo $url_get.PHP_EOL;
					url_save($url_get,$url_from);
				}
				elseif($media_name=='cnn indonesia'){
					$a = explode("//",$url_get);
					$url_get = real_url($a[1]);
					//echo $url_get.PHP_EOL;
					url_save($url_get,$url_from);
				}
				elseif(valid_url($url_get)==0){
					$url_get = real_url($url_get);
					$url_get = str_replace("//","/",$url_get);
					$url_get = str_replace(":/","://",$url_get);
				
					//echo $url_get.PHP_EOL;
					url_save($url_get,$url_from);
				}		
			}		
		}
	}	
}



function url_get_domain($url){
	$pieces = parse_url($url);
  $domain = isset($pieces['host']) ? $pieces['host'] : '';
  if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
    return $regs['domain'];
  }else{
	return false;  
  }
}

function check_domain_from_db_media($url){
	$found = 0;
	$domain = url_get_domain($url);
	foreach(media_list("order by `media_name`") as $media_list){
		$media_domain = url_get_domain($media_list[2]);
		if($media_domain == $domain){
			$found +=1;
		}
		else{
			$found +=0;
		}
	}
	return $found;
}



function url_save($url,$from=null){
	$count		= 0;
	$url_id		= md5($url);
	$url		= UbahSimbol($url);
	
	if(check_url_from_db($url_id)==0){
		$url_query = mysql_query("insert into `url_data` values('$url_id','$url','0','$from')")or die(mysql_error());
		
		if($url_query){
			$count +=1;
		}
		else{
			$count +0;
		}
	}
	

	return $count;
}
function find_url_like_prefix($url_prefix){
	$url_prefix = UbahSimbol($url_prefix);
	$array = array();
	$qry = mysql_query("select * from `url_data`  where `url` like '%$url_prefix%'  and `url_status`='0' order by `url`");
	while($data=mysql_fetch_array($qry)){
		array_push($array,array($data['url_id'],$data['url'],$data['url_status']));
	}
	return $array;
	
}
function find_url_from_db($where){
	$array = array();
	$qry = mysql_query("select * from `url_data` $where ")or die(mysql_error());
	while($data=mysql_fetch_array($qry)){
		array_push($array,array($data['url_id'],$data['url'],$data['url_status'],$data['url_from']));
	}
	return $array;
}

function check_prefix_enable($url_get){
	$ada = 0;
	foreach(list_media_prefix('1') as $list){
		
		$url_prefix = $list[0];
		$url_get = UbahSimbol($url_get);
		$pos = strrpos($url_get,$url_prefix);
		
		if($pos == true){
			$ada += 1;
		}
		
	}
	return $ada	;
}


function exclude($url){
	$found=0;
	$qry = mysql_query("select * from `exclude`");
	while($data=mysql_fetch_row($qry)){
	   $pos = strpos($url,$data[1]);
		if($pos ===  false){
			$found +=0;
		}
		else{
			$found +=1;
		}
	}
	return $found;
}

?>
