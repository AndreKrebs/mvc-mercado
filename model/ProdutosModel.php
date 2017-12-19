<?php namespace model;

use configs\Database as DB;
use dao\ProdutosDAO as PDAO;

class ProdutosModel {
    
    private $conexao;
    
    public function __construct() {
        // instancia base de dados
        $this->conexao = new DB(); 
    }
    
    public function lista($itensPorPagina, $currentPage) {
        
        $dao = new PDAO();
        
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
        
        $dao = new PDAO();
        
        $total = $dao->totalRegistros();
        
        if($total<0) {
            return "Ocorreu um erro na paginação";
        } else {
            return $total;
        }
    }
    
    public function novoRegistro($produto) {
        
        $dao = new PDAO();
        
        $retorno = $dao->novoRegistro($produto);
        
        if ($retorno) {
            return array("mensagem"=>"Cadastro de Produto realizadoo","type"=>"SUCCESS");
        } else {
            return array("mensagem"=>"Falha ao tentar cadastrar Produto","type"=>"ERROR");
        }
    }
    
    public function atualizaRegistro($produto) {
        
        $dao = new PDAO();
        
        $retorno = $dao->atualizaRegistro($produto);
        if ($retorno) {
            return array("mensagem"=>"Cadastro de Produto atualizado","type"=>"SUCCESS");
        } else {
            return array("mensagem"=>"Falha ao tentar atualizar Produto","type"=>"ERROR");
        }
        
    }
    
    public function buscaRegistro($id) {
        
        $dao = new PDAO();
        
        $produto = $dao->buscaRegistro($id);

        return $produto;
    }
    
    public function excluir($id) {
        if($id>0) {
            $dao = new PDAO();
            
            $retorno = $dao->excluir($id);
            
            if($retorno===true) {
                return array("mensagem"=>"Cadastro de Produto excluido com sucesso","type"=>"SUCCESS");
            } else {
                return array("mensagem"=>"Não foi possivel excluir cadastro de Produto","type"=>"ERROR");
            }
        }
    }
    
}



