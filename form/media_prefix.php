<?php
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
	elseif(isset($_GET['op'])){
		$op=$_GET['op'];
		if($op=="UbahXXX"){
			$data = UbahXXX($_GET['data']);
			
			echo $data;
			
		}
		
	}
	else{
?>

<!-- --------------------------------------------------------------------------------------------------------------------------- -->
<h3 id="media_prefix">Media prefix for get a News content</h3>
<form name="media_prefix" method="post" action="?m=<?php echo ifset('m');?>">
		<label>Media URL prefix</label>
			<input name="media_prefix_url" class="form-control" placeholder="www.domain.com/read/  (without http:// or https://)"> 
		<label>Media</label>
		<select class="form-control" name="media_">
			<?php
				foreach(media_list('order by `media_name`') as $list){echo '<option value="'.$list[0].'">'.$list[0].'</option>';}			
			?>
			</select>
		<label>Content Container</label>
			<input name="media_prefix_container" class="form-control" placeholder="html element like jquery selector (ex:  div.article)"> 
		<label>Title</label>
			<input name="media_prefix_title" class="form-control" placeholder="html element like jquery selector (ex:  title)"> 
			<table class="table">
				<tr>
					<th>date element</th>
					<th>test your date text</th>
					<th>date value with format YYYY-MM-DD</th>
				</tr>
				<tr>
					<td>
						<input name="media_prefix_date" class="form-control" placeholder="html element like jquery selector (ex:   div.date)">
					</td>
					<td>
						<input name="media_prefix_date_test" class="form-control" placeholder="copy your text contained in the element " id="UbahXXX">
					</td>
					<td>
						<input name="media_prefix_date_split" class="form-control" placeholder="order of the text by a space. example (3|2|1)">
					</td>
				</tr>
			</table>	
		<label>News Content</label>
			<input name="media_prefix_news_content" class="form-control" placeholder="html element like jquery selector (ex:  div#article)"> 
		<label>Writer</label>
			<input name="media_prefix_writer" class="form-control" placeholder="html element like jquery selector (ex:  td#writer)">
		<label>Media Image</label>
			<input name="media_prefix_image" class="form-control" placeholder="html element like jquery selector (ex:  img.photos)">
		
		<hr>
		<button type="submit" name="media_prefix_save" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
</form>
<hr>
<div class="table-responsive" id="media_prefix_data">
<table class="table table-striped table-bordered table-hover " id="media-table2">
	<thead>
		<tr>
			<th>no</th>
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
		 $qry = mysql_query("select * from `media_prefix` order by `media_prefix_url` asc ")or die(mysql_error());
		 $q = "";$no=1;
		 while($data=mysql_fetch_array($qry)){
			   $q .='<tr>
					<td align="right" width="60px">'.$no++.'</td>
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
}
?>
