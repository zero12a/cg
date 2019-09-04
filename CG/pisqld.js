//글로벌 변수 선언	
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_USERDEF = "pisqldController?CTLGRP=G1&CTLFNC=USERDEF";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SEARCHALL = "pisqldController?CTLGRP=G1&CTLFNC=SEARCHALL";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SAVE = "pisqldController?CTLGRP=G1&CTLFNC=SAVE";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_RESET = "pisqldController?CTLGRP=G1&CTLFNC=RESET";
// 변수 선언	
var obj_G1_PGMSEQ; // PGMSEQ 변수선언
var obj_G1_COLID; // 컬럼ID 변수선언
var obj_G1_PJTSEQ; // PJTSEQ 변수선언
var obj_G1_SQLSEQ; // SQLSEQ 변수선언
var $btG2 = null; //
	//컨트롤러 경로 s
	var url_G2_USERDEF = "pisqldController?CTLGRP=G2&CTLFNC=USERDEF";
	//컨트롤러 경로 s
	var url_G2_SEARCH = "pisqldController?CTLGRP=G2&CTLFNC=SEARCH";
	//컨트롤러 경로 s
	var url_G2_RELOAD = "pisqldController?CTLGRP=G2&CTLFNC=RELOAD";
	//컨트롤러 경로 s
	var url_G2_EXCEL = "pisqldController?CTLGRP=G2&CTLFNC=EXCEL";
	//컨트롤러 경로 s
	var url_G2_CHKSAVE = "pisqldController?CTLGRP=G2&CTLFNC=CHKSAVE";
//디테일 변수 초기화	

var obj_G3_SQLSEQ_valid = jQuery.parseJSON( '{ "G3_SQLSEQ": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":30,  "DATATYPE":"NUMBER"} }' );   // SQLSEQ 밸리데이션 선언
var obj_G3_COLSEQ_valid = jQuery.parseJSON( '{ "G3_COLSEQ": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":30,  "DATATYPE":"NUMBER"} }' );   // COLSEQ 밸리데이션 선언
var obj_G3_PJTSEQ_valid = jQuery.parseJSON( '{ "G3_PJTSEQ": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":20,  "DATATYPE":"NUMBER"} }' );   // PJTSEQ 밸리데이션 선언
var obj_G3_PGMSEQ_valid = jQuery.parseJSON( '{ "G3_PGMSEQ": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":30,  "DATATYPE":"NUMBER"} }' );   // PGMSEQ 밸리데이션 선언
var obj_G3_SQLGBN_valid = jQuery.parseJSON( '{ "G3_SQLGBN": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":1,  "DATATYPE":"STRING"} }' );   // SQLGBN 밸리데이션 선언
var obj_G3_COLID_valid = jQuery.parseJSON( '{ "G3_COLID": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":30,  "DATATYPE":"STRING"} }' );   // 컬럼ID 밸리데이션 선언
var obj_G3_DDCOLID_valid = jQuery.parseJSON( '{ "G3_DDCOLID": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":50,  "DATATYPE":"STRING"} }' );   // DDCOLID 밸리데이션 선언
var obj_G3_REQUIREYN_valid = jQuery.parseJSON( '{ "G3_REQUIREYN": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":1,  "DATATYPE":"STRING"} }' );   // 필수 밸리데이션 선언
var obj_G3_ORD_valid = jQuery.parseJSON( '{ "G3_ORD": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":10,  "DATATYPE":"NUMBER"} }' );   // ORD 밸리데이션 선언
var obj_G3_MODDT_valid = jQuery.parseJSON( '{ "G3_MODDT": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":14,  "DATATYPE":"STRING"} }' );   // MODDT 밸리데이션 선언
//폼뷰 컨트롤러 경로
var url_G3_USERDEF = "pisqldController?CTLGRP=G3&CTLFNC=USERDEF";
//폼뷰 컨트롤러 경로
var url_G3_SEARCH = "pisqldController?CTLGRP=G3&CTLFNC=SEARCH";
//폼뷰 컨트롤러 경로
var url_G3_SAVE = "pisqldController?CTLGRP=G3&CTLFNC=SAVE";
//폼뷰 컨트롤러 경로
var url_G3_RELOAD = "pisqldController?CTLGRP=G3&CTLFNC=RELOAD";
//폼뷰 컨트롤러 경로
var url_G3_NEW = "pisqldController?CTLGRP=G3&CTLFNC=NEW";
//폼뷰 컨트롤러 경로
var url_G3_MODIFY = "pisqldController?CTLGRP=G3&CTLFNC=MODIFY";
//폼뷰 컨트롤러 경로
var url_G3_DELETE = "pisqldController?CTLGRP=G3&CTLFNC=DELETE";
var obj_G3_SQLSEQ;   // SQLSEQ 글로벌 변수 선언
var obj_G3_COLSEQ;   // COLSEQ 글로벌 변수 선언
var obj_G3_PJTSEQ;   // PJTSEQ 글로벌 변수 선언
var obj_G3_PGMSEQ;   // PGMSEQ 글로벌 변수 선언
var obj_G3_SQLGBN;   // SQLGBN 글로벌 변수 선언
var obj_G3_COLID;   // 컬럼ID 글로벌 변수 선언
var obj_G3_DDCOLID;   // DDCOLID 글로벌 변수 선언
var obj_G3_REQUIREYN;   // 필수 글로벌 변수 선언
var obj_G3_ORD;   // ORD 글로벌 변수 선언
var obj_G3_MODDT;   // MODDT 글로벌 변수 선언
//화면 초기화	
function initBody(){
     alog("initBody()-----------------------start");
	
   //dhtmlx 메시지 박스 초기화
   dhtmlx.message.position="bottom";
	G1_INIT();	
		G2_INIT();	
		G3_INIT();	
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
	//COLID, 컬럼ID 초기화	
	//PGMSEQ, PGMSEQ 초기화	
	//PJTSEQ, PJTSEQ 초기화	
	//SQLSEQ, SQLSEQ 초기화	
  alog("G1_INIT()-------------------------end");
}

