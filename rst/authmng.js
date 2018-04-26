//글로벌 변수 선언	
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SEARCHALL = "authmngController.php?CTLGRP=G1&CTLFNC=SEARCHALL";//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SAVE = "authmngController.php?CTLGRP=G1&CTLFNC=SAVE";//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_RESET = "authmngController.php?CTLGRP=G1&CTLFNC=RESET";//조회조건 변수 선언	
var obj_G1_PGMID_valid = jQuery.parseJSON( '{ "G1_PGMID": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":20,  "DATATYPE":"STRING"} }' );  //프로그램ID  밸리데이션
var obj_G1_PGMID; // 프로그램ID 변수선언//그리드 변수 초기화	
//컨트롤러 경로
var url_G2_SEARCH = "authmngController.php?CTLGRP=G2&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G2_SAVE = "authmngController.php?CTLGRP=G2&CTLFNC=SAVE";
//컨트롤러 경로
var url_G2_ROWDELETE = "authmngController.php?CTLGRP=G2&CTLFNC=ROWDELETE";
//컨트롤러 경로
var url_G2_ROWADD = "authmngController.php?CTLGRP=G2&CTLFNC=ROWADD";
//컨트롤러 경로
var url_G2_RELOAD = "authmngController.php?CTLGRP=G2&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G2_HIDDENCOL = "authmngController.php?CTLGRP=G2&CTLFNC=HIDDENCOL";
//컨트롤러 경로
var url_G2_EXCEL = "authmngController.php?CTLGRP=G2&CTLFNC=EXCEL";
//컨트롤러 경로
var url_G2_CHKSAVE = "authmngController.php?CTLGRP=G2&CTLFNC=CHKSAVE";
//컨트롤러 경로
var url_G2_ADDBULK = "authmngController.php?CTLGRP=G2&CTLFNC=ADDBULK";
//그리드 객체
var mygridG2,isToggleHiddenColG2,lastinputG2,lastinputG2json,lastrowidG2;
var lastselectG2json;//디테일 변수 초기화	

