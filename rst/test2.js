//날짜 포멧 정의
var dateFormatJson = {
			dateFormat: 'yy.mm.dd',
			prevText: '이전 달',
			nextText: '다음 달',
			monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
			monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
			dayNames: ['일','월','화','수','목','금','토'],
			dayNamesShort: ['일','월','화','수','목','금','토'],
			dayNamesMin: ['일','월','화','수','목','금','토'],
			showMonthAfterYear: true,
			changeMonth: true,
			changeYear: true,
			yearSuffix: '년'
			};
//글로벌 변수 선언
//버틀 그룹쪽에서 컨틀롤러 호출	
var url_G1_SAVE = "test2Controller.php?CTLGRP=G1&CTLFNC=SAVE";//버틀 그룹쪽에서 컨틀롤러 호출	
var url_G1_NEW = "test2Controller.php?CTLGRP=G1&CTLFNC=NEW";//버틀 그룹쪽에서 컨틀롤러 호출	
var url_G1_MODIFY = "test2Controller.php?CTLGRP=G1&CTLFNC=MODIFY";//버틀 그룹쪽에서 컨틀롤러 호출	
var url_G1_DELETE = "test2Controller.php?CTLGRP=G1&CTLFNC=DELETE";//버틀 그룹쪽에서 컨틀롤러 호출	
var url_G1_BTNCLICK = "test2Controller.php?CTLGRP=G1&CTLFNC=BTNCLICK";//2 변수 선언	
var obj_G2_PJTID_valid = jQuery.parseJSON( '{ "G2_PJTID": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":30,  "DATATYPE":"STRING"} }' );  //프로젝트ID  밸리데이션
var obj_G2_ADDDT_valid = jQuery.parseJSON( '{ "G2_ADDDT": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":8,  "DATATYPE":"STRING"} }' );  //생성일  밸리데이션
var obj_G2_PJTID; // 프로젝트ID 변수선언var obj_G2_ADDDT; // 생성일 변수선언//그리드 변수 초기화	
//동적 변수 선언
var obj_G3_PJTSEQ_valid = jQuery.parseJSON( '{ "G3_PJTSEQ": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":10,  "DATATYPE":"NUMBER"} }' );
//동적 변수 선언
var obj_G3_PJTID_valid = jQuery.parseJSON( '{ "G3_PJTID": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":30,  "DATATYPE":"STRING"} }' );
//동적 변수 선언
var obj_G3_PJTNM_valid = jQuery.parseJSON( '{ "G3_PJTNM": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":100,  "DATATYPE":"STRING"} }' );
//동적 변수 선언
var obj_G3_FILECHARSET_valid = jQuery.parseJSON( '{ "G3_FILECHARSET": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":30,  "DATATYPE":"STRING"} }' );
//동적 변수 선언
var obj_G3_UITOOL_valid = jQuery.parseJSON( '{ "G3_UITOOL": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":10,  "DATATYPE":"STRING"} }' );
//동적 변수 선언
var obj_G3_SVRLANG_valid = jQuery.parseJSON( '{ "G3_SVRLANG": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":10,  "DATATYPE":"STRING"} }' );
//동적 변수 선언
var obj_G3_PKGROOT_valid = jQuery.parseJSON( '{ "G3_PKGROOT": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":10,  "DATATYPE":"STRING"} }' );
//동적 변수 선언
var obj_G3_STARTDT_valid = jQuery.parseJSON( '{ "G3_STARTDT": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":8,  "DATATYPE":"STRING"} }' );
//동적 변수 선언
var obj_G3_ENDDT_valid = jQuery.parseJSON( '{ "G3_ENDDT": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":8,  "DATATYPE":"STRING"} }' );
//동적 변수 선언
var obj_G3_DELYN_valid = jQuery.parseJSON( '{ "G3_DELYN": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":1,  "DATATYPE":"STRING"} }' );
//동적 변수 선언
var obj_G3_ADDDT_valid = jQuery.parseJSON( '{ "G3_ADDDT": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":14,  "DATATYPE":"STRING"} }' );
//동적 변수 선언
var obj_G3_MODDT_valid = jQuery.parseJSON( '{ "G3_MODDT": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":14,  "DATATYPE":"STRING"} }' );
//컨트롤러 경로
var url_G3_SEARCH = "test2Controller.php?CTLGRP=G3&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G3_SAVE = "test2Controller.php?CTLGRP=G3&CTLFNC=SAVE";
//컨트롤러 경로
var url_G3_ROWDELETE = "test2Controller.php?CTLGRP=G3&CTLFNC=ROWDELETE";
//컨트롤러 경로
var url_G3_ROWADD = "test2Controller.php?CTLGRP=G3&CTLFNC=ROWADD";
//컨트롤러 경로
var url_G3_RELOAD = "test2Controller.php?CTLGRP=G3&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G3_LINK = "test2Controller.php?CTLGRP=G3&CTLFNC=LINK";
//그리드 객체
var mygridG3,addstatusynG3,lastinputG3,lastinputG3json,lastrowidG3;
var lastselectG3json;//그리드 변수 초기화	
//동적 변수 선언
var obj_G4_PJTSEQ_valid = jQuery.parseJSON( '{ "G4_PJTSEQ": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":10,  "DATATYPE":""} }' );
//동적 변수 선언
var obj_G4_PGMSEQ_valid = jQuery.parseJSON( '{ "G4_PGMSEQ": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":30,  "DATATYPE":""} }' );
//동적 변수 선언
var obj_G4_PGMID_valid = jQuery.parseJSON( '{ "G4_PGMID": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":20,  "DATATYPE":"STRING"} }' );
//동적 변수 선언
var obj_G4_PGMNM_valid = jQuery.parseJSON( '{ "G4_PGMNM": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":20,  "DATATYPE":"STRING"} }' );
//동적 변수 선언
var obj_G4_PKGGRP_valid = jQuery.parseJSON( '{ "G4_PKGGRP": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":15,  "DATATYPE":""} }' );
//동적 변수 선언
var obj_G4_ADDDT_valid = jQuery.parseJSON( '{ "G4_ADDDT": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":14,  "DATATYPE":"STRING"} }' );
//동적 변수 선언
var obj_G4_MODDT_valid = jQuery.parseJSON( '{ "G4_MODDT": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":14,  "DATATYPE":"STRING"} }' );
//컨트롤러 경로
var url_G4_SEARCH = "test2Controller.php?CTLGRP=G4&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G4_SAVE = "test2Controller.php?CTLGRP=G4&CTLFNC=SAVE";
//컨트롤러 경로
var url_G4_ROWDELETE = "test2Controller.php?CTLGRP=G4&CTLFNC=ROWDELETE";
//컨트롤러 경로
var url_G4_ROWADD = "test2Controller.php?CTLGRP=G4&CTLFNC=ROWADD";
//컨트롤러 경로
var url_G4_RELOAD = "test2Controller.php?CTLGRP=G4&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G4_EXCEL = "test2Controller.php?CTLGRP=G4&CTLFNC=EXCEL";
//그리드 객체
var mygridG4,addstatusynG4,lastinputG4,lastinputG4json,lastrowidG4;
var lastselectG4json;//그리드 변수 초기화	
//동적 변수 선언
var obj_G5_PJTSEQ_valid = jQuery.parseJSON( '{ "G5_PJTSEQ": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":30,  "DATATYPE":""} }' );
//동적 변수 선언
var obj_G5_COLID_valid = jQuery.parseJSON( '{ "G5_COLID": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":30,  "DATATYPE":"STRING"} }' );
//동적 변수 선언
var obj_G5_COLNM_valid = jQuery.parseJSON( '{ "G5_COLNM": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":30,  "DATATYPE":"STRING"} }' );
//동적 변수 선언
var obj_G5_COLSNM_valid = jQuery.parseJSON( '{ "G5_COLSNM": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":30,  "DATATYPE":"STRING"} }' );
//동적 변수 선언
var obj_G5_DATATYPE_valid = jQuery.parseJSON( '{ "G5_DATATYPE": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":30,  "DATATYPE":"STRING"} }' );
//동적 변수 선언
var obj_G5_DATASIZE_valid = jQuery.parseJSON( '{ "G5_DATASIZE": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":30,  "DATATYPE":"STRING"} }' );
//동적 변수 선언
var obj_G5_OBJTYPE_valid = jQuery.parseJSON( '{ "G5_OBJTYPE": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":30,  "DATATYPE":"STRING"} }' );
//동적 변수 선언
var obj_G5_LBLWIDTH_valid = jQuery.parseJSON( '{ "G5_LBLWIDTH": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":30,  "DATATYPE":"STRING"} }' );
//동적 변수 선언
var obj_G5_LBLHEIGHT_valid = jQuery.parseJSON( '{ "G5_LBLHEIGHT": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":30,  "DATATYPE":"STRING"} }' );
//동적 변수 선언
var obj_G5_OBJWIDTH_valid = jQuery.parseJSON( '{ "G5_OBJWIDTH": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":30,  "DATATYPE":"STRING"} }' );
//동적 변수 선언
var obj_G5_OBJHEIGHT_valid = jQuery.parseJSON( '{ "G5_OBJHEIGHT": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":30,  "DATATYPE":"STRING"} }' );
//동적 변수 선언
var obj_G5_OBJALIGN_valid = jQuery.parseJSON( '{ "G5_OBJALIGN": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":30,  "DATATYPE":"STRING"} }' );
//동적 변수 선언
var obj_G5_ADDDT_valid = jQuery.parseJSON( '{ "G5_ADDDT": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":14,  "DATATYPE":"STRING"} }' );
//동적 변수 선언
var obj_G5_MODDT_valid = jQuery.parseJSON( '{ "G5_MODDT": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":14,  "DATATYPE":"STRING"} }' );
//컨트롤러 경로
var url_G5_SEARCH = "test2Controller.php?CTLGRP=G5&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G5_SAVE = "test2Controller.php?CTLGRP=G5&CTLFNC=SAVE";
//컨트롤러 경로
var url_G5_ROWDELETE = "test2Controller.php?CTLGRP=G5&CTLFNC=ROWDELETE";
//컨트롤러 경로
var url_G5_ROWADD = "test2Controller.php?CTLGRP=G5&CTLFNC=ROWADD";
//컨트롤러 경로
var url_G5_RELOAD = "test2Controller.php?CTLGRP=G5&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G5_EXCEL = "test2Controller.php?CTLGRP=G5&CTLFNC=EXCEL";
//그리드 객체
var mygridG5,addstatusynG5,lastinputG5,lastinputG5json,lastrowidG5;
var lastselectG5json;//그리드 변수 초기화	
//동적 변수 선언
var obj_G6_PJTSEQ_valid = jQuery.parseJSON( '{ "G6_PJTSEQ": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":20,  "DATATYPE":""} }' );
//동적 변수 선언
var obj_G6_CFGSEQ_valid = jQuery.parseJSON( '{ "G6_CFGSEQ": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":30,  "DATATYPE":"NUMBER"} }' );
//동적 변수 선언
var obj_G6_CFGID_valid = jQuery.parseJSON( '{ "G6_CFGID": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":30,  "DATATYPE":"STRING"} }' );
//동적 변수 선언
var obj_G6_CFGNM_valid = jQuery.parseJSON( '{ "G6_CFGNM": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":100,  "DATATYPE":"STRING"} }' );
//동적 변수 선언
var obj_G6_MVCGBN_valid = jQuery.parseJSON( '{ "G6_MVCGBN": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":30,  "DATATYPE":"STRING"} }' );
//동적 변수 선언
var obj_G6_PATH_valid = jQuery.parseJSON( '{ "G6_PATH": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":300,  "DATATYPE":"STRING"} }' );
//동적 변수 선언
var obj_G6_CFGORD_valid = jQuery.parseJSON( '{ "G6_CFGORD": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":30,  "DATATYPE":"STRING"} }' );
//동적 변수 선언
var obj_G6_ADDDT_valid = jQuery.parseJSON( '{ "G6_ADDDT": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":14,  "DATATYPE":"STRING"} }' );
//동적 변수 선언
var obj_G6_MODDT_valid = jQuery.parseJSON( '{ "G6_MODDT": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":14,  "DATATYPE":"STRING"} }' );
//컨트롤러 경로
var url_G6_USERDEF = "test2Controller.php?CTLGRP=G6&CTLFNC=USERDEF";
//컨트롤러 경로
var url_G6_SEARCH = "test2Controller.php?CTLGRP=G6&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G6_SAVE = "test2Controller.php?CTLGRP=G6&CTLFNC=SAVE";
//컨트롤러 경로
var url_G6_ROWDELETE = "test2Controller.php?CTLGRP=G6&CTLFNC=ROWDELETE";
//컨트롤러 경로
var url_G6_ROWADD = "test2Controller.php?CTLGRP=G6&CTLFNC=ROWADD";
//컨트롤러 경로
var url_G6_RELOAD = "test2Controller.php?CTLGRP=G6&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G6_EXCEL = "test2Controller.php?CTLGRP=G6&CTLFNC=EXCEL";
//그리드 객체
var mygridG6,addstatusynG6,lastinputG6,lastinputG6json,lastrowidG6;
var lastselectG6json;//그리드 변수 초기화	
//동적 변수 선언
var obj_G7_PJTSEQ_valid = jQuery.parseJSON( '{ "G7_PJTSEQ": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":10,  "DATATYPE":""} }' );
//동적 변수 선언
var obj_G7_FILESEQ_valid = jQuery.parseJSON( '{ "G7_FILESEQ": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":0,  "DATATYPE":""} }' );
//동적 변수 선언
var obj_G7_MKFILETYPE_valid = jQuery.parseJSON( '{ "G7_MKFILETYPE": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":0,  "DATATYPE":""} }' );
//동적 변수 선언
var obj_G7_MKFILETYPENM_valid = jQuery.parseJSON( '{ "G7_MKFILETYPENM": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":0,  "DATATYPE":""} }' );
//동적 변수 선언
var obj_G7_MKFILEFORMAT_valid = jQuery.parseJSON( '{ "G7_MKFILEFORMAT": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":0,  "DATATYPE":""} }' );
//동적 변수 선언
var obj_G7_MKFILEEXT_valid = jQuery.parseJSON( '{ "G7_MKFILEEXT": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":0,  "DATATYPE":""} }' );
//동적 변수 선언
var obj_G7_TEMPLATE_valid = jQuery.parseJSON( '{ "G7_TEMPLATE": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":0,  "DATATYPE":""} }' );
//동적 변수 선언
var obj_G7_FILEORD_valid = jQuery.parseJSON( '{ "G7_FILEORD": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":0,  "DATATYPE":""} }' );
//동적 변수 선언
var obj_G7_USEYN_valid = jQuery.parseJSON( '{ "G7_USEYN": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":0,  "DATATYPE":""} }' );
//동적 변수 선언
var obj_G7_ADDDT_valid = jQuery.parseJSON( '{ "G7_ADDDT": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":0,  "DATATYPE":""} }' );
//동적 변수 선언
var obj_G7_MODDT_valid = jQuery.parseJSON( '{ "G7_MODDT": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":0,  "DATATYPE":""} }' );
//컨트롤러 경로
var url_G7_USERDEF = "test2Controller.php?CTLGRP=G7&CTLFNC=USERDEF";
//컨트롤러 경로
var url_G7_SEARCH = "test2Controller.php?CTLGRP=G7&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G7_SAVE = "test2Controller.php?CTLGRP=G7&CTLFNC=SAVE";
//컨트롤러 경로
var url_G7_ROWDELETE = "test2Controller.php?CTLGRP=G7&CTLFNC=ROWDELETE";
//컨트롤러 경로
var url_G7_ROWADD = "test2Controller.php?CTLGRP=G7&CTLFNC=ROWADD";
//컨트롤러 경로
var url_G7_RELOAD = "test2Controller.php?CTLGRP=G7&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G7_EXCEL = "test2Controller.php?CTLGRP=G7&CTLFNC=EXCEL";
//그리드 객체
var mygridG7,addstatusynG7,lastinputG7,lastinputG7json,lastrowidG7;
var lastselectG7json;//화면 초기화
function initBody(){
     alog("initBody()-----------------------start");
	
   //dhtmlx 메시지 박스 초기화
   dhtmlx.message.position="bottom";
	G1_INIT();
		G2_INIT();
		G3_INIT();
		G4_INIT();
		G5_INIT();
		G6_INIT();
		G7_INIT();
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


//각 폼 오브젝트들 초기화  alog("G2_INIT()-------------------------end");
}

	//PJT 그리드 초기화
