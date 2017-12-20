<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include '../../configs/config.php';

use controller\ComprasController;
use controller\ProdutosController;
use controller\TiposProdutoController;

$comprasCtrl = new ComprasController();
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
            
            <input type="hidden" id="id" name="id">
            
            <h3>Nova Compra</h3>
            
            <form class="form-inline" onsubmit="adicionaProdutoLista(); return false;">
                
                <div class="form-group ui-widget">
                    <label for="produtos">Produtos: </label>
                    <input id="produtos" class="form-control" size="20">
                </div>
                <div class="form-group">
                    <label for="quantidade">Quantidade:</label>
                    <input type="quantidade" class="form-control" id="quantidade" value="1" size="5">
                </div>
                <button type="submit" class="btn btn-default">Adicionar</button>
            </form>
            
            <h2>Itens da compra</h2>
            
            <table class="table" >
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Produto</th>
                        <th>Valor unidade</th>
                        <th>Quantidade</th>
                        <th>Total</th>
                        <th>Imposto</th>
                    </tr>
                </thead>
                <tbody id="itens-compra">
                    <tr id="cod-compra-prod">
                        
                    </tr>
                </tbody>
            </table>

        </div>

        <script src="../../content/js/jquery/jquery-1.12.4.js"></script>
        <script src="../../content/js/jqueryui/jquery-ui.min.js"></script>
        <script>
            var itemSelecionado = {};
            
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
//                        if (term.length < 2) {
//                            return false;
//                        }
                    },
                    focus: function () {
                        // prevent value inserted on focus
                        return false;
                    },
                    select: function (event, ui) {
                        itemSelecionado = {};
                        
                        this.value = ui.item.label;
                                                
                        itemSelecionado = {id:ui.item.id, label: ui.item.label, value:ui.item.value, percent: ui.item.percent};
                                         
                        $("#quantidade").focus();
                                         
                        return false;
                    }
                });
            });
            
            function adicionaProdutoLista() {
                
                if(itemSelecionado.id>0) {
                    
                    var cont = 0;
                    var stringData = "";
                    
                    
                    var idCompra = $("#id").val();
                    // informa id da compra ou zero 
                    itemSelecionado.compraId = (idCompra>0?idCompra:0);
                    
                    $.ajax({
                        type: "POST",
                        url: "add-item-compra.php", 
                        data: itemSelecionado, //encodeURIComponent(stringData),
                        success: function(result){ // retorna o id da compra
                            console.log(result);
                        }
                    });
                }
                
                return false;
            }
        </script>
    </body>
</html>