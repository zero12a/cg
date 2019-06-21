<?php 

    header("Content-Type: text/html; charset=UTF-8");
    header("Cache-Control:no-cache");
    header("Pragma:no-cache");

    require_once("./include/incUtil.php");
    require_once("./incConfig.php");
    require_once("./include/incUtil.php");
    require_once("./include/incDB.php");

    //ServerViewTxt("N","N","Y","Y");
    $db["cg"]=db_m_open();


    //그룹ID받기
    $F_GRPID = $_GET['F_GRPID'];
    $F_PJTID = $_GET['F_PJTID'];
    $F_OBJTYPE = $_GET['F_OBJTYPE'];
    $F_DT_TYPE = $_GET['F_DT_TYPE'];
    $F_START_DT = str_replace("-","",$_GET['F_START_DT']); //날짜 타입은 - 제거
    $F_END_DT = str_replace("-","",$_GET['F_END_DT']); //날짜 타입은 - 제거

    //컬럼ROW받기 (REFGRID의 컬럼 정보 받기)
    $G1_OBJTYPE = $_GET['G1_OBJTYPE'];
    $G1_LBLTXT = $_GET['G1_LBLTXT'];
    $G1_OBJTXT = $_GET['G1_OBJTXT'];
    $G1_SRCTXT = $_GET['G1_SRCTXT'];
    $G1_SPTTXT = $_GET['G1_SPTTXT'];
    $G1_INPUT = $_GET['G1_INPUT'];
    $G1_PARAM = $_GET['G1_PARAM'];
    $G1_SRCTYPE = $_GET['G1_SRCTYPE'];

    $G2_OBJDSEQ = $_POST['G2_OBJDSEQ'];



    //그룹ID받기
    $REQ["F_GRPID"] = $_GET['F_GRPID'];
    $REQ["F_PJTID"] = $_POST['F_PJTID'];
    $REQ["F_FILETYPE"] = $_POST['F_FILETYPE'];
    $REQ["F_OBJTYPE"] = $_POST['F_OBJTYPE'];
    $REQ["F_DT_TYPE"] = $_POST['F_DT_TYPE'];
    $REQ["F_START_DT"] = str_replace("-","",$_POST['F_START_DT']); //날짜 타입은 - 제거
    $REQ["F_END_DT"] = str_replace("-","",$_POST['F_END_DT']); //날짜 타입은 - 제거

    //컬럼ROW받기 (REFGRID의 컬럼 정보 받기)
    $REQ["G1_OBJTYPE"] = $_POST['G1_OBJTYPE'];
    $REQ["G1_LBLTXT"] = $_GET['G1_LBLTXT'];
    $REQ["G1_OBJTXT"] = $_GET['G1_OBJTXT'];
    $REQ["G1_SRCTXT"] = $_GET['G1_SRCTXT'];
    $REQ["G1_SPTTXT"] = $_GET['G1_SPTTXT'];
    $REQ["G1_INPUT"] = $_GET['G1_INPUT'];
    $REQ["G1_PARAM"] = $_GET['G1_PARAM'];
    $REQ["G1_SRCTYPE"] = $_GET['G1_SRCTYPE'];

    $REQ["G2_OBJDSEQ"] = $_POST['G2_OBJDSEQ'];
    $REQ["G3_OBJASEQ"] = $_POST['G3_OBJASEQ'];


    //폼뷰
    $REQ["OBJTYPE"]      = $_POST['OBJTYPE'];
    $REQ["STARTTXT"]     = $_POST['STARTTXT'];
    $REQ["LBLSTARTTXT"]  = $_POST['LBLSTARTTXT'];
    $REQ["LBLTXT"]       = $_POST['LBLTXT'];
    $REQ["LBLENDTXT"]    = $_POST['LBLENDTXT'];
    $REQ["OBJSTARTTXT"]  = $_POST['OBJSTARTTXT'];
    $REQ["OBJTXT"]       = $_POST['OBJTXT'];
    $REQ["OBJENDTXT"]    = $_POST['OBJENDTXT'];
    $REQ["ENDTXT"]       = $_POST['ENDTXT'];
    $REQ["USEYN"]        = $_POST['USEYN'];


    $REQ["G1_CRUD_MODE"]    = $_GET['G1_CRUD_MODE'];
    $REQ["G2_CRUD_MODE"]    = $_GET['G2_CRUD_MODE'];
    $REQ["G3_CRUD_MODE"]    = $_GET['G3_CRUD_MODE'];
    $REQ["G4_CRUD_MODE"]    = $_GET['G4_CRUD_MODE'];
    $REQ["G5_CRUD_MODE"]    = $_GET['G5_CRUD_MODE'];


