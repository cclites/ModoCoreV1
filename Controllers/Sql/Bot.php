<?php
function getAllActiveBots(&$bot)
{
    $link = new Connect();

	$query = "SELECT * FROM bot WHERE is_active=1";
	$queryResult = $link->conn->query($query);

	while ($row = $queryResult->fetch_object())
	{
	    getUserById($user, $row->id);
		
		if (!$user) continue;
		$tBot = new Bot($row, $user);
		
		//Need to get the history
		getHistoricData($historicalData, $row->id);
		$tBot->setHistory($historicalData);
		$bot[] = $tBot;
	}
}

function disableFixedTransaction($type, $id)
{
    $link = new Connect();

	if($type == "s")
	{
		$query = "UPDATE bot set fixed_sell=0 where owner_id=$id";
	}
	else
	{
		$query = "UPDATE bot set fixed_buy=0 where owner_id=$id";
	}
	
	$queryResult = $link->conn->query($query);
}

function getBotsByOwnerId(&$bot, $ownerId)
{
	$link = new Connect();	
	$query = "SELECT * FROM bot WHERE owner_id=" . $ownerId;
	
	$queryResult = $link->conn->query($query);

	while ($row = $queryResult->fetch_object())
	{
	    getUserById($user, $row->id);
		$bot[] = new Bot($row, $user);
	}
}

function getBotById(&$bot, $id)
{
	$link = new Connect();
	
	$query = "SELECT * FROM bot WHERE id=$id";
	$queryResult = $link->conn->query($query);
	$bot = mysqli_fetch_assoc($queryResult);
}

function getActiveBotsById(&$bots, $id)
{
	$link = new Connect();
	$bots = array();

	$query = "SELECT * FROM bot WHERE is_active=1 AND exchange = 1";
	
	$queryResult = $link->conn->query($query);
	
	while ($row = $queryResult->fetch_object())
	{
	  getUserById($user, $row->id);
	  $b = new Bot($row, $user);
	  calculatePricePoints($b);
	  $bots[] = $b;
	}
}

function db_updateBase($base, $id)
{
	try
	{
		$link = new Connect();
		$query = "UPDATE bot SET base=$base WHERE id=$id";
		$queryResult = $link->conn->query($query);
	}
	catch(Exception $e)
	{
		writeLog("Error updaing base $owner_id. " . $e->getMessage());
		return 1;
	}
	return 0;
}

function addNewBot($id, $ticker)
{	

	$base = $ticker->getLast();
	$usd = 500;
	$btc = 5;
	$exchange_fee = .005;
	$increase = .5;
	$decrease = .5;
	$is_active = 0;
	$buy_limit_btc = 1;
	$sell_limit_btc = 1;
	$owner_id = $id;
	$testing_mode = 1;
	$buying = 0;
	$selling = 0;
	$fixed_buy = 0;
	$fixed_sell = 0;
    $fixed_sell_amount = 0;
	$fixed_buy_amount = 0;
	$link = new Connect();

	try
	{
		$query = "INSERT INTO bot
		(base, usd, btc, exchange_fee, increase, decrease, is_active, 
		buy_limit_btc, sell_limit_btc, owner_id, testing_mode, can_buy, can_sell, exchange,
		fixed_buy, fixed_sell, fixed_buy_amount, fixed_sell_amount)
			VALUES
		($base, $usd, $btc, $exchange_fee, $increase, $decrease, $is_active,  
		$buy_limit_btc, $sell_limit_btc, $owner_id, $testing_mode, $buying, $selling,1,
		$fixed_buy, $fixed_sell, $fixed_buy_amount, $fixed_sell_amount)";
		
		$queryResult = $link->conn->query($query);
		
		//Get bot by owner id									
	}
	catch(Exception $e)
	{
		writeLog("Failed to insert new record." . $e->getMessage());
		return 1;
	}
	return 0;
}

function updateBotBalance($balance, $id)
{
	//echo("Updating bot balance\n");
	
	$usd = $balance["usd_available"];
	$btc = $balance["btc_available"];
	$exchange_fee = $balance["fee"];
	
	$link = new Connect();
	
	$exchange_fee = ".5";
	if( isset($balance["fee"]))
	{
		$exchange_fee = ($balance["fee"]/100);
	}
	
	try
	{
		$query = "UPDATE bot
		SET
		usd=$usd,
		btc=$btc,
		exchange_fee=$exchange_fee
		WHERE
		id=$id";
		
		$queryResult = $link->conn->query($query);
	}
	catch(Exception $e)
	{
		writeLog("Failed to update bot balance. " . $e->getMessage());
		return 1;
	}
}
?>