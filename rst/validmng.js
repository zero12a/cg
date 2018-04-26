//글로벌 변수 선언
//버틀 그룹쪽에서 컨틀롤러 호출
var url_C1_SEARCHALL = "validmngController.php?CTLGRP=C1&CTLFNC=SEARCHALL";//버틀 그룹쪽에서 컨틀롤러 호출
var url_C1_SAVE = "validmngController.php?CTLGRP=C1&CTLFNC=SAVE";//버틀 그룹쪽에서 컨틀롤러 호출
var url_C1_RESET = "validmngController.php?CTLGRP=C1&CTLFNC=RESET";//조회조건 변수 선언	
var obj_C1_PJTSEQ_valid = jQuery.parseJSON( '{ "C1_PJTSEQ": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":20,  "DATATYPE":"NUMBER"} }' );  //PJTSEQ  밸리데이션
var obj_C1_PJTSEQ; // PJTSEQ 변수선언//그리드 변수 초기화	
//컨트롤러 경로
var url_G2_SEARCH = "validmngController.php?CTLGRP=G2&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G2_SAVE = "validmngController.php?CTLGRP=G2&CTLFNC=SAVE";
//컨트롤러 경로
var url_G2_ROWDELETE = "validmngController.php?CTLGRP=G2&CTLFNC=ROWDELETE";
//컨트롤러 경로
var url_G2_ROWADD = "validmngController.php?CTLGRP=G2&CTLFNC=ROWADD";
//컨트롤러 경로
var url_G2_RELOAD = "validmngController.php?CTLGRP=G2&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G2_HIDDENCOL = "validmngController.php?CTLGRP=G2&CTLFNC=HIDDENCOL";
//컨트롤러 경로
var url_G2_EXCEL = "validmngController.php?CTLGRP=G2&CTLFNC=EXCEL";
//컨트롤러 경로
var url_G2_CHKSAVE = "validmngController.php?CTLGRP=G2&CTLFNC=CHKSAVE";
//그리드 객체
var mygridG2,isToggleHiddenColG2,lastinputG2,lastinputG2json,lastrowidG2;
var lastselectG2json;//디테일 변수 초기화	

//폼뷰 컨트롤러 경로
var url_F3_SEARCH = "validmngController.php?CTLGRP=F3&CTLFNC=SEARCH";
//폼뷰 컨트롤러 경로
var url_F3_SAVE = "validmngController.php?CTLGRP=F3&CTLFNC=SAVE";
//폼뷰 컨트롤러 경로
var url_F3_RELOAD = "validmngController.php?CTLGRP=F3&CTLFNC=RELOAD";
//폼뷰 컨트롤러 경로
var url_F3_NEW = "validmngController.php?CTLGRP=F3&CTLFNC=NEW";
//폼뷰 컨트롤러 경로
var url_F3_MODIFY = "validmngController.php?CTLGRP=F3&CTLFNC=MODIFY";
//폼뷰 컨트롤러 경로
var url_F3_DELETE = "validmngController.php?CTLGRP=F3&CTLFNC=DELETE";
//화면 초기화
function initBody(){
     alog("initBody()-----------------------start");
	
   //dhtmlx 메시지 박스 초기화
   dhtmlx.message.position="bottom";
	C1_INIT();
		G2_INIT();
		F3_INIT();
		alog("initBody()-----------------------end");
} //initBody()
	//그룹별 초기화 함수
// CONDITIONInit	//컨디션 초기화
function C1_INIT(){
  alog("C1_INIT()-------------------------start	");

//각 폼 오브젝트들 초기화
	//PJTSEQ, PJTSEQ 초기화	
  alog("C1_INIT()-------------------------end");
}

	//목록 그리드 초기화
