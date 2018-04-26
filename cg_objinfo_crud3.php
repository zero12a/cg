<?php 

    header("Content-Type: text/html; charset=UTF-8");
    header("Cache-Control:no-cache");
    header("Pragma:no-cache");

    require_once("./include/incUtil.php");
    require_once("./incConfig.php");
    require_once("./include/incUtil.php");
    require_once("./include/incDB.php");

    //ServerViewTxt("N","N","Y","Y");
    $db=db_m_open();


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

    $G2_OBJDSEQ = $_GET['G2_OBJDSEQ'];



    //그룹ID받기
    $REQ["F_GRPID"] = $_GET['F_GRPID'];
    $REQ["F_PJTID"] = $_GET['F_PJTID'];
    $REQ["F_FILETYPE"] = $_GET['F_FILETYPE'];
    $REQ["F_OBJTYPE"] = $_GET['F_OBJTYPE'];
    $REQ["F_DT_TYPE"] = $_GET['F_DT_TYPE'];
    $REQ["F_START_DT"] = str_replace("-","",$_GET['F_START_DT']); //날짜 타입은 - 제거
    $REQ["F_END_DT"] = str_replace("-","",$_GET['F_END_DT']); //날짜 타입은 - 제거

    //컬럼ROW받기 (REFGRID의 컬럼 정보 받기)
    $REQ["G1_OBJTYPE"] = $_GET['G1_OBJTYPE'];
    $REQ["G1_LBLTXT"] = $_GET['G1_LBLTXT'];
    $REQ["G1_OBJTXT"] = $_GET['G1_OBJTXT'];
    $REQ["G1_SRCTXT"] = $_GET['G1_SRCTXT'];
    $REQ["G1_SPTTXT"] = $_GET['G1_SPTTXT'];
    $REQ["G1_INPUT"] = $_GET['G1_INPUT'];
    $REQ["G1_PARAM"] = $_GET['G1_PARAM'];
    $REQ["G1_SRCTYPE"] = $_GET['G1_SRCTYPE'];

    $REQ["G2_OBJDSEQ"] = $_GET['G2_OBJDSEQ'];
    $REQ["G3_OBJASEQ"] = $_GET['G3_OBJASEQ'];


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


