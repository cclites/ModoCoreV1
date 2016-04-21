<?php

Class Ticker
{
    private $high;
	private $last;			// Last is actually the most recent price.
	private $bid;
	private $volume;
	private $low;
	private $ask;
	private $id;			//exchange id
	
	private $direction;
	private $trend;
	private $previous;
	
	public function __construct($ticker, $id)
	{
		if(isset($ticker->high)) $this->high = $ticker->high;
		if(isset($ticker->last)) $this->last = $ticker->last;
		if(isset($ticker->bid)) $this->bid = $ticker->bid;
		if(isset($ticker->volume)) $this->volume = $ticker->volume;
		if(isset($ticker->low)) $this->low = $ticker->low;
		if(isset($ticker->ask)) $this->ask = $ticker->ask;
		if(isset($id)) $this->id = $id;

	}
	
	public function getHigh(){ return $this->high; }
	public function getLast(){ return $this->last; }
	public function getBid(){ return $this->bid; }
	public function getVolume(){ return $this->volume; }
	public function getLow(){ return $this->low; }
	public function getAsk(){ return $this->ask; }
	public function getId(){ return $this->id; }
	public function getDirection(){ return $this->direction; }
	public function getTrend(){ return $this->trend; }
	public function getPrevious(){ return $this->previous; }
	
	public function setHigh($high){ $this->high = $high; }
	public function setLast($last){ $this->last = $last; }
	public function setBid($bid){ $this->bid = $bid; }
	public function setVolume($volume){ $this->volume = $volume; }
	public function setLow($low){ $this->low = $low; }
	public function setAsk($ask){ $this->ask = $ask; }
	public function setId($id){ $this->id = $id; }
	public function setDirection($direction){ $this->direction = $direction; }
	public function setTrend($trend){ $this->trend = $trend; }
	public function setPrevious($previous){ $this->previous = $previous; }
}

?>
