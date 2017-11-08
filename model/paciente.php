<?php
include_once("dao/paciente_dao.php");

class Paciente
{
	private $cpf;
	private $nome;
	private $datanasc;
	private $peso;
	private $altura;
        
    private $paciente_dao;
    
    function __construct() {
        $this->paciente_dao = new PacienteDao();
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

	public function setPeso($peso){
		$this->peso = $peso;
	}

	public function getPeso(){
		return $this->peso;
	}

	public function setAltura($altura){
		$this->altura = $altura;
	}

	public function getAltura(){
		return $this->altura;
	}


	public function getIdade(){
		if(isset($this->datanasc)){
			try{
				$datanasc = new DateTime($this->datanasc);
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

	public function getImc(){
		if(isset($this->peso) && isset($this->altura) &&
			is_numeric($this->peso) && is_numeric($this->altura)){

			$imc = $this->peso / (pow($this->altura, 2));
			return $imc;

		} else {
			echo 'Configure corretamente os valores: peso e altura. ',  "\n";
		}
	}


	/*
	Metodo Estatico para calcular IMC de qualquer pessoa.
	Neste caso, deve-se passar o peso e altura desta pessoa.
	*/
	static public function getImcQualquerPessoa($peso, $altura){
		if(isset($peso) && isset($altura) &&
			is_numeric($peso) && is_numeric($altura)){

			$imc = $peso / (pow($altura, 2));
			return $imc;

		} else {
			echo 'Configure corretamente os valores: peso e altura. ',  "\n";
		}
	}	


        
	public function getPacientes() {            
            
        $pacientes = $this->paciente_dao->getPacientes();
        
        $array_pacientes = [];        
        if ($pacientes){
	        foreach ($pacientes as $v_paciente) {
	            $paciente = new Paciente();
	            $paciente->setCpf($v_paciente["cpf"]);
	            $paciente->setNome($v_paciente["nome"]);
	            $paciente->setDatanasc($v_paciente["datanasc"]);
	            $paciente->setPeso($v_paciente["peso"]);
	            $paciente->setAltura($v_paciente["altura"]);
	            $array_pacientes[] = $paciente;
	        }
    	}
        
        return $array_pacientes;
	}	


	public function getPacienteByCpf($cpf) {                        
        $v_paciente = $this->paciente_dao->getPacienteByCpf($cpf);
        
        $paciente = new Paciente();
        $paciente->setCpf($v_paciente->cpf);
        $paciente->setNome($v_paciente->nome);
        $paciente->setDatanasc($v_paciente->datanasc);
        $paciente->setPeso($v_paciente->peso);
        $paciente->setAltura($v_paciente->altura);

        return $paciente;
	}		
        

	public function add() {                        
        $result = $this->paciente_dao->add($this);        
        return $result;
	}	        


	public function edit() {                        
        $result = $this->paciente_dao->edit($this);        
        return $result;
	}	        


	public function remove() {                        
        $result = $this->paciente_dao->remove($this);        
        return $result;
	}	        	


}

?>
