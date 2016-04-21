<?php

class Connect
{
	var $conn;
	
	public function __construct()
	{
	  $conn = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB);

	  if(!$conn) 
	  {
	    //writeLog("Cannot connect to the database<br>");
		exit(1);
	  }
	  else
	  {
	    $this->conn = $conn;
		//writeLog("Database connection established<br>");
	  }
	
	  return $this->conn;
	}
}

?>