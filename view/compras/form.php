<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include '../../configs/config.php';

use controller\ProdutosController;
use controller\TiposProdutoController;

$produtoCtrl = new ProdutosController();
$tiposProdutoCtrl = new TiposProdutoController();

// se vai editar um registro
$produto = $produtoCtrl->buscaRegistro();

// se submeter o form ele salva
$salvo = $produtoCtrl->adicionarSalvar();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Mercado - início</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../../content/js/jqueryui/jquery-ui.min.css">
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
                    <li><a href="<?= HOST_APPLICATION ?>">Início</a></li>
                    <li class="active"><a href="<?= HOST_APPLICATION ?>/produtos.php">Nova Compra</a></li>
                    <li><a href="<?= HOST_APPLICATION ?>/produtos.php">Produtos</a></li>
                    <li><a href="<?= HOST_APPLICATION ?>/tipos-produto.php" >Tipos de produto</a></li>
                </ul>
            </div>
        </nav>
        <div class="container fill" style="position: relative;">
            <h3>Nova Compra</h3>

            <div class="ui-widget">
                <label for="produtos">Produtos: </label>
                <input id="produtos" size="50">
            </div>

        </div>

        <script src="../../content/js/jquery/jquery-1.12.4.js"></script>
        <script src="../../content/js/jqueryui/jquery-ui.min.js"></script>
        <script>
            $(function () {
                function split(val) {
                    return val.split(/,\s*/);
                }
                function extractLast(term) {
                    return split(term).pop();
                }

                $("#produtos")
                // don't navigate away from the field on tab when selecting an item
                .on("keydown", function (event) {
                    if (event.keyCode === $.ui.keyCode.TAB &&
                            $(this).autocomplete("instance").menu.active) {
                        event.preventDefault();
                    }
                })
                .autocomplete({
                    source: function (request, response) {
                        $.getJSON("autocomplete-compra-produto.php", {
                            term: extractLast(request.term)
                        }, response);
                    },
                    search: function () {
                        // custom minLength
                        var term = extractLast(this.value);
                        if (term.length < 2) {
                            return false;
                        }
                    },
                    focus: function () {
                        // prevent value inserted on focus
                        return false;
                    },
                    select: function (event, ui) {
                        var terms = split(this.value);
                        // remove the current input
                        terms.pop();
                        // add the selected item
                        terms.push(ui.item.value);
                        // add placeholder to get the comma-and-space at the end
                        terms.push("");
                        this.value = terms.join(", ");
                        return false;
                    }
                });
            });
        </script>
    </body>
</html>