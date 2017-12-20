<?php namespace controller;

use model\ProdutosModel as PModel;

class ProdutosController {
    
    public $currentPage = 0;
    public $mensagem;
    
    public function __construct() {
        if(array_key_exists('pg', $_GET)){
            $this->currentPage = $_GET['pg'];
        }
        // se a pagina recebeu nova mensagem
        $this->mensagem = "";
        if(array_key_exists('mensagem', $_SESSION)){
            $this->mensagem = $_SESSION['mensagem'];
            $_SESSION['mensagem'] = null;
        }
    }
    
    public function lista($itensPorPagina=0) {
        $produtos = [];
        
        $model = new PModel();
        
        $produtos = $model->lista($itensPorPagina, $this->currentPage);
        
        return $produtos;
    }
    
    public function adicionarSalvar() {
        
        if($_POST) {
            $produto = $_POST;
            $model = new PModel();
            
            if($produto['id']>0) { // update
                $mensagem = $model->atualizaRegistro($produto);
                $this->redirectList($mensagem);
            } else { // novo registro
                $mensagem = $model->novoRegistro($produto);
                $this->redirectList($mensagem);
            }
        }
        
    }
    
    public function buscaRegistro() {
        if(@$_GET) {
            if(array_key_exists('id', $_GET)) {
                if($_GET['id']>0) {
                    $model = new PModel();

                    $produto = $model->buscaRegistro($_GET['id']);

                    return $produto;
                }
            } else {
                return "Registro inválido";
            }
        }
    }
    
    public function totalRegistros() {
        $model = new PModel();
        
        $total = $model->totalRegistros();
        
        return $total;
    }
    
    private function redirectList($mensagem) {
        
        $url = HOST_APPLICATION."/produtos.php";

        $_SESSION['mensagem'] = $mensagem;

        header("Location: ".$url);
        
    }
    
    public function excluir() {
        if(@$_GET) {
            if(array_key_exists('id', $_GET)){
                $id = $_GET['id'];
                
                $model = new PModel();
                
                $mensagem = $model->excluir($id);
                
                $url = HOST_APPLICATION."/produtos.php";

                $_SESSION['mensagem'] = $mensagem;

                header("Location: ".$url);
            }
        }
    }
    
    public function buscaAutocomplete() {
        
        if(is_array($_GET)){
            if(array_key_exists('term', $_GET)){
                $termo = $_GET['term'];
                
                $model = new PModel();
                
                $listaJson = $model->buscaAutocomplete($termo);
                
                return json_encode($listaJson);
            }
        }
        // se não entrou no if
        return new ArrayObject();
    }
}