<?php
header("Content-Type: text/html; charset=UTF-8"); //HTML

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>	
<title>디테일 프로그램2</title>
<meta http-equiv="Context-Type" context="text/html;charset=UTF-8" /><style>
    body {margin:0;padding:0}
    div,input {font-size: 11px;}

    #F_START_DT, #F_END_DT {
        border: 1px solid #909090;
    }


    .BODY_BOX {width:100%;height:100%;background-color:yellowgreen;padding:5px 5px 5px 5px;}

     .CON_LINE {position: relative;width:100%;overflow:auto;z-index:20;}
    .CON_OBJGRP {position: relative;float:left;background-color: #eeeeee;vertical-align:middle ;overflow:auto;z-index:25;}
    .CON_LABEL {position: relative;float:left;background-color: #eeeeee;vertical-align:middle ;padding-left:5px;overflow:auto;z-index:30;}
    .CON_OBJECT {position: relative;float:left;background-color: #eeeeee;vertical-align:middle;overflow:auto;z-index:30;}
    .CON_LINEPADDING {position: relative;height:5px;overflow:auto;z-index:20;}

    .GRID_LABELGRP {position:relative;width:100%;height:22px;z-index:20;}
    .GRID_LABEL {position:relative;float:left;width:60%;height:22px;line-height:22px;vertical-align:middle;z-index:30;}
    .GRID_LABELBTN {position: relative;float:left;width:40%;height:22px;line-height:22px;vertical-align:middle;text-align:right;z-index:30;}
    .GRID_OBJECT {position: relative;width:100%;padding:0 0 0 0;z-index:20;}
    .CONDITION_LABELGRP {position:relative;width:100%;height:22px;z-index:20;}
    .CONDITION_LABEL {position:relative;float:left;width:60%;height:22px;line-height:22px;vertical-align:middle;z-index:30;}
    .CONDITION_LABELBTN {position: relative;float:left;width:40%;height:22px;line-height:22px;vertical-align:middle;text-align:right;z-index:30;}
    .CONDITION_OBJECT {position: relative;background-color:#eeeeee;padding:10px 10px 10px 10px;overflow:auto;}

    .DETAIL_LABELGRP {position:relative;width:100%;height:22px;z-index:20;}
    .DETAIL_LABEL {position:relative;float:left;width:60%;height:22px;line-height:22px;vertical-align:middle;z-index:30;}
    .DETAIL_LABELBTN {position: relative;float:left;width:40%;height:22px;line-height:22px;vertical-align:middle;text-align:right;z-index:30;}
    .DETAIL_OBJECT {position: relative;background-color:#eeeeee;padding:10px 10px 10px 10px;overflow:auto;}

    .GRP_LINE {position: relative;width:100%;z-index:10;overflow:auto;}
    .GRP_OBJECT {position: relative;float:left;z-index:20;}
</style>
	<!--jquery / json-->
	<script src="./lib/jquery-1.11.1.min.js"></script>
	<script src="./lib/json2.min.js"></script>

	<!--dhmltx-->
    <script src="./lib/dhtmlxSuite/codebase/dhtmlx.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="./lib/dhtmlxSuite/codebase/dhtmlx.css" type="text/css" charset="utf-8">

<script src="./rst/cg_common.js"></script><script>//글로벌 변수 선언


//Submit Action	
var url_G1_SAVE = "cg_pjt2Control.php?CTLGRP=G1&CTLFNC=SAVE";



//2 변수 선언
var obj_G2_PJTID_valid = jQuery.parseJSON( '{ "G2_PJTID": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":30,  "DATATYPE":"STRING"} }' );  //프로젝트ID  밸리데이션
var obj_G2_ADDDT_valid = jQuery.parseJSON( '{ "G2_ADDDT": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":8,  "DATATYPE":"STRING"} }' );  //생성일  밸리데이션
var obj_G2_PJTID; // 프로젝트ID 변수선언var obj_G2_ADDDT; // 생성일 변수선언//그리드 변수 초기화
    //동적 변수 선언
    var obj_G3_PJTID_valid = jQuery.parseJSON( '{ "G3_PJTID": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":30,  "DATATYPE":"STRING"} }' );
    //동적 변수 선언
    var obj_G3_PJTNM_valid = jQuery.parseJSON( '{ "G3_PJTNM": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":100,  "DATATYPE":"STRING"} }' );
    //동적 변수 선언
    var obj_G3_DELYN_valid = jQuery.parseJSON( '{ "G3_DELYN": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":1,  "DATATYPE":"STRING"} }' );
    //동적 변수 선언
    var obj_G3_ADDDT_valid = jQuery.parseJSON( '{ "G3_ADDDT": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":14,  "DATATYPE":"STRING"} }' );
    //동적 변수 선언
    var obj_G3_MODDT_valid = jQuery.parseJSON( '{ "G3_MODDT": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":14,  "DATATYPE":"STRING"} }' );
//Submit Action	
var url_G3_SEARCH = "cg_pjt2Control.php?CTLGRP=G3&CTLFNC=SEARCH";
//Submit Action	
var url_G3_SAVE = "cg_pjt2Control.php?CTLGRP=G3&CTLFNC=SAVE";
//Submit Action	
var url_G3_ROWDELETE = "cg_pjt2Control.php?CTLGRP=G3&CTLFNC=ROWDELETE";
//Submit Action	
var url_G3_ROWADD = "cg_pjt2Control.php?CTLGRP=G3&CTLFNC=ROWADD";
//Submit Action	
var url_G3_RELOAD = "cg_pjt2Control.php?CTLGRP=G3&CTLFNC=RELOAD";
//Submit Action	
var url_G3_EXCEL = "cg_pjt2Control.php?CTLGRP=G3&CTLFNC=EXCEL";
//그리드 객체
var mygridG3,addstatusynG3,lastinputG3,lastinputG3json,lastrowidG3;//그리드 변수 초기화
    //동적 변수 선언
    var obj_G4_PJTID_valid = jQuery.parseJSON( '{ "G4_PJTID": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":30,  "DATATYPE":"STRING"} }' );
    //동적 변수 선언
    var obj_G4_PGMID_valid = jQuery.parseJSON( '{ "G4_PGMID": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":20,  "DATATYPE":"STRING"} }' );
    //동적 변수 선언
    var obj_G4_PGMNM_valid = jQuery.parseJSON( '{ "G4_PGMNM": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":20,  "DATATYPE":"STRING"} }' );
    //동적 변수 선언
    var obj_G4_ADDDT_valid = jQuery.parseJSON( '{ "G4_ADDDT": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":14,  "DATATYPE":"STRING"} }' );
    //동적 변수 선언
    var obj_G4_MODDT_valid = jQuery.parseJSON( '{ "G4_MODDT": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":14,  "DATATYPE":"STRING"} }' );
//Submit Action	
var url_G4_SEARCH = "cg_pjt2Control.php?CTLGRP=G4&CTLFNC=SEARCH";
//Submit Action	
var url_G4_SAVE = "cg_pjt2Control.php?CTLGRP=G4&CTLFNC=SAVE";
//Submit Action	
var url_G4_ROWDELETE = "cg_pjt2Control.php?CTLGRP=G4&CTLFNC=ROWDELETE";
//Submit Action	
var url_G4_ROWADD = "cg_pjt2Control.php?CTLGRP=G4&CTLFNC=ROWADD";
//Submit Action	
var url_G4_RELOAD = "cg_pjt2Control.php?CTLGRP=G4&CTLFNC=RELOAD";
//Submit Action	
var url_G4_EXCEL = "cg_pjt2Control.php?CTLGRP=G4&CTLFNC=EXCEL";
//그리드 객체
var mygridG4,addstatusynG4,lastinputG4,lastinputG4json,lastrowidG4;//그리드 변수 초기화
    //동적 변수 선언
    var obj_G5_PJTID_valid = jQuery.parseJSON( '{ "G5_PJTID": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":30,  "DATATYPE":"STRING"} }' );
    //동적 변수 선언
    var obj_G5_COLID_valid = jQuery.parseJSON( '{ "G5_COLID": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":30,  "DATATYPE":"STRING"} }' );
    //동적 변수 선언
    var obj_G5_COLNM_valid = jQuery.parseJSON( '{ "G5_COLNM": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":30,  "DATATYPE":"STRING"} }' );
    //동적 변수 선언
    var obj_G5_COLSNM_valid = jQuery.parseJSON( '{ "G5_COLSNM": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":30,  "DATATYPE":"STRING"} }' );
    //동적 변수 선언
    var obj_G5_DATATYPE_valid = jQuery.parseJSON( '{ "G5_DATATYPE": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":30,  "DATATYPE":"STRING"} }' );
    //동적 변수 선언
    var obj_G5_DATASIZE_valid = jQuery.parseJSON( '{ "G5_DATASIZE": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":30,  "DATATYPE":"STRING"} }' );
    //동적 변수 선언
    var obj_G5_OBJTYPE_valid = jQuery.parseJSON( '{ "G5_OBJTYPE": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":30,  "DATATYPE":"STRING"} }' );
    //동적 변수 선언
    var obj_G5_LBLWIDTH_valid = jQuery.parseJSON( '{ "G5_LBLWIDTH": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":30,  "DATATYPE":"STRING"} }' );
    //동적 변수 선언
    var obj_G5_LBLHEIGHT_valid = jQuery.parseJSON( '{ "G5_LBLHEIGHT": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":30,  "DATATYPE":"STRING"} }' );
    //동적 변수 선언
    var obj_G5_OBJWIDTH_valid = jQuery.parseJSON( '{ "G5_OBJWIDTH": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":30,  "DATATYPE":"STRING"} }' );
    //동적 변수 선언
    var obj_G5_OBJHEIGHT_valid = jQuery.parseJSON( '{ "G5_OBJHEIGHT": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":30,  "DATATYPE":"STRING"} }' );
    //동적 변수 선언
    var obj_G5_OBJALIGN_valid = jQuery.parseJSON( '{ "G5_OBJALIGN": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":30,  "DATATYPE":"STRING"} }' );
//Submit Action	
var url_G5_SEARCH = "cg_pjt2Control.php?CTLGRP=G5&CTLFNC=SEARCH";
//Submit Action	
var url_G5_SAVE = "cg_pjt2Control.php?CTLGRP=G5&CTLFNC=SAVE";
//Submit Action	
var url_G5_ROWDELETE = "cg_pjt2Control.php?CTLGRP=G5&CTLFNC=ROWDELETE";
//Submit Action	
var url_G5_ROWADD = "cg_pjt2Control.php?CTLGRP=G5&CTLFNC=ROWADD";
//Submit Action	
var url_G5_RELOAD = "cg_pjt2Control.php?CTLGRP=G5&CTLFNC=RELOAD";
//Submit Action	
var url_G5_EXCEL = "cg_pjt2Control.php?CTLGRP=G5&CTLFNC=EXCEL";
//그리드 객체
var mygridG5,addstatusynG5,lastinputG5,lastinputG5json,lastrowidG5;//화면 초기화
function initBody(){
     alog("initBody()-----------------------start");
	
	var paramG1 = { xml : 1111 };
	var paramG2 = { xml : 2222 };
	var paramG3 = { width:1680, height:1050 };

	var params = { G1 : paramG1, G2 : paramG2, G3 : paramG3 };
	var str = jQuery.param( params );
	alert(str);

	$.ajax({
			type : "POST",
			url : "cg_test.php"  ,
			data : params,
			success: function(data){
				alog("   json return----------------------");
				alog("   json data : " + data);
			},
			error: function(error){
				msgError("Ajax http 500 error ( " + error + " )");
				alog("Ajax http 500 error ( " + error + " )");
			}
		});



   //dhtmlx 메시지 박스 초기화
   dhtmlx.message.position="bottom";
     G1_INIT();
	     G2_INIT();
	     G3_INIT();
	     G4_INIT();
	     G5_INIT();
	     alog("initBody()-----------------------end");
} //initBody()
//그룹별 초기화 함수
//버튼 초기화
function G1_INIT(){
 //비어있음
  alog("G1_INIT()-------------------------start	");
	
}
// CONDITIONInit//컨디션 초기화
function G2_INIT(){
  alog("G2_INIT()-------------------------start	");


//각 폼 오브젝트들 초기화  alog("G2_INIT()-------------------------end");
}

//PJT 그리드 초기화
function G3_INIT(){
  alog("G3_INIT()-------------------------start");

        //그리드 초기화
        mygridG3 = new dhtmlXGridObject('gridG3');
        mygridG3.setImagePath("./lib/dhtmlxSuite/codebase/imgs/");
		mygridG3.setUserData("","gridTitle","G3 : PJT"); //글로별 변수에 그리드 타이블 넣기
//헤더초기화
        mygridG3.setHeader("프로젝트ID,프로젝트명,삭제YN,UITOOL,SVRLANG,PKGROOT,ADDDT,수정일");
mygridG3.setColumnIds("PJTID,PJTNM,DELYN,UITOOL,SVRLANG,PKGROOT,ADDDT,MODDT");
mygridG3.setInitWidthsP("20,40,10,20,20,50,10,20");
mygridG3.setColTypes("ed,ed,ed,ed,ed,ed,ed,ed");
//mygridG3.setColSorting(",,,,");//렌더링
mygridG3.enableSmartRendering(false);
mygridG3.enableMultiselect(true);


//mygridG3.setColValidators("G3_PJTID,G3_PJTNM,G3_DELYN,G3_ADDDT,G3_MODDT");
  mygridG3.splitAt(0);//'freezes' 0 columns 
  mygridG3.init();
 // IO : 프로젝트ID초기화 // IO : 프로젝트명초기화 // IO : 삭제YN초기화 // IO : ADDDT초기화 // IO : 수정일초기화// ROW선택 이벤트
        mygridG3.attachEvent("onRowSelect",function(rowID,celInd){
              
             //GRIDRowSelect30(rowID,celInd);
			var ConAllData = $( "#condition" ).serialize();
			var RowAllData = getRowsColid(mygridG3,rowID,"G3");
			//A125
			lastinputG4 = ConAllData + RowAllData;
			//A125
			lastinputG5 = ConAllData + RowAllData;
			//A124
			lastinputG4json = jQuery.parseJSON('{ "__NAME":"lastinputG4json"' +
			', "PJTID" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("PJTID")).getValue()) + '"' +
			'}');
			lastinputG5json = jQuery.parseJSON('{ "__NAME":"lastinputG5json"' +
			', "PJTID" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("PJTID")).getValue()) + '"' +
			'}');
			G4_SEARCH(lastinputG4); //자식그룹 호출 : PGM
			G5_SEARCH(lastinputG5); //자식그룹 호출 : DD
		});

        mygridG3.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            alog("mygridG3  onEditCell ------------------start");
            alog("       stage : " + stage);
            alog("       rId : " + rId);
            alog("       cInd : " + cInd);
            alog("       nValue : " + nValue);
            alog("       oValue : " + oValue);

            RowEditStatus = mygridG3.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygridG3.setUserData(rId,"!nativeeditor_status","updated");
                    mygridG3.setRowTextBold(rId);
                }
                mygridG3.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

        });
        alog("G3_INIT()-------------------------end");
     }

//PGM 그리드 초기화
function G4_INIT(){
  alog("G4_INIT()-------------------------start");

        //그리드 초기화
        mygridG4 = new dhtmlXGridObject('gridG4');
        mygridG4.setImagePath("./lib/dhtmlxSuite/codebase/imgs/");
		mygridG4.setUserData("","gridTitle","G4 : PGM"); //글로별 변수에 그리드 타이블 넣기
//헤더초기화
        mygridG4.setHeader("프로젝트ID,프로그램ID,프로그램이름,PKGGRP,ADDDT,MODDT");
mygridG4.setColumnIds("PJTID,PGMID,PGMNM,PKGGRP,ADDDT,MODDT");
mygridG4.setInitWidths("100,100,100,100,100,100");
mygridG4.setColTypes("ed,ed,ed,ed,ed,ed");
mygridG4.setColSorting("str,str,str,str,str,str");//렌더링
mygridG4.enableSmartRendering(false);
mygridG4.enableMultiselect(true);


//mygridG4.setColValidators("G4_PJTID,G4_PGMID,G4_PGMNM,G4_ADDDT,G4_MODDT");
  mygridG4.splitAt(0);//'freezes' 0 columns 
  mygridG4.init();
 // IO : 프로젝트ID초기화 // IO : 프로그램ID초기화 // IO : 프로그램이름초기화 // IO : ADDDT초기화 // IO : MODDT초기화// ROW선택 이벤트
        mygridG4.attachEvent("onRowSelect",function(rowID,celInd){
              
             //GRIDRowSelect40(rowID,celInd);
var ConAllData = $( "#condition" ).serialize();
var RowAllData = getRowsColid(mygridG4,rowID,"G4");
//A124
});

        mygridG4.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            alog("mygridG4  onEditCell ------------------start");
            alog("       stage : " + stage);
            alog("       rId : " + rId);
            alog("       cInd : " + cInd);
            alog("       nValue : " + nValue);
            alog("       oValue : " + oValue);

            RowEditStatus = mygridG4.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygridG4.setUserData(rId,"!nativeeditor_status","updated");
                    mygridG4.setRowTextBold(rId);
                }
                mygridG4.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

        });
        alog("G4_INIT()-------------------------end");
     }

