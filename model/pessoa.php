<?php
include_once("dao/pessoa_dao.php");
include("cidade.php");
include("estado.php");


class Pessoa
{
	private $cpf;
	private $nome;
	private $datanasc;
	private $celular;
	private $cep;
	private $cidade;
        private $foto;
        
    private $pessoa_dao;
    
    function __construct() {
        $this->pessoa_dao = new PessoaDao();
    }

	public function setCpf($cpf){
		$this->cpf = $cpf;
	}

	public function getCpf(){
		return $this->cpf;
	}

	public function setNome($nome){
		$this->nome = $nome;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setDatanasc($datanasc){
		$this->datanasc = $datanasc;
	}

	public function getDatanasc(){
		return $this->datanasc;
	}

	public function setCelular($celular){
		$this->celular = $celular;
	}

	public function getCelular(){
		return $this->celular;
	}

	public function setCep($cep){
		$this->cep = $cep;
	}

	public function getCep(){
		return $this->cep;
	}

	public function setCidade($cidade){
		$this->cidade = $cidade;
	}

	public function getCidade(){
		return $this->cidade;
	}

	public function setFoto($foto){
		$this->foto = $foto;
	}

	public function getFoto(){
		return $this->foto;
	}
        
	public function getIdade(){
		if(isset($this->datanasc)){
			try{
				$datanasc = new DateTime(date("Y-m-d", strtotime(str_replace('/', '-', $this->datanasc))));
		 		$now = new DateTime();
		 		$interval = $now->diff($datanasc);
		 		return $interval->y;
			} catch (Exception $e) {
			    echo 'Data Invalida. ',  "\n";
			}
		} else {
			echo 'Configure a data de nascimento. ',  "\n";
		}
	}

        
	public function getPessoas() {            
            
        $pessoas = $this->pessoa_dao->getPessoas();
        
        $array_pessoas = [];        
        if ($pessoas){
	        foreach ($pessoas as $v_pessoa) {
	            $pessoa = new Pessoa();
	            $pessoa->setCpf($v_pessoa["cpf"]);
	            $pessoa->setNome($v_pessoa["nome"]);
	            $pessoa->setDatanasc($v_pessoa["datanasc"]);
	            $pessoa->setCelular($v_pessoa["celular"]);
	            $pessoa->setCep($v_pessoa["cep"]);
                    $pessoa->setFoto($v_pessoa["foto"]);

	            $estado = new Estado();
	            $estado->setId($v_pessoa["estado_id"]);
	            $estado->setNome($v_pessoa["estado_nome"]);
	            $estado->setSigla($v_pessoa["estado_sigla"]);

	            $cidade = new Cidade();
	            $cidade->setId($v_pessoa["cidade_id"]);
	            $cidade->setNome($v_pessoa["cidade_nome"]);
	            $cidade->setCepInicial($v_pessoa["cidade_cep_inicial"]);
	            $cidade->setCepFinal($v_pessoa["cidade_cep_final"]);
	            $cidade->setEstado($estado);

	            $pessoa->setCidade($cidade);

	            $array_pessoas[] = $pessoa;
	        }
    	}
        
        return $array_pessoas;
	}	


	public function getPessoaByCpf($cpf) {                        
        $v_pessoa = $this->pessoa_dao->getPessoaByCpf($cpf);
        
        $pessoa = new Pessoa();
        $pessoa->setCpf($v_pessoa->cpf);
        $pessoa->setNome($v_pessoa->nome);
        $pessoa->setDatanasc($v_pessoa->datanasc);
        $pessoa->setCelular($v_pessoa->celular);
        $pessoa->setCep($v_pessoa->cep);
        $pessoa->setFoto($v_pessoa->foto);

        $estado = new Estado();
        $estado->setId($v_pessoa->estado_id);
        $estado->setNome($v_pessoa->estado_nome);
        $estado->setSigla($v_pessoa->estado_sigla);

        $cidade = new Cidade();
        $cidade->setId($v_pessoa->cidade_id);
        $cidade->setNome($v_pessoa->cidade_nome);
        $cidade->setCepInicial($v_pessoa->cidade_cep_inicial);
        $cidade->setCepFinal($v_pessoa->cidade_cep_final);
        $cidade->setEstado($estado);

        $pessoa->setCidade($cidade);

        return $pessoa;
	}		
        

	public function add() {                        
        $result = $this->pessoa_dao->add($this);        
        return $result;
	}	        


	public function edit() {                        
        $result = $this->pessoa_dao->edit($this);        
        return $result;
	}	        


	public function remove() {                        
        $result = $this->pessoa_dao->remove($this);        
        return $result;
	}	        	


}

?>
