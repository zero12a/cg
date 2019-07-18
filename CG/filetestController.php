<?php
header("Content-Type: text/html; charset=UTF-8"); //SVRCTL
header("Cache-Control:no-cache");
header("Pragma:no-cache");
$_RTIME = array();
array_push($_RTIME,array("[TIME 00.START]",microtime(true)));
include_once('filetestService.php');

array_push($_RTIME,array("[TIME 10.INCLUDE SERVICE]",microtime(true)));
include_once('../include/incUtil.php');//CG UTIL
	include_once('../include/incRequest.php');//CG REQUEST
	include_once('../include/incDB.php');//CG DB
	include_once('../include/incSEC.php');//CG SEC
	include_once('../include/incAuth.php');//CG AUTH
	include_once('./incConfig.CG.php');//CG CONFIG
	include_once('../include/incUser.php');//CG USER
	//하위에서 LOADDING LIB 처리
	array_push($_RTIME,array("[TIME 20.IMPORT]",microtime(true)));
alog("FiletestControl___________________________start");

$reqToken = reqGetString("TOKEN",37);
$resToken = uniqid();
alog("reqToken : " . $reqToken);
alog("resToken : " . $resToken);

$objAuth = new authObject();	
	

//컨트롤 명령 받기
$ctl = "";
$ctl1 = reqGetString("CTLGRP",50);
$ctl2 = reqGetString("CTLFNC",50);


if($ctl1 == "" || $ctl2 == ""){
	JsonMsg("500","100","처리 명령이 잘못되었습니다.(no input ctl)");
}else{
	$ctl = $ctl1 . "_" . $ctl2;
}
//로그인 : 권한정보 검사하기 in_array("aix", $os)
if(!isLogin()){
	JsonMsg("500","110"," 로그아웃되었습니다.");
}else if(!$objAuth->isOneConnection()){
	logOut();
	JsonMsg("500","120"," 다른기기(PC,브라우저 등)에서 로그인하였습니다. 다시로그인 후 사용해 주세요.");
}else if($objAuth->isAuth("FILETEST",$ctl)){
	$objAuth->LAUTH_SEQ = $objAuth->logUsrAuth($reqToken,$resToken,"FILETEST",$ctl,"Y");
}else{
	$objAuth->logUsrAuth($reqToken,$resToken,"FILETEST",$ctl,"N");
	JsonMsg("500","120",$ctl . " 권한이 없습니다.");
}
		//사용자 정보 가져오기
//로그 저장 방식 결정
//일반로그, 권한변경로그, PI로그
//NORMAL, POWER, PI
$PGM_CFG["SECTYPE"] = "NORMAL";
$PGM_CFG["SQLTXT"] = array();
array_push($_RTIME,array("[TIME 30.AUTH_CHECK]",microtime(true)));
$REQ["G3-CTLCUD"] = reqPostString("G3-CTLCUD",2);

//로그인정보 및 환경경수 받기

//FILE먼저 : G1, 컨디션
//FILE먼저 : G4, a
//FILE먼저 : G5, b
//FILE먼저 : G6, c
//FILE먼저 : G7, d
//FILE먼저 : G2, 그리드
//FILE먼저 : G3, 폼뷰
$REQ["G3-FILE1-NM"] = $_FILES["G3-FILE1"]["name"];//파일1
$REQ["G3-FILE1-TYPE"] = $_FILES["G3-FILE1"]["type"];//파일1
$REQ["G3-FILE1-TMPNM"] = $_FILES["G3-FILE1"]["tmp_name"];//파일1
$REQ["G3-FILE1-SIZE"] = $_FILES["G3-FILE1"]["size"];//파일1
$REQ["G3-FILE1-ERROR"] = $_FILES["G3-FILE1"]["error"];//파일1

