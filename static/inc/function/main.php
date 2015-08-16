<?php
function check_content($kode,$title){
	$check_content1 = mysql_query("select * from `data` where `kode`='$kode'")or die(mysql_error());
	$count1 = mysql_num_rows($check_content1);
	
	$title = UbahSimbol($title)   ;
	$check_content2 = mysql_query("select * from `data` where `title`='$title'")or die(mysql_error());
	$count2 = mysql_num_rows($check_content1);
	
	return $count1+$count2;
}

function save_content($kode,$media,$title,$date,$image,$news_content,$writer,$url){

	$NOW = date("Y-m-d H:i:s");
	
	
	if(check_content($kode,$title)==0){
		$save_content = mysql_query("
							insert into `data`
							(`kode`,`media`,`title`,`date`,`image`,`news_content`,`writer`,`url`,`status`,`created`) 
	                  values
	                  ('$kode','$media','$title','$date','$image','$news_content','$writer','$url','1','$NOW')
							" )or die(mysql_error());
		if($save_content){
			update_status_url($kode);
			return 1;
		}else{return 0;}
	}
}

function update_status_url($url_id){
	$update_status_url = mysql_query("update `url_data` set `url_status`='1' where `url_id`='$url_id'")or die(mysql_error());
	if($update_status_url){
		return 1;
	}
	else{
		return 0;
	}
	
}





?>
