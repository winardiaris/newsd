<?php
 	$edit="";
 	
 	if(isset($_POST['media_prefix_save'])){
		$media_prefix_url				= UbahSimbol($_POST['media_prefix_url']);
		$media_							= UbahSimbol($_POST['media_']);
		$media_prefix_container		= UbahSimbol($_POST['media_prefix_container']);
		$media_prefix_title 			= UbahSimbol($_POST['media_prefix_title']);
		$media_prefix_date 			= UbahSimbol($_POST['media_prefix_date']);
		$media_prefix_date_split	= UbahSimbol($_POST['media_prefix_date_split']);
		$media_prefix_news_content	= UbahSimbol($_POST['media_prefix_news_content']);
		$media_prefix_writer  		= UbahSimbol($_POST['media_prefix_writer']);
		$media_prefix_image 			= UbahSimbol($_POST['media_prefix_image']);
		
		
		//echo $media_prefix_url				;
		//echo $media_prefix_title 			;
		//echo $media_prefix_date 			;
		//echo $media_prefix_date_split	;
		//echo $media_prefix_news_content	;
		//echo $media_prefix_writer  		;
		//echo $media_prefix_image 			;
		
		media_prefix_save($media_prefix_url,$media_prefix_container,$media_prefix_title,$media_prefix_date,$media_prefix_date_split,$media_prefix_news_content,$media_prefix_writer,$media_prefix_image,$media_);
	}
	elseif(isset($_POST['media_prefix_update'])){
		$media_prefix_id				= $_POST['media_prefix_id'];
		$media_prefix_url				= UbahSimbol($_POST['media_prefix_url']);
		$media_							= UbahSimbol($_POST['media_']);
		$media_prefix_container		= UbahSimbol($_POST['media_prefix_container']);
		$media_prefix_title 			= UbahSimbol($_POST['media_prefix_title']);
		$media_prefix_date 			= UbahSimbol($_POST['media_prefix_date']);
		$media_prefix_date_split	= UbahSimbol($_POST['media_prefix_date_split']);
		$media_prefix_news_content	= UbahSimbol($_POST['media_prefix_news_content']);
		$media_prefix_writer  		= UbahSimbol($_POST['media_prefix_writer']);
		$media_prefix_image 			= UbahSimbol($_POST['media_prefix_image']);
		$media_prefix_status			= UbahSimbol($_POST['media_prefix_status']);
	
		//send_notif("update");
		media_prefix_update($media_prefix_id,$media_prefix_url,$media_prefix_container,$media_prefix_title,$media_prefix_date,$media_prefix_date_split,$media_prefix_news_content,$media_prefix_writer,$media_prefix_image,$media_,$media_prefix_status);
	}
	elseif(isset($_GET['op'])){
		$op=$_GET['op'];
		if($op=="UbahXXX"){
			$data = UbahXXX($_GET['data']);
			
			echo $data;
			
		}
		elseif($op=="edit"){
			$id=ifset('id');
			$edit=1;
			
			
			$q = mysql_query("select * from `media_prefix` where `media_prefix_id`='$id'")or die(mysql_error());
			$data = mysql_fetch_row($q);
			$media_ =  Balikin($data[1]);
			$media_prefix_url =  Balikin($data[2]);
			$media_prefix_container =  Balikin($data[3]);
			$media_prefix_title =  Balikin($data[4]);
			$media_prefix_date =  Balikin($data[5]);
			$media_prefix_date_split =  Balikin($data[6]);
			$media_prefix_news_content =  Balikin($data[7]);
			$media_prefix_writer =  Balikin($data[8]);
			$media_prefix_image =  Balikin($data[9]);
			$media_prefix_status =  Balikin($data[10]);
			
		}
		elseif($op=="delete"){
			$id=ifset('id');
			
			
			
			$q = mysql_query("update `media_prefix` set `media_prefix_status`='2' where `media_prefix_id`='$id'")or die(mysql_error());
			send_notif("delete success");
			
		}
		
	}

	
	
?>

