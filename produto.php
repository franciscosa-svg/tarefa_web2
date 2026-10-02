<?php
    $escolha = $_GET["escolha"] ?? "";

    switch ($escolha) {
        case "cadastro":
            echo "<form action=\"produtos_CRUD/produtoCadastro.php\" method=\"post\">
                <label for=\"nome\" class=\"caixa-saida\">Nome do produto</label>
                <input type=\"text\" id=\"nome\" name=\"nome\" class=\"caixa-entrada\" placeholder=\"Nome\"><br>
                <label for=\"sabor\" class=\"caixa-saida\">Sabor do produto</label>
                <input type=\"text\" name=\"sabor\" id=\"sabor\" class=\"caixa-entrada\" placeholder=\"Sabor\"><br>
                <button class=\"button\" type=\"submit\">Enviar</button>
                <button class=\"button\" type=\"reset\">Resetar</button>
                <a href=\"index.php\"><button class=\"button\" type=\"button\">Voltar</button></a>
            </form>";
            break;

        case "mostrar":
            echo "<h1 class=\"sucesso\">Produtos cadastrados</h1>";
            break;

        default:
            echo "<h1 class=\"erro\">Erro: Não foi possível encontrar o tipo do formulário</h1>";
            break;
    }
?>

