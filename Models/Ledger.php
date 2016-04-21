<?php

Class Ledger
{
	private $usd;
	private $btc;
		
	public function __construct($bot)	//Pass the current bot
	{
	  $this->base = $bot->base;
	  $this->usd = $bot->usd;
	  $this->btc = $bot->btc;  
	}
	
	public function getBase() {return $this->base; }
	public function getUsd() {return $this->usd; }
	public function getBtc() {return $this->btc; }

	public function setBase($base){ $this->base = $base;}
	public function setUsd($usd){ $this->usd = $usd;}
	public function setBtc($btc){ $this->btc = $btc;}
	
}
?>