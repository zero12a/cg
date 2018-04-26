<?php
header("Content-Type: text/html; charset=UTF-8"); //SVRCTL
header("Cache-Control:no-cache");
header("Pragma:no-cache");
include_once('cg_pjt2Service.php');
include_once('./include/incUtil.php');
include_once('./include/incDB.php');
include_once('./incConfig.php');

alog("Test2Control___________________________start");
//컨트롤 명령 받기
$ctl = "";
$ctl1 = $_GET["CTLGRP"];
$ctl2 = $_GET["CTLFNC"];


if($ctl1 == "" || $ctl2 == ""){
	JsonMsg("500","100","처리 명령이 잘못되었습니다.(no input ctl)");
}else{
	$ctl = $ctl1 . "_" . $ctl2;
}
$REQ["G1_aaa"] = $_POST["G1_aaa"];//12
$REQ["G2_PJTID"] = $_POST["G2_PJTID"];//프로젝트ID
$REQ["G2_ADDDT"] = $_POST["G2_ADDDT"];//생성일
$REQ["G3_PJTID"] = $_POST["G3_PJTID"];//프로젝트ID
$REQ["G3_PJTNM"] = $_POST["G3_PJTNM"];//프로젝트명
$REQ["G3_DELYN"] = $_POST["G3_DELYN"];//삭제YN
$REQ["G3_PKGROOT"] = $_POST["G3_PKGROOT"];//삭제YN
$REQ["G3_ADDDT"] = $_POST["G3_ADDDT"];//ADDDT
$REQ["G3_UITOOL"] = $_POST["G3_UITOOL"];//UITOOL
$REQ["G3_SVRLANG"] = $_POST["G3_SVRLANG"];//SVRLANG
$REQ["G3_MODDT"] = $_POST["G3_MODDT"];//수정일
$REQ["G4_PJTID"] = $_POST["G4_PJTID"];//프로젝트ID
$REQ["G4_PGMID"] = $_POST["G4_PGMID"];//프로그램ID
$REQ["G4_PGMNM"] = $_POST["G4_PGMNM"];//프로그램이름
$REQ["G4_PKGGRP"] = $_POST["G4_PKGGRP"];//패키지그룹
$REQ["G4_ADDDT"] = $_POST["G4_ADDDT"];//ADDDT
$REQ["G4_MODDT"] = $_POST["G4_MODDT"];//MODDT
$REQ["G5_PJTID"] = $_POST["G5_PJTID"];//PJTID
$REQ["G5_COLID"] = $_POST["G5_COLID"];//컬럼ID
$REQ["G5_COLNM"] = $_POST["G5_COLNM"];//컬럼명
$REQ["G5_COLSNM"] = $_POST["G5_COLSNM"];//단축명
$REQ["G5_DATATYPE"] = $_POST["G5_DATATYPE"];//데이터타입
$REQ["G5_DATASIZE"] = $_POST["G5_DATASIZE"];//데이터사이즈
$REQ["G5_OBJTYPE"] = $_POST["G5_OBJTYPE"];//오브젝트타입
$REQ["G5_LBLWIDTH"] = $_POST["G5_LBLWIDTH"];//라벨가로
$REQ["G5_LBLHEIGHT"] = $_POST["G5_LBLHEIGHT"];//가벨세로
$REQ["G5_OBJWIDTH"] = $_POST["G5_OBJWIDTH"];//오브젝트가로
$REQ["G5_OBJHEIGHT"] = $_POST["G5_OBJHEIGHT"];//오브젝트세로
$REQ["G5_OBJALIGN"] = $_POST["G5_OBJALIGN"];//가로정렬
alog($_POST["G3_XML"]);
$REQ["G3_XML"] = getXml2Array($_POST["G3_XML"]);//PJT	
$REQ["G4_XML"] = getXml2Array($_POST["G4_XML"]);//PGM	
$REQ["G5_XML"] = getXml2Array($_POST["G5_XML"]);//DD	
//서비스 클래스 생성
$objService = new Pjt2Service();//컨트롤 명령별 분개처리
alog("ctl:" . $ctl);
switch ($ctl){case "G1_SAVE" :
  echo $objService->goG1Save(); //1, 저장
  break;
case "G3_SEARCH" :
  echo $objService->goG3Search(); //PJT, 조회
  break;
case "G3_SAVE" :
  echo $objService->goG3Save(); //PJT, 저장
  break;
case "G4_SEARCH" :
  echo $objService->goG4Search(); //PGM, 조회
  break;
case "G4_SAVE" :
  echo $objService->goG4Save(); //PGM, 저장
  break;
case "G5_SEARCH" :
  echo $objService->goG5Search(); //DD, 조회
  break;
case "G5_SAVE" :
  echo $objService->goG5Save(); //DD, 저장
  break;
	default:
		JsonMsg("500","110","처리 명령을 찾을 수 없습니다. (no search ctl)");
		break;
}//서비스 클래스 비우기
unset($objService);

alog("Test2Control___________________________end");

?>