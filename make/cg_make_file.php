<?php
/**
 * Created by PhpStorm.
 * User: zero12a
 * Date: 2014. 7. 12.
 * Time: 오후 3:25
 */



function saveFile2($filetype,$filenm){
    global $F_PJTSEQ,$svrid,$F_PGMSEQ,$db,$CFG_ROOT_DIR, $F_VERSEQ, $P;
    //$tpath = $CFG_ROOT_DIR . "rst/" . ;//단일 프로젝트 일때
    $tpath = $CFG_ROOT_DIR . $P["PJTID"] . "/";  
	$printRowCnt = 0;

    //프로젝트 폴더가 없으면 생성하기
    if(!is_dir($tpath))mkdir($tpath);

    $filename = $tpath . $filenm;

    if (!$handle = fopen($filename, 'w+')) {
        echo "Cannot open file ($filename)";
        exit;
    }

    //src 불러오기
    $T_SQL = sprintf("
        select *
        from CG_RST   
		where PJTSEQ = %d and PGMSEQ = %d and FILETYPE = '%s' and VERSEQ = %d
        order by SRCORD ASC"
        , $F_PJTSEQ
        , $F_PGMSEQ
        , $filetype
		, $F_VERSEQ
    );
    //mlog("makr RST SQL : " . $T_SQL);
    $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","099file1", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

    while($line =  $result->fetch_assoc()  ){
		//mlog($printRowCnt++);
        //echo HtmlEncode($line["SRCTXT"]);
        // Write $somecontent to our opened file.
        if (fwrite($handle, $line["SRCTXT"]) === FALSE) {
            echo "Cannot write to file ($filename)";
            exit;
        }
    }
    $result->close();



    fclose($handle);
    chmod($filename,0766);

    //파일 라인수 구하기
    $linecount = 0;
    $handle = fopen($filename, "r");
    while(!feof($handle)){
        $line = fgets($handle, 4096);
        $linecount = $linecount + substr_count($line, PHP_EOL);
    }
    fclose($handle);
    //echo $linecount;


    alog("Success, wrote ($somecontent) to file ($filename)");

    return array("LINECOUNT" => $linecount, "FILEHASH" => md5_file($filename), "FILESIZE" => filesize($filename)); 
    //JsonMsg("200","200","Success, wrote ($somecontent) to file ($filename)");

}



function saveFile($filetype,$suffix,$file_extension){
    global $F_PJTSEQ,$F_PGMSEQ,$db,$svrid,$CFG_ROOT_DIR;
    $tpath = $CFG_ROOT_DIR . "rst/";




    $tname = getCamel($F_PGMID) . getCamel($suffix) . $file_extension;
    $filename = $tpath . $tname;


    if (!$handle = fopen($filename, 'w+')) {
        echo "Cannot open file ($filename)";
        exit;
    }


    //src 불러오기
    $T_SQL = sprintf("
        select *
        from CG_RST   where PJTSEQ = %d and PGMSEQ = %d and FILETYPE = '%s'
        order by SRCORD ASC"
        , $F_PJTSEQ
        , $F_PGMSEQ
        , $filetype
    );
    //echo $T_SQL;
    $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","099file2", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

    while($line =  $result->fetch_assoc()  ){
        //echo HtmlEncode($line["SRCTXT"]);
        // Write $somecontent to our opened file.
        if (fwrite($handle, $line["SRCTXT"]) === FALSE) {
            echo "Cannot write to file ($filename)";
            exit;
        }
    }
    $result->close();

    alog("Success, wrote ($somecontent) to file ($filename)");

    fclose($handle);
    chmod($filename,0766);

}
?>