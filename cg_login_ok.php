<?php

header("Content-Type: text/html; charset=UTF-8");
if(!include_once './include/incUtil.php')		echo "include fail(3)";
require_once("./incConfig.php");

echo "11";

//파라미터 검사
$F_PASSWD = trim( $_POST["pw"] );

if($F_PASSWD == "") 	MsgBack("empty");

//비밀번호 맞는지 검사
if( $F_PASSWD == "kimsclub" ){
	echo "22";
	//로그인 처리
	$_SESSION["CG_USR_SEQ"] = 1;
	
	MsgGo("good","bo_menu.php");
		
}
else
{
	echo "33";
	MsgBack("not good");
}


?>