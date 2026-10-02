<?php
    include "../bd.php";

    $nome = trim((string)($_POST["nome"] ?? ""));
    $sabor = trim((string)($_POST["sabor"] ?? ""));

    if ($sabor === "" || $nome === "") {
        echo "<h1 class=\"erro\">Retornando a pagina inicial, por falta de conteudo</h1>";
        echo "<meta http-equiv=\"refresh\" content=\"3;url=../produto.php?escolha=cadastro\">";
        exit;
    }

    $tabela = "produto";
    $dados = [
        ["nome", $nome],
        ["sabor", $sabor]
    ];

    if (setDado($tabela, $dados)) {
        echo "<h1 class=\"sucesso\">Produto cadastrado com sucesso!</h1>";
    } else {
        echo "<h1 class=\"erro\">Erro ao cadastrar produto.</h1>";
    }

    echo "<meta http-equiv=\"refresh\" content=\"3;url=../produto.php?escolha=cadastro\">";
    exit;
?>