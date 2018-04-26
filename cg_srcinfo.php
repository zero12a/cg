<?
header("Content-Type: text/html; charset=UTF-8");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>CODE</title>
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

</style>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script src="./lib/dhtmlxSuite/codebase/dhtmlx.js" type="text/javascript" charset="utf-8"></script>
<script src="./lib/dhtmlxConnector/samples/dhtmlx/dhtmlxdataprocessor.js" type="text/javascript" charset="utf-8"></script>
<script src="./lib/dhtmlxConnector/codebase/connector.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="./lib/dhtmlxSuite/codebase/dhtmlx.css" type="text/css" charset="utf-8">



    <script>
    function myErrorHandler(type, desc, erData){
        console.log("----------myErrorHandler------------start");
        console.log("   type : " + type);
        console.log("   desc : " + desc);
        console.log("   status : " + erData[0].status);
        console.log("   responseText : " + erData[0].responseText);
        console.log("----------myErrorHandler------------end");
        return false;
    }
    dhtmlxError.catchError("LoadXML", myErrorHandler);
    dhtmlxError.catchError("DataStructure",myErrorHandler);




    function jsonFormValid(jsonobj, inputid, inputnm, inputval){
        console.log("jsonFormValid()------------start");
        console.log("   jsonobj.REQUARED : " + jsonobj.REQUARED);
        console.log("   jsonobj.MIN : " + jsonobj.MIN);
        console.log("   jsonobj.MAX : " + jsonobj.MAX);
        console.log("   jsonobj.DATASIZE : " + jsonobj.DATASIZE);
        console.log("   jsonobj.DATATYPE : " + jsonobj.DATATYPE);
        console.log("   inputid : " + inputid);
        console.log("   inputnm : " + inputnm);
        console.log("   inputval : " + inputval);


        if(jsonobj.REQUARED == "Y" && inputval == ""){   alert(getMsg(validmsg.REQUARED,new Array(inputid, inputnm)) );return false;   }

        return true;
        console.log("jsonFormValid()------------end");
    }

    function getMsg(msg,tarray){
        var RtnVal;
        RtnVal = msg;
        if(isArray(tarray)){
            for(i=0;i<tarray.length;i++){
                RtnVal += tarray[i];
            }
        }
        return RtnVal;
    }
    function isArray(myArray) {
        return Object.prototype.toString.call(myArray) === "[object Array]";
    }

    function search1(){
        //폼값 밸리데이션
        if( !jsonFormValid(obj_condition_valid.F_PJTID, "F_PJTID", "프로젝트ID", $("#F_PJTID").val()) ){return false;};
        //if( !jsonFormValid(obj_condition_valid.F_PGMID, "F_PGMID", "프로그램ID", $("#F_PGMID").val()) ){return false;};


        //폼의 모든값 구하기
        var ConAllData = $( "#condition1" ).serialize();
        console.log("ConAllData:" + ConAllData);

        mygrid1.clearAll();

        //데이터 불러오기
        mygrid1.loadXML(mygrid1_url + ConAllData, function(){
            console.log("GRID 'CODE' is loadXML------------start");
            var rowsnum = mygrid1.getRowsNum();
            if(rowsnum > 0)mygrid1.selectRow(0);
            console.log("   mygrid1.getRowsNum:" + rowsnum);
            console.log("GRID 'CODE' is loadXML------------end");
        });

        //데이터 프로세서 정의
        dp1 = new dataProcessor(mygrid1_url + ConAllData);
        dp1.setTransactionMode("POST",true); //set mode as send-all-by-post
        dp1.setUpdateMode("off"); //disable auto-update
        dp1.init(mygrid1);

    }


    //mygrid.filterBy(0,function(a){ return (a<500);});

    function addRow1(){
        console.log("addRow1()------------start");
        var id=mygrid1.uid();
        mygrid1.addRow(id,'',0);
        mygrid1.showRow(id);
        mygrid1.selectRow(0);
        addstatusyn1 = true;
        console.log("addRow1()------------end");
    }
    function addRow2(){
        console.log("addRow2()------------start");
        var id=mygrid2.uid();
        mygrid2.addRow(id,'',0);
        mygrid2.showRow(id);
        mygrid2.selectRow(0);
        addstatusyn2 = true;
        console.log("addRow2()------------end");
    }
    function addRow3(){
        console.log("addRow3()------------start");
        var id=mygrid3.uid();
        mygrid3.addRow(id,'',0);
        mygrid3.showRow(id);
        mygrid3.selectRow(0);
        addstatusyn3 = true;
        console.log("addRow3()------------end");
    }




    function delRow1(){
        console.log("delRow1()------------start");
        mygrid1.deleteSelectedRows()
        console.log("delRow1()------------start");
    }
    function delRow2(){
        console.log("delRow2()------------start");
        mygrid2.deleteSelectedRows()
        console.log("delRow2()------------end");
    }
    function delRow3(){
        console.log("delRow3()------------start");
        mygrid3.deleteSelectedRows()
        console.log("delRow3()------------end");
    }


    function saveAll(){
        console.log("saveAll()------------start");
        save1();
        save2();
        save3();
        addstatusyn1 = false;
        addstatusyn2 = false;
        addstatusyn3 = false;
        console.log("saveAll()------------end");
    }
    function save1(){
        console.log("save1()------------start");
        dp1.sendData();
        addstatusyn1 = false;
        console.log("save1()------------end");
    }
    function save2(){
        console.log("save2()------------start");
        dp2.sendData();
        addstatusyn2 = false;
        console.log("save2()------------end");
    }
    function save3(){
        console.log("save3()------------start");
        dp3.sendData();
        addstatusyn3 = false;
        console.log("save3()------------end");
    }


    //정적-특정row의 모든 컬럼 값 가져오기
    function getRowsArray(tgrid,trowid){
        console.log("getRowsArray()------------start");

        var RtnVal="";
        var colNum=tgrid.getColumnsNum();
        for(i=0;i<colNum;i++){
            RtnVal += "&c" + i + "=" + mygrid1.cells(trowid,i).getValue();
        }
        console.log("getRowsArray()------------end");
        return RtnVal;
    }
    //정적-특정row의 모든 컬럼 값 가져오기
    function getRowsColid(tgrid,head,trowid){
        console.log("getRowsColid()------------start");

        var RtnVal="";
        var colNum=tgrid.getColumnsNum();
        for(i=0;i<colNum;i++){
            console.log("   " + i + " = " + tgrid.getColumnId(i));
            RtnVal += "&" + head + "_" + tgrid.getColumnId(i) + "=" + tgrid.cells(trowid,i).getValue();
        }
        console.log("getRowsColid()------------end");
        return RtnVal;
    }


    //정적 변수 선언
    var myCalendar;
    var mygrid1,dp1,addstatusyn1;
    var mygrid2,dp2,addstatusyn2;
    var mygrid3,dp3,addstatusyn3;
    var mygrid1_url = "cg_srcinfo_crud.php?F_GRPID=1&";
    var mygrid2_url = "cg_srcinfo_crud.php?F_GRPID=2&";
    var mygrid3_url = "cg_srcinfo_crud.php?F_GRPID=3&";
    var validmsg = jQuery.parseJSON('{"REQUARED":"[0]는 반드시 입력바랍니다.", "MIN":"this는 [0]이상 입력바랍니다."}');

    //동적 변수 선언
    var obj_condition_valid = jQuery.parseJSON( '{"000":"000"' +
        ' ,"F_PJTID": {"REQUARED":"Y",  "MIN":"0",  "MAX":"ZZZ",  "DATASIZE":10,  "DATATYPE":"STRING"} ' +
        '}');



    //화면 초기화
    function initBody(){
        //컨디션 초기화
        $("#F_PJTID").val("CG");

        //날짜 박스 초기
        console.log("initBody()---------start")
        myCalendar = new dhtmlXCalendarObject([
            {input:null,button:null}
            ,{input:"F_START_DT",            button:"F_START_DT_ICON"}
            ,{input:"F_END_DT",            button:"F_END_DT_ICON"}
        ]);
        console.log("initBody()---------end")


        //그리드 초기화
        mygrid1 = new dhtmlXGridObject('grid1');
        mygrid1.setImagePath("../dhtmlx/imgs/");
        mygrid1.setHeader("SEQ,FILE,ORD,설명,SRC,INPUT,PARAM,타입,ADDDT,MODDT");
        mygrid1.setColumnIds("SRCSEQ,FILETYPE,SRCORD,SRCDESC,SRCTXT,INPUT,PARAM,SRCTYPE,ADDDT,MODDT");
        //mygrid1._CSVRowDelimiter = '|||';

        //mygrid1.attachHeader("#connector_text_filter,#connector_text_filter,#connector_text_filter,#connector_text_filter")
        mygrid1.setInitWidths("35,40,35,60,350,50,50,40,60,60");
        mygrid1.setColTypes("ed,coro,ed,ed,txttxt,ed,ed,ed,ro,ro");
        mygrid1.setColSorting("connector,connector,connector,connector,connector,connector,connector,connector,connector,connector");
        mygrid1.enableSmartRendering(false);
        mygrid1.enableMultiselect(true);
        mygrid1.init();
        mygrid1.splitAt(4);
        //mygrid1.loadXML("cg_code_crud.php?GRPID=CODE");



        mygrid1.attachEvent("onRowSelect",function(rowID,celInd){
            console.log("mygrid1 - onRowSelect ----------start");
            console.log("   rowID = " + rowID);
            console.log("   celInd = " + celInd);


            //선택된 ROW의 모든컬럼 추출하기
            var RowAllData;
            RowAllData = getRowsColid(mygrid1,"G1",rowID);
            console.log("   RowAllData = " + RowAllData);

            var ConAllData = $( "#condition1" ).serialize();
            console.log("   ConAllData = " + ConAllData);

            //그리드 2번 조회
            mygrid2.clearAll();
            mygrid2.loadXML(mygrid2_url + ConAllData + RowAllData,function(){
                console.log("grid2 is loadXML------------start");
                var rowsnum = mygrid2.getRowsNum();
                //if(rowsnum > 0)mygrid2.selectRow(0);
                console.log("   mygrid2.getRowsNum:" + rowsnum);
                console.log("grid2 is loadXML------------end");
            });

            dp2 = new dataProcessor(mygrid2_url + ConAllData + RowAllData);
            dp2.setTransactionMode("POST",true); //set mode as send-all-by-post
            dp2.setUpdateMode("off"); //disable auto-update
            dp2.init(mygrid2);






            console.log("mygrid1 - onRowSelect ----------end");
        });
        mygrid1.attachEvent("onBeforeSorting", function(ind,type,direction){
            //any custom logic here
            return !addstatusyn1;
        });

        //2번째 그리드 초기화
        mygrid2 = new dhtmlXGridObject('grid2');
        mygrid2.setImagePath("../dhtmlx/imgs/");
        mygrid2.setHeader("SEQ,ORD,DESC,SRC,SPLIT,INPUT,PARAM,TYPE,ADDDT,MODDT");
        mygrid2.setColumnIds("SRCDSEQ,SRCDORD,SRCDESC,SRCTXT,SPTTXT,INPUT,PARAM,SRCTYPE,ADDDT,MODDT");
        //mygrid2.attachHeader("#connector_text_filter,#connector_text_filter,#connector_text_filter,#connector_text_filter")
        mygrid2.setInitWidths("50,50,60,350,50,50,50,50,50,50")
        mygrid2.setColTypes("ro,edn,ed,txttxt,ed,ed,ed,ed,ro,ro");
        mygrid2.setColAlign("left,left,left,left,left,left,left,left,left,right")
        mygrid2.setColSorting("connector,connector,connector,connector,connector,connector,connector,connector,connector,connector");
        //mygrid2.isColumnHidden(0);//PJTID숨기기

        mygrid2.enableSmartRendering(false);
        mygrid2.enableMultiselect(true);
        mygrid2.init();
        mygrid2.splitAt(3);

        mygrid2.attachEvent("onRowSelect",function(rowID,celInd){
            console.log("mygrid2 - onRowSelect ----------start");
            console.log("   rowID = " + rowID);
            console.log("   celInd = " + celInd);


            //선택된 ROW의 모든컬럼 추출하기
            var RowAllData;
            RowAllData = getRowsColid(mygrid2,"G2",rowID);
            console.log("   RowAllData = " + RowAllData);

            var ConAllData = $( "#condition1" ).serialize();
            console.log("   ConAllData = " + ConAllData);

            //그리드3번 조회
            mygrid3.clearAll();
            mygrid3.loadXML(mygrid3_url + ConAllData + RowAllData,function(){
                console.log("grid3 is loadXML------------start");
                var rowsnum = mygrid3.getRowsNum();
                //if(rowsnum > 0)mygrid3.selectRow(0);
                console.log("   mygrid3.getRowsNum:" + rowsnum);
                console.log("grid3 is loadXML------------end");
            });

            dp3 = new dataProcessor(mygrid3_url + ConAllData + RowAllData);
            dp3.setTransactionMode("POST",true); //set mode as send-all-by-post
            dp3.setUpdateMode("off"); //disable auto-update
            dp3.init(mygrid3);

            console.log("mygrid2 - onRowSelect ----------end");
        });
        //mygrid2.loadXML("cg_pjtinfo_crud2.php");


        //3번째 그리드 초기화
        mygrid3 = new dhtmlXGridObject('grid3');
        mygrid3.setImagePath("../dhtmlx/imgs/");
        mygrid3.setHeader("SEQ,ORD,DESC,SRC,SPLIT,INPUT,PARAM,TYPE,ADDDT,MODDT");
        mygrid3.setColumnIds("SRCASEQ,SRCDESC,SRCAORD,SRCTXT,SPTTXT,INPUT,PARAM,SRCTYPE,ADDDT,MODDT");
        //mygrid2.attachHeader("#connector_text_filter,#connector_text_filter,#connector_text_filter,#connector_text_filter")
        mygrid3.setInitWidths("30,30,60,300,50,50,50,50,50,50")
        mygrid3.setColTypes("ro,edn,ed,txttxt,ed,ed,ed,ed,ro,ro");
        mygrid3.setColAlign("left,left,left,left,left,left,left,left,left,right")
        mygrid3.setColSorting("connector,connector,connector,connector,connector,connector,connector,connector,connector,connector");
        //mygrid2.isColumnHidden(0);//PJTID숨기기

        mygrid3.enableSmartRendering(false);
        mygrid3.enableMultiselect(true);
        mygrid3.init();
        //mygrid2.loadXML("cg_pjtinfo_crud2.php");


    }//initBody();



    </script>


