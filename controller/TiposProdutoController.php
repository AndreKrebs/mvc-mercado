<?php namespace controller;

use model\TiposProdutoModel as TPModel;

class TiposProdutoController {
    
    public $currentPage = 0;
    
    public function __construct() {
        if(array_key_exists('pg', $_GET)){
            $this->currentPage = $_GET['pg'];
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
                return $model->atualizaRegistro($tipoProduto);
            } else { // novo registro
                return $model->novoRegistro($tipoProduto);
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
    
}