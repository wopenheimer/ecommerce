<?php

include_once("model/usuario.php");
include_once("model/pessoa.php");
include_once("model/perfil.php");
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
   $usuario = new Usuario();
   $usuarios = $usuario->getUsuarios();
   $template = "usuario_" . "home";
   render($usuarios, $template);	
}


function add(){
	if (!$_POST) {
	   	$pessoa = new Pessoa();
	    $pessoas = $pessoa->getPessoas();
	    $args['pessoas'] = $pessoas;

	   	$perfil = new Perfil();
	    $perfis = $perfil->getPerfis();
	    $args['perfis'] = $perfis;	    

		$template = "usuario_" . "add";
		render($args, $template);
	} else {	
		$usuario = new Usuario();
		$usuario->setEmail(validInputData($_POST["email"]));
		$usuario->setSenha(md5($_POST["senha"]));
		$usuario->setPessoa(validInputData($_POST["pessoa"]));
		$usuario->setPerfil(validInputData($_POST["perfil"]));

		$result = $usuario->add();
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
		$usuario = new Usuario();
		$usuario_obj = $usuario->getUsuarioById(validInputData($_GET["id"]));
		$args['usuario'] = $usuario_obj;

	   	$pessoa = new Pessoa();
	    $pessoas = $pessoa->getPessoas();
	    $args['pessoas'] = $pessoas;

	   	$perfil = new Perfil();
	    $perfis = $perfil->getPerfis();
	    $args['perfis'] = $perfis;	    

		$template = "usuario_" . "edit";
		render($args, $template);
	} else {
		$usuario = new Usuario();
		$usuario->setId(validInputData($_POST["id"]));
		$usuario->setEmail(validInputData($_POST["email"]));
		$usuario->setSenha(md5($_POST["senha"]));
		$usuario->setPessoa(validInputData($_POST["pessoa"]));
		$usuario->setPerfil(validInputData($_POST["perfil"]));

		$result = $usuario->edit();
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
	$usuario = new Usuario();
	$usuario->setId(validInputData($_GET["id"]));

	$result = $usuario->remove();
	$template = "show_message";

	if ($result) {
		$args['message'] = "Removido com sucesso!";	
	} else {
		$args['message'] = "Houve uma falha na remoção.";	
	}
	render($args, $template);		
}

?>

