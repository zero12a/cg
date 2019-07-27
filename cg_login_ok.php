<?php
header("Content-Type: text/html; charset=UTF-8");
header("Cache-Control:no-cache");
header("Pragma:no-cache");


if(!include_once './include/incUtil.php')		echo "include fail(3)";
require_once("./incConfig.php");
require_once("./include/incUser.php");

echo "11";

//파라미터 검사
$F_PASSWD = trim( $_POST["pw"] );

if($F_PASSWD == "") 	MsgBack("empty");

//비밀번호 맞는지 검사
if( $F_PASSWD == "1234" ){
	echo "22";


	setUserSeq(1);


	
	MsgGo("good","bo_menu");
		
}
else
{
	echo "33";
	MsgBack("not good");
}


?>