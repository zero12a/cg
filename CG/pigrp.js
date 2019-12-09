//글로벌 변수 선언
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_USERDEF = "pigrpController?CTLGRP=G1&CTLFNC=USERDEF";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SEARCHALL = "pigrpController?CTLGRP=G1&CTLFNC=SEARCHALL";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SAVE = "pigrpController?CTLGRP=G1&CTLFNC=SAVE";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_RESET = "pigrpController?CTLGRP=G1&CTLFNC=RESET";
//조건 변수 선언	
var obj_G1_PJTSEQ; // PJTSEQ 변수선언
var obj_G1_PGMSEQ; // PGMSEQ 변수선언
var obj_G1_GRPNM; // GRPNM 변수선언
var $btG2 = null; //GRP목록
	//컨트롤러 경로 s
	var url_G2_USERDEF = "pigrpController?CTLGRP=G2&CTLFNC=USERDEF";
	//컨트롤러 경로 s
	var url_G2_SEARCH = "pigrpController?CTLGRP=G2&CTLFNC=SEARCH";
	//컨트롤러 경로 s
	var url_G2_RELOAD = "pigrpController?CTLGRP=G2&CTLFNC=RELOAD";
	//컨트롤러 경로 s
	var url_G2_EXCEL = "pigrpController?CTLGRP=G2&CTLFNC=EXCEL";
	//컨트롤러 경로 s
	var url_G2_CHKSAVE = "pigrpController?CTLGRP=G2&CTLFNC=CHKSAVE";
//디테일 변수 초기화	

//폼뷰 컨트롤러 경로
var url_G3_SEARCH = "pigrpController?CTLGRP=G3&CTLFNC=SEARCH";
//폼뷰 컨트롤러 경로
var url_G3_reload = "pigrpController?CTLGRP=G3&CTLFNC=reload";
//폼뷰 컨트롤러 경로
var url_G3_save = "pigrpController?CTLGRP=G3&CTLFNC=save";
//폼뷰 컨트롤러 경로
var url_G3_edit = "pigrpController?CTLGRP=G3&CTLFNC=edit";
//폼뷰 컨트롤러 경로
var url_G3_new = "pigrpController?CTLGRP=G3&CTLFNC=new";
//폼뷰 컨트롤러 경로
var url_G3_del = "pigrpController?CTLGRP=G3&CTLFNC=del";
var obj_G3_PJTSEQ;   // PJTSEQ 글로벌 변수 선언
var obj_G3_PGMSEQ;   // PGMSEQ 글로벌 변수 선언
var obj_G3_GRPSEQ;   // GRPSEQ 글로벌 변수 선언
var obj_G3_GRPID;   // GRPID 글로벌 변수 선언
var obj_G3_GRPTYPE;   // GRPTYPE 글로벌 변수 선언
var obj_G3_GRPNM;   // GRPNM 글로벌 변수 선언
var obj_G3_GRPORD;   // GRPORD 글로벌 변수 선언
var obj_G3_FREEZECNT;   // (Grid)FREEZECNT 글로벌 변수 선언
var obj_G3_VBOX;   // VBOX 글로벌 변수 선언
var obj_G3_REFGRPID;   // REFGRPID 글로벌 변수 선언
var obj_G3_GRPWIDTH;   // GRPWIDTH 글로벌 변수 선언
var obj_G3_GRPHEIGHT;   // GRPHEIGHT 글로벌 변수 선언
var obj_G3_COLSIZETYPE;   // COLSIZETYPE 글로벌 변수 선언
var obj_G3_LEGENDALIGN;   // (Chart)LEGENDALIGN 글로벌 변수 선언
var obj_G3_STACKED;   // (Chart)STACKED 글로벌 변수 선언
var obj_G3_ADDDT;   // ADDDT 글로벌 변수 선언
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
	//PJTSEQ, PJTSEQ 초기화	
	//PGMSEQ, PGMSEQ 초기화	
	//GRPNM, GRPNM 초기화	
  alog("G1_INIT()-------------------------end");
}

