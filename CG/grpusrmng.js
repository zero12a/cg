//글로벌 변수 선언
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SEARCHALL = "grpusrmngController?CTLGRP=G1&CTLFNC=SEARCHALL";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SAVE = "grpusrmngController?CTLGRP=G1&CTLFNC=SAVE";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_RESET = "grpusrmngController?CTLGRP=G1&CTLFNC=RESET";
// 변수 선언	
var obj_G1_GRP_SEQ; // GRP_SEQ 변수선언
var obj_G1_GRP_NM; // GRP_NM 변수선언
var obj_G1_USE_YN; // USE_YN 변수선언
//그리드 변수 초기화	
//컨트롤러 경로
var url_G2_SEARCH = "grpusrmngController?CTLGRP=G2&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G2_SAVE = "grpusrmngController?CTLGRP=G2&CTLFNC=SAVE";
//컨트롤러 경로
var url_G2_ROWDELETE = "grpusrmngController?CTLGRP=G2&CTLFNC=ROWDELETE";
//컨트롤러 경로
var url_G2_ROWADD = "grpusrmngController?CTLGRP=G2&CTLFNC=ROWADD";
//컨트롤러 경로
var url_G2_RELOAD = "grpusrmngController?CTLGRP=G2&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G2_HIDDENCOL = "grpusrmngController?CTLGRP=G2&CTLFNC=HIDDENCOL";
//그리드 객체
var mygridG2,isToggleHiddenColG2,lastinputG2,lastinputG2json,lastrowidG2;
var lastselectG2json;//그리드 변수 초기화	
//컨트롤러 경로
var url_G3_SEARCH = "grpusrmngController?CTLGRP=G3&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G3_ROWDELETE = "grpusrmngController?CTLGRP=G3&CTLFNC=ROWDELETE";
//컨트롤러 경로
var url_G3_ROWADD = "grpusrmngController?CTLGRP=G3&CTLFNC=ROWADD";
//컨트롤러 경로
var url_G3_RELOAD = "grpusrmngController?CTLGRP=G3&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G3_HIDDENCOL = "grpusrmngController?CTLGRP=G3&CTLFNC=HIDDENCOL";
//컨트롤러 경로
var url_G3_CHKSAVE = "grpusrmngController?CTLGRP=G3&CTLFNC=CHKSAVE";
//그리드 객체
var mygridG3,isToggleHiddenColG3,lastinputG3,lastinputG3json,lastrowidG3;
var lastselectG3json;//그리드 변수 초기화	
//컨트롤러 경로
var url_G4_SEARCH = "grpusrmngController?CTLGRP=G4&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G4_ROWDELETE = "grpusrmngController?CTLGRP=G4&CTLFNC=ROWDELETE";
//컨트롤러 경로
var url_G4_ROWADD = "grpusrmngController?CTLGRP=G4&CTLFNC=ROWADD";
//컨트롤러 경로
var url_G4_RELOAD = "grpusrmngController?CTLGRP=G4&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G4_HIDDENCOL = "grpusrmngController?CTLGRP=G4&CTLFNC=HIDDENCOL";
//컨트롤러 경로
var url_G4_CHKSAVE = "grpusrmngController?CTLGRP=G4&CTLFNC=CHKSAVE";
//그리드 객체
var mygridG4,isToggleHiddenColG4,lastinputG4,lastinputG4json,lastrowidG4;
var lastselectG4json;//화면 초기화	
function initBody(){
     alog("initBody()-----------------------start");
	
   //dhtmlx 메시지 박스 초기화
   dhtmlx.message.position="bottom";
	G1_INIT();	
		G2_INIT();	
		G3_INIT();	
		G4_INIT();	
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



	//각 폼 오브젝트들 초기화
	//GRP_NM, GRP_NM 초기화	
	//USE_YN, USE_YN 초기화	
  alog("G1_INIT()-------------------------end");
}

	//그룹 그리드 초기화
