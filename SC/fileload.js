//글로벌 변수 선언	
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SEARCHALL = "fileloadController?CTLGRP=G1&CTLFNC=SEARCHALL";//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SAVE = "fileloadController?CTLGRP=G1&CTLFNC=SAVE";//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_RESET = "fileloadController?CTLGRP=G1&CTLFNC=RESET";//2 변수 선언	
var obj_G1_FILE_NM_valid = jQuery.parseJSON( '{ "G1_FILE_NM": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":1000,  "DATATYPE":"STRING"} }' );  //FILE_NM  밸리데이션
var obj_G1_TEAM_NM_valid = jQuery.parseJSON( '{ "G1_TEAM_NM": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":300,  "DATATYPE":"STRING"} }' );  //TEAM_NM  밸리데이션
var obj_G1_ADD_DT_valid = jQuery.parseJSON( '{ "G1_ADD_DT": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":14,  "DATATYPE":"STRING"} }' );  //ADD_DT  밸리데이션
var obj_G1_FILE_NM; // FILE_NM 변수선언var obj_G1_TEAM_NM; // TEAM_NM 변수선언var obj_G1_ADD_DT; // ADD_DT 변수선언//그리드 변수 초기화	
//컨트롤러 경로
var url_G2_SEARCH = "fileloadController?CTLGRP=G2&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G2_SAVE = "fileloadController?CTLGRP=G2&CTLFNC=SAVE";
//컨트롤러 경로
var url_G2_ROWDELETE = "fileloadController?CTLGRP=G2&CTLFNC=ROWDELETE";
//컨트롤러 경로
var url_G2_ROWBULKADD = "fileloadController?CTLGRP=G2&CTLFNC=ROWBULKADD";
//컨트롤러 경로
var url_G2_ROWADD = "fileloadController?CTLGRP=G2&CTLFNC=ROWADD";
//컨트롤러 경로
var url_G2_RELOAD = "fileloadController?CTLGRP=G2&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G2_HIDDENCOL = "fileloadController?CTLGRP=G2&CTLFNC=HIDDENCOL";
//컨트롤러 경로
var url_G2_EXCEL = "fileloadController?CTLGRP=G2&CTLFNC=EXCEL";
//컨트롤러 경로
var url_G2_CHKSAVE = "fileloadController?CTLGRP=G2&CTLFNC=CHKSAVE";
//그리드 객체
var mygridG2,isToggleHiddenColG2,lastinputG2,lastinputG2json,lastrowidG2;
var lastselectG2json;//그리드 변수 초기화	
//컨트롤러 경로
var url_G3_SEARCH = "fileloadController?CTLGRP=G3&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G3_SAVE = "fileloadController?CTLGRP=G3&CTLFNC=SAVE";
//컨트롤러 경로
var url_G3_ROWDELETE = "fileloadController?CTLGRP=G3&CTLFNC=ROWDELETE";
//컨트롤러 경로
var url_G3_ROWBULKADD = "fileloadController?CTLGRP=G3&CTLFNC=ROWBULKADD";
//컨트롤러 경로
var url_G3_ROWADD = "fileloadController?CTLGRP=G3&CTLFNC=ROWADD";
//컨트롤러 경로
var url_G3_RELOAD = "fileloadController?CTLGRP=G3&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G3_HIDDENCOL = "fileloadController?CTLGRP=G3&CTLFNC=HIDDENCOL";
//컨트롤러 경로
var url_G3_EXCEL = "fileloadController?CTLGRP=G3&CTLFNC=EXCEL";
//컨트롤러 경로
var url_G3_CHKSAVE = "fileloadController?CTLGRP=G3&CTLFNC=CHKSAVE";
//그리드 객체
var mygridG3,isToggleHiddenColG3,lastinputG3,lastinputG3json,lastrowidG3;
var lastselectG3json;//화면 초기화	
function initBody(){
     alog("initBody()-----------------------start");
	
   //dhtmlx 메시지 박스 초기화
   dhtmlx.message.position="bottom";
	G1_INIT();	
		G2_INIT();	
		G3_INIT();	
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
	//FILE_NM, FILE_NM 초기화	
	//TEAM_NM, TEAM_NM 초기화	
	//ADD_DT, ADD_DT 초기화	
  alog("G1_INIT()-------------------------end");
}

	//3 그리드 초기화
