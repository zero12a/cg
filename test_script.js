

	var checked=mygridG2.getCheckedRows(0);//table 목록
	if(checked ==""){
		return;
	}else{
		//alert(checked);
		var arrTables = checked.split(",");

		var colIndex = mygridG2.getColIndexById("RESULT");

		for(t=0;t<arrTables.length;t++){
			var tableNm = arrTables[t];

			//alert(tableNm);
			//alert("rowid, 컬럼순번:" + tableNm + ", " + colIndex);
			//불러오기
			$.ajax({
				type : "GET",
				url : CFG_CGWEB_URL + "/c.g/cg_cdeploy_db.php?TOKEN=" + token + "&DB=" + $("#G1-DB").val() + "&TABLE=" + tableNm ,
				dataType: "jsonp",
				async: false,
				success: function(data){
					alog("   gridG2 json return----------------------");

					//alog("   json RTN_MSG length : " + data.RTN_MSG.length);

					mygridG2.cells(data.ERR_CD,colIndex).setValue("O");
					//alert("응답오케이:" + tableNm + ", " + colIndex);

				},
				error: function(error){
					msgError("[테이블목록] Ajax http 500 error ( " + error + " )",3);
					//alog("[테이블목록] Ajax http 500 error ( " + data.RTN_MSG + " )");
				}
			});
		}
	}