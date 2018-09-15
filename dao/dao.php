<?php

class Dao {

    private $dbhost;
    private $dbusuario;
    private $dbsenha;
    private $dbport;
    private $dbname;
    private $condb;
    private $query;
    private $result;
    private $dbtipo;
    private $transaction;

    function __construct() {
            $this->dbhost = DB_HOST;
            $this->dbusuario = DB_USER;
            $this->dbsenha = DB_PASSWORD;
            $this->dbport = DB_PORT;
            $this->dbname = DB_NAME;
            $this->transaction = false;
    }

    public function getCondb() {
        return $this->condb;
    }

    public function getTransaction() {
        return $this->transaction;
    }


    private function conecta_postgres() {

        $this->condb = pg_connect("host=$this->dbhost port=$this->dbport dbname=$this->dbname user=$this->dbusuario password=$this->dbsenha");
        if (pg_connection_status($this->condb) !== 0) {
            echo "Não foi possível conectar ao banco de dados.<br>";
            die();
        }
    }


    private function desconecta_postgres() {
        pg_connection_status($this->condb) === 0 ? (!pg_connection_busy($this->condb) ? pg_close($this->condb) : false) : false;
    }

    public function executaQuery($query, $params) {
            if (!isset($GLOBALS['dao'])) {
                $this->conecta_postgres();    
            }
            
            $this->query = $query;

            $condb = Null;
            if(isset($GLOBALS['dao'])) {
                if ($GLOBALS['dao']->getCondb() != Null) {
                    $condb = $GLOBALS['dao']->getCondb();
                } else {
                    $condb = $this->condb;
                }
            } else {
                $condb = $this->condb;
            }

            $query = md5(uniqid(rand(), true));

            $result = pg_prepare($condb, $query, $this->query);

            if ($this->result = pg_execute($condb, $query, $params)) {
                if (!isset($GLOBALS['dao'])) {
                    $this->desconecta_postgres();    
                } elseif ($GLOBALS['dao']->getTransaction() == False) { 
                    $this->desconecta_postgres();
                }
                return $this->result;
            } else {
//                echo "Ocorreu um erro na execução da SQL.<br>";
//                echo "<br>" . pg_last_error();
//                echo "<br>SQL: " . $query;
                if (!isset($GLOBALS['dao'])) {
                    $this->desconecta_postgres();    
                } else {
                    $GLOBALS['dao']->desconecta_postgres();
                }
                return false;
            }
    }

    public function beginTransaction() {
        $this->conecta_postgres();    
        pg_query($this->condb,"begin;");
        $this->transaction = True;
    }

    public function commitTransaction() {
        pg_query($this->condb,"commit;");
        $this->desconecta_postgres();        
        $this->transaction = False;
    }    
    
    function getNumRows($query) {
            return pg_num_rows($query);
    }    
    
    function getFetchObject($query) {
            return pg_fetch_object($query);
    }  
    
    function getFetchArray($query) {
            return pg_fetch_array($query);
    }
    
    function getFetchAll($query) {
            return pg_fetch_all($query);
    }
    

}


?>
