<?php
/**************************************************     Configs ****/
require_once("../Conf/Defines.php");


/************************************************** Controllers ****/
require_once(DOC_ROOT . "/ModoCore/Controllers/Bot.php");
require_once(DOC_ROOT . "/ModoCore/Controllers/Curl.php");
require_once(DOC_ROOT . "/ModoCore/Controllers/Ledger.php");
require_once(DOC_ROOT . "/ModoCore/Controllers/Logging.php");
require_once(DOC_ROOT . "/ModoCore/Controllers/History.php");
require_once(DOC_ROOT . "/ModoCore/Controllers/Ticker.php");
require_once(DOC_ROOT . "/ModoCore/Controllers/Transaction.php");
require_once(DOC_ROOT . "/ModoCore/Controllers/User.php");
require_once(DOC_ROOT . "/ModoCore/Controllers/Authenticate.php");
require_once(DOC_ROOT . "/ModoCore/Controllers/AuthenticateHandler.php");
require_once(DOC_ROOT . "/ModoCore/Controllers/Configs.php");
require_once(DOC_ROOT . "/ModoCore/Controllers/Mail.php");

//writeLog("Controllers are loaded", TEST);


/**************************************************         Sql ****/
require_once(DOC_ROOT . "/ModoCore/Controllers/Sql/Bot.php");
require_once(DOC_ROOT . "/ModoCore/Controllers/Sql/Connect.php");
require_once(DOC_ROOT . "/ModoCore/Controllers/Sql/History.php");
require_once(DOC_ROOT . "/ModoCore/Controllers/Sql/Ledger.php");
require_once(DOC_ROOT . "/ModoCore/Controllers/Sql/Ticker.php");
require_once(DOC_ROOT . "/ModoCore/Controllers/Sql/Transaction.php");
require_once(DOC_ROOT . "/ModoCore/Controllers/Sql/User.php");
require_once(DOC_ROOT . "/ModoCore/Controllers/Sql/Configuration.php");

//writeLog("Sql controllers loaded.", TEST);


/**************************************************      Models ****/
require_once(DOC_ROOT . "/ModoCore/Models/Bot.php");
require_once(DOC_ROOT . "/ModoCore/Models/Configs.php");
require_once(DOC_ROOT . "/ModoCore/Models/History.php");
require_once(DOC_ROOT . "/ModoCore/Models/Ledger.php");
require_once(DOC_ROOT . "/ModoCore/Models/Ticker.php");
require_once(DOC_ROOT . "/ModoCore/Models/User.php");
require_once(DOC_ROOT . "/ModoCore/Models/Transact.php");
//writeLog("Models are loaded.", TEST);


/**************************************************       Views ****/
require_once(DOC_ROOT . "/ModoCore/Views/Ticker.php");
//require_once(DOC_ROOT . "/ModoCore/Views/Bot.php");

//echo "***************************************\n";
//echo "Loaded dispatcher and all dependencies.\n";
//echo "***************************************\n";


$func = "";
if (isset($_GET["func"])) $func = $_GET["func"];
if (isset($_POST["func"])) $func = $_POST["func"];
if($func != "") dispatch($func);

function dispatch($func)
{
  writeLog("Checking function $func", TEST);

  switch($func)
  {
	case "state":
	      getBotState($_GET["args"]["token"], $_GET["args"]["session"]);
		  break;
		  
    case "transactions":
	      getTransactionHistory($_GET["id"]);
		  break;
		 
	case "validate":
	      $ah = new AuthenticateHandler($_POST);	  
		  if($ah->registered) getBotState($ah->token, $ah->session);
		  break;
		  
	case "resetHistoric":
	     resetBotHistory($_GET["args"]["token"], $_GET["args"]["session"], $_GET["id"]);
		 break;
		 
	case "resetBalance":
	     resetTestBalance($_GET["args"]["token"], $_GET["args"]["session"], $_GET["id"]);
	     break;
		 
	case "updateConfigs":
	     //writeLog("Updating configs", TEST);
	     updateConfigs($_POST);
	     break;
/*		 
    case "resetPassword":
echo "Updating password\n";
	      updatePassword($_POST);
	      break;
*/
		  
	case "resetEmail":
//echo "resetting email\n";
	     updateEmail($_POST);
	     break;
		 
    case "addMember":
//echo "Adding member\n";
	     addNewMember($_POST);
	     break;
		 
	case "resendValidate":
//echo "resending validation\n";
	     resendValidationMail($_POST);
	     break;
		 
	case "resetPassword":
	     //echo "DISPATCH: Resetting password\n";
	     resetMemberPassword($_POST);	 
             break;
		 
    default:
	  writeLog("No function selected.");
  }	  
}

?>