<?php
function save_header($kode,$search,$url,$media,$time,$title,$created){
	$qry = mysql_query("select count(`kode`) as `ada` from `data` where `kode`='$kode' limit 1")or die(mysql_error());
	$data = mysql_fetch_array($qry);
	$ada = $data['ada'];
	
	if($ada==0){
		save1($kode,$search,$url,$media,$time,$title,$created);
	}else{
		update_search($kode,$search);
	}
}
function save1($kode,$search,$url,$media,$time,$title,$created){
	$search = UbahSimbol($search);
	$title = UbahSimbol($title);
	$url = UbahSimbol($url);
	$time = UbahBulan($time);
	
	$save = mysql_query("insert into `data` (`kode`,`search`,`url`,`media`,`title`,`title`,`created`) values ('$kode','$search','$url','$media','$title','$time','$created')  ")or die(mysql_error());
	if($save){echo ' <span class="label label-success">saved</span>';}else{echo ' <span class="label label-danger">not saved !!</span> ';}
}
function get_data($from,$str,$field){
	$qry = mysql_query("SELECT * FROM `data` WHERE `$from`='$str' ") or die(mysql_error());
	$data = mysql_fetch_array($qry);
		if($field == 'ids')
			return $data['ids'];
		elseif($field == 'kode')
			return $data['kode'];
		elseif($field == 'media')
			return $data['media'];
		elseif($field == 'title')
			return $data['title'];
		elseif($field == 'title')
			return $data['title'];
		elseif($field == 'image')
			return $data['image'];
		elseif($field == 'news_content')
			return $data['news_content'];
		elseif($field == 'writer')
			return $data['writer'];
		elseif($field == 'url')
			return $data['url'];
		elseif($field == 'status')
			return $data['status'];
		elseif($field == 'search')
			return $data['search'];
		elseif($field == 'city')
			return $data['city'];
		elseif($field == 'tags')
			return $data['tags'];
		elseif($field == 'created')
			return $data['created'];
}
function min_max($type,$str){
	$qry = mysql_query("SELECT max($str) as `max`, min($str) as `min` from `data`")or die(mysql_error());
	$data = mysql_fetch_array($qry);
	if($type=="min"){
		return $data['min'];
	}
	else{
		return $data['max'];
	}
}

function update_search($kode,$search){
	$last_search = get_data('kode',$kode,'search');
	$pos = strpos($last_search, $search);
	if ($pos === false) {
		$new_search = $last_search.",".$search;
		mysql_query("UPDATE `data` SET `search`='$new_search' WHERE `kode`='$kode'");
	} 	
}

function go_to($str,$kode){
	$qry2 = mysql_query("SELECT  max(`ids`) as `max`, min(`ids`) as `min` FROM `data`")or die(mysql_error());
	$data2 = mysql_fetch_array($qry2);
	$max=$data2['max'];
	$min=$data2['min'];
	
	if($str=="next"){
		$ids = get_data('kode',$kode,'ids');
		if($ids==$max){
			$go_to=get_data('ids',$min,'kode');	
		}else{
			$go_to=get_data('ids',$ids+1,'kode');
		}		
	}
	elseif($str=="prev"){
		$ids = get_data('kode',$kode,'ids');
		if($ids==$min){
			$go_to=get_data('ids',$max,'kode');
		}else{
			$go_to=get_data('ids',$ids-1,'kode');	
		}
	}
	return $go_to;
}
function View(){
	if(isset($_GET['kode'])){
		$qry = "SELECT * FROM `data` WHERE `kode`='".$_GET['kode']."'";
	}
	elseif(isset($_GET['ids'])){
		$qry = "SELECT * FROM `data` WHERE `ids`='".$_GET['ids']."'";
	}
	
	$result = mysql_query($qry)or die(mysql_error());
	$data = mysql_fetch_array($result);
	echo '
	<div class="row">
	<form method="POST" action="?m='.ifset('m').'&l='.ifset('l').'&a='.ifset('a').'&kode='.$data['kode'].'">
		<div class="col-lg-10">
		   <h3>'.html_entity_decode(Balikin($data['title']), ENT_NOQUOTES, 'UTF-8').'</h3>
		   <small>'.strtoupper(Balikin($data['media'])).' | '.Balikin($data['title']).' | '.Balikin($data['writer']).'</small>
			<small><a class="" target="_blank" href="'.Balikin($data['url']).'" title="Visit Link">Visit url</a></small>
			
			<div class="pull-right">
			<a href="?m='.ifset('m').'&l='.ifset('l').'&op='.ifset('op').'&kode='.go_to('prev',$data['kode']).'" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> </a>
			<a href="?m='.ifset('m').'&l='.ifset('l').'&op='.ifset('op').'&kode='.go_to('next',$data['kode']).'" class="btn btn-sm btn-default"><i class="fa fa-arrow-right"></i> </a>
			</div>
			
			 <br><br>
			<textarea name="news_content" class="form-control" rows="15">'.html_entity_decode(Balikin($data['news_content'])).'</textarea>
		
		</div>
		
		<!-- sidebar --------------------------------------------------------------------------------------------- -->
		<div class="col-lg-2">
			<img class="thumbnail center" src="'.Balikin($data['image']).'" style="width:180px; margin:0 auto 0 auto;">
		
		
			<label>Status :</label>
			<select name="status" class="form-control">
				<option value="1"';if($data['status']==1){echo 'selected="selected"';} echo'>Not Checked</option>
				<option value="2"';if($data['status']==2){echo 'selected="selected"';} echo'>Positive</option>
				<option value="3"';if($data['status']==3){echo 'selected="selected"';} echo'>Negative</option>
				<option value="4"';if($data['status']==4){echo 'selected="selected"';} echo'>Delete</option>
			</select>
			<button type="submit" class="btn btn-primary" name="simpan"><i class="fa fa-save"></i> Save</button>
			<!-- <a href="?m='.ifset('m').'&l='.ifset('l').'&op=reload&kode='.ifset('kode').'"><button type="button" class="btn btn-primary" name="reload"><i class="fa fa-refresh"></i> Reload</button></a> -->
			
			
		
		</div>
	</form>
	</div>';	
	//set_automatic_category(ifset('kode'),Balikin($data['news_content']));
	
}

