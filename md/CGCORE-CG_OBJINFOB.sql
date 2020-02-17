-- MySQL dump 10.17  Distrib 10.3.22-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: 172.17.0.1    Database: CGCORE
-- ------------------------------------------------------
-- Server version	5.7.20

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `CG_OBJINFOB`
--

DROP TABLE IF EXISTS `CG_OBJINFOB`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CG_OBJINFOB` (
  `OBJTYPE` varchar(30) COLLATE utf8_bin NOT NULL,
  `OBJASEQ` int(11) unsigned NOT NULL,
  `OBJBSEQ` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `OBJBORD` int(11) unsigned NOT NULL,
  `OBJDESC` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `SRCTXT` varchar(4000) COLLATE utf8_bin NOT NULL,
  `SPTTXT` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `INPUT` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `PARAM` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `SRCTYPE` varchar(1) COLLATE utf8_bin NOT NULL DEFAULT 'R',
  `FILTER` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `DEBUGYN` varchar(1) COLLATE utf8_bin NOT NULL DEFAULT 'N',
  `ADDDT` varchar(14) COLLATE utf8_bin NOT NULL,
  `MODDT` varchar(14) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`OBJBSEQ`),
  KEY `OBJASEQ` (`OBJASEQ`)
) ENGINE=InnoDB AUTO_INCREMENT=538 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CG_OBJINFOB`
--

