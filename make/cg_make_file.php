<?php
/**
 * Created by PhpStorm.
 * User: zero12a
 * Date: 2014. 7. 12.
 * Time: 오후 3:25
 */



function saveFile2($filetype,$filenm){
    global $F_PJTSEQ,$svrid,$F_PGMSEQ,$db,$CFG_ROOT_DIR, $F_VERSEQ;
    $tpath = $CFG_ROOT_DIR . "rst/";
	$printRowCnt = 0;

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

    alog("Success, wrote ($somecontent) to file ($filename)");

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