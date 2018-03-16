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
		case 'get_cidades_by_estado':
			get_cidades_by_estado();
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
        $estados = $cidade->getDistinctEstados();
        $args['estados'] = $estados;

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
                $estados = $cidade->getDistinctEstados();
                $args['estados'] = $estados;

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


function get_cidades_by_estado() {        
	$estado_id = validInputData($_POST["estado_id"]);

	$cidade = new Cidade();
        $cidades = $cidade->getCidadesByEstado($estado_id);        
        $cidades_response = [];

        $cidade_response = [];
        $cidade_response['id'] = "";
        $cidade_response['nome'] = "----";
        $cidades_response[] = $cidade_response;
        
        foreach ($cidades as $key => $cidade) {
            $cidade_response = [];
            $cidade_response['id'] = $cidade->getId();
            $cidade_response['nome'] = $cidade->getNome();
            $cidades_response[] = $cidade_response;
        }
        
        $_SESSION["json_content"] = $cidades_response;
        
        header('Location: ' . BASE_URL . 'utils/json.php');
        exit(0);
}

?>

