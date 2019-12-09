//글로벌 변수 선언
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_USERDEF = "piioController?CTLGRP=G1&CTLFNC=USERDEF";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SEARCHALL = "piioController?CTLGRP=G1&CTLFNC=SEARCHALL";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SAVE = "piioController?CTLGRP=G1&CTLFNC=SAVE";
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_RESET = "piioController?CTLGRP=G1&CTLFNC=RESET";
// 변수 선언	
var obj_G1_COLID; // 컬럼ID 변수선언
var obj_G1_COLNM; // 컬럼명 변수선언
var obj_G1_PJTSEQ; // PJTSEQ 변수선언
var obj_G1_PGMSEQ; // PGMSEQ 변수선언
var obj_G1_GRPSEQ; // GRPSEQ 변수선언
var $btG2 = null; //
	//컨트롤러 경로 s
	var url_G2_USERDEF = "piioController?CTLGRP=G2&CTLFNC=USERDEF";
	//컨트롤러 경로 s
	var url_G2_SEARCH = "piioController?CTLGRP=G2&CTLFNC=SEARCH";
	//컨트롤러 경로 s
	var url_G2_RELOAD = "piioController?CTLGRP=G2&CTLFNC=RELOAD";
	//컨트롤러 경로 s
	var url_G2_EXCEL = "piioController?CTLGRP=G2&CTLFNC=EXCEL";
	//컨트롤러 경로 s
	var url_G2_CHKSAVE = "piioController?CTLGRP=G2&CTLFNC=CHKSAVE";
//디테일 변수 초기화	

//폼뷰 컨트롤러 경로
var url_G3_USERDEF = "piioController?CTLGRP=G3&CTLFNC=USERDEF";
//폼뷰 컨트롤러 경로
var url_G3_SEARCH = "piioController?CTLGRP=G3&CTLFNC=SEARCH";
//폼뷰 컨트롤러 경로
var url_G3_SAVE = "piioController?CTLGRP=G3&CTLFNC=SAVE";
//폼뷰 컨트롤러 경로
var url_G3_RELOAD = "piioController?CTLGRP=G3&CTLFNC=RELOAD";
//폼뷰 컨트롤러 경로
var url_G3_NEW = "piioController?CTLGRP=G3&CTLFNC=NEW";
//폼뷰 컨트롤러 경로
var url_G3_MODIFY = "piioController?CTLGRP=G3&CTLFNC=MODIFY";
//폼뷰 컨트롤러 경로
var url_G3_DELETE = "piioController?CTLGRP=G3&CTLFNC=DELETE";
var obj_G3_PJTSEQ;   // PJTSEQ 글로벌 변수 선언
var obj_G3_PGMSEQ;   // PGMSEQ 글로벌 변수 선언
var obj_G3_GRPSEQ;   // GRPSEQ 글로벌 변수 선언
var obj_G3_IOSEQ;   // IOSEQ 글로벌 변수 선언
var obj_G3_COLORD;   // COLORD 글로벌 변수 선언
var obj_G3_COLID;   // 컬럼ID 글로벌 변수 선언
var obj_G3_COLNM;   // 컬럼명 글로벌 변수 선언
var obj_G3_DATATYPE;   // 데이터타입 글로벌 변수 선언
var obj_G3_VALIDSEQ;   // VALIDSEQ 글로벌 변수 선언
var obj_G3_DATASIZE;   // 데이터사이즈 글로벌 변수 선언
var obj_G3_OBJTYPE;   // 오브젝트타입 글로벌 변수 선언
var obj_G3_POPUP;   // POPUP 글로벌 변수 선언
var obj_G3_KEYYN;   // KEYYN 글로벌 변수 선언
var obj_G3_SEQYN;   // SEQYN 글로벌 변수 선언
var obj_G3_LBLHIDDENYN;   // LBLHIDDENYN 글로벌 변수 선언
var obj_G3_LBLWIDTH;   // 라벨가로 글로벌 변수 선언
var obj_G3_LBLALIGN;   // LBLALIGN 글로벌 변수 선언
var obj_G3_OBJWIDTH;   // 오브젝트가로 글로벌 변수 선언
var obj_G3_OBJHEIGHT;   // 오브젝트세로 글로벌 변수 선언
var obj_G3_OBJALIGN;   // 가로정렬 글로벌 변수 선언
var obj_G3_HIDDENYN;   // HIDDENYN 글로벌 변수 선언
var obj_G3_EDITYN;   // EDITYN 글로벌 변수 선언
var obj_G3_FNINIT;   // FNINIT 글로벌 변수 선언
var obj_G3_BRYN;   // BRYN 글로벌 변수 선언
var obj_G3_FORMAT;   // FORMAT 글로벌 변수 선언
var obj_G3_FOOTERMATH;   // FOOTERMATH 글로벌 변수 선언
var obj_G3_FOOTERNM;   // FOOTERNM 글로벌 변수 선언
var obj_G3_ICONNM;   // ICONNM 글로벌 변수 선언
var obj_G3_ICONSTYLE;   // ICONSTYLE 글로벌 변수 선언
var obj_G3_LBLSTYLE;   // LBLSTYLE 글로벌 변수 선언
var obj_G3_OBJSTYLE;   // OBJSTYLE 글로벌 변수 선언
var obj_G3_OBJ2STYLE;   // OBJ2STYLE 글로벌 변수 선언
var obj_G3_ADDDT;   // ADDDT 글로벌 변수 선언
var obj_G3_ADDID;   // ADDID 글로벌 변수 선언
var obj_G3_MODDT;   // MODDT 글로벌 변수 선언
var obj_G3_MODID;   // MODID 글로벌 변수 선언
	var codeMirrorFontSizeG3Fninit = 11; // FNINIT

