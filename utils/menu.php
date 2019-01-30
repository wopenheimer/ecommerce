<?php

  menu();
  
  function menu() {
    $template = "comum_" . "menu";
    render(is_adm_user(), $template);	
  }
?>

