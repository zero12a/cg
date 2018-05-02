<?php
header("Content-Type: text/html; charset=UTF-8"); //SVRCTL
header("Cache-Control:no-cache");
header("Pragma:no-cache");
$_RTIME = array();
array_push($_RTIME,array("[TIME 00.START]",microtime(true)));
include_once('authlogService.php');

array_push($_RTIME,array("[TIME 10.INCLUDE SERVICE]",microtime(true)));
include_once('../include/incUtil.php');//CG UTIL
	include_once('../include/incRequest.php');//CG REQUEST
	include_once('../include/incDB.php');//CG DB
	include_once('../include/incSEC.php');//CG SEC
	include_once('../include/incAuth.php');//CG AUTH
	include_once('../incConfig.php');//CG CONFIG
	include_once('../include/incUser.php');//CG USER
	//하위에서 LOADDING LIB 처리
	array_push($_RTIME,array("[TIME 20.IMPORT]",microtime(true)));
alog("AuthlogControl___________________________start");

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
//권한정보 검사하기 in_array("aix", $os)
if(!isLogin()){
	JsonMsg("500","110"," 로그아웃되었습니다.");
}else if(!$objAuth->isOneConnection()){
	logOut();
	JsonMsg("500","120"," 다른기기(PC,브라우저 등)에서 로그인하였습니다. 다시로그인 후 사용해 주세요.");
}else if($objAuth->isAuth("AUTHLOG",$ctl)){
	$objAuth->LAUTH_SEQ = $objAuth->logUsrAuth($reqToken,$resToken,"AUTHLOG",$ctl,"Y");
}else{
	$objAuth->logUsrAuth($reqToken,$resToken,"AUTHLOG",$ctl,"N");
	JsonMsg("500","120",$ctl . " 권한이 없습니다.");
}
		//사용자 정보 가져오기
//로그 저장 방식 결정
//일반로그, 권한변경로그, PI로그
//NORMAL, POWER, PI
$PGM_CFG["SECTYPE"] = "POWER";
$PGM_CFG["SQLTXT"] = array();
array_push($_RTIME,array("[TIME 30.AUTH_CHECK]",microtime(true)));
$REQ["G4-CTLCUD"] = reqPostString("G4-CTLCUD",2);

//로그인정보 및 환경경수 받기

//FILE먼저 : G1, 컨
//FILE먼저 : G2, AUTH
//FILE먼저 : G3, AUTHD
//FILE먼저 : G4, AUTHD상세

//G1, 컨

