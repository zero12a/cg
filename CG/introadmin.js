//글로벌 변수 선언	
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SEARCHALL = "introadminController?CTLGRP=G1&CTLFNC=SEARCHALL";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SAVE = "introadminController?CTLGRP=G1&CTLFNC=SAVE";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_RESET = "introadminController?CTLGRP=G1&CTLFNC=RESET";
//조건 변수 선언	
var obj_G1_FROM_DT; // FROM_DT 변수선언
var obj_G1_TO_DT; // TO_DT 변수선언
//디테일 변수 초기화	

//폼뷰 컨트롤러 경로
var url_G2_SEARCH = "introadminController?CTLGRP=G2&CTLFNC=SEARCH";
//폼뷰 컨트롤러 경로
var url_G2_SAVE = "introadminController?CTLGRP=G2&CTLFNC=SAVE";
//폼뷰 컨트롤러 경로
var url_G2_RELOAD = "introadminController?CTLGRP=G2&CTLFNC=RELOAD";
//폼뷰 컨트롤러 경로
var url_G2_NEW = "introadminController?CTLGRP=G2&CTLFNC=NEW";
var obj_G2_FROM_DT;   // FROM_DT 글로벌 변수 선언
var obj_G2_TO_DT;   // ~ 글로벌 변수 선언
var obj_G2_CFM_DESC;   // CFM_DESC 글로벌 변수 선언
//그리드 변수 초기화	
//컨트롤러 경로
var url_G8_SEARCH = "introadminController?CTLGRP=G8&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G8_RELOAD = "introadminController?CTLGRP=G8&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G8_EXCEL = "introadminController?CTLGRP=G8&CTLFNC=EXCEL";
//그리드 객체
var mygridG8,isToggleHiddenColG8,lastinputG8,lastinputG8json,lastrowidG8;
var lastselectG8json;//그리드 변수 초기화	
//컨트롤러 경로
var url_G3_SEARCH = "introadminController?CTLGRP=G3&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G3_RELOAD = "introadminController?CTLGRP=G3&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G3_EXCEL = "introadminController?CTLGRP=G3&CTLFNC=EXCEL";
//그리드 객체
var mygridG3,isToggleHiddenColG3,lastinputG3,lastinputG3json,lastrowidG3;
var lastselectG3json;//그리드 변수 초기화	
//컨트롤러 경로
var url_G4_SEARCH = "introadminController?CTLGRP=G4&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G4_RELOAD = "introadminController?CTLGRP=G4&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G4_EXCEL = "introadminController?CTLGRP=G4&CTLFNC=EXCEL";
//그리드 객체
var mygridG4,isToggleHiddenColG4,lastinputG4,lastinputG4json,lastrowidG4;
var lastselectG4json;//그리드 변수 초기화	
//컨트롤러 경로
var url_G6_SEARCH = "introadminController?CTLGRP=G6&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G6_RELOAD = "introadminController?CTLGRP=G6&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G6_EXCEL = "introadminController?CTLGRP=G6&CTLFNC=EXCEL";
//그리드 객체
var mygridG6,isToggleHiddenColG6,lastinputG6,lastinputG6json,lastrowidG6;
var lastselectG6json;//그리드 변수 초기화	
//컨트롤러 경로
var url_G7_SEARCH = "introadminController?CTLGRP=G7&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G7_RELOAD = "introadminController?CTLGRP=G7&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G7_EXCEL = "introadminController?CTLGRP=G7&CTLFNC=EXCEL";
//그리드 객체
var mygridG7,isToggleHiddenColG7,lastinputG7,lastinputG7json,lastrowidG7;
var lastselectG7json;//그리드 변수 초기화	
//컨트롤러 경로
var url_G9_SEARCH = "introadminController?CTLGRP=G9&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G9_RELOAD = "introadminController?CTLGRP=G9&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G9_EXCEL = "introadminController?CTLGRP=G9&CTLFNC=EXCEL";
//그리드 객체
var mygridG9,isToggleHiddenColG9,lastinputG9,lastinputG9json,lastrowidG9;
var lastselectG9json;//화면 초기화	
function initBody(){
     alog("initBody()-----------------------start");
	
   //dhtmlx 메시지 박스 초기화
   dhtmlx.message.position="bottom";
	G1_INIT();	
		G2_INIT();	
		G8_INIT();	
		G3_INIT();	
		G4_INIT();	
		G6_INIT();	
		G7_INIT();	
		G9_INIT();	
	      feather.replace();
	alog("initBody()-----------------------end");
} //initBody()	
//팝업띄우기		
	//팝업창 오픈요청
function goGridPopOpen(tGrpId,tRowId,tColIndex,tValue,tText){
	alog("goGridPopOpen()............. tGrpId = " + tGrpId + ", tRowId = " + tRowId + ", tColIndex = " + tColIndex + ", tValue = " + tValue + ", tText = " + tText);
	
	tColId = mygridG2.getColumnId(tColIndex);
	
	//PGMGRP ,  	
}
function goFormPopOpen(tGrpId, tColId, tColId_Nm){
	alog("goFormviewPopOpen()............. tGrpId = " + tGrpId + ", tColId = " + tColId + ", tColId_Nm = " +tColId_Nm );
	
	tColId_Val = $("#" + tColId).val();
	tColId_Nm_Text = $("#" + tColId_Nm).text();
	//PGMGRP ,  	
}// goFormviewPopOpen
//부모창 리턴용//팝업창에서 받을 내용
function popReturn(tGrpId,tRowId,tColId,tBtnNm,tJsonObj){
	//alert("popReturn");
		//, 

}//popReturn
//그룹별 초기화 함수	
// CONDITIONInit	//컨디션 초기화
function G1_INIT(){
  alog("G1_INIT()-------------------------start	");
$("#G1-FROM_DT").val(moment().add(-30, 'days').format("YYYY.MM.DD"));

$("#G1-TO_DT").val(moment().format("YYYY.MM.DD"));
	//각 폼 오브젝트들 초기화
	//달력 FROM_DT, FROM_DT
	$( "#G1-FROM_DT" ).datepicker(dateFormatJson);
	//달력 TO_DT, TO_DT
	$( "#G1-TO_DT" ).datepicker(dateFormatJson);
  alog("G1_INIT()-------------------------end");
}

//디테일 초기화	
//월점검 폼뷰 초기화
function G2_INIT(){
  alog("G2_INIT()-------------------------start");



	//컬럼 초기화
	//달력 FROM_DT, FROM_DT
	$( "#G2-FROM_DT" ).datepicker(dateFormatJson);
	//달력 TO_DT, ~
	$( "#G2-TO_DT" ).datepicker(dateFormatJson);
	//CFM_DESC, CFM_DESC 초기화	
  alog("G2_INIT()-------------------------end");
}
	//월점검목록 그리드 초기화
