<?php
//PGMID : PGMSEARCH
//PGMNM : 프로그램검색
header("Content-Type: text/html; charset=UTF-8"); //HTML

require_once("../include/incUtil.php");
include_once('../include/incRequest.php');//CG REQUEST
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>	
<title>프로그램검색</title>
<meta http-equiv="Context-Type" context="text/html;charset=UTF-8" />
<!--CSS/JS 불러오기-->
<script src="../lib/jquery-1.11.1.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY CORE-->
<script src="../lib/jquery-ui-1.11.1.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY UI-->
<script src="../lib/json2.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY JSON-->
<script src="../lib/dhtmlxSuite/codebase/dhtmlx.js" type="text/javascript" charset="UTF-8"></script> <!--DHTMLX CORE-->
<script src="../common/common.js" type="text/javascript" charset="UTF-8"></script> <!--DHTMLX EXT-->
<link rel="stylesheet" href="../lib/dhtmlxSuite/codebase/dhtmlx.css" type="text/css" charset="UTF-8"><!--DHTMLX CORE-->
<link rel="stylesheet" href="../lib/jquery-ui-1.8.18.css" type="text/css" charset="UTF-8"><!--JQUERY UI-->
<script src="pgmsearch.js?<?=getRndVal(10)?>"></script>
<link href="../common/common.css?11" rel="stylesheet" type="text/css" />
<script>
	//팝업창인 경우 오프너에게서 파라미터 받기
    var grpId = "<?=getFilter(reqPostString("GRPID",20),"SAFEECHO","")?>";
    var rowId = "<?=getFilter(reqPostString("ROWID",30),"SAFEECHO","")?>";
    var colId = "<?=getFilter(reqPostString("COLID",30),"SAFEECHO","")?>";
    var btnNm = "<?=getFilter(reqPostString("BTNNM",30),"SAFEECHO","")?>";
</script>
</head>
<body onload="initBody();" class="HTML_BODY">

<div id="BODY_BOX" class="BODY_BOX"><!--그룹별 IO출력-->	<!--D72 : STARTTXT, TAG-->
	<!--G.GRPID : G1-->
	<div class="GRP_OBJECT" style="width:100%;height:80px;border-radius:3px;-moz-border-radius: 3px;">
	  <div style="width:0px;height:0px;overflow: hidden"><form id="condition" onsubmit="return false;"></div>
			<div class="DETAIL_LABELGRP">
			<div class="DETAIL_LABEL"  style="">
				<b>* 프로그램검색</b>	
				<!--popup--><a href="?" target="_blank"><img src="/c.g/img/popup.png" height=10 align=absmiddle border=0></a>
				<!--reload--><a href="javascript:location.reload();"><img src="/c.g/img/reload.png" width=11 height=10 align=absmiddle border=0></a>
			</div>	
			<div class="DETAIL_LABELBTN">				<input type="button" name="BTN_G1_SEARCHALL" value="조회(전체)" onclick="G1_SEARCHALL();">
				<input type="button" name="BTN_G1_SAVE" value="저장" onclick="G1_SAVE();">
				<input type="button" name="BTN_G1_RESET" value="입력 초기화" onclick="G1_RESET();">
			</div>
		</div>
		<div style="height:38px;border-radius:3px;-moz-border-radius: 3px;" class="CONDITION_OBJECT">
			<DIV class="CON_LINE" is_br_tag>
		<!--컨디션 IO리스트-->
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : PGMID-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						프로그램ID
					</div>
					<!-- style="width:100px;"-->
					<div class="CON_OBJECT">
	<!--PGMID오브젝트출력-->						<input type="text" name="G1-PGMID" value="<?=getFilter(reqPostString("PGMID",20),"SAFEECHO","")?>" id="G1-PGMID" style="width:100px;">
					</div>
				</div>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : PGMNM-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						프로그램이름
					</div>
					<!-- style="width:100px;"-->
					<div class="CON_OBJECT">
	<!--PGMNM오브젝트출력-->						<input type="text" name="G1-PGMNM" value="<?=getFilter(reqPostString("PGMNM",50),"SAFEECHO","")?>" id="G1-PGMNM" style="width:100px;">
					</div>
				</div>
			</div><!-- is_br_tag end -->
		</div>
		<div style="width:0px;height:0px;overflow: hidden"></form></div>    
	</div>
	<!--
	#####################################################
	## 그리드 - START
	#####################################################
	-->
	<div class="GRP_OBJECT" style="width:50%;height:400px;">

		<div  class="GRID_LABELGRP">
  			<div id="div_gridG2_GRID_LABEL"class="GRID_LABEL" >
	  				* G2      
			</div>
			<div id="div_gridG2_GRID_LABELBTN" class="GRID_LABELBTN"  style="">
				<span id="spanG2Cnt" name="그리드 ROW 갯수">N</span>
			<input type="button" name="BTN_G2_SAVE" value="저장" onclick="G2_SAVE();">
			<input type="button" name="BTN_G2_ROWDELETE" value="행삭제" onclick="G2_ROWDELETE();">
			<input type="button" name="BTN_G2_ROWBULKADD" value="행대량추가" onclick="G2_ROWBULKADD();">
			<input type="button" name="BTN_G2_ROWADD" value="행추가" onclick="G2_ROWADD();">
			<input type="button" name="BTN_G2_RELOAD" value="새로고침" onclick="G2_RELOAD();">
			<input type="button" name="BTN_G2_HIDDENCOL" value="숨김필드보기" onclick="G2_HIDDENCOL();">
			<input type="button" name="BTN_G2_EXCEL" value="엑셀다운로드" onclick="G2_EXCEL();">
			<input type="button" name="BTN_G2_CHKSAVE" value="선택저장" onclick="G2_CHKSAVE();">
			</div>
		</div>
		<div  class="GRID_OBJECT"  style="">
			<div id="gridG2"  style="background-color:white;overflow:hidden;height:378px;width:100%;"></div>
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
	<div class="GRP_OBJECT" style="width:50%;height:400px;">

		<div  class="GRID_LABELGRP">
  			<div id="div_gridG3_GRID_LABEL"class="GRID_LABEL" >
	  				* G3      
			</div>
			<div id="div_gridG3_GRID_LABELBTN" class="GRID_LABELBTN"  style="">
				<span id="spanG3Cnt" name="그리드 ROW 갯수">N</span>
			<input type="button" name="BTN_G3_SAVE" value="저장" onclick="G3_SAVE();">
			<input type="button" name="BTN_G3_ROWDELETE" value="행삭제" onclick="G3_ROWDELETE();">
			<input type="button" name="BTN_G3_ROWBULKADD" value="행대량추가" onclick="G3_ROWBULKADD();">
			<input type="button" name="BTN_G3_ROWADD" value="행추가" onclick="G3_ROWADD();">
			<input type="button" name="BTN_G3_RELOAD" value="새로고침" onclick="G3_RELOAD();">
			<input type="button" name="BTN_G3_HIDDENCOL" value="숨김필드보기" onclick="G3_HIDDENCOL();">
			<input type="button" name="BTN_G3_EXCEL" value="엑셀다운로드" onclick="G3_EXCEL();">
			<input type="button" name="BTN_G3_CHKSAVE" value="선택저장" onclick="G3_CHKSAVE();">
			</div>
		</div>
		<div  class="GRID_OBJECT"  style="">
			<div id="gridG3"  style="background-color:white;overflow:hidden;height:378px;width:100%;"></div>
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


</div><!--BODY_BOX-->

</body>
</html>
