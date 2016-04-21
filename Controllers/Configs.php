<?php
function updateConfigs($get)
{

    writeLog("Updating configs");
    $s = print_r($get, true);
	writeLog($s);

	$botId = $get["id"];
	$token = $get["args"]["token"];
	//$session = $get["args"]["session"];
	//$configs = json_decode(stripslashes($get["configs"]));
	$configs = $get["configs"];
	$base = $get["base"];
	
	//if(isset($_SESSION["authenticated"]) && $_SESSION["authenticated"])
	//{	
		db_updateConfigs($configs, $botId, $base);
		echo true;
	//}
	
	//Testing
	//dCrypt($session, $token, $_SESSION["id"], $decrypttext);
	
	/*
	$s = print_r($decrypttext, true);
	writeLog("$s", TEST);
	//echo "\nToken is: $token\n";
	
	if($token == $decrypttext["token"])
	{
	  db_updateConfigs($configs, $botId, $base);
	}
	else
	{
	  writeLog("Failed to decrypt token.", TEST);	
	}
	*/
}
?>
