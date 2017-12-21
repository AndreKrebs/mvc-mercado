<?php

namespace dao;

class ProdutosCompraDAO {

    public function addProdutoCompra($itemCompra, $compraid) {

        // monta o insert
        $sql = "INSERT INTO compra_produto(compra_id, produto_id, quantidade, total, total_imposto) VALUES";
        $imposto = ($itemCompra['value']*$itemCompra['percent'])/100;
        
        $values = "(";
        $values .= "{$compraid},";
        $values .= "{$itemCompra['id']},";
        $values .= "{$itemCompra['quantidade']},";
        $values .= "{$itemCompra['value']},";
        $values .= "{$imposto}";
        $values .= ") ";
        
        
        $sql .= $values . " RETURNING id ";
        
        $retorno = pg_query($sql);
        
        if ($retorno == false) {    
            die( pg_last_error() );
        } 
        
        $lastId = pg_fetch_array($retorno, null, PGSQL_ASSOC);
        
        return $lastId['id'];
        
    }
    
    public function removeItemCompra($id) {
        $sql = "DELETE FROM compra_produto WHERE id = {$id}";
        
        $retorno = pg_query($sql);
        
        if ($retorno === false) {   
            die( pg_last_error() );
        }
        return $retorno;
    }
    
    public function buscaItensCompra($compraId) {
        $lista = array();
        
        $sql = "SELECT cp.*, p.nome, p.preco FROM compra_produto cp "
                . "INNER JOIN produto p ON p.id = cp.produto_id "
                . "WHERE cp.compra_id = {$compraId} "
                . "ORDER BY cp.id ASC ";
                
        $retorno = pg_query($sql);
        
        if ($retorno == false) {    
            die( pg_last_error() );
        } 
        
        while($row = pg_fetch_array($retorno, null, PGSQL_ASSOC)) {
            $lista[] = $row;
        }
        
        return $lista;
        
    }
    
}
