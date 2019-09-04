//글로벌 변수 선언	
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_USERDEF = "pipgmController?CTLGRP=G1&CTLFNC=USERDEF";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SEARCHALL = "pipgmController?CTLGRP=G1&CTLFNC=SEARCHALL";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SAVE = "pipgmController?CTLGRP=G1&CTLFNC=SAVE";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_RESET = "pipgmController?CTLGRP=G1&CTLFNC=RESET";
//검색 변수 선언	
var obj_G1_PJTSEQ; // PJTSEQ 변수선언
var $btG2 = null; //PGM목록
	//컨트롤러 경로 s
	var url_G2_USERDEF = "pipgmController?CTLGRP=G2&CTLFNC=USERDEF";
	//컨트롤러 경로 s
	var url_G2_SEARCH = "pipgmController?CTLGRP=G2&CTLFNC=SEARCH";
	//컨트롤러 경로 s
	var url_G2_RELOAD = "pipgmController?CTLGRP=G2&CTLFNC=RELOAD";
	//컨트롤러 경로 s
	var url_G2_CHKSAVE = "pipgmController?CTLGRP=G2&CTLFNC=CHKSAVE";
	//컨트롤러 경로 s
	var url_G2_EXCEL = "pipgmController?CTLGRP=G2&CTLFNC=EXCEL";
//디테일 변수 초기화	

//폼뷰 컨트롤러 경로
var url_G3_SEARCH = "pipgmController?CTLGRP=G3&CTLFNC=SEARCH";
//폼뷰 컨트롤러 경로
var url_G3_reload = "pipgmController?CTLGRP=G3&CTLFNC=reload";
var obj_G3_PGMSEQ;   // PGMSEQ 글로벌 변수 선언
var obj_G3_PGMID;   // 프로그램ID 글로벌 변수 선언
var obj_G3_PJTSEQ;   // PJTSEQ 글로벌 변수 선언
var obj_G3_PGMNM;   // 프로그램이름 글로벌 변수 선언
var obj_G3_VIEWURL;   // VIEWURL 글로벌 변수 선언
var obj_G3_PGMTYPE;   // PGMTYPE 글로벌 변수 선언
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
  alog("G1_INIT()-------------------------end");
}

//PGM목록 그리드 초기화
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
			field: 'PJTSEQ',
			title: 'PJTSEQ',
			visible: false,
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
			field: 'PGMID',
			title: '프로그램ID',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'PGMNM',
			title: '프로그램이름',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'VIEWURL',
			title: 'VIEWURL',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'PGMTYPE',
			title: 'PGMTYPE',
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
	$btG2.on('click-row.bs.table', function (e, row, $element) {
		//    alert(row.myid);
		//alert(JSON.stringify(row))

		lastinputG3 = new HashMap(); // PGM상세
		lastinputG3.set("G2-PGMSEQ", row.PGMSEQ); // 
		lastinputG3.set("G2-PJTSEQ", row.PJTSEQ); // 
		G3_SEARCH(lastinputG3,uuidv4()); //자식그룹 호출 : PGM상세
		//    //alog(field);
		});
}
//디테일 초기화	
//PGM상세 폼뷰 초기화
function G3_INIT(){
  alog("G3_INIT()-------------------------start");








	//컬럼 초기화
	//PGMSEQ, PGMSEQ 초기화	
	//PGMID, 프로그램ID 초기화	
	//PJTSEQ, PJTSEQ 초기화	
	//PGMNM, 프로그램이름 초기화	
	//VIEWURL, VIEWURL 초기화	
	//PGMTYPE, PGMTYPE 초기화	
	//ADDDT, ADDDT 초기화		//MODDT, MODDT 초기화	  alog("G3_INIT()-------------------------end");
}
//D146 그룹별 기능 함수 출력		
//검색조건 초기화
function G1_RESET(){
	alog("G1_RESET--------------------------start");
	$('#condition')[0].reset();
}
//검색, 저장	
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
			lastinputG2 = new HashMap(); //PGM목록
		//  호출
	G2_SEARCH(lastinputG2,token);
	alog("G1_SEARCHALL--------------------------end");
}
//사용자정의함수 : 사용자정의
function G1_USERDEF(token){
	alog("G1_USERDEF-----------------start");

	alog("G1_USERDEF-----------------end");
}
//PGM목록 엑셀 내려받기
function G2_EXCEL(){
	alog("G2_EXCEL()-------------------------start");

	$btG2.tableExport({type:'excel'});

	alog("G2_EXCEL()------------end");
}
//그리드 조회(PGM목록)	
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
					msgNotice("[PGM목록] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[PGM목록] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[PGM목록] Ajax http 500 error ( " + error + " )",3);
                alog("[PGM목록] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
		alog("G2_SEARCH()------------end");
}

//PGM목록
function G2_CHKSAVE(token){
	alog("G2_CHKSAVE()------------start");

	var jsonSelectedRows = $btG2.bootstrapTable('getSelections');
	var strSelectedRowsIds = "";

	for(i=0;i<jsonSelectedRows.length;i++){
		if(i>0) strSelectedRowsIds += ",";


		strSelectedRowsIds += jsonSelectedRows[i].PGMSEQ;
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
				msgNotice("[PGM목록] 정상 처리되었습니다.");
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
//새로고침	
function G2_RELOAD(token){
  alog("G2_RELOAD-----------------start");
  G2_SEARCH(lastinputG2,token);
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
			$("#G3-PGMSEQ").val(data.RTN_DATA.PGMSEQ);//PGMSEQ 변수세팅
			$("#G3-PGMID").val(data.RTN_DATA.PGMID);//프로그램ID 변수세팅
			$("#G3-PJTSEQ").val(data.RTN_DATA.PJTSEQ);//PJTSEQ 변수세팅
			$("#G3-PGMNM").val(data.RTN_DATA.PGMNM);//프로그램이름 변수세팅
			$("#G3-VIEWURL").val(data.RTN_DATA.VIEWURL);//VIEWURL 변수세팅
			$("#G3-PGMTYPE").val(data.RTN_DATA.PGMTYPE);//PGMTYPE 변수세팅
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
//새로고침	
function G3_reload(token){
	alog("G3_reload-----------------start");
	G3_SEARCH(lastinputG3,token);
}