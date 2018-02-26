<?php


$anuncios = $args;

print '<h3>Anúncios</h3>';

?>

<div class="paragraphs">
<?php
	for($i = 0; $i < sizeof($anuncios); $i++){
		$anuncio = $anuncios[$i];
		?>
  	    <div class="row">
	      <div class="span4">
	        <div class="clearfix content-heading">
	        	<?php
	        	$img = $anuncio->getMainfile();
	        	if ($img == "") {
	        		$img = NO_IMAGE_FILE;
	        	}
	        	?>
	            <img class="img-responsive img-rounded pull-left" width="250px" src="<?= BASE_URL . 'utils/image.php?img=' . $img; ?> " style="margin-right: 10px" />
	            <div>
		            <h3><?=$anuncio->getTitulo();?></h3>
		            <p><?=$anuncio->getPreco();?></p>
		            <p><?=$anuncio->getAnunciante()->getNome();?></p>
		            <p><?=$anuncio->getUltimaAlteracao();?></p>
	        	</div>
	        </div>	      
	      </div>
	    </div>		
		<?php	
	}
?>
</div>



