<?php
header("Content-Type: text/html; charset=UTF-8");

//redis에 모두 넣기
//require_once "/data/www/lib/php/vendor/autoload.php";
$CFG = include_once("../common/include/incConfig.php");
//if(!require_once("/data/www/lib/php/predis/autoload.php"))die("require predis load fail.");

require_once "../common/include/incUtil.php";


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>CONFIG</title>

	<meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">

	<!--jquery / json-->
	<script src="/lib/jquery/jquery-1.12.4.min.js"></script>
	<script src="/lib/json2.min.js"></script>

    <!--공통-->
    <script src="/common/common.js?" type="text/javascript" charset="utf-8"></script>    
    <link href="/common/common.css?" rel="stylesheet" type="text/css" />


    <!--codemirror-->
    <link href="/lib/codemirror/lib/codemirror.css" rel="stylesheet" type="text/css" />
    <script src="/lib/codemirror/lib/codemirror.js"></script>
    <script src="/lib/codemirror/mode/javascript/javascript.js"></script>    
    <script src="/lib/codemirror/addon/edit/matchbrackets.js"></script>
    <script src="/lib/codemirror/addon/comment/continuecomment.js"></script>
    <script src="/lib/codemirror/addon/comment/comment.js"></script> 
    <script src="/lib/codemirror/addon/selection/active-line.js"></script>

<script>

    $( document ).ready(function() {
        var editor = CodeMirror.fromTextArea(document.getElementById("codeMirror"), {
            styleActiveLine: true,
            indentWithTabs: true,
            smartIndent: true,
            tabSize: 4,
            indentUnit: 4,
            indentWithTabs: true,
            lineNumbers: true,
            matchBrackets: true,
            autoCloseBrackets: true,
            mode: "application/ld+json",
            lineWrapping: true
        });

        editor.setSize("100%","500px");

        //비밀번호 입력창 초기화
        $("#CONFIG_PW").val("");
        alert("loaded");
    });

    

    function chkForm(){
        if(!confirm("정말로 변경하시겠습니까?"))return false;
        //alert($("#codeMirror").val());

        return true;
    }
</script>

</head>
<body class="HTML_BODY">

<?php

