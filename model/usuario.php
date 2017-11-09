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

        
	public function getUsuarios() {            
            
        $usuarios = $this->usuario_dao->getUsuarios();
        
        $array_usuarios = [];        
        if ($usuarios){
	        foreach ($usuarios as $v_usuario) {
	            $usuario = new Usuario();
	            $usuario->setId($v_usuario["usuario_id"]);
	            $usuario->setEmail($v_usuario["email"]);
	            $usuario->setSenha($v_usuario["senha"]);

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


}

?>
