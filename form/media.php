<?php
	if(isset($_POST['media_save'])){
		$media_name = ifset('media_name');
		$media_url = ifset('media_url');
		
		$pos = strpos($media_url,"http://");
		if($pos === false){
			$media_url = "http://".$media_url;
		
			$check = substr($media_url,-1);
				if($check !="/"){
					$media_url = $media_url."/";
				}
		}

		media_save($media_name,$media_url);
	}
	else{
		
	

?>

<h3 id="media">Media</h3>


<!-- media add -->
<form name="media_add" action="?m=<?php echo ifset('m');?>" method="post">
	<label>Media Name:</label>
		<input name="media_name" class="form-control">
	<label>Media URL</label>
		<div class="input-group">
			<div class="input-group-addon">http://</div>
			<input name="media_url" class="form-control">
		</div>
	<hr>
	<button type="submit" name="media_save" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
</form>
<hr>

<table class="table table-striped table-bordered table-hover" id="media-table">
	<thead>
		<tr>
			<th>no</th>
			<th>media</th>
			<th>url</th>
		</tr>
	</thead>
	<tbody>
		<?php
		 $qry = mysql_query("select * from `media` ")or die(mysql_error());
		 $q = "";$no=1;
		 while($data=mysql_fetch_array($qry)){
			   $q .='<tr>
					<td align="right" width="60px">'.$no++.'</td>
					<td>'.$data['media_name'].'</td>
					<td><a href="'.Balikin($data['media_url']).'" target="_blank">'.Balikin($data['media_url']).'</a></td>
			   </tr>';	 
		 }
		 echo $q;
		?>
	</tbody>
</table>
<hr>


<?php 

//top else
}

?>


