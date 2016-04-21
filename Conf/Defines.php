<?php

/* DATABASE*/
define("MYSQL_HOST", "");
define("MYSQL_DB", "");
define("MYSQL_USER", "");
define("MYSQL_PASSWORD","");

/*  Bitstamp URLS */
define("BITSTAMP_GET_TICKER", "https://www.bitstamp.net/api/ticker/");
define("BITSTAMP_GET_BALANCE", "https://www.bitstamp.net/api/balance/");
define("BITSTAMP_BUY_LIMIT", "https://www.bitstamp.net/api/buy/");
define("BITSTAMP_SELL_LIMIT", "https://www.bitstamp.net/api/sell/");
define("BITSTAMP_OPEN_ORDERS", "https://www.bitstamp.net/api/open_orders/");
define("BITSTAMP_CLOSE_ORDER", "https://www.bitstamp.net/api/cancel_order/");
define("BITSTAMP_TRANSACTIONS","https://www.bitstamp.net/api/user_transactions/");


//$docRoot = "/home/modovwns/public_html";

if (isset($_SERVER['SERVER_NAME']) && $_SERVER['SERVER_NAME'] == "192.168.1.125")
{
  $docRoot = "/var/www";	
}

//define("DOC_ROOT", $docRoot);

//define("DOC_ROOT", "/home/modovwns/public_html");
define("DOC_ROOT", "D:/xampp/htdocs");

/*  Logging  */
define("LOG", "Logs/lazy.log");
define("TRANSACTION", "Logs/transaction.log");
define("AUTHENTICATE", "Logs/authenticate.log");
define("TEST", "Logs/test.log");
define("BOT", "Logs/bot.log");

/* authentication */
define("SEED", "");
define("LEGACY_SEED", "");

define("REG_FEE", 16);
define("MON_FEE", 4);

/*
php /home/modovwns/public_html/lazy/daemons/queue.V2.php
*/
?>