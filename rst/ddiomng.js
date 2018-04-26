//글로벌 변수 선언
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SEARCHALL = "ddiomngController.php?CTLGRP=G1&CTLFNC=SEARCHALL";//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SAVE = "ddiomngController.php?CTLGRP=G1&CTLFNC=SAVE";//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_RESET = "ddiomngController.php?CTLGRP=G1&CTLFNC=RESET";//조건1 변수 선언	
var obj_G1_COLID_valid = jQuery.parseJSON( '{ "G1_COLID": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":30,  "DATATYPE":"STRING"} }' );  //컬럼ID  밸리데이션
var obj_G1_COLID; // 컬럼ID 변수선언//그리드 변수 초기화	
//컨트롤러 경로
var url_G2_SEARCH = "ddiomngController.php?CTLGRP=G2&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G2_SAVE = "ddiomngController.php?CTLGRP=G2&CTLFNC=SAVE";
//컨트롤러 경로
var url_G2_RELOAD = "ddiomngController.php?CTLGRP=G2&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G2_HIDDENCOL = "ddiomngController.php?CTLGRP=G2&CTLFNC=HIDDENCOL";
//컨트롤러 경로
var url_G2_CHKSAVE = "ddiomngController.php?CTLGRP=G2&CTLFNC=CHKSAVE";
//그리드 객체
var mygridG2,isToggleHiddenColG2,lastinputG2,lastinputG2json,lastrowidG2;
var lastselectG2json;//그리드 변수 초기화	
//컨트롤러 경로
var url_G3_SEARCH = "ddiomngController.php?CTLGRP=G3&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G3_SAVE = "ddiomngController.php?CTLGRP=G3&CTLFNC=SAVE";
//컨트롤러 경로
var url_G3_RELOAD = "ddiomngController.php?CTLGRP=G3&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G3_HIDDENCOL = "ddiomngController.php?CTLGRP=G3&CTLFNC=HIDDENCOL";
//컨트롤러 경로
var url_G3_CHKSAVE = "ddiomngController.php?CTLGRP=G3&CTLFNC=CHKSAVE";
//그리드 객체
var mygridG3,isToggleHiddenColG3,lastinputG3,lastinputG3json,lastrowidG3;
var lastselectG3json;//그리드 변수 초기화	
//컨트롤러 경로
var url_G4_SEARCH = "ddiomngController.php?CTLGRP=G4&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G4_RELOAD = "ddiomngController.php?CTLGRP=G4&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G4_CHKSAVE = "ddiomngController.php?CTLGRP=G4&CTLFNC=CHKSAVE";
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
		alog("initBody()-----------------------end");
} //initBody()
	//그룹별 초기화 함수
// CONDITIONInit	//컨디션 초기화
function G1_INIT(){
  alog("G1_INIT()-------------------------start	");

//각 폼 오브젝트들 초기화
	//COLID, 컬럼ID 초기화	
  alog("G1_INIT()-------------------------end");
}

	//DATASIZE 그리드 초기화
