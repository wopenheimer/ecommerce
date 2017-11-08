<?php
include_once("model/usuario.php");
include_once("utils/utils.php");

switch ($_REQUEST["page"]) {
    case 'login':
	   login();
       break;
    case 'logout':
	   logout();
       break;

}


function login() {
	if (!$_POST) {
	    $template = "comum_" . "login";
	    render(null, $template);	
	} else {	
		$usuario = new Usuario();
		$usuario->setEmail(validInputData($_POST["email"]));
		$usuario->setSenha(md5($_POST["senha"]));

		$usuario_obj = $usuario->getLogin();

		$args = null;
		if ($usuario_obj) {
			create_session_user($usuario_obj);
			header("Location: " . BASE_URL . MODULE_HOME . "/" . PAGE_HOME);			
		} else {
			$template = "show_message";
			$args['message'] = "Falha no login.";	
		}
		render($args, $template);
	}
}


function logout() {
	destroy_session_user();
	header("Location: " . BASE_URL . MODULE_LOGIN . "/" . PAGE_LOGIN);				
}
?>