function G2_INIT(){
  alog("G2_INIT()-------------------------start");

        //그리드 초기화
        mygridG2 = new dhtmlXGridObject('gridG2');
        mygridG2.setDateFormat("%Y%m%d");
        mygridG2.setImagePath("lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG2.setUserData("","gridTitle","G2 : 그룹"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG2.setHeader("GRP_SEQ,GRP_NM,USE_YN,ADD,MOD");
		mygridG2.setColumnIds("GRP_SEQ,GRP_NM,USE_YN,ADD_DT,MOD_DT");
		mygridG2.setInitWidths("60,120,60,60,60");
		mygridG2.setColTypes("ro,ed,ed,ro,ro");
	//가로 정렬	
		mygridG2.setColAlign("left,left,left,,");
		mygridG2.setColSorting("str,str,str,str,str");		//렌더링	
		mygridG2.enableSmartRendering(false);
		mygridG2.enableMultiselect(true);
		//mygridG2.setColValidators("G2_GRP_SEQ,G2_GRP_NM,G2_USE_YN,G2_ADD_DT,G2_MOD_DT");
		mygridG2.splitAt(0);//'freezes' 0 columns 
		mygridG2.init();

		mygridG2.attachEvent("onDhxCalendarCreated", function(myCal){ myCal.loadUserLanguage( "kr" ); });
		//블럭선택 및 복사
		mygridG2.enableBlockSelection(true);
		mygridG2.attachEvent("onKeyPress",function(code,ctrl,shift){
			alog("onKeyPress.......code=" + code + ", ctrl=" + ctrl + ", shift=" + shift);

			//셀편집모드 아닐때만 블록처리
			if(!mygridG2.editor){
				mygridG2.setCSVDelimiter("	");
				if(code==67&&ctrl){
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
		 // IO : GRP_SEQ초기화	
		 // IO : GRP_NM초기화	
		 // IO : USE_YN초기화	
		 // IO : ADD초기화	
		 // IO : MOD초기화	
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
			//', "GRP_SEQ" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("GRP_SEQ")).getValue()) + '"' +
			//', "GRP_NM" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("GRP_NM")).getValue()) + '"' +
			//', "USE_YN" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("USE_YN")).getValue()) + '"' +
			//', "ADD_DT" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("ADD_DT")).getValue()) + '"' +
			//', "MOD_DT" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("MOD_DT")).getValue()) + '"' +
			//'}');
		//A124
			lastinputG3json = jQuery.parseJSON('{ "__NAME":"lastinputG3json"' +
				', "G2-GRP_SEQ" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("GRP_SEQ")).getValue()) + '"' +
			'}');
		lastinputG3 = new HashMap(); // 그룹에 속함
		lastinputG3.set("G2-GRP_SEQ", mygridG2.cells(rowID,mygridG2.getColIndexById("GRP_SEQ")).getValue().replace(/&amp;/g, "&")); // 
			lastinputG4json = jQuery.parseJSON('{ "__NAME":"lastinputG4json"' +
				', "G2-GRP_SEQ" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("GRP_SEQ")).getValue()) + '"' +
			'}');
		lastinputG4 = new HashMap(); // 해당그룹에 미포함
		lastinputG4.set("G2-GRP_SEQ", mygridG2.cells(rowID,mygridG2.getColIndexById("GRP_SEQ")).getValue().replace(/&amp;/g, "&")); // 
			G3_SEARCH(lastinputG3,uuidv4()); //자식그룹 호출 : 그룹에 속함
			G4_SEARCH(lastinputG4,uuidv4()); //자식그룹 호출 : 해당그룹에 미포함
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
	//그룹에 속함 그리드 초기화
function G3_INIT(){
  alog("G3_INIT()-------------------------start");

        //그리드 초기화
        mygridG3 = new dhtmlXGridObject('gridG3');
        mygridG3.setDateFormat("%Y%m%d");
        mygridG3.setImagePath("lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG3.setUserData("","gridTitle","G3 : 그룹에 속함"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG3.setHeader("#master_checkbox,GRP_SEQ,USR_SEQ,USR_ID,USR_NM,ADD,ADD_ID");
		mygridG3.setColumnIds("CHK,GRP_SEQ,USR_SEQ,USR_ID,USR_NM,ADD_DT,ADD_ID");
		mygridG3.setInitWidths("50,60,60,60,60,60,60");
		mygridG3.setColTypes("ch,ro,ro,ro,ro,ro,ro");
	//가로 정렬	
		mygridG3.setColAlign("center,left,left,left,left,left,left");
		mygridG3.setColSorting("int,str,int,str,str,str,str");		//렌더링	
		mygridG3.enableSmartRendering(false);
		mygridG3.enableMultiselect(true);
		//mygridG3.setColValidators("G3_CHK,G3_GRP_SEQ,G3_USR_SEQ,G3_USR_ID,G3_USR_NM,G3_ADD_DT,G3_ADD_ID");
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
		 // IO : CHK초기화	
		 // IO : GRP_SEQ초기화	
		 // IO : USR_SEQ초기화	
		 // IO : USR_ID초기화	
		 // IO : USR_NM초기화	
		 // IO : ADD초기화	
		 // IO : ADD_ID초기화	
	//onCheck
		mygridG3.attachEvent("onCheck",function(rowId, cellInd, state){
			//onCheck is void return event
			alog(rowId + " is onCheck.");
			//ROW 마스터 체크 박스는 변경이면 실제 row 안함
			if(  mygridG3.getColumnId(cellInd) == "ROWCHK" ){
					mygridG3.cells(rowId,cellInd).cell.wasChanged = false;	
			}	
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
			//', "CHK" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("CHK")).getValue()) + '"' +
			//', "GRP_SEQ" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("GRP_SEQ")).getValue()) + '"' +
			//', "USR_SEQ" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("USR_SEQ")).getValue()) + '"' +
			//', "USR_ID" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("USR_ID")).getValue()) + '"' +
			//', "USR_NM" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("USR_NM")).getValue()) + '"' +
			//', "ADD_DT" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("ADD_DT")).getValue()) + '"' +
			//', "ADD_ID" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("ADD_ID")).getValue()) + '"' +
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
		mygridG3.setColumnHidden(mygridG3.getColIndexById("GRP_SEQ"),true); //GRP_SEQ
		mygridG3.setColumnHidden(mygridG3.getColIndexById("USR_SEQ"),true); //USR_SEQ
        alog("G3_INIT()-------------------------end");
     }
	//해당그룹에 미포함 그리드 초기화
function G4_INIT(){
  alog("G4_INIT()-------------------------start");

        //그리드 초기화
        mygridG4 = new dhtmlXGridObject('gridG4');
        mygridG4.setDateFormat("%Y%m%d");
        mygridG4.setImagePath("lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG4.setUserData("","gridTitle","G4 : 해당그룹에 미포함"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG4.setHeader("#master_checkbox,USR_SEQ,USR_ID,USR_NM");
		mygridG4.setColumnIds("CHK,USR_SEQ,USR_ID,USR_NM");
		mygridG4.setInitWidths("50,60,60,60");
		mygridG4.setColTypes("ch,ro,ed,ed");
	//가로 정렬	
		mygridG4.setColAlign("left,left,left,left");
		mygridG4.setColSorting("int,int,str,str");		//렌더링	
		mygridG4.enableSmartRendering(false);
		mygridG4.enableMultiselect(true);
		//mygridG4.setColValidators("G4_CHK,G4_USR_SEQ,G4_USR_ID,G4_USR_NM");
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
		 // IO : CHK초기화	
		 // IO : USR_SEQ초기화	
		 // IO : USR_ID초기화	
		 // IO : USR_NM초기화	
	//onCheck
		mygridG4.attachEvent("onCheck",function(rowId, cellInd, state){
			//onCheck is void return event
			alog(rowId + " is onCheck.");
			//ROW 마스터 체크 박스는 변경이면 실제 row 안함
			if(  mygridG4.getColumnId(cellInd) == "ROWCHK" ){
					mygridG4.cells(rowId,cellInd).cell.wasChanged = false;	
			}	
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
			//', "CHK" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("CHK")).getValue()) + '"' +
			//', "USR_SEQ" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("USR_SEQ")).getValue()) + '"' +
			//', "USR_ID" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("USR_ID")).getValue()) + '"' +
			//', "USR_NM" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("USR_NM")).getValue()) + '"' +
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
		mygridG4.setColumnHidden(mygridG4.getColIndexById("USR_SEQ"),true); //USR_SEQ
        alog("G4_INIT()-------------------------end");
     }
//D146 그룹별 기능 함수 출력		
// CONDITIONSearch	
function G1_SEARCHALL(token){
	alog("G1_SEARCHALL--------------------------start");
	//입력값검증
	//폼의 모든값 구하기
	var ConAllData = $( "#condition" ).serialize();
	alog("ConAllData:" + ConAllData);
	//json : G1
			lastinputG2 = new HashMap(); //그룹
		//  호출
	G2_SEARCH(lastinputG2,token);
	alog("G1_SEARCHALL--------------------------end");
}
//검색조건 초기화
function G1_RESET(){
	alog("G1_RESET--------------------------start");
	$('#condition')[0].reset();
}
//, 저장	
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








    //그리드 조회(그룹)	
    function G2_SEARCH(tinput,token){
        alog("G2_SEARCH()------------start");

		var tGrid = mygridG2;

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
            url : url_G2_SEARCH+"&TOKEN=" + token + " &G2_CRUD_MODE=read" ,
            data : sendFormData,
			processData: false,
			contentType: false,
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridG2 json return----------------------");
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
						tGrid.parse(data.RTN_DATA,function(){
							//푸터 합계 처리	

						},"json");
						
					}else{
						$("#spanG2Cnt").text("-");
					}
					msgNotice("[그룹] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[그룹] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[그룹] Ajax http 500 error ( " + error + " )",3);
                alog("[그룹] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
        alog("G2_SEARCH()------------end");
    }

//행추가3 (그룹)	
//그리드 행추가 : 그룹
	function G2_ROWADD(){
		if( !(lastinputG2)){
			msgError("조회 후에 행추가 가능합니다. 또는 상속값이 없습니다.",3);
		}else{
			var tCols = ["","","","",""];//초기값
			addRow(mygridG2,tCols);
		}
	}    function G2_HIDDENCOL(){
		alog("G2_HIDDENCOL()..................start");
        if(isToggleHiddenColG2){
            isToggleHiddenColG2 = false;     }else{
            isToggleHiddenColG2 = true;
        }
		alog("G2_HIDDENCOL()..................end");
    }
    function G2_ROWDELETE(){	
        alog("G2_ROWDELETE()------------start");
        delRow(mygridG2);
        alog("G2_ROWDELETE()------------start");
    }
	function G2_SAVE(token){
	alog("G2_SAVE()------------start");
	tgrid = mygridG2;

	tgrid.setSerializationLevel(true,false,false,false,true,false);
	var myXmlString = tgrid.serialize();
        //post 만들기
		sendFormData = new FormData($("#condition")[0]);
		//for(var pair of lastinputG2.entries()) {
		//	sendFormData.append(pair[0],pair[1]);
   		//	//console.log(pair[0]+ ', '+ pair[1]); 
		//}

		if(typeof lastinputG2 != "undefined"){
			var tKeys = lastinputG2.keys();
			for(i=0;i<tKeys.length;i++) {
				sendFormData.append(tKeys[i],lastinputG2.get(tKeys[i]));
				//console.log(tKeys[i]+ '='+ lastinputG2.get(tKeys[i])); 
			}
		}
	sendFormData.append("G2-XML" , myXmlString);
	$.ajax({
		type : "POST",
		url : url_G2_SAVE + "&TOKEN=" + token,
		data : sendFormData,
		processData: false,
		contentType: false,
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
	
	alog("G2_SAVE()------------end");
}
//새로고침	
function G2_RELOAD(token){
  alog("G2_RELOAD-----------------start");
  G2_SEARCH(lastinputG2,token);
}
    function G3_HIDDENCOL(){
		alog("G3_HIDDENCOL()..................start");
        if(isToggleHiddenColG3){
            isToggleHiddenColG3 = false;            mygridG3.setColumnHidden(mygridG3.getColIndexById("GRP_SEQ"),true); //GRP_SEQ
            mygridG3.setColumnHidden(mygridG3.getColIndexById("USR_SEQ"),true); //USR_SEQ
     }else{
            isToggleHiddenColG3 = true;
            mygridG3.setColumnHidden(mygridG3.getColIndexById("GRP_SEQ"),false); //GRP_SEQ
            mygridG3.setColumnHidden(mygridG3.getColIndexById("USR_SEQ"),false); //USR_SEQ
        }
		alog("G3_HIDDENCOL()..................end");
    }
    function G3_ROWDELETE(){	
        alog("G3_ROWDELETE()------------start");
        delRow(mygridG3);
        alog("G3_ROWDELETE()------------start");
    }








    //그리드 조회(그룹에 속함)	
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
					msgNotice("[그룹에 속함] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[그룹에 속함] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[그룹에 속함] Ajax http 500 error ( " + error + " )",3);
                alog("[그룹에 속함] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
        alog("G3_SEARCH()------------end");
    }

//새로고침	
function G3_RELOAD(token){
  alog("G3_RELOAD-----------------start");
  G3_SEARCH(lastinputG3,token);
}
function G3_CHKSAVE(token){
	alog("G3_CHKSAVE()------------start");
	tgrid = mygridG3;

	//체크된 ROW의 ID 배열로 불러오기
	var arrRows =  tgrid.getCheckedRows(0); //0번째 CHK 컬럼
	//alert(arrRows.length);

        //전송용 post 만들기
		sendFormData = new FormData($("#condition")[0]);

		if(typeof lastinputG3 != "undefined"){
			var tKeys = lastinputG3.keys();
			for(i=0;i<tKeys.length;i++) {
				sendFormData.append(tKeys[i],lastinputG3.get(tKeys[i]));
				//console.log(tKeys[i]+ '='+ lastinputG3.get(tKeys[i])); 
			}
		}
	//CHK 배열 합치기
	sendFormData.append("G3-CHK",arrRows);
	$.ajax({
		type : "POST",
		url : url_G3_CHKSAVE + "&TOKEN=" + token,
		data : sendFormData,
		processData: false,
		contentType: false,
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
	
	alog("G3_CHKSAVE()------------end");
}
//행추가3 (그룹에 속함)	
//그리드 행추가 : 그룹에 속함
	function G3_ROWADD(){
		if( !(lastinputG3)|| lastinputG3.get("G3-GRP_SEQ") == ""){
			msgError("조회 후에 행추가 가능합니다. 또는 상속값이 없습니다.",3);
		}else{
			var tCols = ["",lastinputG3.get("G2-GRP_SEQ"),"","","","",""];//초기값
			addRow(mygridG3,tCols);
		}
	}    function G4_HIDDENCOL(){
		alog("G4_HIDDENCOL()..................start");
        if(isToggleHiddenColG4){
            isToggleHiddenColG4 = false;            mygridG4.setColumnHidden(mygridG4.getColIndexById("USR_SEQ"),true); //USR_SEQ
     }else{
            isToggleHiddenColG4 = true;
            mygridG4.setColumnHidden(mygridG4.getColIndexById("USR_SEQ"),false); //USR_SEQ
        }
		alog("G4_HIDDENCOL()..................end");
    }
    function G4_ROWDELETE(){	
        alog("G4_ROWDELETE()------------start");
        delRow(mygridG4);
        alog("G4_ROWDELETE()------------start");
    }
//새로고침	
function G4_RELOAD(token){
  alog("G4_RELOAD-----------------start");
  G4_SEARCH(lastinputG4,token);
}








    //그리드 조회(해당그룹에 미포함)	
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
					msgNotice("[해당그룹에 미포함] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[해당그룹에 미포함] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[해당그룹에 미포함] Ajax http 500 error ( " + error + " )",3);
                alog("[해당그룹에 미포함] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
        alog("G4_SEARCH()------------end");
    }

//행추가3 (해당그룹에 미포함)	
//그리드 행추가 : 해당그룹에 미포함
	function G4_ROWADD(){
		if( !(lastinputG4)|| lastinputG4.get("G4-GRP_SEQ") == ""){
			msgError("조회 후에 행추가 가능합니다. 또는 상속값이 없습니다.",3);
		}else{
			var tCols = ["","","",""];//초기값
			addRow(mygridG4,tCols);
		}
	}function G4_CHKSAVE(token){
	alog("G4_CHKSAVE()------------start");
	tgrid = mygridG4;

	//체크된 ROW의 ID 배열로 불러오기
	var arrRows =  tgrid.getCheckedRows(0); //0번째 CHK 컬럼
	//alert(arrRows.length);

        //전송용 post 만들기
		sendFormData = new FormData($("#condition")[0]);

		if(typeof lastinputG4 != "undefined"){
			var tKeys = lastinputG4.keys();
			for(i=0;i<tKeys.length;i++) {
				sendFormData.append(tKeys[i],lastinputG4.get(tKeys[i]));
				//console.log(tKeys[i]+ '='+ lastinputG4.get(tKeys[i])); 
			}
		}
	//CHK 배열 합치기
	sendFormData.append("G4-CHK",arrRows);
	$.ajax({
		type : "POST",
		url : url_G4_CHKSAVE + "&TOKEN=" + token,
		data : sendFormData,
		processData: false,
		contentType: false,
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
	
	alog("G4_CHKSAVE()------------end");
}
