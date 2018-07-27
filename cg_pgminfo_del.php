<?php
    header("Content-Type: text/html; charset=UTF-8");
    header("Cache-Control:no-cache");
    header("Pragma:no-cache");


    require_once("./include/incUtil.php");
    require_once("./incConfig.php");
    require_once("./include/incDB.php");
    require_once("./include/incUser.php");
    require_once("./include/incRequest.php");

    require_once("./lib/PHP-SQL-Parser/src/PHPSQLParser.php");

	

    //ServerViewTxt("N","N","Y","Y");

    $db=db_m_open();

	//내부함수 호출 후 리던 배열 
	$rtnArr = array();


    $REQ["PJTSEQ"] = reqPostNumber('PJTSEQ',10);
    $REQ["PGMSEQ"] = reqPostNumber('PGMSEQ',10);
    

	alog("---------------GRP PGM ---------------------START");


    //100 PGMINFO 가져오기
        //200 SQL 가져오기
            //300 SQlCOL 가져오기
        //400 GRP 가져오기
            //500 FNC 가져오기
                //600 SVC가져오기
                //700 SQLR가져오기
            //800 IO 가져오기
            //900 INHERIT 가져오기

    //100 inherit 지우기
    //200 io 지우기
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

    JsonMsg("200","100","정상적으로 Copy 성공하였습니다.");

    
?>