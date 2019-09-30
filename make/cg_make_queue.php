<?php
/**
 * Created by PhpStorm.
 * User: zero12a
 * Date: 2014. 6. 29.
 * Time: 오후 9:32
 */

header("Content-Type: text/html; charset=UTF-8");

//설정 함수 읽기
if(!include_once '../incConfig.php')	        echo "include fail(1)";
if(!include_once '../include/incDB.php')			echo "include fail(2)";
if(!include_once '../include/incUtil.php')		echo "include fail(3)";
if(!include_once '../include/incSec.php')		echo "include fail(4)";
if(!include_once '../include/incUser.php')		echo "include fail(5)";


if(!include_once './cg_make_db.php')		echo "include fail(6)";
if(!include_once './cg_make_file.php')		echo "include fail(7)";
if(!include_once './cg_make_body.php')		echo "include fail(8)";
if(!include_once './cg_make_js.php')		echo "include fail(9)";
if(!include_once './cg_make_func.php')		echo "include fail(10)";

require_once("../include/incLoginCheck.php");//로그인 검사



//SeverView();

function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

$time_start = microtime_float();



//db캐쉬
$dbCache = array();

//db 오픈
//$db = db_open();
$svrid = "CG";
$db[$svrid] = db_m_open();

//환경 변수
$ENV["MAKE_DEBUG"] = false;
$ENV["MAKE_RST_MAX"] = 2000;
$ENV["MAKE_RST_NOW"] = 0;


//전체 리플레서 정보
$G = null;

//$F_PJTSEQ = 3;
$reqToken = $_GET["TOKEN"];


//분산 큐
require_once($CFG_LIBS_PATH_REDIS);
Predis\Autoloader::register();
$redis = new Predis\Client($CFG_AUTH_REDIS);   


$REQ["REQTYPE"] = "QUEUE";

$F_PJTSEQ = $_GET["pjtseq"];
$F_PGMSEQ = $_GET["pgmseq"];
alog("F_PJTSEQ = " . $F_PJTSEQ);
alog("F_PGMSEQ = " . $F_PGMSEQ);

//echo "F_PJTSEQ = " . $F_PJTSEQ;
//echo "F_PGMSEQ = " . $F_PGMSEQ;

$F_PGMTYPE = $_GET["pgmtype"];
$RstCnt = 0;
$NowFileType = "";

//pgm 정보 읽기
//$obj = array2obj(getInput("OBJINFO","",$G));

$P = getInput("PGMINFO","","",$G);

if($P == null)MsgExit("프로그램 정보가 없습니다.");
//echo "<br>P : ";
//aview($P);
//echo "<BR>프로젝트명 : " . $P["PJTNM"];
//echo "<BR>UITOOL : " . $P["UITOOL"];
//echo "<BR>서버언어 : " . $P["SVRLANG"];

$G = setG($G,"PGMINFO",$P);  //G################################

$arrFileList= getInput("PJTFILE","","",$G);

//A010 PGMVER 기존꺼 전부 비활성화
//A020 PGMVER 버전정보 추가
//A030 PGMFILE에 버전정보 추가



//A010 PGMVER 기존꺼 전부 비활성화
$map["FNCTYPE"] = "U";
$map["SQL"]["U"]["SVRID"] = $svrid;
$map["SQL"]["U"]["BINDTYPE"] = "ii";
$map["SQL"]["U"]["SQLTXT"] = "
	update CG_PGMVER set ACTIVEYN='N'
		, MODDT = date_format(NOW(),'%Y%m%d%H%i%s')
	where PJTSEQ = #{PJTSEQ} and PGMSEQ = #{PGMSEQ} and ACTIVEYN='Y'
	";

$REQ["PJTSEQ"] = $P["PJTSEQ"];
$REQ["PGMSEQ"] = $P["PGMSEQ"];
$rtnVal = makeFormviewSaveJson($map,$db);


//A020 PGMVER 버전정보 추가
$map["FNCTYPE"] = "C";
$map["SQL"]["C"]["SVRID"] = $svrid;
$map["SQL"]["C"]["BINDTYPE"] = "iiii";
$map["SQL"]["C"]["SQLTXT"] = "
	insert into CG_PGMVER (
		PJTSEQ, PGMSEQ, VERDT, DEGREE, ACTIVEYN
		,ADDDT
	) 
	select
		#{PJTSEQ} as PJTSEQ,#{PGMSEQ} as PGMSEQ,date_format(NOW(),'%Y%m%d') as VERDT,count(degree)+1 as DEGREE, 'Y'
		,date_format(NOW(),'%Y%m%d%H%i%s') as ADDDT
	from CG_PGMVER 
	where PJTSEQ=#{PJTSEQ} and PGMSEQ=#{PGMSEQ} and VERDT = date_format(NOW(),'%Y%m%d')
	";

