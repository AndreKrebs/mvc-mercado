<?php
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);

include 'controller/index.controller.php';

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
                    <li class="active"><a href="#">Início</a></li>
                    <li><a href="compras.php">Nova Compra</a></li>
                    <li><a href="produtos.php">Produtos</a></li>
                </ul>
            </div>
        </nav>
        <div class="container">
            <h3>Bem vindo </h3>
            <!--<p>A navigation bar is a navigation header that is placed at the top of the page.</p>-->
        </div>

    </body>
</html>