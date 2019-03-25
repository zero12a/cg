<?php
/**
 * Created by PhpStorm.
 * User: zero12a
 * Date: 2014. 6. 29.
 * Time: 오후 9:32
 */

header("Content-Type: text/html; charset=UTF-8");

//설정 함수 읽기
if(!include_once './incConfig.php')	        echo "include fail(1)";
if(!include_once './include/incDB.php')			echo "include fail(2)";
if(!include_once './include/incUtil.php')		echo "include fail(3)";
if(!include_once './include/incSec.php')		echo "include fail(4)";
if(!include_once './include/incRequest.php')		echo "include fail(5)";

?>
<html>
<head>
    <!--codemirror-->
    <link rel=stylesheet href="./lib/codemirror/doc/docs.css">
    <link rel=stylesheet href="./lib/codemirror/lib/codemirror.css">

    <script src="./lib/codemirror/lib/codemirror.js"></script>
    <script src="./lib/codemirror/mode/php/php.js"></script>
    <script src="./lib/codemirror/mode/sql/sql.js"></script>
    <script src="./lib/codemirror/addon/selection/active-line.js"></script>

    <script src="./lib/codemirror/mode/xml/xml.js"></script>
    <script src="./lib/codemirror/mode/javascript/javascript.js"></script>
    <script src="./lib/codemirror/mode/css/css.js"></script>
    <script src="./lib/codemirror/mode/htmlmixed/htmlmixed.js"></script>

    <script src="./lib/codemirror/addon/edit/matchbrackets.js"></script>
    <script src="./lib/codemirror/addon/comment/continuecomment.js"></script>
    <script src="./lib/codemirror/addon/comment/comment.js"></script>
    <script src="./lib/codemirror/mode/clike/clike.js"></script>
    <style>
        body {margin:0;padding:0}

		.code2 {
			border: 1px solid blue;
			font-size:70%;
		}


	</style>
	<script>
	var cm1;
	function initBody2(){
	}
	function initBody(){
	        //코드 미러 초기화
        cm1 = CodeMirror.fromTextArea(document.getElementById('code2'), {
            mode: "application/x-httpd-php",
            styleActiveLine: true,
            indentWithTabs: true,
            smartIndent: true,
            lineNumbers: true,
            matchBrackets : true,
            tabSize: 4,
            indentUnit: 4,
            indentWithTabs: true
        });
		cm1.setSize("100%","100%");
        cm1.getWrapperElement().style["font-size"] = "11px";
        cm1.refresh();

	}
	</script>
</head>
<body onload="initBody()" style="background-color:green;">
<textarea style="width:100%;height:100%;" id="code2" name="code2"><?php

//SeverView();

//db 오픈
//$db = db_open();
$db = db_m_open();

//전체 리플레서 정보
$G = null;

$F_PJTSEQ = reqPostNumber("pjtseq",10);
$F_PGMSEQ = reqPostNumber("pgmseq",10);
$F_FILETYPE = $_POST["filetype"];
$RstCnt = 0;
$NowFileType = "";


//src 불러오기
$T_SQL = sprintf("
    select a.*
    from CG_RST a 
		join CG_RSTFILE b on a.PJTSEQ = b.PJTSEQ and a.PGMSEQ = b.PGMSEQ and a.VERSEQ = b.VERSEQ and b.ACTIVEYN='Y' and a.FILETYPE = b.FILETYPE
	where a.PJTSEQ = %d and a.PGMSEQ = %d and a.FILETYPE = '%s' 
    order by a.SRCORD ASC"
    , $F_PJTSEQ
    , $F_PGMSEQ
    , $F_FILETYPE
    );
alog("T_SQL:" . $T_SQL);
//echo $T_SQL;
$result = $db->query($T_SQL) or ServerMsg("500","120", "[" . $db->error . "] " . $db->error) ;

while($line =  $result->fetch_assoc()  ){
    echo HtmlEncode($line["SRCTXT"]);
}
$result->close();
db_close3($db); //db 닫기
?></textarea></body></html>