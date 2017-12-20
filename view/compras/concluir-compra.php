<?php

include '../../configs/config.php';

use controller\ComprasController;

$compraCtrl = new ComprasController();

$retorno = $compraCtrl->concluirCompra();

echo json_encode(array("result"=>$retorno));