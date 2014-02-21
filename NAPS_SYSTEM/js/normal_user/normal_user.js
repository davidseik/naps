$(document).ready(function(){
	var editing  = 0;
	var add_edit_form = $("#add_edit_form");
	$('#dataTables-example').dataTable(); 



	$(".e_btn").on("click",function(){
		var id = this.id.replace("edit_btn","");
		editing = 1;
		$.ajax({
			url : 'admin_user/admin_user/get_user_data',
			dataType : "json",
			cache : false,
			data : {
				id : id
			},
			type : 'post',
			success : function(output) {
					$("#add_edit_form").show("slow");
					$("#edit_heading").html("Editing "+output.name+" "+output.last_name);
					$("#id_label").html(output.id_admin_user);
					$("#name_in").val(output.name);
					$("#last_name_in").val(output.last_name);
					$("#mail_in").val(output.mail);
					$("#category_in").val(output.category);
					$("#active_in").val(output.active);
				}
			});
	});

	$("#add_new_user").on("click",function(){
		clear_user_form(add_edit_form);
		editing = 0;
		if(!add_edit_form.is(":visible"))
			add_edit_form.show("slow");
	});


	function clear_user_form(form){ // Using different selector of jQuery we empty the form we use	
		form.find("input, select, #label_topic_id").each(function(){
			var elem = $(this);
			if(elem.is("input")){
				elem.val("");
			}else if(elem.is("select")){
				elem.val();
			}else if(elem.is("label")){
				elem.html("?");
			}
		});
	}



});