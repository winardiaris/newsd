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
function rss_list($order){
	
	$rss_list_array = array();
	$rss_list_query = mysql_query("select * from `rss_data` $order ")or die(mysql_error());
	
	while($data = mysql_fetch_array($rss_list_query)){
		array_push($rss_list_array,array($data['rss_id'],$data['rss_name'],Balikin($data['rss_url'])));
	}
	
	return $rss_list_array;
}
?>
