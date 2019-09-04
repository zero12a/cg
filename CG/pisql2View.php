<?php
//PGMID : PISQL2
//PGMNM : Copy of PISQL
header("Content-Type: text/html; charset=UTF-8"); //HTML

require_once("../include/incUtil.php");
include_once('../include/incRequest.php');//CG REQUEST
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>	
<title>Copy of PISQL</title>
<meta http-equiv="Context-Type" context="text/html;charset=UTF-8" />
<!--CSS/JS 불러오기-->
<!--JS 불러오기--><script src="/lib/feather.min.js" type="text/javascript" charset="UTF-8"></script> <!--FEATHER ICON JS-->
<script src="/lib/jquery/jquery-3.4.1.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY CORE-->
<script src="/lib/jquery/jquery-ui.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY UI-->
<script src="/lib/tableExport/FileSaver.min.js" type="text/javascript" charset="UTF-8"></script> <!--BT4 TABLE EXPORT SAVER-->
<script src="/lib/tableExport/tableExport.min.js" type="text/javascript" charset="UTF-8"></script> <!--BT4 TABLE EXPORT-->
<script src="../lib/json2.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY JSON-->
<script src="/lib/hashmap.js" type="text/javascript" charset="UTF-8"></script> <!--HASHMAP-->
<script src="../lib/dhtmlxSuite/codebase/dhtmlx.js" type="text/javascript" charset="UTF-8"></script> <!--DHTMLX CORE-->
<script src="/lib/chart.min.js" type="text/javascript" charset="UTF-8"></script> <!--Chart.js-->
<script src="/chartjs_util.js" type="text/javascript" charset="UTF-8"></script> <!--Chart.js-->
<script src="../common/common.js" type="text/javascript" charset="UTF-8"></script> <!--DHTMLX EXT-->
<script src="/lib/moment.min.js" type="text/javascript" charset="UTF-8"></script> <!--Moment Date-->
<script src="/lib/bootstrap-table/bootstrap-table.min.js" type="text/javascript" charset="UTF-8"></script> <!--BT4 Table JS-->
<script src="/lib/bootstrap-table/locale/bootstrap-table-ko-KR.min.js" type="text/javascript" charset="UTF-8"></script> <!--BT4 Table JS Lang-->
<script src="/lib/codemirror/lib/codemirror.js" type="text/javascript" charset="UTF-8"></script> <!--CODE MIRROR1-->
<script src="/lib/codemirror/mode/sql/sql.js" type="text/javascript" charset="UTF-8"></script> <!--CODE MIRROR2-->
<script src="/lib/codemirror/addon/selection/active-line.js" type="text/javascript" charset="UTF-8"></script> <!--CODE MIRROR3-->
<!--CSS 불러오기--><link rel="stylesheet" href="../common/common.css" type="text/css" charset="UTF-8"><!--FEATHER ICON CSS-->
<link rel="stylesheet" href="../lib/dhtmlxSuite/codebase/dhtmlx.css" type="text/css" charset="UTF-8"><!--DHTMLX CORE-->
<link rel="stylesheet" href="/lib/jquery/jquery-ui.min.css" type="text/css" charset="UTF-8"><!--JQUERY UI-->
<link rel="stylesheet" href="/lib/bootstrap4/css/bootstrap.min.css" type="text/css" charset="UTF-8"><!--BOOTSTRAP V4-->
<link rel="stylesheet" href="/lib/bootstrap-table/bootstrap-table.min.css" type="text/css" charset="UTF-8"><!--BT4 Table CSS-->
<link rel="stylesheet" href="/lib/codemirror/lib/codemirror.css" type="text/css" charset="UTF-8"><!--CODE MIRROR CSS-->
<script src="pisql2.js?<?=getRndVal(10)?>"></script>
<link href="../common/common.css" rel="stylesheet" type="text/css" />
<script>
	//팝업창인 경우 오프너에게서 파라미터 받기
    var grpId = "<?=getFilter(reqPostString("GRPID",20),"SAFEECHO","")?>";
    var rowId = "<?=getFilter(reqPostString("ROWID",30),"SAFEECHO","")?>";
    var colId = "<?=getFilter(reqPostString("COLID",30),"SAFEECHO","")?>";
    var btnNm = "<?=getFilter(reqPostString("BTNNM",30),"SAFEECHO","")?>";
</script>
</head>
<body onload="initBody();">

