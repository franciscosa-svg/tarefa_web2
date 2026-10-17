<link rel="stylesheet" href="../style.css">
<?php
    include "../bd.php";

    $cpf = $_POST["cpf"] ?? "";
    $id_produto =  intval($_POST["id"] ?? "0");
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
    if($id_produto <= 0 || $cpf === "" || $qntd <=0){
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
    try{
        $dados_clientes = getDados($tabelas[2], $filtro);
        if($dados_clientes === null){
            echo "<h1 class=\"erro\">Retornando a pagina inicial, cliente não registrado</h1>";
            retornar();
        }
        
        $cliente = $dados_clientes[0];

        

        setDado($tabelas[0], [[
            "id_cliente",
            "{$cliente["id_cliente"]}"
        ]]);


        $filtro_cliente = [
            "parametro" => "id_cliente",
            "valor" => $cliente["id_cliente"]
        ];
        $ordem_pedidos = [
            "parametro" => "id_pedido DESC"
        ];
        $ultimo_pedido = getDados($tabelas[0], $filtro_cliente, $ordem_pedidos);

        $produto_pedido_parametros = [
            [
                "id_produto",
                "{$id_produto}"
            ],
            [
                "id_pedido",
                "{$ultimo_pedido[0]["id_pedido"]}"
            ],
            [
                "quantidade",
                "{$qntd}"
            ]
        ];

        if(setDado($tabelas[1], $produto_pedido_parametros)){
            echo "<h1 class=\"sucesso\">Retornando a pagina inicial, sucesso no cadastro do pedido</h1>";
        }
        else{
            echo "<h1 class=\"erro\">Retornando a pagina inicial, erro no cadastro";
        }
        retornar();
    }
    catch(Throwable $e){
        echo "<h1 class=\"erro\">Retornando a pagina inicial, erro {$e->getMessage()}</h1>";
        retornar();
    }

    function retornar() {
        sleep(4);
            
        echo "<meta http-equiv=\"refresh\" content=\"5;url=../pedido.php?escolha=cadastro\">";
        exit;
    }
?>