//FNINIT
function changeCodemirrorFontSizeG3Fninit(sizeCmd){
	alog("changeCodemirrorFontSizeG3Fninit..........start " + sizeCmd);

	if(sizeCmd == "+"){
		codeMirrorFontSizeG3Fninit  = codeMirrorFontSizeG3Fninit  + 2;
	}else{
		codeMirrorFontSizeG3Fninit  = codeMirrorFontSizeG3Fninit  - 2;
	}

	$(".CodeMirror").css('font-size',codeMirrorFontSizeG3Fninit  + "px");

	obj_G3_FNINIT .refresh();
	alog("changeCodemirrorFontSizeG3Fninit..........end");   
}
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
	//COLNM, 컬럼명 초기화	
	//GRPSEQ, GRPSEQ 초기화	
	//PGMSEQ, PGMSEQ 초기화	
	//PJTSEQ, PJTSEQ 초기화	
  alog("G1_INIT()-------------------------end");
}

// 그리드 초기화
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
			field: 'IOSEQ',
			title: 'IOSEQ',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'COLORD',
			title: 'COLORD',
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
			field: 'COLNM',
			title: '컬럼명',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'DATATYPE',
			title: '데이터타입',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'VALIDSEQ',
			title: 'VALIDSEQ',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'DATASIZE',
			title: '데이터사이즈',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'OBJTYPE',
			title: '오브젝트타입',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'POPUP',
			title: 'POPUP',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'KEYYN',
			title: 'KEYYN',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'SEQYN',
			title: 'SEQYN',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'LBLHIDDENYN',
			title: 'LBLHIDDENYN',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'LBLWIDTH',
			title: '라벨가로',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'LBLALIGN',
			title: 'LBLALIGN',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'OBJWIDTH',
			title: '오브젝트가로',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'OBJHEIGHT',
			title: '오브젝트세로',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'OBJALIGN',
			title: '가로정렬',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'HIDDENYN',
			title: 'HIDDENYN',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'EDITYN',
			title: 'EDITYN',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'FNINIT',
			title: 'FNINIT',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'BRYN',
			title: 'BRYN',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'FORMAT',
			title: 'FORMAT',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'FOOTERMATH',
			title: 'FOOTERMATH',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'FOOTERNM',
			title: 'FOOTERNM',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'ICONNM',
			title: 'ICONNM',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'ICONSTYLE',
			title: 'ICONSTYLE',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'LBLSTYLE',
			title: 'LBLSTYLE',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'OBJSTYLE',
			title: 'OBJSTYLE',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
			,{
			field: 'OBJ2STYLE',
			title: 'OBJ2STYLE',
			sortable: true,
			align: 'left',
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
			field: 'ADDID',
			title: 'ADDID',
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
			,{
			field: 'MODID',
			title: 'MODID',
			sortable: true,
			align: 'left',
			valign: 'middle'
			}
]
	});
