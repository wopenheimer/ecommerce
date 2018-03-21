<?php
$pessoas = $args;

include_once("pessoa_add.php");

print '<h3>Pessoas</h3>';

print '
<table class="table">
	<tr>
		<th>Foto</th>
		<th>CPF</th>
		<th>Nome</th>
		<th>Nascimento</th>
		<th>Celular</th>
		<th>Cidade</th>
		<th>Cep</th>	
		<th>Idade</th>
		<th>Opções</th>
	</tr>';
	for($i = 0; $i < sizeof($args['pessoas']); $i++){
		$pessoa = $args['pessoas'][$i];
		print '<tr>
		    <td>
		      <img class="img-responsive img-circle pull-left" width="30px" src="'. BASE_URL . 'utils/image.php?img=' . $pessoa->getFoto() . '" />		    
		    </td>
			<td>' .$pessoa->getCpf(). '</td>
			<td>' .$pessoa->getNome() .'</td>
			<td>' .$pessoa->getDatanasc() .'</td>
			<td>' .$pessoa->getCelular() .'</td>
			<td>' .$pessoa->getCidade()->getNome() . '-' . $pessoa->getCidade()->getEstado()->getSigla() .'</td>
			<td>' .$pessoa->getCep() .'</td>
			<td>' .$pessoa->getIdade() .'</td>
			<td>
			<a href="' . BASE_URL. 'pessoa/edit/' .$pessoa->getCpf() .'" class="btn btn-default" role="button">
				<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
			</a>
			<a href="' . BASE_URL. 'pessoa/remove/' .$pessoa->getCpf() .'" class="btn btn-default" role="button">
				<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
			</a>

			</td>
		</tr>';		
	}
print '</table>';
?>




<a href="#myModal2" role="button" class="btn btn-primary" data-toggle="modal">Adicionar Pessoa</a>



