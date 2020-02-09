<?php
header("Content-Type: text/html; charset=UTF-8"); //SVRCTL
header("Cache-Control:no-cache");
header("Pragma:no-cache");
$_RTIME = array();
array_push($_RTIME,array("[TIME 00.START]",microtime(true)));
$CFG = include_once('../../common/include/incConfig.php');//CG CONFIG
include_once('errmngService.php');

array_push($_RTIME,array("[TIME 10.INCLUDE SERVICE]",microtime(true)));
include_once('../../common/include/incUtil.php');//CG UTIL
include_once('../../common/include/incRequest.php');//CG REQUEST
include_once('../../common/include/incDB.php');//CG DB
include_once('../../common/include/incSec.php');//CG SEC
include_once('../../common/include/incAuth.php');//CG AUTH
include_once('../../common/include/incUser.php');//CG USER
//하위에서 LOADDING LIB 처리
array_push($_RTIME,array("[TIME 20.IMPORT]",microtime(true)));
$reqToken = reqGetString("TOKEN",37);
$resToken = uniqid();

$log = getLogger(
	array(
	"LIST_NM"=>"log_CG"
	, "PGM_ID"=>"ERRMNG"
	, "REQTOKEN" => $reqToken
	, "RESTOKEN" => $resToken
	, "LOG_LEVEL" => Monolog\Logger::ERROR
	)
);
$log->info("ErrmngControl___________________________start");
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
}else if($objAuth->isAuth("ERRMNG",$ctl)){
	$objAuth->LAUTH_SEQ = $objAuth->logUsrAuth($reqToken,$resToken,"ERRMNG",$ctl,"Y");
}else{
	$objAuth->logUsrAuth($reqToken,$resToken,"ERRMNG",$ctl,"N");
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

//FILE먼저 : G1, 
//FILE먼저 : G2, 
//FILE먼저 : G3, 에러
//FILE먼저 : G4, 

//G1, 

//G2, 

//G3, 에러
$REQ["G3-ERRLOGSEQ"] = reqPostNumber("G3-ERRLOGSEQ",0);//SEQ	
$REQ["G3-ERRLOGSEQ"] = getFilter($REQ["G3-ERRLOGSEQ"],"","//");	
$REQ["G3-SESSIONID"] = reqPostString("G3-SESSIONID",30);//SESSION	
$REQ["G3-SESSIONID"] = getFilter($REQ["G3-SESSIONID"],"","//");	
$REQ["G3-REQID"] = reqPostString("G3-REQID",0);//REQID	
$REQ["G3-REQID"] = getFilter($REQ["G3-REQID"],"","//");	
$REQ["G3-ERRNO"] = reqPostString("G3-ERRNO",0);//NO	
$REQ["G3-ERRNO"] = getFilter($REQ["G3-ERRNO"],"","//");	
$REQ["G3-ERRCD"] = reqPostString("G3-ERRCD",20);//CD	
$REQ["G3-ERRCD"] = getFilter($REQ["G3-ERRCD"],"","//");	
$REQ["G3-ERRSTR"] = reqPostString("G3-ERRSTR",0);//STR	
$REQ["G3-ERRSTR"] = getFilter($REQ["G3-ERRSTR"],"","//");	
$REQ["G3-ERRFILE"] = reqPostString("G3-ERRFILE",100);//FILE	
$REQ["G3-ERRFILE"] = getFilter($REQ["G3-ERRFILE"],"","//");	
$REQ["G3-ERRLINE"] = reqPostString("G3-ERRLINE",0);//LINE	
$REQ["G3-ERRLINE"] = getFilter($REQ["G3-ERRLINE"],"","//");	
$REQ["G3-ERRCONTEXT"] = reqPostString("G3-ERRCONTEXT",0);//CONTEXT	
$REQ["G3-ERRCONTEXT"] = getFilter($REQ["G3-ERRCONTEXT"],"","//");	
$REQ["G3-ADDDT"] = reqPostString("G3-ADDDT",14);//ADD	
$REQ["G3-ADDDT"] = getFilter($REQ["G3-ADDDT"],"","//");	
$REQ["G3-MODDT"] = reqPostString("G3-MODDT",14);//MOD	
$REQ["G3-MODDT"] = getFilter($REQ["G3-MODDT"],"","//");	

//G4, 
$REQ["G4-SESSIONID"] = reqPostString("G4-SESSIONID",30);//SESSIONID	
$REQ["G4-SESSIONID"] = getFilter($REQ["G4-SESSIONID"],"","//");	
$REQ["G4-ERRCD"] = reqPostString("G4-ERRCD",20);//ERRCD	
$REQ["G4-ERRCD"] = getFilter($REQ["G4-ERRCD"],"","//");	
$REQ["G4-ERRFILE"] = reqPostString("G4-ERRFILE",100);//에러파일	
$REQ["G4-ERRFILE"] = getFilter($REQ["G4-ERRFILE"],"","//");	
$REQ["G3-XML"] = getXml2Array($_POST["G3-XML"]);//에러	
	//,  입력값 필터 
	$REQ["G3-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G3-XML"]
		,"COLORD"=>"ERRLOGSEQ,SESSIONID,REQID,ERRNO,ERRCD,ERRSTR,ERRFILE,ERRLINE,ERRCONTEXT,ADDDT,MODDT"
		,"VALID"=>
			array(
			"ERRLOGSEQ"=>array("NUMBER",0)	
			,"SESSIONID"=>array("STRING",30)	
			,"REQID"=>array("STRING",0)	
			,"ERRNO"=>array("STRING",0)	
			,"ERRCD"=>array("STRING",20)	
			,"ERRSTR"=>array("STRING",0)	
			,"ERRFILE"=>array("STRING",100)	
			,"ERRLINE"=>array("STRING",0)	
			,"ERRCONTEXT"=>array("STRING",0)	
			,"ADDDT"=>array("STRING",14)	
			,"MODDT"=>array("STRING",14)	
					)
		,"FILTER"=>
			array(
					)
	)
);
array_push($_RTIME,array("[TIME 40.REQ_VALID]",microtime(true)));
	//서비스 클래스 생성
$objService = new errmngService();
	//컨트롤 명령별 분개처리
$log->info("ctl:" . $ctl);
switch ($ctl){
		case "G1_SAVE" :
  		echo $objService->goG1Save(); //, 저장
  		break;
	case "G3_USERDEF" :
  		echo $objService->goG3Userdef(); //에러, 사용자정의
  		break;
	case "G3_SEARCH" :
  		echo $objService->goG3Search(); //에러, 조회
  		break;
	case "G3_SAVE" :
  		echo $objService->goG3Save(); //에러, 저장
  		break;
	case "G3_EXCEL" :
  		echo $objService->goG3Excel(); //에러, 엑셀다운로드
  		break;
	case "G4_SEARCH" :
  		echo $objService->goG4Search(); //, 조회
  		break;
	case "G4_SAVE" :
  		echo $objService->goG4Save(); //, 저장
  		break;
	case "G4_DELETE" :
  		echo $objService->goG4Delete(); //, 삭제
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

$log->info("ErrmngControl___________________________end");
$log->close(); unset($log);
?>
