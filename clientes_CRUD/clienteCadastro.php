<?php
    include "../bd.php";

    $nome = trim((string)($_POST["nome"] ?? ""));
    $cpf = trim((string)($_POST["cpf"] ?? ""));
    $n_mesa = (int)($_POST["n_mesa"] ?? "0");

    $cpf_valido = (strlen($cpf) === 11) || (
        (strlen($cpf) === 14) &&
        (substr_count($cpf, ".") === 2) &&
        (substr_count($cpf, "-") === 1) &&
        ($cpf[3] === "." && $cpf[7] === "." && $cpf[11] === "-")
    );

    if ($n_mesa <= 0 || $nome === "" || $cpf === "") {
        echo "<h1 class=\"erro\">Retornando a pagina inicial, por falta de conteudo</h1>";
        echo "<meta http-equiv=\"refresh\" content=\"3;url=../cliente.php?escolha=cadastro\">";
        exit;
    }

    if (!$cpf_valido) {
        echo "<h1 class=\"erro\">Retornando a pagina inicial, cpf invalido</h1>";
        echo "<meta http-equiv=\"refresh\" content=\"3;url=../cliente.php?escolha=cadastro\">";
        exit;
    }

    $tabela = "cliente";
    $dados = [
        ["nome_completo", $nome],
        ["n_mesa", $n_mesa],
        ["cpf", $cpf]
    ];

    if (setDado($tabela, $dados)) {
        echo "<h1 class=\"sucesso\">Cliente cadastrado com sucesso!</h1>";
    } else {
        echo "<h1 class=\"erro\">Erro ao cadastrar cliente.</h1>";
    }

    echo "<meta http-equiv=\"refresh\" content=\"3;url=../cliente.php?escolha=cadastro\">";
    exit;
?>