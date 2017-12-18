<?php namespace model;

use configs\Database as DB;
use dao\TiposProdutoDAO as TPDAO;

class TiposProdutoModel {
    
    private $conexao;
    
    public function __construct() {
        // instancia base de dados
        $this->conexao = new DB(); 
    }
    
    public function lista($itensPorPagina, $currentPage) {
        
        $dao = new TPDAO();
        
        $lista = $dao->lista($itensPorPagina, $currentPage);
        
        if($lista == 0) {
            return [];
        } else if($lista<0){
            return "Ocorreu um erro na consulta";
        } else {
            return $lista;
        }
    }
    
    public function totalRegistros() {
        
        $dao = new TPDAO();
        
        $total = $dao->totalRegistros();
        
        if($total<0) {
            return "Ocorreu um erro na paginação";
        } else {
            return $total;
        }
    }
    
    public function novoRegistro($tipoProduto) {
        
        $dao = new TPDAO();
        
        $retorno = $dao->novoRegistro($tipoProduto);
        
        if ($retorno) {
            return "Cadastro de Tipo de Produto realizado";
        } else {
            return "Falha ao tentar cadastrar Tipo de Produto";
        }
    }
    
    public function atualizaRegistro($tipoProduto) {
        
        $dao = new TPDAO();
        
        $retorno = $dao->atualizaRegistro($tipoProduto);
        print_r($retorno);
        if ($retorno) {
            return "Cadastro de Tipo de Produto atualizado";
        } else {
            return "Falha ao tentar atualizar Tipo de Produto";
        }
        
    }
    
    public function buscaRegistro($id) {
        
        $dao = new TPDAO();
        
        return $dao->buscaRegistro($id);
        
    }
    
}



