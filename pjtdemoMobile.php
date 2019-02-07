<?php
header("Content-Type: text/html; charset=UTF-8");
header("Cache-Control:no-cache");
header("Pragma:no-cache");

	//로그인 검사
    require_once("./include/incUtil.php");
    require_once("./include/incUser.php");
    require_once("./incConfig.php");

    require_once("./include/incLoginCheck.php");//로그인 검사


$REQ["PJTSEQ"] = $_GET["PJTSEQ"];
if(!is_numeric($REQ["PJTSEQ"]))exit;

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ko">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


	<title>Document</title>
	<style type="text/css">
		*{margin:0;padding:0}
		html,body{height:100%}
		body{display:table;width:100%}

		body{font-size:10pt;color:#FFF}
		#header{background-color:#F00}
		#footer{background-color:#F00;position:absolute;bottom:0px;width:100%;z-index:1;}


		#container{display:table-row;width:100%;height:100%;background-color:#0F0;overflow:scroll;}
		#layoutObj{background-color:yellow;position:relative;width:100%;height:100%;z-index:50;}

		#sidebarObj{position:absolute;left:0px;top:46px;width:250px;height:400px;z-index:60;}



		.MENU_LINE {background-color:silver;position:relative;width:100%;height:45px;z-index:20;}
		.MENU_LEFT {background-color:gray;position:relative;float:left;width:10%;height:45px;line-height:45px;vertical-align:middle;text-align:left;z-index:30;}
		.MENU_TITLE {background-color:silver;position: relative;float:left;width:80%;height:45px;line-height:45px;vertical-align:middle;text-align:center;z-index:30;}
		.MENU_RIGHT {background-color:gray;position:relative;float:left;width:10%;height:45px;line-height:45px;vertical-align:middle;text-align:right;z-index:30;}



		.CON_LINE {position: relative;width:100%;height:22px;line-height;122px;overflow:visible;}
		.CON_OBJCHK {position: relative;float:left;background-color: #eeeeee;height:22px;line-height:22px;vertical-align:middle ;overflow:visible;}
		.CON_OBJGRP {position: relative;float:left;background-color: #eeeeee;height:22px;line-height:22px;vertical-align:middle ;overflow:visible;}
		.CON_LABEL {position: relative;float:left;background-color: #eeeeee;height:22px;line-height:22px;vertical-align:middle ;padding-left:5px;color:blue}
		.CON_OBJECT {position: relative;float:left;background-color: #eeeeee;height:22px;line-height:22px;vertical-align:middle ;}
		.CON_LINEBREAK {position: relative;height:5px;overflow:auto;}

		.GRP_LINE {position: relative;width:100%;z-index:10;overflow:auto;}
		.GRP_OBJECT {position: relative;float:left;z-index:20;}


	</style>
	<!--jquery / json-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="./lib/json2.min.js"></script>

	<!--dhmltx-->
    <script src="./lib/dhtmlxSuite/codebase/dhtmlx461_beautify.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="./lib/dhtmlxSuite/codebase/dhtmlx.css" type="text/css" charset="utf-8">


    <!--공통-->
    <script src="./rst/common.js" type="text/javascript" charset="utf-8"></script>


	<!--bootstrap-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>


	<script>
		//선언
		var myList, myDetail, myToolbar, lastBtn, prevBtn, isEditYn, isMenuOpen;
		var isListEditMode = false;
		var rowSeq = 1;
		var ctlUrl = "pjtdemoMobile_crud.php";

		//dhtmlx
		window.skin = "skyblue"; // for tree image_path
		window.dhx4.skin = 'dhx_skyblue';



		//초기화
		isMenuOpen = 1;

		//alert("pjtview2_is start");


        $(document).ready(function() {
			alog("document_ready...............................");


			//공통 초기화
			commnonBodyOnlaod();

			//페이지 초기화
			pageBodyOnload();



        });    

		
		function pageBodyOnload(){
			alog("pageBodyOnload...............................");


			//레이아웃 처리
			main_layout = new dhtmlXLayoutObject("layoutObj", '1C');
			var a = main_layout.cells('a');
			a.hideHeader();
			//a.attachURL("http://www.naver.com", null, {fname: "Mike", hobby: "fishing"});
			msgNotice("main_layout.................init");

		}


		function commnonBodyOnlaod(){
			alog("commnonBodyOnlaod...............................");


            $("#btnNavReload").click(function() {
                location.reload();
            });

			//초기화
			setTitle("프로젝트 관리");
			
			//사이드바에 PGM리스트 불러오기
			getPgmList();

			//back링크
            $("#btnNavBack").click(function() {
				alert("go back");
                history.back();
            });


			//메뉴 링크
            $("#naviMenu1").click(function() {
				alert("go naver");
                $("#container").load("cg_login.php");
            });
		}


		function getPgmList(){
			alog("getPgmList...............................start");


			//PGM리스트 불러우기
			$.ajax({
				type : "POST",
				url : ctlUrl+"?FNC=PGMLIST",
				data : {PJTSEQ : "<?=$REQ["PJTSEQ"]?>"},
				dataType: "json",
				async: true,
				success: function(data){
					alog("   getPgmList json return----------------------");
					alog("   json data : " + data);
					alog("   json RTN_CD : " + data.RTN_CD);
					alog("   json ERR_CD : " + data.ERR_CD);
					//alog("   json RTN_MSG length : " + data.RTN_MSG.length);

					//그리드에 데이터 반영
					if(data.RTN_CD == "200"){
						alog(JSON.stringify(data.RTN_DATA));

						var tCols;
						for(var i=0;i<data.RTN_DATA.rows.length;i++){
							alog( "   i : " + i);

							//rtn : PGMSEQ, PGMNM, PGMID, ADDDT, MODDT
							pgmSeq = data.RTN_DATA.rows[i].data[0];
							pgmNm = data.RTN_DATA.rows[i].data[1];
							pgmId = data.RTN_DATA.rows[i].data[2];
							pgmUrl = data.RTN_DATA.rows[i].data[3];


							//행추가
							$("#listProgram").append("<a class='list-group-item' id='listRow"+ pgmSeq +"' keyid='" + pgmSeq + "' url='" + pgmUrl + "'>" + pgmNm + " (" + pgmId + ")</a>");

							$("#listRow"+pgmSeq).click(function() {
								alert($(this).attr("url")); 
				                //$("#container").load("./rst/" + $(this).attr("url"));

								main_layout.cells('a').attachURL("./rst/" + $(this).attr("url"));

							});

						}

					}else{
						msgError("서버 조회중 에러가 발생했습니다.\nRTN_CD : " + data.RTN_CD + "\nERR_CD : " + data.ERR_CD + "\nRTN_MSG :" + data.RTN_MSG,3);
					}


				},
				error: function(error){
					msgError("Ajax http 500 error ( " + error + " )",3);
					alog("Ajax http 500 error ( " + error + " )");
				}
			});

			alog("getPgmList...............................end");

		}


		function setTitle(tmp){
			//값 비우기
			$("#nav_title").text(tmp);
		}

		function doOnLoad2() {
			//alert("doOnLoad2()___________________start");


			
			//alert("doOnLoad2()___________________start");


			msgNotice("doOnLoad2_______________start");




		}

		function listEditMode(){
			msgNotice("listEditMode___________________start");

			//if($(".CON_OBJCHK").css("display") == "none"){
			//  $(".CON_OBJCHK").show();
			//} else {
			//  $(".CON_OBJCHK").hide();
			//}

		}


		function viewSide(){
			//alert(1);
			if(isMenuOpen == 1){
				isMenuOpen = 0;
				jQuery('#sidebarObj').hide();
			}else{
				isMenuOpen = 1;
				jQuery('#sidebarObj').show();
			}
			//mySidebar.showSide();
		}


	</script>
</head>
<body id="BODY_BOX" class="BODY_BOX" onl__oad="">
	<div id="header">
		<div  class="MENU_LINE" >
			<div class="MENU_LEFT" ><a href="#" onclick="viewSide();"><img src="img/menu.png" height=45 border=0></a> <a href="#" id="btnNavBack"><</a>
			</div>
			<div  class="MENU_TITLE" id="nav_title">menu title
			</div>
			<div  class="MENU_RIGHT" id="btnNavReload" >Reload
			</div>
		</div>
	</div>

	<div id="container">
		<div id="layoutObj"></div>		
	</div>




	<div id="footer">
		Footer Area
	</div>

	<div id="sidebarObj">
		<div class="list-group" id="listProgram">
		  <a href="#" class="list-group-item active">
			PROGRAM LIST
		  </a>
		</div>
	</div>
</body>
</html>