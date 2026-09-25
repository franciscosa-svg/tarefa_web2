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
        $n_mesa = intval($_POST["n_mesa"] ?? "");
    }
    catch(Throwable $e){
        echo "<h1 class=\"erro\">Retornando a pagina inicial, por entrada invalida</h1>";
        sleep(4);
        header("Location: .../cliente.php?escolha=cadastro");
        exit;
    }

    if($n_mesa >= 0 || $nome==="" || $cpf===""){
        echo "<h1 class=\"erro\">Retornando a pagina inicial, por falta de conteudo</h1>";
        sleep(4);
        header("Location: .../cliente.php?escolha=cadastro");
        exit;
    }
    else if(!$cpf_valido){
        echo "<h1 class=\"erro\">Retornando a pagina inicial, cpf invalido</h1>";
        sleep(4);
        header("Location: .../cliente.php?escolha=cadastro");
        exit;
    }
    else{
        $tabela = "cliente";

        $dados = [
            ["nome",$nome],
            ["n_mesa",$n_mesa],
            ["cpf",$cpf]
        ];

        if (setDado($tabela,$dados)) echo "<h1 class=\"sucesso\">Retornando para a pagina inicial, produto cadastrado completo</h1>";
        else echo "<h1 class=\"erro\">Retornando a pagina inicial, por falta de conteudo</h1>";
        sleep(4);
        
        header("Location: .../produto.php?escolha=cadastro");
        exit;
    }
?>