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
        $totalDados = count($dados);
        $index = 0;
        
        foreach ($dados as $dado) {
            $sql .= $dado[0];
            if($index < $totalDados - 1) $sql .= ",";
            $index++;
        }
        
        $sql .= ") values (";
        
        $index = 0;
        foreach ($dados as $dado) {
            $sql .= ":".$dado[0];
            if($index < $totalDados - 1) $sql .= ",";
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

    function getDados($tabela, $filtro = [], $ordenar = []){
        $sql = "SELECT * from $tabela ";

        if(!empty($filtro)){
            $sql .= "where ".$filtro["parametro"]."= :parametro_filtro";
        }
        if(!empty($ordenar)){
            $sql .= " order by {$ordenar["parametro"]}";
        }

        try {
            $conn = getConnection();
            $rs = $conn->prepare($sql);

            if(!empty($filtro)){
                $rs->bindParam(":parametro_filtro", $filtro["valor"]);
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
            if($index < count($valores)-1) $sql.=", ";
            $index++;
        }

        if($filtro != null){
            $sql .= " where ".$filtro["parametro"]."= :".$filtro["parametro"]."_filtro";
        }

        try {
            $conn = getConnection();
            $rs = $conn->prepare($sql);

            foreach ($valores as $valor) {
                $rs->bindValue(":".$valor["parametro"],$valor["valor"]);
            }

            if($filtro != null){
                $rs->bindValue(":".$filtro["parametro"]."_filtro", $filtro["valor"]);
            }

            $rs->execute();
            return $rs->rowCount() > 0;
        } catch (Throwable $e) {
            echo "Erro na conexão: " . $e->getMessage();
            return null;
        }
    }

    function deleteValor($tabela, $filtro = []) {
        $sql = "DELETE from $tabela ";
        if($filtro != null){
            $sql .= "where ".$filtro["parametro"]."= :".$filtro["parametro"];
        }

        try {
            $conn = getConnection();
            $rs = $conn->prepare($sql);

            if($filtro != null){
                $rs->bindParam(":".$filtro["parametro"], $filtro["valor"]);
            }

            $rs->execute();
            return $rs->rowCount() > 0;
        } catch (Throwable $e) {
            echo "Erro na conexão: " . $e->getMessage();
            return null;
        }
    }
?>