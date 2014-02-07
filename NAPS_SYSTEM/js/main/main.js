$(document).ready(function(){

	
	function init(){
		if(localStorage.check_active == 1){
			$("#mail_input").val(localStorage.mail_input);
			$("#remember_me").attr("checked","checked");
		}
	}

	$("#sort_button").on("click",function(){
		console.log("wooo");
	});

	$("#remember_me").on("change",function(){
		var name = $("#mail_input").val();
		if($(this).is(":checked") && name!=""){
			localStorage.mail_input = name;
			localStorage.check_active = 1;
		}else{
			 localStorage.mail_input = "";
			 localStorage.check_active = 0;
		}
	});

	$("#see_all").on("click",function(){
		console.log("See All Score");
	});

	init();

});