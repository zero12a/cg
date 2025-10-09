<?php
header("Content-Type: text/html; charset=UTF-8");
header("Cache-Control:no-cache");
header("Pragma:no-cache");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>PGM</title>

	<meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
</head>
<body>
<table>

<tr>
    <td>
    <img src="별의여신.jpg" width="300">
    </td>
    <td>
    <font size=6>1.별의 여신은 변실할수 있을까요?<BR>
    <input type=button value="YES" onclick="alert('네 정답니다.')" style="width:300px;height:50px;font-size:20pt;"><BR>
    <input type=button value="NO" onclick="alert('아쉽네요 틀렸습니다.');"  style="width:300px;height:50px;font-size:20pt;"><BR>
    </font>
    <br>

    <font size=6>2.별의 여신은 모두 몇명 일까요?<BR>
    <input type=button value="6명" onclick="alert('아쉽네요 틀렸습니다.')" style="width:300px;height:50px;font-size:20pt;"><BR>
    <input type=button value="7명" onclick="alert('아쉽네요 틀렸습니다.')" style="width:300px;height:50px;font-size:20pt;"><BR>
    <input type=button value="8명" onclick="alert('아쉽네요 틀렸습니다.')" style="width:300px;height:50px;font-size:20pt;"><BR>
    <input type=button value="9명" onclick="alert('네 정답니다.')" style="width:300px;height:50px;font-size:20pt;"><BR>
    </font>
    </td>
</tr>

<tr>
    <td>
    <img src="별의여신_타로.jpg" width="300">
    </td>
    <td>
    <font size=6>3. 옆에 주인공 이름은 뭘까요?<BR>
    <input type=button value="아롬이" onclick="alert('아쉽네요 틀렸습니다.')" style="width:300px;height:50px;font-size:20pt;"><BR>
    <input type=button value="타로" onclick="alert('네 정답니다.');"  style="width:300px;height:50px;font-size:20pt"><BR>
    </font>
    </td>
</tr>

</table>

</body>
</html>