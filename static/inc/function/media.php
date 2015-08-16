<?php
function media_check_from_db($media_id){
	$media_check_from_db = mysql_query("select * from `media` where `media_id`='$media_id'")or die(mysql_error());
	$count = mysql_num_rows($media_check_from_db);
	return $count;
}
function media_save($media_name,$media_url){
	$media_name = strtolower($media_name);
	$media_id 	= str_replace(" ","_",$media_name);
	
	if(valid_url($media_url)==true){
		$media_url	= UbahSimbol(real_url($media_url));
		
		if(url_get_domain($media_url)!="v3.mercusuar.info"){
			if(media_check_from_db($media_id)==0){
				$media_save = mysql_query("insert into `media` values('$media_id','$media_name','$media_url')")or die(mysql_error());
				if($media_save){
					send_notif("media saved");
				}else{
					send_notif("media cant save");
				}
					
			}
			else{
				send_notif("media in use");
			}
		}
		else{
			send_notif("is not valid URL");
		}
		
		
	}
	else{
		send_notif("is not valid URL");
	}
	
	
	
}
function media_list($order){
	
	$media_list_array = array();
	$media_list_query = mysql_query("select * from `media` $order ")or die(mysql_error());
	
	while($data = mysql_fetch_array($media_list_query)){
		array_push($media_list_array,array($data['media_id'],$data['media_name'],Balikin($data['media_url'])));
	}
	
	return $media_list_array;
}

function get_media_from_url($url){
	$url = explode("/",$url);
	$url = $url[2];
	$find_media_from_url_query = mysql_query("select * from `media` where `media_url` like '%$url%' limit 1")or die(mysql_error());
	$data = mysql_fetch_array($find_media_from_url_query);
	
	return $data['media_name'];
	
	
}

function media_prefix_check($media_prefix_id){
	$media_prefix_query = mysql_query("select * from `media_prefix` where `media_prefix_id`='$media_prefix_id'")or die(mysql_error());
	$count = mysql_num_rows($media_prefix_query);
	return $count;
}

function media_prefix_save($media_prefix_url,$media_prefix_container,$media_prefix_title,$media_prefix_date,$media_prefix_date_split,$media_prefix_news_content,$media_prefix_writer,$media_prefix_image,$media_){
	$media_prefix_id 				= md5($media_prefix_url);
	$media_prefix_url 			= UbahSimbol($media_prefix_url);
	$media_ 							= UbahSimbol($media_);
	$media_prefix_container 	= UbahSimbol($media_prefix_container);
	$media_prefix_title 			= UbahSimbol($media_prefix_title);
	$media_prefix_date 			= UbahSimbol($media_prefix_date);
	$media_prefix_date_split	= UbahSimbol($media_prefix_date_split);
	$media_prefix_news_content	= UbahSimbol($media_prefix_news_content);
	$media_prefix_writer 		= UbahSimbol($media_prefix_writer);
	$media_prefix_image 			= UbahSimbol($media_prefix_image);
	
	if(media_prefix_check($media_prefix_id)==0){
		$media_prefix_query = mysql_query("
									insert into `media_prefix`  
									(`media_prefix_id` ,`media_prefix_url`,`media_prefix_container` ,`media_prefix_title` ,`media_prefix_date` ,`media_prefix_date_split` ,`media_prefix_news_content` ,`media_prefix_writer` ,`media_prefix_image`,`media_`) 
									values
									('$media_prefix_id','$media_prefix_url','$media_prefix_container','$media_prefix_title','$media_prefix_date','$media_prefix_date_split','$media_prefix_news_content','$media_prefix_writer','$media_prefix_image','$media_')")or die(mysql_error());
		
		if($media_prefix_query){
			send_notif("media prefix saved");
		}
		else{
			send_notif("failed");
		}
	}

}
function media_prefix_update($media_prefix_id,$media_prefix_url,$media_prefix_container,$media_prefix_title,$media_prefix_date,$media_prefix_date_split,$media_prefix_news_content,$media_prefix_writer,$media_prefix_image,$media_,$media_prefix_status){
	
	$media_prefix_url 			= UbahSimbol($media_prefix_url);
	$media_ 							= UbahSimbol($media_);
	$media_prefix_container 	= UbahSimbol($media_prefix_container);
	$media_prefix_title 			= UbahSimbol($media_prefix_title);
	$media_prefix_date 			= UbahSimbol($media_prefix_date);
	$media_prefix_date_split	= UbahSimbol($media_prefix_date_split);
	$media_prefix_news_content	= UbahSimbol($media_prefix_news_content);
	$media_prefix_writer 		= UbahSimbol($media_prefix_writer);
	$media_prefix_image 			= UbahSimbol($media_prefix_image);
	$media_prefix_status			= UbahSimbol($media_prefix_status);
	
	$media_prefix_query = mysql_query("
								
								update `media_prefix` set 
								`media_`='$media_', 
								`media_prefix_container`='$media_prefix_container', 
								`media_prefix_title`='$media_prefix_title',
								`media_prefix_date`='$media_prefix_date',
								`media_prefix_date_split`='$media_prefix_date_split',
								`media_prefix_news_content`='$media_prefix_news_content',
								`media_prefix_writer`='$media_prefix_writer',
								`media_prefix_image`='$media_prefix_image',
								`media_prefix_status`='$media_prefix_status' 
								where 
								`media_prefix_id`='$media_prefix_id'
								
								
								
								
								")or die(mysql_error());
	
	if($media_prefix_query){
		send_notif("media prefix updated");
	}
	else{
		send_notif("failed");
	}
}

function media_prefix_list($status){
	if($status!="all"){
		$where="WHERE `media_prefix_status`='$status' ";
	}
	else{
		$where = "";
	}
	$media_prefix_array = array();
	$media_prefix_query = mysql_query("select * from `media_prefix` $where order by rand() ")or die(mysql_error());
	
	while($data = mysql_fetch_array($media_prefix_query)){
		array_push($media_prefix_array,
			array(
				$data['media_prefix_url'],
				$data['media_prefix_container'],
				$data['media_prefix_title'],
				$data['media_prefix_date'],
				$data['media_prefix_date_split'],
				$data['media_prefix_news_content'],
				$data['media_prefix_writer'],
				$data['media_prefix_image'],
				$data['media_prefix_status'],
				$data['media_']
			)
		);
	}
	
	return $media_prefix_array;
}


//skip
function media_skip($media_name){
	$media_skip=mysql_query("select * from `media_skip` where `media_name`='$media_name' ")or die (mysql_error());
	$count = mysql_num_rows($media_skip);
	return $count;
}








?>
