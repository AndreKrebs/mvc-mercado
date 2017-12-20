<?php

include '../../configs/config.php';

use controller\ProdutosController;

$produtoCtrl = new ProdutosController();

echo ($produtoCtrl->buscaAutocomplete());