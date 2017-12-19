<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include '../../configs/config.php';

use controller\TiposProdutoController;

$tiposProdutoCtrl = new TiposProdutoController();

// se vai editar um registro
$tipoProduto = $tiposProdutoCtrl->buscaRegistro();

// se submeter o form ele salva
$salvo = $tiposProdutoCtrl->adicionarSalvar();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Mercado - início</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../../content/css/reset.css"> 
        <link rel="stylesheet" type="text/css" href="../../content/css/style.css"> 
        <link rel="stylesheet" type="text/css" href="../../content/css/bootstrap/bootstrap.min.css"> 

    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">SoftExpert</a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="<?=HOST_APPLICATION?>">Início</a></li>
                    <li><a href="compras.php">Nova Compra</a></li>
                    <li><a href="produtos.php">Produtos</a></li>
                    <li class="active"><a href="<?=HOST_APPLICATION?>/tipos-produto.php" >Tipos de produto</a></li>
                </ul>
            </div>
        </nav>
        <div class="container fill" style="position: relative;">
            <h3>Formulário Tipo de Produto </h3>
            
            <form method="post">
                <input type="hidden" class="form-control" name="id" id="id" value="<?=(is_array($tipoProduto)?$tipoProduto['id']:'')?>">
                <div class="form-group">
                    <label for="tipo">Tipo:</label>
                    <input type="text" class="form-control" name="tipo" id="tipo" value="<?=(is_array($tipoProduto)?$tipoProduto['tipo']:'')?>">
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição:</label>
                    <input type="text" class="form-control" name="descricao" id="descricao" value="<?=(is_array($tipoProduto)?$tipoProduto['descricao']:'')?>">
                </div>
                <div class="form-group">
                    <label for="imposto">Imposto:</label>
                    <input type="number" class="form-control" name="imposto" id="imposto" value="<?=(is_array($tipoProduto)?$tipoProduto['imposto']:'')?>">
                </div>
                <button type="submit" class="btn btn-default">Salvar</button>
            </form>

        </div>

    </body>
</html>