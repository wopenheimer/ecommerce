<?php
include_once("dao/perfil_dao.php");

class Perfil
{
	private $id;
	private $descricao;
        
    private $perfil_dao;
    
    function __construct() {
        $this->perfil_dao = new PerfilDao();
    }

	public function setId($id){
		$this->id = $id;
	}

	public function getId(){
		return $this->id;
	}

	public function setDescricao($descricao){
		$this->descricao = $descricao;
	}

	public function getDescricao(){
		return $this->descricao;
	}

        
	public function getPerfis() {            
            
        $perfis = $this->perfil_dao->getPerfis();
        
        $array_perfis = [];        
        if ($perfis){
	        foreach ($perfis as $v_perfil) {
	            $perfil = new Perfil();
	            $perfil->setId($v_perfil["id"]);
	            $perfil->setDescricao($v_perfil["descricao"]);
	            $array_perfis[] = $perfil;
	        }
    	}
        
        return $array_perfis;
	}	


	public function getPerfilByCpf($id) {                        
        $v_perfil = $this->perfil_dao->getPerfilById($id);
        
        $perfil = new Perfil();
        $perfil->setId($v_perfil->id);
        $perfil->setDescricao($v_perfil->descricao);

        return $perfil;
	}		
        

	public function add() {                        
        $result = $this->perfil_dao->add($this);        
        return $result;
	}	        


	public function edit() {                        
        $result = $this->perfil_dao->edit($this);        
        return $result;
	}	        


	public function remove() {                        
        $result = $this->perfil_dao->remove($this);        
        return $result;
	}	        	


}

?>
