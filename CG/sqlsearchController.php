<?php
header("Content-Type: text/html; charset=UTF-8"); //SVRCTL
header("Cache-Control:no-cache");
header("Pragma:no-cache");
$_RTIME = array();
array_push($_RTIME,array("[TIME 00.START]",microtime(true)));
include_once('sqlsearchService.php');

array_push($_RTIME,array("[TIME 10.INCLUDE SERVICE]",microtime(true)));
include_once('../include/incUtil.php');//CG UTIL
	include_once('../include/incRequest.php');//CG REQUEST
	include_once('../include/incDB.php');//CG DB
	include_once('../include/incSEC.php');//CG SEC
	include_once('../include/incAuth.php');//CG AUTH
	include_once('./incConfig.CG.php');//CG CONFIG
	include_once('../include/incUser.php');//CG USER
	//하위에서 LOADDING LIB 처리
	include_once('../lib/htmlpurifier-4.9.3/library/HTMLPurifier.auto.php');//HTML Purifier
	array_push($_RTIME,array("[TIME 20.IMPORT]",microtime(true)));
//SAFE HTML 필더 로더
$config = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($config);	
alog("SqlsearchControl___________________________start");

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
}else if($objAuth->isAuth("SQLSEARCH",$ctl)){
	$objAuth->LAUTH_SEQ = $objAuth->logUsrAuth($reqToken,$resToken,"SQLSEARCH",$ctl,"Y");
}else{
	$objAuth->logUsrAuth($reqToken,$resToken,"SQLSEARCH",$ctl,"N");
	JsonMsg("500","120",$ctl . " 권한이 없습니다.");
}
		//사용자 정보 가져오기
//로그 저장 방식 결정
//일반로그, 권한변경로그, PI로그
//NORMAL, POWER, PI
$PGM_CFG["SECTYPE"] = "NORMAL";
$PGM_CFG["SQLTXT"] = array();
array_push($_RTIME,array("[TIME 30.AUTH_CHECK]",microtime(true)));
$REQ["G4-CTLCUD"] = reqPostString("G4-CTLCUD",2);

//로그인정보 및 환경경수 받기

//FILE먼저 : G1, 조건
//FILE먼저 : G2, 프로그램
//FILE먼저 : G3, SQL
//FILE먼저 : G4, 폼

//G1, 조건
$REQ["G1-PJTSEQ"] = reqPostNumber("G1-PJTSEQ",20);//PJTSEQ	
$REQ["G1-PJTSEQ"] = getFilter($REQ["G1-PJTSEQ"],"REGEXMAT","/^[0-9]+$/");	

