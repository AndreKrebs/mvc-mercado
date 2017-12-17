<?php namespace Model;

include 'configs/data.config.php';
use Config\Database\Data as DB;

class TiposProdutoModel {
    
    private $database;
    
    public function __construct() {
        // instancia base de dados
        $this->database = new DB(); 
    }
    
    public function lista() {
        
        
        
    }
}



