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
	private $mainfile;
	private $files = [];
        
    private $anuncio_dao;
    
    function __construct() {
        $this->anuncio_dao = new AnuncioDao();
    }

    static function getPublicControllers() {
    	$publicControllers = [];
    	$publicControllers[] = "feed";
    	$publicControllers[] = "view";
        $publicControllers[] = "home";
        $publicControllers[] = "add";
        $publicControllers[] = "edit";
        $publicControllers[] = "remove";
    	return $publicControllers;
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

	public function setFiles($files){
		$this->files = $files;
	}

	public function getFiles(){
        $files = $this->anuncio_dao->getFilesByAnuncioId($this->getId());

        if ($files){
	        foreach ($files as $v_file) {
	        	$this->file[] = $file;
	        }
    	}
        
        return $this->files;	
    }

	public function setMainFile($mainfile){
		$this->mainfile = $mainfile;
	}

	public function getMainfile(){
		return $this->mainfile;
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
	            $anuncio->setMainFile($v_anuncio["file"]);

	            $pessoa = new Pessoa();
	            $pessoa_obj = $pessoa->getPessoaByCpf($v_anuncio["anunciante_cpf"]);

	            $anuncio->setAnunciante($pessoa_obj);
	            $array_anuncios[] = $anuncio;
	        }
    	}
        
        return $array_anuncios;
	}	
        
        
	public function getAnunciosByAnunciante($anunciante_cpf) {            
            
        $anuncios = $this->anuncio_dao->getAnunciosByAnunciante($anunciante_cpf);

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
	            $anuncio->setMainFile($v_anuncio["file"]);

	            $pessoa = new Pessoa();
	            $pessoa_obj = $pessoa->getPessoaByCpf($v_anuncio["anunciante_cpf"]);

	            $anuncio->setAnunciante($pessoa_obj);
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

        $pessoa = new Pessoa();
        $pessoa_obj = $pessoa->getPessoaByCpf($v_anuncio->anunciante_cpf);

        $anuncio->setAnunciante($pessoa_obj);

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
