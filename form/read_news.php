<div class="col-lg-12">

<?php
	$op = ifset('op');
	$kode = ifset('kode');
	$ids = ifset('ids');
	
	if(isset($kode)){
		$media = get_data('kode',$kode,'media');
		$status = get_data('kode',$kode,'status');
		
		View();

		if(isset($_POST['simpan'])){
			$news_content = $_POST['news_content'];
			$status = $_POST['status'];
			update_data($kode,$news_content,$status);
		}
	}
	else{
		header("location:?m=news_content");
	}	

	
	

?>
</div>
<script type="text/javascript" src="static/tinymce/tinymce.min.js"></script>
<script type="text/javascript">tinymce.init({selector: "textarea"});</script>





