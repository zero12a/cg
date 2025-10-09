<?php
    header("Content-Type: text/html; charset=UTF-8");
    header("Cache-Control:no-cache");
    header("Pragma:no-cache");


    require_once("./include/incUtil.php");
    require_once("./incConfig.php");
    require_once("./include/incDB.php");

    require_once("./lib/PHP-SQL-Parser/src/PHPSQLParser.php");

	

    //ServerViewTxt("N","N","Y","Y");

    $db=db_m_open();

	//내부함수 호출 후 리던 배열 
	$rtnArr = array();

    //그룹ID받기
    $F_GRPID = $_GET['F_GRPID'];
    $F_PJTID = $_GET['F_PJTID'];
    $F_PGMID = $_GET['F_PGMID'];
    $F_PGMNM = $_GET['F_PGMNM'];
    $F_DT_TYPE = $_GET['F_DT_TYPE'];
    $F_START_DT = str_replace("-","",$_GET['F_START_DT']); //날짜 타입은 - 제거
    $F_END_DT = str_replace("-","",$_GET['F_END_DT']); //날짜 타입은 - 제거

    //컬럼ROW받기 GRPID,GRPTYPE,GRPNM,GRPORD,BRCNT,REFGRPID,GRPWIDTH,GRPHEIGHT,COLSIZETYPE,
    $G1_GRPID = $_GET['G1_GRPID'];
    $G1_GRPTYPE = $_GET['G1_GRPTYPE'];
    $G1_GRPNM = $_GET['G1_GRPNM'];
    $G1_GRPORD = $_GET['G1_GRPORD'];
    $G1_COLBRCNT = $_GET['G1_COLBRCNT'];
    $G1_REFGRPID = $_GET['G1_REFGRPID'];
    $G1_GRPWIDTH = $_GET['G1_GRPWIDTH'];
    $G1_GRPHEIGHT = $_GET['G1_GRPHEIGHT'];
    $G1_COLSIZETYPE = $_GET['G1_COLSIZETYPE'];


    $G2_CRUD_MODE = $_GET['G2_CRUD_MODE'];
    $G4_CRUD_MODE = $_GET['G4_CRUD_MODE'];




    //그룹ID받기
    $REQ["F_GRPID"] = $_GET['F_GRPID'];
    $REQ["F_PJTID"] = $_GET['F_PJTID'];
    $REQ["F_PGMID"] = $_GET['F_PGMID'];
    $REQ["F_PGMNM"] = $_GET['F_PGMNM'];
    $REQ["F_DT_TYPE"] = $_GET['F_DT_TYPE'];
    $REQ["F_START_DT"] = str_replace("-","",$_GET['F_START_DT']); //날짜 타입은 - 제거
    $REQ["F_END_DT"] = str_replace("-","",$_GET['F_END_DT']); //날짜 타입은 - 제거


    $REQ["G1_PJTID"]   = $_GET['G1_PJTID'];
    $REQ["G1_PGMID"]   = $_GET['G1_PGMID'];
    $REQ["G1_GRPID"]   = $_GET['G1_GRPID'];
    $REQ["G1_PCD"]	   = $_GET['G1_PCD'];

    $REQ["G5_PJTID"]   = $_GET['G5_PJTID'];
    $REQ["G5_PGMID"]   = $_GET['G5_PGMID'];
    $REQ["G5_GRPID"]   = $_GET['G5_GRPID'];
    $REQ["G5_FNCID"]   = $_GET['G5_FNCID'];

    $REQ["G2_PJTID"]   = $_GET['G2_PJTID'];
    $REQ["G2_PGMID"]   = $_GET['G2_PGMID'];
    $REQ["G2_GRPID"]   = $_GET['G2_GRPID'];
    $REQ["G2_FNCID"]   = $_GET['G2_FNCID'];
    $REQ["G2_SQLID"]   = $_GET['G2_SQLID'];
    $REQ["G2_SQLSEQ"]   = $_GET['G2_SQLSEQ'];

    $REQ["G9_SVCSEQ"]  = $_GET['G9_SVCSEQ'];
    $REQ["G9_PJTID"]   = $_GET['G9_PJTID'];
    $REQ["G9_PGMID"]   = $_GET['G9_PGMID'];
    $REQ["G9_GRPID"]   = $_GET['G9_GRPID'];
    $REQ["G9_FNCID"]   = $_GET['G9_FNCID'];

    $REQ["G1_CRUD_MODE"]    = $_GET['G1_CRUD_MODE'];
    $REQ["G2_CRUD_MODE"]    = $_GET['G2_CRUD_MODE'];
    $REQ["G2_CRUD"]         = $_GET['G2_CRUD'];
    $REQ["G3_CRUD_MODE"]    = $_GET['G3_CRUD_MODE'];
    $REQ["G4_CRUD_MODE"]    = $_GET['G4_CRUD_MODE'];
    $REQ["G5_CRUD_MODE"]    = $_GET['G5_CRUD_MODE'];
    $REQ["G6_CRUD_MODE"]    = $_GET['G6_CRUD_MODE'];
    $REQ["G7_CRUD_MODE"]    = $_GET['G7_CRUD_MODE'];
    $REQ["G8_CRUD_MODE"]    = $_GET['G8_CRUD_MODE'];
    $REQ["G9_CRUD_MODE"]    = $_GET['G9_CRUD_MODE'];
    $REQ["G10_CRUD_MODE"]    = $_GET['G10_CRUD_MODE'];
    $REQ["G11_CRUD_MODE"]    = $_GET['G11_CRUD_MODE'];
    $REQ["G12_CRUD_MODE"]    = $_GET['G12_CRUD_MODE'];
    $REQ["G13_CRUD_MODE"]    = $_GET['G13_CRUD_MODE'];

    $REQ["F_LAYOUTID"]    = $_POST['F_LAYOUTID'];



