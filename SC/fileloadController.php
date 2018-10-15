<?php
header("Content-Type: text/html; charset=UTF-8"); //SVRCTL
header("Cache-Control:no-cache");
header("Pragma:no-cache");
$_RTIME = array();
array_push($_RTIME,array("[TIME 00.START]",microtime(true)));
include_once('fileloadService.php');

array_push($_RTIME,array("[TIME 10.INCLUDE SERVICE]",microtime(true)));
include_once('../include/incUtil.php');//CG UTIL
	include_once('../include/incRequest.php');//CG REQUEST
	include_once('../include/incDB.php');//CG DB
	include_once('../include/incSEC.php');//CG SEC
	include_once('../include/incAuth.php');//CG AUTH
	include_once('./incConfig.SC.php');//CG CONFIG
	include_once('../include/incUser.php');//CG USER
	//하위에서 LOADDING LIB 처리
	array_push($_RTIME,array("[TIME 20.IMPORT]",microtime(true)));
alog("FileloadControl___________________________start");

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
}else if($objAuth->isAuth("fileLoad",$ctl)){
	$objAuth->LAUTH_SEQ = $objAuth->logUsrAuth($reqToken,$resToken,"fileLoad",$ctl,"Y");
}else{
	$objAuth->logUsrAuth($reqToken,$resToken,"fileLoad",$ctl,"N");
	JsonMsg("500","120",$ctl . " 권한이 없습니다.");
}
		//사용자 정보 가져오기
//로그 저장 방식 결정
//일반로그, 권한변경로그, PI로그
//NORMAL, POWER, PI
$PGM_CFG["SECTYPE"] = "NORMAL";
$PGM_CFG["SQLTXT"] = array();
array_push($_RTIME,array("[TIME 30.AUTH_CHECK]",microtime(true)));

//로그인정보 및 환경경수 받기

//FILE먼저 : G1, 2
//FILE먼저 : G2, 3
//FILE먼저 : G3, 4