//폼뷰 컨트롤러 경로
var url_G3_SEARCH = "authmngController.php?CTLGRP=G3&CTLFNC=SEARCH";
//폼뷰 컨트롤러 경로
var url_G3_SAVE = "authmngController.php?CTLGRP=G3&CTLFNC=SAVE";
//폼뷰 컨트롤러 경로
var url_G3_RELOAD = "authmngController.php?CTLGRP=G3&CTLFNC=RELOAD";
//폼뷰 컨트롤러 경로
var url_G3_NEW = "authmngController.php?CTLGRP=G3&CTLFNC=NEW";
//폼뷰 컨트롤러 경로
var url_G3_MODIFY = "authmngController.php?CTLGRP=G3&CTLFNC=MODIFY";
//폼뷰 컨트롤러 경로
var url_G3_DELETE = "authmngController.php?CTLGRP=G3&CTLFNC=DELETE";
//화면 초기화	
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
	//G2, 권한목록, PGMID2, PGMID2
	if( tGrpId =="G2" && tColId == "PGMID2" ){
		window.open("about:blank","codeSearchG2Pop","width=800px,height=500px,resizable=yes,scrollbars=yes");
		
		//값세팅하고
		var frm1 = $('form[name="popupForm"]');

		frm1.append("<input type=text name='PGMID2' id='PGMID2' value='" + tValue + "'>");//이 컬럼이 동적으로 PGMID2 변경되어야 함.	
		frm1.append("<input type=text name='PGMID2-NM' id='PGMID2-NM' value='" + tText + "'>");//이 컬럼이 동적으로 PGMID2 변경되어야 함.	
		
		$("#GRPID").val(tGrpId);
		$("#ROWID").val(tRowId);		
		$("#COLID").val(tColId);

		//폼실행
		var frm =document.popupForm;
		frm.action = "pgmsearchView.php";//호출할 팝업 프로그램 URL
		frm.target = "codeSearchG2Pop";
		frm.method = "post";
		//frm.submit();

		alog("delay end and go.");

		//딜레이 폼실행
		var timer;
		var delay = 500; // 0.6 seconds delay after last input
		window.clearTimeout(timer);
		timer = window.setTimeout(function(){
			alog("delay end and go1.");
			frm.submit();
			alog("delay end and go2.");
		}, delay);
	}
}
function goFormPopOpen(tGrpId, tColId, tColId_Nm){
	alog("goFormviewPopOpen()............. tGrpId = " + tGrpId + ", tColId = " + tColId + ", tColId_Nm = " +tColId_Nm );
	
	tColId_Val = $("#" + tColId).val();
	tColId_Nm_Text = $("#" + tColId_Nm).text();
	//PGMGRP ,  	
	//G1, 조회조건, PGMID, 프로그램ID
	if( tGrpId == "G1" && tColId == "G1-PGMID" ){
		window.open("about:blank","codeSearchG1Pop","width=800px,height=500px,resizable=yes,scrollbars=yes");
		
		//값세팅하고
		var frm1 = $('form[name="popupForm"]');

		frm1.append("<input type=text name='PGMID' id='PGMID' value='" + tColId_Val + "'>");//이 컬럼이 동적으로 PGMID 변경되어야 함.	
		frm1.append("<input type=text name='PGMID-NM' id='PGMID-NM' value='" + tColId_Nm_Text + "'>");//이 컬럼이 동적으로 PGMID 변경되어야 함.		

		$("#GRPID").val(tGrpId);
		$("#COLID").val(tColId);

		//폼실행
		var frm =document.popupForm;
		frm.action = "pgmsearchView.php";//호출할 팝업 프로그램 URL
		frm.target = "codeSearchG1Pop";
		frm.method = "post";
		//frm.submit();

		alog("delay end and go.");

		//딜레이 폼실행
		var timer;
		var delay = 500; // 0.6 seconds delay after last input
		window.clearTimeout(timer);
		timer = window.setTimeout(function(){
			alog("delay end and go1.");
			frm.submit();
			alog("delay end and go2.");
		}, delay);
	}

}// goFormviewPopOpen
//부모창 리턴용//팝업창에서 받을 내용
function popReturn(tGrpId,tRowId,tColId,tBtnNm,tJsonObj){
	//alert("popReturn");
		//, 
	//FORM
	if(tGrpId == "G1" && tColId =="G1-PGMID"){
		$("#G1-PGMID").val(tJsonObj.CD);
		$("#G1-PGMID-NM").text(tJsonObj.NM);
	}
	//GRID
	if(tGrpId == "G2" && tColId =="PGMID2"){
		alog("LAST_ROWID = " + tRowId);
		//그리드 일때
		//전체 값중에 TEXT, VALUE만 변경
		var origin = mygridG2.cells(tRowId,mygridG2.getColIndexById(tColId)).getValue();
		alog("before = " + origin);
		var tArr = origin.split("^"); ////CD^NM^GRPID
		tArr[0] = tJsonObj.CD;
		tArr[1] = tJsonObj.NM;	
		tArr[2] = "G2";//GRPID
		alog("after = " + tArr[0] + "^" + tArr[1] + "^" + tArr[2]);

		mygridG2.cells(tRowId,mygridG2.getColIndexById(tColId)).setValue(tArr[0] + "^" + tArr[1] + "^" + tArr[2] );
	}
	
}//popReturn
//그룹별 초기화 함수	
// CONDITIONInit	//컨디션 초기화
function G1_INIT(){
  alog("G1_INIT()-------------------------start	");

//각 폼 오브젝트들 초기화
  alog("G1_INIT()-------------------------end");
}

	//권한목록 그리드 초기화
