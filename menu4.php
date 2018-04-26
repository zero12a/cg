<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ko">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width" /> 
	<title>Document</title>
	<style type="text/css">
		*{margin:0;padding:0}
		html,body{height:100%}
		body{display:table;width:100%}
		#header,#footer{display:table-row;width:100%;height:1px}
		#container{display:table-row;width:100%;height:100%}

		body{font-size:10pt;color:#FFF}
		#header,#footer{background-color:#F00}
		#container{background-color:#0F0}

	#sidebarObj{position:absolute;left:0px;top:32px;width:160px;height:400px;z-index:60;}
	#layoutObj{background-color:yellow;position:relative;width:100%;height:100%;z-index:50;}

	.MENU_LINE {background-color:silver;position:relative;width:100%;height:32px;z-index:20;}
    .MENU_LEFT {background-color:gray;position:relative;float:left;width:10%;height:32px;line-height:32px;vertical-align:middle;text-align:left;z-index:30;}
    .MENU_TITLE {background-color:silver;position: relative;float:left;width:80%;height:32px;line-height:32px;vertical-align:middle;text-align:center;z-index:30;}
    .MENU_RIGHT {background-color:gray;position:relative;float:left;width:10%;height:32px;line-height:32px;vertical-align:middle;text-align:right;z-index:30;}

	</style>
	<!--jquery / json-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="./lib/json2.min.js"></script>

	<!--dhmltx-->
    <script src="./lib/dhtmlxSuite/codebase/dhtmlx461_beautify.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="./lib/dhtmlxSuite/codebase/dhtmlx.css" type="text/css" charset="utf-8">

    <!--공통-->
    <script src="./rst/common.js" type="text/javascript" charset="utf-8"></script>


	<script>
		var mySidebar,main_layout;
		var isMenuOpen = 1;

		window.skin = "skyblue"; // for tree image_path
		window.dhx4.skin = 'dhx_skyblue';

		function doOnLoad() {

			//dhtmlx 메시지 박스 초기화
			dhtmlx.message.position="bottom"


			msgNotice("doOnload_______________start");

			//main_layout = new dhtmlXLayoutObject("layoutObj", '2U');
			//var a = main_layout.cells('a');
			//a.hideHeader();
			//var b = main_layout.cells('b');
			//b.hideHeader();


			main_layout = new dhtmlXLayoutObject("layoutObj", '1C');
			var a = main_layout.cells('a');
			a.hideHeader();
			//a.attachURL("http://www.naver.com", null, {fname: "Mike", hobby: "fishing"});
			msgNotice("main_layout.................init");


			// firstly add the event
			//main_layout.attachEvent("onContentLoaded", function(id){
			//	// page.html id loaded, your code here
			//	alert("onContentLoaded : " + id);
			//});

			a.attachURL("menu4_pjtview2.html", true, {fname: "Mike", hobby: "fishing"});


			msgNotice("main_layout.................load (url)");

			mySidebar = new dhtmlXSideBar({
				parent: "sidebarObj",
				icons_path: "./",
				autohide: false
			});

			msgNotice("mySidebar.................init");

			//프로젝트 목록
			mySidebar.loadStruct("menu3_sidebar.json");

			msgNotice("mySidebar.................load (url)");

			msgNotice("doOnload_______________end");

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

		function setTitle(tmp){
			//값 비우기
			$("#nav_title").text(tmp);
		}
	</script>
</head>
<body onload="doOnLoad()">
	<div id="header">
		<div  class="MENU_LINE" >
			<div class="MENU_LEFT" ><a href="#" onclick="viewSide();"><img src="img/menu.png" height=32 border=0></a> <a href="#" onclick="go_back();"><</a>
			</div>
			<div  class="MENU_TITLE" id="nav_title">menu title
			</div>
			<div  class="MENU_RIGHT"  >**
			</div>
		</div>
	</div>
	<div id="container">
		<div id="layoutObj"></div>
	</div>
	<div id="footer">
		Footer Area
	</div>
	<div id="sidebarObj"></div>	
</body>
</html>