function G8_INIT(){
  alog("G8_INIT()-------------------------start");

        //그리드 초기화
        mygridG8 = new dhtmlXGridObject('gridG8');
        mygridG8.setDateFormat("%Y%m%d");
        mygridG8.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG8.setUserData("","gridTitle","G8 : 월점검목록"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG8.setHeader("CFM_SEQ,FROM_DT,TO_DT,CFM_DESC,ADD,ADD_ID");
		mygridG8.setColumnIds("CFM_SEQ,FROM_DT,TO_DT,CFM_DESC,ADD_DT,ADD_ID");
		mygridG8.setInitWidths("60,100,100,100,60,60");
		mygridG8.setColTypes("ro,ro,ro,ro,ro,ro");
	//가로 정렬	
		mygridG8.setColAlign("left,left,left,left,left,left");
		mygridG8.setColSorting("str,str,str,str,str,str");		//렌더링	
		mygridG8.enableSmartRendering(false);
		mygridG8.enableMultiselect(true);
		//mygridG8.setColValidators("G8_CFM_SEQ,G8_FROM_DT,G8_TO_DT,G8_CFM_DESC,G8_ADD_DT,G8_ADD_ID");
		mygridG8.splitAt(0);//'freezes' 0 columns 
		mygridG8.init();

		mygridG8.attachEvent("onDhxCalendarCreated", function(myCal){ myCal.loadUserLanguage( "kr" ); });
		//블럭선택 및 복사
		mygridG8.enableBlockSelection(true);
		mygridG8.attachEvent("onKeyPress",function(code,ctrl,shift){
			alog("onKeyPress.......code=" + code + ", ctrl=" + ctrl + ", shift=" + shift);

			//셀편집모드 아닐때만 블록처리
			if(!mygridG8.editor){
				mygridG8.setCSVDelimiter("	");
				if(code==67&&ctrl){
					mygridG8.copyBlockToClipboard();

					var top_row_idx = mygridG8.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG8.getSelectedBlock().RightBottomRow;
					var copyRowCnt = bottom_row_idx-top_row_idx+1;
					msgNotice( copyRowCnt + "개의 행이 클립보드에 복사되었습니다.",2);

				}
				if(code==86&&ctrl){
					mygridG8.pasteBlockFromClipboard();

					//row상태 변경
					var top_row_idx = mygridG8.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG8.getSelectedBlock().RightBottomRow;
					for(j=top_row_idx;j<=bottom_row_idx;j++){
						var rowID = mygridG8.getRowId(j);
						RowEditStatus = mygridG8.getUserData(rowID,"!nativeeditor_status");
						if(RowEditStatus == ""){
							mygridG8.setUserData(rowID,"!nativeeditor_status","updated");
							mygridG8.setRowTextBold(rowID);
						}
					}
				}
				return true;
			}else{
				return false;
			}
		});
		 // IO : CFM_SEQ초기화	
		 // IO : FROM_DT초기화	
		 // IO : TO_DT초기화	
		 // IO : CFM_DESC초기화	
		 // IO : ADD초기화	
		 // IO : ADD_ID초기화	
	//onCheck
		mygridG8.attachEvent("onCheck",function(rowId, cellInd, state){
			//onCheck is void return event
			alog(rowId + " is onCheck.");
			//일반 체크 박스는 변경이면 실제 row 변경
			if( 1 == 2 
				){
				RowEditStatus = mygridG8.getUserData(rowId,"!nativeeditor_status");
				if(RowEditStatus == ""){
					mygridG8.setUserData(rowId,"!nativeeditor_status","updated");
					mygridG8.setRowTextBold(rowId);
					mygridG8.cells(rowId,cellInd).cell.wasChanged = true;	
				}
			}
						
		});	
		// ROW선택 이벤트
		mygridG8.attachEvent("onRowSelect",function(rowID,celInd){
			RowEditStatus = mygridG8.getUserData(rowID,"!nativeeditor_status");
			if(RowEditStatus == "inserted"){return false;}
			//GRIDRowSelect25(rowID,celInd);
			//팝업오프너 호출
			//CD[필수], NM 정보가 있는 경우 팝업 오프너에게 값 전달
			popG8json = jQuery.parseJSON('{ "__NAME":"lastinputG3json"' +
			'}');

			if(popG8json && popG8json.CD){
				goOpenerReturn(popG8json);
				return;
			}
			//LAST SELECT ROW
			//lastselectG8json = jQuery.parseJSON('{ "__NAME":"lastinputG8json"' +
			//', "CFM_SEQ" : "' + q(mygridG8.cells(rowID,mygridG8.getColIndexById("CFM_SEQ")).getValue()) + '"' +
			//', "FROM_DT" : "' + q(mygridG8.cells(rowID,mygridG8.getColIndexById("FROM_DT")).getValue()) + '"' +
			//', "TO_DT" : "' + q(mygridG8.cells(rowID,mygridG8.getColIndexById("TO_DT")).getValue()) + '"' +
			//', "CFM_DESC" : "' + q(mygridG8.cells(rowID,mygridG8.getColIndexById("CFM_DESC")).getValue()) + '"' +
			//', "ADD_DT" : "' + q(mygridG8.cells(rowID,mygridG8.getColIndexById("ADD_DT")).getValue()) + '"' +
			//', "ADD_ID" : "' + q(mygridG8.cells(rowID,mygridG8.getColIndexById("ADD_ID")).getValue()) + '"' +
			//'}');
		//A124
		});
		mygridG8.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            alog("mygridG8  onEditCell ------------------start");
            alog("       stage : " + stage);
            alog("       rId : " + rId);
            alog("       cInd : " + cInd);
            alog("       nValue : " + nValue);
            alog("       oValue : " + oValue);

            RowEditStatus = mygridG8.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygridG8.setUserData(rId,"!nativeeditor_status","updated");
                    mygridG8.setRowTextBold(rId);
                }
                mygridG8.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

		});
        alog("G8_INIT()-------------------------end");
     }
	//로그인실패 그리드 초기화
