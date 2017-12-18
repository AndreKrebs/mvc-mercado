<?php namespace Controller;

include 'model/tipos-produto.model.php';
use Model\TiposProdutoModel as TPModel;

class TiposProdutoController {
    
    public $currentPage = 0;
    
    public function __construct() {
        if(array_key_exists('pg', $_GET)){
            $this->currentPage = $_GET['pg'];
        }
    }
    
    public function lista($itensPorPagina=0) {
        $tiposProduto = [];
        
        $model = new TPModel();
        
        $tiposProduto = $model->lista($itensPorPagina, $this->currentPage);
        
        return $tiposProduto;
    }
    
    
    public function totalRegistros() {
        $total = 0;
        
        $model = new TPModel();
        
        $total = $model->totalRegistros();
        
        return $total;
    }
    
}