if($F_GRPID == "1" && $REQ["G1_CRUD_MODE"] == "read"){

    $to_coltype = "ss";
    alog("        to_coltype : " . $to_coltype);
    $sql = "
      select
        PJTID,PGMID,GRPID,GRPTYPE,GRPNM,GRPORD,FREEZECNT,COLBRCNT,REFGRPID,VBOXNO,GRPWIDTH,GRPHEIGHT,COLSIZETYPE,ADDDT,MODDT
      from CG_PGMGRP where PJTID = #F_PJTID# and PGMID = #F_PGMID#
          ";
    alog("        selected : " );
    $stmt = make_stmt($db,$sql, $to_coltype, $REQ);
    if(!$stmt)   JsonMsg("500","100","stmt 생성 실패" . $db->errno . " -> " . $db->error);
    echo make_grid_read_json($stmt,2);
    $db->close();

    //var_dump($RtnVal);

}else if($F_GRPID == "1"){
    alog("---------------GRP G1 ---------------------START");
    alog("        G1_CRUD_MODE : " .$G2_CRUD_MODE);
    alog("        xmldata : " .$_POST["xmldata"]);

	$xml_array = getXml2Array($_POST["xmldata"]);

    $colord = "PJTID,PGMID,GRPID,GRPTYPE,GRPNM,GRPORD,FREEZECNT,COLBRCNT,REFGRPID,VBOXNO,GRPWIDTH,GRPHEIGHT,COLSIZETYPE,ADDDT,MODDT";

	$sql_inserted = "
	  insert into CG_PGMGRP (
			PJTID,PGMID,GRPID,GRPNM,GRPTYPE
			,GRPORD,COLBRCNT,REFGRPID,GRPWIDTH,GRPHEIGHT
			,COLSIZETYPE,BRYN,FREEZECNT
			,ADDDT
		) values (
			#PJTID#,#PGMID#,#GRPID#,#GRPNM#,#GRPTYPE#
			,#GRPORD#,#COLBRCNT#,#REFGRPID#,#GRPWIDTH#,#GRPHEIGHT#
			,#COLSIZETYPE#,#BRYN#,#FREEZECNT#
			,date_format(sysdate(),'%Y%m%d%H%i%s')
		)
	";
	$sql_inserted_coltype = "sssss iisss ssi";

	$sql_deleted = "
		delete from  CG_PGMGRP  where PJTID = #PJTID# and PGMID = #PGMID# and GRPID = #GRPID#	
	";
	$sql_deleted_coltype = "sss";

	$sql_updated = "
		update CG_PGMGRP set
			GRPNM =#GRPNM#, GRPTYPE = #GRPTYPE#, GRPORD = #GRPORD#, COLBRCNT = #COLBRCNT#, REFGRPID = #REFGRPID#
			, GRPWIDTH = #GRPWIDTH#,GRPHEIGHT = #GRPHEIGHT#,COLSIZETYPE = #COLSIZETYPE#, BRYN = #BRYN#, FREEZECNT = #FREEZECNT#
			, MODDT =date_format(sysdate(),'%Y%m%d%H%i%s')
		where PJTID = #PJTID# and PGMID = #PGMID# and GRPID = #GRPID#
	";
	$sql_updated_coltype = "ssiis ssssi sss";


	echo make_grid_save_json($db,$REQ,$colord,$xml_array,$sql_inserted,$sql_inserted_coltype,$sql_deleted,$sql_deleted_coltype,$sql_updated,$sql_updated_coltype,"N","GRPID");

    $db->close();


}



