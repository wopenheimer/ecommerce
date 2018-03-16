<?php

include_once("dao.php");

class CidadeDao extends Dao {


    public function getDistinctEstados() {
        $sql = "select distinct E.*
                from estado E
                inner join cidade C on C.estado_id = E.id
                order by E.nome;";
        $param = array();
        $result = $this->executaQuery($sql, $param);
        return $this->getFetchAll($result);        
    }


    public function getCidades() {
        $sql = "select C.*, E.id as estado_id, E.nome as estado_nome, E.sigla as estado_sigla 
                from cidade C
                inner join estado E on E.id = C.estado_id
                order by E.sigla, C.nome limit 10;";
        $param = array();
        $result = $this->executaQuery($sql, $param);
        return $this->getFetchAll($result);        
    }


    public function getCidadesByEstado($estado_id) {


        $sql = "select *
                from cidade C
                where estado_id = $1
                order by C.nome;";
        $param = array();
        array_push($param, $estado_id);
        $result = $this->executaQuery($sql, $param);
        return $this->getFetchAll($result);
    }

    


}

?>