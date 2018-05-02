<?php
    header("Content-Type: text/html; charset=UTF-8");
    header("Cache-Control:no-cache");
    header("Pragma:no-cache");


    require_once("./include/incUtil.php");
    require_once("./incConfig.php");
    require_once("./include/incDB.php");
    require_once("./include/incUser.php");

    require_once("./lib/PHP-SQL-Parser/src/PHPSQLParser.php");

	

    //ServerViewTxt("N","N","Y","Y");

    $db=db_m_open();

	//내부함수 호출 후 리던 배열 
	$rtnArr = array();

    //그룹ID받기
    $F_GRPID = $_GET['F_GRPID'];
    $F_PJTID = $_GET['F_PJTID'];
    $F_PGMID = $_GET['F_PGMID'];
    $F_PJTSEQ = $_GET['F_PJTSEQ'];
    $F_PGMSEQ = $_GET['F_PGMSEQ'];
    $F_PGMNM = $_GET['F_PGMNM'];
    $F_DT_TYPE = $_GET['F_DT_TYPE'];
    $F_START_DT = str_replace("-","",$_GET['F_START_DT']); //날짜 타입은 - 제거
    $F_END_DT = str_replace("-","",$_GET['F_END_DT']); //날짜 타입은 - 제거

    //컬럼ROW받기 GRPID,GRPTYPE,GRPNM,GRPORD,BRCNT,REFGRPID,GRPWIDTH,GRPHEIGHT,
    $G1_GRPSEQ = $_GET['G1_GRPSEQ'];
    $G1_GRPID = $_GET['G1_GRPID'];
    $G1_GRPTYPE = $_GET['G1_GRPTYPE'];
    $G1_GRPNM = $_GET['G1_GRPNM'];
    $G1_GRPORD = $_GET['G1_GRPORD'];
    $G1_REFGRPID = $_GET['G1_REFGRPID'];
    $G1_GRPWIDTH = $_GET['G1_GRPWIDTH'];
    $G1_GRPHEIGHT = $_GET['G1_GRPHEIGHT'];


    $G2_CRUD_MODE = $_GET['G2_CRUD_MODE'];
    $G4_CRUD_MODE = $_GET['G4_CRUD_MODE'];


    //로그인 정보
    $REQ["ADDID"] = getUserSeq();
    $REQ["MODID"] = $REQ["ADDID"];

    //그룹ID받기
    $REQ["F_GRPID"] = $_GET['F_GRPID'];
    $REQ["F_GRPSEQ"] = $_GET['F_GRPSEQ'];
    $REQ["F_PJTSEQ"] = $_GET['F_PJTSEQ'];
    $REQ["F_PGMSEQ"] = $_GET['F_PGMSEQ'];
    $REQ["F_PGMNM"] = $_GET['F_PGMNM'];
    $REQ["F_DT_TYPE"] = $_GET['F_DT_TYPE'];
    $REQ["F_START_DT"] = str_replace("-","",$_GET['F_START_DT']); //날짜 타입은 - 제거
    $REQ["F_END_DT"] = str_replace("-","",$_GET['F_END_DT']); //날짜 타입은 - 제거


    $REQ["G1_PJTSEQ"]   = $_GET['G1_PJTSEQ'];
    $REQ["G1_PGMSEQ"]   = $_GET['G1_PGMSEQ'];
    $REQ["G1_GRPSEQ"]   = $_GET['G1_GRPSEQ'];
    $REQ["G1_GRPTYPE"]   = $_GET['G1_GRPTYPE'];    
    $REQ["G1_GRPID"]   = $_GET['G1_GRPID'];
    $REQ["G1_PCD"]	   = $_GET['G1_PCD'];

    $REQ["G5_PJTSEQ"]   = $_GET['G5_PJTSEQ'];
    $REQ["G5_PGMSEQ"]   = $_GET['G5_PGMSEQ'];
    $REQ["G5_GRPSEQ"]   = $_GET['G5_GRPSEQ'];
    $REQ["G5_FNCSEQ"]   = $_GET['G5_FNCSEQ'];

    $REQ["G2_PJTSEQ"]   = $_GET['G2_PJTSEQ'];
    $REQ["G2_PGMSEQ"]   = $_GET['G2_PGMSEQ'];
    $REQ["G2_GRPSEQ"]   = $_GET['G2_GRPSEQ'];
    $REQ["G2_FNCSEQ"]   = $_GET['G2_FNCSEQ'];
    $REQ["G2_SQLID"]   = $_GET['G2_SQLID'];
    $REQ["G2_SQLSEQ"]   = $_GET['G2_SQLSEQ'];

    $REQ["G9_SVCSEQ"]  = $_GET['G9_SVCSEQ'];
    $REQ["G9_PJTSEQ"]   = $_GET['G9_PJTSEQ'];
    $REQ["G9_PGMSEQ"]   = $_GET['G9_PGMSEQ'];
    $REQ["G9_GRPSEQ"]   = $_GET['G9_GRPSEQ'];
    $REQ["G9_FNCSEQ"]   = $_GET['G9_FNCSEQ'];

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

    $REQ["PGM_CRUD_MODE"]    = $_GET['PGM_CRUD_MODE'];
    $REQ["POP_PGMID"]    = $_POST['POP_PGMID'];
    $REQ["POP_PGMNM"]    = $_POST['POP_PGMNM'];
    $REQ["POP_PJTSEQ"]    = $_POST['POP_PJTSEQ'];
	alog("POP_PGMID=" . $_POST['POP_PGMID']);
	alog("POP_PGMNM=" . $_POST['POP_PGMNM']);
	alog("POP_PJTSEQ=" . $_POST['POP_PJTSEQ']);

	$REQ["POP_PGMNM"] = "%" . $REQ["POP_PGMNM"] . "%";
	

    $REQ["F_LAYOUTID"]    = $_POST['F_LAYOUTID'];
    $REQ["searchdd"]    = $_POST['searchdd'];


