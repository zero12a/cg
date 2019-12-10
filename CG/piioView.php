<?php
//PGMID : PIIO
//PGMNM : PIIO
header("Content-Type: text/html; charset=UTF-8"); //HTML

require_once("../../common/include/incUtil.php");
include_once('../../common/include/incRequest.php');//CG REQUEST
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>	
<title>PIIO</title>
<meta http-equiv="Context-Type" context="text/html;charset=UTF-8" />
<!--CSS/JS 불러오기-->
<!--JS 불러오기-->
<script src="/lib/feather.min.js" type="text/javascript" charset="UTF-8"></script> <!--FEATHER ICON JS-->
<script src="/lib/jquery/jquery-3.4.1.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY CORE-->
<script src="/lib/jquery/jquery-ui.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY UI-->
<script src="/lib/tableExport/FileSaver.min.js" type="text/javascript" charset="UTF-8"></script> <!--BT4 TABLE EXPORT SAVER-->
<script src="/lib/tableExport/tableExport.min.js" type="text/javascript" charset="UTF-8"></script> <!--BT4 TABLE EXPORT-->
<script src="/lib/json2.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY JSON-->
<script src="/lib/hashmap.js" type="text/javascript" charset="UTF-8"></script> <!--HASHMAP-->
<script src="/lib/dhtmlxSuite/codebase/dhtmlx.js" type="text/javascript" charset="UTF-8"></script> <!--DHTMLX CORE-->
<script src="/lib/chart.min.js" type="text/javascript" charset="UTF-8"></script> <!--Chart.js-->
<script src="/common/chartjs_util.js" type="text/javascript" charset="UTF-8"></script> <!--Chart.js-->
<script src="/common/common.js" type="text/javascript" charset="UTF-8"></script> <!--DHTMLX EXT-->
<script src="/lib/moment.min.js" type="text/javascript" charset="UTF-8"></script> <!--Moment Date-->
<script src="/lib/bootstrap-table/bootstrap-table.min.js" type="text/javascript" charset="UTF-8"></script> <!--BT4 Table JS-->
<script src="/lib/bootstrap-table/locale/bootstrap-table-ko-KR.min.js" type="text/javascript" charset="UTF-8"></script> <!--BT4 Table JS Lang-->
<script src="/lib/codemirror/lib/codemirror.js" type="text/javascript" charset="UTF-8"></script> <!--CODE MIRROR1-->
<script src="/lib/codemirror/mode/sql/sql.js" type="text/javascript" charset="UTF-8"></script> <!--CODE MIRROR2-->
<script src="/lib/codemirror/addon/selection/active-line.js" type="text/javascript" charset="UTF-8"></script> <!--CODE MIRROR3-->

