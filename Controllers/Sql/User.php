<?php
function getUserById(&$userObject, $id)
{
	$link = new Connect();
	
	try
	{
		$query = "SELECT * FROM user WHERE owner_id=$id";
		
		$queryResult = $link->conn->query($query);			
		$userObject = mysqli_fetch_object($queryResult);
		} 
	catch(Exception $e)
	{
		writeLog("Failed to get user $id." . $e->getMessage());
		return 1;
	}
	return 0;
}

function getMemberInfo($token, &$member)
{
	try
	{
		$link = new Connect();
		$query = "SELECT * FROM member where token='" . $token . "'";
		$queryResult = $link->conn->query($query);
		//writeLog($query, AUTHENTICATE);
		
		if($queryResult)
		{
			$member = mysqli_fetch_assoc($queryResult);
			
			//$s = print_r($member, true);
			//writeLog($s, AUTHENTICATE);
			
			//Update last_viewed
			updateLastViewed($member["id"]);
		}
		else
		{
			$member->id = -1;
		}
	}
	catch(Exception $e)
	{
		writeLog("DB Error::getMemberInfo. " . $e->getMessage());
		return 1;
	}
}

function updateToken($token, $id)
{
	try
	{
	  $link = new Connect();
	  $query = "UPDATE member SET token='$token' WHERE id=$id";
	  
	  //echo "$query\n";
	  
	  $queryResult = $link->conn->query($query);	
	}
	catch (Exception $e)
	{
		writeLog("DB Error:: updateToken. " . $e->getMessage());
		return 1;
	}
}

function setEmail($email, $id)
{
	try
	{
	  $link = new Connect();
	  $query = "UPDATE member SET email='$email' WHERE id=$id";
	  $queryResult = $link->conn->query($query);
	}
	catch (Exception $e)
	{
		writeLog("DB Error:: updateEmail. " . $e->getMessage());
		return 1;
	}
}

function getMemberByEmail($mail)
{
	try
	{
	  $link = new Connect();
	  $query = "SELECT * FROM member WHERE email='$mail'";
	   
	  $queryResult = $link->conn->query($query);
	  return mysqli_fetch_assoc($queryResult);
	}
	catch (Exception $e)
	{
		writeLog("DB Error:: updateEmail. " . $e->getMessage());
		return 1;
	}
}

function getUserByName($name)
{
	try
	{
	  $link = new Connect();
	  $query = "UPDATE * FROM member WHERE display_name=$name";
	  $queryResult = $link->conn->query($query);
	  

	  if($queryResult)
	  {
	  	return 1;
	  }
	  else
	  {
	  	return 0;
	  }
	}
	catch (Exception $e)
	{
		writeLog("DB Error:: updateEmail. " . $e->getMessage());
		return 1;
	}
}

function db_addNewMember($email, $display_name, $token)
{
    // $email = $mysqli->real_escape_string($email);
    //$display_name = $mysqli->real_escape_string($display_name);
	
	//There is no column updated in member?

	try
	{
		$link = new Connect();
		$query = "INSERT INTO
		            member
				  (email, display_name, token, activated, date_added)
				  VALUES
				  ('$email', '$display_name', '$token', 0, now())";
				  
				  
	    $queryResult = $link->conn->query($query);
		
		getMemberInfo($token, $member);
		//addMemberAddress($member["id"]);
		
		
		return $member["id"];	
	}
	catch (Exception $e)
	{
		writeLog("DB Error:: addNewMember. " . $e->getMessage());
		return 1;
	}
}

function db_updateMemberToken($uname, $token)
{
    //$uname = $mysqli->real_escape_string($uname);

    try
	{
		$link = new Connect();
		$query = "UPDATE member set token='$token', updated=1 WHERE display_name='$uname' ";
	    $queryResult = $link->conn->query($query);
	}
	catch (Exception $e)
	{
		writeLog("DB Error:: addNewUser. " . $e->getMessage());
		return 1;
	}	
}

// Only called internally
function updateLastViewed($id)
{
	try
	{
		$link = new Connect();
		$query = "UPDATE member set last_viewed=now() WHERE id=$id ";
	    $queryResult = $link->conn->query($query);
	}
	catch (Exception $e)
	{
		writeLog("DB Error:: updateLastViewed. " . $e->getMessage());
		return 1;
	}
}

function activateMember($token)
{
	try
	{
		$link = new Connect();
		$query = "UPDATE member SET activated=1 WHERE token='$token'";
	    $queryResult = $link->conn->query($query);
	}
	catch (Exception $e)
	{
		writeLog("DB Error:: updateLastViewed. " . $e->getMessage());
		return 1;
	}
}

//Update bot user credentials
function updateUserCredentials($ownerId, $message)
{
	try
	{
		$link = new Connect();
		$query = "UPDATE user SET api_key='$message' WHERE owner_id=$ownerId";
		
		//echo "$query\n\n";
		
	    $queryResult = $link->conn->query($query);
	}
	catch (Exception $e)
	{
		writeLog("DB Error:: updateLastViewed. " . $e->getMessage());
		return 1;
	}
}

//Add bot user credentials.
function addUserCredentials($ownerId)
{
	try
	{
		$link = new Connect();
		$query = "INSERT INTO user (owner_id, exchange_id, api_key) VALUES ($ownerId, 1, 'unregistered')";
	    return $link->conn->query($query);	
	}
	catch (Exception $e)
	{
		writeLog("DB Error:: addUserCredentials. " . $e->getMessage());
		return 1;
	}
}

function getUserCredentials($ownerId, &$message)
{
	try
	{
		$link = new Connect();
		$query = "SELECT api_key FROM user WHERE owner_id=$ownerId";
	    $queryResult = $link->conn->query($query);
		
		//This should only ever return a single row. 
		while ($row = $queryResult->fetch_row()) {
          $message = $row;
        }
	}
	catch (Exception $e)
	{
		writeLog("DB Error:: getUserCredentials. " . $e->getMessage());
		return 1;
	}
}


?>