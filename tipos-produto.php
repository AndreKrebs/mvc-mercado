<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include 'controller/tipos-produto.controller.php';
use Controller\TiposProdutoController;

$tiposProduto = new TiposProdutoController();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Mercado - início</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="./content/css/bootstrap/bootstrap.min.css"> 

    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">SoftExpert</a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Início</a></li>
                    <li><a href="compras.php">Nova Compra</a></li>
                    <li><a href="produtos.php">Produtos</a></li>
                    <li class="active"><a href="tipos-produto.php" >Tipos de produto</a></li>
                </ul>
            </div>
        </nav>
        <div class="container">
            <h3>Tipos de produto </h3>
            
            <table class="table">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Descrição</th>
                        <th>Tipo</th>
                        <th>Imposto(%)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $tiposProduto->
                    ?>
                </tbody>
            </table>
            
        </div>

    </body>
</html>