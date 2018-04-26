<?
//세션 사용
session_start(); 

//요청할때 마다 신규id
$xhandler_unique_id = sprintf("%08x", abs(crc32($_SERVER['REMOTE_ADDR'] . $_SERVER['REQUEST_TIME'] . $_SERVER['REMOTE_PORT'])));



	//에러 사용자 처리
	set_error_handler("xhandler",E_ERROR); //incUtil


    //디자인 테마
    $CFG_HEADER_THEME = "b";
    $CFG_HEADER_THEME_M = "b";
    $CFG_HEADER_THEME_A = "c";


	//관리자 메일 주소 
	$CFG_SYS_EMAIL = "zero12a@gmail.com";
	$CFG_OPER_EMAIL = "19991237@hanmail.net";


	//단축 루트 폴더
    $CFG_DOMAIN = $_SERVER["HTTP_HOST"];
    //$CFG_DOMAIN = "www.su.sg";
	$CFG_ROOT_FOLDER =  "http://" . $CFG_DOMAIN . "/ShortUrl/" ;
    $CFG_ROOTS_FOLDER =  "http://". $CFG_DOMAIN ."/ShortUrl/" ;

//질의응답 이메일 수신 여부 URL
	$CFG_QA_ANS_READ_URL = $CFG_ROOT_FOLDER . "su_qa_ans_read_ok.php";
	
	//단축 URL 서비스 포탈 
	$CFG_PORTAL_URL =  $CFG_ROOT_FOLDER . "su_main.php" ;	
	
	
	
	//암호화 관련 키
	$CFG_SEC_KEY = "shorturl";
	
	//디버그 유무
	$CFG_DEBUG_YN = "Y";

	//업로드 가능 이미지 확장자
	$CFG_IMG_EXT = array( "JPG", "JPEG", "PNG", "GIF", "BMP" );

	//목록 불러오기 기본라인수
	$CFG_LIST_SIZE = 10;

	//목록 불러오기 기본라인수
	$CFG_PHOTO_CNT = 4;

    //헤더 타이틀
    $CFG_HEADER_TITLE_DEFAULT = "<font color='#9acd32'>S</font>hort <font color='#9acd32'>U</font>rl.<font color='#9acd32'>sg</font> for user long url";



	
	//마스터 서버 정보
	$CFG_URL_API = $CFG_ROOT_FOLDER . "su_m_make_api.php";
	


	//이미지 경로
	$CFG_UPLOAD_URL =  "/up/" ;
	

	

        //무료 기업용 도메인SEQ
        $CFG_DEMO_DOMAIN_URL = "demo.su.sg";
        $CFG_DEMO_MEM_SEQ = 34;
        $CFG_DEMO_DOMAIN_SEQ = 38;

        //무료 개인용 도메인SEQ
        $CFG_FREE_DOMAIN_URL = "su.sg";
        $CFG_FREE_MEM_SEQ = 35;
        $CFG_FREE_DOMAIN_SEQ = 37;

		$mysql_host = "localhost";
		$mysql_userid = "cg";
		$mysql_passwd = "cg1234qwer";
		$mysql_db = "CG";


        //DB2 (계정 정보)
        $mysql_m_host = "localhost";
        $mysql_m_userid = "cg";
        $mysql_m_passwd = "cg1234qwer";
        $mysql_m_db = "CG";


        //서버 PATH  정보들
		$CFG_ROOT_DIR = "/var/www/html/c.g/";


	
	
	
//저장 경로 정보들	
$CFG_LOG_PATH = $CFG_ROOT_DIR  . "log/cg.log"; //코드 그룹
$CFG_LOG_PATH2 = $CFG_ROOT_DIR  . "log/cg2.log"; //make 로그

$CFG_JSON_CODE_GROUP_FILE = $CFG_ROOT_DIR  . "up/json/code.group.%s.json"; //코드 그룹
$CFG_JSON_MEDIA_FILE = $CFG_ROOT_DIR  . "up/json/code.media.json"; //디바이스, 브라우저 정보
$CFG_JSON_BOARD_FILE = $CFG_ROOT_DIR  . "up/json/board.%s.json"; //게시물 정보 캐쉬
$CFG_JSON_DOMAIN_INFO_FILE = $CFG_ROOT_DIR  . "up/json/cache/domain.info.%s.json"; //도메인 만료일 정보
$CFG_JSON_HIT_OVER_FILE = $CFG_ROOT_DIR  . "up/json/cache/domain.hit.over.%d.%d.json"; //히트 초과 정보domainseq, yymmdd
$CFG_UPLOAD_DIR =  $CFG_ROOT_DIR .  "up/" ;	  //업로드 폴더


//설정 정보
$CFG_CONFIG_SERVER_FILE = $CFG_ROOT_DIR . "include/server/server.%s.php"; //서버 정보
/*


//기기 아이디 
create table AM_USER (
	USER_SEQ bigint(8) NOT NULL auto_increment
	,DEVICE_ID	varchar(100)	Not null
	,USER_ID	varchar(30)	Not null 	 	 	 
	,INSERT_DT	varchar(8)	Not null 	 	 	 
	,INSERT_TM	varchar(6)	Not null 
	,PRIMARY KEY (USER_SEQ)
)

create unique index IDX_AM_USER_Deviceid on AM_USER(DEVICE_ID);
create unique index IDX_AM_USER_Userid on AM_USER(USER_ID);
ALTER TABLE AM_USER AUTO_INCREMENT = 10000000;

//접속 로그
create table AM_USER_LOG (
	LOG_SEQ  bigint(8) NOT NULL auto_increment
	,USER_SEQ	bigint(8) Not null
	,INSERT_DT	varchar(8)	Not null 	 	 	 
	,INSERT_TM	varchar(6)	Not null 
	,PRIMARY KEY (LOG_SEQ)
)
*/
?>