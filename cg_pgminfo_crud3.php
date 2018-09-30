<?php
    header("Content-Type: text/html; charset=UTF-8");
    header("Cache-Control:no-cache");
    header("Pragma:no-cache");


    include_once("./include/incUtil.php");
	include_once('./include/incRequest.php');//CG REQUEST    
    include_once("./incConfig.php");
    include_once("./include/incDB.php");
    include_once("./include/incUser.php");
	include_once('./include/incSEC.php');//CG SEC
    include_once("./cg_pgminfo_svc.php");

    include_once("./lib/PHP-SQL-Parser/src/PHPSQLParser.php");

	

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


    $REQ["G1-PJTSEQ"]   = $_GET['G1-PJTSEQ'];
    $REQ["G1-PGMSEQ"]   = $_GET['G1-PGMSEQ'];
    $REQ["G1-GRPSEQ"]   = $_GET['G1-GRPSEQ'];
    $REQ["G1-GRPTYPE"]   = $_GET['G1-GRPTYPE'];    
    $REQ["G1-GRPID"]   = $_GET['G1-GRPID'];
    $REQ["G1-PCD"]	   = $_GET['G1-PCD'];

    $REQ["G5-PJTSEQ"]   = $_GET['G5-PJTSEQ'];
    $REQ["G5-PGMSEQ"]   = $_GET['G5-PGMSEQ'];
    $REQ["G5-GRPSEQ"]   = $_GET['G5-GRPSEQ'];
    $REQ["G5-FNCSEQ"]   = $_GET['G5-FNCSEQ'];

    $REQ["G2-PJTSEQ"]   = $_GET['G2-PJTSEQ'];
    $REQ["G2-PGMSEQ"]   = $_GET['G2-PGMSEQ'];
    $REQ["G2-GRPSEQ"]   = $_GET['G2-GRPSEQ'];
    $REQ["G2-FNCSEQ"]   = $_GET['G2-FNCSEQ'];
    $REQ["G2-SQLID"]   = $_GET['G2-SQLID'];
    $REQ["G2-SQLSEQ"]   = $_GET['G2-SQLSEQ'];

    $REQ["G9-SVCSEQ"]  = $_GET['G9-SVCSEQ'];
    $REQ["G9-PJTSEQ"]   = $_GET['G9-PJTSEQ'];
    $REQ["G9-PGMSEQ"]   = $_GET['G9-PGMSEQ'];
    $REQ["G9-GRPSEQ"]   = $_GET['G9-GRPSEQ'];
    $REQ["G9-FNCSEQ"]   = $_GET['G9-FNCSEQ'];

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


    $REQ["GRP-XML"] = getXml2Array($_POST["GRP-XML"]);//GRP
    $REQ["FNC-XML"] = getXml2Array($_POST["FNC-XML"]);//FNC
    $REQ["IO-XML"] = getXml2Array($_POST["IO-XML"]);//IO
    $REQ["INHERIT-XML"] = getXml2Array($_POST["INHERIT-XML"]);//INHERIT
    $REQ["SVC-XML"] = getXml2Array($_POST["SVC-XML"]);//SVC
    $REQ["SQLR-XML"] = getXml2Array($_POST["SQLR-XML"]);//SQLR
    $REQ["SQL-XML"] = getXml2Array($_POST["SQL-XML"]);//SQL
    $REQ["SQLD-XML"] = getXml2Array($_POST["SQLD-XML"]);//SQLD

    //서비스 클래스 생성
    $objService = new cg_pgminfo_svc();

    //컨트롤 명령 받기
    $ctl = "";
    $ctl1 = reqGetString("CTLGRP",50);
    $ctl2 = reqGetString("CTLFNC",50);
    
    if($ctl1 == "" || $ctl2 == ""){
        JsonMsg("500","100","처리 명령이 잘못되었습니다.(no input ctl)");
    }else{
        $ctl = $ctl1 . "_" . $ctl2;
    }

    alog("ctl:" . $ctl);
    switch ($ctl){
        case "GRP_SEARCH" :
            echo $objService->goGrpSearch(); //
            break;
        case "GRP_SAVE" :
            echo $objService->goGrpSave(); //
            break;            
        case "SQL_SEARCH" :
            echo $objService->goSqlSearch(); //
            break;
        case "SQL_SAVE" :
            echo $objService->goSqlSave(); //
            break;      
        case "FNC_SEARCH" :
            echo $objService->goFncSearch(); //
            break;
        case "FNC_SAVE" :
            echo $objService->goFncSave(); //
            break;            
        case "IO_SEARCH" :
            echo $objService->goIoSearch(); //
            break;
        case "IO_SAVE" :
            echo $objService->goIoSave(); //
            break;            
        case "IOCD_SEARCH" :
            echo $objService->goIocdSearch(); //
            break;            
        case "INHERIT_SEARCH" :
            echo $objService->goInheritSearch(); //
            break;
        case "INHERIT_SAVE" :
            echo $objService->goInheritSave(); //
            break;            
        case "SVC_SEARCH" :
            echo $objService->goSvcSearch(); //
            break;      
        case "SVC_SAVE" :
            echo $objService->goSvcSave(); //
            break;   
        case "SQLR_SEARCH" :
            echo $objService->goSqlrSearch(); //
            break;
        case "SQLR_SAVE" :
            echo $objService->goSqlrSave(); //
            break;            
        case "SQLD_SEARCH" :
            echo $objService->goSqldSearch(); //
            break;        
        case "SQLD_SAVE" :
            echo $objService->goSqldSave(); //
            break;      
        case "PGM_SEARCH" :
            echo $objService->goPgmSearch(); //
            break;     
        case "LAYOUT_SEARCH" :
            echo $objService->goLayoutSearch(); //
            break;  
        case "LAYOUTD_SEARCH" :
            echo $objService->goLayoutdSearch(); //
            break;     
        case "FNCCD_SEARCH" :
            echo $objService->goFnccdSearch(); //
            break;  
        case "DD_SEARCH" :
            echo $objService->goDdSearch(); //
            break;                                            
        default:
            JsonMsg("500","110","처리 명령을 찾을 수 없습니다. (no search ctl)");
            break;
    }
