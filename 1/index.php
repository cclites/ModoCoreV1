<?php

      require_once("../Conf/Defines.php");
      require_once("../Controllers/Sql/Connect.php");
      require_once("../Controllers/Sql/User.php");
      
      $token = $_REQUEST["authenticate"];
      
      $message = "";
      
      $status = activate($token, $member);
	  
      if ($status && !$member["activated"])	//Account not activated.
      {
	    activateMember($token);
        $message = "Your account has been activated. You should now be able to log in.<br><a href='http://www.modobot.com'>Modobot.com</a>";
		//need to actually activate the accountConfirm
      }
	  else if($status && $member["activated"])	//Account already activated.
	  {
	  	$message = "This account has already been activated. Please contact support@modobot.com to request a password reset.";
	  }
      else
      {
        $message = "Sorry. Your account cannot be activated at this time. Please try again later.<br>If the problem persists, please contact support@modobot.com.";
      }
	  
	  function activate($token, &$member)
	  {
	      //Should just need to see if the token is available in the database.
		  //echo "Getting member info.<br>";
		  getMemberInfo($token, $member);
		  
		  if($member) return true;
		  return false;
	  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Modobot Activation</title>
  </head>
  <body>
  	<div id="message" style="width: 800px; height: 200px; text-align: center; margin: 0 auto; margin-top: 20%;"><?= $message ?></div>
  </body>
</html>