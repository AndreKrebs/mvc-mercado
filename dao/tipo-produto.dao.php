<?php

namespace DAO;

class TiposProdutoDAO {

    public function lista() {

        $query = "SELECT * FROM tipo_produto";
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
