<?php
  if($auth){
?>
<div class="navbar navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?= base_url();?>index.php/">NAPS</a>
        </div>
      <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="#">Hello <?= $name.' '.$last_name; ?></a> <input type="hidden" value='<?= $id_user ?>' id="logged_user" /><li>
            <?php
              if($category == 1){ ?>
            <li><a href="<?= base_url();?>index.php/dashboard">Dashboard</a></li>
            <?php }?>
            <li><a href="<?= base_url();?>index.php/session/destroy">Logout</a></li>
          </ul>
      </div>
      </div>
</div> 
<?php
}else{
?>
<div class="navbar navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?= base_url();?>index.php/">NAPS</a>
        </div>
      <div class="navbar-collapse collapse">
       <form class="navbar-form navbar-right" role="form" id="login_form" action="<?php echo base_url(); ?>index.php/main/main/sign_in" method="post">
           <!-- <form class="navbar-form navbar-right" role="form" id="login_form" method="post">  -->
            <div class="form-group">
              <input type="text" placeholder="Email" id="mail_input" class="form-control" name="mail" size="25" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="mail@domain.com" required>
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control" name="pass">
            </div>
            <button  type="submit" class="btn btn-success" id="login_form_button">Sign in</button>
            <div style="color:white; margin-top:2px;">
              <span><input type="checkbox" id="remember_me" style="margin-right:5px"/>Remember Me </span>
            </div>
        </form>
        </div>
      </div>
</div>
<?php
}
?> 