//G2, AUTH
$REQ["G2-LAUTH_SEQ"] = reqPostNumber("G2-LAUTH_SEQ",10);//SEQ	
$REQ["G2-LAUTH_SEQ"] = getFilter($REQ["G2-LAUTH_SEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-REQ_TOKEN"] = reqPostString("G2-REQ_TOKEN",37);//REQ	
$REQ["G2-REQ_TOKEN"] = getFilter($REQ["G2-REQ_TOKEN"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-RES_TOKEN"] = reqPostString("G2-RES_TOKEN",30);//RES	
$REQ["G2-RES_TOKEN"] = getFilter($REQ["G2-RES_TOKEN"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-USR_SEQ"] = reqPostNumber("G2-USR_SEQ",10);//USR_SEQ	
$REQ["G2-USR_SEQ"] = getFilter($REQ["G2-USR_SEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-USR_ID"] = reqPostString("G2-USR_ID",10);//USR_ID	
$REQ["G2-USR_ID"] = getFilter($REQ["G2-USR_ID"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G2-PGMID"] = reqPostString("G2-PGMID",20);//프로그램ID	
$REQ["G2-PGMID"] = getFilter($REQ["G2-PGMID"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G2-AUTH_ID"] = reqPostString("G2-AUTH_ID",50);//AUTH_ID	
$REQ["G2-AUTH_ID"] = getFilter($REQ["G2-AUTH_ID"],"REGEXMAT","/^[a-zA-Z]{1}[_a-zA-Z0-9]*$/");	
$REQ["G2-SUCCESS_YN"] = reqPostString("G2-SUCCESS_YN",1);//SUCCESS_YN	
$REQ["G2-SUCCESS_YN"] = getFilter($REQ["G2-SUCCESS_YN"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-ADD_DT"] = reqPostString("G2-ADD_DT",14);//ADD	
$REQ["G2-ADD_DT"] = getFilter($REQ["G2-ADD_DT"],"REGEXMAT","/^[0-9]+$/");	

//G3, AUTHD
$REQ["G3-LAUTHD_SEQ"] = reqPostString("G3-LAUTHD_SEQ",30);//DSEQ	
$REQ["G3-LAUTHD_SEQ"] = getFilter($REQ["G3-LAUTHD_SEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-REQ_TOKEN"] = reqPostString("G3-REQ_TOKEN",37);//REQ	
$REQ["G3-REQ_TOKEN"] = getFilter($REQ["G3-REQ_TOKEN"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-RES_TOKEN"] = reqPostString("G3-RES_TOKEN",30);//RES	
$REQ["G3-RES_TOKEN"] = getFilter($REQ["G3-RES_TOKEN"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-LAUTH_SEQ"] = reqPostNumber("G3-LAUTH_SEQ",10);//SEQ	
$REQ["G3-LAUTH_SEQ"] = getFilter($REQ["G3-LAUTH_SEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-PARAM_COLIDS"] = reqPostString("G3-PARAM_COLIDS",30);//PARAM	
$REQ["G3-PARAM_COLIDS"] = getFilter($REQ["G3-PARAM_COLIDS"],"SAFETEXT","/--미 정의--/");	
$REQ["G3-DD_COLIDS"] = reqPostString("G3-DD_COLIDS",30);//DD	
$REQ["G3-DD_COLIDS"] = getFilter($REQ["G3-DD_COLIDS"],"SAFETEXT","/--미 정의--/");	
$REQ["G3-PI_IN_COLIDS"] = reqPostString("G3-PI_IN_COLIDS",30);//PI IN	
$REQ["G3-PI_IN_COLIDS"] = getFilter($REQ["G3-PI_IN_COLIDS"],"SAFETEXT","/--미 정의--/");	
$REQ["G3-PI_OUT_COLIDS"] = reqPostString("G3-PI_OUT_COLIDS",30);//PI OUT	
$REQ["G3-PI_OUT_COLIDS"] = getFilter($REQ["G3-PI_OUT_COLIDS"],"SAFETEXT","/--미 정의--/");	
$REQ["G3-ROW_CNT"] = reqPostString("G3-ROW_CNT",30);//ROW_CNT	
$REQ["G3-ROW_CNT"] = getFilter($REQ["G3-ROW_CNT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-ADD_DT"] = reqPostString("G3-ADD_DT",14);//ADD	
$REQ["G3-ADD_DT"] = getFilter($REQ["G3-ADD_DT"],"REGEXMAT","/^[0-9]+$/");	

//G4, AUTHD상세
$REQ["G4-LAUTHD_SEQ"] = reqPostString("G4-LAUTHD_SEQ",30);//DSEQ	
$REQ["G4-LAUTHD_SEQ"] = getFilter($REQ["G4-LAUTHD_SEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G4-PREPARE_SQL"] = reqPostString("G4-PREPARE_SQL",30);//PREPARE	
$REQ["G4-PREPARE_SQL"] = getFilter($REQ["G4-PREPARE_SQL"],"SAFETEXT","/--미 정의--/");	
$REQ["G4-FULL_SQL"] = reqPostString("G4-FULL_SQL",30);//FULL	
$REQ["G4-FULL_SQL"] = getFilter($REQ["G4-FULL_SQL"],"SAFETEXT","/--미 정의--/");	
$REQ["G4-ADD_DT"] = reqPostString("G4-ADD_DT",14);//ADD	
$REQ["G4-ADD_DT"] = getFilter($REQ["G4-ADD_DT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-XML"] = getXml2Array($_POST["G2-XML"]);//AUTH	
	$REQ["G3-XML"] = getXml2Array($_POST["G3-XML"]);//AUTHD	
	//,  입력값 필터 
	$REQ["G2-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G2-XML"]
		,"COLORD"=>"LAUTH_SEQ,REQ_TOKEN,RES_TOKEN,USR_SEQ,USR_ID,PGMID,AUTH_ID,SUCCESS_YN,ADD_DT"
		,"VALID"=>
			array(
			"LAUTH_SEQ"=>array("NUMBER",10)	
			,"REQ_TOKEN"=>array("STRING",37)	
			,"RES_TOKEN"=>array("STRING",30)	
			,"USR_SEQ"=>array("NUMBER",10)	
			,"USR_ID"=>array("STRING",10)	
			,"PGMID"=>array("STRING",20)	
			,"AUTH_ID"=>array("STRING",50)	
			,"SUCCESS_YN"=>array("STRING",1)	
			,"ADD_DT"=>array("STRING",14)	
					)
		,"FILTER"=>
			array(
			"LAUTH_SEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"REQ_TOKEN"=>array("CLEARTEXT","/--미 정의--/")
			,"RES_TOKEN"=>array("CLEARTEXT","/--미 정의--/")
			,"USR_SEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"USR_ID"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"PGMID"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"AUTH_ID"=>array("REGEXMAT","/^[a-zA-Z]{1}[_a-zA-Z0-9]*$/")
			,"SUCCESS_YN"=>array("CLEARTEXT","/--미 정의--/")
			,"ADD_DT"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
$REQ["G3-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G3-XML"]
		,"COLORD"=>"LAUTHD_SEQ,REQ_TOKEN,RES_TOKEN,LAUTH_SEQ,PARAM_COLIDS,DD_COLIDS,PI_IN_COLIDS,PI_OUT_COLIDS,ROW_CNT,ADD_DT"
		,"VALID"=>
			array(
			"LAUTHD_SEQ"=>array("STRING",30)	
			,"REQ_TOKEN"=>array("STRING",37)	
			,"RES_TOKEN"=>array("STRING",30)	
			,"LAUTH_SEQ"=>array("NUMBER",10)	
			,"PARAM_COLIDS"=>array("STRING",30)	
			,"DD_COLIDS"=>array("STRING",30)	
			,"PI_IN_COLIDS"=>array("STRING",30)	
			,"PI_OUT_COLIDS"=>array("STRING",30)	
			,"ROW_CNT"=>array("STRING",30)	
			,"ADD_DT"=>array("STRING",14)	
					)
		,"FILTER"=>
			array(
			"LAUTHD_SEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"REQ_TOKEN"=>array("CLEARTEXT","/--미 정의--/")
			,"RES_TOKEN"=>array("CLEARTEXT","/--미 정의--/")
			,"LAUTH_SEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"PARAM_COLIDS"=>array("SAFETEXT","/--미 정의--/")
			,"DD_COLIDS"=>array("SAFETEXT","/--미 정의--/")
			,"PI_IN_COLIDS"=>array("SAFETEXT","/--미 정의--/")
			,"PI_OUT_COLIDS"=>array("SAFETEXT","/--미 정의--/")
			,"ROW_CNT"=>array("REGEXMAT","/^[0-9]+$/")
			,"ADD_DT"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
	
array_push($_RTIME,array("[TIME 40.REQ_VALID]",microtime(true)));
	//서비스 클래스 생성
$objService = new authlogService();
	//컨트롤 명령별 분개처리
alog("ctl:" . $ctl);
switch ($ctl){
			case "G1_SEARCHALL" :
  		echo $objService->goG1Searchall(); //컨, 조회(전체)
  		break;
	case "G1_SAVE" :
  		echo $objService->goG1Save(); //컨, 저장
  		break;
	case "G2_SEARCH" :
  		echo $objService->goG2Search(); //AUTH, 조회
  		break;
	case "G2_EXCEL" :
  		echo $objService->goG2Excel(); //AUTH, 엑셀다운로드
  		break;
	case "G2_CHKSAVE" :
  		echo $objService->goG2Chksave(); //AUTH, 선택저장
  		break;
	case "G3_SEARCH" :
  		echo $objService->goG3Search(); //AUTHD, 조회
  		break;
	case "G3_EXCEL" :
  		echo $objService->goG3Excel(); //AUTHD, 엑셀다운로드
  		break;
	case "G3_CHKSAVE" :
  		echo $objService->goG3Chksave(); //AUTHD, 선택저장
  		break;
	case "G4_SEARCH" :
  		echo $objService->goG4Search(); //AUTHD상세, 조회
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

alog("AuthlogControl___________________________end");

?>	