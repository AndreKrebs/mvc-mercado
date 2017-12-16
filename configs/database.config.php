<?php namespace Config\Database;

class database {
    private $dbcon;
    
    function __construct() {
        // abre conexão com o banco
        $this->dbcon = pg_connect("host=ovelha port=5432 dbname=mercado user=softexpert password=12345");
    }

    function __destruct() {
        // fecha conexão com o banco
        pg_close($this->dbcon);
    }
}