<?php
function db_getTestAccount(&$accountData, $owner_id)
{
	writeLog("Getting test account data for account id: $owner_id");
	
	try
	{
		$link = new Connect();
		$query = "SELECT * FROM  test_ledger WHERE owner_id=$owner_id";
		$queryResult = $link->conn->query($query);			
		$accountData = mysqli_fetch_assoc($queryResult);
	}
	catch(Exception $e)
	{
		writeLog("Failed to retrieve");
		return 1;
	}
	return 0;
}

function db_updateTestLedger($usd, $btc, $id)
{
	writeLog("UPDATING TEST LEDGER");
	
	try
	{
		$link = new Connect();
		$query = "UPDATE test_ledger SET btc=$btc, usd= $usd WHERE owner_id=$id";
		
		$queryResult = $link->conn->query($query);			
	}
	catch(Exception $e)
	{
		writeLog("Failed to retrieve");
		return 1;
	}
	return 0;
}

function db_addTestledger($id)
{
	try
	{
		$link = new Connect();
		$query = "INSERT INTO 
		            test_ledger
					(usd, btc, owner_id)
				  VALUES
				    (500, 5, $id)";
	    $queryResult = $link->conn->query($query);
	}
	catch(Exception $e)
	{
		
	}
}

function db_updateLedger($usd, $btc, $id)
{
	writeLog("UPDATING LEDGER BALANCES");
	
	writeLog("Usd is $usd");
	writeLog("Btc is $btc");
	
	$usd = number_format($usd,2);
	$usd = str_replace(",","", $usd);
	
	try
	{
		$link = new Connect();
		$query = "UPDATE bot SET usd=$usd, btc=$btc WHERE id=$id";
		
		writeLog($query, TEST);
		
		$queryResult = $link->conn->query($query);
	}
	catch(Exception $e)
	{
		writeLog("Failed to update ledger.");
		return 1;
	}
	return 0;
}
?>