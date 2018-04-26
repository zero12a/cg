<?php
header("Content-Type: text/html; charset=UTF-8"); //HTML
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>	
<title>에러 관리</title>
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
<!--CSS/JS 불러오기-->
<script src="../lib/jquery-1.11.1.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY CORE-->
<script src="../lib/jquery-1.11.1.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY CORE-->
<script src="../lib/json2.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY JSON-->
<script src="../lib/dhtmlxSuite/codebase/dhtmlx.js" type="text/javascript" charset="UTF-8"></script> <!--DHTMLX CORE-->
<script src="/c.g/rst/cg_common.js" type="text/javascript" charset="UTF-8"></script> <!--DHTMLX EXT-->
<link rel="stylesheet" href="../lib/dhtmlxSuite/codebase/dhtmlx.css" type="text/css" charset="UTF-8"><!--DHTMLX CORE-->
<script>//글로벌 변수 선언
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SAVE = "errmngController.php?CTLGRP=G1&CTLFNC=SAVE";//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_NEW = "errmngController.php?CTLGRP=G1&CTLFNC=NEW";//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_MODIFY = "errmngController.php?CTLGRP=G1&CTLFNC=MODIFY";//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_DELETE = "errmngController.php?CTLGRP=G1&CTLFNC=DELETE";//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_BTNCLICK = "errmngController.php?CTLGRP=G1&CTLFNC=BTNCLICK";// 변수 선언
//그리드 변수 초기화
    //동적 변수 선언
    var obj_G3_ERRLOGSEQ_valid = jQuery.parseJSON( '{ "G3_ERRLOGSEQ": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":0,  "DATATYPE":""} }' );
    //동적 변수 선언
    var obj_G3_SESSIONID_valid = jQuery.parseJSON( '{ "G3_SESSIONID": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":0,  "DATATYPE":""} }' );
    //동적 변수 선언
    var obj_G3_REQID_valid = jQuery.parseJSON( '{ "G3_REQID": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":0,  "DATATYPE":""} }' );
    //동적 변수 선언
    var obj_G3_ERRNO_valid = jQuery.parseJSON( '{ "G3_ERRNO": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":0,  "DATATYPE":""} }' );
    //동적 변수 선언
    var obj_G3_ERRCD_valid = jQuery.parseJSON( '{ "G3_ERRCD": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":0,  "DATATYPE":""} }' );
    //동적 변수 선언
    var obj_G3_ERRSTR_valid = jQuery.parseJSON( '{ "G3_ERRSTR": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":0,  "DATATYPE":""} }' );
    //동적 변수 선언
    var obj_G3_ERRFILE_valid = jQuery.parseJSON( '{ "G3_ERRFILE": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":0,  "DATATYPE":""} }' );
    //동적 변수 선언
    var obj_G3_ERRLINE_valid = jQuery.parseJSON( '{ "G3_ERRLINE": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":0,  "DATATYPE":""} }' );
    //동적 변수 선언
    var obj_G3_ERRCONTEXT_valid = jQuery.parseJSON( '{ "G3_ERRCONTEXT": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":0,  "DATATYPE":""} }' );
    //동적 변수 선언
    var obj_G3_ADDDT_valid = jQuery.parseJSON( '{ "G3_ADDDT": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":0,  "DATATYPE":""} }' );
    //동적 변수 선언
    var obj_G3_MODDT_valid = jQuery.parseJSON( '{ "G3_MODDT": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":0,  "DATATYPE":""} }' );
