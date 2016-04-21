<?php

Class User
{
	private $id;
	private $owner_id;
	private $exchange_id;
	private $api_key;
	
	public function __construct($user)
	{

	   $this->id = $user->id;
	   $this->owner_id = $user->owner_id;
	   $this->exchange_id = $user->exchange_id;
	   $this->api_key = $user->api_key;
	}
	
	public function getId() {return $this->id; }
	public function getOwnerId() {return $this->owner_id; }
	public function getExchangeId() {return $this->exchange_id; }
	public function getApiKey() {return $this->api_key; }
	
}

?>