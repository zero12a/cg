<?php
header("Content-Type: text/html; charset=UTF-8");
///echo "111";
//redis에 모두 넣기
//require_once "/data/www/lib/php/vendor/autoload.php";
$CFG = require_once("../common/include/incConfig.php");
//if(!require_once("/data/www/lib/php/predis/autoload.php"))die("require predis load fail.");

//echo "222";

require_once "../common/include/incUtil.php";

//var_dump($CFG);
if(trim($CFG["REDIS_HOST"]) == "")die("Config에 REDIS_HOST 값이 없습니다.");
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>CONFIG</title>

	<meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">

	<!--jquery / json-->
	<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/jquery/jquery-1.12.4.min.js"></script>
	<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/json2.min.js"></script>

    <!--공통-->
    <script>
    var CFG_URL_LIBS_ROOT = "<?=$CFG["CFG_URL_LIBS_ROOT"]?>";  // 형식 http://url:port/
    </script>
    <script src="/common/common.js?" type="text/javascript" charset="utf-8"></script>    
    <link href="/common/common.css?" rel="stylesheet" type="text/css" />


    <!--codemirror-->
    <link href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/codemirror/lib/codemirror.css" rel="stylesheet" type="text/css" />
    <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/codemirror/lib/codemirror.js"></script>
    <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/codemirror/mode/javascript/javascript.js"></script>    
    <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/codemirror/addon/edit/matchbrackets.js"></script>
    <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/codemirror/addon/comment/continuecomment.js"></script>
    <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/codemirror/addon/comment/comment.js"></script> 
    <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/codemirror/addon/selection/active-line.js"></script>

<script>

    $( document ).ready(function() {
        if(document.getElementById("codeMirror")){
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
        }


        //비밀번호 입력창 초기화
        $("#CONFIG_PW").val("");
        alert("loaded");
    });

    function clearLocalCache(){
        $("#fnc").val("CONFIG_LOCAL_CACHE_CLEAR");
        $("#tform").submit();
    }
    

    function chkForm(){
        if(!confirm("정말로 변경하시겠습니까?"))return false;
        //alert($("#codeMirror").val());

        return true;
    }
</script>

</head>
<body class="HTML_BODY">
    <div class="GRID_LABEL" style="vertical-align:text-bottom;">* CONFIGMNG
        <!--popup--><a href="?" target="_blank"><img src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>img/popup.png" height=10 align=absmiddle border=0></a>
        <!--reload--><a href="javascript:location.reload();"><img src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>img/reload.png" width=11 height=10 align=absmiddle border=0></a>
    </div>
    <BR><BR>
<?php

