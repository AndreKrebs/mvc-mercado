<?php
include '../../configs/config.php';

use controller\ProdutosController;

$produtos = new ProdutosController();

$produtos->excluir();