if($F_GRPID == "PGM" && $REQ["PGM_CRUD_MODE"] == "read"){
	alog("---------------GRP PGM ---------------------START");

    $to_coltype = "isss";
    alog("        to_coltype : " . $to_coltype);
    $sql = "
      select
        a.PJTSEQ, a.PGMSEQ, a.PGMID, a.PGMNM, a.VIEWURL, a.PGMTYPE
        ,b.VERDT, b.DEGREE, a.ADDDT, a.MODDT
      from 
		CG_PGMINFO a
			left outer join CG_PGMVER b on a.PJTSEQ = b.PJTSEQ and a.PGMSEQ = b.PGMSEQ and b.ACTIVEYN='Y'
      where a.PJTSEQ = #POP_PJTSEQ# and (a.PGMID = #POP_PGMID# or a.PGMNM LIKE #POP_PGMNM# or a.PGMTYPE LIKE #POP_PGMTYPE#)
      order by a.PGMSEQ desc
          ";
    alog("        selected : " );
    $stmt = make_stmt($db,$sql, $to_coltype, $REQ);
    if(!$stmt)   JsonMsg("500","108","stmt 생성 실패" . $db->errno . " -> " . $db->error);
    echo make_grid_read_json($stmt,2);
    $db->close();

    //var_dump($RtnVal);
}



if($F_GRPID == "1" && $REQ["G1_CRUD_MODE"] == "read"){

    $to_coltype = "ii";
    alog("        to_coltype : " . $to_coltype);
    $sql = "
      select
        PJTSEQ,PGMSEQ,GRPSEQ,GRPID,GRPTYPE,GRPNM,GRPORD,FREEZECNT,REFGRPID,VBOX,GRPWIDTH,GRPHEIGHT,COLSIZETYPE,ADDDT,MODDT
      from CG_PGMGRP where PJTSEQ = #F_PJTSEQ# and PGMSEQ = #F_PGMSEQ#
      order by GRPORD
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

    $colord = "PJTSEQ,PGMSEQ,GRPSEQ,GRPID,GRPTYPE,GRPNM,GRPORD,FREEZECNT,REFGRPID,VBOX,GRPWIDTH,GRPHEIGHT,COLSIZETYPE,ADDDT,MODDT";

	$sql_inserted = "
	  insert into CG_PGMGRP (
			PJTSEQ,PGMSEQ,GRPID,GRPNM,GRPTYPE
            ,GRPORD,REFGRPID,VBOX,GRPWIDTH,GRPHEIGHT
            ,BRYN,FREEZECNT,COLSIZETYPE
			,ADDDT
		) values (
			#PJTSEQ#, #PGMSEQ#, #GRPID#, #GRPNM#, #GRPTYPE#
            ,#GRPORD#, #REFGRPID#, #VBOX#, #GRPWIDTH#, #GRPHEIGHT#
            ,#BRYN#, #FREEZECNT#, if(#COLSIZETYPE#='','X',#COLSIZETYPE#)
			,date_format(sysdate(),'%Y%m%d%H%i%s')
		)
	";
	$sql_inserted_coltype = "iisss issss siss";

	$sql_deleted = "
		delete from  CG_PGMGRP  where PJTSEQ = #PJTSEQ# and PGMSEQ = #PGMSEQ# and GRPSEQ = #GRPSEQ#	
	";
	$sql_deleted_coltype = "iii";

	$sql_updated = "
		update CG_PGMGRP set
            GRPID = #GRPID#, GRPNM =#GRPNM#, GRPTYPE = #GRPTYPE#, GRPORD = #GRPORD#, REFGRPID = #REFGRPID#
            , GRPWIDTH = #GRPWIDTH#, GRPHEIGHT = #GRPHEIGHT#, BRYN = #BRYN#, FREEZECNT = #FREEZECNT#, COLSIZETYPE = #COLSIZETYPE#
            , VBOX = #VBOX#
            , MODDT =date_format(sysdate(),'%Y%m%d%H%i%s')
		where PJTSEQ = #PJTSEQ# and PGMSEQ = #PGMSEQ# and GRPSEQ = #GRPSEQ#
	";
	$sql_updated_coltype = "sssis sssis s iii";


	echo make_grid_save_json($db,$REQ,$colord,$xml_array,$sql_inserted,$sql_inserted_coltype,$sql_deleted,$sql_deleted_coltype,$sql_updated,$sql_updated_coltype,"Y","GRPSEQ");

    $db->close();


}



