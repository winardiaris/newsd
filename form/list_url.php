<?php
$media = ifset('media');

  echo '<h3>List URL</h3>
		<label>Media</label>
		<select class="form-control" name="media"  onchange="window.location.href=$(this).val();">';
				foreach(media_list('order by `media_name`') as $list){echo '<option value="?m='.ifset('m').'&media='.$list[0].'"'; if($media==$list[0]){echo "selected";}echo' >'.$list[0].'</option>';}			
		echo '</select> <hr>
		';
//////list url
if($media){
	
	$media = UbahSimbol($media);
	$q=mysql_query("select * from `url_data` where `url_status`='0' and `url` like '%$media%' order by `url` asc")or die(mysql_error());
	$count = mysql_num_rows($q)+1;
	echo "<textarea class='form-control' rows='20'>";
	while($d=mysql_fetch_array($q)){
		echo Balikin($d['url']).PHP_EOL;
	}
	echo "</textarea>";	
}

?>
