<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include 'configs/pagination.php';
include 'controller/tipos-produto.controller.php';

use Controller\TiposProdutoController;
use Config\Pagination;

$tiposProduto = new TiposProdutoController();
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
                    <li><a href="index.php">Início</a></li>
                    <li><a href="compras.php">Nova Compra</a></li>
                    <li><a href="produtos.php">Produtos</a></li>
                    <li class="active"><a href="tipos-produto.php" >Tipos de produto</a></li>
                </ul>
            </div>
        </nav>
        <div class="container fill" style="position: relative;">
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
                    $paginacao = new Pagination();
                    // pega valor padrão de registros por paginas
                    $totalPorPagina = $paginacao->recordsPerPage;
                    
                    $lista = $tiposProduto->lista($totalPorPagina);

                    if (is_array($lista)) {
                        foreach ($lista as $item) {
                            echo "<tr>";
                            echo "<td>{$item['id']}</td>";
                            echo "<td>{$item['descricao']}</td>";
                            echo "<td>{$item['tipo']}</td>";
                            echo "<td>{$item['imposto']}</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
            <?php
            // consulta no bd o total de registros
            $totalRegistros = $tiposProduto->totalRegistros();
            
            // pagina atual
            $currentPage = $tiposProduto->currentPage;
            ?>
            <ul class="pagination bottom-pagination">
                <?php
                $totalPaginas = (int)($totalRegistros/$totalPorPagina);
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

    </body>
</html>