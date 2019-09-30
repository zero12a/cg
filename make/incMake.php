<?php


class makeObject
{
    private $DB;

	//생성자
	function __construct($tDb){

		alog("makeObject-__construct");

        $this->DB = $tDb;
        
	}
	//파괴자
	function __destruct(){
		alog("makeObject-__destruct");

        //메모리 비우기
		if($this->DB)$this->DB->close();
		unset($this->DB);
	}
	function __toString(){
		alog("makeObject-__toString");
    }


    //로그 저장
    function goMakeQueue($QueueValue){
        global $_SESSION, $CFG_AUTH_LOG;
        
        //RST 만들기.
        goJsD($OBJINFOD,$G,$arrFileList[$j]["MKFILETYPE"]);


        //040 DB추출해서 실제파일생성
        $rtnMap = saveFile2($arrFileList[$j]["MKFILETYPE"],$MAKE_FILE_NM);

        $REQ["FILEHASH"] = $rtnMap["FILEHASH"];
        $REQ["FILESIZE"] = $rtnMap["FILESIZE"];
        
        //alog("FILEHASH 1: " . $map["FILEHASH"]);

        //050 이전 결과파일은 ACTIVEYN = N으로 변경하기
        $map["FNCTYPE"] = "U";
        $map["SQL"]["U"]["SVRID"] = $svrid;        
		$map["SQL"]["U"]["BINDTYPE"] = "iis";
		$map["SQL"]["U"]["SQLTXT"] = "
        update CG_RSTFILE set
            ACTIVEYN = 'N', MODDT = date_format(NOW(),'%Y%m%d%H%i%s') 
        where PJTSEQ = #{PJTSEQ} and PGMSEQ = #{PGMSEQ} and FILETYPE = #{FILETYPE} 
            and ACTIVEYN = 'Y'
		";
		$REQ["FILETYPE"] = $arrFileList[$j]["MKFILETYPE"];
        $rtnVal = makeFormviewSaveJson($map,$db);
        
        //alog("FILEHASH 2: " . $map["FILEHASH"]);

		//060 CG_RSTFILE결과 파일 목록  추가
        $map["FNCTYPE"] = "C";
        $map["SQL"]["C"]["SVRID"] = $svrid;        
		$map["SQL"]["C"]["BINDTYPE"] = "iiiss sis";
		$map["SQL"]["C"]["SQLTXT"] = "
		insert into CG_RSTFILE (
			PJTSEQ, PGMSEQ, VERSEQ, FILETYPE, FILENM
            , ACTIVEYN, FILEHASH, FILESIZE, REQTYPE
            , ADDDT
		) values (
			#{PJTSEQ} ,#{PGMSEQ} ,#{VERSEQ} ,#{FILETYPE}, #{FILENM} 
            , 'Y', #{FILEHASH} , #{FILESIZE}, #{REQTYPE}
            , date_format(NOW(),'%Y%m%d%H%i%s') 
		)
		";
		$REQ["FILETYPE"] = $arrFileList[$j]["MKFILETYPE"];
        $REQ["FILENM"] = $MAKE_FILE_NM; 
        
        //alog("FILEHASH 3: " . $map["FILEHASH"]);        
        $rtnVal = makeFormviewSaveJson($map,$db);
        
        //070 프로그램 viewurl 업데이트
        if(($F_PGMTYPE == "" || $F_PGMTYPE == "HTML" ) && strlen($REQ["FILENM"])>4){

            $REQ["FILENM"] = $MAKE_FILE_NM_NO_EXT; // view url용

            $map["FNCTYPE"] = "U";
            $map["SQL"]["U"]["SVRID"] = $svrid;            
            $map["SQL"]["U"]["BINDTYPE"] = "si";
            $map["SQL"]["U"]["SQLTXT"] = "     
                update CG_PGMINFO set 
                    VIEWURL = #{FILENM}
                    , MODDT = date_format(NOW(),'%Y%m%d%H%i%s') 
                where PGMSEQ = #{PGMSEQ}
            ";
            alog("#################뷰 파일명 변경됨 : " . $REQ["FILETYPE"] . "/" . $REQ["FILENM"]);
            $rtnVal = makeFormviewSaveJson($map,$db);
        }

                

        return $RtnVal;
    }
    


}//class