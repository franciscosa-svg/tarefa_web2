<link rel="stylesheet" href="../style.css">
<?php
    include "../bd.php";
    $id_pedido = intval($_GET["id_pedido"] ?? "0");
    $cpf = $_POST["cpf"] ?? "";
    $id_produto =  intval($_POST["id_produto"] ?? "0");
    $qntd = intval($_POST["qntd"] ?? "0");

    $cpf_valido = (strlen($cpf) === 11) || 
        ((strlen($cpf) === 14) && 
            ((substr_count($cpf,".") === 2) && 
            (substr_count($cpf,"-") === 1) &&
            ($cpf[3] === "." && $cpf[7] === "." && $cpf[11] === "-")
            ));

    if(!$cpf_valido){
        echo "<h1 class=\"erro\">Retornando a pagina inicial, insira um cpf valido</h1>";
        retornar();
    }
    if($id_produto <= 0 || $id_pedido <= 0 || $cpf === "" || $qntd <=0){
        echo "<h1 class=\"erro\">Retornando a pagina inicial, dados invalidos</h1>";
        retornar();
    }
    
    $tabelas = [
        "pedido",
        "produto_pedido",
        "cliente"];

    $filtro = [
        "parametro" => "cpf",
        "valor" => $cpf
    ];

    try {
        $dados_clientes = getDados($tabelas[2],$filtro);
        $id_cliente = $dados_clientes[0]["id_cliente"];

        $filtragem_pedido = [
            "parametro" => "id_pedido",
            "valor" => $id_pedido
        ];
        
        $novoPedido = [
            [
                "parametro" => "id_cliente",
                "valor" => $id_cliente
            ]
        ];

        $novoPP=[
            [
                "parametro" => "id_produto",
                "valor" => $id_produto
            ],
            [
                "parametro" => "quantidade",
                "valor" => $qntd
            ]
        ];

        $valor = updateDados($tabelas[0],$novoPedido,$filtragem_pedido) && updateDados($tabelas[1],$novoPP,$filtragem_pedido);
        if ($valor) {
            echo "<h1 class=\"sucesso\">Retornando para a pagina de visualizar, pedido atualizado completo</h1>";
            retornar();
        }
        else{
            echo "<h1 class=\"erro\">Retornando a pagina de edição, falha na alteração</h1>";
            
            sleep(4);
            
            echo "<meta http-equiv=\"refresh\" content=\"5;url=pedidoAtualizar.php?id={$id_pedido}\">";
            exit;
            
        }
    } catch (Throwable $e) {
    
    }
    function retornar() {
        sleep(4);
            
        echo "<meta http-equiv=\"refresh\" content=\"5;url=pedidosVisualizar.php\">";
        exit;
    }
?>