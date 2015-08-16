<?php
include ("static/inc/con.php");
include ("static/inc/function.php");
include ("static/inc/simple_html_dom.php");


if(isset($_GET['op'])){
	$op=$_GET['op'];
	$data = $_GET['data'];
	
	if($op=="UbahXXX"){
		echo UbahXXX(UbahXXX($data));
	}
	
	
}



?>
