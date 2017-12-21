<?php
include 'configs/config.php';
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
                    <li class="active"><a href="<?=HOST_APPLICATION?>">Início</a></li>
                    <li><a href="<?=HOST_APPLICATION?>/compras.php">Nova Compra</a></li>
                    <li><a href="<?=HOST_APPLICATION?>/produtos.php">Produtos</a></li>
                    <li><a href="<?=HOST_APPLICATION?>/tipos-produto.php" >Tipos de produto</a></li>
                </ul>
            </div>
        </nav>
        <div class="container">
            <h3>Bem vindo </h3>
        </div>

    </body>
</html>