<?php namespace controller;

use model\ComprasModel as CModel;

class ComprasController {
    
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
        $compras = [];
        
        $model = new CModel();
        
        $compras = $model->lista($itensPorPagina, $this->currentPage);
        
        return $compras;
    }
    
    public function adicionarSalvar() {
        
        if($_POST) {
            $compra = $_POST;
            $model = new CModel();
            
            if($compra['id']>0) { // update
                $mensagem = $model->atualizaRegistro($compra);
                $this->redirectList($mensagem);
            } else { // novo registro
                $mensagem = $model->novoRegistro($compra);
                $this->redirectList($mensagem);
            }
        }
        
    }
    
    public function buscaRegistro() {
        if(@$_GET) {
            if(array_key_exists('id', $_GET)) {
                if($_GET['id']>0) {
                    $model = new CModel();

                    $compra = $model->buscaRegistro($_GET['id']);

                    return $compra;
                }
            } else {
                return "Registro inválido";
            }
        }
    }
    
    public function totalRegistros() {
        $model = new CModel();
        
        $total = $model->totalRegistros();
        
        return $total;
    }
    
    private function redirectList($mensagem) {
        
        $url = HOST_APPLICATION."/compras.php";

        $_SESSION['mensagem'] = $mensagem;

        header("Location: ".$url);
        
    }
    
    public function excluir() {
        if(@$_GET) {
            if(array_key_exists('id', $_GET)){
                $id = $_GET['id'];
                
                $model = new CModel();
                
                $mensagem = $model->excluir($id);
                
                $url = HOST_APPLICATION."/compras.php";

                $_SESSION['mensagem'] = $mensagem;

                header("Location: ".$url);
            }
        }
    }
    
    public function addCompra() {
        if(@$_POST) {
            if(is_array($_POST)) {
                $itemCompra = $_POST;
                
                $model = new CModel();
                
                $compraId = $model->addCompra($itemCompra);
                
                
                return $compraId;
            }
        }
    }
    
    public function concluirCompra() {
        if(@$_POST) {
            if(is_array($_POST)) {
                $compra = $_POST;
                
                $model = new CModel();
                
                $retorno = $model->concluirCompra($compra);
                                
                return $retorno;
            }
        }
    }
}