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
	<title>CODE</title>
    <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<style>
    body {margin:0;padding:0}
    div,input {font-size: 11px;}

    #F_START_DT, #F_END_DT {
        border: 1px solid #909090;
    }


    .BODY_BOX {100%;background-color:yellowgreen;padding:5px 5px 5px 5px;}

    .CON_LINE {position: relative;width:100%;height:22px;line-height;122px;overflow:visible;}
    .CON_OBJGRP {position: relative;float:left;background-color: #eeeeee;height:22px;line-height:22px;vertical-align:middle ;overflow:visible;}
    .CON_LABEL {position: relative;float:left;background-color: #eeeeee;height:22px;line-height:22px;vertical-align:middle ;padding-left:5px;}
    .CON_OBJECT {position: relative;float:left;background-color: #eeeeee;height:22px;line-height:22px;vertical-align:middle ;}
    .CON_LINEBREAK {position: relative;height:5px;overflow:auto;}

    .GRID_LABELGRP {position:relative;width:100%;height:22px;z-index:20;}
    .GRID_LABEL {position:relative;float:left;width:60%;height:22px;line-height:22px;vertical-align:middle;z-index:30;}
    .GRID_LABELBTN {position: relative;float:left;width:40%;height:22px;line-height:22px;vertical-align:middle;text-align:right;z-index:30;}
    .GRID_OBJECT {position: relative;width:100%;padding:0 0 0 0;z-index:20;}

    .GRP_LINE {position: relative;width:100%;z-index:10;overflow:auto;}
    .GRP_OBJECT {position: relative;float:left;z-index:20;}
</style>

	<!--jquery / json-->
	<script src="./lib/jquery-1.11.1.min.js"></script>
	<script src="./lib/json2.min.js"></script>

	<!--dhmltx-->
    <script src="./lib/dhtmlxSuite/codebase/dhtmlx.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="./lib/dhtmlxSuite/codebase/dhtmlx.css" type="text/css" charset="utf-8">


    <!--공통-->
    <script src="./rst/common.js" type="text/javascript" charset="utf-8"></script>

    <!--codemirror-->
    <link rel=stylesheet href="./lib/codemirror/doc/docs.css">
    <link rel=stylesheet href="./lib/codemirror/lib/codemirror.css">

    <script src="./lib/codemirror/lib/codemirror.js"></script>
    <script src="./lib/codemirror/mode/sql/sql.js"></script>
    <script src="./lib/codemirror/addon/selection/active-line.js"></script>
    <style>
        .CodeMirror {
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            width:100%;height:172px;
        }
        .cm-tab {
            background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAMCAYAAAAkuj5RAAAAAXNSR0IArs4c6QAAAGFJREFUSMft1LsRQFAQheHPowAKoACx3IgEKtaEHujDjORSgWTH/ZOdnZOcM/sgk/kFFWY0qV8foQwS4MKBCS3qR6ixBJvElOobYAtivseIE120FaowJPN75GMu8j/LfMwNjh4HUpwg4LUAAAAASUVORK5CYII=);
            background-position: right;
            background-repeat: no-repeat;
        }
    </style>







    <script>



    function search1(){
        //폼값 밸리데이션
        if( !jsonFormValid(obj_condition_valid.F_PJTID, "F_PJTID", "프로젝트ID", $("#F_PJTID").val()) ){return false;};
        if( !jsonFormValid(obj_condition_valid.F_PGMID, "F_PGMID", "프로그램ID", $("#F_PGMID").val()) ){return false;};


        //폼의 모든값 구하기

        var ConAllData = $( "#condition1" ).serialize();
        console.log("ConAllData:" + ConAllData);
        lastCondition = ConAllData;

            //그리드 조회
        gridSearch1(lastCondition);

    }



    //그리드 조회
    function gridSearch1(tinput){
        console.log("gridSearch1()------------start");

        //그리드 초기화
        mygrid1.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : mygrid1_url+"&G1_CRUD_MODE=read&" + tinput ,
            data : {xmldata : ""},
            dataType: "json",
            async: true,
            success: function(data){
                console.log("   gridSearch1 json return----------------------");
                console.log("   json data : " + data);
                console.log("   json RTN_CD : " + data.RTN_CD);
                console.log("   json ERR_CD : " + data.ERR_CD);
                //console.log("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
                    console.log(JSON.stringify(data.RTN_DATA));

                    mygrid1.parse(data.RTN_DATA,"json");

                }else{
                    alert("서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG);
                }


            },
            error: function(error){
                console.log("Error:");
                console.log(error);
            }
        });

        console.log("gridSearch1()------------end");
    }

    //그리드 조회
    function gridSearch2(tinput){
        console.log("gridSearch2()------------start");

        //console.log("   tinput size : ". tinput.size());
        //console.log("   tinput geturi : ". tinput.getUri());
        //return;

        //그리드 초기화
        mygrid2.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : mygrid2_url+"&G2_CRUD_MODE=read&" + tinput + "&" + lastCondition,
            data : {xmldata : ""},
            dataType: "json",
            async: false,
            success: function(data){
                console.log("   gridSearch2 json return----------------------");
                console.log("   json data : " + data);
                console.log("   json RTN_CD : " + data.RTN_CD);
                console.log("   json ERR_CD : " + data.ERR_CD);
                //console.log("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
                    console.log(JSON.stringify(data.RTN_DATA));

                    mygrid2.parse(data.RTN_DATA,"json");

                }else{
                    alert("서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG);
                }


            },
            error: function(error){
                console.log("Error:");
                console.log(error);
            }
        });

        console.log("gridSearch2()------------end");
    }


    //mygrid.filterBy(0,function(a){ return (a<500);});

    function addRow1(){
        console.log("addRow1()------------start");
        var id=mygrid1.uid();
        mygrid1.addRow(id,'',0);
        mygrid1.showRow(id);
        mygrid1.selectRow(0);
        mygrid1.cells(id,0).cell.wasChanged = true;
        mygrid1.setUserData(id,"!nativeeditor_status","inserted");
        mygrid1.setRowTextBold(id);
        addstatusyn1 = true;
        console.log("addRow1()------------end");
    }
    function addRow2(){
        console.log("addRow2()------------start");
        var id=mygrid2.uid();
        mygrid2.addRow(id,[lastinput2json.PJTID,lastinput2json.LAYOUTID,"","","",""],0);
        mygrid2.showRow(id);
        mygrid2.selectRow(0);
        mygrid2.cells(id,0).cell.wasChanged = true;
        mygrid2.setUserData(id,"!nativeeditor_status","inserted");
        mygrid2.setRowTextBold(id);
        addstatusyn2 = true;
        console.log("addRow2()------------end");
    }



    function delRow1(){
        console.log("delRow1()------------start");

        rid = mygrid1.getSelectedRowId();
        mygrid1.setUserData(rid,"!nativeeditor_status","deleted");
        mygrid1.setRowTextBold(rid);
        mygrid1.cells(rid,0).cell.wasChanged=true;

        console.log("delRow4()------------end");
    }
    function delRow2(){
        console.log("delRow2()------------start");

        rid = mygrid2.getSelectedRowId();
        mygrid2.setUserData(rid,"!nativeeditor_status","deleted");
        mygrid2.setRowTextBold(rid);
        mygrid2.cells(rid,0).cell.wasChanged=true;

        console.log("delRow4()------------end");
    }


    function saveAll(){
        console.log("saveAll()------------start");
        save1();
        save2();
        addstatusyn1 = false;
        addstatusyn2 = false;
        console.log("saveAll()------------end");
    }
    function save1(){
        console.log("save1()------------start");
        //serialize user data or not,
        //serialize 'selected' attribute for the rows tags,
        //serialize grid structure info,
        //serialize the 'changed' attribute for the cells tags,
        //include just changed rows to serialization,
        //serialize cell values as CDATA sections

        mygrid1.setSerializationLevel(true,false,false,false,true,false);
        //mygrid4.serialize();
        var myXmlString = mygrid1.serialize();

        mygrid1.setSerializationLevel(true,false,false,false,false,false);
        //mygrid4.serialize();
        var myXmlString2 = mygrid1.serialize();

        //console.log("xml : " + myXmlString);

        //컨디션 데이터 모두 말기
        var ConAllData = $( "#condition1" ).serialize();
        console.log("   ConAllData = " + ConAllData);

        var xml = myXmlString;
        xml = xml.replace(new RegExp("<row","g"),"\n<row");
        xml = xml.replace(new RegExp("</row","g"),"\n</row");
        xml = xml.replace(new RegExp("<cell","g"),"\n\t<cell");

        var xml2 = myXmlString2;
        xml2 = xml2.replace(new RegExp("<row","g"),"\n<row");
        xml2 = xml2.replace(new RegExp("</row","g"),"\n</row");
        xml2 = xml2.replace(new RegExp("<cell","g"),"\n\t<cell");

        $("#tt").val(xml);
        $("#tt2").val(xml2);

        $.ajax({
            type : "POST",
            url : mygrid1_url+"&G1_CRUD_MODE=SAVE&" + lastinput2 ,
            data : {xmldata : myXmlString},
            dataType: "json",
            async: false,
            success: function(data){
                console.log("   json return----------------------");
                console.log("   json data : " + data);
                console.log("   json RTN_CD : " + data.RTN_CD);
                console.log("   json ERR_CD : " + data.ERR_CD);
                //console.log("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                saveToGrid(mygrid1,data);

            },
            error: function(error){
                console.log("Error:");
                console.log(error);
            }
        });

        addstatusyn2 = false;
        console.log("save1()------------end");
    }


    function save2(){
        console.log("save2()------------start");
        //serialize user data or not,
        //serialize 'selected' attribute for the rows tags,
        //serialize grid structure info,
        //serialize the 'changed' attribute for the cells tags,
        //include just changed rows to serialization,
        //serialize cell values as CDATA sections

        mygrid2.setSerializationLevel(true,false,false,false,true,false);
        //mygrid4.serialize();
        var myXmlString = mygrid2.serialize();

        mygrid2.setSerializationLevel(true,false,false,false,false,false);
        //mygrid4.serialize();
        var myXmlString2 = mygrid2.serialize();

        //console.log("xml : " + myXmlString);

        //컨디션 데이터 모두 말기
        var ConAllData = $( "#condition1" ).serialize();
        console.log("   ConAllData = " + ConAllData);

        var xml = myXmlString;
        xml = xml.replace(new RegExp("<row","g"),"\n<row");
        xml = xml.replace(new RegExp("</row","g"),"\n</row");
        xml = xml.replace(new RegExp("<cell","g"),"\n\t<cell");

        var xml2 = myXmlString2;
        xml2 = xml2.replace(new RegExp("<row","g"),"\n<row");
        xml2 = xml2.replace(new RegExp("</row","g"),"\n</row");
        xml2 = xml2.replace(new RegExp("<cell","g"),"\n\t<cell");

        $("#tt").val(xml);
        $("#tt2").val(xml2);

        $.ajax({
            type : "POST",
            url : mygrid2_url+"&G2_CRUD_MODE=SAVE&" + lastinput2 ,
            data : {xmldata : myXmlString},
            dataType: "json",
            async: false,
            success: function(data){
                console.log("   json return----------------------");
                console.log("   json data : " + data);
                console.log("   json RTN_CD : " + data.RTN_CD);
                console.log("   json ERR_CD : " + data.ERR_CD);
                //console.log("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                saveToGrid(mygrid2,data);

            },
            error: function(error){
                console.log("Error:");
                console.log(error);
            }
        });

        addstatusyn2 = false;
        console.log("save2()------------end");
    }



    function loadxml(){
        //serialize user data or not,
        //serialize 'selected' attribute for the rows tags,
        //serialize grid structure info,
        //serialize the 'changed' attribute for the cells tags,
        //include just changed rows to serialization,
        //serialize cell values as CDATA sections

        tgrid = mygrid4;

        tgrid.setSerializationLevel(true,false,false,true,false,false);

        //mygrid4.serialize();
        var myXmlString = tgrid.serialize();

        var xml = myXmlString;
        xml = xml.replace(new RegExp("<row","g"),"\n<row");
        xml = xml.replace(new RegExp("</row","g"),"\n</row");
        xml = xml.replace(new RegExp("<cell","g"),"\n\t<cell");

        $("#tt").val(xml);


        tgrid.setSerializationLevel(true,false,false,true,true,false);

        //mygrid4.serialize();
        var myXmlString = tgrid.serialize();

        var xml = myXmlString;
        xml = xml.replace(new RegExp("<row","g"),"\n<row");
        xml = xml.replace(new RegExp("</row","g"),"\n</row");
        xml = xml.replace(new RegExp("<cell","g"),"\n\t<cell");

        $("#tt2").val(xml);
    }




    //정적 변수 선언
    var myCalendar;
    var lastCondition;
    var mygrid1,dp1,addstatusyn1,lastinput1,lastinput1map,lastrowid1;
    var mygrid2,dp2,addstatusyn2,lastinput2,lastinput2map,lastrowid2;
    var mygrid1_url = "cg_layout_crud.php?F_GRPID=1&";
    var mygrid2_url = "cg_layout_crud.php?F_GRPID=2&";
    var validmsg = jQuery.parseJSON('{"REQUARED":"[0]는 반드시 입력바랍니다.", "MIN":"this는 [0]이상 입력바랍니다."}');

    //동적 변수 선언
    var obj_condition_valid = jQuery.parseJSON( '{"__NAME":"obj_condition_valid"' +
        ' ,"F_PJTID": {"REQUARED":"Y",  "MIN":"0",  "MAX":"ZZZ",  "DATASIZE":10,  "DATATYPE":"STRING"} ' +
        ' ,"F_PGMID": {"REQUARED":"Y",  "MIN":"0",  "MAX":"ZZZ",  "DATASIZE":10,  "DATATYPE":"STRING"} ' +
        '}');
    var obj_G4_valid = jQuery.parseJSON( '{"__NAME":"obj_G4_valid"' +
        ' ,"OBJTYPE": {"REQUARED":"Y",  "MIN":"0",  "MAX":"ZZZ",  "DATASIZE":10,  "DATATYPE":"STRING"} ' +
        ' ,"F_PGMID": {"REQUARED":"Y",  "MIN":"0",  "MAX":"ZZZ",  "DATASIZE":10,  "DATATYPE":"STRING"} ' +
        '}');


    //화면 초기화
    function initBody(){
        //컨디션 초기화
        $("#F_PJTID").val("CG");
        $("#F_PGMID").val("TEST2");

        //날짜 박스 초기
        console.log("initBody()---------start")
        myCalendar = new dhtmlXCalendarObject([{input:"F_START_DT",
            button:"F_START_DT_ICON"},{input:"F_END_DT",
            button:"F_END_DT_ICON"}]);
        console.log("initBody()---------end")


        //그리드 초기화
        mygrid1 = new dhtmlXGridObject('grid1');
        mygrid1.setImagePath("../dhtmlx/imgs/");
        mygrid1.setHeader("PJTSEQ,LAYOUTID,GRPCNT,ADDDT,MODDT");
        mygrid1.setColumnIds("PJTSEQ,LAYOUTID,GRPCNT,ADDDT,MODDT");
        //mygrid1.attachHeader("#connector_text_filter,#connector_text_filter,#connector_text_filter,#connector_text_filter")
        mygrid1.setInitWidths("80,80,80,80,80")
        mygrid1.setColTypes("ed,ed,ed,ro,ro");
        //mygrid1.setColSorting("connector,connector,connector,connector,cconnector");
        mygrid1.enableSmartRendering(false);
        mygrid1.enableMultiselect(false);
        mygrid1.init();
        //mygrid1.splitAt(3);//'freezes' 0 columns // ROW선택 이벤트

        //mygrid1.loadXML("cg_code_crud.php?GRPID=CODE");



        mygrid1.attachEvent("onRowSelect",function(rowID,celInd){
            console.log("mygrid1 - onRowSelect ----------start");
            console.log("   rowID = " + rowID);
            console.log("   celInd = " + celInd);


            lastrowid1 = rowID;

            //선택된 ROW의 모든컬럼 추출하기
            var RowAllData;
            RowAllData = getRowsColid(mygrid1,rowID,"G1");

            //KEY컬럼만 자식에게 전달
            lastinput2json = jQuery.parseJSON('{ "__NAME":"lastinput2json"' +
                ', "PJTSEQ" : "' + q(mygrid1.cells(lastrowid1,0).getValue()) + '"' +
                ', "LAYOUTID" : "' + q(mygrid1.cells(lastrowid1,1).getValue()) + '"' +
                '}');

            console.log("   RowAllData = " + RowAllData);

            //마지막 선송 정보 저장
            lastinput2 = RowAllData;

            //그리드 2번 조회
            //console.log(" lastinput2 size2 : ". lastinput2map.size());
            gridSearch2(lastinput2);


            console.log("mygrid1 - onRowSelect ----------end");
        });
        mygrid1.attachEvent("onBeforeSorting", function(ind,type,direction){
            //any custom logic here
            return !addstatusyn1;
        });


        mygrid1.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            console.log("mygrid1  onEditCell ------------------start");
            console.log("       stage : " + stage);
            console.log("       rId : " + rId);
            console.log("       cInd : " + cInd);
            console.log("       nValue : " + nValue);
            console.log("       oValue : " + oValue);

            RowEditStatus = mygrid1.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygrid1.setUserData(rId,"!nativeeditor_status","updated");
                    mygrid1.setRowTextBold(rId);
                }
                mygrid1.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

        });

        //2번째 그리드 초기화
        mygrid2 = new dhtmlXGridObject('grid2');
        mygrid2.setImagePath("../dhtmlx/imgs/");
        mygrid2.setHeader("LAYOUTDSEQ,PJTSEQ,LAYOUTID,GRPID,REFGRPID,ORD,GRPTYPE,GRPWIDTH,GRPHEIGHT,VBOXNO,ADDDT,MODDT");
        mygrid2.setColumnIds("LAYOUTDSEQ,PJTSEQ,LAYOUTID,GRPID,REFGRPID,ORD,GRPTYPE,GRPWIDTH,GRPHEIGHT,VBOXNO,ADDDT,MODDT");
        //mygrid2.attachHeader("#connector_text_filter,#connector_text_filter,#connector_text_filter,#connector_text_filter")
        mygrid2.setInitWidths("80,80,80,80,80,80,80,80,80,80,80,80")
        mygrid2.setColTypes("ed,ed,ed,ed,ed,ed,coro,ed,ed,ed,ro,ro");
        mygrid2.setColAlign("left,left,left,left,left,left,left,left,left,left,left,left")
        //mygrid2.setColumnHidden(0,true);
        //mygrid2.isColumnHidden(0);//PJTID숨기기

        mygrid2.enableSmartRendering(false);
        mygrid2.enableMultiselect(false);

		//GRPTYPE 콤보
		setCodeCombo("GRID",mygrid2.getCombo(mygrid2.getColIndexById("GRPTYPE")),"GRPTYPE");


        mygrid2.init();
        mygrid2.attachEvent("onRowSelect",function(rowID,celInd){
            console.log("mygrid2 - onRowSelect ----------start");
            console.log("   rowID = " + rowID);
            console.log("   celInd = " + celInd);

            console.log("mygrid1 - onRowSelect ----------end");
        });

        mygrid2.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            console.log("mygrid2  onEditCell ------------------start");
            console.log("       stage : " + stage);
            console.log("       rId : " + rId);
            console.log("       cInd : " + cInd);
            console.log("       nValue : " + nValue);
            console.log("       oValue : " + oValue);

            RowEditStatus = mygrid2.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygrid2.setUserData(rId,"!nativeeditor_status","updated");
                    mygrid2.setRowTextBold(rId);
                }
                mygrid2.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

        });

        //mygrid2.loadXML("cg_pjtinfo_crud2.php");


    }//initBody();



    </script>


