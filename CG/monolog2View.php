<?php
//PGMID : MONOLOG2
//PGMNM : Copy of MONOLOG
header("Content-Type: text/html; charset=UTF-8"); //HTML

$CFG = require_once('../../common/include/incConfig.php');//CG CONFIG

require_once("../../common/include/incUtil.php");
require_once('../../common/include/incRequest.php');//CG REQUEST
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>	
<title>Copy of MONOLOG</title>
<meta http-equiv="Context-Type" context="text/html;charset=UTF-8" />
<!--CSS/JS 불러오기-->
<!--JS 불러오기-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/feather.min.js" type="text/javascript" charset="UTF-8"></script> <!--FEATHER ICON JS-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/jquery/jquery-3.4.1.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY CORE-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/jquery/jquery-ui.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY UI-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/tableExport/FileSaver.min.js" type="text/javascript" charset="UTF-8"></script> <!--BT4 TABLE EXPORT SAVER-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/tableExport/tableExport.min.js" type="text/javascript" charset="UTF-8"></script> <!--BT4 TABLE EXPORT-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/json2.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY JSON-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/hashmap.js" type="text/javascript" charset="UTF-8"></script> <!--HASHMAP-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/dhtmlxSuite/codebase/dhtmlx.js" type="text/javascript" charset="UTF-8"></script> <!--DHTMLX CORE-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/Chart.min.js" type="text/javascript" charset="UTF-8"></script> <!--Chart.js-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/moment.min.js" type="text/javascript" charset="UTF-8"></script> <!--Moment Date-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/bootstrap-table/bootstrap-table.min.js" type="text/javascript" charset="UTF-8"></script> <!--BT4 Table JS-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/bootstrap-table/locale/bootstrap-table-ko-KR.min.js" type="text/javascript" charset="UTF-8"></script> <!--BT4 Table JS Lang-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/codemirror/lib/codemirror.js" type="text/javascript" charset="UTF-8"></script> <!--CODE MIRROR1-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/codemirror/mode/sql/sql.js" type="text/javascript" charset="UTF-8"></script> <!--CODE MIRROR2-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/codemirror/addon/selection/active-line.js" type="text/javascript" charset="UTF-8"></script> <!--CODE MIRROR3-->

<!--CSS 불러오기-->
<link rel="stylesheet" href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>/common/common.css" type="text/css" charset="UTF-8"><!--FEATHER ICON CSS-->
<link rel="stylesheet" href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/dhtmlxSuite/codebase/dhtmlx.css" type="text/css" charset="UTF-8"><!--DHTMLX CORE-->
<link rel="stylesheet" href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/jquery/jquery-ui.min.css" type="text/css" charset="UTF-8"><!--JQUERY UI-->
<link rel="stylesheet" href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/bootstrap4/css/bootstrap.min.css" type="text/css" charset="UTF-8"><!--BOOTSTRAP V4-->
<link rel="stylesheet" href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/bootstrap-table/bootstrap-table.min.css" type="text/css" charset="UTF-8"><!--BT4 Table CSS-->
<link rel="stylesheet" href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/codemirror/lib/codemirror.css" type="text/css" charset="UTF-8"><!--CODE MIRROR CSS-->
<!--공통 js/css-->
<script src="/common/common.js?<?=getRndVal(10)?>"></script>
<link rel="stylesheet" href="/common/common.css?<?=getRndVal(10)?>" type="text/css" charset="UTF-8">

<script src="monolog2.js?<?=getRndVal(10)?>"></script>
<script>
	//팝업창인 경우 오프너에게서 파라미터 받기
    var grpId = "<?=getFilter(reqPostString("GRPID",20),"SAFEECHO","")?>";
    var rowId = "<?=getFilter(reqPostString("ROWID",30),"SAFEECHO","")?>";
    var colId = "<?=getFilter(reqPostString("COLID",30),"SAFEECHO","")?>";
    var btnNm = "<?=getFilter(reqPostString("BTNNM",30),"SAFEECHO","")?>";
</script>
</head>
<body onload="initBody();">

