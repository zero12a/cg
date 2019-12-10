//글로벌 변수 선언
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SEARCHALL = "menumngController.php?CTLGRP=G1&CTLFNC=SEARCHALL";//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SAVE = "menumngController.php?CTLGRP=G1&CTLFNC=SAVE";//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_RESET = "menumngController.php?CTLGRP=G1&CTLFNC=RESET";//조회조건 변수 선언	
//그리드 변수 초기화	
//컨트롤러 경로
var url_G2_SEARCH = "menumngController.php?CTLGRP=G2&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G2_SAVE = "menumngController.php?CTLGRP=G2&CTLFNC=SAVE";
//컨트롤러 경로
var url_G2_ROWDELETE = "menumngController.php?CTLGRP=G2&CTLFNC=ROWDELETE";
//컨트롤러 경로
var url_G2_ROWADD = "menumngController.php?CTLGRP=G2&CTLFNC=ROWADD";
//컨트롤러 경로
var url_G2_RELOAD = "menumngController.php?CTLGRP=G2&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G2_HIDDENCOL = "menumngController.php?CTLGRP=G2&CTLFNC=HIDDENCOL";
//컨트롤러 경로
var url_G2_EXCEL = "menumngController.php?CTLGRP=G2&CTLFNC=EXCEL";
//컨트롤러 경로
var url_G2_CHKSAVE = "menumngController.php?CTLGRP=G2&CTLFNC=CHKSAVE";
//그리드 객체
var mygridG2,isToggleHiddenColG2,lastinputG2,lastinputG2json,lastrowidG2;
var lastselectG2json;//그리드 변수 초기화	
//컨트롤러 경로
var url_G3_SEARCH = "menumngController.php?CTLGRP=G3&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G3_SAVE = "menumngController.php?CTLGRP=G3&CTLFNC=SAVE";
//컨트롤러 경로
var url_G3_ROWDELETE = "menumngController.php?CTLGRP=G3&CTLFNC=ROWDELETE";
//컨트롤러 경로
var url_G3_ROWADD = "menumngController.php?CTLGRP=G3&CTLFNC=ROWADD";
//컨트롤러 경로
var url_G3_RELOAD = "menumngController.php?CTLGRP=G3&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G3_HIDDENCOL = "menumngController.php?CTLGRP=G3&CTLFNC=HIDDENCOL";
//컨트롤러 경로
var url_G3_EXCEL = "menumngController.php?CTLGRP=G3&CTLFNC=EXCEL";
//컨트롤러 경로
var url_G3_CHKSAVE = "menumngController.php?CTLGRP=G3&CTLFNC=CHKSAVE";
//컨트롤러 경로
var url_G3_ROWBULKADD = "menumngController.php?CTLGRP=G3&CTLFNC=ROWBULKADD";
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
	//그룹별 초기화 함수
// CONDITIONInit	//컨디션 초기화
function G1_INIT(){
  alog("G1_INIT()-------------------------start	");
//각 폼 오브젝트들 초기화
  alog("G1_INIT()-------------------------end");
}

	//폴더 그리드 초기화
