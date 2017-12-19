<?php
include 'configs/config.php';

use controller\ProdutosController;
use configs\Pagination;

$produtos = new ProdutosController();

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Mercado - início</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="./content/css/reset.css"> 
        <link rel="stylesheet" type="text/css" href="./content/css/style.css"> 
        <link rel="stylesheet" type="text/css" href="./content/css/bootstrap/bootstrap.min.css"> 

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
                    <li><a href="<?=HOST_APPLICATION?>/produtos.php">Produtos</a></li>
                    <li class="active"><a href="<?=HOST_APPLICATION?>/tipos-produto.php" >Tipos de produto</a></li>
                </ul>
            </div>
        </nav>
        <div class="container fill" style="position: relative;">
            <h3>Produtos</h3>
            
            <?php 
            if(is_array($produtos->mensagem) && $produtos->mensagem['type']=='ERROR'): ?>
                <div class="alert alert-warning">
                    <strong>Erro! </strong><?=$produtos->mensagem['mensagem']?> 
                </div>
            <?php
            endif;
            if(is_array($produtos->mensagem) && $produtos->mensagem['type']=='SUCCESS'): ?>
                <div class="alert alert-success">
                    <strong>Sucesso!</strong> <?=$produtos->mensagem['mensagem']?>.
                </div>
            <?php
            endif;
            ?>
            <div>
            
            <button type="button" class="btn btn-success" onclick="location.href='<?=HOST_APPLICATION?>/view/produtos/form.php'">Cadastrar novo</button>
            
            <table class="table" style="margin-bottom: 35px;">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Tipo Produto</th>
                        <th>Preço</th>
                        <th>Produtor</th>
                        <th>Distribuidor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $paginacao = new Pagination();
                    // pega valor padrão de registros por paginas
                    $totalPorPagina = $paginacao->recordsPerPage;
                    
                    $lista = $produtos->lista($totalPorPagina);
                    
                    // alerta se retornou string
                    if(is_string($lista)) { ?>
                        <div class="alert alert-warning">
                            <strong>Erro! </strong><?=$lista?> 
                        </div>
                    <?php
                    } else if (is_array($lista)) {
                        foreach ($lista as $item) {
                            echo "<tr>";
                            echo "<td>{$item['id']}</td>";
                            echo "<td>{$item['nome']}</td>";
                            echo "<td>{$item['tipo']}</td>";
                            echo "<td>{$item['preco']}</td>";
                            echo "<td>{$item['produtor']}</td>";
                            echo "<td>{$item['distribuidor']}</td>";
                            echo "<td>";
                            echo "<button type=\"button\" class=\"btn btn-primary\" onclick=\"location.href='".HOST_APPLICATION."/view/produtos/form.php?id={$item['id']}'\">Editar</button>";
                            echo "<button type=\"button\" class=\"btn btn-danger\" style='margin-left: 10px;' onclick=\"location.href='".HOST_APPLICATION."/view/produtos/excluir.php?id={$item['id']}'\">Excluir</button>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
            <?php
            // consulta no bd o total de registros
            $totalRegistros = $produtos->totalRegistros();
            
            // pagina atual
            $currentPage = $produtos->currentPage;
            ?>
            <ul class="pagination bottom-pagination">
                <?php
                // arredonda valor para valor maior
                $totalPaginas = ceil($totalRegistros/$totalPorPagina);
                if($totalPaginas>0):
                    for($i=0; $i<$totalPaginas; $i++):
                    ?>
                        <li class="<?php echo ($currentPage==$i?'active':'') ?>">
                            <a href="?pg=<?php echo $i ?>"><?php echo $i+1 ?></a>
                        </li>
                    <?php
                    endfor;
                    ?>
                <?php
                endif;
                ?>
            </ul>
            </div>
        </div>

    </body>
</html>