function save_data($kode,$image,$news_content,$writer){
	$news_content = UbahSimbol($news_content);
	$writer = UbahSimbol($writer);
	//$city = SetCity(strtolower($news_content));
	//$tags = SetTags(strtolower($news_content));
	
	set_automatic_category($kode,$news_content);


	//DOWNLOAD IMAGE
	if(Settings('GetPhoto')=="1"){
		$pos = strpos($image,"https");
		
		if($pos == false){
			$type = explode(".",$image);
			$type = end($type);
			$type = explode("?",$type);
			$type = $type[0];
			$images = "img/image/".$kode.".".$type;
			
			//Get the file
			$content = file_get_contents($image);
			//Store in the filesystem.
			$fp = fopen($images, "w");
			fwrite($fp, $content);
			fclose($fp);
		}	
	}
	else{
		$images=$image;
	}
	
	//$qry ="UPDATE `data` SET  `image`='$images', `writer`='$writer', `news_content`='$news_content' , `city`='$city', `tags`='$tags', `status`='1' WHERE `kode`='$kode'";
	$qry ="UPDATE `data` SET  `image`='$images', `writer`='$writer', `news_content`='$news_content' , `status`='1' WHERE `kode`='$kode'";
	$save = mysql_query($qry) OR DIE (mysql_error());
	
	if($save){echo ' <span class="label label-info">saved</span>';}else{echo ' <span class="label label-danger">not saved !!</span> ';}
	
}

function save_all_data($kode){
	$media 	= get_data('kode',$kode,'media');
	$status 	= get_data('kode',$kode,'status');
	$target 	= Balikin(get_data('kode',$kode,'url'));
	
	if($status==0){
		include ("form/module/".$media."/get_content.php");
	}
}

function update_data($kode,$news_content,$status){
	$kode 	= UbahSimbol($kode);
	$news_content	= UbahSimbol($news_content);
	
	$qry 		= mysql_query("UPDATE `data` SET `news_content`='$news_content', `status`='$status' WHERE `kode`='$kode'")or die(mysql_error());
	if($qry){
		send_notif("Data has been saved");
	}
}
function getCount($media,$WHERE,$title){
	if(!empty($WHERE)){
		$WHERE=$WHERE." AND";
	}else{
		$WHERE="WHERE ";
	}
	$q = mysql_query("SELECT count(*) as `count`  FROM `data` $WHERE `title` LIKE '$title%' AND `media`='$media';")or die(mysql_error());
	$d = mysql_fetch_array($q);
	
	return $d['count'];
}


function ShowMedia(){
	$x = mysql_query("SELECT DISTINCT `media` FROM `data` ORDER BY `media` ASC")or die(mysql_error());
	$media="";
	while($xx = mysql_fetch_array($x)){
		$media .= ",".$xx['media'];
	}	
	$ShowMedia = substr($media,1,strlen($media));
	return $ShowMedia;
}
function ShowStatus(){
	$x = mysql_query("SELECT DISTINCT `status` FROM `data` ORDER BY `status` ")or die(mysql_error());
	$status="";
	while($xx = mysql_fetch_array($x)){
		$status .= ",".$xx['status'];
	}	
	$ShowStatus = substr($status,1,strlen($status));
	return $ShowStatus;
}
function ShowSearch(){
	$x = mysql_query("SELECT DISTINCT `search` FROM `data` ORDER BY `search` ")or die(mysql_error());
	$search="";
	while($xx = mysql_fetch_array($x)){
		$search .= ",".$xx['search'];
	}	
	$ShowSearch = substr($search,1,strlen($search));
	$ShowSearch = explode(',', $ShowSearch);
	asort($ShowSearch);
	$ShowSearch = implode(',',array_unique($ShowSearch));

	return $ShowSearch;
}
function ShowTags(){
	$x = mysql_query("SELECT * FROM `tags` ORDER BY `tags` ")or die(mysql_error());
	$tags="";
	while($xx = mysql_fetch_array($x)){
		$tags .= ",".$xx['tags'];
	}	
	$ShowTags = substr($tags,1,strlen($tags));
	return $ShowTags;
}
function ShowCity(){
	$x = mysql_query("SELECT * FROM `city` ORDER BY `city` ")or die(mysql_error());
	$city="";
	while($xx = mysql_fetch_array($x)){
		$city .= ",".$xx['city'];
	}	
	$ShowCity = substr($city,1,strlen($city));
	return $ShowCity;
}