//echo "aaa";    
if($_POST["CONFIG_NM"] == ""){
    if($_POST["CONFIG_NM"] ==""){
        $defaultConfig = "CONFIG_CG";
        $defaultDatasource = "DATASOURCE_CG";
    }
?>
    <form name="tform" id="tform" method="post">
    <input type="hidden" name="fnc" id="fnc" value="CONFIG_SEARCH">
    CONFIG_NM : <input type="text" name="CONFIG_NM" value="<?=$_POST["CONFIG_NM"]?>"><BR>
    CONFIG_PW : <input type="password" name="CONFIG_PW" value=""><BR>
    <input type="submit" value="조회"><input type="button" value="로컬캐쉬 삭제" onclick="clearLocalCache()">
    </form>
    <BR>apcu :<BR>
    <textarea style="font-size:9pt;width:100%;height:500px">
    <?=json_encode(json_decode(apcu_fetch($defaultConfig)),JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)?>
    </textarea>
<?php
}else if($_POST["fnc"] == "CONFIG_LOCAL_CACHE_CLEAR"){
?>
    <form name="tform" id="tform" method="post">
    <input type="hidden" name="fnc" id="fnc" value="CONFIG_SEARCH">
    CONFIG_NM : <input type="text" name="CONFIG_NM" value="<?=$_POST["CONFIG_NM"]?>"><BR>
    CONFIG_PW : <input type="password" name="CONFIG_PW" value=""><BR>
    <input type="submit" value="조회"><input type="button" value="로컬캐쉬 삭제" onclick="clearLocalCache()">

    </form>
<?php

    apcu_delete($_POST["CONFIG_NM"]);
    echo $_POST["CONFIG_NM"] . " 로컬캐쉬가 삭제되었습니다.";
}else if($_POST["fnc"] == "CONFIG_UPDATE" && $_POST["CONFIG_NM"] != "" && $_POST["codeMirror"] != ""){
    //echo "aaa";

    //var_dump($CFG);

    if($CFG["REDIS_PASSWD"] != ""){
        $redisClient = new Predis\Client(
            array(
                'scheme' => 'tcp',
                'host'   => $CFG["REDIS_HOST"],
                'port'   => $CFG["REDIS_PORT"],
                'password' => $CFG["REDIS_PASSWD"],
                'timeout' => 3
            )
        );

    }else{
        $redisClient = new Predis\Client(
            array(
                'scheme' => 'tcp',
                'host'   => $CFG["REDIS_HOST"],
                'port'   => $CFG["REDIS_PORT"],
                'timeout' => 3
            )
        );

    }




    //echo "aaa";

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


        //가입 채널에 변경 통보하기
        $redisClient->publish("config." . $_POST["CONFIG_NM"],$_POST["CONFIG_NM"] . " change redis config data.");


        $redisClient->quit();
        MsgBack("정상 저장되었습니다.");

    }else{
        $redisClient->quit();
        MsgBack("기존 비밀번호가 일치하지 않습니다.");
    }
    $redisClient->quit();

}else if ($_POST["fnc"] == "CONFIG_SEARCH"){
    //echo "bbb";

    //var_dump($CFG);
    //echo "<Br>REDIS_HOST= " . $CFG["REDIS_HOST"];
    //echo "<Br>REDIS_PORT= " . $CFG["REDIS_PORT"];
    //echo "<Br>REDIS_PASSWD= " . $CFG["REDIS_PASSWD"];
    if($CFG["REDIS_PASSWD"] != ""){

        $redisClient = new Predis\Client(
            array(
                'scheme' => 'tcp',
                'host'   => $CFG["REDIS_HOST"],
                'port'   => $CFG["REDIS_PORT"],
                'password'   => $CFG["REDIS_PASSWD"],
                'timeout' => 1
            )
        );
    }else{
        $redisClient = new Predis\Client(
            array(
                'scheme' => 'tcp',
                'host'   => $CFG["REDIS_HOST"],
                'port'   => $CFG["REDIS_PORT"],
                'timeout' => 1
            )
        );
    }
            
    //echo "000";
    //var_dump($redisClient->info()["server"]["redis_version"]);
    //$redisClient->info();


    //echo "111";
    $pwStr = $redisClient->get("CONFIG_PW");
    //echo "222";
    //echo "000";    
    if(trim($_POST["CONFIG_PW"]) != trim($pwStr)){
        $redisClient->quit();
        MsgBack("기존 비밀번호가 일치하지 않습니다.");
    }
   //echo "333";
    //echo "############". $_POST["CONFIG_NM"];
    $jsonStr = $redisClient->get($_POST["CONFIG_NM"]);   
    $redisClient->quit();


    //echo "444";
    //echo "333";

    if(strlen($jsonStr) < 50){
        $jsonStr = json_encode(array(
            "FRIST_LOAD_DT" => date("Y.m.d H:i:s")
            ,"CFG_LIBS_PATH_REDIS" => "/data/www/lib/php/vendor/predis/predis/autoload.php" // predis/predis 
            ,"CFG_LIBS_PATH_AWS" => "/data/www/lib/php/aws/aws-autoloader.php"
            ,"CFG_LIBS_SQL_PARSER" => "/data/www/lib/php/PHP-SQL-Parser/src/PHPSQLParser.php"
            ,"CFG_LIBS_HTML_PURIFIER" => "/data/www/lib/php/HTMLPurifier-4.12.0/library/HTMLPurifier.auto.php" //xss 필터
            ,"CFG_LIBS_MONO_LOG" => "/data/www/lib/php/monolog/autoload.php"
            ,"CFG_LIBS_SQL_PARSER" => "/data/www/lib/php/PHP-SQL-Parser/src/PHPSQLParser.php"
            ,"CFG_LIBS_EXCEL" => "/data/www/lib/php/vendor/autoload.php"
            ,"CFG_LIBS_VENDOR" => "/data/www/lib/php/vendor/autoload.php"
            

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
            ,"CFG_OAUTH_HOST" => "172.17.0.1"
            ,"CFG_OAUTH_PORT" => "18052"
            ,"CFG_MAKE_URL" => "http://localhost:8060"
            ,"CFG_DEMO_URL" => "http://localhost:8040"
            ,"CFG_CGWEB_URL" => "http://localhost:8090"


            ,"CFG_DB" => array(
                "CG" => array("DRIVER"=>"MYSQLI", "HOST"=>"172.17.0.1", "PORT"=>"3306", "DBNM"=>"CG", "ID"=>"cg", "PW"=>"cg1234qwer"),
                "DATING" => array("DRIVER"=>"PDO_MYSQL", "HOST"=>"", "PORT"=>"", "DBNM"=>"", "ID"=>"", "PW"=>"")
                )
            ,"CFG_SEC_KEY" => ""
            ,"CFG_SEC_IV" => ""
        
            ,"CFG_SEC_SALT" => "codegen"
        
            //디버그 유무
            ,"CFG_DEBUG_YN" => "Y"
        
            //업로드 가능 이미지 확장자
            ,"CFG_IMG_EXT" => array( "JPG", "JPEG", "PNG", "GIF", "BMP" )
        
            //서버 PATH  정보들
            ,"CFG_COMMON_DIR" => "/data/www/common/"
            ,"CFG_ROOT_DIR" => "/data/www/c.g/"
            ,"CFG_LC_DIR" => "/data/www/l.c/"
        
            //배포 관련 정보
            ,"CFG_DEPLOY_DIR" => "/data/www/r.d/"
            ,"CFG_DEPLOY_KEY" => ""
            ,"CFG_DEPLOY_MAKE_ROOT"  =>   "/data/www/d.s/"
            ,"CFG_DEPLOY_GITHUB_USR_NM"  =>   ""
            ,"CFG_DEPLOY_GITHUB_USR_EML"  =>   ""
            ,"CFG_DEPLOY_GITHUB_USR_ID"  =>   ""
            ,"CFG_DEPLOY_GITHUB_USR_TOKEN"  =>   ""     
            ,"CFG_DEPLOY_GITHUB_URL"  =>   ""     

            //저장 경로 정보들	
            ,"CFG_LOG_PATH" => "/data/www/log/"//코드 그룹
            ,"CFG_LOG_PATH2" => "/data/www/log/" //make 로그
            ,"CFG_UPLOAD_DIR" => "/data/www/up/" 	  //업로드 폴더
            ,"CFG_UPLOAD_ALLOW_EXT" => array("jpg", "gif", "png","peng","bmp","svg","xls","xlsx","doc","docx","ppt","pptx","pdf","hwp","txt")

            //경로들
            ,"CFG_URL_LIBS_ROOT" => "http://localhost:8070/" //라이브러리들
            ,"CFG_URL_CODE_API" => "/d.s/CG/codeapiView.php"
            ,"CFG_RD_URL_MNU_ROOT" => "/d.s/CG/" //RD서비스 루트 경로
        ));
    }

?>
    <form method="post" onsubmit="return chkForm(this);">
    <input type="hidden" name="fnc" id="fnc" value="CONFIG_UPDATE">
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