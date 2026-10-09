<link rel="stylesheet" href="../style.css">
<?php
    include "../bd.php";

    $nome = $_POST["nome"] ?? "";
    $sabor = $_POST["sabor"] ?? "";

    if($sabor==="" || $nome===""){
        echo "<h1 class=\"erro\">Retornando a pagina inicial, por falta de conteudo</h1>";
        
    }
    else{
        $tabela = "produto";

        $dados = [
            ["nome",$nome],
            ["sabor",$sabor]
        ];

        if (setDado($tabela,$dados)) {
            echo "<h1 class=\"sucesso\">Retornando para a pagina inicial, produto cadastrado completo</h1>";
        }
        else{ 
            echo "<h1 class=\"erro\">Retornando a pagina inicial, por falta de conteudo</h1>";
        }
        
    }
    sleep(4);
        
    echo "<meta http-equiv=\"refresh\" content=\"5;url=../produto.php?escolha=cadastro\">";
    exit;
?>