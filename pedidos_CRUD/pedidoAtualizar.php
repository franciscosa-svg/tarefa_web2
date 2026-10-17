<link rel="stylesheet" href="../style.css">
<?php
    include "../bd.php";
    $filtragem_pedido = [
        "parametro" =>"id_pedido",
        "valor" => $_GET["id"]
    ];
    $tabela_cliente = "cliente";
    $tabela_pedido = "pedido";
    $tabela_produto = "produto";
    $tabela_pp = "produto_pedido";

    $dados_pedidos = getDados($tabela_pedido,$filtragem_pedido);
    $dados_pp = getDados($tabela_pp, $filtragem_pedido);
    $dados_produtos = getDados($tabela_produto);

    $filtragem_cliente = [
        "parametro" => "id_cliente",
        "valor" => $dados_pedidos[0]["id_cliente"]
    ];
    $dados_clientes = getDados($tabela_cliente, $filtragem_cliente);

    $opcoes = "\n";
    foreach ($dados_produtos as $dado) {
        if($dados_pp[0]["id_produto"] === $dado["id_produto"]){
            $opcoes .= "<option class=\"opcao\" value=\"{$dado["id_produto"]}\" selected>{$dado["nome"]}</option>\n";    
        }
        else{
            $opcoes .= "<option class=\"opcao\" value=\"{$dado["id_produto"]}\">{$dado["nome"]}</option>\n";
        }
    }
    echo "<form class=\"formulario formulario-cadastro\" action=\"pedidoAtualizarPost.php?id_pedido={$_GET["id"]}\" method=\"post\">
                <label for=\"cpf\" class=\"caixa-saida caixa-saida-cpf\">CPF</label>
                <input type=\"text\" id=\"cpf\" name=\"cpf\" class=\"caixa-entrada caixa-entrada-cpf\" value=\"{$dados_clientes[0]["cpf"]}\" placeholder=\"123.456.789-01\"><br>
                <select name=\"id_produto\" id=\"lista\" class=\"lista-opcoes lista\">
                    <option class=\"opcao\" value=\"\">--Escolha um produto--</option>
                    {$opcoes}
                </select>
                <label for=\"qntd\" id=\"caixa-saida-quantidade\" class=\"caixa-saida\"}\">Quantidade</label>
                <input type=\"text\" id=\"caixa-entrada-quantidade\" name=\"qntd\" class=\"caixa-entrada\" value=\"{$dados_pp[0]["quantidade"]}\"><br>
                <button class=\"botao\" type=\"submit\">Enviar</button>
                <button class=\"botao\" type=\"reset\">Resetar</button>
                <a href=\"pedidosVisualizar.php\"><button class=\"botao\" type=\"button\">Voltar</button></a>
            </form>";
?>