<?php

include_once("model/pessoa.php");
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
	default:
		# code...
		break;
}


function home() {
   $pessoa = new Pessoa();
   $pessoas = $pessoa->getPessoas();
   $template = "pessoa_" . "home";
   render($pessoas, $template);	
}


function add(){
	$pessoa = new Pessoa();
	$pessoa->setCpf(validInputData($_POST["cpf"]));
	$pessoa->setNome(validInputData($_POST["nome"]));
	$pessoa->setDatanasc(validInputData($_POST["datanasc"]));
	$pessoa->setCelular(validInputData($_POST["celular"]));
	$pessoa->setCep(validInputData($_POST["cep"]));

	$result = $pessoa->add();
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
		$pessoa = new Pessoa();
		$pessoa_obj = $pessoa->getPessoaByCpf(validInputData($_GET["id"]));

		$template = "pessoa_" . "edit";
		render($pessoa_obj, $template);
	} else {
		$pessoa = new Pessoa();
		$pessoa->setCpf(validInputData($_POST["cpf"]));
		$pessoa->setNome(validInputData($_POST["nome"]));
		$pessoa->setDatanasc(validInputData($_POST["datanasc"]));
		$pessoa->setCelular(validInputData($_POST["celular"]));
		$pessoa->setCep(validInputData($_POST["cep"]));

		$result = $pessoa->edit();
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
	$pessoa = new Pessoa();
	$pessoa->setCpf(validInputData($_GET["id"]));

	$result = $pessoa->remove();
	$template = "show_message";

	if ($result) {
		$args['message'] = "Removido com sucesso!";	
	} else {
		$args['message'] = "Houve uma falha na remoção.";	
	}
	render($args, $template);		
}


?>

