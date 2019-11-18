<?php
header("Content-Type: text/html; charset=UTF-8"); //SVRCTL
header("Cache-Control:no-cache");
header("Pragma:no-cache");
$_RTIME = array();
array_push($_RTIME,array("[TIME 00.START]",microtime(true)));
$CFG = include_once('./incConfig.CG.php');//CG CONFIG
include_once('ddiomngService.php');

array_push($_RTIME,array("[TIME 10.INCLUDE SERVICE]",microtime(true)));
include_once('../include/incUtil.php');//CG UTIL
include_once('../include/incRequest.php');//CG REQUEST
include_once('../include/incDB.php');//CG DB
include_once('../include/incSec.php');//CG SEC
include_once('../include/incAuth.php');//CG AUTH
include_once('../include/incUser.php');//CG USER
//하위에서 LOADDING LIB 처리
	array_push($_RTIME,array("[TIME 20.IMPORT]",microtime(true)));
$reqToken = reqGetString("TOKEN",37);
$resToken = uniqid();

$log = getLogger(
	array(
	"LIST_NM"=>"log_CG"
	, "PGM_ID"=>"DDIOMNG"
	, "REQTOKEN" => $reqToken
	, "RESTOKEN" => $resToken
	)
);
$log->info("DdiomngControl___________________________start");
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
}else if($objAuth->isAuth("DDIOMNG",$ctl)){
	$objAuth->LAUTH_SEQ = $objAuth->logUsrAuth($reqToken,$resToken,"DDIOMNG",$ctl,"Y");
}else{
	$objAuth->logUsrAuth($reqToken,$resToken,"DDIOMNG",$ctl,"N");
	JsonMsg("500","120",$ctl . " 권한이 없습니다.");
}
		//사용자 정보 가져오기
//로그 저장 방식 결정
//일반로그, 권한변경로그, PI로그
//NORMAL, POWER, PI
$PGM_CFG["SECTYPE"] = "NORMAL";
$PGM_CFG["SQLTXT"] = array();
array_push($_RTIME,array("[TIME 30.AUTH_CHECK]",microtime(true)));

//FILE먼저 : G1, 조건1
//FILE먼저 : G2, DATASIZE
//FILE먼저 : G3, DATATYPE
//FILE먼저 : G4, VALIDSEQ