if($REQ["F_GRPID"] == "1" && $REQ["G1_CRUD_MODE"] == "read"){

    $to_coltype = "s";
    alog("        to_coltype : " . $to_coltype);
    $sql = "
          select
            OBJTYPE as OLD_OBJTYPE,OBJTYPE,a.USEYN,a.ADDDT,a.MODDT
          from CG_OBJINFO a
		  where a.DELYN='N' 
          ";
    if($REQ["F_OBJTYPE"] != "") {
        $sql .= " and OBJTYPE = #F_OBJTYPE# ";
        $to_coltype .= "s";
    }




    //V_GRPNM : 팀별 현황 (보안취약점 갯수)
    $GRID["SQL"]["R"]["FNCTYPE"] = "R";
    $GRID["SQL"]["R"]["SQLTXT"] = "
        select
            OBJTYPE as OLD_OBJTYPE,OBJTYPE,a.USEYN,a.ADDDT,a.MODDT
        from CG_OBJINFO a
        where a.DELYN='N' 
        ";
    $GRID["SQL"]["R"]["BINDTYPE"] = $to_coltype;
    $GRID["SQL"]["R"]["SVRID"] = "cg";
    $GRID["COLCRYPT"] = array();//xml컬럼 자동으로 cdata 붙이기.

    $rtnVal = makeGridSearchJson($GRID,$db);

    //처리 결과 리턴
    $rtnVal->RTN_CD = "200";
    $rtnVal->ERR_CD = "200";
    echo json_encode($rtnVal);
    
    $db["cg"]->close();

}else if($REQ["F_GRPID"] == "1"){
    alog("---------------GRP G1 ---------------------START");
    alog("        G1_CRUD_MODE : " .$G1_CRUD_MODE);
    alog("        xmldata : " .$_POST["xmldata"]);


    $GRID["XML"] = getXml2Array($_POST["xmldata"]);//

    $GRID["COLORD"] = "OLD_OBJTYPE,OBJTYPE,USEYN,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)

    $GRID["COLCRYPT"] = array();
    $GRID["KEYCOLID"] = "OBJTYPE";  //KEY컬럼 COLID, 0
    $GRID["SEQYN"] = "N";  //시퀀스 컬럼 유무

    $GRID["SQL"]["C"]["SQLTXT"] = "
                insert into CG_OBJINFO (
                    OBJTYPE,USEYN
                    ,ADDDT
                ) values (
                    #{OBJTYPE},#{USEYN}
                    ,date_format(sysdate(),'%Y%m%d%H%i%s')
                )
    ";
    $GRID["SQL"]["C"]["BINDTYPE"] = "ss";
    $GRID["SQL"]["C"]["SVRID"] = "cg";

    $GRID["SQL"]["D"]["SQLTXT"] = "update   CG_OBJINFO set DELYN='Y' where OBJTYPE = #{OBJTYPE} ";
    $GRID["SQL"]["D"]["BINDTYPE"] = "s";
    $GRID["SQL"]["D"]["SVRID"] = "cg";

    $GRID["SQL"]["U"]["SQLTXT"] = "
                update CG_OBJINFO set
                    OBJTYPE = #{OBJTYPE}, USEYN = #{USEYN}
                    , MODDT =date_format(sysdate(),'%Y%m%d%H%i%s')
                where OBJTYPE = #{OLD_OBJTYPE}
    ";
    $GRID["SQL"]["U"]["BINDTYPE"] = "ss s";
    $GRID["SQL"]["U"]["SVRID"] = "cg";


    $rtnVal = makeGridSaveJson($GRID,$db);

    $rtnVal->RTN_CD = "200";
    $rtnVal->ERR_CD = "200";
    echo json_encode($rtnVal);

    $db["cg"]->close();
}







