<?php
function db_insertTransaction($transaction)
	{	
	$owner_id = $transaction["owner_id"];
	$category = $transaction["category"];
	$currency = $transaction["currency"];
	$price = $transaction["price"];
	$amount = $transaction["amount"];
	$fee = $transaction["fee"];
	
	if($transaction["order_id"])
	{
		$order_id = $transaction["order_id"];
	}
	else
	{
		$order_id = -99999;
	}
	
	
	try
	{
		$link = new Connect();
		$query = "INSERT INTO transaction
		(owner_id, category, currency, price, amount, fee, order_id)
			VALUES
		($owner_id, '$category', '$currency', $price, $amount, $fee, $order_id)";
		writeLog($query);
		
		$queryResult = $link->conn->query($query);
	}
	catch(Exception $e)
	{
		writeLog("Failed to insert transaction." . $e->getMessage());
		return 1;
	}
	return 0;
}

/*********************************************************************
* getTransactionsByOwnerID
*
* Parameters:
* $ownerId						- represents the account owner id
*
* Returns:
* $transactions				- represents the selected transacations
*********************************************************************/
function getTransactionsByOwnerId(&$transactions, $ownerId)
{
	try
	{
		$link = new Connect();
		$query = "SELECT * FROM transaction WHERE owner_id=$ownerId";
		$queryResult = $link->conn->query($query);

		while ($row = $queryResult->fetch_object())
		{
			$t = new Transact($row);
			$transactions[] = $t;
		}
	}
	catch(Exception $e)
	{
		writeLog("Failed to get transactions by owner id." . $e->getMessage());
		return 1;
	}
	return 0;
}

?>