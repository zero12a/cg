<?php

//세션 사용
session_start(); 

$CFG_LIBS_PATH_REDIS = "Predis/Autoloader.php";

//운영/개발 모드
$CFG_MODE = "DEV"; //DEV, REAL, LOCAL

//개인정보(PI) 컬럼에 해당하는 DD
$CFG_PI_COLIDS = array("USR_ID", "USR_NM");

//로그인에 사용될 세션 프리픽스 ( FO, BO, FO 컨테이너 분리 관점 )
$CFG_SID_PREFIX = "CG";

//R.D용 프로젝트명
$CFG_PROJECT_NAME = "리얼 만남";

//권한변경 및 개인정보 이력 저장 방식
$CFG_AUTH_LOG = "REDIS"; //DB, REDIS
$CFG_AUTH_REDIS = "tcp://172.17.0.1:1234"; //REDIS인 경우 REDIS 경로


//  CBC : 다음의 키사이즈 중에 하나를 사용해야함 16, 24 or 32 byte keys for AES-128, 192, 256 


$CFG_SEC_KEY = "";
$CFG_SEC_IV = "";

$CFG_SEC_SALT = "codegen";

//디버그 유무
$CFG_DEBUG_YN = "Y";



//업로드 가능 이미지 확장자
$CFG_IMG_EXT = array( "JPG", "JPEG", "PNG", "GIF", "BMP" );

//이미지 경로
$CFG_UPLOAD_URL =  "/data/www/up/" ;


	//개발 환경
	$mysql_host = "172.17.0.1";
	$mysql_userid = "";
	$mysql_passwd = "";
	$mysql_db = "";


	//DB2 (계정 정보)
	$mysql_m_host = $mysql_host;
	$mysql_m_userid = "";
	$mysql_m_passwd = "";
	$mysql_m_db = "";
	$mysql_m_port = "3306";

	//DB2 (계정 정보)
	$mysql_s_host = $mysql_host;
	$mysql_s_userid = "";
	$mysql_s_passwd = "";
	$mysql_s_db = "DATING";
	

	//서버 PATH  정보들
	$CFG_ROOT_DIR = "/data/www/c.g/";

	//배포 관련 정보
	$CFG_DEPLOY_DIR = "/data/www/r.d/";
	$CFG_DEPLOY_KEY = "";
	
		
		
	//저장 경로 정보들	
	$CFG_LOG_PATH = $CFG_ROOT_DIR  . "log/cg_" . date("Ymd"). ".log"; //코드 그룹
	$CFG_LOG_PATH2 = $CFG_ROOT_DIR  . "log/cg2_" . date("Ymd"). ".log"; //make 로그

	$CFG_JSON_CODE_GROUP_FILE = $CFG_ROOT_DIR  . "up/json/code.group.%s.json"; //코드 그룹
	$CFG_JSON_MEDIA_FILE = $CFG_ROOT_DIR  . "up/json/code.media.json"; //디바이스, 브라우저 정보
	$CFG_JSON_BOARD_FILE = $CFG_ROOT_DIR  . "up/json/board.%s.json"; //게시물 정보 캐쉬
	$CFG_JSON_DOMAIN_INFO_FILE = $CFG_ROOT_DIR  . "up/json/cache/domain.info.%s.json"; //도메인 만료일 정보
	$CFG_JSON_HIT_OVER_FILE = $CFG_ROOT_DIR  . "up/json/cache/domain.hit.over.%d.%d.json"; //히트 초과 정보domainseq, yymmdd
	$CFG_UPLOAD_DIR =  $CFG_ROOT_DIR .  "up/" ;	  //업로드 폴더


	//설정 정보
    $CFG_CONFIG_SERVER_FILE = $CFG_ROOT_DIR . "include/server/server.%s.php"; //서버 정보
    
?>