if($REQ["F_GRPID"] == "2" && $REQ["G2_CRUD_MODE"] == "read"){
    alog("---------------GRP G2 ---------------------START");
    alog("        G2_CRUD_MODE : " .$REQ["G2_CRUD_MODE"]);	
	$add_sql = "";
    $to_coltype = "s";
    if($REQ["F_FILETYPE"] != "") {
        $add_sql = " and FILETYPE = #{F_FILETYPE} ";
        $to_coltype .= "s";
    }
    //V_GRPNM : 팀별 현황 (보안취약점 갯수)
    $GRID["SQL"]["R"]["FNCTYPE"] = "R";
    $GRID["SQL"]["R"]["SQLTXT"] = "
            select
                OBJDSEQ,OBJTYPE,FILETYPE,OBJVAL,OBJDORD,OBJVALTYPE,UILANG,OBJVALNM,OBJDESC,SRCTXT,SPTTXT,INPUT,PARAM,SRCTYPE,FILTER,a.ADDDT,a.MODDT,DEBUGYN
            from 
            CG_OBJINFOD a 		  
            where OBJTYPE = #{G1_OBJTYPE} $add_sql
            order by OBJDORD asc
        ";
    $GRID["SQL"]["R"]["BINDTYPE"] = $to_coltype;
    $GRID["SQL"]["R"]["SVRID"] = "cg";
    $GRID["COLCRYPT"] = array();//xml컬럼 자동으로 cdata 붙이기.

    $rtnVal = makeGridSearchJson($GRID,$db);

    //처리 결과 리턴
    $rtnVal->RTN_CD = "200";
    $rtnVal->ERR_CD = "200";
    echo json_encode($rtnVal);
    
    $db["cg"]->close();

}else if($REQ["F_GRPID"] == "2"){
    alog("---------------GRP G2 ---------------------START");
    alog("        G2_CRUD_MODE : " .$REQ["G2_CRUD_MODE"]);
    alog("        xmldata : " .$_POST["xmldata"]);

    $GRID["XML"] = getXml2Array($_POST["xmldata"]);//

    $GRID["COLORD"] = "OBJDSEQ,OBJTYPE,FILETYPE,OBJVAL,OBJDORD,OBJVALTYPE,UILANG,OBJVALNM,OBJDESC,SRCTXT,SPTTXT,INPUT,PARAM,SRCTYPE,FILTER,ADDDT,MODDT,DEBUGYN"; //그리드 컬럼순서(Hidden컬럼포함)

    $GRID["COLCRYPT"] = array();
    $GRID["KEYCOLID"] = "OBJDSEQ";  //KEY컬럼 COLID, 0
    $GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무

    $GRID["SQL"]["C"]["SQLTXT"] = "
               insert into CG_OBJINFOD (
                                    OBJTYPE,FILETYPE,OBJVAL,OBJDORD,OBJVALTYPE
                                    ,UILANG,OBJVALNM,OBJDESC,SRCTXT,SPTTXT
                                    ,INPUT,PARAM,SRCTYPE,FILTER,DEBUGYN
                                    ,ADDDT
               ) values (
                                    #{OBJTYPE},#{FILETYPE},#{OBJVAL},#{OBJDORD},#{OBJVALTYPE}
                                    ,#{UILANG},#{OBJVALNM},#{OBJDESC},#{SRCTXT},#{SPTTXT}
                                    ,#{INPUT},#{PARAM},#{SRCTYPE},#{FILTER},#{DEBUGYN}
                                    ,date_format(sysdate(),'%Y%m%d%H%i%s')
               )
    ";
    $GRID["SQL"]["C"]["BINDTYPE"] = "sssis sssss sssss";
    $GRID["SQL"]["C"]["SVRID"] = "cg";

    $GRID["SQL"]["D"]["SQLTXT"] = " delete from CG_OBJINFOD where  OBJTYPE = #{OBJTYPE} and OBJDSEQ = #{OBJDSEQ} ";
    $GRID["SQL"]["D"]["BINDTYPE"] = "si";
    $GRID["SQL"]["D"]["SVRID"] = "cg";

    $GRID["SQL"]["U"]["SQLTXT"] = "
               update CG_OBJINFOD set
                    OBJTYPE = #{OBJTYPE}, FILETYPE = #{FILETYPE}, OBJVAL = #{OBJVAL}, OBJVALNM = #{OBJVALNM}, OBJDORD = #{OBJDORD}
					, OBJVALTYPE = #{OBJVALTYPE}, UILANG = #{UILANG},  OBJDESC = #{OBJDESC}, SRCTXT = #{SRCTXT}, SPTTXT = #{SPTTXT}
					, INPUT = #{INPUT}, PARAM = #{PARAM}, SRCTYPE = #{SRCTYPE}, FILTER = #{FILTER}, DEBUGYN = #{DEBUGYN}
                    ,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
                where OBJDSEQ = #{OBJDSEQ}
    ";
    $GRID["SQL"]["U"]["BINDTYPE"] = "ssssi sssss sssss i";
    $GRID["SQL"]["U"]["SVRID"] = "cg";


    
    $rtnVal = makeGridSaveJson($GRID,$db);

    $rtnVal->RTN_CD = "200";
    $rtnVal->ERR_CD = "200";
    echo json_encode($rtnVal);

	$db["cg"]->close();
}







