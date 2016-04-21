<?php

/*********************************************************************
*  getCurrentTicker	- gets the Bitstamp ticker object
*
*  Parameters:
*  $ticker					- array representing a collection of market tickers
*  $idArray					- represents an array of Exchange Ids
*
*  Data Attributes:
*  <high>|<last>|<bid>|<volume>|<last>|<ask>|<direction>|<trend>
**********************************************************************/
function getCurrentTicker( $id){
	

	if($id == 1)  //Bitstamp
	{
		$url = BITSTAMP_GET_TICKER;
	}
	
	
	/*
	$tempTicker = _get($url);
	
	$tempTicker = json_decode($tempTicker[0]);
	
	$a = new stdClass();
	
	$a->high = number_format($tempTicker->high,2);
	$a->last = number_format($tempTicker->last,2);
	$a->bid = number_format($tempTicker->bid,2);
	$a->volume = $tempTicker->volume;
	$a->low = number_format($tempTicker->low,2);
	$a->ask = number_format($tempTicker->ask,2);
	
	$t = new Ticker($a, $id);
	getPreviousTicker($previous, $id, $currency = "btc");
	updateTrend($t, $previous);
	
	//$ticker[] = $t;
	return $t;
	 * */
}

/********************************************************************
*  updateTrend	- update the market trend and direction
*
*  Parameters:
*  $last				- float representing latest market close in USD
*  $lastClose		- float representing previous market close in USD
*
*  Returns:
*  $direction		- representing market direction as an int.
*  $trend				- representing trend as an int.
*********************************************************************/
function updateTrend(&$currentMarket, $previousMarket)
{
	writeLog("**********  Updating trend");
	
	if($currentMarket->getLast() < $previousMarket->getLast())   			// trending down
	{
		writeLog("**********  Trending down. ");
		if( $previousMarket->getDirection() == -1)  // was already decreasing
		{
			$t = $previousMarket->getTrend();
			$currentMarket->setTrend( ($t += 1) );
			$currentMarket->setDirection(1);
		}
		else				//was increasing. Set to direction to decreasing,  and reset trend
		{
			writeLog("**********  Was increasing");
			$currentMarket->setTrend(1);
			$currentMarket->setDirection(-1);
		}
	}
	else if ( $currentMarket->getLast() > $previousMarket->getLast() )   // trending up
	{
		writeLog("**********  Trending up");
		if( $previousMarket->getDirection() == 1)		// Was already increasing
		{
			$t = $currentMarket->getTrend();
			$currentMarket->setTrend( ($t += 1) );
			$currentMarket->setDirection(-1);
		}
		else			// was decreasing. Set direction to increasing
		{
			writeLog("**********  Was decreasing");
			$currentMarket->setTrend(1);
			$currentMarket->setDirection(1);
		}
	}
}
/*************************************************************************/


function updatePreviousTicker(&$cur, &$prev)
{
	$cur->setPrevious($prev->getLast());
}


function addMarket($currentMarket)
{
	newNewMarket($currentMarket);
}

function updateTicker($currentMarket)
{
	updateTickerState($currentMarket);
}

function getTicker(&$ticker, $id)
{
	getTickerById($ticker, $id);
}

?>