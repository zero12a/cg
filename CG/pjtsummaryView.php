<?php
//PGMID : PJTSUMMARY
//PGMNM : 프로젝트요약
header("Content-Type: text/html; charset=UTF-8"); //HTML

//설정 함수 읽기
$CFG = require_once '../../common/include/incConfig.php';

//default lib Autoload
require_once($CFG["CFG_LIBS_VENDOR"]);

//LIBS
require_once('../../common/include/incUtil.php');//CG UTIL
require_once('../../common/include/incRequest.php');//CG REQUEST
require_once('../../common/include/incDB.php');//CG DB
require_once('../../common/include/incSec.php');//CG SEC
require_once('../../common/include/incAuth.php');//CG AUTH
require_once('../../common/include/incUser.php');//CG USER

//인증 게이트웨이
require_once('../../common/include/incLoginOauthGateway.php');//CG USER
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>	
<title>프로젝트요약</title>
<meta http-equiv="Context-Type" context="text/html;charset=UTF-8" />
<!--CSS/JS 불러오기-->
<!--JS 불러오기-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/feather.min.js" type="text/javascript" charset="UTF-8"></script> <!--FEATHER ICON JS-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/jquery/jquery-3.4.1.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY CORE-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/jquery/jquery-ui.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY UI-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/tableExport/FileSaver.min.js" type="text/javascript" charset="UTF-8"></script> <!--BT4 TABLE EXPORT SAVER-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/cleave.min.js" type="text/javascript" charset="UTF-8"></script> <!--CLEAVE JS-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/tableExport/tableExport.min.js" type="text/javascript" charset="UTF-8"></script> <!--BT4 TABLE EXPORT-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/json2.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY JSON-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/hashmap.js" type="text/javascript" charset="UTF-8"></script> <!--HASHMAP-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/dhtmlxSuite/codebase/dhtmlx.js" type="text/javascript" charset="UTF-8"></script> <!--DHTMLX CORE-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/Chart.min.js" type="text/javascript" charset="UTF-8"></script> <!--Chart.js-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/bootstrap4/popper.min.js" type="text/javascript" charset="UTF-8"></script> <!--BT4 Poper Js-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/bootstrap4/js/bootstrap.min.js" type="text/javascript" charset="UTF-8"></script> <!--BT4 Min Js-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/moment.min.js" type="text/javascript" charset="UTF-8"></script> <!--Moment Date-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/summernote/summernote-bs4.min.js" type="text/javascript" charset="UTF-8"></script> <!--WebEditor Summbernote-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/bootstrap-table/bootstrap-table.min.js" type="text/javascript" charset="UTF-8"></script> <!--BT4 Table JS-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/bootstrap-table/locale/bootstrap-table-ko-KR.min.js" type="text/javascript" charset="UTF-8"></script> <!--BT4 Table JS Lang-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/codemirror/lib/codemirror.js" type="text/javascript" charset="UTF-8"></script> <!--CODE MIRROR1-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/codemirror/mode/sql/sql.js" type="text/javascript" charset="UTF-8"></script> <!--CODE MIRROR2-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/codemirror/addon/selection/active-line.js" type="text/javascript" charset="UTF-8"></script> <!--CODE MIRROR3-->

<!--CSS 불러오기-->
<link rel="stylesheet" href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/dhtmlxSuite/codebase/dhtmlx.css" type="text/css" charset="UTF-8"><!--DHTMLX CORE-->
<link rel="stylesheet" href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/jquery/jquery-ui.min.css" type="text/css" charset="UTF-8"><!--JQUERY UI-->
<link rel="stylesheet" href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/bootstrap4/css/bootstrap.min.css" type="text/css" charset="UTF-8"><!--BOOTSTRAP V4-->
<link rel="stylesheet" href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/summernote/summernote-bs4.min.css" type="text/css" charset="UTF-8"><!--WebEditor Summbernote-->
<link rel="stylesheet" href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/bootstrap-table/bootstrap-table.min.css" type="text/css" charset="UTF-8"><!--BT4 Table CSS-->
<link rel="stylesheet" href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/codemirror/lib/codemirror.css" type="text/css" charset="UTF-8"><!--CODE MIRROR CSS-->
<!--공통 js/css-->
<script>
var CFG_CGWEB_URL = "<?=$CFG["CFG_CGWEB_URL"]?>";  // 형식 http://url:port/
var CFG_URL_LIBS_ROOT = "<?=$CFG["CFG_URL_LIBS_ROOT"]?>";  // 형식 http://url:port/
</script>
<script src="/common/chartjs_util.js"></script>
<script src="/common/common.js?<?=getRndVal(10)?>"></script>
<link rel="stylesheet" href="/common/common.css?<?=getRndVal(10)?>" type="text/css" charset="UTF-8">

