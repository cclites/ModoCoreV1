<?php
class History
{
	private $high;
	private $low;
	private $date_low;
	private $date_high;
	private $start_usd;
	private $start_btc;
	private $currency;
	
	public function __construct($history)
	{
	
	  $this->high = $history->high;
	  $this->low = $history->low;
	  $this->date_low = $history->date_low;
	  $this->date_high = $history->date_high;
	  $this->start_usd = $history->start_usd;
	  $this->start_btc = $history->start_btc;
	  $this->currency = $history->currency;
	}
	
	public function getHigh(){ return $this->high;}
	public function getLow(){ return $this->low;}
	public function getDateLow(){ return $this->date_low;}
	public function getDateHigh(){ return $this->date_high;}
	public function getStartUsd(){ return $this->start_usd;}
	public function getStartBtc(){ return $this->start_btc;}
	public function getCurrency(){ return $this->currency;}
	
	public function setHigh($high){ $this->high = $high;}
	public function setLow($low){ $this->low = $low;}
	public function setDateLow($date_low){ $this->date_low = $date_low;}
	public function setDateHigh($date_high){ $this->date_high = $date_high;}
	public function setStartUsd($start_usd){ $this->start_usd = $start_usd;}
	public function setStartBtc($start_btc){ $this->start_btc = $start_btc;}
	public function setCurrency($currency){ $this->currency = $currency;}
}

?>