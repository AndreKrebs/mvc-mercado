<?php

include '../../configs/config.php';

use controller\ComprasController;
use controller\ProdutosCompraController;

$compraCtrl = new ComprasController();
$produtoCompraCtrl = new ProdutosCompraController();

$compraId = $compraCtrl->addCompra();
if($compraId>0) {
    $compraProdutoArray = $produtoCompraCtrl->addItemCompra($compraId);
    
    print_r($compraProdutoArray);
} else {
    echo -1;
}