function G2_INIT(){
  alog("G2_INIT()-------------------------start");

        //그리드 초기화
        mygridG2 = new dhtmlXGridObject('gridG2');
        mygridG2.setDateFormat("%Y%m%d");
        mygridG2.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG2.setUserData("","gridTitle","G2 : 목록"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG2.setHeader("#master_checkbox,VALIDSEQ,PJTSEQ,데이터타입,VALIDID,VALIDNM,VALIDORD,VALIDTYPE,INVALIDMSG,MATSTR,ADDDT,수정일");
		mygridG2.setColumnIds("ROWCHK,VALIDSEQ,PJTSEQ,DATATYPE,VALIDID,VALIDNM,VALIDORD,VALIDTYPE,INVALIDMSG,MATSTR,ADDDT,MODDT");
		mygridG2.setInitWidths("40,60,60,60,60,60,60,60,80,120,60,60");
		mygridG2.setColTypes("ch,ro,ed,co,ed,ed,ed,coro,ed,ed,ed,ed");
	//가로 정렬
		mygridG2.setColAlign("center,left,left,left,left,left,left,left,left,left,left,left");
		mygridG2.setColSorting("int,int,int,str,str,str,str,str,str,str,str,str");		//렌더링
		mygridG2.enableSmartRendering(false);
		mygridG2.enableMultiselect(true);


		//mygridG2.setColValidators("G2_ROWCHK,G2_VALIDSEQ,G2_PJTSEQ,G2_DATATYPE,G2_VALIDID,G2_VALIDNM,G2_VALIDORD,G2_VALIDTYPE,G2_INVALIDMSG,G2_MATSTR,G2_ADDDT,G2_MODDT");
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
		 // IO : ROWCHK초기화	
		 // IO : VALIDSEQ초기화	
		 // IO : PJTSEQ초기화	
		setCodeCombo("GRID",mygridG2.getCombo(mygridG2.getColIndexById("DATATYPE")),"DATATYPE"); // IO : 데이터타입초기화	
		 // IO : VALIDID초기화	
		 // IO : VALIDNM초기화	
		 // IO : VALIDORD초기화	
		setCodeCombo("GRID",mygridG2.getCombo(mygridG2.getColIndexById("VALIDTYPE")),"VALIDTYPE"); // IO : VALIDTYPE초기화	
		 // IO : INVALIDMSG초기화	
		 // IO : MATSTR초기화	
		 // IO : ADDDT초기화	
		 // IO : 수정일초기화	
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
			//', "ROWCHK" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("ROWCHK")).getValue()) + '"' +
			//', "VALIDSEQ" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("VALIDSEQ")).getValue()) + '"' +
			//', "PJTSEQ" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("PJTSEQ")).getValue()) + '"' +
			//', "DATATYPE" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("DATATYPE")).getValue()) + '"' +
			//', "VALIDID" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("VALIDID")).getValue()) + '"' +
			//', "VALIDNM" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("VALIDNM")).getValue()) + '"' +
			//', "VALIDORD" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("VALIDORD")).getValue()) + '"' +
			//', "VALIDTYPE" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("VALIDTYPE")).getValue()) + '"' +
			//', "INVALIDMSG" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("INVALIDMSG")).getValue()) + '"' +
			//', "MATSTR" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("MATSTR")).getValue()) + '"' +
			//', "ADDDT" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("ADDDT")).getValue()) + '"' +
			//', "MODDT" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("MODDT")).getValue()) + '"' +
			//'}');
			//A125
			lastinputF3 = ConAllData + RowAllData;
		//A124
			lastinputF3json = jQuery.parseJSON('{ "__NAME":"lastinputF3json"' +
			', "VALIDSEQ" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("VALIDSEQ")).getValue()) + '"' +
			'}');
			F3_SEARCH(lastinputF3); //자식그룹 호출 : 상세
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
            mygridG2.setColumnHidden(mygridG2.getColIndexById("VALIDSEQ"),true); //VALIDSEQ
        alog("G2_INIT()-------------------------end");
     }

//디테일 초기화	
//상세 폼뷰 초기화
function F3_INIT(){
  alog("F3_INIT()-------------------------start");
//컬럼 초기화
  alog("F3_INIT()-------------------------end");
}
	//D146 그룹별 기능 함수 출력	
// CONDITIONSearch	
function C1_SEARCHALL(){
	alog("C1_SEARCHALL--------------------------start");
	//입력값검증
	//폼의 모든값 구하기
	var ConAllData = $( "#condition" ).serialize();
	alog("ConAllData:" + ConAllData);
	lastinputG2 = ConAllData ;
	//json : C1
            lastinputG2json = jQuery.parseJSON('{ "__NAME":"lastinputG2json"' +'}');
	//  호출
	G2_SEARCH(lastinputG2);
	alog("C1_SEARCHALL--------------------------end");
}
//조회조건, 저장	
function C1_SAVE(){
 alog("C1_SAVE-------------------start");
	//FormData parameter에 담아줌	
	var formData = new FormData();	//C1 getparams	
	//그리드G2 가져오기	
    mygridG2.setSerializationLevel(true,false,false,false,true,false);
    var paramsG2 = mygridG2.serialize();
	formData.append("G2_XML",paramsG2);
//var params = { CTL : "C1_SAVE", G2_XML : paramsG2	};
	$.ajax({	
		type : "POST",
		url : url_C1_SAVE  ,
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
			msgError("[C1] Ajax http 500 error ( " + error + " )");
			alog("[C1] Ajax http 500 error ( " + error + " )");
		}
	});
	alog("C1_SAVE-------------------end");	
}
//검색조건 초기화
function C1_RESET(){
	alog("C1_RESET--------------------------start");
	$('#condition')[0].reset();
}
    function G2_HIDDENCOL(){
		alog("G2_HIDDENCOL()..................start");
        if(isToggleHiddenColG2){
            isToggleHiddenColG2 = false;            mygridG2.setColumnHidden(mygridG2.getColIndexById("VALIDSEQ"),true); //VALIDSEQ
     }else{
            isToggleHiddenColG2 = true;
            mygridG2.setColumnHidden(mygridG2.getColIndexById("VALIDSEQ"),false); //VALIDSEQ
        }
		alog("G2_HIDDENCOL()..................end");
    }
    function G2_ROWDELETE(){	
        alog("G2_ROWDELETE()------------start");
        delRow(mygridG2);
        alog("G2_ROWDELETE()------------start");
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
	$("#DATA_HEADERS").val("ROWCHK,VALIDSEQ,PJTSEQ,DATATYPE,VALIDID,VALIDNM,VALIDORD,VALIDTYPE,INVALIDMSG,MATSTR,ADDDT,MODDT");
	$("#DATA_WIDTHS").val("40,60,60,60,60,60,60,60,80,120,60,60");
	$("#DATA_ROWS").val(myXmlString);
	myForm.submit();
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
    //그리드 조회(목록)	
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
					msgNotice("[목록] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[목록] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[목록] Ajax http 500 error ( " + error + " )",3);
                alog("[목록] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearchG2()------------end");
    }