if($F_GRPID == "2" && $REQ["G2_CRUD_MODE"] == "read"){


    $to_coltype = "ii";
    $sql = "
    select PJTSEQ,PGMSEQ,SQLSEQ,SQLID,SQLNM,SVRSEQ,CRUD,RTN_TYPE,SQLORD,SQLTXT,ADDDT,MODDT 
	from CG_PGMSQL 
	where PJTSEQ = #F_PJTSEQ# and PGMSEQ = #F_PGMSEQ# 
          ";
    $stmt = make_stmt($db,$sql, $to_coltype, $REQ);
    if(!$stmt)  JsonMsg("500","100","stmt 생성 실패" . $db->errno . " -> " . $db->error);

	$t = make_grid_read_json($stmt,2);
	alog($t);
    echo $t;
    $db->close();


    //var_dump($RtnVal);

}else if($F_GRPID == "2"){
    alog("---------------GRP G2 ---------------------START");
    alog("        G2_CRUD_MODE : " .$G2_CRUD_MODE);
    alog("        xmldata : " .$_POST["xmldata"]);

	$xml_array = getXml2Array($_POST["xmldata"]);


    $colord = "PJTSEQ,PGMSEQ,SQLSEQ,SQLID,SQLNM,SVRSEQ,CRUD,RTN_TYPE,SQLORD,SQLTXT,ADDDT,MODDT";

	$sql_inserted = "
		  insert into CG_PGMSQL (
                                PJTSEQ,PGMSEQ,SQLID,SQLNM,SVRSEQ
                                ,CRUD,RTN_TYPE,SQLORD,SQLTXT
								,ADDDT
		   ) values (
                                #PJTSEQ#,#PGMSEQ#,#SQLID#,#SQLNM#,#SVRSEQ#
                                ,#CRUD#,#RTN_TYPE#,#SQLORD#,#SQLTXT#
								,date_format(sysdate(),'%Y%m%d%H%i%s')
		   )
	";
	$sql_inserted_coltype = "iissi ssis";

	$sql_deleted = " delete from CG_PGMSQL where PJTSEQ=#PJTSEQ# and PGMSEQ = #PGMSEQ# and SQLSEQ = #SQLSEQ# ";
	$sql_deleted_coltype = "ssi";

	$sql_updated = "
		  update CG_PGMSQL set
                SQLID = #SQLID#, SQLNM = #SQLNM#, SVRSEQ = #SVRSEQ#, CRUD = #CRUD# , RTN_TYPE = #RTN_TYPE#
                , SQLTXT = #SQLTXT#, SQLORD = #SQLORD#	,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
			where PJTSEQ = #PJTSEQ#  and PGMSEQ = #PGMSEQ# and SQLSEQ = #SQLSEQ# 
	";
	$sql_updated_coltype = "ssiss si iii";


	echo make_grid_save_json($db,$REQ,$colord,$xml_array,$sql_inserted,$sql_inserted_coltype,$sql_deleted,$sql_deleted_coltype,$sql_updated,$sql_updated_coltype,"Y","SQLSEQ");







    $colord_array = explode(",",$colord);


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
        $sql = "delete from CG_PGMSQLD where  PJTSEQ = #PJTSEQ# and PGMSEQ = #PGMSEQ# and SQLSEQ = #SQLSEQ#  ";
        $to_coltype = "iii";
		
		
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
            alog("  s : " . $s);
            alog("      alias : " . $parser->parsed["SELECT"][$s]["alias"]);
            alog("      alias.name : " . $parser->parsed["SELECT"][$s]["alias"]["name"]);
            alog("      expr_type : " . $parser->parsed["SELECT"][$s]["expr_type"]);            
            alog("      base_expr before : " . $parser->parsed["SELECT"][$s]["base_expr"]);

            // A.COLID를 COLID로 변경
            $base_expr = $parser->parsed["SELECT"][$s]["base_expr"];
            $base_expr = strpos($base_expr,".")>0?explode(".",$base_expr)[1]:$base_expr;

            //alog("      base_expr after : " . $base_expr);
            $sql_row["COLID"] = is_array($parser->parsed["SELECT"][$s]["alias"])?$parser->parsed["SELECT"][$s]["alias"]["name"]:$base_expr;
            $sql_row["DDCOLID"] = $sql_row["COLID"];

            alog("            OUTPUT 절 $s :  " . $sql_row["COLID"] );
            $sql_row["SQLGBN"] = "O";
            $sql_row["ORD"] = ($s+1) * 10;
            $sql = "insert into CG_PGMSQLD (
					PJTSEQ, PGMSEQ, SQLSEQ, SQLGBN, COLID
					, DDCOLID, ORD
					, ADDDT
				)values(
                    #{PJTSEQ}, #{PGMSEQ}, #{SQLSEQ}, #{SQLGBN}, #{COLID}
					, #{DDCOLID}, #{ORD}
					, date_format(sysdate(),'%Y%m%d%H%i%s')
                )
            ";
            $to_coltype = "iiiss si";

            $stmt = makeStmt($db,$sql, $to_coltype, array_merge($REQ,$to_row,$sql_row));
            if(!$stmt)JsonMsg("500","102","stmt 생성 실패" . $db->errno . " -> " . $db->error);
            $stmt->execute();
            //echo "\n db affected_rows : " .  $db->affected_rows; //stmt를 클로즈 하기 전에 해야
            $to_affected_rows = $db->affected_rows;
            $stmt->close();

        }

        //WHERE절이 있을 경우에만
        $to_sql = $to_row["SQLTXT"];
        $s=0;
        //정규식에서 .를 검색할때는 []안에 인수 값중에 맨뒤에 가면 동작안함.
        while(preg_match("/(#{)([\.a-zA-Z0-9_-]+)(})/",$to_sql,$mat)){
            //alog("org : " . HtmlEncode($org));
            //alog("매칭0 : " . $mat[0]);
            //alog("매칭1 : " . $mat[1]);
            //alog("매칭2 : " . $mat[2]);
            //alog("매칭3 : " . $mat[3]);
            //alog("매칭4 : " . $mat[4]);


            $sql_row["COLID"] = $mat[2];
            $sql_row["DDCOLID"] = ( strpos($sql_row["COLID"],"-") > 0 )?explode("-",$sql_row["COLID"])[1]:$sql_row["COLID"];
                        
            $to_sql = str_replace_once($mat[1].$mat[2].$mat[3],"?",$to_sql); //방금 찾은겨 치환

            alog("            INPUT 절 $s :  " . $sql_row["COLID"] );
            $sql_row["SQLGBN"] = "I";
            $sql_row["ORD"] = ($s+1) * 10;
            $sql = "insert into CG_PGMSQLD (
					PJTSEQ,PGMSEQ,SQLSEQ,SQLGBN,COLID
					, DDCOLID, ORD
					,ADDDT
				)values(
                    #{PJTSEQ},#{PGMSEQ},#{SQLSEQ},#{SQLGBN},#{COLID}
					, #{DDCOLID}, #{ORD}
					,date_format(sysdate(),'%Y%m%d%H%i%s')
                )
            ";
            $to_coltype = "iiiss si";

            $stmt = makeStmt($db,$sql, $to_coltype, array_merge($REQ,$to_row,$sql_row));
            if(!$stmt) JsonMsg("500","103","stmt 생성 실패 " . $stmt->errno . " -> " . $stmt->error);
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
    $to_coltype = "iii";
    alog("        to_coltype : " . $to_coltype);
    $sql = "select 
				a.COLSEQ, a.PJTSEQ, a.PGMSEQ, a.SQLSEQ, a.DDCOLID, a.COLID, b.DATATYPE, a.SQLGBN, a.ORD, a.ADDDT, a.MODDT 
            from CG_PGMSQLD a
                left outer join CG_DD b on a.PJTSEQ = b.PJTSEQ and a.DDCOLID = b.COLID
            where a.PJTSEQ=#G2_PJTSEQ# and a.PGMSEQ = #G2_PGMSEQ# and a.SQLSEQ = #G2_SQLSEQ#
            order by a.SQLGBN,a.ORD asc
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

    $colord = "COLSEQ,PJTSEQ,PGMSEQ,SQLSEQ,DDCOLID,COLID,DATATYPE,SQLGBN,ORD,ADDDT,MODDT";

	$sql_inserted = "
					insert into CG_PGMSQLD (
                                        PJTSEQ, PGMSEQ, SQLSEQ, COLID, SQLGBN
                                        , DDCOLID, ORD
                                        ,ADDDT
                   ) values (
                                        #PJTSEQ#, #PGMSEQ#, #SQLSEQ#, #COLID#, #SQLGBN#
                                        , #DDCOLID#, #ORD#
                                        ,date_format(sysdate(),'%Y%m%d%H%i%s')
                   )
	";
	$sql_inserted_coltype = "iiiss si";

	$sql_deleted = "
		delete from CG_PGMSQLD where PJTSEQ=#PJTSEQ# and PGMSEQ = #PGMSEQ# and SQLSEQ = #SQLSEQ# and COLSEQ = #COLSEQ#
		";
	$sql_deleted_coltype = "iiii";

	$sql_updated = "
		  update CG_PGMSQLD set
				ORD = #ORD#, SQLGBN = #SQLGBN#, COLID = #COLID#, DDCOLID = #DDCOLID#
				,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
		  where PJTSEQ=#PJTSEQ# and PGMSEQ = #PGMSEQ# and SQLSEQ = #SQLSEQ# and COLSEQ = #COLSEQ#
	";
	$sql_updated_coltype = "isss iiii";


	echo make_grid_save_json($db,$REQ,$colord,$xml_array,$sql_inserted,$sql_inserted_coltype,$sql_deleted,$sql_deleted_coltype,$sql_updated,$sql_updated_coltype,"Y","COLSEQ");



    $db->close();


    //echo "\n\n\n xml to array : ";
    //var_dump($xml_array);

}