//GRP목록 그리드 초기화
function G2_INIT(){
	alog("G2_INIT()-------------------------start");
	$btG2 = $('#btG2').bootstrapTable();

	/*
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
			field: 'GRPSEQ',
			title: 'GRPSEQ',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'GRPID',
			title: 'GRPID',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'GRPTYPE',
			title: 'GRPTYPE',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'GRPNM',
			title: 'GRPNM',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'GRPORD',
			title: 'GRPORD',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'LINK',
			title: 'LINK',
			sortable: true,
			align: 'left',
			formatter:'bt4TableMultiLinkFormatter',
			valign: 'middle'
			}
			,{
			field: 'ADDDT',
			title: 'ADDDT',
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
*/	$btG2.on('click-row.bs.table', function (e, row, $element) {
		//    alert(row.myid);
		//alert(JSON.stringify(row))

		lastinputG3 = new HashMap(); // GRP상세
		lastinputG3.set("G2-PJTSEQ", row.PJTSEQ); // 
		lastinputG3.set("G2-PGMSEQ", row.PGMSEQ); // 
		lastinputG3.set("G2-GRPSEQ", row.GRPSEQ); // 
		G3_SEARCH(lastinputG3,uuidv4()); //자식그룹 호출 : GRP상세
		//    //alog(field);
		});
}
//디테일 초기화	
//GRP상세 폼뷰 초기화
function G3_INIT(){
  alog("G3_INIT()-------------------------start");




setCodeCombo("FORMVIEW",$("#G3-GRPTYPE"),"GRPTYPE");




setCodeCombo("FORMVIEW",$("#G3-VBOX"),"VBOX");




setCodeCombo("FORMVIEW",$("#G3-COLSIZETYPE"),"COLSIZETYPE");





	//컬럼 초기화
	//PJTSEQ, PJTSEQ 초기화	
	$("#G3-PJTSEQ").attr("readonly",true);
	//PGMSEQ, PGMSEQ 초기화	
	$("#G3-PGMSEQ").attr("readonly",true);
	//GRPSEQ, GRPSEQ 초기화	
	$("#G3-GRPSEQ").attr("readonly",true);
	//GRPID, GRPID 초기화	
	//GRPNM, GRPNM 초기화	
	//GRPORD, GRPORD 초기화	
	//FREEZECNT, (Grid)FREEZECNT 초기화	
	//REFGRPID, REFGRPID 초기화	
	//GRPWIDTH, GRPWIDTH 초기화	
	//GRPHEIGHT, GRPHEIGHT 초기화	
	//LEGENDALIGN, (Chart)LEGENDALIGN 초기화	
	//STACKED, (Chart)STACKED 초기화	
	//ADDDT, ADDDT 초기화		//MODDT, MODDT 초기화	  alog("G3_INIT()-------------------------end");
}
//D146 그룹별 기능 함수 출력		
//검색조건 초기화
function G1_RESET(){
	alog("G1_RESET--------------------------start");
	$('#condition')[0].reset();
}
//사용자정의함수 : 사용자정의
function G1_USERDEF(token){
	alog("G1_USERDEF-----------------start");

	alog("G1_USERDEF-----------------end");
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
// CONDITIONSearch	
function G1_SEARCHALL(token){
	alog("G1_SEARCHALL--------------------------start");
	//입력값검증
	//폼의 모든값 구하기
	var ConAllData = $( "#condition" ).serialize();
	alog("ConAllData:" + ConAllData);
	//json : G1
			lastinputG2 = new HashMap(); //GRP목록
		//  호출
	G2_SEARCH(lastinputG2,token);
	alog("G1_SEARCHALL--------------------------end");
}
//새로고침	
function G2_RELOAD(token){
  alog("G2_RELOAD-----------------start");
  G2_SEARCH(lastinputG2,token);
}
//GRP목록
function G2_CHKSAVE(token){
	alog("G2_CHKSAVE()------------start");

	var jsonSelectedRows = $btG2.bootstrapTable('getSelections');
	var strSelectedRowsIds = "";

	for(i=0;i<jsonSelectedRows.length;i++){
		if(i>0) strSelectedRowsIds += ",";


		strSelectedRowsIds += jsonSelectedRows[i].GRPSEQ;
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
				msgNotice("[GRP목록] 정상 처리되었습니다.");
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
//그리드 조회(GRP목록)	
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
					msgNotice("[GRP목록] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[GRP목록] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[GRP목록] Ajax http 500 error ( " + error + " )",3);
                alog("[GRP목록] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
		alog("G2_SEARCH()------------end");
}

//GRP목록 엑셀 내려받기
function G2_EXCEL(){
	alog("G2_EXCEL()-------------------------start");

	$btG2.tableExport({type:'excel'});

	alog("G2_EXCEL()------------end");
}
//사용자정의함수 : 사용자정의
function G2_USERDEF(token){
	alog("G2_USERDEF-----------------start");

	alog("G2_USERDEF-----------------end");
}
function G3_edit(){
       alog("[FromView] G3_edit---------------start");
	if( $("#G3-CTLCUD").val() == "C" ){
		alert("조회 후 수정 가능합니다. 신규 모드에서는 수정할 수 없습니다.")
		return;
	}
	if( $("#G3-CTLCUD").val() == "D" ){
		alert("조회 후 수정 가능합니다. 삭제 모드에서는 수정할 수 없습니다.")
		return;
	}

	$("#G3-CTLCUD").val("U");
       alog("[FromView] G3_edit---------------end");
}
//FORMVIEW DELETE
function G3_del(){	
	alog("G3_del---------------start");

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
		url : url_G3_del,
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
//G3_save
//IO_FILE_YN = N	
	//IO_FILE_YN = N	
function G3_save(token){	
	alog("G3_save---------------start");

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
		url : url_G3_save + "&TOKEN=" + token,
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
}//	
function G3_new(){
       alog("[FromView] G3_new---------------start");
	$("#G3-CTLCUD").val("C");
	//PMGIO 로직
	$("#G3-PJTSEQ").val("");//PJTSEQ 신규초기화	
	$("#G3-PGMSEQ").val("");//PGMSEQ 신규초기화	
	$("#G3-GRPSEQ").val("");//GRPSEQ 신규초기화	
	$("#G3-GRPID").val("");//GRPID 신규초기화	
	$("#G3-GRPNM").val("");//GRPNM 신규초기화	
	$("#G3-GRPORD").val("");//GRPORD 신규초기화	
	$("#G3-FREEZECNT").val("");//(Grid)FREEZECNT 신규초기화	
	$("#G3-REFGRPID").val("");//REFGRPID 신규초기화	
	$("#G3-GRPWIDTH").val("");//GRPWIDTH 신규초기화	
	$("#G3-GRPHEIGHT").val("");//GRPHEIGHT 신규초기화	
	$("#G3-LEGENDALIGN").val("");//(Chart)LEGENDALIGN 신규초기화	
	$("#G3-STACKED").val("");//(Chart)STACKED 신규초기화	
	$("#G3-ADDDT").text("");//ADDDT 신규초기화		$("#G3-MODDT").text("");//MODDT 신규초기화	       alog("DETAILNew30---------------end");
}
//새로고침	
function G3_reload(token){
	alog("G3_reload-----------------start");
	G3_SEARCH(lastinputG3,token);
}//디테일 검색	
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
			$("#G3-PJTSEQ").val(data.RTN_DATA.PJTSEQ);//PJTSEQ 변수세팅
			$("#G3-PGMSEQ").val(data.RTN_DATA.PGMSEQ);//PGMSEQ 변수세팅
			$("#G3-GRPSEQ").val(data.RTN_DATA.GRPSEQ);//GRPSEQ 변수세팅
			$("#G3-GRPID").val(data.RTN_DATA.GRPID);//GRPID 변수세팅
			$("#G3-GRPTYPE").val(data.RTN_DATA.GRPTYPE);//GRPTYPE 변수세팅
			$("#G3-GRPNM").val(data.RTN_DATA.GRPNM);//GRPNM 변수세팅
			$("#G3-GRPORD").val(data.RTN_DATA.GRPORD);//GRPORD 변수세팅
			$("#G3-FREEZECNT").val(data.RTN_DATA.FREEZECNT);//(Grid)FREEZECNT 변수세팅
			$("#G3-VBOX").val(data.RTN_DATA.VBOX);//VBOX 변수세팅
			$("#G3-REFGRPID").val(data.RTN_DATA.REFGRPID);//REFGRPID 변수세팅
			$("#G3-GRPWIDTH").val(data.RTN_DATA.GRPWIDTH);//GRPWIDTH 변수세팅
			$("#G3-GRPHEIGHT").val(data.RTN_DATA.GRPHEIGHT);//GRPHEIGHT 변수세팅
			$("#G3-COLSIZETYPE").val(data.RTN_DATA.COLSIZETYPE);//COLSIZETYPE 변수세팅
			$("#G3-LEGENDALIGN").val(data.RTN_DATA.LEGENDALIGN);//(Chart)LEGENDALIGN 변수세팅
			$("#G3-STACKED").val(data.RTN_DATA.STACKED);//(Chart)STACKED 변수세팅
			$("#G3-ADDDT").text(data.RTN_DATA.ADDDT);//ADDDT 변수세팅
			$("#G3-MODDT").text(data.RTN_DATA.MODDT);//MODDT 변수세팅
        },
        error: function(error){
            alog("Error:");
            alog(error);
        }
    });
    alog("(FORMVIEW) G3_SEARCH---------------end");

}
