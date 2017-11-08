<?php
include_once("paciente_calcular_imc.php");
include_once("paciente_add.php");

$pacientes = $args;

print '<h3>Pacientes</h3>';

print '
<table class="table">
	<tr>
		<th>CPF</th>
		<th>Nome</th>
		<th>Nascimento</th>
		<th>Peso</th>
		<th>Altura</th>	
		<th>Idade</th>
		<th>Massa Corpórea</th>
		<th>Opções</th>
	</tr>';
	for($i = 0; $i < sizeof($pacientes); $i++){
		$paciente = $pacientes[$i];
		print '<tr>
			<td>' .$paciente->getCpf(). '</td>
			<td>' .$paciente->getNome() .'</td>
			<td>' .$paciente->getDatanasc() .'</td>
			<td>' .$paciente->getPeso() .'</td>
			<td>' .$paciente->getAltura() .'</td>
			<td>' .$paciente->getIdade() .'</td>
			<td>' .$paciente->getImc() .'</td>
			<td>
			<a href="' . BASE_URL. 'paciente/edit/' .$paciente->getCpf() .'" class="btn btn-default" role="button">
				<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
			</a>
			<a href="' . BASE_URL. 'paciente/remove/' .$paciente->getCpf() .'" class="btn btn-default" role="button">
				<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
			</a>

			</td>
		</tr>';		
	}
print '</table>';
?>




<a href="#myModal2" role="button" class="btn btn-primary" data-toggle="modal">Adicionar Paciente</a>

<a href="#myModal" role="button" class="btn btn-large btn-success" data-toggle="modal">Calcular IMC de qualquer pessoa</a>


