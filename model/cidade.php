<?php
include_once("dao/cidade_dao.php");

class Cidade
{
	private $id;
	private $nome;
	private $estado;
	private $cep_inicial;
	private $cep_final;
        
    private $cidade_dao;
    
    function __construct() {
        $this->cidade_dao = new CidadeDao();
    }

	public function setId($id){
		$this->id = $id;
	}

	public function getId(){
		return $this->id;
	}

	public function setNome($nome){
		$this->nome = $nome;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setEstado($estado){
		$this->estado = $estado;
	}

	public function getEstado(){
		return $this->estado;
	}

	public function setCepInicial($cep_inicial){
		$this->cep_inicial = $cep_inicial;
	}

	public function getCepInicial(){
		return $this->cep_inicial;
	}

	public function setCepFinal($cep_final){
		$this->cep_final = $cep_final;
	}

	public function getCepFinal(){
		return $this->cep_final;
	}

        
	public function getCidades() {            
            
        $cidades = $this->cidade_dao->getCidades();
        
        $array_cidades = [];        
        if ($cidades) {
	        foreach ($cidades as $v_cidade) {
	            $cidade = new Cidade();
	            $cidade->setId($v_cidade["id"]);
	            $cidade->setNome($v_cidade["nome"]);
	            $cidade->setCepInicial($v_cidade["cep_inicial"]);
	            $cidade->setCepFinal($v_cidade["cep_final"]);

	            $estado = new Estado();
	            $estado->setId($v_cidade["estado_id"]);
	            $estado->setNome($v_cidade["estado_nome"]);
	            $estado->setSigla($v_cidade["estado_sigla"]);

				$cidade->setEstado($estado);

	            $array_cidades[] = $cidade;
	        }
    	}
        
        return $array_cidades;
	}	


}

?>
