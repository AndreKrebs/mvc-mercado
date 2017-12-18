<?php namespace Model;

include 'configs/data.config.php';
include 'dao/tipo-produto.dao.php';

use Config\Database\Data as DB;
use DAO\TiposProdutoDAO as TPDAO;

class TiposProdutoModel {
    
    private $conexao;
    
    public function __construct() {
        // instancia base de dados
        $this->conexao = new DB(); 
    }
    
    public function lista() {
        
        $dao = new TPDAO();
        
        $lista = $dao->lista();
        
        if($lista == 0) {
            return [];
        } else if($lista<0){
            return "Ocorreu um erro na consulta";
        }else {
            return $lista;
        }
    }
}



