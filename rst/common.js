/**
 * Created by zero12a on 2014. 7. 10..
 */


 //날짜포멧 정의
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
	
//달력 타입 정의
dhtmlXCalendarObject.prototype.langData["kr"] = {
	// date format
	dateformat: "%d.%m.%Y",
	// full names of months
	monthesFNames: [
		"1월","2월","3월","4월","5월","6월","7월",
		"8월","9월","10월","11월","12월"
	],
	// short names of months
	monthesSNames: [
		"1월","2월","3월","4월","5월","6월","7월",
		"8월","9월","10월","11월","12월"
	],
	// full names of days
	daysFNames: [
		"일","월","화","수",
		"목","금","토"
	],
	// short names of days
	daysSNames: [
		"일","월","화","수",
		"목","금","토"
	],
	// starting day of a week. Number from 1(Monday) to 7(Sunday)
	weekstart: 7, 
	// the title of the week number column
	weekname: "w" 
};


function alog(tLog){
	if(typeof console == "object")console.log(tLog);
}

function getCamelCase(str){
	str = str.toLowerCase();
	return str && str.charAt(0).toUpperCase() + str.substring(1);
}

function msgNotice(tMsg,tSecond){
	alog("msgNotice : " + tMsg);
	dhtmlx.message({
		type: "Notice",
		text: tMsg,
		expire: tSecond * 1000
	});
}
function msgError(tMsg,tSecond){
	alog("msgError : " + tMsg);

	dhtmlx.message({
		type: "Error",
		text: tMsg,
		expire: tSecond * 1000
	});
}


function delRow(tGrid){
	var tname = tGrid.getUserData("","gridTitle");
	alog("delRow(" + tname + ")------------start");

	rid = tGrid.getSelectedRowId();
	if(rid != null){
		tGrid.setUserData(rid,"!nativeeditor_status","deleted");
		tGrid.setRowTextBold(rid);
		tGrid.cells(rid,0).cell.wasChanged=true;
	}
	alog("delRow(" + tname + ")------------end");
}

function addRow(tGrid,tCols){
	var tname = tGrid.getUserData("","gridTitle");

	alog("addRow(" + tname + ")------------start");

	var id=tGrid.uid();
	alog("	row id : " + id);

	tGrid.addRow(id,tCols,0);
	tGrid.showRow(id);
	tGrid.selectRow(0);
	tGrid.cells(id,0).cell.wasChanged = true;
	tGrid.setUserData(id,"!nativeeditor_status","inserted");
	tGrid.setRowTextBold(id);
	alog("addRow(" + tname + ")------------end");
}

function addRowLast(tGrid,tCols,tisChanged){
	var tname = tGrid.getUserData("","gridTitle");

	alog("(common) addRow(" + tname + ")------------start");

	var id=tGrid.uid();
	alog("	row id : " + id);

	tGrid.addRow(id,tCols);
	tGrid.showRow(id);
	tGrid.selectRow(0);
	if(tisChanged == true){
		tGrid.cells(id,0).cell.wasChanged = true;
		tGrid.setUserData(id,"!nativeeditor_status","inserted");
		tGrid.setRowTextBold(id);
	}
	alog("(common) addRow(" + tname + ")------------end");
}



function setCodeYN(tGrptype, tCombo, tPcd){
	alog("   setGridCombo----------------------start");
	//alog("		tPcd = " + tPcd);
	
	//alert(tCombo);

	if(!tCombo)return;

	


	var data = {
			"RTN_DATA":
				{"rows":
					[
						{"data":["Y","Y"]}
						,{"data":["N","N"]}
					]
				}
			};

	if(tGrptype == "GRID"){
		if(!data.RTN_DATA)return;
		//alog("	코드수 : " + data.RTN_DATA.rows.length);
		
		tCombo.clear(); //비우기
		tCombo.put("","");

		for(var i=0;i<data.RTN_DATA.rows.length;i++){
			alog(data.RTN_DATA.rows[i].data[0] + "=" + data.RTN_DATA.rows[i].data[1]);

			tCombo.put(data.RTN_DATA.rows[i].data[0],data.RTN_DATA.rows[i].data[1]);
		}
	}else if(tGrptype == "CONDITION"){
		if(!data.RTN_DATA)return;
		//alog("	코드수 : " + data.RTN_DATA.rows.length);
		
		tCombo.empty(); //비우기
		tCombo.append("<option value=''></option>"); //빈라인 추가

		for(var i=0;i<data.RTN_DATA.rows.length;i++){
			//alog(data.RTN_DATA.rows[i].data[1] + "=" + data.RTN_DATA.rows[i].data[2]);

			tCombo.append("<option value='" + data.RTN_DATA.rows[i].data[0] + "'>" + data.RTN_DATA.rows[i].data[1] + "</option>");
		}
	}else if(tGrptype == "FORMVIEW"){
		if(!data.RTN_DATA)return;
		//alog("	코드수 : " + data.RTN_DATA.rows.length);
		
		tCombo.empty(); //비우기
		tCombo.append("<option value=''></option>"); //빈라인 추가

		for(var i=0;i<data.RTN_DATA.rows.length;i++){
			//alog(data.RTN_DATA.rows[i].data[1] + "=" + data.RTN_DATA.rows[i].data[2]);

			tCombo.append("<option value='" + data.RTN_DATA.rows[i].data[0] + "'>" + data.RTN_DATA.rows[i].data[1] + "</option>");
		}
	}else{
		alog("	그룹 타입이 없습니다");
	}

		
	//alog("   setGridCombo----------------------end");

}



