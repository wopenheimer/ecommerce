<?php

include_once("dao.php");

class CidadeDao extends Dao {
    
    public function getCidades() {
        $sql = "select C.*, E.id as estado_id, E.nome as estado_nome, E.sigla as estado_sigla 
                from cidade C
                inner join estado E on E.id = C.estado_id
                order by id;";
        $param = array();
        $result = $this->executaQuery($sql, $param);
        return $this->getFetchAll($result);        
    }


}

?>