<script src="pjtsummary.js?<?=getRndVal(10)?>"></script>
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
				<b>* 프로젝트요약</b>	
				<!--popup--><a href="?" target="_blank"><img src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>img/popup.png" height=10 align=absmiddle border=0></a>
				<!--reload--><a href="javascript:location.reload();"><img src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>img/reload.png" width=11 height=10 align=absmiddle border=0></a>
			</div>	
			<div class="CONDITION_LABELBTN">				<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G1_SEARCHALL" value="조회(전체)" onclick="G1_SEARCHALL(uuidv4());">
				<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G1_RESET" value="입력 초기화" onclick="G1_RESET(uuidv4());">
			</div>
		</div>
		<div style="height:32px;border-radius:3px;-moz-border-radius: 3px;" class="CONDITION_OBJECT">
			<DIV class="CON_LINE" is_br_tag>
		<!--컨디션 IO리스트-->
			</div><!-- is_br_tag end -->
		</div>
		<div style="width:0px;height:0px;overflow: hidden"></form></div>    
		</div></div>
	</div>
	<!--
	#####################################################
	## BI뷰  1 - START
	#####################################################
	-->
		<div class="GRP_OBJECT" id="DIV-G2-CLICK" style="width:25%;">
			<div class="GRP_GAP"><!--흰색 바깥 여백-->
				<div class="GRP_INNER" style="height:74px;overflow:hidden;">
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : VAL1-->
                <div class="BI_ICON" style="float:left;width:30%;text-align:center;">
                        <i style="padding-top:9px;"
                        width="50"
                        height="50"
                        data-feather="moon"></i>
                </div>
                <div class="BI_VALUE"
                 style="width:70%;">
                    <span id="G2-VAL1-VALUE">Value</span>
                </div>
                <div class="BI_LABEL" style="width:70%;">
                    <span id="G2-VAL1-LABEL">프로그램갯수</span>
                </div>
				</div>
			</div>
		</div>
	<!--
	#####################################################
	## BI뷰  2 - START
	#####################################################
	-->
		<div class="GRP_OBJECT" id="DIV-G3-CLICK" style="width:25%;">
			<div class="GRP_GAP"><!--흰색 바깥 여백-->
				<div class="GRP_INNER" style="height:74px;overflow:hidden;">
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : VAL1-->
                <div class="BI_LABEL" style="width:100%;">
                    <span id="G3-VAL1-LABEL">VAL1</span>
                </div>
                <div class="BI_VALUE" style="width:80%;float:left;">
                    <span id="G3-VAL1-VALUE">Value</span>
                </div>            
                <div class="BI_ICON" style="width:20%;text-align:right;">
                        <i style="padding-left:5px;padding-top:0px;"
                        color="silver" 
                        width="30"
                        height="30"
                        data-feather="moon"></i>
                </div>				</div>
			</div>
		</div>
	<!--
	#####################################################
	## BI뷰  3 - START
	#####################################################
	-->
		<div class="GRP_OBJECT" id="DIV-G4-CLICK" style="width:25%;">
			<div class="GRP_GAP"><!--흰색 바깥 여백-->
				<div class="GRP_INNER" style="height:74px;overflow:hidden;">
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : VAL1-->
 				<div class="BI_LABEL" style="float:left;width:70%;">
                    <span id="G4-VAL1-LABEL">설정값 및 DD</span>
                </div>
                <div class="BI_ICON" style="text-align:right;width:30%;">
                        <i style="padding-right:5px;padding-top:0px;"
                        color="silver" 
                        width="22"
                        height="22"
                        data-feather="moon"></i>
                </div>
                <div class="BI_VALUE" style="float:left;width:70%;">
                    <span id="G4-VAL1-VALUE1">Value1</span>
                </div>
                <div class="BI_VALUE2 BI_VALUE2_TYPE3" style="font-width:bold;">
                    <span id="G4-VAL1-VALUE2">Value2</span>
                </div>				</div>
			</div>
		</div>
	<!--
	#####################################################
	## BI뷰  4 - START
	#####################################################
	-->
		<div class="GRP_OBJECT" id="DIV-G5-CLICK" style="width:25%;">
			<div class="GRP_GAP"><!--흰색 바깥 여백-->
				<div class="GRP_INNER" style="height:74px;overflow:hidden;">
                <div class="BI_LABEL" style="width:100%;">
                    <span id="G5-VAL1-LABEL">VAL1</span>
                </div>
                <div style="float:left;width:80%">
                    <div class="BI_VALUE" style="float:left;text-align:left;">
                    	<span id="G5-VAL1-VALUE1">Value1</span>
                    </div>    
                    <div class="BI_VALUE2 BI_VALUE2_TYPE4">
                    	<span id="G5-VAL1-VALUE2">Value2</span>
                    </div>   
                </div>
                <div class="BI_ICON" style="text-align:right;width:20%;">
                        <i style="padding-left:5px;padding-top:0px;"
                        color="silver" 
                        width="30"
                        height="30"
                        data-feather="moon"></i>
                </div>				</div>
			</div>
		</div>
	<!--
	#####################################################
	## 챠트바 6 - START
	#####################################################
	-->
    <div class="GRP_OBJECT" style="width:100%;">
        <div class="GRP_GAP"><!--흰색 바깥 여백-->
            <div class="GRP_INNER" style="height:194px;">
		<div class="CHART_LABELGRP">
			<div class="CHART_LABEL"  style="">
					* 6				</div>	
				<div class="CHART_LABELBTN">
			</div>
		</div>
			<div class="CHART_OBJECT" style="border-radius:3px;-moz-border-radius: 3px;">
				<canvas id="canvasG6" style="width:100%;height:152px"></canvas>
		</div>
			</div></div>
	</div>
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