if($F_GRPID == "4" && $REQ["G4_CRUD_MODE"] == "read"){
    alog("---------------GRP G4 ---------------------START");
    alog("        G4_CRUD_MODE : " . $REQ["G4_CRUD_MODE"]);


    //$colord = "COLID,ORD,ADDDT,MODDT";

    $to_coltype = "iii";
    alog("        to_coltype : " . $to_coltype);
    $sql = "
        select
		  a.PJTSEQ, a.PGMSEQ, a.GRPSEQ, a.IOSEQ, b.DDSEQ
          , a.COLID, a.COLORD, a.COLNM, a.DATATYPE,ifnull(a.VALIDSEQ,'') AS VALIDSEQ
          , a.DATASIZE, a.OBJTYPE, a.POPUP, a.BRYN, a.LBLHIDDENYN
          , a.LBLWIDTH, a.LBLALIGN, a.OBJWIDTH, a.OBJHEIGHT, a.OBJALIGN
          , a.KEYYN, a.SEQYN, a.HIDDENYN, a.EDITYN, a.FNINIT
          , a.ADDDT, a.MODDT
        from CG_PGMIO a
            left outer join CG_DD b on a.PJTSEQ = b.PJTSEQ and a.COLID = b.COLID
        where a.PJTSEQ=#F_PJTSEQ# and a.PGMSEQ = #F_PGMSEQ# and a.GRPSEQ = #G1_GRPSEQ#
        ORDER BY a.COLORD ASC
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


    $colord = "PJTSEQ,PGMSEQ,GRPSEQ,IOSEQ,DDSEQ,COLID,COLORD,COLNM,DATATYPE,VALIDSEQ,DATASIZE,OBJTYPE,POPUP,BRYN,LBLHIDDENYN,LBLWIDTH,LBLALIGN,OBJWIDTH,OBJHEIGHT,OBJALIGN,KEYYN,SEQYN,HIDDENYN,EDITYN,FNINIT,ADDDT,MODDT";

	$sql_inserted = "
		insert into CG_PGMIO (
							PJTSEQ,PGMSEQ,GRPSEQ,COLID,COLORD
							,COLNM,DATATYPE,DATASIZE,OBJTYPE,LBLHIDDENYN
                            ,LBLWIDTH, LBLALIGN, OBJWIDTH,OBJHEIGHT,OBJALIGN
                            ,HIDDENYN,EDITYN,FNINIT,KEYYN,SEQYN
                            ,VALIDSEQ,POPUP
							,ADDDT,ADDID
	   ) values (
							#F_PJTSEQ#,#F_PGMSEQ#,#G1_GRPSEQ#,#COLID#,#COLORD#
							,#COLNM#,#DATATYPE#,#DATASIZE#,#OBJTYPE#,#LBLHIDDENYN#
                            ,#LBLWIDTH#, #LBLALIGN#, #OBJWIDTH#, #OBJHEIGHT#, #OBJALIGN#
                            ,#HIDDENYN#,if(#EDITYN#='','Y',#EDITYN#),#FNINIT#,#KEYYN#,#SEQYN#
                            ,#VALIDSEQ#,#POPUP#
							,date_format(sysdate(),'%Y%m%d%H%i%s'),#ADDID#
	   )
	";
	$sql_inserted_coltype = "iiisi ssiss sssss ssssss is i";

	$sql_deleted = "
                delete from CG_PGMIO where PJTSEQ=#F_PJTSEQ# and PGMSEQ = #F_PGMSEQ# and GRPSEQ = #G1_GRPSEQ# and IOSEQ = #IOSEQ#
		";
	$sql_deleted_coltype = "ssss";

	$sql_updated = "
	  update CG_PGMIO set
			COLID = #COLID#, COLORD=#COLORD#, COLNM=#COLNM#, DATATYPE=#DATATYPE#, DATASIZE=#DATASIZE#
            ,OBJTYPE = #OBJTYPE#, LBLHIDDENYN=#LBLHIDDENYN#, LBLWIDTH=#LBLWIDTH#, LBLALIGN=#LBLALIGN#, OBJWIDTH=#OBJWIDTH#
            , OBJHEIGHT=#OBJHEIGHT#, OBJALIGN=#OBJALIGN#, HIDDENYN=#HIDDENYN#, EDITYN=#EDITYN#, FNINIT=#FNINIT#
            , KEYYN=#KEYYN#, SEQYN = #SEQYN#, BRYN=#BRYN#, VALIDSEQ = #VALIDSEQ#, POPUP = #POPUP#
			,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s'), MODID = #MODID#
	  where PJTSEQ=#F_PJTSEQ# and PGMSEQ = #F_PGMSEQ# and GRPSEQ = #G1_GRPSEQ# and IOSEQ = #IOSEQ#

	";
	$sql_updated_coltype = "sissi sssss sssss sssis i iiii";


	echo make_grid_save_json($db,$REQ,$colord,$xml_array,$sql_inserted,$sql_inserted_coltype,$sql_deleted,$sql_deleted_coltype,$sql_updated,$sql_updated_coltype,"N","COLID");



	//데이터 딕셔너리에 추가/수정해 주기
	updateDd($xml_array,$colord,$db,$REQ);




    $db->close();

}


