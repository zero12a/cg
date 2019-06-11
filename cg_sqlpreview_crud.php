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
	$REQ["crud"] = $_POST["crud"];	
	
	$map["XML"] = getXml2Array($_POST["PARAM-XML"]);//GRP
	//$REQ["colords"] = $_POST["colords"];

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

    $sql = $F_SQLTXT;

	if(is_assoc($map["XML"]["row"]) == 1) {
		alog(" Y " );
		$xml_array_last[0] = $map["XML"]["row"];
	}else{
		alog(" N " );

		$xml_array_last = $map["XML"]["row"];
	}
	//var_dump($xml_array_last);
	alog("xml sizeof : " . sizeof($xml_array_last));

	$colord_array = explode(",","NO,NAME,DATATYPE,VALUE");

	$to_coltype = "";
	for($i=0;$i<sizeof($xml_array_last);$i++){

		$row = $xml_array_last[$i];
		//alog("        i : " . $i);
		//alog("        @attributes : " . $row["@attributes"]["id"]);
		//alog("        userdata : " . $row["userdata"]);

		//현재 그리드 line을 bind 배열에 담기
		$to_row = null;

		for($j=0;$j<sizeof($row["cell"]);$j++){
			$col = $row["cell"][$j];
			if(is_array($col)){
				$to_row[trim($colord_array[$j])] = "";
			}else{
				//암호화 컬럼에 존재 하는지 확인
				if($colcrypt_array[trim($colord_array[$j])] == "CRYPT" ){
					//양방향 암호화
					alog("  crypt 전 col/key: [" . $col . "]/" . $CFG_SEC_KEY);
					alog("  crypt 후 : [" .  aes_encrypt($col,$CFG_SEC_KEY) . "]");                        
					$to_row[trim($colord_array[$j])] = aes_encrypt($col,$CFG_SEC_KEY);
				}else if($colcrypt_array[trim($colord_array[$j])] == "HASH" ){
					//일방향 암호화
					alog("  hash 전 col/salt: [" . $col . "]/" . $CFG_SEC_SALT);
					alog("  hash 후 : [" .  pwd_hash($col,$CFG_SEC_SALT) . "]");                        
					$to_row[trim($colord_array[$j])] = pwd_hash($col,$CFG_SEC_SALT);
				}else{
					//평문
					//alog("  [평문] " . trim($colord_array[$j]) . " = " . $col);
					$to_row[trim($colord_array[$j])] = $col;
				}
			}
			
		}
		$to_coltype .= ($to_row["DATATYPE"]=="NUMBER")?"i":"s";
		$REQ[$to_row["NAME"]] = $to_row["VALUE"];
		alog("param " . $to_row["NAME"] . "=" . $to_row["VALUE"]);
	}
	//alog("to_coltype=" . $to_coltype);

    $stmt = makeStmt($db2,$sql, $to_coltype, $REQ);
	if(!$stmt)   JsonMsg("500","100","stmt 생성 실패" . $db->errno . " -> " . $db->error);
	
	if($REQ["crud"] =="R"){
		echo make_grid_read_json($stmt,2);
		$db2->close();
	}else{
		if(!$stmt->execute())JsonMsg("500","410","stmt 실행 실패" . $stmt->errno . " -> " . $stmt->error);
		$db2->close();
		JsonMsg("200","200","처리 성공");
	}




}

?>
