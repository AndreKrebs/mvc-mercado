<?php

include '../../configs/config.php';

use controller\ProdutosCompraController;

$produtoCompraCtrl = new ProdutosCompraController();

$retorno = $produtoCompraCtrl->removeItemCompra();

echo json_encode(array("result"=>$retorno));