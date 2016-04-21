<?php

function getActiveBots(&$bots)
{
	getAllActiveBots($bots);
}

function processBotRules($bot)
{
    $s = print_r($bot,TRUE);
    writeLog($s, BOT);
    writeLog(" ", BOT);

    getTicker($ticker, $bot->getExchange());
	
	//getBotBalance();
	if($bot->getLive() == 0 ) 
	{   
	    writeLog("Setting Testing Mode", BOT);
	    $bot->getConfigs()->setTestingMode(1);
	}
	
	if($ticker)
	{
		checkTransactions($bot, $ticker);
		updateHistoricalData($ticker, $bot->getId());
	}

    if(!$bot->getConfigs()->getTestingMode())
	{
	    writeLog("Bot is not testing.", BOT);
		
	    $apiKey = $bot->getUser()->getApiKey();
		
		
	    dCrypt($apiKey, $decrypttext);
		
		
		$tokens = explode("|", $decrypttext);
		
		
		//$bs = new Bitstamp($tokens[0], $tokens[1],$tokens[2]);
		//$result = $bs->bitstamp_query("balance");
		
		$s = print_r($result, true);
		writeLog("$s\n", BOT);
		
		db_updateLedger($result["usd_available"], $result["btc_available"], $bot->getId());
		//saveBalanceInformation($result, $bot->getId());
	}
	else
	{
      writeLog("****Updating test ledger.\n");
	  db_getTestAccount($accountData, $bot->getId());
	  
	  writeLog("Bot id is " . $bot->getId(), TEST);
	  
	  $s = print_r($accountData, true);
		writeLog("$s\n", TEST);
		writeLog("*****************************************", TEST);
	  
	  db_updateLedger($accountData["usd"], $accountData["btc"], $bot->getId());
	
	  writeLog("Bot is testing.", AUTHENTICATE); 
	}
}

function saveBalanceInformation($balance, $id)
{
    writeLog("Save balance information.\n");
	
	$balance["usd_available"] = $usd;
	$balance["btc_available"] = $btc;
	$balance["fee"] = $exchange_fee;
}

function calculatePricePoints(&$bot)
{	
	$ledger = $bot->getLedger();
	$configs = $bot->getConfigs();
	
	$tSpp = ($ledger->getBase() + ( $ledger->getBase() * ($configs->getIncrease()/10)));
	$tPpp = ($ledger->getBase() - ( $ledger->getBase() * ($configs->getDecrease()/10)));
	
	
	$configs->setSpp(number_format($tSpp,2));
	$configs->setPpp(number_format($tPpp,2));
}

