<?php
header("Content-Type: text/html; charset=UTF-8"); //SVRCTL
header("Cache-Control:no-cache");
header("Pragma:no-cache");
$_RTIME = array();
array_push($_RTIME,array("[TIME 00.START]",microtime(true)));
$CFG = include_once('./incConfig.CG.php');//CG CONFIG
include_once('layoutmngService.php');

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
	, "PGM_ID"=>"LAYOUTMNG"
	, "REQTOKEN" => $reqToken
	, "RESTOKEN" => $resToken
	)
);
$log->info("LayoutmngControl___________________________start");
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
}else if($objAuth->isAuth("LAYOUTMNG",$ctl)){
	$objAuth->LAUTH_SEQ = $objAuth->logUsrAuth($reqToken,$resToken,"LAYOUTMNG",$ctl,"Y");
}else{
	$objAuth->logUsrAuth($reqToken,$resToken,"LAYOUTMNG",$ctl,"N");
	JsonMsg("500","120",$ctl . " 권한이 없습니다.");
}
		//사용자 정보 가져오기
	$REQ["USER.SEQ"] = getUserSeq();
//로그 저장 방식 결정
//일반로그, 권한변경로그, PI로그
//NORMAL, POWER, PI
$PGM_CFG["SECTYPE"] = "NORMAL";
$PGM_CFG["SQLTXT"] = array();
array_push($_RTIME,array("[TIME 30.AUTH_CHECK]",microtime(true)));

//FILE먼저 : G1, 
//FILE먼저 : G2, LAYOUT
//FILE먼저 : G3, LAYOUTD

//G1, 
$REQ["G1-LAYOUTID"] = reqPostString("G1-LAYOUTID",30);//LAYOUTID	
$REQ["G1-LAYOUTID"] = getFilter($REQ["G1-LAYOUTID"],"CLEARTEXT","/--미 정의--/");	

