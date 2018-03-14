<?php

include_once("model/pessoa.php");
include_once("model/cidade.php");
include_once("utils/utils.php");

if (is_adm_user()) {
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
} else {
	$template = "show_message";
	$args['message'] = "Permissão negada.";	
	render($args, $template);	
}


function home() {
    $pessoa = new Pessoa();
    $pessoas = $pessoa->getPessoas();
    $args['pessoas'] = $pessoas;

  	$cidade = new Cidade();
    $cidades = $cidade->getCidades();
    $args['cidades'] = $cidades;

   $template = "pessoa_" . "home";
   render($args, $template);	
}


function add(){
	$pessoa = new Pessoa();
	$pessoa->setCpf(validInputData($_POST["cpf"]));
	$pessoa->setNome(validInputData($_POST["nome"]));
	$pessoa->setDatanasc(validInputData($_POST["datanasc"]));
	$pessoa->setCelular(validInputData($_POST["celular"]));
	$pessoa->setCidade(validInputData($_POST["cidade"]));
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
		$args['pessoa'] = $pessoa_obj;

	   	$cidade = new Cidade();
	    $cidades = $cidade->getCidades();
	    $args['cidades'] = $cidades;

		$template = "pessoa_" . "edit";
		render($args, $template);
	} else {
		$pessoa = new Pessoa();
		$pessoa->setCpf(validInputData($_POST["cpf"]));
		$pessoa->setNome(validInputData($_POST["nome"]));
		$pessoa->setDatanasc(validInputData($_POST["datanasc"]));
		$pessoa->setCelular(validInputData($_POST["celular"]));
		$pessoa->setCidade(validInputData($_POST["cidade"]));
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

