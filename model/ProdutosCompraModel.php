<?php namespace model;

use configs\Database as DB;
use dao\ProdutosCompraDAO as PCDAO;

class ProdutosCompraModel {
    
    private $conexao;
    
    public function __construct() {
        // instancia base de dados
        $this->conexao = new DB(); 
    }
    
    public function addProdutoCompra($itemCompra, $compraid) {
     
        $dao = new PCDAO();
        
        return $dao->addProdutoCompra($itemCompra, $compraid);
        
    }
    
    
}



