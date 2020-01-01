<?php


//opcache on redis, file(opcache not folder), apcu
// 1.77s, 0.99s, 0.0023s

//redis에 모두 넣기
require_once "/data/www/lib/php/vendor/autoload.php";

echo 111;

$startTm = microtime(true);


  

$startTm = microtime(true);
for($i=0;$i<1000;$i++){
    $redisClient = new Predis\Client(
        array(
            'scheme' => 'tcp',
            'host'   => '172.17.0.1',
            'port'   => 1234,
            'timeout' => 1
        )
    );  

    $tmp = json_decode($redisClient->get("myconfig"),true);
    echo $i . " " ;
    $redisClient->quit();
}
$endTm = microtime(true);
echo "redis : <font color=blue>" . number_format($endTm-$startTm ,4). "</font>";



echo "<hr>";


$startTm = microtime(true);
for($i=0;$i<1000;$i++){
    include "./SC/incConfig.SC.php";
    echo $i . " ";//. " = " . $CFG_LIBS_PATH_REDIS;
}
$endTm = microtime(true);
echo "file : <font color=blue>" . number_format($endTm-$startTm ,4). "</font>";
echo "<hr>";


$tmp = '{
    "CFG_LIBS_PATH_REDIS": "/data/www/lib/php/vendor/predis/predis/autoload.php",
    "CFG_LIBS_PATH_AWS": "/data/www/lib/php/vendor/predis/predis/autoload.php",
    "CFG_LIBS_SQL_PARSER": "/data/www/lib/php/PHP-SQL-Parser/src/PHPSQLParser.php",
    "CFG_LIBS_HTML_PURIFIER": "/data/www/lib/php/HTMLPurifier-4.12.0/library/HTMLPurifier.auto.php",
    "CFG_LIBS_MONO_LOG": "/data/www/lib/php/vendor/autoload.php",
    "CFG_LIBS_EXCEL": "/data/www/lib/php/vendor/autoload.php",
    "CFG_AWS_AID": "AKIAVHXRCVHDMKKQ2NMI",
    "CFG_AWS_KEY": "R9B59Nzi8tPZwucYBw+uOzdBuWVfDVR8NKYILq/s",
    "CFG_MODE": "DEV",
    "CFG_PI_COLIDS": [
        "USR_ID",
        "USR_NM"
    ],
    "CFG_SID_PREFIX": "CG",
    "CFG_PROJECT_NAME": "리얼 만남",
    "CFG_AUTH_LOG": "REDIS",
    "CFG_AUTH_REDIS": "tcp://172.17.0.1:1234",
    "CFG_SEC_KEY": "8F12A9C3BCAFD81D520F7B61140F454842BEEA94A29A01F8",
    "CFG_SEC_IV": "4LUoikddG3mPQsV/ELjRCQ==",
    "CFG_SEC_SALT": "codegen",
    "CFG_DEBUG_YN": "Y",
    "CFG_IMG_EXT": [
        "JPG",
        "JPEG",
        "PNG",
        "GIF",
        "BMP"
    ],
    "CFG_UPLOAD_URL": "/data/www/up/",
    "mysql_host": "172.17.0.1",
    "mysql_userid": "zero12a",
    "mysql_passwd": "kimsclub",
    "mysql_db": "DATING",
    "mysql_m_host": "172.17.0.1",
    "mysql_m_userid": "cg",
    "mysql_m_passwd": "cg1234qwer",
    "mysql_m_db": "CG",
    "mysql_m_port": "3306",
    "mysql_s_host": "172.17.0.1",
    "mysql_s_userid": "zero12a",
    "mysql_s_passwd": "kimsclub",
    "mysql_s_db": "DATING",
    "CFG_ROOT_DIR": "/data/www/c.g/",
    "CFG_LC_DIR": "/data/www/l.c/",
    "CFG_DEPLOY_DIR": "/data/www/r.d/",
    "CFG_DEPLOY_KEY": "MyLoveKim",
    "CFG_LOG_PATH": "/data/www/log/",
    "CFG_LOG_PATH2": "/data/www/log/",
    "CFG_UPLOAD_DIR": "/data/www/up/",
    "CFG_URL_LIBS_ROOT": "http://localhost:8070/"
}';
//apcu_store('foo', $tmp);

$startTm = microtime(true);
for($i=0;$i<1000;$i++){
    $tmp = apcu_fetch('foo');
    echo $i . " ";
}
$endTm = microtime(true);
echo "apcu : <font color=blue>" . number_format($endTm-$startTm ,4) . "</font>";



?>