function G2_INIT(){
  alog("G2_INIT()-------------------------start");

        //그리드 초기화
        mygridG2 = new dhtmlXGridObject('gridG2');
        mygridG2.setDateFormat("%Y%m%d");
        mygridG2.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG2.setUserData("","gridTitle","G2 : 3"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG2.setHeader("#master_checkbox,SEQ,FILE_NM,TEAM_NM,TEAM_NM_LEN,SYS_NM,SYS_NM_LEN,SUBSYS_NM,SUBSYS_NM_LEN,FILE_HASH,XML_VERSION,XML_TIMESTAMP,XML_ANAL_TIMESTAMP,XML_DT,XML_ANAL_DT,BUG_CNT,LOAD_END_DT,ADD_DT,MOD_DT");
		mygridG2.setColumnIds("CHK,LOAD_SEQ,FILE_NM,TEAM_NM,TEAM_NM_LEN,SYS_NM,SYS_NM_LEN,SUBSYS_NM,SUBSYS_NM_LEN,FILE_HASH,XML_VERSION,XML_TIMESTAMP,XML_ANAL_TIMESTAMP,XML_DT,XML_ANAL_DT,BUG_CNT,LOAD_END_DT,ADD_DT,MOD_DT");
		mygridG2.setInitWidths("60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60");
		mygridG2.setColTypes("ch,ro,ro,ed,ro,ed,ro,ed,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
	//가로 정렬	
		mygridG2.setColAlign("left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left");
		mygridG2.setColSorting("str,int,str,str,int,str,int,str,int,str,str,str,str,str,str,int,str,str,str");		//렌더링	
		mygridG2.enableSmartRendering(false);
		mygridG2.enableMultiselect(true);
		//mygridG2.setColValidators("G2_CHK,G2_LOAD_SEQ,G2_FILE_NM,G2_TEAM_NM,G2_TEAM_NM_LEN,G2_SYS_NM,G2_SYS_NM_LEN,G2_SUBSYS_NM,G2_SUBSYS_NM_LEN,G2_FILE_HASH,G2_XML_VERSION,G2_XML_TIMESTAMP,G2_XML_ANAL_TIMESTAMP,G2_XML_DT,G2_XML_ANAL_DT,G2_BUG_CNT,G2_LOAD_END_DT,G2_ADD_DT,G2_MOD_DT");
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
		 // IO : CHK초기화	
		 // IO : SEQ초기화	
		 // IO : FILE_NM초기화	
		 // IO : TEAM_NM초기화	
		 // IO : TEAM_NM_LEN초기화	
		 // IO : SYS_NM초기화	
		 // IO : SYS_NM_LEN초기화	
		 // IO : SUBSYS_NM초기화	
		 // IO : SUBSYS_NM_LEN초기화	
		 // IO : FILE_HASH초기화	
		 // IO : XML_VERSION초기화	
		 // IO : XML_TIMESTAMP초기화	
		 // IO : XML_ANAL_TIMESTAMP초기화	
		 // IO : XML_DT초기화	
		 // IO : XML_ANAL_DT초기화	
		 // IO : BUG_CNT초기화	
		 // IO : LOAD_END_DT초기화	
		 // IO : ADD_DT초기화	
		 // IO : MOD_DT초기화	
	//onCheck
		mygridG2.attachEvent("onCheck",function(rowId, cellInd, state){
			//onCheck is void return event
			alog(rowId + " is onCheck.");
			//ROW 마스터 체크 박스는 변경이면 실제 row 안함
			if(  mygridG2.getColumnId(cellInd) == "ROWCHK" ){
					mygridG2.cells(rowId,cellInd).cell.wasChanged = false;	
			}	
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
			//', "CHK" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("CHK")).getValue()) + '"' +
			//', "LOAD_SEQ" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("LOAD_SEQ")).getValue()) + '"' +
			//', "FILE_NM" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("FILE_NM")).getValue()) + '"' +
			//', "TEAM_NM" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("TEAM_NM")).getValue()) + '"' +
			//', "TEAM_NM_LEN" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("TEAM_NM_LEN")).getValue()) + '"' +
			//', "SYS_NM" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("SYS_NM")).getValue()) + '"' +
			//', "SYS_NM_LEN" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("SYS_NM_LEN")).getValue()) + '"' +
			//', "SUBSYS_NM" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("SUBSYS_NM")).getValue()) + '"' +
			//', "SUBSYS_NM_LEN" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("SUBSYS_NM_LEN")).getValue()) + '"' +
			//', "FILE_HASH" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("FILE_HASH")).getValue()) + '"' +
			//', "XML_VERSION" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("XML_VERSION")).getValue()) + '"' +
			//', "XML_TIMESTAMP" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("XML_TIMESTAMP")).getValue()) + '"' +
			//', "XML_ANAL_TIMESTAMP" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("XML_ANAL_TIMESTAMP")).getValue()) + '"' +
			//', "XML_DT" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("XML_DT")).getValue()) + '"' +
			//', "XML_ANAL_DT" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("XML_ANAL_DT")).getValue()) + '"' +
			//', "BUG_CNT" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("BUG_CNT")).getValue()) + '"' +
			//', "LOAD_END_DT" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("LOAD_END_DT")).getValue()) + '"' +
			//', "ADD_DT" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("ADD_DT")).getValue()) + '"' +
			//', "MOD_DT" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("MOD_DT")).getValue()) + '"' +
			//'}');
		//A124
			lastinputG3json = jQuery.parseJSON('{ "__NAME":"lastinputG3json"' +
				', "G2-LOAD_SEQ" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("LOAD_SEQ")).getValue()) + '"' +
			'}');
		lastinputG3 = new FormData(); // 4
		lastinputG3.append("G2-LOAD_SEQ", mygridG2.cells(rowID,mygridG2.getColIndexById("LOAD_SEQ")).getValue().replace(/&amp;/g, "&")); // 
		G3_SEARCH(lastinputG3,uuidv4()); //자식그룹 호출 : 4
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
	//4 그리드 초기화
function G3_INIT(){
  alog("G3_INIT()-------------------------start");

        //그리드 초기화
        mygridG3 = new dhtmlXGridObject('gridG3');
        mygridG3.setDateFormat("%Y%m%d");
        mygridG3.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG3.setUserData("","gridTitle","G3 : 4"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG3.setHeader("LOADD_SEQ,SEQ,TYPE,우선순위,CLASSNAME,CLASS_LINE_S,CLASS_LINE_E,SOURCEFILE,SOURCEPATH,METHOD_NAME,METHOD_LINE_S,METHOD_LINE_E,FIELD_NAME,FIELD_LINE_S,FIELD_LINE_E,LINE_CNT,BIG_LINE_S,ADD_DT");
		mygridG3.setColumnIds("LOADD_SEQ,LOAD_SEQ,TYPE,PRIORITY,CLASSNAME,CLASS_LINE_S,CLASS_LINE_E,SOURCEFILE,SOURCEPATH,METHOD_NAME,METHOD_LINE_S,METHOD_LINE_E,FIELD_NAME,FIELD_LINE_S,FIELD_LINE_E,LINE_CNT,BUG_LINE_S,ADD_DT");
		mygridG3.setInitWidths("60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60");
		mygridG3.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
	//가로 정렬	
		mygridG3.setColAlign("left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left");
		mygridG3.setColSorting("int,int,str,int,str,int,int,str,str,str,int,int,str,int,int,int,int,str");		//렌더링	
		mygridG3.enableSmartRendering(false);
		mygridG3.enableMultiselect(true);
		//mygridG3.setColValidators("G3_LOADD_SEQ,G3_LOAD_SEQ,G3_TYPE,G3_PRIORITY,G3_CLASSNAME,G3_CLASS_LINE_S,G3_CLASS_LINE_E,G3_SOURCEFILE,G3_SOURCEPATH,G3_METHOD_NAME,G3_METHOD_LINE_S,G3_METHOD_LINE_E,G3_FIELD_NAME,G3_FIELD_LINE_S,G3_FIELD_LINE_E,G3_LINE_CNT,G3_BUG_LINE_S,G3_ADD_DT");
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
		 // IO : LOADD_SEQ초기화	
		 // IO : SEQ초기화	
		 // IO : TYPE초기화	
		 // IO : 우선순위초기화	
		 // IO : CLASSNAME초기화	
		 // IO : CLASS_LINE_S초기화	
		 // IO : CLASS_LINE_E초기화	
		 // IO : SOURCEFILE초기화	
		 // IO : SOURCEPATH초기화	
		 // IO : METHOD_NAME초기화	
		 // IO : METHOD_LINE_S초기화	
		 // IO : METHOD_LINE_E초기화	
		 // IO : FIELD_NAME초기화	
		 // IO : FIELD_LINE_S초기화	
		 // IO : FIELD_LINE_E초기화	
		 // IO : LINE_CNT초기화	
		 // IO : BIG_LINE_S초기화	
		 // IO : ADD_DT초기화	
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
			//', "LOADD_SEQ" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("LOADD_SEQ")).getValue()) + '"' +
			//', "LOAD_SEQ" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("LOAD_SEQ")).getValue()) + '"' +
			//', "TYPE" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("TYPE")).getValue()) + '"' +
			//', "PRIORITY" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("PRIORITY")).getValue()) + '"' +
			//', "CLASSNAME" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("CLASSNAME")).getValue()) + '"' +
			//', "CLASS_LINE_S" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("CLASS_LINE_S")).getValue()) + '"' +
			//', "CLASS_LINE_E" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("CLASS_LINE_E")).getValue()) + '"' +
			//', "SOURCEFILE" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("SOURCEFILE")).getValue()) + '"' +
			//', "SOURCEPATH" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("SOURCEPATH")).getValue()) + '"' +
			//', "METHOD_NAME" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("METHOD_NAME")).getValue()) + '"' +
			//', "METHOD_LINE_S" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("METHOD_LINE_S")).getValue()) + '"' +
			//', "METHOD_LINE_E" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("METHOD_LINE_E")).getValue()) + '"' +
			//', "FIELD_NAME" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("FIELD_NAME")).getValue()) + '"' +
			//', "FIELD_LINE_S" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("FIELD_LINE_S")).getValue()) + '"' +
			//', "FIELD_LINE_E" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("FIELD_LINE_E")).getValue()) + '"' +
			//', "LINE_CNT" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("LINE_CNT")).getValue()) + '"' +
			//', "BUG_LINE_S" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("BUG_LINE_S")).getValue()) + '"' +
			//', "ADD_DT" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("ADD_DT")).getValue()) + '"' +
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
//D146 그룹별 기능 함수 출력		
//검색조건 초기화
function G1_RESET(){
	alog("G1_RESET--------------------------start");
	$('#condition')[0].reset();
}
//2, 저장	
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
	lastinputG2 = new FormData(); //3
	//json : G1
            lastinputG2json = jQuery.parseJSON('{ "__NAME":"lastinputG2json"' +'}');
	//  호출
	G2_SEARCH(lastinputG2,token);
	alog("G1_SEARCHALL--------------------------end");
}
//새로고침	
function G2_RELOAD(token){
  alog("G2_RELOAD-----------------start");
  G2_SEARCH(lastinputG2,token);
}
	function G2_SAVE(token){
	alog("G2_SAVE()------------start");
	tgrid = mygridG2;

	tgrid.setSerializationLevel(true,false,false,false,true,false);
	var myXmlString = tgrid.serialize();
        //post 만들기
		sendFormData = new FormData($("#condition")[0]);
		for(var pair of lastinputG2.entries()) {
			sendFormData.append(pair[0],pair[1]);
   			//console.log(pair[0]+ ', '+ pair[1]); 
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
function G2_CHKSAVE(){
	alog("G2_CHKSAVE()------------start");
	tgrid = mygridG2;

	//체크된 ROW의 ID 배열로 불러오기
	var arrRows =  tgrid.getCheckedRows(0); //0번째 CHK 컬럼
	//alert(arrRows.length);

        //전송용 post 만들기
		sendFormData = new FormData($("#condition")[0]);
		for(var pair of lastinputG2.entries()) {
			sendFormData.append(pair[0],pair[1]);
   			//console.log(pair[0]+ ', '+ pair[1]); 
		}	//CHK 배열 합치기
	sendFormData.append("G2-CHK",arrRows);
	$.ajax({
		type : "POST",
		url : url_G2_CHKSAVE + "&" + lastinputG2 ,
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
	
	alog("G2_CHKSAVE()------------end");
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
	$("#DATA_HEADERS").val("CHK,LOAD_SEQ,FILE_NM,TEAM_NM,TEAM_NM_LEN,SYS_NM,SYS_NM_LEN,SUBSYS_NM,SUBSYS_NM_LEN,FILE_HASH,XML_VERSION,XML_TIMESTAMP,XML_ANAL_TIMESTAMP,XML_DT,XML_ANAL_DT,BUG_CNT,LOAD_END_DT,ADD_DT,MOD_DT");
	$("#DATA_WIDTHS").val("60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60");
	$("#DATA_ROWS").val(myXmlString);
	myForm.submit();
}
    function G2_ROWDELETE(){	
        alog("G2_ROWDELETE()------------start");
        delRow(mygridG2);
        alog("G2_ROWDELETE()------------start");
    }
    function G2_HIDDENCOL(){
		alog("G2_HIDDENCOL()..................start");
        if(isToggleHiddenColG2){
            isToggleHiddenColG2 = false;     }else{
            isToggleHiddenColG2 = true;
        }
		alog("G2_HIDDENCOL()..................end");
    }
//행추가3 (3)	
//그리드 행추가 : 3
	function G2_ROWADD(){
		if( !(lastinputG2)){
			msgError("조회 후에 행추가 가능합니다. 또는 상속값이 없습니다.",3);
		}else{
			var tCols = ["","","","","","","","","","","","","","","","","","",""];//초기값
			addRow(mygridG2,tCols);
		}
	}//그리드 행추가 : 3
	function G2_ROWBULKADD(){
		if( !(lastinputG2json)){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = ["","","","","","","","","","","","","","","","","","",""];//초기값

	var rowcnt = prompt("Please enter row's count", "input number");
	if($.isNumeric(rowcnt)){
		for(k=0;k<rowcnt;k++){
			addRow(mygridG2,tCols);  
		}
	}
			}
	}








    //그리드 조회(3)	
    function G2_SEARCH(tinput,token){
        alog("G2_SEARCH()------------start");

		var tGrid = mygridG2;

        //그리드 초기화
        tGrid.clearAll();        //post 만들기
		sendFormData = new FormData($("#condition")[0]);
		if(typeof tinput != "undefined"){
			for(var pair of tinput.entries()) {
				sendFormData.append(pair[0],pair[1]);
				//console.log(pair[0]+ ', '+ pair[1]); 
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
						$("#spanG2Cnt").text(row_cnt);						tGrid.parse(data.RTN_DATA,function(){
							//푸터 합계 처리	

						},"json");
						
					}
					msgNotice("[3] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[3] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[3] Ajax http 500 error ( " + error + " )",3);
                alog("[3] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
        alog("G2_SEARCH()------------end");
    }

//새로고침	
function G3_RELOAD(token){
  alog("G3_RELOAD-----------------start");
  G3_SEARCH(lastinputG3,token);
}
	function G3_SAVE(token){
	alog("G3_SAVE()------------start");
	tgrid = mygridG3;

	tgrid.setSerializationLevel(true,false,false,false,true,false);
	var myXmlString = tgrid.serialize();
        //post 만들기
		sendFormData = new FormData($("#condition")[0]);
		for(var pair of lastinputG3.entries()) {
			sendFormData.append(pair[0],pair[1]);
   			//console.log(pair[0]+ ', '+ pair[1]); 
		}
	sendFormData.append("G3-XML" , myXmlString);
	$.ajax({
		type : "POST",
		url : url_G3_SAVE + "&TOKEN=" + token,
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
	
	alog("G3_SAVE()------------end");
}
function G3_CHKSAVE(){
	alog("G3_CHKSAVE()------------start");
	tgrid = mygridG3;

	//체크된 ROW의 ID 배열로 불러오기
	var arrRows =  tgrid.getCheckedRows(0); //0번째 CHK 컬럼
	//alert(arrRows.length);

        //전송용 post 만들기
		sendFormData = new FormData($("#condition")[0]);
		for(var pair of lastinputG3.entries()) {
			sendFormData.append(pair[0],pair[1]);
   			//console.log(pair[0]+ ', '+ pair[1]); 
		}	//CHK 배열 합치기
	sendFormData.append("G3-CHK",arrRows);
	$.ajax({
		type : "POST",
		url : url_G3_CHKSAVE + "&" + lastinputG3 ,
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
	$("#DATA_HEADERS").val("LOADD_SEQ,LOAD_SEQ,TYPE,PRIORITY,CLASSNAME,CLASS_LINE_S,CLASS_LINE_E,SOURCEFILE,SOURCEPATH,METHOD_NAME,METHOD_LINE_S,METHOD_LINE_E,FIELD_NAME,FIELD_LINE_S,FIELD_LINE_E,LINE_CNT,BUG_LINE_S,ADD_DT");
	$("#DATA_WIDTHS").val("60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60,60");
	$("#DATA_ROWS").val(myXmlString);
	myForm.submit();
}
    function G3_HIDDENCOL(){
		alog("G3_HIDDENCOL()..................start");
        if(isToggleHiddenColG3){
            isToggleHiddenColG3 = false;     }else{
            isToggleHiddenColG3 = true;
        }
		alog("G3_HIDDENCOL()..................end");
    }
//행추가3 (4)	
//그리드 행추가 : 4
	function G3_ROWADD(){
		if( !(lastinputG3)|| lastinputG3.get("G3-LOAD_SEQ") == ""){
			msgError("조회 후에 행추가 가능합니다. 또는 상속값이 없습니다.",3);
		}else{
			var tCols = ["",lastinputG3.get("G2-LOAD_SEQ"),"","","","","","","","","","","","","","","",""];//초기값
			addRow(mygridG3,tCols);
		}
	}    function G3_ROWDELETE(){	
        alog("G3_ROWDELETE()------------start");
        delRow(mygridG3);
        alog("G3_ROWDELETE()------------start");
    }
//그리드 행추가 : 4
	function G3_ROWBULKADD(){
		if( !(lastinputG3json)|| !(lastinputG3json.LOAD_SEQ) ){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = ["",lastinputG3.get("G2-LOAD_SEQ"),"","","","","","","","","","","","","","","",""];//초기값

	var rowcnt = prompt("Please enter row's count", "input number");
	if($.isNumeric(rowcnt)){
		for(k=0;k<rowcnt;k++){
			addRow(mygridG3,tCols);  
		}
	}
			}
	}








    //그리드 조회(4)	
    function G3_SEARCH(tinput,token){
        alog("G3_SEARCH()------------start");

		var tGrid = mygridG3;

        //그리드 초기화
        tGrid.clearAll();        //post 만들기
		sendFormData = new FormData($("#condition")[0]);
		if(typeof tinput != "undefined"){
			for(var pair of tinput.entries()) {
				sendFormData.append(pair[0],pair[1]);
				//console.log(pair[0]+ ', '+ pair[1]); 
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
						$("#spanG3Cnt").text(row_cnt);						tGrid.parse(data.RTN_DATA,function(){
							//푸터 합계 처리	

						},"json");
						
					}
					msgNotice("[4] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[4] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[4] Ajax http 500 error ( " + error + " )",3);
                alog("[4] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
        alog("G3_SEARCH()------------end");
    }

