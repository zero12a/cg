<!DOCTYPE html>
<html>
<head>
	<title>Init from json</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<link rel="stylesheet" type="text/css" href="../../../codebase/dhtmlx.css"/>


	<!--jquery / json-->
	<script src="./lib/jquery-1.11.1.min.js"></script>
	<script src="./lib/json2.min.js"></script>

	<!--dhmltx-->
    <script src="./lib/dhtmlxSuite/codebase/dhtmlx461_beautify.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="./lib/dhtmlxSuite/codebase/dhtmlx.css" type="text/css" charset="utf-8">
	<style>
		html, body {
			width: 100%;
			height: 100%;
			overflow: hidden;
			margin: 0px;
		}

	</style>
	<script type="text/javascript" charset="utf-8">
	window.skin = "skyblue"; // for tree image_path
	window.dhx4.skin = 'dhx_skyblue';

	var main_layout;
	function doOnLoad(){
		main_layout = new dhtmlXLayoutObject(document.body, '3T');

		var a = main_layout.cells('a');
		a.hideHeader();
		a.setHeight(40);
		a.attachURL("menu3.html", true, {fname: "Mike", hobby: "fishing"});
		a.fixSize(false, true);//가로,세로

		var b = main_layout.cells('b');
		b.setWidth(160);
		b.hideHeader();
		b.fixSize(true, false);//가로,세로

		var sidebar_1 = b.attachSidebar(
				{
					template: 'details'
					, width: '160'
					, icons_path: './preview/codebase/imgs_sidebar/'
					, autohide: ''
					, header: ''
					, json: 'menu3_sidebar.json'
				}
			);
		//sidebar_1.cells('recent').setActive();



		var c = main_layout.cells('c');
		c.hideHeader();
		var tabbar_1 = c.attachTabbar();
		tabbar_1.addTab('tab_1','tab_1');
		var tab_1 = tabbar_1.cells('tab_1');
		tab_1.setActive();


		tabbar_1.addTab('tab_2','tab_2');
		var tab_2 = tabbar_1.cells('tab_2');

	}

	function go_cell_b(){
		main_layout.cells("b").collapse();
		main_layout.cells("c").progressOn();

	}





	</script>
</head>
<body onload="doOnLoad();">
</body>
</html>