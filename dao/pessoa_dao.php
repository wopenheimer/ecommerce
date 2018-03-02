<?php

include_once("dao.php");

class PessoaDao extends Dao {
    
    public function getPessoas() {
        $sql = "select *,  
                to_char(datanasc, 'dd/mm/yyyy') as datanasc 
                from pessoa order by cpf;";
        $param = array();
        $result = $this->executaQuery($sql, $param);
        return $this->getFetchAll($result);        
    }
    

    public function getPessoaByCpf($cpf) {
        $sql = "select *, 
                to_char(datanasc, 'dd/mm/yyyy') as datanasc
                from pessoa where cpf = $1;";
        $param = array();
        array_push($param, $cpf);
        $result = $this->executaQuery($sql, $param);
        return $this->getFetchObject($result);        
    }


    public function add($pessoa) {
        $sql = 'insert into pessoa (cpf, nome, datanasc, celular, cep) ';
        $sql .= 'values ($1, $2, $3, $4, $5);';
        $param = array();
        array_push($param, $pessoa->getCpf(), $pessoa->getNome(),
        			$pessoa->getDatanasc(), $pessoa->getCelular(), $pessoa->getCep());

        $result = $this->executaQuery($sql, $param);
        return $result;        
    }    


    public function edit($pessoa) {
        $sql = 'update pessoa set cpf = $1, nome = $2, datanasc = $3, celular = $4, cep = $5 ';
        $sql .= 'where cpf = $6;';
        $param = array();

        array_push($param, $pessoa->getCpf(), $pessoa->getNome(),
                    $pessoa->getDatanasc(), $pessoa->getCelular(), $pessoa->getCep(), 
                    validInputData($_POST["old_cpf"]));

        $result = $this->executaQuery($sql, $param);
        return $result;        
    }        


    public function remove($pessoa) {
        $sql = 'delete from pessoa where cpf = $1;';
        $param = array();
        array_push($param, $pessoa->getCpf());

        $result = $this->executaQuery($sql, $param);
        return $result;        
    }        

}

?>