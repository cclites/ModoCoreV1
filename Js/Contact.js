var contactSubmit = function(){

  var cAddress = document.getElementById("cAddress").value,
      cSubject = document.getElementById("cSubject").value,
      cMessage = document.getElementById("cMessage").value,
      url = "ModoCore/Api/Dispatcher.php";

  $.ajax({
        type: "POST",
		url: url,
	    data: { func:"contact", cAddress:cAddress, cSubject:cSubject, cMessage:cMessage }
	}).success(function(data){
		
    $("#modals").dialog("close");
		//$("#modal").html("Thank you! An email has been sent to support.");

	}).error(function(data, error, message){
	     
	     //display error modal
	     alert("Unable to send notification.");
	     
	});
}

var contactDisplay = function(){
  var content = buildContact();
	
	$("#modals").dialog({
		modal: true,
		width: 800,
		height: 500,
		id: "contactModal",
		title: "Contact"
		}).html(content);
		
		$(".ui-dialog-titlebar-close").text("X");
		
		$("#contactSubmit").on("click", function(o){contactSubmit();});
		
}