<?php
header("Content-Type: text/html; charset=UTF-8");
header("Cache-Control:no-cache");
header("Pragma:no-cache");


$CFG = require_once("../common/include/incConfig.php");

require_once($CFG["CFG_LIBS_VENDOR"]);

require_once("../common/include/incUtil.php");
require_once("../common/include/incDB.php");
require_once("../common/include/incUser.php");
require_once("../common/include/incSec.php");    
require_once("../common/include/incRequest.php");

//로그인 검사
require_once("../common/include/incLoginCheck.php");//로그인 검사

//로거
$reqToken = reqGetString("TOKEN",37);
$CTL = reqGetString("CTL",20);
$resToken = uniqid();
/*
$log = getLoggerStdout(
    array(
    "LIST_NM"=>"log_CG"
    , "PGM_ID"=>"BO_MAIN_V3"
    , "REQTOKEN" => $reqToken
    , "RESTOKEN" => $resToken
    , "LOG_LEVEL" => Monolog\Logger::DEBUG
    )
);
*/

if($CTL == "getMenu"){

    $rtnVal = array();
    $rtnVal[0] = array( "id" => "CGCORE", "nm" => "CORE", "url" => "");
    $rtnVal[0]["submenus"][0] = array("id" => "objinfo", "nm" => "OBJINFO", "url" => "/c.g/cg_objinfo3.php");
    $rtnVal[0]["submenus"][1] = array("id" => "pgminfo3", "nm" => "PGMINFO", "url" => "/c.g/cg_pgminfo3.php");
    $rtnVal[0]["submenus"][2] = array("id" => "pgmmng", "nm" => "PGMMNG", "url" => "/c.g/cg_pgmmng.php");
    $rtnVal[0]["submenus"][3] = array("id" => "configmng", "nm" => "CFG_MNG", "url" => "/c.g/cg_configmng.php");
    $rtnVal[0]["submenus"][4] = array("id" => "redismng", "nm" => "REDIS_MNG", "url" => $CFG["CFG_DEMO_URL"] . "/d.s/CG/redismngView.php");


    //모든 프로젝트의 데이터 소스 정보 불러오기
    $db = getDbConn($CFG["CFG_DB"]["CGCORE"]);    
    $sql = "
    select PJTSEQ, PJTID, PJTNM, DSNM from CG_PJTINFO where DELYN='N' ORDER BY PJTORD asc
        ";
    $sqlMap = getSqlParam($sql,$coltype="",$REQ);
    $stmt = getStmt($db,$sqlMap);
    $arrPjtInfo = getStmtArray($stmt);
    closeStmt($stmt);
    alog("sizeof(arrPjtInfo) = " . sizeof($arrPjtInfo) );

    for($i=0;$i<sizeof($arrPjtInfo); $i++){
        $tMap = $arrPjtInfo[$i];

        if($tMap["DSNM"] !=""){
            $dbPjt=getDbConn($CFG["CFG_DB"][$tMap["DSNM"]]);

            $REQ["PJTSEQ"] = $tMap["PJTSEQ"];
            $REQ["PJTID"] = $tMap["PJTID"];
            $REQ["CFG_DEMO_URL"] = $CFG["CFG_DEMO_URL"];
            //echo "<BR>DSNM : " .  $tMap["DSNM"] ;
            //echo "<BR>PJTSEQ : " .  $REQ["PJTSEQ"] ;

            $sql = " 
            select PGMSEQ as seq, pgmid, concat(#{PJTID},'-',PGMID) as id, PGMNM as nm, concat(#{CFG_DEMO_URL}, '/d.s/',#{PJTID},'/', VIEWURL) as url 
            from CG_PGMINFO 
            where PJTSEQ = #{PJTSEQ} 
            order by PGMORD asc, PGMSEQ desc";
            $sqlMap = getSqlParam($sql,$coltype="sssi",$REQ);
            $stmt = getStmt($dbPjt,$sqlMap);
            $arrPgmInfo = getStmtArray($stmt);
            closeStmt($stmt);
            closeDb($dbPjt);

            $pjtInfo = array( "seq" => $tMap["PJTSEQ"], "id" => $tMap["PJTID"],"nm" => $tMap["PJTNM"],"url" => "", "submenus" => $arrPgmInfo);

        }else{
            $pjtInfo = array( "seq" => $tMap["PJTSEQ"], "id" => $tMap["PJTID"], "nm" => $tMap["PJTNM"],"url" => "", "submenus" => array());
        }

        array_push($rtnVal,$pjtInfo); 
    }


    echo json_encode($rtnVal);



}else if($CTL == "getUserInfo"){

    $rtnVal = array();


    $db = getDbConn($CFG["CFG_DB"]["OS"]);
    $sql = "
        select c.PGMID, c.MNU_SEQ, c.MNU_NM, c.URL
        from CMN_GRP_USR a
            join CMN_GRP b on a.GRP_SEQ = b.GRP_SEQ
            join CMN_MNU c on b.INTRO_PGMID = c.PGMID
        where a.USR_SEQ = #{USR_SEQ}
    ";

    $REQ["USR_SEQ"] = getUserSeq(); //incUser.php
    $sqlMap = getSqlParam($sql,$coltype="i",$REQ);
    $stmt = getStmt($db,$sqlMap);
    $arrIntroUrl = getStmtArray($stmt);
    closeStmt($stmt);

    //접속 세션 토크
    //$rtnVal["accessToken"] = getAccessToken();

    //세션에서 인트로URL 가져오기
    $rtnVal["intro"] = $arrIntroUrl;

    //알림 목록 가져오기
    $rtnVal["notice"] = array();

    echo json_encode($rtnVal);

    closeDb($db);
}else{
    ?>
    {"ctl":"not good"}
    <?php
}

?>