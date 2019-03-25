<?php
header("Content-Type: text/html; charset=UTF-8");
header("Cache-Control:no-cache");
header("Pragma:no-cache");

	//로그인 검사
    require_once("./include/incUtil.php");
    require_once("./include/incUser.php");
    require_once("./incConfig.php");

    require_once("./include/incLoginCheck.php");//로그인 검사

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>PJT/PGM</title>


    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script src="./lib/dhtmlxSuite/codebase/dhtmlx.js" type="text/javascript" charset="utf-8"></script>
<script src="./lib/dhtmlxConnector/samples/dhtmlx/dhtmlxdataprocessor.js" type="text/javascript" charset="utf-8"></script>
<script src="./lib/dhtmlxConnector/codebase/connector.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="./lib/dhtmlxSuite/codebase/dhtmlx.css" type="text/css" charset="utf-8">
</head>
<body onload="initBody();">

<div style="width:654px;padding:0 0 0 0;text-align:right;">
<input type="button" name="some_name" value="Search1" onclick="search1();">
<input type="button" name="some_name" value="Save1" onclick="save1();">
<input type="button" name="some_name" value="Save2" onclick="save2();">
<input type="button" name="some_name" value="SaveAll" onclick="saveAll();">
</div>
<div style="width:641px;background-color:silver;padding:5 5 5 5;">
    <form id="condition1">
    프로젝트ID <input type="text" name="F_PJTID" value="" id="F_PJTID">
    프로젝트명  <input type="text" name="F_PJTNM" value="" id="F_PJTNM"><BR>
    날짜종류   <input type="radio" name="F_DT_TYPE" value="ADDDT" id="F_DT_TYPE" checked>생성일, <input type="radio" name="F_DT_TYPE" value="MODDT" id="F_DT_TYPE">변경일
    날짜범위   <input type="text" name="F_START_DT" value="" id="F_START_DT" style="width:80px"><img id="F_START_DT_ICON" src="./lib/dhtmlxSuite/calendar.png" border="0" align="absmiddle">
    날짜범위   <input type="text" name="F_END_DT" value="" id="F_END_DT" style="width:80px"><img id="F_END_DT_ICON" src="./lib/dhtmlxSuite/calendar.png" border="0" align="absmiddle">
    </form>
</div>

<div style="width:654px;padding:0 0 0 0;text-align:right;">
<input type="button" name="add" value="add row" onclick="addRow1();">
<input type="button" name="delete" value="delete row" onclick="mygrid.deleteSelectedRows()">
</div>

<div style="width:650px;padding:0 0 0 0;">
<div id="gridbox" width="650px" height="250px" style="background-color:white;overflow:hidden"></div>
</div>

<div style="width:654px;padding:0 0 0 0;text-align:right;">
<input type="button" name="add" value="add row" onclick="addRow2();">
<input type="button" name="delete" value="delete row" onclick="mygrid2.deleteSelectedRows()">
</div>

<div style="width:650px;padding:0 0 0 0;">
<div id="gridboxPgminfo" width="650px" height="250px" style="background-color:white;overflow:hidden"></div>
</div>
<style>
    #F_START_DT,
    #F_END_DT {
        border: 1px solid #909090;
        font-family: Tahoma;
        font-size: 12px;
    }
</style>
<script>
    var myCalendar;
    function initBody() {
        //날짜 박스 초기
        myCalendar = new dhtmlXCalendarObject([{input:"F_START_DT",
            button:"F_START_DT_ICON"},{input:"F_END_DT",
            button:"F_END_DT_ICON"}]);
    }

    function search1(){
        //폼의 모든값 구하기
        var condtion1_str = $( "#condition1" ).serialize();
        console.log("condtion1_str:" + condtion1_str);

        mygrid1.clearAll();
        mygrid1.loadXML("cg_pjtinfo_crud.php?" + condtion1_str);

    }
    //mygrid.filterBy(0,function(a){ return (a<500);});

    function addRow1(){
        var id=mygrid1.uid();
        mygrid1.addRow(id,'',0);
        mygrid1.showRow(id);
        mygrid1.selectRow(0);
    }
    function addRow2(){
        var id2=mygrid2.uid();
        mygrid2.addRow(id2,'',0);
        mygrid2.showRow(id2);
        mygrid2.selectRow(0);
    }
    function saveAll(){
        save1();
        save2();
    }
    function save1(){
        dp1.sendData();
    }
    function save2(){
        dp2.sendData();
    }

    var mygrid1,dp1;
    mygrid1 = new dhtmlXGridObject('gridbox');
	mygrid1.setImagePath("../dhtmlx/imgs/");
	mygrid1.setHeader("프로젝트ID, 프로젝트명, 생성일, 변경일");
	//mygrid1.attachHeader("#connector_text_filter,#connector_text_filter,#connector_text_filter,#connector_text_filter")
	mygrid1.setInitWidths("100,*,100,100")
	mygrid1.setColTypes("edtxt,ed,ro,ro");
	mygrid1.setColSorting("connector,connector,connector,connector")
	mygrid1.enableSmartRendering(true)
	mygrid1.enableMultiselect(true)
	mygrid1.init();
	mygrid1.loadXML("cg_pjtinfo_crud.php");
	dp1 = new dataProcessor("cg_pjtinfo_crud.php");
    dp1.setTransactionMode("POST",true); //set mode as send-all-by-post
    dp1.setUpdateMode("off"); //disable auto-update
	dp1.init(mygrid1);

    mygrid1.attachEvent("onRowSelect",function(rowID,celInd){
        //alert("The id of the selected row is "+rowID);
        //mygrid2.filterBy("PJTID",rowID);

        mygrid2.clearAll();
        mygrid2.loadXML("cg_pjtinfo_crud2.php?PJTID=" + rowID);

        dp2 = new dataProcessor("cg_pjtinfo_crud2.php?PJTID=" + rowID);
        dp2.setTransactionMode("POST",true); //set mode as send-all-by-post
        dp2.setUpdateMode("off"); //disable auto-update
        dp2.init(mygrid2);
    });


    var mygrid2,dp2;
    mygrid2 = new dhtmlXGridObject('gridboxPgminfo');
    mygrid2.setImagePath("../dhtmlx/imgs/");
    mygrid2.setHeader("프로그램ID, 프로그램명, 생성일, 변경일");
    //mygrid2.attachHeader("#connector_text_filter,#connector_text_filter,#connector_text_filter,#connector_text_filter")
    mygrid2.setInitWidths("100,*,100,100")
    mygrid2.setColTypes("edtxt,ed,ro,ro");
    mygrid2.setColAlign("right,left,left,right")
    mygrid2.setColSorting("connector,connector,connector,connector")
    //mygrid2.isColumnHidden(0);//PJTID숨기기

    mygrid2.enableSmartRendering(true)
    mygrid2.enableMultiselect(true)
    mygrid2.init();
	//mygrid2.splitAt(0);
    //mygrid2.setColumnHidden(0,true); //PJTID
    //mygrid2.setColumnHidden(1,true); //PGMID

    //mygrid2.loadXML("cg_pjtinfo_crud2.php");


</script>



</body>
</html>
