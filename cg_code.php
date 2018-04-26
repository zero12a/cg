<?
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
<style>
    body {margin:0;padding:0}
    div,input {font-size: 11px;}

    #F_START_DT, #F_END_DT {
        border: 1px solid #909090;
    }


    .BODY_BOX {100%;background-color:yellowgreen;padding:10px 10px 10px 10px;}

    .CON_LINE {position: relative;width:100%;height:22px;line-height;122px;overflow:visible;}
    .CON_OBJGRP {position: relative;float:left;background-color: #eeeeee;height:22px;line-height:22px;vertical-align:middle ;overflow:visible;}
    .CON_LABEL {position: relative;float:left;background-color: #eeeeee;height:22px;line-height:22px;vertical-align:middle ;padding-left:5px;}
    .CON_OBJECT {position: relative;float:left;background-color: #eeeeee;height:22px;line-height:22px;vertical-align:middle ;}
    .CON_LINEBREAK {position: relative;height:10px;overflow:auto;}

    .GRID_LABELGRP {position:relative;width:100%;height:22px;z-index:20;}
    .GRID_LABEL {position:relative;float:left;width:20%;height:22px;line-height:22px;vertical-align:middle;z-index:30;}
    .GRID_LABELBTN {position: relative;float:left;width:80%;height:22px;line-height:22px;vertical-align:middle;text-align:right;z-index:30;}
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

    <script>


    function search1(){
        //폼값 밸리데이션
        if( !jsonFormValid(obj_condition_valid.F_PJTID, "F_PJTID", "프로젝트ID", $("#F_PJTID").val()) ){return false;};


        //폼의 모든값 구하기
        var ConAllData = $( "#condition1" ).serialize();
        alog("ConAllData:" + ConAllData);

        lastCondition = ConAllData;

        //그리드 조회
        gridSearch1(ConAllData);

    }



    //그리드1 조회
    function gridSearch1(tinput){
        alog("gridSearch1()------------start");

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
                alog("   gridSearch1 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
                    alog(JSON.stringify(data.RTN_DATA));

                    mygrid1.parse(data.RTN_DATA,"json");

					msgNotice("[그리드1] 조회 성공했습니다.",1);
                }else{
                    msgError("[그리드1] 서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG,3);
                }


            },
            error: function(error){
                alog("Error:");
                alog(error);
            }
        });

        alog("gridSearch1()------------end");
    }


    //그리드2 조회
    function gridSearch2(tinput){
        alog("gridSearch2()------------start");

        //그리드 초기화
        mygrid2.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : mygrid2_url+"&G2_CRUD_MODE=read&" + tinput ,
            data : {xmldata : ""},
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridSearch1 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
                    alog(JSON.stringify(data.RTN_DATA));

                    mygrid2.parse(data.RTN_DATA,"json");
					msgNotice("[그리드2] 조회 성공했습니다.",1);
                }else{
                    msgError("[그리드2] 서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG,3);
                }


            },
            error: function(error){
                alog("Error:");
                alog(error);
            }
        });

        alog("gridSearch1()------------end");
    }


    //mygrid.filterBy(0,function(a){ return (a<500);});


    function addRow1(){
        alog("addRow1()------------start");
        var id=mygrid1.uid();
        mygrid1.addRow(id,'',0);
        mygrid1.showRow(id);
        mygrid1.selectRow(0);
        mygrid1.cells(id,0).cell.wasChanged = true;
        mygrid1.setUserData(id,"!nativeeditor_status","inserted");
        mygrid1.setRowTextBold(id);
        addstatusyn1 = true;
        alog("addRow1()------------end");
    }

    function addRow2(){
        alog("addRow2()------------start");
        var id=mygrid2.uid();
        mygrid2.addRow(id,'',0);
        mygrid2.showRow(id);
        mygrid2.selectRow(0);
        mygrid2.cells(id,0).cell.wasChanged = true;
        mygrid2.setUserData(id,"!nativeeditor_status","inserted");
        mygrid2.setRowTextBold(id);
        addstatusyn1 = true;
        alog("addRow2()------------end");
    }

    function delRow1(){
        alog("delRow1()------------start");

        rid = mygrid1.getSelectedRowId();
        mygrid1.setUserData(rid,"!nativeeditor_status","deleted");
        mygrid1.setRowTextBold(rid);
        mygrid1.cells(rid,0).cell.wasChanged=true;

        alog("delRow4()------------end");
    }
    function delRow2(){
        alog("delRow2()------------start");

        rid = mygrid2.getSelectedRowId();
        mygrid2.setUserData(rid,"!nativeeditor_status","deleted");
        mygrid2.setRowTextBold(rid);
        mygrid2.cells(rid,0).cell.wasChanged=true;

        alog("delRow2()------------end");
    }

    function saveAll(){
        alog("saveAll()------------start");
        save1();
        save2();
        addstatusyn1=false;
        addstatusyn2=false;
        alog("saveAll()------------end");
    }

    function save1(){
        alog("save1()------------start");

        mygrid1.setSerializationLevel(true,false,false,false,true,true);
        var myXmlString = mygrid1.serialize();
        $.ajax({
            type : "POST",
            url : mygrid1_url+"&G1_CRUD_MODE=SAVE&" + lastinput2 ,
            data : {xmldata : myXmlString},
            dataType: "json",
            async: false,
            success: function(data){
                alog("   json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                saveToGrid(mygrid1,data);

				msgNotice("[그리드1] 성공적으로 저장되었습니다.",2);
            },
            error: function(error){
                alog("Error:");
                alog(error);
            }
        });

        addstatusyn2 = false;
        alog("save1()------------end");
    }

    function save2(){
        alog("save2()------------start");

        mygrid2.setSerializationLevel(true,false,false,false,true,true);
        var myXmlString = mygrid2.serialize();
        $.ajax({
            type : "POST",
            url : mygrid2_url+"&G2_CRUD_MODE=SAVE&" + lastinput2 ,
            data : {xmldata : myXmlString},
            dataType: "json",
            async: false,
            success: function(data){
                alog("   json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                saveToGrid(mygrid2,data);

				msgNotice("[그리드2] 성공적으로 저장되었습니다.",2);

            },
            error: function(error){
                alog("Error:");
                alog(error);
            }
        });

        addstatusyn2 = false;
        alog("save2()------------end");
    }



    //정적 변수 선언
    var myCalendar;
    var mygrid1,dp1,addstatusyn1;
    var mygrid2,dp2,addstatusyn2;

    var mygrid1_url = "cg_code_crud.php?F_GRPID=1&";
    var mygrid2_url = "cg_code_crud.php?F_GRPID=2&";

    var validmsg = jQuery.parseJSON('{"REQUARED":"[0]는 반드시 입력바랍니다.", "MIN":"this는 [0]이상 입력바랍니다."}');

    //동적 변수 선언
    //동적 변수 선언
    var obj_condition_valid = jQuery.parseJSON( '{"__NAME":"obj_condition_valid"' +
        ' ,"F_PJTID": {"REQUARED":"Y",  "MIN":"0",  "MAX":"ZZZ",  "DATASIZE":10,  "DATATYPE":"STRING"} ' +
        '}');


    //값초기화

    //화면 초기화
    function initBody(){
		//dhtmlx 메시지 박스 초기화
		dhtmlx.message.position="bottom"




        //컨디션 초기화
        $("#F_PJTID").val("CG");


        //날짜 박스 초기
        alog("initBody()---------start")
        myCalendar = new dhtmlXCalendarObject([{input:"F_START_DT",
            button:"F_START_DT_ICON"},{input:"F_END_DT",
            button:"F_END_DT_ICON"}]);
        alog("initBody()---------end")


        //그리드 초기화
        mygrid1 = new dhtmlXGridObject('gridbox');
        mygrid1.setImagePath("../dhtmlx/imgs/");
        mygrid1.setHeader("PCD,PNM,ORD,PCDDESC,USEYN,UITOOL,ADDDT,MODDT");
        mygrid1.setColumnIds("PCD,PNM,ORD,PCDDESC,USEYN,UITOOL,ADDDT,MODDT");

        //mygrid1.attachHeader("#connector_text_filter,#connector_text_filter,#connector_text_filter,#connector_text_filter")
        mygrid1.setInitWidths("100,100,50,*,100,100,100,100");
        mygrid1.setColTypes("ed,ed,ed,ed,ed,ed,ro,ro");
        mygrid1.setColSorting("str,str,str,str,str,str,str");
        mygrid1.enableSmartRendering(true);
        mygrid1.enableMultiselect(true);
        mygrid1.init();
        //mygrid1.loadXML("cg_code_crud.php?GRPID=CODE");

        mygrid1.attachEvent("onRowSelect",function(rowID,celInd){
            alog("mygrid1 - onRowSelect ----------start");
            alog("   rowID = " + rowID);
            alog("   celInd = " + celInd);


            lastrowid1 = rowID;

            //선택된 ROW의 모든컬럼 추출하기
            var RowAllData;

            RowAllData = getRowsColid(mygrid1,rowID,"G1");
            alog("   RowAllData = " + RowAllData);

            var ConAllData = $( "#condition1" ).serialize();
            alog("   ConAllData = " + ConAllData);

            //마지막 선송 정보 저장
            lastinput2 = RowAllData + "&" + ConAllData;


            //그리드 2번 조회
            gridSearch2(lastinput2);

            alog("mygrid1 - onRowSelect ----------end");
        });
        mygrid1.attachEvent("onBeforeSorting", function(ind,type,direction){
            //any custom logic here
            return !addstatusyn1;
        });


        mygrid1.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            alog("mygrid1  onEditCell ------------------start");
            alog("       stage : " + stage);
            alog("       rId : " + rId);
            alog("       cInd : " + cInd);
            alog("       nValue : " + nValue);
            alog("       oValue : " + oValue);

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
        mygrid2 = new dhtmlXGridObject('gridboxPgminfo');
        mygrid2.setImagePath("../dhtmlx/imgs/");
        mygrid2.setHeader("CD,NM,ORD,CDVAL,CDVAL2,CDDESC,CDMIN,CDMAX,DATATYPE,EDITYN,FORMATYN,USEYN,ADDDT,MODDT");
        mygrid2.setColumnIds("CD,NM,ORD,CDVAL,CDVAL2,CDDESC,CDMIN,CDMAX,DATATYPE,EDITYN,FORMATYN,USEYN,ADDDT,MODDT");

        mygrid2.setInitWidths("100,100,30,200,200,100,30,30,30,30,30,30,60,60")
        mygrid2.setColTypes("edtxt,ed,ed,txttxt,ed,ed,ed,ed,ed,ed,ed,ed,ro,ro");
        mygrid2.setColAlign("left,left,left,left,left,left,left,left,left,left,left,left,right");
        mygrid2.setColSorting("str,str,str,str,str,str,str,str,str,str,str,str,str,str,str");
        //mygrid2.isColumnHidden(0);//PJTID숨기기

        mygrid2.enableSmartRendering(true);
        mygrid2.enableMultiselect(true);
        mygrid2.init();
        mygrid2.attachEvent("onBeforeSorting", function(ind,type,direction){
            alog("mygrid2 - onBeforeSorting ----------start");

            alog("   addstatusyn2 = " + !addstatusyn2);

            alog("mygrid1 - onBeforeSorting ----------end");
            return false;
        });



        mygrid2.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            alog("mygrid2  onEditCell ------------------start");
            alog("       stage : " + stage);
            alog("       rId : " + rId);
            alog("       cInd : " + cInd);
            alog("       nValue : " + nValue);
            alog("       oValue : " + oValue);

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


    }//initBody();



    </script>


</head>
<body onload="initBody();">

<div id="BODY_BOX" class="BODY_BOX">
	<div  class="GRID_LABELGRP" >
		<div class="GRID_LABEL" >* CODE 
			<!--popup--><a href="?" target="_blank"><img src="./img/popup.png" height=10 align=absmiddle border=0></a>
			<!--reload--><a href="javascript:location.reload();"><img src="./img/reload.png" width=11 height=10 align=absmiddle border=0></a>		
		</div>
		<div  class="GRID_LABELBTN"  >
			<input type="button" name="some_name" value="Search1" onclick="search1();">
			<input type="button" name="some_name" value="SaveAll" onclick="saveAll();">
		</div>
	</div>

    <div style="position: relative;width:100%;background-color:yellow;padding:0 0 0 0;overflow:auto;">
        <div style="position: relative;background-color:#eeeeee;padding:10px 10px 10px 10px;overflow:auto;">
            <div style="width:0px;height:0px;overflow: hidden"><form id="condition1"></div>

            <div class="CON_LINE" style="">
                <div class="CON_OBJGRP" style="">
                    <div class="CON_LABEL" style="width:100px;">PJTID *</div>
                    <div class="CON_OBJECT" style="width:150px;"><input type="text" name="F_PJTID" value="" id="F_PJTID"></div>
                </div>
                <div class="CON_OBJGRP" style="">
                    <div class="CON_LABEL" style="width:100px;">PJTSEQ *</div>
                    <div class="CON_OBJECT" style="width:150px;"><input type="text" name="F_PJTSEQ" value="3" id="F_PJTSEQ"></div>
                </div>
                <div class="CON_OBJGRP" style="">
                    <div class="CON_LABEL" style="width:100px;">PCD</div>
                    <div class="CON_OBJECT" style="width:150px;"><input type="text" name="F_PCD" value="" id="F_PCD"></div>
                </div>
                <div class="CON_OBJGRP" style="">
                    <div class="CON_LABEL" style="width:100px;">PNM</div>
                    <div class="CON_OBJECT" style="width:150px;"><input type="text" name="F_PNM" value="" id="F_PNM"></div>
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
            <div style="width:0px;height:0px;overflow: hidden"></form></div>
        </div>
    </div>

    <div style="position: relative;width:100%;padding:0 0 0 0;text-align:right;">
    <input type="button" name="add" value="add row" onclick="addRow1();">
    <input type="button" name="delete" value="delete row" onclick="delRow1();">
    <input type="button" name="some_name" value="Save1" onclick="save1();">

    </div>

    <div style="position: relative;width:100%;padding:0 0 0 0;">
    <div id="gridbox" width="100%" height="250px" style="background-color:white;overflow:hidden"></div>
    </div>

    <div style="position: relative;width:100%;padding:0 0 0 0;text-align:right;">
    <input type="button" name="add" value="add row" onclick="addRow2();">
    <input type="button" name="delete" value="delete row" onclick="delRow2();">
    <input type="button" name="some_name" value="Save2" onclick="save2();">
    </div>

    <div style="position: relative;width:100%;padding:0 0 0 0;">
    <div id="gridboxPgminfo" width="100%" height="300px" style="background-color:white;overflow:hidden"></div>
    </div>

</div>




</body>
</html>
