<?php
header("Content-Type: text/html; charset=UTF-8"); //SVRCTL
header("Cache-Control:no-cache");
header("Pragma:no-cache");
include_once('validmngService.php');
include_once('../include/incUtil.php');//CG UTIL
include_once('../include/incDB.php');//CG DB
include_once('../include/incSEC.php');//CG SEC
include_once('../incConfig.php');//CG CONFIG
alog("ValidmngControl___________________________start");

//컨트롤 명령 받기
$ctl = "";
$ctl1 = $_GET["CTLGRP"];
$ctl2 = $_GET["CTLFNC"];


if($ctl1 == "" || $ctl2 == ""){
	JsonMsg("500","100","처리 명령이 잘못되었습니다.(no input ctl)");
}else{
	$ctl = $ctl1 . "_" . $ctl2;
}
//권한정보 세션에서 받기
alog("session cg_auth:" . $_SESSION['CG_AUTH']);
$sessAuth = json_decode($_SESSION['CG_AUTH'],true); //true줘야 일반 배열이 되고, true없으면 stdclass()가 됨

//권한정보 검사하기 in_array("aix", $os)
if(in_array($ctl,$sessAuth["VALIDMNG"])){
  //JsonMsg("500","130",$ctl . " 권한이 있습니다.");
}else{
  JsonMsg("500","120",$ctl . " 권한이 없습니다.");
}
$REQ["F3_CTLCUD"] = $_POST["F3_CTLCUD"];
//FILE먼저 : C1, 조회조건
//FILE먼저 : G2, 목록
//FILE먼저 : F3, 상세

//C1, 조회조건
$REQ["C1_PJTSEQ"] = $_POST["C1_PJTSEQ"];//PJTSEQ
$REQ["C1_PJTSEQ"] = filter_var($REQ["C1_PJTSEQ"], FILTER_VALIDATE_REGEXP,array("options" => array("regexp" => "/^[1-9]{1}[0-9]*$/" )));

//G2, 목록
$REQ["G2_ROWCHK"] = $_POST["G2_ROWCHK"];//ROWCHK
$REQ["G2_VALIDSEQ"] = $_POST["G2_VALIDSEQ"];//VALIDSEQ
$REQ["G2_VALIDSEQ"] = filter_var($REQ["G2_VALIDSEQ"], FILTER_VALIDATE_REGEXP,array("options" => array("regexp" => "/^[1-9]{1}[0-9]*$/" )));
$REQ["G2_PJTSEQ"] = $_POST["G2_PJTSEQ"];//PJTSEQ
$REQ["G2_PJTSEQ"] = filter_var($REQ["G2_PJTSEQ"], FILTER_VALIDATE_REGEXP,array("options" => array("regexp" => "/^[1-9]{1}[0-9]*$/" )));
$REQ["G2_VALIDNM"] = $_POST["G2_VALIDNM"];//VALIDNM
$REQ["G2_VALIDID"] = $_POST["G2_VALIDID"];//VALIDID
$REQ["G2_VALIDID"] = filter_var($REQ["G2_VALIDID"], FILTER_VALIDATE_REGEXP,array("options" => array("regexp" => "/^[a-zA-Z]{1}[a-zA-Z0-9]*$/" )));
$REQ["G2_VALIDORD"] = $_POST["G2_VALIDORD"];//VALIDORD
$REQ["G2_VALIDORD"] = filter_var($REQ["G2_VALIDORD"], FILTER_VALIDATE_REGEXP,array("options" => array("regexp" => "/^[1-9]{1}[0-9]*$/" )));
$REQ["G2_VALIDTYPE"] = $_POST["G2_VALIDTYPE"];//VALIDTYPE
$REQ["G2_INVALIDMSG"] = $_POST["G2_INVALIDMSG"];//INVALIDMSG
$REQ["G2_MATSTR"] = $_POST["G2_MATSTR"];//MATSTR
$REQ["G2_ADDDT"] = $_POST["G2_ADDDT"];//ADDDT
$REQ["G2_MODDT"] = $_POST["G2_MODDT"];//수정일

//F3, 상세
$REQ["G2_XML"] = getXml2Array($_POST["G2_XML"]);//목록	
//var_dump($REQ["G2_XML"]);
//echo "===================================================================\n";

$REQ["G2_XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G2_XML"]
		,"COLORD"=>"ROWCHK,VALIDSEQ,PJTSEQ,VALIDID,VALIDORD,VALIDNM,VALIDTYPE,INVALIDMSG,MATSTR,ADDDT,MODDT"
		,"FILTER"=>
			array(
			"VALIDSEQ"=>"^[1-9]{1}[0-9]*$"
			,"VALIDORD"=>"^[1-9]{1}[0-9]*$"
			)
	)
);
//var_dump($REQ["G2_XML"]);


$REQ["G2_CHK"] = explode(",", $_POST["G2_CHK"]);//CHK 받기	
//서비스 클래스 생성
$objService = new validmngService();//컨트롤 명령별 분개처리
alog("ctl:" . $ctl);
switch ($ctl){
	case "C1_SEARCHALL" :
  		echo $objService->goC1Searchall(); //조회조건, 조회(전체)
  		break;
	case "C1_SAVE" :
  		echo $objService->goC1Save(); //조회조건, 저장
  		break;
	case "G2_SEARCH" :
  		echo $objService->goG2Search(); //목록, 조회
  		break;
	case "G2_SAVE" :
  		echo $objService->goG2Save(); //목록, 저장
  		break;
	case "G2_EXCEL" :
  		echo $objService->goG2Excel(); //목록, 엑셀다운로드
  		break;
	case "G2_CHKSAVE" :
  		echo $objService->goG2Chksave(); //목록, 선택저장
  		break;
	case "F3_SEARCH" :
  		echo $objService->goF3Search(); //상세, 조회
  		break;
	case "F3_SAVE" :
  		echo $objService->goF3Save(); //상세, 저장
  		break;
	case "F3_EXCEL" :
  		echo $objService->goF3Excel(); //상세, 엑셀다운로드
  		break;
	case "F3_CHKSAVE" :
  		echo $objService->goF3Chksave(); //상세, 선택저장
  		break;
	default:
		JsonMsg("500","110","처리 명령을 찾을 수 없습니다. (no search ctl)");
		break;
}//서비스 클래스 비우기
unset($objService);

alog("ValidmngControl___________________________end");

?>