<?php

include_once("dao.php");

class UsuarioDao extends Dao {
    
    public function getUsuarios() {
        $sql = "select *, U.id as usuario_id, PE.id as perfil_id
                from usuario U
                left join pessoa P on P.cpf = U.pessoa_cpf
                left join perfil PE on PE.id = U.perfil_id
                order by U.id;";
        $param = array();
        $result = $this->executaQuery($sql, $param);
        return $this->getFetchAll($result);        
    }
    

    public function getUsuarioById($id) {
        $sql = "select *, U.id as usuario_id, PE.id as perfil_id
                from usuario U
                left join pessoa P on P.cpf = U.pessoa_cpf
                left join perfil PE on PE.id = U.perfil_id
                where U.id = $1;";
        $param = array();
        array_push($param, $id);
        $result = $this->executaQuery($sql, $param);
        return $this->getFetchObject($result);        
    }

    
    public function getUsuarioByHash($hash) {
        $sql = "select *
                from usuario U
                where U.hash_validacao = $1 and U.ativo = False;";
        $param = array();
        array_push($param, $hash);
        $result = $this->executaQuery($sql, $param);
        return $this->getFetchObject($result);        
    }   
    

    public function ativarUsuario($usuario) {
        $sql = 'update usuario set ativo = True ';
        $sql .= 'where id = $1;';
        $param = array();
        array_push($param, $usuario->getId());

        $result = $this->executaQuery($sql, $param);
        return $result;        
    }    

    public function getLogin($usuario) {
        $sql = "select *, U.id as usuario_id, PE.id as perfil_id
                from usuario U
                left join pessoa P on P.cpf = U.pessoa_cpf
                left join perfil PE on PE.id = U.perfil_id
                where 
                U.email = $1 and
                senha = $2 and
                U.ativo = true;";
        $param = array();
        array_push($param, $usuario->getEmail(), $usuario->getSenha());
        $result = $this->executaQuery($sql, $param);
        return $this->getFetchObject($result);        
    }


    public function add($usuario) {
        $sql = 'insert into usuario (email, senha, pessoa_cpf, perfil_id, ativo, hash_validacao) ';
        $sql .= 'values ($1, $2, $3, $4, $5, $6);';
        $param = array();
        array_push($param, $usuario->getEmail(), $usuario->getSenha(), $usuario->getPessoa(), $usuario->getPerfil(), $usuario->getAtivo(), $usuario->getHashValidacao());

        $result = $this->executaQuery($sql, $param);
        return $result;        
    }    


    public function edit($usuario) {
        $sql = 'update usuario set email = $1, senha = $2, pessoa_cpf = $3, perfil_id = $4, ativo = $5 ';
        $sql .= 'where id = $6;';
        $param = array();
        array_push($param, $usuario->getEmail(), $usuario->getSenha(), $usuario->getPessoa(), $usuario->getPerfil(), $usuario->getAtivo(), $usuario->getId());

        $result = $this->executaQuery($sql, $param);
        return $result;        
    }        


    public function remove($usuario) {
        $sql = 'delete from usuario where id = $1;';
        $param = array();
        array_push($param, $usuario->getId());

        $result = $this->executaQuery($sql, $param);
        return $result;        
    }        

}

?>