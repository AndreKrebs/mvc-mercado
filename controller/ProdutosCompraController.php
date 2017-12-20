<?php namespace controller;

use model\ProdutosCompraModel as PCModel;

class ProdutosCompraController {
    
    public function addItemCompra($compraId) {
        if(@$_POST) {
            if(is_array($_POST)) {
                $itemCompra = $_POST;
                
                $model = new PCModel();
                
                $produtoCompraId = $model->addProdutoCompra($itemCompra, $compraId);                
                
                return array("compraId"=>$compraId, "produtoCompraId"=>$produtoCompraId);
            }
        }
    }
}