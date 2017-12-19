<?php

namespace dao;

class TiposProdutoDAO {

    public function lista($itensPorPagina, $currentPage) {

        $query = "SELECT * FROM tipo_produto ";
        
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
    
    public function totalRegistros() {
        
        $query = "SELECT count(*) FROM tipo_produto";
        $result = pg_query($query);
        $lista = array();
            
        if (!$result) {
            return -1;
        }
        if (pg_num_rows($result) == 0) {
            return 0;
        } else {
            return pg_fetch_array($result, null, PGSQL_ASSOC)['count'];
        }
        
        
    }
    
    public function novoRegistro($tipoProduto) {
        
        $sql = "INSERT INTO ";
        $campos = " tipo_produto (";
        $valores = " VALUES (";
        
        $startFor = 0;
        
        foreach ($tipoProduto as $key=>$tp) {
            if(empty($tp)) {
                continue;
            }
            
            if($startFor==0) {
                $campos .= $key;
                $valores .= "'{$tp}'";
                $startFor++;
            } else {
                $campos .= ",".$key;
                $valores .= ",'{$tp}'";
            }
        }
        
        $campos .= ")";
        $valores .= ")";
        
        $sql .= $campos . $valores;
        $resultado = pg_query($sql);
        echo $sql;
        var_dump(pg_fetch_row($resultado));
        print_r(pg_last_oid(pg_affected_rows($resultado)));
        
//        $tipoProduto2 = pg_fetch_array($resultado, null, PGSQL_ASSOC);
//        echo "---->";
//        print_r(pg_last_oid($resultado));
        return $resultado;
        
    }
    
    public function atualizaRegistro($tipoProduto) {
        $sql = "UPDATE tipo_produto SET ";
        $valores = " ";
        $where = " ";
        $startFor = 0;
        
        foreach ($tipoProduto as $key=>$tp) {
            if(empty($tp) || $key == 'id') {
                if($key == 'id') {
                    $where .= " WHERE id = {$key}";
                }
                continue;
            }
            
            if($startFor==0) {
                $valores .= $key . " = '{$tp}'";
                $startFor++;
            } else {
                $valores .= "," . $key . " = '{$tp}'";
            }
        }
        
        $sql .= $valores.$where;
        $result = pg_query($sql);
        
        return $result;
    }
    
    public function buscaRegistro($id) {
        $sql = "SELECT * FROM tipo_produto WHERE id = {$id}";
        
        $resultado = pg_query($sql);
        
        $tipoProduto = pg_fetch_array($resultado, null, PGSQL_ASSOC);
        
        if($tipoProduto) {
            return $tipoProduto;
        } else {
            return "Não foi encontrado";
        }
    }

}
