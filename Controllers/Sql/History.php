<?php

function getHistoricData(&$historicalData, $id)
	{	
	try
	{
		$link = new Connect();
		$query = "SELECT * FROM historic WHERE owner_id=$id";
		
		//echo "\n$query\n<br>";
		
		$queryResult = $link->conn->query($query);
		
		$hD = mysqli_fetch_object($queryResult);
		
		$historicalData = "";
		
		if($hD)
		{
			$historicalData = new History($hD);
		}
		
		//echo "====== HISTORIC DATA ========\n";
		//print_r($historicalData);
	}
	catch(Exception $e)
	{
		writeLog("Failed to retrieve historical data.\n");
		return 1;
	}
	return 0;
}

function resetHistoricData($id)
{
	try
	{
		$link = new Connect();
		$query = "DELETE FROM historic WHERE owner_id=$id";
		$queryResult = $link->conn->query($query);	
		
		//getPreviousMarket($ticker, 1, "btc");
		getTicker($ticker, $id);
		updateHistoricalData($ticker, $id);
		
	}
	catch(Exception $e)
	{
		writeLog("Failed to reset historical data.");
		return 1;
	}
	return 0;
}

function updateHistorical($historicalData, $id)
{
	
	writeLog("Updating historical data for account id: $id");
	
	$high = $historicalData->getHigh();
	$low = $historicalData->getLow();
	$date_low = $historicalData->getDateLow();
	$date_high = $historicalData->getDateHigh();
	$start_usd = $historicalData->getStartUsd();
	$start_btc = $historicalData->getStartBtc();
	
	
	try
	{
		$link = new Connect();
		
		$query = "SELECT * FROM historic WHERE owner_id=$id";
		
		$queryResult = $link->conn->query($query);
		
		if($queryResult && $row = $queryResult->fetch_object())
		{
			$query = "UPDATE historic SET
			high=$high,
			low=$low,
			date_low='$date_low',
			date_high='$date_high',
			start_usd=$start_usd,
			start_btc=$start_btc
			WHERE
			owner_id=$id";
		}
		
		else
		{
			$query = "INSERT INTO
			historic
			(high, low, date_low, date_high, start_usd, start_btc, owner_id)
				VALUES
			($high, $low, '$date_low', '$date_high', $start_usd, $start_btc, $id)";
		}
		
		$queryResult = $link->conn->query($query);

	}
	catch(Exception $r)
	{
		writeLog("Error updating historical data for account id: $id" . $e->getMessage());
		return 1;
	}
	return 0;
}

function addHistoric($ticker, $ownerId)
{
	$link = new Connect();
	$date = date("y/m/d H:i:s");
	
	$default = ( ($ticker->getLast() * 5) + 500);
	
	$historicalData->high = str_replace(",", "", number_format($default,2));
	$historicalData->low = str_replace(",", "", number_format($default,2));
	$historicalData->date_low = $date;
	$historicalData->date_high = $date;
	$historicalData->start_usd = 500;
	$historicalData->start_btc = 5;
	$historicalData->owner_id = $ownerId;
	$historicalData->currency = "BTC";
	
	$history = new History($historicalData);
	updateHistorical($history, $ownerId);
	
}
?>