<!-- --------------------------------------------------------------------------------------------------------------------------- -->
<h3 id="media_prefix">Media prefix for get a News content</h3>
<form name="media_prefix" method="post" action="?m=<?php echo ifset('m');?>">
		<label>Media URL prefix</label>
			<input name="media_prefix_url" class="form-control" placeholder="www.domain.com/read/  (without http:// or https://)" <?php if($edit==1)echo 'value="'.$media_prefix_url.'"'; ?>> 
		<label>Media</label>
		<select class="form-control" name="media_" >
			<?php
				foreach(media_list('order by `media_name`') as $list){
					echo '<option value="'.$list[0].'"';
					      if($edit==1){
								if($list[0]==$media_){
									echo " selected ";
								}
							}
					echo '>'.$list[0].'</option>';
					
				}			
			?>
			</select>
		<label>Content Container</label>
			<input name="media_prefix_container" class="form-control" placeholder="html element like jquery selector (ex:  div.article)" <?php if($edit==1)echo 'value="'.$media_prefix_container.'"'; ?>> 
		<label>Title</label>
			<input name="media_prefix_title" class="form-control" placeholder="html element like jquery selector (ex:  title)" <?php if($edit==1)echo 'value="'.$media_prefix_title.'"'; ?>> 
			<table class="table">
				<tr>
					<th>date element</th>
					<th>test your date text</th>
					<th>date value with format YYYY-MM-DD</th>
				</tr>
				<tr>
					<td>
						<input name="media_prefix_date" class="form-control" placeholder="html element like jquery selector (ex:   div.date)" <?php if($edit==1)echo 'value="'.$media_prefix_date.'"'; ?>>
					</td>
					<td>
						<input name="media_prefix_date_test" class="form-control" placeholder="copy your text contained in the element " id="UbahXXX">
					</td>
					<td>
						<input name="media_prefix_date_split" class="form-control" placeholder="order of the text by a space. example (3|2|1)" <?php if($edit==1)echo 'value="'.$media_prefix_date_split.'"'; ?>>
					</td>
				</tr>
			</table>	
		<label>News Content</label>
			<input name="media_prefix_news_content" class="form-control" placeholder="html element like jquery selector (ex:  div#article)" <?php if($edit==1)echo 'value="'.$media_prefix_news_content.'"'; ?>> 
		<label>Writer</label>
			<input name="media_prefix_writer" class="form-control" placeholder="html element like jquery selector (ex:  td#writer)" <?php if($edit==1)echo 'value="'.$media_prefix_writer.'"'; ?>>  
		<label>Media Image</label>
			<input name="media_prefix_image" class="form-control" placeholder="html element like jquery selector (ex:  img.photos)" <?php if($edit==1)echo 'value="'.$media_prefix_image.'"'; ?>>
			
			<?php 
			
			if($edit==1){
				echo '<input type="hidden" name="media_prefix_id" value="'.$id.'">';
				echo '<input type="hidden" name="media_prefix_status" value="'.$media_prefix_status.'">';
			}
			
			
			?>
		
		<hr>
		<button type="submit" name="<?php if($edit==1)echo 'media_prefix_update'; else echo 'media_prefix_save';?>" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
</form>
<hr>
<div class="table-responsive" id="media_prefix_data">
<table class="table table-striped table-bordered table-hover " id="media-table2">
	<thead>
		<tr>
			<th>no</th>
			<th></th>
			<th>media url prefix</th>
			<th>media</th>
			<th>container</th>
			<th>title</th>
			<th>date</th>
			<th>date order</th>
			<th>news content</th>
			<th>writer</th>
			<th>media image</th>
		</tr>
	</thead>
	<tbody>
		<?php
		 $qry = mysql_query("select * from `media_prefix` where `media_prefix_status`!='2' order by `media_prefix_url` asc ")or die(mysql_error());
		 $q = "";$no=1;
		 while($data=mysql_fetch_array($qry)){
			   $q .='<tr>
					<td align="right" width="60px">'.$no++.'</td>
					<td >
						<a href="?m='.ifset('m').'&op=edit&id='.$data['media_prefix_id'].'" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a>
						<a href="?m='.ifset('m').'&op=delete&id='.$data['media_prefix_id'].'" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
					</td>
					<td>'.Balikin($data['media_prefix_url']).'</td>
					<td>'.Balikin($data['media_']).'</td>
					<td>'.Balikin($data['media_prefix_container']).'</td>
					<td>'.Balikin($data['media_prefix_title']).'</td>
					<td>'.Balikin($data['media_prefix_date']).'</td>
					<td>'.Balikin($data['media_prefix_date_split']).'</td>
					<td>'.Balikin($data['media_prefix_news_content']).'</td>
					<td>'.Balikin($data['media_prefix_writer']).'</td>
					<td>'.Balikin($data['media_prefix_image']).'</td>
			   </tr>';	 
		 }
		 echo $q;
		?>
	</tbody>
</table>
</div>
<hr>
 <div class="table-responsive" id="url_data">
<table class="table table-striped table-bordered table-hover " id="media-table3">

</table>
</div>
<?php

?>
