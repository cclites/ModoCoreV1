<?php
function createToken($uname, $upass, &$token)
{
	$token = $uname . SEED . $upass;
	
	//echo "Raw token is $token\n";
	
	for($i = 0; $i < 100000; $i += 1)
	{
		$token = hash("sha256", $token, false);
	}
	
	$token = hash("sha256", $token, false);
}

function eCrypt($toEncrypt, &$crypttext)
{
	$iv = mcrypt_create_iv(
	          mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC),
	          MCRYPT_DEV_URANDOM
	      );
	
	$crypttext = base64_encode(
	                 $iv .
	                 mcrypt_encrypt(
	                   MCRYPT_RIJNDAEL_256,
	                   hash('sha256', SEED, true),
	                   $toEncrypt,
	                   MCRYPT_MODE_CBC,
	                   $iv
	                 )
		          );
}

function dCrypt($toDecrypt, &$decrypttext)
{
	$data = base64_decode($toDecrypt);
	$iv = substr($data, 0, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC));
	
	$decrypttext = rtrim(
	mcrypt_decrypt(
	MCRYPT_RIJNDAEL_256,
	hash('sha256', SEED, true),
	substr($data, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC)),
	MCRYPT_MODE_CBC,
	$iv
	),
	"\0"
	);

}

function createKey($token, $id, &$key)
	{		
	$text = $token . $id;
	$key = $token;
	
	$key = hash("sha256", $key, false);
	$key = hash("sha256", $key, false);
}

function createLegacyToken($uname, $upass, &$token)
{
	$data = $uname . LEGACY_SEED . $upass;		
	$token = hash("sha256", $data, false);
}

function generatePassword($len)
{
	$result = "";
	$chars = "abcdefghijklmnopqrstuvwxyz@#%^_?!-0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$charArray = str_split($chars);
	
	for($i = 0; $i < $len; $i++){
		$randItem = array_rand($charArray);
		$result .= "".$charArray[$randItem];
	}
	return $result;	
}

function createWalletAddress()
{
  require_once('bitcoinAddress.php');
}
?>