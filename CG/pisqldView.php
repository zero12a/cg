<?php
//PGMID : PISQLD
//PGMNM : PISQLD
header("Content-Type: text/html; charset=UTF-8"); //HTML

//설정 함수 읽기
$CFG = require_once '../../common/include/incConfig.php';

//MONO Autoload
require_once($CFG["CFG_LIBS_MONO_LOG"]);

//LIBS
include_once('../../common/include/incUtil.php');//CG UTIL
include_once('../../common/include/incRequest.php');//CG REQUEST
include_once('../../common/include/incDB.php');//CG DB
include_once('../../common/include/incSec.php');//CG SEC
include_once('../../common/include/incAuth.php');//CG AUTH
include_once('../../common/include/incUser.php');//CG USER

//인증 게이트웨이
require_once('../../common/include/incLoginOauthGateway.php');//CG USER
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>	
<title>PISQLD</title>
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
<link rel="stylesheet" href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/dhtmlxSuite/codebase/dhtmlx.css" type="text/css" charset="UTF-8"><!--DHTMLX CORE-->
<link rel="stylesheet" href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/jquery/jquery-ui.min.css" type="text/css" charset="UTF-8"><!--JQUERY UI-->
<link rel="stylesheet" href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/bootstrap4/css/bootstrap.min.css" type="text/css" charset="UTF-8"><!--BOOTSTRAP V4-->
<link rel="stylesheet" href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/bootstrap-table/bootstrap-table.min.css" type="text/css" charset="UTF-8"><!--BT4 Table CSS-->
<link rel="stylesheet" href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/codemirror/lib/codemirror.css" type="text/css" charset="UTF-8"><!--CODE MIRROR CSS-->
<!--공통 js/css-->
<script>
var CFG_URL_LIBS_ROOT = "<?=$CFG["CFG_URL_LIBS_ROOT"]?>";  // 형식 http://url:port/
</script>
<script src="/common/common.js?<?=getRndVal(10)?>"></script>
<link rel="stylesheet" href="/common/common.css?<?=getRndVal(10)?>" type="text/css" charset="UTF-8">

<script src="pisqld.js?<?=getRndVal(10)?>"></script>
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
				<b>* PISQLD</b>	
				<!--popup--><a href="?" target="_blank"><img src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>img/popup.png" height=10 align=absmiddle border=0></a>
				<!--reload--><a href="javascript:location.reload();"><img src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>img/reload.png" width=11 height=10 align=absmiddle border=0></a>
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
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : COLID-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						컬럼ID
					</div>
					<!-- style="width:100px;"-->
					<div class="CON_OBJECT">
	<!--COLID오브젝트출력-->						<input type="text" name="G1-COLID" value="<?=getFilter(reqPostString("COLID",30),"SAFEECHO","")?>" id="G1-COLID" style="width:100px;">
					</div>
				</div>
					<!-- PGMSEQ -->
					<div class="CON_OBJECT" style="display:none">
						<input type="text" name="G1-PGMSEQ" value="<?=getFilter(reqGetString("PGMSEQ",30),"SAFEECHO","")?>" id="G1-PGMSEQ">
					</div>
					<!-- PJTSEQ -->
					<div class="CON_OBJECT" style="display:none">
						<input type="text" name="G1-PJTSEQ" value="<?=getFilter(reqGetString("PJTSEQ",20),"SAFEECHO","")?>" id="G1-PJTSEQ">
					</div>
					<!-- SQLSEQ -->
					<div class="CON_OBJECT" style="display:none">
						<input type="text" name="G1-SQLSEQ" value="<?=getFilter(reqGetString("SQLSEQ",30),"SAFEECHO","")?>" id="G1-SQLSEQ">
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
			data-id-field="COLSEQ"			>
			<thead>
				<tr>
					<th
						data-field="ROWID"
						data-sortable="false"
						data-visible="false"
						data-align="right"
						data-width="100"
						data-width-unit="px"
						>ROWID</th>
					<th
						data-field="SQLSEQ"
						data-width="50" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>SQLSEQ
					</th>
					<th
						data-field="COLSEQ"
						data-width="50" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>COLSEQ
					</th>
					<th
						data-field="PJTSEQ"
						data-width="100" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>PJTSEQ
					</th>
					<th
						data-field="PGMSEQ"
						data-width="100" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>PGMSEQ
					</th>
					<th
						data-field="SQLGBN"
						data-width="50" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>SQLGBN
					</th>
					<th
						data-field="COLID"
						data-width="100" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>컬럼ID
					</th>
					<th
						data-field="DDCOLID"
						data-width="50" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>DDCOLID
					</th>
					<th
						data-field="REQUIREYN"
						data-width="50" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>필수
					</th>
					<th
						data-field="ORD"
						data-width="30" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>ORD
					</th>
					<th
						data-field="MODDT"
						data-width="60" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>MODDT
					</th>
					</tr>            
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
				<!-- style="width:50;"-->
				<div class="CON_OBJECT">
					<div name="G3-SQLSEQ" id="G3-SQLSEQ" style="width:50px;"></div>
				</div>
			</div>
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
		<!--D101: STARTTXT, TAG-->
		<!--I.COLID : COLSEQ-->
			<div class="CON_OBJGRP" style="">
				<div class="CON_LABEL" style="width:100px;text-align:left;">	
					COLSEQ	
				</div>	
				<!-- style="width:50;"-->
				<div class="CON_OBJECT">
					<div name="G3-COLSEQ" id="G3-COLSEQ" style="width:50px;"></div>
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
				<!-- style="width:100;"-->
				<div class="CON_OBJECT">
					<div name="G3-PJTSEQ" id="G3-PJTSEQ" style="width:100px;"></div>
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
				<!-- style="width:100;"-->
				<div class="CON_OBJECT">
					<div name="G3-PGMSEQ" id="G3-PGMSEQ" style="width:100px;"></div>
				</div>
			</div>
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : SQLGBN-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						SQLGBN
					</div>
					<!-- style="width:50px;"-->
					<div class="CON_OBJECT">
	<!--SQLGBN오브젝트출력-->						<input type="text" name="G3-SQLGBN" value="" id="G3-SQLGBN" style="width:50px;">
					</div>
				</div>
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : COLID-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						컬럼ID
					</div>
					<!-- style="width:100px;"-->
					<div class="CON_OBJECT">
	<!--COLID오브젝트출력-->						<input type="text" name="G3-COLID" value="" id="G3-COLID" style="width:100px;">
					</div>
				</div>
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : DDCOLID-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						DDCOLID
					</div>
					<!-- style="width:50px;"-->
					<div class="CON_OBJECT">
	<!--DDCOLID오브젝트출력-->						<input type="text" name="G3-DDCOLID" value="" id="G3-DDCOLID" style="width:50px;">
					</div>
				</div>
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : REQUIREYN-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						필수
					</div>
					<!-- style="width:50px;"-->
					<div class="CON_OBJECT">
	<!--REQUIREYN오브젝트출력-->						<input type="text" name="G3-REQUIREYN" value="" id="G3-REQUIREYN" style="width:50px;">
					</div>
				</div>
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : ORD-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						ORD
					</div>
					<!-- style="width:30px;"-->
					<div class="CON_OBJECT">
	<!--ORD오브젝트출력-->						<input type="text" name="G3-ORD" value="" id="G3-ORD" style="width:30px;">
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
