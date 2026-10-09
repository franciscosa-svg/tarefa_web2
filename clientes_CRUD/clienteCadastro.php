<link rel="stylesheet" href="../style.css">
<?php
    include "../bd.php";

    $nome = $_POST["nome"] ?? "";
    $n_mesa = null;
    $cpf = $_POST["cpf"] ?? "";

    $cpf_valido = (strlen($cpf) === 11) || 
        ((strlen($cpf) === 14) && 
            ((substr_count($cpf,".") === 2) && 
            (substr_count($cpf,"-") === 1) &&
            ($cpf[3] === "." && $cpf[7] === "." && $cpf[11] === "-")
            ));

    try{
        $n_mesa = intval($_POST["n_mesa"]) ?? 0;
    }
    catch(Throwable $e){
        echo "<h1 class=\"erro\">Retornando a pagina inicial, por entrada invalida</h1>";
        retornar();
    }

    if($n_mesa <= 0 || $nome==="" || $cpf===""){
        echo "<h1 class=\"erro\">Retornando a pagina inicial, por falta de conteudo</h1>";
        retornar();
    }
    else if(!$cpf_valido){
        echo "<h1 class=\"erro\">Retornando a pagina inicial, cpf invalido</h1>";
        retornar();
    }
    else{
        $tabela = "cliente";

        $dados = [
            ["nome_completo",$nome],
            ["n_mesa",$n_mesa],
            ["cpf",$cpf]
        ];

        try{
            if (setDado($tabela,$dados)){ echo "<h1 class=\"sucesso\">Retornando para a pagina inicial, produto cadastrado completo</h1>";}
            else{ echo "<h1 class=\"erro\">Retornando a pagina inicial, por falta de conteudo</h1>";}
        }
        catch(Throwable $e){
            echo "<h1 class=\"erro\">Erro na hora de registrar</h1>";
        }

        retornar();
        
    }

    function retornar(){
        sleep(4);
        
        echo "<meta http-equiv=\"refresh\" content=\"5;url=../cliente.php?escolha=cadastro\">";
        exit;
    }
?>