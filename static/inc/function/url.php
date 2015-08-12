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

function url_test($url_target){
	if(check_internet($url_target)==1){
		$html = file_get_html($url_target);
	   $url_array=array();
		foreach($html->find('a') as $data){
			$url_get = $data->href;
			$valid_url = valid_url($url_get);
			$exclude = exclude($url_get);
			$check_domain = check_domain_from_db_media($url_get);
			
			
			if($valid_url==1){
				if($exclude==0){
					if($check_domain>0){
						array_push($url_array,$url_get);
					}
				}
			}
			else{
				
				
			}
	
			//echo $url_get." valid = ".$valid_url." exclude=".$exclude." domain = ".$check_domain."<br>";
		}
		
		return $url_array;	
	}
}


function url_get($url_target){	
	$array=url_test($url_target);
	
	if($array!=0){
		$count = 0;
		$uniq = array_map('unserialize', array_unique(array_map('serialize', $array)));
		
		foreach($uniq as $urls){
			$url_id = md5($urls);
			if(check_url_from_db($url_id)==0){
				printf($urls.PHP_EOL);
				$count += url_save($urls);
			}
			
		}
		
		if($count<5){
			$count_2="";
			$qry = mysql_query("select * from `url_data` where `url` like '%".UbahSimbol($url_target)."%' and `url_status`='1' limit 50 ")or die(mysql_error());
			//$qry = mysql_query("select * from `url_data` where `url` like '%detik.%' and `url_status`='1' limit 50 ")or die(mysql_error());
			while($data=mysql_fetch_array($qry)){
				$array=url_test(Balikin($data['url']));
				
				//bagian ini yang dirubah terkahir kali
				if($array!=0){
					$uniq = array_map('unserialize', array_unique(array_map('serialize', $array)));
					
					foreach($uniq as $urls){
						$url_id = md5($urls);
						if(check_url_from_db($url_id)==0){
							printf($urls.PHP_EOL);
							$count_2 += url_save($urls);
						}
						
					}
				}
				
			}
			if($count_2<5){
				$count_1="";
				$qry = mysql_query("select * from `url_data` where `url` like '%".UbahSimbol($url_target)."%' order by rand() limit 50 ")or die(mysql_error());
				//$qry = mysql_query("select * from `url_data` where `url` like '%detik.%' order by rand() limit 50 ")or die(mysql_error());
				while($data=mysql_fetch_array($qry)){
					$array=url_test(Balikin($data['url']));
					
					//bagian ini yang dirubah terkahir kali
					if($array!=0){
						$uniq = array_map('unserialize', array_unique(array_map('serialize', $array)));
						
						foreach($uniq as $urls){
							$url_id = md5($urls);
							if(check_url_from_db($url_id)==0){
								printf($urls.PHP_EOL);
								$count_1 += url_save($urls);
							}
							
						}
					}
					
				}
				
				
			}
			
			
		}	
	}
	
	//echo $count."<br>";
	
	
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


function url_save($url){
	$count		= 0;
	$url_id		= md5($url);
	$url			= UbahSimbol($url);
	$url_status	= 0;
	
	$url_query = mysql_query("insert into `url_data` values('$url_id','$url','$url_status')")or die(mysql_error());
	
	if($url_query){
		$count +=1;
	}
	else{
		$count +0;
	}

	return $count;
}
function url_find_media_prefix($url_prefix){
	$url_prefix = UbahSimbol($url_prefix);
	$array = array();
	$qry = mysql_query("select * from `url_data`  where `url` like '%$url_prefix%'  and `url_status`='0' order by `url`");
	while($data=mysql_fetch_array($qry)){
		array_push($array,array($data['url_id'],$data['url'],$data['url_status']));
	}
	return $array;
	
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
