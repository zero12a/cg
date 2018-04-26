<?php
/**
 * Created by PhpStorm.
 * User: zero12a
 * Date: 2014. 7. 3.
 * Time: 오전 5:03
 */


function getInput($input,$param,$G){
    Global $db,$F_PJTID,$F_PGMID;
    $AddSql = "";
    $RtnVal = null;
    //$TmpVal=null;
    list($col,$val) = split("=",$param);

    if($col != "")    {
        if(strtoupper($val) == "NULL"){
            $AddSql = sprintf(" and (%s is null or %s = '') ", $col,$col);
        }else if(strtoupper($val) == "NOT NULL") {
            $AddSql = sprintf(" and (%s is not null and %s != '') ", $col, $col);
        }else{
            $AddSql = sprintf(" and %s = '%s' ", $col, $val);
        }

    }
    //echo "<br> getInput : " . $input;
    if($input == "CODED"){
        $T_SQL = sprintf("
                SELECT
                  CD AS NM
                  ,CDVAL AS VAL
                FROM CG_CODED
                WHERE PJTID = '%s'
                %s
                "
            ,mysql_real_escape_string($F_PJTID)
            ,$AddSql
        );
        //echo "<br>getInput :  ". $T_SQL;
        $result = $db->query($T_SQL) or ServerMsg("500","140", "[" . $db->errno . "] " . $db->error) ;

        //$line2 = null;
        $RtnVal = mysqli_fetch_all($result,MYSQLI_ASSOC);
        //if($RtnVal =  $result->fetch_assoc()  ){}
        $result->close();
    }
    //echo "<br> getInput : " . $input;
    if($input == "OBJINFO"){
        $T_SQL = sprintf("
                SELECT
                  COLTYPE AS COLTYPE
                  ,COLLBLTXT AS COLLBLTXT
                  ,COLOBJTXT AS COLOBJTXT
                FROM CG_OBJINFO
                WHERE PJTID = '%s'
                %s
                "
            ,mysql_real_escape_string($F_PJTID)
            ,$AddSql
        );
        //echo "<br>getInput :  ". $T_SQL;
        $result = $db->query($T_SQL) or ServerMsg("500","140", "[" . $db->errno . "] " . $db->error) ;

        //$line2 = null;
        $RtnVal = mysqli_fetch_all($result,MYSQLI_ASSOC);
        //if($RtnVal =  $result->fetch_assoc()  ){}
        $result->close();
    }

    //echo "<br> getInput : " . $input;
    if($input == "PGMINFOD"){
        $T_SQL = sprintf("
                select * from CG_PGMINFOD where PJTID = '%s' and PGMID = '%s' %s order by GRPORD asc "
            ,mysql_real_escape_string($F_PJTID)
            ,mysql_real_escape_string($F_PGMID)
            ,$AddSql
        );
        //echo "<br>getInput :  ". $T_SQL;
        $result = $db->query($T_SQL) or ServerMsg("500","140", "[" . $db->errno . "] " . $db->error) ;

        //$line2 = null;
        $RtnVal = mysqli_fetch_all($result,MYSQLI_ASSOC);
        $result->close();
    }
    if($input == "PGMINFOD.REF"){
        $T_SQL = sprintf("
            select * from CG_PGMINFOD where PJTID = '%s' and PGMID = '%s' and REFGRPID = '%s' order by GRPORD asc
            "
            ,mysql_real_escape_string($F_PJTID)
            ,mysql_real_escape_string($F_PGMID)
            ,$G["G"]["GRPID"]
        );
        //echo "<br>getInput :  ". $T_SQL;
        $result = $db->query($T_SQL) or ServerMsg("500","110", "[" . $db->errno . "] " . $db->error) ;

        //$line2 = null;
        $RtnVal = mysqli_fetch_all($result,MYSQLI_ASSOC);
        //$RtnVal = mysqli_fetch_all($result,MYSQLI_ASSOC);
        $result->close();
    }
    if($input == "CONDITION.REF"){
        $T_SQL = sprintf("
            select * from CG_PGMINFOD where PJTID = '%s' and PGMID = '%s'
            and REFGRPID = ( select GRPID from CG_PGMINFOD where PJTID = '%s' and PGMID = '%s' and GRPTYPE = 'CONDITION' )
            order by GRPORD asc
            "
            ,mysql_real_escape_string($F_PJTID)
            ,mysql_real_escape_string($F_PGMID)
            ,mysql_real_escape_string($F_PJTID)
            ,mysql_real_escape_string($F_PGMID)
        );
        //echo "<br>getInput :  ". $T_SQL;
        $result = $db->query($T_SQL) or ServerMsg("500","110", "[" . $db->errno . "] " . $db->error) ;

        //$line2 = null;
        $RtnVal = mysqli_fetch_all($result,MYSQLI_ASSOC);
        //$RtnVal = mysqli_fetch_all($result,MYSQLI_ASSOC);
        $result->close();
    }



    if($input == "PGMINFO"){
        $T_SQL = sprintf("
            select * from CG_PJTINFO a join CG_PGMINFO b on b.PJTID = '%s' and b.PGMID = '%s' and a.PJTID = b.PJTID
            "
            ,mysql_real_escape_string($F_PJTID)
            ,mysql_real_escape_string($F_PGMID)
        );
        //echo "<br>getInput :  ". $T_SQL;
        $result = $db->query($T_SQL) or ServerMsg("500","110", "[" . $db->errno . "] " . $db->error) ;

        //$line2 = null;
        if($RtnVal =  $result->fetch_assoc()  ){}
        //$RtnVal = mysqli_fetch_all($result,MYSQLI_ASSOC);
        $result->close();
    }

    if($input == "IOINFO"){
        $T_SQL = sprintf("
            select
              a.*
              ,ifnull(b.CDVAL,'na') as COLSORT
            from CG_IOINFO a
                left outer join CG_CODED b on a.DATATYPE = b.CD and b.PCD='GRIDSOFT' and a.PJTID = b.PJTID
            where a.PJTID = '%s' and a.PGMID = '%s' and a.GRPID = '%s' %s
            "
            ,mysql_real_escape_string($F_PJTID)
            ,mysql_real_escape_string($F_PGMID)
            ,$G["G"]["GRPID"]
            ,$AddSql
        );
        //echo "<br>getInput $input :  ". $T_SQL;
        $result = $db->query($T_SQL) or ServerMsg("500","110", "[" . $db->errno . "] " . $db->error) ;

        //$line2 = null;
        $RtnVal = mysqli_fetch_all($result,MYSQLI_ASSOC);
        //$RtnVal = mysqli_fetch_all($result,MYSQLI_ASSOC);
        $result->close();
    }
    if($input == "IOINFO.CONDITION"){
        $T_SQL = sprintf("
            select
              a.*
              ,ifnull(b.CDVAL,'na') as COLSORT
            from CG_IOINFO a
              left outer join CG_CODED b on a.DATATYPE = b.CD and b.PCD='GRIDSORT' and a.PJTID = b.PJTID
            where a.PJTID = '%s' and a.PGMID = '%s'
              and a.GRPID = (select GRPID from CG_PGMINFOD where PJTID='%s' and PGMID = '%s' and GRPTYPE = 'CONDITION' )
              %s
            "
            ,mysql_real_escape_string($F_PJTID)
            ,mysql_real_escape_string($F_PGMID)
            ,mysql_real_escape_string($F_PJTID)
            ,mysql_real_escape_string($F_PGMID)
            ,$AddSql
        );
        //echo "<br>getInput $input :  ". $T_SQL;
        $result = $db->query($T_SQL) or ServerMsg("500","110", "[" . $db->errno . "] " . $db->error) ;

        //$line2 = null;
        $RtnVal = mysqli_fetch_all($result,MYSQLI_ASSOC);
        //$RtnVal = mysqli_fetch_all($result,MYSQLI_ASSOC);
        $result->close();
    }


    if($input == "SQLINFO"){
        $T_SQL = sprintf("
            select * from CG_SQLINFO where PJTID = '%s' and PGMID = '%s' and GRPID = '%s' %s
            "
            ,mysql_real_escape_string($F_PJTID)
            ,mysql_real_escape_string($F_PGMID)
            ,$G["G"]["GRPID"]
            ,$AddSql
        );
        //echo "<br>getInput $input :  ". $T_SQL;
        $result = $db->query($T_SQL) or ServerMsg("500","110", "[" . $db->errno . "] " . $db->error) ;

        //$line2 = null;
        $RtnVal = mysqli_fetch_all($result,MYSQLI_ASSOC);
        //$RtnVal = mysqli_fetch_all($result,MYSQLI_ASSOC);
        $result->close();
    }



    return $RtnVal;
}







