$(document).ready(function(){

	
	function init(){
		if(localStorage.check_active == 1){
			$("#mail_input").val(localStorage.mail_input);
			$("#remember_me").attr("checked","checked");
		}
	}

	$("#sort_button").on("click",function(){
		var user_select = $("#user_select").val();
		var topic_select = $("#topic_select").val();

		$.ajax({
			url : 'main/main/sort_user_topic',
			dataType : "json",
			cache : false,
			data : {
				user_select : user_select,
				topic_select : topic_select
			},
			type : 'post',
			success : function(output) {
						var res = confirm("You got: "+output.name+" with the topic: "+output.title+", do you want to assign it?");
						if(res){
							$.ajax({
								url : 'main/main/set_user_topic_presented',
								dataType : "json",
								cache : false,
								data : {
									id_user : output.id_user,
									id_topic : output.id_topic
								},
								type : 'post',
								success : function(output) {
										if(output.response){
											alert("Presentation Added Correctly!");
											location.reload();
										}else{
											alert("Something Bad Happened");
										}
									}
							});
						}
				}
		});
	});

	$("#user_select").on("change",function(e){
		$.ajax({
			url : 'main/main/get_user_topics',
			dataType : "json",
			cache : false,
			data : {
				id : $(this).val()
			},
			type : 'post',
			success : function(output) {
				var topic_select = $('#topic_select');
				topic_select.find('option:gt(0)').remove();
					$.each(output, function (i, item) {
					    topic_select.append($('<option>', { 
					        value: item.id_topic,
					        text : item.title 
					    }));
					});
				}
		});
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