function updateDd($xml_array,$colord,&$db,$REQ){
	alog("updateDd.......................................start()");
	$colord_array = explode(",",$colord);

	$xml_array_last = null;
	alog("is_assoc : " . is_assoc($xml_array["row"]) );
    if(is_assoc($xml_array["row"]) == 1) {
		alog(" Y " );
        $xml_array_last[0] = $xml_array["row"];
    }else{
		alog(" N " );

        $xml_array_last = $xml_array["row"];
    }
    //var_dump($xml_array_last);

    $RtnVal = null;
    $RtnCnt = 0;
	alog("xml sizeof : " . sizeof($xml_array_last));
    for($i=0;$i<sizeof($xml_array_last);$i++){
		alog("	i : " . $i);
        $row = $xml_array_last[$i];
        for($j=0;$j<sizeof($row["cell"]);$j++){
            $col = $row["cell"][$j];
            if(is_array($col)){
                $to_row[trim($colord_array[$j])] = "";
            }else{
                $to_row[trim($colord_array[$j])] = $col;
            }
		}


		$tarray = array_merge($REQ,$to_row);

		//이미 등록된 dd인지 확인하기
		$to_coltype = "is";
		$sql = "
			select
			  *
			from CG_DD
			where PJTSEQ=#{F_PJTSEQ} and COLID = #{COLID}
			";
		alog("        selected : " );
		$stmt = makeStmt($db,$sql, $to_coltype, $tarray);
		if(!$stmt)JsonMsg("500","100","stmt 생성 실패" . $db->errno . " -> " . $db->error);
		if(!$stmt->execute())JsonMsg("500","110","(makeGridSearchJson) stmt 실행 실패" . $db->errno . " -> " . $db->error);
		if($stmt->fetch()){
			$stmt->close();
			alog("데이터딕셔너리 UPDATE : " . $tarray["COLID"]);

			//이미 존재
			$to_coltype = "ssiss sssss is i is";
			$sql = "
				update CG_DD set
					COLNM = #{COLNM}, DATATYPE = #{DATATYPE}, DATASIZE = #{DATASIZE}, OBJTYPE = #{OBJTYPE}, LBLWIDTH = #{LBLWIDTH}
                    ,LBLHEIGHT = #{LBLHEIGHT}, LBLALIGN = #{LBLALIGN},  OBJWIDTH = #{OBJWIDTH}, OBJHEIGHT = #{OBJHEIGHT}, OBJALIGN = #{OBJALIGN}
                    , VALIDSEQ = #{VALIDSEQ}, POPUP = #{POPUP}
					,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s'), MODID = #{MODID}
				where PJTSEQ = #{F_PJTSEQ} and COLID = #{COLID}
				";
			
			$stmt = makeStmt($db,$sql, $to_coltype, $tarray);
			if(!$stmt)JsonMsg("500","10U","stmt 생성 실패" . $db->errno . " -> " . $db->error);
			if(!$stmt->execute())JsonMsg("500","11U","(makeGridSearchJson) stmt 실행 실패" . $db->errno . " -> " . $db->error);
			$stmt->close();

		}else{
			$stmt->close();
			alog("데이터딕셔너리 INSERT : " . $tarray["COLID"]);

			//신규 추가
			$to_coltype = "isssi sssss ssis i";
			$sql = "
				insert into CG_DD (
					PJTSEQ, COLID, COLNM, DATATYPE, DATASIZE
                    ,OBJTYPE, LBLWIDTH, LBLHEIGHT, LBLALIGN, OBJWIDTH
                    ,OBJHEIGHT, OBJALIGN, VALIDSEQ, POPUP
					,ADDDT, ADDID
				) values (
					#{F_PJTSEQ}, #{COLID}, #{COLNM}, #{DATATYPE}, #{DATASIZE}
                    ,#{OBJTYPE}, #{LBLWIDTH}, #{LBLHEIGHT}, #{LBLALIGN}, #{OBJWIDTH}
                    ,#{OBJHEIGHT}, #{OBJALIGN}, #{VALIDSEQ}, #{POPUP}
					,date_format(sysdate(),'%Y%m%d%H%i%s'), #{ADDID}
				)
				";
			
			$stmt = makeStmt($db,$sql, $to_coltype, $tarray);
			if(!$stmt)JsonMsg("500","10I","stmt 생성 실패" . $db->errno . " -> " . $db->error);
			if(!$stmt->execute())JsonMsg("500","11I","(makeGridSearchJson) stmt 실행 실패" . $db->errno . " -> " . $db->error);
			$stmt->close();

		}
        

        //데이터 딕셔너리 오브젝트 타입 등록하기
        $to_coltype = "iss i iss i";
        $sql = "
            insert into CG_DDOBJ (
                DDSEQ,GRPTYPE,OBJTYPE
                ,ADDDT, ADDID
            ) values (
                #{DDSEQ},#{G1_GRPTYPE},#{OBJTYPE}
                ,date_format(sysdate(),'%Y%m%d%H%i%s'), #{ADDID}
            )
            ON DUPLICATE KEY 
                UPDATE DDSEQ = #{DDSEQ}, GRPTYPE = #{G1_GRPTYPE}, OBJTYPE = #{OBJTYPE}
                ,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s'), MODID = #{MODID}
            ";
        
        $stmt = makeStmt($db,$sql, $to_coltype, $tarray);
        if(!$stmt)JsonMsg("500","10I","[CG_DDOBJ] stmt 생성 실패 " . $db->errno . " -> " . $db->error);
        if(!$stmt->execute())JsonMsg("500","11I","[CG_DDOBJ] stmt 실행 실패 " . $stmt->error);
        $stmt->close();

        
	}

	alog("updateDd.......................................end()");

}