$rtnVal = makeFormviewSaveJson($map,$db);

$REQ["VERSEQ"] = $db[$svrid]->insert_id;
$F_VERSEQ = $REQ["VERSEQ"];

 
//글로별 변수에 파일명 먼저 저장하기 ( ctl에서 svc파일 명을 참조하기 위함 )
for($j=0;$j<sizeof($arrFileList);$j++){

		
	//파일 이름 처리
	$MAKE_FILE_NM = $arrFileList[$j]["MKFILEFORMAT"];
	//$MAKE_FILE_NM = str_replace("{","{P.",$arrFileList[$j]["MKFILEFORMAT"]);
	$MAKE_FILE_NM = R($MAKE_FILE_NM,$G);

	//글로벌 변수에 파일명 넣기 
	$G["P"][$arrFileList[$j]["MKFILETYPE"] . "_FILENAME"] = $MAKE_FILE_NM; 
	$G["P"][$arrFileList[$j]["MKFILETYPE"] . "_FILEEXT"] = $arrFileList[$j]["MKFILEEXT"]; 
}

if($ENV["MAKE_DEBUG"])var_dump($G);


//실제 결과 db생성 및 파일생성
for($j=0;$j<sizeof($arrFileList);$j++){
    alog("makeFile(" . $arrFileList[$j]["MKFILEFORMAT"] . ")--------------------------------start");

	//020 파일명 규칙에 맞게 생성하기
	//$MAKE_FILE_NM = str_replace("{","{P.",$arrFileList[$j]["MKFILEFORMAT"]);
	$MAKE_FILE_NM = $arrFileList[$j]["MKFILEFORMAT"];
	//blog("MAKE_FILE_NM1 = ". $MAKE_FILE_NM );
    $MAKE_FILE_NM = R($MAKE_FILE_NM,$G) . "." . $arrFileList[$j]["MKFILEEXT"];
    $MAKE_FILE_NM_NO_EXT = R($MAKE_FILE_NM,$G);
	alog("MAKE_FILE_TYPE = ". $arrFileList[$j]["MKFILETYPE"] );
    alog("TEMPLATE = ". $arrFileList[$j]["TEMPLATE"] );
    alog("MKFILEFORMAT = ". $arrFileList[$j]["MKFILEFORMAT"] );    
    alog("MKFILEEXT = ". $arrFileList[$j]["MKFILEEXT"] );
    alog("MAKE_FILE_NM = ". $MAKE_FILE_NM );
    alog("MAKE_FILE_NM_NO_EXT = ". $MAKE_FILE_NM_NO_EXT );

	$NowFileType =  $arrFileList[$j]["MKFILETYPE"]; //makeRst(db저장 할때 사용)

	if($F_PGMTYPE == "" || $F_PGMTYPE == $arrFileList[$j]["MKFILETYPE"]){

		//030 템플릿 DB생성
		$OBJINFOD = getInput($arrFileList[$j]["TEMPLATE"] ,"","FILETYPE=" . $arrFileList[$j]["MKFILETYPE"],$G);
        alog("	OBJINFOD sizeof : " . sizeof($OBJINFOD) );
        
        //RSTFILE 넣고 번호 가져오기      
        $coltype = "iiiss s";
        $sql = "
        insert into CG_RSTFILE (
            PJTSEQ, PGMSEQ, VERSEQ, FILETYPE, FILENM
            , ACTIVEYN, FILEHASH, FILESIZE, REQTYPE
            , ADDDT
        ) values (
            #{PJTSEQ} ,#{PGMSEQ} ,#{VERSEQ} ,#{FILETYPE}, #{FILENM} 
            , 'N', '' , 0, #{REQTYPE}
            , date_format(NOW(),'%Y%m%d%H%i%s') 
        )
        ";
        $REQ["FILETYPE"] = $arrFileList[$j]["MKFILETYPE"];
        $REQ["FILENM"] = $MAKE_FILE_NM; 
        
        $stmt = makeStmt($db[$svrid],$sql,$coltype,$REQ);
        if(!$stmt) JsonMsg("500","100","(CG_RSTFILE) stmt make fail " . $db->errno . " -> " . $db->error);
        if(!$stmt->execute()) JsonMsg("500","110","(CG_RSTFILE) stmt execute fail " . $stmt->errno . " -> " . $stmt->error);
        $REQ["FILESEQ"] = $db[$svrid]->insert_id;
        $stmt->close();

		for($i=0; $i < sizeof($OBJINFOD); $i++ ){
            //var_dump($OBJINFOD[$i]);

            //echo "<BR>OBJDORD =" . $REQ["OBJDORD"];

            //RSTQUEUEM 테이블에 insert
            $coltype = "isiss sssss s";
            $sql = "
                insert into CG_RSTQUEUEM 
                (
                    FILESEQ, OBJDESC, OBJDORD, SPTTXT, SRCTXT
                    , SRCTYPE, UILANG, PARAM, INPUT, FILTER
                    , DEBUGYN, DTLSTEP, ADDDT
                ) values (
                    #{FILESEQ}, #{OBJDESC}, #{OBJDORD}, #{SPTTXT}, #{SRCTXT}
                    , #{SRCTYPE}, #{UILANG}, #{PARAM}, #{INPUT}, #{FILTER}
                    , #{DEBUGYN}, '10', date_format(NOW(),'%Y%m%d%H%i%s') 
                )
            ";
            $REQ = array_merge($REQ, $OBJINFOD[$i]);

            $stmt = makeStmt($db[$svrid],$sql,$coltype,$REQ);
            if(!$stmt) JsonMsg("500","100","(CG_RSTQUEUEM) stmt make fail " . $db->errno . " -> " . $db->error);
            if(!$stmt->execute()) JsonMsg("500","110","(CG_RSTQUEUEM) stmt execute fail " . $stmt->errno . " -> " . $stmt->error);
            $REQ["QUEUEMSEQ"] = $db[$svrid]->insert_id;
            $stmt->close();      

            //큐에 넣기
            $redisMap["REQ"] = $REQ;
            $redisMap["G"] = $G;
            //var_dump($redisMap);
            
            if(!$redis->rpush( 'make_queue', json_encode($redisMap)))JsonMsg("500","120","Redis make_queue rpush error");

		}


        //갱신 내용 알리기
        if(!$redis->publish("PUBSUB_MAKE_QUEUE","NEWMSG"))JsonMsg("500","120","Redis PUBSUB_MAKE_QUEUE error");

        
	}else{
		alog("<font color=red>MAKE_FILE_NM 미생성 = ". $MAKE_FILE_NM ."</font>");
	}


    alog("makeFile(" . $arrFileList[$j]["MKFILEFORMAT"] . ")--------------------------------end");

}


