
	<?php
  //var_dump($data);
    if($data["menu_data"]["auth"] && $data["menu_data"]["category"]==1){
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
         <div class="row">
          <img src="<?= base_url().'img/storm/megaman-run.gif'?>" id="megaman-run" style="width:50px; position:absolute; left:calc(-60% - 50px); top:4%; display:none;" />
          <img src="<?= base_url().'img/storm/megaman-fire.gif'?>" id="megaman-fire" style="width:195px; position:absolute; left: calc(38% - 44px); top:-6%; display:none;" />
          <img src="<?= base_url().'img/storm/storm-fly.gif'?>" id="storm-fly" style="position:absolute; left:100%; top:-10%; display:none;" />
          <img src="<?= base_url().'img/storm/storm-stand.gif' ?>" id="storm-stand" style="position:absolute; width:180px; left:calc(60% - 60px); top:-10%; display:none;" />
         </div>

          <h1 id="title_system"> Presentation Rating System</h1>
          <h2> Today Presenting</h2>
          <audio style="display:none" id="storm_audio">
            <source src="<?= base_url().'img/storm/storm.mp3' ?>" type="audio/mpeg">
          Your browser does not support the audio element.
          </audio>
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
        //var_dump($p_data);
      ?>
        <div class="row">
          <div class="col-md-3 user_img_cont">
            <img src ="http://localhost:8888/NAPS/NAPS_SYSTEM/img/<?= $p_data['picture'] ?>" class="user_img" />
          </div>
        <?php 

          if(!$data["menu_data"]["auth"] ){
        ?>
              <div class="col-md-6">  
                <h2><a href="<?= base_url().'index.php/user_profile/'.$p_data['mail']?>"><?= $p_data['name'].' '.$p_data['last_name']?></a></h2>
                <h2><?= $p_data['title'] ?></h2>
                <h2><?= $p_data['date'] ?></h2>
                <!-- <button type="button" class="btn btn-md btn-success"><i class="fa fa-gavel fa-fw"></i>Evaluated</button>  -->
              </div>          
        <?php
        }else if(!$p_data['topic_rated']){
        ?>
            <div class="cont">
            <div class="card" id="flips<?= $p_data['id_user'] ?>">
              <div class="col-md-6 user_data_cont front" id="user_present<?= $p_data['id_user'] ?>">  
                <h2><a href="<?= base_url().'index.php/user_profile/'.$p_data['mail']?>"><?= $p_data['name'].' '.$p_data['last_name']?></a></h2>
                <h2><?= $p_data['title'] ?></h2>
                <h2><?= $p_data['date'] ?></h2>
                <button type="button" class="btn btn-md btn-primary eval_btn" id="eval<?= $p_data['id_user']?>"><i class="fa fa-gavel fa-fw"></i>Evaluate!</button> 
              </div>
              
              <div class="col-md-6 user_data_cont back nodisplay" id="user_form<?= $p_data['id_user'] ?>">  
                 <form id="rate_form<?= $p_data['id_user'] ?>" class="rate_form">
                  <input type="hidden" name="id_topic" value='<?= $p_data["id_topic"] ?>' />
                  <input type="hidden" name="id_user" value='<?= $p_data['id_user'] ?>' />
                  <input type="hidden" name="id_user_voting" value="<?php if(isset($data["menu_data"]["id_user"])) echo $data["menu_data"]["id_user"]; ?>" />
                  <h2><?= $p_data['name'].' '.$p_data['last_name']?></h2>
                  <h2><?= $p_data['title'] ?></h2>   
                  <div class="rate" name="rating" style="margin-bottom:20px"></div>
                  <div class="row" style="padding-bottom:10px;"><textarea name="comment" class="form-control" rows="3" placeholder="Place your comment here"></textarea></div>
                   <button type="submit" class="btn btn-md btn-primary save_btn" id="save<?= $p_data['id_user']?>"><i class="fa fa-save fa-fw"></i>Save</button> 
                </form>
               
              </div>
            </div>
          </div>

        <?php }else{ ?>
              <div class="col-md-6">  
                <h2><a href="<?= base_url().'index.php/user_profile/'.$p_data['mail']?>"><?= $p_data['name'].' '.$p_data['last_name']?></a></h2>
                <h2><?= $p_data['title'] ?></h2>
                <h2><?= $p_data['date'] ?></h2>
                <button type="button" class="btn btn-md btn-success"><i class="fa fa-check fa-fw"></i>Evaluated</button> 
              </div>
        <?php }?>

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