//행추가3 (목록)	
//그리드 행추가 : 목록
	function G2_ROWADD(){
		if( !(lastinputG2json)){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = ["","","","","","","","","","","",""];//초기값
			addRow(mygridG2,tCols);
		}
	}//새로고침	
function F3_RELOAD(){
	alog("F3_RELOAD-----------------start");
	F3_SEARCH(lastinputF3);
}//디테일 검색	
function F3_SEARCH(tinput){
       alog("(FORMVIEW) F3_SEARCH---------------start");


    $.ajax({
        type : "POST",
        url : url_F3_SEARCH+"&F3_CRUD_MODE=SEARCH&" ,
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
            $("#F3-CTLCUD").val("R");
			//SETVAL  가져와서 세팅
        },
        error: function(error){
            alog("Error:");
            alog(error);
        }
    });    alog("(FORMVIEW) F3_SEARCH---------------end");

}
//	
function F3_NEW(){
       alog("[FromView] F3_NEW---------------start");
	$("#F3-CTLCUD").val("C");
	//PMGIO 로직
       alog("DETAILNew30---------------end");
}
function F3_MODIFY(){
       alog("[FromView] F3_MODIFY---------------start");
	if( $("#F3-CTLCUD").val() == "C" ){
		alert("조회 후 수정 가능합니다. 신규 모드에서는 수정할 수 없습니다.")
		return;
	}
	if( $("#F3-CTLCUD").val() == "D" ){
		alert("조회 후 수정 가능합니다. 삭제 모드에서는 수정할 수 없습니다.")
		return;
	}

	$("#F3-CTLCUD").val("U");
       alog("[FromView] F3_MODIFY---------------end");
}
//F3_SAVE
//IO_FILE_YN = N	
function F3_SAVE(){	
	alog("F3_SAVE---------------start");

	if( !( $("#F3-CTLCUD").val() == "C" || $("#F3-CTLCUD").val() == "U") ){
		alert("신규 또는 수정 모드 진입 후 저장할 수 있습니다.")
		return;
	}

	//폼객체를 불러와서
	var form1 = $("#formviewF3")[0];

	//FormData parameter에 담아줌
	var formData = new FormData(form1);

	$.ajax({
		type : "POST",
		url : url_F3_SAVE,
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
//FORMVIEW DELETE
function F3_DELETE(){	
	alog("F3_DELETE---------------start");

	//조회했는지 확인하기
	if( $("#F3-CTLCUD").val() != "R" ){
		alert("조회된 것만 삭제 가능합니다.");
		return;
	}
	//확인
	if(!confirm("정말로 삭제하시겠습니까?")){
		return;
	}
	
	//삭제처리 명령어
	$("#F3-CTLCUD").val("D");

	//폼객체를 불러와서
	var form1 = $("#formviewF3")[0];

	//FormData parameter에 담아줌
	var formData = new FormData(form1);

	$.ajax({
		type : "POST",
		url : url_F3_DELETE,
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