//G1, 조건1
$REQ["G1-COLID"] = reqPostString("G1-COLID",30);//컬럼ID	
$REQ["G1-COLID"] = getFilter($REQ["G1-COLID"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	

//G2, DATASIZE
$REQ["G2-COLID"] = reqPostString("G2-COLID",30);//컬럼ID	
$REQ["G2-COLID"] = getFilter($REQ["G2-COLID"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G2-PGMSEQ"] = reqPostString("G2-PGMSEQ",30);//SEQ	
$REQ["G2-PGMSEQ"] = getFilter($REQ["G2-PGMSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-IOSEQ"] = reqPostNumber("G2-IOSEQ",30);//IOSEQ	
$REQ["G2-IOSEQ"] = getFilter($REQ["G2-IOSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-DD_DATASIZE"] = reqPostString("G2-DD_DATASIZE",30);//DD SIZE	
$REQ["G2-DD_DATASIZE"] = getFilter($REQ["G2-DD_DATASIZE"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-IO_DATASIZE"] = reqPostString("G2-IO_DATASIZE",30);//IO SIZE	
$REQ["G2-IO_DATASIZE"] = getFilter($REQ["G2-IO_DATASIZE"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-ADDDT"] = reqPostString("G2-ADDDT",14);//ADDDT	
$REQ["G2-ADDDT"] = getFilter($REQ["G2-ADDDT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-MODDT"] = reqPostString("G2-MODDT",14);//MODDT	
$REQ["G2-MODDT"] = getFilter($REQ["G2-MODDT"],"REGEXMAT","/^[0-9]+$/");	

//G3, DATATYPE
$REQ["G3-COLID"] = reqPostString("G3-COLID",30);//컬럼ID	
$REQ["G3-COLID"] = getFilter($REQ["G3-COLID"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G3-PGMSEQ"] = reqPostString("G3-PGMSEQ",30);//SEQ	
$REQ["G3-PGMSEQ"] = getFilter($REQ["G3-PGMSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-IOSEQ"] = reqPostNumber("G3-IOSEQ",30);//IOSEQ	
$REQ["G3-IOSEQ"] = getFilter($REQ["G3-IOSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-DD_DATATYPE"] = reqPostString("G3-DD_DATATYPE",30);//DD TYPE	
$REQ["G3-DD_DATATYPE"] = getFilter($REQ["G3-DD_DATATYPE"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-IO_DATATYPE"] = reqPostString("G3-IO_DATATYPE",30);//IO TYPE	
$REQ["G3-IO_DATATYPE"] = getFilter($REQ["G3-IO_DATATYPE"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-ADDDT"] = reqPostString("G3-ADDDT",14);//ADDDT	
$REQ["G3-ADDDT"] = getFilter($REQ["G3-ADDDT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-MODDT"] = reqPostString("G3-MODDT",14);//MODDT	
$REQ["G3-MODDT"] = getFilter($REQ["G3-MODDT"],"REGEXMAT","/^[0-9]+$/");	

//G4, VALIDSEQ
$REQ["G4-COLID"] = reqPostString("G4-COLID",30);//컬럼ID	
$REQ["G4-COLID"] = getFilter($REQ["G4-COLID"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G4-PGMSEQ"] = reqPostString("G4-PGMSEQ",30);//SEQ	
$REQ["G4-PGMSEQ"] = getFilter($REQ["G4-PGMSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G4-IOSEQ"] = reqPostNumber("G4-IOSEQ",30);//IOSEQ	
$REQ["G4-IOSEQ"] = getFilter($REQ["G4-IOSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G4-DD_VALIDSEQ"] = reqPostNumber("G4-DD_VALIDSEQ",30);//DD VALID	
$REQ["G4-DD_VALIDSEQ"] = getFilter($REQ["G4-DD_VALIDSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G4-IO_VALIDSEQ"] = reqPostNumber("G4-IO_VALIDSEQ",30);//IO VALID	
$REQ["G4-IO_VALIDSEQ"] = getFilter($REQ["G4-IO_VALIDSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G4-ADDDT"] = reqPostString("G4-ADDDT",14);//ADDDT	
$REQ["G4-ADDDT"] = getFilter($REQ["G4-ADDDT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G4-MODDT"] = reqPostString("G4-MODDT",14);//MODDT	
$REQ["G4-MODDT"] = getFilter($REQ["G4-MODDT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-XML"] = getXml2Array($_POST["G2-XML"]);//DATASIZE	
	$REQ["G3-XML"] = getXml2Array($_POST["G3-XML"]);//DATATYPE	
	$REQ["G4-XML"] = getXml2Array($_POST["G4-XML"]);//VALIDSEQ	
	//,  입력값 필터 
	$REQ["G2-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G2-XML"]
		,"COLORD"=>"CHK,COLID,PGMSEQ,IOSEQ,DD_DATASIZE,IO_DATASIZE,ADDDT,MODDT"
		,"VALID"=>
			array(
			"CHK"=>array("NUMBER",1)	
			,"COLID"=>array("STRING",30)	
			,"PGMSEQ"=>array("STRING",30)	
			,"IOSEQ"=>array("NUMBER",30)	
			,"DD_DATASIZE"=>array("STRING",30)	
			,"IO_DATASIZE"=>array("STRING",30)	
			,"ADDDT"=>array("STRING",14)	
			,"MODDT"=>array("STRING",14)	
					)
		,"FILTER"=>
			array(
			"CHK"=>array("REGEXMAT","/^([0-9a-zA-Z]|,)+$/")
			,"COLID"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"PGMSEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"IOSEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"DD_DATASIZE"=>array("REGEXMAT","/^[0-9]+$/")
			,"IO_DATASIZE"=>array("REGEXMAT","/^[0-9]+$/")
			,"ADDDT"=>array("REGEXMAT","/^[0-9]+$/")
			,"MODDT"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
$REQ["G3-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G3-XML"]
		,"COLORD"=>"CHK,COLID,PGMSEQ,IOSEQ,DD_DATATYPE,IO_DATATYPE,ADDDT,MODDT"
		,"VALID"=>
			array(
			"CHK"=>array("NUMBER",1)	
			,"COLID"=>array("STRING",30)	
			,"PGMSEQ"=>array("STRING",30)	
			,"IOSEQ"=>array("NUMBER",30)	
			,"DD_DATATYPE"=>array("STRING",30)	
			,"IO_DATATYPE"=>array("STRING",30)	
			,"ADDDT"=>array("STRING",14)	
			,"MODDT"=>array("STRING",14)	
					)
		,"FILTER"=>
			array(
			"CHK"=>array("REGEXMAT","/^([0-9a-zA-Z]|,)+$/")
			,"COLID"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"PGMSEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"IOSEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"DD_DATATYPE"=>array("CLEARTEXT","/--미 정의--/")
			,"IO_DATATYPE"=>array("CLEARTEXT","/--미 정의--/")
			,"ADDDT"=>array("REGEXMAT","/^[0-9]+$/")
			,"MODDT"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
$REQ["G4-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G4-XML"]
		,"COLORD"=>"CHK,COLID,PGMSEQ,IOSEQ,DD_VALIDSEQ,IO_VALIDSEQ,ADDDT,MODDT"
		,"VALID"=>
			array(
			"CHK"=>array("NUMBER",1)	
			,"COLID"=>array("STRING",30)	
			,"PGMSEQ"=>array("STRING",30)	
			,"IOSEQ"=>array("NUMBER",30)	
			,"DD_VALIDSEQ"=>array("NUMBER",30)	
			,"IO_VALIDSEQ"=>array("NUMBER",30)	
			,"ADDDT"=>array("STRING",14)	
			,"MODDT"=>array("STRING",14)	
					)
		,"FILTER"=>
			array(
			"CHK"=>array("REGEXMAT","/^([0-9a-zA-Z]|,)+$/")
			,"COLID"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"PGMSEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"IOSEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"DD_VALIDSEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"IO_VALIDSEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"ADDDT"=>array("REGEXMAT","/^[0-9]+$/")
			,"MODDT"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
$REQ["G2-CHK"] = $_POST["G2-CHK"];//CHK 받기
//filterGridChk($tStr,$tDataType,$tDataSize,$tValidType,$tValidRule)
$REQ["G2-CHK"] = filterGridChk($REQ["G2-CHK"],"NUMBER",30,"REGEXMAT","/^[0-9]+$/");//IOSEQ 입력값검증
	$REQ["G3-CHK"] = $_POST["G3-CHK"];//CHK 받기
//filterGridChk($tStr,$tDataType,$tDataSize,$tValidType,$tValidRule)
$REQ["G3-CHK"] = filterGridChk($REQ["G3-CHK"],"NUMBER",30,"REGEXMAT","/^[0-9]+$/");//IOSEQ 입력값검증
	$REQ["G4-CHK"] = $_POST["G4-CHK"];//CHK 받기
//filterGridChk($tStr,$tDataType,$tDataSize,$tValidType,$tValidRule)
$REQ["G4-CHK"] = filterGridChk($REQ["G4-CHK"],"NUMBER",30,"REGEXMAT","/^[0-9]+$/");//IOSEQ 입력값검증
	array_push($_RTIME,array("[TIME 40.REQ_VALID]",microtime(true)));
	//서비스 클래스 생성
$objService = new ddiomngService();
	//컨트롤 명령별 분개처리
$log->info("ctl:" . $ctl);
switch ($ctl){
			case "G1_SEARCHALL" :
  		echo $objService->goG1Searchall(); //조건1, 조회(전체)
  		break;
	case "G1_SAVE" :
  		echo $objService->goG1Save(); //조건1, 저장
  		break;
	case "G2_SEARCH" :
  		echo $objService->goG2Search(); //DATASIZE, 조회
  		break;
	case "G2_SAVE" :
  		echo $objService->goG2Save(); //DATASIZE, S
  		break;
	case "G2_CHKSAVE" :
  		echo $objService->goG2Chksave(); //DATASIZE, 선택저장
  		break;
	case "G3_SEARCH" :
  		echo $objService->goG3Search(); //DATATYPE, 조회
  		break;
	case "G3_SAVE" :
  		echo $objService->goG3Save(); //DATATYPE, S
  		break;
	case "G3_CHKSAVE" :
  		echo $objService->goG3Chksave(); //DATATYPE, 선택저장
  		break;
	case "G4_SEARCH" :
  		echo $objService->goG4Search(); //VALIDSEQ, 조회
  		break;
	case "G4_CHKSAVE" :
  		echo $objService->goG4Chksave(); //VALIDSEQ, 선택저장
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
	$log->debug( $_RTIME[$j][0] . " " . number_format($_RTIME[$j][1]-$_RTIME[$j-1][1],4) );

	if($j == sizeof($_RTIME)-1) $log->debug( "RUN TIME : " . number_format($_RTIME[$j][1]-$_RTIME[0][1],4) );
}
//서비스 클래스 비우기
unset($objService);
unset($objAuth);

$log->info("DdiomngControl___________________________end");
$log->close(); unset($log);
?>