if($REQ["F_GRPID"] == "4" && $REQ["F4_CRUD_MODE"] == "read"){

    $to_coltype = "ss";
    alog("        to_coltype : " . $to_coltype);
    $sql = "
          select
            a.PJTSEQ,OBJTYPE,STARTTXT,LBLSTARTTXT,LBLTXT,LBLENDTXT,OBJSTARTTXT,OBJTXT,OBJENDTXT,ENDTXT,USEYN,a.ADDDT,a.MODDT
          from CG_OBJINFO a 
			join CG_PJTINFO b on a.PJTSEQ=b.PJTSEQ
		  where a.DELYN='N' and b.PJTID = #F_PJTID# and a.OBJTYPE = #G1_OBJTYPE#
          limit 1
          ";

    alog("        selected : " . $sql);
    $stmt = make_stmt($db,$sql, $to_coltype, $REQ);
    if(!$stmt)  JsonMsg("500","100","stmt 생성 실패" . $db->errno . " -> " . $db->error);

    echo make_detail_read_json($stmt);
    $db->close();

}else if($REQ["F_GRPID"] == "4"){
    alog("---------------GRP G4 ---------------------START");
    alog("        F4_CRUD_MODE : " .$F4_CRUD_MODE);
    alog("        xmldata : " .$_POST["xmldata"]);
	
	$xml_array = getXml2Array($_POST["xmldata"]);


    $sql_inserted = "
                insert into CG_OBJINFO (
                    PJTSEQ,OBJTYPE,LBLTXT,OBJTXT,USEYN
                    ,STARTTXT,ENDTXT,LBLSTARTTXT,LBLENDTXT,OBJSTARTTXT
                    ,OBJENDTXT
                    ,ADDDT
                ) values (
                    #PJTSEQ#,#OBJTYPE#,#LBLTXT#,#OBJTXT#,#USEYN#
                    ,#STARTTXT#,#ENDTXT#,#LBLSTARTTXT#,#LBLENDTXT#,#OBJSTARTTXT#
                    ,#OBJENDTXT#
                    ,date_format(sysdate(),'%Y%m%d%H%i%s')
                )
    ";
    $sql_inserted_coltype = "issss sssss s";

    $sql_deleted = "update  CG_OBJINFO set DELYN='Y' where PJTSEQ  = ( SELECT PJTSEQ FROM CG_PJTINFO WHERE PJTID = #F_PJTID# ) and OBJTYPE = #OBJTYPE# ";
    $sql_deleted_coltype = "ss";

    $sql_updated = "
                update CG_OBJINFO set
                    LBLTXT = #LBLTXT#,OBJTXT = #OBJTXT#, USEYN = #USEYN#
                    ,STARTTXT = #STARTTXT#, ENDTXT = #ENDTXT#,LBLSTARTTXT = #LBLSTARTTXT#,LBLENDTXT = #LBLENDTXT#,OBJSTARTTXT = #OBJSTARTTXT#
                    ,OBJENDTXT = #OBJENDTXT#
                    , MODDT =date_format(sysdate(),'%Y%m%d%H%i%s')
                where PJTSEQ = #PJTSEQ# and OBJTYPE = #OBJTYPE#
    ";
    $sql_updated_coltype = "sssss ssssi s";


    $sql=null;
    $coltype=null;
    if($REQ["F4_CRUD_MODE"] == "new"){
        $sql = $sql_inserted;
        $coltype = $sql_inserted_coltype;
    }
    if($REQ["F4_CRUD_MODE"] == "update"){
        $sql = $sql_updated;
        $coltype = $sql_updated_coltype;
    }
    if($REQ["F4_CRUD_MODE"] == "delete"){
        $sql = $sql_deleted;
        $coltype = $sql_deleted_coltype;
    }

    echo make_detail_save_json($db,$REQ,$sql,$coltype);

    //echo "\n\n\n xml to array : ";
    //var_dump($xml_array);
    $db->close();
}





if($REQ["F_GRPID"] == "1" && $REQ["G1_CRUD_MODE"] == "read"){

    $to_coltype = "s";
    alog("        to_coltype : " . $to_coltype);
    $sql = "
          select
            a.PJTSEQ,OBJTYPE as OLD_OBJTYPE,OBJTYPE,a.USEYN,a.ADDDT,a.MODDT
          from CG_OBJINFO a
			join CG_PJTINFO b on a.PJTSEQ = b.PJTSEQ
		  where a.DELYN='N' and b.PJTID = #F_PJTID# 
          ";
    if($REQ["F_OBJTYPE"] != "") {
        $sql .= " and OBJTYPE = #F_OBJTYPE# ";
        $to_coltype .= "s";
    }


    alog("        selected : " );
    $stmt = make_stmt($db,$sql, $to_coltype, $REQ);
    if(!$stmt) JsonMsg("500","100","stmt 생성 실패" . $db->errno . " -> " . $db->error);

    echo make_grid_read_json($stmt,1);
    $db->close();

}else if($REQ["F_GRPID"] == "1"){
    alog("---------------GRP G1 ---------------------START");
    alog("        G1_CRUD_MODE : " .$G1_CRUD_MODE);
    alog("        jsondata : " .$_POST["jsondata"]);


	$json_array = json_decode($_POST["jsondata"],true);
	alog("	json_array.COLS count = " . count($json_array["REQ_DATA"]["COLS"]) );
	alog("	json_array.ROWS count = " . count($json_array["REQ_DATA"]["ROWS"]) );
	alog("	json_array.error : " . json_last_error()); // 4 (JSON_ERROR_SYNTAX)
	alog("	json_array.error_msg : " .json_last_error_msg()); // unexpected character 

	//$xml_array = getXml2Array($_POST["xmldata"]);
    //$colord = "OLD_OBJTYPE,OBJTYPE,STARTTXT,LBLSTARTTXT,LBLTXT,LBLENDTXT,OBJSTARTTXT,OBJTXT,OBJENDTXT,ENDTXT,USEYN,ADDDT,MODDT";


    $sql_inserted = "
                insert into CG_OBJINFO (
                    PJTSEQ,OBJTYPE,USEYN
                    ,ADDDT
                ) values (
                    #PJTSEQ#,#OBJTYPE#,#USEYN#
                    ,date_format(sysdate(),'%Y%m%d%H%i%s')
                )
    ";
    $sql_inserted_coltype = "iss";

    $sql_deleted = "update   CG_OBJINFO set DELYN='Y' where PJTSEQ = #PJTSEQ# and OBJTYPE = #OBJTYPE# ";
    $sql_deleted_coltype = "ss";

    $sql_updated = "
                update CG_OBJINFO set
                    OBJTYPE = #OBJTYPE#, USEYN = #USEYN#
                    , MODDT =date_format(sysdate(),'%Y%m%d%H%i%s')
                where PJTSEQ = #PJTSEQ# and OBJTYPE = #OLD_OBJTYPE#
    ";
    $sql_updated_coltype = "ss is";


    //echo make_grid_save_json($db,$REQ,$colord,$xml_array,$sql_inserted,$sql_inserted_coltype,$sql_deleted,$sql_deleted_coltype,$sql_updated,$sql_updated_coltype);
    
	echo make_grid_save_json_new($db,$REQ,$json_array["REQ_DATA"]["COLS"],$json_array["REQ_DATA"]["ROWS"]
		,$sql_inserted,$sql_inserted_coltype,$sql_deleted,$sql_deleted_coltype,$sql_updated,$sql_updated_coltype,$ai_yn='N',$key_colid="OBJTYPE");


    //echo "\n\n\n xml to array : ";
    //var_dump($xml_array);
    $db->close();
}







