<?php
$media = ifset('media');
$from = ifset('from');

  echo '<h3>List URL</h3>
		<label>From</label>
		<select class="form-control" name="media"  onchange="window.location.href=$(this).val();">
			<option value="?m='.ifset('m').'&from=1&media='.ifset('media').'"'; if($from==1) echo "selected"; echo' >Media</option>
			<option value="?m='.ifset('m').'&from=2&media='.ifset('media').'"'; if($from==2) echo "selected"; echo' >Priority</option>
			<option value="?m='.ifset('m').'&from=3&media='.ifset('media').'"'; if($from==3) echo "selected"; echo' >RSS</option>
			
		</select>
		
		<label>Media</label>
		<select class="form-control" name="media"  onchange="window.location.href=$(this).val();">';
				foreach(media_list('order by `media_name`') as $list){echo '<option value="?m='.ifset('m').'&from='.ifset('from').'&media='.$list[0].'"'; if($media==$list[0]){echo "selected";}echo' >'.$list[0].'</option>';}			
		echo '</select> <hr>
		';
//////list url
$where="where";
if($media){
	$where .= "`url` like '%$media%' AND ";
}

if($from){
	$where .= "`url_from`='$from' AND ";	
}
$where = substr($where,0,-5);

//echo $where;

if($from or $media){
$media = UbahSimbol($media);
	$q=mysql_query("select * from `url_data`  $where  order by `url` asc")or die(mysql_error());
	$count = mysql_num_rows($q)+1;
	
	echo '<div style="height:380px;overflow: auto;" class="well well-sm">';
	while($d=mysql_fetch_array($q)){
		echo $NO1++.'.<a href="'.Balikin($d['url']).'" target="_blank">'.Balikin($d['url']).'</a><div class="pull-right">'.$d['url_status'].'</div><br>'.PHP_EOL;
	}
	
	echo '</div>';

}

?>
