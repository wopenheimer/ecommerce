<?php


$anuncios = $args;

print '<h3>Anúncios</h3>';

print '
<table class="table">
	<tr>
		<th>ID</th>
		<th>Título</th>
		<th>Preço</th>
		<th>Anunciante</th>
		<th>Criado em</th>
		<th>Última Alteração</th>
		<th>Opções</th>
	</tr>';
	for($i = 0; $i < sizeof($anuncios); $i++){
		$anuncio = $anuncios[$i];
		print '<tr>
			<td>' .$anuncio->getId(). '</td>
			<td>' .$anuncio->getTitulo() .'</td>
			<td>' .$anuncio->getPreco() .'</td>
			<td><a href="' . BASE_URL. 'pessoa/edit/' .$anuncio->getAnunciante()->getCpf() .'">' .$anuncio->getAnunciante()->getNome() .'</a></td>
			<td>' .$anuncio->getDataCriacao() .'</td>
			<td>' .$anuncio->getUltimaAlteracao() .'</td>
			<td>
			<a href="' . BASE_URL. 'anuncio/imagens/' .$anuncio->getId() .'" title="Fotos do Anúncio" class="btn btn-default" role="button">
				<span class="glyphicon glyphicon-camera" aria-hidden="true"></span>
			</a>
			<a href="' . BASE_URL. 'anuncio/edit/' .$anuncio->getId() .'" class="btn btn-default" role="button">
				<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
			</a>
			<a href="' . BASE_URL. 'anuncio/remove/' .$anuncio->getId() .'" class="btn btn-default" role="button">
				<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
			</a>

			</td>
		</tr>';		
	}
print '</table>';
?>




<a href="<?= BASE_URL ?>anuncio/add" role="button" class="btn btn-primary" data-toggle="modal">Adicionar Anúncio</a>