//컨트롤러 경로
var url_G3_USERDEF = "errmngController.php?CTLGRP=G3&CTLFNC=USERDEF";
//컨트롤러 경로
var url_G3_SEARCH = "errmngController.php?CTLGRP=G3&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G3_SAVE = "errmngController.php?CTLGRP=G3&CTLFNC=SAVE";
//컨트롤러 경로
var url_G3_ROWDELETE = "errmngController.php?CTLGRP=G3&CTLFNC=ROWDELETE";
//컨트롤러 경로
var url_G3_ROWADD = "errmngController.php?CTLGRP=G3&CTLFNC=ROWADD";
//컨트롤러 경로
var url_G3_RELOAD = "errmngController.php?CTLGRP=G3&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G3_EXCEL = "errmngController.php?CTLGRP=G3&CTLFNC=EXCEL";
//그리드 객체
var mygridG3,addstatusynG3,lastinputG3,lastinputG3json,lastrowidG3;//디테일 변수 초기화

var obj_G4_SESSIONID_valid = jQuery.parseJSON( '{ "G4_SESSIONID": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":10,  "DATATYPE":"STRING"} }' );   // SESSIONID 밸리데이션 선언
var obj_G4_ERRCD_valid = jQuery.parseJSON( '{ "G4_ERRCD": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":10,  "DATATYPE":"STRING"} }' );   // ERRCD 밸리데이션 선언
var obj_G4_ERRFILE_valid = jQuery.parseJSON( '{ "G4_ERRFILE": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":200,  "DATATYPE":"STRING"} }' );   // 에러파일 밸리데이션 선언
//폼뷰 컨트롤러 경로
var url_G4_SEARCH = "errmngController.php?CTLGRP=G4&CTLFNC=SEARCH";
//폼뷰 컨트롤러 경로
var url_G4_SAVE = "errmngController.php?CTLGRP=G4&CTLFNC=SAVE";
//폼뷰 컨트롤러 경로
var url_G4_RELOAD = "errmngController.php?CTLGRP=G4&CTLFNC=RELOAD";
//폼뷰 컨트롤러 경로
var url_G4_NEW = "errmngController.php?CTLGRP=G4&CTLFNC=NEW";
//폼뷰 컨트롤러 경로
var url_G4_DELETE = "errmngController.php?CTLGRP=G4&CTLFNC=DELETE";
var obj_G4_SESSIONID;   // SESSIONID 글로벌 변수 선언
var obj_G4_ERRCD;   // ERRCD 글로벌 변수 선언
var obj_G4_ERRFILE;   // 에러파일 글로벌 변수 선언
//화면 초기화
function initBody(){
     alog("initBody()-----------------------start");
	
   //dhtmlx 메시지 박스 초기화
   dhtmlx.message.position="bottom";
     G1_INIT();
	     G2_INIT();
	     G3_INIT();
	     G4_INIT();
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

//에러 그리드 초기화
function G3_INIT(){
  alog("G3_INIT()-------------------------start");

        //그리드 초기화
        mygridG3 = new dhtmlXGridObject('gridG3');
		mygridG3.setStyle(
			"text-align:center;margin:0px 0px 0px 0px;padding:0px 0px 0px 0px", "","color:red;", ""
		);
        mygridG3.setDateFormat("%Y%m%d");
        mygridG3.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG3.setUserData("","gridTitle","G3 : 에러"); //글로별 변수에 그리드 타이블 넣기
//헤더초기화
        mygridG3.setHeader("SEQ,SESSION,REQID,NO,CD,STR,FILE,LINE,CONTEXT,ADD,MOD");
mygridG3.setColumnIds("ERRLOGSEQ,SESSIONID,REQID,ERRNO,ERRCD,ERRSTR,ERRFILE,ERRLINE,ERRCONTEXT,ADDDT,MODDT");
mygridG3.setColTypes("ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed");
//mygridG3.setColSorting(",,,,,,,,,,");//렌더링
mygridG3.enableSmartRendering(false);
mygridG3.enableMultiselect(true);


//mygridG3.setColValidators("G3_ERRLOGSEQ,G3_SESSIONID,G3_REQID,G3_ERRNO,G3_ERRCD,G3_ERRSTR,G3_ERRFILE,G3_ERRLINE,G3_ERRCONTEXT,G3_ADDDT,G3_MODDT");
  mygridG3.splitAt(0);//'freezes' 0 columns 
  mygridG3.init();
 // IO : SEQ초기화 // IO : SESSION초기화 // IO : REQID초기화 // IO : NO초기화 // IO : CD초기화 // IO : STR초기화 // IO : FILE초기화 // IO : LINE초기화 // IO : CONTEXT초기화 // IO : ADD초기화 // IO : MOD초기화// ROW선택 이벤트
        mygridG3.attachEvent("onRowSelect",function(rowID,celInd){
              
             //GRIDRowSelect20(rowID,celInd);
var ConAllData = $( "#condition" ).serialize();
var RowAllData = getRowsColid(mygridG3,rowID,"G3");
//A125
lastinputG4 = ConAllData + RowAllData;
//A124
lastinputG4json = jQuery.parseJSON('{ "__NAME":"lastinputG4json"' +
'}');
G4_SEARCH(lastinputG4); //자식그룹 호출 : 
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

//디테일 초기화
// 폼뷰 초기화
function G4_INIT(){
  alog("G4_INIT()-------------------------start");

setCodeCombo("FORMVIEW",$("#G4_ERRCD"),"PHPERRTYPE");

//컬럼 초기화
  alog("G4_INIT()-------------------------end");
}
//그룹별 기능 함수 출력//조회 
function G1_BTNCLICK(){
   alog("G1_BTNCLICK()--------------------------start");
   SEARCHALL();   alog("G1_BTNCLICK()--------------------------end");

}
//, 저장
function G1_SAVE(){
 alog("G1_SAVE-------------------start");
var params = { CTL : "G1_SAVE"};
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
			msgError("[G1] Ajax http 500 error ( " + error + " )");
			alog("[G1] Ajax http 500 error ( " + error + " )");
		}
	});
 alog("G1_SAVE-------------------end");
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
    function G3_ROWDELETE(){
        alog("G3_ROWDELETE()------------start");
        delRow(mygridG3);
        alog("G3_ROWDELETE()------------start");
    }
//새로고침
function G3_RELOAD(){
  alog("G3_RELOAD-----------------start");
  G3_SEARCH(lastinputG3);
}
//행추가3 (에러)
//그리드 행추가 : 에러
	function G3_ROWADD(){
		if( !(lastinputG3json)){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = ["","","","","","","","","","",""];//초기값
			addRow(mygridG3,tCols);
		}
	}//엑셀다운
function G3_EXCEL(){
  alog("G3_EXCEL-----------------start");
}
    //그리드 조회(에러)
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
					msgNotice("[에러] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[에러] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[에러] Ajax http 500 error ( " + error + " )",3);
                alog("[에러] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearchG3()------------end");
    }
//
function DETAILNew30(){
       alog("DETAILNew30---------------start");
$("#G4_CRUD_MODE").val("NEW");
//로직       alog("DETAILNew30---------------end");
}
function DETAILSave30(){
       alog("DETAILSave30---------------start");
    $.ajax({
        type : "POST",
        url : mygrid30_url +"&G4_CRUD_MODE="+ $("#G4_CRUD_MODE").val(),
        data : $( "#form30" ).serialize(),
        dataType: "json",
        success: function(data){
            alog(data);
            alert("정상적으로 저장되었습니다.");
        },
        error: function(error){
            alog("Error:");
            alog(error);
        }
    });
}
//디테일 검색
function G4_SEARCH(tinput){
       alog("(FORMVIEW) G4_SEARCH---------------start");


    $.ajax({
        type : "POST",
        url : url_G4_SEARCH+"&G4_CRUD_MODE=SEARCH&" ,
        data : tinput,
        dataType: "json",
        success: function(data){
            alog(data);

            //모드 변경하기
            $("#G4_CRUD_MODE").val("UPDATE");
			//SETVAL  가져와서 세팅
		$("#G4_SESSIONID").val(data.RTN_DATA.SESSIONID);//SESSIONID 변수세팅
$("#G4_ERRCD").val(data.RTN_DATA.ERRCD);//ERRCD 변수세팅
		$("#G4_ERRFILE").val(data.RTN_DATA.ERRFILE);//에러파일 오브젝트 값세팅
        },
        error: function(error){
            alog("Error:");
            alog(error);
        }
    });    alog("(FORMVIEW) G4_SEARCH---------------end");

}
</script></head><body onload="initBody();">

<div id="BODY_BOX" class="BODY_BOX"><!--그룹별 IO출력--><div  class="GRID_LABELGRP" ><div class="GRID_LABEL" >에러 관리</div><div  class="GRID_LABELBTN"  ><input type="button" name="BTN_G1_SAVE" value="저장" onclick="G1_SAVE();"><input type="button" name="BTN_G1_NEW" value="신규" onclick="G1_NEW();"><input type="button" name="BTN_G1_MODIFY" value="수정" onclick="G1_MODIFY();"><input type="button" name="BTN_G1_DELETE" value="삭제" onclick="G1_DELETE();"><input type="button" name="BTN_G1_BTNCLICK" value="조회(BTN)" onclick="G1_BTNCLICK();"></div></div><div class="GRP_OBJECT" style="width:100%;height:44px;">
  <div style="width:0px;height:0px;overflow: hidden"><form id="condition"></div><div style="height:24px;" class="CONDITION_OBJECT"><!--컨디션 IO리스트--></div><div style="width:0px;height:0px;overflow: hidden"></form></div>    </div><div class="GRP_OBJECT" style="width:70%;height:400px;"><div  class="GRID_LABELGRP">
  <div id="div_grid4_GRID_LABEL"class="GRID_LABEL" >에러            </div><div id="div_grid20_GRID_LABELBTN" class="GRID_LABELBTN"  style="">                <input type="button" name="BTN_G3_RELOAD" value="새로고침" onclick="G3_RELOAD();"><input type="button" name="BTN_G3_ROWDELETE" value="행삭제" onclick="G3_ROWDELETE();"><input type="button" name="BTN_G3_EXCEL" value="엑셀다운로드" onclick="G3_EXCEL();"><input type="button" name="BTN_G3_ROWADD" value="행추가" onclick="G3_ROWADD();"></div></div><div  class="GRID_OBJECT"  style=""><div id="gridG3"  style="background-color:white;overflow:hidden;height:378px;width:100%;"></div></div></div><div class="GRP_OBJECT" style="width:30%;height:400px;">            <div class="DETAIL_LABELGRP">
                <div class="DETAIL_LABEL"  style=""></div> <div class="DETAIL_LABELBTN"  style=""><input type="button" name="New" value="New" onclick="DETAILNew30();">                </div>
</div>  <div style="height:358px;" class="DETAIL_OBJECT"><!--OBJECT LIST PRINT.--><div class="CON_OBJGRP" style=""><div class="CON_LABEL" style="width:100;">SESSIONID</div><div class="CON_OBJECT" style="width:60;"><input type="text" name="G4_SESSIONID" value="" id="G4_SESSIONID" style="width:60;"></div></div><div class="CON_OBJGRP" style=""><div class="CON_LABEL" style="width:100;">ERRCD</div><div class="CON_OBJECT" style="width:60;"><select id="G4_ERRCD" name="G4_ERRCD" style="width:60"></select>
</div></div><div class="CON_OBJGRP" style=""><div class="CON_LABEL" style="width:100;">에러파일</div><div class="CON_OBJECT" style="width:60;height:500"><textarea  name="G4_ERRFILE"  id="G4_ERRFILE" style="width:60;height:500"></textarea></div></div></div><div style="width:0px;height:0px;overflow: hidden"></form></div>    </div></div>



</body>
</html>