function G2_INIT(){
  alog("G2_INIT()-------------------------start");

        //그리드 초기화
        mygridG2 = new dhtmlXGridObject('gridG2');
        mygridG2.setDateFormat("%Y%m%d");
        mygridG2.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG2.setUserData("","gridTitle","G2 : 폴더"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG2.setHeader("FOLDER_SEQ,FOLDER_NM,USE_YN,FOLDER_ORD,ADD,ADD_ID,MOD,MOD_ID");
		mygridG2.setColumnIds("FOLDER_SEQ,FOLDER_NM,USE_YN,FOLDER_ORD,ADD_DT,ADD_ID,MOD_DT,MOD_ID");
		mygridG2.setInitWidths("60,60,60,60,60,60,60,60");
		mygridG2.setColTypes("ro,ed,ed,ed,ro,ro,ro,ro");
	//가로 정렬
		mygridG2.setColAlign("left,left,left,left,left,left,left,left");
		mygridG2.setColSorting("int,str,str,int,str,str,str,str");		//렌더링
		mygridG2.enableSmartRendering(false);
		mygridG2.enableMultiselect(true);


		//mygridG2.setColValidators("G2_FOLDER_SEQ,G2_FOLDER_NM,G2_USE_YN,G2_FOLDER_ORD,G2_ADD_DT,G2_ADD_ID,G2_MOD_DT,G2_MOD_ID");
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
		});
		 // IO : FOLDER_SEQ초기화	
		 // IO : FOLDER_NM초기화	
		 // IO : USE_YN초기화	
		 // IO : FOLDER_ORD초기화	
		 // IO : ADD초기화	
		 // IO : ADD_ID초기화	
		 // IO : MOD초기화	
		 // IO : MOD_ID초기화	
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
		//LAST SELECT ROW
			//lastselectG2json = jQuery.parseJSON('{ "__NAME":"lastinputG2json"' +
			//', "FOLDER_SEQ" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("FOLDER_SEQ")).getValue()) + '"' +
			//', "FOLDER_NM" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("FOLDER_NM")).getValue()) + '"' +
			//', "USE_YN" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("USE_YN")).getValue()) + '"' +
			//', "FOLDER_ORD" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("FOLDER_ORD")).getValue()) + '"' +
			//', "ADD_DT" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("ADD_DT")).getValue()) + '"' +
			//', "ADD_ID" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("ADD_ID")).getValue()) + '"' +
			//', "MOD_DT" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("MOD_DT")).getValue()) + '"' +
			//', "MOD_ID" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("MOD_ID")).getValue()) + '"' +
			//'}');
			//A125
			lastinputG3 = ConAllData + RowAllData;
		//A124
			lastinputG3json = jQuery.parseJSON('{ "__NAME":"lastinputG3json"' +
			', "FOLDER_SEQ" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("FOLDER_SEQ")).getValue()) + '"' +
			'}');
			G3_SEARCH(lastinputG3); //자식그룹 호출 : 메뉴
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

	//메뉴 그리드 초기화
function G3_INIT(){
  alog("G3_INIT()-------------------------start");

        //그리드 초기화
        mygridG3 = new dhtmlXGridObject('gridG3');
        mygridG3.setDateFormat("%Y%m%d");
        mygridG3.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG3.setUserData("","gridTitle","G3 : 메뉴"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG3.setHeader("#master_checkbox,MNU_SEQ,프로그램ID,MNU_NM,URL,PGMTYPE,MNU_ORD,FOLDER_SEQ,USE_YN,ADD,ADD_ID,MOD_ID,MOD");
		mygridG3.setColumnIds("CHK,MNU_SEQ,PGMID,MNU_NM,URL,PGMTYPE,MNU_ORD,FOLDER_SEQ,USE_YN,ADD_DT,ADD_ID,MOD_ID,MOD_DT");
		mygridG3.setInitWidths("50,60,100,60,60,60,60,60,60,60,60,60,60");
		mygridG3.setColTypes("ch,ro,ed,ed,ed,co,ed,ro,ed,ro,ro,ro,ro");
	//가로 정렬
		mygridG3.setColAlign("left,left,left,left,left,left,left,left,left,left,left,left,left");
		mygridG3.setColSorting("int,str,str,str,str,str,str,int,str,str,str,str,str");		//렌더링
		mygridG3.enableSmartRendering(false);
		mygridG3.enableMultiselect(true);


		//mygridG3.setColValidators("G3_CHK,G3_MNU_SEQ,G3_PGMID,G3_MNU_NM,G3_URL,G3_PGMTYPE,G3_MNU_ORD,G3_FOLDER_SEQ,G3_USE_YN,G3_ADD_DT,G3_ADD_ID,G3_MOD_ID,G3_MOD_DT");
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
		});
		 // IO : CHK초기화	
		 // IO : MNU_SEQ초기화	
		 // IO : 프로그램ID초기화	
		 // IO : MNU_NM초기화	
		 // IO : URL초기화	
		setCodeCombo("GRID",mygridG3.getCombo(mygridG3.getColIndexById("PGMTYPE")),"PGMTYPE"); // IO : PGMTYPE초기화	
		 // IO : MNU_ORD초기화	
		 // IO : FOLDER_SEQ초기화	
		 // IO : USE_YN초기화	
		 // IO : ADD초기화	
		 // IO : ADD_ID초기화	
		 // IO : MOD_ID초기화	
		 // IO : MOD초기화	
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
			//', "MNU_SEQ" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("MNU_SEQ")).getValue()) + '"' +
			//', "PGMID" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("PGMID")).getValue()) + '"' +
			//', "MNU_NM" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("MNU_NM")).getValue()) + '"' +
			//', "URL" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("URL")).getValue()) + '"' +
			//', "PGMTYPE" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("PGMTYPE")).getValue()) + '"' +
			//', "MNU_ORD" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("MNU_ORD")).getValue()) + '"' +
			//', "FOLDER_SEQ" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("FOLDER_SEQ")).getValue()) + '"' +
			//', "USE_YN" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("USE_YN")).getValue()) + '"' +
			//', "ADD_DT" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("ADD_DT")).getValue()) + '"' +
			//', "ADD_ID" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("ADD_ID")).getValue()) + '"' +
			//', "MOD_ID" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("MOD_ID")).getValue()) + '"' +
			//', "MOD_DT" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("MOD_DT")).getValue()) + '"' +
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
// CONDITIONSearch	
function G1_SEARCHALL(){
	alog("G1_SEARCHALL--------------------------start");
	//입력값검증
	//폼의 모든값 구하기
	var ConAllData = $( "#condition" ).serialize();
	alog("ConAllData:" + ConAllData);
	lastinputG2 = ConAllData ;
	//json : G1
            lastinputG2json = jQuery.parseJSON('{ "__NAME":"lastinputG2json"' +'}');
	//  호출
	G2_SEARCH(lastinputG2);
	alog("G1_SEARCHALL--------------------------end");
}
//조회조건, 저장	
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
//검색조건 초기화
function G1_RESET(){
	alog("G1_RESET--------------------------start");
	$('#condition')[0].reset();
}
    function G2_ROWDELETE(){	
        alog("G2_ROWDELETE()------------start");
        delRow(mygridG2);
        alog("G2_ROWDELETE()------------start");
    }
