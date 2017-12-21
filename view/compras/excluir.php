<?php
include '../../configs/config.php';

use controller\ProdutosCompraController;
use controller\ComprasController;

$produtosCompraCtrl = new ProdutosCompraController();
$comprasCtrl = New ComprasController(); 

if($produtosCompraCtrl->excluirPorCompra() == true) {
    $comprasCtrl->excluir();
}