function G3_INIT(){
  alog("G3_INIT()-------------------------start");

        //그리드 초기화
        mygridG3 = new dhtmlXGridObject('gridG3');
        mygridG3.setDateFormat("%Y%m%d");
        mygridG3.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG3.setUserData("","gridTitle","G3 : PJT"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG3.setHeader("SEQ,프로젝트ID,프로젝트명,파일 CHARSET,UITOOL,서버언어,패키지ROOT,시작일,종료일,삭제YN,ADDDT,수정일");
		mygridG3.setColumnIds("PJTSEQ,PJTID,PJTNM,FILECHARSET,UITOOL,SVRLANG,PKGROOT,STARTDT,ENDDT,DELYN,ADDDT,MODDT");
		mygridG3.setColTypes("ed,ed,ed,ed,ed,ed,ed,dhxCalendar,dhxCalendar,ed,ed,ed");
		//mygridG3.setColSorting(",,,,,,,,,,,");		//렌더링
		mygridG3.enableSmartRendering(false);
		mygridG3.enableMultiselect(true);


		//mygridG3.setColValidators("G3_PJTSEQ,G3_PJTID,G3_PJTNM,G3_FILECHARSET,G3_UITOOL,G3_SVRLANG,G3_PKGROOT,G3_STARTDT,G3_ENDDT,G3_DELYN,G3_ADDDT,G3_MODDT");
		mygridG3.splitAt(0);//'freezes' 0 columns 
		mygridG3.init();
		 // IO : SEQ초기화
		 // IO : 프로젝트ID초기화
		 // IO : 프로젝트명초기화
		 // IO : 파일 CHARSET초기화
		 // IO : UITOOL초기화
		 // IO : 서버언어초기화
		 // IO : 패키지ROOT초기화
		 // IO : 시작일초기화
		 // IO : 종료일초기화
		 // IO : 삭제YN초기화
		 // IO : ADDDT초기화
		 // IO : 수정일초기화
		// ROW선택 이벤트
		mygridG3.attachEvent("onRowSelect",function(rowID,celInd){
			RowEditStatus = mygridG3.getUserData(rowID,"!nativeeditor_status");
			if(RowEditStatus == "inserted"){return false;}
             //GRIDRowSelect30(rowID,celInd);
		var ConAllData = $( "#condition" ).serialize();
		var RowAllData = getRowsColid(mygridG3,rowID,"G3");
		//LAST SELECT ROW
lastselectG3json = jQuery.parseJSON('{ "__NAME":"lastinputG3json"' +
', "PJTSEQ" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("PJTSEQ")).getValue()) + '"' +
', "PJTID" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("PJTID")).getValue()) + '"' +
', "PJTNM" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("PJTNM")).getValue()) + '"' +
', "FILECHARSET" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("FILECHARSET")).getValue()) + '"' +
', "UITOOL" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("UITOOL")).getValue()) + '"' +
', "SVRLANG" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("SVRLANG")).getValue()) + '"' +
', "PKGROOT" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("PKGROOT")).getValue()) + '"' +
', "STARTDT" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("STARTDT")).getValue()) + '"' +
', "ENDDT" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("ENDDT")).getValue()) + '"' +
', "DELYN" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("DELYN")).getValue()) + '"' +
', "ADDDT" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("ADDDT")).getValue()) + '"' +
', "MODDT" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("MODDT")).getValue()) + '"' +
'}');
		//A125
		lastinputG4 = ConAllData + RowAllData;
		//A125
		lastinputG5 = ConAllData + RowAllData;
		//A125
		lastinputG6 = ConAllData + RowAllData;
		//A125
		lastinputG7 = ConAllData + RowAllData;
		//A124
lastinputG4json = jQuery.parseJSON('{ "__NAME":"lastinputG4json"' +
'}');
lastinputG5json = jQuery.parseJSON('{ "__NAME":"lastinputG5json"' +
'}');
lastinputG6json = jQuery.parseJSON('{ "__NAME":"lastinputG6json"' +
'}');
lastinputG7json = jQuery.parseJSON('{ "__NAME":"lastinputG7json"' +
'}');
		G4_SEARCH(lastinputG4); //자식그룹 호출 : PGM
		G5_SEARCH(lastinputG5); //자식그룹 호출 : DD
		G6_SEARCH(lastinputG6); //자식그룹 호출 : CONFIG
		G7_SEARCH(lastinputG7); //자식그룹 호출 : FILE
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

	//PGM 그리드 초기화
function G4_INIT(){
  alog("G4_INIT()-------------------------start");

        //그리드 초기화
        mygridG4 = new dhtmlXGridObject('gridG4');
        mygridG4.setDateFormat("%Y%m%d");
        mygridG4.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG4.setUserData("","gridTitle","G4 : PGM"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG4.setHeader("PJTSEQ,SEQ,프로그램ID,프로그램이름,PKGGRP,ADDDT,MODDT");
		mygridG4.setColumnIds("PJTSEQ,PGMSEQ,PGMID,PGMNM,PKGGRP,ADDDT,MODDT");
		mygridG4.setColTypes("ed,ed,ed,ed,ed,ed,ed");
		//mygridG4.setColSorting(",,,,,,");		//렌더링
		mygridG4.enableSmartRendering(false);
		mygridG4.enableMultiselect(true);


		//mygridG4.setColValidators("G4_PJTSEQ,G4_PGMSEQ,G4_PGMID,G4_PGMNM,G4_PKGGRP,G4_ADDDT,G4_MODDT");
		mygridG4.splitAt(0);//'freezes' 0 columns 
		mygridG4.init();
		 // IO : PJTSEQ초기화
		 // IO : SEQ초기화
		 // IO : 프로그램ID초기화
		 // IO : 프로그램이름초기화
		 // IO : PKGGRP초기화
		 // IO : ADDDT초기화
		 // IO : MODDT초기화
		// ROW선택 이벤트
		mygridG4.attachEvent("onRowSelect",function(rowID,celInd){
			RowEditStatus = mygridG4.getUserData(rowID,"!nativeeditor_status");
			if(RowEditStatus == "inserted"){return false;}
             //GRIDRowSelect40(rowID,celInd);
		var ConAllData = $( "#condition" ).serialize();
		var RowAllData = getRowsColid(mygridG4,rowID,"G4");
		//LAST SELECT ROW
lastselectG4json = jQuery.parseJSON('{ "__NAME":"lastinputG4json"' +
', "PJTSEQ" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("PJTSEQ")).getValue()) + '"' +
', "PGMSEQ" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("PGMSEQ")).getValue()) + '"' +
', "PGMID" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("PGMID")).getValue()) + '"' +
', "PGMNM" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("PGMNM")).getValue()) + '"' +
', "PKGGRP" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("PKGGRP")).getValue()) + '"' +
', "ADDDT" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("ADDDT")).getValue()) + '"' +
', "MODDT" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("MODDT")).getValue()) + '"' +
'}');
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

	//DD 그리드 초기화
function G5_INIT(){
  alog("G5_INIT()-------------------------start");

        //그리드 초기화
        mygridG5 = new dhtmlXGridObject('gridG5');
        mygridG5.setDateFormat("%Y%m%d");
        mygridG5.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG5.setUserData("","gridTitle","G5 : DD"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG5.setHeader("PJTSEQ,컬럼ID,컬럼명,단축명,데이터타입,데이터사이즈,오브젝트타입,라벨가로,가벨세로,오브젝트가로,오브젝트세로,가로정렬,등록일,수정일");
		mygridG5.setColumnIds("PJTSEQ,COLID,COLNM,COLSNM,DATATYPE,DATASIZE,OBJTYPE,LBLWIDTH,LBLHEIGHT,OBJWIDTH,OBJHEIGHT,OBJALIGN,ADDDT,MODDT");
		mygridG5.setColTypes("ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed");
		//mygridG5.setColSorting(",,,,,,,,,,,,,");		//렌더링
		mygridG5.enableSmartRendering(false);
		mygridG5.enableMultiselect(true);


		//mygridG5.setColValidators("G5_PJTSEQ,G5_COLID,G5_COLNM,G5_COLSNM,G5_DATATYPE,G5_DATASIZE,G5_OBJTYPE,G5_LBLWIDTH,G5_LBLHEIGHT,G5_OBJWIDTH,G5_OBJHEIGHT,G5_OBJALIGN,G5_ADDDT,G5_MODDT");
		mygridG5.splitAt(0);//'freezes' 0 columns 
		mygridG5.init();
		 // IO : PJTSEQ초기화
		 // IO : 컬럼ID초기화
		 // IO : 컬럼명초기화
		 // IO : 단축명초기화
		 // IO : 데이터타입초기화
		 // IO : 데이터사이즈초기화
		 // IO : 오브젝트타입초기화
		 // IO : 라벨가로초기화
		 // IO : 가벨세로초기화
		 // IO : 오브젝트가로초기화
		 // IO : 오브젝트세로초기화
		 // IO : 가로정렬초기화
		 // IO : 등록일초기화
		 // IO : 수정일초기화
		// ROW선택 이벤트
		mygridG5.attachEvent("onRowSelect",function(rowID,celInd){
			RowEditStatus = mygridG5.getUserData(rowID,"!nativeeditor_status");
			if(RowEditStatus == "inserted"){return false;}
             //GRIDRowSelect50(rowID,celInd);
		var ConAllData = $( "#condition" ).serialize();
		var RowAllData = getRowsColid(mygridG5,rowID,"G5");
		//LAST SELECT ROW
lastselectG5json = jQuery.parseJSON('{ "__NAME":"lastinputG5json"' +
', "PJTSEQ" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("PJTSEQ")).getValue()) + '"' +
', "COLID" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("COLID")).getValue()) + '"' +
', "COLNM" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("COLNM")).getValue()) + '"' +
', "COLSNM" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("COLSNM")).getValue()) + '"' +
', "DATATYPE" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("DATATYPE")).getValue()) + '"' +
', "DATASIZE" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("DATASIZE")).getValue()) + '"' +
', "OBJTYPE" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("OBJTYPE")).getValue()) + '"' +
', "LBLWIDTH" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("LBLWIDTH")).getValue()) + '"' +
', "LBLHEIGHT" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("LBLHEIGHT")).getValue()) + '"' +
', "OBJWIDTH" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("OBJWIDTH")).getValue()) + '"' +
', "OBJHEIGHT" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("OBJHEIGHT")).getValue()) + '"' +
', "OBJALIGN" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("OBJALIGN")).getValue()) + '"' +
', "ADDDT" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("ADDDT")).getValue()) + '"' +
', "MODDT" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("MODDT")).getValue()) + '"' +
'}');
		//A124
});

        mygridG5.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            alog("mygridG5  onEditCell ------------------start");
            alog("       stage : " + stage);
            alog("       rId : " + rId);
            alog("       cInd : " + cInd);
            alog("       nValue : " + nValue);
            alog("       oValue : " + oValue);

            RowEditStatus = mygridG5.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygridG5.setUserData(rId,"!nativeeditor_status","updated");
                    mygridG5.setRowTextBold(rId);
                }
                mygridG5.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

        });
        alog("G5_INIT()-------------------------end");
     }

	//CONFIG 그리드 초기화
function G6_INIT(){
  alog("G6_INIT()-------------------------start");

        //그리드 초기화
        mygridG6 = new dhtmlXGridObject('gridG6');
        mygridG6.setDateFormat("%Y%m%d");
        mygridG6.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG6.setUserData("","gridTitle","G6 : CONFIG"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG6.setHeader("PJTSEQ,SEQ,CFGID,CFGNM,MVCGBN,PATH,ORD,ADDDT,MODDT");
		mygridG6.setColumnIds("PJTSEQ,CFGSEQ,CFGID,CFGNM,MVCGBN,PATH,CFGORD,ADDDT,MODDT");
		mygridG6.setColTypes("ed,ed,ed,ed,ed,ed,ed,ed,ed");
		//mygridG6.setColSorting(",,,,,,,,");		//렌더링
		mygridG6.enableSmartRendering(false);
		mygridG6.enableMultiselect(true);


		//mygridG6.setColValidators("G6_PJTSEQ,G6_CFGSEQ,G6_CFGID,G6_CFGNM,G6_MVCGBN,G6_PATH,G6_CFGORD,G6_ADDDT,G6_MODDT");
		mygridG6.splitAt(0);//'freezes' 0 columns 
		mygridG6.init();
		 // IO : PJTSEQ초기화
		 // IO : SEQ초기화
		 // IO : CFGID초기화
		 // IO : CFGNM초기화
		 // IO : MVCGBN초기화
		 // IO : PATH초기화
		 // IO : ORD초기화
		 // IO : ADDDT초기화
		 // IO : MODDT초기화
		// ROW선택 이벤트
		mygridG6.attachEvent("onRowSelect",function(rowID,celInd){
			RowEditStatus = mygridG6.getUserData(rowID,"!nativeeditor_status");
			if(RowEditStatus == "inserted"){return false;}
             //GRIDRowSelect60(rowID,celInd);
		var ConAllData = $( "#condition" ).serialize();
		var RowAllData = getRowsColid(mygridG6,rowID,"G6");
		//LAST SELECT ROW
lastselectG6json = jQuery.parseJSON('{ "__NAME":"lastinputG6json"' +
', "PJTSEQ" : "' + q(mygridG6.cells(rowID,mygridG6.getColIndexById("PJTSEQ")).getValue()) + '"' +
', "CFGSEQ" : "' + q(mygridG6.cells(rowID,mygridG6.getColIndexById("CFGSEQ")).getValue()) + '"' +
', "CFGID" : "' + q(mygridG6.cells(rowID,mygridG6.getColIndexById("CFGID")).getValue()) + '"' +
', "CFGNM" : "' + q(mygridG6.cells(rowID,mygridG6.getColIndexById("CFGNM")).getValue()) + '"' +
', "MVCGBN" : "' + q(mygridG6.cells(rowID,mygridG6.getColIndexById("MVCGBN")).getValue()) + '"' +
', "PATH" : "' + q(mygridG6.cells(rowID,mygridG6.getColIndexById("PATH")).getValue()) + '"' +
', "CFGORD" : "' + q(mygridG6.cells(rowID,mygridG6.getColIndexById("CFGORD")).getValue()) + '"' +
', "ADDDT" : "' + q(mygridG6.cells(rowID,mygridG6.getColIndexById("ADDDT")).getValue()) + '"' +
', "MODDT" : "' + q(mygridG6.cells(rowID,mygridG6.getColIndexById("MODDT")).getValue()) + '"' +
'}');
		//A124
});

        mygridG6.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            alog("mygridG6  onEditCell ------------------start");
            alog("       stage : " + stage);
            alog("       rId : " + rId);
            alog("       cInd : " + cInd);
            alog("       nValue : " + nValue);
            alog("       oValue : " + oValue);

            RowEditStatus = mygridG6.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygridG6.setUserData(rId,"!nativeeditor_status","updated");
                    mygridG6.setRowTextBold(rId);
                }
                mygridG6.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

        });
        alog("G6_INIT()-------------------------end");
     }

	//FILE 그리드 초기화
function G7_INIT(){
  alog("G7_INIT()-------------------------start");

        //그리드 초기화
        mygridG7 = new dhtmlXGridObject('gridG7');
        mygridG7.setDateFormat("%Y%m%d");
        mygridG7.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG7.setUserData("","gridTitle","G7 : FILE"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG7.setHeader("PJTSEQ,SEQ,파일타입,타입명,포멧,확장자,템플릿,순번,사용,ADDDT,MODDT");
		mygridG7.setColumnIds("PJTSEQ,FILESEQ,MKFILETYPE,MKFILETYPENM,MKFILEFORMAT,MKFILEEXT,TEMPLATE,FILEORD,USEYN,ADDDT,MODDT");
		mygridG7.setColTypes("ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed");
		//mygridG7.setColSorting(",,,,,,,,,,");		//렌더링
		mygridG7.enableSmartRendering(false);
		mygridG7.enableMultiselect(true);


		//mygridG7.setColValidators("G7_PJTSEQ,G7_FILESEQ,G7_MKFILETYPE,G7_MKFILETYPENM,G7_MKFILEFORMAT,G7_MKFILEEXT,G7_TEMPLATE,G7_FILEORD,G7_USEYN,G7_ADDDT,G7_MODDT");
		mygridG7.splitAt(0);//'freezes' 0 columns 
		mygridG7.init();
		 // IO : PJTSEQ초기화
		 // IO : SEQ초기화
		 // IO : 파일타입초기화
		 // IO : 타입명초기화
		 // IO : 포멧초기화
		 // IO : 확장자초기화
		 // IO : 템플릿초기화
		 // IO : 순번초기화
		 // IO : 사용초기화
		 // IO : ADDDT초기화
		 // IO : MODDT초기화
		// ROW선택 이벤트
		mygridG7.attachEvent("onRowSelect",function(rowID,celInd){
			RowEditStatus = mygridG7.getUserData(rowID,"!nativeeditor_status");
			if(RowEditStatus == "inserted"){return false;}
             //GRIDRowSelect70(rowID,celInd);
		var ConAllData = $( "#condition" ).serialize();
		var RowAllData = getRowsColid(mygridG7,rowID,"G7");
		//LAST SELECT ROW
lastselectG7json = jQuery.parseJSON('{ "__NAME":"lastinputG7json"' +
', "PJTSEQ" : "' + q(mygridG7.cells(rowID,mygridG7.getColIndexById("PJTSEQ")).getValue()) + '"' +
', "FILESEQ" : "' + q(mygridG7.cells(rowID,mygridG7.getColIndexById("FILESEQ")).getValue()) + '"' +
', "MKFILETYPE" : "' + q(mygridG7.cells(rowID,mygridG7.getColIndexById("MKFILETYPE")).getValue()) + '"' +
', "MKFILETYPENM" : "' + q(mygridG7.cells(rowID,mygridG7.getColIndexById("MKFILETYPENM")).getValue()) + '"' +
', "MKFILEFORMAT" : "' + q(mygridG7.cells(rowID,mygridG7.getColIndexById("MKFILEFORMAT")).getValue()) + '"' +
', "MKFILEEXT" : "' + q(mygridG7.cells(rowID,mygridG7.getColIndexById("MKFILEEXT")).getValue()) + '"' +
', "TEMPLATE" : "' + q(mygridG7.cells(rowID,mygridG7.getColIndexById("TEMPLATE")).getValue()) + '"' +
', "FILEORD" : "' + q(mygridG7.cells(rowID,mygridG7.getColIndexById("FILEORD")).getValue()) + '"' +
', "USEYN" : "' + q(mygridG7.cells(rowID,mygridG7.getColIndexById("USEYN")).getValue()) + '"' +
', "ADDDT" : "' + q(mygridG7.cells(rowID,mygridG7.getColIndexById("ADDDT")).getValue()) + '"' +
', "MODDT" : "' + q(mygridG7.cells(rowID,mygridG7.getColIndexById("MODDT")).getValue()) + '"' +
'}');
		//A124
});

        mygridG7.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            alog("mygridG7  onEditCell ------------------start");
            alog("       stage : " + stage);
            alog("       rId : " + rId);
            alog("       cInd : " + cInd);
            alog("       nValue : " + nValue);
            alog("       oValue : " + oValue);

            RowEditStatus = mygridG7.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygridG7.setUserData(rId,"!nativeeditor_status","updated");
                    mygridG7.setRowTextBold(rId);
                }
                mygridG7.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

        });
        alog("G7_INIT()-------------------------end");
     }

	//D146 그룹별 기능 함수 출력	
//조회 1	
function G1_BTNCLICK(){
	   alog("G1_BTNCLICK()--------------------------start");
   SEARCHALL();
   alog("G1_BTNCLICK()--------------------------end");
}
	//1, 저장
function G1_SAVE(){
 alog("G1_SAVE-------------------start");
	//FormData parameter에 담아줌
	var formData = new FormData();	//G1 getparams
	//그리드G4 가져오기	
    mygridG4.setSerializationLevel(true,false,false,false,true,false);
    var paramsG4 = mygridG4.serialize();
	formData.append("G4_XML",paramsG4);
	//그리드G5 가져오기	
    mygridG5.setSerializationLevel(true,false,false,false,true,false);
    var paramsG5 = mygridG5.serialize();
	formData.append("G5_XML",paramsG5);
	//그리드G3 가져오기	
    mygridG3.setSerializationLevel(true,false,false,false,true,false);
    var paramsG3 = mygridG3.serialize();
	formData.append("G3_XML",paramsG3);
	//그리드G6 가져오기	
    mygridG6.setSerializationLevel(true,false,false,false,true,false);
    var paramsG6 = mygridG6.serialize();
	formData.append("G6_XML",paramsG6);
	//그리드G7 가져오기	
    mygridG7.setSerializationLevel(true,false,false,false,true,false);
    var paramsG7 = mygridG7.serialize();
	formData.append("G7_XML",paramsG7);
//var params = { CTL : "G1_SAVE", G4_XML : paramsG4	, G5_XML : paramsG5	, G3_XML : paramsG3	, G6_XML : paramsG6	, G7_XML : paramsG7	};
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
function SEARCHALL(){
	alog("G2_SEARCHALL--------------------------start");
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
//행추가3 (PJT)	
//그리드 행추가 : PJT
	function G3_ROWADD(){
		if( !(lastinputG3json)){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = ["","","","","","","","","","","",""];//초기값
			addRow(mygridG3,tCols);
		}
	}    function G3_ROWDELETE(){	
        alog("G3_ROWDELETE()------------start");
        delRow(mygridG3);
        alog("G3_ROWDELETE()------------start");
    }
    //그리드 조회(PJT)	
    function G3_SEARCH(tinput){
        alog("gridSearchG3()------------start");

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
					msgNotice("[PJT] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[PJT] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[PJT] Ajax http 500 error ( " + error + " )",3);
                alog("[PJT] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearchG3()------------end");
    }
//새로고침	
function G3_RELOAD(){
  alog("G3_RELOAD-----------------start");
  G3_SEARCH(lastinputG3);
}
	
//링크이동
function G3_LINK(){
  alog("G3_LINK-----------------start");
	alert("G3_LINK");
 	var param = "";
	param = ""+ "&PJTSEQ=" + lastselectG3json.PJTSEQ + "&PJTID=" + lastselectG3json.PJTID + "&PJTNM=" + lastselectG3json.PJTNM ;
 	$(location).attr('href', "/c.g/cg_pgminfo3.php?"+param);

}
	    function G3_SAVE(){
		alog("save1()------------start");
		tgrid = mygridG3;
    
    	tgrid.setSerializationLevel(true,false,false,false,true,false);
    	var myXmlString = tgrid.serialize();        //컨디션 데이터 모두 말기
        var ConAllData = $( "#condition" ).serialize();
        alog("   ConAllData = " + ConAllData);
        $.ajax({
            type : "POST",
            url : url_G3_SAVE + "&" + lastinputG3 ,
            data : { G3_XML : myXmlString},
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
	        addstatusyn2 = false;
        alog("G3_SAVE()------------end");
    }
//엑셀다운	
function G4_EXCEL(){
  alog("G4_EXCEL-----------------start");
}
//새로고침	
function G4_RELOAD(){
  alog("G4_RELOAD-----------------start");
  G4_SEARCH(lastinputG4);
}
	    function G4_SAVE(){
		alog("save1()------------start");
		tgrid = mygridG4;
    
    	tgrid.setSerializationLevel(true,false,false,false,true,false);
    	var myXmlString = tgrid.serialize();        //컨디션 데이터 모두 말기
        var ConAllData = $( "#condition" ).serialize();
        alog("   ConAllData = " + ConAllData);
        $.ajax({
            type : "POST",
            url : url_G4_SAVE + "&" + lastinputG4 ,
            data : { G4_XML : myXmlString},
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
	        addstatusyn2 = false;
        alog("G4_SAVE()------------end");
    }
//행추가3 (PGM)	
//그리드 행추가 : PGM
	function G4_ROWADD(){
		if( !(lastinputG4json)){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = ["","","","","","",""];//초기값
			addRow(mygridG4,tCols);
		}
	}    function G4_ROWDELETE(){	
        alog("G4_ROWDELETE()------------start");
        delRow(mygridG4);
        alog("G4_ROWDELETE()------------start");
    }
    //그리드 조회(PGM)	
    function G4_SEARCH(tinput){
        alog("gridSearchG4()------------start");

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
					msgNotice("[PGM] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[PGM] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[PGM] Ajax http 500 error ( " + error + " )",3);
                alog("[PGM] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearchG4()------------end");
    }
	    function G5_SAVE(){
		alog("save1()------------start");
		tgrid = mygridG5;
    
    	tgrid.setSerializationLevel(true,false,false,false,true,false);
    	var myXmlString = tgrid.serialize();        //컨디션 데이터 모두 말기
        var ConAllData = $( "#condition" ).serialize();
        alog("   ConAllData = " + ConAllData);
        $.ajax({
            type : "POST",
            url : url_G5_SAVE + "&" + lastinputG5 ,
            data : { G5_XML : myXmlString},
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
	        addstatusyn2 = false;
        alog("G5_SAVE()------------end");
    }
//행추가3 (DD)	
//그리드 행추가 : DD
	function G5_ROWADD(){
		if( !(lastinputG5json)){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = ["","","","","","","","","","","","","",""];//초기값
			addRow(mygridG5,tCols);
		}
	}    function G5_ROWDELETE(){	
        alog("G5_ROWDELETE()------------start");
        delRow(mygridG5);
        alog("G5_ROWDELETE()------------start");
    }
//엑셀다운	
function G5_EXCEL(){
  alog("G5_EXCEL-----------------start");
}
    //그리드 조회(DD)	
    function G5_SEARCH(tinput){
        alog("gridSearchG5()------------start");

		var tGrid = mygridG5;

        //그리드 초기화
        tGrid.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : url_G5_SEARCH+"&G5_CRUD_MODE=read&" + tinput ,
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
						$("#spanG5Cnt").text(row_cnt);

						tGrid.parse(data.RTN_DATA,"json");
						
					}
					msgNotice("[DD] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[DD] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[DD] Ajax http 500 error ( " + error + " )",3);
                alog("[DD] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearchG5()------------end");
    }
//새로고침	
function G5_RELOAD(){
  alog("G5_RELOAD-----------------start");
  G5_SEARCH(lastinputG5);
}
    function G6_ROWDELETE(){	
        alog("G6_ROWDELETE()------------start");
        delRow(mygridG6);
        alog("G6_ROWDELETE()------------start");
    }
//엑셀다운	
function G6_EXCEL(){
  alog("G6_EXCEL-----------------start");
}
    //그리드 조회(CONFIG)	
    function G6_SEARCH(tinput){
        alog("gridSearchG6()------------start");

		var tGrid = mygridG6;

        //그리드 초기화
        tGrid.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : url_G6_SEARCH+"&G6_CRUD_MODE=read&" + tinput ,
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
						$("#spanG6Cnt").text(row_cnt);

						tGrid.parse(data.RTN_DATA,"json");
						
					}
					msgNotice("[CONFIG] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[CONFIG] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[CONFIG] Ajax http 500 error ( " + error + " )",3);
                alog("[CONFIG] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearchG6()------------end");
    }
//새로고침	
function G6_RELOAD(){
  alog("G6_RELOAD-----------------start");
  G6_SEARCH(lastinputG6);
}
	    function G6_SAVE(){
		alog("save1()------------start");
		tgrid = mygridG6;
    
    	tgrid.setSerializationLevel(true,false,false,false,true,false);
    	var myXmlString = tgrid.serialize();        //컨디션 데이터 모두 말기
        var ConAllData = $( "#condition" ).serialize();
        alog("   ConAllData = " + ConAllData);
        $.ajax({
            type : "POST",
            url : url_G6_SAVE + "&" + lastinputG6 ,
            data : { G6_XML : myXmlString},
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
	        addstatusyn2 = false;
        alog("G6_SAVE()------------end");
    }
//행추가3 (CONFIG)	
//그리드 행추가 : CONFIG
	function G6_ROWADD(){
		if( !(lastinputG6json)){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = ["","","","","","","","",""];//초기값
			addRow(mygridG6,tCols);
		}
	}    //그리드 조회(FILE)	
    function G7_SEARCH(tinput){
        alog("gridSearchG7()------------start");

		var tGrid = mygridG7;

        //그리드 초기화
        tGrid.clearAll();

        //불러오기
        $.ajax({
            type : "POST",
            url : url_G7_SEARCH+"&G7_CRUD_MODE=read&" + tinput ,
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
						$("#spanG7Cnt").text(row_cnt);

						tGrid.parse(data.RTN_DATA,"json");
						
					}
					msgNotice("[FILE] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[FILE] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[FILE] Ajax http 500 error ( " + error + " )",3);
                alog("[FILE] Ajax http 500 error ( " + error + " )");
            }
        });

        alog("gridSearchG7()------------end");
    }
//새로고침	
function G7_RELOAD(){
  alog("G7_RELOAD-----------------start");
  G7_SEARCH(lastinputG7);
}
	    function G7_SAVE(){
		alog("save1()------------start");
		tgrid = mygridG7;
    
    	tgrid.setSerializationLevel(true,false,false,false,true,false);
    	var myXmlString = tgrid.serialize();        //컨디션 데이터 모두 말기
        var ConAllData = $( "#condition" ).serialize();
        alog("   ConAllData = " + ConAllData);
        $.ajax({
            type : "POST",
            url : url_G7_SAVE + "&" + lastinputG7 ,
            data : { G7_XML : myXmlString},
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
	        addstatusyn2 = false;
        alog("G7_SAVE()------------end");
    }
//행추가3 (FILE)	
//그리드 행추가 : FILE
	function G7_ROWADD(){
		if( !(lastinputG7json)){
			msgError("조회 후에 행추가 가능합니다",3);
		}else{
			var tCols = ["","","","","","","","","","",""];//초기값
			addRow(mygridG7,tCols);
		}
	}    function G7_ROWDELETE(){	
        alog("G7_ROWDELETE()------------start");
        delRow(mygridG7);
        alog("G7_ROWDELETE()------------start");
    }
//엑셀다운	
function G7_EXCEL(){
  alog("G7_EXCEL-----------------start");
}
