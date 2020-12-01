<?php
    header("Content-Type: text/html; charset=UTF-8");
    header("Cache-Control:no-cache");
    header("Pragma:no-cache");

    $CFG = require_once "../common/include/incConfig.php";
    require_once("../common/include/incUtil.php");
    require_once("../common/include/incSec.php");
    require_once("../common/include/incDB.php");
    require_once("../common/include/incUser.php");
    require_once("../common/include/incRequest.php");

	

    //ServerViewTxt("N","N","Y","Y");
    $REQ["PJTSEQ"] = reqPostNumber('PJTSEQ',10);
    $REQ["PGMSEQ"] = reqPostNumber('PGMSEQ',10);

    //프로젝트의 데이터소스 정보 얻기
    $db2 = getDbConn($CFG["CFG_DB"]["CGCORE"]);
    //var_dump($db2);
    $sql = "select * from CG_PJTINFO where PJTSEQ = #{PJTSEQ}";
    //$stmt = makeStmt($db2,$sql,$coltype="i",$REQ);

    
    $sqlMap = getSqlParam($sql,$coltype="i",$REQ);
    $stmt = getStmt($db2,$sqlMap);
    $pjtInfo = getStmtArray($stmt)[0];

    closeStmt($stmt);
    closeDb($db2);

    //echo "DSNM : " . $pjtInfo["DSNM"];

    //프로젝트 db연결
    $db = getDbConn($CFG["CFG_DB"][$pjtInfo["DSNM"]]);

	//내부함수 호출 후 리던 배열 
	$rtnArr = array();



    

	alog("---------------GRP PGM ---------------------START");


    //100 PGMINFO 가져오기
        //200 SQL 가져오기
            //300 SQlCOL 가져오기
        //400 GRP 가져오기
            //500 FNC 가져오기
                //600 SVC가져오기
                //700 SQLR가져오기
            //800 EVT 가져오기
            //800 IO 가져오기
            //900 INHERIT 가져오기

    //100 inherit 지우기
    //200 io 지우기
    //250 evt 지우기
    //300 sqlr 지우기
    //400 svc 지우기
    //500 fnc 지우기
    //600 grp 지우기
    //700 sqlcol 지우기
    //800 sql 지우기
    //900 pgminfo 지우기




    //100 inherit 지우기
    $coltype = "ii";
    $sql = " delete from CG_PGMINHERIT where PJTSEQ = #{PJTSEQ} AND PGMSEQ = #{PGMSEQ} ";
    $stmt = makeStmt($db,$sql,$coltype,$REQ);
    if(!$stmt)JsonMsg("500","100","stmt make fail.");
    if(!$stmt->execute())JsonMsg("500","100","stmt execute fail." . $dtmt->errno . " -> " . $stmt->error);
    $stmt->close();

    //200 io 지우기
    $coltype = "ii";
    $sql = " delete from CG_PGMIO where PJTSEQ = #{PJTSEQ} AND PGMSEQ = #{PGMSEQ} ";
    $stmt = makeStmt($db,$sql,$coltype,$REQ);
    if(!$stmt)JsonMsg("500","200","stmt make fail.");
    if(!$stmt->execute())JsonMsg("500","200","stmt execute fail." . $dtmt->errno . " -> " . $stmt->error);
    $stmt->close();

    //250 evt 지우기
    $coltype = "ii";
    $sql = " delete from CG_PGMEVT where PJTSEQ = #{PJTSEQ} AND PGMSEQ = #{PGMSEQ} ";
    $stmt = makeStmt($db,$sql,$coltype,$REQ);
    if(!$stmt)JsonMsg("500","200","stmt make fail.");
    if(!$stmt->execute())JsonMsg("500","200","stmt execute fail." . $dtmt->errno . " -> " . $stmt->error);
    $stmt->close();
    
    //300 sqlr 지우기
    $coltype = "ii";
    $sql = " delete from CG_PGMSQLR where PJTSEQ = #{PJTSEQ} AND PGMSEQ = #{PGMSEQ} ";
    $stmt = makeStmt($db,$sql,$coltype,$REQ);
    if(!$stmt)JsonMsg("500","300","stmt make fail.");
    if(!$stmt->execute())JsonMsg("500","300","stmt execute fail." . $dtmt->errno . " -> " . $stmt->error);
    $stmt->close();

    //400 svc 지우기
    $coltype = "ii";
    $sql = " delete from CG_PGMSVC where PJTSEQ = #{PJTSEQ} AND PGMSEQ = #{PGMSEQ} ";
    $stmt = makeStmt($db,$sql,$coltype,$REQ);
    if(!$stmt)JsonMsg("500","400","stmt make fail.");
    if(!$stmt->execute())JsonMsg("500","400","stmt execute fail." . $dtmt->errno . " -> " . $stmt->error);
    $stmt->close();
    
    //500 fnc 지우기
    $coltype = "ii";
    $sql = " delete from CG_PGMFNC where PJTSEQ = #{PJTSEQ} AND PGMSEQ = #{PGMSEQ} ";
    $stmt = makeStmt($db,$sql,$coltype,$REQ);
    if(!$stmt)JsonMsg("500","100","stmt make fail.");
    if(!$stmt->execute())JsonMsg("500","100","stmt execute fail." . $dtmt->errno . " -> " . $stmt->error);
    $stmt->close();
    
    //600 grp 지우기
    $coltype = "ii";
    $sql = " delete from CG_PGMGRP where PJTSEQ = #{PJTSEQ} AND PGMSEQ = #{PGMSEQ} ";
    $stmt = makeStmt($db,$sql,$coltype,$REQ);
    if(!$stmt)JsonMsg("500","600","stmt make fail.");
    if(!$stmt->execute())JsonMsg("500","600","stmt execute fail." . $dtmt->errno . " -> " . $stmt->error);
    $stmt->close();

    //700 sqlcol 지우기
    $coltype = "ii";
    $sql = " delete from CG_PGMSQLD where PJTSEQ = #{PJTSEQ} AND PGMSEQ = #{PGMSEQ} ";
    $stmt = makeStmt($db,$sql,$coltype,$REQ);
    if(!$stmt)JsonMsg("500","700","stmt make fail.");
    if(!$stmt->execute())JsonMsg("500","700","stmt execute fail." . $dtmt->errno . " -> " . $stmt->error);
    $stmt->close();

    //800 sql 지우기
    $coltype = "ii";
    $sql = " delete from CG_PGMSQL where PJTSEQ = #{PJTSEQ} AND PGMSEQ = #{PGMSEQ} ";
    $stmt = makeStmt($db,$sql,$coltype,$REQ);
    if(!$stmt)JsonMsg("500","800","stmt make fail.");
    if(!$stmt->execute())JsonMsg("500","800","stmt execute fail." . $dtmt->errno . " -> " . $stmt->error);
    $stmt->close();


    //900 pgminfo 지우기
    $coltype = "ii";
    $sql = " delete from CG_PGMINFO where PJTSEQ = #{PJTSEQ} AND PGMSEQ = #{PGMSEQ} ";
    $stmt = makeStmt($db,$sql,$coltype,$REQ);
    if(!$stmt)JsonMsg("500","900","stmt make fail.");
    if(!$stmt->execute())JsonMsg("500","900","stmt execute fail." . $dtmt->errno . " -> " . $stmt->error);
    $stmt->close();

    $db->close();

    JsonMsg("200","100","정상적으로 Delete 성공하였습니다.");

    
?>