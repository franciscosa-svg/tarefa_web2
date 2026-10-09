<link rel="stylesheet" href="../style.css">
<?php
    include "../bd.php";
    $tabela = "cliente";
    $filtro = [
        "parametro" => "id_cliente",
        "valor" => intval($_GET["id"]) ?? 0
    ];
    $dados = [
        [
            "parametro" => "nome_completo",
            "valor" => $_POST["nome"] ?? ""
        ],
        [
            "parametro" => "n_mesa",
            "valor" => $_POST["n_mesa"] ?? ""
        ],
        [
            "parametro" => "cpf",
            "valor" => $_POST["cpf"] ?? ""
        ]
        
    ];

    if(empty($dados[0]['valor']) || empty($dados[1]['valor']) || empty($dados[2]['valor'])){
        echo "<h1 class=\"erro\">Retornando a pagina de edição, por falta de conteudo</h1>";
        sleep(4);
        
        echo "<meta http-equiv=\"refresh\" content=\"5;url=clienteAtualizar.php?id={$filtro['id_cliente']}\">";
        exit;
    }
    else{
        try {
            updateDados($tabela,$dados,$filtro);
            echo "<h1 class=\"sucesso\">Retornando para a pagina de visualizar, cliente atualizado completo</h1>";
            sleep(4);
            
            echo "<meta http-equiv=\"refresh\" content=\"5;url=clientesVisualizar.php?\">";
        } catch (Throwable $e) {
            echo "<h1 class=\"erro\">Retornando a pagina de edição, falha na alteração</h1>";
            sleep(4);
            
            echo "<meta http-equiv=\"refresh\" content=\"5;url=clienteAtualizar.php?id={$filtro['id_cliente']}\">";
        }
        
        exit;
    }
?>