if($F_GRPID == "2" && $REQ["G2_CRUD_MODE"] == "read"){


    $to_coltype = "ss";
    $sql = "
    select PJTID,PGMID,SQLSEQ,SQLID,SQLNM,CRUD,RTN_TYPE,SQLORD,SQLTXT,ADDDT,MODDT 
	from CG_PGMSQL 
	where PJTID = #F_PJTID# and PGMID = #F_PGMID# 
          ";
    $stmt = make_stmt($db,$sql, $to_coltype, $REQ);
    if(!$stmt)  JsonMsg("500","100","stmt 생성 실패" . $db->errno . " -> " . $db->error);

    echo make_grid_read_json($stmt,2);
    $db->close();


    //var_dump($RtnVal);

}else if($F_GRPID == "2"){
    alog("---------------GRP G2 ---------------------START");
    alog("        G2_CRUD_MODE : " .$G2_CRUD_MODE);
    alog("        xmldata : " .$_POST["xmldata"]);

	$xml_array = getXml2Array($_POST["xmldata"]);


    $colord = "PJTID,PGMID,SQLSEQ,SQLID,SQLNM,CRUD,RTN_TYPE,SQLORD,SQLTXT,ADDDT,MODDT";

	$sql_inserted = "
		  insert into CG_PGMSQL (
								PJTID,PGMID,SQLID,SQLNM,CRUD
								,RTN_TYPE,SQLORD,SQLTXT
								,ADDDT
		   ) values (
								#PJTID#,#PGMID#,#SQLID#,#SQLNM#,#CRUD#
								,#RTN_TYPE#,#SQLORD#,#SQLTXT#
								,date_format(sysdate(),'%Y%m%d%H%i%s')
		   )
	";
	$sql_inserted_coltype = "sssss sis";

	$sql_deleted = " delete from CG_PGMSQL where PJTID=#PJTID# and PGMID = #PGMID# and SQLSEQ = #SQLSEQ# ";
	$sql_deleted_coltype = "ssi";

	$sql_updated = "
		  update CG_PGMSQL set
				SQLID = #SQLID#, SQLNM = #SQLNM#, CRUD = #CRUD# , RTN_TYPE = #RTN_TYPE#, SQLTXT = #SQLTXT#
				, SQLORD = #SQLORD#	,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
			where PJTID = #PJTID#  and PGMID = #PGMID# and SQLSEQ = #SQLSEQ# 
	";
	$sql_updated_coltype = "sssss issi";


	echo make_grid_save_json($db,$REQ,$colord,$xml_array,$sql_inserted,$sql_inserted_coltype,$sql_deleted,$sql_deleted_coltype,$sql_updated,$sql_updated_coltype,"Y","SQLSEQ");







    $colord_array = split(",",$colord);


    $xml_array_last = null;
    if(is_assoc($xml_array["row"]) == 1) {
        $xml_array_last[0] = $xml_array["row"];
    }else{
        $xml_array_last = $xml_array["row"];
    }
    //var_dump($xml_array_last);

    $RtnVal = null;
    $RtnCnt = 0;
	
	alog("        xml_array_last sizeof : " . sizeof($xml_array_last));

    for($i=0;$i<sizeof($xml_array_last);$i++){

        $row = $xml_array_last[$i];
        alog("        @attributes : " . $row["@attributes"]["id"]);
        alog("        userdata : " . $row["userdata"]);



        //echo "\n @attributes : ". $row["@attributes"]["id"];
        //echo "\n userdata : ". $row["userdata"];
        //echo "\n cell sizeof : ". sizeof($row["cell"]);

        //현재 그리드 line을 bind 배열에 담기
        $to_row = null;
        $to_coltype = null;
        $sql = null;
        for($j=0;$j<sizeof($row["cell"]);$j++){
            $col = $row["cell"][$j];
            if(is_array($col)){
                $to_row[$colord_array[$j]] = "";
            }else{
                $to_row[$colord_array[$j]] = $col;
            }
			//alog("        ★★★ " . $colord_array[$j] . "=" .$col );
        }
		//alog("		############################ $i = " . $rtnArr[$i]);		
		if($row["userdata"] == "inserted" && !is_numeric($to_row["SQLSEQ"])){
			$to_row["SQLSEQ"] = $rtnArr[$i];
		}
		
		//$to_row["SQLSEQ"] = $rtnArr[$i];


        //SQL 파싱하기
        alog("        SQLTXT : " . $to_row["SQLTXT"]);

        $parser = new PHPSQLParser($to_row["SQLTXT"]);
        $sql_row = null;

        //기존꺼 지우기
        $sql = "delete from CG_PGMSQLD where  PJTID = #PJTID# and PGMID = #PGMID# and SQLSEQ = #SQLSEQ#  ";
        $to_coltype = "ssi";
		
		
		$tarray = array_merge($REQ,$to_row);


        $stmt = make_stmt($db,$sql, $to_coltype, array_merge($REQ,$to_row));
        if(!$stmt) JsonMsg("500","101","stmt 생성 실패" . $db->errno . " -> " . $db->error);
        $stmt->execute();
        //echo "\n db affected_rows : " .  $db->affected_rows; //stmt를 클로즈 하기 전에 해야
        $to_affected_rows = $db->affected_rows;
        $stmt->close();


        alog("        SELECT절 sizeof : " . sizeof($parser->parsed["SELECT"]) );
        alog("        WHERE절 sizeof : " . sizeof($parser->parsed["WHERE"]) );

        //SELECT절이 있을 경우에만
        for($s=0;$s<sizeof($parser->parsed["SELECT"]); $s++){
            //$parser["SELECT"]["expr_type"];
            //$parser["SELECT"]["base_expr"];
            //$parser["SELECT"]["sub_tree"];
            //var_dump($parser->parsed["SELECT"][$s]);

            $sql_row["COLID"] = is_array($parser->parsed["SELECT"][$s]["alias"])?$parser->parsed["SELECT"][$s]["alias"]["name"]:$parser->parsed["SELECT"][$s]["base_expr"];

            alog("            OUTPUT 절 $s :  " . $sql_row["COLID"] );
            $sql_row["SQLGBN"] = "O";
            $sql_row["ORD"] = ($s+1) * 10;
            $sql = "insert into CG_PGMSQLD (
					PJTID,PGMID,SQLSEQ,SQLGBN,COLID
					,ORD
					,ADDDT
				)values(
                    #PJTID#,#PGMID#,#SQLSEQ#,#SQLGBN#,#COLID#
					,#ORD#
					,date_format(sysdate(),'%Y%m%d%H%i%s')
                )
            ";
            $to_coltype = "ssiss i";

            $stmt = make_stmt($db,$sql, $to_coltype, array_merge($REQ,$to_row,$sql_row));
            if(!$stmt)JsonMsg("500","102","stmt 생성 실패" . $db->errno . " -> " . $db->error);
            $stmt->execute();
            //echo "\n db affected_rows : " .  $db->affected_rows; //stmt를 클로즈 하기 전에 해야
            $to_affected_rows = $db->affected_rows;
            $stmt->close();

        }

        //WHERE절이 있을 경우에만
        $to_sql = $to_row["SQLTXT"];
        $s=0;
        while(ereg("(#)([a-zA-Z0-9_-]+)(#)",$to_sql,$mat)){
            //echo "<br>org : " . HtmlEncode($org);
            //echo "\n<br>매칭0 : " . $mat[0];
            //echo "\n<br>매칭1 : " . $mat[1];
            //echo "\n<br>매칭2 : " . $mat[2];
            //echo "\n<br>매칭3 : " . $mat[3];
            //echo "<br>매칭4 : " . $mat[4];


            $sql_row["COLID"] = $mat[2];
            $to_sql = str_replace($mat[1].$mat[2].$mat[3],"?",$to_sql); //방금 찾은겨 치환

            alog("            INPUT 절 $s :  " . $sql_row["COLID"] );
            $sql_row["SQLGBN"] = "I";
            $sql_row["ORD"] = ($s+1) * 10;
            $sql = "insert into CG_PGMSQLD (
					PJTID,PGMID,SQLSEQ,SQLGBN,COLID
					,ORD
					,ADDDT
				)values(
                    #PJTID#,#PGMID#,#SQLSEQ#,#SQLGBN#,#COLID#
					,#ORD#
					,date_format(sysdate(),'%Y%m%d%H%i%s')
                )
            ";
            $to_coltype = "ssiss i";

            $stmt = make_stmt($db,$sql, $to_coltype, array_merge($REQ,$to_row,$sql_row));
            if(!$stmt) JsonMsg("500","103","stmt 생성 실패" . $db->errno . " -> " . $db->error);
            $stmt->execute();
            //echo "\n db affected_rows : " .  $db->affected_rows; //stmt를 클로즈 하기 전에 해야
            $to_affected_rows = $db->affected_rows;
            $stmt->close();

            $s++;
            //echo "\ntosql : " . $tosql;
            //exit;
        }
    }

    $db->close();


    //echo "\n\n\n xml to array : ";
    //var_dump($xml_array);

}


