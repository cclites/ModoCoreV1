<?php
function setPendingActivate($post)
{
	$address = $post["address"];
	setAddressPending($address);
	
	//send email
	sendActivationNotice($address, $post["id"]);
}
?>