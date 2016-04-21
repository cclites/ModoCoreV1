<?php

function getAvailableAddress(&$address)
{
	try
	{
		$link = new Connect();
		$query = "SELECT address FROM wallet WHERE id=0 LIMIT 1";
		$queryResult = $link->conn->query($query);	
		
		//print_r($queryResult);
		
        $row = mysqli_fetch_assoc($queryResult);
		$address = $row["address"];	
	}
	catch(Exception $e)
	{
		writeLog("DB Error:: getAvailableAddress. " . $e->getMessage());
		return false;
	}
	return true;
}

function setAddressId($id, $address)
{
	//$coin = CoinAddress::bitcoin();
	
	//$public = $coin['public'];

    try
	{
		$link = new Connect();
		$query = "UPDATE wallet SET id=$id WHERE address='$address'";
	    $queryResult = $link->conn->query($query);
	}
	catch (Exception $e)
	{
		writeLog("DB Error:: setAddressId. " . $e->getMessage());
		return 1;
	}
}

function getAddress($id, &$address)
{
	try
	{
		$link = new Connect();
		$query = "SELECT address FROM wallet WHERE id=$id";
	    $queryResult = $link->conn->query($query);
		$row = mysqli_fetch_assoc($queryResult);
		$address = $row["address"];
	}
	catch (Exception $e)
	{
		writeLog("DB Error:: getAddress. " . $e->getMessage());
		return 1;
	}
}

function setAddressPending($address)
{
    //Hack to prevent address from being obliterated by too many 'P_'
	$address = str_replace("P_", "", $address);

	try
	{
		$link = new Connect();
		$query = "update wallet SET address='P_$address' where address='$address'";
	    $queryResult = $link->conn->query($query);
	}
	catch (Exception $e)
	{
		writeLog("DB Error:: getAddress. " . $e->getMessage());
		return 1;
	}
}

?>