function G2_INIT(){
  alog("G2_INIT()-------------------------start");

        //그리드 초기화
        mygridG2 = new dhtmlXGridObject('gridG2');
        mygridG2.setDateFormat("%Y%m%d");
        mygridG2.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG2.setUserData("","gridTitle","G2 : DATASIZE"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG2.setHeader("#master_checkbox,컬럼ID,SEQ,IOSEQ,DD SIZE,IO SIZE,ADDDT,MODDT");
		mygridG2.setColumnIds("CHK,COLID,PGMSEQ,IOSEQ,DD_DATASIZE,IO_DATASIZE,ADDDT,MODDT");
		mygridG2.setInitWidths("50,100,50,60,60,60,80,80");
		mygridG2.setColTypes("ch,ro,ro,ro,ed,ed,ed,ed");
	//가로 정렬
		mygridG2.setColAlign("center,left,left,left,left,left,left,left");
		mygridG2.setColSorting("int,str,str,int,str,str,str,str");		//렌더링
		mygridG2.enableSmartRendering(false);
		mygridG2.enableMultiselect(true);


		//mygridG2.setColValidators("G2_CHK,G2_COLID,G2_PGMSEQ,G2_IOSEQ,G2_DD_DATASIZE,G2_IO_DATASIZE,G2_ADDDT,G2_MODDT");
		mygridG2.splitAt(0);//'freezes' 0 columns 
		mygridG2.init();

				
		//블럭선택 및 복사
		mygridG2.enableBlockSelection(true);
		mygridG2.attachEvent("onKeyPress",function(code,ctrl,shift){
			mygridG2.setCSVDelimiter("	");
			if(code==67&&ctrl){
				mygridG2.copyBlockToClipboard();

				var top_row_idx = mygridG2.getSelectedBlock().LeftTopRow;
				var bottom_row_idx = mygridG2.getSelectedBlock().RightBottomRow;
				var copyRowCnt = bottom_row_idx-top_row_idx
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
		});
		 // IO : CHK초기화	
		 // IO : 컬럼ID초기화	
		 // IO : SEQ초기화	
		 // IO : IOSEQ초기화	
		 // IO : DD SIZE초기화	
		 // IO : IO SIZE초기화	
		 // IO : ADDDT초기화	
		 // IO : MODDT초기화	
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
			var ConAllData = $( "#condition" ).serialize();
			var RowAllData = getRowsColid(mygridG2,rowID,"G2");
		//LAST SELECT ROW
			//lastselectG2json = jQuery.parseJSON('{ "__NAME":"lastinputG2json"' +
			//', "CHK" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("CHK")).getValue()) + '"' +
			//', "COLID" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("COLID")).getValue()) + '"' +
			//', "PGMSEQ" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("PGMSEQ")).getValue()) + '"' +
			//', "IOSEQ" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("IOSEQ")).getValue()) + '"' +
			//', "DD_DATASIZE" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("DD_DATASIZE")).getValue()) + '"' +
			//', "IO_DATASIZE" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("IO_DATASIZE")).getValue()) + '"' +
			//', "ADDDT" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("ADDDT")).getValue()) + '"' +
			//', "MODDT" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("MODDT")).getValue()) + '"' +
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

	//DATATYPE 그리드 초기화
function G3_INIT(){
  alog("G3_INIT()-------------------------start");

        //그리드 초기화
        mygridG3 = new dhtmlXGridObject('gridG3');
        mygridG3.setDateFormat("%Y%m%d");
        mygridG3.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG3.setUserData("","gridTitle","G3 : DATATYPE"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG3.setHeader("#master_checkbox,컬럼ID,SEQ,IOSEQ,DD TYPE,IO TYPE,ADDDT,MODDT");
		mygridG3.setColumnIds("CHK,COLID,PGMSEQ,IOSEQ,DD_DATATYPE,IO_DATATYPE,ADDDT,MODDT");
		mygridG3.setInitWidths("50,100,50,60,60,60,80,80");
		mygridG3.setColTypes("ch,ro,ro,ro,ed,ed,ed,ed");
	//가로 정렬
		mygridG3.setColAlign("left,left,left,left,left,left,left,left");
		mygridG3.setColSorting("int,str,str,int,str,str,str,str");		//렌더링
		mygridG3.enableSmartRendering(false);
		mygridG3.enableMultiselect(true);


		//mygridG3.setColValidators("G3_CHK,G3_COLID,G3_PGMSEQ,G3_IOSEQ,G3_DD_DATATYPE,G3_IO_DATATYPE,G3_ADDDT,G3_MODDT");
		mygridG3.splitAt(0);//'freezes' 0 columns 
		mygridG3.init();

				
		//블럭선택 및 복사
		mygridG3.enableBlockSelection(true);
		mygridG3.attachEvent("onKeyPress",function(code,ctrl,shift){
			mygridG3.setCSVDelimiter("	");
			if(code==67&&ctrl){
				mygridG3.copyBlockToClipboard();

				var top_row_idx = mygridG3.getSelectedBlock().LeftTopRow;
				var bottom_row_idx = mygridG3.getSelectedBlock().RightBottomRow;
				var copyRowCnt = bottom_row_idx-top_row_idx
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
		});
		 // IO : CHK초기화	
		 // IO : 컬럼ID초기화	
		 // IO : SEQ초기화	
		 // IO : IOSEQ초기화	
		 // IO : DD TYPE초기화	
		 // IO : IO TYPE초기화	
		 // IO : ADDDT초기화	
		 // IO : MODDT초기화	
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
			var ConAllData = $( "#condition" ).serialize();
			var RowAllData = getRowsColid(mygridG3,rowID,"G3");
		//LAST SELECT ROW
			//lastselectG3json = jQuery.parseJSON('{ "__NAME":"lastinputG3json"' +
			//', "CHK" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("CHK")).getValue()) + '"' +
			//', "COLID" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("COLID")).getValue()) + '"' +
			//', "PGMSEQ" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("PGMSEQ")).getValue()) + '"' +
			//', "IOSEQ" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("IOSEQ")).getValue()) + '"' +
			//', "DD_DATATYPE" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("DD_DATATYPE")).getValue()) + '"' +
			//', "IO_DATATYPE" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("IO_DATATYPE")).getValue()) + '"' +
			//', "ADDDT" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("ADDDT")).getValue()) + '"' +
			//', "MODDT" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("MODDT")).getValue()) + '"' +
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

	//VALIDSEQ 그리드 초기화
function G4_INIT(){
  alog("G4_INIT()-------------------------start");

        //그리드 초기화
        mygridG4 = new dhtmlXGridObject('gridG4');
        mygridG4.setDateFormat("%Y%m%d");
        mygridG4.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG4.setUserData("","gridTitle","G4 : VALIDSEQ"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG4.setHeader("#master_checkbox,컬럼ID,SEQ,IOSEQ,DD VALID,IO VALID,ADDDT,MODDT");
		mygridG4.setColumnIds("CHK,COLID,PGMSEQ,IOSEQ,DD_VALIDSEQ,IO_VALIDSEQ,ADDDT,MODDT");
		mygridG4.setInitWidths("50,100,50,60,60,60,80,80");
		mygridG4.setColTypes("ch,ro,ro,ro,ro,ro,ed,ed");
	//가로 정렬
		mygridG4.setColAlign("left,left,left,left,left,left,left,left");
		mygridG4.setColSorting("int,str,str,int,int,int,str,str");		//렌더링
		mygridG4.enableSmartRendering(false);
		mygridG4.enableMultiselect(true);


		//mygridG4.setColValidators("G4_CHK,G4_COLID,G4_PGMSEQ,G4_IOSEQ,G4_DD_VALIDSEQ,G4_IO_VALIDSEQ,G4_ADDDT,G4_MODDT");
		mygridG4.splitAt(0);//'freezes' 0 columns 
		mygridG4.init();

				
		//블럭선택 및 복사
		mygridG4.enableBlockSelection(true);
		mygridG4.attachEvent("onKeyPress",function(code,ctrl,shift){
			mygridG4.setCSVDelimiter("	");
			if(code==67&&ctrl){
				mygridG4.copyBlockToClipboard();

				var top_row_idx = mygridG4.getSelectedBlock().LeftTopRow;
				var bottom_row_idx = mygridG4.getSelectedBlock().RightBottomRow;
				var copyRowCnt = bottom_row_idx-top_row_idx
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
		});
		 // IO : CHK초기화	
		 // IO : 컬럼ID초기화	
		 // IO : SEQ초기화	
		 // IO : IOSEQ초기화	
		 // IO : DD VALID초기화	
		 // IO : IO VALID초기화	
		 // IO : ADDDT초기화	
		 // IO : MODDT초기화	
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
			var ConAllData = $( "#condition" ).serialize();
			var RowAllData = getRowsColid(mygridG4,rowID,"G4");
		//LAST SELECT ROW
			//lastselectG4json = jQuery.parseJSON('{ "__NAME":"lastinputG4json"' +
			//', "CHK" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("CHK")).getValue()) + '"' +
			//', "COLID" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("COLID")).getValue()) + '"' +
			//', "PGMSEQ" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("PGMSEQ")).getValue()) + '"' +
			//', "IOSEQ" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("IOSEQ")).getValue()) + '"' +
			//', "DD_VALIDSEQ" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("DD_VALIDSEQ")).getValue()) + '"' +
			//', "IO_VALIDSEQ" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("IO_VALIDSEQ")).getValue()) + '"' +
			//', "ADDDT" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("ADDDT")).getValue()) + '"' +
			//', "MODDT" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("MODDT")).getValue()) + '"' +
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

	//D146 그룹별 기능 함수 출력	
//검색조건 초기화
function G1_RESET(){
	alog("G1_RESET--------------------------start");
	$('#condition')[0].reset();
}
//조건1, 저장	
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
function G1_SEARCHALL(){
	alog("G1_SEARCHALL--------------------------start");
	//입력값검증
	//폼의 모든값 구하기
	var ConAllData = $( "#condition" ).serialize();
	alog("ConAllData:" + ConAllData);
	lastinputG2 = ConAllData ;
	lastinputG3 = ConAllData ;
	lastinputG4 = ConAllData ;
	//json : G1
            lastinputG2json = jQuery.parseJSON('{ "__NAME":"lastinputG2json"' +'}');
            lastinputG3json = jQuery.parseJSON('{ "__NAME":"lastinputG3json"' +'}');
            lastinputG4json = jQuery.parseJSON('{ "__NAME":"lastinputG4json"' +'}');
	//  호출
	G2_SEARCH(lastinputG2);
	//  호출
	G3_SEARCH(lastinputG3);
	//  호출
	G4_SEARCH(lastinputG4);
	alog("G1_SEARCHALL--------------------------end");
}
	function G2_SAVE(){
	alog("G2_SAVE()------------start");
	tgrid = mygridG2;

	tgrid.setSerializationLevel(true,false,false,false,true,false);
	var myXmlString = tgrid.serialize();
	//컨디션 데이터 모두 말기
	var ConAllData = $( "#condition" ).serialize();
	alog("   ConAllData = " + ConAllData);
	$.ajax({
		type : "POST",
		url : url_G2_SAVE + "&" + lastinputG2 ,
		data : { "G2-XML" : myXmlString},
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
    function G2_HIDDENCOL(){
		alog("G2_HIDDENCOL()..................start");
        if(isToggleHiddenColG2){
            isToggleHiddenColG2 = false;     }else{
            isToggleHiddenColG2 = true;
        }
		alog("G2_HIDDENCOL()..................end");
    }
//새로고침	
function G2_RELOAD(){
  alog("G2_RELOAD-----------------start");
  G2_SEARCH(lastinputG2);
}
    //그리드 조회(DATASIZE)	
    function G2_SEARCH(tinput){
        alog("G2_SEARCH()------------start");

		var tGrid = mygridG2;

        //그리드 초기화
        tGrid.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : url_G2_SEARCH+"&G2_CRUD_MODE=read&" + tinput ,
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
					msgNotice("[DATASIZE] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[DATASIZE] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[DATASIZE] Ajax http 500 error ( " + error + " )",3);
                alog("[DATASIZE] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearchG2()------------end");
    }
function G2_CHKSAVE(){
	alog("G2_CHKSAVE()------------start");
	tgrid = mygridG2;

	//체크된 ROW의 ID 배열로 불러오기
	var arrRows =  tgrid.getCheckedRows(0); //0번째 CHK 컬럼
	//alert(arrRows.length);

	//컨디션 데이터 모두 말기
	var ConAllData = $( "#condition" ).serialize();
	alog("   ConAllData = " + ConAllData);
//전송할 POST값 합치기
var postData = ConAllData + lastinputG2+ "&G2-CHK=" + arrRows ;

	$.ajax({
		type : "POST",
		url : url_G2_CHKSAVE + "&" + lastinputG2 ,
		data : postData,
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
	function G3_SAVE(){
	alog("G3_SAVE()------------start");
	tgrid = mygridG3;

	tgrid.setSerializationLevel(true,false,false,false,true,false);
	var myXmlString = tgrid.serialize();
	//컨디션 데이터 모두 말기
	var ConAllData = $( "#condition" ).serialize();
	alog("   ConAllData = " + ConAllData);
	$.ajax({
		type : "POST",
		url : url_G3_SAVE + "&" + lastinputG3 ,
		data : { "G3-XML" : myXmlString},
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
    function G3_HIDDENCOL(){
		alog("G3_HIDDENCOL()..................start");
        if(isToggleHiddenColG3){
            isToggleHiddenColG3 = false;     }else{
            isToggleHiddenColG3 = true;
        }
		alog("G3_HIDDENCOL()..................end");
    }
    //그리드 조회(DATATYPE)	
    function G3_SEARCH(tinput){
        alog("G3_SEARCH()------------start");

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
						row_cnt = data.RTN_DATA.rows.length;
						$("#spanG3Cnt").text(row_cnt);

						tGrid.parse(data.RTN_DATA,"json");
						
					}
					msgNotice("[DATATYPE] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[DATATYPE] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[DATATYPE] Ajax http 500 error ( " + error + " )",3);
                alog("[DATATYPE] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearchG3()------------end");
    }
//새로고침	
function G3_RELOAD(){
  alog("G3_RELOAD-----------------start");
  G3_SEARCH(lastinputG3);
}
function G3_CHKSAVE(){
	alog("G3_CHKSAVE()------------start");
	tgrid = mygridG3;

	//체크된 ROW의 ID 배열로 불러오기
	var arrRows =  tgrid.getCheckedRows(0); //0번째 CHK 컬럼
	//alert(arrRows.length);

	//컨디션 데이터 모두 말기
	var ConAllData = $( "#condition" ).serialize();
	alog("   ConAllData = " + ConAllData);
//전송할 POST값 합치기
var postData = ConAllData + lastinputG3+ "&G3-CHK=" + arrRows ;

	$.ajax({
		type : "POST",
		url : url_G3_CHKSAVE + "&" + lastinputG3 ,
		data : postData,
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
    //그리드 조회(VALIDSEQ)	
    function G4_SEARCH(tinput){
        alog("G4_SEARCH()------------start");

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
						row_cnt = data.RTN_DATA.rows.length;
						$("#spanG4Cnt").text(row_cnt);

						tGrid.parse(data.RTN_DATA,"json");
						
					}
					msgNotice("[VALIDSEQ] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[VALIDSEQ] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[VALIDSEQ] Ajax http 500 error ( " + error + " )",3);
                alog("[VALIDSEQ] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearchG4()------------end");
    }
//새로고침	
function G4_RELOAD(){
  alog("G4_RELOAD-----------------start");
  G4_SEARCH(lastinputG4);
}
function G4_CHKSAVE(){
	alog("G4_CHKSAVE()------------start");
	tgrid = mygridG4;

	//체크된 ROW의 ID 배열로 불러오기
	var arrRows =  tgrid.getCheckedRows(0); //0번째 CHK 컬럼
	//alert(arrRows.length);

	//컨디션 데이터 모두 말기
	var ConAllData = $( "#condition" ).serialize();
	alog("   ConAllData = " + ConAllData);
//전송할 POST값 합치기
var postData = ConAllData + lastinputG4+ "&G4-CHK=" + arrRows ;

	$.ajax({
		type : "POST",
		url : url_G4_CHKSAVE + "&" + lastinputG4 ,
		data : postData,
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
