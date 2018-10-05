<?php

include_once("dao.php");

class TokenDao extends Dao {
    
    public function getTokenByToken($token) {
        $sql = "select *, U.id as usuario_id
                from token T
                inner join usuario U on U.id = T.usuario_id
                where T.token = $1 and
                T.validade >= now();";
        $param = array();
        array_push($param, $token);
        $result = $this->executaQuery($sql, $param);
        return $this->getFetchObject($result);        
    }

    
    public function add($token) {
        $sql = 'insert into token ';
        $sql .= "values (default, $1, now(), now() + '5 days', $2);";
        $param = array();
        array_push($param, $token->getUsuario()->getId(), $token->getToken());

        $result = $this->executaQuery($sql, $param);
        return $result;        
    }    


}

?>