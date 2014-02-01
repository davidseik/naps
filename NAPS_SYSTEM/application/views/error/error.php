<style>
	#error_message{
		width:30%;
		margin:0 auto;
		background-image: linear-gradient(to bottom,#d9534f 0,#c12e2a 100%);
		border-radius: 0 0 5px 5px;
		-moz-border-radius: 0 0 5px 5px;
		-webkit-border-radius: 0 0 5px 5px;
		background-repeat: repeat-x;
		border-color: #b92c28;
	}

	#error_message p{
		font-size: 1em;
		text-align: center;
		color:white;
	}

	@media screen and (max-width: 600px){
	#error_message p{
		font-size: .8em;
	}
	}
</style>

<script>
window.setTimeout(function(){
	$("#error_message").fadeOut('slow');
},3000);
</script>

<div id="error_message">
	<p><?php 
	if(isset($error)){
		echo $error;
	}
	?></p>
</div>