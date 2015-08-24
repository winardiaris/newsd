<?php
	$edit="";
	if(isset($_POST['rss_save'])){
		$rss_url = ifset('rss_url');
		$rss_media = ifset('rss_media');
		
		$pos = strpos($rss_url,"http://");
		if($pos === false){
			$rss_url = "http://".$rss_url;
		}

		rss_save($rss_url,$rss_media);
	}
	elseif(isset($_GET['op'])){
		$op=$_GET['op'];
		if($op=="delete"){
			$id=ifset('id');
			
			$q = mysql_query("update `rss_data` set `rss_status`='2' where `rss_id`='$id'")or die(mysql_error());
			send_notif("delete success");
			
		}
	}

?>

<h3 id="rss">RSS</h3>


<!-- rss add -->
<form name="rss_add" action="?m=<?php echo ifset('m');?>" method="post">
	<label>RSS URL</label>
		<div class="input-group ">
			<div class="input-group-addon">http://</div>
			<input name="rss_url" class="form-control clear">
		</div>
	<label>Media:</label>
	<select class="form-control" name="rss_media" >
			<?php
				foreach(media_list('order by `media_name`') as $list){
					echo '<option value="'.$list[0].'"';
					      if($edit==1){
								if($list[0]==$rss_media){
									echo " selected ";
								}
							}
					echo '>'.$list[0].'</option>';
					
				}			
			?>
			</select>
	<hr>
	<button type="submit" name="rss_save" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
</form>
<hr>

<table class="table table-striped table-bordered table-hover" id="rss-table">
	<thead>
		<tr>
			<th>action</th>
			<th>no</th>
			<th>RSS Media</th>
			<th>url</th>
		</tr>
	</thead>
	<tbody>
		<?php
		 $qry = mysql_query("select * from `rss_data` where `rss_status` !='2' order by `rss_media` asc ")or die(mysql_error());
		 $q = "";$no=1;
		 while($data=mysql_fetch_array($qry)){
			   $q .='<tr>
					<td><a href="?m='.ifset('m').'&op=delete&id='.$data['rss_id'].'" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
					<td align="right" width="60px">'.$no++.'</td>
					<td>'.$data['rss_media'].'</td>
					<td><a href="'.Balikin($data['rss_url']).'" target="_blank">'.Balikin($data['rss_url']).'</a></td>
			   </tr>';	 
		 }
		 echo $q;
		?>
	</tbody>
</table>
<hr>


<?php 


?>


