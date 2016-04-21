<?php

function buildBotView($id)
{
    getAllActiveBotsById($botState,$id);
	//print_r($botState);
}

function getBalanceSummary($bot)
{
    //print_r($bot);

	$str = "";
	$str .= "        <tbody>\n"; 
	$str .= "            <tr>\n"; 
	$str .= "                <th>USD: </th><td id='availableUsd" . $bot["id"] ."' ng-controller='balance.usd'>" . $bot["usd"] . "</td>\n"; 
	$str .= "                <th>BTC: </th><td id='availableBtc". $bot["id"]. "'  ng-controller='balance.btc'>" . $bot["btc"] ."</td>\n"; 
	$str .= "                <th>Purchase Price Point: </th><td id='ppp". $bot["id"]. "' ng-controller='balance.ppp'>" . $bot["ppp"] ."</td>\n"; 
	$str .= "                <th>Sell Price Point: </th><td id='spp". $bot["id"]. "' ng-controller='balance.spp'>" . $bot["spp"] ."</td>\n"; 
	$str .= "           </tr>\n";
	$str .= "       </tbody>\n"; 
	
	return $str;
}

?>