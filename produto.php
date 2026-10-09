<link rel="stylesheet" href="style.css">
<?php
    $escolha = $_GET["escolha"] ?? "";

    switch ($escolha) {
        case "cadastro":
            echo "<form class=\"formulario\" action=\"produtos_CRUD/produtoCadastro.php?cadastro\" method=\"post\">
                <label for=\"nome\" class=\"caixa-saida\">Nome do produto</label>
                <input type=\"text\" id=\"nome\" name=\"nome\" class=\"caixa-entrada\" placeholder=\"Nome\"><br>
                <label for=\"preco\" class=\"caixa-saida\">Sabor do produto</label>
                <input type=\"text\" name=\"sabor\" class=\"caixa-entrada\" id=\"sabor\" placeholder=\"Sabor\"><br>
                <button class=\"botao\" type=\"submit\">Enviar</button>
                <button class=\"botao\" type=\"reset\">Resetar</button>
                <a href=\"index.php\"><button class=\"botao\" type=\"button\">Voltar</button></a>
            </form>";            
            break;
        case "mostrar":

            echo "<meta http-equiv=\"refresh\" content=\"2;url=produtos_CRUD/produtosVisualizar.php?escolha=\">";
            break;
        default:
            echo "<h1 class=\"erro\">Erro: Não foi possível encontrar o tipo do formulário</h1>";
            break;
            
    }
?>