function G2_INIT(){
  alog("G2_INIT()-------------------------start");

        //그리드 초기화
        mygridG2 = new dhtmlXGridObject('gridG2');
        mygridG2.setDateFormat("%Y%m%d");
        mygridG2.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG2.setUserData("","gridTitle","G2 : 권한목록"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG2.setHeader("#master_checkbox,AUTH_SEQ,프로그램ID,AUTH_ID,AUTH_NM,USE_YN,ADD,MOD,PGMID2");
		mygridG2.setColumnIds("CHK,AUTH_SEQ,PGMID,AUTH_ID,AUTH_NM,USE_YN,ADD_DT,MOD_DT,PGMID2");
		mygridG2.setInitWidths("50,60,100,120,120,60,60,60,120");
		mygridG2.setColTypes("ch,ro,ed,ed,ed,ed,ro,ro,button");
	//가로 정렬
		mygridG2.setColAlign("left,left,left,left,left,left,left,left,right");
		mygridG2.setColSorting("int,int,str,str,str,str,str,str,str");		//렌더링
		mygridG2.enableSmartRendering(false);
		mygridG2.enableMultiselect(true);


		//mygridG2.setColValidators("G2_CHK,G2_AUTH_SEQ,G2_PGMID,G2_AUTH_ID,G2_AUTH_NM,G2_USE_YN,G2_ADD_DT,G2_MOD_DT,G2_PGMID2");
		mygridG2.splitAt(0);//'freezes' 0 columns 
		mygridG2.init();

				
		//블럭선택 및 복사
		mygridG2.enableBlockSelection(true);
		mygridG2.attachEvent("onKeyPress",function(code,ctrl,shift){
			alog("onKeyPress.......code=" + code + ", ctrl=" + ctrl + ", shift=" + shift);

			//셀편집모드 아닐때만 블록처리
			if(!mygridG2.editor){
				alog("editor....on");

				mygridG2.setCSVDelimiter("	");
				if(code==67&&ctrl){
					mygridG2.copyBlockToClipboard();

					var top_row_idx = mygridG2.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG2.getSelectedBlock().RightBottomRow;
					var copyRowCnt = bottom_row_idx-top_row_idx+1;
					msgNotice( copyRowCnt + "개의 행이 클립보드에 복사되었습니다.",2);

				}
				if(code==86&&ctrl){
					alog("붙여넣기 고고.....start");
					mygridG2.pasteBlockFromClipboard();

					//row상태 변경
					var top_row_idx = mygridG2.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG2.getSelectedBlock().RightBottomRow;
					alog("	top_row_idx=" + top_row_idx);
					alog("	bottom_row_idx=" + bottom_row_idx);					
					for(j=top_row_idx;j<=bottom_row_idx;j++){
						var rowID = mygridG2.getRowId(j);
						RowEditStatus = mygridG2.getUserData(rowID,"!nativeeditor_status");
						if(RowEditStatus == ""){
							mygridG2.setUserData(rowID,"!nativeeditor_status","updated");
							mygridG2.setRowTextBold(rowID);
						}
					}
					alog("붙여넣기 고고.....end");
				}
				return true;
			}else{
				alog("editor....off");
				return false;
			}
		});
		 // IO : CHK초기화	
		 // IO : AUTH_SEQ초기화	
		 // IO : 프로그램ID초기화	
		 // IO : AUTH_ID초기화	
		 // IO : AUTH_NM초기화	
		 // IO : USE_YN초기화	
		 // IO : ADD초기화	
		 // IO : MOD초기화	
		 // IO : PGMID2초기화	
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
			//', "AUTH_SEQ" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("AUTH_SEQ")).getValue()) + '"' +
			//', "PGMID" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("PGMID")).getValue()) + '"' +
			//', "AUTH_ID" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("AUTH_ID")).getValue()) + '"' +
			//', "AUTH_NM" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("AUTH_NM")).getValue()) + '"' +
			//', "USE_YN" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("USE_YN")).getValue()) + '"' +
			//', "ADD_DT" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("ADD_DT")).getValue()) + '"' +
			//', "MOD_DT" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("MOD_DT")).getValue()) + '"' +
			//', "PGMID2" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("PGMID2")).getValue()) + '"' +
			//'}');
			//A125
			lastinputG3 = ConAllData + RowAllData;
		//A124
			lastinputG3json = jQuery.parseJSON('{ "__NAME":"lastinputG3json"' +
			', "AUTH_SEQ" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("AUTH_SEQ")).getValue()) + '"' +
			'}');
		G3_SEARCH(lastinputG3); //자식그룹 호출 : 권한상세
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
//디테일 초기화	
//권한상세 폼뷰 초기화
function G3_INIT(){
  alog("G3_INIT()-------------------------start");
//컬럼 초기화
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
	$("#DATA_HEADERS").val("CHK,AUTH_SEQ,PGMID,AUTH_ID,AUTH_NM,USE_YN,ADD_DT,MOD_DT,PGMID2");
	$("#DATA_WIDTHS").val("50,60,100,120,120,60,60,60,120");
	$("#DATA_ROWS").val(myXmlString);
	myForm.submit();
}
//새로고침	
function G2_RELOAD(){
  alog("G2_RELOAD-----------------start");
  G2_SEARCH(lastinputG2);
}
//그리드 행추가 : 권한목록
	function G2_ADDBULK(){
		if( !(lastinputG2json)){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = ["","","","","","","","",""];//초기값

	var rowcnt = prompt("Please enter row's count", "input number");
	if($.isNumeric(rowcnt)){
		for(k=0;k<rowcnt;k++){
			addRow(mygridG2,tCols);  
		}
	}
			}
	}
    function G2_ROWDELETE(){	
        alog("G2_ROWDELETE()------------start");
        delRow(mygridG2);
        alog("G2_ROWDELETE()------------start");
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
    //그리드 조회(권한목록)	
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
					msgNotice("[권한목록] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[권한목록] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[권한목록] Ajax http 500 error ( " + error + " )",3);
                alog("[권한목록] Ajax http 500 error ( " + error + " )");
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
	//var ConAllData = $( "#condition" ).serialize();
//전송할 POST값 합치기
var postData = lastinputG2+ "&G2-CHK=" + arrRows ;

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
//행추가3 (권한목록)	
//그리드 행추가 : 권한목록
	function G2_ROWADD(){
		if( !(lastinputG2json)){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = ["","","","","","","","",""];//초기값
			addRow(mygridG2,tCols);
		}
	}//디테일 검색	
function G3_SEARCH(tinput){
       alog("(FORMVIEW) G3_SEARCH---------------start");


    $.ajax({
        type : "POST",
        url : url_G3_SEARCH+"&G3_CRUD_MODE=SEARCH&" ,
        data : tinput,
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
            $("#G3-CTLCUD").val("R");
			//SETVAL  가져와서 세팅
        },
        error: function(error){
            alog("Error:");
            alog(error);
        }
    });    alog("(FORMVIEW) G3_SEARCH---------------end");

}
//	
function G3_NEW(){
       alog("[FromView] G3_NEW---------------start");
	$("#G3-CTLCUD").val("C");
	//PMGIO 로직
       alog("DETAILNew30---------------end");
}
//G3_SAVE
//IO_FILE_YN = N	
function G3_SAVE(){	
	alog("G3_SAVE---------------start");

	if( !( $("#G3-CTLCUD").val() == "C" || $("#G3-CTLCUD").val() == "U") ){
		alert("신규 또는 수정 모드 진입 후 저장할 수 있습니다.")
		return;
	}

	//폼객체를 불러와서
	var form1 = $("#formviewG3")[0];

	//FormData parameter에 담아줌
	var formData = new FormData(form1);

	$.ajax({
		type : "POST",
		url : url_G3_SAVE,
		data : formData,
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
}
function G3_MODIFY(){
       alog("[FromView] G3_MODIFY---------------start");
	if( $("#G3-CTLCUD").val() == "C" ){
		alert("조회 후 수정 가능합니다. 신규 모드에서는 수정할 수 없습니다.")
		return;
	}
	if( $("#G3-CTLCUD").val() == "D" ){
		alert("조회 후 수정 가능합니다. 삭제 모드에서는 수정할 수 없습니다.")
		return;
	}

	$("#G3-CTLCUD").val("U");
       alog("[FromView] G3_MODIFY---------------end");
}
//FORMVIEW DELETE
function G3_DELETE(){	
	alog("G3_DELETE---------------start");

	//조회했는지 확인하기
	if( $("#G3-CTLCUD").val() != "R" ){
		alert("조회된 것만 삭제 가능합니다.");
		return;
	}
	//확인
	if(!confirm("정말로 삭제하시겠습니까?")){
		return;
	}
	
	//삭제처리 명령어
	$("#G3-CTLCUD").val("D");

	//폼객체를 불러와서
	var form1 = $("#formviewG3")[0];

	//FormData parameter에 담아줌
	var formData = new FormData(form1);

	$.ajax({
		type : "POST",
		url : url_G3_DELETE,
		data : formData,
		processData: false,
		contentType: false,
		success: function(tdata){
			alog(tdata);
			data = jQuery.parseJSON(tdata);
			//alert(data);
			if(data && data.RTN_CD == "200"){
				msgNotice("정상적으로 삭제되었습니다.",1);
			}else{
				msgError("오류가 발생했습니다("+ data.ERR_CD + ")." + data.RTN_MSG,3);
			}
		},
		error: function(error){
			alog("Error:");
			alog(error);
		}
	});
}
//새로고침	
function G3_RELOAD(){
	alog("G3_RELOAD-----------------start");
	G3_SEARCH(lastinputG3);
}