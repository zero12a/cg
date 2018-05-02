<?php
//PGMID : INTROADMIN
//PGMNM : 인트로_관리자
header("Content-Type: text/html; charset=UTF-8"); //HTML

require_once("../include/incUtil.php");
include_once('../include/incRequest.php');//CG REQUEST
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>	
<title>인트로_관리자</title>
<meta http-equiv="Context-Type" context="text/html;charset=UTF-8" />
<!--CSS/JS 불러오기-->
<script src="../lib/jquery-1.11.1.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY CORE-->
<script src="../lib/jquery-ui-1.11.1.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY UI-->
<script src="../lib/json2.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY JSON-->
<script src="../lib/dhtmlxSuite/codebase/dhtmlx.js" type="text/javascript" charset="UTF-8"></script> <!--DHTMLX CORE-->
<script src="../common/common.js" type="text/javascript" charset="UTF-8"></script> <!--DHTMLX EXT-->
<link rel="stylesheet" href="../lib/dhtmlxSuite/codebase/dhtmlx.css" type="text/css" charset="UTF-8"><!--DHTMLX CORE-->
<link rel="stylesheet" href="../lib/jquery-ui-1.8.18.css" type="text/css" charset="UTF-8"><!--JQUERY UI-->
<script src="introadmin.js?<?=getRndVal(10)?>"></script>
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

