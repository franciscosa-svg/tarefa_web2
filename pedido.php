<?php
    $escolha = $_GET["escolha"];
    

    switch ($escolha) {
        case "cadastro":
            echo "<form action=\"pedido_CRUD/pedidoCadastro.php\" method=\"post\">
                <label for=\"nome\" class=\"caixa-saida\">Nome do produto</label>
                <input type=\"text\" id=\"nome\" name=\"nome\" class=\"caixa-entrada\" placeholder=\"Nome\"><br>
                <label for=\"preco\" class=\"caixa-saida\">Sabor do produto</label>
                <input type=\"text\" name=\"sabor\" id=\"sabor\" placeholder=\"sabor\"><br>
                <button type=\"submit\">Enviar</button>
                <button type=\"reset\">Resetar</button>
            </form>";            
            break;
        case "mostrar":

        default:
            echo "<h1 class=\"erro\">Erro: Não foi possível encontrar o tipo do formulário</h1>";
            break;
    }
?>