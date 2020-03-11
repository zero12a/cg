<?php
    header("Content-Type: text/html; charset=UTF-8");
    header("Cache-Control:no-cache");
    header("Pragma:no-cache");

    //로그인 검사
    $CFG = require_once("../common/include/incConfig.php");
    
	require_once($CFG["CFG_LIBS_VENDOR"]);
	
	//로그인 검사
    require_once("../common/include/incUtil.php");
    require_once("../common/include/incUser.php");
    require_once("../common/include/incSec.php");
    require_once("../common/include/incDB.php");
	require_once("../common/include/incRequest.php");    

    require_once("/data/www/lib/php/PHP-SQL-Parser/src/PHPSQLParser.php");

	

    //ServerViewTxt("N","N","Y","Y");
	//외부 파라미터 받기
	$REQ["KEYCOLIDX"] = reqGetNumber("KEYCOLIDX",2);

	$REQ["SVRSEQ"] = reqGetNumber("SVRSEQ",3);    
	$REQ["SQLSEQ"] = reqGetNumber("SQLSEQ",10);
    $REQ["PJTSEQ"] = reqGetNumber("PJTSEQ",3);
	
	$REQ["crud"] = reqPostString("crud",10);	
	
	$map["XML"] = getXml2Array(reqPostString("PARAM-XML",10000));//GRP
	//$REQ["colords"] = $_POST["colords"];

	//10. 해당 프로젝트의 데이터 소스 정보 가져오기
	$svridCore = "CGCORE";
	$db[$svridCore] = getDbConn($CFG["CFG_DB"][$svridCore]);
	$sql = "select SVRID as DSNM from CG_SVR where SVRSEQ = #{SVRSEQ}";
	
	$sqlMap = getSqlParam($sql,$coltype="i",$REQ);
	//echo "<hr><pre>" . jsonView($sqlMap);
	$stmt = getStmt($db[$svridCore],$sqlMap);
	$svrInfo = getStmtArray($stmt)[0];

	//echo "<hr><pre>" . jsonView($svrInfo);

	$svridPjt = $svrInfo["DSNM"];
	closeStmt($stmt);
	//closeDb($db[$svridCore]);

	//20. 헤당 데이터소스 정보로 서비스 db연결하기
	if($svridPjt  == "")JsonMsg("500","501", "svrInfo DSNM is empty.");
	$db[$svridPjt] = getDbConn($CFG["CFG_DB"][$svridPjt ]);

	



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

	//var_dump($REQ);
	//exit;
	/*
    $stmt = makeStmt($db2,$sql, $to_coltype, $REQ);
	


	if(!$stmt)   JsonMsg("500","100","stmt create fail" . $db->errno . " -> " . $db->error);
	*/
	if($REQ["crud"] =="R"){

		$map["KEYCOLIDX"] = $REQ["KEYCOLIDX"];
		$map["SQL"]["R"]["SQLTXT"] = $sql;
		$map["SQL"]["R"]["BINDTYPE"] = $to_coltype;
		$map["SQL"]["R"]["SVRID"] = $svridPjt;

		echo json_encode(makeGridSearchJson($map,$db));

		//echo make_grid_read_json($stmt,2);
		closeDb($db[$svridPjt]);
	}else{
		$sqlMap = getSqlParam($sql,$to_coltype,$REQ);
		//echo "<hr><pre>" . jsonView($sqlMap);
		$stmt = getStmt($db[$svridPjt],$sqlMap);
		if(!$stmt)   JsonMsg("500","100","stmt create fail" . $db->errno . " -> " . $db->error);
		if(!$stmt->execute())JsonMsg("500","410","stmt execute fail" . $stmt->errno . " -> " . $stmt->error);

		if($stmt instanceof PDOStatement){
			//pdo
			$to_affected_rows = $stmt->rowCount();
		}else{
			//mysqli
			$to_affected_rows = $db[$svridPjt]->affected_rows;
		}

		closeDb($db[$svridPjt]);
		
		$RtnData->RTN_CD = "200";
		$RtnData->ERR_CD = "200";
		$RtnData->RTN_MSG = "처리 성공 (영향받은 건수:". $to_affected_rows . ")";
		$RtnData->RTN_DATA["SQLMAP"] = $sqlMap;
		
		echo json_encode($RtnData);
	}




}

?>
