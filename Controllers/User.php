<?php

function addNewMember($post)
{
    //print_r($post);
    $uname = $post["newUserName"];
	$upass = $post["newUserPass"];
	$umail = $post["newUserEmail"];
	

	//See if there is an available address.
	
	if( !getAvailableAddress($address) )
	{
		echo "No more available licenses. Please try again later.<br>";
	}
	else if(getUserByName($uname) )//This needs to return a true or false to work.
	{
		echo "That user name is already in use.\n";
	}
	else if(getMemberByEmail($umail))
	{
		echo "You must select a unique email.\n";
	}
	else
	{
		echo "Account does not exist. Adding new account.<br>";
		
		/*
		  This function needs to be cleaned up
		*/
		
		//First, create token
		//echo "Creating token<br>";
		createToken($uname, $upass, $token);
		//echo "Creating new token: $token<br>";
		
		//add member
		$newUserId = db_addNewMember($umail, $uname, $token);
		
		
		//echo "New user ID is $newUserId<br>";
		
        //get last ticker so that we can add a bot
        getTicker($ticker, 1);
		
		addNewBot($newUserId, $ticker);
		
		
		//echo "Retrieved Ticker<br>";

		//Need bot id in order to create historic record, and test-ledger.
		getBotsByOwnerId($b, $newUserId);
		//echo "Retrieved bots by id<br>";
		
		/*
		echo "<pre>";
		print_r($b);
		echo "</pre>";
		*/
		
		$bId = $b[0]->getId();
		
		//echo "Bot is is " . $bId . "<br>";
		
		addHistoric($ticker, $bId);
		//echo "added historic<br>";
		
		db_addTestledger($bId);
		//echo "added test ledger<br>";
		
		addUserCredentials($bId);
		//echo "Added user credentials.<br>";
		
		setAddressId($bId, $address);
		//echo "Set address";

		accountConfirm($umail, $upass, $token);
		
		echo "Account has been added. Please check your email for validation instructions.";
	}
}

function resendValidationMail($post)
{
	//lookup user by email
	
	$result = getMemberByEmail($post["userMail"]);
	$token = $result["token"];
	
	$displayName = $result["display_name"];
	
	if($displayName == "ModoBot") {
	  echo "Cannot update public ModoBot";
	  return;
	}
	
	if($result && !$result["activated"])
	{
		accountConfirm($post["userMail"], $result["display_name"], $token);
	}
	else if($result && $result["activated"])
	{
		echo "This account has already been activated. Please contact support@modobot.com to request a password reset.";
	}
	else
	{
	    echo "No such user.";	
	}
}

function resetMemberPassword($post)
{
	$result = getMemberByEmail($post["userMail"]);
	$token = $result["token"];
	$displayName = $result["display_name"];
	
	if($displayName == "ModoBot") {
	  echo "Cannot update public ModoBot";
	  return;
	}

	if($result && !$result["activated"])
	{
	    $newPass = generatePassword(8);
		createToken($displayName, $newPass, $newToken);
		updateToken($newToken, $result["id"]);
		
		//email new token
		passwordReset($post["userMail"], "", $newPass, $newToken);
		//echo "Password has been reset. Check your email for information.";
	}
}

function updateUser($post)
{
    /*
    $s = print_r($post, true);
	echo "$s\n";

    echo "**** UPDATING USER";
	*/
	$key = $post["key"];
	$secret = $post["secret"];
	$id = $post["id"];
	
	if($id == 38) {
	  echo "Cannot update public ModoBot";
	  return;
	}
	
	/*
	echo "id is $id\n";
	echo "Secret is $secret\n";
	echo "Key is $key\n";
	
	if( is_numeric($id) ){ echo "ID is numeric\n"; }
	else { echo "Id is not numeric\n";}
	
	if(ctype_alnum($secret)){ echo "Secret matches\n";}
	else{ echo "Secret does not match\n";}
	
	if( ctype_alnum($key)){ echo "Key matches\n";}
	else { echo "Key does not match\n";}
	*/
	
	if(is_numeric($id) && ctype_alnum($secret) && ctype_alnum($key))
	{
	  echo "Saving credentials.\n";
	}
	else
	{
	  echo "Credentials are not valid.\n";
	  return;
	}
	

	$toEncrypt = $post["key"] . "|" . $post["secret"] . "|" . $post["id"] . "|" . $post["address"];
	//echo "$toEncrypt\n";
    eCrypt($toEncrypt, $encryptedSession);
	
	//Save encrypted user token
	updateUserCredentials($post["botId"], $encryptedSession);
	//updateToken($encryptedSession, $post["botId"]);
}


?>