*/	$btG2.on('click-row.bs.table', function (e, row, $element) {
		//    alert(row.myid);
		//alert(JSON.stringify(row))

		lastinputG3 = new HashMap(); // 
		lastinputG3.set("G2-PJTSEQ", row.PJTSEQ); // 
		lastinputG3.set("G2-PGMSEQ", row.PGMSEQ); // 
		lastinputG3.set("G2-GRPSEQ", row.GRPSEQ); // 
		lastinputG3.set("G2-IOSEQ", row.IOSEQ); // 
		G3_SEARCH(lastinputG3,uuidv4()); //자식그룹 호출 : 
		//    //alog(field);
		});
}
//디테일 초기화	
// 폼뷰 초기화
function G3_INIT(){
  alog("G3_INIT()-------------------------start");







setCodeCombo("FORMVIEW", $("#G3-DATATYPE"), "DATATYPE","");
setCodeCombo("FORMVIEW", $("#G3-VALIDSEQ"), "VALIDSEQ","");

setCodeCombo("FORMVIEW", $("#G3-OBJTYPE"), "CTFORMVIEW","");

setCodeRadio("FORMVIEW", "G3-KEYYN", "YN","");

setCodeRadio("FORMVIEW", "G3-SEQYN", "YN","");

setCodeRadio("FORMVIEW", "G3-LBLHIDDENYN", "YN","");


setCodeCombo("FORMVIEW", $("#G3-LBLALIGN"), "OBJALIGN","");



setCodeCombo("FORMVIEW", $("#G3-OBJALIGN"), "OBJALIGN","");
setCodeRadio("FORMVIEW", "G3-HIDDENYN", "YN","");

setCodeRadio("FORMVIEW", "G3-EDITYN", "YN","");

setCodeRadio("FORMVIEW", "G3-BRYN", "YN","");

setCodeCombo("FORMVIEW", $("#G3-FOOTERMATH"), "GRIDFOOTER","");










	//컬럼 초기화
	//PJTSEQ, PJTSEQ 초기화	
	$("#G3-PJTSEQ").attr("readonly",true);
	//PGMSEQ, PGMSEQ 초기화	
	$("#G3-PGMSEQ").attr("readonly",true);
	//GRPSEQ, GRPSEQ 초기화	
	$("#G3-GRPSEQ").attr("readonly",true);
	//IOSEQ, IOSEQ 초기화	
	$("#G3-IOSEQ").attr("readonly",true);
	//COLORD, COLORD 초기화	
	//COLID, 컬럼ID 초기화	
	//COLNM, 컬럼명 초기화	
	//DATASIZE, 데이터사이즈 초기화	
	//POPUP, POPUP 초기화	
	//KEYYN, KEYYN 초기화	
	//SEQYN, SEQYN 초기화	
	//LBLHIDDENYN, LBLHIDDENYN 초기화	
	//LBLWIDTH, 라벨가로 초기화	
	//OBJWIDTH, 오브젝트가로 초기화	
	//OBJHEIGHT, 오브젝트세로 초기화	
	//HIDDENYN, HIDDENYN 초기화	
	//EDITYN, EDITYN 초기화	
		//코드 미러 초기화
        obj_G3_FNINIT = CodeMirror.fromTextArea(document.getElementById('codeMirror_G3-FNINIT'), {
            mode: "text/x-sql",
            styleActiveLine: true,
            indentWithTabs: true,
            smartIndent: true,
            lineWrapping: true,
            lineNumbers: true,
            matchBrackets : true,
            tabSize: 4,
            indentUnit: 4,
            indentWithTabs: true,
            extraKeys: {"Ctrl-Space": "autocomplete"},
			hintOptions: {tables: {
			  users: {name: null, score: null, birthDate: null},
			  countries: {name: null, population: null, size: null}
			}}
        });
		obj_G3_FNINIT .setSize("300px","53px");
	//BRYN, BRYN 초기화	
	//FORMAT, FORMAT 초기화	
	//FOOTERNM, FOOTERNM 초기화	
	//ICONNM, ICONNM 초기화	
	//ICONSTYLE, ICONSTYLE 초기화	
	//LBLSTYLE, LBLSTYLE 초기화	
	//OBJSTYLE, OBJSTYLE 초기화	
	//OBJ2STYLE, OBJ2STYLE 초기화	
	//ADDDT, ADDDT 초기화		//ADDID, ADDID 초기화		//MODDT, MODDT 초기화		//MODID, MODID 초기화	  alog("G3_INIT()-------------------------end");
}
//D146 그룹별 기능 함수 출력		
//사용자정의함수 : 사용자정의
function G1_USERDEF(token){
	alog("G1_USERDEF-----------------start");

	alog("G1_USERDEF-----------------end");
}
//검색조건 초기화
function G1_RESET(){
	alog("G1_RESET--------------------------start");
	$('#condition')[0].reset();
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
// 엑셀 내려받기
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
//새로고침	
function G2_RELOAD(token){
  alog("G2_RELOAD-----------------start");
  G2_SEARCH(lastinputG2,token);
}
//
function G2_CHKSAVE(token){
	alog("G2_CHKSAVE()------------start");

	var jsonSelectedRows = $btG2.bootstrapTable('getSelections');
	var strSelectedRowsIds = "";

	for(i=0;i<jsonSelectedRows.length;i++){
		if(i>0) strSelectedRowsIds += ",";


		strSelectedRowsIds += jsonSelectedRows[i].IOSEQ;
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
//	
function G3_NEW(){
       alog("[FromView] G3_NEW---------------start");
	$("#G3-CTLCUD").val("C");
	//PMGIO 로직
	$("#G3-PJTSEQ").val("");//PJTSEQ 신규초기화	
	$("#G3-PGMSEQ").val("");//PGMSEQ 신규초기화	
	$("#G3-GRPSEQ").val("");//GRPSEQ 신규초기화	
	$("#G3-IOSEQ").val("");//IOSEQ 신규초기화	
	$("#G3-COLORD").val("");//COLORD 신규초기화	
	$("#G3-COLID").val("");//컬럼ID 신규초기화	
	$("#G3-COLNM").val("");//컬럼명 신규초기화	
	$("#G3-DATASIZE").val("");//데이터사이즈 신규초기화	
	$("#G3-POPUP").val("");//POPUP 신규초기화	
	$("#G3-KEYYN").val("");//KEYYN 신규초기화	
	$("#G3-SEQYN").val("");//SEQYN 신규초기화	
	$("#G3-LBLHIDDENYN").val("");//LBLHIDDENYN 신규초기화	
	$("#G3-LBLWIDTH").val("");//라벨가로 신규초기화	
	$("#G3-OBJWIDTH").val("");//오브젝트가로 신규초기화	
	$("#G3-OBJHEIGHT").val("");//오브젝트세로 신규초기화	
	$("#G3-HIDDENYN").val("");//HIDDENYN 신규초기화	
	$("#G3-EDITYN").val("");//EDITYN 신규초기화	
obj_G3_FNINIT.setValue(""); // FNINIT값 비우기	$("#G3-BRYN").val("");//BRYN 신규초기화	
	$("#G3-FORMAT").val("");//FORMAT 신규초기화	
	$("#G3-FOOTERNM").val("");//FOOTERNM 신규초기화	
	$("#G3-ICONNM").val("");//ICONNM 신규초기화	
	$("#G3-ICONSTYLE").val("");//ICONSTYLE 신규초기화	
	$("#G3-LBLSTYLE").val("");//LBLSTYLE 신규초기화	
	$("#G3-OBJSTYLE").val("");//OBJSTYLE 신규초기화	
	$("#G3-OBJ2STYLE").val("");//OBJ2STYLE 신규초기화	
	$("#G3-ADDDT").text("");//ADDDT 신규초기화		$("#G3-ADDID").text("");//ADDID 신규초기화		$("#G3-MODDT").text("");//MODDT 신규초기화		$("#G3-MODID").text("");//MODID 신규초기화	       alog("DETAILNew30---------------end");
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
			$("#G3-PJTSEQ").val(data.RTN_DATA.PJTSEQ);//PJTSEQ 변수세팅
			$("#G3-PGMSEQ").val(data.RTN_DATA.PGMSEQ);//PGMSEQ 변수세팅
			$("#G3-GRPSEQ").val(data.RTN_DATA.GRPSEQ);//GRPSEQ 변수세팅
			$("#G3-IOSEQ").val(data.RTN_DATA.IOSEQ);//IOSEQ 변수세팅
			$("#G3-COLORD").val(data.RTN_DATA.COLORD);//COLORD 변수세팅
			$("#G3-COLID").val(data.RTN_DATA.COLID);//컬럼ID 변수세팅
			$("#G3-COLNM").val(data.RTN_DATA.COLNM);//컬럼명 변수세팅
			$("#G3-DATATYPE").val(data.RTN_DATA.DATATYPE);//데이터타입 변수세팅
			$("#G3-VALIDSEQ").val(data.RTN_DATA.VALIDSEQ);//VALIDSEQ 변수세팅
			$("#G3-DATASIZE").val(data.RTN_DATA.DATASIZE);//데이터사이즈 변수세팅
			$("#G3-OBJTYPE").val(data.RTN_DATA.OBJTYPE);//오브젝트타입 변수세팅
			$("#G3-POPUP").val(data.RTN_DATA.POPUP);//POPUP 변수세팅
			$('input:radio[name="G3-KEYYN"][value=' + data.RTN_DATA.KEYYN + ']').click();
			$('input:radio[name="G3-SEQYN"][value=' + data.RTN_DATA.SEQYN + ']').click();
			$('input:radio[name="G3-LBLHIDDENYN"][value=' + data.RTN_DATA.LBLHIDDENYN + ']').click();
			$("#G3-LBLWIDTH").val(data.RTN_DATA.LBLWIDTH);//라벨가로 변수세팅
			$("#G3-LBLALIGN").val(data.RTN_DATA.LBLALIGN);//LBLALIGN 변수세팅
			$("#G3-OBJWIDTH").val(data.RTN_DATA.OBJWIDTH);//오브젝트가로 변수세팅
			$("#G3-OBJHEIGHT").val(data.RTN_DATA.OBJHEIGHT);//오브젝트세로 변수세팅
			$("#G3-OBJALIGN").val(data.RTN_DATA.OBJALIGN);//가로정렬 변수세팅
			$('input:radio[name="G3-HIDDENYN"][value=' + data.RTN_DATA.HIDDENYN + ']').click();
			$('input:radio[name="G3-EDITYN"][value=' + data.RTN_DATA.EDITYN + ']').click();
		obj_G3_FNINIT.setValue(data.RTN_DATA.FNINIT); //FNINIT 
			$('input:radio[name="G3-BRYN"][value=' + data.RTN_DATA.BRYN + ']').click();
			$("#G3-FORMAT").val(data.RTN_DATA.FORMAT);//FORMAT 변수세팅
			$("#G3-FOOTERMATH").val(data.RTN_DATA.FOOTERMATH);//FOOTERMATH 변수세팅
			$("#G3-FOOTERNM").val(data.RTN_DATA.FOOTERNM);//FOOTERNM 변수세팅
			$("#G3-ICONNM").val(data.RTN_DATA.ICONNM);//ICONNM 변수세팅
			$("#G3-ICONSTYLE").val(data.RTN_DATA.ICONSTYLE);//ICONSTYLE 변수세팅
			$("#G3-LBLSTYLE").val(data.RTN_DATA.LBLSTYLE);//LBLSTYLE 변수세팅
			$("#G3-OBJSTYLE").val(data.RTN_DATA.OBJSTYLE);//OBJSTYLE 변수세팅
			$("#G3-OBJ2STYLE").val(data.RTN_DATA.OBJ2STYLE);//OBJ2STYLE 변수세팅
			$("#G3-ADDDT").text(data.RTN_DATA.ADDDT);//ADDDT 변수세팅
			$("#G3-ADDID").text(data.RTN_DATA.ADDID);//ADDID 변수세팅
			$("#G3-MODDT").text(data.RTN_DATA.MODDT);//MODDT 변수세팅
			$("#G3-MODID").text(data.RTN_DATA.MODID);//MODID 변수세팅
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
}//사용자정의함수 : 사용자정의
function G3_USERDEF(token){
	alog("G3_USERDEF-----------------start");

	alog("G3_USERDEF-----------------end");
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

	sendFormData.append("G3-KEYYN",$('input[name="G3-KEYYN"]:checked').val());//radio 선택값 가져오기.
	sendFormData.append("G3-SEQYN",$('input[name="G3-SEQYN"]:checked').val());//radio 선택값 가져오기.
	sendFormData.append("G3-LBLHIDDENYN",$('input[name="G3-LBLHIDDENYN"]:checked').val());//radio 선택값 가져오기.
	sendFormData.append("G3-HIDDENYN",$('input[name="G3-HIDDENYN"]:checked').val());//radio 선택값 가져오기.
	sendFormData.append("G3-EDITYN",$('input[name="G3-EDITYN"]:checked').val());//radio 선택값 가져오기.
	sendFormData.append("G3-FNINIT",obj_G3_FNINIT.getValue()); //FNINIT
	sendFormData.append("G3-BRYN",$('input[name="G3-BRYN"]:checked').val());//radio 선택값 가져오기.
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
}