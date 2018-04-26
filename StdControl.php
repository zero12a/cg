<?php
header("Content-Type: text/html; charset=UTF-8");
header("Cache-Control:no-cache");
header("Pragma:no-cache");

include_once('StdService.php');
include_once('./include/incUtil.php');
include_once('./include/incDB.php');
include_once('./incConfig.php');



alog("StdControl___________________________start");

//컨트롤 명령 받기
$ctl = "";
$ctl1 = $_GET["CTLGRP"];
$ctl2 = $_GET["CTLFNC"];

if($ctl1 == "" || $ctl2 == ""){
	JsonMsg("500","100","처리 명령이 입력되지 않았습니다.(no input ctl)");
}else{
	$ctl = $ctl1 . "_" . $ctl2;
}

//파라미터 받기(컨디션받기 및 폼뷰받기, 그리드XML)
$REQ["PJTID"] = "CG";
$REQ["PGMID"] = "TEST2";
$REQ["GRPID"] = "G1";
$REQ["FNCID"] = "FNC1";
$REQ["G2_FNCTYPE"] = "D";

//$xml_array = getXml2Array($_POST["xmldata"]);

//서비스 클래스 생성
$objService = new StdService();


//컨트롤 명령별 분개처리
alog("ctl:" . $ctl);
switch ($ctl){
	case "GRID1_SEARCH1" :
		echo $objService->goGrid1Search1();
		break;

	case "GRID1_SAVE2" :
		echo $objService->goGrid1Save2();
		break;

	case "FORMVIEW2_SEARCH1" :
		echo $objService->goFormview2Search1();
		break;
		
	case "FORMVIEW2_SAVE2" :
		echo $objService->goFormview2Save2();
		break;

	case "FORMVIEW2_DELETE3" :
		echo $objService->goFormview2Delete3();
		break;

	default:
		JsonMsg("500","110","처리 명령을 찾을 수 없습니다. (no search ctl)");
		break;
}

//서비스 클래스 비우기
unset($objService);

alog("StdControl___________________________end");

?>
Thanks
