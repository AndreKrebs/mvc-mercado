<?php
include 'configs/config.php';

use controller\ComprasController;
use configs\Pagination;

$compras = new ComprasController();

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
                    <li class="active"><a href="<?=HOST_APPLICATION?>/compras.php">Nova Compra</a></li>
                    <li><a href="<?=HOST_APPLICATION?>/produtos.php">Produtos</a></li>
                    <li><a href="<?=HOST_APPLICATION?>/tipos-produto.php" >Tipos de produto</a></li>
                </ul>
            </div>
        </nav>
        <div class="container fill" style="position: relative;">
            <h3>Compras</h3>
            
            <?php 
            if(is_array($compras->mensagem) && $compras->mensagem['type']=='ERROR'): ?>
                <div class="alert alert-warning">
                    <strong>Erro! </strong><?=$compras->mensagem['mensagem']?> 
                </div>
            <?php
            endif;
            if(is_array($compras->mensagem) && $compras->mensagem['type']=='SUCCESS'): ?>
                <div class="alert alert-success">
                    <strong>Sucesso!</strong> <?=$compras->mensagem['mensagem']?>.
                </div>
            <?php
            endif;
            ?>
            <div>
            
            <button type="button" class="btn btn-success" onclick="location.href='<?=HOST_APPLICATION?>/view/compras/form.php'">Nova Compra</button>
            
            <table class="table" style="margin-bottom: 35px;">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Valor total</th>
                        <th>Fechada</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $paginacao = new Pagination();
                    // pega valor padrão de registros por paginas
                    $totalPorPagina = $paginacao->recordsPerPage;
                    
                    $lista = $compras->lista($totalPorPagina);
                    
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
                            echo "<td>{$item['total']}</td>";
                            echo "<td>".($item['fechada']=='t'?"Sim":"Não")."</td>";
                            echo "<td>";
                            echo "<button type=\"button\" class=\"btn btn-primary\" onclick=\"location.href='".HOST_APPLICATION."/view/compras/form.php?id={$item['id']}'\">".($item['fechada']=='t'?"Ver":"Editar")."</button>";
                            echo "<button type=\"button\" class=\"btn btn-danger\" style='margin-left: 10px; ".($item['fechada']=='t'?"display: none;":"")."' onclick=\"location.href='".HOST_APPLICATION."/view/compras/excluir.php?id={$item['id']}'\">Excluir</button>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
            <?php
            // consulta no bd o total de registros
            $totalRegistros = $compras->totalRegistros();
            
            // pagina atual
            $currentPage = $compras->currentPage;
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