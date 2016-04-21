<?php
class Transact
{
    private $id;
	private $datetime;
	private $category;
	private $price;
	private $amount;
	private $currency;
	private $order_id;
	private $fee;
	
	public function __construct($transaction)
	{
	  $this->id = $transaction->id;
	  $this->datetime = $transaction->datetime;
	  $this->category = $transaction->category;
	  $this->price = $transaction->price;
	  $this->amount = $transaction->amount;
	  $this->currency = $transaction->currency;
	  $this->order_id = $transaction->order_id;
	  $this->fee = $transaction->fee;
	}
	
	public function getId(){ return $this->id;}
	public function getDateTime(){ return $this->datetime;}
	public function getCategory(){ return $this->category;}
	public function getPrice(){ return $this->price;}
	public function getAmount(){ return $this->amount;}
	public function getCurrency(){ return $this->currency;}
	public function getOrderId(){ return $this->order_id;}
	public function getFee(){ return $this->fee;}
	
	public function setId($id){ $this->id = $id;}
	public function setDatetime($datetime){ $this->datetime = $datetime;}
	public function setCategory($category){ $this->category = $category;}
	public function setPrice($price){ $this->price = $price;}
	public function setAmount($amount){ $this->amount = $amount;}
	public function setCurrency($currency){ $this->currency = $currency;}
	public function setOrderId($order_id){ $this->order_id = $order_id;}
	public function setFee($fee){ $this->fee = $fee;}
}

?>