//G1, 컨디션
$REQ["G1-ADDDT"] = reqPostString("G1-ADDDT",14);//ADDDT	
$REQ["G1-ADDDT"] = getFilter($REQ["G1-ADDDT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G1-MODDT"] = reqPostString("G1-MODDT",14);//MODDT	
$REQ["G1-MODDT"] = getFilter($REQ["G1-MODDT"],"REGEXMAT","/^[0-9]+$/");	

//G4, a
$REQ["G4-BIVAL1A"] = reqPostString("G4-BIVAL1A",100);//BIVAL1A	
$REQ["G4-BIVAL1A"] = getFilter($REQ["G4-BIVAL1A"],"CLEARTEXT","/--미 정의--/");	

//G5, b
$REQ["G5-BIVAL1A"] = reqPostString("G5-BIVAL1A",100);//BIVAL1A	
$REQ["G5-BIVAL1A"] = getFilter($REQ["G5-BIVAL1A"],"CLEARTEXT","/--미 정의--/");	

//G6, c
$REQ["G6-BIVAL1A"] = reqPostString("G6-BIVAL1A",100);//BIVAL1A	
$REQ["G6-BIVAL1A"] = getFilter($REQ["G6-BIVAL1A"],"CLEARTEXT","/--미 정의--/");	

//G7, d
$REQ["G7-BIVAL1A"] = reqPostString("G7-BIVAL1A",100);//BIVAL1A	
$REQ["G7-BIVAL1A"] = getFilter($REQ["G7-BIVAL1A"],"CLEARTEXT","/--미 정의--/");	

//G2, 그리드
$REQ["G2-FILESEQ"] = reqPostString("G2-FILESEQ",30);//FILESEQ	
$REQ["G2-FILESEQ"] = getFilter($REQ["G2-FILESEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-FILESVRNM"] = reqPostString("G2-FILESVRNM",100);//FILESVRNM	
$REQ["G2-FILESVRNM"] = getFilter($REQ["G2-FILESVRNM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-FILENM"] = reqPostString("G2-FILENM",30);//FILENM	
$REQ["G2-FILENM"] = getFilter($REQ["G2-FILENM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-FILETYPE"] = reqPostString("G2-FILETYPE",30);//FILETYPE	
$REQ["G2-FILETYPE"] = getFilter($REQ["G2-FILETYPE"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-FILESIZE"] = reqPostNumber("G2-FILESIZE",30);//FILESIZE	
$REQ["G2-FILESIZE"] = getFilter($REQ["G2-FILESIZE"],"REGEXMAT","/^[0-9]+$/");	

//G3, 폼뷰
$REQ["G3-FILESEQ"] = reqPostString("G3-FILESEQ",30);//FILESEQ	
$REQ["G3-FILESEQ"] = getFilter($REQ["G3-FILESEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-FILE1"] = reqPostString("G3-FILE1",100);//파일1	
$REQ["G3-FILE1"] = getFilter($REQ["G3-FILE1"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-LINKVIEW"] = reqPostString("G3-LINKVIEW",10);//링크뷰	
$REQ["G3-LINKVIEW"] = getFilter($REQ["G3-LINKVIEW"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-HIDDENLINK"] = reqPostString("G3-HIDDENLINK",50);//히든링크	
$REQ["G3-HIDDENLINK"] = getFilter($REQ["G3-HIDDENLINK"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-XML"] = getXml2Array($_POST["G2-XML"]);//그리드	
	//,  입력값 필터 
	$REQ["G2-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G2-XML"]
		,"COLORD"=>"FILESEQ,FILESVRNM,FILENM,FILETYPE,FILESIZE"
		,"VALID"=>
			array(
			"FILESEQ"=>array("STRING",30)	
			,"FILESVRNM"=>array("STRING",100)	
			,"FILENM"=>array("STRING",30)	
			,"FILETYPE"=>array("STRING",30)	
			,"FILESIZE"=>array("NUMBER",30)	
					)
		,"FILTER"=>
			array(
			"FILESEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"FILESVRNM"=>array("CLEARTEXT","/--미 정의--/")
			,"FILENM"=>array("CLEARTEXT","/--미 정의--/")
			,"FILETYPE"=>array("CLEARTEXT","/--미 정의--/")
			,"FILESIZE"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
	
array_push($_RTIME,array("[TIME 40.REQ_VALID]",microtime(true)));
	//서비스 클래스 생성
$objService = new filetestService();
	//컨트롤 명령별 분개처리
alog("ctl:" . $ctl);
switch ($ctl){
			case "G1_SEARCHALL" :
  		echo $objService->goG1Searchall(); //컨디션, 조회(전체)
  		break;
	case "G1_SAVE" :
  		echo $objService->goG1Save(); //컨디션, 저장
  		break;
	case "G4_SEARCH" :
  		echo $objService->goG4Search(); //a, 조회
  		break;
	case "G5_SEARCH" :
  		echo $objService->goG5Search(); //b, 조회
  		break;
	case "G6_SEARCH" :
  		echo $objService->goG6Search(); //c, 조회
  		break;
	case "G7_SEARCH" :
  		echo $objService->goG7Search(); //d, 조회
  		break;
	case "G2_SEARCH" :
  		echo $objService->goG2Search(); //그리드, 조회
  		break;
	case "G2_SAVE" :
  		echo $objService->goG2Save(); //그리드, 저장
  		break;
	case "G3_SEARCH" :
  		echo $objService->goG3Search(); //폼뷰, 조회
  		break;
	case "G3_SAVE" :
  		echo $objService->goG3Save(); //폼뷰, 저장
  		break;
	default:
		JsonMsg("500","110","처리 명령을 찾을 수 없습니다. (no search ctl)");
		break;
}
	array_push($_RTIME,array("[TIME 50.SVC]",microtime(true)));
if($PGM_CFG["SECTYPE"] == "POWER" || $PGM_CFG["SECTYPE"] == "PI") $objAuth->logUsrAuthD($reqToken,$resToken);;	//권한변경 로그 저장
	array_push($_RTIME,array("[TIME 60.AUGHD_LOG]",microtime(true)));
//실행시간 검사
for($j=1;$j<sizeof($_RTIME);$j++){
	alog( $_RTIME[$j][0] . " " . number_format($_RTIME[$j][1]-$_RTIME[$j-1][1],4) );

	if($j == sizeof($_RTIME)-1) alog( "RUN TIME : " . number_format($_RTIME[$j][1]-$_RTIME[0][1],4) );
}
//서비스 클래스 비우기
unset($objService);
unset($objAuth);

alog("FiletestControl___________________________end");

?>	