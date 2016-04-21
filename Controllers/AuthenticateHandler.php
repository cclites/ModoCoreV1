<?php
class AuthenticateHandler
{
	private $uPass;
	private $uName;
	public $token;
	public $session;
	public $registered = false;
	public $message = "Invalid Credentials.";
	public $userId = null;
	
	public function __construct($post)
	{

		$this->uPass = $post["args"]["uPass"];
		$this->uName = $post["args"]["uName"];
		
		$this->authenticate($this->uName, $this->uPass);
	}
	
	public function getToken(){ return $this->token;}
	public function getSession(){ return $this->session;}
	public function getId(){ return $this->userId;}
	public function isRegistered(){ return $this->registered; }
	
	function authenticate($uName, $uPass)
	{
	    //Server side sanity check
		if(!$uName || !$uPass) return false;
	
	  
	    writeLog("uname:  $uName      upass:  $uPass. ", AUTHENTICATE );
	    writeLog($_SERVER['REMOTE_ADDR'], AUTHENTICATE);
		
	
        //Hijack the process to try and create a legacy token.
		//See if the token exists in that context.
		$token="";
		$lMember = null;
		createLegacyToken($uName, $uPass, $lToken);
		getMemberInfo($lToken, $lMember);

		//echo "Legacy token is $lToken\n";
		//print_r($lMember);
		
		writeLog("Legacy token: $lToken", AUTHENTICATE);
		
		if($lMember)
		{
		    //echo "Creating updated token\n";
			createToken($uName, $uPass, $token);
			db_updateMemberToken($uName, $token); 
		}
		else
		{
			createToken($uName, $uPass, $token);  
		}

        getMemberInfo($token, $member);
		writeLog("Token: $token", AUTHENTICATE);

		$this->token = $token;
		getMemberInfo($this->token, $member);
		
		$s = print_r($member,true);
		writeLog($s, AUTHENTICATE);
		
		if($member)
		{
		    writeLog("Member exists", AUTHENTICATE);
		
			$this->message = "Credentials Validated.";
			$this->registered = true;
			
			
			//************************************
			//****  Prevent session hijacking ****
			//************************************
			$_SESSION["id"] = time();
			$_SESSION["authenticated"] = true;
			$_SESSION["token"] = $token;
				
			$this->userId = $member["id"];
			$toEncrypt = $member["id"] . "|" . $this->token . "|" . $_SESSION["id"];
			eCrypt($toEncrypt, $encryptedSession);
			$this->session = $encryptedSession;
			//************************************
			//************************************
			//************************************
		}
		else
		{
			writeLog("Member does not exist", AUTHENTICATE);
		}
	}
}
?>