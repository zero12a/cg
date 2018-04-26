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
	
	if(!$db)JsonMsg("500","100","db open 실패" . $db->errno . " -> " . $db->error);


    //그룹ID받기
    $REQ["F_GRPID"]			= $_GET['F_GRPID'];
    $REQ["G1_CRUD_MODE"]	= $_GET['G1_CRUD_MODE'];
    $REQ["G2_CRUD_MODE"]	= $_GET['G2_CRUD_MODE'];
    $REQ["F_PJTID"]			= $_GET['F_PJTID'];
    $REQ["F_PJTSEQ"]			= $_GET['F_PJTSEQ'];
	alog("F_PJTSEQ:" . $REQ["F_PJTSEQ"]);
    $REQ["F_PCD"]			= $_GET['F_PCD'];
    $REQ["F_PNM"]			= $_GET['F_PNM'];
    $REQ["F_DT_TYPE"]		= $_GET['F_DT_TYPE'];
    $REQ["F_START_DT"]		= str_replace("-","",$_GET['F_START_DT']); //날짜 타입은 - 제거
    $REQ["F_END_DT"]		= str_replace("-","",$_GET['F_END_DT']); //날짜 타입은 - 제거
    $REQ["G1_PCD"]			= $_GET['G1_PCD'];



alog("---------------GRP ".$REQ["F_GRPID"] ." ---------------------START");




if($REQ["F_GRPID"] == "1" && $REQ["G1_CRUD_MODE"] == "read"){
	alog("---------------G1_CRUD_MODE  : ".$REQ["G1_CRUD_MODE"] );
    $to_coltype = "s";
    $sql = "
		select PCD,PNM,ORD,PCDDESC,USEYN,UITOOL,ADDDT,MODDT from CG_CODE where DELYN='N' and PJTSEQ  = #F_PJTSEQ#
          ";

	
    $stmt = make_stmt($db,$sql, $to_coltype, $REQ);
    if(!$stmt)JsonMsg("500","100","stmt 생성 실패" . $db->errno . " -> " . $db->error);

    echo make_grid_read_json($stmt,0);
    $db->close();

}else if($REQ["F_GRPID"] == "1"){
	alog("---------------G1_CRUD_MODE  : ".$REQ["G1_CRUD_MODE"] );

    alog("        xmldata : " .$_POST["xmldata"]);


    $xml_array = getXml2Array($_POST["xmldata"]);

    $colord = "PCD,PNM,ORD,PCDDESC,USEYN,UITOOL,ADDDT,MODDT";

    $sql_inserted = "
               insert into CG_CODE (
                    PJTSEQ,PCD,PNM,ORD,USEYN
                    ,PCDDESC,UITOOL,ADDDT
                ) values (
                    #F_PJTSEQ#,#PCD#,#PNM#,#ORD#,#USEYN#
                    ,#PCDDESC#,#UITOOL#,date_format(sysdate(),'%Y%m%d%H%i%s')
                )
    ";
    $sql_inserted_coltype = "issis ss";

    $sql_deleted = "update CG_CODE set DELYN='Y' where PJTSEQ = #F_PJTSEQ# and PCD = #PCD# ";
    $sql_deleted_coltype = "ss";

    $sql_updated = "
                update CG_CODE set
                    PNM = #PNM#,ORD = #ORD#, USEYN = #USEYN#, PCDDESC = #PCDDESC#, UITOOL = #UITOOL#
					, MODDT =date_format(sysdate(),'%Y%m%d%H%i%s')
                where PJTSEQ = #F_PJTSEQ# and PCD = #PCD#
    ";
    $sql_updated_coltype = "sisss ss";



    echo make_grid_save_json($db,$REQ,$colord,$xml_array,$sql_inserted,$sql_inserted_coltype,$sql_deleted,$sql_deleted_coltype,$sql_updated,$sql_updated_coltype,$ai_yn="N",$key_colid="PCD");

    //echo "\n\n\n xml to array : ";
    //var_dump($xml_array);
    $db->close();
}



if($REQ["F_GRPID"] == "2" && $REQ["G2_CRUD_MODE"] == "read"){
	alog("---------------G2_CRUD_MODE : ".$REQ["G2_CRUD_MODE"] );

    $to_coltype = "ss";
    $sql = "
		select CD,NM,ORD,CDVAL,CDVAL2,CDDESC,CDMIN,CDMAX,DATATYPE,EDITYN,FORMATYN,USEYN,ADDDT,MODDT 
		from CG_CODED 
		where PJTSEQ = #F_PJTSEQ# and PCD = #G1_PCD# and DELYN = 'N'
		ORDER BY ORD ASC, CD ASC
          ";

	
    $stmt = make_stmt($db,$sql, $to_coltype, $REQ);
    if(!$stmt)JsonMsg("500","100","stmt 생성 실패" . $db->errno . " -> " . $db->error);

    echo make_grid_read_json($stmt,0);
    $db->close();

}else if($REQ["F_GRPID"] == "2"){
	alog("---------------G2_CRUD_MODE : ".$REQ["G2_CRUD_MODE"] );

	alog("        xmldata : " .$_POST["xmldata"]);

    $xml_array = getXml2Array($_POST["xmldata"]);

	$colord = "CD,NM,ORD,CDVAL,CDVAL2,CDDESC,CDMIN,CDMAX,DATATYPE,EDITYN,FORMATYN,USEYN,ADDDT,MODDT";

    $sql_inserted = "
		insert into CG_CODED (
			PJTSEQ,CD,NM,PCD,ORD
            ,CDVAL,CDVAL2,CDMIN,CDMAX,USEYN
            ,DELYN,CDDESC,EDITYN,FORMATYN,DATATYPE
			,ADDDT
		) values (
			#F_PJTSEQ#,#CD#,#NM#,#G1_PCD#,#ORD#
            ,#CDVAL#,#CDVAL2#,#CDMIN#,#CDMAX#,#USEYN#
            ,'N',#CDDESC#,#EDITYN#,#FORMATYN#,#DATATYPE#
			,date_format(sysdate(),'%Y%m%d%H%i%s')
		)
    ";
    $sql_inserted_coltype = "isssi sssss ssss";

    $sql_deleted = "delete from CG_CODED where PJTSEQ = #F_PJTSEQ# and PCD = #G1_PCD# and CD = #CD#  ";
    $sql_deleted_coltype = "sss";

    $sql_updated = "
		update CG_CODED set
            NM = #NM#, ORD = #ORD#, CDVAL = #CDVAL#, CDVAL2 = #CDVAL2#, CDMIN = #CDMIN#
            ,CDMAX = #CDMAX#,CDDESC = #CDDESC#,USEYN = #USEYN#,EDITYN = #EDITYN#,FORMATYN = #FORMATYN#
            ,DATATYPE = #DATATYPE#
			,MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
		where PJTSEQ = #F_PJTSEQ# and PCD = #G1_PCD# and CD = #CD#
    ";
    $sql_updated_coltype = "sisss sssss s iss";



    echo make_grid_save_json($db,$REQ,$colord,$xml_array,$sql_inserted,$sql_inserted_coltype,$sql_deleted,$sql_deleted_coltype,$sql_updated,$sql_updated_coltype,$ai_yn="N",$key_colid="CD");

    //echo "\n\n\n xml to array : ";
    //var_dump($xml_array);
    $db->close();
}


?>