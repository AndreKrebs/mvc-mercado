<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include '../../configs/config.php';

use controller\TiposProdutoController;

$tiposProduto = new TiposProdutoController();

$tiposProduto->excluir();