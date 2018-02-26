<?php

include_once("dao.php");

class AnuncioDao extends Dao {
    
    public function getAnuncios() {
        $sql = "select * from anuncio A
                left join pessoa P on P.cpf = A.anunciante_cpf
                left join 
                    (
                    select distinct on(anuncio_id) * from anuncio_file
                    ) AF on AF.anuncio_id = A.id
                order by A.ultimaalteracao desc;";
        $param = array();
        $result = $this->executaQuery($sql, $param);
        return $this->getFetchAll($result);        
    }
    

    public function getAnuncioById($id) {
        $sql = "select *, A.preco::numeric from anuncio A
                left join pessoa P on P.cpf = A.anunciante_cpf
                where A.id = $1;";
        $param = array();
        array_push($param, $id);
        $result = $this->executaQuery($sql, $param);
        return $this->getFetchObject($result);        
    }


    public function getFilesByAnuncioId($id) {
        $sql = "select * from anuncio_file AF
                where AF.anuncio_id = $1;";
        $param = array();
        array_push($param, $id);
        $result = $this->executaQuery($sql, $param);
        return $this->getFetchAll($result);        
    }    


    public function add($anuncio) {
        $sql = 'insert into anuncio (titulo, descricao, preco, datacriacao, ultimaalteracao, anunciante_cpf) ';
        $sql .= 'values ($1, $2, $3::numeric, now(), now(), $4);';
        $param = array();
        array_push($param, $anuncio->getTitulo(), $anuncio->getDescricao(), $anuncio->getPreco(), $anuncio->getAnunciante());

        $result = $this->executaQuery($sql, $param);
        return $result;        
    }    


    public function edit($anuncio) {
        $sql = 'update anuncio set titulo = $1, descricao = $2, preco = $3::numeric, ultimaalteracao = now(), anunciante_cpf = $4 ';
        $sql .= 'where id = $5;';
        $param = array();
        array_push($param, $anuncio->getTitulo(), $anuncio->getDescricao(), $anuncio->getPreco(), $anuncio->getAnunciante(), $anuncio->getId());

        $result = $this->executaQuery($sql, $param);
        return $result;        
    }        


    public function remove($anuncio) {  
        $sql = 'delete from anuncio where id = $1 cascade;';
        $param = array();
        array_push($param, $anuncio->getId());

        $result = $this->executaQuery($sql, $param);
        return $result;        
    }        

}

?>