<?php
//redis에 모두 넣기
if(!require_once("/data/www/lib/php/predis/autoload.php"))die("require predis load fail.");

//세션 사용
$redisClient = new Predis\Client(
	array(
		'scheme' => 'tcp',
		'host'   => 'xxx.xxx.xxx.xxx',
		'port'   => 1234,
		'timeout' => 1
	));
$rtnArray = $redisClient->get("CONFIG_CG");//CONFIG_PJTID
$redisClient->quit();

return json_decode($rtnArray,true);
?>