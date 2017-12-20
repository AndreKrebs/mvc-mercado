<?php

namespace dao;

class ProdutosCompraDAO {

    public function lista($itensPorPagina, $currentPage) {

        $query = "SELECT p.*, tp.tipo FROM compra p"
                . " INNER JOIN tipo_compra tp ON tp.id=p.tipo_compra_id"
                . " ORDER BY p.id ";
        
        // paginação se maior que zero
        if($itensPorPagina>0) {
            $query .= " LIMIT {$itensPorPagina} OFFSET ". (int)($currentPage*$itensPorPagina);
        }
        
        $result = pg_query($query);
        $lista = array();
            
        if (!$result) {
            return -1;
        }
        if (pg_num_rows($result) == 0) {
            return 0;
        } else {
            while ($row = pg_fetch_array($result, null, PGSQL_ASSOC)) {
                $lista[] = $row;
            }
        }
        
        return $lista;
    }
    
    
}
