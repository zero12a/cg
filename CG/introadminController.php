<?php
header("Content-Type: text/html; charset=UTF-8"); //SVRCTL
header("Cache-Control:no-cache");
header("Pragma:no-cache");
$_RTIME = array();
array_push($_RTIME,array("[TIME 00.START]",microtime(true)));
include_once('introadminService.php');

array_push($_RTIME,array("[TIME 10.INCLUDE SERVICE]",microtime(true)));
include_once('../include/incUtil.php');//CG UTIL
	include_once('../include/incRequest.php');//CG REQUEST
	include_once('../include/incDB.php');//CG DB
	include_once('../include/incSec.php');//CG SEC
	include_once('./incConfig.CG.php');//CG CONFIG
	include_once('../include/incAuth.php');//CG AUTH
	include_once('../include/incUser.php');//CG USER
	//하위에서 LOADDING LIB 처리
	array_push($_RTIME,array("[TIME 20.IMPORT]",microtime(true)));
alog("IntroadminControl___________________________start");

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
}else if($objAuth->isAuth("INTROADMIN",$ctl)){
	$objAuth->LAUTH_SEQ = $objAuth->logUsrAuth($reqToken,$resToken,"INTROADMIN",$ctl,"Y");
}else{
	$objAuth->logUsrAuth($reqToken,$resToken,"INTROADMIN",$ctl,"N");
	JsonMsg("500","120",$ctl . " 권한이 없습니다.");
}
		//사용자 정보 가져오기
//로그 저장 방식 결정
//일반로그, 권한변경로그, PI로그
//NORMAL, POWER, PI
$PGM_CFG["SECTYPE"] = "NORMAL";
$PGM_CFG["SQLTXT"] = array();
array_push($_RTIME,array("[TIME 30.AUTH_CHECK]",microtime(true)));
$REQ["G2-CTLCUD"] = reqPostString("G2-CTLCUD",2);

//FILE먼저 : G1, 조건
//FILE먼저 : G2, 월점검
//FILE먼저 : G8, 월점검목록
//FILE먼저 : G3, 로그인실패
//FILE먼저 : G4, 로그인실패IP
//FILE먼저 : G6, 권한없는접근
//FILE먼저 : G7, 로그인잠금
//FILE먼저 : G9, 개인정보접근

//G1, 조건
$REQ["G1-FROM_DT"] = reqPostString("G1-FROM_DT",10);//FROM_DT	
$REQ["G1-FROM_DT"] = getFilter($REQ["G1-FROM_DT"],"CLEARTEXT","/--미 정의--/");	
$REQ["G1-TO_DT"] = reqPostString("G1-TO_DT",10);//TO_DT	
$REQ["G1-TO_DT"] = getFilter($REQ["G1-TO_DT"],"CLEARTEXT","/--미 정의--/");	

