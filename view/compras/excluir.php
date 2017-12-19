<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include '../../configs/config.php';

use controller\ProdutosController;

$produtos = new ProdutosController();

$produtos->excluir();