if($REQ["F_GRPID"] == "3" && $REQ["G3_CRUD_MODE"] == "read"){


    $GRID["SQL"]["R"]["FNCTYPE"] = "R";
    $GRID["SQL"]["R"]["SQLTXT"] = "
        select
            OBJASEQ,OBJTYPE,OBJDSEQ,OBJAORD,OBJDESC,SRCTXT,SPTTXT,INPUT,PARAM,SRCTYPE,FILTER,a.ADDDT,a.MODDT,DEBUGYN
        from CG_OBJINFOA a
        where  OBJDSEQ = #{G2_OBJDSEQ}
        order by OBJAORD asc
        ";
    $GRID["SQL"]["R"]["BINDTYPE"] = "i";
    $GRID["SQL"]["R"]["SVRID"] = "cg";
    $GRID["COLCRYPT"] = array();//xml컬럼 자동으로 cdata 붙이기.

    $rtnVal = makeGridSearchJson($GRID,$db);

    //처리 결과 리턴
    $rtnVal->RTN_CD = "200";
    $rtnVal->ERR_CD = "200";
    echo json_encode($rtnVal);
    
    $db["cg"]->close();


}else if($REQ["F_GRPID"] == "3"){
    alog("---------------GRP G3 ---------------------START");
    alog("        G3_CRUD_MODE : " .$REQ["G3_CRUD_MODE"]);
    alog("        xmldata : " .$_POST["xmldata"]);

    $GRID["XML"] = getXml2Array($_POST["xmldata"]);//

    $GRID["COLORD"] = "OBJASEQ,OBJTYPE,OBJDSEQ,OBJAORD,OBJDESC,SRCTXT,SPTTXT,INPUT,PARAM,SRCTYPE,FILTER,ADDDT,MODDT,DEBUGYN"; //그리드 컬럼순서(Hidden컬럼포함)

    $GRID["COLCRYPT"] = array();
    $GRID["KEYCOLID"] = "OBJDSEQ";  //KEY컬럼 COLID, 0
    $GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무

    $GRID["SQL"]["C"]["SQLTXT"] = "
               insert into CG_OBJINFOA (
                                    OBJTYPE,OBJDSEQ,OBJAORD,OBJDESC,SRCTXT
                                    ,SPTTXT,INPUT,PARAM,SRCTYPE,FILTER
                                    ,DEBUGYN
                                    ,ADDDT
               ) values (
                                    #{OBJTYPE},#{OBJDSEQ},#{OBJAORD},#{OBJDESC},#{SRCTXT}
                                    ,#{SPTTXT},#{INPUT},#{PARAM},#{SRCTYPE},#{FILTER}
                                    ,#{DEBUGYN}
                                    ,date_format(sysdate(),'%Y%m%d%H%i%s')
               )
    ";
    $GRID["SQL"]["C"]["BINDTYPE"] = "siiss sssss s";
    $GRID["SQL"]["C"]["SVRID"] = "cg";

    $GRID["SQL"]["D"]["SQLTXT"] = " delete from CG_OBJINFOA where OBJASEQ = #{OBJASEQ} ";
    $GRID["SQL"]["D"]["BINDTYPE"] = "i";
    $GRID["SQL"]["D"]["SVRID"] = "cg";

    $GRID["SQL"]["U"]["SQLTXT"] = "
              update CG_OBJINFOA set
                    OBJTYPE = #{OBJTYPE}, OBJDSEQ = #{OBJDSEQ}, OBJDESC = #{OBJDESC}, OBJAORD = #{OBJAORD}, SRCTXT = #{SRCTXT}
                    , SPTTXT = #{SPTTXT}, INPUT = #{INPUT}, PARAM = #{PARAM}, SRCTYPE = #{SRCTYPE}, FILTER = #{FILTER}
                    , DEBUGYN = #{DEBUGYN}
                    ,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
                where  OBJASEQ = #{OBJASEQ}
    ";
    $GRID["SQL"]["U"]["BINDTYPE"] = "sisis sssss s i";
    $GRID["SQL"]["U"]["SVRID"] = "cg";



    $rtnVal = makeGridSaveJson($GRID,$db);

    $rtnVal->RTN_CD = "200";
    $rtnVal->ERR_CD = "200";
    echo json_encode($rtnVal);

    $db["cg"]->close();

}