LOCK TABLES `CG_OBJINFOB` WRITE;
/*!40000 ALTER TABLE `CG_OBJINFOB` DISABLE KEYS */;
INSERT INTO `CG_OBJINFOB` VALUES ('BODYINIT',149,13,10,'','public function go{G.GRPID}{F.FNCID}();','','PGMFNC','','L',NULL,'N','20141118141230',NULL),('BODYINIT',155,14,10,'IO받기','$REQ[\"{G.GRPID}_{I.COLID}\"] = $_POST[\"{G.GRPID}_{I.COLID}\"];//{I.COLNM}','','PGMIO','','L',NULL,'N','20141118151028','20141118162329'),('BODYINIT',160,15,10,'처리','case \"{G.GRPID}_{F.FNCID}\" :\n  echo $objService->go{G.GRPID}_{F.FNCID}();\n  break;','','PGMFNC','','L',NULL,'N','20141118151133','20141118162458'),('BODYINIT',164,17,60,'값리턴','		return $RtnVal;\n    }  ','','','','R',NULL,'N','20141118163145','20141118163157'),('BODYINIT',164,18,50,'바인트타입종료','\";\n','','','','R',NULL,'N','20141118163145',NULL),('BODYINIT',164,19,40,'바인드','{I.COLTYPE}','','PGMIO','','L',NULL,'N','20141118163145',NULL),('BODYINIT',164,20,30,'바인드타입시작','		$RtnVal[\"BINDTYPE\"] = \"','','','','R',NULL,'N','20141118163145',NULL),('BODYINIT',164,21,20,'SQLX타입','		$RtnVal[\"FNCTYPE\"] = \"D\";//CRUD\n		$RtnVal[\"SQLTXT\"] = \"\n		  select\n            PJTID,PGMID,GRPID,FNCID,FNCCD,FNCNM,FNCTYPE,BTNWIDTH,ORD,ADDDT,MODDT\n          from CG_PGMFNC where PJTID = #PJTID# and GRPID = #GRPID#\n          \";','','','','R',NULL,'N','20141118163145',NULL),('BODYINIT',164,22,10,'함수시작','    public function getFormview2Delete3Sql1($req){\n		//GRID 조회\n		$RtnVal = null;\n		$RtnVal[\"FNCTYPE\"] = \"D\";//CRUD','','','','R',NULL,'N','20141118163145',NULL),('BTN',209,31,10,'start','//var params = { CTL : \"{G.GRPID}_{G.FNCID}\"','','','','R','','N','20150101211302','20171219224914'),('BTN',209,32,20,'loop','','','PGMSVC.OBJD.JS','OBJVAL=MAKEPARAMS','C','','N','20150101211302','20150101211315'),('BTN',209,33,30,'end','};\n','','','','R','','N','20150101211302','20150101211330'),('JSVRCTL',249,38,40,'Method End','	}\n','','','','R','','N','20151223061431','20160111103645'),('JSVRCTL',249,39,30,'서비스 처리','		return {P.PGMID#L}Service.{G.GRPID}_{F.FNCID}(params,userParams);\n','','','','R','','N','20151223061431','20160111103645'),('JSVRCTL',249,40,10,'Method Start','	@RequestMapping(\"/{P.PKGGRP}/{P.PGMID}/{G.GRPID}_{F.FNCID}.cg\")\n	public @ResponseBody\n	StdResDomain {G.GRPID}_{F.FNCID}(HttpServletRequest request,@RequestParam HashMap<String, String> params) {\n','','','','R','','N','20151223061431','20160111103956'),('JSVRCTL',249,41,29,'사용자 리스트데이터받기','		userParams.put(\"{V.SVCGRPID}_DATA\",stdUtil.getReqDomain(params.get(\"{V.SVCGRPID}_jsondata\")));\n','','PGMSVC.LIST','','L','','N','20160111044715','20160111103923'),('JSVRCTL',249,42,27,'사용자 정의변수','		userParams = new HashMap<String,Object>(); \n','','','','R','','N','20160111044716','20160111103645'),('JSVRCTL',249,43,25,'사용자 정의 변수','		//외부 입력값 로그 출력\n		stdUtil.viewRequest(request);\n','','','','R','','N','20160111044716','20160111104045'),('JSVRSVC',258,44,10,'M START','	/*SVC START*/\n	//{G.GRPNM} {F.FNCID}\n	public StdResDomain {G.GRPID}_{F.FNCID}(HashMap<String, String> params, HashMap<String,Object> userParams) {\n		logger.info(\"{P.PGMID#C}Service-------------------------------{G.GPRID}_{F.FNCID}()\");\n		resDomain = new StdResDomain();\n','','','','R','','G','20160111115441','20160111123708'),('JSVRSVC',258,45,20,'OBJ LOOP','		/*SVC OBJ LOOP*/\n','','PGMSVC.OBJD','UILANG=JAVA','C','','N','20160111115441','20160111120202'),('JSVRSVC',258,46,30,'RETURN','\n		resDomain.setRTN_CD(\"200\");\n		resDomain.setERR_CD(\"200\");\n		resDomain.setRTN_MSG(\"감사합니다.\");		\n		return resDomain;\n','','','','R','','N','20160111115441','20160328110118'),('JSVRSVC',258,47,40,'M END','	}\n','','','','R','','N','20160111115441','20160111115826'),('JSVRSVC',270,49,10,'REQ 로프','		StdReqDomain {V.SVCGRPID}_reqDomain = new StdReqDomain();\n','','','','R','','V','20160328113840','20160328122519'),('JSVRSVC',272,50,10,'REQ LOOP','			{V.SVCGRPID}_reqDomain = (StdReqDomain) userParams.get(\"{V.SVCGRPID}_DATA\");\n','','','','R','','V','20160328113922','20160328122525'),('CHARTBAR',450,95,10,'','		$GRID[\"COLCRYPT\"] = array(','','','','R','','','20180515215305','20180515215336'),('CHARTBAR',450,96,20,'','\"{I.COLID}\"=>\"{I.DD_CRYPTCD}\"',',','PGMIO.SVC','CRYPTCD!=NONE','L','','','20180515215305','20180515215619'),('CHARTBAR',450,97,30,'',');\n','','','','R','','','20180515215305','20180515215336'),('CHARTBAR',449,98,10,'','		//V_GRPNM : {V.GRPNM}\n		$GRID[\"SQL\"][\"{S.CRUD}\"] = $this->DAO->{S.SQLID}($REQ); //{F.FNCID}, {F.FNCNM},{S.SQLNM}\n','','PGMSQLR','','L','','','20180515215614',NULL),('CHARTPIE',466,99,10,'','		//V_GRPNM : {V.GRPNM}\n		$GRID[\"SQL\"][\"{S.CRUD}\"] = $this->DAO->{S.SQLID}($REQ); //{F.FNCID}, {F.FNCNM},{S.SQLNM}\n','','PGMSQLR','','L','','','20180518082602',NULL),('CHARTPIE',467,100,10,'','		$GRID[\"COLCRYPT\"] = array(','','','','R','','','20180518082707','20180518083617'),('CHARTPIE',467,101,20,'','\"{I.COLID}\"=>\"{I.DD_CRYPTCD}\"',',','PGMIO.SVC','CRYPTCD!=NONE','L','','','20180518082708','20180518083617'),('CHARTPIE',467,102,30,'',');\n','','','','R','','','20180518082708','20180518083617'),('CHARTPIE',471,104,0,'','			{GR.GRPID}_{GR.FNCID}(lastinput{GR.GRPID},uuidv4());\n','','','','R','','','20180614075409','20190322215456'),('CHARTBAR',474,105,0,'','			{GR.GRPID}_{GR.FNCID}(lastinput{GR.GRPID},uuidv4());\n','','','','R','','','20180614081348','20190325213857'),('CHARTBAR2Y',487,111,10,'','		{GR.GRPID}_{GR.FNCID}(lastinput{GR.GRPID},uuidv4());\n','','','','R','','','20180720112917','20190325222057'),('CHARTBAR2Y',492,112,10,'','		//V_GRPNM : {V.GRPNM}\n		$GRID[\"SQL\"][\"{S.CRUD}\"] = $this->DAO->{S.SQLID}($REQ); //{F.FNCID}, {F.FNCNM},{S.SQLNM}\n	','','PGMSQLR','','L','','','20180720113152','20180720115901'),('CHARTBAR2Y',493,113,0,'','		$GRID[\"COLCRYPT\"] = array(','','','','R','','','20180720113247',NULL),('CHARTBAR2Y',493,114,0,'','\"{I.COLID}\"=>\"{I.DD_CRYPTCD}\"','','PGMIO.SVC','CRYPTCD!=NONE','L','','','20180720113247',NULL),('CHARTBAR2Y',493,115,0,'',');\n','','','','R','','','20180720113247',NULL),('CHARTBAR',531,128,10,'','		//챠트 상속\n		lastinput{GR.GRPID} = new HashMap();\n		lastinput{GR.GRPID}.set(\"{G.GRPID}-\" + chart{G.GRPID}Data.colids[0],firstColLabel);\n		lastinput{GR.GRPID}.set(\"{G.GRPID}-\" + labelElement,dataElement);\n','','','','R','','','20190322214142','20190325214811'),('CHARTBAR2Y',532,129,10,'','		//챠트 상속\n		lastinput{GR.GRPID} = new HashMap();\n		lastinput{GR.GRPID}.set(\"{G.GRPID}-\" + chart{G.GRPID}Data.colids[0],firstColLabel);\n		lastinput{GR.GRPID}.set(\"{G.GRPID}-\" + labelElement,dataElement);\n','','','','R','','','20190322214359','20190325222333'),('CHARTPIE',533,130,10,'','		//{GR.GRPNM}\n		lastinput{GR.GRPID} = new HashMap();\n		lastinput{GR.GRPID}.set(\"{G.GRPID}-\" + chart{G.GRPID}Data.colids[0],firstColLabel);\n		lastinput{GR.GRPID}.set(\"{G.GRPID}-\" + labelElement,dataElement);\n	','','','','R','','','20190322214520','20190325214904'),('CHARTPIE',534,131,10,'','				//컬럼ID목록 저장해 두기\n				newColids = [];\n','','','','R','','','20190325203323','20190325204552'),('CHARTPIE',534,132,20,'','				newColids.push(\"{I.COLID}\");\n','','PGMIO','','L','','','20190325203323','20190325204554'),('CHARTPIE',534,133,30,'','				chart{G.GRPID}Data.colids = newColids;\n','','','','R','','','20190325203323','20190325204557'),('CHARTBAR',535,134,10,'','				//컬럼ID목록 저장해 두기\n				newColids = [];\n','','','','R','','','20190325211906',NULL),('CHARTBAR',535,135,20,'','				newColids.push(\"{I.COLID}\"); // {I.COLNM}\n	','','PGMIO','','L','','','20190325211906','20190325213413'),('CHARTBAR',535,136,30,'','				chart{G.GRPID}Data.colids = newColids; // {G.GRPNM}\n','','','','R','','','20190325211906','20190325222026'),('CHARTBAR2Y',536,137,10,'','				//컬럼ID목록 저장해 두기\n				newColids = [];\n','','','','R','','','20190325221921','20190325221947'),('CHARTBAR2Y',536,138,20,'','				newColids.push(\"{I.COLID}\"); // {I.COLNM}\n','','PGMIO','','L','','','20190325221922','20190325222017'),('CHARTBAR2Y',536,139,30,'','				chart{G.GRPID}Data.colids = newColids; // {G.GRPNM}\n','','','','R','','','20190325221922','20190325222031'),('BIVAL1A',592,153,20,'','\"{I.COLID}\"=>\"{I.DD_CRYPTCD}\"',',','PGMIO.SVC','CRYPTCD!=NONE','L','','','20190625211222',NULL),('BIVAL1A',592,154,10,'','		$BIVIEW[\"COLCRYPT\"] = array(','','','','R','','','20190625211222','20190625211339'),('BIVAL1A',592,155,30,'',');\n','','','','R','','','20190625211222',NULL),('BIVAL1A',594,156,10,'','		// {S.SQLNM}\n		array_push($BIVIEW[\"SQL\"], $this->DAO->{S.SQLID}($REQ)); \n','','PGMSQLR','','L','','','20190625211310','20190625211357'),('BIVIEW',598,157,10,'','		$BIVIEW[\"COLCRYPT\"] = array(','','','','R','','','20190625212435','20190625212522'),('BIVIEW',598,158,20,'','\"{I.COLID}\"=>\"{I.DD_CRYPTCD}\"',',','PGMIO.SVC','CRYPTCD!=NONE','L','','','20190625212435',NULL),('BIVIEW',598,159,30,'',');\n','','','','R','','','20190625212435',NULL),('BIVIEW',600,160,10,'','		// {S.SQLNM}\n		array_push($BIVIEW[\"SQL\"], $this->DAO->{S.SQLID}($REQ)); \n','','PGMSQLR','','L','','','20190625213731','20190625213843'),('BTN',958,251,10,'start','//var params = { CTL : \"{G.GRPID}_{G.FNCID}\"','','','','R','','N','20191029211843',NULL),('BTN',958,252,20,'loop','','','PGMSVC.OBJD.JS','OBJVAL=MAKEPARAMS','C','','N','20191029211844',NULL),('BTN',958,253,30,'end','};\n','','','','R','','N','20191029211844',NULL),('BTN',1273,350,10,'start','//var params = { CTL : \"{G.GRPID}_{G.FNCID}\"','','','','R','','N','20191029212131',NULL),('BTN',1273,351,20,'loop','','','PGMSVC.OBJD.JS','OBJVAL=MAKEPARAMS','C','','N','20191029212131',NULL),('BTN',1273,352,30,'end','};\n','','','','R','','N','20191029212131',NULL),('AJS',1527,435,0,'','	//{G.GRPID}, {G.GRPNM}, {I.COLID}, {I.COLNM}\n	if( tGrpId ==\"{G.GRPID}\" && tColId == \"{I.COLID}\" ){\n		window.open(\"about:blank\",\"codeSearch{G.GRPID}Pop\",\"width={I.POP_WIDTH},height={I.POP_HEIGHT},resizable=yes,scrollbars=yes\");\n		\n		//값세팅하고\n		var frm1 = $(\'form[name=\"popupForm\"]\');\n\n		frm1.append(\"<input type=text name=\'{I.COLID}\' id=\'{I.COLID}\' value=\'\" + tValue + \"\'>\");//이 컬럼이 동적으로 {I.COLID} 변경되어야 함.	\n		frm1.append(\"<input type=text name=\'{I.COLID}-NM\' id=\'{I.COLID}-NM\' value=\'\" + tText + \"\'>\");//이 컬럼이 동적으로 {I.COLID} 변경되어야 함.	\n		\n		$(\"#GRPID\").val(tGrpId);\n		$(\"#ROWID\").val(tRowId);		\n		$(\"#COLID\").val(tColId);\n\n		//폼실행\n		var frm =document.popupForm;\n		frm.action = \"{I.POP_URL}\";//호출할 팝업 프로그램 URL\n		frm.target = \"codeSearch{G.GRPID}Pop\";\n		frm.method = \"post\";\n		//frm.submit();\n\n		alog(\"delay end and go.\");\n\n		//딜레이 폼실행\n		var timer;\n		var delay = 500; // 0.6 seconds delay after last input\n		window.clearTimeout(timer);\n		timer = window.setTimeout(function(){\n			alog(\"delay end and go1.\");\n			frm.submit();\n			alog(\"delay end and go2.\");\n		}, delay);\n	}\n','','PGMIO','POPUP!=','L','','','20191029212118',NULL),('AJS',1530,436,0,'','	//{G.GRPID}, {G.GRPNM}, {I.COLID}, {I.COLNM}\n	if( tGrpId == \"{G.GRPID}\" && tColId == \"{G.GRPID}-{I.COLID}\" ){\n		window.open(\"about:blank\",\"codeSearch{G.GRPID}Pop\",\"width={I.POP_WIDTH},height={I.POP_HEIGHT},resizable=yes,scrollbars=yes\");\n		\n		//값세팅하고\n		var frm1 = $(\'form[name=\"popupForm\"]\');\n\n		frm1.append(\"<input type=text name=\'{I.COLID}\' id=\'{I.COLID}\' value=\'\" + tColId_Val + \"\'>\");//이 컬럼이 동적으로 {I.COLID} 변경되어야 함.	\n		frm1.append(\"<input type=text name=\'{I.COLID}-NM\' id=\'{I.COLID}-NM\' value=\'\" + tColId_Nm_Text + \"\'>\");//이 컬럼이 동적으로 {I.COLID} 변경되어야 함.		\n\n		$(\"#GRPID\").val(tGrpId);\n		$(\"#COLID\").val(tColId);\n\n		//폼실행\n		var frm =document.popupForm;\n		frm.action = \"{I.POP_URL}\";//호출할 팝업 프로그램 URL\n		frm.target = \"codeSearch{G.GRPID}Pop\";\n		frm.method = \"post\";\n		//frm.submit();\n\n		alog(\"delay end and go.\");\n\n		//딜레이 폼실행\n		var timer;\n		var delay = 500; // 0.6 seconds delay after last input\n		window.clearTimeout(timer);\n		timer = window.setTimeout(function(){\n			alog(\"delay end and go1.\");\n			frm.submit();\n			alog(\"delay end and go2.\");\n		}, delay);\n	}\n\n','','PGMIO','POPUP!=','L','','','20191029212118',NULL),('AJS',1533,437,10,'GRID','	//GRID\n	if(tGrpId == \"{G.GRPID}\" && tColId ==\"{I.COLID}\"){\n		alog(\"LAST_ROWID = \" + tRowId);\n		//그리드 일때\n		//전체 값중에 TEXT, VALUE만 변경\n		var origin = mygrid{G.GRPID}.cells(tRowId,mygrid{G.GRPID}.getColIndexById(tColId)).getValue();\n		alog(\"before = \" + origin);\n		var tArr = origin.split(\"^\"); ////CD^NM^GRPID\n		tArr[0] = tJsonObj.CD;\n		tArr[1] = tJsonObj.NM;	\n		tArr[2] = \"{G.GRPID}\";//GRPID\n		alog(\"after = \" + tArr[0] + \"^\" + tArr[1] + \"^\" + tArr[2]);\n\n		mygrid{G.GRPID}.cells(tRowId,mygrid{G.GRPID}.getColIndexById(tColId)).setValue(tArr[0] + \"^\" + tArr[1] + \"^\" + tArr[2] );\n	}\n	','','PGMIO','POPUP!=','L','G.GRPTYPE=GRID','','20191029212119',NULL),('AJS',1533,438,20,'FORM','	//FORM\n	if(tGrpId == \"{G.GRPID}\" && tColId ==\"{G.GRPID}-{I.COLID}\"){\n		$(\"#{G.GRPID}-{I.COLID}\").val(tJsonObj.CD);\n		$(\"#{G.GRPID}-{I.COLID}-NM\").text(tJsonObj.NM);\n	}\n','','PGMIO','POPUP!=','L','G.GRPTYPE=CONDITION||G.GRPTYPE=FORMVIEW','','20191029212119',NULL),('ASVRCTL',1544,439,10,'','$REQ[\"{G.GRPID}-{I.COLID}-NM\"] = $_FILES[\"{G.GRPID}-{I.COLID}\"][\"name\"];//{I.COLNM}\n$REQ[\"{G.GRPID}-{I.COLID}-TYPE\"] = $_FILES[\"{G.GRPID}-{I.COLID}\"][\"type\"];//{I.COLNM}\n$REQ[\"{G.GRPID}-{I.COLID}-TMPNM\"] = $_FILES[\"{G.GRPID}-{I.COLID}\"][\"tmp_name\"];//{I.COLNM}\n$REQ[\"{G.GRPID}-{I.COLID}-SIZE\"] = $_FILES[\"{G.GRPID}-{I.COLID}\"][\"size\"];//{I.COLNM}\n$REQ[\"{G.GRPID}-{I.COLID}-ERROR\"] = $_FILES[\"{G.GRPID}-{I.COLID}\"][\"error\"];//{I.COLNM}\n','','','','R','I.OBJTYPE=FILE','','20191029212122',NULL),('ASVRCTL',1546,440,10,'IO받기','$REQ[\"{G.GRPID}-{I.COLID}\"] = reqPost{I.DATATYPE#C}(\"{G.GRPID}-{I.COLID}\",{I.DATASIZE});//{I.COLNM}	\n','','','','R','','','20191029212122',NULL),('ASVRCTL',1546,441,20,'IO필터','$REQ[\"{G.GRPID}-{I.COLID}\"] = getFilter($REQ[\"{G.GRPID}-{I.COLID}\"],\"{I.VALID_VALIDTYPE}\",\"/{I.VALID_MATSTR}/\");	\n','','','','R','','','20191029212122',NULL),('CONDITION',1577,446,10,'','			lastinput{GR.GRPID} = new HashMap(); //{GR.GRPNM}\n	','','','','R','','','20191029212129',NULL),('CONDITION',1577,447,20,'','            lastinput{GR.GRPID}.set(\"{G.GRPID}-{I.COLID}\", $(\"#{G.GRPID}-{I.COLID}\").val());//{I.COLNM}\n	','','PGMIO.CHILD','OBJTYPE!=INPUTRADIO','L','','N','20191029212129',NULL),('CONDITION',1577,448,30,'radio','			lastinput{GR.GRPID}.set(\"{G.GRPID}-{I.COLID}\", $(\'input[name=\"{G.GRPID}-{I.COLID}\"]:checked\').val());\n','','PGMIO.CHILD','OBJTYPE=INPUTRADIO','L','','','20191029212130',NULL),('BTN',1588,449,10,'start','//var params = { CTL : \"{G.GRPID}_{G.FNCID}\"','','','','R','','N','20191029212131',NULL),('BTN',1588,450,20,'loop','','','PGMSVC.OBJD.JS','OBJVAL=MAKEPARAMS','C','','N','20191029212131',NULL),('BTN',1588,451,30,'end','};\n','','','','R','','N','20191029212131',NULL),('FORMVIEW',1599,452,10,'','		$FORMVIEW[\"COLCRYPT\"] = array(','','','','R','','','20191029212134',NULL),('FORMVIEW',1599,453,20,'','\"{I.COLID}\"=>\"{I.DD_CRYPTCD}\"',',','PGMIO.SVC','CRYPTCD!=NONE','L','','','20191029212134',NULL),('FORMVIEW',1599,454,30,'',');	\n	','','','','R','','','20191029212134',NULL),('FORMVIEW',1600,455,0,'FILE저장','		//파일저장\n		alog(\"{G.GRPID}-{I.COLID}-NM = \" . $REQ[\"{G.GRPID}-{I.COLID}-NM\"]);\n		if(strlen($REQ[\"{G.GRPID}-{I.COLID}-NM\"]) > 4  && isAllowExtension($REQ[\"{G.GRPID}-{I.COLID}-NM\"],$t_allow_extension=array(\"jpg\", \"gif\", \"png\",\"peng\",\"bmp\",\"svg\",\"xls\",\"xlsx\",\"doc\",\"docx\",\"ppt\",\"pptx\",\"pdf\",\"hwp\",\"txt\"))){\n			\n			$REQ[\"{G.GRPID}-{I.COLID}-SVRNM\"] = getFileSvrNm($REQ[\"{G.GRPID}-{I.COLID}-NM\"], $t_prefix=\"PIC_\");\n			$MYFILE1 = $CFG[\"CFG_UPLOAD_DIR\"] . $REQ[\"{G.GRPID}-{I.COLID}-SVRNM\"];\n			alog(\"###### MYFILE1 : \" . $MYFILE1 );\n\n			if(!move_uploaded_file($REQ[\"{G.GRPID}-{I.COLID}-TMPNM\"], $MYFILE1)){\n				//처리 결과 리턴\n				$rtnVal->RTN_CD = \"500\";\n				$rtnVal->ERR_CD = \"591\";\n				echo json_encode($rtnVal);\n				return;\n			}\n		}\n','','','','R','I.OBJTYPE=FILE','','20191029212135','20191119061018'),('FORMVIEW',1604,456,10,'','					array_push($FORMVIEW[\"SQL\"],$this->DAO->{S.SQLID}($REQ)); \n','','','','R','S.LAST_CRUD=C','Y','20191029212135',NULL),('FORMVIEW',1606,457,10,'','					array_push($FORMVIEW[\"SQL\"],$this->DAO->{S.SQLID}($REQ));\n','','','','R','S.LAST_CRUD=U','Y','20191029212135',NULL),('FORMVIEW',1618,458,10,'','		$FORMVIEW[\"COLCRYPT\"] = array(','','','','R','','','20191029212137',NULL),('FORMVIEW',1618,459,20,'','\"{I.COLID}\"=>\"{I.DD_CRYPTCD}\"',',','PGMIO.SVC','CRYPTCD!=NONE','L','','','20191029212137',NULL),('FORMVIEW',1618,460,30,'',');\n','','','','R','','','20191029212137',NULL),('FORMVIEW',1620,461,10,'FNC출력','		// {S.SQLNM}\n		array_push($FORMVIEW[\"SQL\"], $this->DAO->{S.SQLID}($REQ)); \n','','PGMSQLR','','L','','','20191029212138',NULL),('FORMVIEW',1623,462,10,'','//IO_FILE_YN = {F.IO_FILE_YN}	\nfunction {G.GRPID}_{F.FNCID}(token){	\n	alog(\"{G.GRPID}_{F.FNCID}---------------start\");\n\n	if( !( $(\"#{G.GRPID}-CTLCUD\").val() == \"C\" || $(\"#{G.GRPID}-CTLCUD\").val() == \"U\") ){\n		alert(\"신규 또는 수정 모드 진입 후 저장할 수 있습니다.\")\n		return;\n	}\n\n	//전송용 데이터 생성하기\n	var sendFormData = new FormData($(\"#formview{G.GRPID}\")[0]);\n\n','','','','R','','','20191029212138',NULL),('FORMVIEW',1623,463,20,'radio, check','','','PGMIO.OBJ','OBJVAL=GETVAL','C','','','20191029212138',NULL),('FORMVIEW',1623,464,30,'','	//컨디션 데이터 추가하기\n	conditionData = new FormData($(\"#condition\")[0]);\n    var es, e, pair;\n    for (es = conditionData.entries(); !(e = es.next()).done && (pair = e.value);) {\n		sendFormData.append(pair[0],pair[1]);\n    }\n','','','','R','','','20191029212138',NULL),('FORMVIEW',1623,465,40,'컨디션 radio, check','','','PGMIO.CONDITION.OBJ','OBJVAL=GETVAL_CONDITION','C','','','20191029212138',NULL),('FORMVIEW',1623,466,50,'','\n	$.ajax({\n		type : \"POST\",\n		url : url_{G.GRPID}_{F.FNCID} + \"&TOKEN=\" + token,\n		data : sendFormData,\n		processData: false,\n		contentType: false,\n		success: function(tdata){\n			alog(tdata);\n			data = jQuery.parseJSON(tdata);\n			//alert(data);\n			if(data && data.RTN_CD == \"200\"){\n				msgNotice(\"정상적으로 저장되었습니다.\",1);\n			}else{\n				msgError(\"오류가 발생했습니다(\"+ data.ERR_CD + \").\" + data.RTN_MSG,3);\n			}\n		},\n		error: function(error){\n			alog(\"Error:\");\n			alog(error);\n		}\n	});\n}','','','','R','','','20191029212139',NULL),('GRID',1658,467,10,'','		mygrid{G.GRPID}.setColAlign(\"','','','','R','','','20191029212143',NULL),('GRID',1658,468,20,'','{I.OBJALIGN_CDVAL}',',','PGMIO','','L','','','20191029212143',NULL),('GRID',1658,469,30,'','\");\n','','','','R','','','20191029212144',NULL),('GRID',1673,470,10,'','		mygrid{G.GRPID}.setNumberFormat(\"{I.FORMAT}\",mygrid{G.GRPID}.getColIndexById(\"{I.COLID}\")); // {I.COLNM}\n','','','','R','','','20191029212145',NULL),('GRID',1676,471,10,'','		mygrid{G.GRPID}.attachEvent(\"onCheck\",function(rowId, cellInd, state){\n			//onCheck is void return event\n			alog(rowId + \" is onCheck.\");\n','','','','R','','','20191029212145',NULL),('GRID',1676,472,20,'마스터체크','			//ROW 마스터 체크 박스는 변경이면 실제 row 안함\n			if(  mygrid{G.GRPID}.getColumnId(cellInd) == \"ROWCHK\" ){\n					mygrid{G.GRPID}.cells(rowId,cellInd).cell.wasChanged = false;	\n			}	\n','','PGMIO','OBJTYPE=ROWCHECK','L','','','20191029212145',NULL),('GRID',1676,473,30,'일반체크검사','			//일반 체크 박스는 변경이면 실제 row 변경\n			if( 1 == 2 \n','','','','R','','','20191029212145',NULL),('GRID',1676,474,40,'','			|| mygrid{G.GRPID}.getColumnId(cellInd) == \"{I.COLID}\"\n','','PGMIO','OBJTYPE=CHECKBOX','L','','','20191029212145',NULL),('GRID',1676,475,50,'','				){\n				RowEditStatus = mygrid{G.GRPID}.getUserData(rowId,\"!nativeeditor_status\");\n				if(RowEditStatus == \"\"){\n					mygrid{G.GRPID}.setUserData(rowId,\"!nativeeditor_status\",\"updated\");\n					mygrid{G.GRPID}.setRowTextBold(rowId);\n					mygrid{G.GRPID}.cells(rowId,cellInd).cell.wasChanged = true;	\n				}\n			}\n','','','','R','','','20191029212145',NULL),('GRID',1676,476,60,'','						\n		});	\n','','','','R','','','20191029212145',NULL),('GRID',1678,477,10,'EDIT 기능일때만 출력','            //편집모드 일때는 하위 새로고침 안하게 하기\n            if($(\"#{G.GRPID}-{F.FNCID}_EDIT_MODE\") && $(\"#{G.GRPID}-{F.FNCID}_EDIT_MODE\").is(\":checked\"))return false;\n','','','','R','F.FNCCD=EDITMODE','','20191029212146',NULL),('GRID',1679,478,0,'','			//CD[필수], NM 정보가 있는 경우 팝업 오프너에게 값 전달\n			pop{G.GRPID}json = jQuery.parseJSON(\'{ \"__NAME\":\"lastinputG3json\"\' +\n','','','','R','','','20191029212146',NULL),('GRID',1679,479,0,'','				\', \"{I.POPUP}\" : \"\' + q(mygrid{G.GRPID}.cells(rowID,mygrid{G.GRPID}.getColIndexById(\"{I.COLID}\")).getValue()) + \'\"\' +\n','','PGMIO','POPUP=CD||POPUP=NM','L','','','20191029212146',NULL),('GRID',1679,480,0,'','			\'}\');\n\n			if(pop{G.GRPID}json && pop{G.GRPID}json.CD){\n				goOpenerReturn(pop{G.GRPID}json);\n				return;\n			}\n','','','','R','','','20191029212146',NULL),('GRID',1681,484,10,'json','			lastinput{GR.GRPID}json = jQuery.parseJSON(\'{ \"__NAME\":\"lastinput{GR.GRPID}json\"\' +\n	','','','','R','','N','20191029212146',NULL),('GRID',1681,485,20,'','			\', \"{G.GRPID}-{I.COLID}\" : \"\' + q(mygrid{G.GRPID}.cells(rowID,mygrid{G.GRPID}.getColIndexById(\"{I.COLID}\")).getValue()) + \'\"\' +\n','','PGMIO.CHILD','','L','','N','20191029212146',NULL),('GRID',1681,486,30,'','			\'}\');\n','','','','R','','N','20191029212147',NULL),('GRID',1681,487,40,'','		lastinput{GR.GRPID} = new HashMap(); // {GR.GRPNM}\n','','','','R','','','20191029212147',NULL),('GRID',1681,488,50,'','		lastinput{GR.GRPID}.set(\"{G.GRPID}-{I.COLID}\", mygrid{G.GRPID}.cells(rowID,mygrid{G.GRPID}.getColIndexById(\"{I.COLID}\")).getValue().replace(/&amp;/g, \"&\")); // {I.COLNM}\n','','PGMIO.CHILD','','L','','','20191029212147',NULL),('GRID',1691,489,10,'','		//V_GRPNM : {V.GRPNM}\n		array_push($GRID[\"SQL\"], $this->DAO->{S.SQLID}($REQ)); //{F.FNCID}, {F.FNCNM},{S.SQLNM}\n','','PGMSQLR','','L','','N','20191029212148',NULL),('GRID',1692,490,10,'','		$GRID[\"COLCRYPT\"] = array(','','','','R','','','20191029212148',NULL),('GRID',1692,491,20,'','\"{I.COLID}\"=>\"{I.DD_CRYPTCD}\"',',','PGMIO.SVC','CRYPTCD!=NONE','L','','','20191029212148',NULL),('GRID',1692,492,30,'',');\n','','','','R','','','20191029212148',NULL),('GRID',1698,493,10,'','		$GRID[\"COLORD\"] = \"','','','','R','','N','20191029212149',NULL),('GRID',1698,494,20,'','{I.COLID}',',','PGMIO.SVC','','L','','N','20191029212149',NULL),('GRID',1698,495,30,'','\"; //그리드 컬럼순서(Hidden컬럼포함)\n','','','','R',NULL,'N','20191029212149',NULL),('GRID',1699,496,0,'','		$GRID[\"COLCRYPT\"] = array(','','','','R','','','20191029212149',NULL),('GRID',1699,497,0,'','\"{I.COLID}\"=>\"{I.DD_CRYPTCD}\"',',','PGMIO.SVC','CRYPTCD!=NONE','L','','','20191029212149',NULL),('GRID',1699,498,0,'',');	\n','','','','R','','','20191029212149',NULL),('GRID',1702,499,0,'','		//V_GRPNM : {V.GRPNM}\n		array_push($GRID[\"SQL\"][\"{S.LAST_CRUD}\"], $this->DAO->{S.SQLID}($REQ)); //{F.FNCID}, {F.FNCNM},{S.SQLNM}\n','','PGMSQLR','','L','','N','20191029212149',NULL),('GRID',1725,500,10,'매퍼호출','{P.PGMID#L}Mapper.{S.SQLID}(params)',',','','','R','','','20191029212152',NULL),('GRID',1733,501,10,'','		array_push($GRID[\"SQL\"], $this->DAO->{S.SQLID}($REQ)); // {V.FNCID}, {V.FNCNM}, {S.SQLNM}\n','','PGMSQLR','','L','','','20191029212153',NULL),('GRID',1749,502,10,'sum','							//특정 컬럼 합계 구하기. {G.GRPNM}.\n							var out = 0, ind=mygrid{G.GRPID}.getColIndexById(\"{I.COLID}\");\n							for(var i=0;i<mygrid{G.GRPID}.getRowsNum();i++){\n								tmp = mygrid{G.GRPID}.cells2(i,ind).getValue();\n								if($.isNumeric(tmp)){\n									out+= parseFloat(tmp);\n								}\n							}\n							//천단위 금액 표기\n							out = formatNumber(out);\n																			 \n							$(\"#{G.GRPID}-{I.COLID}_SUM\").text(out);	\n\n																			 ','','','','R','I.FOOTERMATH=SUM&&I.FOOTERMATH=SUM','','20191029212154',NULL),('GRID',1749,503,20,'avg','							//특정 컬럼 평균 구하기. {G.GRPNM}.\n							var out = 0, ind=mygrid{G.GRPID}.getColIndexById(\"{I.COLID}\");\n							for(var i=0;i<mygrid{G.GRPID}.getRowsNum();i++){\n								tmp = mygrid{G.GRPID}.cells2(i,ind).getValue();\n								if($.isNumeric(tmp)){																			 \n									out+= parseFloat(tmp);\n								}\n							}\n							out = Math.round(out/mygrid{G.GRPID}.getRowsNum());\n												 \n							$(\"#{G.GRPID}-{I.COLID}_SUM\").text(out);\n','','','','R','I.FOOTERMATH=AVG','','20191029212154',NULL),('GRID',1749,504,30,'min','							//특정 컬럼 최소값 구하기. {G.GRPNM}.\n							var out = 0, ind=mygrid{G.GRPID}.getColIndexById(\"{I.COLID}\");\n							for(var i=0;i<mygrid{G.GRPID}.getRowsNum();i++){\n								tmp = mygrid{G.GRPID}.cells2(i,ind).getValue();\n								if($.isNumeric(tmp) && out > parseFloat(tmp) ){																			 \n									out = parseFloat(tmp);\n								}\n							}\n							//천단위 금액 표기\n							out = formatNumber(out);\n																			 \n							$(\"#{G.GRPID}-{I.COLID}_SUM\").text(out);','','','','R','I.FOOTERMATH=MIN','','20191029212154',NULL),('GRID',1749,505,40,'max','							//특정 컬럼 최대값 구하기. {G.GRPNM}.\n							var out = 0, ind=mygrid{G.GRPID}.getColIndexById(\"{I.COLID}\");\n							for(var i=0;i<mygrid{G.GRPID}.getRowsNum();i++){\n								tmp = mygrid{G.GRPID}.cells2(i,ind).getValue();\n								if($.isNumeric(tmp) && out < parseFloat(tmp) ){\n									out = parseFloat(tmp);\n								}\n							}\n							//천단위 금액 표기\n							out = formatNumber(out);\n																			 \n							$(\"#{G.GRPID}-{I.COLID}_SUM\").text(out);','','','','R','I.FOOTERMATH=MAX','','20191029212154',NULL),('GRID',1749,506,50,'cnt','							//특정 행수 구하기. {G.GRPNM}.\n							var out = 0, ind=mygrid{G.GRPID}.getColIndexById(\"{I.COLID}\");\n							out = mygrid{G.GRPID}.getRowsNum();\n\n							//천단위 금액 표기\n							out = formatNumber(out);\n																			 \n							$(\"#{G.GRPID}-{I.COLID}_SUM\").text(out);','','','','R','I.FOOTERMATH=CNT','','20191029212154',NULL),('GRIDBT',1793,507,10,'','		//V_GRPNM : {V.GRPNM}\n		array_push($GRID[\"SQL\"], $this->DAO->{S.SQLID}($REQ)); //{F.FNCID}, {F.FNCNM},{S.SQLNM}\n','','PGMSQLR','','L','','','20191029212202',NULL),('GRIDBT',1800,508,10,'','			,{\n','','','','R','','','20191029212203',NULL),('GRIDBT',1800,509,20,'','			field: \'{I.COLID}\',\n','','','','R','','','20191029212203',NULL),('GRIDBT',1800,510,30,'','			title: \'{I.COLNM}\',\n','','','','R','','','20191029212203',NULL),('GRIDBT',1800,511,40,'','			checkbox: true,\n','','','','R','I.OBJTYPE=ROWCHECK','','20191029212204',NULL),('GRIDBT',1800,512,45,'','			radio: true,\n','','','','R','I.OBJTYPE=ROWRADIO','','20191029212204',NULL),('GRIDBT',1800,513,50,'','			visible: false,\n','','','','R','I.HIDDENYN=Y','','20191029212204',NULL),('GRIDBT',1800,514,60,'','			sortable: true,\n','','','','R','I.OBJTYPE!=ROWCHECK&&I.OBJTYPE!=ROWRADIO','','20191029212204',NULL),('GRIDBT',1800,515,70,'','			align: \'{I.OBJALIGN#L}\',\n','','','','R','','','20191029212204',NULL),('GRIDBT',1800,516,80,'','			formatter:\'bt4TableLinkFormatter\',\n','','','','R','I.OBJTYPE=LINK','','20191029212204',NULL),('GRIDBT',1800,517,85,'','			formatter:\'bt4TableMultiLinkFormatter\',\n','','','','R','I.OBJTYPE=MULTILINK','','20191029212204',NULL),('GRIDBT',1800,518,90,'','			valign: \'middle\'\n','','','','R','','','20191029212204',NULL),('GRIDBT',1800,519,90,'','			}\n','','','','R','','','20191029212204',NULL),('GRIDBT',1803,520,10,'','		lastinput{GR.GRPID} = new HashMap(); // {GR.GRPNM}\n','','','','R','','','20191029212205',NULL),('GRIDBT',1803,521,20,'','		lastinput{GR.GRPID}.set(\"{G.GRPID}-{I.COLID}\", row.{I.COLID}); // {I.COLNM}\n','','PGMIO.CHILD','','L','','','20191029212205',NULL),('GRIDBT',1809,522,10,'','		array_push($GRID[\"SQL\"], $this->DAO->{S.SQLID}($REQ)); // {V.FNCID}, {V.FNCNM}, {S.SQLNM}\n','','PGMSQLR','','L','','','20191029212206',NULL),('GRIDBT',1824,523,10,'','		strSelectedRowsIds += jsonSelectedRows[i].{I.COLID};\n','','','','R','I.KEYYN=Y','','20191029212209',NULL),('GRIDBT',1833,524,10,'KEY ID','			data-id-field=\"{I.COLID}\"','','','','R','I.KEYYN=Y','','20191029212211',NULL),('GRIDBT',1835,525,10,'','					<th\n						data-field=\"{I.COLID}\"\n						data-width=\"{I.OBJWIDTH}\" \n						data-align=\"{I.OBJALIGN#L}\"\n						data-width-unit=\"{G.COLSIZETYPE_CDVAL}\"\n','','','','R','','','20191029212211',NULL),('GRIDBT',1835,526,20,'','						data-sortable=\"true\" \n','','','','R','I.OBJTYPE!=INPUTCHECK&&I.OBJTYPE!=INPUTRADIO','','20191029212211',NULL),('GRIDBT',1835,527,30,'','						data-visible=\"true\"\n','','','','R','I.HIDDENYN=N','','20191029212211',NULL),('GRIDBT',1835,528,35,'','						data-visible=\"false\"\n','','','','R','I.HIDDENYN=Y','','20191029212211',NULL),('GRIDBT',1835,529,40,'','						data-checkbox=\"true\"\n','','','','R','I.OBJTYPE=INPUTCHECK','','20191029212211',NULL),('GRIDBT',1835,530,50,'','						data-halign=\"center\"\n','','','','R','','','20191029212211',NULL),('GRIDBT',1835,531,55,'','					data-formatter=\"bt4TableLinkFormatter\"\n','','','','R','I.OBJTYPE=LINK','','20191029212211',NULL),('GRIDBT',1835,532,57,'','					data-formatter=\"bt4TableMultiLinkFormatter\"\n','','','','R','I.OBJTYPE=MULTILINK','','20191029212211',NULL),('GRIDBT',1835,533,60,'','					>{I.COLNM}\n					</th>\n','','','','R','','','20191029212211',NULL),('ASVRSVC',1843,534,10,'header','	//{G.GRPNM}, {F.FNCNM}\n	public function go{G.GRPID#C}{F.FNCID#C}(){\n		global $REQ,$CFG,$_RTIME, $log;\n		$rtnVal = null;\n		$tmpVal = null;\n		$grpId = null;\n		$rtnVal->GRP_DATA = array();\n\n		$log->info(\"{P.PGMID}Service-go{G.GRPID#C}{F.FNCID#C}________________________start\");\n','','','','R','','N','20191029212126','20191119060834'),('ASVRSVC',1843,535,20,'svrsvc','','','PGMSVC.OBJD','UILANG=PHP&&OBJVALTYPE=SVRSVC&&FNCTYPE=NOT NULL','C','','N','20191029212126',NULL),('ASVRSVC',1843,536,25,'return json','		//처리 결과 리턴\n		$rtnVal->RTN_CD = \"200\";\n		$rtnVal->ERR_CD = \"200\";\n		echo json_encode($rtnVal);\n','','','','R','','N','20191029212126',NULL),('ASVRSVC',1843,537,30,'footer','		$log->info(\"{P.PGMID}Service-go{G.GRPID#C}{F.FNCID#C}________________________end\");\n	}\n','','','','R','','N','20191029212126','20191118171437');
/*!40000 ALTER TABLE `CG_OBJINFOB` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-02-18  6:04:32
