<?php
 
include_once('StdInterface.php');
include_once('StdDao.php');

class StdService implements StdInterface
{
	private $DAO;
	private $DB;

	function __construct(){
		alog("StdService-__construct");

		$this->DAO = new StdDao();
	    $this->DB = db_m_open();
	}
	function __destruct(){
		alog("StdService-__destruct");

		unset($this->DAO);
		if($this->DB)$this->DB->close();
		unset($this->DB);
	}
	function __toString(){
		alog("StdService-__toString");
	}

	public function goGrid1Search1(){
		global $REQ;
		alog("StdService-goGrid1Search1");

		$GRID["KEYCOLIDX"] = 0;
        $GRID["SQL"]["R"] = $this->DAO->getGrid1Search1Sql1($var1);

        echo makeGridSearchJson($GRID,$this->DB);
    }                                                   
 
	public function goGrid1Save2(){
		global $REQ;
		alog("StdService-goGrid1Save2");

        $GRID["XML"] = $REQ["G2_XML"];
        $GRID["COLORD"] = "COL1,COL2,COL3"; //그리드 컬럼순서(Hidden컬럼포함)
		$GRID["KEYCOLID"] = "COL2";  //KEY컬럼 COLID
		$GRID["SEQYN"] = "N"; //자동증가 컬럼 여부 

        $GRID["SQL"]["C"] = $this->DAO->getGrid1Save2Sql1();
        $GRID["SQL"]["U"] = $this->DAO->getGrid1Save2Sql2();
        $GRID["SQL"]["D"] = $this->DAO->getGrid1Save2Sql3();

        echo makeGridSaveJson($GRID,$this->DB);
    }                                                   
 
	public function goFormview2Search1(){
		global $REQ;
		alog("StdService-goFormview2Search1");

        $FORMVIEW["SQL"]["R"] = $this->DAO->getFormview2Search1Sql1($var1);

        echo makeFormviewSearchJson($FORMVIEW,$this->DB);
    }                                                        
 
	public function goFormview2Save2(){
		global $REQ;
		alog("StdService-goFormview2Save2");

        $FORMVIEW["FNCTYPE"] = $REQ["G2_FNCTYPE"];
        $FORMVIEW["SQL"]["C"] = $this->DAO->getFormview2Save2Sql1();
        $FORMVIEW["SQL"]["U"] = $this->DAO->getFormview2Save2Sql2();

        echo makeFormviewSaveJson($FORMVIEW,$this->DB);
    }    
	
 	public function goFormview2Delete3(){
		global $REQ;
		alog("StdService-goFormview2Save2");

        $FORMVIEW["FNCTYPE"] = $REQ["G2_FNCTYPE"];
        $FORMVIEW["SQL"]["D"] = $this->DAO->getFormview2Delete3Sql1();

        echo makeFormviewSaveJson($FORMVIEW,$this->DB);
    }                                                   
 

}
                                                             
?>