//G2, 프로그램
$REQ["G2-PJTSEQ"] = reqPostNumber("G2-PJTSEQ",20);//PJTSEQ	
$REQ["G2-PJTSEQ"] = getFilter($REQ["G2-PJTSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-PGMSEQ"] = reqPostNumber("G2-PGMSEQ",30);//SEQ	
$REQ["G2-PGMSEQ"] = getFilter($REQ["G2-PGMSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-PGMID"] = reqPostString("G2-PGMID",20);//프로그램ID	
$REQ["G2-PGMID"] = getFilter($REQ["G2-PGMID"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G2-PGMNM"] = reqPostString("G2-PGMNM",50);//프로그램이름	
$REQ["G2-PGMNM"] = getFilter($REQ["G2-PGMNM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-ADDDT"] = reqPostString("G2-ADDDT",14);//ADDDT	
$REQ["G2-ADDDT"] = getFilter($REQ["G2-ADDDT"],"REGEXMAT","/^[0-9]+$/");	

//G3, SQL
$REQ["G3-PJTSEQ"] = reqPostNumber("G3-PJTSEQ",20);//PJTSEQ	
$REQ["G3-PJTSEQ"] = getFilter($REQ["G3-PJTSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-PGMSEQ"] = reqPostNumber("G3-PGMSEQ",30);//SEQ	
$REQ["G3-PGMSEQ"] = getFilter($REQ["G3-PGMSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-SQLSEQ"] = reqPostNumber("G3-SQLSEQ",30);//SQLSEQ	
$REQ["G3-SQLSEQ"] = getFilter($REQ["G3-SQLSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-SQLID"] = reqPostString("G3-SQLID",30);//SQLID	
$REQ["G3-SQLID"] = getFilter($REQ["G3-SQLID"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-SQLNM"] = reqPostString("G3-SQLNM",30);//SQLNM	
$REQ["G3-SQLNM"] = getFilter($REQ["G3-SQLNM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-CRUD"] = reqPostString("G3-CRUD",1);//CRUD	
$REQ["G3-CRUD"] = getFilter($REQ["G3-CRUD"],"REGEXMAT","/^[a-zA-Z]{1}[_a-zA-Z0-9]*$/");	
$REQ["G3-RTN_TYPE"] = reqPostString("G3-RTN_TYPE",30);//RTN_TYPE	
$REQ["G3-RTN_TYPE"] = getFilter($REQ["G3-RTN_TYPE"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-ADDDT"] = reqPostString("G3-ADDDT",14);//ADDDT	
$REQ["G3-ADDDT"] = getFilter($REQ["G3-ADDDT"],"REGEXMAT","/^[0-9]+$/");	

//G4, 폼
$REQ["G4-SQLID"] = reqPostString("G4-SQLID",30);//SQLID	
$REQ["G4-SQLID"] = getFilter($REQ["G4-SQLID"],"CLEARTEXT","/--미 정의--/");	
$REQ["G4-SQLTXT"] = reqPostString("G4-SQLTXT",1000);//SQLTXT	
$REQ["G4-SQLTXT"] = getFilter($REQ["G4-SQLTXT"],"SAFEHTML","/--미 정의--/");	
$REQ["G2-XML"] = getXml2Array($_POST["G2-XML"]);//프로그램	
	$REQ["G3-XML"] = getXml2Array($_POST["G3-XML"]);//SQL	
	//,  입력값 필터 
	$REQ["G2-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G2-XML"]
		,"COLORD"=>"PJTSEQ,PGMSEQ,PGMID,PGMNM,ADDDT"
		,"VALID"=>
			array(
			"PJTSEQ"=>array("NUMBER",20)	
			,"PGMSEQ"=>array("NUMBER",30)	
			,"PGMID"=>array("STRING",20)	
			,"PGMNM"=>array("STRING",50)	
			,"ADDDT"=>array("STRING",14)	
					)
		,"FILTER"=>
			array(
			"PJTSEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"PGMSEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"PGMID"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"PGMNM"=>array("CLEARTEXT","/--미 정의--/")
			,"ADDDT"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
$REQ["G3-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G3-XML"]
		,"COLORD"=>"PJTSEQ,PGMSEQ,SQLSEQ,SQLID,SQLNM,CRUD,RTN_TYPE,ADDDT"
		,"VALID"=>
			array(
			"PJTSEQ"=>array("NUMBER",20)	
			,"PGMSEQ"=>array("NUMBER",30)	
			,"SQLSEQ"=>array("NUMBER",30)	
			,"SQLID"=>array("STRING",30)	
			,"SQLNM"=>array("STRING",30)	
			,"CRUD"=>array("STRING",1)	
			,"RTN_TYPE"=>array("STRING",30)	
			,"ADDDT"=>array("STRING",14)	
					)
		,"FILTER"=>
			array(
			"PJTSEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"PGMSEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"SQLSEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"SQLID"=>array("CLEARTEXT","/--미 정의--/")
			,"SQLNM"=>array("CLEARTEXT","/--미 정의--/")
			,"CRUD"=>array("REGEXMAT","/^[a-zA-Z]{1}[_a-zA-Z0-9]*$/")
			,"RTN_TYPE"=>array("CLEARTEXT","/--미 정의--/")
			,"ADDDT"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
	
array_push($_RTIME,array("[TIME 40.REQ_VALID]",microtime(true)));
	//서비스 클래스 생성
$objService = new sqlsearchService();
	//컨트롤 명령별 분개처리
alog("ctl:" . $ctl);
switch ($ctl){
			case "G1_SEARCHALL" :
  		echo $objService->goG1Searchall(); //조건, 조회(전체)
  		break;
	case "G1_SAVE" :
  		echo $objService->goG1Save(); //조건, 저장
  		break;
	case "G2_SEARCH" :
  		echo $objService->goG2Search(); //프로그램, 조회
  		break;
	case "G2_EXCEL" :
  		echo $objService->goG2Excel(); //프로그램, 엑셀다운로드
  		break;
	case "G3_SEARCH" :
  		echo $objService->goG3Search(); //SQL, 조회
  		break;
	case "G3_EXCEL" :
  		echo $objService->goG3Excel(); //SQL, 엑셀다운로드
  		break;
	case "G4_SEARCH" :
  		echo $objService->goG4Search(); //폼, 조회
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

alog("SqlsearchControl___________________________end");

?>	