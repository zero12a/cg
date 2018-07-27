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


    $REQ["PJTSEQ"] = reqPostNumber('FROM_PJTSEQ',10);
    $REQ["PGMSEQ"] = reqPostNumber('FROM_PGMSEQ',10);
    

    $REQ["TO_PJTSEQ"] = reqPostNumber('TO_PJTSEQ',10);
    $REQ["TO_PGMID"] = reqPostString('TO_PGMID',30);

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

    $fromArr = array();

    //100 PGMINFO 가져오기
    $coltype = "ii";
    $sql = "
        SELECT
            *
        FROM 
            CG_PGMINFO
        WHERE PJTSEQ = #{PJTSEQ} AND PGMSEQ = #{PGMSEQ}
    ";

    $stmt = makeStmt($db,$sql,$coltype,$REQ);
    if(!$stmt)JsonMsg("500","300","SQL makeStmt 실패 했습니다.");
    if(!$stmt->execute())JsonMsg("500","100","stmt 실행 실패" . $dtmt->errno . " -> " . $stmt->error);

    $result = $stmt->get_result();
    $stmt->close();

    $fromArr["PGMINFO"] = array();
    if($row = $result->fetch_array(MYSQLI_ASSOC))
    {
        $fromArr["PGMINFO"] = $row;
        alog("PGMID = " . $row["PGMID"]);
    }
    $result->close();

    //200 SQL 가져오기
    $coltype = "ii";
    $sql = "
        SELECT
            *
        FROM 
            CG_PGMSQL
        WHERE PJTSEQ = #{PJTSEQ} AND PGMSEQ = #{PGMSEQ}
    ";

    $stmt = makeStmt($db,$sql,$coltype,$REQ);
    if(!$stmt)JsonMsg("500","300","SQL makeStmt 실패 했습니다.");
    if(!$stmt->execute())JsonMsg("500","100","stmt 실행 실패" . $dtmt->errno . " -> " . $stmt->error);

    $result = $stmt->get_result();
    $stmt->close();

    $fromArr["PGMSQL"] = array();
    while($row = $result->fetch_array(MYSQLI_ASSOC))
    {
        //300 SQlCOL 가져오기
        $REQ["SQLSEQ"] = $row["SQLSEQ"];
        $coltype = "iii";
        $sql = "
            SELECT
                *
            FROM 
                CG_PGMSQLD
            WHERE PJTSEQ = #{PJTSEQ} AND PGMSEQ = #{PGMSEQ} AND SQLSEQ = #{SQLSEQ}
        ";
    
        $stmt = makeStmt($db,$sql,$coltype,$REQ);
        if(!$stmt)JsonMsg("500","300","SQL makeStmt 실패 했습니다.");
        if(!$stmt->execute())JsonMsg("500","100","stmt 실행 실패" . $dtmt->errno . " -> " . $stmt->error);
    
        $result2 = $stmt->get_result();
        $stmt->close();
    
        $tArr = array();
        while($rowCol = $result2->fetch_array(MYSQLI_ASSOC))
        {
            array_push($tArr,$rowCol);
        }
        $result2->close();

        $row["PGMSQLD"] = $tArr;

        array_push($fromArr["PGMSQL"],$row);


        alog("SQLSEQ = " . $row["SQLSEQ"]);
    }
    $result->close();


    //400 GRP 가져오기
    $coltype = "ii";
    $sql = "
        SELECT
            *
        FROM 
            CG_PGMGRP
        WHERE PJTSEQ = #{PJTSEQ} AND PGMSEQ = #{PGMSEQ}
    ";

    $stmt = makeStmt($db,$sql,$coltype,$REQ);
    if(!$stmt)JsonMsg("500","300","SQL makeStmt 실패 했습니다.");
    if(!$stmt->execute())JsonMsg("500","100","stmt 실행 실패" . $dtmt->errno . " -> " . $stmt->error);

    $result = $stmt->get_result();
    $stmt->close();

    $fromArr["PGMGRP"] = array();
    while($row = $result->fetch_array(MYSQLI_ASSOC))
    {

        //500 FNC 가져오기
        $REQ["GRPSEQ"] = $row["GRPSEQ"];
        $coltype = "iii";
        $sql = "
            SELECT
                *
            FROM 
                CG_PGMFNC
            WHERE PJTSEQ = #{PJTSEQ} AND PGMSEQ = #{PGMSEQ} AND GRPSEQ = #{GRPSEQ}
        ";

        $stmt = makeStmt($db,$sql,$coltype,$REQ);
        if(!$stmt)JsonMsg("500","300","SQL makeStmt 실패 했습니다.");
        if(!$stmt->execute())JsonMsg("500","100","stmt 실행 실패" . $dtmt->errno . " -> " . $stmt->error);

        $resultFnc = $stmt->get_result();
        $stmt->close();

        $tArr = array();
        while($rowFnc = $resultFnc->fetch_array(MYSQLI_ASSOC))
        {


            //600 SVC가져오기
            $REQ["GRPSEQ"] = $row["GRPSEQ"];
            $REQ["FNCSEQ"] = $rowFnc["FNCSEQ"];

            $coltype = "iiii";
            $sql = "
                SELECT
                    *
                FROM 
                    CG_PGMSVC
                WHERE PJTSEQ = #{PJTSEQ} 
                    AND PGMSEQ = #{PGMSEQ} 
                    AND GRPSEQ = #{GRPSEQ}
                    AND FNCSEQ = #{FNCSEQ}
            ";

            $stmt = makeStmt($db,$sql,$coltype,$REQ);
            if(!$stmt)JsonMsg("500","300","SQL makeStmt 실패 했습니다.");
            if(!$stmt->execute())JsonMsg("500","100","stmt 실행 실패" . $dtmt->errno . " -> " . $stmt->error);

            $resultSvc = $stmt->get_result();
            $stmt->close();

            $tArrSvc = array();
            while($rowSvc = $resultSvc->fetch_array(MYSQLI_ASSOC))
            {

                //700 SQLR가져오기
                $REQ["SVCSEQ"] = $rowSvc["SVCSEQ"];

                $coltype = "iii";
                $sql = "
                    SELECT
                        *
                    FROM 
                        CG_PGMSQLR
                    WHERE PJTSEQ = #{PJTSEQ} 
                        AND PGMSEQ = #{PGMSEQ} 
                        AND SVCSEQ = #{SVCSEQ}
                ";

                $stmt = makeStmt($db,$sql,$coltype,$REQ);
                if(!$stmt)JsonMsg("500","300","SQL makeStmt 실패 했습니다.");
                if(!$stmt->execute())JsonMsg("500","100","stmt 실행 실패" . $dtmt->errno . " -> " . $stmt->error);

                $resultSqlr = $stmt->get_result();
                $stmt->close();

                $tArrSqlr = array();
                while($rowSqlr = $resultSqlr->fetch_array(MYSQLI_ASSOC))
                {
                    array_push($tArrSqlr,$rowSqlr);
                }
                $resultSqlr->close();

                $rowSvc["PGMSQLR"] = $tArrSqlr;

                array_push($tArrSvc,$rowSvc);
            }
            $resultSvc->close();
            $rowFnc["PGMSVC"] = $tArrSvc;




            array_push($tArr,$rowFnc);
        }
        $resultFnc->close();
        $row["PGMFNC"] = $tArr;


                        

        //800 IO 가져오기
        $REQ["GRPSEQ"] = $row["GRPSEQ"];
        $coltype = "iii";
        $sql = "
            SELECT
                *
            FROM 
                CG_PGMIO
            WHERE PJTSEQ = #{PJTSEQ} AND PGMSEQ = #{PGMSEQ} AND GRPSEQ = #{GRPSEQ}
        ";

        $stmt = makeStmt($db,$sql,$coltype,$REQ);
        if(!$stmt)JsonMsg("500","600","SQL makeStmt 실패 했습니다.");
        if(!$stmt->execute())JsonMsg("500","600","stmt 실행 실패" . $dtmt->errno . " -> " . $stmt->error);

        $resultIo = $stmt->get_result();
        $stmt->close();

        $tArr = array();
        while($rowCol = $resultIo->fetch_array(MYSQLI_ASSOC))
        {
            array_push($tArr,$rowCol);
        }
        $resultIo->close();
        $row["PGMIO"] = $tArr;


        //900 INHERIT 가져오기
        $REQ["GRPSEQ"] = $row["GRPSEQ"];
        $coltype = "iii";
        $sql = "
            SELECT
                *
            FROM 
                CG_PGMINHERIT
            WHERE PJTSEQ = #{PJTSEQ} AND PGMSEQ = #{PGMSEQ} AND GRPSEQ = #{GRPSEQ}
        ";

        $stmt = makeStmt($db,$sql,$coltype,$REQ);
        if(!$stmt)JsonMsg("500","900","SQL makeStmt 실패 했습니다.");
        if(!$stmt->execute())JsonMsg("500","900","stmt 실행 실패" . $dtmt->errno . " -> " . $stmt->error);

        $resultInherit = $stmt->get_result();
        $stmt->close();

        $tArr = array();
        while($rowCol = $resultInherit->fetch_array(MYSQLI_ASSOC))
        {
            array_push($tArr,$rowCol);
        }
        $resultInherit->close();
        $row["PGMINHERIT"] = $tArr;


        array_push($fromArr["PGMGRP"],$row);
        alog("GRPSEQ = " . $row["GRPSEQ"]);
    }
    $result->close();



    //echo json_encode($fromArr);

    $toArr = $fromArr;


    //100 PGMINFO 넣기
    //200 SQL 넣기
        //300 SQlCOL 넣기
    //400 GRP 넣기
        //500 FNC 넣기
            //600 SVC 넣기
            //700 SQLR 넣기
        //800 IO 넣기
        //900 INHERIT 넣기

    //100 PGMINFO 넣기
    $map = $toArr["PGMINFO"];
    $map["PGMNM"] = "Copy of " . $map["PGMNM"];
    $map["PJTSEQ"] = $REQ["TO_PJTSEQ"];
    $map["PGMID"] = $REQ["TO_PGMID"];
    $coltype = "sisss ssss";
    $sql = "
        insert into CG_PGMINFO (
            PGMID, PJTSEQ, PGMNM, PKGGRP, VIEWURL
            , PGMTYPE, POPWIDTH, POPHEIGHT, SECTYPE
            , ADDDT, ADDID
        ) values (
            #{PGMID}, #{PJTSEQ}, #{PGMNM}, #{PKGGRP}, #{VIEWURL}
            ,#{PGMTYPE}, #{POPWIDTH}, #{POPHEIGHT}, #{SECTYPE}
            ,date_format(sysdate(),'%Y%m%d%H%i%s'), 0
        )
    ";

    $stmt = makeStmt($db,$sql,$coltype,$map);
    if(!$stmt)JsonMsg("500","1100","SQL makeStmt 실패 했습니다.");
    if(!$stmt->execute())JsonMsg("500","1100","stmt 실행 실패" . $dtmt->errno . " -> " . $stmt->error);
    $toArr["PGMSEQ"] = $db->insert_id;
    $stmt->close();

    //200 SQL 넣기
    for($i=0;$i<count($toArr["PGMSQL"]);$i++){
        $sqls = $toArr["PGMSQL"][$i];
        $map["PGMSEQ"]      = $toArr["PGMSEQ"];
        $map["SQLID"]       = $sqls["SQLID"];
        $map["SQLNM"]       = $sqls["SQLNM"];
        $map["SVRSEQ"]      = $sqls["SVRSEQ"];
        $map["CRUD"]        = $sqls["CRUD"];
        $map["RTN_TYPE"]    = $sqls["RTN_TYPE"];
        $map["SQLORD"]      = $sqls["SQLORD"];
        $map["SQLTXT"]      = $sqls["SQLTXT"];

        $coltype = "iissi ssis";
        $sql = "
            insert into CG_PGMSQL (
                PJTSEQ, PGMSEQ, SQLID, SQLNM, SVRSEQ
                , CRUD, RTN_TYPE, SQLORD, SQLTXT
                , ADDDT
            ) values (
                #{PJTSEQ}, #{PGMSEQ}, #{SQLID}, #{SQLNM}, #{SVRSEQ}
                ,#{CRUD}, #{RTN_TYPE}, #{SQLORD}, #{SQLTXT}
                ,date_format(sysdate(),'%Y%m%d%H%i%s')
            )
        ";
    
        $stmt = makeStmt($db,$sql,$coltype,$map);
        if(!$stmt)JsonMsg("500","1200","SQL makeStmt 실패 했습니다.");
        if(!$stmt->execute())JsonMsg("500","1200","stmt 실행 실패" . $dtmt->errno . " -> " . $stmt->error);
        $toArr["PGMSQL"][$i]["SQLSEQ"] = $db->insert_id;
        $stmt->close();

        //300 SQlCOL 넣기
        for($t=0;$t<count($toArr["PGMSQL"][$i]["PGMSQLD"]);$t++){
            $cols = $toArr["PGMSQL"][$i]["PGMSQLD"][$t];

            $map["SQLSEQ"]      = $toArr["PGMSQL"][$i]["SQLSEQ"];
            $map["SQLGBN"]      = $cols["SQLGBN"];
            $map["COLID"]        = $cols["COLID"];
            $map["DDCOLID"]    = $cols["DDCOLID"];
            $map["SQLORD"]      = $cols["SQLORD"];
            $map["ORD"]      = $cols["ORD"];

            $coltype = "iiiss si";
            $sql = "
                insert into CG_PGMSQLD (
                    SQLSEQ, PJTSEQ, PGMSEQ, SQLGBN, COLID
                    ,DDCOLID, ORD
                    , ADDDT
                ) values (
                    #{SQLSEQ}, #{PJTSEQ}, #{PGMSEQ}, #{SQLGBN}, #{COLID}
                    , #{DDCOLID}, #{ORD}
                    , date_format(sysdate(),'%Y%m%d%H%i%s')
                )
            ";
        
            $stmt = makeStmt($db,$sql,$coltype,$map);
            if(!$stmt)JsonMsg("500","1300","SQL makeStmt 실패 했습니다.");
            if(!$stmt->execute())JsonMsg("500","1300","stmt 실행 실패" . $dtmt->errno . " -> " . $stmt->error);
            //$toArr["PGMSQL"][$i]["SQLSEQ"] = $db->insert_id;
            $stmt->close();
        }
    }

    
    //400 GRP 넣기
    for($i=0;$i<count($toArr["PGMGRP"]);$i++){
        $grps = $toArr["PGMGRP"][$i];

        $map["GRPID"]           = $grps["GRPID"];
        $map["GRPTYPE"]         = $grps["GRPTYPE"];
        $map["GRPNM"]           = $grps["GRPNM"];
        $map["GRPORD"]          = $grps["GRPORD"];
        $map["FREEZECNT"]       = $grps["FREEZECNT"];
        $map["VBOX"]            = $grps["VBOX"];
        $map["COLBRCNT"]        = $grps["COLBRCNT"];
        $map["REFGRPID"]        = $grps["REFGRPID"];
        $map["GRPWIDTH"]        = $grps["GRPWIDTH"];
        $map["GRPHEIGHT"]       = $grps["GRPHEIGHT"];
        $map["GRPPADDING"]      = $grps["GRPPADDING"];
        $map["BRYN"]            = $grps["BRYN"];
        $map["COLSIZETYPE"]     = $grps["COLSIZETYPE"];
        $map["LEGENDALIGN"]     = $grps["LEGENDALIGN"];

        $coltype = "iisss iisis sssss s";
        $sql = "
            insert into CG_PGMGRP (
                PJTSEQ, PGMSEQ, GRPID, GRPTYPE, GRPNM
                , GRPORD, FREEZECNT, VBOX, COLBRCNT, REFGRPID
                , GRPWIDTH, GRPHEIGHT, GRPPADDING, BRYN, COLSIZETYPE
                , LEGENDALIGN, ADDDT
            ) values (
                #{PJTSEQ}, #{PGMSEQ}, #{GRPID}, #{GRPTYPE}, #{GRPNM} 
                , #{GRPORD}, #{FREEZECNT}, #{VBOX}, #{COLBRCNT}, #{REFGRPID}
                , #{GRPWIDTH}, #{GRPHEIGHT}, #{GRPPADDING}, #{BRYN}, #{COLSIZETYPE}
                , #{LEGENDALIGN}, date_format(sysdate(),'%Y%m%d%H%i%s')
            )
        ";
    
        $stmt = makeStmt($db,$sql,$coltype,$map);
        if(!$stmt)JsonMsg("500","1400","SQL makeStmt 실패 했습니다.");
        if(!$stmt->execute())JsonMsg("500","1400","stmt 실행 실패" . $dtmt->errno . " -> " . $stmt->error);
        $toArr["PGMGRP"][$i]["GRPSEQ"] = $db->insert_id;
        $stmt->close();


        //500 FNC 넣기
        for($t=0;$t<count($toArr["PGMGRP"][$i]["PGMFNC"]);$t++){
            $fncs = $toArr["PGMGRP"][$i]["PGMFNC"][$t];

            $map["GRPSEQ"]       = $toArr["PGMGRP"][$i]["GRPSEQ"];
            $map["FNCID"]        = $fncs["FNCID"];
            $map["FNCCD"]        = $fncs["FNCCD"];
            $map["FNCNM"]        = $fncs["FNCNM"];
            $map["FNCTYPE"]      = $fncs["FNCTYPE"];
            $map["FNCORD"]       = $fncs["FNCORD"];
            $map["USEYN"]        = $fncs["USEYN"];

            $coltype = "iiiss ssis";
            $sql = "
                insert into CG_PGMFNC (
                    PJTSEQ, PGMSEQ, GRPSEQ, FNCID, FNCCD
                    , FNCNM, FNCTYPE, FNCORD, USEYN
                    , ADDDT
                ) values (
                    #{PJTSEQ}, #{PGMSEQ}, #{GRPSEQ}, #{FNCID}, #{FNCCD}
                    ,#{FNCNM}, #{FNCTYPE}, #{FNCORD}, #{USEYN}
                    , date_format(sysdate(),'%Y%m%d%H%i%s')
                )
            ";

            $stmt = makeStmt($db,$sql,$coltype,$map);
            if(!$stmt)JsonMsg("500","1500","SQL makeStmt 실패 했습니다.");
            if(!$stmt->execute())JsonMsg("500","1500","stmt 실행 실패" . $dtmt->errno . " -> " . $stmt->error);
            $toArr["PGMGRP"][$i]["PGMFNC"][$t]["FNCSEQ"] = $db->insert_id;
            $stmt->close();

            //600 SVC가져오기
            for($u=0;$u<count($toArr["PGMGRP"][$i]["PGMFNC"][$t]["PGMSVC"]);$u++){
                $svcs = $toArr["PGMGRP"][$i]["PGMFNC"][$t]["PGMSVC"][$u];
    
                $map["FNCSEQ"]       = $toArr["PGMGRP"][$i]["PGMFNC"][$t]["FNCSEQ"];
                $map["SVCGRPID"]     = $svcs["SVCGRPID"];
                $map["ORD"]          = $svcs["ORD"];
    
                $coltype = "iiiis i";
                $sql = "
                    insert into CG_PGMSVC (
                        PJTSEQ, PGMSEQ, GRPSEQ, FNCSEQ, SVCGRPID
                        , ORD, ADDDT 
                    ) values (
                        #{PJTSEQ}, #{PGMSEQ}, #{GRPSEQ}, #{FNCSEQ}, #{SVCGRPID}
                        , #{ORD} 
                        , date_format(sysdate(),'%Y%m%d%H%i%s')
                    )
                ";
    
                $stmt = makeStmt($db,$sql,$coltype,$map);
                if(!$stmt)JsonMsg("500","1600","SQL makeStmt 실패 했습니다.");
                if(!$stmt->execute())JsonMsg("500","1600","stmt 실행 실패" . $dtmt->errno . " -> " . $stmt->error);
                $toArr["PGMGRP"][$i]["PGMFNC"][$t]["PGMSVC"][$u]["SVCSEQ"] = $db->insert_id;
                $stmt->close();


                //700 SQLR 넣기
                for($v=0;$v<count($toArr["PGMGRP"][$i]["PGMFNC"][$t]["PGMSVC"][$u]["PGMSQLR"]);$v++){
                    $sqlrs = $toArr["PGMGRP"][$i]["PGMFNC"][$t]["PGMSVC"][$u]["PGMSQLR"][$v];
        
                    $map["SVCSEQ"]  = $toArr["PGMGRP"][$i]["PGMFNC"][$t]["PGMSVC"][$u]["SVCSEQ"];
                    $map["SQLID"]   = $sqlrs["SQLID"];
                    $map["ORD"]     = $sqlrs["ORD"];
        
                    $coltype = "iiisi";
                    $sql = "
                        insert into CG_PGMSQLR (
                            SVCSEQ, PJTSEQ, PGMSEQ, SQLID, ORD
                            , ADDDT
                        ) values (
                            #{SVCSEQ}, #{PJTSEQ}, #{PGMSEQ}, #{SQLID}, #{ORD}
                            , date_format(sysdate(),'%Y%m%d%H%i%s')
                        )
                    ";
        
                    $stmt = makeStmt($db,$sql,$coltype,$map);
                    if(!$stmt)JsonMsg("500","1700","SQL makeStmt 실패 했습니다.");
                    if(!$stmt->execute())JsonMsg("500","1700","stmt 실행 실패" . $dtmt->errno . " -> " . $stmt->error);
                    //$toArr["PGMGRP"][$i]["PGMFNC"][$t]["PGMSVC"][$u]["SVCSEQ"] = $db->insert_id;
                    $stmt->close();
                }

            }

        }



        //800 IO 넣기
        for($t=0;$t<count($toArr["PGMGRP"][$i]["PGMIO"]);$t++){
            $ios = $toArr["PGMGRP"][$i]["PGMIO"][$t];

            $map["GRPSEQ"]       = $toArr["PGMGRP"][$i]["GRPSEQ"];
            $map["COLORD"]        = $ios["COLORD"];
            $map["COLID"]        = $ios["COLID"];
            $map["COLNM"]        = $ios["COLNM"];
            $map["DATATYPE"]        = $ios["DATATYPE"];
            $map["VALIDSEQ"]        = $ios["VALIDSEQ"];
            $map["DATASIZE"]        = $ios["DATASIZE"];
            $map["OBJTYPE"]        = $ios["OBJTYPE"];
            $map["POPUP"]        = $ios["POPUP"];
            $map["KEYYN"]        = $ios["KEYYN"];
            $map["SEQYN"]        = $ios["SEQYN"];
            $map["LBLHIDDENYN"]        = $ios["LBLHIDDENYN"];
            $map["LBLWIDTH"]        = $ios["LBLWIDTH"];
            $map["LBLALIGN"]        = $ios["LBLALIGN"];
            $map["OBJWIDTH"]        = $ios["OBJWIDTH"];
            $map["OBJHEIGHT"]        = $ios["OBJHEIGHT"];
            $map["OBJALIGN"]        = $ios["OBJALIGN"];
            $map["HIDDENYN"]        = $ios["HIDDENYN"];
            $map["EDITYN"]        = $ios["EDITYN"];
            $map["FNINIT"]        = $ios["FNINIT"];
            $map["BRYN"]        = $ios["BRYN"];


            $coltype = "iiiis ssiis sssss sssss sss";
            $sql = "
                insert into CG_PGMIO (
                    PJTSEQ, PGMSEQ, GRPSEQ, COLORD, COLID
                    , COLNM, DATATYPE, VALIDSEQ, DATASIZE, OBJTYPE
                    , POPUP, KEYYN, SEQYN, LBLHIDDENYN, LBLWIDTH
                    , LBLALIGN, OBJWIDTH, OBJHEIGHT, OBJALIGN, HIDDENYN
                    , EDITYN, FNINIT, BRYN, ADDDT, ADDID
                ) values (
                    #{PJTSEQ}, #{PGMSEQ}, #{GRPSEQ}, #{COLORD}, #{COLID}
                    ,#{COLNM}, #{DATATYPE}, #{VALIDSEQ}, #{DATASIZE}, #{OBJTYPE}
                    ,#{POPUP}, #{KEYYN}, #{SEQYN}, #{LBLHIDDENYN}, #{LBLWIDTH}
                    ,#{LBLALIGN}, #{OBJWIDTH}, #{OBJHEIGHT}, #{OBJALIGN}, #{HIDDENYN}
                    ,#{EDITYN}, #{FNINIT}, #{BRYN}, date_format(sysdate(),'%Y%m%d%H%i%s'), 0
                )
            ";

            $stmt = makeStmt($db,$sql,$coltype,$map);
            if(!$stmt)JsonMsg("500","1800","SQL makeStmt 실패 했습니다.");
            if(!$stmt->execute())JsonMsg("500","1800","stmt 실행 실패" . $dtmt->errno . " -> " . $stmt->error);
            //$toArr["PGMGRP"][$i]["PGMFNC"][$t]["FNCSEQ"] = $db->insert_id;
            $stmt->close();
        }

        //900 INHERIT 넣기
        for($t=0;$t<count($toArr["PGMGRP"][$i]["PGMINHERIT"]);$t++){
            $inherits = $toArr["PGMGRP"][$i]["PGMINHERIT"][$t];

            $map["GRPSEQ"]  = $toArr["PGMGRP"][$i]["GRPSEQ"];
            $map["COLID"]        = $inherits["COLID"];
            $map["CHILDGRPID"]        = $inherits["CHILDGRPID"];

            $coltype = "iiiss";
            $sql = "
                insert into CG_PGMINHERIT (
                    PJTSEQ, PGMSEQ, GRPSEQ, COLID, CHILDGRPID
                    , ADDDT
                ) values (
                    #{PJTSEQ}, #{PGMSEQ}, #{GRPSEQ}, #{COLID}, #{CHILDGRPID}
                    , date_format(sysdate(),'%Y%m%d%H%i%s')
                )
            ";

            $stmt = makeStmt($db,$sql,$coltype,$map);
            if(!$stmt)JsonMsg("500","1900","SQL makeStmt 실패 했습니다.");
            if(!$stmt->execute())JsonMsg("500","1900","stmt 실행 실패" . $dtmt->errno . " -> " . $stmt->error);
            //$toArr["PGMGRP"][$i]["PGMFNC"][$t]["FNCSEQ"] = $db->insert_id;
            $stmt->close();
        }

    }



    $db->close();


    JsonMsg("200","100","정상적으로 Copy 성공하였습니다.");

    
?>