if($F_GRPID == "3" && $REQ["G3_CRUD_MODE"] == "read"){
    $to_coltype = "ssi";
    alog("        to_coltype : " . $to_coltype);
    $sql = "select 
				COLSEQ,PJTID,PGMID, SQLSEQ, COLID, DATATYPE,  SQLGBN, ORD , ADDDT, MODDT 
			from CG_PGMSQLD
            where PJTID=#G2_PJTID# and PGMID = #G2_PGMID# and SQLSEQ = #G2_SQLSEQ#
            order by SQLGBN,ORD asc
          ";
    alog("        selected : " );
    $stmt = make_stmt($db,$sql, $to_coltype, $REQ);
    if(!$stmt)JsonMsg("500","100","stmt 생성 실패" . $db->errno . " -> " . $db->error);

    echo make_grid_read_json($stmt,0);
    $db->close();

    //var_dump($RtnVal);

}else if($F_GRPID == "3"){
    alog("---------------GRP G3 ---------------------START");
    alog("        G3_CRUD_MODE : " .$G4_CRUD_MODE);
    alog("        xmldata : " .$_POST["xmldata"]);

	$xml_array = getXml2Array($_POST["xmldata"]);

    $colord = "COLSEQ,PJTID,PGMID,SQLSEQ,COLID,DATATYPE,SQLGBN,ORD,ADDDT,MODDT";

	$sql_inserted = "
					insert into CG_PGMSQLD (
                                        PJTID,PGMID,SQLSEQ,COLID,DATATYPE
										,SQLGBN,ORD
                                        ,ADDDT
                   ) values (
                                        #PJTID#,#PGMID#,#SQLSEQ#,#COLID#,#DATATYPE#
										,#SQLGBN#,#ORD#
                                        ,date_format(sysdate(),'%Y%m%d%H%i%s')
                   )
	";
	$sql_inserted_coltype = "ssiss si";

	$sql_deleted = "
		delete from CG_PGMSQLD where PJTID=#PJTID# and PGMID = #PGMID# and SQLSEQ = #SQLSEQ# and COLSEQ = #COLSEQ#
		";
	$sql_deleted_coltype = "ssii";

	$sql_updated = "
		  update CG_PGMSQLD set
				ORD = #ORD#, DATATYPE = #DATATYPE#, SQLGBN = #SQLGBN#, COLID = #COLID#
				,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
		  where PJTID=#PJTID# and PGMID = #PGMID# and SQLSEQ = #SQLSEQ# and COLSEQ = #COLSEQ#
	";
	$sql_updated_coltype = "isss ssii";


	echo make_grid_save_json($db,$REQ,$colord,$xml_array,$sql_inserted,$sql_inserted_coltype,$sql_deleted,$sql_deleted_coltype,$sql_updated,$sql_updated_coltype,"Y","COLSEQ");



    $db->close();


    //echo "\n\n\n xml to array : ";
    //var_dump($xml_array);

}




