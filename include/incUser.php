<?
//echo "session_status:" . session_status();
//php5.4이상 echo "ession_status : " . session_status();
if( !isset($_SESSION) ){
	//echo "세션이 시작되지 않았습니다.";
}	


function isLogin(){
	global $_SESSION;
	alog("session[CG_USR_SEQ] : " . $_SESSION["CG_USR_SEQ"]);
	return is_numeric($_SESSION["CG_USR_SEQ"]);
}

function setUserSeq($tSeq){
	global $_SESSION;
    $_SESSION['CG_USR_SEQ'] = $tSeq;
}

function getUserSeq(){
	global $_SESSION;
	return $_SESSION["CG_USR_SEQ"];
}

function getUserId(){
	global $_SESSION;
	return $_SESSION["CG_USR_ID"];
}

function setUserId($tId){
	global $_SESSION;
    $_SESSION['CG_USR_ID'] = $tId;
}


function getUserNm(){
	global $_SESSION;
	return $_SESSION["CG_USR_NM"];
}

function setUserNm($tNm){
	global $_SESSION;
    $_SESSION['CG_USR_NM'] = $tNm;
}

function getLoginSeq(){
	global $_SESSION;
	return $_SESSION["CG_LOGIN_SEQ"];
}

function setLoginSeq($tSeq){
	global $_SESSION;
    $_SESSION['CG_LOGIN_SEQ'] = $tSeq;
}

function getIntroUrl(){
	global $_SESSION;
	return $_SESSION["CG_INTRO_URL"];
}

function setIntroUrl($tUrl){
	global $_SESSION;
    $_SESSION['CG_INTRO_URL'] = $tUrl;
}



//세션만 파기 해야하고, 리다이렉트나 exit하면 안됨.
function logOut(){
	global $_SESSION;
	$_SESSION['CG_USR_ID'] = null;	
	$_SESSION['CG_USR_SEQ'] = null;
	$_SESSION['CG_AUTH'] = null;
	$_SESSION['CG_USR_NM'] = null;
	$_SESSION['CG_INTRO_URL'] = null;

	session_destroy();
}


?>