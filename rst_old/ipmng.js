//글로벌 변수 선언
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SEARCHALL = "ipmngController.php?CTLGRP=G1&CTLFNC=SEARCHALL";//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SAVE = "ipmngController.php?CTLGRP=G1&CTLFNC=SAVE";//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_RESET = "ipmngController.php?CTLGRP=G1&CTLFNC=RESET";//조건 변수 선언	
//그리드 변수 초기화	
//컨트롤러 경로
var url_G2_SEARCH = "ipmngController.php?CTLGRP=G2&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G2_SAVE = "ipmngController.php?CTLGRP=G2&CTLFNC=SAVE";
//컨트롤러 경로
var url_G2_ROWDELETE = "ipmngController.php?CTLGRP=G2&CTLFNC=ROWDELETE";
//컨트롤러 경로
var url_G2_ROWBULKADD = "ipmngController.php?CTLGRP=G2&CTLFNC=ROWBULKADD";
//컨트롤러 경로
var url_G2_ROWADD = "ipmngController.php?CTLGRP=G2&CTLFNC=ROWADD";
//컨트롤러 경로
var url_G2_RELOAD = "ipmngController.php?CTLGRP=G2&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G2_HIDDENCOL = "ipmngController.php?CTLGRP=G2&CTLFNC=HIDDENCOL";
//컨트롤러 경로
var url_G2_EXCEL = "ipmngController.php?CTLGRP=G2&CTLFNC=EXCEL";
//컨트롤러 경로
var url_G2_CHKSAVE = "ipmngController.php?CTLGRP=G2&CTLFNC=CHKSAVE";
//그리드 객체
var mygridG2,isToggleHiddenColG2,lastinputG2,lastinputG2json,lastrowidG2;
var lastselectG2json;//화면 초기화
function initBody(){
     alog("initBody()-----------------------start");
	
   //dhtmlx 메시지 박스 초기화
   dhtmlx.message.position="bottom";
	G1_INIT();
		G2_INIT();
		alog("initBody()-----------------------end");
} //initBody()
	//그룹별 초기화 함수
// CONDITIONInit	//컨디션 초기화
function G1_INIT(){
  alog("G1_INIT()-------------------------start	");
//각 폼 오브젝트들 초기화
  alog("G1_INIT()-------------------------end");
}

	//IP목록 그리드 초기화
function G2_INIT(){
  alog("G2_INIT()-------------------------start");

        //그리드 초기화
        mygridG2 = new dhtmlXGridObject('gridG2');
        mygridG2.setDateFormat("%Y%m%d");
        mygridG2.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG2.setUserData("","gridTitle","G2 : IP목록"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG2.setHeader("IP_SEQ,PGMTYPE,IP,DESC,ADD,ADD_ID,MOD,MOD_ID");
		mygridG2.setColumnIds("IP_SEQ,PGMTYPE,IP,IP_DESC,ADD_DT,ADD_ID,MOD_DT,MOD_ID");
		mygridG2.setInitWidths("60,60,60,80,60,60,120,60");
		mygridG2.setColTypes("ro,ed,ed,ed,ro,ro,ro,ro");
	//가로 정렬
		mygridG2.setColAlign("left,left,left,left,left,left,left,left");
		mygridG2.setColSorting("int,str,str,str,str,str,str,str");		//렌더링
		mygridG2.enableSmartRendering(false);
		mygridG2.enableMultiselect(true);


		//mygridG2.setColValidators("G2_IP_SEQ,G2_PGMTYPE,G2_IP,G2_IP_DESC,G2_ADD_DT,G2_ADD_ID,G2_MOD_DT,G2_MOD_ID");
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
		 // IO : IP_SEQ초기화	
		 // IO : PGMTYPE초기화	
		 // IO : IP초기화	
		 // IO : DESC초기화	
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
			//', "IP_SEQ" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("IP_SEQ")).getValue()) + '"' +
			//', "PGMTYPE" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("PGMTYPE")).getValue()) + '"' +
			//', "IP" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("IP")).getValue()) + '"' +
			//', "IP_DESC" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("IP_DESC")).getValue()) + '"' +
			//', "ADD_DT" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("ADD_DT")).getValue()) + '"' +
			//', "ADD_ID" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("ADD_ID")).getValue()) + '"' +
			//', "MOD_DT" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("MOD_DT")).getValue()) + '"' +
			//', "MOD_ID" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("MOD_ID")).getValue()) + '"' +
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

	//D146 그룹별 기능 함수 출력	
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
	$("#DATA_HEADERS").val("IP_SEQ,PGMTYPE,IP,IP_DESC,ADD_DT,ADD_ID,MOD_DT,MOD_ID");
	$("#DATA_WIDTHS").val("60,60,60,80,60,60,120,60");
	$("#DATA_ROWS").val(myXmlString);
	myForm.submit();
}
//행추가3 (IP목록)	
//그리드 행추가 : IP목록
	function G2_ROWADD(){
		if( !(lastinputG2json)){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = ["","","","","","","",""];//초기값
			addRow(mygridG2,tCols);
		}
	}//새로고침	
function G2_RELOAD(){
  alog("G2_RELOAD-----------------start");
  G2_SEARCH(lastinputG2);
}
//그리드 행추가 : IP목록
	function G2_ROWBULKADD(){
		if( !(lastinputG2json)){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = ["","","","","","","",""];//초기값

	var rowcnt = prompt("Please enter row's count", "input number");
	if($.isNumeric(rowcnt)){
		for(k=0;k<rowcnt;k++){
			addRow(mygridG2,tCols);  
		}
	}
			}
	}
    function G2_HIDDENCOL(){
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
    //그리드 조회(IP목록)	
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
					msgNotice("[IP목록] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[IP목록] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[IP목록] Ajax http 500 error ( " + error + " )",3);
                alog("[IP목록] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearchG2()------------end");
    }