function G3_INIT(){
  alog("G3_INIT()-------------------------start");

        //그리드 초기화
        mygridG3 = new dhtmlXGridObject('gridG3');
        mygridG3.setDateFormat("%Y%m%d");
        mygridG3.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG3.setUserData("","gridTitle","G3 : 로그인실패"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG3.setHeader("USR_ID,LOGIN_CNT");
		mygridG3.setColumnIds("USR_ID,LOGIN_CNT");
		mygridG3.setInitWidths("50,100");
		mygridG3.setColTypes("ro,ro");
	//가로 정렬	
		mygridG3.setColAlign("left,left");
		mygridG3.setColSorting("str,int");		//렌더링	
		mygridG3.enableSmartRendering(false);
		mygridG3.enableMultiselect(true);
		//mygridG3.setColValidators("G3_USR_ID,G3_LOGIN_CNT");
		mygridG3.splitAt(0);//'freezes' 0 columns 
		mygridG3.init();

		mygridG3.attachEvent("onDhxCalendarCreated", function(myCal){ myCal.loadUserLanguage( "kr" ); });
		//블럭선택 및 복사
		mygridG3.enableBlockSelection(true);
		mygridG3.attachEvent("onKeyPress",function(code,ctrl,shift){
			alog("onKeyPress.......code=" + code + ", ctrl=" + ctrl + ", shift=" + shift);

			//셀편집모드 아닐때만 블록처리
			if(!mygridG3.editor){
				mygridG3.setCSVDelimiter("	");
				if(code==67&&ctrl){
					mygridG3.copyBlockToClipboard();

					var top_row_idx = mygridG3.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG3.getSelectedBlock().RightBottomRow;
					var copyRowCnt = bottom_row_idx-top_row_idx+1;
					msgNotice( copyRowCnt + "개의 행이 클립보드에 복사되었습니다.",2);

				}
				if(code==86&&ctrl){
					mygridG3.pasteBlockFromClipboard();

					//row상태 변경
					var top_row_idx = mygridG3.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG3.getSelectedBlock().RightBottomRow;
					for(j=top_row_idx;j<=bottom_row_idx;j++){
						var rowID = mygridG3.getRowId(j);
						RowEditStatus = mygridG3.getUserData(rowID,"!nativeeditor_status");
						if(RowEditStatus == ""){
							mygridG3.setUserData(rowID,"!nativeeditor_status","updated");
							mygridG3.setRowTextBold(rowID);
						}
					}
				}
				return true;
			}else{
				return false;
			}
		});
		 // IO : USR_ID초기화	
		 // IO : LOGIN_CNT초기화	
	//onCheck
		mygridG3.attachEvent("onCheck",function(rowId, cellInd, state){
			//onCheck is void return event
			alog(rowId + " is onCheck.");
			//일반 체크 박스는 변경이면 실제 row 변경
			if( 1 == 2 
				){
				RowEditStatus = mygridG3.getUserData(rowId,"!nativeeditor_status");
				if(RowEditStatus == ""){
					mygridG3.setUserData(rowId,"!nativeeditor_status","updated");
					mygridG3.setRowTextBold(rowId);
					mygridG3.cells(rowId,cellInd).cell.wasChanged = true;	
				}
			}
						
		});	
		// ROW선택 이벤트
		mygridG3.attachEvent("onRowSelect",function(rowID,celInd){
			RowEditStatus = mygridG3.getUserData(rowID,"!nativeeditor_status");
			if(RowEditStatus == "inserted"){return false;}
			//GRIDRowSelect30(rowID,celInd);
			//팝업오프너 호출
			//CD[필수], NM 정보가 있는 경우 팝업 오프너에게 값 전달
			popG3json = jQuery.parseJSON('{ "__NAME":"lastinputG3json"' +
			'}');

			if(popG3json && popG3json.CD){
				goOpenerReturn(popG3json);
				return;
			}
			//LAST SELECT ROW
			//lastselectG3json = jQuery.parseJSON('{ "__NAME":"lastinputG3json"' +
			//', "USR_ID" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("USR_ID")).getValue()) + '"' +
			//', "LOGIN_CNT" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("LOGIN_CNT")).getValue()) + '"' +
			//'}');
		//A124
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
	//로그인실패IP 그리드 초기화
function G4_INIT(){
  alog("G4_INIT()-------------------------start");

        //그리드 초기화
        mygridG4 = new dhtmlXGridObject('gridG4');
        mygridG4.setDateFormat("%Y%m%d");
        mygridG4.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG4.setUserData("","gridTitle","G4 : 로그인실패IP"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG4.setHeader("IP,LOGIN_CNT");
		mygridG4.setColumnIds("REMOTE_ADDR,LOGIN_CNT");
		mygridG4.setInitWidths("60,100");
		mygridG4.setColTypes("ro,ro");
	//가로 정렬	
		mygridG4.setColAlign("left,left");
		mygridG4.setColSorting("str,int");		//렌더링	
		mygridG4.enableSmartRendering(false);
		mygridG4.enableMultiselect(true);
		//mygridG4.setColValidators("G4_REMOTE_ADDR,G4_LOGIN_CNT");
		mygridG4.splitAt(0);//'freezes' 0 columns 
		mygridG4.init();

		mygridG4.attachEvent("onDhxCalendarCreated", function(myCal){ myCal.loadUserLanguage( "kr" ); });
		//블럭선택 및 복사
		mygridG4.enableBlockSelection(true);
		mygridG4.attachEvent("onKeyPress",function(code,ctrl,shift){
			alog("onKeyPress.......code=" + code + ", ctrl=" + ctrl + ", shift=" + shift);

			//셀편집모드 아닐때만 블록처리
			if(!mygridG4.editor){
				mygridG4.setCSVDelimiter("	");
				if(code==67&&ctrl){
					mygridG4.copyBlockToClipboard();

					var top_row_idx = mygridG4.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG4.getSelectedBlock().RightBottomRow;
					var copyRowCnt = bottom_row_idx-top_row_idx+1;
					msgNotice( copyRowCnt + "개의 행이 클립보드에 복사되었습니다.",2);

				}
				if(code==86&&ctrl){
					mygridG4.pasteBlockFromClipboard();

					//row상태 변경
					var top_row_idx = mygridG4.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG4.getSelectedBlock().RightBottomRow;
					for(j=top_row_idx;j<=bottom_row_idx;j++){
						var rowID = mygridG4.getRowId(j);
						RowEditStatus = mygridG4.getUserData(rowID,"!nativeeditor_status");
						if(RowEditStatus == ""){
							mygridG4.setUserData(rowID,"!nativeeditor_status","updated");
							mygridG4.setRowTextBold(rowID);
						}
					}
				}
				return true;
			}else{
				return false;
			}
		});
		 // IO : IP초기화	
		 // IO : LOGIN_CNT초기화	
	//onCheck
		mygridG4.attachEvent("onCheck",function(rowId, cellInd, state){
			//onCheck is void return event
			alog(rowId + " is onCheck.");
			//일반 체크 박스는 변경이면 실제 row 변경
			if( 1 == 2 
				){
				RowEditStatus = mygridG4.getUserData(rowId,"!nativeeditor_status");
				if(RowEditStatus == ""){
					mygridG4.setUserData(rowId,"!nativeeditor_status","updated");
					mygridG4.setRowTextBold(rowId);
					mygridG4.cells(rowId,cellInd).cell.wasChanged = true;	
				}
			}
						
		});	
		// ROW선택 이벤트
		mygridG4.attachEvent("onRowSelect",function(rowID,celInd){
			RowEditStatus = mygridG4.getUserData(rowID,"!nativeeditor_status");
			if(RowEditStatus == "inserted"){return false;}
			//GRIDRowSelect40(rowID,celInd);
			//팝업오프너 호출
			//CD[필수], NM 정보가 있는 경우 팝업 오프너에게 값 전달
			popG4json = jQuery.parseJSON('{ "__NAME":"lastinputG3json"' +
			'}');

			if(popG4json && popG4json.CD){
				goOpenerReturn(popG4json);
				return;
			}
			//LAST SELECT ROW
			//lastselectG4json = jQuery.parseJSON('{ "__NAME":"lastinputG4json"' +
			//', "REMOTE_ADDR" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("REMOTE_ADDR")).getValue()) + '"' +
			//', "LOGIN_CNT" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("LOGIN_CNT")).getValue()) + '"' +
			//'}');
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
	//권한없는접근 그리드 초기화
function G6_INIT(){
  alog("G6_INIT()-------------------------start");

        //그리드 초기화
        mygridG6 = new dhtmlXGridObject('gridG6');
        mygridG6.setDateFormat("%Y%m%d");
        mygridG6.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG6.setUserData("","gridTitle","G6 : 권한없는접근"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG6.setHeader("USR_ID,AUTH_CNT");
		mygridG6.setColumnIds("USR_ID,AUTH_CNT");
		mygridG6.setInitWidths("50,50");
		mygridG6.setColTypes("ro,ro");
	//가로 정렬	
		mygridG6.setColAlign("left,left");
		mygridG6.setColSorting("str,int");		//렌더링	
		mygridG6.enableSmartRendering(false);
		mygridG6.enableMultiselect(true);
		//mygridG6.setColValidators("G6_USR_ID,G6_AUTH_CNT");
		mygridG6.splitAt(0);//'freezes' 0 columns 
		mygridG6.init();

		mygridG6.attachEvent("onDhxCalendarCreated", function(myCal){ myCal.loadUserLanguage( "kr" ); });
		//블럭선택 및 복사
		mygridG6.enableBlockSelection(true);
		mygridG6.attachEvent("onKeyPress",function(code,ctrl,shift){
			alog("onKeyPress.......code=" + code + ", ctrl=" + ctrl + ", shift=" + shift);

			//셀편집모드 아닐때만 블록처리
			if(!mygridG6.editor){
				mygridG6.setCSVDelimiter("	");
				if(code==67&&ctrl){
					mygridG6.copyBlockToClipboard();

					var top_row_idx = mygridG6.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG6.getSelectedBlock().RightBottomRow;
					var copyRowCnt = bottom_row_idx-top_row_idx+1;
					msgNotice( copyRowCnt + "개의 행이 클립보드에 복사되었습니다.",2);

				}
				if(code==86&&ctrl){
					mygridG6.pasteBlockFromClipboard();

					//row상태 변경
					var top_row_idx = mygridG6.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG6.getSelectedBlock().RightBottomRow;
					for(j=top_row_idx;j<=bottom_row_idx;j++){
						var rowID = mygridG6.getRowId(j);
						RowEditStatus = mygridG6.getUserData(rowID,"!nativeeditor_status");
						if(RowEditStatus == ""){
							mygridG6.setUserData(rowID,"!nativeeditor_status","updated");
							mygridG6.setRowTextBold(rowID);
						}
					}
				}
				return true;
			}else{
				return false;
			}
		});
		 // IO : USR_ID초기화	
		 // IO : AUTH_CNT초기화	
	//onCheck
		mygridG6.attachEvent("onCheck",function(rowId, cellInd, state){
			//onCheck is void return event
			alog(rowId + " is onCheck.");
			//일반 체크 박스는 변경이면 실제 row 변경
			if( 1 == 2 
				){
				RowEditStatus = mygridG6.getUserData(rowId,"!nativeeditor_status");
				if(RowEditStatus == ""){
					mygridG6.setUserData(rowId,"!nativeeditor_status","updated");
					mygridG6.setRowTextBold(rowId);
					mygridG6.cells(rowId,cellInd).cell.wasChanged = true;	
				}
			}
						
		});	
		// ROW선택 이벤트
		mygridG6.attachEvent("onRowSelect",function(rowID,celInd){
			RowEditStatus = mygridG6.getUserData(rowID,"!nativeeditor_status");
			if(RowEditStatus == "inserted"){return false;}
			//GRIDRowSelect50(rowID,celInd);
			//팝업오프너 호출
			//CD[필수], NM 정보가 있는 경우 팝업 오프너에게 값 전달
			popG6json = jQuery.parseJSON('{ "__NAME":"lastinputG3json"' +
			'}');

			if(popG6json && popG6json.CD){
				goOpenerReturn(popG6json);
				return;
			}
			//LAST SELECT ROW
			//lastselectG6json = jQuery.parseJSON('{ "__NAME":"lastinputG6json"' +
			//', "USR_ID" : "' + q(mygridG6.cells(rowID,mygridG6.getColIndexById("USR_ID")).getValue()) + '"' +
			//', "AUTH_CNT" : "' + q(mygridG6.cells(rowID,mygridG6.getColIndexById("AUTH_CNT")).getValue()) + '"' +
			//'}');
		//A124
		});
		mygridG6.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            alog("mygridG6  onEditCell ------------------start");
            alog("       stage : " + stage);
            alog("       rId : " + rId);
            alog("       cInd : " + cInd);
            alog("       nValue : " + nValue);
            alog("       oValue : " + oValue);

            RowEditStatus = mygridG6.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygridG6.setUserData(rId,"!nativeeditor_status","updated");
                    mygridG6.setRowTextBold(rId);
                }
                mygridG6.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

		});
        alog("G6_INIT()-------------------------end");
     }
	//로그인잠금 그리드 초기화
function G7_INIT(){
  alog("G7_INIT()-------------------------start");

        //그리드 초기화
        mygridG7 = new dhtmlXGridObject('gridG7');
        mygridG7.setDateFormat("%Y%m%d");
        mygridG7.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG7.setUserData("","gridTitle","G7 : 로그인잠금"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG7.setHeader("USR_ID,LOGIN_CNT");
		mygridG7.setColumnIds("USR_ID,LOGIN_CNT");
		mygridG7.setInitWidths("50,100");
		mygridG7.setColTypes("ro,ro");
	//가로 정렬	
		mygridG7.setColAlign("left,left");
		mygridG7.setColSorting("str,int");		//렌더링	
		mygridG7.enableSmartRendering(false);
		mygridG7.enableMultiselect(true);
		//mygridG7.setColValidators("G7_USR_ID,G7_LOGIN_CNT");
		mygridG7.splitAt(0);//'freezes' 0 columns 
		mygridG7.init();

		mygridG7.attachEvent("onDhxCalendarCreated", function(myCal){ myCal.loadUserLanguage( "kr" ); });
		//블럭선택 및 복사
		mygridG7.enableBlockSelection(true);
		mygridG7.attachEvent("onKeyPress",function(code,ctrl,shift){
			alog("onKeyPress.......code=" + code + ", ctrl=" + ctrl + ", shift=" + shift);

			//셀편집모드 아닐때만 블록처리
			if(!mygridG7.editor){
				mygridG7.setCSVDelimiter("	");
				if(code==67&&ctrl){
					mygridG7.copyBlockToClipboard();

					var top_row_idx = mygridG7.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG7.getSelectedBlock().RightBottomRow;
					var copyRowCnt = bottom_row_idx-top_row_idx+1;
					msgNotice( copyRowCnt + "개의 행이 클립보드에 복사되었습니다.",2);

				}
				if(code==86&&ctrl){
					mygridG7.pasteBlockFromClipboard();

					//row상태 변경
					var top_row_idx = mygridG7.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG7.getSelectedBlock().RightBottomRow;
					for(j=top_row_idx;j<=bottom_row_idx;j++){
						var rowID = mygridG7.getRowId(j);
						RowEditStatus = mygridG7.getUserData(rowID,"!nativeeditor_status");
						if(RowEditStatus == ""){
							mygridG7.setUserData(rowID,"!nativeeditor_status","updated");
							mygridG7.setRowTextBold(rowID);
						}
					}
				}
				return true;
			}else{
				return false;
			}
		});
		 // IO : USR_ID초기화	
		 // IO : LOGIN_CNT초기화	
	//onCheck
		mygridG7.attachEvent("onCheck",function(rowId, cellInd, state){
			//onCheck is void return event
			alog(rowId + " is onCheck.");
			//일반 체크 박스는 변경이면 실제 row 변경
			if( 1 == 2 
				){
				RowEditStatus = mygridG7.getUserData(rowId,"!nativeeditor_status");
				if(RowEditStatus == ""){
					mygridG7.setUserData(rowId,"!nativeeditor_status","updated");
					mygridG7.setRowTextBold(rowId);
					mygridG7.cells(rowId,cellInd).cell.wasChanged = true;	
				}
			}
						
		});	
		// ROW선택 이벤트
		mygridG7.attachEvent("onRowSelect",function(rowID,celInd){
			RowEditStatus = mygridG7.getUserData(rowID,"!nativeeditor_status");
			if(RowEditStatus == "inserted"){return false;}
			//GRIDRowSelect60(rowID,celInd);
			//팝업오프너 호출
			//CD[필수], NM 정보가 있는 경우 팝업 오프너에게 값 전달
			popG7json = jQuery.parseJSON('{ "__NAME":"lastinputG3json"' +
			'}');

			if(popG7json && popG7json.CD){
				goOpenerReturn(popG7json);
				return;
			}
			//LAST SELECT ROW
			//lastselectG7json = jQuery.parseJSON('{ "__NAME":"lastinputG7json"' +
			//', "USR_ID" : "' + q(mygridG7.cells(rowID,mygridG7.getColIndexById("USR_ID")).getValue()) + '"' +
			//', "LOGIN_CNT" : "' + q(mygridG7.cells(rowID,mygridG7.getColIndexById("LOGIN_CNT")).getValue()) + '"' +
			//'}');
		//A124
		});
		mygridG7.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            alog("mygridG7  onEditCell ------------------start");
            alog("       stage : " + stage);
            alog("       rId : " + rId);
            alog("       cInd : " + cInd);
            alog("       nValue : " + nValue);
            alog("       oValue : " + oValue);

            RowEditStatus = mygridG7.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygridG7.setUserData(rId,"!nativeeditor_status","updated");
                    mygridG7.setRowTextBold(rId);
                }
                mygridG7.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

		});
        alog("G7_INIT()-------------------------end");
     }
	//개인정보접근 그리드 초기화
function G9_INIT(){
  alog("G9_INIT()-------------------------start");

        //그리드 초기화
        mygridG9 = new dhtmlXGridObject('gridG9');
        mygridG9.setDateFormat("%Y%m%d");
        mygridG9.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG9.setUserData("","gridTitle","G9 : 개인정보접근"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG9.setHeader("USR_ID,PI_CNT,ROW_SUM");
		mygridG9.setColumnIds("USR_ID,REQ_PI_CNT,VIEW_ROW_SUM");
		mygridG9.setInitWidths("50,60,60");
		mygridG9.setColTypes("ro,ro,ro");
	//가로 정렬	
		mygridG9.setColAlign("left,right,right");
		mygridG9.setColSorting("str,int,int");		//렌더링	
		mygridG9.enableSmartRendering(false);
		mygridG9.enableMultiselect(true);
		//mygridG9.setColValidators("G9_USR_ID,G9_REQ_PI_CNT,G9_VIEW_ROW_SUM");
		mygridG9.splitAt(0);//'freezes' 0 columns 
		mygridG9.init();

		mygridG9.attachEvent("onDhxCalendarCreated", function(myCal){ myCal.loadUserLanguage( "kr" ); });
		//블럭선택 및 복사
		mygridG9.enableBlockSelection(true);
		mygridG9.attachEvent("onKeyPress",function(code,ctrl,shift){
			alog("onKeyPress.......code=" + code + ", ctrl=" + ctrl + ", shift=" + shift);

			//셀편집모드 아닐때만 블록처리
			if(!mygridG9.editor){
				mygridG9.setCSVDelimiter("	");
				if(code==67&&ctrl){
					mygridG9.copyBlockToClipboard();

					var top_row_idx = mygridG9.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG9.getSelectedBlock().RightBottomRow;
					var copyRowCnt = bottom_row_idx-top_row_idx+1;
					msgNotice( copyRowCnt + "개의 행이 클립보드에 복사되었습니다.",2);

				}
				if(code==86&&ctrl){
					mygridG9.pasteBlockFromClipboard();

					//row상태 변경
					var top_row_idx = mygridG9.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG9.getSelectedBlock().RightBottomRow;
					for(j=top_row_idx;j<=bottom_row_idx;j++){
						var rowID = mygridG9.getRowId(j);
						RowEditStatus = mygridG9.getUserData(rowID,"!nativeeditor_status");
						if(RowEditStatus == ""){
							mygridG9.setUserData(rowID,"!nativeeditor_status","updated");
							mygridG9.setRowTextBold(rowID);
						}
					}
				}
				return true;
			}else{
				return false;
			}
		});
		 // IO : USR_ID초기화	
		 // IO : PI_CNT초기화	
		 // IO : ROW_SUM초기화	
	//onCheck
		mygridG9.attachEvent("onCheck",function(rowId, cellInd, state){
			//onCheck is void return event
			alog(rowId + " is onCheck.");
			//일반 체크 박스는 변경이면 실제 row 변경
			if( 1 == 2 
				){
				RowEditStatus = mygridG9.getUserData(rowId,"!nativeeditor_status");
				if(RowEditStatus == ""){
					mygridG9.setUserData(rowId,"!nativeeditor_status","updated");
					mygridG9.setRowTextBold(rowId);
					mygridG9.cells(rowId,cellInd).cell.wasChanged = true;	
				}
			}
						
		});	
		// ROW선택 이벤트
		mygridG9.attachEvent("onRowSelect",function(rowID,celInd){
			RowEditStatus = mygridG9.getUserData(rowID,"!nativeeditor_status");
			if(RowEditStatus == "inserted"){return false;}
			//GRIDRowSelect70(rowID,celInd);
			//팝업오프너 호출
			//CD[필수], NM 정보가 있는 경우 팝업 오프너에게 값 전달
			popG9json = jQuery.parseJSON('{ "__NAME":"lastinputG3json"' +
			'}');

			if(popG9json && popG9json.CD){
				goOpenerReturn(popG9json);
				return;
			}
			//LAST SELECT ROW
			//lastselectG9json = jQuery.parseJSON('{ "__NAME":"lastinputG9json"' +
			//', "USR_ID" : "' + q(mygridG9.cells(rowID,mygridG9.getColIndexById("USR_ID")).getValue()) + '"' +
			//', "REQ_PI_CNT" : "' + q(mygridG9.cells(rowID,mygridG9.getColIndexById("REQ_PI_CNT")).getValue()) + '"' +
			//', "VIEW_ROW_SUM" : "' + q(mygridG9.cells(rowID,mygridG9.getColIndexById("VIEW_ROW_SUM")).getValue()) + '"' +
			//'}');
		//A124
		});
		mygridG9.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            alog("mygridG9  onEditCell ------------------start");
            alog("       stage : " + stage);
            alog("       rId : " + rId);
            alog("       cInd : " + cInd);
            alog("       nValue : " + nValue);
            alog("       oValue : " + oValue);

            RowEditStatus = mygridG9.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygridG9.setUserData(rId,"!nativeeditor_status","updated");
                    mygridG9.setRowTextBold(rId);
                }
                mygridG9.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

		});
        alog("G9_INIT()-------------------------end");
     }
//D146 그룹별 기능 함수 출력		
//검색조건 초기화
function G1_RESET(){
	alog("G1_RESET--------------------------start");
	$('#condition')[0].reset();
}
//조건, 저장	
function G1_SAVE(){
 alog("G1_SAVE-------------------start");
	//FormData parameter에 담아줌	
	var formData = new FormData();	//G1 getparams	
//var params = { CTL : "G1_SAVE"};
	$.ajax({	
		type : "POST",
		url : url_G1_SAVE  ,
		data : formData,
		processData: false,
		contentType: false,
		async: false,
		success: function(tdata){
			alog("   json return----------------------");
			alog("   json data : " + tdata);
			data = jQuery.parseJSON(tdata);
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
function G1_SEARCHALL(token){
	alog("G1_SEARCHALL--------------------------start");
	//입력값검증
	//폼의 모든값 구하기
	var ConAllData = $( "#condition" ).serialize();
	alog("ConAllData:" + ConAllData);
	//json : G1
			lastinputG2 = new HashMap(); //월점검
				lastinputG8 = new HashMap(); //월점검목록
				lastinputG3 = new HashMap(); //로그인실패
				lastinputG4 = new HashMap(); //로그인실패IP
				lastinputG6 = new HashMap(); //권한없는접근
				lastinputG7 = new HashMap(); //로그인잠금
				lastinputG9 = new HashMap(); //개인정보접근
		//  호출
	G2_SEARCH(lastinputG2,token);
	//  호출
	G8_SEARCH(lastinputG8,token);
	//  호출
	G3_SEARCH(lastinputG3,token);
	//  호출
	G4_SEARCH(lastinputG4,token);
	//  호출
	G6_SEARCH(lastinputG6,token);
	//  호출
	G7_SEARCH(lastinputG7,token);
	//  호출
	G9_SEARCH(lastinputG9,token);
	alog("G1_SEARCHALL--------------------------end");
}
//디테일 검색	
function G2_SEARCH(tinput,token){
       alog("(FORMVIEW) G2_SEARCH---------------start");

	//post 만들기
	sendFormData = new FormData($("#condition")[0]);
	if(typeof tinput != "undefined"){
		var tKeys = tinput.keys();
		for(i=0;i<tKeys.length;i++) {
			sendFormData.append(tKeys[i],tinput.get(tKeys[i]));
			//console.log(tKeys[i]+ '='+ tinput.get(tKeys[i])); 
		}
	}

    $.ajax({
        type : "POST",
        url : url_G2_SEARCH+"&TOKEN=" + token + "&G2_CRUD_MODE=SEARCH" ,
        data : sendFormData,
		processData: false,
		contentType: false,
        dataType: "json",
        success: function(data){
            alog(data);

			if(data && data.RTN_CD == "200"){
				if(data.RTN_DATA){
					msgNotice("정상적으로 조회되었습니다.",1);
				}else{
					msgNotice("정상적으로 조회되었으나 데이터가 없습니다.",2);
					return;
				}
			}else{
				msgError("오류가 발생했습니다("+ data.ERR_CD + ")." + data.RTN_MSG,3);
				return;
			}

            //모드 변경하기
            $("#G2-CTLCUD").val("R");
			//SETVAL  가져와서 세팅
	$("#G2-FROM_DT").val(data.RTN_DATA.FROM_DT);//FROM_DT 오브젝트 값 세팅
	$("#G2-TO_DT").val(data.RTN_DATA.TO_DT);//~ 오브젝트 값 세팅
			$("#G2-CFM_DESC").val(data.RTN_DATA.CFM_DESC);//CFM_DESC 변수세팅
        },
        error: function(error){
            alog("Error:");
            alog(error);
        }
    });
    alog("(FORMVIEW) G2_SEARCH---------------end");

}
//G2_SAVE
//IO_FILE_YN = N	
	//IO_FILE_YN = N	
function G2_SAVE(token){	
	alog("G2_SAVE---------------start");

	if( !( $("#G2-CTLCUD").val() == "C" || $("#G2-CTLCUD").val() == "U") ){
		alert("신규 또는 수정 모드 진입 후 저장할 수 있습니다.")
		return;
	}

	//전송용 데이터 생성하기
	var sendFormData = new FormData($("#formviewG2")[0]);

	//컨디션 데이터 추가하기
	conditionData = new FormData($("#condition")[0]);
    var es, e, pair;
    for (es = conditionData.entries(); !(e = es.next()).done && (pair = e.value);) {
		sendFormData.append(pair[0],pair[1]);
    }

	$.ajax({
		type : "POST",
		url : url_G2_SAVE + "&TOKEN=" + token,
		data : sendFormData,
		processData: false,
		contentType: false,
		success: function(tdata){
			alog(tdata);
			data = jQuery.parseJSON(tdata);
			//alert(data);
			if(data && data.RTN_CD == "200"){
				msgNotice("정상적으로 저장되었습니다.",1);
			}else{
				msgError("오류가 발생했습니다("+ data.ERR_CD + ")." + data.RTN_MSG,3);
			}
		},
		error: function(error){
			alog("Error:");
			alog(error);
		}
	});
}//	
function G2_NEW(){
       alog("[FromView] G2_NEW---------------start");
	$("#G2-CTLCUD").val("C");
	//PMGIO 로직
	$("#G2-CFM_DESC").val("");//CFM_DESC 신규초기화	
       alog("DETAILNew20---------------end");
}
//새로고침	
function G2_RELOAD(token){
	alog("G2_RELOAD-----------------start");
	G2_SEARCH(lastinputG2,token);
}//엑셀다운		
function G8_EXCEL(){	
	alog("G8_EXCEL-----------------start");
	var myForm = document.excelDownForm;
	var url = "/c.g/cg_phpexcel.php";
	window.open("" ,"popForm",
		  "toolbar=no, width=540, height=467, directories=no, status=no,    scrollorbars=no, resizable=no");
	myForm.action =url;
	myForm.method="post";
	myForm.target="popForm";

	mygridG8.setSerializationLevel(true,false,false,false,false,false);
	var myXmlString = mygridG8.serialize();        //컨디션 데이터 모두 말기
	$("#DATA_HEADERS").val("CFM_SEQ,FROM_DT,TO_DT,CFM_DESC,ADD_DT,ADD_ID");
	$("#DATA_WIDTHS").val("60,100,100,100,60,60");
	$("#DATA_ROWS").val(myXmlString);
	myForm.submit();
}








    //그리드 조회(월점검목록)	
    function G8_SEARCH(tinput,token){
        alog("G8_SEARCH()------------start");

		var tGrid = mygridG8;

        //그리드 초기화
        tGrid.clearAll();
        //post 만들기
		sendFormData = new FormData($("#condition")[0]);
		if(typeof tinput != "undefined"){
			var tKeys = tinput.keys();
			for(i=0;i<tKeys.length;i++) {
				sendFormData.append(tKeys[i],tinput.get(tKeys[i]));
				//console.log(tKeys[i]+ '='+ tinput.get(tKeys[i])); 
			}
		}

        //불러오기
        $.ajax({
            type : "POST",
            url : url_G8_SEARCH+"&TOKEN=" + token + " &G8_CRUD_MODE=read" ,
            data : sendFormData,
			processData: false,
			contentType: false,
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridG8 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
					var row_cnt = 0;
					if(data.RTN_DATA){
						row_cnt = data.RTN_DATA.rows.length;
						$("#spanG8Cnt").text(row_cnt);
						tGrid.parse(data.RTN_DATA,function(){
							//푸터 합계 처리	

						},"json");
						
					}else{
						$("#spanG8Cnt").text("-");
					}
					msgNotice("[월점검목록] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[월점검목록] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[월점검목록] Ajax http 500 error ( " + error + " )",3);
                alog("[월점검목록] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
        alog("G8_SEARCH()------------end");
    }

//새로고침	
function G8_RELOAD(token){
  alog("G8_RELOAD-----------------start");
  G8_SEARCH(lastinputG8,token);
}
//새로고침	
function G3_RELOAD(token){
  alog("G3_RELOAD-----------------start");
  G3_SEARCH(lastinputG3,token);
}
//엑셀다운		
function G3_EXCEL(){	
	alog("G3_EXCEL-----------------start");
	var myForm = document.excelDownForm;
	var url = "/c.g/cg_phpexcel.php";
	window.open("" ,"popForm",
		  "toolbar=no, width=540, height=467, directories=no, status=no,    scrollorbars=no, resizable=no");
	myForm.action =url;
	myForm.method="post";
	myForm.target="popForm";

	mygridG3.setSerializationLevel(true,false,false,false,false,false);
	var myXmlString = mygridG3.serialize();        //컨디션 데이터 모두 말기
	$("#DATA_HEADERS").val("USR_ID,LOGIN_CNT");
	$("#DATA_WIDTHS").val("50,100");
	$("#DATA_ROWS").val(myXmlString);
	myForm.submit();
}








    //그리드 조회(로그인실패)	
    function G3_SEARCH(tinput,token){
        alog("G3_SEARCH()------------start");

		var tGrid = mygridG3;

        //그리드 초기화
        tGrid.clearAll();
        //post 만들기
		sendFormData = new FormData($("#condition")[0]);
		if(typeof tinput != "undefined"){
			var tKeys = tinput.keys();
			for(i=0;i<tKeys.length;i++) {
				sendFormData.append(tKeys[i],tinput.get(tKeys[i]));
				//console.log(tKeys[i]+ '='+ tinput.get(tKeys[i])); 
			}
		}

        //불러오기
        $.ajax({
            type : "POST",
            url : url_G3_SEARCH+"&TOKEN=" + token + " &G3_CRUD_MODE=read" ,
            data : sendFormData,
			processData: false,
			contentType: false,
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridG3 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
					var row_cnt = 0;
					if(data.RTN_DATA){
						row_cnt = data.RTN_DATA.rows.length;
						$("#spanG3Cnt").text(row_cnt);
						tGrid.parse(data.RTN_DATA,function(){
							//푸터 합계 처리	

						},"json");
						
					}else{
						$("#spanG3Cnt").text("-");
					}
					msgNotice("[로그인실패] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[로그인실패] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[로그인실패] Ajax http 500 error ( " + error + " )",3);
                alog("[로그인실패] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
        alog("G3_SEARCH()------------end");
    }

//엑셀다운		
function G4_EXCEL(){	
	alog("G4_EXCEL-----------------start");
	var myForm = document.excelDownForm;
	var url = "/c.g/cg_phpexcel.php";
	window.open("" ,"popForm",
		  "toolbar=no, width=540, height=467, directories=no, status=no,    scrollorbars=no, resizable=no");
	myForm.action =url;
	myForm.method="post";
	myForm.target="popForm";

	mygridG4.setSerializationLevel(true,false,false,false,false,false);
	var myXmlString = mygridG4.serialize();        //컨디션 데이터 모두 말기
	$("#DATA_HEADERS").val("REMOTE_ADDR,LOGIN_CNT");
	$("#DATA_WIDTHS").val("60,100");
	$("#DATA_ROWS").val(myXmlString);
	myForm.submit();
}








    //그리드 조회(로그인실패IP)	
    function G4_SEARCH(tinput,token){
        alog("G4_SEARCH()------------start");

		var tGrid = mygridG4;

        //그리드 초기화
        tGrid.clearAll();
        //post 만들기
		sendFormData = new FormData($("#condition")[0]);
		if(typeof tinput != "undefined"){
			var tKeys = tinput.keys();
			for(i=0;i<tKeys.length;i++) {
				sendFormData.append(tKeys[i],tinput.get(tKeys[i]));
				//console.log(tKeys[i]+ '='+ tinput.get(tKeys[i])); 
			}
		}

        //불러오기
        $.ajax({
            type : "POST",
            url : url_G4_SEARCH+"&TOKEN=" + token + " &G4_CRUD_MODE=read" ,
            data : sendFormData,
			processData: false,
			contentType: false,
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridG4 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
					var row_cnt = 0;
					if(data.RTN_DATA){
						row_cnt = data.RTN_DATA.rows.length;
						$("#spanG4Cnt").text(row_cnt);
						tGrid.parse(data.RTN_DATA,function(){
							//푸터 합계 처리	

						},"json");
						
					}else{
						$("#spanG4Cnt").text("-");
					}
					msgNotice("[로그인실패IP] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[로그인실패IP] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[로그인실패IP] Ajax http 500 error ( " + error + " )",3);
                alog("[로그인실패IP] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
        alog("G4_SEARCH()------------end");
    }

//새로고침	
function G4_RELOAD(token){
  alog("G4_RELOAD-----------------start");
  G4_SEARCH(lastinputG4,token);
}
//엑셀다운		
function G6_EXCEL(){	
	alog("G6_EXCEL-----------------start");
	var myForm = document.excelDownForm;
	var url = "/c.g/cg_phpexcel.php";
	window.open("" ,"popForm",
		  "toolbar=no, width=540, height=467, directories=no, status=no,    scrollorbars=no, resizable=no");
	myForm.action =url;
	myForm.method="post";
	myForm.target="popForm";

	mygridG6.setSerializationLevel(true,false,false,false,false,false);
	var myXmlString = mygridG6.serialize();        //컨디션 데이터 모두 말기
	$("#DATA_HEADERS").val("USR_ID,AUTH_CNT");
	$("#DATA_WIDTHS").val("50,50");
	$("#DATA_ROWS").val(myXmlString);
	myForm.submit();
}








    //그리드 조회(권한없는접근)	
    function G6_SEARCH(tinput,token){
        alog("G6_SEARCH()------------start");

		var tGrid = mygridG6;

        //그리드 초기화
        tGrid.clearAll();
        //post 만들기
		sendFormData = new FormData($("#condition")[0]);
		if(typeof tinput != "undefined"){
			var tKeys = tinput.keys();
			for(i=0;i<tKeys.length;i++) {
				sendFormData.append(tKeys[i],tinput.get(tKeys[i]));
				//console.log(tKeys[i]+ '='+ tinput.get(tKeys[i])); 
			}
		}

        //불러오기
        $.ajax({
            type : "POST",
            url : url_G6_SEARCH+"&TOKEN=" + token + " &G6_CRUD_MODE=read" ,
            data : sendFormData,
			processData: false,
			contentType: false,
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridG6 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
					var row_cnt = 0;
					if(data.RTN_DATA){
						row_cnt = data.RTN_DATA.rows.length;
						$("#spanG6Cnt").text(row_cnt);
						tGrid.parse(data.RTN_DATA,function(){
							//푸터 합계 처리	

						},"json");
						
					}else{
						$("#spanG6Cnt").text("-");
					}
					msgNotice("[권한없는접근] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[권한없는접근] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[권한없는접근] Ajax http 500 error ( " + error + " )",3);
                alog("[권한없는접근] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
        alog("G6_SEARCH()------------end");
    }

//새로고침	
function G6_RELOAD(token){
  alog("G6_RELOAD-----------------start");
  G6_SEARCH(lastinputG6,token);
}








    //그리드 조회(로그인잠금)	
    function G7_SEARCH(tinput,token){
        alog("G7_SEARCH()------------start");

		var tGrid = mygridG7;

        //그리드 초기화
        tGrid.clearAll();
        //post 만들기
		sendFormData = new FormData($("#condition")[0]);
		if(typeof tinput != "undefined"){
			var tKeys = tinput.keys();
			for(i=0;i<tKeys.length;i++) {
				sendFormData.append(tKeys[i],tinput.get(tKeys[i]));
				//console.log(tKeys[i]+ '='+ tinput.get(tKeys[i])); 
			}
		}

        //불러오기
        $.ajax({
            type : "POST",
            url : url_G7_SEARCH+"&TOKEN=" + token + " &G7_CRUD_MODE=read" ,
            data : sendFormData,
			processData: false,
			contentType: false,
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridG7 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
					var row_cnt = 0;
					if(data.RTN_DATA){
						row_cnt = data.RTN_DATA.rows.length;
						$("#spanG7Cnt").text(row_cnt);
						tGrid.parse(data.RTN_DATA,function(){
							//푸터 합계 처리	

						},"json");
						
					}else{
						$("#spanG7Cnt").text("-");
					}
					msgNotice("[로그인잠금] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[로그인잠금] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[로그인잠금] Ajax http 500 error ( " + error + " )",3);
                alog("[로그인잠금] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
        alog("G7_SEARCH()------------end");
    }

//엑셀다운		
function G7_EXCEL(){	
	alog("G7_EXCEL-----------------start");
	var myForm = document.excelDownForm;
	var url = "/c.g/cg_phpexcel.php";
	window.open("" ,"popForm",
		  "toolbar=no, width=540, height=467, directories=no, status=no,    scrollorbars=no, resizable=no");
	myForm.action =url;
	myForm.method="post";
	myForm.target="popForm";

	mygridG7.setSerializationLevel(true,false,false,false,false,false);
	var myXmlString = mygridG7.serialize();        //컨디션 데이터 모두 말기
	$("#DATA_HEADERS").val("USR_ID,LOGIN_CNT");
	$("#DATA_WIDTHS").val("50,100");
	$("#DATA_ROWS").val(myXmlString);
	myForm.submit();
}
//새로고침	
function G7_RELOAD(token){
  alog("G7_RELOAD-----------------start");
  G7_SEARCH(lastinputG7,token);
}
//엑셀다운		
function G9_EXCEL(){	
	alog("G9_EXCEL-----------------start");
	var myForm = document.excelDownForm;
	var url = "/c.g/cg_phpexcel.php";
	window.open("" ,"popForm",
		  "toolbar=no, width=540, height=467, directories=no, status=no,    scrollorbars=no, resizable=no");
	myForm.action =url;
	myForm.method="post";
	myForm.target="popForm";

	mygridG9.setSerializationLevel(true,false,false,false,false,false);
	var myXmlString = mygridG9.serialize();        //컨디션 데이터 모두 말기
	$("#DATA_HEADERS").val("USR_ID,REQ_PI_CNT,VIEW_ROW_SUM");
	$("#DATA_WIDTHS").val("50,60,60");
	$("#DATA_ROWS").val(myXmlString);
	myForm.submit();
}








    //그리드 조회(개인정보접근)	
    function G9_SEARCH(tinput,token){
        alog("G9_SEARCH()------------start");

		var tGrid = mygridG9;

        //그리드 초기화
        tGrid.clearAll();
        //post 만들기
		sendFormData = new FormData($("#condition")[0]);
		if(typeof tinput != "undefined"){
			var tKeys = tinput.keys();
			for(i=0;i<tKeys.length;i++) {
				sendFormData.append(tKeys[i],tinput.get(tKeys[i]));
				//console.log(tKeys[i]+ '='+ tinput.get(tKeys[i])); 
			}
		}

        //불러오기
        $.ajax({
            type : "POST",
            url : url_G9_SEARCH+"&TOKEN=" + token + " &G9_CRUD_MODE=read" ,
            data : sendFormData,
			processData: false,
			contentType: false,
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridG9 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
					var row_cnt = 0;
					if(data.RTN_DATA){
						row_cnt = data.RTN_DATA.rows.length;
						$("#spanG9Cnt").text(row_cnt);
						tGrid.parse(data.RTN_DATA,function(){
							//푸터 합계 처리	

						},"json");
						
					}else{
						$("#spanG9Cnt").text("-");
					}
					msgNotice("[개인정보접근] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[개인정보접근] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[개인정보접근] Ajax http 500 error ( " + error + " )",3);
                alog("[개인정보접근] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
        alog("G9_SEARCH()------------end");
    }

//새로고침	
function G9_RELOAD(token){
  alog("G9_RELOAD-----------------start");
  G9_SEARCH(lastinputG9,token);
}
