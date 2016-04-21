<?php

/*********************************************************************
*  getPrevious					- retrieves saved market state.
*
*  Parameters:
*  $ticker						- class object representing the saved market
*                       state.
*  $market						- string representing the exchange description
*  $currency					- string representing the currency type
*********************************************************************/

//The assumption is that the market actually exists.
function getPreviousTicker(&$ticker, $marketId=1, $currency="btc")
{
	$link = new Connect();

	try
	{
		$query = "SELECT *, e.description FROM ticker AS m, exchange AS e WHERE e.id=" . $marketId . " AND m.exchange_id=e.id"; 
		$queryResult = $link->conn->query($query);
		
		//print_r("$query\n");

        $t = mysqli_fetch_assoc($queryResult);

		$ticker = new Ticker(null, $marketId);
		$ticker->setHigh($t["high"]);
		$ticker->setLast($t["last"]);
		$ticker->setBid($t["bid"]);
		$ticker->setVolume($t["volume"]);
		$ticker->setLow($t["low"]);
		$ticker->setAsk($t["ask"]);
		$ticker->setId($marketId);
		$ticker->setTrend($t["trend"]);
		$ticker->setDirection($t["direction"]);
		$ticker->setPrevious(($t["previous"]));
	}
	catch(Exception $e)
	{
		writeLog("Failed to load ticker data. " . $e->getMessage());
		return new stdClass();
	}
	
	return 0;
}


/***********************************************************
*  updateTickerState		- saves market state
*
*  Parameters:
*  $currentMarket   - object representing current 
*                     market state
*  $id				- represents the unique market id
***********************************************************/
function updateTickerState($currentMarket)
{
	$link = new Connect();
	writeLog("Updating ticker state");

	$high = str_replace(",", "", $currentMarket->getHigh());
	$last = str_replace(",", "", $currentMarket->getLast());
	$previous = str_replace(",", "", $currentMarket->getPrevious());
	$bid = str_replace(",", "", $currentMarket->getBid());
	$low = str_replace(",", "", $currentMarket->getLow());
	$ask = str_replace(",", "", $currentMarket->getAsk());
	$direction = $currentMarket->getDirection();
	$trend = $currentMarket->getTrend();
	$id = $currentMarket->getId();
	$volume = number_format($currentMarket->getVolume(), 2);
	$volume = str_replace(",", "", $volume);
	
	try
	{
		$query = "UPDATE ticker 
		SET
		high=$high,
		currency='btc',
		last=$last,
		previous=$previous,
		bid=$bid,
		low=$low,
		ask=$ask,
		direction=$direction,
		trend=$trend,
		volume=$volume
		WHERE
		exchange_id=$id";
		
		$queryResult = $link->conn->query($query);

		writeLog("Updated ticker data");	
	}
	catch(Exception $e)
	{
		writeLog("Failed to load ticker data. " . $e->getMessage());
		return 1;
	}
	return 0;
}

/*
function addNewMarket($market)
{
  $link = new Connect();
  writeLog("Adding new ticker.");
  
  try
  {
  	
  } 
  catch (Exception $e) 
  {	
	writeLog("Failed to add new ticker. " . $e->getMessage());
	return 1;
  }
}
*/

function getTickerById(&$ticker, $id)
{
    $link = new Connect();
	//writeLog("Getting previous ticker.");

	try
	{
		$query = "SELECT * FROM ticker WHERE id=id"; 
		$queryResult = $link->conn->query($query);
		
		$tempTicker = mysqli_fetch_object($queryResult);
		$ticker = new Ticker($tempTicker, $id);

		$ticker->setDirection($tempTicker->direction);
		$ticker->setTrend($tempTicker->trend);
		$ticker->setPrevious($tempTicker->previous);
		$ticker->setLast($tempTicker->last);

	}
	catch(Exception $e)
	{
		writeLog("Failed to load ticker data. " . $e->getMessage());
		return new stdClass();
	}
	
	return 0;	

}

?>
