<?php 
namespace configs;

class Database {
    public $dbcon;
    
    public function __construct() {
        // abre conexão com o banco
        $this->dbcon = pg_connect("host=localhost port=5432 dbname=mercado user=softexpert password=12345") or die('connection failed');
    }

    public function __destruct() {
        // fecha conexão com o banco
        pg_close($this->dbcon);
    }
}