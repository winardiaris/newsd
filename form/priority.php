<?php
if(isset($_POST['priority_save'])){
	$priority_url = $_POST['priority_url'];
	priority_save($priority_url);
	
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
		foreach(priority_list() as $list){
		
	echo '<tr>
		<td></td>
		<td width="50px;" align="right">'.$NO1++.'</td>
		<td>'.Balikin($list[1]).'</td>
		
	</tr>';
		}
	?>
	</tbody>

</table>

