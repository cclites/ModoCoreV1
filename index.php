<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>MoDo V1</title>

		<link rel="icon" href="Content/Images/favicon.ico" type="image/x-icon" />

		<link rel="stylesheet" type="text/css" href="Content/Css/jquery_ui.css">
		<link rel="stylesheet" type="text/css" href="Content/Css/desktop.css">
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

		<link href='//fonts.googleapis.com/css?family=Allura' rel='stylesheet' type='text/css'>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
		<!--script src="Js/Jquery/jquery.js"></script>
		<script src="Js/Jquery/jquery_ui.js"></script-->
		<script src="Js/Knockout/knockout.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

	</head>
	<body>
		<img class="bannerLogo" src="Content/Images/ModoBotcom_x_200.png" alt="modo dot com logo" />

		<div id="banner_background"></div>
		<div class="banner">
			<div class="bannerContent">
				<div id="bannerLeft">
					<form data-bind="submit: validate">
						<input id="banner_uname" type="text" required="required" autofocus="" placeholder="Username" data-bind="value: uName">
						<input id="banner_upass" type="password" required="required" placeholder="Password" data-bind="value: uPass">
						<button id="logIn" type="submit">
							⋅ Log In
						</button>
					</form>
				</div>
				<div id="bannerCenter"></div>
				<div id="bannerRight">
					<span id="newAccount" onclick="newAccount()">⋅ New Account</span>
				</div>
			</div>
		</div>
		<br>
		<div id="frame">
			<div id="statusLogContainer"></div>
			<div id="botContainer">

				<?php
	require_once ("Splash.php");
 ?>

				<div id="tickerContainer"></div>
				<br>
				<div id="ledgerContainer"></div>
				<div id="configsContainer"></div>
				<div id="calculatorContainer"></div>
				<div id="historyContainer"></div>
				<div id="footerContainer"></div>
			</div>

			<footer>
				All rights reserved - modobot & modobot.com (2013-2016)
				<br/>
				ModoBot logo is the property of modobot.com, and may not be reproduced without permission.
				<br/>
			</footer>

		</div>

		<!--div id="footer_background"></div-->

		<div id="modals"></div>
		<div class="contact glyphicon-envelope btn-lg" onclick="contactDisplay()"></div>
		<br>

		<script>
			var model;
		</script>
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
		<script src="Js/ViewModels/Contact.js"></script>

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
		<script src="Js/Contact.js"></script>

		<script>
			addMessage("Initialized.");
			$("#statusLogContent").attr("disabled", "disabled");
		</script>

		<script>
			(function(i, s, o, g, r, a, m) {
				i['GoogleAnalyticsObject'] = r;
				i[r] = i[r] ||
				function() {
					(i[r].q = i[r].q || []).push(arguments)
				}, i[r].l = 1 * new Date();
				a = s.createElement(o),
				m = s.getElementsByTagName(o)[0];
				a.async = 1;
				a.src = g;
				m.parentNode.insertBefore(a, m)
			})(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

			ga('create', 'UA-47845671-1', 'modobot.com');
			ga('send', 'pageview');

		</script>
	</body>

</html>

