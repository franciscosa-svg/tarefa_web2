<?php
    $filtro = [
        "id_produto" => $_GET["id"]
    ];
    $dados = [
        "nome" => $_POST["nome"] ?? "",
        "sabor" => $_POST["sabor"] ?? ""
    ];

    if(empty($dados['nome']) || empty($dados['sabor'])){
        
    }
?>