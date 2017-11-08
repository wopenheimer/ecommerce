<?php

  menu();
  
  function menu() {
  	if (check_session_active()) {
	    $template = "comum_" . "menu";
	    render(null, $template);	
	}
  }
?>

