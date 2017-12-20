<?php

include '../../configs/config.php';

use controller\ComprasController;

$compraCtrl = new ComprasController();

$compraId = $compraCtrl->addItemCompra();

echo $compraId;