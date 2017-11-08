<?php

include_once("dao.php");

class PacienteDao extends Dao {
    
    public function getPacientes() {
        $sql = "select * from paciente order by cpf;";
        $param = array();
        $result = $this->executaQuery($sql, $param);
        return $this->getFetchAll($result);        
    }
    

    public function getPacienteByCpf($cpf) {
        $sql = "select * from paciente where cpf = $1;";
        $param = array();
        array_push($param, $cpf);
        $result = $this->executaQuery($sql, $param);
        return $this->getFetchObject($result);        
    }


    public function add($paciente) {
        $sql = 'insert into paciente (cpf, nome, datanasc, peso, altura) ';
        $sql .= 'values ($1, $2, $3, $4, $5);';
        $param = array();
        array_push($param, $paciente->getCpf(), $paciente->getNome(),
        			$paciente->getDatanasc(), $paciente->getPeso(), $paciente->getAltura());

        $result = $this->executaQuery($sql, $param);
        return $result;        
    }    


    public function edit($paciente) {
        $sql = 'update paciente set cpf = $1, nome = $2, datanasc = $3, peso = $4, altura = $5 ';
        $sql .= 'where cpf = $6;';
        $param = array();

        array_push($param, $paciente->getCpf(), $paciente->getNome(),
                    $paciente->getDatanasc(), $paciente->getPeso(), $paciente->getAltura(), 
                    validInputData($_POST["old_cpf"]));

        $result = $this->executaQuery($sql, $param);
        return $result;        
    }        


    public function remove($paciente) {
        $sql = 'delete from paciente where cpf = $1;';
        $param = array();
        array_push($param, $paciente->getCpf());

        $result = $this->executaQuery($sql, $param);
        return $result;        
    }        

}

?>