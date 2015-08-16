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
			
			
			if($valid_url==1){
				if($exclude==0){
					if($check_domain>0){
						array_push($url_array,$url_get);
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
							array_push($url_array,$url_get);
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
			$qry = mysql_query("select * from `url_data` where `url` like '%".UbahSimbol($media_url)."%' and `url_status`='1' limit 50 ")or die(mysql_error());
			//$qry = mysql_query("select * from `url_data` where `url` like '%detik.%' and `url_status`='1' limit 50 ")or die(mysql_error());
			while($data=mysql_fetch_array($qry)){
				$array=url_test($media_url,Balikin($data['url']));
				
				
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
				$qry = mysql_query("select * from `url_data` where `url` like '%".UbahSimbol($media_url)."%' order by rand() limit 50 ")or die(mysql_error());
				//$qry = mysql_query("select * from `url_data` where `url` like '%detik.%' order by rand() limit 50 ")or die(mysql_error());
				while($data=mysql_fetch_array($qry)){
					$array=url_test($media_url,Balikin($data['url']));
					
					
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

function check_url_rss($url_id){
	$qry = mysql_query("SELECT count(*) as `ada` FROM `url_data_tmp` WHERE `url_id`='$url_id'")or die(mysql_error());
	$data = mysql_fetch_array($qry);
	if($data['ada']>0){
		return 1;
	}
	else{
		return 0;
	}
}


function save_url_rss($url){
	$count		= 0;
	$url_id		= md5($url);
	$url		= UbahSimbol($url);
	$url_status	= 0; //0= belum terdapat data berita
	
	if(check_url_rss($url_id)==0){
		$url_query = mysql_query("insert into `url_data_tmp` values('$url_id','$url','$url_status')")or die(mysql_error());
		if($url_query){
			$count +=1;
		}
		else{
			$count +0;
		}
		
	}

	return $count;
}

function find_url_like_prefix_rss($url_prefix){
	$url_prefix = UbahSimbol($url_prefix);
	$array = array();
	$qry = mysql_query("select * from `url_data_tmp`  where `url` like '%$url_prefix%'  and `url_status`='0' order by `url`");
	while($data=mysql_fetch_array($qry)){
		array_push($array,array($data['url_id'],$data['url'],$data['url_status']));
	}
	return $array;
	
}
function delete_tmp($url_id){
	mysql_query("delete from `url_data_tmp` where `url_id`='$url_id'")or die(mysql_error());
}
function update_status_url_rss($url_id,$url){
	//$update_status_url = mysql_query("update `url_data_tmp` set `url_status`='1' where `url_id`='$url_id'")or die(mysql_error());
	
	if(check_url_from_db($url_id)==0){
		
		// move tmp to data  
		save_url($url,"1");
		delete_tmp($url_id);
	}
	
	//if($update_status_url){
		//return 1;
	//}
	//else{
		//return 0;
	//}
	
}




?>
