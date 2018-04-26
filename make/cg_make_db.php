<?php
/**
 * Created by PhpStorm.
 * User: zero12a
 * Date: 2014. 7. 3.
 * Time: 오전 5:03
 */

function saveRst($rsttxt){
	//mlog("saveRst---------------------------------------start");
    Global $db,$svrid,$F_PJTSEQ,$F_PGMSEQ,$RstCnt,$NowFileType, $F_VERSEQ;
    $RtnVal=null;
    $RstCnt = $RstCnt + 1;
    //echo "<br>RstCnt : " . $RstCnt;
    $T_SQL = sprintf("
        insert into CG_RST (
			PJTSEQ,PGMSEQ,FILETYPE,VERSEQ,SRCORD
			,SRCTXT,ADDDT
		) values (
            %d, %d, '%s', %d, %d
			, '%s', %s
        )
        "
        , $F_PJTSEQ
        , $F_PGMSEQ
        , $NowFileType
		, $F_VERSEQ
        , $RstCnt
        , addSqlSlashes($rsttxt)
        , "date_format(sysdate(),'%Y%m%d%H%i%s')"
    );
    //mlog("saveRst SQL : " . EOL . $T_SQL);
    //echo "<br> rsstxt : " . $rsttxt;
    //echo "<br> saveRst :  " . $T_SQL;
    $db[$svrid]->query($T_SQL) or ServerMsg("500","saveRst-100", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

    //$line2 = null;
    //$RtnVal = fetch_all($result2,MYSQLI_ASSOC);

    //$result2->close();
	//mlog("saveRst---------------------------------------end");

    return $RtnVal;
}


function isDbCache($sql){
    Global $dbCache,$reqToken,$redis;    
    //alog("isDbCache()...........hash:" . $reqToken.sha1($sql));     
    //alog("  is_null :" . is_null( $redis->get( sha1($sql) ) ) ) ;   


    
    if( $reqToken !="" ){
        //redis 뒤지기
        return ( $redis->exists($reqToken.sha1($sql)) == 1 ? true:false );
    }else{
        return ( $dbCache[sha1($sql)] != null ? true:false ) ;
    }
	
}

function getDbCache($sql){
	Global $dbCache,$reqToken,$redis;    
    //alog("getDbCache()...........hash:" . $reqToken.sha1($sql));    

	//rlog("getDbCache 1: " . $sql);
	//rlog("getDbCache 2: " . sha1($sql));

    if( $reqToken !="" ){
        //alog("getDbCache()...........hash:" . $reqToken.sha1($sql)); 
        //redis 뒤지기
        $tarr = json_decode($redis->get($reqToken.sha1($sql)),true);//true옵션 없으면 stdClass로 변환됨    
        $tarr["HIT"]++;
        //alog("      ttl:" . $redis->ttl($reqToken.sha1($sql)) );  
        //$redis->set($reqToken.sha1($sql),json_encode($tarr)); //세팅하면 expire가 초기화 되므로, 다시 expire세팅 해줘야 함.
        //$redis->expire($reqToken.sha1($sql),30);
        return $tarr["DATA"]; 
    }else{
        $dbCache[sha1($sql)]["HIT"]++;
        return $dbCache[sha1($sql)]["DATA"];
    }

}

function putDbCache($sql,$data){
    Global $dbCache,$reqToken,$redis;    
    //alog("putDbCache()...........hash:" . $reqToken.sha1($sql));

    
    $tarr = array("HIT"=>0, "DATA"=>$data);

    if( $reqToken !="" ){
        //redis 뒤지기
        $redis->set($reqToken.sha1($sql),json_encode($tarr));
        $redis->expire($reqToken.sha1($sql),30);
    }else{
        $dbCache[sha1($sql)] = $tarr;
    }
}




function getInput($input,$filetype,$param,$G){
    Global $db,$svrid,$F_PJTSEQ,$F_PGMSEQ;
    $AddSql = "";
    $RtnVal = null;
    $tarr = null;
    $paramCnt = 0;
    $TempCnt = 0;
    //$TmpVal=null;
	mlog("getinput ----------------------------------start");
    mlog("	input : " . $input . ", filetype : " . $filetype .  ", param : " . $param);
    //echo "<br>      param : " . $param;
    //mlog("	strpos && : " . strpos($param,"&&") );
    //echo "<br>      strpos || : " . strpos($param,"||");
    if(strpos($param,"&&") > 0){
        $tarr = explode("&&",$param);
        $toper = " and ";
    }else  if(strpos($param,"||") > 0){
        $tarr = explode("||",$param);
        $toper = " or ";
    }
    //echo "<br><font color=blue>";
    //var_dump($tarr);
    //echo "</font>";
    //echo "<br>      is_null tarr : " . is_null($tarr);
    //echo "<br>      is_array tarr : " . is_array($tarr);
    if(!is_null($tarr) && is_array($tarr)){
	    //mlog("	param : 멀티");

        //echo "<br> 111111111";
        for($u=0;$u<sizeof($tarr);$u++){
            $tval = $tarr[$u];

            if(strpos($tval,"!=") > 0 ){
                list($col,$val) = explode("!=",$tval);
                $col = trim($col);
                $val = trim($val);
                
                if($col != "")    {
                    if($paramCnt > 0) $AddSql .= $toper;
                    if(strtoupper($val) == "NULL"){
                        $AddSql .= sprintf(" (%s is not null or %s = '') ", $col,$col);
                    }else{
                        $AddSql .= sprintf(" %s != '%s' ", $col, $val);
                    }
                    $paramCnt++;
                }
            }else if(strpos($tval,"=") > 0 ) {
                list($col,$val) = explode("=",$tval);
                $col = trim($col);
                $val = trim($val);
                
                if($col != "")    {
                    if($paramCnt > 0) $AddSql .= $toper;
                    if(strtoupper($val) == "NULL"){
                        $AddSql .= sprintf(" (%s is null or %s = '') ", $col,$col);
                    }else if(strtoupper($val) == "NOT NULL") {
                        $AddSql .= sprintf(" (%s is not null and %s != '') ", $col, $col);
                    }else{
                        $AddSql .= sprintf(" %s = '%s' ", $col, $val);
                    }
                    $paramCnt++;
                }
            }else{
                mlog("PARAM의 = 또는 != 문법이 잘못되었습니다.");
            }

        }

    }else{

	    //mlog("	param : 싱글");
        if(strpos($param,"!=") > 0 ){
            list($col,$val) = explode("!=",$param);
            $col = trim($col);
            $val = trim($val);
                        
            if($col != "")    {
                if($paramCnt > 0) $AddSql .= $toper;
                if(strtoupper($val) == "NULL"){
                    $AddSql .= sprintf(" (%s is not null or %s = '') ", $col,$col);
                }else{
                    $AddSql .= sprintf(" %s != '%s' ", $col, $val);
                }
                $paramCnt++;
            }
        }else if(strpos($param,"=") > 0 ) {
            list($col,$val) = explode("=",$param);
            $col = trim($col);
            $val = trim($val);
                        
            if($col != "")    {
                if($paramCnt > 0) $AddSql .= $toper;
                if(strtoupper($val) == "NULL"){
                    $AddSql .= sprintf(" (%s is null or %s = '') ", $col,$col);
                }else if(strtoupper($val) == "NOT NULL") {
                    $AddSql .= sprintf(" (%s is not null and %s != '') ", $col, $col);
                }else{
                    $AddSql .= sprintf(" %s = '%s' ", $col, $val);
                }
                $paramCnt++;
            }
        }else if( strlen($param) > 0 ){
            mlog("PARAM의 = 또는 != 문법이 잘못되었습니다.");
        }
    }
    //mlog("	paramCnt : " . $paramCnt);
	//mlog("	AddSql 1 : " . $AddSql);

    if($filetype != "" && $input != "PGMSQL" && $input != "PGMGRP" && $input != "PGMFNC" 
        && $input != "PGMIO.SEQYN" && $input != "PJTCFG" && $input != "PGMIO.SVC"
        && $input != "PGMSQLD.HINT"
        ){
		if($paramCnt >= 1){
			$AddSql = " and FILETYPE = '" . $filetype. "' and (" . $AddSql . ")";
		}else{
			$AddSql = " and FILETYPE = '" . $filetype . "' ";
		}
	}else{
		if($paramCnt >= 1)$AddSql = " and (" . $AddSql . ")";
	}
	//mlog("	AddSql 2 : " . $AddSql);
    //echo "<br> addsql : " . $AddSql;




    //echo "<br> getInput : " . $input;
    if($input == "PJTFILE"){
        $T_SQL = sprintf("
                SELECT 
				* 
				FROM CG_PJTFILE
				WHERE PJTSEQ = %d and USEYN='Y'
                %s
				ORDER BY FILEORD ASC
                "
            ,addSqlSlashes($F_PJTSEQ)
            ,$AddSql
        );
        //echo "<br>getInput :  ". $T_SQL;
		if(isDbCache($T_SQL))return getDbCache($T_SQL); //#############################캐쉬#######################
        $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","130", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

        //$line2 = null;
        $RtnVal = fetch_all($result,MYSQLI_ASSOC);
        //if($RtnVal =  $result->fetch_assoc()  ){}
        $result->close();

    }else if($input == "PGMPARAM"){
        $T_SQL = sprintf("
                SELECT
                 *
                FROM CG_PGMPARAM
                WHERE PJTSEQ = %d AND PGMSEQ = %d AND GRPSEQ = %d AND FNCSEQ = %d
                %s
				ORDER BY PARAMORD ASC
                "
            ,addSqlSlashes($F_PJTSEQ)
            ,addSqlSlashes($F_PGMSEQ)
            ,$G["G"]["GRPSEQ"]
            ,$G["G"]["FNCSEQ"]
            ,$AddSql
        );
        //echo "<br>getInput :  ". $T_SQL;
		if(isDbCache($T_SQL))return getDbCache($T_SQL); //#############################캐쉬#######################
        $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","139", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

        //$line2 = null;
        $RtnVal = fetch_all($result,MYSQLI_ASSOC);
        //if($RtnVal =  $result->fetch_assoc()  ){}
        $result->close();

    }else if($input == "CODED"){
        $T_SQL = sprintf("
                SELECT
                  CD AS NM
                  ,CDVAL AS VAL
                FROM CG_CODED
                WHERE PJTSEQ = %d
                %s
                "
            ,addSqlSlashes($F_PJTSEQ)
            ,$AddSql
        );
        //echo "<br>getInput :  ". $T_SQL;
		if(isDbCache($T_SQL))return getDbCache($T_SQL); //#############################캐쉬#######################
        $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","140", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

        //$line2 = null;
        $RtnVal = fetch_all($result,MYSQLI_ASSOC);
        //if($RtnVal =  $result->fetch_assoc()  ){}
        $result->close();

    }else if($input == "OBJINFO"){
        $T_SQL = sprintf("
                SELECT
                  OBJTYPE AS OBJTYPE
                  ,LBLTXT AS LBLTXT
                  ,OBJTXT AS OBJTXT
                FROM CG_OBJINFO
                WHERE PJTSEQ = %d
                %s
                "
            ,addSqlSlashes($F_PJTSEQ)
            ,$AddSql
        );
        mlog("SQL (input " . $input . ") : " .$T_SQL);
        //echo "<br>getInput :  ". $T_SQL;
		if(isDbCache($T_SQL))return getDbCache($T_SQL); //#############################캐쉬#######################
        $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","152", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

        //$line2 = null;
        $RtnVal = fetch_all($result,MYSQLI_ASSOC);
        //if($RtnVal =  $result->fetch_assoc()  ){}
        $result->close();

    }else if($input == "BODYINIT"
        ||$input == "AJS" ||$input == "AHTML"||$input == "ASVRDAO"||$input == "ASVRCTL"||$input == "ASVRUFI"||$input == "ASVRSVC"
		||$input == "JHTML"||$input == "JSVRDAO"||$input == "JSVRCTL"||$input == "JSVRUFI"||$input == "JSVRSVC"||$input == "JSVRSQL"
		){
        $T_SQL = sprintf("
                SELECT
                  a.*
                FROM CG_OBJINFOD a
					join CG_PJTINFO b on a.PJTSEQ = b.PJTSEQ
                WHERE b.PJTSEQ = %d and a.OBJTYPE = '%s'
                %s
                ORDER BY OBJDORD ASC
                "
            ,addSqlSlashes($F_PJTSEQ)
			,$input
            ,$AddSql
        );
        //echo "<br>getInput :  ". $T_SQL;
		if(isDbCache($T_SQL))return getDbCache($T_SQL); //#############################캐쉬#######################
        $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","161", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

        //$line2 = null;
        $RtnVal = fetch_all($result,MYSQLI_ASSOC);
        //if($RtnVal =  $result->fetch_assoc()  ){}
        $result->close();

    }else if($input == "IMPORTCSS" || $input == "IMPORTJS" || $input == "HEADSTYLE"){
        $T_SQL = sprintf("
                SELECT
                  distinct b.SRCTXT as SRCTXT, '' as SPTTXT
                FROM CG_PGMIO a join CG_OBJINFOD b on a.OBJTYPE = b.OBJTYPE and a.PJTSEQ = b.PJTSEQ
                WHERE a.PJTSEQ = %d and b.OBJVALTYPE = '%s'
                %s
                ORDER BY OBJDORD ASC
                "
            ,addSqlSlashes($F_PJTSEQ)
            ,$input
            ,$AddSql
        );
        //echo "<font color=red><br>getInput :  ". $T_SQL ."</font>";
		if(isDbCache($T_SQL))return getDbCache($T_SQL); //#############################캐쉬#######################
        $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","171", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

        //$line2 = null;
        $RtnVal = fetch_all($result,MYSQLI_ASSOC);
        //if($RtnVal =  $result->fetch_assoc()  ){}
        $result->close();

    }else if($input == "PJTCFG"){
        $T_SQL = sprintf("
                SELECT
					* 
                FROM CG_PJTCFG
                WHERE PJTSEQ = %d and USEYN='Y' %s
                ORDER BY CFGORD ASC
                "
            ,addSqlSlashes($F_PJTSEQ)
            ,$AddSql
        );
        //echo "<font color=red><br>getInput :  ". $T_SQL ."</font>";
		if(isDbCache($T_SQL))return getDbCache($T_SQL); //#############################캐쉬#######################
        $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","171", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

        //$line2 = null;
        $RtnVal = fetch_all($result,MYSQLI_ASSOC);
        //if($RtnVal =  $result->fetch_assoc()  ){}
        $result->close();

    }else if($input == "OBJINFOD"){
        $T_SQL = sprintf("
                SELECT
                  *
                FROM CG_OBJINFOD
                WHERE PJTSEQ = %d and OBJTYPE = '%s'
                %s
                ORDER BY OBJDORD ASC
                "
            ,addSqlSlashes($F_PJTSEQ)
            ,$G["G"]["GRPTYPE"]
            ,$AddSql
        );
        //mlog("SQL (input " . $input . ") : " .$T_SQL);
		if(isDbCache($T_SQL))return getDbCache($T_SQL); //#############################캐쉬#######################
        $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","181", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

        //$line2 = null;
        $RtnVal = fetch_all($result,MYSQLI_ASSOC);
        //if($RtnVal =  $result->fetch_assoc()  ){}
        $result->close();

    }else if($input == "PGMGRP.FNC.OBJD"){
        $T_SQL = sprintf("
                select CASE WHEN e.IO_FILE_CNT IS NULL THEN 'N' ELSE 'Y' END  AS IO_FILE_YN,a.*,b.*,c.*
				from 
                    CG_PGMGRP a 
                    left outer join 
                        (   SELECT GRPSEQ, COUNT(IOSEQ) AS IO_FILE_CNT 
                            FROM CG_PGMIO 
                            WHERE PJTSEQ = %d AND PGMSEQ=%d  AND OBJTYPE='FILE' 
                            GROUP BY GRPSEQ
                        ) e on e.GRPSEQ = a.GRPSEQ
					join CG_PGMFNC b on a.GRPSEQ = b.GRPSEQ and a.PGMSEQ = %d and b.PGMSEQ = %d
                    join CG_OBJINFOD c on a.GRPTYPE = c.OBJTYPE and b.FNCCD = c.OBJVAL
                where  a.PJTSEQ = %d and b.PJTSEQ = %d and c.PJTSEQ = %d %s order by GRPORD asc "
            ,addSqlSlashes($F_PJTSEQ)
            ,addSqlSlashes($F_PGMSEQ)
            ,addSqlSlashes($F_PGMSEQ)
            ,addSqlSlashes($F_PGMSEQ)
			,addSqlSlashes($F_PJTSEQ)
			,addSqlSlashes($F_PJTSEQ)
			,addSqlSlashes($F_PJTSEQ)
			,$AddSql
        );
        //mlog("SQL 339 (input " . $input . ") : " .$T_SQL);
        //echo "<br>getInput :  ". $T_SQL;
		if(isDbCache($T_SQL))return getDbCache($T_SQL); //#############################캐쉬#######################
        $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","190", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

        //$line2 = null;
        $RtnVal = fetch_all($result,MYSQLI_ASSOC);
        $result->close();

    }else if($input == "PGMGRP"){
        $T_SQL = sprintf("
                select g.*, cd.NM as COLSIZETYPE_CDVAL, if(io.ROWCHECK_YN is null,'N','Y') as ROWCHECK_YN
                from CG_PGMGRP g
                    left outer join CG_CODED cd on g.PJTSEQ = cd.PJTSEQ and g.COLSIZETYPE = cd.CD and cd.PCD = 'COLSIZETYPE'
                    left outer join
                        ( select GRPSEQ,if(count(IOSEQ)>0,'Y','N') as ROWCHECK_YN from CG_PGMIO where PJTSEQ = %d and PGMSEQ = %d and OBJTYPE='ROWCHECK' group by GRPSEQ ) io
                        on g.GRPSEQ = io.GRPSEQ
                where g.PJTSEQ = %d and g.PGMSEQ = %d %s order by g.GRPORD asc "
            ,addSqlSlashes($F_PJTSEQ)
            ,addSqlSlashes($F_PGMSEQ)                
            ,addSqlSlashes($F_PJTSEQ)
            ,addSqlSlashes($F_PGMSEQ)
            ,$AddSql
        );
        //mlog("SQL 415 (input " . $input . ") : " .$T_SQL);
		if(isDbCache($T_SQL))return getDbCache($T_SQL); //#############################캐쉬#######################
        $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","200", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

        //$line2 = null;
        $RtnVal = fetch_all($result,MYSQLI_ASSOC);
        $result->close();

    }else if($input == "PGMFNC"){
        $T_SQL = sprintf("
                select * from CG_PGMFNC where PJTSEQ = %d and PGMSEQ = %d and GRPSEQ = %d %s order by FNCORD asc "
            ,addSqlSlashes($F_PJTSEQ)
            ,addSqlSlashes($F_PGMSEQ)
            ,addSqlSlashes($G["G"]["GRPSEQ"])
            ,$AddSql
        );
        //mlog("SQL (input " . $input . ") : " .$T_SQL);
		if(isDbCache($T_SQL))return getDbCache($T_SQL); //#############################캐쉬#######################
        $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","210", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

        //$line2 = null;
        $RtnVal = fetch_all($result,MYSQLI_ASSOC);
        $result->close();

    }else if($input == "PGMFNC.DIRECT"){
		//프로그램에서 PGMGRP접근없이 다로 FNC로 접근
        $T_SQL = sprintf("
			select * 
			from 
				CG_PGMGRP a
				join CG_PGMFNC b on a.PJTSEQ = b.PJTSEQ and a.PGMSEQ = b.PGMSEQ and a.GRPSEQ = b.GRPSEQ
			where a.PJTID = '%s' and a.PGMID = '%s' 
			order by a.GRPORD asc, b.FNCORD asc
				"
            ,addSqlSlashes($F_PJTSEQ)
            ,addSqlSlashes($F_PGMSEQ)
        );
        //mlog("SQL (input " . $input . ") : " .$T_SQL);
		if(isDbCache($T_SQL))return getDbCache($T_SQL); //#############################캐쉬#######################
        $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","210", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

        //$line2 = null;
        $RtnVal = fetch_all($result,MYSQLI_ASSOC);
        $result->close();

    }else if($input == "PGMGRP.CHILD"){
        $T_SQL = sprintf("
            select * from CG_PGMGRP
            where PJTSEQ = '%s' and PGMSEQ = '%s' and REFGRPID = '%s'
            order by GRPORD asc
            "
            ,addSqlSlashes($F_PJTSEQ)
            ,addSqlSlashes($F_PGMSEQ)
            ,$G["G"]["GRPID"]
        );
        //echo "<br>getInput :  ". $T_SQL;
		if(isDbCache($T_SQL))return getDbCache($T_SQL); //#############################캐쉬#######################
        $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","220", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

        //$line2 = null;
        $RtnVal = fetch_all($result,MYSQLI_ASSOC);
        //$RtnVal = fetch_all($result,MYSQLI_ASSOC);
        $result->close();

    }else if($input == "PGMGRP.REF"){
        $T_SQL = sprintf("
            select * from CG_PGMGRP
            where PJTSEQ = %d and PGMSEQ = %d and REFGRPID = '%s' order by GRPORD asc
            "
            ,addSqlSlashes($F_PJTSEQ)
            ,addSqlSlashes($F_PGMSEQ)
            ,$G["G"]["GRPID"]
        );
        //mlog("SQL 120 (input " . $input . ") : " .$T_SQL);
		if(isDbCache($T_SQL))return getDbCache($T_SQL); //#############################캐쉬#######################
        $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","230", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

        //$line2 = null;
        $RtnVal = fetch_all($result,MYSQLI_ASSOC);
        //$RtnVal = fetch_all($result,MYSQLI_ASSOC);
        $result->close();

    }else if($input == "PGMFNC.OBJD"){
        $T_SQL = sprintf("
            select a.*,b.GRPTYPE,c.*
            from CG_PGMFNC a 
				join CG_PGMGRP b on a.PJTSEQ = b.PJTSEQ and a.PGMSEQ = b.PGMSEQ and a.GRPSEQ = b.GRPSEQ
				join CG_OBJINFOD c on b.GRPTYPE = c.OBJTYPE and a.PJTSEQ = b.PJTSEQ and a.FNCCD = c.OBJVAL
            where a.PJTSEQ = %d and a.PGMSEQ = %d and a.GRPSEQ = %d %s order by FNCORD asc
            "
            ,addSqlSlashes($F_PJTSEQ)
            ,addSqlSlashes($F_PGMSEQ)
            ,addSqlSlashes($G["G"]["GRPSEQ"])
	        ,$AddSql
        );
        //mlog("SQL (input " . $input . ") : " .$T_SQL);
		if(isDbCache($T_SQL))return getDbCache($T_SQL); //#############################캐쉬#######################
        $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","241", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

        //$line2 = null;
        $RtnVal = fetch_all($result,MYSQLI_ASSOC);
        //$RtnVal = fetch_all($result,MYSQLI_ASSOC);
        $result->close();

    }else if($input == "PGMSVC.LIST"){
		//그룹의 기능의 서비스목록 가져오기
        $T_SQL = sprintf("
            select a.SVCSEQ,a.SVCGRPID,b.GRPNM
            from 
				CG_PGMSVC a
				join CG_PGMGRP b on a.PJTSEQ= b.PJTSEQ and a.PGMSEQ = b.PGMSEQ and a.SVCGRPID = b.GRPID
			where a.PJTSEQ = '%s' and a.PGMSEQ = '%s' and a.GRPSEQ = '%s' and a.FNCSEQ = '%s' %s
            "
            ,addSqlSlashes($F_PJTSEQ)
            ,addSqlSlashes($F_PGMSEQ)
            ,addSqlSlashes($G["G"]["GRPSEQ"])
            ,addSqlSlashes($G["F"]["FNCSEQ"])
	        ,$AddSql
        );
        //mlog("SQL (input " . $input . ") : " .$T_SQL);
		if(isDbCache($T_SQL))return getDbCache($T_SQL); //#############################캐쉬#######################
        $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","242", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

        //$line2 = null;
        $RtnVal = fetch_all($result,MYSQLI_ASSOC);
        //$RtnVal = fetch_all($result,MYSQLI_ASSOC);
        $result->close();

    }else if($input == "PGMSVC.OBJD"){
		//현재 FNC에 해당하는 서버 서비스 그룹별 서버 처리 소스 조회
        $T_SQL = sprintf("
            select a.SVCSEQ,a.SVCGRPID,b.GRPSEQ,b.GRPNM,c.FNCID,c.FNCNM,d.*
            from 
				CG_PGMSVC a
				join CG_PGMGRP b on a.PJTSEQ= b.PJTSEQ and a.PGMSEQ = b.PGMSEQ and a.SVCGRPID = b.GRPID
				join CG_PGMFNC c on a.PJTSEQ= c.PJTSEQ and a.PGMSEQ = c.PGMSEQ and a.GRPSEQ = c.GRPSEQ and a.FNCSEQ = c.FNCSEQ
				left join CG_OBJINFOD d on a.PJTSEQ = d.PJTSEQ and b.GRPTYPE = d.OBJTYPE and c.FNCCD = d.OBJVAL
			where a.PJTSEQ = %d and a.PGMSEQ = %d and a.GRPSEQ = %d and a.FNCSEQ = %d %s
            "
            ,addSqlSlashes($F_PJTSEQ)
            ,addSqlSlashes($F_PGMSEQ)
            ,addSqlSlashes($G["G"]["GRPSEQ"])
            ,addSqlSlashes($G["F"]["FNCSEQ"])
	        ,$AddSql
        );
        //mlog("SQL (input " . $input . ") : " .$T_SQL);
		if(isDbCache($T_SQL))return getDbCache($T_SQL); //#############################캐쉬#######################
        $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","243", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

        //$line2 = null;
        $RtnVal = fetch_all($result,MYSQLI_ASSOC);
        //$RtnVal = fetch_all($result,MYSQLI_ASSOC);
        $result->close();

    }else if($input == "PGMSVC.OBJD.JS"){
		//현재 그룹의 기능의 SVCGRP OBJ가져오기
        $T_SQL = sprintf("
	    select CASE WHEN e.IO_FILE_CNT IS NULL THEN 'N' ELSE 'Y' END  AS IO_FILE_YN,a.SVCSEQ,a.SVCGRPID,b.GRPSEQ,b.GRPID,b.GRPNM,c.FNCID,c.FNCNM,d.*
            from 
				CG_PGMSVC a
                join CG_PGMGRP b on a.PJTSEQ= b.PJTSEQ and a.PGMSEQ = b.PGMSEQ and a.SVCGRPID = b.GRPID
                left outer join (SELECT GRPSEQ, COUNT(IOSEQ) AS IO_FILE_CNT FROM CG_PGMIO WHERE PJTSEQ = %d AND PGMSEQ=%d  AND OBJTYPE='FILE' GROUP BY GRPSEQ) e on e.GRPSEQ = b.GRPSEQ
				join CG_PGMFNC c on a.PJTSEQ= c.PJTSEQ and a.PGMSEQ = c.PGMSEQ and a.GRPSEQ = c.GRPSEQ and a.FNCSEQ = c.FNCSEQ
				join CG_OBJINFOD d on a.PJTSEQ = d.PJTSEQ and b.GRPTYPE = d.OBJTYPE 
			where a.PJTSEQ = %d and a.PGMSEQ = %d and a.GRPSEQ = %d and a.FNCSEQ = %d    %s
            "
            ,addSqlSlashes($F_PJTSEQ)
            ,addSqlSlashes($F_PGMSEQ)
            ,addSqlSlashes($F_PJTSEQ)
            ,addSqlSlashes($F_PGMSEQ)
            ,addSqlSlashes($G["G"]["GRPSEQ"])
            ,addSqlSlashes($G["G"]["FNCSEQ"]) //G에서 바로 F거치지 않고 SVC로 간 경우 G로해서 접근해야 함 
	        ,$AddSql
        );
        //mlog("SQL 526 (input " . $input . ") : " .$T_SQL);
		if(isDbCache($T_SQL))return getDbCache($T_SQL); //#############################캐쉬#######################
        $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","244", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

        //$line2 = null;
        $RtnVal = fetch_all($result,MYSQLI_ASSOC);
        //$RtnVal = fetch_all($result,MYSQLI_ASSOC);
        $result->close();

    }else if($input == "PGMGRP.OBJ"){
        $T_SQL = sprintf("
            select a.*,b.*
            from CG_PGMGRP a join CG_OBJINFO b on a.GRPTYPE = b.OBJTYPE and a.PJTSEQ = b.PJTSEQ
            where a.PJTSEQ = %d and a.PGMSEQ = %d order by GRPORD asc
            "
            ,addSqlSlashes($F_PJTSEQ)
            ,addSqlSlashes($F_PGMSEQ)
        );
        //mlog("SQL (input " . $input . ") : " .$T_SQL);
        //echo "<br>getInput :  ". $T_SQL;
		if(isDbCache($T_SQL))return getDbCache($T_SQL); //#############################캐쉬#######################
        $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","250", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

        //$line2 = null;
        $RtnVal = fetch_all($result,MYSQLI_ASSOC);
        //$RtnVal = fetch_all($result,MYSQLI_ASSOC);
        $result->close();

    }else if($input == "PGMGRP.OBJD"){
        $T_SQL = sprintf("
            select a.*,b.*,cd.CDVAL as COLSIZETYPE_CDVAL
            from CG_PGMGRP a 
                join CG_OBJINFOD b on a.GRPTYPE = b.OBJTYPE and a.PJTSEQ = b.PJTSEQ
                left outer join CG_CODED cd on a.PJTSEQ = cd.PJTSEQ and a.COLSIZETYPE = cd.CD and cd.PCD = 'COLSIZETYPE'            
            where a.PJTSEQ = %d and a.PGMSEQ = %d %s 
			order by a.GRPORD asc, b.OBJDORD asc
            "
            ,addSqlSlashes($F_PJTSEQ)
            ,addSqlSlashes($F_PGMSEQ)
	        ,$AddSql
        );
        //mlog("SQL 624  (input " . $input . ") : " .$T_SQL);
        //echo "<br>getInput :  ". $T_SQL;
		if(isDbCache($T_SQL))return getDbCache($T_SQL); //#############################캐쉬#######################
        $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","260", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

        //$line2 = null;
        $RtnVal = fetch_all($result,MYSQLI_ASSOC);
        //$RtnVal = fetch_all($result,MYSQLI_ASSOC);
        $result->close();

    }else if($input == "CONDITION.REF"){
        $T_SQL = sprintf("
            select * from CG_PGMGRP where PJTSEQ = %d and PGMSEQ = %d
            and REFGRPID = ( select GRPID from CG_PGMGRP where PJTSEQ = %d and PGMSEQ = %d and GRPTYPE = 'CONDITION' )
            order by GRPORD asc
            "
            ,addSqlSlashes($F_PJTSEQ)
            ,addSqlSlashes($F_PGMSEQ)
            ,addSqlSlashes($F_PJTSEQ)
            ,addSqlSlashes($F_PGMSEQ)
        );
        //echo "<br>getInput :  ". $T_SQL;
		if(isDbCache($T_SQL))return getDbCache($T_SQL); //#############################캐쉬#######################
        $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","270", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

        //$line2 = null;
        $RtnVal = fetch_all($result,MYSQLI_ASSOC);
        //$RtnVal = fetch_all($result,MYSQLI_ASSOC);
        $result->close();

    }else if($input == "PGMINFO"){
        //IO_SAFEHTML_YN가 Y일때만 PURIFIER라이브러리 로딩 처리
        $T_SQL = sprintf("
            select a.*,b.*,e.IO_SAFEHTML_YN
			from 
				CG_PJTINFO a 
                join CG_PGMINFO b on a.PJTSEQ = %d and b.PGMSEQ = %d and a.PJTSEQ = b.PJTSEQ
                join ( 
                        select if(count(IOSEQ)>0,'Y','N') as IO_SAFEHTML_YN from CG_PGMIO c 
                            join CG_VALID d on c.PJTSEQ = %d and c.PJTSEQ = d.PJTSEQ and c.PGMSEQ = %d 
                                and c.VALIDSEQ = d.VALIDSEQ
                                and d.VALIDTYPE='SAFEHTML'
                    ) e
            "
            ,$F_PJTSEQ
            ,$F_PGMSEQ
            ,$F_PJTSEQ
            ,$F_PGMSEQ            
        );
        //mlog("F_PJTSEQ: " .addSqlSlashes($F_PJTSEQ));
        //mlog("F_PGMSEQ: " .addSqlSlashes($F_PGMSEQ));
        //mlog("SQL 673 (input " . $input . ") : " .$T_SQL);
        //echo "<br>getInput :  ". $T_SQL;
		if(isDbCache($T_SQL))return getDbCache($T_SQL); //#############################캐쉬#######################
		$result = $db[$svrid]->query($T_SQL) or ServerMsg("500","280", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

        //$line2 = null;
        if($RtnVal =  $result->fetch_assoc()  ){}
        //$RtnVal = fetch_all($result,MYSQLI_ASSOC);
        $result->close();


    }else if($input == "PGMIO"){
        $T_SQL = sprintf("
            select
              a.*
			  ,ifnull(bc.CDVAL,'') as CONDITION_CDVAL
			  ,ifnull(bg.CDVAL,'') as GRID_CDVAL
              ,ifnull(bf.CDVAL,'') as FORMVIEW_CDVAL
			  ,ifnull(bc.CDVAL2,'') as CONDITION_CDVAL2
			  ,ifnull(bg.CDVAL2,'') as GRID_CDVAL2
              ,ifnull(bf.CDVAL2,'') as FORMVIEW_CDVAL2
              ,case when ifnull(bg.CDVAL2,'') = '' then a.COLNM else bg.CDVAL2 end as GRID_CDVAL2_COLNM   
              ,ifnull(oalign.CDVAL,'') as OBJALIGN_CDVAL            
              ,ifnull(csort.CDVAL,'') as COLSORT_CDVAL 
              ,dd.CRYPTCD as DD_CRYPTCD       
              ,crypt.CDVAL as DD_CRYPTCD_CDVAL     
              ,crypt.CDVAL2 as DD_CRYPTCD_CDVAL2    
              ,vld.VALIDTYPE as VALID_VALIDTYPE
              ,vld.MATSTR as VALID_MATSTR
              ,pop.POPWIDTH as POP_WIDTH
              ,pop.POPHEIGHT as POP_HEIGHT    
              ,pop.VIEWURL as POP_URL                   
            from CG_PGMIO a
                left outer join CG_CODED bc on a.OBJTYPE = bc.CD and bc.PCD='CTCONDITION'	and a.PJTSEQ = bc.PJTSEQ
                left outer join CG_CODED bg on a.OBJTYPE = bg.CD and bg.PCD='CTGRID'		and a.PJTSEQ = bg.PJTSEQ
                left outer join CG_CODED bf on a.OBJTYPE = bf.CD and bf.PCD='CTFORMVIEW'	and a.PJTSEQ = bf.PJTSEQ
                left outer join CG_CODED oalign on a.OBJALIGN = oalign.CD and oalign.PCD='OBJALIGN'	and a.PJTSEQ = oalign.PJTSEQ      
                left outer join CG_CODED csort on a.DATATYPE = csort.CD and csort.PCD='COLSORT'	and a.PJTSEQ = csort.PJTSEQ    
                left outer join ( select COLID,CRYPTCD FROM CG_DD where PJTSEQ = %d ) dd on a.COLID = dd.COLID    
                left outer join CG_CODED crypt on dd.CRYPTCD = crypt.CD and crypt.PCD='CRYPT'	and a.PJTSEQ = crypt.PJTSEQ   
                left outer join CG_VALID vld on a.VALIDSEQ = vld.VALIDSEQ and a.PJTSEQ = vld.PJTSEQ 
                left outer join CG_PGMINFO pop on a.PJTSEQ = pop.PJTSEQ and a.POPUP = pop.PGMID                                
            where a.PJTSEQ = %d and a.PGMSEQ = %d and a.GRPSEQ = %d %s
			order by a.COLORD asc
            "
            ,addSqlSlashes($F_PJTSEQ)
            ,addSqlSlashes($F_PJTSEQ)
            ,addSqlSlashes($F_PGMSEQ)
            ,$G["G"]["GRPSEQ"]
            ,$AddSql
        );
        alog("SQL 735 (input " . $input . ") : " .$T_SQL);

        //echo "<br>getInput $input :  ". $T_SQL;
		if(isDbCache($T_SQL))return getDbCache($T_SQL); //#############################캐쉬#######################
        $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","290", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

        //$line2 = null;
        $RtnVal = fetch_all($result,MYSQLI_ASSOC);
        //$RtnVal = fetch_all($result,MYSQLI_ASSOC);
        $result->close();

    }else if($input == "PGMIO.SVC"){
        $T_SQL = sprintf("
            select
              a.*
			  ,ifnull(bc.CDVAL,'') as CONDITION_CDVAL
			  ,ifnull(bg.CDVAL,'') as GRID_CDVAL
              ,ifnull(bf.CDVAL,'') as FORMVIEW_CDVAL
              ,dd.CRYPTCD as DD_CRYPTCD
            from CG_PGMIO a
                left outer join CG_CODED bc on a.OBJTYPE = bc.CD and bc.PCD='CTCONDITION'	and a.PJTSEQ = bc.PJTSEQ
                left outer join CG_CODED bg on a.OBJTYPE = bg.CD and bg.PCD='CTGRID'		and a.PJTSEQ = bg.PJTSEQ
                left outer join CG_CODED bf on a.OBJTYPE = bf.CD and bf.PCD='CTFORMVIEW'	and a.PJTSEQ = bf.PJTSEQ
                left outer join (SELECT COLID,CRYPTCD FROM CG_DD WHERE PJTSEQ = %d ) dd on a.COLID = dd.COLID 
            where a.PJTSEQ = %d and a.PGMSEQ = %d and a.GRPSEQ = %d %s
			order by COLORD asc
            "
            ,addSqlSlashes($F_PJTSEQ)
            ,addSqlSlashes($F_PJTSEQ)
            ,addSqlSlashes($F_PGMSEQ)
            ,$G["V"]["GRPSEQ"]
            ,$AddSql
        );
        //mlog("SQL 716 (input " . $input . ") : " .$T_SQL);

        //echo "<br>getInput $input :  ". $T_SQL;
		if(isDbCache($T_SQL))return getDbCache($T_SQL); //#############################캐쉬#######################
        $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","295", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

        //$line2 = null;
        $RtnVal = fetch_all($result,MYSQLI_ASSOC);
        //$RtnVal = fetch_all($result,MYSQLI_ASSOC);
        $result->close();

    }else if($input == "PGMIO.CHILD"){ //자식에게 내려줄 IO들 (부모1 자식N)
        $T_SQL = sprintf("
            select *
            from CG_PGMINHERIT
            where PJTSEQ = %d and PGMSEQ = %d and GRPSEQ = %d and CHILDGRPID = '%s' %s
            "
            ,addSqlSlashes($F_PJTSEQ)
            ,addSqlSlashes($F_PGMSEQ)
            ,$G["G"]["GRPSEQ"]
            ,$G["GR"]["GRPID"]
			,$AddSql
        );
        //mlog("SQL  (input " . $input . ") : " .$T_SQL);

        //echo "<br>getInput $input :  ". $T_SQL;
		if(isDbCache($T_SQL))return getDbCache($T_SQL); //#############################캐쉬#######################
        $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","300", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

        //$line2 = null;
        $RtnVal = fetch_all($result,MYSQLI_ASSOC);
        //$RtnVal = fetch_all($result,MYSQLI_ASSOC);
        $result->close();

    }else if($input == "PGMIO.PARENT"){ //부모에게서 받은 IO들 (부모1 자식1)
        $T_SQL = sprintf("
            select *
            from CG_PGMINHERIT
            where PJTSEQ = %d and PGMSEQ = %d and CHILDGRPID = '%s' %s
            "
            ,addSqlSlashes($F_PJTSEQ)
            ,addSqlSlashes($F_PGMSEQ)
            ,$G["G"]["GRPID"]
			,$AddSql
        );
        //mlog("SQL  (input " . $input . ") : " .$T_SQL);

        //echo "<br>getInput $input :  ". $T_SQL;
		if(isDbCache($T_SQL))return getDbCache($T_SQL); //#############################캐쉬#######################
        $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","310", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

        //$line2 = null;
        $RtnVal = fetch_all($result,MYSQLI_ASSOC);
        //$RtnVal = fetch_all($result,MYSQLI_ASSOC);
        $result->close();

    }else if($input == "PGMIO.ADDROWS"){ //부모로 부터 상속 받은 IO들
        $T_SQL = sprintf("
			select 
			  b.COLID as INHERITCOLID
			  ,case when b.COLID is null then '\"\"'
				 else concat('lastinput',c.GRPID,'json.',a.COLID)
				 end as  REALCOLID
			  ,a.* 
			from CG_PGMIO a 
			    left outer join CG_PGMINHERIT b
                    on a.PJTSEQ = b.PJTSEQ and a.PGMSEQ = b.PGMSEQ and b.CHILDGRPID = '%s'     and a.COLID = b.COLID
                left outer join CG_PGMGRP c on a.GRPSEQ = c.GRPSEQ
			where a.PJTSEQ = %d and a.PGMSEQ = %d and a.GRPSEQ = %d  %s
			order by COLORD asc
            "
            ,$G["G"]["GRPID"]            
			,addSqlSlashes($F_PJTSEQ)
            ,addSqlSlashes($F_PGMSEQ)
            ,$G["G"]["GRPSEQ"]
			,$AddSql
        );
        //mlog("SQL 811 (input " . $input . ") : " .$T_SQL);
		if(isDbCache($T_SQL))return getDbCache($T_SQL); //#############################캐쉬#######################
        $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","320", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

        //$line2 = null;
        $RtnVal = fetch_all($result,MYSQLI_ASSOC);
        //$RtnVal = fetch_all($result,MYSQLI_ASSOC);
        $result->close();

    }else if($input == "PGMIO.OBJ"){
        $T_SQL = sprintf("
            select
              a.*
              ,ifnull(b.CDVAL,'na') as COLSORT
              ,c.*
              ,dd.CRYPTCD as DD_CRYPTCD       
              ,crypt.CDVAL as DD_CRYPTCD_CDVAL     
              ,crypt.CDVAL2 as DD_CRYPTCD_CDVAL2                     
            from CG_PGMIO a
                left outer join CG_CODED b on a.DATATYPE = b.CD and b.PCD='GRIDSORT' and a.PJTSEQ = b.PJTSEQ
                join CG_OBJINFOD c on a.OBJTYPE = c.OBJTYPE and c.PJTSEQ = a.PJTSEQ
                left outer join ( select COLID,CRYPTCD FROM CG_DD where PJTSEQ = %d ) dd on a.COLID = dd.COLID    
                left outer join CG_CODED crypt on dd.CRYPTCD = crypt.CD and crypt.PCD='CRYPT'	and a.PJTSEQ = crypt.PJTSEQ                  
            where a.PJTSEQ = %d and a.PGMSEQ = %d and a.GRPSEQ = %d %s
			order by a.COLORD asc, a.COLID asc, c.OBJDORD asc
            "
            ,addSqlSlashes($F_PJTSEQ)            
            ,addSqlSlashes($F_PJTSEQ)
            ,addSqlSlashes($F_PGMSEQ)
            ,$G["G"]["GRPSEQ"]
            ,$AddSql
        );
        //alog("LINE 873 : SQL (input " . $input . ") : \n" .$T_SQL);
		if(isDbCache($T_SQL))return getDbCache($T_SQL); //#############################캐쉬#######################

        $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","330", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

        //$line2 = null;
        $RtnVal = fetch_all($result,MYSQLI_ASSOC);
        //$RtnVal = fetch_all($result,MYSQLI_ASSOC);
        $result->close();

    }else if($input == "PGMIO.OBJ.SVC"){
        $T_SQL = sprintf("
            select
              a.*
              ,b.*
            from CG_PGMIO a
                join CG_OBJINFOD b on a.OBJTYPE = b.OBJTYPE and a.PJTSEQ = b.PJTSEQ
            where a.PJTSEQ = %d and a.PGMSEQ = %d and a.GRPSEQ = %d %s
			order by a.COLORD asc, a.COLID asc
            "
            ,addSqlSlashes($F_PJTSEQ)
            ,addSqlSlashes($F_PGMSEQ)
            ,$G["V"]["GRPSEQ"]
            ,$AddSql
        );
        //mlog("SQL 190 (input " . $input . ") : " .$T_SQL);
		if(isDbCache($T_SQL))return getDbCache($T_SQL); //#############################캐쉬#######################

		$result = $db[$svrid]->query($T_SQL) or ServerMsg("500","335", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

        //$line2 = null;
        $RtnVal = fetch_all($result,MYSQLI_ASSOC);
        //$RtnVal = fetch_all($result,MYSQLI_ASSOC);
        $result->close();

    }else if($input == "PGMIO.CONDITION"){
        $T_SQL = sprintf("
            select
              a.*
              ,ifnull(b.CDVAL,'na') as COLSORT
            from CG_PGMIO a
              left outer join CG_CODED b on a.DATATYPE = b.CD and b.PCD='GRIDSORT' and a.PJTSEQ = b.PJTSEQ
            where a.PJTSEQ = %d and a.PGMSEQ = %d
              and a.GRPSEQ = (select GRPSEQ from CG_PGMGRP where PJTSEQ = %d and PGMSEQ = %d and GRPTYPE = 'CONDITION' )
              %s
            "
            ,addSqlSlashes($F_PJTSEQ)
            ,addSqlSlashes($F_PGMSEQ)
            ,addSqlSlashes($F_PJTSEQ)
            ,addSqlSlashes($F_PGMSEQ)
            ,$AddSql
        );
        //echo "<br>getInput $input :  ". $T_SQL;
		if(isDbCache($T_SQL))return getDbCache($T_SQL); //#############################캐쉬#######################

        $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","340", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

        //$line2 = null;
        $RtnVal = fetch_all($result,MYSQLI_ASSOC);
        //$RtnVal = fetch_all($result,MYSQLI_ASSOC);
        $result->close();

    }else if($input == "PGMIO.SEQYN"){
        $T_SQL = sprintf("
            select case when count(*)>0 then 'Y' else 'N' end as SEQYN
			from CG_PGMIO
			where 
				PJTSEQ = %d
				and PGMSEQ = %d
				and GRPSEQ = %d and SEQYN = 'Y' %s
            "
            ,addSqlSlashes($F_PJTSEQ)
            ,addSqlSlashes($F_PGMSEQ)
            ,$G["V"]["GRPSEQ"]
			,$AddSql
        );
        //mlog("SQL 853 (input " . $input . ") : " .$T_SQL);

        //echo "<br>getInput $input :  ". $T_SQL;
		if(isDbCache($T_SQL))return getDbCache($T_SQL); //#############################캐쉬#######################

        $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","3451", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

        //$line2 = null;
        $RtnVal = fetch_all($result,MYSQLI_ASSOC);
        //$RtnVal = fetch_all($result,MYSQLI_ASSOC);
        $result->close();

    }else if($input == "PGMIO.KEYCOL"){
        $T_SQL = sprintf("
            select COUNT(a.COLID)-1 as KEYCOLIDX,b.COLID as KEYCOLID
			from 
				CG_PGMIO a 
				join
				(
					SELECT COLORD,COLID
					FROM 
						CG_PGMIO 
					WHERE PJTSEQ = %d and PGMSEQ = %d and GRPSEQ = %d and KEYYN='Y'
					LIMIT 1
				) b
			where a.PJTSEQ = %d and a.PGMSEQ = %d and a.GRPSEQ = %d AND a.COLORD <= b.COLORD
            "
            ,addSqlSlashes($F_PJTSEQ)
            ,addSqlSlashes($F_PGMSEQ)
            ,$G["G"]["GRPSEQ"]
            ,addSqlSlashes($F_PJTSEQ)
            ,addSqlSlashes($F_PGMSEQ)
            ,$G["G"]["GRPSEQ"]
        );
        //mlog("★★★★SQL (input " . $input . ") : " .$T_SQL);

        //echo "<br>getInput $input :  ". $T_SQL;
		if(isDbCache($T_SQL))return getDbCache($T_SQL); //#############################캐쉬#######################
        $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","3452", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

        //$line2 = null;
        $RtnVal = fetch_all($result,MYSQLI_ASSOC);
        //$RtnVal = fetch_all($result,MYSQLI_ASSOC);
        $result->close();

    }else if($input == "PGMIO.KEYCOL.SVC"){
        $T_SQL = sprintf("
            select COUNT(a.COLID)-1 as KEYCOLIDX,b.COLID as KEYCOLID
			from 
				CG_PGMIO a 
				join
				(
					SELECT COLORD,COLID
					FROM 
						CG_PGMIO 
                    WHERE PJTSEQ = %d and PGMSEQ = %d and GRPSEQ = %d and KEYYN='Y'
                    GROUP BY COLORD,COLID
					LIMIT 1
				) b
			where a.PJTSEQ = %d and a.PGMSEQ = %d and a.GRPSEQ = %d AND a.COLORD <= b.COLORD
            "
            ,addSqlSlashes($F_PJTSEQ)
            ,addSqlSlashes($F_PGMSEQ)
            ,$G["V"]["GRPSEQ"]
            ,addSqlSlashes($F_PJTSEQ)
            ,addSqlSlashes($F_PGMSEQ)
            ,$G["V"]["GRPSEQ"]
        );
        //mlog("SQL (input " . $input . ") : " .$T_SQL);

        //echo "<br>getInput $input :  ". $T_SQL;
		if(isDbCache($T_SQL))return getDbCache($T_SQL); //#############################캐쉬#######################
        $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","3453", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

        //$line2 = null;
        $RtnVal = fetch_all($result,MYSQLI_ASSOC);
        //$RtnVal = fetch_all($result,MYSQLI_ASSOC);
        $result->close();
    }else if($input == "PGMSQL.USEDSVR"){
        $T_SQL = sprintf("
            select a.SVRSEQ,b.SVRID
            from CG_PGMSQL a
                join CG_SVR b on a.SVRSEQ = b.SVRSEQ
            where a.PJTSEQ = %d and a.PGMSEQ = %d %s 
            group by a.SVRSEQ,b.SVRID
            order by b.SVRID asc
            "
            ,addSqlSlashes($F_PJTSEQ)
            ,addSqlSlashes($F_PGMSEQ)
            ,$AddSql
        );
        //mlog("SQL (input " . $input . ") : " .$T_SQL);
        //echo "<br>getInput $input :  ". $T_SQL;
		if(isDbCache($T_SQL))return getDbCache($T_SQL); //#############################캐쉬#######################

        $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","3454", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

        //$line2 = null;
        $RtnVal = fetch_all($result,MYSQLI_ASSOC);
        //$RtnVal = fetch_all($result,MYSQLI_ASSOC);
        $result->close();
    }else if($input == "PGMSQLR"){
        $T_SQL = sprintf("
            select a.*,b.SQLNM,b.CRUD,b.SQLTXT,b.SVRSEQ
			from CG_PGMSQLR a 
                left outer join CG_PGMSQL b	on a.PJTSEQ = b.PJTSEQ and a.PGMSEQ = b.PGMSEQ and a.SQLID = b.SQLID
			where a.PJTSEQ = %d and a.PGMSEQ = %d and a.SVCSEQ = %s %s
            "
            ,addSqlSlashes($F_PJTSEQ)
            ,addSqlSlashes($F_PGMSEQ)
            ,$G["V"]["SVCSEQ"]
            ,$AddSql
        );
        //alog("SQL 1059 (input " . $input . ") : " .$T_SQL);
        //echo "<br>getInput $input :  ". $T_SQL;
		if(isDbCache($T_SQL))return getDbCache($T_SQL); //#############################캐쉬#######################

        $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","350", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

        //$line2 = null;
        $RtnVal = fetch_all($result,MYSQLI_ASSOC);
        //$RtnVal = fetch_all($result,MYSQLI_ASSOC);
        $result->close();
    }else if($input == "PGMSQL"){
        $T_SQL = sprintf("
            select a.*, b.CDVAL as RTN_TYPE_NM, s.SVRID
			from 
				CG_PGMSQL a 
				left outer join CG_CODED b
                    ON b.PCD = 'RTN_TYPE' and a.RTN_TYPE = b.CD
                left outer join CG_SVR s on a.SVRSEQ = s.SVRSEQ
			where a.PJTSEQ = %d and a.PGMSEQ = %d %s
				and a.PJTSEQ= b.PJTSEQ
            "
            ,addSqlSlashes($F_PJTSEQ)
            ,addSqlSlashes($F_PGMSEQ)
            ,$AddSql
        );
        //echo "<br>getInput $input :  ". $T_SQL;
		if(isDbCache($T_SQL))return getDbCache($T_SQL); //#############################캐쉬#######################

        $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","355", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

        //$line2 = null;
        $RtnVal = fetch_all($result,MYSQLI_ASSOC);
        //$RtnVal = fetch_all($result,MYSQLI_ASSOC);
        $result->close();
    }else if($input == "PGMSQL.SVC"){
		//서비스 그룹의 SQL정보 가져오기
        $T_SQL = sprintf("
			select a.*
			from 
				CG_PGMSQLR a 
				join CG_PGMSQL b ON a.PJTSEQ = b.PJTSEQ and a.PGMSEQ = b.PGMSEQ and a.SQLID = b.SQLID
			where a.PJTSEQ = %d and a.PGMSEQ = %d and a.SVCSEQ = %d 
				and a.PJTSEQ= b.PJTSEQ
            "
            ,addSqlSlashes($F_PJTSEQ)
            ,addSqlSlashes($F_PGMSEQ)
            ,$G["V"]["SVCSEQ"]
            ,$AddSql
        );
        //mlog("SQL (input " . $input . ") : " .$T_SQL);
        //echo "<br>getInput $input :  ". $T_SQL;
		if(isDbCache($T_SQL))return getDbCache($T_SQL); //#############################캐쉬#######################

        $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","355", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

        //$line2 = null;
        $RtnVal = fetch_all($result,MYSQLI_ASSOC);
        //$RtnVal = fetch_all($result,MYSQLI_ASSOC);
        $result->close();
    }else if($input == "PGMSQLD"){
        $T_SQL = sprintf("
            select a.*,ifnull(b.CDVAL,'s') as DATATYPE_CDVAL
			from 
                CG_PGMSQLD a
                left outer join CG_DD c on a.PJTSEQ = c.PJTSEQ and a.DDCOLID = c.COLID
				left outer join CG_CODED b on b.PCD = 'DATATYPE' and c.DATATYPE = b.CD and a.PJTSEQ = b.PJTSEQ
			where a.PJTSEQ = %d and a.PGMSEQ = %d and a.SQLSEQ = '%s' %s
			order by ORD asc
            "
            ,addSqlSlashes($F_PJTSEQ)
            ,addSqlSlashes($F_PGMSEQ)
            ,$G["S"]["SQLSEQ"]
            ,$AddSql
        );
        alog("SQL 1134 (input " . $input . ") : " .$T_SQL);
        //echo "<br>getInput $input :  ". $T_SQL;
		if(isDbCache($T_SQL))return getDbCache($T_SQL); //#############################캐쉬#######################

        $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","360", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

        //$line2 = null;
        $RtnVal = fetch_all($result,MYSQLI_ASSOC);
        //$RtnVal = fetch_all($result,MYSQLI_ASSOC);
        $result->close();
    }else if($input == "PGMSQLD.HINT"){
        $T_SQL = sprintf("
            select distinct COLID as COLID
			from 
                CG_PGMSQLD 
			where PJTSEQ = %d and PGMSEQ = %d and (COLID like 'USER.%%' or  COLID like 'SERVER.%%') %s
			order by COLID asc
            "
            ,addSqlSlashes($F_PJTSEQ)
            ,addSqlSlashes($F_PGMSEQ)
            ,$AddSql
        );
        alog("SQL 1155 (input " . $input . ") : " . $T_SQL);
        //echo "<br>getInput $input :  ". $T_SQL;
		if(isDbCache($T_SQL))return getDbCache($T_SQL); //#############################캐쉬#######################

        $result = $db[$svrid]->query($T_SQL) or ServerMsg("500","370", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

        //$line2 = null;
        $RtnVal = fetch_all($result,MYSQLI_ASSOC);
        //$RtnVal = fetch_all($result,MYSQLI_ASSOC);
        $result->close();
    }else{
		Msg("	input[".$input."]이 없습니다.	");
        mlog("	input[".$input."]이 없습니다.	");
        exit;
	}

	
	putDbCache($T_SQL,$RtnVal); //#############################캐쉬#######################



    return $RtnVal;
}






function getJsA($lineD){
    Global $db,$svrid,$F_PJTSEQ;
    $RtnVal=null;

    $T_SQL = sprintf("
		select a.* from CG_OBJINFOA  a
			join CG_PJTINFO b on a.PJTSEQ = b.PJTSEQ
		where b.PJTSEQ = %d and OBJDSEQ = %d order by OBJAORD ASC"
        , $F_PJTSEQ
        , $lineD["OBJDSEQ"]
    );

	//if($lineD["OBJDSEQ"] == 124)rlog("SQL : " . $T_SQL);

    //echo "<br>getJsA :  ". $T_SQL;
    $result2 = $db[$svrid]->query($T_SQL) or ServerMsg("500","141", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

    //$line2 = null;
    $RtnVal = fetch_all($result2,MYSQLI_ASSOC);

    $result2->close();

    return $RtnVal;
}

function getJsB($lineA){
    Global $db,$svrid,$F_PJTSEQ;
    $RtnVal=null;

    $T_SQL = sprintf("
		select a.* from CG_OBJINFOB a
			join CG_PJTINFO b on a.PJTSEQ = b.PJTSEQ
		where b.PJTSEQ = %d and OBJASEQ = %d order by OBJBORD ASC"
        , $F_PJTSEQ
        , $lineA["OBJASEQ"]
    );
	//if($lineA["OBJASEQ"] == 124)rlog("SQL : " . $T_SQL);

    //echo "<br>getJsA :  ". $T_SQL;
    $result2 = $db[$svrid]->query($T_SQL) or ServerMsg("500","142", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

    //$line2 = null;
    $RtnVal = fetch_all($result2,MYSQLI_ASSOC);

    $result2->close();

    return $RtnVal;
}



function getSrcA($lineD){
    Global $db,$svrid,$F_PJTSEQ;
    $RtnVal=null;

    $T_SQL = sprintf("select SRCTXT,SRCAORD,INPUT,PARAM,SRCTYPE,SPTTXT from CG_SRCINFOA   where PJTSEQ = %d and SRCDSEQ = %d order by SRCAORD ASC"
        , $F_PJTSEQ
        , $lineD["SRCDSEQ"]
    );
    //echo "<br>getSrcA :  ". $T_SQL;
    $result2 = $db[$svrid]->query($T_SQL) or ServerMsg("500","143", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

    //$line2 = null;
    $RtnVal = fetch_all($result2,MYSQLI_ASSOC);

    $result2->close();

    return $RtnVal;
}

function getSrcD($line){
    Global $db,$svrid,$F_PJTSEQ;
    $RtnVal=null;

    $T_SQL = sprintf("select SRCDSEQ,SRCTXT,SRCDORD,INPUT,PARAM,SRCTYPE,SPTTXT from CG_SRCINFOD   where PJTSEQ = %d and SRCSEQ = %d order by SRCDORD ASC"
        , $F_PJTSEQ
        , $line["SRCSEQ"]
    );
    //echo "<br>getSrcD :  ". $T_SQL;
    $result2 = $db[$svrid]->query($T_SQL) or ServerMsg("500","144", "[" . $db[$svrid]->errno . "] " . $db[$svrid]->error) ;

    //$line2 = null;
    $RtnVal = fetch_all($result2,MYSQLI_ASSOC);

    $result2->close();

    return $RtnVal;
}

?>