<div id="BODY_BOX" class="BODY_BOX"><!--그룹별 IO출력-->	<!--
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
				<b>* Copy of PISQL</b>	
				<!--popup--><a href="?" target="_blank"><img src="/c.g/img/popup.png" height=10 align=absmiddle border=0></a>
				<!--reload--><a href="javascript:location.reload();"><img src="/c.g/img/reload.png" width=11 height=10 align=absmiddle border=0></a>
			</div>	
			<div class="CONDITION_LABELBTN">				<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G1_USERDEF" value="사용자정의" onclick="G1_USERDEF(uuidv4());">
				<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G1_SEARCHALL" value="조회(전체)" onclick="G1_SEARCHALL(uuidv4());">
				<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G1_SAVE" value="저장" onclick="G1_SAVE(uuidv4());">
				<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G1_RESET" value="입력 초기화" onclick="G1_RESET(uuidv4());">
			</div>
		</div>
		<div style="height:32px;border-radius:3px;-moz-border-radius: 3px;" class="CONDITION_OBJECT">
			<DIV class="CON_LINE" is_br_tag>
		<!--컨디션 IO리스트-->
					<!-- PGMSEQ -->
					<div class="CON_OBJECT" style="display:none">
						<input type="text" name="G1-PGMSEQ" value="<?=getFilter(reqGetString("PGMSEQ",30),"SAFEECHO","")?>" id="G1-PGMSEQ">
					</div>
					<!-- PJTSEQ -->
					<div class="CON_OBJECT" style="display:none">
						<input type="text" name="G1-PJTSEQ" value="<?=getFilter(reqGetString("PJTSEQ",20),"SAFEECHO","")?>" id="G1-PJTSEQ">
					</div>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : SQLNM-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						SQLNM
					</div>
					<!-- style="width:60px;"-->
					<div class="CON_OBJECT">
	<!--SQLNM오브젝트출력-->						<input type="text" name="G1-SQLNM" value="<?=getFilter(reqPostString("SQLNM",30),"SAFEECHO","")?>" id="G1-SQLNM" style="width:60px;">
					</div>
				</div>
			</div><!-- is_br_tag end -->
		</div>
		<div style="width:0px;height:0px;overflow: hidden"></form></div>    
		</div></div>
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
  			<div id="div_gridG2_GRID_LABEL"class="GRID_LABEL" >
	  				*       
			</div>
			<div id="div_gridG2_GRID_LABELBTN" class="GRID_LABELBTN"  style="">
				<span id="spanG2Cnt" name="그리드 ROW 갯수">N</span>
			<input type="button" class="btn btn-secondary  btn-sm" name="BTN_G2_USERDEF" value="사용자정의" onclick="G2_USERDEF(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm" name="BTN_G2_RELOAD" value="새로고침" onclick="G2_RELOAD(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm" name="BTN_G2_EXCEL" value="엑셀다운로드" onclick="G2_EXCEL(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm" name="BTN_G2_CHKSAVE" value="선택저장" onclick="G2_CHKSAVE(uuidv4());">
			</div>
			</div><!--GAP-->
		</div>
		<div  class="GRID_OBJECT"  style="">