// 그리드 초기화
function G2_INIT(){
	alog("G2_INIT()-------------------------start");
	$btG2 = $('#btG2').bootstrapTable({
		columns:[
			{
				field: 'ROWID',
				title: 'ROWID',
				checkbox: false,
				visible: false,
				sortable: false,
				align: 'center',
				valign: 'middle',
			}
			,{
			field: 'SQLSEQ',
			title: 'SQLSEQ',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'COLSEQ',
			title: 'COLSEQ',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'PJTSEQ',
			title: 'PJTSEQ',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'PGMSEQ',
			title: 'PGMSEQ',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'SQLGBN',
			title: 'SQLGBN',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'COLID',
			title: '컬럼ID',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'DDCOLID',
			title: 'DDCOLID',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'REQUIREYN',
			title: '필수',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'ORD',
			title: 'ORD',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'MODDT',
			title: 'MODDT',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
]
	});
	$btG2.on('click-row.bs.table', function (e, row, $element) {
		//    alert(row.myid);
		//alert(JSON.stringify(row))

		lastinputG3 = new HashMap(); // 
		lastinputG3.set("G2-SQLSEQ", row.SQLSEQ); // 
		lastinputG3.set("G2-COLSEQ", row.COLSEQ); // 
		lastinputG3.set("G2-PJTSEQ", row.PJTSEQ); // 
		lastinputG3.set("G2-PGMSEQ", row.PGMSEQ); // 
		G3_SEARCH(lastinputG3,uuidv4()); //자식그룹 호출 : 
		//    //alog(field);
		});
}
//디테일 초기화	
// 폼뷰 초기화
function G3_INIT(){
  alog("G3_INIT()-------------------------start");










	//컬럼 초기화
	//SQLSEQ, SQLSEQ 초기화		//COLSEQ, COLSEQ 초기화		//PJTSEQ, PJTSEQ 초기화		//PGMSEQ, PGMSEQ 초기화		//SQLGBN, SQLGBN 초기화	
	//COLID, 컬럼ID 초기화	
	//DDCOLID, DDCOLID 초기화	
	//REQUIREYN, 필수 초기화	
	//ORD, ORD 초기화	
	//MODDT, MODDT 초기화	  alog("G3_INIT()-------------------------end");
}
//D146 그룹별 기능 함수 출력		
//검색조건 초기화
function G1_RESET(){
	alog("G1_RESET--------------------------start");
	$('#condition')[0].reset();
}
// CONDITIONSearch	
function G1_SEARCHALL(token){
	alog("G1_SEARCHALL--------------------------start");
	//입력값검증
	//폼의 모든값 구하기
	var ConAllData = $( "#condition" ).serialize();
	alog("ConAllData:" + ConAllData);
	//json : G1
			lastinputG2 = new HashMap(); //
		//  호출
	G2_SEARCH(lastinputG2,token);
	alog("G1_SEARCHALL--------------------------end");
}
//사용자정의함수 : 사용자정의
function G1_USERDEF(token){
	alog("G1_USERDEF-----------------start");

	alog("G1_USERDEF-----------------end");
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
//새로고침	
function G2_RELOAD(token){
  alog("G2_RELOAD-----------------start");
  G2_SEARCH(lastinputG2,token);
}
// 엑셀 내려받기
function G2_EXCEL(){
	alog("G2_EXCEL()-------------------------start");

	$btG2.tableExport({type:'excel'});

	alog("G2_EXCEL()------------end");
}
//그리드 조회()	
function G2_SEARCH(tinput,token){
	alog("G2_SEARCH()------------start");
	$("#spanG2Cnt").text("");
	//post 만들기
	sendFormData = new FormData($("#condition")[0]);
	if(typeof tinput != "undefined"){
		var tKeys = tinput.keys();
		for(i=0;i<tKeys.length;i++) {
			sendFormData.append(tKeys[i],tinput.get(tKeys[i]));
			//console.log(tKeys[i]+ '='+ tinput.get(tKeys[i])); 
		}
	}
	$btG2.bootstrapTable('showLoading');

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

			$btG2.bootstrapTable('hideLoading');

			//그리드에 데이터 반영
			if(data.RTN_CD == "200"){
				var row_cnt = 0;
				if(data.RTN_DATA){
					row_cnt = data.RTN_DATA.rows.length;
					$("#spanG2Cnt").text(row_cnt);
					$btG2.bootstrapTable('removeAll'); //모두 지우기
					$btG2.bootstrapTable('load', data.RTN_DATA.rows);

					}else{
						$("#spanG2Cnt").text("-");
					}
					msgNotice("[] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[] Ajax http 500 error ( " + error + " )",3);
                alog("[] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
		alog("G2_SEARCH()------------end");
}

//
function G2_CHKSAVE(token){
	alog("G2_CHKSAVE()------------start");

	var jsonSelectedRows = $btG2.bootstrapTable('getSelections');
	var strSelectedRowsIds = "";

	for(i=0;i<jsonSelectedRows.length;i++){
		if(i>0) strSelectedRowsIds += ",";


		strSelectedRowsIds += jsonSelectedRows[i].COLSEQ;
	}
        //전송용 post 만들기
		sendFormData = new FormData($("#condition")[0]);

		if(typeof lastinputG2 != "undefined"){
			var tKeys = lastinputG2.keys();
			for(i=0;i<tKeys.length;i++) {
				sendFormData.append(tKeys[i],lastinputG2.get(tKeys[i]));
				//console.log(tKeys[i]+ '='+ lastinputG2.get(tKeys[i])); 
			}
		}
	//CHK 배열 합치기
	sendFormData.append("G2-CHK",strSelectedRowsIds);

	$.ajax({
		type : "POST",
		url : url_G2_CHKSAVE + "&TOKEN=" + token ,
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
			if(data && data.RTN_CD == "200"){
				msgNotice("[] 정상 처리되었습니다.");
			}else{
				msgError("처리 결과 실패했습니다. ( " + data.ERR_CD + ":" + data.RTN_MSG + " )",3);
			}

		},
		error: function(error){
			msgError("Ajax http 500 error ( " + error + " )");
			alog("Ajax http 500 error ( " + error + " )");
		}
	});
	
	alog("G2_CHKSAVE()------------end");
}
//사용자정의함수 : 사용자정의
function G2_USERDEF(token){
	alog("G2_USERDEF-----------------start");

	alog("G2_USERDEF-----------------end");
}
//사용자정의함수 : 사용자정의
function G3_USERDEF(token){
	alog("G3_USERDEF-----------------start");

	alog("G3_USERDEF-----------------end");
}
//G3_SAVE
//IO_FILE_YN = N	
	//IO_FILE_YN = N	
function G3_SAVE(token){	
	alog("G3_SAVE---------------start");

	if( !( $("#G3-CTLCUD").val() == "C" || $("#G3-CTLCUD").val() == "U") ){
		alert("신규 또는 수정 모드 진입 후 저장할 수 있습니다.")
		return;
	}

	//전송용 데이터 생성하기
	var sendFormData = new FormData($("#formviewG3")[0]);

	//컨디션 데이터 추가하기
	conditionData = new FormData($("#condition")[0]);
    var es, e, pair;
    for (es = conditionData.entries(); !(e = es.next()).done && (pair = e.value);) {
		sendFormData.append(pair[0],pair[1]);
    }

	$.ajax({
		type : "POST",
		url : url_G3_SAVE + "&TOKEN=" + token,
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
}function G3_MODIFY(){
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
//	
function G3_NEW(){
       alog("[FromView] G3_NEW---------------start");
	$("#G3-CTLCUD").val("C");
	//PMGIO 로직
	$("#G3-SQLSEQ").text("");//SQLSEQ 신규초기화		$("#G3-COLSEQ").text("");//COLSEQ 신규초기화		$("#G3-PJTSEQ").text("");//PJTSEQ 신규초기화		$("#G3-PGMSEQ").text("");//PGMSEQ 신규초기화		$("#G3-SQLGBN").val("");//SQLGBN 신규초기화	
	$("#G3-COLID").val("");//컬럼ID 신규초기화	
	$("#G3-DDCOLID").val("");//DDCOLID 신규초기화	
	$("#G3-REQUIREYN").val("");//필수 신규초기화	
	$("#G3-ORD").val("");//ORD 신규초기화	
	$("#G3-MODDT").text("");//MODDT 신규초기화	       alog("DETAILNew30---------------end");
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
//디테일 검색	
function G3_SEARCH(tinput,token){
       alog("(FORMVIEW) G3_SEARCH---------------start");

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
        url : url_G3_SEARCH+"&TOKEN=" + token + "&G3_CRUD_MODE=SEARCH" ,
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
            $("#G3-CTLCUD").val("R");
			//SETVAL  가져와서 세팅
			$("#G3-SQLSEQ").text(data.RTN_DATA.SQLSEQ);//SQLSEQ 변수세팅
			$("#G3-COLSEQ").text(data.RTN_DATA.COLSEQ);//COLSEQ 변수세팅
			$("#G3-PJTSEQ").text(data.RTN_DATA.PJTSEQ);//PJTSEQ 변수세팅
			$("#G3-PGMSEQ").text(data.RTN_DATA.PGMSEQ);//PGMSEQ 변수세팅
			$("#G3-SQLGBN").val(data.RTN_DATA.SQLGBN);//SQLGBN 변수세팅
			$("#G3-COLID").val(data.RTN_DATA.COLID);//컬럼ID 변수세팅
			$("#G3-DDCOLID").val(data.RTN_DATA.DDCOLID);//DDCOLID 변수세팅
			$("#G3-REQUIREYN").val(data.RTN_DATA.REQUIREYN);//필수 변수세팅
			$("#G3-ORD").val(data.RTN_DATA.ORD);//ORD 변수세팅
			$("#G3-MODDT").text(data.RTN_DATA.MODDT);//MODDT 변수세팅
        },
        error: function(error){
            alog("Error:");
            alog(error);
        }
    });
    alog("(FORMVIEW) G3_SEARCH---------------end");

}
//새로고침	
function G3_RELOAD(token){
	alog("G3_RELOAD-----------------start");
	G3_SEARCH(lastinputG3,token);
}