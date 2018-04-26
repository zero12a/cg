<?php
    header("Content-Type: text/html; charset=UTF-8");
    header("Cache-Control:no-cache");
    header("Pragma:no-cache");


    require_once("./include/incUtil.php");
    require_once("./incConfig.php");
    require_once("./include/incDB.php");
	require_once("./include/incSEC.php");
	
    require_once("./lib/PHP-SQL-Parser/src/PHPSQLParser.php");

	

    //ServerViewTxt("N","N","Y","Y");
	//외부 파라미터 받기
	$REQ["SQLSEQ"] = $_GET["SQLSEQ"];

	$svrid = "CG";
    $db[$svrid]=db_m_open();
	
	//현재 프로젝트의 db연결 정보 가져오기
	$map["SQL"]["R"]["SVRID"] = $svrid;
	$map["SQL"]["R"]["SQLTXT"] = "select a.SVRSEQ,b.SVRID from CG_PGMSQL a join CG_SVR b on a.SVRSEQ = b.SVRSEQ where a.SQLSEQ = #{SQLSEQ}";
	$map["SQL"]["R"]["BINDTYPE"] = "i";
    $rtnMap = makeFormviewSearchJson($map,$db);

	$svrid2 = $rtnMap->RTN_DATA["SVRID"];
	//db 닫기
	$db[$svrid]->close();
	
	//db 열기
	$db2 = db_obj_open(getDbSvrInfo($svrid2));


	//내부함수 호출 후 리던 배열 
	$rtnArr = array();

    //컬럼ROW받기 GRPID,GRPTYPE,GRPNM,GRPORD,BRCNT,REFGRPID,GRPWIDTH,GRPHEIGHT,COLSIZETYPE,
	$F_GRPID =  $_GET['F_GRPID'];
	$F_SQLSEQ =  $_GET['F_SQLSEQ'];
	$F_SQLTXT =  $_POST['sqltxt'];
    $REQ["G2_CRUD_MODE"] = $_GET['G2_CRUD_MODE'];



if($F_GRPID == "2" && $REQ["G2_CRUD_MODE"] == "read"){

	$json_array = json_decode($_POST["jsondata"],true);
	alog("	json_array.COLS count = " . count($json_array["REQ_DATA"]["COLS"]) );
	alog("	json_array.ROWS count = " . count($json_array["REQ_DATA"]["ROWS"]) );
	alog("	json_array.error : " . json_last_error()); // 4 (JSON_ERROR_SYNTAX)
	alog("	json_array.error_msg : " .json_last_error_msg()); // unexpected character 

	$to_coltype = "";
	for($i=0;$i<count($json_array["REQ_DATA"]["ROWS"]);$i++){
	    alog("        datatype : " . $json_array["REQ_DATA"]["ROWS"][$i]["cell"][2]);

		if($json_array["REQ_DATA"]["ROWS"][$i]["cell"][2] == "STRING"){
			$to_coltype .= "s";
		}else{
			$to_coltype .= "i";
		}
		$REQ[$json_array["REQ_DATA"]["ROWS"][$i]["cell"][1]] = $json_array["REQ_DATA"]["ROWS"][$i]["cell"][3];
	}
    alog("        to_coltype : " . $to_coltype);
    $sql = $F_SQLTXT;
    alog("        selected : " );
    $stmt = makeStmt($db2,$sql, $to_coltype, $REQ);
    if(!$stmt)   JsonMsg("500","100","stmt 생성 실패" . $db->errno . " -> " . $db->error);
    echo make_grid_read_json($stmt,2);

    $db2->close();

}

?>
