<?php

namespace dao;

class ProdutosDAO {

    public function lista($itensPorPagina, $currentPage) {

        $query = "SELECT p.*, tp.tipo FROM produto p"
                . " INNER JOIN tipo_produto tp ON tp.id=p.tipo_produto_id"
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
        
        $query = "SELECT count(*) FROM produto";
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
    
    public function novoRegistro($produto) {
        
        $sql = "INSERT INTO ";
        $campos = " produto (";
        $valores = " VALUES (";
        
        $startFor = 0;
        
        foreach ($produto as $key=>$tp) {
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
    
    public function atualizaRegistro($produto) {
        $sql = "UPDATE produto SET ";
        $valores = " ";
        $where = " ";
        $startFor = 0;
        
        $where .= " WHERE id = {$produto['id']}";
        
        foreach ($produto as $key=>$tp) {
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
        $sql = "SELECT * FROM produto WHERE id = {$id}";
        
        $resultado = pg_query($sql);
        
        $produto = pg_fetch_array($resultado, null, PGSQL_ASSOC);
        
        if($produto) {
            return $produto;
        } else {
            return "Não foi encontrado";
        }
    }
    
    public function excluir($id) {
        $sql = "DELETE FROM produto WHERE id = {$id}";
        
        $retorno = pg_query($sql);
        
        if($retorno) {
            return true;
        } else {
            return false;
        }
    }

    public function buscaAutocomplete($item) {
        
        $sql = "SELECT p.id, p.nome, p.preco, tp.imposto FROM produto p "
                . " INNER JOIN tipo_produto tp ON tp.id=p.tipo_produto_id "
                . " WHERE ";
        $where = "";
        
        // transforma valor en int
        $id = intval($item);

        if($id>0) {
            $where .= "p.id={$item} OR ";
        }
        
        $where .= " LOWER(p.nome) like LOWER('%{$item}%') ";
        
        $sql .= $where;
        
        $result = pg_query($sql);
        $lista = array();
            
        
        while ($row = pg_fetch_array($result, null, PGSQL_ASSOC)) {
            $lista[] = $row;
        }
        
        return $lista;
        
    }
    
}