if($F_GRPID == "4" && $REQ["G4_CRUD_MODE"] == "read"){
    alog("---------------GRP G4 ---------------------START");
    alog("        G5_CRUD_MODE : " . $REQ["G4_CRUD_MODE"]);


    //$colord = "COLID,ORD,ADDDT,MODDT";

    $to_coltype = "sss";
    alog("        to_coltype : " . $to_coltype);
    $sql = "
        select
		  PJTID,PGMID,GRPID
          ,COLID,COLORD,COLNM,DATATYPE,DATASIZE
          ,OBJTYPE,BRYN,LBLHIDDENYN,LBLWIDTH,OBJWIDTH
          ,OBJHEIGHT,KEYYN,SEQYN,HIDDENYN,EDITYN
		  ,FNINIT,FNNMSEARCH,FNPOPSEARCH,COLFORMAT,VALIDREQUARE
		  ,VALIDMIN,VALIDMAX,OBJALIGN,REFCOLID,ADDDT,MODDT
        from CG_PGMIO
        where PJTID=#F_PJTID# and PGMID = #F_PGMID# and GRPID = #G1_GRPID#
        ";
    alog("        selected : " );
    $stmt = make_stmt($db,$sql, $to_coltype, $REQ);
    if(!$stmt)JsonMsg("500","100","stmt 생성 실패" . $db->errno . " -> " . $db->error);
    echo make_grid_read_json($stmt,3);
    $db->close();


    //var_dump($RtnVal);
}else if($F_GRPID == "4"){
    alog("---------------GRP G4 ---------------------START");
    alog("        G4_CRUD_MODE : " .$G4_CRUD_MODE);
    alog("        xmldata : " .$_POST["xmldata"]);

	$xml_array = getXml2Array($_POST["xmldata"]);


    $colord = "PJTID,PGMID,GRPID,COLID,COLORD,COLNM,DATATYPE,DATASIZE,OBJTYPE,BRYN,LBLHIDDENYN,LBLWIDTH,OBJWIDTH,OBJHEIGHT,KEYYN,SEQYN,HIDDENYN,EDITYN,FNINIT,FNNMSEARCH,FNPOPSEARCH,COLFORMAT,VALIDREQUARE,VALIDMIN,VALIDMAX,OBJALIGN,REFCOLID,ADDDT,MODDT";

	$sql_inserted = "
		insert into CG_PGMIO (
							PJTID,PGMID,GRPID,COLID,COLORD
							,COLNM,DATATYPE,DATASIZE,OBJTYPE,LBLHIDDENYN
							,LBLWIDTH,OBJWIDTH,HIDDENYN,EDITYN,FNINIT
							,FNNMSEARCH,FNPOPSEARCH,COLFORMAT,VALIDREQUARE,VALIDMIN
							,VALIDMAX,OBJALIGN,REFCOLID,KEYYN,SEQYN
							,OBJHEIGHT
							,ADDDT
	   ) values (
							#F_PJTID#,#F_PGMID#,#G1_GRPID#,#COLID#,#COLORD#
							,#COLNM#,#DATATYPE#,#DATASIZE#,#OBJTYPE#,#LBLHIDDENYN#
							,#LBLWIDTH#,#OBJWIDTH#,#HIDDENYN#,#EDITYN#,#FNINIT#
							,#FNNMSEARCH#,#FNPOPSEARCH#,#COLFORMAT#,#VALIDREQUARE#,#VALIDMIN#
							,#VALIDMAX#,#OBJALIGN#,#REFCOLID#,#KEYYN#,#SEQYN#
							,#OBJHEIGHT#
							,date_format(sysdate(),'%Y%m%d%H%i%s')
	   )
	";
	$sql_inserted_coltype = "ssssi ssiss sssss sssss sssss s";

	$sql_deleted = "
                delete from CG_PGMIO where PJTID=#F_PJTID# and PGMID = #F_PGMID# and GRPID = #G1_GRPID# and COLID = #COLID#
		";
	$sql_deleted_coltype = "ssss";

	$sql_updated = "
	  update CG_PGMIO set
			COLORD=#COLORD#,COLNM=#COLNM#,DATATYPE=#DATATYPE#,DATASIZE=#DATASIZE#,OBJTYPE = #OBJTYPE#
			,LBLHIDDENYN=#LBLHIDDENYN#,LBLWIDTH=#LBLWIDTH#,OBJWIDTH=#OBJWIDTH#,HIDDENYN=#HIDDENYN#,EDITYN=#EDITYN#
			,FNINIT=#FNINIT#,FNNMSEARCH=#FNNMSEARCH#,FNPOPSEARCH=#FNPOPSEARCH#,COLFORMAT=#COLFORMAT#,VALIDREQUARE=#VALIDREQUARE#
			,VALIDMIN=#VALIDMIN#,VALIDMAX=#VALIDMAX#,OBJALIGN=#OBJALIGN#,REFCOLID=#REFCOLID#, KEYYN=#KEYYN#
			,SEQYN = #SEQYN#, BRYN=#BRYN#, OBJHEIGHT=#OBJHEIGHT#
			,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
	  where PJTID=#F_PJTID# and PGMID = #F_PGMID# and GRPID = #G1_GRPID# and COLID = #COLID#

	";
	$sql_updated_coltype = "issis sssss sssss sssss sss ssss";


	echo make_grid_save_json($db,$REQ,$colord,$xml_array,$sql_inserted,$sql_inserted_coltype,$sql_deleted,$sql_deleted_coltype,$sql_updated,$sql_updated_coltype,"N","COLID");


    $db->close();

}




if($F_GRPID == "5" && $REQ["G5_CRUD_MODE"] == "read"){
    alog("---------------GRP G5 ---------------------START");
    alog("        G5_CRUD_MODE : " . $REQ["G5_CRUD_MODE"]);


    //$colord = "COLID,ORD,ADDDT,MODDT";

    $to_coltype = "sss";
    alog("        to_coltype : " . $to_coltype);
    $sql = "
        select
          *
        from CG_DD
        where PJTID=#F_PJTID# and ( COLID = #searchdd# or COLNM = #searchdd# )
        ";
    alog("        selected : " );
    $stmt = make_stmt($db,$sql, $to_coltype, $REQ);
    if(!$stmt)JsonMsg("500","100","stmt 생성 실패" . $db->errno . " -> " . $db->error);


    echo make_grid_read_json($stmt,0);

}


if($F_GRPID == "6" && $REQ["G6_CRUD_MODE"] == "read"){
    alog("---------------GRP G6 ---------------------START");
    alog("        G6_CRUD_MODE : " . $REQ["G6_CRUD_MODE"]);


    //$colord = "COLID,ORD,ADDDT,MODDT";

    $to_coltype = "s";
    alog("        to_coltype : " . $to_coltype);
    $sql = "
        select
          LAYOUTID,GRPCNT
        from CG_LAYOUT
        where PJTID=#F_PJTID# or 1=1
        order by GRPCNT asc,LAYOUTID asc
        ";
    alog("        selected : " );
    $stmt = make_stmt($db,$sql, $to_coltype, $REQ);
    if(!$stmt){
        JsonMsg("500","100","stmt 생성 실패" . $db->errno . " -> " . $db->error);
    }


    echo make_grid_read_json($stmt,0);

}

