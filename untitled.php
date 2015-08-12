<?php
	include("static/inc/function.php");


	$url_="batam.tribunnews.com/";
	$media = UbahSimbol("batam.tribunnews");
	$container = UbahSimbol("div#article");
	$title = UbahSimbol("h1");
	$date = UbahSimbol("div.grey h3");
	$date_split =UbahSimbol("3|2|1");
	$news_content = UbahSimbol("div.txt-article");
	$writer = UbahSimbol("div[class=f11 grey]");
	$image = UbahSimbol("div.imgfull_div img");

	$a="";
	$sql = "INSERT INTO `newsd`.`media_prefix` (`media_prefix_id`, `media_`, `media_prefix_url`, `media_prefix_container`, `media_prefix_title`, `media_prefix_date`, `media_prefix_date_split`, `media_prefix_news_content`, `media_prefix_writer`, `media_prefix_image`, `media_prefix_status`) VALUES ".PHP_EOL;
	for($thn=2008;$thn<=2016;$thn++){
		$x="";
		for($bln=1;$bln<=12;$bln++){
			if($bln<10){
				$bln = "0".$bln;
			}
			$url = $url_.$thn."/".$bln."/";
			$id = md5($url) ;
	
				$x .= "('".$id."','".$media."','".UbahSimbol($url)."','".$container."','".$title."','".$date."','".$date_split."','".$news_content."','".$writer."','".$image."','1'),".PHP_EOL;
				
		}
		$a .=$x;
	}
	
	
	$sql .=$a;
	$sql = substr($sql,0,-2);
	
	echo $sql;
	
	//$url_="batam.tribunnews.com/";
	//$media = UbahSimbol("batam.tribunnews");
	//$container = UbahSimbol("div#article");
	//$title = UbahSimbol("h1");
	//$date = UbahSimbol("h3");
	//$date_split =UbahSimbol("3|2|1");
	//$news_content = UbahSimbol("div.txt-article");
	//$writer = UbahSimbol("div[class=f11 grey]");
	//$image = UbahSimbol("div.imgfull_div img");

	//$a="";
	//$sql = "delete from  `newsd`.`media_prefix` where  ";
	//for($thn=2008;$thn<=2016;$thn++){
		//$x="";
		//for($bln=1;$bln<=12;$bln++){
			//$url = $url_.$thn."/".$bln."/";
			//$id = md5($url) ;
	
				//$x .= "`media_prefix_id`='".$id."' or "   ;
				
		//}
		//$a .=$x;
	//}
	
	
	//$sql .=$a;
	//$sql = substr($sql,0,-4);
	
	//echo $sql;
?>
