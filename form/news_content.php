<h3>News Content</h3>
<?php
	$media=ifset('me');
	$page=ifset('p');
	$search=ifset('se');
	$tgl1=ifset('tgl1');
	$tgl2=ifset('tgl2');
	$status=ifset('st');
	$searched=ifset('searched');
	
	
	//category
	$category = ifset('category');
	
	if(empty($media)){header("location:?m=news_content&me=all&st=all&searched=&p=&se=&tgl1=&tgl2=");}
	elseif(empty($page)){$page=1;}
	
	
    CreateSearch();

	echo '
		<table class="table">
			<tr>
				<td>';
					CreateMenuMedia();echo'</td>
				<td>';CreateSearchDate();echo'</td>
			</tr>
		</table>';
?>
</div><!-- well well-sm -->
<div class="well-sm well-me"><?php CreatePagination($DataPerPage,$media,$search,$tgl1,$tgl2);?>
<div class="table-responsive">
	<table class="table  table-hover table-striped" >
		<thead>
		<tr>
			<!-- <th width="50px"></th> -->
			<th width="50px">No.</th>
			<th width="100px">Publish</th>
			<th >Media</th>
			<th align="left">News Title</th>
		</tr>
		</thead>
		<tbody>
		<?php
			
			$WHERE="WHERE";
			if(!empty($media)){
				if($media!="all"){$WHERE .=" `media`='$media' AND ";}
				else{$WHERE .="";}
			}
			if(!empty($search)){
				$WHERE .=" (`title` LIKE '%$search%' OR `date` LIKE '%$search%' OR `writer` LIKE '%$search%'  ) AND ";
			}
			if(!empty($tgl1) AND !empty($tgl2)){
				$WHERE .=" (`date` BETWEEN '$tgl1' and '$tgl2') AND ";
			}
			else{$WHERE .="";}
				

			$WHERE = substr($WHERE,0,(strlen($WHERE)-5));
			if(!empty($page)){$p=$page;}else{$p=0;} //page
			$NO=($p-1)*$DataPerPage;
			$LIMIT = "LIMIT ".$NO.",".$DataPerPage;
			$q="SELECT * FROM `data` ".$WHERE."  ORDER BY `date` DESC ".$LIMIT;
			$qry=mysql_query($q) or die(mysql_error());
			
				
			while($data=mysql_fetch_array($qry)){
				$NO++;
				echo '
				<tr>
					<td align="right">'.$NO.'.</td>
					<td align="center" ><a href="?m='.ifset('m').'&me='.$media.'&st='.$status.'&searched='.$searched.'&tgl1='.$data['date'].'&tgl2='.$data['date'].'"">'.$data['date'].'</a></td>
					<td align="center"><a href="?m='.ifset('m').'&me='.$data['media'].'&st='.$status.'&searched='.$searched.'&tgl1='.$tgl1.'&tgl2='.$tgl2.'">'.$data['media'].'</a></td>
					<td><a class="linkthumb" href="?m=read_news&op=edit&kode='.$data['kode'].'"  >'.html_entity_decode(Balikin($data['title'])).'</a></td>
				</tr>
				';
			}
					
		?>
		</tbody>
	</table>
</div>
	<?php //echo "<textarea cols='200' rows='2' class='form-control'>".$q."</textarea>"; ?>
</div>
<!--
///category
-->
<script>
	<?php
	    if(!empty($category)){
				$category_ = explode(";",$category);
				$count_category = count($category_);
				for($i=1;$i<$count_category;$i++){
					$category__=explode(":",$category_[$i]);
					$category_name = $category__[0];
					$category_data = $category__[1];
					
					print("$(\"div.category select[name='".$category_name."'] \").val('".$category_data."');\n ");
				}
			}
	
	?>
</script>
	
 
