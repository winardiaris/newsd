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

function url_test($media_url,$url_target){
	if(check_internet($url_target)==1){
		$html = file_get_html($url_target);
		$url_array=array();
		foreach($html->find('a') as $data){
			$url_get = $data->href;
			$valid_url = valid_url($url_get);
			$exclude = exclude($url_get);
			$check_domain = check_domain_from_db_media($url_get);
			$check_prefix_enable = check_prefix_enable($url_get);

			if($valid_url==1){
				if($exclude==0){
					if($check_domain>0){
						if($check_prefix_enable>0){
							array_push($url_array,$url_get);
						}
					}
				}
			}
			else{
				$url_get = real_url($media_url.$url_get);
				
				$valid_url = valid_url($url_get);
				$exclude = exclude($url_get);
				$check_domain = check_domain_from_db_media($url_get);
				
				
				if($valid_url==1){
					if($exclude==0){
						if($check_domain>0){
							if($check_prefix_enable>0){
								array_push($url_array,$url_get);
							}
						}
					}
				}
				
				
			}
	
			//echo $url_get." valid = ".$valid_url." exclude=".$exclude." domain = ".$check_domain."<br>";
		}
		
		return $url_array;	
	}
}


function url_get($media_url,$url_target){	
	
	$array=url_test($media_url,$url_target);
	if($array!=0){
		$uniq = array_map('unserialize', array_unique(array_map('serialize', $array)));
		
		foreach($uniq as $urls){
			$url_id = md5($urls);
			if(check_url_from_db($url_id)==0){
				//printf($urls.PHP_EOL);
				url_save($urls);
			}
		}
		
		
		foreach(media_list("order by rand()") as $media_list){
			$media_url0 = Balikin($media_list[2]);
			$array0=url_test($media_url0,$media_url0);
			if($array0!=0){
				$uniq0 = array_map('unserialize', array_unique(array_map('serialize', $array0)));
				
				foreach($uniq0 as $urls0){
					$url_id0 = md5($urls0);
					if(check_url_from_db($url_id0)==0){
						//printf($urls0.PHP_EOL);
						url_save($urls1);
					}
					
				}
			}
		}
		
		
		$qry1 = mysql_query("select * from `url_data` where `url` like '%".UbahSimbol($media_url)."%' and `url_status`='1' limit 20 ")or die(mysql_error());
		while($data1=mysql_fetch_array($qry1)){
			$array1=url_test($media_url,Balikin($data1['url']));
			
			
			if($array1!=0){
				$uniq1 = array_map('unserialize', array_unique(array_map('serialize', $array1)));
				
				foreach($uniq1 as $urls1){
					$url_id1 = md5($urls1);
					if(check_url_from_db($url_id1)==0){
						//printf($urls1.PHP_EOL);
						url_save($urls1);
					}
					
				}
			}
			
		}
		//------------
		$qry2 = mysql_query("select * from `url_data` where `url` like '%".UbahSimbol($media_url)."%' order by rand() limit 20 ")or die(mysql_error());
		while($data2=mysql_fetch_array($qry2)){
			$array2=url_test($media_url2,Balikin($data2['url']));
			
			if($array2!=0){
				$uniq2 = array_map('unserialize', array_unique(array_map('serialize', $array2)));
				
				foreach($uniq2 as $urls2){
					$url_id2 = md5($urls2);
					if(check_url_from_db($url_id2)==0){
						//printf($urls2.PHP_EOL);
						url_save($urls2);
					}
					
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


function url_save($url,$status=null){
	$count		= 0;
	$url_id		= md5($url);
	$url		= UbahSimbol($url);
	$url_status	= 0; //0= belum terdapat data berita
	if(!isset($status)){
		$url_query = mysql_query("insert into `url_data` values('$url_id','$url','$url_status')")or die(mysql_error());
	}
	else{
		$url_query = mysql_query("insert into `url_data` values('$url_id','$url','$status')")or die(mysql_error());
	}
	
	
	
	
	if($url_query){
		$count +=1;
	}
	else{
		$count +0;
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
	   $pos = strpos($url,$data[0]);
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
