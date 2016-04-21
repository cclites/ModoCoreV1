
var buildLedgerView = function()
{
  //this will need to eventually be passed an id.

  // manually handle which bot gets processed.
  var b = model.bots();
  var myB = b[0];
  var id = myB.id();
  
  str = "";
  str += "  <div class='sectionHeader'>Balances:</div>\n";
  str += "  <table class='balanceTable'>";
  str += "    <tr>";
  str += "      <th>USD: </th><td id='availableUsd" + id + "'>$" + myB.ledger.usd() + "</td>"; 
  str += "      <th>BTC: </th><td id='availableBtc" + id + "'>" + myB.ledger.btc() + "</td>";
  str += "      <th>Purchase Price: </th><td id='ppp" + id + "'>$" + myB.configs.ppp() + "</td>";
  str += "      <th>Sell Price: </th><td id='spp" + id + "'>$" + myB.configs.spp() + "</td>";
  str += "    </tr>";
  str += "  </table>";
  str += "</div>";
  
  return str;
}

  

