<?php
// var_dump($rating_history);
?>
<div class="maincontainer" style="padding-top:30px;">
	<div class="col-md-3" style="padding-right:30px">
		<div class="row">
			<img src="http://localhost:8888/NAPS/NAPS_SYSTEM/img/<?= $user_data['picture'] ?>" class="user_img"/>
		</div>
		<div class="row" style="text-align:center;">
			<h2>Global Score</h2>
			<h3><?= $user_data['score'] ?></h3>
		</div>
	</div>
	<div class="col-md-9">
		<div class="row">
			<h2><?= $user_data['name'].' '.$user_data['last_name'] ?></h2>
			<h2><?= $user_data['mail']?></h2>
		</div>
		<div class="row">
			<h2>Comments</h2>
			<?php
				foreach($rating_history as $comment){
			?>
			<div class="row user_comment">
				<div class="row">
					<div class="col-md-4">
						<?= $comment['date'] ?>
					</div>
					<div class="col-md-5">
						<?= $comment['title'].' - '.$comment['topic_category'] ?>
					</div>
					<div class="col-md-3">
						<?= $comment['score'] ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<p><?= $comment['comment'] ?></p>
					</div>
				</div>

			</div> 

			<?php
				}
			?>
		</div>
	</div>
</div>
