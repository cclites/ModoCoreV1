<?php

Class Configs
{
    private $exchange_fee;
	private $increase;
	private $decrease;
	private $is_active;
	private $can_sell;
	private $can_buy;
	private $sell_limit_btc;
	private $buy_limit_btc;
	private $fixed_buy;
	private $fixed_sell;
	private $fixed_buy_amount;
	private $fixed_sell_amount;
	private $testing_mode;
	private $ppp;
	private $spp;
	private $base;
	private $balance;
	
	public function __construct($bot)	//Pass the current bot
	{
	  $this->exchange_fee = $bot->exchange_fee;
	  $this->increase = $bot->increase;
	  $this->decrease = $bot->decrease;
	  $this->is_active = $bot->is_active;
	  $this->can_sell = $bot->can_sell;
	  $this->can_buy = $bot->can_buy;
	  $this->fixed_sell = $bot->fixed_sell;
	  $this->fixed_buy = $bot->fixed_buy;
	  $this->fixed_sell_amount = $bot->fixed_sell_amount;
	  $this->fixed_buy_amount = $bot->fixed_buy_amount;
	  $this->sell_limit_btc = $bot->sell_limit_btc;
	  $this->buy_limit_btc = $bot->buy_limit_btc;
	  $this->testing_mode = $bot->testing_mode;
	  $this->base = $bot->base;
	  $this->balance = $bot->balance;
	}

    public function getExchangeFee() {return $this->exchange_fee; }
	public function getIncrease() {return $this->increase; }
	public function getDecrease() {return $this->decrease; }
	public function getIsActive() {return $this->is_active; }
	public function getCanSell() {return $this->can_sell; }
	public function getCanBuy() {return $this->can_buy; }
	public function getSellLimitBtc() {return $this->sell_limit_btc; }
	public function getBuyLimitBtc() {return $this->buy_limit_btc; }
	public function getTestingMode() {return $this->testing_mode; }
	public function getPpp() {return $this->ppp; }
	public function getSpp() {return $this->spp; }
	public function getBase() {return $this->base; }
	public function getBalance() {return $this->balance; }
	public function getFixedSell() {return $this->fixed_sell; }
	public function getFixedBuy() {return $this->fixed_buy; }
	public function getFixedSellAmount() { return $this->fixed_sell_amount; }
	public function getFixedBuyAmount() { return $this->fixed_buy_amount; }
	
	
	public function setExchangeFee($exchange_fee){ $this->exchange_fee = $exchange_fee;}
	public function setIncrease($increase){ $this->increase = $increase;}	
	public function setDecrease($decrease){ $this->decrease = $decrease;}	
	public function setIsActive($is_active){ $this->is_active = $is_active;}	
	public function setCanSell($can_sell){ $this->can_sell = $can_sell;}	
	public function setCanBuy($can_buy){ $this->can_buy = $can_buy;}	
	public function setSellLimitBtc($sell_limit_btc){ $this->sell_limit_btc = $sell_limit_btc;}	
	public function setBuyLimitBtc($buy_limit_btc){ $this->buy_limit_btc = $buy_limit_btc;}	
	public function setTestingMode($testing_mode){ $this->testing_mode = $testing_mode;}
	public function setPpp($ppp){ $this->ppp = $ppp;}	
	public function setSpp($spp){ $this->spp = $spp;}	
	public function setBase($base){ $this->base = $base;}
	public function setBalance($balance){ $this->base = $balance;}
	
	public function setFixedSell($fixed_sell){ $this->fixed_sell = $fixed_sell;}	
	public function setFixedBuy($fixed_buy){ $this->fixed_buy = $fixed_buy;}
	public function setFixedSellAmount($fixed_sell_amount){ $this->fixed_sell_amount = $fixed_sell_amount;}	
	public function setFixedBuyAmount($fixed_buy_amount){ $this->fixed_buy_amount = $fixed_buy_amount;}	
}
?>