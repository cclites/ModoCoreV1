<?php

//$currenmarket is guaranteed to have a value.
function checkTransactions($bot, $ticker)
{
	writeLog("@@@@ Checking Transactions For Bot ". $bot->getId()  ." @@@@@");
	
	//No reason to do an additional assignment
	
	$direction = $ticker->getDirection();
	$trend = $ticker->getTrend();
	$last = $ticker->getLast();
	
	$btc = $bot->getLedger()->getBtc();
	$usd = $bot->getLedger()->getUsd();
	$base = $bot->getLedger()->getBase();
	$canBuy = $bot->getConfigs()->getCanBuy();
	$canSell = $bot->getConfigs()->getCanSell();
	$ppp = $bot->getConfigs()->getPpp();
	$spp = $bot->getConfigs()->getSpp();
	$fixed_sell = $bot->getConfigs()->getFixedSell();
	$fixed_buy = $bot->getConfigs()->getFixedBuy();
	$fixed_sell_price = $bot->getConfigs()->getFixedSellAmount();
	$fixed_buy_price = $bot->getConfigs()->getFixedBuyAmount();
	
	$bLimit = $bot->getConfigs()->getBuyLimitBtc();
	$sLimit = $bot->getConfigs()->getSellLimitBtc();
	
	writeLog("---- Sell order size (in btc) (pre) " . $sLimit);
	writeLog("---- Buy order size (in btc) (pre) " . $bLimit);
	
	if($bLimit == 0)
	{
		$bLimit = $usd/$last;
	}
	elseif(($bLimit * $last) >= $usd)
	{
		$bLimit = $usd/$last;
	}
	
	if($sLimit == 0)
	{ 
		$sLimit = $btc;
	}
	else if( $btc < $sLimit) 
	{
		$sLimit = $btc;
	}
	
	$live = $bot->getLive();
	$isTesting = $bot->getConfigs()->getTestingMode();
	
	
	//bot is live and not testing
	if($live && !$isTesting)
	{
		if($sLimit > 1)
		{
		  $sLimit = 1;	
		}
		
		if($bLimit > 1)
		{
			$bLimit = 1;
		}
	}
	
	
	$sellCost = ($sLimit * $last); 
	$buyCost = ($bLimit * $last);
	
	$sellFee = $sellCost * $bot->getConfigs()->getExchangefee();
	$buyFee = $buyCost * $bot->getConfigs()->getExchangefee();
	
	$totalSellCost = $sellCost + $sellFee;
	$totalBuyCost = $buyCost + $buyFee;
	
	$fixedSellCost = ($sLimit * $fixed_sell_price);
	$fixedBuyCost = ($bLimit * $fixed_buy_price);
	
	$fixedSellFee = $fixedSellCost * $bot->getConfigs()->getExchangefee();
	$fixedBuyFee = $fixedBuyCost * $bot->getConfigs()->getExchangefee();
	
	$totalFixedBuyCost = $fixedBuyCost + $fixedBuyFee;
	$totalFixedSellCost = $fixedSellCost + $fixedSellFee;
	
	writeLog("Sell order size (in btc) (post) " . $sLimit);
	writeLog("Buy order size (in btc) (post)" . $bLimit);
	writeLog("Purchase cost is $buyCost");
	writeLog("Usd available = $usd");
	writeLog("Btc available = $btc");
	writeLog("Direction is $direction");
	writeLog("Bot can buy = $canBuy");
	writeLog("Bot can sell = $canSell");
	writeLog("Purchase Price Point = $ppp");
	writeLog("Sell Price Point = $spp");
	writeLog("sell cost = $sellCost");
	writeLog("buy cost = $buyCost");
	writeLog("last is = $last");
	writeLog("Total sell cost = $totalSellCost");
	writeLog("Total buy cost = $totalBuyCost");
	writeLog("Total fixed sell cost = $fixedSellCost");
	writeLog("Total fixed buy cost = $fixedBuyCost");
	writeLog("Fixed sell fee is $fixedSellFee");
	writeLog("FixedBuyFee is $fixedBuyFee");
	writeLog("totalFixed buy cost = $totalFixedBuyCost");
	writeLog("total fixed sell cost = $totalFixedSellCost");
	writeLog("fixed sell = $fixed_sell");
	writeLog("fixed buy = $fixed_buy");
	
	
	writeLog("\n\n");
	
	$sellTotal = 0;
	$buyTotal = 0;
	
	$ppp = str_replace(",", "", $ppp);
	$spp = str_replace(",", "", $spp);
	
	if($ppp > $last)
	{
		writeLog("Purchase price has been reached. Buy total +1");
		$buyTotal += 1;
	}
	
	if($usd >= $totalBuyCost)
	{
		writeLog("There is enough USD available. Buy total +1.");
		$buyTotal += 1;
	}
	
	if($direction == 1)
	{
		writeLog("Direction is increasing. Buy total +1");
		$buyTotal += 1;
	}
	
	if($canBuy)
	{
		writeLog("Bot can buy. Buy total +1");
		$buyTotal += 1;
	}
	
	if($totalBuyCost> 0)
	{
		writeLog("Total cost is greater than 0. Buy total +1 (Protect against $0 transaction)");
		$buyTotal += 1;
	}
	
	if($buyTotal == 5)
	{
		writeLog("All conditions met for purchase. Trigger sale.......\n\n");
	}
	else
	{
		writeLog("Buy total is $buyTotal");
		writeLog("Conditions for purchase not met.\n<br>");
	}
	
	if($spp < $last)
	{
		writeLog("Sell price point met. Sell total +1");
		$sellTotal += 1;
	}
	
	if($btc >= $sLimit)
	{
		writeLog("Have enough btc. Sell total +1");
		$sellTotal += 1;
	}
	
	if($direction == -1)
	{
		writeLog("Direction is decreasing. Sell total +1");
		$sellTotal += 1;
	}
	
	if($canSell)
	{
		writeLog("Bot can sell. Sell total +1");
		$sellTotal += 1;
	}
	
	if($sellCost > 0)
	{
		writeLog("Sell order is greater than zero. Sell total +1");
		$sellTotal += 1;
	}
	
	if($sellTotal == 5)
	{
		writeLog("All conditions met for sale. Trigger purchase.");
	}
	else
	{
		writeLog("Sell Total is $sellTotal");
		writeLog("Conditions for sale not met.<br>");
	}

	if($buyTotal == 5)
	{
		writeLog ("CREATING BUY TRANSACTION\n");
		createBuyTransaction($bot, $bLimit, $last);
	}
	else if($sellTotal == 5)
	{
		writeLog("CREATING SELL TRANSACTION\n");
		createSellTransaction($bot, $sLimit, $last);
	}
	else if($fixed_sell == 1 && $sLimit > 0 && $last >= $fixed_sell_price )
	{
	    writeLog("CREATING FIXED SELL TRANSACTION\n");
		createSellTransaction($bot, $sLimit, $last);
		disableFixedTransaction("s", $bot->getId());
	}
	else if($fixed_buy == 1 && $buyCost <= $usd && $bLimit > 0 && $last < $fixed_buy_price)
	{
		writeLog ("CREATING FIXED BUY TRANSACTION\n");
		createBuyTransaction($bot, $bLimit, $last);
		disableFixedTransaction("b", $bot->getId());
	}
}

