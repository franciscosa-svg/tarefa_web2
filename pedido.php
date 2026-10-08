<link rel="stylesheet" href="style.css">
<?php
    $escolha = $_GET["escolha"] ?? "";

    switch ($escolha) {
        case "cadastro":
            echo "<h1 class=\"sucesso\">Cadastro de pedido</h1>
                <p>Funcionalidade em desenvolvimento.</p>
                <a href=\"index.php\"><button class=\"button\" type=\"button\">Voltar ao menu</button></a>";
            break;

        case "mostrar":
            echo "<h1 class=\"sucesso\">Pedidos</h1>
                <p>Lista de pedidos em desenvolvimento.</p>
                <a href=\"index.php\"><button class=\"button\" type=\"button\">Voltar ao menu</button></a>";
            break;

        default:
            echo "<h1 class=\"erro\">Erro: Não foi possível encontrar o tipo do formulário</h1>
                <a href=\"index.php\"><button class=\"button\" type=\"button\">Voltar ao menu</button></a>";
            break;
    }
?>