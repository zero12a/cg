<?php
header("Content-Type: text/html; charset=UTF-8");
header("Cache-Control:no-cache");
header("Pragma:no-cache");


$CFG = include_once("./incConfig.php");

if(!include_once './include/incUtil.php')		echo "include fail(3)";

require_once("./include/incUser.php");
include_once('./include/incAuth.php');//CG AUTH

$objAuth = new authObject();	
//echo "11";

//파라미터 검사
$F_PASSWD = trim( $_POST["pw"] );

if($F_PASSWD == "") 	MsgBack("empty");

//비밀번호 맞는지 검사
if( $F_PASSWD == "1234" ){
	//echo "22";

	$REQ["USR_SEQ"] = 1;
	$REQ["USR_ID"] = "zero12a";
	setUserSeq($REQ["USR_SEQ"]);
	setUserId($REQ["USR_ID"]);

	$objAuth->setLastSession($REQ["USR_SEQ"],session_id());
	unset($objAuth);
	
	MsgGo("good","bo_menu");
		
}
else
{
	echo "33";
	MsgBack("not good");
}


?>