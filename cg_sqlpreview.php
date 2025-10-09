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
    //require_once("./incConfig.php");

    require_once("../common/include/incLoginCheck.php");//로그인 검사


    $log = getLogger(
        array(
        "LIST_NM"=>"log_CG"
        , "PGM_ID"=>"SQLPREVIEW"
        , "REQTOKEN" => $reqToken
        , "RESTOKEN" => $resToken
        , "LOG_LEVEL" => Monolog\Logger::INFO
        )
    );



    //외부 파라미터 받기
	$REQ["SVRSEQ"] = reqGetNumber("SVRSEQ",3);    
	$REQ["SQLSEQ"] = reqGetNumber("SQLSEQ",10);
    $REQ["PJTSEQ"] = reqGetNumber("PJTSEQ",3);
    
    //프로젝트seq가지고 core에서 프로젝트 ds정보 가져오기
    $svridCore = "CGCORE";
    $db[$svridCore] = getDbConn($CFG["CFG_DB"][$svridCore]);
    $sql = "select * from CG_PJTINFO where PJTSEQ = #{PJTSEQ}";
    
    //$stmt = makeStmt($db[$svridCore],$sql,$coltype="i",$map["F_PJTSEQ"] = $F_PJTSEQ);
    //$pjtInfo = getStmtArray($stmt)[0];
    
    $sqlMap = getSqlParam($sql,$coltype="i",$REQ);
    $stmt = getStmt($db[$svridCore],$sqlMap);
    $pjtInfo = getStmtArray($stmt)[0];
    closeStmt($stmt);


    //DB연결정보 가져오기
    $svrid = $pjtInfo["DSNM"];
    //echo "svrid = " . $svrid;
    $db[$svrid] = getDbConn($CFG["CFG_DB"][$svrid]);


    //sqlseq로 db에서 sql쿼리문 가져오기
	$map["SQL"]["R"]["SVRID"] = $svrid;
	$map["SQL"]["R"]["SQLTXT"] = "select * from CG_PGMSQL where SQLSEQ = #{SQLSEQ} ";
	$map["SQL"]["R"]["BINDTYPE"] = "i";
	$rstMap = makeFormviewSearchJson($map,$db);


    //sqlcol문에서 input 컬럼 목록 가져오기
	$map["SQL"]["R"]["SVRID"] = $svrid;    
    $map["SQL"]["R"]["SQLTXT"] = "
        select a.COLID, ifnull(b.DATATYPE,'STRING') as DATATYPE from 
            CG_PGMSQLD a left outer join CG_DD b on a.PJTSEQ = b.PJTSEQ and a.COLID = b.COLID
        where SQLSEQ = #{SQLSEQ} and SQLGBN='I' order by ORD ASC ";
	$map["SQL"]["R"]["BINDTYPE"] = "i";
	$rstInputList = makeDataviewSearchJson($map,$db);

    //sqlcol문에서 output 컬럼 목록 가져오기
	$map["SQL"]["R"]["SVRID"] = $svrid;    
	$map["SQL"]["R"]["SQLTXT"] = "select * from CG_PGMSQLD where SQLSEQ = #{SQLSEQ} and SQLGBN='O' order by ORD ASC ";
	$map["SQL"]["R"]["BINDTYPE"] = "i";
	$rstOutputList = makeDataviewSearchJson($map,$db);



	//현재 프로젝트의 db접속 정보 불러오기
	

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>PGM</title>
    <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<style>
    body {margin:0;padding:0}
    div,input {font-size: 11px;}

    #F_START_DT, #F_END_DT {
        border: 1px solid #909090;
    }


    .BODY_BOX {100%;background-color:yellowgreen;padding:5px 5px 5px 5px;}

    .CON_LINE {position: relative;width:100%;height:22px;line-height;122px;overflow:visible;}
    .CON_OBJGRP {position: relative;float:left;background-color: #eeeeee;height:22px;line-height:22px;vertical-align:middle ;overflow:visible;}
    .CON_LABEL {position: relative;float:left;background-color: #eeeeee;height:22px;line-height:22px;vertical-align:middle ;padding-left:5px;}
    .CON_OBJECT {position: relative;float:left;background-color: #eeeeee;height:22px;line-height:22px;vertical-align:middle ;}
    .CON_LINEBREAK {position: relative;height:5px;overflow:auto;}

    .GRID_LABELGRP {position:relative;width:100%;height:22px;z-index:20;}
    .GRID_LABEL {position:relative;float:left;width:20%;height:22px;line-height:22px;vertical-align:middle;z-index:30;}
    .GRID_LABELBTN {position: relative;float:left;width:80%;height:22px;line-height:22px;vertical-align:middle;text-align:right;z-index:30;}
    .GRID_OBJECT {position: relative;width:100%;padding:0 0 0 0;z-index:20;}

    .GRP_LINE {position: relative;width:100%;z-index:10;overflow:auto;}
    .GRP_OBJECT {position: relative;float:left;z-index:20;}
</style>
	<!--jquery / json-->
	<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/jquery/jquery-1.12.4.min.js"></script>
	<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/json2.min.js"></script>

	<!--dhmltx-->
    <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/dhtmlxSuite/codebase/dhtmlx.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>/lib/dhtmlxSuite/codebase/dhtmlx.css" type="text/css" charset="utf-8">

    <!--chart-->
    <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/Chart.min.js" type="text/javascript" charset="UTF-8"></script> <!--Chart.js-->
    <script src="/common/chartjs_util.js" type="text/javascript" charset="UTF-8"></script> <!--Chart.js-->

    <!--codemirror-->
    <link rel=stylesheet href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/codemirror/lib/codemirror.css">

    <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/codemirror/lib/codemirror.js"></script>
    <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/codemirror/mode/sql/sql.js"></script>
    <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/codemirror/mode/javascript/javascript.js"></script>    
    <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/codemirror/addon/selection/active-line.js"></script>

    <!--공통-->
    <script>
    var CFG_URL_LIBS_ROOT = "<?=$CFG["CFG_URL_LIBS_ROOT"]?>";
    </script>
    <script src="/common/common.js?<?=getRndVal(10)?>" type="text/javascript" charset="utf-8"></script>    
    <link href="/common/common.css" rel="stylesheet" type="text/css" />



    <style>
        .CodeMirror {
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            width:100%;height:222px;
        }
        .cm-tab {
            background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAMCAYAAAAkuj5RAAAAAXNSR0IArs4c6QAAAGFJREFUSMft1LsRQFAQheHPowAKoACx3IgEKtaEHujDjORSgWTH/ZOdnZOcM/sgk/kFFWY0qV8foQwS4MKBCS3qR6ixBJvElOobYAtivseIE120FaowJPN75GMu8j/LfMwNjh4HUpwg4LUAAAAASUVORK5CYII=);
            background-position: right;
            background-repeat: no-repeat;
        }
    </style>







    <script>

    //정적 변수 선언
    var colords;//서버에 컬럼 목록 전송용.
	var popSelectLayout; //레이아웃용
    var myCalendar;
    var lastCondition;
    var mygrid1,dp1,addstatusyn1,lastinput1,lastinput1json,lastrowid1;
    var mygrid2,dp2,addstatusyn2,lastinput2,lastinput2json,lastrowid2;
    var mygrid1_url = "cg_sqlpreview_crud.php?F_GRPID=1&";
    var mygrid2_url = "cg_sqlpreview_crud.php?F_GRPID=2&";
    var validmsg = jQuery.parseJSON('{"REQUARED":"[0]는 반드시 입력바랍니다.", "MIN":"this는 [0]이상 입력바랍니다."}');

	var isLayoutLoaded = false;

    //동적 변수 선언
    var obj_condition_valid = jQuery.parseJSON( '{"__NAME":"obj_condition_valid"' +
        ' ,"F_PJTID": {"REQUARED":"N",  "MIN":"0",  "MAX":"ZZZ",  "DATASIZE":10,  "DATATYPE":"STRING"} ' +
        ' ,"F_PGMID": {"REQUARED":"N",  "MIN":"0",  "MAX":"ZZZ",  "DATASIZE":10,  "DATATYPE":"STRING"} ' +
        '}');
    var obj_G4_valid = jQuery.parseJSON( '{"__NAME":"obj_G4_valid"' +
        ' ,"OBJTYPE": {"REQUARED":"N",  "MIN":"0",  "MAX":"ZZZ",  "DATASIZE":10,  "DATATYPE":"STRING"} ' +
        ' ,"F_PGMID": {"REQUARED":"N",  "MIN":"0",  "MAX":"ZZZ",  "DATASIZE":10,  "DATATYPE":"STRING"} ' +
        '}');


    //화면 초기화
    function initBody(){

		//dhtmlx 메시지 박스 초기화
		dhtmlx.message.position="bottom"

		
        //코드 미러 초기화
        cm = CodeMirror.fromTextArea(document.getElementById('code'), {
            mode: "text/x-sql",
            styleActiveLine: true,
            indentWithTabs: true,
            smartIndent: true,
            lineNumbers: true,
            matchBrackets : true,
            tabSize: 4,
            indentUnit: 4,
            indentWithTabs: true,
			extraKeys: {"Ctrl-Space": "autocomplete"},
			hintOptions: {tables: {
			  users: {name: null, score: null, birthDate: null},
			  countries: {name: null, population: null, size: null}
			}}
        });
        //cm.setValue("");

        //그리드 초기화(파라미터)
        mygrid1 = new dhtmlXGridObject('grid1');
		mygrid1.setUserData("","gridTitle","grid1 : group list"); //글로별 변수에 그리드 타이블 넣기
        mygrid1.setImagePath("./lib/dhtmlxSuite/codebase/imgs/");
        mygrid1.setHeader("NO,NAME,DATATYPE,VALUE");
        mygrid1.setColumnIds("NO,NAME,DATATYPE,VALUE");
        mygrid1.setInitWidths("40,80,40,*")
        mygrid1.setColTypes("ro,ro,ro,ed");
		mygrid1.setColSorting("str,str,str,str");

		mygrid1.enableSmartRendering(false);
        mygrid1.enableMultiselect(false);
        mygrid1.init();

		mygrid1_addparam();

        <?php
        //crud is R
        if($rstMap->RTN_DATA["CRUD"] == "R"){

        ?>
        //그리드 초기화(실행결과)
        mygrid2 = new dhtmlXGridObject('grid2');
		mygrid2.setUserData("","gridTitle","grid1 : group list"); //글로별 변수에 그리드 타이블 넣기
        mygrid2.setImagePath("./lib/dhtmlxSuite/codebase/imgs/");

        mygrid2.setHeader("<?php
		//파라미터 갯수만큼 loop돌면서 출력	
		for($i=0;$i<count($rstOutputList);$i++){
			if($i>0){ echo ","; }
			echo $rstOutputList[$i]["COLID"];
		}
        ?>");
        
        mygrid2.setColumnIds("<?php
        //파라미터 갯수만큼 loop돌면서 출력	
        $tCols = "";
		for($i=0;$i<count($rstOutputList);$i++){
			if($i>0){ $tCols .= ","; }
			$tCols .= $rstOutputList[$i]["COLID"];
		}
        echo $tCols;
        ?>");
        
        colords = "<?=$tCols?>";//서버에 전송용.

        mygrid2.setInitWidthsP("<?php
		//파라미터 갯수만큼 loop돌면서 100%/갯수 출력	
		for($i=0;$i<count($rstOutputList);$i++){
			if($i>0){ echo ","; }
			echo round(100/count($rstOutputList), 0, PHP_ROUND_HALF_DOWN) ;
		}
		?>")
        mygrid2.setColTypes("<?php
		//파라미터 갯수만큼 loop돌면서 ro 출력	
		for($i=0;$i<count($rstOutputList);$i++){
			if($i>0){ echo ","; }
			echo "ro";
		}
		?>");
		mygrid2.setColSorting("<?php
		//파라미터 갯수만큼 loop돌면서 str 출력	
		for($i=0;$i<count($rstOutputList);$i++){
			if($i>0){ echo ","; }
			echo "str";
		}
		?>");

		mygrid2.enableSmartRendering(false);
        mygrid2.enableMultiselect(false);
        mygrid2.init();

        <?php
        }//crud is R
        ?>


		alog("initBody-----------------------------end");

    }//initBody();



	function mygrid1_addparam(){
		var tCols;
		<?php
		//파라미터 갯수만큼 loop돌면서 str 출력	
		for($i=0;$i<count($rstInputList);$i++){
			?>
		tCols = ["<?=$i+1?>","<?=$rstInputList[$i]["COLID"]?>","<?=$rstInputList[$i]["DATATYPE"]?>","?"];//초기값
		addRowLast(mygrid1,tCols,false);//행추가				
			
			<?php
		}
		?>	
	}

    function sqlChange(){
        if(opener && opener.cm){
            //alert("오프너 인식됨");

            opener.goSqlChange($("#code").val());
            alert("오프너 저장됨");
        }
    }
    
	function sqlExecute(){
        alog("sqlExecute()------------start");


        var crud = "<?=$rstMap->RTN_DATA["CRUD"]?>";

        //그리드 초기화
        if(crud == "R"){
            mygrid2.clearAll();
        }
        //var myJsonString = mygrid1.serializeJson();
        
        mygrid1.setSerializationLevel(true,false,false,false,true,false);
        //mygridIo.serialize();
        var myXmlString = mygrid1.serialize();
        alog("myXmlString=" + myXmlString);


		//alog("	serializeJson:" + myJsonString);
		tinput = "&PJTSEQ=<?=$REQ["PJTSEQ"]?>&SVRSEQ=<?=$REQ["SVRSEQ"]?>&SQLSEQ=<?=$REQ["SQLSEQ"]?>&KEYCOLIDX=" + $("#KEYCOLIDX").val();

        //alert(mygrid1.cells(mygrid1.getSelectedRowId(), 1).getValue());
		//alert($("#code").val());
        //불러오기
        $.ajax({
            type : "POST",
            url : mygrid2_url+"&G2_CRUD_MODE=read&" + tinput ,
            data : {"PARAM-XML" : myXmlString,  sqltxt : $("#code").val(), colords : colords, crud : crud},
            dataType: "json",
            async: true,
            success: function(data){
                alog("   sqlExecute json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
					var row_cnt = 0;
					if(data.RTN_DATA){

                        if(crud == "R"){
                            mygrid2.parse(data.RTN_DATA,"json");
                            row_cnt = data.RTN_DATA.rows.length;
                            msgNotice("[SELECT RESULT] 조회 성공했습니다. ("+row_cnt+"건)",3);
                        }else{
                            $("#grid2").html("<pre>" + data.RTN_DATA.SQLMAP.DEBUG_SQL + "<pre>");
                            msgNotice(data.RTN_MSG,3);
                        }

                    }else{
                        msgNotice(data.RTN_MSG,3);
                    }


                }else{
                    msgError("[SELECT RESULT] 서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[SELECT RESULT] Ajax http 500 error ( " + error + " )",3);
                alog("[SELECT RESULT] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("sqlExecute()------------end");
	}


    </script>


</head>
<body onload="initBody();">

<div id="BODY_BOX" class="BODY_BOX">
	<div  class="GRID_LABELGRP" >
		<div class="GRID_LABEL" >* SQL PREVIEW 
			<!--popup--><a href="?" target="_blank"><img src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>img/popup.png" height=10 align=absmiddle border=0></a>
			<!--reload--><a href="javascript:location.reload();"><img src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>img/reload.png" width=11 height=10 align=absmiddle border=0></a>
		</div>
	</div>

    <div class="GRP_LINE" style="">

        <div class="GRP_OBJECT" style="width:70%;">
        KEYCOLIDX : <input type="text" id="KEYCOLIDX" name="KEYCOLIDX" value=1>
            <textarea id="code" name="code"><?=$rstMap->RTN_DATA["SQLTXT"]?></textarea>
        </div>
        <div class="GRP_OBJECT" style="width:30%;">
            <div  class="GRID_LABELGRP" >
                <div class="GRID_LABEL" >* COL</div>
                <div  class="GRID_LABELBTN"  >
                <input type="button" name="add" value="+" onclick="addRow();">
                <input type="button" name="delete" value="-" onclick="delRow(mygrid1);">
                </div>
            </div>

            <div class="GRID_OBJECT" >
                <div id="grid1" width="100%" height="200px" style="background-color:white;z-index:3;"></div>
            </div>
        </div>


    </div>
    <div class="GRP_LINE" style="">

        <div class="GRP_OBJECT" style="width:100%;">
            <div  class="GRID_LABELGRP" >
			<input type="button" style="width:100%" name="EXECUTE" value="EXECUTE" onclick="sqlExecute()">
            <!--<input type="button" style="width:19%" name="CHANGE" value="CHANGE THIS SQL" onclick="sqlChange()">-->
            </div>
        </div>

    </div>



    <div class="GRP_LINE" style="">

        <div class="GRP_OBJECT" style="width:100%;">

            <div  class="GRID_LABELGRP" >
                <div class="GRID_LABEL" >* SELECT RESULT</div>
                <div  class="GRID_LABELBTN"  >
					실행결과 : 
				</div>
            </div>
            <div class="GRID_OBJECT" >
                <div id="grid2" width="100%" height="200px" style="background-color:white;z-index:40;"></div>
            </div>
        </div>

    </div>

</div>
<div id="div_layout" style="display: none;background-color:silver;position:absolute;top:24px;left:10px;overflow: auto;width:100%;z-index;100">

</div>

<div style="width:0px;height:0px;overflow: hidden"></form></div>
</body>
</html>
