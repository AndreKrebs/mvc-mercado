<?php namespace controller;

use model\ProdutosCompraModel as PCModel;

class ProdutosCompraController {
    
    public function addItemCompra() {
        if(@$_POST) {
            if(is_array($_POST)) {
                $itemCompra = $_POST;
                
                $model = new PCModel();
                
                $ProdutoCompraId = $model->addProdutoCompra($itemCompra);
                
                
                return $ProdutoCompraId;
            }
        }
    }
}