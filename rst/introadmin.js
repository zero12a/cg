//글로벌 변수 선언	
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SEARCHALL = "introadminController.php?CTLGRP=G1&CTLFNC=SEARCHALL";//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SAVE = "introadminController.php?CTLGRP=G1&CTLFNC=SAVE";//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_RESET = "introadminController.php?CTLGRP=G1&CTLFNC=RESET";//조건 변수 선언	
//그리드 변수 초기화	
//컨트롤러 경로
var url_G2_SEARCH = "introadminController.php?CTLGRP=G2&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G2_RELOAD = "introadminController.php?CTLGRP=G2&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G2_HIDDENCOL = "introadminController.php?CTLGRP=G2&CTLFNC=HIDDENCOL";
//컨트롤러 경로
var url_G2_EXCEL = "introadminController.php?CTLGRP=G2&CTLFNC=EXCEL";
//그리드 객체
var mygridG2,isToggleHiddenColG2,lastinputG2,lastinputG2json,lastrowidG2;
var lastselectG2json;//그리드 변수 초기화	
//컨트롤러 경로
var url_G3_SEARCH = "introadminController.php?CTLGRP=G3&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G3_RELOAD = "introadminController.php?CTLGRP=G3&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G3_HIDDENCOL = "introadminController.php?CTLGRP=G3&CTLFNC=HIDDENCOL";
//컨트롤러 경로
var url_G3_EXCEL = "introadminController.php?CTLGRP=G3&CTLFNC=EXCEL";
//그리드 객체
var mygridG3,isToggleHiddenColG3,lastinputG3,lastinputG3json,lastrowidG3;
var lastselectG3json;//그리드 변수 초기화	
//컨트롤러 경로
var url_G4_SEARCH = "introadminController.php?CTLGRP=G4&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G4_RELOAD = "introadminController.php?CTLGRP=G4&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G4_HIDDENCOL = "introadminController.php?CTLGRP=G4&CTLFNC=HIDDENCOL";
//컨트롤러 경로
var url_G4_EXCEL = "introadminController.php?CTLGRP=G4&CTLFNC=EXCEL";
//그리드 객체
var mygridG4,isToggleHiddenColG4,lastinputG4,lastinputG4json,lastrowidG4;
var lastselectG4json;//그리드 변수 초기화	
//컨트롤러 경로
var url_G5_SEARCH = "introadminController.php?CTLGRP=G5&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G5_RELOAD = "introadminController.php?CTLGRP=G5&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G5_EXCEL = "introadminController.php?CTLGRP=G5&CTLFNC=EXCEL";
//그리드 객체
var mygridG5,isToggleHiddenColG5,lastinputG5,lastinputG5json,lastrowidG5;
var lastselectG5json;//그리드 변수 초기화	
//컨트롤러 경로
var url_G6_SEARCH = "introadminController.php?CTLGRP=G6&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G6_RELOAD = "introadminController.php?CTLGRP=G6&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G6_EXCEL = "introadminController.php?CTLGRP=G6&CTLFNC=EXCEL";
//그리드 객체
var mygridG6,isToggleHiddenColG6,lastinputG6,lastinputG6json,lastrowidG6;
var lastselectG6json;//그리드 변수 초기화	
//컨트롤러 경로
var url_G7_SEARCH = "introadminController.php?CTLGRP=G7&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G7_RELOAD = "introadminController.php?CTLGRP=G7&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G7_EXCEL = "introadminController.php?CTLGRP=G7&CTLFNC=EXCEL";
//그리드 객체
var mygridG7,isToggleHiddenColG7,lastinputG7,lastinputG7json,lastrowidG7;
var lastselectG7json;//화면 초기화	
function initBody(){
     alog("initBody()-----------------------start");
	
   //dhtmlx 메시지 박스 초기화
   dhtmlx.message.position="bottom";
	G1_INIT();	
		G2_INIT();	
		G3_INIT();	
		G4_INIT();	
		G5_INIT();	
		G6_INIT();	
		G7_INIT();	
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
//각 폼 오브젝트들 초기화
  alog("G1_INIT()-------------------------end");
}

	//로그인성공 그리드 초기화
