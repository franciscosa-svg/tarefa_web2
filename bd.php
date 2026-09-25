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
            if($index > 0) $sql .= ",";
            $sql .= $dado[0];
            $index++;
        }
        $sql .= ") values (";
        for ($i=0; $i < $index ; $i++) { 
            if($i > 0) $sql .= ",";
            $sql .= ":".$dados[$i][0];
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

    function getDados(string $tabela){
        $sql = "SELECT * from $tabela";

        try {
            $conn = getConnection();
            $rs = $conn->prepare($sql);

            $rs->execute();
            return $rs->fetchAll(PDO::FETCH_ASSOC);
        } catch (Throwable $e) {
            echo "Erro na conexão: " . $e->getMessage();
            return null;
        }
    }
?>