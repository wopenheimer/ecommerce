<?php

include_once("model/paciente.php");
include_once("utils/utils.php");

switch ($_REQUEST["page"]) {
    case 'home':
	   home();
       break;
	case 'add':
		add();
		break;	
	case 'edit':
		edit();
		break;	
	case 'remove':
		remove();
		break;	
	case 'processar_imc':
		processar_imc();
		break;	
	default:
		# code...
		break;
}


function home() {
   $paciente = new Paciente();
   $pacientes = $paciente->getPacientes();
   $template = "paciente_" . "home";
   render($pacientes, $template);	
}


function add(){
	$paciente = new Paciente();
	$paciente->setCpf(validInputData($_POST["cpf"]));
	$paciente->setNome(validInputData($_POST["nome"]));
	$paciente->setDatanasc(validInputData($_POST["datanasc"]));
	$paciente->setPeso(validInputData($_POST["peso"]));
	$paciente->setAltura(validInputData($_POST["altura"]));

	$result = $paciente->add();
	$template = "show_message";

	if ($result) {
		$args['message'] = "Inserido com sucesso!";	
	} else {
		$args['message'] = "Houve uma falha na insercao.";	
	}
	render($args, $template);
}


function edit(){
	if (!$_POST) {
		$paciente = new Paciente();
		$paciente_obj = $paciente->getPacienteByCpf(validInputData($_GET["id"]));

		$template = "paciente_" . "edit";
		render($paciente_obj, $template);
	} else {
		$paciente = new Paciente();
		$paciente->setCpf(validInputData($_POST["cpf"]));
		$paciente->setNome(validInputData($_POST["nome"]));
		$paciente->setDatanasc(validInputData($_POST["datanasc"]));
		$paciente->setPeso(validInputData($_POST["peso"]));
		$paciente->setAltura(validInputData($_POST["altura"]));

		$result = $paciente->edit();
		$template = "show_message";

		if ($result) {
			$args['message'] = "Alterado com sucesso!";	
		} else {
			$args['message'] = "Houve uma falha na edição.";	
		}
		render($args, $template);		
	}
}


function remove(){
	$paciente = new Paciente();
	$paciente->setCpf(validInputData($_GET["id"]));

	$result = $paciente->remove();
	$template = "show_message";

	if ($result) {
		$args['message'] = "Removido com sucesso!";	
	} else {
		$args['message'] = "Houve uma falha na remoção.";	
	}
	render($args, $template);		
}


function processar_imc(){
	$peso = validInputData($_POST["peso"]);
	$altura = validInputData($_POST["altura"]);
	$imc = Paciente::getImcQualquerPessoa($peso, $altura);
	$template = "show_message";
	$args['message'] = "IMC calculado: ";
	$args['content'] = $imc;
	render($args, $template);
}

?>

