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
	   //print_r($post);
	
		//$json = json_decode($post["args"]);
		//$this->uPass = $json->uPass;
		//$this->uName = $json->uName;
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
	
        //Hijack the process to try and create a legacy token.
		//See if the token exists in that context.
		$lMember = null;
		createLegacyToken($uName, $uPass, $lToken);
		getMemberInfo($lToken, $lMember);
		
		if($lMember)
		{
			createToken($uName, $uPass, $token);
			
			//update the token. 
		}
		else
		{
			createToken($uName, $uPass, $token);  
		}

        getMemberInfo($token, $member);
		//echo "Token is $token\n";

		$this->token = $token;
		getMemberInfo($this->token, $member);
		
		if($member)
		{
			$this->message = "Credentials Validated.";
			$this->registered = true;
			
			//************************************
			//****  Prevent session hijacking ****
			//************************************
			$_SESSION["id"] = time();
			
			//writeLog('Session id when logging in is: ' + $_SESSION["id"]);
			
			
			$this->userId = $member["id"];
			$toEncrypt = $member["id"] . "|" . $this->token . "|" . $_SESSION["id"];
			eCrypt($toEncrypt, $token, $_SESSION['id'], $encryptedSession);
			$this->session = $encryptedSession;
			//************************************
			//************************************
			//************************************
		}
	}
}
?>