<!--
data-toggle : 이 옵션이 있어야 데이터 load 처리시 동적으로 정상 처리됨
-->
<table id="btG2"
			data-toggle="table"
			data-height="457"
			data-virtual-scroll="true"
			data-click-to-select="false"
			data-resizable="true"
			class="table table-bordered table-striped"
			data-id-field="SQLSEQ"			>
			<thead>
            </thead>
        </table>
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
	## 폼뷰  - START
	#####################################################
	-->
    <div class="GRP_OBJECT" style="width:50%;">
        <div class="GRP_GAP"><!--흰색 바깥 여백-->
            <div class="GRP_INNER" style="height:494px;">
				
			<div sty_le="width:0px;height:0px;overflow: hidden">
				<form id="formviewG3" name="formviewG3" method="post" enctype="multipart/form-data"  onsubmit="return false;">
				<input type="hidden" name="G3-CTLCUD"  id="G3-CTLCUD" value="">
			</div>	
		<div class="FORMVIEW_LABELGRP">
			<div class="FORMVIEW_LABEL"  style="">
				* 
			</div>
			<div class="FORMVIEW_LABELBTN"  style="">
			<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G3_USERDEF" value="사용자정의" onclick="G3_USERDEF(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G3_SAVE" value="저장" onclick="G3_SAVE(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G3_RELOAD" value="새로고침" onclick="G3_RELOAD(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G3_NEW" value="신규" onclick="G3_NEW(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G3_MODIFY" value="수정" onclick="G3_MODIFY(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G3_DELETE" value="삭제" onclick="G3_DELETE(uuidv4());">
			</div>
		</div>
		<div style="height:452px;" class="FORMVIEW_OBJECT">
			<DIV class="CON_LINE" is_br_tag>
			<!--OBJECT LIST PRINT.-->
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : SQLSEQ-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						SQLSEQ
					</div>
					<!-- style="width:50px;"-->
					<div class="CON_OBJECT">
	<!--SQLSEQ오브젝트출력-->						<input type="text" name="G3-SQLSEQ" value="" id="G3-SQLSEQ" style="width:50px;">
					</div>
				</div>
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : PJTSEQ-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						PJTSEQ
					</div>
					<!-- style="width:100px;"-->
					<div class="CON_OBJECT">
	<!--PJTSEQ오브젝트출력-->						<input type="text" name="G3-PJTSEQ" value="" id="G3-PJTSEQ" style="width:100px;">
					</div>
				</div>
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : PGMSEQ-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						PGMSEQ
					</div>
					<!-- style="width:100px;"-->
					<div class="CON_OBJECT">
	<!--PGMSEQ오브젝트출력-->						<input type="text" name="G3-PGMSEQ" value="" id="G3-PGMSEQ" style="width:100px;">
					</div>
				</div>
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : SQLID-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						SQLID
					</div>
					<!-- style="width:60px;"-->
					<div class="CON_OBJECT">
	<!--SQLID오브젝트출력-->						<input type="text" name="G3-SQLID" value="" id="G3-SQLID" style="width:60px;">
					</div>
				</div>
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : SQLNM-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						SQLNM
					</div>
					<!-- style="width:60px;"-->
					<div class="CON_OBJECT">
	<!--SQLNM오브젝트출력-->						<input type="text" name="G3-SQLNM" value="" id="G3-SQLNM" style="width:60px;">
					</div>
				</div>
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : SVRSEQ-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						SERVERSEQ
					</div>
					<!-- style="width:60px;"-->
					<div class="CON_OBJECT">
	<!--SVRSEQ오브젝트출력-->						<input type="text" name="G3-SVRSEQ" value="" id="G3-SVRSEQ" style="width:60px;">
					</div>
				</div>
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : CRUD-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						CRUD
					</div>
					<!-- style="width:40px;"-->
					<div class="CON_OBJECT">
	<!--CRUD오브젝트출력-->						<input type="text" name="G3-CRUD" value="" id="G3-CRUD" style="width:40px;">
					</div>
				</div>
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : RTN_TYPE-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						RTN_TYPE
					</div>
					<!-- style="width:60px;"-->
					<div class="CON_OBJECT">
	<!--RTN_TYPE오브젝트출력-->						<input type="text" name="G3-RTN_TYPE" value="" id="G3-RTN_TYPE" style="width:60px;">
					</div>
				</div>
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : SQLORD-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						ORD
					</div>
					<!-- style="width:30px;"-->
					<div class="CON_OBJECT">
	<!--SQLORD오브젝트출력-->						<input type="text" name="G3-SQLORD" value="" id="G3-SQLORD" style="width:30px;">
					</div>
				</div>
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : PSQLSEQ-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						PSQLSEQ
					</div>
					<!-- style="width:70px;"-->
					<div class="CON_OBJECT">
	<!--PSQLSEQ오브젝트출력-->						<input type="text" name="G3-PSQLSEQ" value="" id="G3-PSQLSEQ" style="width:70px;">
					</div>
				</div>
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : SQLTXT-->
				<div class="CON_OBJGRP" style="">
					<!-- style="width:400px;height:200px;"-->
					<div class="CON_OBJECT">
			<!--SQLTXT오브젝트출력-->
			<span style="height:31px;overflow:hidden">
				<input class="btn btn-secondary  btn-sm" type="button" name="bigFont" value="+" onclick="changeCodemirrorFontSizeG3Sqltxt('+')">
				<input class="btn btn-secondary  btn-sm" type="button" name="bigFont" value="-" onclick="changeCodemirrorFontSizeG3Sqltxt('-')">
			</span>

			<textarea id="codeMirror_G3-SQLTXT" name="codeMirror_G3-SQLTXT" ></textarea>
					</div>
				</div>
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
		<!--D101: STARTTXT, TAG-->
		<!--I.COLID : ADDDT-->
			<div class="CON_OBJGRP" style="">
				<div class="CON_LABEL" style="width:100px;text-align:left;">	
					ADDDT	
				</div>	
				<!-- style="width:60;"-->
				<div class="CON_OBJECT">
					<div name="G3-ADDDT" id="G3-ADDDT" style="width:60px;"></div>
				</div>
			</div>
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
		<!--D101: STARTTXT, TAG-->
		<!--I.COLID : MODDT-->
			<div class="CON_OBJGRP" style="">
				<div class="CON_LABEL" style="width:100px;text-align:left;">	
					MODDT	
				</div>	
				<!-- style="width:60;"-->
				<div class="CON_OBJECT">
					<div name="G3-MODDT" id="G3-MODDT" style="width:60px;"></div>
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
