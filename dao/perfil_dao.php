<?php

include_once("dao.php");

class PerfilDao extends Dao {
    
    public function getPerfis() {
        $sql = "select * from perfil order by id;";
        $param = array();
        $result = $this->executaQuery($sql, $param);
        return $this->getFetchAll($result);        
    }
    

    public function getPerfilById($id) {
        $sql = "select * from perfil where id = $1;";
        $param = array();
        array_push($param, $id);
        $result = $this->executaQuery($sql, $param);
        return $this->getFetchObject($result);        
    }


    public function add($perfil) {
        $sql = 'insert into perfil (descricao) ';
        $sql .= 'values ($1);';
        $param = array();
        array_push($param, $perfil->getDescricao());

        $result = $this->executaQuery($sql, $param);
        return $result;        
    }    


    public function edit($perfil) {
        $sql = 'update perfil set descricao = $1 ';
        $sql .= 'where id = $2;';
        $param = array();

        array_push($param, $perfil->getDescricao(), $perfil->getId());

        $result = $this->executaQuery($sql, $param);
        return $result;        
    }        


    public function remove($perfil) {
        $sql = 'delete from perfil where id = $1;';
        $param = array();
        array_push($param, $perfil->getId());

        $result = $this->executaQuery($sql, $param);
        return $result;        
    }        

}

?>