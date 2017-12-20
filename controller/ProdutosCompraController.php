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
    
    public function removeItemCompra() {
        if(@$_GET) {
            if(is_array($_GET) && array_key_exists('id', $_GET)) {
                $id = $_GET['id'];
                
                $model = new PCModel();

                return $model->removeItemCompra($id);
            }
        }
    }
}