//alter table `data`
function alter_data($str){
	$fields = mysql_list_fields(__DB_NAME__, 'data');
	$columns = mysql_num_fields($fields);
	for ($i = 0; $i < $columns; $i++) {$field_array[] = mysql_field_name($fields, $i);}
	
	if (!in_array($str, $field_array)){
		$qry = mysql_query("ALTER TABLE `data` ADD `$str` VARCHAR(100) NOT NULL AFTER `search`;")or die(mysql_error());
		if($qry){
			return 1;
		}
		else{
			return 0;
		}
	}
}


//category
function set_automatic_category($kode,$str){
	$str = strtolower($str);
	$x=0;
	
	$qry_automatic = mysql_query("select `category_name` from `category` where `automatic`='1'")or die(mysql_error());
	while ($data_automatic=mysql_fetch_array($qry_automatic)){
		$x++;
		$push[$x]="";
		$push="";
		
		$qry_category_list = mysql_query("SELECT * FROM `".$data_automatic['category_name']."`")or die(mysql_error());
		while($data_category_list=mysql_fetch_array($qry_category_list)){
			
			$category = strtolower($data_category_list['data']);
			$pos = strpos($str,$category);
			if ($pos == true) {
				$push .=",".$category;
			}
			
		}
		//update category_* in data
		$push=substr($push,1,strlen($push));
		$update = mysql_query("update `data` set `".$data_automatic['category_name']."`='".$push."' where `kode`='$kode'")or die(mysql_error());
	}
	
	
}
function list_category($str){
	if($str!="all"){
		$where = "WHERE `automatic`='$str'";}
	else{
		$where ="";}
	
	$array= array();
	$qry = mysql_query("select * from `category` $where ") or die(mysql_error());
	
	while($data=mysql_fetch_row($qry)){
		array_push($array,array($data[0],$data[1]));
	}
	return $array;
	
}
function add_category($str,$automatic){
	$str = str_replace(" ","-",$str);
	$qry = mysql_query("SHOW TABLES LIKE 'category_".$str."' ;") or die(mysql_error());
	$ada = mysql_num_rows($qry);
	if($ada>0){
		return 0;
	}
	else{
		$qry = mysql_query("CREATE TABLE `category_".$str."` (`id` int(11) PRIMARY KEY AUTO_INCREMENT,`data` VARCHAR(50));") or die(mysql_error());
		$qry2 = mysql_query("insert into `category` values('category_".$str."','".$automatic."')") or die(mysql_error());
		
		
		if($qry){
			alter_data("category_".$str);
			return 1;
		}
		else{
			return 2;
		}
	}
	//0 in use
	//1 success
	//2 failed
	
}
function delete_category($category_name){
	$delete_1 = mysql_query("ALTER TABLE `data` DROP `$category_name`")or die(mysql_error());
	$delete_2 = mysql_query("DROP TABLE IF EXISTS `$category_name`")or die(mysql_error());
	$delete_3 = mysql_query("DELETE FROM `category` WHERE `category_name`='$category_name' ")or die(mysql_error());
	if($delete_1 || $delete_2 || $delete_3){
		send_notif("Delete category succefully");
	}
}

function show_category_data($str){
	$array = array();
	$qry=mysql_query("select * from `$str` order by `data` asc" ) or die(mysql_error());
	while($data=mysql_fetch_array($qry)){
		array_push($array,array($data['id'],$data['data']));
	}
	return $array;
}
function save_category_data($category,$data){
	$ck_ 	= mysql_query("select `data` from `$category` where `data`='$data'")or die(mysql_error());
	$ck 	= mysql_num_rows($ck_);
	if($ck>0){
		return 0;
	}
	else{
		$qry = mysql_query("insert into `$category` (`data`) values('$data')")or die(mysql_error());
		if($qry){
			return 1;
		}
		else{
			return 2;
		}
	}
	//0 in use
	//1 success
	//2 failed

}
function delete_category_data($category,$id){
	$qry = mysql_query("delete from `$category` where `id`='$id'")or die(mysql_error());
	if($qry){
		send_notif("Success");
	}
	else{
		send_notif("failed");
	}
}
function update_category_data($category,$id,$data){
	$qry = mysql_query("update `$category` set `data`='$data' where `id`='$id'")or die(mysql_error());
	if($qry){
		return 1;
	}
	else{
		return 0;
	}
	//0 failed
	//1 success
}









?>
