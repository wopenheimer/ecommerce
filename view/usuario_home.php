<?php

$usuarios = $args;

print '<h3>Usuários</h3>';

print '
<table class="table">
	<tr>
		<th>ID</th>
		<th>Email</th>
		<th>Pessoa</th>
		<th>Opções</th>
	</tr>';
	for($i = 0; $i < sizeof($usuarios); $i++){
		$usuario = $usuarios[$i];
		print '<tr>
			<td>' .$usuario->getId(). '</td>
			<td>' .$usuario->getEmail() .'</td>
			<td><a href="' . BASE_URL. 'pessoa/edit/' .$usuario->getPessoa()->getCpf() .'">' .$usuario->getPessoa()->getNome() .'</a></td>
			<td>
			<a href="' . BASE_URL. 'usuario/edit/' .$usuario->getId() .'" class="btn btn-default" role="button">
				<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
			</a>
			<a href="' . BASE_URL. 'usuario/remove/' .$usuario->getId() .'" class="btn btn-default" role="button">
				<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
			</a>

			</td>
		</tr>';		
	}
print '</table>';
?>




<a href="<?= BASE_URL ?>usuario/add" role="button" class="btn btn-primary" data-toggle="modal">Adicionar Usuário</a>


