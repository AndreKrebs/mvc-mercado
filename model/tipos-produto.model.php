<?php namespace Model;

include 'configs/data.config.php';
include 'dao/tipo-produto.dao.php';

use Config\Database as DB;
use DAO\TiposProdutoDAO as TPDAO;

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
        }else {
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
    
}



