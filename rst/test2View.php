<?php
//PGMID : TEST2
//PGMNM : 프로젝트 관리
header("Content-Type: text/html; charset=UTF-8"); //HTML

require_once("../include/incUtil.php");
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>	
<title>프로젝트 관리</title>
<meta http-equiv="Context-Type" context="text/html;charset=UTF-8" /><style>
    body {margin:0;padding:0}
    div,input {font-size: 11px;}

    #F_START_DT, #F_END_DT {
        border: 1px solid #909090;
    }

	input[tppe=text]:-moz-read-only { /* For Firefox */
    	background-color: silver;
	}

	input[type=text]:read-only {
		background-color: silver;
	}

    .BODY_BOX {width:100%;height:100%;background-color:yellowgreen;padding:5px 5px 5px 5px;}

     .CON_LINE {position: relative;width:100%;overflow:auto;z-index:20;}
    .CON_OBJGRP {position: relative;float:left;background-color: #eeeeee;vertical-align:middle ;overflow:auto;z-index:25;}
    .CON_LABEL {position: relative;float:left;background-color: #eeeeee;vertical-align:middle ;padding-left:5px;overflow:auto;z-index:30;}
    .CON_OBJECT {position: relative;float:left;background-color: #eeeeee;vertical-align:middle;overflow:auto;z-index:30;}
    .CON_LINEPADDING {position: relative;height:5px;overflow:auto;z-index:20;}

    .GRID_LABELGRP {position:relative;width:100%;height:22px;z-index:20;}
    .GRID_LABEL {position:relative;float:left;width:30%;height:22px;line-height:22px;vertical-align:middle;z-index:30;}
    .GRID_LABELBTN {position: relative;float:left;width:70%;height:22px;line-height:22px;vertical-align:middle;text-align:right;z-index:30;}
    .GRID_OBJECT {position: relative;width:100%;padding:0 0 0 0;z-index:20;}
    .CONDITION_LABELGRP {position:relative;width:100%;height:22px;z-index:20;}
    .CONDITION_LABEL {position:relative;float:left;width:60%;height:22px;line-height:22px;vertical-align:middle;z-index:30;}
    .CONDITION_LABELBTN {position: relative;float:left;width:40%;height:22px;line-height:22px;vertical-align:middle;text-align:right;z-index:30;}
    .CONDITION_OBJECT {position: relative;background-color:#eeeeee;padding:10px 10px 10px 10px;overflow:auto;}

    .DETAIL_LABELGRP {position:relative;width:100%;height:22px;z-index:20;}
    .DETAIL_LABEL {position:relative;float:left;width:30%;height:22px;line-height:22px;vertical-align:middle;z-index:30;}
    .DETAIL_LABELBTN {position: relative;float:left;width:70%;height:22px;line-height:22px;vertical-align:middle;text-align:right;z-index:30;}
    .DETAIL_OBJECT {position: relative;background-color:#eeeeee;padding:10px 10px 10px 10px;overflow:auto;}

    .GRP_LINE {position: relative;width:100%;z-index:10;overflow:auto;}
    .GRP_OBJECT {position: relative;float:left;z-index:20;}
	
	.FORMVIEW_IMGVIEWER {background-color:#e1e1e1;}
</style>
<!--CSS/JS 불러오기-->
<script src="../lib/jquery-1.11.1.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY CORE-->
<script src="../lib/jquery-1.11.1.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY CORE-->
<script src="../lib/jquery-ui-1.11.1.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY UI-->
<script src="../lib/json2.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY JSON-->
<script src="../lib/dhtmlxSuite/codebase/dhtmlx.js" type="text/javascript" charset="UTF-8"></script> <!--DHTMLX CORE-->
<script src="/c.g/rst/cg_common.js" type="text/javascript" charset="UTF-8"></script> <!--DHTMLX EXT-->
<link rel="stylesheet" href="../lib/dhtmlxSuite/codebase/dhtmlx.css" type="text/css" charset="UTF-8"><!--DHTMLX CORE-->
<link rel="stylesheet" href="../lib/jquery-ui-1.8.18.css" type="text/css" charset="UTF-8"><!--JQUERY UI-->
<script src="test2.js?<?=getRndVal(10)?>"></script></head><body onload="initBody();">

<div id="BODY_BOX" class="BODY_BOX"><!--그룹별 IO출력-->	<!--D51 : BTN, STARTTXT -->
	<!--G.GRPID = G1-->
	<!--V.SVCGRPID = -->
	<div  class="GRID_LABELGRP">
		<div class="GRID_LABEL" >
			* 프로젝트 관리
			<!--popup--><a href="?" target="_blank"><img src="/c.g/img/popup.png" height=10 align=absmiddle border=0></a>
			<!--reload--><a href="javascript:location.reload();"><img src="/c.g/img/reload.png" width=11 height=10 align=absmiddle border=0></a>
		</div>
		<div  class="GRID_LABELBTN"  >
					<input type="button" name="BTN_G1_SAVE" value="저장" onclick="G1_SAVE();">
			<input type="button" name="BTN_G1_NEW" value="신규" onclick="G1_NEW();">
			<input type="button" name="BTN_G1_MODIFY" value="수정" onclick="G1_MODIFY();">
			<input type="button" name="BTN_G1_DELETE" value="삭제" onclick="G1_DELETE();">
			<input type="button" name="BTN_G1_BTNCLICK" value="조회(BTN)" onclick="G1_BTNCLICK();">
		</div>
	</div>
	<!--D72 : STARTTXT, TAG-->
	<!--G.GRPID : G2-->
	<!--V.SVCGRPID : -->
	<div class="GRP_OBJECT" style="width:100%;height:50px;">
	  <div style="width:0px;height:0px;overflow: hidden"><form id="condition"></div>
			<div style="height:30px;" class="CONDITION_OBJECT">
				<div class="CON_LINE" is_br_tag>
		<!--컨디션 IO리스트-->	
		<!--D101: STARTTXT, TAG-->
		<!--I.COLID : PJTID-->
		<div class="CON_OBJGRP" style="">
		<div class="CON_LABEL" style="width:100;">
			프로젝트ID
		</div>
		<!-- style="width:100;"-->
		<div class="CON_OBJECT">
		<input type="text" name="G2_PJTID" value="" id="G2_PJTID" style="width:100;">
		</div>
	</div>
		</DIV>
		<DIV class="CON_LINE" is_br_tag>
		<!--D101: STARTTXT, TAG-->
		<!--I.COLID : ADDDT-->
		<div class="CON_OBJGRP" style="display:none">		<div class="CON_LABEL" style="width:100;">
			생성일
		</div>
		<div class="CON_OBJECT" style="width:100;">
			<input type="text" name="G2_ADDDT" value="" id="G2_ADDDT" style="width:100;">
		</div>
	</div>
			</div><!-- is_br_tag end -->
		</div>
		<div style="width:0px;height:0px;overflow: hidden"></form></div>    
	</div>
	<!--D89 : HTML, STARTXT -->
	<!--G.GRPID : G3-->
	<!--V.SVCGRPID : -->
	<div class="GRP_OBJECT" style="width:50%;height:200px;">

			<div  class="GRID_LABELGRP">
  			<div id="div_grid4_GRID_LABEL"class="GRID_LABEL" >
	  				* PJT      
			</div>
			<div id="div_grid30_GRID_LABELBTN" class="GRID_LABELBTN"  style="">
				<span id="spanG3Cnt" name="그리드 ROW 갯수">N</span>
			<input type="button" name="BTN_G3_SEARCH" value="조회" onclick="G3_SEARCH();">
			<input type="button" name="BTN_G3_SAVE" value="저장" onclick="G3_SAVE();">
			<input type="button" name="BTN_G3_ROWDELETE" value="행삭제" onclick="G3_ROWDELETE();">
			<input type="button" name="BTN_G3_ROWADD" value="행추가" onclick="G3_ROWADD();">
			<input type="button" name="BTN_G3_RELOAD" value="새로고침" onclick="G3_RELOAD();">
			<input type="button" name="BTN_G3_LINK" value="링크이동합니다" onclick="G3_LINK();">
			</div>
		</div>
		<div  class="GRID_OBJECT"  style="">
			<div id="gridG3"  style="background-color:white;overflow:hidden;height:178px;width:100%;"></div>
		</div>
	</div>
	<!--D89 : HTML, STARTXT -->
	<!--G.GRPID : G4-->
	<!--V.SVCGRPID : -->
	<div class="GRP_OBJECT" style="width:50%;height:200px;">

			<div  class="GRID_LABELGRP">
  			<div id="div_grid4_GRID_LABEL"class="GRID_LABEL" >
	  				* PGM      
			</div>
			<div id="div_grid40_GRID_LABELBTN" class="GRID_LABELBTN"  style="">
				<span id="spanG4Cnt" name="그리드 ROW 갯수">N</span>
			<input type="button" name="BTN_G4_SEARCH" value="조회" onclick="G4_SEARCH();">
			<input type="button" name="BTN_G4_SAVE" value="저장" onclick="G4_SAVE();">
			<input type="button" name="BTN_G4_ROWDELETE" value="행삭제" onclick="G4_ROWDELETE();">
			<input type="button" name="BTN_G4_ROWADD" value="행추가" onclick="G4_ROWADD();">
			<input type="button" name="BTN_G4_RELOAD" value="새로고침" onclick="G4_RELOAD();">
			<input type="button" name="BTN_G4_EXCEL" value="엑셀다운로드" onclick="G4_EXCEL();">
			</div>
		</div>
		<div  class="GRID_OBJECT"  style="">
			<div id="gridG4"  style="background-color:white;overflow:hidden;height:178px;width:100%;"></div>
		</div>
	</div>
	<!--D89 : HTML, STARTXT -->
	<!--G.GRPID : G5-->
	<!--V.SVCGRPID : -->
	<div class="GRP_OBJECT" style="width:100%;height:200px;">

			<div  class="GRID_LABELGRP">
  			<div id="div_grid4_GRID_LABEL"class="GRID_LABEL" >
	  				* DD      
			</div>
			<div id="div_grid50_GRID_LABELBTN" class="GRID_LABELBTN"  style="">
				<span id="spanG5Cnt" name="그리드 ROW 갯수">N</span>
			<input type="button" name="BTN_G5_SEARCH" value="조회" onclick="G5_SEARCH();">
			<input type="button" name="BTN_G5_SAVE" value="저장" onclick="G5_SAVE();">
			<input type="button" name="BTN_G5_ROWDELETE" value="행삭제" onclick="G5_ROWDELETE();">
			<input type="button" name="BTN_G5_ROWADD" value="행추가" onclick="G5_ROWADD();">
			<input type="button" name="BTN_G5_RELOAD" value="새로고침" onclick="G5_RELOAD();">
			<input type="button" name="BTN_G5_EXCEL" value="엑셀다운로드" onclick="G5_EXCEL();">
			</div>
		</div>
		<div  class="GRID_OBJECT"  style="">
			<div id="gridG5"  style="background-color:white;overflow:hidden;height:178px;width:100%;"></div>
		</div>
	</div>
	<!--D89 : HTML, STARTXT -->
	<!--G.GRPID : G6-->
	<!--V.SVCGRPID : -->
	<div class="GRP_OBJECT" style="width:50%;height:200px;">

			<div  class="GRID_LABELGRP">
  			<div id="div_grid4_GRID_LABEL"class="GRID_LABEL" >
	  				* CONFIG      
			</div>
			<div id="div_grid60_GRID_LABELBTN" class="GRID_LABELBTN"  style="">
				<span id="spanG6Cnt" name="그리드 ROW 갯수">N</span>
			<input type="button" name="BTN_G6_USERDEF" value="사용자정의" onclick="G6_USERDEF();">
			<input type="button" name="BTN_G6_SEARCH" value="조회" onclick="G6_SEARCH();">
			<input type="button" name="BTN_G6_SAVE" value="저장" onclick="G6_SAVE();">
			<input type="button" name="BTN_G6_ROWDELETE" value="행삭제" onclick="G6_ROWDELETE();">
			<input type="button" name="BTN_G6_ROWADD" value="행추가" onclick="G6_ROWADD();">
			<input type="button" name="BTN_G6_RELOAD" value="새로고침" onclick="G6_RELOAD();">
			<input type="button" name="BTN_G6_EXCEL" value="엑셀다운로드" onclick="G6_EXCEL();">
			</div>
		</div>
		<div  class="GRID_OBJECT"  style="">
			<div id="gridG6"  style="background-color:white;overflow:hidden;height:178px;width:100%;"></div>
		</div>
	</div>
	<!--D89 : HTML, STARTXT -->
	<!--G.GRPID : G7-->
	<!--V.SVCGRPID : -->
	<div class="GRP_OBJECT" style="width:50%;height:200px;">

			<div  class="GRID_LABELGRP">
  			<div id="div_grid4_GRID_LABEL"class="GRID_LABEL" >
	  				* FILE      
			</div>
			<div id="div_grid70_GRID_LABELBTN" class="GRID_LABELBTN"  style="">
				<span id="spanG7Cnt" name="그리드 ROW 갯수">N</span>
			<input type="button" name="BTN_G7_USERDEF" value="사용자정의" onclick="G7_USERDEF();">
			<input type="button" name="BTN_G7_SEARCH" value="조회" onclick="G7_SEARCH();">
			<input type="button" name="BTN_G7_SAVE" value="저장" onclick="G7_SAVE();">
			<input type="button" name="BTN_G7_ROWDELETE" value="행삭제" onclick="G7_ROWDELETE();">
			<input type="button" name="BTN_G7_ROWADD" value="행추가" onclick="G7_ROWADD();">
			<input type="button" name="BTN_G7_RELOAD" value="새로고침" onclick="G7_RELOAD();">
			<input type="button" name="BTN_G7_EXCEL" value="엑셀다운로드" onclick="G7_EXCEL();">
			</div>
		</div>
		<div  class="GRID_OBJECT"  style="">
			<div id="gridG7"  style="background-color:white;overflow:hidden;height:178px;width:100%;"></div>
		</div>
	</div>
</div>



</body>
</html>
