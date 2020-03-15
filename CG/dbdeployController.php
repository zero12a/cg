<?php
header("Content-Type: text/html; charset=UTF-8"); //SVRCTL
header("Cache-Control:no-cache");
header("Pragma:no-cache");
$_RTIME = array();
array_push($_RTIME,array("[TIME 00.START]",microtime(true)));
$CFG = require_once('../../common/include/incConfig.php');//CG CONFIG
require_once($CFG["CFG_LIBS_VENDOR"]);
require_once('dbdeployService.php');

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
	, "PGM_ID"=>"DBDEPLOY"
	, "REQTOKEN" => $reqToken
	, "RESTOKEN" => $resToken
	, "LOG_LEVEL" => Monolog\Logger::ERROR
	)
);
$log->info("DbdeployControl___________________________start");
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
}else if($objAuth->isAuth("DBDEPLOY",$ctl)){
	$objAuth->LAUTH_SEQ = $objAuth->logUsrAuth($reqToken,$resToken,"DBDEPLOY",$ctl,"Y");
}else{
	$objAuth->logUsrAuth($reqToken,$resToken,"DBDEPLOY",$ctl,"N");
	JsonMsg("500","120",$ctl . " 권한이 없습니다.");
}
		//사용자 정보 가져오기
	$REQ["CFG.CFG_CGWEB_URL"] = $CFG["CFG_CGWEB_URL"];
//로그 저장 방식 결정
//일반로그, 권한변경로그, PI로그
//NORMAL, POWER, PI
$PGM_CFG["SECTYPE"] = "NORMAL";
$PGM_CFG["SQLTXT"] = array();
array_push($_RTIME,array("[TIME 30.AUTH_CHECK]",microtime(true)));
$REQ["G3-CTLCUD"] = reqPostString("G3-CTLCUD",2);

//FILE먼저 : G1, 
//FILE먼저 : G2, 테이블목록
//FILE먼저 : G3, 테이블상세

//G1,  - RW속성 오브젝트만 필터 적용 ( RO속성은 제외 )
$REQ["G1-DB"] = reqPostString("G1-DB",30);//DB	
$REQ["G1-DB"] = getFilter($REQ["G1-DB"],"CLEARTEXT","/--미 정의--/");	
$REQ["G1-TARGET_DB"] = reqPostString("G1-TARGET_DB",100);//TARET_DB	
$REQ["G1-TARGET_DB"] = getFilter($REQ["G1-TARGET_DB"],"CLEARTEXT","/--미 정의--/");	

