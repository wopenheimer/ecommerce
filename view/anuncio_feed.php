<?php


$anuncios = $args;

print '<h3>Anúncios</h3>';

?>

<form action="<?= BASE_URL ?>anuncio/feed" method="POST">
  <div class="input-group">
   <input type="text" class="form-control" name="q" id="q" placeholder="Buscar" required autofocus="" />
   <span class="input-group-btn">
        <button class="btn btn-default" type="button">Buscar</button>
   </span>
</div>
</form>
<br />

<div class="paragraphs">
<?php
	for($i = 0; $i < sizeof($anuncios); $i++){
		$anuncio = $anuncios[$i];
		?>
  	    <div class="row container-fluid">
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
		            <h3><a href="<?= BASE_URL ?>anuncio/view/<?= $anuncio->getId() ?>"><?=$anuncio->getTitulo();?></a></h3>
		            <p><?=$anuncio->getPreco();?></p>
		            <p><?=$anuncio->getAnunciante()->getNome();?></p>
		            <p>
		            	<a 
		            		href="<?= BASE_URL ?>anuncio/feed/?cidade=<?= $anuncio->getAnunciante()->getCidade()->getId(); ?>">
		            		<?= $anuncio->getAnunciante()->getCidade()->getNome();?>-<?=$anuncio->getAnunciante()->getCidade()->getEstado()->getSigla();?>
		            		
		            	</a>
		            </p>
		            <p><?=$anuncio->getUltimaAlteracao();?></p>
	        	</div>
	        </div>	      
	      </div>
	    </div>		
		<?php	
	}
?>
</div>



