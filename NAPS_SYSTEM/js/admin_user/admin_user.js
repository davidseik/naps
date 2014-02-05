$(document).ready(function(){
	var isEditing = false; // Flag to see if the user is editing something
	$('#dataTables-example').dataTable(); // Datatable JS

	$('#dataTables-example').on("click", ".clickable", function(e){ // Delegation of event
		if(e.currentTarget.classList.contains("clickable")){
			if(e.currentTarget.classList.contains("e_btn")){ // Check if it's edit button
				var id = e.currentTarget.id.replace("edit_btn","");
				edit_data(id);

			}else if(e.currentTarget.classList.contains("d_btn")){ // Check if it's delete button

			var id = e.currentTarget.id.replace("delete_btn","");
			var res = confirm("Are you sure you want to delete this user?");
			if(res){
				console.log("User Deleted " + id);
			}

			}else{ // Nothing Was clicked? 
				console.log("Something Wrong Happened");
			}
		}
	});

	$("#cancel_form").on("click",function(){
		isEditing = false; // We cancel the editing behavior
		clear_user_form(); // Clear the form
		$("#add_edit_form").hide("slow"); // Hide the form
	});

	$("#data_form").submit(function(e){

		var serialized = $("#data_form").serialize();
		//console.log(serialized);
		if(isEditing){
			console.log(serialized);
		}else{
			var _pval = $("#pwd_in");
			if(_pval.val()!="" && _pval.val().length>5){
					//console.log("Valid Password");
					console.log(serialized);
			}else{
				alert("Password must be at least 6 characters long");
			}
		}
		e.preventDefault();

	});

	$("#add_new_user").on("click",function(){ // Listener for the button "Add New User"
		isEditing = false;
		clear_user_form();
		$("#edit_heading").html("Adding New User");
		if(!$("#add_edit_form").is(":visible")){
			$("#add_edit_form").show("slow");
		}
	});


	function clear_user_form(){ // Using different selector of jQuery we empty the form we use
		$("#data_form .form-group input, #data_form .form-group select, #data_form .form-group #id_label").each(function(index){ // Clear all the Inputs
			var elem = $(this);
			if(elem.is("input")){
				elem.val("");
			}else if(elem.is("select")){
				elem.val(1);
			}else if(elem.is("label")){
				elem.html("?");
			}
		});
	}

	function edit_data(id){
		isEditing = true;
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
	}
});