/* createSellTransaction  */
function createSellTransaction($bot, $limit, $last)
{

    writeLog("Creating Sell Transaction for bot: " . $bot->getId(), TEST);
	//limit is actual order size in btc
	writeLog("%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%");
	writeLog("%%% SELL Order size in BTC = $limit");
	
	$cost = ($limit * $last);
	
	$limit = number_format($limit,8);
	
	writeLog("%%% Last price is $last");
	writeLog("%%% Cost is $cost");
	
	calculateFees($bot, $cost, $feeUsd, $feeBtc);
	
	$cost = number_format($cost, 8);
	
	writeLog("%%% Fee in USD is $feeUsd");
	writeLog("%%% Fee in BTC is $feeBtc");
	
	if($bot->getConfigs()->getTestingMode())
	{
		//This will also update the bot ledger at the same time.
		updateTestLedger($bot, $limit, $feeUsd, $feeBtc, $last, "s");

	}
	else
	{
		$apiKey = $bot->getUser()->getApiKey();
		dCrypt($apiKey, $decrypttext);
		$tokens = explode("|", $decrypttext);
		$bs = new Bitstamp($tokens[0], $tokens[1],$tokens[2]);
		
		$result = "";
		writeLog("Creating sell transaction:  $limit : $last", TEST);
		$result = $bs->bitstamp_query("sell", array('amount'=>($limit - $feeBtc),'price'=>$last));
		$s = print_r($result, true);
		writeLog($s);
		writeLog($s, TEST);
		
		//db_updateBase($last, $bot->getId());
		if(!isset($result["error"])){
		
			db_updateBase($last, $bot->getId());
			
		}
		else
		{
			return;
		}
	}	
	
	writeLog("Building Transactions");
		$transaction = array( "owner_id"=>$bot->getId(),
			"category"=>"sell",
			"price"=>$last,
			"amount"=>$limit,
			"fee"=>$feeUsd,
			"currency"=>"BTC",
			"order_id"=>-9999
			);
		
		
		$s = print_r($transaction, true);
		writeLog($s);

        db_insertTransaction($transaction);
}

