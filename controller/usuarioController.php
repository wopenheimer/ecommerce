<?php

include_once("model/usuario.php");
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
	default:
		# code...
		break;
}


function home() {
   $usuario = new Usuario();
   $usuarios = $usuario->getUsuarios();
   $template = "usuario_" . "home";
   render($usuarios, $template);	
}


function add(){
	if (!$_POST) {
	   	$paciente = new Paciente();
	    $pacientes = $paciente->getPacientes();

		$template = "usuario_" . "add";
		render($pacientes, $template);
	} else {	
		$usuario = new Usuario();
		$usuario->setEmail(validInputData($_POST["email"]));
		$usuario->setSenha(md5($_POST["senha"]));
		$usuario->setPaciente(validInputData($_POST["paciente"]));

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

	   	$paciente = new Paciente();
	    $pacientes = $paciente->getPacientes();
	    $args['pacientes'] = $pacientes;

		$template = "usuario_" . "edit";
		render($args, $template);
	} else {
		$usuario = new Usuario();
		$usuario->setId(validInputData($_POST["id"]));
		$usuario->setEmail(validInputData($_POST["email"]));
		$usuario->setSenha(md5($_POST["senha"]));
		$usuario->setPaciente(validInputData($_POST["paciente"]));

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