//900 마시작 새성 시간 처리하기
/*
$map["FNCTYPE"] = "U";
$map["SQL"]["U"]["SVRID"] = $svrid;        
$map["SQL"]["U"]["BINDTYPE"] = "ii";
$map["SQL"]["U"]["SQLTXT"] = "
update CG_PGMINFO set    LSTMKDT = date_format(NOW(),'%Y%m%d%H%i%s') 
where PJTSEQ = #{PJTSEQ} and PGMSEQ = #{PGMSEQ}
";
$rtnVal = makeFormviewSaveJson($map,$db);
*/

//캐쉬 클로즈
$redis->disconnect();
unset($redis);


$time_end = microtime_float();
$time = $time_end - $time_start;

alog("실행시간 (seconds) : " . number_format($time,2) );

//캐쉬 활용
//echo "<table>";
//while (list($key, $tarr) = each($dbCache)) {
//    echo "<tr><td>" . $key . "</td><td>" . $tarr["HIT"] . "</td><td>arraysize:" . sizeof($tarr["DATA"]) . "</td></tr>";
//}
//echo "</table>";
alog("HTTP_REFERER = " . strpos($_SERVER['HTTP_REFERER'],"cg_pgmmng.php"));
if(strpos($_SERVER['HTTP_REFERER'],"cg_pgmmng.php")){
    JsonMsg("200",$F_PGMSEQ,$F_PGMTYPE . " 실행시간 (seconds) : " . number_format($time,2));
}else{
    JsonMsg("200",$rtnMap["LINECOUNT"],$F_PGMTYPE . " 실행시간 (seconds) : " . number_format($time,2));
}




exit;


















//HTML 생성
function makeTotal($G,$OBJTYPE,$FILETYPE){
    global $db,$svrid,$F_PJTSEQ,$F_PGMSEQ;
    blog("makeTotal(" . $OBJTYPE . ")--------------------------------start");
    //기존꺼 지우기

    //기존 생성 정보 삭제
    $T_SQL = sprintf("delete from CG_RST where PJTSEQ = %d and PGMSEQ = %d and FILETYPE = '%s' "
        , $F_PJTSEQ
        , $F_PGMSEQ
		, $OBJTYPE
    );

    $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","199", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;
    //echo "<br>G : ";
    //var_dump($G);



    //
    $OBJINFOD = getInput($OBJTYPE,"","FILETYPE=" . $FILETYPE,$G);

    mlog("	OBJINFOD sizeof : " . sizeof($OBJINFOD) );
    if( sizeof($OBJINFOD) > 0 ){
        goJsD($OBJINFOD,$G,$FILETYPE);
    }
    blog("makeTotal--------------------------------end");
}