//DD 그리드 초기화
function G5_INIT(){
  alog("G5_INIT()-------------------------start");

        //그리드 초기화
        mygridG5 = new dhtmlXGridObject('gridG5');
        mygridG5.setImagePath("./lib/dhtmlxSuite/codebase/imgs/");
		mygridG5.setUserData("","gridTitle","G5 : DD"); //글로별 변수에 그리드 타이블 넣기
//헤더초기화
        mygridG5.setHeader("PJTID,컬럼ID,컬럼명,단축명,데이터타입,데이터사이즈,오브젝트타입,라벨가로,가벨세로,오브젝트가로,오브젝트세로,가로정렬,ADDDT,MODDT");
mygridG5.setColumnIds("PJTID,COLID,COLNM,COLSNM,DATATYPE,DATASIZE,OBJTYPE,LBLWIDTH,LBLHEIGHT,OBJWIDTH,OBJHEIGHT,OBJALIGN,ADDDT,MODDT");
mygridG5.setInitWidths("100,100,100,100,100,100,100,100,100,100,100,100,60,60");
mygridG5.setColTypes("ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,ro,ro");
mygridG5.setColSorting("str,str,str,str,str,str,str,str,str,str,str,str,str,str");//렌더링
mygridG5.enableSmartRendering(false);
mygridG5.enableMultiselect(true);


//mygridG5.setColValidators("G5_PJTID,G5_COLID,G5_COLNM,G5_COLSNM,G5_DATATYPE,G5_DATASIZE,G5_OBJTYPE,G5_LBLWIDTH,G5_LBLHEIGHT,G5_OBJWIDTH,G5_OBJHEIGHT,G5_OBJALIGN");
  mygridG5.splitAt(0);//'freezes' 0 columns 
  mygridG5.init();
 // IO : PJTID초기화 // IO : 컬럼ID초기화 // IO : 컬럼명초기화 // IO : 단축명초기화 // IO : 데이터타입초기화 // IO : 데이터사이즈초기화 // IO : 오브젝트타입초기화 // IO : 라벨가로초기화 // IO : 가벨세로초기화 // IO : 오브젝트가로초기화 // IO : 오브젝트세로초기화 // IO : 가로정렬초기화// ROW선택 이벤트
        mygridG5.attachEvent("onRowSelect",function(rowID,celInd){
              
             //GRIDRowSelect50(rowID,celInd);
var ConAllData = $( "#condition" ).serialize();
var RowAllData = getRowsColid(mygridG5,rowID,"G5");
//A124
});

        mygridG5.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            alog("mygridG5  onEditCell ------------------start");
            alog("       stage : " + stage);
            alog("       rId : " + rId);
            alog("       cInd : " + cInd);
            alog("       nValue : " + nValue);
            alog("       oValue : " + oValue);

            RowEditStatus = mygridG5.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygridG5.setUserData(rId,"!nativeeditor_status","updated");
                    mygridG5.setRowTextBold(rId);
                }
                mygridG5.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

        });
        alog("G5_INIT()-------------------------end");
     }

