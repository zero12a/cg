<?php
header("Content-Type: text/html; charset=UTF-8"); //SVRCTL
header("Cache-Control:no-cache");
header("Pragma:no-cache");
$_RTIME = array();
array_push($_RTIME,array("[TIME 00.START]",microtime(true)));
$CFG = require_once('../../common/include/incConfig.php');//CG CONFIG
require_once($CFG["CFG_LIBS_VENDOR"]);
require_once('monologService.php');

array_push($_RTIME,array("[TIME 10.INCLUDE SERVICE]",microtime(true)));
require_once('../../common/include/incUtil.php');//CG UTIL
require_once('../../common/include/incRequest.php');//CG REQUEST
require_once('../../common/include/incDB.php');//CG DB
require_once('../../common/include/incSec.php');//CG SEC
require_once('../../common/include/incAuth.php');//CG AUTH
require_once('../../common/include/incUser.php');//CG USER
//하위에서 LOADDING LIB 처리
array_push($_RTIME,array("[TIME 20.IMPORT]",microtime(true)));
$reqToken = reqGetString("TOKEN",37);
$resToken = uniqid();

$log = getLogger(
	array(
	"LIST_NM"=>"log_CG"
	, "PGM_ID"=>"MONOLOG"
	, "REQTOKEN" => $reqToken
	, "RESTOKEN" => $resToken
	, "LOG_LEVEL" => Monolog\Logger::ERROR
	)
);
$log->info("MonologControl___________________________start");
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
}else if($objAuth->isAuth("MONOLOG",$ctl)){
	$objAuth->LAUTH_SEQ = $objAuth->logUsrAuth($reqToken,$resToken,"MONOLOG",$ctl,"Y");
}else{
	$objAuth->logUsrAuth($reqToken,$resToken,"MONOLOG",$ctl,"N");
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

//FILE먼저 : G1, 
//FILE먼저 : G2, 로그
//FILE먼저 : G3, 상세

//G1,  - RW속성 오브젝트만 필터 적용 ( RO속성은 제외 )
$REQ["G1-ADDDT"] = reqPostString("G1-ADDDT",14);//ADDDT	
$REQ["G1-ADDDT"] = getFilter($REQ["G1-ADDDT"],"REGEXMAT","/^[0-9]{8}$/");	
$REQ["G1-LISTNM"] = reqPostString("G1-LISTNM",30);//LIST	
$REQ["G1-LISTNM"] = getFilter($REQ["G1-LISTNM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G1-LOGLEVEL"] = reqPostString("G1-LOGLEVEL",30);//LEVEL	
$REQ["G1-LOGLEVEL"] = getFilter($REQ["G1-LOGLEVEL"],"CLEARTEXT","/--미 정의--/");	
$REQ["G1-LOGMSG"] = reqPostString("G1-LOGMSG",300);//MSG	
$REQ["G1-LOGMSG"] = getFilter($REQ["G1-LOGMSG"],"CLEARTEXT","/--미 정의--/");	
$REQ["G1-CHANNEL"] = reqPostString("G1-CHANNEL",30);//PGMID	
$REQ["G1-CHANNEL"] = getFilter($REQ["G1-CHANNEL"],"CLEARTEXT","/--미 정의--/");	

//G2, 로그 - RW속성 오브젝트만 필터 적용 ( RO속성은 제외 )
$REQ["G2-LOGSEQ"] = reqPostNumber("G2-LOGSEQ",30);//SEQ	
$REQ["G2-LOGSEQ"] = getFilter($REQ["G2-LOGSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-URL"] = reqPostString("G2-URL",50);//URL	
$REQ["G2-URL"] = getFilter($REQ["G2-URL"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-SESSIONID"] = reqPostString("G2-SESSIONID",30);//SESSION	
$REQ["G2-SESSIONID"] = getFilter($REQ["G2-SESSIONID"],"SAFETEXT","/--미 정의--/");	
$REQ["G2-REQTOKEN"] = reqPostString("G2-REQTOKEN",100);//REQTOKEN	
$REQ["G2-REQTOKEN"] = getFilter($REQ["G2-REQTOKEN"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-RESTOKEN"] = reqPostString("G2-RESTOKEN",100);//RESTOKEN	
$REQ["G2-RESTOKEN"] = getFilter($REQ["G2-RESTOKEN"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-USERID"] = reqPostString("G2-USERID",50);//ID	
$REQ["G2-USERID"] = getFilter($REQ["G2-USERID"],"SAFETEXT","/--미 정의--/");	
$REQ["G2-USERSEQ"] = reqPostNumber("G2-USERSEQ",20);//USERSEQ	
$REQ["G2-USERSEQ"] = getFilter($REQ["G2-USERSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-LISTNM"] = reqPostString("G2-LISTNM",30);//LIST	
$REQ["G2-LISTNM"] = getFilter($REQ["G2-LISTNM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-LOGLEVEL"] = reqPostString("G2-LOGLEVEL",30);//LEVEL	
$REQ["G2-LOGLEVEL"] = getFilter($REQ["G2-LOGLEVEL"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-LOGDT"] = reqPostString("G2-LOGDT",30);//DT	
$REQ["G2-LOGDT"] = getFilter($REQ["G2-LOGDT"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-LOGMSG"] = reqPostString("G2-LOGMSG",300);//MSG	
$REQ["G2-LOGMSG"] = getFilter($REQ["G2-LOGMSG"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-CHANNEL"] = reqPostString("G2-CHANNEL",30);//PGMID	
$REQ["G2-CHANNEL"] = getFilter($REQ["G2-CHANNEL"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-ADDDT"] = reqPostString("G2-ADDDT",14);//ADDDT	
$REQ["G2-ADDDT"] = getFilter($REQ["G2-ADDDT"],"REGEXMAT","/^[0-9]+$/");	

//G3, 상세 - RW속성 오브젝트만 필터 적용 ( RO속성은 제외 )
$REQ["G3-DATEHM"] = reqPostString("G3-DATEHM",100);//DATEHM	
$REQ["G3-DATEHM"] = getFilter($REQ["G3-DATEHM"],"","//");	
$REQ["G3-LOGMSG"] = reqPostString("G3-LOGMSG",300);//MSG	
$REQ["G3-LOGMSG"] = getFilter($REQ["G3-LOGMSG"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-LOGWE"] = reqPostString("G3-LOGWE",1000);//LOGWE	
$REQ["G3-LOGWE"] = getFilter($REQ["G3-LOGWE"],"","//");	
$REQ["G2-XML"] = getXml2Array($_POST["G2-XML"]);//로그	
//,  입력값 필터 
	$REQ["G2-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G2-XML"]
		,"COLORD"=>"LOGSEQ,URL,SESSIONID,REQTOKEN,RESTOKEN,USERID,USERSEQ,LISTNM,LOGLEVEL,LOGDT,LOGMSG,CHANNEL,ADDDT"
		,"VALID"=>
			array(
			"LOGSEQ"=>array("NUMBER",30)	
			,"URL"=>array("STRING",50)	
			,"SESSIONID"=>array("STRING",30)	
			,"REQTOKEN"=>array("STRING",100)	
			,"RESTOKEN"=>array("STRING",100)	
			,"USERID"=>array("STRING",50)	
			,"USERSEQ"=>array("NUMBER",20)	
			,"LISTNM"=>array("STRING",30)	
			,"LOGLEVEL"=>array("STRING",30)	
			,"LOGDT"=>array("STRING",30)	
			,"LOGMSG"=>array("STRING",300)	
			,"CHANNEL"=>array("STRING",30)	
			,"ADDDT"=>array("STRING",14)	
					)
		,"FILTER"=>
			array(
			"LOGSEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"URL"=>array("CLEARTEXT","/--미 정의--/")
			,"SESSIONID"=>array("SAFETEXT","/--미 정의--/")
			,"REQTOKEN"=>array("CLEARTEXT","/--미 정의--/")
			,"RESTOKEN"=>array("CLEARTEXT","/--미 정의--/")
			,"USERID"=>array("SAFETEXT","/--미 정의--/")
			,"USERSEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"LISTNM"=>array("CLEARTEXT","/--미 정의--/")
			,"LOGLEVEL"=>array("CLEARTEXT","/--미 정의--/")
			,"LOGDT"=>array("CLEARTEXT","/--미 정의--/")
			,"LOGMSG"=>array("CLEARTEXT","/--미 정의--/")
			,"CHANNEL"=>array("CLEARTEXT","/--미 정의--/")
			,"ADDDT"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
array_push($_RTIME,array("[TIME 40.REQ_VALID]",microtime(true)));
	//서비스 클래스 생성
$objService = new monologService();
//컨트롤 명령별 분개처리
$log->info("ctl:" . $ctl);
switch ($ctl){
		case "G1_SEARCHALL" :
  		echo $objService->goG1Searchall(); //, 조회(전체)
  		break;
	case "G2_SEARCH" :
  		echo $objService->goG2Search(); //로그, 조회
  		break;
	case "G2_EXCEL" :
  		echo $objService->goG2Excel(); //로그, 엑셀다운로드
  		break;
	case "G3_SAVE" :
  		echo $objService->goG3Save(); //상세, 저장TEST
  		break;
	case "G3_SEARCH" :
  		echo $objService->goG3Search(); //상세, 조회
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

$log->info("MonologControl___________________________end");
$log->close(); unset($log);
?>
