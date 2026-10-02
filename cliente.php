<?php
    $escolha = $_GET["escolha"] ?? "";

    switch ($escolha) {
        case "cadastro":
            echo "<form action=\"clientes_CRUD/clienteCadastro.php\" method=\"post\">
                <label for=\"nome\" class=\"caixa-saida\">Nome do cliente</label>
                <input type=\"text\" id=\"nome\" name=\"nome\" class=\"caixa-entrada\" placeholder=\"Nome\"><br>
                <label for=\"n_mesa\" class=\"caixa-saida\">Número da mesa</label>
                <input type=\"text\" name=\"n_mesa\" id=\"n_mesa\" class=\"caixa-entrada\" placeholder=\"Nº da mesa\"><br>
                <label for=\"cpf\" class=\"caixa-saida\">CPF</label>
                <input type=\"text\" name=\"cpf\" id=\"cpf\" class=\"caixa-entrada\" placeholder=\"123.456.789-01\"><br>
                <button class=\"button\" type=\"submit\">Enviar</button>
                <button class=\"button\" type=\"reset\">Resetar</button>
                <a href=\"index.php\"><button class=\"button\" type=\"button\">Voltar</button></a>
            </form>";
            break;

        case "mostrar":
            echo "<h1 class=\"sucesso\">Clientes cadastrados</h1>";
            break;

        default:
            echo "<h1 class=\"erro\">Erro: Não foi possível encontrar o tipo do formulário</h1>";
            break;
    }
?>
