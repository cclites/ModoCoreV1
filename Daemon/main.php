<?php
require_once("../Conf/Defines.php");
require_once("../Controllers/Logging.php");

require_once("../Controllers/Authenticate.php");

writeLog("\n\n**********************");
writeLog("Init: " . date ("D M d H:i:s Y") . "\n");

echo("<br><br>**********************<br>");
echo("Init: " . date ("D M d H:i:s Y") . "<br>");

require_once("../Controllers/Sql/Connect.php");
require_once("../Controllers/Sql/Bot.php");
require_once("../Controllers/Sql/Ticker.php");
require_once("../Controllers/Ticker.php");
require_once("../Controllers/Transaction.php");
require_once("../Controllers/Bot.php");
require_once("../Controllers/User.php");
require_once("../Controllers/Sql/User.php");
require_once("../Controllers/Sql/Transaction.php");
require_once("../Controllers/Curl.php");
require_once("../Controllers/Ledger.php");
require_once("../Controllers/Sql/Ledger.php");
require_once("../Controllers/History.php");
require_once("../Controllers/Sql/History.php");
require_once("../Controllers/bitstamp.php");


require_once("../Models/Ticker.php");
require_once("../Models/Ledger.php");
require_once("../Models/Configs.php");
require_once("../Models/Bot.php");
require_once("../Models/User.php");
require_once("../Models/History.php");

$startTime = time();
$link = new Connect();

writeLog("Demon Seeding", TEST);

$currentTicker = getCurrentTicker(1);

//writeLog($currentTicker);
echo "Type of ticker is " . getType($currentTicker);

if(!count($currentTicker)) 
{
	writeLog("Unable to retrieve markets. Quitting.");
	echo("Unable to retrieve markets. Quitting.<br>");
	return $currentTicker = array();
}
else
{
	echo("Retrieved " . count($currentTicker) . " markets.<br>");
	writeLog("Retrieved " . count($currentTicker) . " markets.");
	
	$tTicker[0] = $currentTicker;
	
	for($i = 0; $i< count($tTicker); $i += 1)
	{

		echo "***************************************************<br>\n";
		//writeLog("Updating ticker " . $currentTicker[$i]->getId());
		getPreviousTicker($previousTicker, $tTicker[$i]->getId(), "btc");
		
		updatePreviousTicker($tTicker[$i], $previousTicker);
		//updateTrend($currentTicker[$i], $previousTicker);
		
		
		//$s = print_r($currentTicker[$i]);
		//echo "$s\n";
		
		updateTicker($tTicker[$i]);
		echo "***************************************************<br>\n";
	}
}

botUpdateRoutine();

function botUpdateRoutine()
{

    writeLog("Getting Active bots");
	getActiveBots($bots);
	
	for($i = 0; $i < count($bots); $i += 1)
		{  
		calculatePricePoints($bots[$i]);
		processBotRules($bots[$i]);
	}
	
}

function sweepWallets(){
	//I need a wallet id. Where am I keeping those?
}

$endTime = time();

$totalTime = ($endTime - $startTime);

echo "Total time = $totalTime";

?>