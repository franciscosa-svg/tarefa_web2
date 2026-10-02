<?php

    function getConnection(){
        $password="Pr0gr4m4nd0F0d4cc1";
        $dbname="postgres";
        $user="postgres.swnktyhluazfuxmgncgr";
        $port="5432";
        $host="aws-0-ca-central-1.pooler.supabase.com";

        try {
            $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";
            $conn = new PDO($dsn, $user, $password);
            
            // Define o modo de erro do PDO para exceção
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            //echo "Conexão realizada com sucesso!";
            return $conn;
        } catch (PDOException $e) {
            echo "Erro na conexão: " . $e->getMessage();
            return null;
        }
    }

    function setDado($tabela, $dados) {
        $sql = "INSERT INTO $tabela(";
        $index = 0;
        
        foreach ($dados as $dado) {
            $sql .= $dado[0];
            if($index > count($tabela)-1) $sql .= ",";
            $index++;
        }
        
        $sql .= ") values (";
        
        $index = 0;
        foreach ($dados as $dado) {
            $sql .= ":".$dado[0];
            if($index > count($tabela)-1) $sql .= ",";
            $index++;
        }

        $sql .= ")";

        try{
            $conn = getConnection();
            $ps = $conn->prepare($sql);

            foreach ($dados as $dado) {
                $ps->bindParam(":".$dado[0],$dado[1]);
            }

            return $ps->execute();
        }
        catch(PDOException $e){
            echo "Erro na conexão: " . $e->getMessage();
            return false;
        }
    }

    function getDados($tabela, $filtro){
        $sql = "SELECT * from $tabela ";

        if($filtro != null){
            $sql .= "where ".$filtro[0]."= :".$filtro[0];
        }

        try {
            $conn = getConnection();
            $rs = $conn->prepare($sql);

            if($filtro != null){
                $rs->bindParam(":".$filtro[0], $filtro[1]);
            }

            $rs->execute();
            return $rs->fetchAll(PDO::FETCH_ASSOC);
        } catch (Throwable $e) {
            echo "Erro na conexão: " . $e->getMessage();
            return null;
        }
    }

    function updateDados($tabela, $valores, $filtro) {
        $sql = "UPDATE $tabela SET ";
        $index = 0;
        foreach ($valores as $valor) {
            $sql .= $valor["parametro"] . "= :" . $valor["parametro"];
            if($index < count($valores)-1) $sql.=",";
            $index++;
        }

        if($filtro != null){
            $sql .= " where ".$filtro[0]."= :".$filtro[0]."_filtro";
        }

        try {
            $conn = getConnection();
            $rs = $conn->prepare($sql);

            foreach ($valores as $valor) {
                $rs->bindParam(":".$valor["parametro"],$valor["valor"]);
            }

            if($filtro != null){
                $rs->bindParam(":".$filtro[0]."_filtro", $filtro[1]);
            }

            $rs->execute();
            return $rs->fetchAll(PDO::FETCH_ASSOC);
        } catch (Throwable $e) {
            echo "Erro na conexão: " . $e->getMessage();
            return null;
        }
    }

    function deleteValor($tabela, $filtro) {
        $sql = "DELETE $tabela ";
        if($filtro != null){
            $sql .= "where ".$filtro[0]."= :".$filtro[0];
        }

        try {
            $conn = getConnection();
            $rs = $conn->prepare($sql);

            if($filtro != null){
                $rs->bindParam(":".$filtro[0], $filtro[1]);
            }

            $rs->execute();
            return $rs->fetchAll(PDO::FETCH_ASSOC);
        } catch (Throwable $e) {
            echo "Erro na conexão: " . $e->getMessage();
            return null;
        }
    }
?>