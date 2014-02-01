<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

    <title>NAPS</title>

    <!-- Bootstrap core CSS -->
    <link href="<?= base_url(); ?>css/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <!-- <link href="<?= base_url(); ?>css/main/main.css" rel="stylesheet"> -->
    <?= $_styles ?>

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="navbar-fixed-top">
      <?= $menu ?>
      <?= $error ?>
    </div>
    <div class="jumbotron">
      <div class="container">
        <?= $content ?>
      </div> 
    </div>
    
    <div class="container">
      <footer>
        <p>&copy; Tekmexico 2014</p>
      </footer>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url(); ?>js/jquery/jquery-1.11.0.min.js"></script>
    <script src="<?php echo base_url(); ?>css/bootstrap/js/bootstrap.min.js"></script>
    <?= $_scripts ?>
  </body>
</html>
