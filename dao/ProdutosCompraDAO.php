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
    
    
}