<div id="BODY_BOX" class="BODY_BOX"><!--그룹별 IO출력-->	<!--D72 : STARTTXT, TAG-->
	<!--G.GRPID : G1-->
	<div class="GRP_OBJECT" style="width:100%;height:65px;border-radius:3px;-moz-border-radius: 3px;">
	  <div style="width:0px;height:0px;overflow: hidden"><form id="condition" onsubmit="return false;"></div>
			<div class="DETAIL_LABELGRP">
			<div class="DETAIL_LABEL"  style="">
				<b>* 인트로_관리자</b>	
				<!--popup--><a href="?" target="_blank"><img src="/c.g/img/popup.png" height=10 align=absmiddle border=0></a>
				<!--reload--><a href="javascript:location.reload();"><img src="/c.g/img/reload.png" width=11 height=10 align=absmiddle border=0></a>
			</div>	
			<div class="DETAIL_LABELBTN">				<input type="button" name="BTN_G1_SEARCHALL" value="조회(전체)" onclick="G1_SEARCHALL(uuidv4());">
				<input type="button" name="BTN_G1_SAVE" value="저장" onclick="G1_SAVE(uuidv4());">
				<input type="button" name="BTN_G1_RESET" value="입력 초기화" onclick="G1_RESET(uuidv4());">
			</div>
		</div>
		<div style="height:23px;border-radius:3px;-moz-border-radius: 3px;" class="CONDITION_OBJECT">
			<DIV class="CON_LINE" is_br_tag>
		<!--컨디션 IO리스트-->
		<!--D101: STARTTXT, TAG-->
		<!--I.COLID : FROM_DT-->
		<div class="CON_OBJGRP" style="">			<div class="CON_LABEL" style="width:100px;text-align:right;">
				FROM_DT
			</div>
		<div class="CON_OBJECT">
			<input type="text" name="G1-FROM_DT" value="" id="G1-FROM_DT" style="width:100px;">
		</div>
	</div>
		<!--D101: STARTTXT, TAG-->
		<!--I.COLID : TO_DT-->
		<div class="CON_OBJGRP" style="">			<div class="CON_LABEL" style="width:40px;text-align:center;">
				~
			</div>
		<div class="CON_OBJECT">
			<input type="text" name="G1-TO_DT" value="" id="G1-TO_DT" style="width:100px;">
		</div>
	</div>
			</div><!-- is_br_tag end -->
		</div>
		<div style="width:0px;height:0px;overflow: hidden"></form></div>    
	</div>
	<!--
	#####################################################
	## 폼뷰 - START
	#####################################################
	-->
	<div class="GRP_OBJECT" style="width:50%;height:200px;">
		<div sty_le="width:0px;height:0px;overflow: hidden">
			<form id="formviewF9" name="formviewF9" method="post" enctype="multipart/form-data"  onsubmit="return false;">
			<input type="hidden" name="F9-CTLCUD"  id="F9-CTLCUD" value="">
		</div>	
		<div class="DETAIL_LABELGRP">
			<div class="DETAIL_LABEL"  style="">
				* 월점검
			</div>
			<div class="DETAIL_LABELBTN"  style="">
				<input type="button" name="BTN_F9_SAVE" value="저장" onclick="F9_SAVE(uuidv4());">				<input type="button" name="BTN_F9_NEW" value="신규" onclick="F9_NEW(uuidv4());">			</div>
		</div>
		<div style="height:159px;" class="DETAIL_OBJECT">
			<DIV class="CON_LINE" is_br_tag>
			<!--OBJECT LIST PRINT.-->
		<!--D101: STARTTXT, TAG-->
		<!--I.COLID : FROM_DT-->
		<div class="CON_OBJGRP" style="">			<div class="CON_LABEL" style="width:100px;text-align:right;">
				FROM_DT
			</div>
		<div class="CON_OBJECT">
			<input type="text" name="F9-FROM_DT" value="" id="F9-FROM_DT" style="width:100px;">
		</div>
	</div>
		<!--D101: STARTTXT, TAG-->
		<!--I.COLID : TO_DT-->
		<div class="CON_OBJGRP" style="">			<div class="CON_LABEL" style="width:40px;text-align:center;">
				~
			</div>
		<div class="CON_OBJECT">
			<input type="text" name="F9-TO_DT" value="" id="F9-TO_DT" style="width:100px;">
		</div>
	</div>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : CFM_DESC-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:90px;text-align:left;">
						CFM_DESC
					</div>
					<!-- style="width:200px;"-->
					<div class="CON_OBJECT">
	<!--CFM_DESC오브젝트출력-->						<input type="text" name="F9-CFM_DESC" value="" id="F9-CFM_DESC" style="width:200px;">
					</div>
				</div>
			</DIV><!--is_br_tab end-->
		</div>
		<div style="width:0px;height:0px;overflow: hidden"></form></div>    
	</div>
	<!--
	#####################################################
	## 폼뷰 - END
	#####################################################
	-->
	<!--
	#####################################################
	## 그리드 - START
	#####################################################
	-->
	<div class="GRP_OBJECT" style="width:50%;height:200px;">

		<div  class="GRID_LABELGRP">
  			<div id="div_gridG8_GRID_LABEL"class="GRID_LABEL" >
	  				* 월점검      
			</div>
			<div id="div_gridG8_GRID_LABELBTN" class="GRID_LABELBTN"  style="">
				<span id="spanG8Cnt" name="그리드 ROW 갯수">N</span>
			<input type="button" name="BTN_G8_SAVE" value="저장" onclick="G8_SAVE(uuidv4());">
			<input type="button" name="BTN_G8_ROWDELETE" value="행삭제" onclick="G8_ROWDELETE(uuidv4());">
			<input type="button" name="BTN_G8_RELOAD" value="새로고침" onclick="G8_RELOAD(uuidv4());">
			</div>
		</div>
		<div  class="GRID_OBJECT"  style="">
			<div id="gridG8"  style="background-color:white;overflow:hidden;height:178px;width:100%;"></div>
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
	<div class="GRP_OBJECT" style="width:50%;height:200px;">

		<div  class="GRID_LABELGRP">
  			<div id="div_gridG2_GRID_LABEL"class="GRID_LABEL" >
	  				* 로그인성공      
			</div>
			<div id="div_gridG2_GRID_LABELBTN" class="GRID_LABELBTN"  style="">
				<span id="spanG2Cnt" name="그리드 ROW 갯수">N</span>
			<input type="button" name="BTN_G2_RELOAD" value="새로고침" onclick="G2_RELOAD(uuidv4());">
			<input type="button" name="BTN_G2_HIDDENCOL" value="숨김필드보기" onclick="G2_HIDDENCOL(uuidv4());">
			<input type="button" name="BTN_G2_EXCEL" value="엑셀다운로드" onclick="G2_EXCEL(uuidv4());">
			</div>
		</div>
		<div  class="GRID_OBJECT"  style="">
			<div id="gridG2"  style="background-color:white;overflow:hidden;height:178px;width:100%;"></div>
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
	<div class="GRP_OBJECT" style="width:50%;height:200px;">

		<div  class="GRID_LABELGRP">
  			<div id="div_gridG3_GRID_LABEL"class="GRID_LABEL" >
	  				* 잠금횟수      
			</div>
			<div id="div_gridG3_GRID_LABELBTN" class="GRID_LABELBTN"  style="">
				<span id="spanG3Cnt" name="그리드 ROW 갯수">N</span>
			<input type="button" name="BTN_G3_RELOAD" value="새로고침" onclick="G3_RELOAD(uuidv4());">
			<input type="button" name="BTN_G3_HIDDENCOL" value="숨김필드보기" onclick="G3_HIDDENCOL(uuidv4());">
			<input type="button" name="BTN_G3_EXCEL" value="엑셀다운로드" onclick="G3_EXCEL(uuidv4());">
			</div>
		</div>
		<div  class="GRID_OBJECT"  style="">
			<div id="gridG3"  style="background-color:white;overflow:hidden;height:178px;width:100%;"></div>
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
	<div class="GRP_OBJECT" style="width:50%;height:200px;">

		<div  class="GRID_LABELGRP">
  			<div id="div_gridG4_GRID_LABEL"class="GRID_LABEL" >
	  				* 로그인실패      
			</div>
			<div id="div_gridG4_GRID_LABELBTN" class="GRID_LABELBTN"  style="">
				<span id="spanG4Cnt" name="그리드 ROW 갯수">N</span>
			<input type="button" name="BTN_G4_RELOAD" value="새로고침" onclick="G4_RELOAD(uuidv4());">
			<input type="button" name="BTN_G4_HIDDENCOL" value="숨김필드보기" onclick="G4_HIDDENCOL(uuidv4());">
			<input type="button" name="BTN_G4_EXCEL" value="엑셀다운로드" onclick="G4_EXCEL(uuidv4());">
			</div>
		</div>
		<div  class="GRID_OBJECT"  style="">
			<div id="gridG4"  style="background-color:white;overflow:hidden;height:178px;width:100%;"></div>
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
	<div class="GRP_OBJECT" style="width:50%;height:200px;">

		<div  class="GRID_LABELGRP">
  			<div id="div_gridG5_GRID_LABEL"class="GRID_LABEL" >
	  				* 개인정보접근      
			</div>
			<div id="div_gridG5_GRID_LABELBTN" class="GRID_LABELBTN"  style="">
				<span id="spanG5Cnt" name="그리드 ROW 갯수">N</span>
			<input type="button" name="BTN_G5_RELOAD" value="새로고침" onclick="G5_RELOAD(uuidv4());">
			<input type="button" name="BTN_G5_EXCEL" value="엑셀다운로드" onclick="G5_EXCEL(uuidv4());">
			</div>
		</div>
		<div  class="GRID_OBJECT"  style="">
			<div id="gridG5"  style="background-color:white;overflow:hidden;height:178px;width:100%;"></div>
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
	<div class="GRP_OBJECT" style="width:50%;height:200px;">

		<div  class="GRID_LABELGRP">
  			<div id="div_gridG6_GRID_LABEL"class="GRID_LABEL" >
	  				* 로그인실패IP      
			</div>
			<div id="div_gridG6_GRID_LABELBTN" class="GRID_LABELBTN"  style="">
				<span id="spanG6Cnt" name="그리드 ROW 갯수">N</span>
			<input type="button" name="BTN_G6_RELOAD" value="새로고침" onclick="G6_RELOAD(uuidv4());">
			<input type="button" name="BTN_G6_EXCEL" value="엑셀다운로드" onclick="G6_EXCEL(uuidv4());">
			</div>
		</div>
		<div  class="GRID_OBJECT"  style="">
			<div id="gridG6"  style="background-color:white;overflow:hidden;height:178px;width:100%;"></div>
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
	<div class="GRP_OBJECT" style="width:50%;height:200px;">

		<div  class="GRID_LABELGRP">
  			<div id="div_gridG7_GRID_LABEL"class="GRID_LABEL" >
	  				* 비인가메뉴접근      
			</div>
			<div id="div_gridG7_GRID_LABELBTN" class="GRID_LABELBTN"  style="">
				<span id="spanG7Cnt" name="그리드 ROW 갯수">N</span>
			<input type="button" name="BTN_G7_RELOAD" value="새로고침" onclick="G7_RELOAD(uuidv4());">
			<input type="button" name="BTN_G7_EXCEL" value="엑셀다운로드" onclick="G7_EXCEL(uuidv4());">
			</div>
		</div>
		<div  class="GRID_OBJECT"  style="">
			<div id="gridG7"  style="background-color:white;overflow:hidden;height:178px;width:100%;"></div>
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