<div id="BODY_BOX" class="BODY_BOX"><!--그룹별 IO출력-->
	<!--
	#####################################################
	## 컨디션  - START G.GRPID : G1-
	#####################################################
	-->
 	<div class="GRP_OBJECT" style="width:100%;">
        <div class="GRP_GAP"><!--흰색 바깥 여백-->
            <div class="GRP_INNER" style="height:74px;">	
		
	  		<div style="width:0px;height:0px;overflow: hidden"><form id="condition" onsubmit="return false;"></div>
		<div class="CONDITION_LABELGRP">
			<div class="CONDITION_LABEL"  style="">
				<b>* Copy of MONOLOG</b>	
				<!--popup--><a href="?" target="_blank"><img src="/c.g/img/popup.png" height=10 align=absmiddle border=0></a>
				<!--reload--><a href="javascript:location.reload();"><img src="/c.g/img/reload.png" width=11 height=10 align=absmiddle border=0></a>
			</div>	
			<div class="CONDITION_LABELBTN">				<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G1_SEARCHALL" value="조회(전체)" onclick="G1_SEARCHALL(uuidv4());">
				<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G1_RESET" value="입력 초기화" onclick="G1_RESET(uuidv4());">
			</div>
		</div>
		<div style="height:32px;border-radius:3px;-moz-border-radius: 3px;" class="CONDITION_OBJECT">
			<DIV class="CON_LINE" is_br_tag>
		<!--컨디션 IO리스트-->
		<!--D101: STARTTXT, TAG-->
		<!--I.COLID : ADDDT-->
		<div class="CON_OBJGRP" style="">			<div class="CON_LABEL" style="width:100px;text-align:left;">
				ADDDT
			</div>
		<div class="CON_OBJECT">
			<input type="text" name="G1-ADDDT" value="" id="G1-ADDDT" style="width:80px;">
		</div>
	</div>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : LISTNM-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						LIST
					</div>
					<!-- style="width:80px;"-->
					<div class="CON_OBJECT">
	<!--LISTNM오브젝트출력-->						<input type="text" name="G1-LISTNM" value="<?=getFilter(reqPostString("LISTNM",30),"SAFEECHO","")?>" id="G1-LISTNM" style="width:80px;">
					</div>
				</div>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : LOGLEVEL-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						LEVEL
					</div>
					<!-- style="width:80px;"-->
					<div class="CON_OBJECT">
	<!--LOGLEVEL오브젝트출력-->						<input type="text" name="G1-LOGLEVEL" value="<?=getFilter(reqPostString("LOGLEVEL",30),"SAFEECHO","")?>" id="G1-LOGLEVEL" style="width:80px;">
					</div>
				</div>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : LOGMSG-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						MSG
					</div>
					<!-- style="width:100px;"-->
					<div class="CON_OBJECT">
	<!--LOGMSG오브젝트출력-->						<input type="text" name="G1-LOGMSG" value="<?=getFilter(reqPostString("LOGMSG",300),"SAFEECHO","")?>" id="G1-LOGMSG" style="width:100px;">
					</div>
				</div>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : CHANNEL-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						PGMID
					</div>
					<!-- style="width:100px;"-->
					<div class="CON_OBJECT">
	<!--CHANNEL오브젝트출력-->						<input type="text" name="G1-CHANNEL" value="<?=getFilter(reqPostString("CHANNEL",30),"SAFEECHO","")?>" id="G1-CHANNEL" style="width:100px;">
					</div>
				</div>
			</div><!-- is_br_tag end -->
		</div>
		<div style="width:0px;height:0px;overflow: hidden"></form></div>    
		</div></div>
	</div>
	<!--
	#####################################################
	## BI뷰  11 - START
	#####################################################
	-->
		<div class="GRP_OBJECT" id="DIV-G4-CLICK" style="width:50%;">
			<div class="GRP_GAP"><!--흰색 바깥 여백-->
				<div class="GRP_INNER" style="height:74px;overflow:hidden;">
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : VIEW1-->
                <div class="BI_ICON" style="float:left;width:30%;text-align:center;">
                        <i style="padding-top:9px;"
                        width="50"
                        height="50"
                        data-feather="eye"></i>
                </div>
                <div class="BI_VALUE"
                 style="width:70%;">
                    <span id="G4-VIEW1-VALUE">Value</span>
                </div>
                <div class="BI_LABEL" style="width:70%;">
                    <span id="G4-VIEW1-LABEL">VIEW1</span>
                </div>
				</div>
			</div>
		</div>
	<!--
	#####################################################
	## BI뷰  22 - START
	#####################################################
	-->
		<div class="GRP_OBJECT" id="DIV-G5-CLICK" style="width:50%;">
			<div class="GRP_GAP"><!--흰색 바깥 여백-->
				<div class="GRP_INNER" style="height:74px;overflow:hidden;">
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : VIEW2-->
 				<div class="BI_LABEL" style="float:left;width:70%;">
                    <span id="G5-VIEW2-LABEL">VIEW2</span>
                </div>
                <div class="BI_ICON" style="text-align:right;width:30%;">
                        <i style="padding-right:5px;padding-top:0px;"
                        color="silver" 
                        width="22"
                        height="22"
                        data-feather="eye"></i>
                </div>
                <div class="BI_VALUE" style="float:left;width:70%;">
                    <span id="G5-VIEW2-VALUE1">Value1</span>
                </div>
                <div class="BI_VALUE2 BI_VALUE2_TYPE3" style="font-width:bold;">
                    <span id="G5-VIEW2-VALUE2">Value2</span>
                </div>				</div>
			</div>
		</div>
	<!--
	#####################################################
	## 그리드 - START
	#####################################################
	-->
    <div class="GRP_OBJECT" style="width:60%;">
        <div class="GRP_GAP"><!--흰색 바깥 여백-->
		<div  class="GRID_LABELGRP">
			<div class="GRID_LABELGRP_GAP">	<!--그리드만 필요-->
  			<div id="div_gridG2_GRID_LABEL"class="GRID_LABEL" >
	  				* 로그      
			</div>
			<div id="div_gridG2_GRID_LABELBTN" class="GRID_LABELBTN"  style="">
				<span id="spanG2Cnt" name="그리드 ROW 갯수">N</span>
			<input type="button" class="btn btn-secondary  btn-sm" name="BTN_G2_EXCEL" value="엑셀다운로드" onclick="G2_EXCEL(uuidv4());">
			</div>
			</div><!--GAP-->
		</div>
		<div  class="GRID_OBJECT"  style="">
			<div id="gridG2"  style="background-color:white;overflow:hidden;height:455px;width:100%;"></div>
		</div>
		</div>
	</div>
	<!--
	#####################################################
	## 그리드 - END
	#####################################################
	-->
	<!--
	#####################################################
	## 폼뷰 상세 - START
	#####################################################
	-->
    <div class="GRP_OBJECT" style="width:40%;">
        <div class="GRP_GAP"><!--흰색 바깥 여백-->
            <div class="GRP_INNER" style="height:494px;">
				
			<div sty_le="width:0px;height:0px;overflow: hidden">
				<form id="formviewG3" name="formviewG3" method="post" enctype="multipart/form-data"  onsubmit="return false;">
				<input type="hidden" name="G3-CTLCUD"  id="G3-CTLCUD" value="">
			</div>	
		<div class="FORMVIEW_LABELGRP">
			<div class="FORMVIEW_LABEL"  style="">
				* 상세
			</div>
			<div class="FORMVIEW_LABELBTN"  style="">
			<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G3_RELOAD" value="새로고침" onclick="G3_RELOAD(uuidv4());">
			</div>
		</div>
		<div style="height:452px;" class="FORMVIEW_OBJECT">
			<DIV class="CON_LINE" is_br_tag>
			<!--OBJECT LIST PRINT.-->
		<!--D101: STARTTXT, TAG-->
		<!--I.COLID : LOGSEQ-->
			<div class="CON_OBJGRP" style="">
				<div class="CON_LABEL" style="width:70px;text-align:;">	
					SEQ	
				</div>	
				<!-- style="width:100;"-->
				<div class="CON_OBJECT">
					<div name="G3-LOGSEQ" id="G3-LOGSEQ" style="width:100px;"></div>
				</div>
			</div>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : LOGMSG-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:70px;text-align:;">
						MSG
					</div>
					<!-- style="width:400px;height:px;"-->
					<div class="CON_OBJECT">
			<!--LOGMSG오브젝트출력-->
			<span style="height:31px;overflow:hidden">
				<input class="btn btn-secondary  btn-sm" type="button" name="bigFont" value="+" onclick="changeCodemirrorFontSizeG3Logmsg('+')">
				<input class="btn btn-secondary  btn-sm" type="button" name="bigFont" value="-" onclick="changeCodemirrorFontSizeG3Logmsg('-')">
			</span>

			<textarea id="codeMirror_G3-LOGMSG" name="codeMirror_G3-LOGMSG" ></textarea>
					</div>
				</div>
			</DIV><!--is_br_tab end-->
		</div>
		<div style="width:0px;height:0px;overflow: hidden"></form></div>    
		</div>
		</div>
	</div>
	<!--
	#####################################################
	## 폼뷰 - END
	#####################################################
	-->
<div style="width:0px;height:0px;overflow: hidden">
	<form name="excelDownForm" id="excelDownForm">
	<input type="hidden" name="DATA_HEADERS" id="DATA_HEADERS">
	<input type="hidden" name="DATA_WIDTHS" id="DATA_WIDTHS">
	<input type="hidden" name="DATA_ROWS" id="DATA_ROWS">
	</form>
</div>
<div style="width:0px;height:0px;overflow: hidden">
	<form name="popupForm" id="popupForm">
	<input type="text" name="GRPID" id="GRPID">
	<input type="text" name="ROWID" id="ROWID">	
	<input type="text" name="COLID" id="COLID">
	<input type="text" name="BTNNM" id="BTNNM">
	</form>
</div>
</div>



</body>
</html>
