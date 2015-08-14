<?php
function UbahSimbol($str){
	$str = trim(htmlentities(htmlspecialchars($str)));
	$search = array ("'\''",
						"'%'",
						"'@'",
						"'_'",
						"'1=1'",
						"'/'",
						"'!'",
						"'<'",
						"'>'",
						"'\('",
						"'\)'",
						"';'",
						"'-'",
						"'_'",
						"'\['",
						"'\]'",
						"'\,'"
					);

	$replace = array ("xpsijix",
						"xprsnx",
						"xtkeongx",
						"xgwahx",
						"x1smdgan1x",
						"xgmringx",
						"xpentungx",
						"xkkirix",
						"xkkananx",
						"xkkurix",
						"xkkurnanx",
						"xkommax",
						"xstrix",
						"xstripbwhx",
						"xsiku1x",
						"xsiku2x",
						"xkomax"
					);

	$str = preg_replace($search,$replace,$str);
	return $str;
	
}
function Balikin($str){
	$search = array ("'xpsijix'",
						"'xprsnx'",
						"'xtkeongx'",
						"'xgwahx'",
						"'x1smdgan1x'",
						"'xgmringx'",
						"'xpentungx'",
						"'xkkirix'",
						"'xkkananx'",
						"'xkkurix'",
						"'xkkurnanx'",
						"'xkommax'",
						"'xstrix'",
						"'xstripbwhx'",
						"'&quot;'",
						"'xsiku1x'",
						"'xsiku2x'",
						"'xkomax'");

	$replace = array ("'",
						"%",
						"@",
						"_",
						"1=1",
						"/",
						"!",
						"<",
						">",
						"(",
						")",
						";",
						"-",
						"_",
						"'",
						"[",
						"]",
						","
						);

	$str = preg_replace($search,$replace,$str);

	return $str;
 }
function UbahXXX($str){
	$str = trim(htmlentities(htmlspecialchars($str)));
	$search = array ("'\''",
						"'%'",
						"'@'",
						"'_'",
						"'1=1'",
						"'/'",
						"'!'",
						"'<'",
						"'>'",
						"'\('",
						"'\)'",
						"';'",
						"'-'",
						"'_'",
						"'\['",
						"'\]'",
						"'\.'",
						"':'",
						"'  '",
						"'\,'"
					);

	$replace = array (" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						" ",
						""
					);

	$str = preg_replace($search,$replace,$str);
	return $str;
	
}
 
function UbahBulan1($str){
	$str = trim(htmlentities(htmlspecialchars($str)));
	$search = array ("'Januari'","'Februari'","'Maret'","'April'","'Mei'","'Juni'","'Juli'","'Agustus'","'September'","'Oktober'","'Nopember'","'Desember'");
	$replace = array ("01","02","03","04","05","06","07","08","09","10","11","12");
	$str = preg_replace($search,$replace,$str);
	return $str;
}
function UbahBulan2($str){
	$str = trim(htmlentities(htmlspecialchars($str)));
	$search = array ("'January'","'February'","'March'","'April'","'May'","'June'","'July'","'August'","'September'","'October'","'November'","'December'");
	$replace = array ("01","02","03","04","05","06","07","08","09","10","11","12");
	$str = preg_replace($search,$replace,$str);
	return $str;
}
function UbahBulan3($str){
	$str = trim(htmlentities(htmlspecialchars($str)));
	$search = array ("'Jan'","'Feb'","'Mar'","'Apr'","'May'","'Jun'","'Jul'","'Agu'","'Sep'","'Okt'","'Nov'","'Des'");
	$replace = array ("01","02","03","04","05","06","07","08","09","10","11","12");
	$str = preg_replace($search,$replace,$str);
	return $str;
}
function UbahBulan($str){
	$str=UbahBulan1($str);
	$str=UbahBulan2($str);
	$str=UbahBulan3($str);
	return $str;
	
}

function ifset($str){
	if(isset($_GET[$str])){
		return $_GET[$str];
	}
	elseif(isset($_POST[$str])){
		return $_POST[$str];
	}
	else{
		$a ="";
		return $a;
	}
}
function real_url($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Must be set to true so that PHP follows any "Location:" header
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$a = curl_exec($ch); // $a will contain all headers

	$url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL); // This is what you need, it will return you the last effective URL
	return $url; // Voila
}

function valid_url($url){
	if(!filter_var($url,FILTER_VALIDATE_URL ) === false){
		return 1;
	}
	else{
		return 0;
	}
}



//setting
function Settings($name){
	$x = mysql_query("SELECT `value` FROM `setting` WHERE `name`='$name'") or die(mysql_error());
	$xx = mysql_fetch_array($x);
	$Setting = $xx['value'];
	return $Setting;
}

function SaveSettings($name,$value){
	if(!isset($value)){
		$value="0";
	}
	$qry=mysql_query("UPDATE `setting` SET `value`='$value' WHERE `name`='$name'") or die(mysql_error());
	
}
function SaveUser($UserGroup,$UserName,$UserRealName,$UserPassword,$UserRePassword){
	if($UserRePassword != $UserPassword){
		echo "User password not same";
	}
	else{
		$q = mysql_query("INSERT INTO `user` (`group_id`,`user_name`,`user_real_name`,`user_password`,`created`)
								VALUES ('$UserGroup','$UserName','$UserRealName','".md5($UserRePassword)."','$NOW')")
						or die(mysql_error());
		header("location:".$_SESSION['uri']);
	}
	
}
function UpdateUser($UserId,$UserGroup,$UserName,$UserRealName,$UserPassword,$UserRePassword){
	if($UserRePassword != $UserPassword){
		echo "User password not same";
	}
	else{
		$q = mysql_query("UPDATE `user` SET `group_id`='$UserGroup',`user_name`='$UserName',`user_real_name`='$UserRealName',`user_password`='".md5($UserRePassword)."',`last_change`='$NOW' WHERE `user_id`='$UserId' ")or die(mysql_error());
		header("location:".$_SESSION['uri']);
	}
	
}
//last login
function setLastLogin($user_id){
	mysql_query("UPDATE `user` SET `last_login`='$NOW' WHERE `user_id`='$user_id'") or die(mysql_error());
}
//history
function setHistory($user_id,$log_location,$log_message,$log_time){
	mysql_query("INSERT INTO `system_log` (`user_id`,`log_location`,`log_message`,`log_time`) VALUES('$user_id','$log_location','$log_message','$log_time') ") OR DIE(mysql_error());
	return true;
}
function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}
//notif
function send_notif($str){
	//echo '<script>alert("'.$str.'");history.back();</script>';
	echo '<script>alert("'.$str.'");</script>';
}

function check_internet($target){
	$aa = get_headers($target, 1);
	if($aa[0]=='HTTP/1.1 200 OK'){
		return 1;
	}
	else{
		return 0;
	}
}
?>
