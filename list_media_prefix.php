<?php
  include ("static/inc/con.php");
  
  $gui = "<table>";
	$q = mysql_query("select * from `media_prefix` order by `media_prefix_url` ")or die(mysql_error());
	while($data = mysql_fetch_array($q)){
		$gui .='<tr>
				<td class="kode">'.$data['media_prefix_id'].'</td>
				<td class="media">'.$data['media_'].'</td>
				<td class="url">'.$data['media_prefix_url'].'</td>
				<td class="container">'.$data['media_prefix_container'].'</td>
				<td class="title">'.$data['media_prefix_title'].'</td>
				<td class="date">'.$data['media_prefix_date'].'</td>
				<td class="date_split">'.$data['media_prefix_date_split'].'</td>
				<td class="news">'.$data['media_prefix_news_content'].'</td>
				<td class="writer">'.$data['media_prefix_writer'].'</td>
				<td class="image">'.$data['media_prefix_image'].'</td>
				<td class="status">'.$data['media_prefix_status'].'</td>
				</tr>';
	
	}
	echo $gui;

?>