//HTML 생성
function makeSvc($G,$OBJTYPE){
    global $db,$svrid,$F_PJTID,$F_PGMID;
    blog("makeSvc--------------------------------start");
    //기존꺼 지우기

    //기존 생성 정보 삭제
    $T_SQL = sprintf("delete from CG_RST where PJTSEQ = '%s' and PGMID = '%s' and FILETYPE = 'SVRSVC' "
        , $F_PJTID
        , $F_PGMID
    );

    $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","299", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;
    //echo "<br>G : ";
    //var_dump($G);



    //
    $OBJINFOD = getInput($OBJTYPE,$FILETYPE,"FILETYPE=SVRSVC",$G);

    mlog("	OBJINFOD sizeof : " . sizeof($OBJINFOD) );
    if( sizeof($OBJINFOD) > 0 ){
        goJsD($OBJINFOD,$G,$FILETYPE);
    }
    blog("makeSvc--------------------------------end");
}




//HTML 생성
function makeDao($G,$OBJTYPE){
    global $db,$svrid,$F_PJTID,$F_PGMID;
    blog("makeDao--------------------------------start");
    //기존꺼 지우기

    //기존 생성 정보 삭제
    $T_SQL = sprintf("delete from CG_RST where PJTID = '%s' and PGMID = '%s' and FILETYPE = 'SVRDAO' "
        , $F_PJTID
        , $F_PGMID
    );

    $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","399", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;
    //echo "<br>G : ";
    //var_dump($G);



    //
    $OBJINFOD = getInput($OBJTYPE,$FILETYPE,"FILETYPE=SVRDAO",$G);

    mlog("	OBJINFOD sizeof : " . sizeof($OBJINFOD) );
    if( sizeof($OBJINFOD) > 0 ){
        goJsD($OBJINFOD,$G,$FILETYPE);
    }
    blog("makeDao--------------------------------end");
}




//HTML 생성
function makeCtl($G,$OBJTYPE){
    global $db,$svrid,$F_PJTID,$F_PGMID;
    blog("makeCtl--------------------------------start");
    //기존꺼 지우기

    //기존 생성 정보 삭제
    $T_SQL = sprintf("delete from CG_RST where PJTID = '%s' and PGMID = '%s' and FILETYPE = 'SVRCTL' "
        , $F_PJTID
        , $F_PGMID
    );

    $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","499", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;
    //echo "<br>G : ";
    //var_dump($G);



    //
    $OBJINFOD = getInput($OBJTYPE,$FILETYPE,"FILETYPE=SVRCTL",$G);

    blog("	OBJINFOD sizeof : " . sizeof($OBJINFOD) );
    if( sizeof($OBJINFOD) > 0 ){
        goJsD($OBJINFOD,$G,$FILETYPE);
    }
    blog("makeCtl--------------------------------end");
}



//HTML 생성
function makeHtml($G,$OBJTYPE){
    global $db,$svrid,$F_PJTID,$F_PGMID;
    blog("makeHtml--------------------------------start");
    //기존꺼 지우기

    //기존 생성 정보 삭제
    $T_SQL = sprintf("delete from CG_RST where PJTID = '%s' and PGMID = '%s' and FILETYPE = 'HTML' "
        , $F_PJTID
        , $F_PGMID
    );

    $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","599", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;
    //echo "<br>G : ";
    //var_dump($G);



    //
    $OBJINFOD = getInput($OBJTYPE,$FILETYPE,"FILETYPE=HTML",$G);

    mlog("	OBJINFOD sizeof : " . sizeof($OBJINFOD) );


    if( sizeof($OBJINFOD) > 0 ){
        goJsD($OBJINFOD,$G,$FILETYPE);
    }
    blog("makeHtml--------------------------------end");
}






//HTML 생성
function makeUfi($G,$FILETYPE){
    global $db,$svrid,$F_PJTID,$F_PGMID;
    blog("makeUfi--------------------------------start");
    //기존꺼 지우기

    //기존 생성 정보 삭제
    $T_SQL = sprintf("delete from CG_RST where PJTID = '%s' and PGMID = '%s' and FILETYPE = '%s' "
        , $F_PJTID
        , $F_PGMID
		, $FILETYPE
    );
	//echo "sql : " . $T_SQL;
	//exit;

    $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","699", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;
    //echo "<br>G : ";
    //var_dump($G);



    //
    $OBJINFOD = getInput("ASVRUFI",$FILETYPE,"FILETYPE=".$FILETYPE,$G);

    blog("	OBJINFOD sizeof : " . sizeof($OBJINFOD) );
    if( sizeof($OBJINFOD) > 0 ){
        goJsD($OBJINFOD,$G,$FILETYPE);
    }
    blog("makeUfi--------------------------------end");
}



?>