<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include '../../configs/config.php';

use controller\ProdutosCompraController;
use controller\ComprasController;

$produtosCompraCtrl = new ProdutosCompraController();
$comprasCtrl = New ComprasController(); 

if($produtosCompraCtrl->excluirPorCompra() == true) {
    $comprasCtrl->excluir();
}