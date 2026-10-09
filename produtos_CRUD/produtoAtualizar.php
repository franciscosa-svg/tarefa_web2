<link rel="stylesheet" href="../style.css">
<?php
    include "../bd.php";
    $tabela = "produto";

    $filtragem = [
                "parametro" => "id_produto",
                "valor" => $_GET["id"]
            ];

    $dados = getDados($tabela, $filtragem);
    $dado = $dados[0];


    echo "<form class=\"formulario\" action=\"produtoAtualizarPost.php?id={$_GET["id"]}\" method=\"post\">
                <label for=\"nome\" class=\"caixa-saida\">Nome do produto</label>
                <input type=\"text\" id=\"nome\" name=\"nome\" class=\"caixa-entrada\" placeholder=\"Nome\" value=\"".$dado["nome"]."\"><br>
                <label for=\"preco\" class=\"caixa-saida\">Sabor do produto</label>
                <input type=\"text\" name=\"sabor\" class=\"caixa-entrada\" id=\"sabor\" placeholder=\"Sabor\" value=\"".$dado["sabor"]."\"><br>
                <button class=\"botao\" type=\"submit\">Enviar</button>
                <button class=\"botao\" type=\"reset\">Resetar</button>
                <a href=\"produtosVisualizar.php\"><button class=\"botao\" type=\"button\">Voltar</button></a>
            </form>";
?>