if($F_GRPID == "6" && $REQ["G6_CRUD_MODE"] == "read2"){
    alog("---------------GRP G6 ---------------------START");
    alog("        G6_CRUD_MODE : " . $REQ["G6_CRUD_MODE"]);


    //$colord = "COLID,ORD,ADDDT,MODDT";

    $to_coltype = "ss";
    alog("        to_coltype : " . $to_coltype);
    $sql = "
        select
          GRPID,GRPTYPE,ORD,REFGRPID,VBOXNO,GRPWIDTH,GRPHEIGHT
        from CG_LAYOUTD
        where ( PJTID=#F_PJTID# or 1=1 ) and LAYOUTID = #F_LAYOUTID#
        order by ORD desc
        ";
    alog("        selected : " );
    $stmt = make_stmt($db,$sql, $to_coltype, $REQ);
    if(!$stmt)JsonMsg("500","100","stmt 생성 실패" . $db->errno . " -> " . $db->error);
   


    echo make_grid_read_json($stmt,0);

}






if($REQ["F_GRPID"] == "7" && $REQ["G7_CRUD_MODE"] == "read"){
    alog("---------------GRP G7 ---------------------START");
    alog("        G7_CRUD_MODE : " . $REQ["G7_CRUD_MODE"]);

    $to_coltype = "sss";
    $sql = "
          select
            PJTID,PGMID,GRPID,USEYN,FNCID,FNCCD,FNCNM,FNCTYPE,BTNWIDTH,FNCORD,ADDDT,MODDT
          from CG_PGMFNC where PJTID = #F_PJTID# and PGMID = #F_PGMID# and GRPID = #G1_GRPID#
          ";
    alog("        selected : " );
    $stmt = make_stmt($db,$sql, $to_coltype, $REQ);
    if(!$stmt)   JsonMsg("500","100","stmt 생성 실패" . $db->errno . " -> " . $db->error);

    echo make_grid_read_json($stmt,4);

    $db->close();

}else if($REQ["F_GRPID"] == "7"){
    alog("---------------GRP G7 ---------------------START");
    alog("        G7_CRUD_MODE : " . $REQ["G7_CRUD_MODE"]);
    alog("        xmldata : " .$_POST["xmldata"]);

	$xml_array = getXml2Array($_POST["xmldata"]);


    //echo "\nxml_array row sizeof : " . sizeof($xml_array["row"]);
    //echo "\nxml_array is_assoc : " . is_assoc($xml_array["row"]);

    $colord = "PJTID,PGMID,GRPID,USEYN,FNCID,FNCCD,FNCNM,FNCTYPE,BTNWIDTH,FNCORD,ADDDT,MODDT";


    $sql_inserted = "
               insert into CG_PGMFNC (
									PJTID,PGMID,GRPID,FNCID,FNCCD
									,FNCNM,FNCTYPE,BTNWIDTH,USEYN,FNCORD
									,ADDDT
               ) values (
                                    #PJTID#,#PGMID#,#GRPID#,#FNCID#,#FNCCD#
									,#FNCNM#,#FNCTYPE#,#BTNWIDTH#,case #USEYN# when 1 then 'Y' else 'N' end ,#FNCORD#
									,date_format(sysdate(),'%Y%m%d%H%i%s')
               )
    ";
    $sql_inserted_coltype = "sssss ssssi";

    $sql_deleted = " delete from CG_PGMFNC where PJTID = #PJTID# and PGMID = #PGMID# and GRPID = #GRPID# and FNCID = #FNCID# ";
    $sql_deleted_coltype = "ssss";

    $sql_updated = "
              update CG_PGMFNC set
					FNCCD = #FNCCD#, FNCNM = #FNCNM#, FNCTYPE = #FNCTYPE#, BTNWIDTH = #BTNWIDTH#, USEYN = case #USEYN# when 1 then 'Y' else 'N' end
					, FNCORD = #FNCORD#
                    ,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
              where PJTID = #PJTID# and PGMID = #PGMID#  and GRPID = #GRPID# and FNCID = #FNCID#
    ";
    $sql_updated_coltype = "sssss i ssss";


    echo make_grid_save_json($db,$REQ,$colord,$xml_array,$sql_inserted,$sql_inserted_coltype,$sql_deleted,$sql_deleted_coltype,$sql_updated,$sql_updated_coltype,"N","FNCID");

    //echo "\n\n\n xml to array : ";
    //var_dump($xml_array);
    $db->close();
}




if($REQ["F_GRPID"] == "8" && $REQ["G8_CRUD_MODE"] == "read"){
    alog("---------------GRP G8 ---------------------START");
    alog("        G8_CRUD_MODE : " . $REQ["G8_CRUD_MODE"]);

    $to_coltype = "sss";
    $sql = "
			select a.CD,b.NM,a.CDVAL
			from CG_CODED a join CG_CODED b on a.PCD = #G1_PCD# and b.PCD = 'FNC' and a.CD = b.CD 
			where a.PJTID = #F_PJTID# and b.PJTID = #F_PJTID# 
          ";
    alog("        selected : " );
    $stmt = make_stmt($db,$sql, $to_coltype, $REQ);
    if(!$stmt)   JsonMsg("500","100","stmt 생성 실패" . $db->errno . " -> " . $db->error);

    echo make_grid_read_json($stmt,3);

    $db->close();

}







if($REQ["F_GRPID"] == "9" && $REQ["G9_CRUD_MODE"] == "read"){
    alog("---------------GRP G9 ---------------------START");
    alog("        G9_CRUD_MODE : " . $REQ["G9_CRUD_MODE"]);

    $to_coltype = "sss";
    $sql = "
          select
			INHERITSEQ,PJTID,PGMID,GRPID,COLID,CHILDGRPID,FILTERYN,VALUEYN,ADDDT,MODDT
          from CG_PGMINHERIT where PJTID = #F_PJTID# and PGMID = #F_PGMID# and GRPID = #G1_GRPID#
          ";
    alog("        selected : " );
    $stmt = make_stmt($db,$sql, $to_coltype, $REQ);
    if(!$stmt)   JsonMsg("500","901","stmt 생성 실패" . $db->errno . " -> " . $db->error);

    echo make_grid_read_json($stmt,0);

    $db->close();

}else if($REQ["F_GRPID"] == "9"){
    alog("---------------GRP G9 ---------------------START");
    alog("        G9_CRUD_MODE : " . $REQ["G9_CRUD_MODE"]);
    alog("        xmldata : " .$_POST["xmldata"]);

	$xml_array = getXml2Array($_POST["xmldata"]);


    //echo "\nxml_array row sizeof : " . sizeof($xml_array["row"]);
    //echo "\nxml_array is_assoc : " . is_assoc($xml_array["row"]);

    $colord = "INHERITSEQ,PJTID,PGMID,GRPID,COLID,CHILDGRPID,FILTERYN,VALUEYN,ADDDT,MODDT";


    $sql_inserted = "
               insert into CG_PGMINHERIT (
									PJTID,PGMID,GRPID,COLID,CHILDGRPID
									,FILTERYN,VALUEYN
									,ADDDT
               ) values (
                                    #PJTID#,#PGMID#,#GRPID#,#COLID#,#CHILDGRPID#
									,#FILTERYN#,#VALUEYN#
									,date_format(sysdate(),'%Y%m%d%H%i%s')
               )
    ";
    $sql_inserted_coltype = "sssss ss";

    $sql_deleted = " delete from CG_PGMINHERIT where PJTID = #PJTID# and PGMID = #PGMID# and INHERITSEQ = #INHERITSEQ# ";
    $sql_deleted_coltype = "ssi";

    $sql_updated = "
              update CG_PGMINHERIT set
					COLID = #COLID#, CHILDGRPID = #CHILDGRPID#,	FILTERYN = #FILTERYN#, VALUEYN = #VALUEYN#
                    ,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
              where PJTID = #PJTID# and PGMID = #PGMID# and INHERITSEQ = #INHERITSEQ#
    ";
    $sql_updated_coltype = "ssss ssi";


    echo make_grid_save_json($db,$REQ,$colord,$xml_array,$sql_inserted,$sql_inserted_coltype,$sql_deleted,$sql_deleted_coltype,$sql_updated,$sql_updated_coltype,"Y","INHERITSEQ");

    //echo "\n\n\n xml to array : ";
    //var_dump($xml_array);
    $db->close();
}






//CG_PGMSQLR
if($REQ["F_GRPID"] == "10" && $REQ["G10_CRUD_MODE"] == "read"){
    alog("---------------GRP G9 ---------------------START");
    alog("        G10_CRUD_MODE : " . $REQ["G10_CRUD_MODE"]);

    $to_coltype = "ssi";
    $sql = "
          select
			SQLRSEQ,PJTID,PGMID,SVCSEQ,SQLID,ORD,ADDDT,MODDT
          from CG_PGMSQLR where PJTID = #F_PJTID# and PGMID = #F_PGMID# and SVCSEQ = #G9_SVCSEQ#
		  order by ORD asc
          ";
    alog("        selected : " );
    $stmt = make_stmt($db,$sql, $to_coltype, $REQ);
    if(!$stmt)   JsonMsg("500","901","stmt 생성 실패" . $db->errno . " -> " . $db->error);

    echo make_grid_read_json($stmt,0);

    $db->close();

}else if($REQ["F_GRPID"] == "10"){
    alog("---------------GRP G10 ---------------------START");
    alog("        G10_CRUD_MODE : " . $REQ["G10_CRUD_MODE"]);
    alog("        xmldata : " .$_POST["xmldata"]);

	$xml_array = getXml2Array($_POST["xmldata"]);


    //echo "\nxml_array row sizeof : " . sizeof($xml_array["row"]);
    //echo "\nxml_array is_assoc : " . is_assoc($xml_array["row"]);

    $colord = "SQLRSEQ,PJTID,PGMID,SVCSEQ,SQLID,ORD,ADDDT,MODDT";


    $sql_inserted = "
               insert into CG_PGMSQLR (
									PJTID,PGMID,SVCSEQ,SQLID,ORD
									,ADDDT
               ) values (
                                    #PJTID#,#PGMID#,#SVCSEQ#,#SQLID#,#ORD#
									,date_format(sysdate(),'%Y%m%d%H%i%s')
               )
    ";
    $sql_inserted_coltype = "ssisi";

    $sql_deleted = " delete from CG_PGMSQLR where PJTID = #PJTID# and PGMID = #PGMID# and SQLRSEQ = #SQLRSEQ# ";
    $sql_deleted_coltype = "ssi";

    $sql_updated = "
              update CG_PGMSQLR set
					SQLID = #SQLID#, ORD = #ORD#
					,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
              where PJTID = #PJTID# and PGMID = #PGMID# and SQLRSEQ = #SQLRSEQ# 
    ";
    $sql_updated_coltype = "si ssi";


    echo make_grid_save_json($db,$REQ,$colord,$xml_array,$sql_inserted,$sql_inserted_coltype,$sql_deleted,$sql_deleted_coltype,$sql_updated,$sql_updated_coltype,"Y","SQLRSEQ");

    //echo "\n\n\n xml to array : ";
    //var_dump($xml_array);
    $db->close();
}


if($REQ["F_GRPID"] == "11" && $REQ["G11_CRUD_MODE"] == "read"){
    alog("---------------GRP G11 ---------------------START");
    alog("        G11_CRUD_MODE : " . $REQ["G11_CRUD_MODE"]);

    $to_coltype = "ssi";
    $sql = "
          select
			a.COLID,a.ORD
			,ifnull(b.COLNM,'') as COLNM
			,ifnull(b.DATATYPE,'') as DATATYPE
			,ifnull(b.DATASIZE,'') as DATASIZE
			,ifnull(b.OBJTYPE,'') as OBJTYPE
			,ifnull(b.LBLWIDTH,'') as LBLWIDTH
			,ifnull(b.OBJWIDTH,'') as OBJWIDTH
			,ifnull(b.OBJHEIGHT,'') as OBJHEIGHT
          from CG_PGMSQLD a
			left outer join CG_DD b on a.PJTID = b.PJTID and a.COLID = b.COLID
		  where a.SQLGBN = 'O' and a.PJTID = #G1_PJTID# and a.PGMID = #G1_PGMID# and a.SQLSEQ = #G2_SQLSEQ#
		  order by ORD desc
          ";
    alog("        selected : " );
    $stmt = make_stmt($db,$sql, $to_coltype, $REQ);
    if(!$stmt)   JsonMsg("500","911","stmt 생성 실패" . $db->errno . " -> " . $db->error);

    echo make_grid_read_json($stmt,0);

    $db->close();

}



//VALID
if($REQ["F_GRPID"] == "12" && $REQ["G12_CRUD_MODE"] == "read"){
    alog("---------------GRP G12 ---------------------START");
    alog("        G12_CRUD_MODE : " . $REQ["G12_CRUD_MODE"]);

    $to_coltype = "ssss";
    $sql = "
          select
			VALIDSEQ,PJTID,PGMID,GRPID,FNCID,ORD,TIMETYPE,JOBTYPE,COLID,VAL1,VAL2,OPER,ANDOR,ACTION,MSG,SQLTXT,ADDDT,MODDT
          from CG_VALID 
		  where PJTID = #G5_PJTID# and PGMID = #G5_PGMID# and GRPID = #G5_GRPID# and FNCID = #G5_FNCID#
		  order by ORD desc
          ";
    alog("        selected : " );
    $stmt = make_stmt($db,$sql, $to_coltype, $REQ);
    if(!$stmt)   JsonMsg("500","912","stmt 생성 실패" . $db->errno . " -> " . $db->error);

    echo make_grid_read_json($stmt,0);

    $db->close();

}else if($REQ["F_GRPID"] == "12"){
    alog("---------------GRP G12 ---------------------START");
    alog("        G12_CRUD_MODE : " . $REQ["G12_CRUD_MODE"]);
    alog("        xmldata : " .$_POST["xmldata"]);

	$xml_array = getXml2Array($_POST["xmldata"]);


    //echo "\nxml_array row sizeof : " . sizeof($xml_array["row"]);
    //echo "\nxml_array is_assoc : " . is_assoc($xml_array["row"]);

    $colord = "VALIDSEQ,PJTID,PGMID,GRPID,FNCID,ORD,TIMETYPE,JOBTYPE,COLID,VAL1,VAL2,OPER,ANDOR,ACTION,MSG,SQLTXT,ADDDT,MODDT";


    $sql_inserted = "
               insert into CG_VALID (
									PJTID,PGMID,GRPID,FNCID,ORD
									,TIMETYPE,JOBTYPE,COLID,VAL1,VAL2
									,OPER,ANDOR,ACTION,MSG,SQLTXT
									,ADDDT
               ) values (
									#PJTID#,#PGMID#,#GRPID#,#FNCID#,#ORD#
									,#TIMETYPE#,#JOBTYPE#,#COLID#,#VAL1#,#VAL2#
									,#OPER#,#ANDOR#,#ACTION#,#MSG#,#SQLTXT#
									,date_format(sysdate(),'%Y%m%d%H%i%s')
               )
    ";
    $sql_inserted_coltype = "ssssi sssss sssss";

    $sql_deleted = " delete from CG_VALID where PJTID = #PJTID# and PGMID = #PGMID# and VALIDSEQ = #VALIDSEQ# ";
    $sql_deleted_coltype = "ssi";

    $sql_updated = "
              update CG_VALID set
					ORD = #ORD#,TIMETYPE = #TIMETYPE#,JOBTYPE = #JOBTYPE#,COLID = #COLID#,VAL1 = #VAL1#
					,VAL2 = #VAL2#,OPER = #OPER#,ANDOR = #ANDOR#,ACTION = #ACTION#,MSG = #MSG#
					,SQLTXT = #SQLTXT#
					,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
              where PJTID = #PJTID# and PGMID = #PGMID# and VALIDSEQ = #VALIDSEQ# 
    ";
    $sql_updated_coltype = "issss sssss s ssi";


    echo make_grid_save_json($db,$REQ,$colord,$xml_array,$sql_inserted,$sql_inserted_coltype,$sql_deleted,$sql_deleted_coltype,$sql_updated,$sql_updated_coltype,"Y","VALIDSEQ");

    //echo "\n\n\n xml to array : ";
    //var_dump($xml_array);
    $db->close();
}






//SVC
if($REQ["F_GRPID"] == "13" && $REQ["G13_CRUD_MODE"] == "read"){
    alog("---------------GRP G13 ---------------------START");
    alog("        G13_CRUD_MODE : " . $REQ["G13_CRUD_MODE"]);

    $to_coltype = "ssss";
    $sql = "
          select
			SVCSEQ,PJTID,PGMID,GRPID,FNCID,ORD,SVCGRPID,ADDDT,MODDT
          from CG_PGMSVC 
		  where PJTID = #G5_PJTID# and PGMID = #G5_PGMID# and GRPID = #G5_GRPID# and FNCID = #G5_FNCID#
		  order by ORD desc
          ";
    alog("        selected : " );
    $stmt = make_stmt($db,$sql, $to_coltype, $REQ);
    if(!$stmt)   JsonMsg("500","912","stmt 생성 실패" . $db->errno . " -> " . $db->error);

    echo make_grid_read_json($stmt,0);

    $db->close();

}else if($REQ["F_GRPID"] == "13"){
    alog("---------------GRP G13 ---------------------START");
    alog("        G12_CRUD_MODE : " . $REQ["G13_CRUD_MODE"]);
    alog("        xmldata : " .$_POST["xmldata"]);

	$xml_array = getXml2Array($_POST["xmldata"]);


    //echo "\nxml_array row sizeof : " . sizeof($xml_array["row"]);
    //echo "\nxml_array is_assoc : " . is_assoc($xml_array["row"]);

    $colord = "SVCSEQ,PJTID,PGMID,GRPID,FNCID,ORD,SVCGRPID,ADDDT,MODDT";


    $sql_inserted = "
               insert into CG_PGMSVC (
									PJTID,PGMID,GRPID,FNCID,ORD
									,SVCGRPID
									,ADDDT
               ) values (
									#PJTID#,#PGMID#,#GRPID#,#FNCID#,#ORD#
									,#SVCGRPID#
									,date_format(sysdate(),'%Y%m%d%H%i%s')
               )
    ";
    $sql_inserted_coltype = "ssssi s";

    $sql_deleted = " delete from CG_PGMSVC where PJTID = #PJTID# and PGMID = #PGMID# and SVCSEQ = #SVCSEQ# ";
    $sql_deleted_coltype = "ssi";

    $sql_updated = "
              update CG_PGMSVC set
					ORD = #ORD#, SVCGRPID = #SVCGRPID#
					,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
              where PJTID = #PJTID# and PGMID = #PGMID# and SVCSEQ = #SVCSEQ# 
    ";
    $sql_updated_coltype = "is ssi";


    echo make_grid_save_json($db,$REQ,$colord,$xml_array,$sql_inserted,$sql_inserted_coltype,$sql_deleted,$sql_deleted_coltype,$sql_updated,$sql_updated_coltype,"Y","SVCSEQ");

    //echo "\n\n\n xml to array : ";
    //var_dump($xml_array);
    $db->close();
}
?>