</head>
<body onload="initBody();">

<div id="BODY_BOX" class="BODY_BOX">
    <div  class="GRID_LABELGRP" >
		<div class="GRID_LABEL" >* LAYOUT 
			<!--popup--><a href="?" target="_blank"><img src="./img/popup.png" height=10 align=absmiddle border=0></a>
			<!--reload--><a href="javascript:location.reload();"><img src="./img/reload.png" width=11 height=10 align=absmiddle border=0></a>		
		</div>
		<div  class="GRID_LABELBTN"  >
            <input type="button" name="some_name" value="Search1" onclick="search1();">
            <input type="button" name="some_name" value="LoadXml" onclick="loadxml();">
            <input type="button" name="some_name" value="SaveAll" onclick="saveAll();">
		</div>
	</div>

    <div style="position: relative;width:100%;background-color:yellow;padding:0 0 0 0;overflow:auto;border-radius:3px;-moz-border-radius: 3px;">
        <div style="position: relative;background-color:#eeeeee;padding:5px 5px 5px 5px;overflow:auto;">
            <div style="width:0px;height:0px;overflow: hidden"><form id="condition1"></div>

            <div class="CON_LINE" style="">
                <div class="CON_OBJGRP" style="">
                    <div class="CON_LABEL" style="width:100px;">PJTID *</div>
                    <div class="CON_OBJECT" style="width:150px;"><input type="text" name="F_PJTID" value="" id="F_PJTID"></div>
                </div>
                <div class="CON_OBJGRP" style="">
                    <div class="CON_LABEL" style="width:100px;">PGMID</div>
                    <div class="CON_OBJECT" style="width:150px;"><input type="text" name="F_PGMID" value="" id="F_PGMID"></div>
                </div>
                <div class="CON_OBJGRP" style="">
                    <div class="CON_LABEL" style="width:100px;">PGMNM</div>
                    <div class="CON_OBJECT" style="width:150px;"><input type="text" name="F_PGMNM" value="" id="F_PGMNM"></div>
                </div>
            </div>

            <div class="CON_LINEBREAK" style=""></div>

            <div class="CON_LINE" style="">
                <div class="CON_OBJGRP" style="">
                    <div class="CON_LABEL" style="width:100px;">날짜종류</div>
                    <div class="CON_OBJECT" style="width:200px;"><input type="radio" name="F_DT_TYPE" value="ADDDT" id="F_DT_TYPE" checked>생성일, <input type="radio" name="F_DT_TYPE" value="MODDT" id="F_DT_TYPE">변경일</div>
                </div>
                <div class="CON_OBJGRP" style="">
                    <div class="CON_LABEL" style="width:100px;">날짜범위</div>
                    <div class="CON_OBJECT" style="width:200px;">
                        <input type="text" name="F_START_DT" value="" id="F_START_DT" style="width:80px"><img id="F_START_DT_ICON" src="./lib/dhtmlxSuite/calendar.png" border="0" align="absmiddle">
                        <input type="text" name="F_END_DT" value="" id="F_END_DT" style="width:80px"><img id="F_END_DT_ICON" src="./lib/dhtmlxSuite/calendar.png" border="0" align="absmiddle">
                    </div>
                </div>
            </div>


        </div>
    </div>


    <div class="GRP_LINE" >
        <div class="GRP_OBJECT" style="width:100%;">

            <div style="position: relative;width:100%;padding:0 0 0 0;text-align:right;z-index:30;">
                <input type="button" name="add" value="add row" onclick="addRow1();">
                <input type="button" name="delete" value="delete row" onclick="delRow1();">
				<input type="button" name="some_name" value="Save1" onclick="save1();">
            </div>

            <div style="position: relative;width:100%;padding:0 0 0 0;z-index:20;">
                <div id="grid1" width="100%" height="200px" style="background-color:white;z-index:30;"></div>
            </div>
        </div>
    </div>


    <div class="GRP_LINE" >
        <div class="GRP_OBJECT" style="width:100%;">
            <div style="position: relative;width:100%;padding:0 0 0 0;text-align:right;z-index:30;">
                <input type="button" name="add" value="add row" onclick="addRow2();">
                <input type="button" name="delete" value="delete row" onclick="delRow2();">
			    <input type="button" name="some_name" value="Save2" onclick="save2();">
            </div>

            <div style="position: relative;width:100%;padding:0 0 0 0;z-index:30;">
                <div id="grid2" width="100%" height="250px" style="background-color:white;z-index:40;"></div>
            </div>
        </div>

    </div>


</div>


<div style="width:0px;height:0px;overflow: hidden"></form></div>


<textarea style="width:100%;height:300px;font-size:9pt;" id="tt"></textarea>
<textarea style="width:100%;height:300px;font-size:9pt;" id="tt2"></textarea>
</body>
</html>
