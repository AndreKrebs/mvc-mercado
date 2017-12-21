<?php
include '../../configs/config.php';

use controller\TiposProdutoController;

$tiposProduto = new TiposProdutoController();

$tiposProduto->excluir();