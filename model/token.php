<?php
include_once("dao/token_dao.php");
include_once("usuario.php");

class Token
{
    private $id;
    private $usuario;
    private $data;
    private $validade;
    private $token;
        
    private $token_dao;
    
    function __construct() {
        $this->token_dao = new TokenDao();
    }

    function getId() {
        return $this->id;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getData() {
        return $this->data;
    }

    function getValidade() {
        return $this->validade;
    }

    function getToken() {
        return $this->token;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setValidade($validade) {
        $this->validade = $validade;
    }

    function setToken($token) {
        $this->token = $token;
    }

    public function getTokenByToken($token) {                        
        $v_token = $this->token_dao->getTokenByToken($token);
        
        if (is_object($v_usuario)){
            $token = new Token();
            $token->setId($v_token->id);
            $token->setData($v_token->data);
            $token->setValidade($v_token->validade);
            $token->setToken($v_token->token);

            $usuario = new Usuario();
            $usuario->setId($v_token->usuario_id);
            $usuario->setPessoa($v_token->pessoa_cpf);
            $usuario->setEmail($v_token->email);
            $usuario->setSenha($v_token->senha);
            $usuario->setAtivo($v_token->ativo);

            $token->setUsuario($usuario);

            return $token;
        } else {
            return False;
        }   
    }		


    public function add() {                        
        $result = $this->token_dao->add($this);
        return $result;
    }	        


        
    public function envia_email_token() {
        try {
            $GLOBALS['mail']->addAddress($this->getUsuario()->getEmail());

            $GLOBALS['mail']->Subject = 'Redefinicao de Senha -  ECOMMERCE';
            $GLOBALS['mail']->Body = '<p>Prezado usuario,</p>';
            $GLOBALS['mail']->Body .= '<p>Clique no link a seguir para redefinir sua senha: </p>';
            $GLOBALS['mail']->Body .= '<p>' . BASE_URL . 'comum/trocarsenha/' . $this->getToken() . '</p>';
            $GLOBALS['mail']->Body .= '<p>Agradecemos a preferência.</p>';

            $GLOBALS['mail']->send();
            return true;
        } catch (Exception $e) {
            return false;
        }            
    }
        
        
}

?>