//G2, 테이블목록 - RW속성 오브젝트만 필터 적용 ( RO속성은 제외 )
$REQ["G2-TABLE_SCHEMA"] = reqPostString("G2-TABLE_SCHEMA",100);//DB	
$REQ["G2-TABLE_SCHEMA"] = getFilter($REQ["G2-TABLE_SCHEMA"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-TABLE_NAME"] = reqPostString("G2-TABLE_NAME",100);//TABLE	
$REQ["G2-TABLE_NAME"] = getFilter($REQ["G2-TABLE_NAME"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-RESULT"] = reqPostString("G2-RESULT",100);//RESULT	
$REQ["G2-RESULT"] = getFilter($REQ["G2-RESULT"],"","//");	
$REQ["G2-ENGINE"] = reqPostString("G2-ENGINE",100);//ENGINE	
$REQ["G2-ENGINE"] = getFilter($REQ["G2-ENGINE"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-TABLE_ROWS"] = reqPostString("G2-TABLE_ROWS",100);//ROWS	
$REQ["G2-TABLE_ROWS"] = getFilter($REQ["G2-TABLE_ROWS"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-AUTO_INCREMENT"] = reqPostString("G2-AUTO_INCREMENT",100);//AI	
$REQ["G2-AUTO_INCREMENT"] = getFilter($REQ["G2-AUTO_INCREMENT"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-CREATE_TIME"] = reqPostNumber("G2-CREATE_TIME",100);//CREATE	
$REQ["G2-CREATE_TIME"] = getFilter($REQ["G2-CREATE_TIME"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-UPDATE_TIME"] = reqPostString("G2-UPDATE_TIME",100);//UPDATE	
$REQ["G2-UPDATE_TIME"] = getFilter($REQ["G2-UPDATE_TIME"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-TABLE_COLLATION"] = reqPostString("G2-TABLE_COLLATION",100);//COLLATION	
$REQ["G2-TABLE_COLLATION"] = getFilter($REQ["G2-TABLE_COLLATION"],"CLEARTEXT","/--미 정의--/");	
$REQ["G2-TABLE_COMMENT"] = reqPostString("G2-TABLE_COMMENT",100);//COMMENT	
$REQ["G2-TABLE_COMMENT"] = getFilter($REQ["G2-TABLE_COMMENT"],"CLEARTEXT","/--미 정의--/");	

//G3, 테이블상세 - RW속성 오브젝트만 필터 적용 ( RO속성은 제외 )
$REQ["G2-XML"] = getXml2Array($_POST["G2-XML"]);//테이블목록	
//,  입력값 필터 
	$REQ["G2-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G2-XML"]
		,"COLORD"=>"CHK,TABLE_SCHEMA,TABLE_NAME,SQLCREATE,RESULT,ENGINE,TABLE_ROWS,AUTO_INCREMENT,CREATE_TIME,UPDATE_TIME,TABLE_COLLATION,TABLE_COMMENT"
		,"VALID"=>
			array(
			"CHK"=>array("NUMBER",100)	
			,"TABLE_SCHEMA"=>array("STRING",100)	
			,"TABLE_NAME"=>array("STRING",100)	
			,"SQLCREATE"=>array("STRING",100)	
			,"RESULT"=>array("STRING",100)	
			,"ENGINE"=>array("STRING",100)	
			,"TABLE_ROWS"=>array("STRING",100)	
			,"AUTO_INCREMENT"=>array("STRING",100)	
			,"CREATE_TIME"=>array("NUMBER",100)	
			,"UPDATE_TIME"=>array("STRING",100)	
			,"TABLE_COLLATION"=>array("STRING",100)	
			,"TABLE_COMMENT"=>array("STRING",100)	
					)
		,"FILTER"=>
			array(
			"CHK"=>array("REGEXMAT","/^([0-9a-zA-Z]|,)+$/")
			,"TABLE_SCHEMA"=>array("CLEARTEXT","/--미 정의--/")
			,"TABLE_NAME"=>array("CLEARTEXT","/--미 정의--/")
			,"SQLCREATE"=>array("CLEARTEXT","/--미 정의--/")
			,"ENGINE"=>array("CLEARTEXT","/--미 정의--/")
			,"TABLE_ROWS"=>array("CLEARTEXT","/--미 정의--/")
			,"AUTO_INCREMENT"=>array("CLEARTEXT","/--미 정의--/")
			,"CREATE_TIME"=>array("CLEARTEXT","/--미 정의--/")
			,"UPDATE_TIME"=>array("CLEARTEXT","/--미 정의--/")
			,"TABLE_COLLATION"=>array("CLEARTEXT","/--미 정의--/")
			,"TABLE_COMMENT"=>array("CLEARTEXT","/--미 정의--/")
					)
	)
);
$REQ["G2-CHK"] = $_POST["G2-CHK"];//CHK 받기
//filterGridChk($tStr,$tDataType,$tDataSize,$tValidType,$tValidRule)
$REQ["G2-CHK"] = filterGridChk($REQ["G2-CHK"],"STRING",100,"CLEARTEXT","/--미 정의--/");//TABLE_NAME 입력값검증
	array_push($_RTIME,array("[TIME 40.REQ_VALID]",microtime(true)));
	//서비스 클래스 생성
$objService = new dbdeployService();
//컨트롤 명령별 분개처리
$log->info("ctl:" . $ctl);
switch ($ctl){
		case "G1_SEARCHALL" :
  		echo $objService->goG1Searchall(); //, 조회(전체)
  		break;
	case "G2_SEARCH" :
  		echo $objService->goG2Search(); //테이블목록, 조회
  		break;
	case "G2_EXCEL" :
  		echo $objService->goG2Excel(); //테이블목록, 엑셀다운로드
  		break;
	case "G3_SEARCH" :
  		echo $objService->goG3Search(); //테이블상세, 조회
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

$log->info("DbdeployControl___________________________end");
$log->close(); unset($log);
?>