if($F_GRPID == "5" && $REQ["G5_CRUD_MODE"] == "read"){
    alog("---------------GRP G5 ---------------------START");
    alog("        G5_CRUD_MODE : " . $REQ["G5_CRUD_MODE"]);


    //$colord = "COLID,ORD,ADDDT,MODDT";

    $to_coltype = "sis";
    alog("        to_coltype : " . $to_coltype);
    $sql = "
        select
          a.PJTSEQ, a.DDSEQ,a.COLID,a.COLNM,a.DATATYPE,a.DATASIZE
          ,ifnull(b.OBJTYPE,'') as OBJTYPE, a.POPUP, a.LBLWIDTH,a.LBLHEIGHT,a.OBJWIDTH
          ,a.OBJHEIGHT,a.VALIDSEQ, a.LBLALIGN, a.OBJALIGN
		  ,a.ADDDT,a.MODDT
        from CG_DD a
            left outer join CG_DDOBJ b on a.DDSEQ = b.DDSEQ and b.GRPTYPE = #G1_GRPTYPE#
        where a.PJTSEQ=#F_PJTSEQ# and a.COLID = #searchdd#
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
        where PJTSEQ=#F_PJTID# or 1=1
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
          GRPID,GRPTYPE,ORD,REFGRPID,VBOX,GRPWIDTH,GRPHEIGHT
        from CG_LAYOUTD
        where ( PJTSEQ=#F_PJTSEQ# or 1=1 ) and LAYOUTID = #F_LAYOUTID#
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
            PJTSEQ,PGMSEQ,GRPSEQ,FNCSEQ,IF(USEYN='Y',1,0) AS USEYN,FNCID,FNCCD,FNCNM,FNCTYPE,FNCORD,ADDDT,MODDT
          from CG_PGMFNC where PJTSEQ = #F_PJTSEQ# and PGMSEQ = #F_PGMSEQ# and GRPSEQ = #G1_GRPSEQ#
          ";
    alog("        selected : " );
    $stmt = make_stmt($db,$sql, $to_coltype, $REQ);
    if(!$stmt)   JsonMsg("500","100","stmt 생성 실패" . $db->errno . " -> " . $db->error);

    echo make_grid_read_json($stmt,3);

    $db->close();

}else if($REQ["F_GRPID"] == "7"){
    alog("---------------GRP G7 ---------------------START");
    alog("        G7_CRUD_MODE : " . $REQ["G7_CRUD_MODE"]);
    alog("        xmldata : " .$_POST["xmldata"]);

	$xml_array = getXml2Array($_POST["xmldata"]);


    //echo "\nxml_array row sizeof : " . sizeof($xml_array["row"]);
    //echo "\nxml_array is_assoc : " . is_assoc($xml_array["row"]);

    $colord = "PJTSEQ,PGMSEQ,GRPSEQ,FNCSEQ,USEYN,FNCID,FNCCD,FNCNM,FNCTYPE,FNCORD,ADDDT,MODDT";


    $sql_inserted = "
               insert into CG_PGMFNC (
									PJTSEQ,PGMSEQ,GRPSEQ,FNCID,FNCCD
									,FNCNM,FNCTYPE,USEYN,FNCORD
									,ADDDT
               ) values (
                                    #F_PJTSEQ#,#F_PGMSEQ#,#G1_GRPSEQ#,#FNCID#,#FNCCD#
									,#FNCNM#,#FNCTYPE#,case #USEYN# when 1 then 'Y' else 'N' end,#FNCORD#
									,date_format(sysdate(),'%Y%m%d%H%i%s')
               )
    ";
    $sql_inserted_coltype = "iiiss sssi";

    $sql_deleted = " delete from CG_PGMFNC where PJTSEQ = #PJTSEQ# and PGMSEQ = #PGMSEQ# and GRPSEQ = #GRPSEQ# and FNCSEQ = #FNCSEQ# ";
    $sql_deleted_coltype = "iiii";

    $sql_updated = "
              update CG_PGMFNC set
                    FNCID = #FNCID#, FNCCD = #FNCCD#, FNCNM = #FNCNM#, FNCTYPE = #FNCTYPE#, USEYN = case #USEYN# when 1 then 'Y' else 'N' end
                    , FNCORD = #FNCORD#
                    ,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
              where PJTSEQ = #PJTSEQ# and PGMSEQ = #PGMSEQ#  and GRPSEQ = #GRPSEQ# and FNCSEQ = #FNCSEQ#
    ";
    $sql_updated_coltype = "sssss i iiii";


    echo make_grid_save_json($db,$REQ,$colord,$xml_array,$sql_inserted,$sql_inserted_coltype,$sql_deleted,$sql_deleted_coltype,$sql_updated,$sql_updated_coltype,"Y","FNCSEQ");

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
			where a.PJTSEQ = #F_PJTSEQ# and b.PJTSEQ = #F_PJTSEQ# 
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

    $to_coltype = "iii";
    $sql = "
          select
			INHERITSEQ,PJTSEQ,PGMSEQ,GRPSEQ,COLID,CHILDGRPID,ADDDT,MODDT
          from CG_PGMINHERIT where PJTSEQ = #F_PJTSEQ# and PGMSEQ = #F_PGMSEQ# and GRPSEQ = #G1_GRPSEQ#
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

    $colord = "INHERITSEQ,PJTSEQ,PGMSEQ,GRPSEQ,COLID,CHILDGRPID,ADDDT,MODDT";


    $sql_inserted = "
               insert into CG_PGMINHERIT (
									PJTSEQ,PGMSEQ,GRPSEQ,COLID,CHILDGRPID
									,ADDDT
               ) values (
                                    #PJTSEQ#,#PGMSEQ#,#GRPSEQ#,#COLID#,#CHILDGRPID#
									,date_format(sysdate(),'%Y%m%d%H%i%s')
               )
    ";
    $sql_inserted_coltype = "iiiss";

    $sql_deleted = " delete from CG_PGMINHERIT where PJTSEQ = #PJTSEQ# and PGMSEQ = #PGMSEQ# and INHERITSEQ = #INHERITSEQ# ";
    $sql_deleted_coltype = "iii";

    $sql_updated = "
              update CG_PGMINHERIT set
					COLID = #COLID#, CHILDGRPID = #CHILDGRPID#
                    ,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
              where PJTSEQ = #PJTSEQ# and PGMSEQ = #PGMSEQ# and INHERITSEQ = #INHERITSEQ#
    ";
    $sql_updated_coltype = "ss iii";


    echo make_grid_save_json($db,$REQ,$colord,$xml_array,$sql_inserted,$sql_inserted_coltype,$sql_deleted,$sql_deleted_coltype,$sql_updated,$sql_updated_coltype,"Y","INHERITSEQ");

    //echo "\n\n\n xml to array : ";
    //var_dump($xml_array);
    $db->close();
}






//CG_PGMSQLR
if($REQ["F_GRPID"] == "10" && $REQ["G10_CRUD_MODE"] == "read"){
    alog("---------------GRP G9 ---------------------START");
    alog("        G10_CRUD_MODE : " . $REQ["G10_CRUD_MODE"]);

    $to_coltype = "iii";
    $sql = "
          select
			SQLRSEQ,PJTSEQ,PGMSEQ,SVCSEQ,SQLID,ORD,ADDDT,MODDT
          from CG_PGMSQLR where PJTSEQ = #F_PJTSEQ# and PGMSEQ = #F_PGMSEQ# and SVCSEQ = #G9_SVCSEQ#
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

    $colord = "SQLRSEQ,PJTSEQ,PGMSEQ,SVCSEQ,SQLID,ORD,ADDDT,MODDT";


    $sql_inserted = "
               insert into CG_PGMSQLR (
                                    PJTSEQ,PGMSEQ,SVCSEQ,SQLID,ORD
									,ADDDT
               ) values (
                                    #PJTSEQ#,#PGMSEQ#,#SVCSEQ#,#SQLID#,#ORD#
									,date_format(sysdate(),'%Y%m%d%H%i%s')
               )
    ";
    $sql_inserted_coltype = "iiisi";

    $sql_deleted = " delete from CG_PGMSQLR where PJTSEQ = #PJTSEQ# and PGMSEQ = #PGMSEQ# and SQLRSEQ = #SQLRSEQ# ";
    $sql_deleted_coltype = "ssi";

    $sql_updated = "
              update CG_PGMSQLR set
                    SQLID = #SQLID#, ORD = #ORD#
					,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
              where PJTSEQ = #PJTSEQ# and PGMSEQ = #PGMSEQ# and SQLRSEQ = #SQLRSEQ# 
    ";
    $sql_updated_coltype = "si iii";


    echo make_grid_save_json($db,$REQ,$colord,$xml_array,$sql_inserted,$sql_inserted_coltype,$sql_deleted,$sql_deleted_coltype,$sql_updated,$sql_updated_coltype,"Y","SQLRSEQ");

    //echo "\n\n\n xml to array : ";
    //var_dump($xml_array);
    $db->close();
}

//C 힌트로 SQLD에서 DD가져오기
if($REQ["F_GRPID"] == "11" && $REQ["G11_CRUD_MODE"] == "read"){
    alog("---------------GRP G11 ---------------------START");
    alog("        G11_CRUD_MODE : " . $REQ["G11_CRUD_MODE"]);

    $to_coltype = "iii";
    $sql = "
          select
            ifnull(b.DDSEQ,'') AS DDSEQ
            ,a.COLID,a.ORD
			,ifnull(b.COLNM,'') as COLNM
            ,ifnull(b.DATATYPE,'') as DATATYPE
            ,ifnull(b.VALIDSEQ,'') as VALIDSEQ            
			,ifnull(b.DATASIZE,'') as DATASIZE
            ,ifnull(b.OBJTYPE,'') as OBJTYPE
            ,ifnull(b.POPUP,'') as POPUP
            ,ifnull(b.LBLWIDTH,'') as LBLWIDTH
            ,ifnull(b.LBLALIGN,'') as LBLALIGN            
			,ifnull(b.OBJWIDTH,'') as OBJWIDTH
            ,ifnull(b.OBJHEIGHT,'') as OBJHEIGHT
            ,ifnull(b.OBJALIGN,'') as OBJALIGN
          from CG_PGMSQLD a
			left outer join CG_DD b on a.PJTSEQ = b.PJTSEQ and a.COLID = b.COLID
		  where a.SQLGBN = 'O' and a.PJTSEQ = #G1_PJTSEQ# and a.PGMSEQ = #G1_PGMSEQ# and a.SQLSEQ = #G2_SQLSEQ#
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
			VALIDSEQ,PJTSEQ,PGMSEQ,GRPSEQ,FNCSEQ,ORD,TIMETYPE,JOBTYPE,COLID,VAL1,VAL2,OPER,ANDOR,ACTION,MSG,SQLTXT,ADDDT,MODDT
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

    $to_coltype = "iiii";
    $sql = "
          select
			SVCSEQ,PJTSEQ,PGMSEQ,GRPSEQ,FNCSEQ,ORD,SVCGRPID,ADDDT,MODDT
          from CG_PGMSVC 
		  where PJTSEQ = #G5_PJTSEQ# and PGMSEQ = #G5_PGMSEQ# and GRPSEQ = #G5_GRPSEQ# and FNCSEQ = #G5_FNCSEQ#
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

    $colord = "SVCSEQ,PJTSEQ,PGMSEQ,GRPSEQ,FNCSEQ,ORD,SVCGRPID,ADDDT,MODDT";


    $sql_inserted = "
               insert into CG_PGMSVC (
									PJTSEQ,PGMSEQ,GRPSEQ,FNCSEQ,ORD
									,SVCGRPID
									,ADDDT
               ) values (
									#PJTSEQ#,#PGMSEQ#,#GRPSEQ#,#FNCSEQ#,#ORD#
									,#SVCGRPID#
									,date_format(sysdate(),'%Y%m%d%H%i%s')
               )
    ";
    $sql_inserted_coltype = "iiiii s";

    $sql_deleted = " delete from CG_PGMSVC where PJTSEQ = #PJTSEQ# and PGMSEQ = #PGMSEQ# and SVCSEQ = #SVCSEQ# ";
    $sql_deleted_coltype = "ssi";

    $sql_updated = "
              update CG_PGMSVC set
					ORD = #ORD#, SVCGRPID = #SVCGRPID#
					,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
              where PJTSEQ = #PJTSEQ# and PGMSEQ = #PGMSEQ# and SVCSEQ = #SVCSEQ# 
    ";
    $sql_updated_coltype = "is iii";


    echo make_grid_save_json($db,$REQ,$colord,$xml_array,$sql_inserted,$sql_inserted_coltype,$sql_deleted,$sql_deleted_coltype,$sql_updated,$sql_updated_coltype,"Y","SVCSEQ");

    //echo "\n\n\n xml to array : ";
    //var_dump($xml_array);
    $db->close();
}
?>
