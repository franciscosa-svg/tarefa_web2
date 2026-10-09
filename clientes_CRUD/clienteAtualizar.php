<link rel="stylesheet" href="../style.css">
<?php
    include "../bd.php";
    $tabela = "cliente";

    $filtragem = [
                "parametro" => "id_cliente",
                "valor" => $_GET["id"]
            ];

    $dados = getDados($tabela, $filtragem);
    $dado = $dados[0];


    echo "<form class=\"formulario\" action=\"clienteAtualizarPost.php?id={$_GET["id"]}\" method=\"post\">
                <label for=\"nome\" class=\"caixa-saida\">Nome do cliente</label>
                <input type=\"text\" id=\"nome\" name=\"nome\" class=\"caixa-entrada\" placeholder=\"Nome\" value=\"".$dado["nome_completo"]."\"><br>
                <label for=\"cpf\" class=\"caixa-saida\">CPF</label>
                <input type=\"text\" name=\"cpf\" class=\"caixa-entrada\" id=\"cpf\" placeholder=\"123.456.789-01\" value=\"".$dado["cpf"]."\"><br>
                <label for=\"n_mesa\" class=\"caixa-saida\">Número da mesa</label>
                <input type=\"text\" name=\"n_mesa\" class=\"caixa-entrada\" id=\"n_mesa\" placeholder=\"nº mesa\" value=\"".$dado["n_mesa"]."\"><br>
                <button class=\"botao\" type=\"submit\">Enviar</button>
                <button class=\"botao\" type=\"reset\">Resetar</button>
                <a href=\"clientesVisualizar.php\"><button class=\"botao\" type=\"button\">Voltar</button></a>
            </form>";
?>