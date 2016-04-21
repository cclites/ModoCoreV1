<?php

function buildTickerView()
{
    // Hard-coded for Bitstamp
    $idArray = array("1");
	
	//Returns an array of tickers
    getCurrentTicker($ticker, $idArray);
	
	//TODO: This will need to loop to process multiple exchanges
    echo formatTickerView($ticker[0]);
	
}

function formatTickerView($ticker)
{
	$html = "";
	$html .= "            <table>\n";
	$html .= tickerTableBody($ticker);
	$html .= "            </table>\n";
	return $html;
}

function tickerTableBody($ticker)
{
	$html = "";
	$html .= "              <tbody>\n";
	$html .= "                <tr>\n";
	$html .= "                  <th rowspan='2' id='exchangeTh'>Bitstamp</th>\n";
	$html .= "                  <th>Last</th>\n";
	$html .= "                  <th>Previous</th>\n";
	$html .= "                  <th>Volume</th>\n";
	$html .= "                 <th>High</th>\n";
	$html .= "                  <th>Low</th>\n";
	$html .= "                  <th>Bid</th>\n";
	$html .= "                  <th>Ask</th>\n";
	$html .= "                  <th>Trend</th>\n";
	$html .= "                </tr>\n";
	$html .= "                <tr>\n";
	$html .= "                  <td>".$ticker->getLast()."</td>\n";
	$html .= "                  <td>".$ticker->getPrevious()."</td>\n";
	$html .= "                  <td>".$ticker->getVolume()."</td>\n";
	$html .= "                  <td>".$ticker->getHigh()."</td>\n";
	$html .= "                  <td>".$ticker->getLow()."</td>\n";
	$html .= "                  <td>".$ticker->getBid()."</td>\n";
	$html .= "                  <td>".$ticker->getAsk()."</td>\n";
	
	$trend = "Rising";
	if($ticker->getDirection() < 0) $trend = "Falling";
	
	$html .= "                  <td>".$trend."</td>\n";
	$html .= "                </tr>\n";
	$html .= "              </tbody>\n";
	
	return $html;
}

?>