<link rel="stylesheet" href="style.css">
<?php
    $escolha = $_GET["escolha"] ?? "";

    switch ($escolha) {
        case "cadastro":
            $tabela = "produto";
            $ordernar = [
                "parametro" => "id_produto ASC"
            ];

            include "bd.php";
            $dados = getDados($tabela, null, $ordernar);

            $opcoes = "";
            foreach ($dados as $dado) {
                $opcoes = "<option class=\"opcao\" value=\"{$dado["id_produto"]}\">{$dado["nome"]}</option>";
            }
            echo "<form class=\"formulario\" action=\"pedidos_CRUD/pedidoCadastro.php?cadastro\" method=\"post\">
                <label for=\"cpf\" class=\"caixa-saida caixa-saida-cpf\">CPF</label>
                <input type=\"text\" id=\"cpf\" name=\"cpf\" class=\"caixa-entrada caixa-entrada-cpf\" placeholder=\"123.456.789-01\"><br>
                <select name=\"filtro\" id=\"lista\" class=\"lista-opcoes lista-filtro\">
                    <option class=\"opcao\" value=\"\">--Escolha um produto--</option>
                    {$opcoes}
                </select>
                <label for=\"qntd\" id=\"caixa-saida-quantidade\" class=\"caixa-saida\">Quantidade</label>
                <input type=\"text\" id=\"caixa-entrada-quantidade\" name=\"qntd\" class=\"caixa-entrada\" value=\"1\"><br>
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