//행추가3 (폴더)	
//그리드 행추가 : 폴더
	function G2_ROWADD(){
		if( !(lastinputG2json)){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = ["","","","","","","",""];//초기값
			addRow(mygridG2,tCols);
		}
	}//엑셀다운		
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
	$("#DATA_HEADERS").val("FOLDER_SEQ,FOLDER_NM,USE_YN,FOLDER_ORD,ADD_DT,ADD_ID,MOD_DT,MOD_ID");
	$("#DATA_WIDTHS").val("60,60,60,60,60,60,60,60");
	$("#DATA_ROWS").val(myXmlString);
	myForm.submit();
}
    function G2_HIDDENCOL(){
		alog("G2_HIDDENCOL()..................start");
        if(isToggleHiddenColG2){
            isToggleHiddenColG2 = false;     }else{
            isToggleHiddenColG2 = true;
        }
		alog("G2_HIDDENCOL()..................end");
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
//새로고침	
function G2_RELOAD(){
  alog("G2_RELOAD-----------------start");
  G2_SEARCH(lastinputG2);
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
    //그리드 조회(폴더)	
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
					msgNotice("[폴더] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[폴더] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[폴더] Ajax http 500 error ( " + error + " )",3);
                alog("[폴더] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearchG2()------------end");
    }
//그리드 행추가 : 메뉴
	function G3_ROWBULKADD(){
		if( !(lastinputG3json)|| !(lastinputG3json.FOLDER_SEQ) ){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = ["","","","","","","",lastinputG3json.FOLDER_SEQ,"","","","",""];//초기값

	var rowcnt = prompt("Please enter row's count", "input number");
	if($.isNumeric(rowcnt)){
		for(k=0;k<rowcnt;k++){
			addRow(mygridG3,tCols);  
		}
	}
			}
	}
//행추가3 (메뉴)	
//그리드 행추가 : 메뉴
	function G3_ROWADD(){
		if( !(lastinputG3json)|| !(lastinputG3json.FOLDER_SEQ) ){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = ["","","","","","","",lastinputG3json.FOLDER_SEQ,"","","","",""];//초기값
			addRow(mygridG3,tCols);
		}
	}    function G3_ROWDELETE(){	
        alog("G3_ROWDELETE()------------start");
        delRow(mygridG3);
        alog("G3_ROWDELETE()------------start");
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
	$("#DATA_HEADERS").val("CHK,MNU_SEQ,PGMID,MNU_NM,URL,PGMTYPE,MNU_ORD,FOLDER_SEQ,USE_YN,ADD_DT,ADD_ID,MOD_ID,MOD_DT");
	$("#DATA_WIDTHS").val("50,60,100,60,60,60,60,60,60,60,60,60,60");
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
    //그리드 조회(메뉴)	
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
					msgNotice("[메뉴] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[메뉴] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[메뉴] Ajax http 500 error ( " + error + " )",3);
                alog("[메뉴] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearchG3()------------end");
    }