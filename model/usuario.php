<?php
include_once("dao/usuario_dao.php");
include_once("pessoa.php");
include_once("perfil.php");

class Usuario
{
	private $id;
	private $email;
	private $senha;
	private $pessoa;
	private $perfil;
        private $ativo;
        private $hash_validacao;
        
    private $usuario_dao;
    
    function __construct() {
        $this->usuario_dao = new UsuarioDao();
    }

	public function setId($id){
		$this->id = $id;
	}

	public function getId(){
		return $this->id;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setSenha($senha){
		$this->senha = $senha;
	}

	public function getSenha(){
		return $this->senha;
	}

	public function setPessoa($pessoa){
		$this->pessoa = $pessoa;
	}

	public function getPessoa(){
		return $this->pessoa;
	}

	public function setPerfil($perfil){
		$this->perfil = $perfil;
	}

	public function getPerfil(){
		return $this->perfil;
	}

	public function setAtivo($ativo){
		$this->ativo = $ativo;
	}

	public function getAtivo(){
		return $this->ativo;
	}

	public function setHashValidacao($hash_validacao){
		$this->hash_validacao = $hash_validacao;
	}

	public function getHashValidacao(){
		return $this->hash_validacao;
	}
        
	public function getUsuarios() {            
            
        $usuarios = $this->usuario_dao->getUsuarios();
        
        $array_usuarios = [];        
        if ($usuarios){
	        foreach ($usuarios as $v_usuario) {
	            $usuario = new Usuario();
	            $usuario->setId($v_usuario["usuario_id"]);
	            $usuario->setEmail($v_usuario["email"]);
	            $usuario->setSenha($v_usuario["senha"]);
                    $usuario->setAtivo($v_usuario["ativo"]);

	            $pessoa = new Pessoa();
	            $pessoa->setCpf($v_usuario["cpf"]);
	            $pessoa->setNome($v_usuario["nome"]);
	            $pessoa->setDatanasc($v_usuario["datanasc"]);
	            $pessoa->setCelular($v_usuario["celular"]);
	            $pessoa->setCep($v_usuario["cep"]);

	            $usuario->setPessoa($pessoa);

	            $perfil = new Perfil();
	            $perfil->setId($v_usuario["perfil_id"]);
	            $perfil->setDescricao($v_usuario["descricao"]);

	            $usuario->setPerfil($perfil);

	            $array_usuarios[] = $usuario;
	        }
    	}
        
        return $array_usuarios;
	}	

	public function getUsuarioById($id) {                        
        $v_usuario = $this->usuario_dao->getUsuarioById($id);
        
        $usuario = new Usuario();
        $usuario->setId($v_usuario->usuario_id);
        $usuario->setEmail($v_usuario->email);
        $usuario->setSenha($v_usuario->senha);
        $usuario->setAtivo($v_usuario->ativo);

        $pessoa = new Pessoa();
        $pessoa->setCpf($v_usuario->cpf);
        $pessoa->setNome($v_usuario->nome);
        $pessoa->setDatanasc($v_usuario->datanasc);
        $pessoa->setCelular($v_usuario->celular);
        $pessoa->setCep($v_usuario->cep);

        $usuario->setPessoa($pessoa);

        $perfil = new Perfil();
        $perfil->setId($v_usuario->perfil_id);
        $perfil->setDescricao($v_usuario->descricao);

        $usuario->setPerfil($perfil);


        return $usuario;
	}		


	public function getUsuarioByHash($hash) {                        
            $v_usuario = $this->usuario_dao->getUsuarioByHash($hash);
            
            if (is_object($v_usuario)){
                $usuario = new Usuario();
                $usuario->setId($v_usuario->id);
                $usuario->setEmail($v_usuario->email);
                $usuario->setSenha($v_usuario->senha);
                $usuario->setAtivo($v_usuario->ativo);

                return $usuario;                
            } else {
                return False;
            }
	}		        
        
        
	public function getUsuarioByEmail($email) {                        
            $v_usuario = $this->usuario_dao->getUsuarioByEmail($email);
            
            if (is_object($v_usuario)){
                $usuario = new Usuario();
                $usuario->setId($v_usuario->id);
                $usuario->setEmail($v_usuario->email);
                $usuario->setSenha($v_usuario->senha);
                $usuario->setAtivo($v_usuario->ativo);

                return $usuario;                
            } else {
                return False;
            }
	}		                
        
	public function ativarUsuario() {                        
            $result = $this->usuario_dao->ativarUsuario($this);
            return $result;
	}	                

	public function add() {                        
        $result = $this->usuario_dao->add($this);        
        return $result;
	}	        


	public function edit() {                        
        $result = $this->usuario_dao->edit($this);        
        return $result;
	}	        


	public function remove() {                        
        $result = $this->usuario_dao->remove($this);        
        return $result;
	}	        	

	public function getLogin() {                        
        $v_usuario = $this->usuario_dao->getLogin($this);        

        $usuario = null;
		if ($v_usuario) {
	        $usuario = new Usuario();
	        $usuario->setId($v_usuario->usuario_id);
	        $usuario->setEmail($v_usuario->email);
	        $usuario->setSenha($v_usuario->senha);
                $usuario->setAtivo($v_usuario->ativo);

	        $pessoa = new Pessoa();
	        $pessoa->setCpf($v_usuario->cpf);
	        $pessoa->setNome($v_usuario->nome);
	        $pessoa->setDatanasc($v_usuario->datanasc);
	        $pessoa->setCelular($v_usuario->celular);
	        $pessoa->setCep($v_usuario->cep);

	        $usuario->setPessoa($pessoa);

	        $perfil = new Perfil();
	        $perfil->setId($v_usuario->perfil_id);
	        $perfil->setDescricao($v_usuario->descricao);

	        $usuario->setPerfil($perfil);	        
		} 

        return $usuario;
	}
        
        public function envia_email_novousuario() {
            try {
                $GLOBALS['mail']->addAddress($this->getEmail(), $this->getPessoa()->getNome());

                $GLOBALS['mail']->Subject = 'Ative sua conta no ECOMMERCE';
                $GLOBALS['mail']->Body = '<p>Olá ' . $this->getPessoa()->getNome() . '</p>';
                $GLOBALS['mail']->Body .= '<p>Ative sua conta no Ecommerce através deste link: </p>';
                $GLOBALS['mail']->Body .= '<p>' . BASE_URL . 'comum/ativarusuario/' . $this->getHashValidacao() . '</p>';
                $GLOBALS['mail']->Body .= '<p>Agradecemos a preferência.</p>';

                $GLOBALS['mail']->send();
                return true;
            } catch (Exception $e) {
                return false;
            }            
        }
        
        
}

?>
