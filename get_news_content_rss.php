<?php
include ("static/inc/con.php");
include ("static/inc/function.php");
include ("static/inc/simple_html_dom.php");

//
//	#$url_from,
//	1 = media;
//	2 = priority
//	3 = rss
//	#prefix_status
//	null = null
//  1 = active
//	2 = deleted
//  #show_get_content
// 	0=not show content on debug
// 	1=show content on debug
//	#save_content
//	0 = not save
//	1 = allow save
//	function get_content($url_from,$prefix_status=null,$show_get_content=null,$save_content=null)

get_content(3,1,0,1);

?>
