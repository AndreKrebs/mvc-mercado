<?php
include '../../configs/config.php';

use controller\ComprasController;
use controller\ProdutosCompraController;

$compraCtrl = new ComprasController();
$produtosCompraCtrl = new ProdutosCompraController();

$compra = $compraCtrl->buscaRegistro();
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
                    <li><a href="<?=HOST_APPLICATION?>">Início</a></li>
                    <li class="active"><a href="<?=HOST_APPLICATION?>/compras.php">Nova Compra</a></li>
                    <li><a href="<?=HOST_APPLICATION?>/produtos.php">Produtos</a></li>
                    <li><a href="<?=HOST_APPLICATION?>/tipos-produto.php" >Tipos de produto</a></li>
                </ul>
            </div>
        </nav>
        <div class="container fill" style="position: relative;">
            
            <input type="hidden" id="id" name="id" value="<?=(is_array($compra) && array_key_exists('id', $compra) && $compra['id']>0?$compra['id']:'') ?>">
            <div <?=($compra['fechada']=='t'?"style='display:none;'":"")?> >
                <h3>Nova Compra</h3>

                <form class="form-inline" onsubmit="adicionaProdutoLista(); return false;">

                    <div class="form-group ui-widget">
                        <label for="produtos">Produtos: </label>
                        <input id="produtos" class="form-control" size="20" placeholder="Código ou nome do produto">
                    </div>
                    <div class="form-group">
                        <label for="quantidade">Quantidade:</label>
                        <input type="quantidade" class="form-control" id="quantidade" value="1" size="5">
                    </div>
                    <button type="submit" class="btn btn-default">Adicionar</button>
                </form>
            </form>
            </div>
            
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
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody id="itens-compra">
                    
                    <?php
                    $totalCompra = 0;
                    $totalCompraImpostos = 0;
                    if(is_array($compra) && array_key_exists('id', $compra) && $compra['id']>0):
                        $listaItens = $produtosCompraCtrl->buscaItensCompra($compra['id']);
                        if(is_array($listaItens) && count($listaItens)>0):
                            foreach ($listaItens as $item): 
                                $totalCompra += $item['total'];
                                $totalCompraImpostos += $item['total_imposto'];
                            ?>
                                <tr class="item-compra-<?=$item['id'] ?>">
                                    <td><?=$item['id'] ?></td>
                                    <td><?=$item['nome'] ?></td>
                                    <td>R$ <?=$item['preco'] ?></td>
                                    <td><?=$item['total'] ?></td>
                                    <td>R$ <span class="valortotal"><?=$item['total'] ?></span></td>
                                    <td>R$ <span class="valortotalimposto"><?=$item['total_imposto'] ?></span></td>
                                    <td><button class="btn btn-warning btn-sm" <?=($compra['fechada']=='t'?"style='display:none;'":"")?>  onclick="removeItem(<?=$item['id'] ?>)">Excluir</button></td>
                                </tr>
                            <?php
                            endforeach;
                        endif;
                    endif;
                    ?>
                    
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2">
                            <b>Total impostos: R$ <span id="valor-total-impostos"><?=$totalCompraImpostos ?></span> </b>
                        </td>
                        <td colspan="5">
                            <b>Total da compra: R$ <span id="valor-total"><?=$totalCompra ?></span> </b>
                        </td>
                    </tr>
                </tfoot>
            </table>

            <button class="btn btn-success" onclick="concluirCompra()" <?=($compra['fechada']=='t'?"style='display:none;'":"")?>>Concluir compra</button>
        </div>

        <script src="../../content/js/jquery/jquery-1.12.4.js"></script>
        <script src="../../content/js/jqueryui/jquery-ui.min.js"></script>
        <script>
            var itemSelecionado = {};
            var somaTotaisImpostos = 0, somaTotais = 0;
            
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
                        var term = extractLast(this.value);
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
                    var quantidade = $("#quantidade").val();
                    // informa id da compra ou zero 
                    itemSelecionado.compraId = (idCompra>0?idCompra:0);
                    // adiciona valor de quantidade
                    itemSelecionado.quantidade = quantidade;
                    // atualiza o valor unitário pelo quantidade de itens
                    itemSelecionado.value = itemSelecionado.value*quantidade;
                    
                    // grava os dados no banco de dados
                    $.ajax({
                        type: "POST",
                        url: "add-item-compra.php", 
                        data: itemSelecionado, 
//                        dataType: 'json',                        
                        success: function(result){ // retorna ids
                            var retorno = JSON.parse(result);
                            
                            // limpa os campos do form
                            $("#produtos").val("");
                            $("#quantidade").val(1);
                            
                            if(typeof retorno == 'object') {
                                
                                if(itemSelecionado.compraId === 0) {
                                    itemSelecionado.compraId = retorno.compraId;
                                    $("#id").val(retorno.compraId);
                                }
                                itemSelecionado.produtoCompraId = retorno.produtoCompraId;
                                
                                // monta tr
                                adicionaItemTabela(itemSelecionado);
                                somaTotal();
                            } else {
                                alert("ERRO: não foi possivel adicionar o item na compra.");
                            }
                        }, 
                        error: function() {
                            alert("ERRO: ocorreu uma falha na requisição.");
                            // limpa os campos do form
                            $("#produtos").val("");
                            $("#quantidade").val(1);
                        }
                    });
                }
                
                return false;
            }
            
            function adicionaItemTabela(novoItem) {
                var itemTr = montaTr(novoItem);
                var tabela = document.querySelector("#itens-compra");
                tabela.appendChild(itemTr);
            }
            
            function montaTr(novoItem) {
                var itemTr = document.createElement("tr");
                itemTr.classList.add("item-compra-"+novoItem.produtoCompraId);

                itemTr.appendChild(montaTd(novoItem.produtoCompraId));
                itemTr.appendChild(montaTd(novoItem.label));
                itemTr.appendChild(montaTd("R$ "+ (novoItem.value/novoItem.quantidade)));
                itemTr.appendChild(montaTd(novoItem.quantidade));
                itemTr.appendChild(montaTd("R$ <span class='valortotal'>"+novoItem.value+"</span>"));
                itemTr.appendChild(montaTd("R$ <span class='valortotalimposto'>"+((novoItem.value*novoItem.percent)/100)+"</span>"));
                
                // adiciona botao
                itemTr.appendChild(montaTdBotao(novoItem.produtoCompraId));

                return itemTr;
            }
            
            function montaTd(dado) {
                var td = document.createElement("td");
                td.innerHTML = dado;

                return td;
            }
            
            function montaTdBotao(dado) {
                var td = document.createElement("td");
                
                td.innerHTML = "<button class=\"btn btn-warning btn-sm\" onclick=\"removeItem("+dado+")\">Excluir</button>";
                
                return td;
            }
            
            function removeItem(itemId) {
                if(itemId>0) {
                    if(confirm("Deseja excluir o item ?")){
                        $.ajax({
                            type: "GET",
                            url: "remove-item-compra.php", 
                            data: "id="+itemId, 
                            success: function(result){ // retorna o id da compra
                                var retorno = JSON.parse(result);

                                if(retorno.result === true) {
                                    $(".item-compra-"+itemId).remove();      
                                    somaTotal();
                                } else {
                                    alert("ERRO: não foi possivel excluir o item");
                                }
                            }
                        });
                    }
                }
            }
            
            function somaTotal() {
                
                var totais = document.getElementsByClassName("valortotal");
                var totaisImpostos = document.getElementsByClassName("valortotalimposto");
                somaTotaisImpostos = 0;
                somaTotais = 0;
                
                $.each(totais, function(index, value){
                    somaTotais += parseFloat(value.innerHTML);
                });
                
                $.each(totaisImpostos, function(index, value){
                    somaTotaisImpostos += parseFloat(value.innerHTML);
                });

                $("#valor-total-impostos").html(somaTotaisImpostos);
                $("#valor-total").html(somaTotais);
                
                
            }
            
            function concluirCompra() {
                var idCompra = $("#id").val();
                
                if(confirm("Deseja concluir a compra, ela não podera ser editada posteriormente ?")){
                    if(idCompra > 0) {
                        somaTotaisImpostos = $("#valor-total-impostos").html();
                        somaTotais = $("#valor-total").html();
                        
                        $.ajax({
                            type: "POST",
                            url: "concluir-compra.php", 
                            data: {id: idCompra, total: somaTotais, totalImposto:somaTotaisImpostos}, 
                            success: function(result){ 
                                var retorno = JSON.parse(result);

                                if(retorno.result === true) {
                                    window.location  = "../../compras.php";
                                } else {
                                    alert("ERRO: não foi possivel concluir a compra");
                                }
                            },
                            error: function() {
                                alert("ERRO: não foi possivel concluir a compra");
                            }
                        });
                    } else {
                        // se a compra não foi registrada no BD, só direciona
                        window.location  = "../../compras.php";
                    }
                }
            }
            
        </script>
    </body>
</html>