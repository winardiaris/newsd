<?php
function priority_check($priority_id){
	$q = mysql_query("select * from `priority` where `priority_id`='$priority_id'")or die(mysql_error());
	$d = mysql_num_rows($q);
	return $d;
}
function priority_save($priority_url){
	$priority_id = md5($priority_url);
	$priority_url = UbahSimbol($priority_url);
	
	if(priority_check($priority_id)==0){
		$q = mysql_query("insert into `priority` values('$priority_id','$priority_url','1')")or die(mysql_error());
		if($q){
			send_notif("priority save");
		}
	}
	else{
		send_notif("priority in use");
	}
}
function priority_list($where=null){
	$priority_list_array = array();
	$priority_list_query = mysql_query("select * from `priority` $where ")or die(mysql_error());
	
	while($data = mysql_fetch_array($priority_list_query)){
		array_push($priority_list_array,array($data['priority_id'],Balikin($data['priority_url']),$data['priority_status']));
	}
	
	return $priority_list_array;
}
function priority_delete($priority_id){
	$q = mysql_query("update `priority` set `priority_status`='2' where `priority_id`='$priority_id'")or die(mysql_error());
	if($q){
		send_notif("priority deleted");
	}
}




?>
