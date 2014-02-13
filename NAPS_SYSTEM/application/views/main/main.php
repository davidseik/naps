
	<?php
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
        if(count($data["presentation_data"]) == 0){
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

          <div class="cont">
            <div class="card" id="flips<?= $p_data['id_user'] ?>">
              <div class="col-md-6 user_data_cont front" id="user_present<?= $p_data['id_user'] ?>">  
                <h2><?= $p_data['name'].' '.$p_data['last_name']?></h2>
                <h2><?= $p_data['title'] ?></h2>
                <h2><?= $p_data['date'] ?></h2>
                <button type="button" class="btn btn-md btn-primary eval_btn" id="eval<?= $p_data['id_user']?>"><i class="fa fa-gavel fa-fw"></i>Evaluate!</button> 
              </div>
              
              <div class="col-md-6 user_data_cont back nodisplay" id="user_form<?= $p_data['id_user'] ?>">  
                 <form id="rate_form<?= $p_data['id_user'] ?>">
                  <input type="hidden" name="id_topic" value='<?= $p_data["id_topic"] ?>' />
                  <input type="hidden" name="id_user" value='<?= $p_data['id_user'] ?>' />
                  <h2>Rate</h2>
                  <h2><?= $p_data['name'].' '.$p_data['last_name']?></h2>
                  <h2>Topic</h2>
                  <h2><?= $p_data['title'] ?></h2>
                  
                  <div class="rate" name="rating" style="margin-bottom:20px"></div>
                  <h2>Comment</h2>
                  <div class="row"><textarea name="comment" class="form-control" rows="3"></textarea></div>
                </form>
                <button type="button" class="btn btn-md btn-primary save_btn" id="save<?= $p_data['id_user']?>"><i class="fa fa-save fa-fw"></i>Save</button> 
              </div>
            </div>
          </div>

        </div>
      <?php
        }
      ?>


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