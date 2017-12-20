<?php namespace model;

use configs\Database as DB;
use dao\ComprasDAO as CDAO;

class ComprasModel {
    
    private $conexao;
    
    public function __construct() {
        // instancia base de dados
        $this->conexao = new DB(); 
    }
    
    public function addProdutoCompra($itemCompra) {
     
        
        
    }
    
    
}