<!--CSS 불러오기-->
<link rel="stylesheet" href="/common/common.css" type="text/css" charset="UTF-8"><!--FEATHER ICON CSS-->
<link rel="stylesheet" href="/lib/dhtmlxSuite/codebase/dhtmlx.css" type="text/css" charset="UTF-8"><!--DHTMLX CORE-->
<link rel="stylesheet" href="/lib/jquery/jquery-ui.min.css" type="text/css" charset="UTF-8"><!--JQUERY UI-->
<link rel="stylesheet" href="/lib/bootstrap4/css/bootstrap.min.css" type="text/css" charset="UTF-8"><!--BOOTSTRAP V4-->
<link rel="stylesheet" href="/lib/bootstrap-table/bootstrap-table.min.css" type="text/css" charset="UTF-8"><!--BT4 Table CSS-->
<link rel="stylesheet" href="/lib/codemirror/lib/codemirror.css" type="text/css" charset="UTF-8"><!--CODE MIRROR CSS-->
<!--공통 js/css-->
<script src="piio.js?<?=getRndVal(10)?>"></script>
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
				<b>* PIIO</b>	
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
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : COLNM-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						컬럼명
					</div>
					<!-- style="width:100px;"-->
					<div class="CON_OBJECT">
	<!--COLNM오브젝트출력-->						<input type="text" name="G1-COLNM" value="<?=getFilter(reqPostString("COLNM",30),"SAFEECHO","")?>" id="G1-COLNM" style="width:100px;">
					</div>
				</div>
					<!-- GRPSEQ -->
					<div class="CON_OBJECT" style="display:none">
						<input type="text" name="G1-GRPSEQ" value="<?=getFilter(reqGetString("GRPSEQ",30),"SAFEECHO","")?>" id="G1-GRPSEQ">
					</div>
					<!-- PGMSEQ -->
					<div class="CON_OBJECT" style="display:none">
						<input type="text" name="G1-PGMSEQ" value="<?=getFilter(reqGetString("PGMSEQ",30),"SAFEECHO","")?>" id="G1-PGMSEQ">
					</div>
					<!-- PJTSEQ -->
					<div class="CON_OBJECT" style="display:none">
						<input type="text" name="G1-PJTSEQ" value="<?=getFilter(reqGetString("PJTSEQ",20),"SAFEECHO","")?>" id="G1-PJTSEQ">
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
			data-id-field="IOSEQ"			>
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
						data-field="GRPSEQ"
						data-width="100" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>GRPSEQ
					</th>
					<th
						data-field="IOSEQ"
						data-width="60" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>IOSEQ
					</th>
					<th
						data-field="COLORD"
						data-width="70" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>COLORD
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
						data-field="COLNM"
						data-width="100" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>컬럼명
					</th>
					<th
						data-field="DATATYPE"
						data-width="60" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>데이터타입
					</th>
					<th
						data-field="VALIDSEQ"
						data-width="60" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>VALIDSEQ
					</th>
					<th
						data-field="DATASIZE"
						data-width="100" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>데이터사이즈
					</th>
					<th
						data-field="OBJTYPE"
						data-width="100" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>오브젝트타입
					</th>
					<th
						data-field="POPUP"
						data-width="70" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>POPUP
					</th>
					<th
						data-field="KEYYN"
						data-width="70" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>KEYYN
					</th>
					<th
						data-field="SEQYN"
						data-width="70" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>SEQYN
					</th>
					<th
						data-field="LBLHIDDENYN"
						data-width="70" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>LBLHIDDENYN
					</th>
					<th
						data-field="LBLWIDTH"
						data-width="100" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>라벨가로
					</th>
					<th
						data-field="LBLALIGN"
						data-width="100" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>LBLALIGN
					</th>
					<th
						data-field="OBJWIDTH"
						data-width="100" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>오브젝트가로
					</th>
					<th
						data-field="OBJHEIGHT"
						data-width="100" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>오브젝트세로
					</th>
					<th
						data-field="OBJALIGN"
						data-width="100" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>가로정렬
					</th>
					<th
						data-field="HIDDENYN"
						data-width="70" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>HIDDENYN
					</th>
					<th
						data-field="EDITYN"
						data-width="60" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>EDITYN
					</th>
					<th
						data-field="FNINIT"
						data-width="70" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>FNINIT
					</th>
					<th
						data-field="BRYN"
						data-width="70" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>BRYN
					</th>
					<th
						data-field="FORMAT"
						data-width="70" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>FORMAT
					</th>
					<th
						data-field="FOOTERMATH"
						data-width="70" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>FOOTERMATH
					</th>
					<th
						data-field="FOOTERNM"
						data-width="70" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>FOOTERNM
					</th>
					<th
						data-field="ICONNM"
						data-width="70" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>ICONNM
					</th>
					<th
						data-field="ICONSTYLE"
						data-width="70" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>ICONSTYLE
					</th>
					<th
						data-field="LBLSTYLE"
						data-width="70" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>LBLSTYLE
					</th>
					<th
						data-field="OBJSTYLE"
						data-width="70" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>OBJSTYLE
					</th>
					<th
						data-field="OBJ2STYLE"
						data-width="70" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>OBJ2STYLE
					</th>
					<th
						data-field="ADDDT"
						data-width="60" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>ADDDT
					</th>
					<th
						data-field="ADDID"
						data-width="60" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>ADDID
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
					<th
						data-field="MODID"
						data-width="60" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>MODID
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
			<!--I.COLID : GRPSEQ-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						GRPSEQ
					</div>
					<!-- style="width:100px;"-->
					<div class="CON_OBJECT">
	<!--GRPSEQ오브젝트출력-->						<input type="text" name="G3-GRPSEQ" value="" id="G3-GRPSEQ" style="width:100px;">
					</div>
				</div>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : IOSEQ-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						IOSEQ
					</div>
					<!-- style="width:100px;"-->
					<div class="CON_OBJECT">
	<!--IOSEQ오브젝트출력-->						<input type="text" name="G3-IOSEQ" value="" id="G3-IOSEQ" style="width:100px;">
					</div>
				</div>
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : COLORD-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						COLORD
					</div>
					<!-- style="width:100px;"-->
					<div class="CON_OBJECT">
	<!--COLORD오브젝트출력-->						<input type="text" name="G3-COLORD" value="" id="G3-COLORD" style="width:100px;">
					</div>
				</div>
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
			<!--I.COLID : COLNM-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						컬럼명
					</div>
					<!-- style="width:100px;"-->
					<div class="CON_OBJECT">
	<!--COLNM오브젝트출력-->						<input type="text" name="G3-COLNM" value="" id="G3-COLNM" style="width:100px;">
					</div>
				</div>
		<!--, 데이터타입-->
		<div class="CON_OBJGRP" style="">			<div class="CON_LABEL" style="width:100px;text-align:left;">
				데이터타입
			</div>
			<div class="CON_OBJECT" style="width:100px;">
				<select id="G3-DATATYPE" name="G3-DATATYPE" style="width:100px"></select>
			</div>
		</div>
			</DIV>
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
		<!--, VALIDSEQ-->
		<div class="CON_OBJGRP" style="">			<div class="CON_LABEL" style="width:100px;text-align:left;">
				VALIDSEQ
			</div>
			<div class="CON_OBJECT" style="width:100px;">
				<select id="G3-VALIDSEQ" name="G3-VALIDSEQ" style="width:100px"></select>
			</div>
		</div>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : DATASIZE-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						데이터사이즈
					</div>
					<!-- style="width:100px;"-->
					<div class="CON_OBJECT">
	<!--DATASIZE오브젝트출력-->						<input type="text" name="G3-DATASIZE" value="" id="G3-DATASIZE" style="width:100px;">
					</div>
				</div>
			</DIV>
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
		<!--, 오브젝트타입-->
		<div class="CON_OBJGRP" style="">			<div class="CON_LABEL" style="width:100px;text-align:left;">
				오브젝트타입
			</div>
			<div class="CON_OBJECT" style="width:100px;">
				<select id="G3-OBJTYPE" name="G3-OBJTYPE" style="width:100px"></select>
			</div>
		</div>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : POPUP-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						POPUP
					</div>
					<!-- style="width:100px;"-->
					<div class="CON_OBJECT">
	<!--POPUP오브젝트출력-->						<input type="text" name="G3-POPUP" value="" id="G3-POPUP" style="width:100px;">
					</div>
				</div>
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : KEYYN-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
 						KEYYN
 					</div>
 					<!-- style="width:100px;"-->
					<div class="CON_OBJECT">
 	<!--KEYYN오브젝트출력 radio-->
	<div name="G3-KEYYN-HOLDER" id="G3-KEYYN-HOLDER"  style="width:100px;"></div>
					</div>
 				</div>
 			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : SEQYN-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
 						SEQYN
 					</div>
 					<!-- style="width:100px;"-->
					<div class="CON_OBJECT">
 	<!--SEQYN오브젝트출력 radio-->
	<div name="G3-SEQYN-HOLDER" id="G3-SEQYN-HOLDER"  style="width:100px;"></div>
					</div>
 				</div>
 			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : LBLHIDDENYN-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
 						LBLHIDDENYN
 					</div>
 					<!-- style="width:100px;"-->
					<div class="CON_OBJECT">
 	<!--LBLHIDDENYN오브젝트출력 radio-->
	<div name="G3-LBLHIDDENYN-HOLDER" id="G3-LBLHIDDENYN-HOLDER"  style="width:100px;"></div>
					</div>
 				</div>
 			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : LBLWIDTH-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						라벨가로
					</div>
					<!-- style="width:100px;"-->
					<div class="CON_OBJECT">
	<!--LBLWIDTH오브젝트출력-->						<input type="text" name="G3-LBLWIDTH" value="" id="G3-LBLWIDTH" style="width:100px;">
					</div>
				</div>
			</DIV>
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
		<!--, LBLALIGN-->
		<div class="CON_OBJGRP" style="">			<div class="CON_LABEL" style="width:100px;text-align:left;">
				LBLALIGN
			</div>
			<div class="CON_OBJECT" style="width:100px;">
				<select id="G3-LBLALIGN" name="G3-LBLALIGN" style="width:100px"></select>
			</div>
		</div>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : OBJWIDTH-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						오브젝트가로
					</div>
					<!-- style="width:100px;"-->
					<div class="CON_OBJECT">
	<!--OBJWIDTH오브젝트출력-->						<input type="text" name="G3-OBJWIDTH" value="" id="G3-OBJWIDTH" style="width:100px;">
					</div>
				</div>
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : OBJHEIGHT-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						오브젝트세로
					</div>
					<!-- style="width:100px;"-->
					<div class="CON_OBJECT">
	<!--OBJHEIGHT오브젝트출력-->						<input type="text" name="G3-OBJHEIGHT" value="" id="G3-OBJHEIGHT" style="width:100px;">
					</div>
				</div>
		<!--, 가로정렬-->
		<div class="CON_OBJGRP" style="">			<div class="CON_LABEL" style="width:100px;text-align:left;">
				가로정렬
			</div>
			<div class="CON_OBJECT" style="width:100px;">
				<select id="G3-OBJALIGN" name="G3-OBJALIGN" style="width:100px"></select>
			</div>
		</div>
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : HIDDENYN-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
 						HIDDENYN
 					</div>
 					<!-- style="width:100px;"-->
					<div class="CON_OBJECT">
 	<!--HIDDENYN오브젝트출력 radio-->
	<div name="G3-HIDDENYN-HOLDER" id="G3-HIDDENYN-HOLDER"  style="width:100px;"></div>
					</div>
 				</div>
 			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : EDITYN-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
 						EDITYN
 					</div>
 					<!-- style="width:100px;"-->
					<div class="CON_OBJECT">
 	<!--EDITYN오브젝트출력 radio-->
	<div name="G3-EDITYN-HOLDER" id="G3-EDITYN-HOLDER"  style="width:100px;"></div>
					</div>
 				</div>
 			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : FNINIT-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						FNINIT
					</div>
					<!-- style="width:300px;height:84px;"-->
					<div class="CON_OBJECT">
			<!--FNINIT오브젝트출력-->
			<span style="height:31px;overflow:hidden">
				<input class="btn btn-secondary  btn-sm" type="button" name="bigFont" value="+" onclick="changeCodemirrorFontSizeG3Fninit('+')">
				<input class="btn btn-secondary  btn-sm" type="button" name="bigFont" value="-" onclick="changeCodemirrorFontSizeG3Fninit('-')">
			</span>

			<textarea id="codeMirror_G3-FNINIT" name="codeMirror_G3-FNINIT" ></textarea>
					</div>
				</div>
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : BRYN-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
 						BRYN
 					</div>
 					<!-- style="width:100px;"-->
					<div class="CON_OBJECT">
 	<!--BRYN오브젝트출력 radio-->
	<div name="G3-BRYN-HOLDER" id="G3-BRYN-HOLDER"  style="width:100px;"></div>
					</div>
 				</div>
 			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : FORMAT-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						FORMAT
					</div>
					<!-- style="width:100px;"-->
					<div class="CON_OBJECT">
	<!--FORMAT오브젝트출력-->						<input type="text" name="G3-FORMAT" value="" id="G3-FORMAT" style="width:100px;">
					</div>
				</div>
			</DIV>
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
		<!--, FOOTERMATH-->
		<div class="CON_OBJGRP" style="">			<div class="CON_LABEL" style="width:100px;text-align:left;">
				FOOTERMATH
			</div>
			<div class="CON_OBJECT" style="width:100px;">
				<select id="G3-FOOTERMATH" name="G3-FOOTERMATH" style="width:100px"></select>
			</div>
		</div>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : FOOTERNM-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						FOOTERNM
					</div>
					<!-- style="width:100px;"-->
					<div class="CON_OBJECT">
	<!--FOOTERNM오브젝트출력-->						<input type="text" name="G3-FOOTERNM" value="" id="G3-FOOTERNM" style="width:100px;">
					</div>
				</div>
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : ICONNM-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						ICONNM
					</div>
					<!-- style="width:100px;"-->
					<div class="CON_OBJECT">
	<!--ICONNM오브젝트출력-->						<input type="text" name="G3-ICONNM" value="" id="G3-ICONNM" style="width:100px;">
					</div>
				</div>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : ICONSTYLE-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						ICONSTYLE
					</div>
					<!-- style="width:100px;"-->
					<div class="CON_OBJECT">
	<!--ICONSTYLE오브젝트출력-->						<input type="text" name="G3-ICONSTYLE" value="" id="G3-ICONSTYLE" style="width:100px;">
					</div>
				</div>
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : LBLSTYLE-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						LBLSTYLE
					</div>
					<!-- style="width:100px;"-->
					<div class="CON_OBJECT">
	<!--LBLSTYLE오브젝트출력-->						<input type="text" name="G3-LBLSTYLE" value="" id="G3-LBLSTYLE" style="width:100px;">
					</div>
				</div>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : OBJSTYLE-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						OBJSTYLE
					</div>
					<!-- style="width:100px;"-->
					<div class="CON_OBJECT">
	<!--OBJSTYLE오브젝트출력-->						<input type="text" name="G3-OBJSTYLE" value="" id="G3-OBJSTYLE" style="width:100px;">
					</div>
				</div>
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : OBJ2STYLE-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						OBJ2STYLE
					</div>
					<!-- style="width:100px;"-->
					<div class="CON_OBJECT">
	<!--OBJ2STYLE오브젝트출력-->						<input type="text" name="G3-OBJ2STYLE" value="" id="G3-OBJ2STYLE" style="width:100px;">
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
				<!-- style="width:100;"-->
				<div class="CON_OBJECT">
					<div name="G3-ADDDT" id="G3-ADDDT" style="width:100px;"></div>
				</div>
			</div>
		<!--D101: STARTTXT, TAG-->
		<!--I.COLID : ADDID-->
			<div class="CON_OBJGRP" style="">
				<div class="CON_LABEL" style="width:100px;text-align:left;">	
					ADDID	
				</div>	
				<!-- style="width:100;"-->
				<div class="CON_OBJECT">
					<div name="G3-ADDID" id="G3-ADDID" style="width:100px;"></div>
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
				<!-- style="width:100;"-->
				<div class="CON_OBJECT">
					<div name="G3-MODDT" id="G3-MODDT" style="width:100px;"></div>
				</div>
			</div>
		<!--D101: STARTTXT, TAG-->
		<!--I.COLID : MODID-->
			<div class="CON_OBJGRP" style="">
				<div class="CON_LABEL" style="width:100px;text-align:left;">	
					MODID	
				</div>	
				<!-- style="width:100;"-->
				<div class="CON_OBJECT">
					<div name="G3-MODID" id="G3-MODID" style="width:100px;"></div>
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
