<style>

#features
{
	margin-top: 5px;
}

#calculator
{
	width: 760px;
	margin-bottom: 15px;
	/*margin-top: 5px;*/
}

#calculateSubmit
{
	width: 360px;
}

#calculator td, #calculator th
{
	width: 180px;	
	
}

#calculator td input{
	height: 35px;
	width: 75%;
	line-height:35px;
	padding-left: 5px;
	font-size: 18px;
}

#warped span{
	color: #f47522;
}

.label
{
	width: 100px;
	font-weight: bold;
	
	color: #f47522;
	height: 22px;
	/*margin-left: 10px;*/
	/*font-family:"Trebuchet MS";*/
	/*text-shadow:#fff 0px 1px 0, #000 0 -1px 0;*/ 
	
	font-family: 'Allura', cursive;
}

#ops, #priv, #features{
	font-size: 54px;
	margin-bottom: 10px;
}

.flickerOn
{
	text-shadow: 1px 1px 3px #f47522;
}

.flickerOff
{
	text-shadow: 2px 2px 3px #000000;
}

#calculator th
{
	background-color: #044a76;
	color: #c7c8c9;
	border-radius: 3px;
	line-height: 22px;
	height: 50px;
}
#calculator
{
	/*
	font-size: 17px;
	font-weight: bold;
	*/
}
#calculateSubmit
{
	margin: 0 auto;
	border: none;
	border-radius: 4px;
	height: 100px !important;
	margin-bottom: 6px;
	background-color: #044a76;
	color: #c7c8c9;
	width: 190px;
	float: right;
	font-size: 25px;
	
}
#calculateSubmit:hover
{
	cursor: pointer;
}

#calculatorText, #docs
{
	color: #8A8C8F;
	font-size: 17px;
}
/*
color: #8A8C8F;
font-size: 15px;
margin-top: 30px;*/
#box1{
	background-color:black;
	height: 66px;
	width: 689px;
	margin: auto auto;
	
	border-radius: 12px 12px 0 0;
	border-top: 5px ridge gray;
	text-align: center;
	
	padding-top: 5px;
}

