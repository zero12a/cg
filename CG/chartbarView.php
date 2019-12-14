<?php
//PGMID : CHARTBAR
//PGMNM : 챠트
header("Content-Type: text/html; charset=UTF-8"); //HTML

$CFG = require_once('../../common/include/incConfig.php');//CG CONFIG

require_once("../../common/include/incUtil.php");
require_once('../../common/include/incRequest.php');//CG REQUEST
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>	
<title>챠트</title>
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

<script src="chartbar.js?<?=getRndVal(10)?>"></script>
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
	## 컨디션 컨디션 - START G.GRPID : G1-
	#####################################################
	-->
 	<div class="GRP_OBJECT" style="width:100%;">
        <div class="GRP_GAP"><!--흰색 바깥 여백-->
            <div class="GRP_INNER" style="height:94px;">	
		
	  		<div style="width:0px;height:0px;overflow: hidden"><form id="condition" onsubmit="return false;"></div>
		<div class="CONDITION_LABELGRP">
			<div class="CONDITION_LABEL"  style="">
				<b>* 챠트</b>	
				<!--popup--><a href="?" target="_blank"><img src="/c.g/img/popup.png" height=10 align=absmiddle border=0></a>
				<!--reload--><a href="javascript:location.reload();"><img src="/c.g/img/reload.png" width=11 height=10 align=absmiddle border=0></a>
			</div>	
			<div class="CONDITION_LABELBTN">				<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G1_SEARCHALL" value="조회(전체)" onclick="G1_SEARCHALL(uuidv4());">
				<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G1_SAVE" value="저장" onclick="G1_SAVE(uuidv4());">
				<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G1_RESET" value="입력 초기화" onclick="G1_RESET(uuidv4());">
			</div>
		</div>
		<div style="height:52px;border-radius:3px;-moz-border-radius: 3px;" class="CONDITION_OBJECT">
			<DIV class="CON_LINE" is_br_tag>
		<!--컨디션 IO리스트-->
			</div><!-- is_br_tag end -->
		</div>
		<div style="width:0px;height:0px;overflow: hidden"></form></div>    
		</div></div>
	</div>
	<!--
	#####################################################
	## 챠트바 챠트 - START
	#####################################################
	-->
    <div class="GRP_OBJECT" style="width:50%;">
        <div class="GRP_GAP"><!--흰색 바깥 여백-->
            <div class="GRP_INNER" style="height:494px;">
		<div class="CHART_LABELGRP">
			<div class="CHART_LABEL"  style="">
					* 챠트				</div>	
				<div class="CHART_LABELBTN">
			</div>
		</div>
			<div class="CHART_OBJECT" style="border-radius:3px;-moz-border-radius: 3px;">
				<canvas id="canvasG2" style="width:100%;height:452px"></canvas>
		</div>
			</div></div>
	</div>
	<!--
	#####################################################
	## 챠트파이 PIE - START
	#####################################################
	-->
    <div class="GRP_OBJECT" style="width:50%;">
        <div class="GRP_GAP"><!--흰색 바깥 여백-->
            <div class="GRP_INNER" style="height:494px;">
		<div class="CHART_LABELGRP">
			<div class="CHART_LABEL"  style="">
				* PIE
			</div>	
			<div class="CHART_LABELBTN">
			</div>
		</div>
			<div class="CHART_OBJECT" style="border-radius:3px;-moz-border-radius: 3px;">
			<canvas id="canvasG3" style="width:100%;height:452px"></canvas>
		</div>
			</div>
		</div>
	</div>
	<!--
	#####################################################
	## 그리드 - START
	#####################################################
	-->
    <div class="GRP_OBJECT" style="width:50%;">
        <div class="GRP_GAP"><!--흰색 바깥 여백-->
		<div  class="GRID_LABELGRP">
			<div class="GRID_LABELGRP_GAP">	<!--그리드만 필요-->
  			<div id="div_gridG4_GRID_LABEL"class="GRID_LABEL" >
	  				* BAR상속      
			</div>
			<div id="div_gridG4_GRID_LABELBTN" class="GRID_LABELBTN"  style="">
				<span id="spanG4Cnt" name="그리드 ROW 갯수">N</span>
			<input type="button" class="btn btn-secondary  btn-sm" name="BTN_G4_SAVE" value="저장" onclick="G4_SAVE(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm" name="BTN_G4_RELOAD" value="새로고침" onclick="G4_RELOAD(uuidv4());">
			</div>
			</div><!--GAP-->
		</div>
		<div  class="GRID_OBJECT"  style="">
			<div id="gridG4"  style="background-color:white;overflow:hidden;height:155px;width:100%;"></div>
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
	## 그리드 - START
	#####################################################
	-->
    <div class="GRP_OBJECT" style="width:50%;">
        <div class="GRP_GAP"><!--흰색 바깥 여백-->
		<div  class="GRID_LABELGRP">
			<div class="GRID_LABELGRP_GAP">	<!--그리드만 필요-->
  			<div id="div_gridG5_GRID_LABEL"class="GRID_LABEL" >
	  				* PIE상속      
			</div>
			<div id="div_gridG5_GRID_LABELBTN" class="GRID_LABELBTN"  style="">
				<span id="spanG5Cnt" name="그리드 ROW 갯수">N</span>
			<input type="button" class="btn btn-secondary  btn-sm" name="BTN_G5_SAVE" value="저장" onclick="G5_SAVE(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm" name="BTN_G5_RELOAD" value="새로고침" onclick="G5_RELOAD(uuidv4());">
			</div>
			</div><!--GAP-->
		</div>
		<div  class="GRID_OBJECT"  style="">
			<div id="gridG5"  style="background-color:white;overflow:hidden;height:155px;width:100%;"></div>
		</div>
		</div>
	</div>
	<!--
	#####################################################
	## 그리드 - END
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
