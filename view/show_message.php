<div class="alert alert-info">
  <strong>Info!</strong> 
    <?php 
    	if (isset($args['message'])) { 
    		print $args['message'];
    	} 

     	if (isset($args['content'])) {
     		print $args['content'];
     	}

    ?> 
</div>