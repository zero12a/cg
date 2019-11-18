<?php
//PGMID : CODETEST
//PGMNM : Copy of 코드관리
header("Content-Type: text/html; charset=UTF-8"); //HTML

require_once("../include/incUtil.php");
include_once('../include/incRequest.php');//CG REQUEST
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>	
<title>Copy of 코드관리</title>
<meta http-equiv="Context-Type" context="text/html;charset=UTF-8" />
<!--CSS/JS 불러오기-->
<!--JS 불러오기-->
<script src="/lib/feather.min.js" type="text/javascript" charset="UTF-8"></script> <!--FEATHER ICON JS-->
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

<!--CSS 불러오기-->
<link rel="stylesheet" href="../common/common.css" type="text/css" charset="UTF-8"><!--FEATHER ICON CSS-->
<link rel="stylesheet" href="../lib/dhtmlxSuite/codebase/dhtmlx.css" type="text/css" charset="UTF-8"><!--DHTMLX CORE-->
<link rel="stylesheet" href="/lib/jquery/jquery-ui.min.css" type="text/css" charset="UTF-8"><!--JQUERY UI-->
<link rel="stylesheet" href="/lib/bootstrap4/css/bootstrap.min.css" type="text/css" charset="UTF-8"><!--BOOTSTRAP V4-->
<link rel="stylesheet" href="/lib/bootstrap-table/bootstrap-table.min.css" type="text/css" charset="UTF-8"><!--BT4 Table CSS-->
<link rel="stylesheet" href="/lib/codemirror/lib/codemirror.css" type="text/css" charset="UTF-8"><!--CODE MIRROR CSS-->
<!--공통 js/css-->
<script src="codetest.js?<?=getRndVal(10)?>"></script>
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
	## 컨디션 1 - START G.GRPID : G1-
	#####################################################
	-->
 	<div class="GRP_OBJECT" style="width:100%;">
        <div class="GRP_GAP"><!--흰색 바깥 여백-->
            <div class="GRP_INNER" style="height:74px;">	
		
	  		<div style="width:0px;height:0px;overflow: hidden"><form id="condition" onsubmit="return false;"></div>
		<div class="CONDITION_LABELGRP">
			<div class="CONDITION_LABEL"  style="">
				<b>* Copy of 코드관리</b>	
				<!--popup--><a href="?" target="_blank"><img src="/c.g/img/popup.png" height=10 align=absmiddle border=0></a>
				<!--reload--><a href="javascript:location.reload();"><img src="/c.g/img/reload.png" width=11 height=10 align=absmiddle border=0></a>
			</div>	
			<div class="CONDITION_LABELBTN">				<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G1_SEARCHALL" value="조회(전체)" onclick="G1_SEARCHALL(uuidv4());">
				<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G1_SAVE" value="저장" onclick="G1_SAVE(uuidv4());">
				<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G1_RESET" value="입력 초기화" onclick="G1_RESET(uuidv4());">
			</div>
		</div>
		<div style="height:32px;border-radius:3px;-moz-border-radius: 3px;" class="CONDITION_OBJECT">
			<DIV class="CON_LINE" is_br_tag>
		<!--컨디션 IO리스트-->
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : ADD_DT-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:120px;text-align:left;">
						ADD
					</div>
					<!-- style="width:60px;"-->
					<div class="CON_OBJECT">
	<!--ADD_DT오브젝트출력-->						<input type="text" name="G1-ADD_DT" value="<?=getFilter(reqPostString("ADD_DT",14),"SAFEECHO","")?>" id="G1-ADD_DT" style="width:60px;">
					</div>
				</div>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : MYRADIO-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
 						나의라디오
 					</div>
 					<!-- style="width:400px;"-->
					<div class="CON_OBJECT">
 	<!--MYRADIO오브젝트출력 radio-->
	<div name="G1-MYRADIO-HOLDER" id="G1-MYRADIO-HOLDER"  style="width:400px;"></div>
					</div>
 				</div>
 			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : MYCHECK-->
				<div class="CON_OBJGRP" style="">
						<div class="CON_LABEL" style="width:100px;text-align:left;">
 						체크
 					</div>
 					<!-- style="width:400px;"-->
					<div class="CON_OBJECT">
 	<!--MYCHECK오브젝트출력 checkbox-->
	<div name="G1-MYCHECK-HOLDER" id="G1-MYCHECK-HOLDER"  style="width:400px;"></div>
					</div>
 				</div>
 			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : PNM-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						PNM
					</div>
					<!-- style="width:60px;"-->
					<div class="CON_OBJECT">
	<!--PNM오브젝트출력-->						<input type="text" name="G1-PNM" value="<?=getFilter(reqPostString("PNM",100),"SAFEECHO","")?>" id="G1-PNM" style="width:60px;">
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
    <div class="GRP_OBJECT" style="width:30%;">
        <div class="GRP_GAP"><!--흰색 바깥 여백-->
		<div  class="GRID_LABELGRP">
			<div class="GRID_LABELGRP_GAP">	<!--그리드만 필요-->
  			<div id="div_gridG2_GRID_LABEL"class="GRID_LABEL" >
	  				* 마스터      
			</div>
			<div id="div_gridG2_GRID_LABELBTN" class="GRID_LABELBTN"  style="">
				<span id="spanG2Cnt" name="그리드 ROW 갯수">N</span>
			<input type="button" class="btn btn-secondary  btn-sm" name="BTN_G2_SAVE" value="저장" onclick="G2_SAVE(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm" name="BTN_G2_ROWDELETE" value="-" onclick="G2_ROWDELETE(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm" name="BTN_G2_ROWADD" value="+" onclick="G2_ROWADD(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm" name="BTN_G2_RELOAD" value="R" onclick="G2_RELOAD(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm" name="BTN_G2_HIDDENCOL" value="v" onclick="G2_HIDDENCOL(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm" name="BTN_G2_CHKSAVE" value="선택저장" onclick="G2_CHKSAVE(uuidv4());">
			<input type="checkbox" name="G2-edit_EDIT_MODE" id="G2-edit_EDIT_MODE" value="Y" style="vertical-align:middle;">편집모드
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
	## 그리드 - START
	#####################################################
	-->
    <div class="GRP_OBJECT" style="width:70%;">
        <div class="GRP_GAP"><!--흰색 바깥 여백-->
		<div  class="GRID_LABELGRP">
			<div class="GRID_LABELGRP_GAP">	<!--그리드만 필요-->
  			<div id="div_gridG3_GRID_LABEL"class="GRID_LABEL" >
	  				* 상세      
			</div>
			<div id="div_gridG3_GRID_LABELBTN" class="GRID_LABELBTN"  style="">
				<span id="spanG3Cnt" name="그리드 ROW 갯수">N</span>
			<input type="button" class="btn btn-secondary  btn-sm" name="BTN_G3_SAVE" value="저장" onclick="G3_SAVE(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm" name="BTN_G3_ROWDELETE" value="행삭제" onclick="G3_ROWDELETE(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm" name="BTN_G3_ROWBULKADD" value="행대량추가" onclick="G3_ROWBULKADD(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm" name="BTN_G3_ROWADD" value="행추가" onclick="G3_ROWADD(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm" name="BTN_G3_RELOAD" value="새로고침" onclick="G3_RELOAD(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm" name="BTN_G3_HIDDENCOL" value="숨김필드보기" onclick="G3_HIDDENCOL(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm" name="BTN_G3_EXCEL" value="엑셀다운로드" onclick="G3_EXCEL(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm" name="BTN_G3_CHKSAVE" value="선택저장" onclick="G3_CHKSAVE(uuidv4());">
			</div>
			</div><!--GAP-->
		</div>
		<div  class="GRID_OBJECT"  style="">
			<div id="gridG3"  style="background-color:white;overflow:hidden;height:455px;width:100%;"></div>
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
	## 폼뷰 상세폼 - START
	#####################################################
	-->
    <div class="GRP_OBJECT" style="width:100%;">
        <div class="GRP_GAP"><!--흰색 바깥 여백-->
            <div class="GRP_INNER" style="height:194px;">
				
			<div sty_le="width:0px;height:0px;overflow: hidden">
				<form id="formviewG4" name="formviewG4" method="post" enctype="multipart/form-data"  onsubmit="return false;">
				<input type="hidden" name="G4-CTLCUD"  id="G4-CTLCUD" value="">
			</div>	
		<div class="FORMVIEW_LABELGRP">
			<div class="FORMVIEW_LABEL"  style="">
				* 상세폼
			</div>
			<div class="FORMVIEW_LABELBTN"  style="">
			<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G4_USERDEF" value="사용자정의" onclick="G4_USERDEF(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G4_RELOAD" value="새로고침" onclick="G4_RELOAD(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G4_NEW" value="신규" onclick="G4_NEW(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G4_MODIFY" value="수정" onclick="G4_MODIFY(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G4_DELETE" value="삭제" onclick="G4_DELETE(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G4_save" value="저장" onclick="G4_save(uuidv4());">
			</div>
		</div>
		<div style="height:152px;" class="FORMVIEW_OBJECT">
			<DIV class="CON_LINE" is_br_tag>
			<!--OBJECT LIST PRINT.-->
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : MYCHECK-->
				<div class="CON_OBJGRP" style="">
						<div class="CON_LABEL" style="width:100px;text-align:left;">
 						체크
 					</div>
 					<!-- style="width:400px;"-->
					<div class="CON_OBJECT">
 	<!--MYCHECK오브젝트출력 checkbox-->
	<div name="G4-MYCHECK-HOLDER" id="G4-MYCHECK-HOLDER"  style="width:400px;"></div>
					</div>
 				</div>
 			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : ADD_DT-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:120px;text-align:left;">
						ADD
					</div>
					<!-- style="width:60px;"-->
					<div class="CON_OBJECT">
	<!--ADD_DT오브젝트출력-->						<input type="text" name="G4-ADD_DT" value="" id="G4-ADD_DT" style="width:60px;">
					</div>
				</div>
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : MYRADIO-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
 						나의라디오
 					</div>
 					<!-- style="width:400px;"-->
					<div class="CON_OBJECT">
 	<!--MYRADIO오브젝트출력 radio-->
	<div name="G4-MYRADIO-HOLDER" id="G4-MYRADIO-HOLDER"  style="width:400px;"></div>
					</div>
 				</div>
 				</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : HIDDENLINK-->
				<div  id="DIV_G4-HIDDENLINK" class="CON_OBJGRP" style="display:none">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
							히든링크
						</div>
						<!-- style="width:100px;"-->
					<div class="CON_OBJECT">
					<a href="" target="_blank" name="G4-HIDDENLINK-LINK" id="G4-HIDDENLINK-LINK"><span id="G4-HIDDENLINK-NM" name="G4-HIDDENLINK-NM"></span></a>
			</div>	
		</div>	
				</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : PCD-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						PCD
					</div>
					<!-- style="width:60px;"-->
					<div class="CON_OBJECT">
	<!--PCD오브젝트출력-->						<input type="text" name="G4-PCD" value="" id="G4-PCD" style="width:60px;">
					</div>
				</div>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : IMG-->
				<div class="CON_OBJGRP" style="">
				<div class="CON_LABEL" style="width:100px;text-align:left;">	
					이미지뷰어	
				</div>	
				<!-- style="width:200;"-->
				<div class="CON_OBJECT">
					<div 
						 name="G4-IMG-HOLDER" 
						 id="G4-IMG-HOLDER"
						 class="FORMVIEW_IMGVIEWER"
						 style="width:200px;height:50px;">
					</div>
				</div>
			</div>
			<!--D101: STARTTXT, TAG-->
		<!--I.COLID : TFILE-->
		<div class="CON_OBJGRP" style="">
			<div class="CON_LABEL" style="width:100px;text-align:left;">
				파일
			</div>
		<!-- style="width:300;"-->	
		<div class="CON_OBJECT">
		<input type="file" name="G4-TFILE" value="" id="G4-TFILE" style="width:300px;">
		<div  id="DIV-G4-TFILE" style="display:none">
			<a href="" target="_blank" name="G4-TFILE-LINK" id="G4-TFILE-LINK"><span id="G4-TFILE-NM" name="G4-TFILE-NM"></span></a><input type="checkbox" name="G4-TFILE-DEL" id="G4-TFILE-DEL">삭제
		</div>
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