function getBotState($token, $session)	//need to be able to add token and session
{
    $bot = array();
	
	//writeLog("Session authenticated = " . $_SESSION["authenticated"], AUTHENTICATE);

    
	//if(isset($_SESSION["authenticated"]) && $_SESSION["authenticated"])
	//{
	    //writeLog("Member has been authenticated", AUTHENTICATE);
	
		getMemberInfo($token, $member);	
	    getBotsByOwnerId($bots, $member["id"]);

	
	for($i = 0; $i <count($bots); $i += 1)
	{
		getAddress($bots[$i]->getId(), $address);
	    calculatePricePoints($bots[$i]);
	
		$ledger = array("usd"=>$bots[$i]->getLedger()->getUsd(), 
		                "btc"=>$bots[$i]->getLedger()->getBtc(),
						"base"=>$bots[$i]->getLedger()->getBase());

		$configs = array("exchange_fee"=>$bots[$i]->getConfigs()->getExchangeFee(),
		                 "increase"=>$bots[$i]->getConfigs()->getIncrease(),
                         "decrease"=>$bots[$i]->getConfigs()->getDecrease(),
                         "is_active"=>$bots[$i]->getConfigs()->getIsActive(),
                         "can_sell"=>$bots[$i]->getConfigs()->getCanSell(),
                         "can_buy"=>$bots[$i]->getConfigs()->getCanBuy(),
                         "sell_limit_btc"=>$bots[$i]->getConfigs()->getSellLimitBtc(),
                         "buy_limit_btc"=>$bots[$i]->getConfigs()->getBuyLimitBtc(),
                         "testing_mode"=>$bots[$i]->getConfigs()->getTestingMode(),
                         "ppp"=>$bots[$i]->getConfigs()->getPpp(),
                         "spp"=>$bots[$i]->getConfigs()->getSpp(),
						 "live"=>$bots[$i]->getLive(),
						 "fixed_sell"=>$bots[$i]->getConfigs()->getFixedSell(),
                         "fixed_buy"=>$bots[$i]->getConfigs()->getFixedBuy(),
						 "fixed_sell_amount"=>$bots[$i]->getConfigs()->getFixedSellAmount(),
                         "fixed_buy_amount"=>$bots[$i]->getConfigs()->getFixedBuyAmount(),
						 "balance"=>$bots[$i]->getConfigs()->getBalance()
						 );
						 
		getBotHistory($hD, $bots[$i]->getId());
		
		if($hD)
		{
			$historic = array("high"=>$hD->getHigh(),
		                  "low"=>$hD->getLow(),
		                  "date_high"=>$hD->getDateHigh(),
		                  "date_low"=>$hD->getDateLow(),
		                  "start_usd"=>$hD->getStartUsd(),
		                  "start_btc"=>$hD->getStartBtc(),
						  );
		}
		else
		{
			$historic = array();
		}
		
		//echo "Bot id is " + $bots[$i]->getExchange() + "\n";

		getPreviousTicker($pTicker, $bots[$i]->getExchange(), "btc");

		$previousTicker =array('high'=>$pTicker->getHigh(),
		                       'low'=>$pTicker->getlow(),
							   'bid'=>$pTicker->getBid(),
							   'volume'=>$pTicker->getVolume(),
							   'ask'=>$pTicker->getAsk(),
							   'previous'=>$pTicker->getPrevious(),
							   'trend'=>$pTicker->getTrend(),
							   'direction'=>$pTicker->getDirection(),
							   'last'=>$pTicker->getLast());
							
		

        $bot[$i]["ledger"] = $ledger;
        $bot[$i]["configs"] = $configs;
		$bot[$i]["historic"] = $historic;
		$bot[$i]["ticker"] = $previousTicker;
		
		$bot[$i]["id"] = $bots[$i]->getId();
	}
	
	//$i = $_SESSION["id"];
	//Changed
	$payload = array("bots"=>$bot, "token"=>$token, "session"=>$session, "address"=>$address);

	echo json_encode($payload);
}

function getAllActiveBotsById(&$bots, $id)
{	
	getActiveBotsById($bot, $id);
}

function calculateFees($bot, $cost, &$feeUsd, &$feeBtc)
{
	$feeRate = $bot->getConfigs()->getExchangeFee();	
	$feeUsd = ($cost * ($feeRate*2));				//Fee in USD
	$feeBtc = $feeUsd/$cost;							//Fee in BTC
}

function updatePassword($post)
{
	$token= $post["args"]["token"];
	$session = $post["args"]["session"];
	$password = $post["pass1"];
	
	getMemberInfo($token, $member);
	
	//print_r($member);
	
	//Hard code for public bot
	if($member["id"] == 64) {
	  echo "Cannot update public ModoBot";
	  return;
	}
	
	//if($member)
	//{
		
	    getBotsByOwnerId($bots, $member["id"]);
		
		$uname = $member["display_name"];
		createToken($uname, $password, $token);
		
		updateToken($token, $member["id"]);	
}

function updateEmail($post)
{
    $token= $post["args"]["token"];
	$session = $post["args"]["session"];
	$email = $post["newMail"];


    //if(isset($_SESSION["authenticated"]) && $_SESSION["authenticated"])
	//{
		getMemberInfo($token, $member);
		
		
		if($member["id"] == 64) {
			echo "Cannot update public ModoBot";
	        return;
		}
		
		setEmail($email, $member["id"]);
	//}
    /*
	dCrypt($session, $token, $_SESSION["id"], $decrypttext);
	
	if($token != $decrypttext["token"])
	{ 
	    echo "Session has expired. Please log out, and log back in.";
	}
	else
	{
	    getMemberInfo($token, $member);
		setEmail($email, $member["id"]);
	}
	*/
}

function isTestBot($botId){
	$publicBotId = 35;   //add to configs
	
	if($botId == 35){
		return true;
	}
	else{
		return false;
	}
}
?>