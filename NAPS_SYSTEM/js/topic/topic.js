$(document).ready(function(){

	var add_edit_form = $("#add_edit_form");
	var editing = 0;
	$('#dataTables-example').dataTable(); 

	$(".e_btn").on("click",function(){
		var id = this.id.replace("edit_btn","");
		editing = 1;
		$.ajax({
			url : 'topic/topic/get_topic',
			dataType : "json",
			cache : false,
			data : {
				id_topic : id
			},
			type : 'post',
			success : function(output) {
					add_edit_form.show("slow");
					$("#id_topic_in").val(output.id_topic);
					$("#label_topic_id").html(output.id_topic);
					$("#title_in").val(output.title);
					$("#category_in").val(output.topic_category);
					$("#active_in").val(output.active);
				}
		});
	});

	$(".d_btn").on("click",function(){
		var id = this.id.replace("delete_btn","");
		var res = confirm("Do you want to delete this topic?");
		if(res){
			$.ajax({
				url : 'topic/topic/delete_topic',
				dataType : "json",
				cache : false,
				data : {
					id_topic : id
				},
				type : 'post',
				success : function(output) {
					if(output.response){
						location.reload();
					}else{
						alert("Couldn't delete topic");
					}
				}
			});
		}
	});

	function clear_user_form(form){ // Using different selector of jQuery we empty the form we use	
		form.find("input, select, #label_topic_id").each(function(){
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

	$("#add_new_topic").on("click",function(){
		clear_user_form(add_edit_form);
		editing = 0;
		if(!add_edit_form.is(":visible"))
			add_edit_form.show("slow");
	});

	$("#cancel_form").on("click",function(){
		add_edit_form.toggle('slow');
	});

	$("#data_form").submit(function(e){
		e.preventDefault();
		var serialized = $(this).serialize();
		if(editing)
			update_topic(serialized);
		else
			add_topic(serialized);
	});

	function add_topic(data){
		$.ajax({
			url : 'topic/topic/add_topic',
			dataType : "json",
			cache : false,
			data : {
				data : data
			},
			type : 'post',
			success : function(output) {
				if(output.response){
					location.reload();
				}else{
					alert("Couldn't add topic");
				}
			}
		});
	}

	function update_topic(data){
		$.ajax({
			url : 'topic/topic/update_topic',
			dataType : "json",
			cache : false,
			data : {
				data : data
			},
			type : 'post',
			success : function(output) {
				if(output.response){
					location.reload();
				}else{
					alert("Couldn't update topic");
				}
			}
		});
	}



});