//G2, 월점검
$REQ["G2-FROM_DT"] = reqPostString("G2-FROM_DT",10);//FROM_DT	
$REQ["G2-FROM_DT"] = getFilter($REQ["G2-FROM_DT"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-TO_DT"] = reqPostString("G2-TO_DT",10);//~	
$REQ["G2-TO_DT"] = getFilter($REQ["G2-TO_DT"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-CFM_DESC"] = reqPostString("G2-CFM_DESC",150);//CFM_DESC	
$REQ["G2-CFM_DESC"] = getFilter($REQ["G2-CFM_DESC"],"CLEARTEXT","/--미 정의--/");	

//G8, 월점검목록
$REQ["G8-CFM_SEQ"] = reqPostString("G8-CFM_SEQ",20);//CFM_SEQ	
$REQ["G8-CFM_SEQ"] = getFilter($REQ["G8-CFM_SEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G8-FROM_DT"] = reqPostString("G8-FROM_DT",10);//FROM_DT	
$REQ["G8-FROM_DT"] = getFilter($REQ["G8-FROM_DT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G8-TO_DT"] = reqPostString("G8-TO_DT",10);//TO_DT	
$REQ["G8-TO_DT"] = getFilter($REQ["G8-TO_DT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G8-CFM_DESC"] = reqPostString("G8-CFM_DESC",50);//CFM_DESC	
$REQ["G8-CFM_DESC"] = getFilter($REQ["G8-CFM_DESC"],"CLEARTEXT","/--미 정의--/");	
$REQ["G8-ADD_DT"] = reqPostString("G8-ADD_DT",14);//ADD	
$REQ["G8-ADD_DT"] = getFilter($REQ["G8-ADD_DT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G8-ADD_ID"] = reqPostString("G8-ADD_ID",30);//ADD_ID	
$REQ["G8-ADD_ID"] = getFilter($REQ["G8-ADD_ID"],"SAFETEXT","/--미 정의--/");	

//G3, 로그인실패
$REQ["G3-USR_ID"] = reqPostString("G3-USR_ID",10);//USR_ID	
$REQ["G3-USR_ID"] = getFilter($REQ["G3-USR_ID"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G3-LOGIN_CNT"] = reqPostNumber("G3-LOGIN_CNT",20);//LOGIN_CNT	
$REQ["G3-LOGIN_CNT"] = getFilter($REQ["G3-LOGIN_CNT"],"REGEXMAT","/^[0-9]+$/");	

//G4, 로그인실패IP
$REQ["G4-REMOTE_ADDR"] = reqPostString("G4-REMOTE_ADDR",20);//IP	
$REQ["G4-REMOTE_ADDR"] = getFilter($REQ["G4-REMOTE_ADDR"],"CLEARTEXT","/--미 정의--/");	
$REQ["G4-LOGIN_CNT"] = reqPostNumber("G4-LOGIN_CNT",20);//LOGIN_CNT	
$REQ["G4-LOGIN_CNT"] = getFilter($REQ["G4-LOGIN_CNT"],"REGEXMAT","/^[0-9]+$/");	

//G6, 권한없는접근
$REQ["G6-USR_ID"] = reqPostString("G6-USR_ID",10);//USR_ID	
$REQ["G6-USR_ID"] = getFilter($REQ["G6-USR_ID"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G6-AUTH_CNT"] = reqPostNumber("G6-AUTH_CNT",20);//AUTH_CNT	
$REQ["G6-AUTH_CNT"] = getFilter($REQ["G6-AUTH_CNT"],"REGEXMAT","/^[0-9]+$/");	

//G7, 로그인잠금
$REQ["G7-USR_ID"] = reqPostString("G7-USR_ID",10);//USR_ID	
$REQ["G7-USR_ID"] = getFilter($REQ["G7-USR_ID"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G7-LOGIN_CNT"] = reqPostNumber("G7-LOGIN_CNT",20);//LOGIN_CNT	
$REQ["G7-LOGIN_CNT"] = getFilter($REQ["G7-LOGIN_CNT"],"REGEXMAT","/^[0-9]+$/");	

//G9, 개인정보접근
$REQ["G9-USR_ID"] = reqPostString("G9-USR_ID",10);//USR_ID	
$REQ["G9-USR_ID"] = getFilter($REQ["G9-USR_ID"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G9-REQ_PI_CNT"] = reqPostNumber("G9-REQ_PI_CNT",20);//PI_CNT	
$REQ["G9-REQ_PI_CNT"] = getFilter($REQ["G9-REQ_PI_CNT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G9-VIEW_ROW_SUM"] = reqPostNumber("G9-VIEW_ROW_SUM",30);//ROW_SUM	
$REQ["G9-VIEW_ROW_SUM"] = getFilter($REQ["G9-VIEW_ROW_SUM"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G8-XML"] = getXml2Array($_POST["G8-XML"]);//월점검목록	
	$REQ["G3-XML"] = getXml2Array($_POST["G3-XML"]);//로그인실패	
	$REQ["G4-XML"] = getXml2Array($_POST["G4-XML"]);//로그인실패IP	
	$REQ["G6-XML"] = getXml2Array($_POST["G6-XML"]);//권한없는접근	
	$REQ["G7-XML"] = getXml2Array($_POST["G7-XML"]);//로그인잠금	
	$REQ["G9-XML"] = getXml2Array($_POST["G9-XML"]);//개인정보접근	
	//,  입력값 필터 
	$REQ["G8-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G8-XML"]
		,"COLORD"=>"CFM_SEQ,FROM_DT,TO_DT,CFM_DESC,ADD_DT,ADD_ID"
		,"VALID"=>
			array(
			"CFM_SEQ"=>array("STRING",20)	
			,"FROM_DT"=>array("STRING",10)	
			,"TO_DT"=>array("STRING",10)	
			,"CFM_DESC"=>array("STRING",50)	
			,"ADD_DT"=>array("STRING",14)	
			,"ADD_ID"=>array("STRING",30)	
					)
		,"FILTER"=>
			array(
			"CFM_SEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"FROM_DT"=>array("REGEXMAT","/^[0-9]+$/")
			,"TO_DT"=>array("REGEXMAT","/^[0-9]+$/")
			,"CFM_DESC"=>array("CLEARTEXT","/--미 정의--/")
			,"ADD_DT"=>array("REGEXMAT","/^[0-9]+$/")
			,"ADD_ID"=>array("SAFETEXT","/--미 정의--/")
					)
	)
);
$REQ["G3-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G3-XML"]
		,"COLORD"=>"USR_ID,LOGIN_CNT"
		,"VALID"=>
			array(
			"USR_ID"=>array("STRING",10)	
			,"LOGIN_CNT"=>array("NUMBER",20)	
					)
		,"FILTER"=>
			array(
			"USR_ID"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"LOGIN_CNT"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
$REQ["G4-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G4-XML"]
		,"COLORD"=>"REMOTE_ADDR,LOGIN_CNT"
		,"VALID"=>
			array(
			"REMOTE_ADDR"=>array("STRING",20)	
			,"LOGIN_CNT"=>array("NUMBER",20)	
					)
		,"FILTER"=>
			array(
			"REMOTE_ADDR"=>array("CLEARTEXT","/--미 정의--/")
			,"LOGIN_CNT"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
$REQ["G6-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G6-XML"]
		,"COLORD"=>"USR_ID,AUTH_CNT"
		,"VALID"=>
			array(
			"USR_ID"=>array("STRING",10)	
			,"AUTH_CNT"=>array("NUMBER",20)	
					)
		,"FILTER"=>
			array(
			"USR_ID"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"AUTH_CNT"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
$REQ["G7-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G7-XML"]
		,"COLORD"=>"USR_ID,LOGIN_CNT"
		,"VALID"=>
			array(
			"USR_ID"=>array("STRING",10)	
			,"LOGIN_CNT"=>array("NUMBER",20)	
					)
		,"FILTER"=>
			array(
			"USR_ID"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"LOGIN_CNT"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
$REQ["G9-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G9-XML"]
		,"COLORD"=>"USR_ID,REQ_PI_CNT,VIEW_ROW_SUM"
		,"VALID"=>
			array(
			"USR_ID"=>array("STRING",10)	
			,"REQ_PI_CNT"=>array("NUMBER",20)	
			,"VIEW_ROW_SUM"=>array("NUMBER",30)	
					)
		,"FILTER"=>
			array(
			"USR_ID"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"REQ_PI_CNT"=>array("REGEXMAT","/^[0-9]+$/")
			,"VIEW_ROW_SUM"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
array_push($_RTIME,array("[TIME 40.REQ_VALID]",microtime(true)));
	//서비스 클래스 생성
$objService = new introadminService();
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
  		echo $objService->goG2Search(); //월점검, 조회
  		break;
	case "G2_SAVE" :
  		echo $objService->goG2Save(); //월점검, 저장
  		break;
	case "G8_SEARCH" :
  		echo $objService->goG8Search(); //월점검목록, 조회
  		break;
	case "G8_EXCEL" :
  		echo $objService->goG8Excel(); //월점검목록, 엑셀다운로드
  		break;
	case "G3_SEARCH" :
  		echo $objService->goG3Search(); //로그인실패, 조회
  		break;
	case "G3_EXCEL" :
  		echo $objService->goG3Excel(); //로그인실패, 엑셀다운로드
  		break;
	case "G4_SEARCH" :
  		echo $objService->goG4Search(); //로그인실패IP, 조회
  		break;
	case "G4_EXCEL" :
  		echo $objService->goG4Excel(); //로그인실패IP, 엑셀다운로드
  		break;
	case "G6_SEARCH" :
  		echo $objService->goG6Search(); //권한없는접근, 조회
  		break;
	case "G6_EXCEL" :
  		echo $objService->goG6Excel(); //권한없는접근, 엑셀다운로드
  		break;
	case "G7_SEARCH" :
  		echo $objService->goG7Search(); //로그인잠금, 조회
  		break;
	case "G7_EXCEL" :
  		echo $objService->goG7Excel(); //로그인잠금, 엑셀다운로드
  		break;
	case "G9_SEARCH" :
  		echo $objService->goG9Search(); //개인정보접근, 조회
  		break;
	case "G9_EXCEL" :
  		echo $objService->goG9Excel(); //개인정보접근, 엑셀다운로드
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

alog("IntroadminControl___________________________end");

?>	