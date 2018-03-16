<?php
  session_start();
  include_once("utils/properties.php");  
  include_once("utils/utils.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Ecommerce</title>

    <!-- Bootstrap -->
    <link href="<?= BASE_URL ?>view/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>view/css/estilo.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>view/css/bootstrap-datetimepicker.min.css" rel="stylesheet">    

     <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?= BASE_URL ?>view/js/bootstrap.min.js"></script>
    <script src="<?= BASE_URL ?>view/js/bootstrap-datetimepicker.min.js"></script>
    <script src="<?= BASE_URL ?>view/js/locale/bootstrap-datetimepicker.pt-BR.js"></script>
    <script src="<?= BASE_URL ?>view/js/jquery-3.3.1.min.js"></script>
    <script src="<?= BASE_URL ?>view/js/comum.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>    
    
  </head>
  <body>
    
    <?php            
      include_once("utils/menu.php");
    ?>
 
    <div class="container">
        <?php
        index();
        ?>
    </div>    
  </body>
</html>