if($REQ["F_GRPID"] == "2" && $REQ["G2_CRUD_MODE"] == "read"){
    alog("---------------GRP G2 ---------------------START");
    alog("        G2_CRUD_MODE : " .$REQ["G2_CRUD_MODE"]);	
	$add_sql = "";
    $to_coltype = "ss";
    if($REQ["F_FILETYPE"] != "") {
        $add_sql = " and FILETYPE = #F_FILETYPE# ";
        $to_coltype .= "s";
    }
    $sql = "
          select
             a.PJTSEQ,OBJDSEQ,OBJTYPE,FILETYPE,OBJVAL,OBJDORD,OBJVALTYPE,UILANG,OBJVALNM,OBJDESC,SRCTXT,SPTTXT,INPUT,PARAM,SRCTYPE,FILTER,a.ADDDT,a.MODDT,DEBUGYN
          from 
			CG_OBJINFOD a 
			join CG_PJTINFO b on a.PJTSEQ = b.PJTSEQ		  
		  where b.PJTID = #F_PJTID# and OBJTYPE = #G1_OBJTYPE# $add_sql
		  order by OBJDORD asc
          ";
    alog("        to_coltype : " . $to_coltype);

    alog("        selected SQL : " . $sql);
    $stmt = make_stmt($db,$sql, $to_coltype, $REQ);
    if(!$stmt)    JsonMsg("500","109","stmt 생성 실패" . $db->errno . " -> " . $db->error);

    echo make_grid_read_json($stmt,1);
    $db->close();

}else if($REQ["F_GRPID"] == "2"){
    alog("---------------GRP G2 ---------------------START");
    alog("        G2_CRUD_MODE : " .$REQ["G2_CRUD_MODE"]);
    alog("        xmldata : " .$_POST["xmldata"]);
    alog("        jsondata : " .$_POST["jsondata"]);

	//$xml_array = getXml2Array($_POST["xmldata"]);
	$json_array = json_decode($_POST["jsondata"],true);


	alog("	json_array.COLS count = " . count($json_array["REQ_DATA"]["COLS"]) );
	alog("	json_array.ROWS count = " . count($json_array["REQ_DATA"]["ROWS"]) );
	alog("	json_array.error : " . json_last_error()); // 4 (JSON_ERROR_SYNTAX)
	alog("	json_array.error_msg : " .json_last_error_msg()); // unexpected character 


    //$colord = "OBJDSEQ,OBJTYPE,FILETYPE,OBJVAL,OBJDORD,OBJVALTYPE,OBJVALNM,OBJDESC,SRCTXT,SPTTXT,INPUT,PARAM,SRCTYPE,FILTER,ADDDT,MODDT";


    $sql_inserted = "
               insert into CG_OBJINFOD (
                                    PJTSEQ,OBJTYPE,FILETYPE,OBJVAL,OBJDORD
									,OBJVALTYPE,UILANG,OBJVALNM,OBJDESC,SRCTXT
									,SPTTXT,INPUT,PARAM,SRCTYPE,FILTER
									,DEBUGYN
                                    ,ADDDT
               ) values (
                                    #PJTSEQ#, #OBJTYPE#,#FILETYPE#,#OBJVAL#,#OBJDORD#
									,#OBJVALTYPE#,#UILANG#,#OBJVALNM#,#OBJDESC#,#SRCTXT#
									,#SPTTXT#,#INPUT#,#PARAM#,#SRCTYPE#,#FILTER#
									,#DEBUGYN#
                                    ,date_format(sysdate(),'%Y%m%d%H%i%s')
               )
    ";
    $sql_inserted_coltype = "isssi sssss sssss s";

    $sql_deleted = " delete from CG_OBJINFOD where PJTSEQ = #PJTSEQ# and OBJTYPE = #G1_OBJTYPE# and OBJDSEQ = #OBJDSEQ# ";
    $sql_deleted_coltype = "ssi";

    $sql_updated = "
               update CG_OBJINFOD set
                    OBJTYPE = #OBJTYPE#, FILETYPE = #FILETYPE#, OBJVAL = #OBJVAL#, OBJVALNM = #OBJVALNM#, OBJDORD = #OBJDORD#
					, OBJVALTYPE = #OBJVALTYPE#, UILANG = #UILANG#,  OBJDESC = #OBJDESC#, SRCTXT = #SRCTXT#, SPTTXT = #SPTTXT#
					, INPUT = #INPUT#, PARAM = #PARAM#, SRCTYPE = #SRCTYPE#, FILTER = #FILTER#, DEBUGYN = #DEBUGYN#
                    ,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
                where PJTSEQ = #PJTSEQ# and OBJDSEQ = #OBJDSEQ#
    ";
    $sql_updated_coltype = "ssssi sssss sssss ii";




    //echo make_grid_save_json($db,$REQ,$colord,$xml_array,$sql_inserted,$sql_inserted_coltype,$sql_deleted,$sql_deleted_coltype,$sql_updated,$sql_updated_coltype,"Y","OBJDSEQ");
	echo make_grid_save_json_new($db,$REQ,$json_array["REQ_DATA"]["COLS"],$json_array["REQ_DATA"]["ROWS"]
		,$sql_inserted,$sql_inserted_coltype,$sql_deleted,$sql_deleted_coltype,$sql_updated,$sql_updated_coltype,"Y","OBJDSEQ");
	
	$db->close();
}







