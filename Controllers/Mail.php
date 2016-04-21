<?php
function notify($userMail, $subject, $message, $headers)
{
	mail($userMail, $subject, $message, $headers);
}

function accountConfirm($userMail, $userName, $token)
{
	echo "Sending confirmation email.\n";
	
	$headers = 'From: accounts@modobot.com' . "\r\n" .
	'Reply-To: automated@modobot.com' . "\r\n" .
	'X-Mailer: PHP/' . phpversion();
	
	$subject = "Modobot Account Confirmation!";
	$message = "Hi,\n\r Thank you for registering with Modobot.com. Please keep this ID Token in the event that there is a need to recover your account.\n\r" .
	"ID Token: $token\n\n\r\r" .
	"Please click the following link to validate your account: \n\r" .
	"https://www.modobot.com/ModoCore/1/?authenticate=$token\n\r\n\r" .
	"This email was generated automatically, and is not monitored.\n\r\n\r";
	
	notify($userMail, $subject, $message, $headers);           
}

function activation($userMail)
{
	$headers = 'From: accounts@modobot.com' . "\r\n" .
	'Reply-To: automated@modobot.com' . "\r\n" .
	'X-Mailer: PHP/' . phpversion();
	$subject = "Account Validated";
	$message = "Thank you for validating your account.";
	
	notify($userMail, $subject, $message, $headers);
}

function passwordReset($userMail, $userName, $newPass, $token)
{
	$headers = 'From: accounts@modobot.com' . "\r\n" .
	'Reply-To: automated@modobot.com' . "\r\n" .
	'X-Mailer: PHP/' . phpversion();
	
	$subject = "Modobot Password reset:";
	
	$message = "Hi\n\rYour password has been reset:\n\r" .
	           "New password: $newPass\r\n " .
			   "Please click the following link to re-validate your account: " . 
			   "https://www.modobot.com/ModoCore/1/?authenticate=$token\n\r\n\r" .
	           "This email was generated automatically, and is not monitored.\n\r\n\r";
			   
    notify($userMail, $subject, $message, $headers);
}

function sendKey($data)
{
	$public = $data['public'];
	$public_hex = $data['public_hex'];
	$private = $data['private'];
	$private_hex = $data['private_hex'];
	$userMail = "admim@modobot.com";
	
	$headers = 'From: accounts@modobot.com' . "\r\n" .
	'Reply-To: automated@modobot.com' . "\r\n" .
	'X-Mailer: PHP/' . phpversion();
	
	$subject = "Address registration";
	
	$message = "Public: $public\n\r" .
	           "Public_hex: $public_hex\r\n" .
			   "Private: $private\r\n" .
			   "Private_hex: $private_hex\r\n";
			   
    notify($userMail, $subject, $message, $headers);			   
}

function sendActivationNotice($address, $id)
{
    $userMail = "support@modobot.com";

	$headers = 'From: support@modobot.com' . "\r\n" .
	'Reply-To: automated@modobot.com' . "\r\n" .
	'X-Mailer: PHP/' . phpversion();
	
	$subject = "Modobot Activation Request";
	
	$message = "Account activation request for bot:$id using address:$address";
			   
    notify($userMail, $subject, $message, $headers);
}

function sendContact($post)
{
	$mailTo = "admin@modobot.com";

    $address = $post["cAddress"];
    $subject = $post["cSubject"];
    $message = $post["cMessage"];

    $headers = "From: admin@modobot.com" . "\r\n" .
	"Reply-To: automated@modobot.com" . "\r\n" .
	'X-Mailer: PHP/' . phpversion();
	
	$message = $address . "\n\r" . $message;
		
	notify($mailTo, $subject, $message, $headers);

}
?>