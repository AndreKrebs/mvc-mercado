<?php namespace Controller;

include 'model/tipos-produto.model.php';
use Model\TiposProdutoModel as TPModel;

class TiposProdutoController {
    
    public function lista() {
        $tiposProduto = [];
        
        $model = new TPModel();
        
        $tiposProduto = $model->lista();
        
        return $tiposProduto;
    }
    
}