<?php

namespace dao;

class ComprasDAO {

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
    
    public function totalRegistros() {
        
        $query = "SELECT count(*) FROM compra";
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
    
    public function novoRegistro($compra) {
        
        $sql = "INSERT INTO ";
        $campos = " compra (";
        $valores = " VALUES (";
        
        $startFor = 0;
        
        foreach ($compra as $key=>$tp) {
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
        
        return $resultado;
        
    }
    
    public function atualizaRegistro($compra) {
        $sql = "UPDATE compra SET ";
        $valores = " ";
        $where = " ";
        $startFor = 0;
        
        $where .= " WHERE id = {$compra['id']}";
        
        foreach ($compra as $key=>$tp) {
            if(empty($tp)) {
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
        $sql = "SELECT * FROM compra WHERE id = {$id}";
        
        $resultado = pg_query($sql);
        
        $compra = pg_fetch_array($resultado, null, PGSQL_ASSOC);
        
        if($compra) {
            return $compra;
        } else {
            return "Não foi encontrado";
        }
    }
    
    public function excluir($id) {
        $sql = "DELETE FROM compra WHERE id = {$id}";
        
        $retorno = pg_query($sql);
        
        if($retorno) {
            return true;
        } else {
            return false;
        }
    }

    public function addCompra() {
        
        $sql = "INSERT INTO compra(total, total_imposto) VALUES(0.00, 0.00) RETURNING id";
    
        $retorno = pg_query($sql);
        
        if ($retorno == false) {    
            die( pg_last_error() );
        } 
        
        $lastId = pg_fetch_array($retorno, null, PGSQL_ASSOC);
        
        return $lastId['id'];
        
    }
    
    public function concluirCompra($compra) {
        $sql = "UPDATE compra SET total={$compra['total']}, total_imposto={$compra['totalImposto']}, fechada=true WHERE id={$compra['id']}";
    
        $retorno = pg_query($sql);
        
        if ($retorno == false) {    
            die( pg_last_error() );
        }
        
        return true;
    }
    
}