if($REQ["F_GRPID"] == "3" && $REQ["G3_CRUD_MODE"] == "read"){

    $to_coltype = "si";
    alog("        to_coltype : " . $to_coltype);
    $sql = "
          select
            a.PJTSEQ,OBJASEQ,OBJTYPE,OBJDSEQ,OBJAORD,OBJDESC,SRCTXT,SPTTXT,INPUT,PARAM,SRCTYPE,FILTER,a.ADDDT,a.MODDT,DEBUGYN
          from CG_OBJINFOA a
			join CG_PJTINFO b on a.PJTSEQ = b.PJTSEQ
		  where b.PJTID = #F_PJTID# and OBJDSEQ = #G2_OBJDSEQ#
		  order by OBJAORD asc
          ";
    alog("        selected : " );
    $stmt = make_stmt($db,$sql, $to_coltype, $REQ);
    if(!$stmt)    JsonMsg("500","100","stmt 생성 실패" . $db->errno . " -> " . $db->error);

    echo make_grid_read_json($stmt,1);

    $db->close();

}else if($REQ["F_GRPID"] == "3"){
    alog("---------------GRP G3 ---------------------START");
    alog("        G3_CRUD_MODE : " .$REQ["G3_CRUD_MODE"]);
    alog("        xmldata : " .$_POST["xmldata"]);
    alog("        jsondata : " .$_POST["jsondata"]);

	//$tstr = '{"REQ_DATA":"11"}';



    $json_array = json_decode($_POST["jsondata"],true); //true는 stdClass로 리턴
    //$json_array = json_decode($_POST["jsondata"]);

	alog("	json_array.COLS count = " . count($json_array["REQ_DATA"]["COLS"]) );
	alog("	json_array.ROWS count = " . count($json_array["REQ_DATA"]["ROWS"]) );
	alog("	json_array.error : " . json_last_error()); // 4 (JSON_ERROR_SYNTAX)
	alog("	json_array.error_msg : " .json_last_error_msg()); // unexpected character 

	//exit;


    //$colord = "OBJASEQ,OBJTYPE,OBJDSEQ,OBJAORD,OBJDESC,SRCTXT,SPTTXT,INPUT,PARAM,SRCTYPE,FILTER,ADDDT,MODDT";


    $sql_inserted = "
               insert into CG_OBJINFOA (
                                    PJTSEQ,OBJTYPE,OBJDSEQ,OBJAORD,OBJDESC
                                    ,SRCTXT,SPTTXT,INPUT,PARAM,SRCTYPE
									,FILTER,DEBUGYN
                                    ,ADDDT
               ) values (
                                    #PJTSEQ#,#OBJTYPE#,#OBJDSEQ#,#OBJAORD#,#OBJDESC#
                                    ,#SRCTXT#,#SPTTXT#,#INPUT#,#PARAM#,#SRCTYPE#
									,#FILTER#,#DEBUGYN#
                                    ,date_format(sysdate(),'%Y%m%d%H%i%s')
               )
    ";
    $sql_inserted_coltype = "isiis sssss ss";

    $sql_deleted = " delete from CG_OBJINFOA where PJTSEQ = #PJTSEQ# and OBJASEQ = #OBJASEQ# ";
    $sql_deleted_coltype = "ii";

    $sql_updated = "
              update CG_OBJINFOA set
                    OBJTYPE = #OBJTYPE#, OBJDSEQ = #OBJDSEQ#, OBJDESC = #OBJDESC#, OBJAORD = #OBJAORD#, SRCTXT = #SRCTXT#
                    , SPTTXT = #SPTTXT#, INPUT = #INPUT#, PARAM = #PARAM#, SRCTYPE = #SRCTYPE#, FILTER = #FILTER#
                    , DEBUGYN = #DEBUGYN#
                    ,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
                where PJTSEQ = #PJTSEQ# and OBJASEQ = #OBJASEQ#
    ";
    $sql_updated_coltype = "sisis sssss s ii";


    echo make_grid_save_json_new($db,$REQ,$json_array["REQ_DATA"]["COLS"],$json_array["REQ_DATA"]["ROWS"]
		,$sql_inserted,$sql_inserted_coltype,$sql_deleted,$sql_deleted_coltype,$sql_updated,$sql_updated_coltype,"Y","OBJASEQ");

    //echo "\n\n\n xml to array : ";
    //var_dump($xml_array);
    $db->close();
}