function getSrcA($lineD){
    Global $db,$F_PJTID;
    $RtnVal=null;

    $T_SQL = sprintf("select SRCTXT,SRCAORD,INPUT,PARAM,SRCTYPE,SPTTXT from CG_SRCINFOA   where PJTID = '%s' and SRCDSEQ = %d order by SRCAORD ASC"
        , $F_PJTID
        , $lineD["SRCDSEQ"]
    );
    //echo "<br>getSrcA :  ". $T_SQL;
    $result2 = $db->query($T_SQL) or ServerMsg("500","140", "[" . $db->errno . "] " . $db->error) ;

    //$line2 = null;
    $RtnVal = mysqli_fetch_all($result2,MYSQLI_ASSOC);

    $result2->close();

    return $RtnVal;
}

function getSrcD($line){
    Global $db,$F_PJTID;
    $RtnVal=null;

    $T_SQL = sprintf("select SRCDSEQ,SRCTXT,SRCDORD,INPUT,PARAM,SRCTYPE,SPTTXT from CG_SRCINFOD   where PJTID = '%s' and SRCSEQ = %d order by SRCDORD ASC"
        , $F_PJTID
        , $line["SRCSEQ"]
    );
    //echo "<br>getSrcD :  ". $T_SQL;
    $result2 = $db->query($T_SQL) or ServerMsg("500","140", "[" . $db->errno . "] " . $db->error) ;

    //$line2 = null;
    $RtnVal = mysqli_fetch_all($result2,MYSQLI_ASSOC);

    $result2->close();

    return $RtnVal;
}

?>