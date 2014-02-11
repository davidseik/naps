
	<?php
	//	var_dump($data);
    if($data["menu_data"]["auth"]){
	?>
		<div class="col-md-12"style="margin-bottom:50px; border-bottom:1px solid #c3c3c3; padding-bottom:10px;">
      <div class="col-md-4">
         <select class="form-control sort_select" id="user_select" name="user">
            <option value="0" selected="selected">Random User</option>
            <?php
              foreach($data["user_data"] as $row){
            ?>
              <option value=<?= $row["id_user"] ?>><?= $row["name"].' '.$row['last_name']  ?></option>
            <?php
              }
            ?>
          </select>
      </div>
      <div class="col-md-4">
          <select class="form-control sort_select" id="topic_select" name="topic">
            <option value="0" selected="selected">Random Topic</option>
          </select>
      </div>
      <div class="col-md-4">
  			<button type="button" class="btn btn-lg btn-primary" id="sort_button">Sort</button>
  		</div>
    </div>

	<?php
	}
	?>


<div class="maincontainer col-md-10" >
      <div class="row">
       <div class="col-md-12">
          <h1> Presentation Rating System</h1>
          <h2> Today Presenting</h2>
       </div> 
      </div>
      <?php
      //var_dump($data);
        if(count($data["presentation_data"]) == 0){
          //echo "No presentation :(";
        ?>
          <h2>:'( No presentations right now</h2>
        <?php
          }
          ?>
      <?php

        foreach ($data["presentation_data"] as $p_data) {
      
      ?>
        <div class="row">
          <div class="col-md-3 user_img_cont">
            <img src ="http://localhost:8888/NAPS/NAPS_SYSTEM/img/<?= $p_data['picture'] ?>" class="user_img" />
          </div>

        <div class="col-md-6 user_data_cont">  
            <h2><?= $p_data['name'].' '.$p_data['last_name']?></h2>
            <h2><?= $p_data['title'] ?></h2>
            <h2><?= $p_data['date'] ?></h2>
            <button type="button" class="btn btn-md btn-primary" id="eval<?= $p_data['id_user']?>"><i class="fa fa-gavel fa-fw"></i>Evaluate!</button> 
          </div>
        </div>
      <?php
        }
      ?>

<!--       <div class="row">
      		<div class="col-md-3 user_img_cont">
      			<img src ="http://localhost:8888/NAPS/NAPS_SYSTEM/img/2.jpg" class="user_img" />
      		</div>
      		 <div class="col-md-6 user_data_cont">	
      		 	<h2>Benjamin Hurtado</h2>
      		 	<h2>jQuery Design Patterns</h2>
      		 	<h2>February 6, 2014</h2>
      		 	<button type="button" class="btn btn-md btn-primary"><i class="fa fa-gavel fa-fw"></i>Evaluate!</button>
      		</div>
      </div> -->
 <!--      <div class="row">
      		<div class="col-md-3 user_img_cont">
      			<img src ="http://localhost:8888/NAPS/NAPS_SYSTEM/img/david.jpg" class="user_img" />
      		</div>
      		 <div class="col-md-6 user_data_cont">	
      		 	<h2>David Castro</h2>
      		 	<h2>CodeIgniter</h2>
      		 	<h2>February 6, 2014</h2>
      		 	<button type="button" class="btn btn-md btn-primary"><i class="fa fa-gavel fa-fw"></i>Evaluate!</button>
      		</div>
      </div> -->


 </div>
 <div class="top3 col-md-2">
        <h2>TOP 3</h2>
        <div class="row">
        	<span class="label" style="margin-right:5px; background-color:#FFDB1B;">1</span><span class="label" style="color:black">David Castro</span>
 		</div>
 		<div class="row">
 			<span class="label" style="margin-right:5px; background-color:#DDDBD9">2</span><span class="label" style="color:black">Benjamín Hurtado</span>
 		</div>
 		 <div class="row">
 			<span class="label label-warning" style="margin-right:5px;">3</span><span class="label" style="color:black">Ángel Dávila</span>
 		</div>
 		<div class="row" style="margin: 0 auto;">
 			<button type="button" class="btn btn-md btn-primary" id="see_all"><i class="fa fa-trophy fa-fw"></i>See all</button>
 		</div>
 </div> 