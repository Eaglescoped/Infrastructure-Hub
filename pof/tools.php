<?php
//==============================================================================================================
function getUrlContent($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	$data = curl_exec($ch);
	$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	return ($httpcode>=200 && $httpcode<300) ? $data : false;
}
//==============================================================================================================
function getUEE($user){
	$getinfo = getUrlContent("https://robertsspaceindustries.com/citizens/".$user);
	if($getinfo != false){
		$UEE = explode("<span class=\"label\">UEE Citizen Record</span>", $getinfo);
		$UEE = explode("<strong class=\"value\">", $UEE[1]);
		$UEE = explode("</strong>", $UEE[1]);
		return $UEE[0];
	}
	return "No User";
}
//==============================================================================================================
function getHandle($user){
	$getinfo = getUrlContent("https://robertsspaceindustries.com/citizens/".$user);
	if($getinfo != false){
		$Handle = explode("<span class=\"label\">Handle name</span>", $getinfo);
		$Handle = explode("<strong class=\"value\">", $Handle[1]);
		$Handle = explode("</strong>", $Handle[1]);
		return $Handle[0];
	}
	return "No User";
}
//==============================================================================================================
function getMAINORG($user){
	$getinfo = getUrlContent("https://robertsspaceindustries.com/citizens/".$user);
	if($getinfo != false){
		$MAINORG = explode("<span class=\"label data", $getinfo);
		$MAINORG = explode("</span>", $MAINORG[1]);
		$MAINORG = explode("<strong class=\"value data", $MAINORG[1]);
		$MAINORG = explode("\">", $MAINORG[1]);
		$MAINORG = explode("</strong>", $MAINORG[1]);
		return $MAINORG[0];
	}
	return "No User";
}
//==============================================================================================================
$user = @$_GET['u'];
echo "UEE Citizen Record: " . getUEE($user) . "<br>";
echo "Handle name: " . getHandle($user) . "<br>";
echo "MAIN ORGANIZATION: " . getMAINORG($user) . "<br>";
//==============================================================================================================
?>