//G1, 2
$REQ["G1-FILE_NM"] = reqPostString("G1-FILE_NM",1000);//FILE_NM	
$REQ["G1-FILE_NM"] = getFilter($REQ["G1-FILE_NM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G1-TEAM_NM"] = reqPostString("G1-TEAM_NM",300);//TEAM_NM	
$REQ["G1-TEAM_NM"] = getFilter($REQ["G1-TEAM_NM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G1-ADD_DT"] = reqPostString("G1-ADD_DT",14);//ADD_DT	
$REQ["G1-ADD_DT"] = getFilter($REQ["G1-ADD_DT"],"REGEXMAT","/^[0-9]+$/");	

//G2, 3
$REQ["G2-LOAD_SEQ"] = reqPostNumber("G2-LOAD_SEQ",30);//SEQ	
$REQ["G2-LOAD_SEQ"] = getFilter($REQ["G2-LOAD_SEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-FILE_NM"] = reqPostString("G2-FILE_NM",1000);//FILE_NM	
$REQ["G2-FILE_NM"] = getFilter($REQ["G2-FILE_NM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-TEAM_NM"] = reqPostString("G2-TEAM_NM",300);//TEAM_NM	
$REQ["G2-TEAM_NM"] = getFilter($REQ["G2-TEAM_NM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-TEAM_NM_LEN"] = reqPostNumber("G2-TEAM_NM_LEN",30);//TEAM_NM_LEN	
$REQ["G2-TEAM_NM_LEN"] = getFilter($REQ["G2-TEAM_NM_LEN"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-SYS_NM"] = reqPostString("G2-SYS_NM",1000);//SYS_NM	
$REQ["G2-SYS_NM"] = getFilter($REQ["G2-SYS_NM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-SYS_NM_LEN"] = reqPostNumber("G2-SYS_NM_LEN",30);//SYS_NM_LEN	
$REQ["G2-SYS_NM_LEN"] = getFilter($REQ["G2-SYS_NM_LEN"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-SUBSYS_NM"] = reqPostString("G2-SUBSYS_NM",1000);//SUBSYS_NM	
$REQ["G2-SUBSYS_NM"] = getFilter($REQ["G2-SUBSYS_NM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-SUBSYS_NM_LEN"] = reqPostNumber("G2-SUBSYS_NM_LEN",30);//SUBSYS_NM_LEN	
$REQ["G2-SUBSYS_NM_LEN"] = getFilter($REQ["G2-SUBSYS_NM_LEN"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-FILE_HASH"] = reqPostString("G2-FILE_HASH",30);//FILE_HASH	
$REQ["G2-FILE_HASH"] = getFilter($REQ["G2-FILE_HASH"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-XML_VERSION"] = reqPostString("G2-XML_VERSION",30);//XML_VERSION	
$REQ["G2-XML_VERSION"] = getFilter($REQ["G2-XML_VERSION"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-XML_TIMESTAMP"] = reqPostString("G2-XML_TIMESTAMP",30);//XML_TIMESTAMP	
$REQ["G2-XML_TIMESTAMP"] = getFilter($REQ["G2-XML_TIMESTAMP"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-XML_ANAL_TIMESTAMP"] = reqPostString("G2-XML_ANAL_TIMESTAMP",30);//XML_ANAL_TIMESTAMP	
$REQ["G2-XML_ANAL_TIMESTAMP"] = getFilter($REQ["G2-XML_ANAL_TIMESTAMP"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-XML_DT"] = reqPostString("G2-XML_DT",30);//XML_DT	
$REQ["G2-XML_DT"] = getFilter($REQ["G2-XML_DT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-XML_ANAL_DT"] = reqPostString("G2-XML_ANAL_DT",30);//XML_ANAL_DT	
$REQ["G2-XML_ANAL_DT"] = getFilter($REQ["G2-XML_ANAL_DT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-BUG_CNT"] = reqPostNumber("G2-BUG_CNT",30);//BUG_CNT	
$REQ["G2-BUG_CNT"] = getFilter($REQ["G2-BUG_CNT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-LOAD_END_DT"] = reqPostString("G2-LOAD_END_DT",30);//LOAD_END_DT	
$REQ["G2-LOAD_END_DT"] = getFilter($REQ["G2-LOAD_END_DT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-ADD_DT"] = reqPostString("G2-ADD_DT",14);//ADD_DT	
$REQ["G2-ADD_DT"] = getFilter($REQ["G2-ADD_DT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-MOD_DT"] = reqPostString("G2-MOD_DT",14);//MOD_DT	
$REQ["G2-MOD_DT"] = getFilter($REQ["G2-MOD_DT"],"REGEXMAT","/^[0-9]+$/");	

//G3, 4
$REQ["G3-LOADD_SEQ"] = reqPostNumber("G3-LOADD_SEQ",30);//LOADD_SEQ	
$REQ["G3-LOADD_SEQ"] = getFilter($REQ["G3-LOADD_SEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-LOAD_SEQ"] = reqPostNumber("G3-LOAD_SEQ",30);//SEQ	
$REQ["G3-LOAD_SEQ"] = getFilter($REQ["G3-LOAD_SEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-TYPE"] = reqPostString("G3-TYPE",30);//TYPE	
$REQ["G3-TYPE"] = getFilter($REQ["G3-TYPE"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-PRIORITY"] = reqPostNumber("G3-PRIORITY",30);//우선순위	
$REQ["G3-PRIORITY"] = getFilter($REQ["G3-PRIORITY"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-CLASSNAME"] = reqPostString("G3-CLASSNAME",30);//CLASSNAME	
$REQ["G3-CLASSNAME"] = getFilter($REQ["G3-CLASSNAME"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-CLASS_LINE_S"] = reqPostNumber("G3-CLASS_LINE_S",30);//CLASS_LINE_S	
$REQ["G3-CLASS_LINE_S"] = getFilter($REQ["G3-CLASS_LINE_S"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-CLASS_LINE_E"] = reqPostNumber("G3-CLASS_LINE_E",30);//CLASS_LINE_E	
$REQ["G3-CLASS_LINE_E"] = getFilter($REQ["G3-CLASS_LINE_E"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-SOURCEFILE"] = reqPostString("G3-SOURCEFILE",30);//SOURCEFILE	
$REQ["G3-SOURCEFILE"] = getFilter($REQ["G3-SOURCEFILE"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-SOURCEPATH"] = reqPostString("G3-SOURCEPATH",30);//SOURCEPATH	
$REQ["G3-SOURCEPATH"] = getFilter($REQ["G3-SOURCEPATH"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-METHOD_NAME"] = reqPostString("G3-METHOD_NAME",30);//METHOD_NAME	
$REQ["G3-METHOD_NAME"] = getFilter($REQ["G3-METHOD_NAME"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-METHOD_LINE_S"] = reqPostNumber("G3-METHOD_LINE_S",30);//METHOD_LINE_S	
$REQ["G3-METHOD_LINE_S"] = getFilter($REQ["G3-METHOD_LINE_S"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-METHOD_LINE_E"] = reqPostNumber("G3-METHOD_LINE_E",30);//METHOD_LINE_E	
$REQ["G3-METHOD_LINE_E"] = getFilter($REQ["G3-METHOD_LINE_E"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-FIELD_NAME"] = reqPostString("G3-FIELD_NAME",30);//FIELD_NAME	
$REQ["G3-FIELD_NAME"] = getFilter($REQ["G3-FIELD_NAME"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-FIELD_LINE_S"] = reqPostNumber("G3-FIELD_LINE_S",30);//FIELD_LINE_S	
$REQ["G3-FIELD_LINE_S"] = getFilter($REQ["G3-FIELD_LINE_S"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-FIELD_LINE_E"] = reqPostNumber("G3-FIELD_LINE_E",30);//FIELD_LINE_E	
$REQ["G3-FIELD_LINE_E"] = getFilter($REQ["G3-FIELD_LINE_E"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-LINE_CNT"] = reqPostNumber("G3-LINE_CNT",30);//LINE_CNT	
$REQ["G3-LINE_CNT"] = getFilter($REQ["G3-LINE_CNT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-BUG_LINE_S"] = reqPostNumber("G3-BUG_LINE_S",30);//BIG_LINE_S	
$REQ["G3-BUG_LINE_S"] = getFilter($REQ["G3-BUG_LINE_S"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-ADD_DT"] = reqPostString("G3-ADD_DT",14);//ADD_DT	
$REQ["G3-ADD_DT"] = getFilter($REQ["G3-ADD_DT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-XML"] = getXml2Array($_POST["G2-XML"]);//3	
	$REQ["G3-XML"] = getXml2Array($_POST["G3-XML"]);//4	
	//,  입력값 필터 
	$REQ["G2-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G2-XML"]
		,"COLORD"=>"CHK,LOAD_SEQ,FILE_NM,TEAM_NM,TEAM_NM_LEN,SYS_NM,SYS_NM_LEN,SUBSYS_NM,SUBSYS_NM_LEN,FILE_HASH,XML_VERSION,XML_TIMESTAMP,XML_ANAL_TIMESTAMP,XML_DT,XML_ANAL_DT,BUG_CNT,LOAD_END_DT,ADD_DT,MOD_DT"
		,"VALID"=>
			array(
			"CHK"=>array("STRING",30)	
			,"LOAD_SEQ"=>array("NUMBER",30)	
			,"FILE_NM"=>array("STRING",1000)	
			,"TEAM_NM"=>array("STRING",300)	
			,"TEAM_NM_LEN"=>array("NUMBER",30)	
			,"SYS_NM"=>array("STRING",1000)	
			,"SYS_NM_LEN"=>array("NUMBER",30)	
			,"SUBSYS_NM"=>array("STRING",1000)	
			,"SUBSYS_NM_LEN"=>array("NUMBER",30)	
			,"FILE_HASH"=>array("STRING",30)	
			,"XML_VERSION"=>array("STRING",30)	
			,"XML_TIMESTAMP"=>array("STRING",30)	
			,"XML_ANAL_TIMESTAMP"=>array("STRING",30)	
			,"XML_DT"=>array("STRING",30)	
			,"XML_ANAL_DT"=>array("STRING",30)	
			,"BUG_CNT"=>array("NUMBER",30)	
			,"LOAD_END_DT"=>array("STRING",30)	
			,"ADD_DT"=>array("STRING",14)	
			,"MOD_DT"=>array("STRING",14)	
					)
		,"FILTER"=>
			array(
			"CHK"=>array("REGEXMAT","/^[0-9]+$/")
			,"LOAD_SEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"FILE_NM"=>array("CLEARTEXT","/--미 정의--/")
			,"TEAM_NM"=>array("CLEARTEXT","/--미 정의--/")
			,"TEAM_NM_LEN"=>array("REGEXMAT","/^[0-9]+$/")
			,"SYS_NM"=>array("CLEARTEXT","/--미 정의--/")
			,"SYS_NM_LEN"=>array("REGEXMAT","/^[0-9]+$/")
			,"SUBSYS_NM"=>array("CLEARTEXT","/--미 정의--/")
			,"SUBSYS_NM_LEN"=>array("REGEXMAT","/^[0-9]+$/")
			,"FILE_HASH"=>array("CLEARTEXT","/--미 정의--/")
			,"XML_VERSION"=>array("CLEARTEXT","/--미 정의--/")
			,"XML_TIMESTAMP"=>array("REGEXMAT","/^[0-9]+$/")
			,"XML_ANAL_TIMESTAMP"=>array("REGEXMAT","/^[0-9]+$/")
			,"XML_DT"=>array("REGEXMAT","/^[0-9]+$/")
			,"XML_ANAL_DT"=>array("REGEXMAT","/^[0-9]+$/")
			,"BUG_CNT"=>array("REGEXMAT","/^[0-9]+$/")
			,"LOAD_END_DT"=>array("REGEXMAT","/^[0-9]+$/")
			,"ADD_DT"=>array("REGEXMAT","/^[0-9]+$/")
			,"MOD_DT"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
$REQ["G3-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G3-XML"]
		,"COLORD"=>"LOADD_SEQ,LOAD_SEQ,TYPE,PRIORITY,CLASSNAME,CLASS_LINE_S,CLASS_LINE_E,SOURCEFILE,SOURCEPATH,METHOD_NAME,METHOD_LINE_S,METHOD_LINE_E,FIELD_NAME,FIELD_LINE_S,FIELD_LINE_E,LINE_CNT,BUG_LINE_S,ADD_DT"
		,"VALID"=>
			array(
			"LOADD_SEQ"=>array("NUMBER",30)	
			,"LOAD_SEQ"=>array("NUMBER",30)	
			,"TYPE"=>array("STRING",30)	
			,"PRIORITY"=>array("NUMBER",30)	
			,"CLASSNAME"=>array("STRING",30)	
			,"CLASS_LINE_S"=>array("NUMBER",30)	
			,"CLASS_LINE_E"=>array("NUMBER",30)	
			,"SOURCEFILE"=>array("STRING",30)	
			,"SOURCEPATH"=>array("STRING",30)	
			,"METHOD_NAME"=>array("STRING",30)	
			,"METHOD_LINE_S"=>array("NUMBER",30)	
			,"METHOD_LINE_E"=>array("NUMBER",30)	
			,"FIELD_NAME"=>array("STRING",30)	
			,"FIELD_LINE_S"=>array("NUMBER",30)	
			,"FIELD_LINE_E"=>array("NUMBER",30)	
			,"LINE_CNT"=>array("NUMBER",30)	
			,"BUG_LINE_S"=>array("NUMBER",30)	
			,"ADD_DT"=>array("STRING",14)	
					)
		,"FILTER"=>
			array(
			"LOADD_SEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"LOAD_SEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"TYPE"=>array("CLEARTEXT","/--미 정의--/")
			,"PRIORITY"=>array("REGEXMAT","/^[0-9]+$/")
			,"CLASSNAME"=>array("CLEARTEXT","/--미 정의--/")
			,"CLASS_LINE_S"=>array("REGEXMAT","/^[0-9]+$/")
			,"CLASS_LINE_E"=>array("REGEXMAT","/^[0-9]+$/")
			,"SOURCEFILE"=>array("CLEARTEXT","/--미 정의--/")
			,"SOURCEPATH"=>array("CLEARTEXT","/--미 정의--/")
			,"METHOD_NAME"=>array("CLEARTEXT","/--미 정의--/")
			,"METHOD_LINE_S"=>array("REGEXMAT","/^[0-9]+$/")
			,"METHOD_LINE_E"=>array("REGEXMAT","/^[0-9]+$/")
			,"FIELD_NAME"=>array("CLEARTEXT","/--미 정의--/")
			,"FIELD_LINE_S"=>array("REGEXMAT","/^[0-9]+$/")
			,"FIELD_LINE_E"=>array("REGEXMAT","/^[0-9]+$/")
			,"LINE_CNT"=>array("REGEXMAT","/^[0-9]+$/")
			,"BUG_LINE_S"=>array("REGEXMAT","/^[0-9]+$/")
			,"ADD_DT"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
	
$REQ["G2-CHK"] = $_POST["G2-CHK"];//CHK 받기
//filterGridChk($tStr,$tDataType,$tDataSize,$tValidType,$tValidRule)
$REQ["G2-CHK"] = filterGridChk($REQ["G2-CHK"],"NUMBER",30,"REGEXMAT","/^[0-9]+$/");//LOAD_SEQ 입력값검증
	array_push($_RTIME,array("[TIME 40.REQ_VALID]",microtime(true)));
	//서비스 클래스 생성
$objService = new fileloadService();
	//컨트롤 명령별 분개처리
alog("ctl:" . $ctl);
switch ($ctl){
			case "G1_SEARCHALL" :
  		echo $objService->goG1Searchall(); //2, 조회(전체)
  		break;
	case "G1_SAVE" :
  		echo $objService->goG1Save(); //2, 저장
  		break;
	case "G2_SEARCH" :
  		echo $objService->goG2Search(); //3, 조회
  		break;
	case "G2_SAVE" :
  		echo $objService->goG2Save(); //3, 저장
  		break;
	case "G2_EXCEL" :
  		echo $objService->goG2Excel(); //3, 엑셀다운로드
  		break;
	case "G2_CHKSAVE" :
  		echo $objService->goG2Chksave(); //3, 선택삭제
  		break;
	case "G3_SEARCH" :
  		echo $objService->goG3Search(); //4, 조회
  		break;
	case "G3_SAVE" :
  		echo $objService->goG3Save(); //4, 저장
  		break;
	case "G3_EXCEL" :
  		echo $objService->goG3Excel(); //4, 엑셀다운로드
  		break;
	case "G3_CHKSAVE" :
  		echo $objService->goG3Chksave(); //4, 선택저장
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

alog("FileloadControl___________________________end");

?>	