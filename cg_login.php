<?php
header("Content-Type: text/html; charset=UTF-8");
header("Cache-Control:no-cache");
header("Pragma:no-cache");


require_once("./incConfig.php");

require_once('./include/incUtil.php');

require_once("./include/incUser.php");



  $tmp = getUserSeq(1);
  
?><!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>Document</title>
 </head>
 <body>
  <form method="post" action="cg_login_ok.php">
    UserSeq = <?=$tmp?>
	<input type="password" name="pw" value="">
	<input type="submit" value="go">
  </form>
 </body>
</html>
