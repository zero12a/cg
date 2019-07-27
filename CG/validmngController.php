<?php
header("Content-Type: text/html; charset=UTF-8"); //SVRCTL
header("Cache-Control:no-cache");
header("Pragma:no-cache");
$_RTIME = array();
array_push($_RTIME,array("[TIME 00.START]",microtime(true)));
include_once('validmngService.php');

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
alog("ValidmngControl___________________________start");

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
}else if($objAuth->isAuth("VALIDMNG",$ctl)){
	$objAuth->LAUTH_SEQ = $objAuth->logUsrAuth($reqToken,$resToken,"VALIDMNG",$ctl,"Y");
}else{
	$objAuth->logUsrAuth($reqToken,$resToken,"VALIDMNG",$ctl,"N");
	JsonMsg("500","120",$ctl . " 권한이 없습니다.");
}
		//사용자 정보 가져오기
//로그 저장 방식 결정
//일반로그, 권한변경로그, PI로그
//NORMAL, POWER, PI
$PGM_CFG["SECTYPE"] = "POWER";
$PGM_CFG["SQLTXT"] = array();
array_push($_RTIME,array("[TIME 30.AUTH_CHECK]",microtime(true)));
$REQ["F3-CTLCUD"] = reqPostString("F3-CTLCUD",2);

//로그인정보 및 환경경수 받기
$REQ["USER.SEQ"] = getUserSeq();

//FILE먼저 : C1, 조회조건
//FILE먼저 : G2, 목록
//FILE먼저 : F3, 상세

//C1, 조회조건
$REQ["C1-PJTSEQ"] = reqPostNumber("C1-PJTSEQ",20);//PJTSEQ	
$REQ["C1-PJTSEQ"] = getFilter($REQ["C1-PJTSEQ"],"REGEXMAT","/^[0-9]+$/");	

//G2, 목록
$REQ["G2-VALIDSEQ"] = reqPostNumber("G2-VALIDSEQ",30);//VALIDSEQ	
$REQ["G2-VALIDSEQ"] = getFilter($REQ["G2-VALIDSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-PJTSEQ"] = reqPostNumber("G2-PJTSEQ",20);//PJTSEQ	
$REQ["G2-PJTSEQ"] = getFilter($REQ["G2-PJTSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-DATATYPE"] = reqPostString("G2-DATATYPE",30);//데이터타입	
$REQ["G2-DATATYPE"] = getFilter($REQ["G2-DATATYPE"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G2-VALIDID"] = reqPostString("G2-VALIDID",120);//VALIDID	
$REQ["G2-VALIDID"] = getFilter($REQ["G2-VALIDID"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G2-VALIDNM"] = reqPostString("G2-VALIDNM",100);//VALIDNM	
$REQ["G2-VALIDNM"] = getFilter($REQ["G2-VALIDNM"],"SAFETEXT","/--미 정의--/");	
$REQ["G2-VALIDORD"] = reqPostString("G2-VALIDORD",100);//VALIDORD	
$REQ["G2-VALIDORD"] = getFilter($REQ["G2-VALIDORD"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-VALIDTYPE"] = reqPostString("G2-VALIDTYPE",100);//VALIDTYPE	
$REQ["G2-VALIDTYPE"] = getFilter($REQ["G2-VALIDTYPE"],"SAFETEXT","/--미 정의--/");	
$REQ["G2-INVALIDMSG"] = reqPostString("G2-INVALIDMSG",100);//INVALIDMSG	
$REQ["G2-INVALIDMSG"] = getFilter($REQ["G2-INVALIDMSG"],"SAFETEXT","/--미 정의--/");	
$REQ["G2-MATSTR"] = reqPostString("G2-MATSTR",100);//MATSTR	
$REQ["G2-MATSTR"] = getFilter($REQ["G2-MATSTR"],"SAFETEXT","/--미 정의--/");	
$REQ["G2-ADDDT"] = reqPostString("G2-ADDDT",14);//ADDDT	
$REQ["G2-ADDDT"] = getFilter($REQ["G2-ADDDT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-MODDT"] = reqPostString("G2-MODDT",14);//수정일	
$REQ["G2-MODDT"] = getFilter($REQ["G2-MODDT"],"REGEXMAT","/^[0-9]+$/");	

//F3, 상세
$REQ["G2-XML"] = getXml2Array($_POST["G2-XML"]);//목록	
	//,  입력값 필터 
	$REQ["G2-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G2-XML"]
		,"COLORD"=>"ROWCHK,VALIDSEQ,PJTSEQ,DATATYPE,VALIDID,VALIDNM,VALIDORD,VALIDTYPE,INVALIDMSG,MATSTR,ADDDT,MODDT"
		,"VALID"=>
			array(
			"ROWCHK"=>array("NUMBER",1)	
			,"VALIDSEQ"=>array("NUMBER",30)	
			,"PJTSEQ"=>array("NUMBER",20)	
			,"DATATYPE"=>array("STRING",30)	
			,"VALIDID"=>array("STRING",120)	
			,"VALIDNM"=>array("STRING",100)	
			,"VALIDORD"=>array("STRING",100)	
			,"VALIDTYPE"=>array("STRING",100)	
			,"INVALIDMSG"=>array("STRING",100)	
			,"MATSTR"=>array("STRING",100)	
			,"ADDDT"=>array("STRING",14)	
			,"MODDT"=>array("STRING",14)	
					)
		,"FILTER"=>
			array(
			"ROWCHK"=>array("SAFETEXT","/--미 정의--/")
			,"VALIDSEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"PJTSEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"DATATYPE"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"VALIDID"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"VALIDNM"=>array("SAFETEXT","/--미 정의--/")
			,"VALIDORD"=>array("REGEXMAT","/^[0-9]+$/")
			,"VALIDTYPE"=>array("SAFETEXT","/--미 정의--/")
			,"INVALIDMSG"=>array("SAFETEXT","/--미 정의--/")
			,"MATSTR"=>array("SAFETEXT","/--미 정의--/")
			,"ADDDT"=>array("REGEXMAT","/^[0-9]+$/")
			,"MODDT"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
	
$REQ["G2-CHK"] = $_POST["G2-CHK"];//CHK 받기
//filterGridChk($tStr,$tDataType,$tDataSize,$tValidType,$tValidRule)
$REQ["G2-CHK"] = filterGridChk($REQ["G2-CHK"],"NUMBER",30,"REGEXMAT","/^[0-9]+$/");//VALIDSEQ 입력값검증
	array_push($_RTIME,array("[TIME 40.REQ_VALID]",microtime(true)));
	//서비스 클래스 생성
$objService = new validmngService();
	//컨트롤 명령별 분개처리
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
	case "F3_DELETE" :
  		echo $objService->goF3Delete(); //상세, 삭제
  		break;
	case "F3_SEARCH" :
  		echo $objService->goF3Search(); //상세, 조회
  		break;
	case "F3_SAVE" :
  		echo $objService->goF3Save(); //상세, 저장
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

alog("ValidmngControl___________________________end");

?>	