//echo "aaa";    
if($_POST["CONFIG_NM"] == ""){
?>
    <form method="post">
    CONFIG_NM : <input type="text" name="CONFIG_NM" value="<?=$_POST["CONFIG_NM"]?>"><BR>
    CONFIG_PW : <input type="password" name="CONFIG_PW" value=""><BR>
    <input type="submit" value="조회">

    </form>
<?php
}else if($_POST["CONFIG_NM"] != "" && $_POST["codeMirror"] != ""){
    $redisClient = new Predis\Client(
        array(
            'scheme' => 'tcp',
            'host'   => $CFG["REDIS_HOST"],
            'port'   => $CFG["REDIS_PORT"],
            'timeout' => 1
        )
    );    
    $pwStr = $redisClient->get("CONFIG_PW");

    //echo "000";    
    if(trim($_POST["CONFIG_PW"]) == trim($pwStr)){
        //echo "111";
        //신규 패스워드가 2개다 일치 하면 패스워드 바꾸기
        if(strlen($_POST["CONFIG_PW_NEW"]) > 0){
            if($_POST["CONFIG_PW_NEW"] == $_POST["CONFIG_PW_NEW_CONFIRM"]){
                $redisClient->set("CONFIG_PW",$_POST["CONFIG_PW_NEW"]);
            }else{
                $redisClient->quit();
                MsgBack("신규 비밀번호가 일치하지 않습니다.");
            }
        }else{
            alog("신규 비번 입력 없음.");
        }
        //echo "222";        
        //exit;

        //json
        $tmpArray = json_decode($_POST["codeMirror"],true);

        if(json_last_error() != JSON_ERROR_NONE){
            $redisClient->quit();
            MsgBack("JSON 문법 에러 발생 : " . json_last_error_msg());
        }

        //기존거 오늘날짜로 백업
        $redisClient->set($_POST["CONFIG_NM"] . "." . date("Ymd", time())
            ,$redisClient->get($_POST["CONFIG_NM"]));


        //신규로 세팅
        $redisClient->set($_POST["CONFIG_NM"],json_encode($tmpArray));


        $redisClient->quit();
        MsgBack("정상 저장되었습니다.");

    }else{
        $redisClient->quit();
        MsgBack("기존 비밀번호가 일치하지 않습니다.");
    }
    $redisClient->quit();

}else{
    $redisClient = new Predis\Client(
        array(
            'scheme' => 'tcp',
            'host'   => $CFG["REDIS_HOST"],
            'port'   => $CFG["REDIS_PORT"],
            'timeout' => 1
        )
    );    


    $pwStr = $redisClient->get("CONFIG_PW");

    //echo "000";    
    if(trim($_POST["CONFIG_PW"]) != trim($pwStr)){
        $redisClient->quit();
        MsgBack("기존 비밀번호가 일치하지 않습니다.");
    }

    $jsonStr = $redisClient->get($_POST["CONFIG_NM"]);   
    $redisClient->quit();




    if(strlen($jsonStr) < 10){
        $jsonStr = json_encode(array(
            "FRIST_LOAD_DT" => date("Y.m.d H:i:s")
            ,"CFG_LIBS_PATH_REDIS" => "/data/www/lib/php/vendor/predis/predis/autoload.php" // predis/predis 
            ,"CFG_LIBS_PATH_AWS" => "/data/www/lib/php/aws/aws-autoloader.php"
            ,"CFG_LIBS_SQL_PARSER" => "/data/www/lib/php/PHP-SQL-Parser/src/PHPSQLParser.php"
            ,"CFG_LIBS_HTML_PURIFIER" => "/data/www/lib/php/HTMLPurifier-4.12.0/library/HTMLPurifier.auto.php" //xss 필터
            ,"CFG_LIBS_MONO_LOG" => "/data/www/lib/php/monolog/autoload.php"
            ,"CFG_LIBS_SQL_PARSER" => "/data/www/lib/php/PHP-SQL-Parser/src/PHPSQLParser.php"
        
            ,"CFG_AWS_AID" => ""
            ,"CFG_AWS_KEY" => ""
        
            //운영/개발 모드
            ,"CFG_MODE" => "DEV" //DEV, REAL, LOCAL
        
            //개인정보(PI) 컬럼에 해당하는 DD
            ,"CFG_PI_COLIDS" => array("USR_ID", "USR_NM")
        
            //로그인에 사용될 세션 프리픽스 ( FO, BO, FO 컨테이너 분리 관점 )
            ,"CFG_SID_PREFIX" => "CG"
        
            //R.D용 프로젝트명
            ,"CFG_PROJECT_NAME" => "리얼 만남"
        
            //권한변경 및 개인정보 이력 저장 방식
            ,"CFG_AUTH_LOG" => "REDIS"//DB, REDIS
            ,"CFG_AUTH_REDIS" => "tcp://172.17.0.1:1234" //REDIS인 경우 REDIS 경로
        
            ,"CFG_SEC_KEY" => ""
            ,"CFG_SEC_IV" => ""
        
            ,"CFG_SEC_SALT" => "codegen"
        
            //디버그 유무
            ,"CFG_DEBUG_YN" => "Y"
        
            //업로드 가능 이미지 확장자
            ,"CFG_IMG_EXT" => array( "JPG", "JPEG", "PNG", "GIF", "BMP" )
        
            
            ,"CFG_UPLOAD_URL" => "/data/www/up/"
        
            ,"mysql_host" => "172.17.0.1"
            ,"mysql_userid" => ""
            ,"mysql_passwd" => ""
            ,"mysql_db" => ""
        
        
            ,"mysql_m_host" => "172.17.0.1"
            ,"mysql_m_userid" => ""
            ,"mysql_m_passwd" => ""
            ,"mysql_m_db" => ""
            ,"mysql_m_port" => ""
        
        
            ,"mysql_s_host" => "172.17.0.1"
            ,"mysql_s_userid" => ""
            ,"mysql_s_passwd" => ""
            ,"mysql_s_db" => ""
        
        
            //서버 PATH  정보들
            ,"CFG_ROOT_DIR" => "/data/www/c.g/"
        
            //배포 관련 정보
            ,"CFG_DEPLOY_DIR" => "/data/www/r.d/"
            ,"CFG_DEPLOY_KEY" => "MyLoveKim"
        
            //저장 경로 정보들	
            ,"CFG_LOG_PATH" => "/data/www/c.g/log/cg_" . date("Ymd"). ".log"//코드 그룹
            ,"CFG_LOG_PATH2" => "/data/www/c.g/log/cg2_" . date("Ymd"). ".log" //make 로그
            ,"CFG_UPLOAD_DIR" => "/data/www/c.g/up/" 	  //업로드 폴더
        ));
    }

?>
    <form method="post" onsubmit="return chkForm(this);">
    CONFIG_NM : <?=$_POST["CONFIG_NM"]?> <input type="hidden" name="CONFIG_NM" value="<?=$_POST["CONFIG_NM"]?>"><BR>
    CONFIG_PW : OLD<input type="password" id="CONFIG_PW" name="CONFIG_PW" value="">,
    NEW <input type="password" name="CONFIG_PW_NEW" value="">,
    NEW CONFIRM<input type="password" name="CONFIG_PW_NEW_CONFIRM" value="">
                <BR>
    CONFIG_JSON : 
<textarea id="codeMirror" name="codeMirror" style="width:100%;height:500px;font-size:9pt;">
<?=json_encode(json_decode($jsonStr),JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)?>
</textarea>
<font color="blue">초기화를 원하시면 반드시 <b>{}</b>를 입력하세요.</font>
    <br>
    <input type="submit" value="SAVE">

    </form>

    </body>

    
        
    <html>
<?php

}
?>