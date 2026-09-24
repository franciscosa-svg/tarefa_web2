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
?>