.dim{
	/* Safari 4-5, Chrome 1-9 */ /* Can't specify a percentage size? Laaaaaame. */ 
	background: -webkit-gradient(radial, center center, 0, center center, 460, from(#fafafa), to(#fafafa)); 
	/* Safari 5.1+, Chrome 10+ */ background: -webkit-radial-gradient(circle, #fafafa, #fafafa); 
	/* Firefox 3.6+ */ background: -moz-radial-gradient(circle, #fafafa, #fafafa); 
	/* IE 10 */ background: -ms-radial-gradient(circle, #fafafa, #fafafa);
}

.brighten{
	/* Safari 4-5, Chrome 1-9 */ /* Can't specify a percentage size? Laaaaaame. */ 
	background: -webkit-gradient(radial, center center, 0, center center, 460, from(#fffcdd), to(#fafafa)); 
	/* Safari 5.1+, Chrome 10+ */ background: -webkit-radial-gradient(circle, #fffcdd, #fafafa); 
	/* Firefox 3.6+ */ background: -moz-radial-gradient(circle, #fffcdd, #fafafa); 
	/* IE 10 */ background: -ms-radial-gradient(circle, #fffcdd, #fafafa);
	
}

#box2{
	height: 20px;
	width: 718px;
}

#box3{
	height: 20px;
	border-radius: 12px 12px 0 0;
	background-color:transparent;
	border-top: 5px ridge gray;
	margin-left: 30px;
	margin-top: -2px;
}

.quarter-circle-left {
	-moz-border-radius: 10px 0 0;
	border-radius: 10px 0 0 0;
}

.quarter-circle-right {
	-moz-border-radius: 0 10px 0 0 0;
	border-radius: 0 10px 0 0;
}

.quarter-circle-left, .quarter-circle-right{
	border-top: 1px solid gray;
	height: 10px !important;
	width: 10px !important;
	float: left;
}

.marquee_band{
	border:0;
	border-top: 1px solid gray;
	width: 669px !important;
	float:left;
}

#accent1, #accent2, #accent3{
	position: relative;
	top: 15px;
}

#neon{
	width: 380px;
	font-size: 51px;
	margin: 0 auto 0;
	height: 40px;
	z-index:2;
	position: relative;
	top: -32px;
}

.splash{
	
}

.splashContent{
	margin: 8px auto;
	text-align: justify;
	font-size:25px;
	width: 600px;
}

.opsContent{
    width: 600px;
	font-size: 25px;
	text-align: justify;
	margin:15px auto 15px;
}

.navBox{
	float: left;
	margin: 0 5px 0 5px;
	width: 225px;
	
}

.navs{
	margin: 0 auto;
	width: 940px;
	/*height: 220px;*/
	height: 80px;
}

.navExpand{
	width: 250px;
	margin-top: 6px;
}

.navText{
	
	height: 120px;
	background-color: gray;
	width: 198px;
	color: white;
	padding: 5px 5px 5px 5px;
	font-size: 18px;
	text-shadow: 2px 3px 3px #292929;
	text-align:center;
}

.buttonTop{
	
	height: 50px;
	background-color: #004976;
	border-radius: 8px 8px 0 0;
	border-top: 8px ridge #808080;
	width: 198px;
	text-align: center;
	margin-top: 4px;
	color: white;
	font-size: 22px;
	
	text-shadow: 2px 3px 3px #292929;
}

.buttonBottom{
	width: 0; 
	height: 0;
	border-top: 25px solid #004976;
	border-left: 99px solid transparent; 
	border-right: 99px solid transparent;
	border-radius-top: 8px;
	cursor: pointer;
}

.arrow{
	color: white;
	width: 10px;
	height: 18px;
	position: relative;
	top: -30px;
	left: -8px;
	font-size: 25px;
}

.hilight {
  background: yellow;
}


.carousel-label{
	font-size: 22px;
	color: white;
	height: 45px;
	width: 600px;
	margin: 0 auto;
	padding: 8px;
	
	background: #044a76;
}

.carousel-text{
	font-size: 16px;
	background-image: none;
}


.left, .right, .btn-lg{
	font-family:Glyphicons Halflings;
	width: 36px;
	height: 36px;
	font-size: 28px;
	cursor: pointer;
}


.left, .right, .carousel{
	float: left;
	margin: 0 auto;
}

.carousel-div{
	width: 680px;
	height: 80px;
	margin: 0 auto;
}

</style>

<article style="color: #8A8C8F; font-size: 24px; font-family:'verdana'; width: 600px; margin-top: 25px; justify-content: space-between;">

<div style="width: 560px; margin:0 auto;">Modobot is an automated trading platform for Bitcoins. It is easy to understand and simple to operate.</div>

<span class="label" id="features" style="display:block; margin: 0 50px 55px 168px;">Features</span>
<ul>
  <li>Free LIVE Trades up to 1 Bitcoin (for a limited time).</li>
  <li>Track Account History.</li>
  <li>Sandbox Mode to practice trading strategies.</li>
  <li>Built in spread calculator to quickly determine when to sell and when to buy.</li>
  <li>Create Limit orders, or allow Modobot to place orders for you.</li>
  <li>24/7 Operation.</li>
  <li>View Transaction History.</li>
</ul>
</article>

<article id="splash" style="color: #8A8C8F; width: 750px; margin-top: 40px; justify-content: space-between; flex-grow: 1;">

<div id="box1" class="brighten">

<div id="accent1">
<div class="quarter-circle-left"></div>
<div class="marquee_band"></div>
<div class="quarter-circle-right"></div>
</div>

<div id="accent2">
<div class="quarter-circle-left"></div>
<div class="marquee_band"></div>
<div class="quarter-circle-right"></div>
</div>

<div id="accent3">
<div class="quarter-circle-left"></div>
<div class="marquee_band"></div>
<div class="quarter-circle-right"></div>
</div>

<div id="neon" class="label flickerOff">Signups are open!</div>

</div>

<div id="box2">
<div id="box3"></div>
</div>
<br />
<div class="splashContent">
Click on 'New Accounts' in the upper right hand corner to register for a free automated trading bot. Click on the details below to see how it works.
</div>

</article>


<article id="docs" style="color: #8A8C8F; font-family:'verdana' width: 500; margin-top: 15px;  text-align: center;">
  <span class="label" id="ops">Operation</span>
  <div class="opsContent">
    Modobot uses a basic "Buy-Low Sell-High" strategy that only requires a few settings.
  </div>
    <br />


<div class="carousel-div">
  <div class="left" data-slide="prev">
    <div class="glyphicon-chevron-left"></div>
  </div>
  
  <div class="carousel">


  <div class="carousel-inner">
  
    <div class="item active">
      <div class="carousel-label">Is Active</div>
	  <div class="carousel-text">
	    Single master switch to disable all trading
	  </div>
	</div>
    <div class="item">
      <div class="carousel-label">Sandbox Mode</div>
	  <div class="carousel-text">
	    Switch between Sandbox mode and Live mode
	  </div>
    </div>
    <div class="item">
      <div class="carousel-label">Sandbox Mode</div>
	  <div class="carousel-text">
	    Switch between Sandbox mode and Live mode
	  </div>
	</div>
	<div class="item">
      <div class="carousel-label">Auto Sell</div>
	  <div class="carousel-text">
	    Permit or disallow automatic sales
	  </div>
	</div>
	<div class="item">
      <div class="carousel-label">Auto Buy</div>
	  <div class="carousel-text">
	    Permit or disallow automatic purchases
	  </div>
	</div>
	<div class="item">
      <div class="carousel-label">Base</div>
	  <div class="carousel-text">
	    Set base price around which to calculate transaction offsets
	  </div>
	</div>
	<div class="item">
      <div class="carousel-label">% Increase</div>
	  <div class="carousel-text">
	    Increase over Base where a sale should be triggered
	  </div>
	</div>
	<div class="item">
      <div class="carousel-label">% Decrease</div>
	  <div class="carousel-text">
	    Increase over Base where a purchase should be triggered
	  </div>
	</div>
	<div class="item">
      <div class="carousel-label">Sell Limit Btc</div>
	  <div class="carousel-text">
	    Set limit on how many coins can be sold in a single transaction
	  </div>
	</div>
	<div class="item">
      <div class="carousel-label">Buy Limit Btc</div>
	  <div class="carousel-text">
	    Set limit on how many coins can be purchased in a single transaction
	  </div>
	</div>
	<div class="item">
      <div class="carousel-label">Fixed Sell</div>
	  <div class="carousel-text">
	    Permit or disallow fixed sales
	  </div>
	</div>
	<div class="item">
      <div class="carousel-label">Fixed Buy</div>
	  <div class="carousel-text">
	    Permit or disallow fixed purchases
	  </div>
	</div>
	<div class="item">
      <div class="carousel-label">Sell Price</div>
	  <div class="carousel-text">
	    Price at which a sale is triggered
	  </div>
	</div>
	<div class="item">
      <div class="carousel-label">Buy Price</div>
	  <div class="carousel-text">
	    Price at which a purchase is triggered
	  </div>
	</div>
  </div>
  </div>

  <div class="right" data-slide="next">
    <div class="glyphicon-chevron-right"></div>
  </div>
</div>


</article>

<!--article id="privacy" style="font-size: 17px; color: #8A8C8F; font-family:'verdana' width: 500; margin-top: 5px;">
<span class="label" id="priv">Privacy Policy:</span>
Modobot.com does not collect any user data, with the exception of security logging that contains no user-identifiable information. No site passwords are stored anywhere. Exchange specific credentials are encrypted in the database.
</article-->

<script>
function flicker(flag)
{
	
	if(flag == "on"){
		
		$("#neon").removeClass("flickerOn");
		$("#box1").removeClass("brighten").addClass("dim");
		$("#neon").addClass("flickerOff");
		
		var rand = Math.random() * (400 - 50) + 50;
		setTimeout(function(){flicker("off");}, rand);
	}
	else{
		
		$("#neon").removeClass("flickerOff");
		$("#box1").removeClass("dim").addClass("brighten");
		$("#neon").addClass("flickerOn");
		
		var rand = Math.random() * (6500 - 10) + 10;
		setTimeout(function(){flicker("on");}, rand);
	}
}

$(function(){
		  
  $(".navText").css("display", "none");
  $('.carousel').carousel({wrap:true, interval:2000});
  
  $(document).ready(function(){
    $(".left").click(function(){
        $(".carousel").carousel('prev');
    });
  });
  
  $(document).ready(function(){
    $(".right").click(function(){
        $(".carousel").carousel('next');
    });
  });

  $(".buttonBottom").on("click", function(o){
    
     $(".arrow").html("&dArr;");
	 //$(".navs").height(0);
	 //$(".navs").css("height", "80px");
	 
	 if( $(this).closest(".navs").height() == 80 ){
	 	$(".navs").animate({height: 80},0);
	 }

 
     if($(this).prev("div").css("display") === "block"){
		$(this).first(".arrow").html("<div class='arrow'>&dArr;</div>");
	 }
	 else{
	    $(this).first(".arrow").html("<div class='arrow'>&uArr;</div>");
	 }
	 
	 
 
     $(".navText").hide("blind", 200);
	 
	 $(this).closest(".navs").animate({height: 210},200);
	 //$(this).closest(".navs").css("height", "250px");
	 
     $(this).prev().show("blind", 200); 
 });

});

var rand = Math.random() * (400 - 40) + 10
setTimeout(function(){flicker("on");}, rand);


</script>