//G2, LAYOUT
$REQ["G2-PJTSEQ"] = reqPostNumber("G2-PJTSEQ",20);//PJTSEQ	
$REQ["G2-PJTSEQ"] = getFilter($REQ["G2-PJTSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-LAYOUTID"] = reqPostString("G2-LAYOUTID",30);//LAYOUTID	
$REQ["G2-LAYOUTID"] = getFilter($REQ["G2-LAYOUTID"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-GRPCNT"] = reqPostNumber("G2-GRPCNT",10);//GRPCNT	
$REQ["G2-GRPCNT"] = getFilter($REQ["G2-GRPCNT"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-USEYN"] = reqPostString("G2-USEYN",1);//사용	
$REQ["G2-USEYN"] = getFilter($REQ["G2-USEYN"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G2-ADDDT"] = reqPostString("G2-ADDDT",14);//ADDDT	
$REQ["G2-ADDDT"] = getFilter($REQ["G2-ADDDT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-ADDID"] = reqPostNumber("G2-ADDID",10);//ADDID	
$REQ["G2-ADDID"] = getFilter($REQ["G2-ADDID"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-MODDT"] = reqPostString("G2-MODDT",14);//MODDT	
$REQ["G2-MODDT"] = getFilter($REQ["G2-MODDT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-MODID"] = reqPostNumber("G2-MODID",10);//MODID	
$REQ["G2-MODID"] = getFilter($REQ["G2-MODID"],"REGEXMAT","/^[0-9]+$/");	

//G3, LAYOUTD
$REQ["G3-LAYOUTDSEQ"] = reqPostNumber("G3-LAYOUTDSEQ",10);//LAYOUTDSEQ	
$REQ["G3-LAYOUTDSEQ"] = getFilter($REQ["G3-LAYOUTDSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-PJTSEQ"] = reqPostNumber("G3-PJTSEQ",20);//PJTSEQ	
$REQ["G3-PJTSEQ"] = getFilter($REQ["G3-PJTSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-LAYOUTID"] = reqPostString("G3-LAYOUTID",30);//LAYOUTID	
$REQ["G3-LAYOUTID"] = getFilter($REQ["G3-LAYOUTID"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-GRPID"] = reqPostString("G3-GRPID",30);//GRPID	
$REQ["G3-GRPID"] = getFilter($REQ["G3-GRPID"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G3-REFGRPID"] = reqPostString("G3-REFGRPID",30);//REFGRPID	
$REQ["G3-REFGRPID"] = getFilter($REQ["G3-REFGRPID"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G3-ORD"] = reqPostNumber("G3-ORD",10);//ORD	
$REQ["G3-ORD"] = getFilter($REQ["G3-ORD"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-GRPTYPE"] = reqPostString("G3-GRPTYPE",10);//GRPTYPE	
$REQ["G3-GRPTYPE"] = getFilter($REQ["G3-GRPTYPE"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G3-GRPWIDTH"] = reqPostString("G3-GRPWIDTH",10);//GRPWIDTH	
$REQ["G3-GRPWIDTH"] = getFilter($REQ["G3-GRPWIDTH"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-GRPHEIGHT"] = reqPostString("G3-GRPHEIGHT",10);//GRPHEIGHT	
$REQ["G3-GRPHEIGHT"] = getFilter($REQ["G3-GRPHEIGHT"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-VBOX"] = reqPostString("G3-VBOX",10);//VBOX	
$REQ["G3-VBOX"] = getFilter($REQ["G3-VBOX"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-ADDDT"] = reqPostString("G3-ADDDT",14);//ADDDT	
$REQ["G3-ADDDT"] = getFilter($REQ["G3-ADDDT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-MODDT"] = reqPostString("G3-MODDT",14);//MODDT	
$REQ["G3-MODDT"] = getFilter($REQ["G3-MODDT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-XML"] = getXml2Array($_POST["G2-XML"]);//LAYOUT	
	$REQ["G3-XML"] = getXml2Array($_POST["G3-XML"]);//LAYOUTD	
	//,  입력값 필터 
	$REQ["G2-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G2-XML"]
		,"COLORD"=>"PJTSEQ,LAYOUTID,GRPCNT,USEYN,ADDDT,ADDID,MODDT,MODID"
		,"VALID"=>
			array(
			"PJTSEQ"=>array("NUMBER",20)	
			,"LAYOUTID"=>array("STRING",30)	
			,"GRPCNT"=>array("NUMBER",10)	
			,"USEYN"=>array("STRING",1)	
			,"ADDDT"=>array("STRING",14)	
			,"ADDID"=>array("NUMBER",10)	
			,"MODDT"=>array("STRING",14)	
			,"MODID"=>array("NUMBER",10)	
					)
		,"FILTER"=>
			array(
			"PJTSEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"LAYOUTID"=>array("CLEARTEXT","/--미 정의--/")
			,"GRPCNT"=>array("CLEARTEXT","/--미 정의--/")
			,"USEYN"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"ADDDT"=>array("REGEXMAT","/^[0-9]+$/")
			,"ADDID"=>array("REGEXMAT","/^[0-9]+$/")
			,"MODDT"=>array("REGEXMAT","/^[0-9]+$/")
			,"MODID"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
$REQ["G3-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G3-XML"]
		,"COLORD"=>"LAYOUTDSEQ,PJTSEQ,LAYOUTID,GRPID,REFGRPID,ORD,GRPTYPE,GRPWIDTH,GRPHEIGHT,VBOX,ADDDT,MODDT"
		,"VALID"=>
			array(
			"LAYOUTDSEQ"=>array("NUMBER",10)	
			,"PJTSEQ"=>array("NUMBER",20)	
			,"LAYOUTID"=>array("STRING",30)	
			,"GRPID"=>array("STRING",30)	
			,"REFGRPID"=>array("STRING",30)	
			,"ORD"=>array("NUMBER",10)	
			,"GRPTYPE"=>array("STRING",10)	
			,"GRPWIDTH"=>array("STRING",10)	
			,"GRPHEIGHT"=>array("STRING",10)	
			,"VBOX"=>array("STRING",10)	
			,"ADDDT"=>array("STRING",14)	
			,"MODDT"=>array("STRING",14)	
					)
		,"FILTER"=>
			array(
			"LAYOUTDSEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"PJTSEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"LAYOUTID"=>array("CLEARTEXT","/--미 정의--/")
			,"GRPID"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"REFGRPID"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"ORD"=>array("REGEXMAT","/^[0-9]+$/")
			,"GRPTYPE"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"GRPWIDTH"=>array("CLEARTEXT","/--미 정의--/")
			,"GRPHEIGHT"=>array("CLEARTEXT","/--미 정의--/")
			,"VBOX"=>array("CLEARTEXT","/--미 정의--/")
			,"ADDDT"=>array("REGEXMAT","/^[0-9]+$/")
			,"MODDT"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
array_push($_RTIME,array("[TIME 40.REQ_VALID]",microtime(true)));
	//서비스 클래스 생성
$objService = new layoutmngService();
	//컨트롤 명령별 분개처리
$log->info("ctl:" . $ctl);
switch ($ctl){
			case "G1_SEARCHALL" :
  		echo $objService->goG1Searchall(); //, 조회(전체)
  		break;
	case "G1_SAVE" :
  		echo $objService->goG1Save(); //, 저장
  		break;
	case "G2_SEARCH" :
  		echo $objService->goG2Search(); //LAYOUT, 조회
  		break;
	case "G2_SAVE" :
  		echo $objService->goG2Save(); //LAYOUT, 저장
  		break;
	case "G2_EXCEL" :
  		echo $objService->goG2Excel(); //LAYOUT, 엑셀다운로드
  		break;
	case "G2_CHKSAVE" :
  		echo $objService->goG2Chksave(); //LAYOUT, 선택저장
  		break;
	case "G3_SEARCH" :
  		echo $objService->goG3Search(); //LAYOUTD, 조회
  		break;
	case "G3_SAVE" :
  		echo $objService->goG3Save(); //LAYOUTD, 저장
  		break;
	case "G3_EXCEL" :
  		echo $objService->goG3Excel(); //LAYOUTD, 엑셀다운로드
  		break;
	case "G3_CHKSAVE" :
  		echo $objService->goG3Chksave(); //LAYOUTD, 선택저장
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

$log->info("LayoutmngControl___________________________end");
$log->close(); unset($log);
?>
