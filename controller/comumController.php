<?php
include_once("model/usuario.php");
include_once("model/cidade.php");
include_once("utils/utils.php");

switch ($_REQUEST["page"]) {
    case 'login':
	   login();
       break;
    case 'logout':
	   logout();
       break;
    case 'novousuario':
	   novousuario();
       break;       
    case 'ativarusuario':
	   ativarusuario();
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
			$args['message'] = "Falha no login ou Usuário não está ativo no sistema.";	
		}
		render($args, $template);
	}
}


function novousuario() {
	if (!$_POST) {
            $cidade = new Cidade();
            $estados = $cidade->getDistinctEstados();
            $args['estados'] = $estados;

	    $template = "comum_" . "novousuario";
	    render($args, $template);	
	} else {	
            $pessoa = new Pessoa();
            $pessoa->setCpf(validInputData($_POST["cpf"]));
            $pessoa->setNome(validInputData($_POST["nome"]));
            $pessoa->setCidade(validInputData($_POST["cidade"]));

            $result = $pessoa->add();
            
            $usuario = new Usuario();
            $usuario->setEmail(validInputData($_POST["email"]));
            $usuario->setSenha(md5($_POST["senha"]));
            $usuario->setPessoa(validInputData($_POST["cpf"]));
            $usuario->setPerfil('2');
            $usuario->setAtivo(0);
            $hash_validacao = md5(uniqid(rand(), true));
            $usuario->setHashValidacao($hash_validacao);

            $result = $usuario->add();
            
            $template = "show_message";

            if ($result) {                    
                    $usuario->setPessoa($pessoa);
                    $usuario->envia_email_novousuario();
                    $args['message'] = "Usuário criado com sucesso. Acesse sua caixa de email para validar sua conta.";	
            } else {
                    $args['message'] = "Houve uma falha na criação do usuário.";	
            }
            render($args, $template);
	}
}

function ativarusuario(){
	if (isset($_GET["id"])) {
		$usuario = new Usuario();
		$usuario_obj = $usuario->getUsuarioByHash(validInputData($_GET["id"]));
                
                if ($usuario_obj == False) {
                    $args['message'] = "Usuário para ativação não encontrado.";	
                } else {
                    $result = $usuario_obj->ativarUsuario();
                    if ($result) {
                        $args['message'] = "O Usuário com respectivo email " . $usuario_obj->getEmail() . " foi validado. <br />";	
                        $args['message'] .= 'Você pode acessar sua conta agora: <a href="' . BASE_URL . MODULE_LOGIN . '/' . PAGE_LOGIN . '">' . BASE_URL . MODULE_LOGIN . "/" . PAGE_LOGIN .'</a>';
                    } else {
                        $args['message'] = "Houve um erro na ativação do usuário.";	
                    }
                }

		$template = "show_message";
                
		render($args, $template);
	} 
}

function logout() {
	destroy_session_user();
	header("Location: " . BASE_URL . MODULE_LOGIN . "/" . PAGE_LOGIN);				
}
?>