if($REQ["F_GRPID"] == "5" && $REQ["G5_CRUD_MODE"] == "read"){
    alog("---------------GRP G5 ---------------------START");
    $to_coltype = "si";
    alog("        to_coltype : " . $to_coltype);
    $sql = "
          select
            a.PJTSEQ,OBJBSEQ,OBJTYPE,OBJASEQ,OBJBORD,OBJDESC,SRCTXT,SPTTXT,INPUT,PARAM,SRCTYPE,FILTER,a.ADDDT,a.MODDT,DEBUGYN
          from CG_OBJINFOB a
			join CG_PJTINFO b on a.PJTSEQ = b.PJTSEQ
		  where b.PJTID = #F_PJTID# and OBJASEQ = #G3_OBJASEQ#
		  order by OBJBORD asc
          ";
    alog("        selected : " );
    $stmt = make_stmt($db,$sql, $to_coltype, $REQ);
    if(!$stmt)    JsonMsg("500","100","stmt 생성 실패" . $db->errno . " -> " . $db->error);

    echo make_grid_read_json($stmt,1);

    $db->close();

}else if($REQ["F_GRPID"] == "5"){
    alog("---------------GRP G5 ---------------------START");
    alog("        G5_CRUD_MODE : " .$REQ["G5_CRUD_MODE"]);
    alog("        xmldata : " .$_POST["xmldata"]);

	//$xml_array = getXml2Array($_POST["xmldata"]);
    //$colord = "OBJBSEQ,OBJTYPE,OBJASEQ,OBJBORD,OBJDESC,SRCTXT,SPTTXT,INPUT,PARAM,SRCTYPE,FILTER,ADDDT,MODDT";

	$json_array = json_decode($_POST["jsondata"],true);
	alog("	json_array.COLS count = " . count($json_array["REQ_DATA"]["COLS"]) );
	alog("	json_array.ROWS count = " . count($json_array["REQ_DATA"]["ROWS"]) );
	alog("	json_array.error : " . json_last_error()); // 4 (JSON_ERROR_SYNTAX)
	alog("	json_array.error_msg : " .json_last_error_msg()); // unexpected character 



    $sql_inserted = "
               insert into CG_OBJINFOB (
                                    PJTSEQ,OBJTYPE,OBJASEQ,OBJBORD,OBJDESC
                                    ,SRCTXT,SPTTXT,INPUT,PARAM,SRCTYPE
									,FILTER,DEBUGYN
                                    ,ADDDT
               ) values (
                                    #PJTSEQ#,#OBJTYPE#,#OBJASEQ#,#OBJBORD#,#OBJDESC#
                                    ,#SRCTXT#,#SPTTXT#,#INPUT#,#PARAM#,#SRCTYPE#
									,#FILTER#,#DEBUGYN#
                                    ,date_format(sysdate(),'%Y%m%d%H%i%s')
               )
    ";
    $sql_inserted_coltype = "isiis sssss ss";

    $sql_deleted = " delete from CG_OBJINFOB where PJTSEQ = #PJTSEQ# and OBJBSEQ = #OBJBSEQ# ";
    $sql_deleted_coltype = "si";

    $sql_updated = "
              update CG_OBJINFOB set
                    OBJTYPE = #OBJTYPE#, OBJDESC = #OBJDESC#, OBJBORD = #OBJBORD#, SRCTXT = #SRCTXT#, SPTTXT = #SPTTXT#
					, INPUT = #INPUT#, PARAM = #PARAM#, SRCTYPE = #SRCTYPE#, FILTER = #FILTER#, DEBUGYN = #DEBUGYN#
                    ,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
                where PJTSEQ = #PJTSEQ# and OBJBSEQ = #OBJBSEQ#
    ";
    $sql_updated_coltype = "ssiss sssss ii";


    //echo make_grid_save_json($db,$REQ,$colord,$xml_array,$sql_inserted,$sql_inserted_coltype,$sql_deleted,$sql_deleted_coltype,$sql_updated,$sql_updated_coltype,"Y","OBJBSEQ");
    echo make_grid_save_json_new($db,$REQ,$json_array["REQ_DATA"]["COLS"],$json_array["REQ_DATA"]["ROWS"]
		,$sql_inserted,$sql_inserted_coltype,$sql_deleted,$sql_deleted_coltype,$sql_updated,$sql_updated_coltype,"Y","OBJBSEQ");

    //echo "\n\n\n xml to array : ";
    //var_dump($xml_array);
    $db->close();
}



?>