</head>
<body onload="initBody();">

<div id="BODY_BOX" class="BODY_BOX">

    <div style="position: relative;width:100%;padding:0 0 0 0;text-align:right;">
    <input type="button" name="some_name" value="Search1" onclick="search1();">
    <input type="button" name="some_name" value="Save1" onclick="save1();">
    <input type="button" name="some_name" value="Save2" onclick="save2();">
    <input type="button" name="some_name" value="Save3" onclick="save3();">
    <input type="button" name="some_name" value="SaveAll" onclick="saveAll();">
    </div>

    <div style="position: relative;width:100%;background-color:yellow;padding:0 0 0 0;overflow:auto;">
        <div style="position: relative;background-color:#eeeeee;padding:5px 5px 5px 5px;overflow:auto;">
            <div style="width:0px;height:0px;overflow: hidden"><form id="condition1"></div>

            <div class="CON_LINE" style="">
                <div class="CON_OBJGRP" style="">
                    <div class="CON_LABEL" style="width:100px;">PJTID *</div>
                    <div class="CON_OBJECT" style="width:150px;"><input type="text" name="F_PJTID" value="" id="F_PJTID"></div>
                </div>
                <div class="CON_OBJGRP" style="">
                    <div class="CON_LABEL" style="width:100px;">FILE *</div>
                    <div class="CON_OBJECT" style="width:150px;">
                        <input type="radio" name="F_FILETYPE" value="HTML" id="F_FILETYPE" checked>HTML,
                        <input type="radio" name="F_FILETYPE" value="PHP" id="F_FILETYPE">PHP
                    </div>
                </div>
                <div class="CON_OBJGRP" style="">
                    <div class="CON_LABEL" style="width:100px;">SRCORD</div>
                    <div class="CON_OBJECT" style="width:150px;"><input type="text" name="F_PGMID" value="" id="F_SRCORD"></div>
                </div>
                <div class="CON_OBJGRP" style="">
                    <div class="CON_LABEL" style="width:100px;">SRCDESC</div>
                    <div class="CON_OBJECT" style="width:150px;"><input type="text" name="F_PGMNM" value="" id="F_SRCDESC"></div>
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


    <div style="position:relative:width:100%;z-index:1;">
        <div style="position: relative;float:left;width:50%;z-index:2;">

            <div style="position: relative;width:100%;padding:0 0 0 0;text-align:right;z-index:3;">
                <input type="button" name="add" value="add row" onclick="addRow1();" style="z-index:4;">
                <input type="button" name="delete" value="delete row" onclick="delRow1();" style="z-index:4;">
            </div>

            <div style="position: relative;width:100%;padding:0 0 0 0;z-index:3;">
                <div id="grid1" width="100%" height="300px" style="background-color:white;z-index:4;"></div>
            </div>
        </div>


        <div style="position: relative;float:left;width:50%;z-index:2;">
            <div style="position: relative;width:100%;padding:0 0 0 0;text-align:right;z-index:3;">
                <input type="button" name="add" value="add row" onclick="addRow2();" style="z-index:4;">
                <input type="button" name="delete" value="delete row" onclick="delRow2();" style="z-index:4;">
            </div>

            <div style="position: relative;width:100%;padding:0 0 0 0;z-index:3;">
                <div id="grid2" width="100%" height="300px" style="background-color:white;z-index:4;"></div>
            </div>
        </div>
    </div>


    <div style="position: relative;width:100%;z-index:1;">
        <div style="position: relative;width:100%;padding:0 0 0 0;text-align:right;z-index:2;">
            <input type="button" name="add" value="add row" onclick="addRow3();">
            <input type="button" name="delete" value="delete row" onclick="delRow3();">
        </div>

        <div style="position: relative;width:100%;padding:0 0 0 0;z-index:2;">
            <div id="grid3" width="100%" height="200px" style="background-color:white;z-index:3;"></div>
        </div>
    </div>


</div>


<div style="width:0px;height:0px;overflow: hidden"></form></div>

</body>
</html>
