<?php
function rss_check_from_db($rss_id){
	$rss_check_from_db = mysql_query("select * from `rss_data` where `rss_id`='$rss_id'")or die(mysql_error());
	$count = mysql_num_rows($rss_check_from_db);
	return $count;
}
function rss_save($rss_url,$rss_media){
	$rss_id 	= md5($rss_url);
	
	if(valid_url($rss_url)==true){
		$rss_url	= UbahSimbol(real_url($rss_url));
		
		
			if(rss_check_from_db($rss_id)==0){
				$rss_save = mysql_query("insert into `rss_data` values('$rss_id','$rss_media','$rss_url','1')")or die(mysql_error());
				if($rss_save){
					send_notif("rss saved");
				}else{
					send_notif("rss cant save");
				}
					
			}
			else{
				send_notif("rss in use");
			}
	}
	else{
		send_notif("is not valid URL");
	}
	
	
	
}
function rss_list($order=null){
	
	$rss_list_array = array();
	$rss_list_query = mysql_query("select * from `rss_data` $order ")or die(mysql_error());
	
	while($data = mysql_fetch_array($rss_list_query)){
		array_push($rss_list_array,array($data['rss_id'],$data['rss_media'],Balikin($data['rss_url'])));
	}
	
	return $rss_list_array;
}

function find_element_from_rss($rss_url,$find_element=null){
	$rss = simplexml_load_file($rss_url);
	$rss_list_array=array();
	foreach($rss->channel->item as $item){
		if(!isset($find_element)){
			$finded = (string) $item->link;
		}
		else{
			$finded = (string) $item->$find_element;
		}
		array_push($rss_list_array,$finded);
	}
	return $rss_list_array;
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
		url_save($url,"1");
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
