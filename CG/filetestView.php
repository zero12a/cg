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
<script src="../lib/jquery-1.11.1.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY CORE-->
<script src="../lib/jquery-ui-1.11.1.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY UI-->
<script src="../lib/json2.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY JSON-->
<script src="/lib/hashmap.js" type="text/javascript" charset="UTF-8"></script> <!--HASHMAP-->
<script src="../lib/dhtmlxSuite/codebase/dhtmlx.js" type="text/javascript" charset="UTF-8"></script> <!--DHTMLX CORE-->
<script src="/lib/chart.min.js" type="text/javascript" charset="UTF-8"></script> <!--Chart.js-->
<script src="/chartjs_util.js" type="text/javascript" charset="UTF-8"></script> <!--Chart.js-->
<script src="../common/common.js" type="text/javascript" charset="UTF-8"></script> <!--DHTMLX EXT-->
<script src="/lib/moment.min.js" type="text/javascript" charset="UTF-8"></script> <!--Moment Date-->
<link rel="stylesheet" href="../lib/dhtmlxSuite/codebase/dhtmlx.css" type="text/css" charset="UTF-8"><!--DHTMLX CORE-->
<link rel="stylesheet" href="../lib/jquery-ui-1.8.18.css" type="text/css" charset="UTF-8"><!--JQUERY UI-->
<script src="filetest.js?<?=getRndVal(10)?>"></script>
<link href="../common/common.css" rel="stylesheet" type="text/css" />


<script src="/lib/feather.min.js"></script>

  <style>
