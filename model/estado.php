<?php

class Estado
{
	private $id;
	private $nome;
	private $sigla;
        
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

	public function setSigla($sigla){
		$this->sigla = $sigla;
	}

	public function getSigla(){
		return $this->sigla;
	}

}

?>