exit;




if($F_GRPID == "2"){
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


if($F_GRPID == "3"){
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




if($F_GRPID == "4"){
    alog("---------------GRP G4 ---------------------START");
    alog("        G4_CRUD_MODE : " .$G4_CRUD_MODE);
    alog("        xmldata : " .$_POST["xmldata"]);

	$xml_array = getXml2Array($_POST["xmldata"]);


    $colord = "PJTSEQ,PGMSEQ,GRPSEQ,IOSEQ,DDSEQ,COLID,COLORD,COLNM,DATATYPE,VALIDSEQ,DATASIZE,OBJTYPE,POPUP,BRYN,LBLHIDDENYN,LBLWIDTH,LBLALIGN,OBJWIDTH,OBJHEIGHT,OBJALIGN,KEYYN,SEQYN,HIDDENYN,EDITYN,FNINIT,FORMAT,FOOTERNM,FOOTERMATH,ADDDT,MODDT";

	$sql_inserted = "
		insert into CG_PGMIO (
							PJTSEQ,PGMSEQ,GRPSEQ,COLID,COLORD
							,COLNM,DATATYPE,DATASIZE,OBJTYPE,LBLHIDDENYN
                            ,LBLWIDTH, LBLALIGN, OBJWIDTH,OBJHEIGHT,OBJALIGN
                            ,HIDDENYN,EDITYN,FNINIT,KEYYN,SEQYN
                            ,VALIDSEQ,POPUP,FORMAT,FOOTERNM,FOOTERMATH
							,ADDDT,ADDID
	   ) values (
							#F_PJTSEQ#,#F_PGMSEQ#,#G1-GRPSEQ#,#COLID#,#COLORD#
							,#COLNM#,#DATATYPE#,#DATASIZE#,#OBJTYPE#,#LBLHIDDENYN#
                            ,#LBLWIDTH#, #LBLALIGN#, #OBJWIDTH#, #OBJHEIGHT#, #OBJALIGN#
                            ,#HIDDENYN#,if(#EDITYN#='','Y',#EDITYN#),#FNINIT#,#KEYYN#,#SEQYN#
                            ,#VALIDSEQ#,#POPUP#, #FORMAT#, #FOOTERNM#, #FOOTERMATH#
							,date_format(sysdate(),'%Y%m%d%H%i%s'),#ADDID#
	   )
	";
	$sql_inserted_coltype = "iiisi ssiss sssss ssssss issss i";

	$sql_deleted = "
                delete from CG_PGMIO where PJTSEQ=#F_PJTSEQ# and PGMSEQ = #F_PGMSEQ# and GRPSEQ = #G1-GRPSEQ# and IOSEQ = #IOSEQ#
		";
	$sql_deleted_coltype = "ssss";

	$sql_updated = "
	  update CG_PGMIO set
			COLID = #COLID#, COLORD=#COLORD#, COLNM=#COLNM#, DATATYPE=#DATATYPE#, DATASIZE=#DATASIZE#
            ,OBJTYPE = #OBJTYPE#, LBLHIDDENYN=#LBLHIDDENYN#, LBLWIDTH=#LBLWIDTH#, LBLALIGN=#LBLALIGN#, OBJWIDTH=#OBJWIDTH#
            , OBJHEIGHT=#OBJHEIGHT#, OBJALIGN=#OBJALIGN#, HIDDENYN=#HIDDENYN#, EDITYN=#EDITYN#, FNINIT=#FNINIT#
            , KEYYN=#KEYYN#, SEQYN = #SEQYN#, BRYN=#BRYN#, VALIDSEQ = #VALIDSEQ#, POPUP = #POPUP#
            , FORMAT = #FORMAT#, FOOTERNM = #FOOTERNM#, FOOTERMATH = #FOOTERMATH#
			,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s'), MODID = #MODID#
	  where PJTSEQ=#F_PJTSEQ# and PGMSEQ = #F_PGMSEQ# and GRPSEQ = #G1-GRPSEQ# and IOSEQ = #IOSEQ#

	";
	$sql_updated_coltype = "sissi sssss sssss sssis sss i iiii";


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
                #{DDSEQ},#{G1-GRPTYPE},#{OBJTYPE}
                ,date_format(sysdate(),'%Y%m%d%H%i%s'), #{ADDID}
            )
            ON DUPLICATE KEY 
                UPDATE DDSEQ = #{DDSEQ}, GRPTYPE = #{G1-GRPTYPE}, OBJTYPE = #{OBJTYPE}
                ,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s'), MODID = #{MODID}
            ";
        
        $stmt = makeStmt($db,$sql, $to_coltype, $tarray);
        if(!$stmt)JsonMsg("500","10I","[CG_DDOBJ] stmt 생성 실패 " . $db->errno . " -> " . $db->error);
        if(!$stmt->execute())JsonMsg("500","11I","[CG_DDOBJ] stmt 실행 실패 " . $stmt->error);
        $stmt->close();

        
	}

	alog("updateDd.......................................end()");

}





//CG_PGMSQLR
if($REQ["F_GRPID"] == "10"){
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
		  where a.SQLGBN = 'O' and a.PJTSEQ = #G1-PJTSEQ# and a.PGMSEQ = #G1-PGMSEQ# and a.SQLSEQ = #G2-SQLSEQ#
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




?>
