<?php
//PGMID : FILETEST
//PGMNM : 폼뷰테스트
header("Content-Type: text/html; charset=UTF-8"); //HTML

require_once("../include/incUtil.php");
include_once('../include/incRequest.php');//CG REQUEST
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>	
<title>폼뷰테스트</title>
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
<script src="filetest.js?<?=getRndVal(10)?>"></script>
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
	## 컨디션 컨디션 - START G.GRPID : G1-
	#####################################################
	-->
 	<div class="GRP_OBJECT" style="width:100%;">
        <div class="GRP_GAP"><!--흰색 바깥 여백-->
            <div class="GRP_INNER" style="height:74px;">	
		
	  		<div style="width:0px;height:0px;overflow: hidden"><form id="condition" onsubmit="return false;"></div>
		<div class="CONDITION_LABELGRP">
			<div class="CONDITION_LABEL"  style="">
				<b>* 폼뷰테스트</b>	
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
			<!--I.COLID : ADDDT-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						ADDDT
					</div>
					<!-- style="width:60px;"-->
					<div class="CON_OBJECT">
	<!--ADDDT오브젝트출력-->						<input type="text" name="G1-ADDDT" value="<?=getFilter(reqPostString("ADDDT",14),"SAFEECHO","")?>" id="G1-ADDDT" style="width:60px;">
					</div>
				</div>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : MODDT-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						MODDT
					</div>
					<!-- style="width:60px;"-->
					<div class="CON_OBJECT">
	<!--MODDT오브젝트출력-->						<input type="text" name="G1-MODDT" value="<?=getFilter(reqPostString("MODDT",14),"SAFEECHO","")?>" id="G1-MODDT" style="width:60px;">
					</div>
				</div>
			</div><!-- is_br_tag end -->
		</div>
		<div style="width:0px;height:0px;overflow: hidden"></form></div>    
		</div></div>
	</div>
	<!--
	#####################################################
	## BI뷰  a - START
	#####################################################
	-->
		<div class="GRP_OBJECT" style="width:25%;">
			<div class="GRP_GAP"><!--흰색 바깥 여백-->
				<div class="GRP_INNER" style="height:77px;overflow:hidden;">
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : BIVAL1A-->
                <div class="BI_ICON" style="float:left;width:30%;text-align:center;">
                        <i style="padding-top:9px;"
                        width="50"
                        height="50"
                        data-feather="eye"></i>
                </div>
                <div class="BI_VALUE"
                 style="width:70%;">
                    <span id="G4-BIVAL1A-VALUE">Value</span>
                </div>
                <div class="BI_LABEL" style="width:70%;">
                    <span id="G4-BIVAL1A-LABEL">BIVAL1A</span>
                </div>
				</div>
			</div>
		</div>
	<!--
	#####################################################
	## BI뷰  b - START
	#####################################################
	-->
		<div class="GRP_OBJECT" style="width:25%;">
			<div class="GRP_GAP"><!--흰색 바깥 여백-->
				<div class="GRP_INNER" style="height:77px;overflow:hidden;">
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : BIVAL1A-->
                <div class="BI_LABEL" style="width:100%;">
                    <span id="G5-BIVAL1A-LABEL">BIVAL1A</span>
                </div>
                <div class="BI_VALUE" style="width:80%;float:left;">
                    <span id="G5-BIVAL1A-VALUE">Value</span>
                </div>            
                <div class="BI_ICON" style="width:20%;text-align:right;">
                        <i style="padding-left:5px;padding-top:0px;"
                        color="silver" 
                        width="30"
                        height="30"
                        data-feather="eye"></i>
                </div>				</div>
			</div>
		</div>
	<!--
	#####################################################
	## BI뷰  c - START
	#####################################################
	-->
		<div class="GRP_OBJECT" style="width:25%;">
			<div class="GRP_GAP"><!--흰색 바깥 여백-->
				<div class="GRP_INNER" style="height:77px;overflow:hidden;">
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : BIVAL1A-->
 				<div class="BI_LABEL" style="float:left;width:70%;">
                    <span id="G6-BIVAL1A-LABEL">BIVAL1A</span>
                </div>
                <div class="BI_ICON" style="text-align:right;width:30%;">
                        <i style="padding-right:5px;padding-top:0px;"
                        color="silver" 
                        width="22"
                        height="22"
                        data-feather="eye"></i>
                </div>
                <div class="BI_VALUE" style="float:left;width:70%;">
                    <span id="G6-BIVAL1A-VALUE1">Value1</span>
                </div>
                <div class="BI_VALUE2 BI_VALUE2_TYPE3" style="font-width:bold;">
                    <span id="G6-BIVAL1A-VALUE2">Value2</span>
                </div>				</div>
			</div>
		</div>
	<!--
	#####################################################
	## BI뷰  d - START
	#####################################################
	-->
		<div class="GRP_OBJECT" style="width:25%;">
			<div class="GRP_GAP"><!--흰색 바깥 여백-->
				<div class="GRP_INNER" style="height:77px;overflow:hidden;">
                <div class="BI_LABEL" style="width:100%;">
                    <span id="G7-BIVAL1A-LABEL">BIVAL1A</span>
                </div>
                <div style="float:left;width:80%">
                    <div class="BI_VALUE" style="float:left;text-align:left;">
                    	<span id="G7-BIVAL1A-VALUE1">Value1</span>
                    </div>    
                    <div class="BI_VALUE2 BI_VALUE2_TYPE4">
                    	<span id="G7-BIVAL1A-VALUE2">Value2</span>
                    </div>   
                </div>
                <div class="BI_ICON" style="text-align:right;width:20%;">
                        <i style="padding-left:5px;padding-top:0px;"
                        color="silver" 
                        width="30"
                        height="30"
                        data-feather="eye"></i>
                </div>				</div>
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
  			<div id="div_gridG2_GRID_LABEL"class="GRID_LABEL" >
	  				* 그리드      
			</div>
			<div id="div_gridG2_GRID_LABELBTN" class="GRID_LABELBTN"  style="">
				<span id="spanG2Cnt" name="그리드 ROW 갯수">N</span>
			<input type="button" class="btn btn-secondary  btn-sm" name="BTN_G2_USERDEF" value="사용자정의" onclick="G2_USERDEF(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm" name="BTN_G2_SAVE" value="저장" onclick="G2_SAVE(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm" name="BTN_G2_ROWDELETE" value="행삭제" onclick="G2_ROWDELETE(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm" name="BTN_G2_ROWBULKADD" value="행대량추가" onclick="G2_ROWBULKADD(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm" name="BTN_G2_ROWADD" value="행추가" onclick="G2_ROWADD(uuidv4());">
			</div>
			</div><!--GAP-->
		</div>
		<div  class="GRID_OBJECT"  style="">
			<div id="gridG2"  style="background-color:white;overflow:hidden;height:155px;width:100%;"></div>
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
	## 폼뷰 폼뷰 - START
	#####################################################
	-->
    <div class="GRP_OBJECT" style="width:50%;">
        <div class="GRP_GAP"><!--흰색 바깥 여백-->
            <div class="GRP_INNER" style="height:194px;">
				
			<div sty_le="width:0px;height:0px;overflow: hidden">
				<form id="formviewG3" name="formviewG3" method="post" enctype="multipart/form-data"  onsubmit="return false;">
				<input type="hidden" name="G3-CTLCUD"  id="G3-CTLCUD" value="">
			</div>	
		<div class="FORMVIEW_LABELGRP">
			<div class="FORMVIEW_LABEL"  style="">
				* 폼뷰
			</div>
			<div class="FORMVIEW_LABELBTN"  style="">
			<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G3_USERDEF" value="사용자정의" onclick="G3_USERDEF(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G3_SAVE" value="저장" onclick="G3_SAVE(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G3_NEW2" value="신규" onclick="G3_NEW2(uuidv4());">
			</div>
		</div>
		<div style="height:152px;" class="FORMVIEW_OBJECT">
			<DIV class="CON_LINE" is_br_tag>
			<!--OBJECT LIST PRINT.-->
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : FILESEQ-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						FILESEQ
					</div>
					<!-- style="width:50px;"-->
					<div class="CON_OBJECT">
	<!--FILESEQ오브젝트출력-->						<input type="text" name="G3-FILESEQ" value="" id="G3-FILESEQ" style="width:50px;">
					</div>
				</div>
				</DIV>
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
		<!--D101: STARTTXT, TAG-->
		<!--I.COLID : FILE1-->
		<div class="CON_OBJGRP" style="">
			<div class="CON_LABEL" style="width:100px;text-align:left;">
				파일1
			</div>
		<!-- style="width:100;"-->	
		<div class="CON_OBJECT">
		<input type="file" name="G3-FILE1" value="" id="G3-FILE1" style="width:100px;">
		<div  id="DIV-G3-FILE1" style="display:none">
			<a href="" target="_blank" name="G3-FILE1-LINK" id="G3-FILE1-LINK"><span id="G3-FILE1-NM" name="G3-FILE1-NM"></span></a><input type="checkbox" name="G3-FILE1-DEL" id="G3-FILE1-DEL">삭제
		</div>
		</div>	
	</div>	
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : LINKVIEW-->
				<div  id="DIV_G3-LINKVIEW" class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						링크뷰
						</div>
						<!-- style="width:100px;"-->
					<div class="CON_OBJECT">
					<a href="" target="_blank" name="G3-LINKVIEW-LINK" id="G3-LINKVIEW-LINK"><span id="G3-LINKVIEW-NM" name="G3-LINKVIEW-NM"></span></a>
					</div>	
			</div>	
					</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : HIDDENLINK-->
				<div  id="DIV_G3-HIDDENLINK" class="CON_OBJGRP" style="display:none">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
							히든링크
						</div>
						<!-- style="width:100px;"-->
					<div class="CON_OBJECT">
					<a href="" target="_blank" name="G3-HIDDENLINK-LINK" id="G3-HIDDENLINK-LINK"><span id="G3-HIDDENLINK-NM" name="G3-HIDDENLINK-NM"></span></a>
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
