<?php
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
        <link rel="stylesheet" type="text/css" href="../../content/css/reset.css"> 
        <link rel="stylesheet" type="text/css" href="../../content/css/style.css"> 
        <link rel="stylesheet" type="text/css" href="../../content/css/bootstrap/bootstrap.min.css"> 

    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Mercado</a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="<?=HOST_APPLICATION?>">Início</a></li>
                    <li><a href="<?=HOST_APPLICATION?>/compras.php">Nova Compra</a></li>
                    <li class="active"><a href="<?=HOST_APPLICATION?>/produtos.php">Produtos</a></li>
                    <li><a href="<?=HOST_APPLICATION?>/tipos-produto.php" >Tipos de produto</a></li>
                </ul>
            </div>
        </nav>
        <div class="container fill" style="position: relative;">
            <h3>Formulário Produto </h3>

            <form method="post">
                <input type="hidden" class="form-control" name="id" id="id" value="<?=(is_array($produto)?$produto['id']:'')?>">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" name="nome" id="nome" value="<?=(is_array($produto)?$produto['nome']:'')?>" required>
                </div>
                
                <div class="form-group">
                    <label for="tipo_produto_id">Tipo Produto:</label>    
                    <select class="form-control" name="tipo_produto_id" id="tipo_produto_id" required>
                        <option value="">Selecione</option>
                        <?php
                        
                            $listaTiposProduto = $tiposProdutoCtrl->lista(-1);
                            foreach($listaTiposProduto as $tipo) {
                                echo "<option value=\"{$tipo['id']}\" ".(is_array($produto)?($produto['tipo_produto_id']==$tipo['id']?'selected':''):'')." >{$tipo['tipo']}</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="descricao">Preço:</label>
                    <input type="number" step="0.01" class="form-control" name="preco" id="preco" value="<?=(is_array($produto)?$produto['preco']:'')?>" required>
                </div>
                <div class="form-group">
                    <label for="produtor">Produtor:</label>
                    <input type="text" class="form-control" name="produtor" id="produtor" value="<?=(is_array($produto)?$produto['produtor']:'')?>" required>
                </div>
                <div class="form-group">
                    <label for="distribuidor">Distribuidor:</label>
                    <input type="text" class="form-control" name="distribuidor" id="distribuidor" value="<?=(is_array($produto)?$produto['distribuidor']:'')?>" required>
                </div>
                <button type="submit" class="btn btn-default">Salvar</button>
            </form>

        </div>

    </body>
</html>