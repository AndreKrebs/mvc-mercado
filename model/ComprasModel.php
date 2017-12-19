<?php namespace model;

use configs\Database as DB;
use dao\ComprasDAO as CDAO;

class ComprasModel {
    
    private $conexao;
    
    public function __construct() {
        // instancia base de dados
        $this->conexao = new DB(); 
    }
    
    public function lista($itensPorPagina, $currentPage) {
        
        $dao = new CDAO();
        
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
        
        $dao = new CDAO();
        
        $total = $dao->totalRegistros();
        
        if($total<0) {
            return "Ocorreu um erro na paginação";
        } else {
            return $total;
        }
    }
    
    public function novoRegistro($compra) {
        
        $dao = new CDAO();
        
        $retorno = $dao->novoRegistro($compra);
        
        if ($retorno) {
            return array("mensagem"=>"Cadastro de Compra realizadoo","type"=>"SUCCESS");
        } else {
            return array("mensagem"=>"Falha ao tentar cadastrar Compra","type"=>"ERROR");
        }
    }
    
    public function atualizaRegistro($compra) {
        
        $dao = new CDAO();
        
        $retorno = $dao->atualizaRegistro($compra);
        if ($retorno) {
            return array("mensagem"=>"Cadastro de Compra atualizado","type"=>"SUCCESS");
        } else {
            return array("mensagem"=>"Falha ao tentar atualizar Compra","type"=>"ERROR");
        }
        
    }
    
    public function buscaRegistro($id) {
        
        $dao = new CDAO();
        
        $compra = $dao->buscaRegistro($id);

        return $compra;
    }
    
    public function excluir($id) {
        if($id>0) {
            $dao = new CDAO();
            
            $retorno = $dao->excluir($id);
            
            if($retorno===true) {
                return array("mensagem"=>"Cadastro de Compra excluido com sucesso","type"=>"SUCCESS");
            } else {
                return array("mensagem"=>"Não foi possivel excluir cadastro de Compra","type"=>"ERROR");
            }
        }
    }
    
}



