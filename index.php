<?php
include ("static/inc/con.php");
include ("static/inc/function.php"); 
include ("static/inc/conf.php");
include ("form/header.php");

if(!empty($_GET['m'])){
	$m = $_GET['m'];
	switch($m){
		case "dashboard":
			$view = "form/dashboard.php";
			break;
		case "media":
			$view = "form/media.php";
			break;
		case "media_prefix":
			$view = "form/media_prefix.php";
			break;
		case "news_content":
			$view = "form/news_content.php";
			break;
		case "read_news":
			$view = "form/read_news.php";
			break;
		case "list_url":
			$view = "form/list_url.php";
			break;
		case "rss":
			$view = "form/rss.php";
			break;
		
			
		default:
			$view = "form/404.php";
			break;
	}

include $view;
}
else{
	header("location:?m=dashboard");
}

include("form/footer.php");

?>
