$(document).ready(function(){


$(".e_btn").on("click",function(){
	//console.log(this.id);
	var id = this.id.replace("edit_btn","");
	$.ajax({
		url : 'topic/topic/get_topic',
		dataType : "json",
		cache : false,
		data : {
			id_topic : id
		},
		type : 'post',
		success : function(output) {
				//console.log(output);
			}
	});
});


});