//그룹별 기능 함수 출력//조회 1
function G1_BTNCLICK(){
   alog("G1_BTNCLICK()--------------------------start");
   SEARCHALL();   alog("G1_BTNCLICK()--------------------------end");

}
// CONDITIONSearch
    function SEARCHALL(){
        alog("G2_SEARCHALL--------------------------start");
//입력값검증
        //폼의 모든값 구하기
        var ConAllData = $( "#condition" ).serialize();
        alog("ConAllData:" + ConAllData);
lastinputG3 = ConAllData ;
//json : G2
            lastinputG3json = jQuery.parseJSON('{ "__NAME":"lastinputG3json"' +'}');
//  호출
G3_SEARCH(lastinputG3);
        alog("G2_SEARCHALL--------------------------end");
}
    function G3_ROWDELETE(){
        alog("G3_ROWDELETE()------------start");
        delRow(mygridG3);
        alog("G3_ROWDELETE()------------start");
    }
//엑셀다운
function G3_EXCEL(){
  alog("G3_EXCEL-----------------start");
}




function G1_SAVE(){
	alog("G1_SAVE()------------start");


	//컨디션 가져오기
	var ConAllData = $( "#condition" ).serialize();
	alog("   ConAllData = " + ConAllData);

	//그리드G3 가져오기
    mygridG3.setSerializationLevel(true,false,false,false,true,false);
    var myXmlStringG3 = mygridG3.serialize();        //컨디션 데이터 모두 말기

    mygridG4.setSerializationLevel(true,false,false,false,true,false);
    var myXmlStringG4 = mygridG4.serialize();        //컨디션 데이터 모두 말기

    mygridG5.setSerializationLevel(true,false,false,false,true,false);
    var myXmlStringG5 = mygridG5.serialize();        //컨디션 데이터 모두 말기
	
	var params = { G3_XML : myXmlStringG3, G4_XML : myXmlStringG4, G5_XML : myXmlStringG5, G2_PJTID : $("#G2_PJTID").val() };

	$.ajax({
		type : "POST",
		url : url_G1_SAVE  ,
		data : params,
		dataType: "json",
		async: false,
		success: function(data){
			alog("   json return----------------------");
			alog("   json data : " + data);
			alog("   json RTN_CD : " + data.RTN_CD);
			alog("   json ERR_CD : " + data.ERR_CD);
			//alog("   json RTN_MSG length : " + data.RTN_MSG.length);

			//그리드에 데이터 반영
			saveToGroup(data);

		},
		error: function(error){
			msgError("Ajax http 500 error ( " + error + " )");
			alog("Ajax http 500 error ( " + error + " )");
		}
	});
	addstatusyn2 = false;
	alog("G1_SAVE()------------end");
}


