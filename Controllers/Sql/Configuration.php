<?php

function db_updateConfigs($configs, $id, $base)
{

	$link = new Connect();
	
	
	$s = print_r($configs, true);
	LOG::info("Before" . $s);
	
	//echo "Id is $id\n";
	
	//$s = print_r($configs, true);
	//echo "$s\n";

	$configs["is_active"] = ($configs["is_active"] == "true") ? 1 : 0;
	$configs["testing_mode"] = ($configs["testing_mode"] == "true") ? 1 : 0;
	$configs["buying"] = ($configs["buying"] == "true") ? 1 : 0;
	$configs["selling"] = ($configs["selling"] == "true") ? 1 : 0;
	$configs["fixed_sell"] = ($configs["fixed_sell"] == "true") ? 1 : 0;
	$configs["fixed_buy"] = ($configs["fixed_buy"] == "true") ? 1 : 0;
	
    if($id == 38){
	  $configs["testing_mode"] = 1;
	}
	
	$s = print_r($configs, true);
	LOG::info("After" .$s);
	
	//Remove commas from base
	$base = str_replace(",", "", $base);
	$configs["fixed_sell_amount"] = str_replace(",", "", $configs["fixed_sell_amount"]);
	$configs["fixed_buy_amount"] = str_replace(",", "", $configs["fixed_buy_amount"]);

	$query = "UPDATE
	            bot
              SET
			    increase = " . ($configs["increase"]/10) . ",
			    decrease = " . ($configs["decrease"]/10) . ",
			    is_active = " . $configs["is_active"] . ",
			    can_sell = " . $configs["selling"] . ",
			    can_buy = " . $configs["buying"] . ",
			    sell_limit_btc = " . $configs["sell_limit_btc"] . ",
			    buy_limit_btc = " . $configs["buy_limit_btc"] . ",
			    testing_mode = " . $configs["testing_mode"] . ",
				fixed_sell = " . $configs["fixed_sell"] . ",
			    fixed_buy = " . $configs["fixed_buy"] . ",
				fixed_sell_amount = " . $configs["fixed_sell_amount"] . ",
			    fixed_buy_amount = " . $configs["fixed_buy_amount"] . ",
				base=$base
			  WHERE
				id=$id";
			  
    writeLog($query);			  
			  
	$queryResult = $link->conn->query($query);
}
?>