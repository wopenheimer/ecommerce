<?php
include_once("dao/anuncio_dao.php");
include_once("pessoa.php");

class Anuncio
{
	private $id;
	private $titulo;
	private $descricao;
	private $preco;
	private $datacriacao;
	private $ultimaalteracao;
	private $anunciante;
        
    private $anuncio_dao;
    
    function __construct() {
        $this->anuncio_dao = new AnuncioDao();
    }

	public function setId($id){
		$this->id = $id;
	}

	public function getId(){
		return $this->id;
	}

	public function setTitulo($titulo){
		$this->titulo = $titulo;
	}

	public function getTitulo(){
		return $this->titulo;
	}

	public function setDescricao($descricao){
		$this->descricao = $descricao;
	}

	public function getDescricao(){
		return $this->descricao;
	}

	public function setPreco($preco){
		$this->preco = $preco;
	}

	public function getPreco(){
		return $this->preco;
	}

	public function setDataCriacao($datacriacao){
		$this->datacriacao = $datacriacao;
	}

	public function getDataCriacao(){
		return $this->datacriacao;
	}

	public function setUltimaAlteracao($ultimaalteracao){
		$this->ultimaalteracao = $ultimaalteracao;
	}

	public function getUltimaAlteracao(){
		return $this->ultimaalteracao;
	}


	public function setAnunciante($anunciante){
		$this->anunciante = $anunciante;
	}

	public function getAnunciante(){
		return $this->anunciante;
	}


        
	public function getAnuncios() {            
            
        $anuncios = $this->anuncio_dao->getAnuncios();

        $array_anuncios = [];        
        if ($anuncios){
	        foreach ($anuncios as $v_anuncio) {
	            $anuncio = new Anuncio();
	            $anuncio->setId($v_anuncio["id"]);
	            $anuncio->setTitulo($v_anuncio["titulo"]);
	            $anuncio->setDescricao($v_anuncio["descricao"]);
	            $anuncio->setPreco($v_anuncio["preco"]);
	            $anuncio->setDataCriacao($v_anuncio["datacriacao"]);
	            $anuncio->setUltimaAlteracao($v_anuncio["ultimaalteracao"]);

	            $anunciante = new Pessoa();
	            $anunciante->setCpf($v_anuncio["cpf"]);
	            $anunciante->setNome($v_anuncio["nome"]);
	            $anunciante->setDatanasc($v_anuncio["datanasc"]);
	            $anunciante->setCelular($v_anuncio["celular"]);
	            $anunciante->setCep($v_anuncio["cep"]);

	            $anuncio->setAnunciante($anunciante);
	            $array_anuncios[] = $anuncio;
	        }
    	}
        
        return $array_anuncios;
	}	

	public function getAnuncioById($id) {                        
        $v_anuncio = $this->anuncio_dao->getAnuncioById($id);

        $anuncio = new Anuncio();
        $anuncio->setId($v_anuncio->id);
        $anuncio->setTitulo($v_anuncio->titulo);
        $anuncio->setDescricao($v_anuncio->descricao);
        $anuncio->setPreco($v_anuncio->preco);
        $anuncio->setDataCriacao($v_anuncio->datacriacao);
        $anuncio->setUltimaAlteracao($v_anuncio->ultimaalteracao);

        $anunciante = new Pessoa();
        $anunciante->setCpf($v_anuncio->cpf);
        $anunciante->setNome($v_anuncio->nome);
        $anunciante->setDatanasc($v_anuncio->datanasc);
        $anunciante->setCelular($v_anuncio->celular);
        $anunciante->setCep($v_anuncio->cep);

        $anuncio->setAnunciante($anunciante);

        return $anuncio;
	}		
        

	public function add() {                        
        $result = $this->anuncio_dao->add($this);        
        return $result;
	}	        


	public function edit() {                        
        $result = $this->anuncio_dao->edit($this);        
        return $result;
	}	        


	public function remove() {                        
        $result = $this->anuncio_dao->remove($this);        
        return $result;
	}	        	


}

?>
