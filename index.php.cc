 <!DOCTYPE html>
<html>
    <head>
	    <meta charset="UTF-8">
        <title>MoDo V1</title>
		
        <link rel="icon" href="https://www.modobot.com/ModoCore/Content/Images/favicon.ico" type="image/x-icon" />
		
		<link rel="stylesheet" type="text/css" href="Content/Css/jquery_ui.css">
        <link rel="stylesheet" type="text/css" href="Content/Css/desktop.css">
		
    </head>
    <body>
	    
		<img class="bannerLogo" src="Content/Images/ModoBotcom_x_200.png" alt="modo dot com logo" />
		
	    <div class="banner">
		</div>
		  <br>
	    <div id="frame">
		  <div id="statusLogContainer">
		  </div>
		  <div id="botContainer">
		    <div id="tickerContainer"></div>
			  <br>
		    <div id="ledgerContainer"></div>
		    <div id="configsContainer"></div>
		    <div id="calculatorContainer"></div>
		    <div id="historyContainer"></div>
			<div id="footerContainer"></div>
		  </div>
		  
		  <footer>
              All rights reserved - modobot & modobot.com (2013-2014)
                <br/>
              ModoBot logo is the property of modobot.com, and may not be reproduced without permission.
                <br/>
              Bitcoin Tip Jar:  18Gmr8Xk5QX6Ud3XXWXZMTjFmBSz9YxAez
            </footer>
		  
		</div>
		<div id="modals"></div> 
		  <br>
		  
		<script>
		    var model;
		</script>  
			
	    <script src="https://www.modobot.com/ModoCore/Js/Jquery/jquery.js"></script>
        <script src="https://www.modobot.com/ModoCore/Js/Jquery/jquery_ui.js"></script>
		<script src="Js/Knockout/knockout.js"></script>
		
		
		<script src="Js/ViewModels/LogIn.js"></script>
		<script src="Js/ViewModels/Banner.js"></script>
		<script src="Js/ViewModels/StatusLog.js"></script>
		
		<script src="Js/Knockout/knockoutMapping.js"></script>
		<script src="Js/ViewModels/Bot.js"></script>
		
		<script src="Js/ViewModelController.js"></script>
		<script src="Js/ViewModels/Ledger.js"></script>
		
		
		<script src="Js/ViewModels/Ticker.js"></script>
		<script src="Js/ViewModels/Configs.js"></script>
		<script src="Js/ViewModels/Calculator.js"></script>
		<script src="Js/ViewModels/History.js"></script>
		<script src="Js/ViewModels/Footer.js"></script>
		<script src="Js/ViewModels/Transact.js"></script>
		
		<script src="Js/ViewModels/NewAccount.js"></script>
		<script src="Js/ViewModels/Account.js"></script>
		
        <script src="Js/Transaction.js"></script>  
        <script src="Js/Login.js"></script>  
        <script src="Js/StatusLog.js"></script>  
        <script src="Js/History.js"></script>
		<script src="Js/Balance.js"></script>  
		<script src="Js/Configuration.js"></script>  
		<script src="Js/Calculator.js"></script>  
		<script src="Js/Account.js"></script>  
		<script src="Js/NewAccount.js"></script>  
		<script src="Js/Validate.js"></script>  
	
	    <script>
		  addMessage("Initialized.");
		  $("#statusLogContainer").attr("disabled","disabled");
		</script>
	
    </body>
	
</html>





