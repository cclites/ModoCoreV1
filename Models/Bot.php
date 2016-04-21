<?php

Class Bot
{
    private $id;
	private $owner_id;
	private $bot_name;
	private $exchange;
	
	private $ledger;
	private $configs;
	private $history;
	private $ticker;
	private $session;
	private $user;
	
	private $authenticated;
	private $level;
	
	private $address;
	private $live;

	public function __construct($bot, $user)
	{
	  //echo "User is $user\n";
	
	  $this->id = $bot->id;
	  $this->owner_id = $bot->owner_id;
	  $this->bot_name = $bot->bot_name;
	  $this->exchange = $bot->exchange;
	  $this->live = $bot->live;
	
	  $this->ledger = new Ledger($bot);
	  $this->configs = new Configs($bot);
	  $this->user = new User($user);
	}

    public function getId() {return $this->id; }	
    public function getOwnerId() {return $this->owner_id; }	
    public function getBotName() {return $this->bot_name; }
	public function getLedger() {return $this->ledger; }
	public function getConfigs() {return $this->configs; }
	public function getUser() {return $this->user; }
	public function getExchange() {return $this->exchange; }
	public function getSession() {return $this->session; }
	public function getAuthenticated(){return $this->authenticated; }
	public function getLevel(){ return $this->level; }
	public function getAddress(){ return $this->address; }
	public function getLive(){ return $this->live; }
	
	public function setBotName($bot_name){ $this->bot_name = $bot_name;}
	public function setHistory($history){ $this->history = $history;}
	public function setTicker($ticker){ $this->ticker = $ticker;}
	public function setSession($session){ $this->session = $session;}
	public function setAuthenticated($authenticated){ $this->authenticated = $authenticated; }
	public function setLevel($level){ $this->level = $level; }
	public function setAddress($address){ $this->address = $address; }
	public function setLive($live){ $this->live = $live; }
}
?>