<?php
if(isset($_POST['priority_save'])){
	$priority_url = $_POST['priority_url'];
	priority_save($priority_url);
	
}
elseif(isset($_GET['op'])){
	$op = ifset('op');
	
	if($op=='delete'){
		$id=ifset('id');
		
		priority_delete($id);
	}
}


?>
<h3 id="priority">Priority</h3>
<form name="priority" action="?m=<?php echo ifset('m');?>" method="post">
	<label>Priority URL:</label>
		<div class="input-group">
			<div class="input-group-addon">http://</div>
			<input name="priority_url" class="form-control">
		</div>
	<hr>
	<button type="submit" name="priority_save" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
</form>
<hr>

<table class="table table-striped table-hover" id="priority-table">
	<thead>
	<tr>
		<th></th>
		<th>No</th>
		<th>URL</th>
	</tr>
	</thead>
	<tbody>
		<?php
		foreach(priority_list("where `priority_status`='1' order by `priority_url` asc") as $list){
		
	echo '<tr>
		<td><a href="?m='.ifset('m').'&op=delete&id='.$list[0].'" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
		<td width="50px;" align="right">'.$NO1++.'</td>
		<td><a href="'.Balikin($list[1]).'" target="_blank">'.Balikin($list[1]).'</a></td>
		
	</tr>';
		}
	?>
	</tbody>

</table>