.BI_LINE {position: relative;width:100%;overflow:auto;z-index:20;}
.BI_OBJGRP {border:0px solid black;padding:0px 0px 0px 0px;position: relative;float:left;vertical-align:middle ;overflow:auto;z-index:25;}
.BI_LABEL {height:22px;position: relative;background-color: #eeeeee;vertical-align:middle ;overflow:auto;z-index:30;}
.BI_ICON {position: relative;background-color: #eeeeee;vertical-align:middle;overflow:auto;z-index:30;}
.BI_VALUE {height:47px;position: relative;background-color: #eeeeee;vertical-align:middle;overflow:auto;z-index:30;}
.BI_VALUE2 {position: relative;background-color: #eeeeee;vertical-align:middle;overflow:auto;z-index:30;}

.BI_LINEPADDING {position: relative;height:5px;overflow:auto;z-index:20;}
  </style>


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
	<div class="GRP_OBJECT" style="width:100%;height:80px;border-radius:3px;-moz-border-radius: 3px;">
	  <div style="width:0px;height:0px;overflow: hidden"><form id="condition" onsubmit="return false;"></div>
			<div class="DETAIL_LABELGRP">
			<div class="DETAIL_LABEL"  style="">
				<b>* 폼뷰테스트</b>	
				<!--popup--><a href="?" target="_blank"><img src="/c.g/img/popup.png" height=10 align=absmiddle border=0></a>
				<!--reload--><a href="javascript:location.reload();"><img src="/c.g/img/reload.png" width=11 height=10 align=absmiddle border=0></a>
			</div>	
			<div class="DETAIL_LABELBTN">				<input type="button" name="BTN_G1_USERDEF" value="사용자정의" onclick="G1_USERDEF(uuidv4());">
				<input type="button" name="BTN_G1_SEARCHALL" value="조회(전체)" onclick="G1_SEARCHALL(uuidv4());">
				<input type="button" name="BTN_G1_SAVE" value="저장" onclick="G1_SAVE(uuidv4());">
				<input type="button" name="BTN_G1_RESET" value="입력 초기화" onclick="G1_RESET(uuidv4());">
			</div>
		</div>
		<div style="height:38px;border-radius:3px;-moz-border-radius: 3px;" class="CONDITION_OBJECT">
			<DIV class="CON_LINE" is_br_tag>
		<!--컨디션 IO리스트-->
			</div><!-- is_br_tag end -->
		</div>
		<div style="width:0px;height:0px;overflow: hidden"></form></div>    
	</div>





    <!--type1 -->

    <div class="BI_OBJGRP" style="width:25%;">
        <div style="padding:5px 3px 3px 0px;"><!--흰색 바깥 여백-->
            <div style="border-radius:5px;padding:5px 5px 5px 5px;background-color:white;height:70px;">
                <div class="BI_ICON" style="float:left;width:30%;text-align:center;">
                        <i style="padding-left:5px;padding-top:9px;"
                        color="green" 
                        width="50"
                        height="50"
                        data-feather="eye"></i>
                </div>
                <div class="BI_VALUE"
                 style="width:70%;font-size:28pt;text-align:left;height:45px">
                        <b>412</b>
                </div>
                <div class="BI_LABEL" style="height:22px;width:70%;font-size:11pt;color:gray;">
                        desc hahha
                </div>
            </div>
        </div>
    </div>
    

    

    <!--type2-->
    <div class="BI_OBJGRP" style="width:25%;">
        <div style="padding:5px 3px 3px 3px;"><!--흰색 바깥 여백-->
            <div style="border-radius:5px;padding:5px 5px 5px 5px;background-color:white;height:70px;">
                <div class="BI_LABEL" style="height:22px;font-size:11pt;width:100%;text-align:left;color:gray;">
                    title
                </div>
                <div class="BI_VALUE" style="height:45px;border:0px dashed red;width:70%;float:left;font-size:28pt;text-align:left;">
                        <b>407</b>
                </div>            
                <div class="BI_ICON" style="border:0px dashed red;width:30%;text-align:right;">
                        <i style="padding-left:5px;padding-top:0px;"
                        color="silver" 
                        width="30"
                        height="30"
                        data-feather="eye"></i>
                </div>
            </div>
        </div>
    </div>


    <!--type3-->
    <div class="BI_OBJGRP" style="width:25%;">
        <div style="padding:5px 3px 3px 3px;"><!--흰색 바깥 여백-->
            <div style="border-radius:5px;padding:5px 5px 5px 5px;background-color:white;height:70px;">
                <div class="BI_LABEL" style="float:left;font-size:11pt;width:70%;text-align:left;color:gray;">
                    title
                </div>
                <div class="BI_ICON" style="text-align:right;width:30%;">
                        <i style="padding-right:5px;padding-top:0px;"
                        color="silver" 
                        width="22"
                        height="22"
                        data-feather="eye"></i>
                </div>
                <div class="BI_VALUE" style="float:left;width:70%;font-size:28pt;text-align:left;">
                        <b>407</b>
                </div>
                <div class="BI_VALUE2" style="width:30%;padding-top:12px;font-size:12pt;text-align:right;color:gray;">
                        <b>12%</b>
                </div>
            </div>     
        </div>
    </div>


    <!--type4-->

    <div class="BI_OBJGRP" style="width:25%;">
        <div style="padding:5px 0px 3px 3px;"><!--흰색 바깥 여백-->
            <div style="border-radius:5px;padding:5px 5px 5px 5px;background-color:white;height:70px;">

                <div class="BI_LABEL" style="font-size:11pt;width:100%;text-align:left;color:gray;">
                    title
                </div>
                <div style="float:left;width:80%">
                    <div class="BI_VALUE" style="float:left;font-size:28pt;text-align:left;">
                            <b>407</b>
                    </div>    
                    <div class="BI_VALUE2" style="color:white;border-radius:5px;float:left;font-size:12pt;text-align:left;margin-top:12pt;background-color:green;">
                            +12%
                    </div>   
                </div>
                <div class="BI_ICON" styel="text-align:right;width:20%">
                        <i style="padding-left:5px;padding-top:0px;"
                        color="silver" 
                        width="30"
                        height="30"
                        data-feather="eye"></i>
                </div>
            </div>
        </div>
    </div>





	<!--
	#####################################################
	## 그리드 - START
	#####################################################
	-->
	<div class="GRP_OBJECT" style="width:50%;height:200px;">

		<div  class="GRID_LABELGRP">
  			<div id="div_gridG2_GRID_LABEL"class="GRID_LABEL" >
	  				*       
			</div>
			<div id="div_gridG2_GRID_LABELBTN" class="GRID_LABELBTN"  style="">
				<span id="spanG2Cnt" name="그리드 ROW 갯수">N</span>
<input type="button" name="BTN_G2_USERDEF" value="사용자정의" onclick="G2_USERDEF(uuidv4());">
<input type="button" name="BTN_G2_SAVE" value="저장" onclick="G2_SAVE(uuidv4());">
<input type="button" name="BTN_G2_ROWDELETE" value="행삭제" onclick="G2_ROWDELETE(uuidv4());">
<input type="button" name="BTN_G2_ROWBULKADD" value="행대량추가" onclick="G2_ROWBULKADD(uuidv4());">
<input type="button" name="BTN_G2_ROWADD" value="행추가" onclick="G2_ROWADD(uuidv4());">
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
	## 폼뷰 - START
	#####################################################
	-->
	<div class="GRP_OBJECT" style="width:50%;height:200px;">
		<div sty_le="width:0px;height:0px;overflow: hidden">
			<form id="formviewG3" name="formviewG3" method="post" enctype="multipart/form-data"  onsubmit="return false;">
			<input type="hidden" name="G3-CTLCUD"  id="G3-CTLCUD" value="">
		</div>	
		<div class="DETAIL_LABELGRP">
			<div class="DETAIL_LABEL"  style="">
				* 
			</div>
			<div class="DETAIL_LABELBTN"  style="">
				<input type="button" name="BTN_G3_USERDEF" value="사용자정의" onclick="G3_USERDEF(uuidv4());">				<input type="button" name="BTN_G3_SAVE" value="저장" onclick="G3_SAVE(uuidv4());">				<input type="button" name="BTN_G3_NEW2" value="신규" onclick="G3_NEW2(uuidv4());">			</div>
		</div>
		<div style="height:158px;" class="DETAIL_OBJECT">
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
		<div  id="DIV-G3-FILE1">
			<a href="" target="_blank" name="G3-FILE1-LINK" id="G3-FILE1-LINK"><span id="G3-FILE1-NM" name="G3-FILE1-NM"></span></a>
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


<script>
      //feather.icons.circle.toSvg({ 'width': '100px','height': '200px' });
      //이미지
      feather.replace();

      //SVG는 불필요
      //feather.icons.circle.toSvg({ 'stroke-width': 5 });

      //alert(feather.icons.eye.toString());
    </script>
</body>
</html>