if($REQ["F_GRPID"] == "5" && $REQ["G5_CRUD_MODE"] == "read"){
    alog("---------------GRP G5 ---------------------START");

    $GRID["SQL"]["R"]["FNCTYPE"] = "R";
    $GRID["SQL"]["R"]["SQLTXT"] = "
        select
            OBJBSEQ,OBJTYPE,OBJASEQ,OBJBORD,OBJDESC,SRCTXT,SPTTXT,INPUT,PARAM,SRCTYPE,FILTER,a.ADDDT,a.MODDT,DEBUGYN
        from CG_OBJINFOB a
        where  OBJASEQ = #{G3_OBJASEQ}
        order by OBJBORD asc
        ";
    $GRID["SQL"]["R"]["BINDTYPE"] = "i";
    $GRID["SQL"]["R"]["SVRID"] = "cg";
    $GRID["COLCRYPT"] = array();//xml컬럼 자동으로 cdata 붙이기.

    $rtnVal = makeGridSearchJson($GRID,$db);

    //처리 결과 리턴
    $rtnVal->RTN_CD = "200";
    $rtnVal->ERR_CD = "200";
    echo json_encode($rtnVal);
    
    $db["cg"]->close();

}else if($REQ["F_GRPID"] == "5"){
    alog("---------------GRP G5 ---------------------START");
    alog("        G5_CRUD_MODE : " .$REQ["G5_CRUD_MODE"]);
    alog("        xmldata : " .$_POST["xmldata"]);

    $GRID["XML"] = getXml2Array($_POST["xmldata"]);//

    $GRID["COLORD"] = "OBJBSEQ,OBJTYPE,OBJASEQ,OBJBORD,OBJDESC,SRCTXT,SPTTXT,INPUT,PARAM,SRCTYPE,FILTER,ADDDT,MODDT,DEBUGYN"; //그리드 컬럼순서(Hidden컬럼포함)

    $GRID["COLCRYPT"] = array();
    $GRID["KEYCOLID"] = "OBJBSEQ";  //KEY컬럼 COLID, 0
    $GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무


    $GRID["SQL"]["C"]["SQLTXT"] = "
               insert into CG_OBJINFOB (
                                    OBJTYPE,OBJASEQ,OBJBORD,OBJDESC,SRCTXT
                                    ,SPTTXT,INPUT,PARAM,SRCTYPE,FILTER
                                    ,DEBUGYN
                                    ,ADDDT
               ) values (
                                    #{OBJTYPE},#{OBJASEQ},#{OBJBORD},#{OBJDESC},#{SRCTXT}
                                    ,#{SPTTXT},#{INPUT},#{PARAM},#{SRCTYPE},#{FILTER}
                                    ,#{DEBUGYN}
                                    ,date_format(sysdate(),'%Y%m%d%H%i%s')
               )
    ";
    $GRID["SQL"]["C"]["BINDTYPE"] = "siiss sssss s";
    $GRID["SQL"]["C"]["SVRID"] = "cg";

    $GRID["SQL"]["D"]["SQLTXT"] = " delete from CG_OBJINFOB where  OBJBSEQ = #{OBJBSEQ} ";
    $GRID["SQL"]["D"]["BINDTYPE"] = "i";
    $GRID["SQL"]["D"]["SVRID"] = "cg";

    $GRID["SQL"]["U"]["SQLTXT"] = "
              update CG_OBJINFOB set
                    OBJTYPE = #{OBJTYPE}, OBJDESC = #{OBJDESC}, OBJBORD = #{OBJBORD}, SRCTXT = #{SRCTXT}, SPTTXT = #{SPTTXT}
					, INPUT = #{INPUT}, PARAM = #{PARAM}, SRCTYPE = #{SRCTYPE}, FILTER = #{FILTER}, DEBUGYN = #{DEBUGYN}
                    ,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
                where OBJBSEQ = #{OBJBSEQ}
    ";
    $GRID["SQL"]["U"]["BINDTYPE"] = "ssiss sssss i";
    $GRID["SQL"]["U"]["SVRID"] = "cg";

    $rtnVal = makeGridSaveJson($GRID,$db);

    $rtnVal->RTN_CD = "200";
    $rtnVal->ERR_CD = "200";
    echo json_encode($rtnVal);

    $db["cg"]->close();
}



?>