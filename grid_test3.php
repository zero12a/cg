<?php
header("Content-Type: text/html; charset=UTF-8");
header("Cache-Control:no-cache");
header("Pragma:no-cache");
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>OBJ</title>
    <meta http-equiv="Context-Type" context="text/html;charset=UTF-8" />
    <style>
        body {margin:0;padding:0}
        div,input {font-size: 11px;}

        #F_START_DT, #F_END_DT {
            border: 1px solid #909090;
        }


        .BODY_BOX {100%;background-color:yellowgreen;padding:5px 5px 5px 5px;}

        .CON_LINE {position: relative;width:100%;overflow:auto;}
        .CON_OBJGRP {position: relative;float:left;background-color: #eeeeee;vertical-align:middle ;}
        .CON_LABEL {position: relative;float:left;background-color: #eeeeee;vertical-align:middle ;padding-left:5px;}
        .CON_OBJECT {position: relative;float:left;background-color: #eeeeee;vertical-align:middle ;}
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



    <script>

    function search1(){

        //폼의 모든값 구하기
        var ConAllData = $( "#condition1" ).serialize();
        alog("ConAllData:" + ConAllData);


        lastinput1 = ConAllData;

		//파일 타입에 따른 콤보 변경
		//alert($(':radio[name="F_FILETYPE"]:checked').val());
		var chk_filetype = $('input:radio[name="F_FILETYPE"]:checked').val();


        gridSearch1(lastinput1);

    }




    function clearRowChanged(tgrid,trid){
        alog("clearRowChanged----------------------------start");
        alog("       tgrid.getColumnCount : " + tgrid.getColumnCount());
        alog("       trid : " + trid);
        tgrid.setUserData(trid,"!nativeeditor_status","");
        tgrid.setRowTextStyle(trid, "font-weight:normal;text-decoration:none;");
        for(var j=0;j<tgrid.getColumnCount();j++){
            alog("           j : " + j);
            tgrid.cells(trid,j).cell.wasChanged=false;
        }
        alog("clearRowChanged----------------------------end");
    }





    //그리드 조회
    function gridSearch1(tinput){
        alog("gridSearch1()------------start");

        //처리할 그리드
        tgrid = mygrid1;

        //그리드 초기화
        tgrid.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : url_1+"&G1_CRUD_MODE=read&" + tinput ,
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

                    tgrid.parse(data.RTN_DATA,"json");

                }else{
                    alert("서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG);
                }


            },
            error: function(error){
                alog("Error:");
                alog(error);
            }
        });

        alog("gridSearch1()------------end");
    }

    //그리드 조회
    function gridSearch2(tinput){
        alog("gridSearch2()------------start");

        //처리할 그리드
        tgrid = mygrid2;

        //그리드 초기화
        tgrid.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : url_2+"&G2_CRUD_MODE=read&" + tinput ,
            data : {xmldata : ""},
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridSearch2 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
                    if(data.RTN_DATA)tgrid.parse(data.RTN_DATA,"json");
					alog(JSON.stringify(data.RTN_DATA));
					msgNotice("[그리드2] 조회 성공했습니다",1);
                    

                }else{
                    alert("서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG);
                }


            },
            error: function(error){
                alog("Error:");
                alog(error);
            }
        });

        alog("gridSearch2()------------end");
    }

    //그리드 조회
    function gridSearch3(tinput){
        alog("gridSearch3()------------start");

        //처리할 그리드
        tgrid = mygrid3;

        //그리드 초기화
        tgrid.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : url_3+"&G3_CRUD_MODE=read&" + tinput ,
            data : {xmldata : ""},
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridSearch3 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
					if(data.RTN_DATA)tgrid.parse(data.RTN_DATA,"json");
                    alog(JSON.stringify(data.RTN_DATA));

                    msgNotice("[그리드3] 조회 성공했습니다.",1);


                }else{
                    alert("서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG);
                }


            },
            error: function(error){
                alog("Error:");
                alog(error);
            }
        });

        alog("gridSearch3()------------end");
    }



    //정적 변수 선언
    var myCalendar;
    var mygrid1,selrowid1,lastinput1,lastinput1json;
    var mygrid2,selrowid2,lastinput2,lastinput2json;
    var mygrid3,selrowid3,lastinput3,lastinput3json;
    var mygrid4,selrowid3,lastinput4,lastinput4json;
    var url_1 = "grid_test3_1.txt?F_GRPID=1&";
    var url_2 = "grid_test3_2.txt?F_GRPID=2&";
    var url_3 = "grid_test3_3.txt?F_GRPID=3&";
    var url_4 = "cg_objinfo_crud2.php?F_GRPID=4&";
    var url_5 = "cg_objinfo_crud2.php?F_GRPID=5&";


    //화면 초기화
    function initBody(){
        alog("initBody()---------start")

		//dhtmlx 메시지 박스 초기화
		dhtmlx.message.position="bottom"


        //프로젝트 id초기화
        $("#F_PJTID").val("CG");

        //날짜 박스 초기
        myCalendar = new dhtmlXCalendarObject([{input:"F_START_DT",
            button:"F_START_DT_ICON"},{input:"F_END_DT",
            button:"F_END_DT_ICON"}]);





        alog("       grid1 init-----------start");

        //그리드 초기화
        mygrid1 = new dhtmlXGridObject('grid1');
        mygrid1.setImagePath("../dhtmlx/imgs/");
        mygrid1.setHeader("OLD_OBJTYPE,OBJTYPE,STARTTXT,LBLSTARTTXT,LBLTXT,LBLENDTXT,OBJSTARTTXT,OBJTXT,OBJENDTXT,ENDTXT,사용여부,ADDDT,MODDT");
        mygrid1.setColumnIds("OLD_OBJTYPE,OBJTYPE,STARTTXT,LBLSTARTTXT,LBLTXT,LBLENDTXT,OBJSTARTTXT,OBJTXT,OBJENDTXT,ENDTXT,USEYN,ADDDT,MODDT");
        //mygrid1.attachHeader("#connector_text_filter,#connector_text_filter,#connector_text_filter,#connector_text_filter")
        mygrid1.setInitWidths("60,60,200,200,200,50,200,200,50,50,60,60,60")
        mygrid1.setColTypes("ro,ed,txttxt,txttxt,txttxt,txttxt,txttxt,txttxt,txttxt,txttxt,ed,ro,ro");
        mygrid1.enableSmartRendering(false);
        mygrid1.enableMultiselect(true);
        mygrid1.init();
        mygrid1.splitAt(2);
        mygrid1.setColumnHidden(2,true); //PJTID
        mygrid1.setColumnHidden(3,true); //PJTID
        mygrid1.setColumnHidden(4,true); //PJTID
        mygrid1.setColumnHidden(5,true); //PJTID
        mygrid1.setColumnHidden(6,true); //PJTID
        mygrid1.setColumnHidden(7,true); //PJTID
        mygrid1.setColumnHidden(8,true); //PJTID
        mygrid1.setColumnHidden(9,true); //PJTID

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

        mygrid1.attachEvent("onRowSelect",function(rowID,celInd){
            alog("mygrid1 - onRowSelect ----------start");
            alog("   rowID = " + rowID);
            alog("   celInd = " + celInd);
            mygrid2.clearAll();

            selrowid1 = rowID;

            //선택된 ROW의 모든컬럼 추출하기
            var RowAllData;
            RowAllData = getRowsColid(mygrid1,rowID,"G1",["OBJTYPE"]);
            alog("   RowAllData = " + RowAllData);

            var ConAllData = $( "#condition1" ).serialize();
            alog("   ConAllData = " + ConAllData);

            //alert( mygrid1.cells(rowID,celInd).getValue() );

            lastinput2 = ConAllData + RowAllData;
            lastinput4 = ConAllData + RowAllData;

            //디테일 4 조회
            //detailSearch4(lastinput4);




            //그리드 2 조회
            gridSearch2(lastinput2);



            alog("mygrid1 - onRowSelect ----------end");
        });

        alog("       grid1 init-----------end");

        mygrid2 = new dhtmlXGridObject('grid2');
        mygrid2.setImagePath("../dhtmlx/imgs/");
        mygrid2.setHeader("OBJDSEQ,OBJTYPE,FILETYPE,OBJVAL,ORD,OBJVALTYPE,OBJVALNM,DESC,SRCTXT,SPT,INPUT,PARAM,TYPE,ADDDT,MODDT");
        mygrid2.setColumnIds("OBJDSEQ,OBJTYPE,FILETYPE,OBJVAL,OBJDORD,OBJVALTYPE,OBJVALNM,OBJDESC,SRCTXT,SPTTXT,INPUT,PARAM,SRCTYPE,ADDDT,MODDT");
        //mygrid2.attachHeader("#connector_text_filter,#connector_text_filter,#connector_text_filter,#connector_text_filter")
        mygrid2.setInitWidths("50,50,50,100,40,60,60,60,400,40,60,60,40,60,60")
        mygrid2.setColTypes("ro,ed,coro,coro,ed,coro,ed,ed,txttxt,ed,ed,ed,ed,ro,ro");
        mygrid2.setColAlign("left,left,left,left,left,left,left,left,left,left,left,left,left,left,right")
        //mygrid2.isColumnHidden(0);//PJTID숨기기

        mygrid2.enableSmartRendering(false)
        mygrid2.enableMultiselect(true)
        mygrid2.init();
        mygrid2.splitAt(4);



        //mygrid2.loadXML("cg_pjtinfo_crud2.php");
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
        mygrid2.attachEvent("onRowSelect",function(rowID,celInd){
            alog("mygrid2 - onRowSelect ----------start");
            alog("   rowID = " + rowID);
            alog("   celInd = " + celInd);


            selrowid2 = rowID;


            //그리드 3처리
            mygrid3.clearAll();

            //선택된 ROW의 모든컬럼 추출하기
            var RowAllData;
            var RowAllData1;
            RowAllData1 = getRowsColid(mygrid1,selrowid1,"G1");
            var RowAllData2;
            RowAllData2 = getRowsColid(mygrid2,rowID,"G2");
            RowAllData = RowAllData1 + RowAllData2;
            alog("   RowAllData = " + RowAllData);

            var ConAllData = $( "#condition1" ).serialize();
            alog("   ConAllData = " + ConAllData);

            //alert( mygrid1.cells(rowID,celInd).getValue() );

            lastinput3 = ConAllData + RowAllData;



            //그리드 2 조회
            gridSearch3(lastinput3);






            alog("mygrid2 - onRowSelect ----------end");
        });





        alog("       grid2 init-----------end");




        mygrid3 = new dhtmlXGridObject('grid3');
        mygrid3.setImagePath("../dhtmlx/imgs/");
        mygrid3.setHeader("ASEQ,OBJTYPE,DSEQ,ORD,OBJDESC,SRCTXT,SPT,INPUT,PARAM,TYPE,ADDDT,MODDT");
        mygrid3.setColumnIds("OBJASEQ,OBJTYPE,OBJDSEQ,OBJAORD,OBJDESC,SRCTXT,SPTTXT,INPUT,PARAM,SRCTYPE,ADDDT,MODDT");
        //mygrd3.attachHeader("#connector_text_filter,#connector_text_filter,#connector_text_filter,#connector_text_filter")
        mygrid3.setInitWidths("50,50,50,50,80,500,30,80,80,50,70,70")
        mygrid3.setColTypes("ro,ed,ed,ed,ed,txttxt,ed,ed,ed,ed,ro,ro");
        mygrid3.setColAlign("left,left,left,left,left,left,left,left,left,left,left,right")
        //mygrid2.isColumnHidden(0);//PJTID숨기기

        mygrid3.enableSmartRendering(false);
        mygrid3.enableMultiselect(true);
		//mygrid3.enableMultiline(true);

        mygrid3.init();
        mygrid3.splitAt(3);

        mygrid3.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            alog("mygrid3  onEditCell ------------------start");
            alog("       stage : " + stage);
            alog("       rId : " + rId);
            alog("       cInd : " + cInd);
            alog("       nValue : " + nValue);
            alog("       oValue : " + oValue);

            RowEditStatus = mygrid3.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygrid3.setUserData(rId,"!nativeeditor_status","updated");
                    mygrid3.setRowTextBold(rId);
                }
                mygrid3.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

        });



        mygrid3.attachEvent("onRowSelect",function(rowID,celInd){
            alog("mygrid3 - onRowSelect ----------start");
            alog("   rowID = " + rowID);
            alog("   celInd = " + celInd);


            selrowid3 = rowID;


            //그리드 3처리
            mygrid4.clearAll();

            //선택된 ROW의 모든컬럼 추출하기
            var RowAllData;
            RowAllData = getRowsColid(mygrid3,rowID,"G3");
            alog("   RowAllData = " + RowAllData);
            var ConAllData = $( "#condition1" ).serialize();
            alog("   ConAllData = " + ConAllData);

            //alert( mygrid1.cells(rowID,celInd).getValue() );

            lastinput4 = ConAllData + RowAllData;





            alog("mygrid3 - onRowSelect ----------end");
        });






        mygrid4 = new dhtmlXGridObject('grid4');
        mygrid4.setImagePath("../dhtmlx/imgs/");
        mygrid4.setHeader("BSEQ,OBJTYPE,ASEQ,ORD,OBJDESC,SRCTXT,SPT,INPUT,PARAM,TYPE,ADDDT,MODDT");
        mygrid4.setColumnIds("OBJBSEQ,OBJTYPE,OBJASEQ,OBJBORD,OBJDESC,SRCTXT,SPTTXT,INPUT,PARAM,SRCTYPE,ADDDT,MODDT");
        //mygrd3.attachHeader("#connector_text_filter,#connector_text_filter,#connector_text_filter,#connector_text_filter")
        mygrid4.setInitWidths("50,50,50,50,80,500,30,80,80,50,70,70")
        mygrid4.setColTypes("ro,ed,ed,ed,ed,txttxt,ed,ed,ed,ed,ro,ro");
        mygrid4.setColAlign("left,left,left,left,left,left,left,left,left,left,left,right")
        //mygrid2.isColumnHidden(0);//PJTID숨기기

        mygrid4.enableSmartRendering(false)
        mygrid4.enableMultiselect(true)
        mygrid4.init();
        mygrid4.splitAt(3);

        alog(" initBody()-----------------end");

    }//initBody();





	//그리드 저장 처리
	function saveToGrid(tgrid,data){
		if(data.RTN_CD == "200"){
			if(!data.RTN_MSG){
				msgError("서버 전송후 서버에서 처리 결과를 전송받지 못했습니다.",1);
				return;
			}
			for(var i=0;i<data.RTN_MSG.length;i++){
				alog( "   i : " + i);
				alog( "      OLD_ID : " + data.RTN_MSG[i].OLD_ID);
				alog( "      NEW_ID : " + data.RTN_MSG[i].NEW_ID);
				alog( "      USER_DATA : " + data.RTN_MSG[i].USER_DATA);
				alog( "      AFFECTED_ROWS : " + data.RTN_MSG[i].AFFECTED_ROWS);


				if(data.RTN_MSG[i].AFFECTED_ROWS=="-1"){
					alert(data.RTN_MSG[i].NEW_ID + "는 저장 실패");
				}else{
					//rid = mygrid.getRowId(j);
					rid = data.RTN_MSG[i].OLD_ID;
					if( data.RTN_MSG[i].USER_DATA == "inserted" ){
						clearRowChanged(tgrid,rid);

						tgrid.changeRowId(data.RTN_MSG[i].OLD_ID,data.RTN_MSG[i].NEW_ID); //j+10은 서버에서 전달 받은 서버에 저장된 id값
						alog("	rid [" + rid + "] is [inserted]");
					}
					if( data.RTN_MSG[i].USER_DATA == "updated" ){
						clearRowChanged(tgrid,rid);

						alog("	rid [" + rid + "] is [updated]");
					}
					if( data.RTN_MSG[i].USER_DATA == "deleted" ){
						tgrid.deleteRow(rid);

						alog("	rid [" + rid + "] is [deleted]");
					}
				}
			}

			//변경 상태 모두 초기화
			tgrid.clearChangedState();
			msgNotice("성공적으로 저장되었습니다.");
		}else{
			msgError("서버 저장중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG,3);
		}
	}



	//정적-특정row의 모든 컬럼 값 가져오기
	function getRowsColid(tgrid,trowid,tgrpid, tcols){
		alog("getRowsColid111()------------start");
		//alog("        tgrpid tt : " + tgrpid);

		var RtnVal="";
		var colNum=tgrid.getColumnsNum();
		alog("   colNum : " + colNum);

		for(i=0;i<colNum;i++){
			alog("   " + i + " = " + tgrid.getColumnId(i));
			if(tcols != null){
				for(j=0;j<tcols.length;j++){
					if( tcols[j] == tgrid.getColumnId(i) ){
						RtnVal += "&" + tgrpid + "_" + tgrid.getColumnId(i) + "=" + tgrid.cells(trowid,i).getValue();
					}
				}
			}else{
				//컬럼 정의가 없으면 모든 컬럼 리턴
				RtnVal += "&" + tgrpid + "_" + tgrid.getColumnId(i) + "=" + tgrid.cells(trowid,i).getValue();
			}
		}
		alog("getRowsColid222()------------end");
		return RtnVal;
	}


	function msgNotice(tMsg,tSecond){
		alog("msgNotice : " + tMsg);
		dhtmlx.message({
			type: "Notice",
			text: tMsg,
			expire: tSecond * 1000
		});
	}
	function msgError(tMsg,tSecond){
		alog("msgError : " + tMsg);

		dhtmlx.message({
			type: "Error",
			text: tMsg,
			expire: tSecond * 1000
		});
	}

	function alog(tLog){
		if(typeof console == "object")alog(tLog);
	}

    </script>


</head>
<body onload="initBody();">

<div id="BODY_BOX" class="BODY_BOX">

    <div style="position: relative;width:100%;padding:0 0 0 0;text-align:right;">
    <input type="button" name="some_name" value="Search1" onclick="search1();">
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
                    <div class="CON_LABEL" style="width:100px;">FILETYPE</div>
                    <div class="CON_OBJECT" style="width:400px;">
					<input type="radio" name="F_FILETYPE" value="" id="F_FILETYPE" checked>전체
					<input type="radio" name="F_FILETYPE" value="HTML" id="F_FILETYPE">HTML
					<input type="radio" name="F_FILETYPE" value="SVRCTL" id="F_FILETYPE">SVRCTL
					<input type="radio" name="F_FILETYPE" value="SVRDAO" id="F_FILETYPE">SVRDAO
					
					</div>
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
                    <div class="CON_OBJECT" style="width:300px;">
                        <input type="text" name="F_START_DT" value="" id="F_START_DT" style="width:80px"><img id="F_START_DT_ICON" src="./lib/dhtmlxSuite/calendar.png" border="0" align="absmiddle">
                        <input type="text" name="F_END_DT" value="" id="F_END_DT" style="width:80px"><img id="F_END_DT_ICON" src="./lib/dhtmlxSuite/calendar.png" border="0" align="absmiddle">
                    </div>
                </div>
            </div>
            <div style="width:0px;height:0px;overflow: hidden"></form></div>
        </div>
    </div>

    <div class="GRP_LINE" >
        <div class="GRP_OBJECT" style="width:10%;height:967px">
            <div style="position: relative;width:100%;padding:0 0 0 0;">
            <div id="grid1" width="100%"  style="height:845px;background-color:white;overflow:hidden"></div>
            </div>
        </div>

        <div class="GRP_OBJECT" style="width:90%;height:900px">
            


			<div class="GRP_LINE" >
				<div class="GRP_OBJECT" style="width:60%;">
					<div style="position: relative;width:100%;padding:0 0 0 0;">
						<div id="grid2" width="100%" height="200px" style="background-color:white;overflow:hidden"></div>
					</div>
				</div>
				<div class="GRP_OBJECT" style="width:40%;height:222px;">
						<textarea id="code2" name="code2">

						</textarea>
				</div>
			</div>

			<div class="GRP_LINE" >
				<div class="GRP_OBJECT" style="width:60%;">

					<div style="position: relative;width:100%;padding:0 0 0 0;">
						<div id="grid3" width="100%" height="300px" style="background-color:white;overflow:hidden"></div>
					</div>
				</div>

				<div class="GRP_OBJECT" style="width:40%;height:322px;">
					<textarea id="code3" name="code3">

					</textarea>
				</div>
			</div>


			<div class="GRP_LINE" >
				<div class="GRP_OBJECT" style="width:60%;">

					<div style="position: relative;width:100%;padding:0 0 0 0;">
						<div id="grid4" width="100%" height="300px" style="background-color:white;overflow:hidden"></div>
					</div>
				</div>

				<div class="GRP_OBJECT" style="width:40%;height:322px;">
					<textarea id="code4" name="code4">

					</textarea>
				</div>
			</div>


        </div>

    </div>


</div>


</body>
</html>