function createBuyTransaction($bot, $limit, $last)
{
	//limit is actual order size in btc
	writeLog("%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%");
	writeLog("%%% SELL Order size in BTC = $limit");
	
	$cost = ($limit * $last);
	$cost = number_format($cost, 8);
	
	$limit = number_format($limit,8);
	
	writeLog("%%% Last price is $last");
	writeLog("%%% Cost is $cost");
	
	calculateFees($bot, $cost, $feeUsd, $feeBtc);
	
	writeLog("%%% Fee in USD is $feeUsd");
	writeLog("%%% Fee in BTC is $feeBtc");
	
	if($bot->getConfigs()->getTestingMode())
	{
		//This will also update the bot ledger at the same time.
		updateTestLedger($bot, $limit, $feeUsd, $feeBtc, $last, "p");
	}
	else
	{
		$apiKey = $bot->getUser()->getApiKey();
		dCrypt($apiKey, $decrypttext);
		$tokens = explode("|", $decrypttext);
		$bs = new Bitstamp($tokens[0], $tokens[1],$tokens[2]);
		
		//TODO: Capture fees
		
		//Make sure that there are enough fees to make the transaction in the first place.
		
		if( !( $limit * ( $bot->getConfigs()->getExchangeFee()*2 ) <= $bot->getLedger()->getUsd() ) )
			return;
		
		$result = "";
		writeLog("Creating buy transaction:  $limit : $last", TEST);
		
		$result = $bs->bitstamp_query("buy", array('amount'=>($limit - $feeBtc),'price'=>$last));
		$s = print_r($result, true);
		writeLog($s);
		writeLog($s, TEST);
		
		if(!isset($result["error"]))
		{
			db_updateBase($last, $bot->getId());
		}
		else
		{
			return;
		}

	}
	
	$transaction = array( "owner_id"=>$bot->getId(),
		"category"=>"buy",
		"price"=>$last,
		"amount"=>$limit,
		"fee"=>$feeUsd,
		"currency"=>"BTC",
		"order_id"=>-9999
		);
		
		print_r($transaction);
		db_insertTransaction($transaction);
}

/*
function saveTransaction($t)
{
	$transaction = new stdClass();
	
	writeLog("TRANSACTION PARAMETERS:\n");
	$s = print_r($t, true);
	writeLog($s);
	
	$transaction->owner_id = $t["id"];
	$transaction->category = $t["type"];
	$transaction->currency = "btc";
	$transaction->price = $t["price"];
	$transaction->amount = $t["amount"];
	$transaction->fee = $t["fee"];
	$transaction->order_id = "-99999";
	
	db_insertTransaction($transaction);
}
*/

function getTransactionHistory($id)
	{ 
	getTransactionsByOwnerId($tempLog, $id);
	
	$transactions = array();
	
	if(count($tempLog) > 0)
	{
		foreach($tempLog as $temp)
		{
			$t = array("id"=>$temp->getId(),
			"datetime"=>$temp->getDateTime(),
			"category"=>$temp->getCategory(),
			"price"=>$temp->getPrice(),
			"amount"=>$temp->getAmount(),
			"currency"=>$temp->getCurrency(),
			"order_id"=>$temp->getOrderId(),
			"fee"=>$temp->getFee());			  
			
			$transactions[] = $t;			   
		}
	}
	
	//return the array of transaction objects
	echo json_encode(array("transactions"=>$transactions));
}

?>