function G2_INIT(){
  alog("G2_INIT()-------------------------start");

        //그리드 초기화
        mygridG2 = new dhtmlXGridObject('gridG2');
        mygridG2.setDateFormat("%Y%m%d");
        mygridG2.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG2.setUserData("","gridTitle","G2 : 로그인성공"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG2.setHeader("USR_ID,LOGIN_CNT");
		mygridG2.setColumnIds("USR_ID,LOGIN_CNT");
		mygridG2.setInitWidths("50,60");
		mygridG2.setColTypes("ro,ro");
	//가로 정렬
		mygridG2.setColAlign("left,right");
		mygridG2.setColSorting("str,int");		//렌더링
		mygridG2.enableSmartRendering(false);
		mygridG2.enableMultiselect(true);


		//mygridG2.setColValidators("G2_USR_ID,G2_LOGIN_CNT");
		mygridG2.splitAt(0);//'freezes' 0 columns 
		mygridG2.init();

				
		//블럭선택 및 복사
		mygridG2.enableBlockSelection(true);
		mygridG2.attachEvent("onKeyPress",function(code,ctrl,shift){
			alog("onKeyPress.......code=" + code + ", ctrl=" + ctrl + ", shift=" + shift);

			//셀편집모드 아닐때만 블록처리
			if(!mygridG2.editor){
				mygridG2.setCSVDelimiter("	");
				if(code==67&&ctrl){
				   if(!mygridG2._selectionArea){
						alert("블럭을 선택해 주세요");
						return false;
					}
					mygridG2.copyBlockToClipboard();

					var top_row_idx = mygridG2.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG2.getSelectedBlock().RightBottomRow;
					var copyRowCnt = bottom_row_idx-top_row_idx+1;
					msgNotice( copyRowCnt + "개의 행이 클립보드에 복사되었습니다.",2);

				}
				if(code==86&&ctrl){
					mygridG2.pasteBlockFromClipboard();

					//row상태 변경
					var top_row_idx = mygridG2.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG2.getSelectedBlock().RightBottomRow;
					for(j=top_row_idx;j<=bottom_row_idx;j++){
						var rowID = mygridG2.getRowId(j);
						RowEditStatus = mygridG2.getUserData(rowID,"!nativeeditor_status");
						if(RowEditStatus == ""){
							mygridG2.setUserData(rowID,"!nativeeditor_status","updated");
							mygridG2.setRowTextBold(rowID);
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
		mygridG2.attachEvent("onCheck",function(rowId, cellInd, state){
			//onCheck is void return event
			alog(rowId + " is onCheck.");
			//일반 체크 박스는 변경이면 실제 row 변경
			if( 1 == 2 
				){
				RowEditStatus = mygridG2.getUserData(rowId,"!nativeeditor_status");
				if(RowEditStatus == ""){
					mygridG2.setUserData(rowId,"!nativeeditor_status","updated");
					mygridG2.setRowTextBold(rowId);
					mygridG2.cells(rowId,cellInd).cell.wasChanged = true;	
				}
			}
						
		});	
		// ROW선택 이벤트
		mygridG2.attachEvent("onRowSelect",function(rowID,celInd){
			RowEditStatus = mygridG2.getUserData(rowID,"!nativeeditor_status");
			if(RowEditStatus == "inserted"){return false;}
			//GRIDRowSelect20(rowID,celInd);
			var ConAllData = $( "#condition" ).serialize();
			var RowAllData = getRowsColid(mygridG2,rowID,"G2");
			//팝업오프너 호출
			//CD[필수], NM 정보가 있는 경우 팝업 오프너에게 값 전달
			popG2json = jQuery.parseJSON('{ "__NAME":"lastinputG3json"' +
			'}');

			if(popG2json && popG2json.CD){
				goOpenerReturn(popG2json);
				return;
			}
			//LAST SELECT ROW
			//lastselectG2json = jQuery.parseJSON('{ "__NAME":"lastinputG2json"' +
			//', "USR_ID" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("USR_ID")).getValue()) + '"' +
			//', "LOGIN_CNT" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("LOGIN_CNT")).getValue()) + '"' +
			//'}');
		//A124
		});
		mygridG2.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            alog("mygridG2  onEditCell ------------------start");
            alog("       stage : " + stage);
            alog("       rId : " + rId);
            alog("       cInd : " + cInd);
            alog("       nValue : " + nValue);
            alog("       oValue : " + oValue);

            RowEditStatus = mygridG2.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygridG2.setUserData(rId,"!nativeeditor_status","updated");
                    mygridG2.setRowTextBold(rId);
                }
                mygridG2.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

		});
        alog("G2_INIT()-------------------------end");
     }
	//잠금횟수 그리드 초기화
function G3_INIT(){
  alog("G3_INIT()-------------------------start");

        //그리드 초기화
        mygridG3 = new dhtmlXGridObject('gridG3');
        mygridG3.setDateFormat("%Y%m%d");
        mygridG3.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG3.setUserData("","gridTitle","G3 : 잠금횟수"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG3.setHeader("USR_ID,LOGIN_CNT");
		mygridG3.setColumnIds("USR_ID,LOGIN_CNT");
		mygridG3.setInitWidths("50,60");
		mygridG3.setColTypes("ro,ro");
	//가로 정렬
		mygridG3.setColAlign("left,right");
		mygridG3.setColSorting("str,int");		//렌더링
		mygridG3.enableSmartRendering(false);
		mygridG3.enableMultiselect(true);


		//mygridG3.setColValidators("G3_USR_ID,G3_LOGIN_CNT");
		mygridG3.splitAt(0);//'freezes' 0 columns 
		mygridG3.init();

				
		//블럭선택 및 복사
		mygridG3.enableBlockSelection(true);
		mygridG3.attachEvent("onKeyPress",function(code,ctrl,shift){
			alog("onKeyPress.......code=" + code + ", ctrl=" + ctrl + ", shift=" + shift);

			//셀편집모드 아닐때만 블록처리
			if(!mygridG3.editor){
				mygridG3.setCSVDelimiter("	");
				if(code==67&&ctrl){
				   if(!mygridG3._selectionArea){
						alert("블럭을 선택해 주세요");
						return false;
					}
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
			var ConAllData = $( "#condition" ).serialize();
			var RowAllData = getRowsColid(mygridG3,rowID,"G3");
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
	//로그인실패 그리드 초기화
function G4_INIT(){
  alog("G4_INIT()-------------------------start");

        //그리드 초기화
        mygridG4 = new dhtmlXGridObject('gridG4');
        mygridG4.setDateFormat("%Y%m%d");
        mygridG4.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG4.setUserData("","gridTitle","G4 : 로그인실패"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG4.setHeader("USR_ID,LOGIN_CNT");
		mygridG4.setColumnIds("USR_ID,LOGIN_CNT");
		mygridG4.setInitWidths("50,60");
		mygridG4.setColTypes("ro,ro");
	//가로 정렬
		mygridG4.setColAlign("left,right");
		mygridG4.setColSorting("str,int");		//렌더링
		mygridG4.enableSmartRendering(false);
		mygridG4.enableMultiselect(true);


		//mygridG4.setColValidators("G4_USR_ID,G4_LOGIN_CNT");
		mygridG4.splitAt(0);//'freezes' 0 columns 
		mygridG4.init();

				
		//블럭선택 및 복사
		mygridG4.enableBlockSelection(true);
		mygridG4.attachEvent("onKeyPress",function(code,ctrl,shift){
			alog("onKeyPress.......code=" + code + ", ctrl=" + ctrl + ", shift=" + shift);

			//셀편집모드 아닐때만 블록처리
			if(!mygridG4.editor){
				mygridG4.setCSVDelimiter("	");
				if(code==67&&ctrl){
				   if(!mygridG4._selectionArea){
						alert("블럭을 선택해 주세요");
						return false;
					}
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
		 // IO : USR_ID초기화	
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
			var ConAllData = $( "#condition" ).serialize();
			var RowAllData = getRowsColid(mygridG4,rowID,"G4");
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
			//', "USR_ID" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("USR_ID")).getValue()) + '"' +
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
	//개인정보접근 그리드 초기화
function G5_INIT(){
  alog("G5_INIT()-------------------------start");

        //그리드 초기화
        mygridG5 = new dhtmlXGridObject('gridG5');
        mygridG5.setDateFormat("%Y%m%d");
        mygridG5.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG5.setUserData("","gridTitle","G5 : 개인정보접근"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG5.setHeader("USR_ID,AUTH_ROW_SUM");
		mygridG5.setColumnIds("USR_ID,AUTH_ROW_SUM");
		mygridG5.setInitWidths("50,60");
		mygridG5.setColTypes("ro,ro");
	//가로 정렬
		mygridG5.setColAlign("left,right");
		mygridG5.setColSorting("str,int");		//렌더링
		mygridG5.enableSmartRendering(false);
		mygridG5.enableMultiselect(true);


		//mygridG5.setColValidators("G5_USR_ID,G5_AUTH_ROW_SUM");
		mygridG5.splitAt(0);//'freezes' 0 columns 
		mygridG5.init();

				
		//블럭선택 및 복사
		mygridG5.enableBlockSelection(true);
		mygridG5.attachEvent("onKeyPress",function(code,ctrl,shift){
			alog("onKeyPress.......code=" + code + ", ctrl=" + ctrl + ", shift=" + shift);

			//셀편집모드 아닐때만 블록처리
			if(!mygridG5.editor){
				mygridG5.setCSVDelimiter("	");
				if(code==67&&ctrl){
				   if(!mygridG5._selectionArea){
						alert("블럭을 선택해 주세요");
						return false;
					}
					mygridG5.copyBlockToClipboard();

					var top_row_idx = mygridG5.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG5.getSelectedBlock().RightBottomRow;
					var copyRowCnt = bottom_row_idx-top_row_idx+1;
					msgNotice( copyRowCnt + "개의 행이 클립보드에 복사되었습니다.",2);

				}
				if(code==86&&ctrl){
					mygridG5.pasteBlockFromClipboard();

					//row상태 변경
					var top_row_idx = mygridG5.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG5.getSelectedBlock().RightBottomRow;
					for(j=top_row_idx;j<=bottom_row_idx;j++){
						var rowID = mygridG5.getRowId(j);
						RowEditStatus = mygridG5.getUserData(rowID,"!nativeeditor_status");
						if(RowEditStatus == ""){
							mygridG5.setUserData(rowID,"!nativeeditor_status","updated");
							mygridG5.setRowTextBold(rowID);
						}
					}
				}
				return true;
			}else{
				return false;
			}
		});
		 // IO : USR_ID초기화	
		 // IO : AUTH_ROW_SUM초기화	
	//onCheck
		mygridG5.attachEvent("onCheck",function(rowId, cellInd, state){
			//onCheck is void return event
			alog(rowId + " is onCheck.");
			//일반 체크 박스는 변경이면 실제 row 변경
			if( 1 == 2 
				){
				RowEditStatus = mygridG5.getUserData(rowId,"!nativeeditor_status");
				if(RowEditStatus == ""){
					mygridG5.setUserData(rowId,"!nativeeditor_status","updated");
					mygridG5.setRowTextBold(rowId);
					mygridG5.cells(rowId,cellInd).cell.wasChanged = true;	
				}
			}
						
		});	
		// ROW선택 이벤트
		mygridG5.attachEvent("onRowSelect",function(rowID,celInd){
			RowEditStatus = mygridG5.getUserData(rowID,"!nativeeditor_status");
			if(RowEditStatus == "inserted"){return false;}
			//GRIDRowSelect50(rowID,celInd);
			var ConAllData = $( "#condition" ).serialize();
			var RowAllData = getRowsColid(mygridG5,rowID,"G5");
			//팝업오프너 호출
			//CD[필수], NM 정보가 있는 경우 팝업 오프너에게 값 전달
			popG5json = jQuery.parseJSON('{ "__NAME":"lastinputG3json"' +
			'}');

			if(popG5json && popG5json.CD){
				goOpenerReturn(popG5json);
				return;
			}
			//LAST SELECT ROW
			//lastselectG5json = jQuery.parseJSON('{ "__NAME":"lastinputG5json"' +
			//', "USR_ID" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("USR_ID")).getValue()) + '"' +
			//', "AUTH_ROW_SUM" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("AUTH_ROW_SUM")).getValue()) + '"' +
			//'}');
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
	//로그인실패IP 그리드 초기화
function G6_INIT(){
  alog("G6_INIT()-------------------------start");

        //그리드 초기화
        mygridG6 = new dhtmlXGridObject('gridG6');
        mygridG6.setDateFormat("%Y%m%d");
        mygridG6.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG6.setUserData("","gridTitle","G6 : 로그인실패IP"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG6.setHeader("IP,LOGIN_CNT");
		mygridG6.setColumnIds("REMOTE_ADDR,LOGIN_CNT");
		mygridG6.setInitWidths("60,60");
		mygridG6.setColTypes("ro,ro");
	//가로 정렬
		mygridG6.setColAlign("left,right");
		mygridG6.setColSorting("str,int");		//렌더링
		mygridG6.enableSmartRendering(false);
		mygridG6.enableMultiselect(true);


		//mygridG6.setColValidators("G6_REMOTE_ADDR,G6_LOGIN_CNT");
		mygridG6.splitAt(0);//'freezes' 0 columns 
		mygridG6.init();

				
		//블럭선택 및 복사
		mygridG6.enableBlockSelection(true);
		mygridG6.attachEvent("onKeyPress",function(code,ctrl,shift){
			alog("onKeyPress.......code=" + code + ", ctrl=" + ctrl + ", shift=" + shift);

			//셀편집모드 아닐때만 블록처리
			if(!mygridG6.editor){
				mygridG6.setCSVDelimiter("	");
				if(code==67&&ctrl){
				   if(!mygridG6._selectionArea){
						alert("블럭을 선택해 주세요");
						return false;
					}
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
		 // IO : IP초기화	
		 // IO : LOGIN_CNT초기화	
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
			//GRIDRowSelect60(rowID,celInd);
			var ConAllData = $( "#condition" ).serialize();
			var RowAllData = getRowsColid(mygridG6,rowID,"G6");
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
			//', "REMOTE_ADDR" : "' + q(mygridG6.cells(rowID,mygridG6.getColIndexById("REMOTE_ADDR")).getValue()) + '"' +
			//', "LOGIN_CNT" : "' + q(mygridG6.cells(rowID,mygridG6.getColIndexById("LOGIN_CNT")).getValue()) + '"' +
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
	//비인가메뉴접근 그리드 초기화
function G7_INIT(){
  alog("G7_INIT()-------------------------start");

        //그리드 초기화
        mygridG7 = new dhtmlXGridObject('gridG7');
        mygridG7.setDateFormat("%Y%m%d");
        mygridG7.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG7.setUserData("","gridTitle","G7 : 비인가메뉴접근"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG7.setHeader("USR_ID,AUTH_CNT");
		mygridG7.setColumnIds("USR_ID,AUTH_CNT");
		mygridG7.setInitWidths("50,60");
		mygridG7.setColTypes("ro,ro");
	//가로 정렬
		mygridG7.setColAlign("left,right");
		mygridG7.setColSorting("str,int");		//렌더링
		mygridG7.enableSmartRendering(false);
		mygridG7.enableMultiselect(true);


		//mygridG7.setColValidators("G7_USR_ID,G7_AUTH_CNT");
		mygridG7.splitAt(0);//'freezes' 0 columns 
		mygridG7.init();

				
		//블럭선택 및 복사
		mygridG7.enableBlockSelection(true);
		mygridG7.attachEvent("onKeyPress",function(code,ctrl,shift){
			alog("onKeyPress.......code=" + code + ", ctrl=" + ctrl + ", shift=" + shift);

			//셀편집모드 아닐때만 블록처리
			if(!mygridG7.editor){
				mygridG7.setCSVDelimiter("	");
				if(code==67&&ctrl){
				   if(!mygridG7._selectionArea){
						alert("블럭을 선택해 주세요");
						return false;
					}
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
		 // IO : AUTH_CNT초기화	
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
			//GRIDRowSelect70(rowID,celInd);
			var ConAllData = $( "#condition" ).serialize();
			var RowAllData = getRowsColid(mygridG7,rowID,"G7");
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
			//', "AUTH_CNT" : "' + q(mygridG7.cells(rowID,mygridG7.getColIndexById("AUTH_CNT")).getValue()) + '"' +
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
//D146 그룹별 기능 함수 출력		
// CONDITIONSearch	
function G1_SEARCHALL(token){
	alog("G1_SEARCHALL--------------------------start");
	//입력값검증
	//폼의 모든값 구하기
	var ConAllData = $( "#condition" ).serialize();
	alog("ConAllData:" + ConAllData);
	lastinputG2 = ConAllData ;
	lastinputG3 = ConAllData ;
	lastinputG4 = ConAllData ;
	lastinputG5 = ConAllData ;
	lastinputG6 = ConAllData ;
	lastinputG7 = ConAllData ;
	//json : G1
            lastinputG2json = jQuery.parseJSON('{ "__NAME":"lastinputG2json"' +'}');
            lastinputG3json = jQuery.parseJSON('{ "__NAME":"lastinputG3json"' +'}');
            lastinputG4json = jQuery.parseJSON('{ "__NAME":"lastinputG4json"' +'}');
            lastinputG5json = jQuery.parseJSON('{ "__NAME":"lastinputG5json"' +'}');
            lastinputG6json = jQuery.parseJSON('{ "__NAME":"lastinputG6json"' +'}');
            lastinputG7json = jQuery.parseJSON('{ "__NAME":"lastinputG7json"' +'}');
	//  호출
	G2_SEARCH(lastinputG2,token);
	//  호출
	G3_SEARCH(lastinputG3,token);
	//  호출
	G4_SEARCH(lastinputG4,token);
	//  호출
	G5_SEARCH(lastinputG5,token);
	//  호출
	G6_SEARCH(lastinputG6,token);
	//  호출
	G7_SEARCH(lastinputG7,token);
	alog("G1_SEARCHALL--------------------------end");
}
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
    //그리드 조회(로그인성공)	
    function G2_SEARCH(tinput,token){
        alog("G2_SEARCH()------------start");

		var tGrid = mygridG2;

        //그리드 초기화
        tGrid.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : url_G2_SEARCH+"&TOKEN=" + token + " &G2_CRUD_MODE=read&" + tinput ,
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
						row_cnt = data.RTN_DATA.rows.length;
						$("#spanG2Cnt").text(row_cnt);

						tGrid.parse(data.RTN_DATA,"json");
						
					}
					msgNotice("[로그인성공] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[로그인성공] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[로그인성공] Ajax http 500 error ( " + error + " )",3);
                alog("[로그인성공] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearchG2()------------end");
    }
//새로고침	
function G2_RELOAD(token){
  alog("G2_RELOAD-----------------start");
  G2_SEARCH(lastinputG2,token);
}
    function G2_HIDDENCOL(){
		alog("G2_HIDDENCOL()..................start");
        if(isToggleHiddenColG2){
            isToggleHiddenColG2 = false;     }else{
            isToggleHiddenColG2 = true;
        }
		alog("G2_HIDDENCOL()..................end");
    }
//엑셀다운		
function G2_EXCEL(){	
	alog("G2_EXCEL-----------------start");
	var myForm = document.excelDownForm;
	var url = "/c.g/cg_phpexcel.php";
	window.open("" ,"popForm",
		  "toolbar=no, width=540, height=467, directories=no, status=no,    scrollorbars=no, resizable=no");
	myForm.action =url;
	myForm.method="post";
	myForm.target="popForm";

	mygridG2.setSerializationLevel(true,false,false,false,false,false);
	var myXmlString = mygridG2.serialize();        //컨디션 데이터 모두 말기
	$("#DATA_HEADERS").val("USR_ID,LOGIN_CNT");
	$("#DATA_WIDTHS").val("50,60");
	$("#DATA_ROWS").val(myXmlString);
	myForm.submit();
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
	$("#DATA_WIDTHS").val("50,60");
	$("#DATA_ROWS").val(myXmlString);
	myForm.submit();
}
//새로고침	
function G3_RELOAD(token){
  alog("G3_RELOAD-----------------start");
  G3_SEARCH(lastinputG3,token);
}
    function G3_HIDDENCOL(){
		alog("G3_HIDDENCOL()..................start");
        if(isToggleHiddenColG3){
            isToggleHiddenColG3 = false;     }else{
            isToggleHiddenColG3 = true;
        }
		alog("G3_HIDDENCOL()..................end");
    }
    //그리드 조회(잠금횟수)	
    function G3_SEARCH(tinput,token){
        alog("G3_SEARCH()------------start");

		var tGrid = mygridG3;

        //그리드 초기화
        tGrid.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : url_G3_SEARCH+"&TOKEN=" + token + " &G3_CRUD_MODE=read&" + tinput ,
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
						row_cnt = data.RTN_DATA.rows.length;
						$("#spanG3Cnt").text(row_cnt);

						tGrid.parse(data.RTN_DATA,"json");
						
					}
					msgNotice("[잠금횟수] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[잠금횟수] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[잠금횟수] Ajax http 500 error ( " + error + " )",3);
                alog("[잠금횟수] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearchG3()------------end");
    }
//새로고침	
function G4_RELOAD(token){
  alog("G4_RELOAD-----------------start");
  G4_SEARCH(lastinputG4,token);
}
    function G4_HIDDENCOL(){
		alog("G4_HIDDENCOL()..................start");
        if(isToggleHiddenColG4){
            isToggleHiddenColG4 = false;     }else{
            isToggleHiddenColG4 = true;
        }
		alog("G4_HIDDENCOL()..................end");
    }
    //그리드 조회(로그인실패)	
    function G4_SEARCH(tinput,token){
        alog("G4_SEARCH()------------start");

		var tGrid = mygridG4;

        //그리드 초기화
        tGrid.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : url_G4_SEARCH+"&TOKEN=" + token + " &G4_CRUD_MODE=read&" + tinput ,
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
						row_cnt = data.RTN_DATA.rows.length;
						$("#spanG4Cnt").text(row_cnt);

						tGrid.parse(data.RTN_DATA,"json");
						
					}
					msgNotice("[로그인실패] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[로그인실패] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[로그인실패] Ajax http 500 error ( " + error + " )",3);
                alog("[로그인실패] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearchG4()------------end");
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
	$("#DATA_HEADERS").val("USR_ID,LOGIN_CNT");
	$("#DATA_WIDTHS").val("50,60");
	$("#DATA_ROWS").val(myXmlString);
	myForm.submit();
}
//새로고침	
function G5_RELOAD(token){
  alog("G5_RELOAD-----------------start");
  G5_SEARCH(lastinputG5,token);
}
    //그리드 조회(개인정보접근)	
    function G5_SEARCH(tinput,token){
        alog("G5_SEARCH()------------start");

		var tGrid = mygridG5;

        //그리드 초기화
        tGrid.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : url_G5_SEARCH+"&TOKEN=" + token + " &G5_CRUD_MODE=read&" + tinput ,
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
						row_cnt = data.RTN_DATA.rows.length;
						$("#spanG5Cnt").text(row_cnt);

						tGrid.parse(data.RTN_DATA,"json");
						
					}
					msgNotice("[개인정보접근] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[개인정보접근] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[개인정보접근] Ajax http 500 error ( " + error + " )",3);
                alog("[개인정보접근] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearchG5()------------end");
    }
//엑셀다운		
function G5_EXCEL(){	
	alog("G5_EXCEL-----------------start");
	var myForm = document.excelDownForm;
	var url = "/c.g/cg_phpexcel.php";
	window.open("" ,"popForm",
		  "toolbar=no, width=540, height=467, directories=no, status=no,    scrollorbars=no, resizable=no");
	myForm.action =url;
	myForm.method="post";
	myForm.target="popForm";

	mygridG5.setSerializationLevel(true,false,false,false,false,false);
	var myXmlString = mygridG5.serialize();        //컨디션 데이터 모두 말기
	$("#DATA_HEADERS").val("USR_ID,AUTH_ROW_SUM");
	$("#DATA_WIDTHS").val("50,60");
	$("#DATA_ROWS").val(myXmlString);
	myForm.submit();
}
//새로고침	
function G6_RELOAD(token){
  alog("G6_RELOAD-----------------start");
  G6_SEARCH(lastinputG6,token);
}
    //그리드 조회(로그인실패IP)	
    function G6_SEARCH(tinput,token){
        alog("G6_SEARCH()------------start");

		var tGrid = mygridG6;

        //그리드 초기화
        tGrid.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : url_G6_SEARCH+"&TOKEN=" + token + " &G6_CRUD_MODE=read&" + tinput ,
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
						row_cnt = data.RTN_DATA.rows.length;
						$("#spanG6Cnt").text(row_cnt);

						tGrid.parse(data.RTN_DATA,"json");
						
					}
					msgNotice("[로그인실패IP] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[로그인실패IP] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[로그인실패IP] Ajax http 500 error ( " + error + " )",3);
                alog("[로그인실패IP] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearchG6()------------end");
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
	$("#DATA_HEADERS").val("REMOTE_ADDR,LOGIN_CNT");
	$("#DATA_WIDTHS").val("60,60");
	$("#DATA_ROWS").val(myXmlString);
	myForm.submit();
}
//새로고침	
function G7_RELOAD(token){
  alog("G7_RELOAD-----------------start");
  G7_SEARCH(lastinputG7,token);
}
    //그리드 조회(비인가메뉴접근)	
    function G7_SEARCH(tinput,token){
        alog("G7_SEARCH()------------start");

		var tGrid = mygridG7;

        //그리드 초기화
        tGrid.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : url_G7_SEARCH+"&TOKEN=" + token + " &G7_CRUD_MODE=read&" + tinput ,
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
						row_cnt = data.RTN_DATA.rows.length;
						$("#spanG7Cnt").text(row_cnt);

						tGrid.parse(data.RTN_DATA,"json");
						
					}
					msgNotice("[비인가메뉴접근] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[비인가메뉴접근] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[비인가메뉴접근] Ajax http 500 error ( " + error + " )",3);
                alog("[비인가메뉴접근] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearchG7()------------end");
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
	$("#DATA_HEADERS").val("USR_ID,AUTH_CNT");
	$("#DATA_WIDTHS").val("50,60");
	$("#DATA_ROWS").val(myXmlString);
	myForm.submit();
}
