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

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>MENU</title>


    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!--jquery / json-->
	<script src="./lib/jquery-1.11.1.min.js"></script>
	<script src="./lib/json2.min.js"></script>

	<!--dhmltx-->
    <script src="./lib/dhtmlxSuite/codebase/dhtmlx461_beautify.js" type="text/javascript" charset="utf-8"></script>

    <!--공통-->
    <script src="./rst/common.js" type="text/javascript" charset="utf-8"></script>


    <link rel="stylesheet" href="./lib/dhtmlxSuite/codebase/dhtmlx.css" type="text/css" charset="utf-8">
    <style>
		*{margin:0;padding:0}
		html,body{height:100%}
		body{display:table;width:100%}




		.MENU_LINE {background-color:silver;position:relative;width:100%;height:45px;z-index:20;}
		.MENU_LEFT {background-color:gray;position:relative;float:left;width:10%;height:45px;line-height:45px;vertical-align:middle;text-align:left;z-index:30;}
		.MENU_TITLE {background-color:silver;position: relative;float:left;width:80%;height:45px;line-height:45px;vertical-align:middle;text-align:center;z-index:30;}
		.MENU_RIGHT {background-color:gray;position:relative;float:left;width:10%;height:45px;line-height:45px;vertical-align:middle;text-align:right;z-index:30;}

		#header{display:table-row;background-color:red;height:45px;}
		#container{display:table-row;width:100%;height:100%;background-color:blue;overflow:scroll;}

		div#layoutObj {
			position: relative;
			background-color:yellowgreen;
			margin-top: 0px;
			margin-left: 0px;
			width: 100%;
			height: 100%;
		}

    </style>



    <script>
    var myTabbar;
	var myLayout;
	var myTree;
	var tnum = 0;
	var ctlUrl = "pjtdemoPc_crud.php";

    function initBody(){
		alog("initBody-----------------------------------start");

		//레이아웃
		myLayout = new dhtmlXLayoutObject({
			parent: "layoutObj",
			pattern: "2U"
		});

		//myLayout.cells("a").hideHeader();
		myLayout.cells("a").setWidth(200);
		myLayout.cells("a").setText("메뉴입니다.");
		myLayout.cells("a").hideHeader();
		myLayout.cells("b").hideHeader();

		//빈탭바 붙이기
		alog(111);
		myTabbar = myLayout.cells("b").attachTabbar();
		alog(122);

        myTabbar.setSkin('dhx_skyblue');
        myTabbar.enableAutoReSize(true);
		myTabbar.enableTabCloseButton(true);


		//트리
		myTree = myLayout.cells("a").attachTree();
		myTree.setImagePath("./lib/dhtmlxSuite/codebase/imgs/dhxtree_skyblue/");
		myTree.setDataMode("json");
		myTree.setOnClickHandler(tonclick);

		getPjtInfo();
		getPgmList();
		//jsonObject= ["id":"1","text":"pgm",open:1];
		//myTree.parse(jsonObject,"json");

		//myTree.load("pjtdemoPc_crud.php?FNC=PGMLIST&PJTSEQ=<?=$REQ["PJTSEQ"]?>&etc=" + new Date().getTime(),"json");
		//myTree.loadStruct("pjtdemoPc_crud.php?FNC=PGMLIST&PJTSEQ=<?=$REQ["PJTSEQ"]?>&etc=" + new Date().getTime(),"json");
		
		alog("initBody-----------------------------------end");
    }


	function getPjtInfo(){
		alog("getPjtInfo...............................start");

		//PGM리스트 불러우기
		$.ajax({
			type : "POST",
			url : ctlUrl+"?FNC=PJTINFO",
			data : {PJTSEQ : "<?=$REQ["PJTSEQ"]?>"},
			dataType: "json",
			async: true,
			success: function(data){
				alog("   getPgmList json return----------------------");
				//alog("   json data : " + data);

				alog(JSON.stringify(data));


				setTitle(data[0].PJTNM);


			},
			error: function(error){
				alog("Ajax http 500 error ( " + error + " )");
			}
		});
		alog("getPjtInfo...............................end");

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
				//alog("   json data : " + data);

				alog(JSON.stringify(data));


				myTree.parse(data,"json");


			},
			error: function(error){
				alog("Ajax http 500 error ( " + error + " )");
			}
		});

		alog("getPgmList...............................end");
	}

	$(window).resize(function() {  
		alog("window resize -------------------start");
		myLayout.setSizes();
		alog("window resize -------------------end");
	}); 

	function viewSide(){
		//alert(1);

		if(myLayout.cells("a").isCollapsed()){
            myLayout.cells("a").expand();
		}else{
            myLayout.cells("a").collapse();
		}
		//mySidebar.showSide();
	}


	function setTitle(tmp){
		//값 비우기
		$("#nav_title").text(tmp);
	}



    function tonclick(treeId){
        alog(myTree.getItemText(treeId));
        //void addTab(mixed id,string text,int width,int position,boolean active,boolean close);

		//treeId = id);
		treeNm = myTree.getItemText(treeId);

		if(myTabbar.cells(treeId)){
			myTabbar.cells(treeId).setActive();
		}else{

			myTabbar.addTab(treeId, treeNm, 100, null, true );
			myTabbar.tabs(treeId).attachURL("rst/" + treeId);

		}

    };
    </script>

</head>

<body onload="initBody();">
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
</body>
</html>