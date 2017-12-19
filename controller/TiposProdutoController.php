<?php namespace controller;

use model\TiposProdutoModel as TPModel;

class TiposProdutoController {
    
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
        }
    }
    
    public function lista($itensPorPagina=0) {
        $tiposProduto = [];
        
        $model = new TPModel();
        
        $tiposProduto = $model->lista($itensPorPagina, $this->currentPage);
        
        return $tiposProduto;
    }
    
    public function adicionarSalvar() {
        
        if($_POST) {
            $tipoProduto = $_POST;
            $model = new TPModel();
            
            if($tipoProduto['id']>0) { // update
                $mensagem = $model->atualizaRegistro($tipoProduto);
                $this->redirectList($mensagem);
            } else { // novo registro
                $mensagem = $model->novoRegistro($tipoProduto);
                $this->redirectList($mensagem);
            }
        }
        
    }
    
    public function buscaRegistro() {
        if(@$_GET) {
            if(array_key_exists('id', $_GET)) {
                if($_GET['id']>0) {
                    $model = new TPModel();

                    $tipoProduto = $model->buscaRegistro($_GET['id']);

                    return $tipoProduto;
                }
            } else {
                return "Registro inválido";
            }
        }
    }
    
    public function totalRegistros() {
        $model = new TPModel();
        
        $total = $model->totalRegistros();
        
        return $total;
    }
    
    private function redirectList($mensagem) {
        
        $url = HOST_APPLICATION."/tipos-produto.php";

        $_SESSION['mensagem'] = $mensagem;

        header("Location: ".$url);
        
    }
}