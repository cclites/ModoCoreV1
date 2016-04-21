<?php
/*********************************************************************
*  writeLog				- write to log file
*
*  Parameters:
*  $message				- string representing message to be written to log.
*********************************************************************/
function writeLog($message, $address = LOG) 
{	
	
	return;
	$add = $address;

	$timeStamp = date ("D M d H:i:s Y");
	
	$f = fopen($add, "a");

	if($message == "")
	{
		fwrite($f, ".\n");
	}
	else
	{
		fwrite( $f, $timeStamp . "  $message\n");
	}
	
	fclose($f);

	return 1;
}
?>