function G3_SAVE(){
	alog("save1()------------start");
	tgrid = mygridG3;
    
    tgrid.setSerializationLevel(true,false,false,false,true,false);
    var myXmlString = tgrid.serialize();        //컨디션 데이터 모두 말기
        var ConAllData = $( "#condition" ).serialize();
        alog("   ConAllData = " + ConAllData);
        $.ajax({
            type : "POST",
            url : url_G3_SAVE + "&" + lastinputG3 ,
            data : { G3_XML : myXmlString},
            dataType: "json",
            async: false,
            success: function(data){
                alog("   json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                saveToGroup(data);

            },
            error: function(error){
				msgError("Ajax http 500 error ( " + error + " )");
                alog("Ajax http 500 error ( " + error + " )");
            }
        });
        addstatusyn2 = false;
        alog("G3_SAVE()------------end");
}

//새로고침
function G3_RELOAD(){
  alog("G3_RELOAD-----------------start");
  G3_SEARCH(lastinputG3);
}
    //그리드 조회(PJT)
    function G3_SEARCH(tinput){
        alog("gridSearchG3()------------start");

		var tGrid = mygridG3;

        //그리드 초기화
        tGrid.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : url_G3_SEARCH+"&G3_CRUD_MODE=read&" + tinput ,
            data : tinput,
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridSearch6 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
					var row_cnt = 0;
					if(data.RTN_DATA){
						tGrid.parse(data.RTN_DATA,"json");
						row_cnt = data.RTN_DATA.rows.length;
					}
					msgNotice("[PJT] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[PJT] 서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[PJT] Ajax http 500 error ( " + error + " )",3);
                alog("[PJT] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearchG3()------------end");
    }
//행추가3 (PJT)
//그리드 행추가 : PJT
	function G3_ROWADD(){
		if( !(lastinputG3json)){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = ["","","","","",""];//초기값
			addRow(mygridG3,tCols);
		}
	}    function G4_ROWDELETE(){
        alog("G4_ROWDELETE()------------start");
        delRow(mygridG4);
        alog("G4_ROWDELETE()------------start");
    }
//엑셀다운
function G4_EXCEL(){
  alog("G4_EXCEL-----------------start");
}
    function G4_SAVE(){
	alog("save1()------------start");
	tgrid = mygridG4;
    
    tgrid.setSerializationLevel(true,false,false,false,true,false);
    var myXmlString = tgrid.serialize();        //컨디션 데이터 모두 말기
        var ConAllData = $( "#condition" ).serialize();
        alog("   ConAllData = " + ConAllData);
        $.ajax({
            type : "POST",
            url : url_G4_SAVE + "&" + lastinputG4 ,
            data : { G4_XML : myXmlString},
            dataType: "json",
            async: false,
            success: function(data){
                alog("   json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                saveToGroup(data);

            },
            error: function(error){
				msgError("Ajax http 500 error ( " + error + " )");
                alog("Ajax http 500 error ( " + error + " )");
            }
        });
        addstatusyn2 = false;
        alog("G4_SAVE()------------end");
    }
//새로고침
function G4_RELOAD(){
  alog("G4_RELOAD-----------------start");
  G4_SEARCH(lastinputG4);
}
    //그리드 조회(PGM)
    function G4_SEARCH(tinput){
        alog("gridSearchG4()------------start");

		var tGrid = mygridG4;

        //그리드 초기화
        tGrid.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : url_G4_SEARCH+"&G4_CRUD_MODE=read&" + tinput ,
            data : tinput,
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridSearch6 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
					var row_cnt = 0;
					if(data.RTN_DATA){
						tGrid.parse(data.RTN_DATA,"json");
						row_cnt = data.RTN_DATA.rows.length;
					}
					msgNotice("[PGM] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[PGM] 서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[PGM] Ajax http 500 error ( " + error + " )",3);
                alog("[PGM] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearchG4()------------end");
    }
//행추가3 (PGM)
//그리드 행추가 : PGM
	function G4_ROWADD(){
		if( !(lastinputG4json)|| !(lastinputG4json.PJTID) ){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = [lastinputG4json.PJTID,"","","",""];//초기값
			addRow(mygridG4,tCols);
		}
	}//행추가3 (DD)
//그리드 행추가 : DD
	function G5_ROWADD(){
		if( !(lastinputG5json)|| !(lastinputG5json.PJTID) ){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = [lastinputG5json.PJTID,"","","","","","","","","","",""];//초기값
			addRow(mygridG5,tCols);
		}
	}    function G5_ROWDELETE(){
        alog("G5_ROWDELETE()------------start");
        delRow(mygridG5);
        alog("G5_ROWDELETE()------------start");
    }
//엑셀다운
function G5_EXCEL(){
  alog("G5_EXCEL-----------------start");
}
    function G5_SAVE(){
	alog("save1()------------start");
	tgrid = mygridG5;
    
    tgrid.setSerializationLevel(true,false,false,false,true,false);
    var myXmlString = tgrid.serialize();        //컨디션 데이터 모두 말기
        var ConAllData = $( "#condition" ).serialize();
        alog("   ConAllData = " + ConAllData);
        $.ajax({
            type : "POST",
            url : url_G5_SAVE + "&" + lastinputG5 ,
            data : { G5_XML : myXmlString},
            dataType: "json",
            async: false,
            success: function(data){
                alog("   json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                saveToGroup(data);

            },
            error: function(error){
				msgError("Ajax http 500 error ( " + error + " )");
                alog("Ajax http 500 error ( " + error + " )");
            }
        });
        addstatusyn2 = false;
        alog("G5_SAVE()------------end");
    }
//새로고침
function G5_RELOAD(){
  alog("G5_RELOAD-----------------start");
  G5_SEARCH(lastinputG5);
}
    //그리드 조회(DD)
    function G5_SEARCH(tinput){
        alog("gridSearchG5()------------start");

		var tGrid = mygridG5;

        //그리드 초기화
        tGrid.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : url_G5_SEARCH+"&G5_CRUD_MODE=read&" + tinput ,
            data : tinput,
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridSearch6 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
					var row_cnt = 0;
					if(data.RTN_DATA){
						tGrid.parse(data.RTN_DATA,"json");
						row_cnt = data.RTN_DATA.rows.length;
					}
					msgNotice("[DD] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[DD] 서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[DD] Ajax http 500 error ( " + error + " )",3);
                alog("[DD] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearchG5()------------end");
    }
</script></head><body onload="initBody();">

<div id="BODY_BOX" class="BODY_BOX"><!--그룹별 IO출력--><div  class="GRID_LABELGRP" ><div class="GRID_LABEL" >디테일 프로그램2</div><div  class="GRID_LABELBTN"  ><input type="button" name="BTN_G1_SAVE" value="저장" onclick="G1_SAVE();"><input type="button" name="BTN_G1_NEW" value="신규" onclick="G1_NEW();"><input type="button" name="BTN_G1_MODIFY" value="수정" onclick="G1_MODIFY();"><input type="button" name="BTN_G1_DELETE" value="삭제" onclick="G1_DELETE();"><input type="button" name="BTN_G1_BTNCLICK" value="조회(BTN)" onclick="G1_BTNCLICK();"></div></div><div class="GRP_OBJECT" style="width:100%;height:50px;">
  <div style="width:0px;height:0px;overflow: hidden"><form id="condition"></div><div style="height:30px;" class="CONDITION_OBJECT"><!--컨디션 IO리스트--><div class="CON_OBJGRP" style=""><div class="CON_LABEL" style="width:100;">프로젝트ID</div><div class="CON_OBJECT" style="width:100;"><input type="text" name="G2_PJTID" value="" id="G2_PJTID" style="width:100%;"></div></div><div class="CON_OBJGRP" style=""><div class="CON_LABEL" style="width:100;">생성일</div><div class="CON_OBJECT" style="width:100;"><div class="CON_OBJECT" style="width:100;"></div></div></div><div style="width:0px;height:0px;overflow: hidden"></form></div>    </div><div class="GRP_OBJECT" style="width:50%;height:200px;"><div  class="GRID_LABELGRP">
  <div id="div_grid4_GRID_LABEL"class="GRID_LABEL" >PJT            </div><div id="div_grid30_GRID_LABELBTN" class="GRID_LABELBTN"  style="">                <input type="button" name="BTN_G3_SAVE" value="저장" onclick="G3_SAVE();"><input type="button" name="BTN_G3_ROWDELETE" value="행삭제" onclick="G3_ROWDELETE();"><input type="button" name="BTN_G3_ROWADD" value="행추가" onclick="G3_ROWADD();"><input type="button" name="BTN_G3_RELOAD" value="새로고침" onclick="G3_RELOAD();"><input type="button" name="BTN_G3_EXCEL" value="엑셀다운로드" onclick="G3_EXCEL();"></div></div><div  class="GRID_OBJECT"  style=""><div id="gridG3"  style="background-color:white;overflow:hidden;height:178px;width:100%;"></div></div></div><div class="GRP_OBJECT" style="width:50%;height:200px;"><div  class="GRID_LABELGRP">
  <div id="div_grid4_GRID_LABEL"class="GRID_LABEL" >PGM            </div><div id="div_grid40_GRID_LABELBTN" class="GRID_LABELBTN"  style="">                <input type="button" name="BTN_G4_EXCEL" value="엑셀다운로드" onclick="G4_EXCEL();"><input type="button" name="BTN_G4_ROWDELETE" value="행삭제" onclick="G4_ROWDELETE();"><input type="button" name="BTN_G4_ROWADD" value="행추가" onclick="G4_ROWADD();"><input type="button" name="BTN_G4_RELOAD" value="새로고침" onclick="G4_RELOAD();"><input type="button" name="BTN_G4_SAVE" value="저장" onclick="G4_SAVE();"></div></div><div  class="GRID_OBJECT"  style=""><div id="gridG4"  style="background-color:white;overflow:hidden;height:178px;width:100%;"></div></div></div><div class="GRP_OBJECT" style="width:100%;height:200px;"><div  class="GRID_LABELGRP">
  <div id="div_grid4_GRID_LABEL"class="GRID_LABEL" >DD            </div><div id="div_grid50_GRID_LABELBTN" class="GRID_LABELBTN"  style="">                <input type="button" name="BTN_G5_EXCEL" value="엑셀다운로드" onclick="G5_EXCEL();"><input type="button" name="BTN_G5_ROWDELETE" value="행삭제" onclick="G5_ROWDELETE();"><input type="button" name="BTN_G5_ROWADD" value="행추가" onclick="G5_ROWADD();"><input type="button" name="BTN_G5_RELOAD" value="새로고침" onclick="G5_RELOAD();"><input type="button" name="BTN_G5_SAVE" value="저장" onclick="G5_SAVE();"></div></div><div  class="GRID_OBJECT"  style=""><div id="gridG5"  style="background-color:white;overflow:hidden;height:178px;width:100%;"></div></div></div>

	<div class="CON_LINE">aa<input type="text" id="tinput"><input type=button value="go" onclick="alert($('#tinput').val());mygridG4.setUserData($('#tinput').val(),'!nativeeditor_status','');alert(mygridG4.getUserData($('#tinput').val(),'!nativeeditor_status'))"><input type=button value="go2" onclick="clearRowChanged(mygridG4,$('#tinput').val());">
	<textarea style="width:100%;height:150px" id="tarea"></textarea>
	<input type=button value="get" onclick="$('#tarea').val(mygridG4.serialize());">
	</div>

</div>
</body>
</html>
