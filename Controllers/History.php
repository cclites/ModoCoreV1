<?php

function getBotHistory(&$historicalData, $id)
{
	getHistoricData($historicalData, $id);
	
	//if $historicData is empty, reset the bot history.
}

function resetBotHistory($token, $session, $id)	//need the bot id to reset
{
	//need to check tokens first
	//dCrypt($session, $decrypttext);
	
	//echo "$decrypttext\n";
	//return;
	
	//if(isset($_SESSION["authenticated"]) && $_SESSION["authenticated"])
	//if($token == $decrypttext["token"])
	//{ 
		getBotById($bot, $id);
		getPreviousTicker($ticker, $bot["exchange"], "btc");
		
		$usd = ($bot["btc"] * $ticker->getLast() + $bot["usd"]);
		
		$date = date("y/m/d H:i:s");	
		
		$historicalData->high = str_replace(",", "", number_format($usd,2));
		$historicalData->low = str_replace(",", "", number_format($usd,2));
		$historicalData->date_low = $date;
		$historicalData->date_high = $date;
		$historicalData->start_usd = $bot["usd"];
		$historicalData->start_btc = $bot["btc"];
		$historicalData->owner_id = $ownerId;
		$historicalData->currency = "BTC";	
		
		$history = new History($historicalData);
		updateHistorical($history, $id);
	//}
}

function updateHistoricalData($ticker, $id)
{	
	$date = date("y/m/d H:i:s");
	
	if($ticker->getLast())
	{
		writeLog("Ticker is " . $ticker->getLast(), TEST);
		//writeLog("Ticker is " . $ticker->getLast());
		
		getBotById($bot, $id);
		
		getHistoricData($historicalData, $id);
		
		//echo("Historical Data: <br>");
		//print_r($historicalData);

        $amount = "";
		$amount = ( $bot["btc"] * $ticker->getLast() ) + $bot["usd"];
		
		writeLog("Amount is " . $amount, TEST);
		writeLog("Historic low is " . $historicalData->getLow(), TEST );
		writeLog("Historic high is " . $historicalData->getHigh(), TEST );
		
		if($amount < $historicalData->getLow())
		{
		    writeLog("Going lower $amount");
		    $historicalData->setLow(number_format($amount,2));
		    $historicalData->setDateLow($date);
		}
		else if( $amount > $historicalData->getHigh())
		{
		    writeLog("Going higher");
		    $historicalData->setLow(number_format($amount,2));
			$historicalData->setDateHigh($date);
		}
		
		$history = new History($historicalData);
		updateHistorical($history, $id);
	}
}
?>