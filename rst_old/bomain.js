//글로벌 변수 선언
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G2_conSearch = "bomainController.php?CTLGRP=G2&CTLFNC=conSearch";//10 변수 선언	
var obj_G2_MYCOL_valid = jQuery.parseJSON( '{ "G2_MYCOL": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":11,  "DATATYPE":"STRING"} }' );  //입력해  밸리데이션
var obj_G2_TXT1_valid = jQuery.parseJSON( '{ "G2_TXT1": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":12,  "DATATYPE":""} }' );  //감사  밸리데이션
var obj_G2_MYCOL; // 입력해 변수선언var obj_G2_TXT1; // 감사 변수선언//그리드 변수 초기화	
//컨트롤러 경로
var url_G3_USERDEF = "bomainController.php?CTLGRP=G3&CTLFNC=USERDEF";
//컨트롤러 경로
var url_G3_SEARCH = "bomainController.php?CTLGRP=G3&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G3_SAVE = "bomainController.php?CTLGRP=G3&CTLFNC=SAVE";
//컨트롤러 경로
var url_G3_ROWDELETE = "bomainController.php?CTLGRP=G3&CTLFNC=ROWDELETE";
//컨트롤러 경로
var url_G3_ROWADD = "bomainController.php?CTLGRP=G3&CTLFNC=ROWADD";
//컨트롤러 경로
var url_G3_RELOAD = "bomainController.php?CTLGRP=G3&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G3_EXCEL = "bomainController.php?CTLGRP=G3&CTLFNC=EXCEL";
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
//버튼 초기화	
function G1_INIT(){
 //비어있음
  alog("G1_INIT()-------------------------start	");
	
}
// CONDITIONInit	//컨디션 초기화
function G2_INIT(){
  alog("G2_INIT()-------------------------start	");


//각 폼 오브젝트들 초기화
	//MYCOL, 입력해 초기화	
  alog("G2_INIT()-------------------------end");
}

	//감사 그리드 초기화
function G3_INIT(){
  alog("G3_INIT()-------------------------start");

        //그리드 초기화
        mygridG3 = new dhtmlXGridObject('gridG3');
        mygridG3.setDateFormat("%Y%m%d");
        mygridG3.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG3.setUserData("","gridTitle","G3 : 감사"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG3.setHeader("AAA,BBB");
		mygridG3.setColumnIds("bb,aa");
		mygridG3.setInitWidths(",");
		mygridG3.setColTypes("ed,ed");
	//가로 정렬
		mygridG3.setColAlign(",");
		mygridG3.setColSorting("str,str");		//렌더링
		mygridG3.enableSmartRendering(false);
		mygridG3.enableMultiselect(true);


		//mygridG3.setColValidators("G3_bb,G3_aa");
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
		 // IO : AAA초기화	
		 // IO : BBB초기화	
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
			//GRIDRowSelect3(rowID,celInd);
			var ConAllData = $( "#condition" ).serialize();
			var RowAllData = getRowsColid(mygridG3,rowID,"G3");
		//LAST SELECT ROW
			//lastselectG3json = jQuery.parseJSON('{ "__NAME":"lastinputG3json"' +
			//', "bb" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("bb")).getValue()) + '"' +
			//', "aa" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("aa")).getValue()) + '"' +
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
//조회 5	
function G1_ALLSEARCH(){
	   alog("G1_ALLSEARCH()--------------------------start");
   SEARCHALL();
   alog("G1_BTNCLICK()--------------------------end");
}
// CONDITIONSearch	
function G2_conSearch(){
	alog("G2_conSearch--------------------------start");
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
//행추가3 (감사)	
//그리드 행추가 : 감사
	function G3_ROWADD(){
		if( !(lastinputG3json)){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = ["",""];//초기값
			addRow(mygridG3,tCols);
		}
	}    function G3_ROWDELETE(){	
        alog("G3_ROWDELETE()------------start");
        delRow(mygridG3);
        alog("G3_ROWDELETE()------------start");
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
    //그리드 조회(감사)	
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
					msgNotice("[감사] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[감사] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[감사] Ajax http 500 error ( " + error + " )",3);
                alog("[감사] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearchG3()------------end");
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
	$("#DATA_HEADERS").val("bb,aa");
	$("#DATA_WIDTHS").val(",");
	$("#DATA_ROWS").val(myXmlString);
	myForm.submit();
}
//새로고침	
function G3_RELOAD(){
  alog("G3_RELOAD-----------------start");
  G3_SEARCH(lastinputG3);
}
