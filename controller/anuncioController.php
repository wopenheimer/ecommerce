<?php

include_once("model/anuncio.php");
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
   $anuncio = new Anuncio();
   $anuncios = $anuncio->getAnuncios();
   $template = "anuncio_" . "home";
   render($anuncios, $template);	
}


function add(){
	if (!$_POST) {
	   	$pessoa = new Pessoa();
	    $pessoas = $pessoa->getPessoas();

		$template = "anuncio_" . "add";
		render($pessoas, $template);
	} else {	

		$anuncio = new Anuncio();
        $anuncio->setTitulo(validInputData($_POST["titulo"]));
        $anuncio->setDescricao(validInputData($_POST["descricao"]));
        $anuncio->setPreco(validInputData($_POST["preco"]));
        $anuncio->setAnunciante(validInputData($_POST["anunciante"]));

		$result = $anuncio->add();
		$template = "show_message";

		if ($result) {
			$args['message'] = "Inserido com sucesso!";	
		} else {
			$args['message'] = "Houve uma falha na insercao.";	
		}
		render($args, $template);
	}
}


function edit(){
	if (!$_POST) {
		$anuncio = new Anuncio();
		$anuncio_obj = $anuncio->getAnuncioById(validInputData($_GET["id"]));
		$args['anuncio'] = $anuncio_obj;

	   	$pessoa = new Pessoa();
	    $pessoas = $pessoa->getPessoas();
	    $args['pessoas'] = $pessoas;

		$template = "anuncio_" . "edit";
		render($args, $template);
	} else {
		$anuncio = new Anuncio();
		$anuncio->setId(validInputData($_POST["id"]));
        $anuncio->setTitulo(validInputData($_POST["titulo"]));
        $anuncio->setDescricao(validInputData($_POST["descricao"]));
        $anuncio->setPreco(validInputData($_POST["preco"]));
        $anuncio->setAnunciante(validInputData($_POST["anunciante"]));

		$result = $anuncio->edit();
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
	$anuncio = new Anuncio();
	$anuncio->setId(validInputData($_GET["id"]));

	$result = $anuncio->remove();
	$template = "show_message";

	if ($result) {
		$args['message'] = "Removido com sucesso!";	
	} else {
		$args['message'] = "Houve uma falha na remoção.";	
	}
	render($args, $template);		
}

?>