function setCodeCombo(tGrptype, tCombo, tPcd){
	//alog("   setGridCombo----------------------start");
	//alog("		tPcd = " + tPcd);
	
	//alert(tCombo);

	if(!tCombo)return;

	//불러오기
	$.ajax({
		type : "GET",
		url : "/c.g/cg_code_json.php",
		data : {PJTSEQ : 3,PCD : tPcd},
		dataType: "json",
		async: false,
		success: function(data){
			//alog("   getCodeJson json return----------------------");
			//alog("   json data : " + JSON.stringify(data.RTN_DATA));
			//alog("   json RTN_CD : " + data.RTN_CD);
			//alog("   json ERR_CD : " + data.ERR_CD);
			//alog("   json RTN_MSG length : " + data.RTN_MSG.length);

			//그리드에 데이터 반영
			if(data.RTN_CD == "200"){
				if(tGrptype == "GRID"){
					if(!data.RTN_DATA)return;
					//alog("	코드수 : " + data.RTN_DATA.rows.length);
					
					tCombo.clear(); //비우기
					tCombo.put("","");

					for(var i=0;i<data.RTN_DATA.rows.length;i++){
						//alog(data.RTN_DATA.rows[i].data[0] + "=" + data.RTN_DATA.rows[i].data[1]);

						tCombo.put(data.RTN_DATA.rows[i].data[0],data.RTN_DATA.rows[i].data[1]);
					}
				}else if(tGrptype == "CONDITION"){
					if(!data.RTN_DATA)return;
					//alog("	코드수 : " + data.RTN_DATA.rows.length);
					
					tCombo.empty(); //비우기
					tCombo.append("<option value=''></option>"); //빈라인 추가

					for(var i=0;i<data.RTN_DATA.rows.length;i++){
						//alog(data.RTN_DATA.rows[i].data[1] + "=" + data.RTN_DATA.rows[i].data[2]);

						tCombo.append("<option value='" + data.RTN_DATA.rows[i].data[0] + "'>" + data.RTN_DATA.rows[i].data[1] + "</option>");
					}
				}else if(tGrptype == "FORMVIEW"){
					if(!data.RTN_DATA)return;
					//alog("	코드수 : " + data.RTN_DATA.rows.length);
					
					tCombo.empty(); //비우기
					tCombo.append("<option value=''></option>"); //빈라인 추가

					for(var i=0;i<data.RTN_DATA.rows.length;i++){
						//alog(data.RTN_DATA.rows[i].data[1] + "=" + data.RTN_DATA.rows[i].data[2]);

						tCombo.append("<option value='" + data.RTN_DATA.rows[i].data[0] + "'>" + data.RTN_DATA.rows[i].data[1] + "</option>");
					}
				}else{
					alog("	그룹 타입이 없습니다");
				}

			}else{
				alert("서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG);
			}
		},
		error: function(error){
			alert("Error:" + error);
		}
	});

	//alog("   setGridCombo----------------------end");

}





//GRP목록 가져오기(FNC선택시, GRP선택시)
function setGridGrp(tGrptype, tCombo, tPjtseq, tPgmseq, tGrpseq, tFncseq){
	alog("   setGridSql----------------------start");
	//alog("		tPcd = " + tPcd);
	
	//alert(tCombo);

	if(!tCombo)return;

	//불러오기
	$.ajax({
		type : "GET",
		url : "/c.g/cg_code_json.php",
		data : {PJTSEQ : tPjtseq, PGMSEQ : tPgmseq, GRPSEQ : tGrpseq , FNCSEQ : tFncseq},
		dataType: "json",
		async: false,
		success: function(data){
			//alog("   getCodeJson json return----------------------");
			//alog("   json data : " + JSON.stringify(data.RTN_DATA));
			//alog("   json RTN_CD : " + data.RTN_CD);
			//alog("   json ERR_CD : " + data.ERR_CD);
			//alog("   json RTN_MSG length : " + data.RTN_MSG.length);

			//그리드에 데이터 반영
			if(data.RTN_CD == "200"){
				if(tGrptype == "GRID"){
					if(!data.RTN_DATA)return;
					//alog("	코드수 : " + data.RTN_DATA.rows.length);
					
					tCombo.clear(); //비우기
					tCombo.put("","");

					for(var i=0;i<data.RTN_DATA.rows.length;i++){
						//alog(data.RTN_DATA.rows[i].data[1] + "=" + data.RTN_DATA.rows[i].data[2]);

						tCombo.put(data.RTN_DATA.rows[i].data[0],data.RTN_DATA.rows[i].data[1]);
					}
				}else{
					alog("	그룹 타입이 없습니다");
				}

			}else{
				alert("서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG);
			}
		},
		error: function(error){
			alert("Error:" + error);
		}
	});

	//alog("   setGridCombo----------------------end");

}



//SQL목록 가져오기
function setGridSql(tGrptype, tCombo, tPjtseq, tPgmseq, tSvcseq){
	alog("   setGridSql----------------------start");
	//alog("		tPcd = " + tPcd);
	
	//alert(tCombo);

	if(!tCombo)return;

	//불러오기
	$.ajax({
		type : "GET",
		url : "/c.g/cg_code_json.php",
		data : {PJTSEQ : tPjtseq, PGMSEQ : tPgmseq, SVCSEQ : tSvcseq},
		dataType: "json",
		async: false,
		success: function(data){
			//alog("   getCodeJson json return----------------------");
			//alog("   json data : " + JSON.stringify(data.RTN_DATA));
			//alog("   json RTN_CD : " + data.RTN_CD);
			//alog("   json ERR_CD : " + data.ERR_CD);
			//alog("   json RTN_MSG length : " + data.RTN_MSG.length);

			//그리드에 데이터 반영
			if(data.RTN_CD == "200"){
				if(tGrptype == "GRID"){
					if(!data.RTN_DATA)return;
					//alog("	코드수 : " + data.RTN_DATA.rows.length);
					
					tCombo.clear(); //비우기
					tCombo.put("","");

					for(var i=0;i<data.RTN_DATA.rows.length;i++){
						//alog(data.RTN_DATA.rows[i].data[1] + "=" + data.RTN_DATA.rows[i].data[2]);

						tCombo.put(data.RTN_DATA.rows[i].data[0],data.RTN_DATA.rows[i].data[1]);
					}
				}else{
					alog("	그룹 타입이 없습니다");
				}

			}else{
				alert("서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG);
			}
		},
		error: function(error){
			alert("Error:" + error);
		}
	});

	//alog("   setGridCombo----------------------end");

}





function initTEST5(tobjid){
    if($("#" + tobjid )){
        $("#" + tobjid ).append("<option value=''>- select one-</option>");
        $("#" + tobjid ).append("<option value='1'>Apples</option>");
        $("#" + tobjid ).append("<option value='2'>Mongo</option>");
    }

}


function myErrorHandler(type, desc, erData){
    alog("----------myErrorHandler------------start");
    alog("   type : " + type);
    alog("   desc : " + desc);
    alog("   status : " + erData[0].status);
    alog("   responseText : " + erData[0].responseText);
    alog("----------myErrorHandler------------end");
    return false;
}
//dhtmlxError.catchError("LoadXML", myErrorHandler);
//dhtmlxError.catchError("DataStructure",myErrorHandler);



function jsonFormValid(jsonobj, inputid, inputnm, inputval){
    alog("jsonFormValid()------------start");
	if(!jsonobj)return true;
    alog("   jsonobj.REQUARED : " + jsonobj.REQUARED);
    alog("   jsonobj.MIN : " + jsonobj.MIN);
    alog("   jsonobj.MAX : " + jsonobj.MAX);
    alog("   jsonobj.DATASIZE : " + jsonobj.DATASIZE);
    alog("   jsonobj.DATATYPE : " + jsonobj.DATATYPE);
    alog("   inputid : " + inputid);
    alog("   inputnm : " + inputnm);
    alog("   inputval : " + inputval);


    if(jsonobj.REQUARED == "Y" && inputval == ""){   alert(getMsg(validmsg.REQUARED,new Array(inputid, inputnm)) );return false;   }

	alog("jsonFormValid()------------end");
    return true;
}

function getMsg(msg,tarray){
    var RtnVal;
    RtnVal = msg;
    if(isArray(tarray)){
        for(i=0;i<tarray.length;i++){
            RtnVal += tarray[i];
        }
    }
    return RtnVal;
}
function isArray(myArray) {
    return Object.prototype.toString.call(myArray) === "[object Array]";
}


// 따움표 처리
function q(t){
    return t.replace(new RegExp("\"","g"),"\\\"");
}


//정적-특정row의 모든 컬럼 값 가져오기
function getRowsArray(tgrid,trowid){
    //alog("getRowsArray()------------start");

    var RtnVal="";
    var colNum=tgrid.getColumnsNum();
    for(i=0;i<colNum;i++){
        RtnVal += "&c" + i + "=" + tgrid.cells(trowid,i).getValue();
    }
    //alog("getRowsArray()------------end");
    return RtnVal;
}

//정적-특정row의 모든 컬럼 값 가져오기
function getRowsColid(tgrid,trowid,tgrpid, tcols){
    //alog("getRowsColid111()------------start");
    //alog("        tgrpid tt : " + tgrpid);

    var RtnVal="";
    var colNum=tgrid.getColumnsNum();
    //alog("   colNum : " + colNum);

    for(i=0;i<colNum;i++){
        alog("   " + i + " = " + tgrid.getColumnId(i));
		if(tcols != null){
			for(j=0;j<tcols.length;j++){
				if( tcols[j] == tgrid.getColumnId(i) ){
			        RtnVal += "&" + tgrpid + "_" + tgrid.getColumnId(i) + "=" + tgrid.cells(trowid,i).getValue();
				}
			}
		}else{
			//컬럼 정의가 없으면 모든 컬럼 리턴
	        RtnVal += "&" + tgrpid + "_" + tgrid.getColumnId(i) + "=" + tgrid.cells(trowid,i).getValue();
		}
    }
    //alog("getRowsColid222()------------end");
    return RtnVal;
}

//정적-특정row의 모든 컬럼 값 Map 형태로 가져오기 가져오기
function getRowsColidMap(tgrid,trowid,tgrpid){
    //alog("getRowsColidMap()------------start");
    alog("        tgrpid : " + tgrpid);

    var RtnVal = new Map();
    var colNum=tgrid.getColumnsNum();
    for(i=0;i<colNum;i++){
        alog("   " + i + " = " + tgrid.getColumnId(i));
        RtnVal.put(tgrpid + "_" + tgrid.getColumnId(i), tgrid.cells(trowid,i).getValue());
        //RtnVal += "&" + tgrpid + "_" + tgrid.getColumnId(i) + "=" + tgrid.cells(trowid,i).getValue();
    }
    //alog("       map.size : " + RtnVal.size());
    //alog("getRowsColidMap()------------end");
    return RtnVal;
}

//정적-특정row의 모든 컬럼 값 Map 형태로 가져오기 가져오기
function setRowsColidMap(tmap, tgrid,trowid,tgrpid){
    alog("getRowsColidMap()------------start");
    alog("        tgrpid : " + tgrpid);

    //var RtnVal = new Map();
    var colNum=tgrid.getColumnsNum();
    for(i=0;i<colNum;i++){
        alog("   " + i + " = " + tgrid.getColumnId(i));
        tmap.put(tgrpid + "_" + tgrid.getColumnId(i), tgrid.cells(trowid,i).getValue());
        //RtnVal += "&" + tgrpid + "_" + tgrid.getColumnId(i) + "=" + tgrid.cells(trowid,i).getValue();
    }
    alog("       map.size : " + tmap.size());
    alog("getRowsColidMap()------------end");
    return RtnVal;
}


function clearRowChanged(tgrid,trid){
    alog("clearRowChanged----------------------------start");
    alog("       tgrid.getColumnCount : " + tgrid.getColumnCount());
    alog("       trid : " + trid);
	tgrid.setUserData(trid,"!nativeeditor_status","");
	tgrid.setRowTextNormal(trid);

    //tgrid.setRowTextStyle(trid, "font-weight:normal;text-decoration:none;");
    for(var i=0;i<tgrid.getColumnCount();i++){
        tgrid.cells(trid,i).cell.wasChanged=false;
    }
}



//그리드 저장 처리
function saveToGrid(tgrid,data){
    if(data.RTN_CD == "200"){
		if(!data.RTN_MSG){
			msgError("서버 전송후 서버에서 처리 결과를 전송받지 못했습니다.",1);
			return;
		}
        for(var i=0;i<data.RTN_MSG.length;i++){
            alog( "   i : " + i);
            alog( "      OLD_ID : " + data.RTN_MSG[i].OLD_ID);
            alog( "      NEW_ID : " + data.RTN_MSG[i].NEW_ID);
            alog( "      USER_DATA : " + data.RTN_MSG[i].USER_DATA);
            alog( "      AFFECTED_ROWS : " + data.RTN_MSG[i].AFFECTED_ROWS);


            if(data.RTN_MSG[i].AFFECTED_ROWS=="-1"){
                alert(data.RTN_MSG[i].NEW_ID + "는 저장 실패");
            }else{
                //rid = mygrid.getRowId(j);
                rid = data.RTN_MSG[i].OLD_ID;
                if( data.RTN_MSG[i].USER_DATA == "inserted" ){
                    clearRowChanged(tgrid,rid);
					
					if(data.RTN_MSG[i].NEW_ID != ""){
						alog("SEQ_COLID : " + data.RTN_MSG[i].NEW_ID);						
						tgrid.changeRowId(data.RTN_MSG[i].OLD_ID,data.RTN_MSG[i].NEW_ID); //j+10은 서버에서 전달 받은 서버에 저장된 id값
					}

					//SEQ인 경우 SEQ컬럼을 업데이트 (SEQ_COLID)
					if(data.RTN_DATA && data.RTN_DATA.SEQ_COLID != ""){
						alog("SEQ_COLID : " + data.RTN_DATA.SEQ_COLID);
						tgrid.cells(data.RTN_MSG[i].NEW_ID,tgrid.getColIndexById(data.RTN_DATA.SEQ_COLID)).setValue(data.RTN_MSG[i].NEW_ID);
					}

                    alog("	rid [" + rid + "] is [inserted]");
                }
                if( data.RTN_MSG[i].USER_DATA == "updated" ){
                    clearRowChanged(tgrid,rid);

                    alog("	rid [" + rid + "] is [updated]");
                }
                if( data.RTN_MSG[i].USER_DATA == "deleted" ){
                    tgrid.deleteRow(rid);

                    alog("	rid [" + rid + "] is [deleted]");
                }
            }
        }

        //변경 상태 모두 초기화
        tgrid.clearChangedState();
		msgNotice("성공적으로 저장되었습니다.");
    }else{
        msgError("서버 저장중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG,3);
    }
}


//메시지
var validmsg = jQuery.parseJSON('{"REQUARED":"[0]는 반드시 입력바랍니다.", "MIN":"this는 [0]이상 입력바랍니다."}');

//해쉬맵
Map = function(){
    this.map = new Object();
};
Map.prototype = {
    put : function(key, value){
        this.map[key] = value;
    },
    get : function(key){
        return this.map[key];
    },
    containsKey : function(key){
        return key in this.map;
    },
    containsValue : function(value){
        for(var prop in this.map){
            if(this.map[prop] == value) return true;
        }
        return false;
    },
    isEmpty : function(key){
        return (this.size() == 0);
    },
    clear : function(){
        for(var prop in this.map){
            delete this.map[prop];
        }
    },
    remove : function(key){
        delete this.map[key];
    },
    keys : function(){
        var keys = new Array();
        for(var prop in this.map){
            keys.push(prop);
        }
        return keys;
    },
    values : function(){
        var values = new Array();
        for(var prop in this.map){
            values.push(this.map[prop]);
        }
        return values;
    },
    size : function(){
        var count = 0;
        for (var prop in this.map) {
            count++;
        }
        return count;
    },
    getUri : function(){
        return $.serialize(this);
    }
};

//var map = new Map();
//map.put("user_id", "atspeed");
//map.get("user_id");

//https://stackoverflow.com/questions/105034/create-guid-uuid-in-javascript
function uuidv4() {
	return ([1e7]+-1e3+-4e3+-8e3+-1e11).replace(/[018]/g, c =>
	  (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
	)
  }
  