<?php
	define("__BASE_URL__"	,"http://192.168.2.115/newsd/");
	define("__DB_SERVER__"	,"localhost");
	define("__DB_NAME__"		,"newsd");
	define("__DB_USER__"		,"clipdig");
	define("__DB_PASWD__"	,"clipdig");
	define("__TIMEZONE__"	,"Asia/Jakarta");
	
	mysql_connect(__DB_SERVER__,__DB_USER__,__DB_PASWD__) OR DIE (mysql_error());
	mysql_select_db(__DB_NAME__) OR DIE  (mysql_error());
?>
