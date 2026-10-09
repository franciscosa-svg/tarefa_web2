<link rel="stylesheet" href="../style.css">
<?php
    include "../bd.php";
    $tabela = "produto";
    $filtro = [
        "parametro" => "id_produto",
        "valor" => intval($_GET["id"]) ?? 0
    ];
    $dados = [
        [
            "parametro" => "nome",
            "valor" => $_POST["nome"] ?? ""
        ],
        [
            "parametro" => "sabor",
            "valor" => $_POST["sabor"] ?? ""
        ]
        
    ];

    if(empty($dados[0]['valor']) || empty($dados[1]['valor'])){
        echo "<h1 class=\"erro\">Retornando a pagina de edição, por falta de conteudo</h1>";
        sleep(4);
        
        echo "<meta http-equiv=\"refresh\" content=\"5;url=produtoAtualizar.php?id={$filtro['id_produto']}\">";
        exit;
    }
    else{
        try {
            updateDados($tabela,$dados,$filtro);
            echo "<h1 class=\"sucesso\">Retornando para a pagina de visualizar, produto atualizado completo</h1>";
            sleep(4);
            
            echo "<meta http-equiv=\"refresh\" content=\"5;url=produtosVisualizar.php?\">";
        } catch (Throwable $e) {
            echo "<h1 class=\"erro\">Retornando a pagina de edição, falha na alteração</h1>";
            sleep(4);
            
            echo "<meta http-equiv=\"refresh\" content=\"5;url=produtoAtualizar.php?id={$filtro['id_produto']}\">";
        }
        
        exit;
    }
?>